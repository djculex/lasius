<?php
namespace XoopsModules\Lasius;

use Xmf\Request;
use XoopsModules\Lasius\{
	Tools,
	Db,
	Helper,
	Constants
};

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

	/*
	 * Create array of mudule titles supported by this module
	 * @return array $array
	 */
	public function getBlockArray()
	{
		$db = new Db();
		$array = array(
			$db->getBlockTitle('b_system_online_show'), 		// online users block
			$db->getBlockTitle('b_system_topposters_show'),		// Top posters block
			$db->getBlockTitle('b_system_newmembers_show'),		// New members block
			$db->getBlockTitle('b_system_comments_show'),		// Comments show block
			$db->getBlockTitle('publisher_items_recent_show'),	// Latest articles publisher block
			$db->getBlockTitle('publisher_latest_news_show'),	// Latest news publisher block
			$db->getBlockTitle('b_newbb_post_show'),			// Latest posts NewBB block
			$db->getBlockTitle('bExtcalMinicalShow'),			// Show calandar ExtCal block
			$db->getBlockTitle('b_system_user_show'),			// Show user menu block
			$db->getBlockTitle('bExtcalUpcomingShow'),			// Upcoming events ExtCal block
			'Recent news',										// *Hack * Latest news News block *TODO find better way *
			'Banners'											// *Hack * Banners is not really a block but usefull anyway *
		);
		return $array;
	}
	
	/* Function to search for string part
	 * @param string $a			string to search in
	 * @return string $value	string name of module
	 *
	 */
	 function searchStringPart($a)
	 {
		if (substr_count($a, 'userinfo')) {
			return 1;
		}
	 }
	
	/**
	 * function to refresh online tables
	 * Thanks to NewBB :-)
	 *
	 */
   public function update($url)
   {
        global $xoopsModule;
        /** @var \XoopsOnlineHandler $xoopsOnlineHandler */
        $xoopsOnlineHandler = xoops_getHandler('online');
        // set gc probabillity to 10% for now..
		$db = new Db();
		$title   = $db->moduleNameById($url);
        $mbid    = $db->midByName($title);
		$mbid	 = ($mbid != '') ? $mbid : $this->searchStringPart($url);
		
        $count   = $db->CountMidByName($mbid);
        if (mt_rand(1, 100) < 60) {
            $xoopsOnlineHandler->gc(150);
        }
        if (is_object($GLOBALS['xoopsUser'])) {
            $uid   = $GLOBALS['xoopsUser']->getVar('uid');
            $uname = $GLOBALS['xoopsUser']->getVar('uname');
            $name  = $GLOBALS['xoopsUser']->getVar('name');
        } else {
            $uid   = 0;
            $uname = '';
            $name  = '';
        }
		//echo $uid. " - ". $uname . " - " . $mbid. "<br>";
        /*$xoopsupdate = $xoopsOnlineHandler->write($uid, $uname, time(), $mbid, \Xmf\IPAddress::fromRequest()->asReadable());
        if (!$xoopsupdate) {
            //xoops_error("Lasius write error");
        }
		*/
    }

    public function b_system_online_show($url)
    {
        global $xoopsUser, $xoopsModule;
		$db = new Db();
		$helper = \XoopsModules\Lasius\Helper::getInstance();
		//$this->update($url);
        /* @var XoopsOnlineHandler $online_handler */
		$start = 0;
        $online_handler = xoops_getHandler('online');
		$online_total = $online_handler->getCount();
		$limit = ($online_total > 20) ? 20 : $online_total;
		$criteria = new \CriteriaCompo();
		$criteria->setLimit($limit);
		$criteria->setStart($start);
		//$onlines = $online_handler->getAll($criteria);
        // set gc probabillity to 10% for now..
        if (random_int(1, 100) < 11) {
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

        $onlines = $online_handler->getAll($criteria);
        if (!empty($onlines)) {
            $title   = $db->moduleNameById($url);
			
            $mbid    = $db->midByName($title);
			$mbid	 = ($mbid != '') ? $mbid : $this->searchStringPart($url);
			if ($title == "") {
				$title = $db->moduleNameByMid($mbid);
			}
            $count   = $db->CountMidByName($mbid);
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
			$block['takeoverlinks']  = $helper->getConfig('LASIUSUSEDIALOG');
            //print_r($block);
            return $block;
        } else {
            return false;
        }
    }
	
	public function getOnlineUsers()
	{
		global $xoopsUser, $xoopsModule;
		$helper = Helper::getInstance();
		$isadmin = $helper->isUserAdmin();
		$start = 0;
		/* @var XoopsOnlineHandler $online_handler */
		$online_handler = xoops_getHandler('online');
		$online_total = $online_handler->getCount();
		$limit = ($online_total > 2000) ? 20 : $online_total;
		$criteria = new \CriteriaCompo();
		$criteria->setLimit($limit);
		$criteria->setStart($start);
		$onlines = $online_handler->getAll($criteria);
		$count = count($onlines);
		/* @var XoopsModuleHandler $module_handler */
		$module_handler = xoops_getHandler('module');
		$modules = $module_handler->getList(new \Criteria('isactive', 1));
		
		for ($i = 0; $i < $count; ++$i) {
			if ($onlines[$i]['online_uid'] == 0) {
				$onlineUsers[$i]['user'] = '';
			} else {
				$onlineUsers[$i]['user'] =  new \XoopsUser($onlines[$i]['online_uid']);
			}
			$onlineUsers[$i]['ip'] = $onlines[$i]['online_ip'];
			$onlineUsers[$i]['ipinfo'] = $this->lookupIp($onlineUsers[$i]['ip']);
			$onlineUsers[$i]['updated'] = $onlines[$i]['online_updated'];
			$onlineUsers[$i]['module'] = ($onlines[$i]['online_module'] > 0) ? $modules[$onlines[$i]['online_module']] : '';
			//echo $onlineUsers[$i]['module']." -> ".$onlineUsers[$i]['online_uid'];
			$onlineUsers[$i]['flaghtml'] = '<img class="lasius-online-flag" src = "https://www.verdensflag.dk/data/flags/h80/' .  strtolower($onlineUsers[$i]['ipinfo']['countryCode']) . '.webp" alt="' . $onlineUsers[$i]['ipinfo']['country'] . '" />';
		}
		$class = 'even';
		for ($i = 0; $i < $count; ++$i) {
			$class = ($class === 'odd') ? 'even' : 'odd';
			if (is_object($onlineUsers[$i]['user'])) {
				$onlineUsers[$i]['useravatar'] = $onlineUsers[$i]['user']->getVar('user_avatar') ? '<img class="lasius-online-avatar" src="' . XOOPS_UPLOAD_URL . '/' . $onlineUsers[$i]['user']->getVar('user_avatar') . '" alt="" />' : '&nbsp;';
				//<a href=\"javascript:window.opener.location='" . XOOPS_URL . '/userinfo.php?uid=' . $onlineUsers[$i]['user']->getVar('uid') . "';window.close();\">" . $onlineUsers[$i]['user']->getVar('uname') . '</a>';
				$onlineUsers[$i]['username'] = "<a href='" . XOOPS_URL . "/userinfo.php?uid=" . $onlineUsers[$i]['user']->getVar('uid') . "'>" . $onlineUsers[$i]['user']->getVar('uname') . "</a>";
			} else {
				$onlineUsers[$i]['useravatar'] = '<img class="lasius-online-avatar" src="' .XOOPS_URL. '/modules/lasius/assets/images/unknownuser.png" alt="" />';
				$onlineUsers[$i]['username'] = $onlines[$i]['online_ip'];
			}
		}
		//var_dump("<pre>",$onlineUsers,"</pre>");
		
		return $onlineUsers;
	}

	public function lookupIp($ip)
	{
		$api_url = "http://www.geoplugin.net/php.gp?ip={$ip}";
		$port = 80;
		$ch = curl_init( );
		curl_setopt ( $ch, CURLOPT_URL, $api_url );
		curl_setopt ( $ch, CURLOPT_PORT, $port );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		// Allowing cUrl funtions 20 second to execute
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 5 );
		// Waiting 20 seconds while trying to connect
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 5 );                                 
		$query = unserialize(curl_exec( $ch ));
		curl_close ($ch);
		
		//if($query && $query['geoplugin_status'] == 200){
			$result['country'] = $query['geoplugin_countryName'];
			$result['countryCode'] = $query['geoplugin_countryCode'];
			$result['city'] = $query['geoplugin_city'];
			$result['lat'] = $query['geoplugin_latitude'];
			$result['lon'] = $query['geoplugin_longitude'];
		//}
		return $result;
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
    public function b_newbb_post_show($options)
    {
        global $accessForums;
        global $newbbConfig;

        //require_once dirname(__DIR__) . '/include/functions.time.php';
        require_once XOOPS_ROOT_PATH . '/modules/newbb/include/functions.time.php';

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
	
	public function setJqueryScript()
	{
		if ($_SESSION["lasiusCoreEvents"] == 0) { // Check $_session
		global $xoopsConfig;
		$helper = \XoopsModules\Lasius\Helper::getInstance();
		
		$Db = new Db();
		$_SESSION["lasiusCoreEvents"] += 1;
		$script = null;
		$name = basename($_SERVER['REQUEST_URI']);
		// language files
		$language = $xoopsConfig['language'];
		
		// Check prevents multiple loads
		//$script = "jQuery(document).ready(function(){"."\n";
		//$script  .= 'var Lasius_myID;' . "\n";
		
        $script   = "if (typeof Lasius_myID === 'undefined' || typeof Lasius_myID === '') {"."\n";
        $script  .= "var Lasius_systemurl = '" . XOOPS_URL . "/modules/lasius';\n";
		
		$script  .= "var Lasius_myID = 1;\n";
		$script  .= "var Lasius_refurl = '".$name. "';\n";
		$script  .= 'var Lasius_usepopups = ' . $helper->getConfig('LASIUSUSEDIALOG') . ";\n";
		$script  .= 'var Lasius_reviveonlineusersblock = ' . $Db->getSetSelected($Db->getBlockName('b_system_online_show')) . ";\n";
		$script  .= "var Lasius_reviveonlineusersblock_title = '" . $Db->getBlockTitle('b_system_online_show') . "';\n";
		
		$script  .= 'var Lasius_revivetoppostersblock = ' . $Db->getSetSelected($Db->getBlockName('b_system_topposters_show')) . ";\n";
		$script  .= "var Lasius_revivetoppostersblock_title = '" . $Db->getBlockTitle('b_system_topposters_show') . "';\n";
		
		$script  .= 'var Lasius_revivenewmembersblock = ' . $Db->getSetSelected($Db->getBlockName('b_system_newmembers_show')) . ";\n";
		$script  .= "var Lasius_revivenewmembersblock_title = '" . $Db->getBlockTitle('b_system_newmembers_show') . "';\n";
		
		
		$script  .= 'var Lasius_reviverecentcommentsblock = ' . $Db->getSetSelected($Db->getBlockName('b_system_comments_show')) . ";\n";
		$script  .= "var Lasius_reviverecentcommentsblock_title = '" . $Db->getBlockTitle('b_system_comments_show') . "';\n";
		
		$script  .= 'var Lasius_reviverecentpub_art_block = ' . $Db->getSetSelected($Db->getBlockName('publisher_items_recent_show')) . ";\n";
		$script  .= "var Lasius_reviverecentpub_art_block_title = '" . $Db->getBlockTitle('publisher_items_recent_show') . "';\n";
		
		$script  .= 'var Lasius_reviverecentpubnewsblock = ' . $Db->getSetSelected($Db->getBlockName('publisher_latest_news_show')) . ";\n";
		$script  .= "var Lasius_reviverecentpubnewsblock_title = '" . $Db->getBlockTitle('publisher_latest_news_show') . "';\n";
		
		$script  .= 'var Lasius_reviverecentnewbbpostsblock = ' . $Db->getSetSelected($Db->getBlockName('b_newbb_post_show')) . ";\n";
		$script  .= "var Lasius_reviverecentnewbbpostsblock_title = '" . $Db->getBlockTitle('b_newbb_post_show') . "';\n";
		
		$script  .= 'var Lasius_reviverecentextcalminicalblock = ' . $Db->getSetSelected($Db->getBlockName('bExtcalMinicalShow')) . ";\n";
		$script  .= "var Lasius_reviverecentextcalminicalblock_title = '" . $Db->getBlockTitle('bExtcalMinicalShow') . "';\n";
		
		$script  .= 'var Lasius_reviveusermenublock = ' . $Db->getSetSelected($Db->getBlockName('b_system_user_show')) . ";\n";
		$script  .= "var Lasius_reviveusermenublock_title = '" . $Db->getBlockTitle('b_system_user_show') . "';\n";
		
		$script  .= 'var Lasius_reviveextcalupceventsblock = ' . $Db->getSetSelected($Db->getBlockName('bExtcalUpcomingShow')) . ";\n";
		$script  .= "var Lasius_reviveextcalupceventsblock_title = '" . $Db->getBlockTitle('bExtcalUpcomingShow') . "';\n";
		
		$script  .= 'var Lasius_revivenewslatestnewsblock = ' . $Db->getSetSelected($Db->getBlockName('b_news_top_show')) . ";\n";
		$script  .= "var Lasius_revivenewslatestnewsblock_title = '" . $Db->getBlockTitleFromName('Recent news') . "';\n";
		
		$script  .= 'var Lasius_revivebannerblock = ' . $Db->getSetSelected('Banners') . ";\n";
		$script  .= "var Lasius_revivebannerblock_title = 'Banners';\n";
		
		$script  .= '};' . "\n";
		//$script  .= "});"."\n";
		
		// Include jquery new or framework ?
		$jq  = "if(jQuery.fn.jquery.split('.')" . "\n";
		$jq .= ".map(function(i){return('0'+i).slice(-2)})" . "\n";
		$jq .= "		.join('.') > '01.08.03')" . "\n";
		$jq .= "	{" . "\n";
		$jq .= "		alert('yes');" . "\n";
		$jq .= "	}" . "\n";
		$jq .= "	else" . "\n";
		$jq .= "	{" . "\n";
		$jq .= "		alert('no');" . "\n";
		$jq .= "		var script = document.createElement('script');" . "\n";
		$jq .= "		script.src = 'https://code.jquery.com/jquery-latest.min.js';" . "\n";
		$jq .= "		script.type = 'text/javascript';" . "\n";
		$jq .= "		document.getElementsByTagName('head')[0].appendChild(script);" . "\n";
		$jq .= "	};";
		
		
		if ($helper->getConfig('updatejquery') > 0) {
			$GLOBALS['xoTheme']->addScript('https://code.jquery.com/jquery-latest.min.js');
		} else {
			$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
			//$GLOBALS['xoTheme']->addScript(null, array( 'type' => 'text/javascript' ), $jq, 'CheckJquery');
		}
		
		// Jquery ui
		if ($helper->getConfig('updatejqueryui') > 0) {
			//$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/plugins/jquery.ui.js');
			$GLOBALS['xoTheme']->addScript("https://code.jquery.com/ui/1.12.1/jquery-ui.min.js");
		}
			if ($_SESSION["lasiusCoreEvents"] <= 1) {
				//echo "inserted : ".$_SESSION["lasiusCoreEvents"];
				$GLOBALS['xoTheme']->addScript(null, array( 'type' => 'text/javascript' ), $script, 'lasiusCore');
			}
		}
		$GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/lasius/assets/js/agent.js');
		$GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/lasius/assets/js/lasius.js');
	}
}
