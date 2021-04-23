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
	Db,
	Helper
};
include __DIR__ . '/preloads/autoloader.php';

require_once dirname(__DIR__,2) . '/mainfile.php';
require_once XOOPS_ROOT_PATH . '/class/template.php';
include_once XOOPS_ROOT_PATH .'/modules/system/blocks/system_blocks.php';
$helper = Helper::getInstance();
// Type of block ("onlinenow", "topposters") etc
$type = Request::getString('type', '', 'GET');
// Name of module user is watching
$name = Request::getString('name', '', 'GET');
$tools = new Tools();
// language files
$language = $xoopsConfig['language'];
$Db = new Db();
$tools->update($name);

switch ($type) {   
	
	// ----- System blocks ------
		// Whos online system module
		case 'onlinenow':
			$tpl = new \XoopsTpl();
			$tpl->caching = 0;
			$result = $tools->b_system_online_show($name);
			$users = $tools->getOnlineUsers();
			$tpl->assign('block', $result);	
			if ($helper->getConfig('LASIUSUSEDIALOG') > 0) {
				$tpl->assign('blockhidden', $users);
				$tpl->display(XOOPS_ROOT_PATH . "/modules/lasius/templates/blocks/lasius_system_block_online.tpl");				
			} else {
				$tpl->display('db:system_block_online.tpl');
			}
			//$tpl->display(XOOPS_ROOT_PATH . "/modules/system/templates/blocks/system_block_online.tpl");
			
			break;
		
		// Top posters
		case 'topposters':
			$tpl = new XoopsTpl();
			$tpl->caching = 0;
			$o = $tools->getBlockOptions('b_system_topposters_show');
			$result = b_system_topposters_show($o);
			$tpl->assign('block', $result);	
			$tpl->display('db:system_block_topusers.tpl');
			break;
		
		// New members
		case 'newmembers':
			$tpl = new XoopsTpl();
			$tpl->caching = 0;
			$o = $tools->getBlockOptions('b_system_newmembers_show');
			$result = b_system_newmembers_show($o);
			$tpl->assign('block', $result);	
			$tpl->display('db:system_block_newusers.tpl');
			break;
		
		//Recent system comments
		case 'recentcomments':
			$tpl = new XoopsTpl();
			$tpl->caching = 0;
			$o = $Db->getBlockOptions('b_system_comments_show');
			$result = b_system_comments_show($o);
			$tpl->assign('block', $result);	
			$tpl->display('db:system_block_comments.tpl');
			break;
			
		//User menu
		case 'usermenu':
			if (!file_exists(XOOPS_ROOT_PATH . '/modules/system/language/' . $language . '/blocks.php')) {
				$language = 'english';
			}
			require_once XOOPS_ROOT_PATH . '/modules/system/language/' . $language . '/blocks.php';
			$tpl = new XoopsTpl();
			$tpl->caching = 0;
			//$o = $Db->getBlockOptions('b_system_user_show');
			$result = b_system_user_show();
			$tpl->assign('xoops_isadmin', $helper->isUserAdmin() ? 1 : 0);
			$tpl->assign('block', $result);	
			$tpl->display('db:system_block_user.tpl');
			break;
	
	// ----- publisher module -----
		// Recent articles
		case 'recentpublisherarticles': 
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
		
		// Recent news
		case 'recentpublishernews': 
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
		
	// ----- newBB module -----	
		// Revent posts
		case 'recentnewbbposts': 
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
	
	// ----- ExtCal -----
		// calendar block
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
			
		//Upcommin events	
		case 'upcevents': 
			if (!file_exists(XOOPS_ROOT_PATH . '/modules/extcal/language/' . $language . '/blocks.php')) {
				$language = 'english';
			}
			require_once XOOPS_ROOT_PATH .'/modules/extcal/blocks/upcoming.php';
			require_once XOOPS_ROOT_PATH . '/modules/extcal/language/' . $language . '/blocks.php';
			$tpl = new XoopsTpl();
			$tpl->caching = 0;
			$o = $Db->getBlockOptions('bExtcalUpcomingShow');
			$result = bExtcalUpcomingShow($o);
			$tpl->assign('block', $result);	
			$tpl->display('db:extcal_block_upcoming.tpl');
			break;		
		
	// ----- News module -----
		// recent news
		case 'newsrecentnews': 
			if (!file_exists(XOOPS_ROOT_PATH . '/modules/news/language/' . $language . '/blocks.php')) {
				$language = 'english';
			}
			require_once XOOPS_ROOT_PATH .'/modules/news/blocks/news_top.php';
			require_once XOOPS_ROOT_PATH . '/modules/news/language/' . $language . '/blocks.php';
			$tpl = new XoopsTpl();
			$tpl->caching = 0;
			$o = $Db->getBlockOptions('b_news_top_show');
			$result = b_news_top_show($o);
			$tpl->assign('block', $result);	
			$tpl->display('db:news_block_top.tpl');
			break;	

	// ----- Banners -----
		// Display banner
		case 'banner':
		require_once XOOPS_ROOT_PATH . '/include/functions.php';
		$banner_handler = xoops_getModuleHandler('banner', 'system');
		//echo $banner_handler;
		echo xoops_getbanner();
}

$GLOBALS['xoopsLogger']->activated = false;

