<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project http://xoops.org/
 * @license      GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team, Kazumi Ono (AKA onokazu)
 */

//use Xoops\Core\Kernel\Criteria;
//use Xoops\Core\FixedGroups;
use Xmf\Request;
use XoopsModules\Lasius\{
	Tools,
	Db
};

require_once dirname(__DIR__,2) . '/mainfile.php';
require_once XOOPS_ROOT_PATH . '/class/template.php';
include_once XOOPS_ROOT_PATH .'/modules/system/blocks/system_blocks.php';

// Type of block ("onlinenow", "topposters") etc
$type = Request::getString('type', '', 'GET');
// Name of module user is watching
$name = Request::getString('name', '', 'GET');
$tools = new Tools();
// language files
$language = $xoopsConfig['language'];
$Db = new Db();
$tools->update();
switch ($type) {
    case 'onlinenow':
		$tpl = new \XoopsTpl();
		$tpl->caching = 0;
		$result = $tools->b_system_online_show($name);
		$tpl->assign('block', $result);	
		//$tpl->display(XOOPS_ROOT_PATH . "/modules/system/templates/blocks/system_block_online.tpl");
		$tpl->display('db:system_block_online.tpl');
        break;
		
    case 'topposters':
        //$moduleHandler = xoops_getHandler('module');
		//$module  = $moduleHandler->get($mid);
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		$o = $tools->getBlockOptions('b_system_topposters_show');
		$result = b_system_topposters_show($o);
		$tpl->assign('block', $result);	
		$tpl->display('db:system_block_topusers.tpl');
        break;
    case 'newmembers':
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		$o = $tools->getBlockOptions('b_system_newmembers_show');
		$result = b_system_newmembers_show($o);
		$tpl->assign('block', $result);	
		$tpl->display('db:system_block_newusers.tpl');
        break;
	case 'recentcomments':
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		$o = $Db->getBlockOptions('b_system_comments_show');
		$result = b_system_comments_show($o);
		$tpl->assign('block', $result);	
		$tpl->display('db:system_block_comments.tpl');
        break;
		
	case 'recentpublisherarticles': //publisher module
		if (!file_exists(XOOPS_ROOT_PATH . '/modules/publisher/language/' . $language . '/blocks.php')) {
			$language = 'english';
		}
		require_once XOOPS_ROOT_PATH .'/modules/publisher/blocks/items_recent.php';
		require_once XOOPS_ROOT_PATH . '/modules/publisher/language/' . $language . '/blocks.php';
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		$o = $Db->getBlockOptions('publisher_items_recent_show');
		$result = publisher_items_recent_show($o);
		$tpl->assign('block', $result);	
		$tpl->display('db:publisher_items_recent.tpl');
        break;
		
	case 'recentpublishernews': //publisher module
		if (!file_exists(XOOPS_ROOT_PATH . '/modules/publisher/language/' . $language . '/blocks.php')) {
			$language = 'english';
		}
		require_once XOOPS_ROOT_PATH .'/modules/publisher/blocks/latest_news.php';
		require_once XOOPS_ROOT_PATH . '/modules/publisher/language/' . $language . '/blocks.php';
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		$o = $Db->getBlockOptions('publisher_latest_news_show');
		$result = publisher_latest_news_show($o);
		$tpl->assign('block', $result);	
		$tpl->display('db:publisher_latest_news.tpl');
        break;
		
	
	case 'recentnewbbposts': //newBB module
		if (!file_exists(XOOPS_ROOT_PATH . '/modules/newbb/language/' . $language . '/blocks.php')) {
			$language = 'english';
		}
		require_once XOOPS_ROOT_PATH . '/modules/newbb/language/' . $language . '/blocks.php';
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		
		$o = $Db->getBlockOptions('b_newbb_post_show');
		$result = $tools->b_newbb_post_show($o);
		$tpl->assign('block', $result);	
		$tpl->display('db:newbb_block_post.tpl');
        break;
	
	// extCal block(s)
	case 'extcalminical': //newBB module
		if (!file_exists(XOOPS_ROOT_PATH . '/modules/extcal/language/' . $language . '/blocks.php')) {
			$language = 'english';
		}
		require_once XOOPS_ROOT_PATH .'/modules/extcal/blocks/minical.php';
		require_once XOOPS_ROOT_PATH . '/modules/extcal/language/' . $language . '/blocks.php';
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		
		$o = $Db->getBlockOptions('bExtcalMinicalShow');
		$o[10] = ''; // remove hourlog clock from extcal. 
					 // If not screen wil jitter
		$result = bExtcalMinicalShow($o);
		$tpl->assign('block', $result);	
		$tpl->display('db:extcal_block_minical.tpl');
        break;
		
}

$GLOBALS['xoopsLogger']->activated = false;

