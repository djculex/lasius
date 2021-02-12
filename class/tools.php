<?php
namespace XoopsModules\Lasius;

use XoopsModules\Lasius;
use XoopsModules\Lasius\Constants;

class Tools
{
	/**
	* constructor
	*
	* @param mixed $id
	**/
	public function __construct($id = null)
	{
		//$this->initVar('bid', XOBJ_DTYPE_INT, null, false);
	}
	
	public function getBlockTitle($showfunc){
		$data = [];
		//SELECT title FROM `xoops2511_newblocks` WHERE `show_func` = "b_system_online_show"
		$query  = 'SELECT title FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE show_func = '" . addslashes($showfunc) . "' ORDER BY title ASC ";
		$result = $GLOBALS['xoopsDB']->queryF($query);
		$counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = $sqlfetch['title'];
            }
        }
		return $data;
	}
	
	public function getBlockOptions($showfunc){
		$data = [];
		//SELECT title FROM `xoops2511_newblocks` WHERE `show_func` = "b_system_online_show"
		$query  = 'SELECT options FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE show_func = '" . addslashes($showfunc) . "' ORDER BY options ASC ";
		$result = $GLOBALS['xoopsDB']->queryF($query);
		$counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = explode('|', $sqlfetch['options']);
            }
        }
		return $data;
	}
	
	
	public function moduleNameById ($dir) {
		$n = "";
		$s = ($dir == "htdocs") ? "system" : $dir;
		//SELECT name FROM `xoops2511_modules` WHERE `mid` = 10
		$query  = 'SELECT name FROM ' . $GLOBALS['xoopsDB']->prefix('modules') . " WHERE dirname = '" . addslashes($s) . "' ORDER BY name ASC ";
		$result = $GLOBALS['xoopsDB']->queryF($query);
		$counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $n = ($sqlfetch['name'][0] != "Lasius") ? $sqlfetch['name'] : "System";
            }
        }
		return $n;
	}
	
	public function midByName ($name) {
	$n = "";
	//SELECT name FROM `xoops2511_modules` WHERE `mid` = 10
	$query  = 'SELECT mid FROM ' . $GLOBALS['xoopsDB']->prefix('modules') . " WHERE name = '" . addslashes($name) . "' ORDER BY mid ASC ";
	$result = $GLOBALS['xoopsDB']->queryF($query);
	$counter = $GLOBALS['xoopsDB']->getRowsNum($result);
	if ($counter >= 1) {
		while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
			$n = ($name == "Lasius" OR $name == "htdocs" OR $name == "" OR $name="index.php") ? 1 : $sqlfetch['mid'];
		}
	}
	return $n;
	}
	
	public function CountMidByName ($mbid) {
		$query  = 'SELECT count(*) FROM ' . $GLOBALS['xoopsDB']->prefix('modules') . " WHERE mid = '" . addslashes($mbid)."'";
		$result = $GLOBALS['xoopsDB']->queryF($query);
		return $GLOBALS['xoopsDB']->getRowsNum($result);
	}

	
	public function b_system_online_show($url)
	{
		global $xoopsUser, $xoopsModule;
		/* @var XoopsOnlineHandler $online_handler */
		$online_handler = xoops_getHandler('online');
		// set gc probabillity to 10% for now..
		if (mt_rand(1, 100) < 11) {
			$online_handler->gc(300);
		}
		if (is_object($xoopsUser)) {
			$uid   = $xoopsUser->getVar('uid');
			$uname = $xoopsUser->getVar('uname');
		} else {
			$uid   = 0;
			$uname = '';
		}
		$requestIp = \Xmf\IPAddress::fromRequest()->asReadable();
		$requestIp = (false === $requestIp) ? '0.0.0.0' : $requestIp;
		
		$onlines = $online_handler->getAll();
		if (!empty($onlines)) {
			$title = $this->moduleNameById ($url);
			$mbid = $this->midByName ($title);
			$count = $this->CountMidByName($mbid);
			$total   = count($onlines);
			$block   = [];
			$guests  = 0;
			$members = '';
			for ($i = 0; $i < $total; ++$i) {
				if ($onlines[$i]['online_uid'] > 0) {
					$members .= ' <a href="' . XOOPS_URL . '/userinfo.php?uid=' . $onlines[$i]['online_uid'] . '" title="' . $onlines[$i]['online_uname'] . '">' . $onlines[$i]['online_uname'] . '</a>,';
				} else {
					++$guests;
				}
			}
			$block['online_total'] = sprintf(_ONLINEPHRASE, $total);
			if (is_object($xoopsModule)) {
				//$mytotal = $online_handler->getCount(new \Criteria('online_module', $xoopsModule->getVar('mid')));
				$block['online_total'] .= ' (' . sprintf(_ONLINEPHRASEX, $count, $title) . ')';
			}
			$block['lang_members']   = _MEMBERS;
			$block['lang_guests']    = _GUESTS;
			$block['online_names']   = $members;
			$block['online_members'] = $total - $guests;
			$block['online_guests']  = $guests;
			$block['lang_more']      = _MORE;
			//print_r($block);
			return $block;
		} else {
			return false;
		}
	}
	
	// options[0] - Citeria valid: title(by default), text
// options[1] - NumberToDisplay: any positive integer
// options[2] - TimeDuration: negative for hours, positive for days, for instance, -5 for 5 hours and 5 for 5 days
// options[3] - DisplayMode: 0-full view;1-compact view;2-lite view; Only valid for "time"
// options[4] - Display Navigator: 1 (by default), 0 (No)
// options[5] - Title/Text Length : 0 - no limit
// options[6] - SelectedForumIDs: null for all

	/**
	 * @param $options
	 * @return array
	 */
	function b_newbb_post_show($options)
	{
		global $accessForums;
		global $newbbConfig;

		//require_once dirname(__DIR__) . '/include/functions.time.php';
		require_once XOOPS_ROOT_PATH .'/modules/newbb/include/functions.time.php';
		
		$myts          = \MyTextSanitizer::getInstance();
		$block         = [];
		$i             = 0;
		$order         = '';
		$extraCriteria = '';
		$time_criteria = null;
		if (!empty($options[2])) {
			$time_criteria = time() - newbbGetSinceTime($options[2]);
			$extraCriteria = ' AND p.post_time>' . $time_criteria;
		}

		switch ($options[0]) {
			case 'text':
				if (!empty($newbbConfig['enable_karma'])) {
					$extraCriteria .= ' AND p.post_karma = 0';
				}
				if (!empty($newbbConfig['allow_require_reply'])) {
					$extraCriteria .= ' AND p.require_reply = 0';
				}
			// no break
			default:
				$order = 'p.post_id';
				break;
		}

		if (!isset($accessForums)) {
			/** var Newbb\PermissionHandler $permHandler */
			$permHandler = \XoopsModules\Newbb\Helper::getInstance()->getHandler('Permission');
			if (!$accessForums = $permHandler->getForums()) {
				return $block;
			}
		}

		$newbbConfig = newbbLoadConfig();
		if (!empty($newbbConfig['do_rewrite'])) {
			require_once $GLOBALS['xoops']->path('modules/newbb/seo_url.php');
		} else {
			if (!defined('SEO_MODULE_NAME')) {
				define('SEO_MODULE_NAME', 'modules/newbb');
			}
		}

		if (!empty($options[6])) {
			$myallowedForums = array_filter(array_slice($options, 6), 'b_newbb_array_filter'); // get allowed forums
			$allowedForums   = array_intersect($myallowedForums, $accessForums);
		} else {
			$allowedForums = $accessForums;
		}
		if (empty($allowedForums)) {
			return $block;
		}

		$forumCriteria   = ' AND p.forum_id IN (' . implode(',', $allowedForums) . ')';
		$approveCriteria = ' AND p.approved = 1';

		$query = 'SELECT';
		$query .= '    p.post_id, p.subject, p.post_time, p.icon, p.uid, p.poster_name,';
		if ('text' === $options[0]) {
			$query .= '    pt.dohtml, pt.dosmiley, pt.doxcode, pt.dobr, pt.post_text,';
		}
		$query .= '    f.forum_id, f.forum_name' . '    FROM ' . $GLOBALS['xoopsDB']->prefix('newbb_posts') . ' AS p ' . '    LEFT JOIN ' . $GLOBALS['xoopsDB']->prefix('newbb_forums') . ' AS f ON f.forum_id=p.forum_id';
		if ('text' === $options[0]) {
			$query .= '    LEFT JOIN ' . $GLOBALS['xoopsDB']->prefix('newbb_posts_text') . ' AS pt ON pt.post_id=p.post_id';
		}
		$query .= '    WHERE 1=1 ' . $forumCriteria . $approveCriteria . $extraCriteria . ' ORDER BY ' . $order . ' DESC';

		$result = $GLOBALS['xoopsDB']->query($query, $options[1], 0);
		if (!$result) {
			//xoops_error($GLOBALS['xoopsDB']->error());
			return $block;
		}
		$block['disp_mode'] = ('text' === $options[0]) ? 3 : $options[3]; // 0 - full view; 1 - compact view; 2 - lite view;
		$rows               = [];
		$author             = [];
		while (false !== ($row = $GLOBALS['xoopsDB']->fetchArray($result))) {
			$rows[]              = $row;
			$author[$row['uid']] = 1;
		}
		if (count($rows) < 1) {
			return $block;
		}
		//require_once dirname(__DIR__) . '/include/functions.user.php';
		require_once XOOPS_ROOT_PATH . '/modules/newbb/include/functions.user.php';
		$author_name = newbbGetUnameFromIds(array_keys($author), $newbbConfig['show_realname'], true);

		foreach ($rows as $arr) {
			//if ($arr['icon'] && is_file($GLOBALS['xoops']->path('images/subject/' . $arr['icon']))) {
			if (!empty($arr['icon'])) {
				$last_post_icon = '<img src="' . XOOPS_URL . '/images/subject/' . htmlspecialchars($arr['icon'], ENT_QUOTES | ENT_HTML5) . '" alt="" >';
			} else {
				$last_post_icon = '<img src="' . XOOPS_URL . '/images/subject/icon1.gif" alt="" >';
			}
			//$topic['jump_post'] = "<a href='" . XOOPS_URL . "/modules/newbb/viewtopic.php?post_id=" . $arr['post_id'] ."#forumpost" . $arr['post_id'] . "'>" . $last_post_icon . '</a>';
			$topic               = [];
			$topic['forum_id']   = $arr['forum_id'];
			$topic['forum_name'] = $myts->htmlSpecialChars($arr['forum_name']);
			//$topic['id'] = $arr['topic_id'];

			$title = $myts->htmlSpecialChars($arr['subject']);
			if ('text' !== $options[0] && !empty($options[5])) {
				$title = xoops_substr($title, 0, $options[5]);
			}
			$topic['title']   = $title;
			$topic['post_id'] = $arr['post_id'];
			$topic['time']    = newbbFormatTimestamp($arr['post_time']);
			if (!empty($author_name[$arr['uid']])) {
				$topic_poster = $author_name[$arr['uid']];
			} else {
				$topic_poster = $myts->htmlSpecialChars($arr['poster_name'] ?: $GLOBALS['xoopsConfig']['anonymous']);
			}
			$topic['topic_poster'] = $topic_poster;

			if ('text' === $options[0]) {
				$post_text = $myts->displayTarea($arr['post_text'], $arr['dohtml'], $arr['dosmiley'], $arr['doxcode'], 1, $arr['dobr']);
				if (!empty($options[5])) {
					$post_text = xoops_substr(strip_tags($post_text), 0, $options[5]);
				}
				$topic['post_text'] = $post_text;
			}
			// START irmtfan remove hardcoded html in URLs
			$seo_url       = XOOPS_URL . '/' . SEO_MODULE_NAME . '/viewtopic.php?post_id=' . $topic['post_id'];
			$seo_forum_url = XOOPS_URL . '/' . SEO_MODULE_NAME . '/viewforum.php?forum=' . $topic['forum_id'];
			// END irmtfan remove hardcoded html in URLs
			if (!empty($newbbConfig['do_rewrite'])) {
				$topic['seo_url']       = seo_urls($seo_url);
				$topic['seo_forum_url'] = seo_urls($seo_forum_url);
			} else {
				$topic['seo_url']       = $seo_url;
				$topic['seo_forum_url'] = $seo_forum_url;
			}

			$block['topics'][] = $topic;
			unset($topic);
		}
		// START irmtfan remove hardcoded html in URLs
		$seo_top_allforums          = XOOPS_URL . '/' . SEO_MODULE_NAME;
		$block['seo_top_allforums'] = !empty($newbbConfig['do_rewrite']) ? seo_urls($seo_top_allforums) : $seo_top_allforums;
		$seo_top_allforums          = XOOPS_URL . '/' . SEO_MODULE_NAME . '/list.topic.php';
		$block['seo_top_alltopics'] = !empty($newbbConfig['do_rewrite']) ? seo_urls($seo_top_allforums) : $seo_top_allforums;
		$seo_top_allforums          = XOOPS_URL . '/' . SEO_MODULE_NAME . '/viewpost.php';
		$block['seo_top_allposts']  = !empty($newbbConfig['do_rewrite']) ? seo_urls($seo_top_allforums) : $seo_top_allforums;
		// END irmtfan remove hardcoded html in URLs

		$block['indexNav'] = (int)$options[4];
		return $block;
	}

}
