<?php
namespace XoopsModules\Lasius;

use XoopsModules\Lasius;
use XoopsModules\Lasius\Constants;

class tools
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
		$data = array();
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
		$data = array();
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
			$block   = array();
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
}