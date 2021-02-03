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
use Xoops\Core\FixedGroups;
use Xmf\Request;
use XoopsModules\Lasius\{
	tools
};
include dirname(dirname(__DIR__)) . '/mainfile.php';
require_once XOOPS_ROOT_PATH . '/class/template.php';
include_once XOOPS_ROOT_PATH .'/modules/system/blocks/system_blocks.php';

/**
 * @return array|bool
 */
 
$type = Request::getString('type', '', 'GET');
$tools = new tools();

switch ($type) {
    case "onlinenow":
		//$moduleHandler = xoops_getHandler('module');
		//$module  = $moduleHandler->get($mid);
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		$result = b_system_online_show();
		$tpl->assign('block', $result);	
		$tpl->display(XOOPS_ROOT_PATH . "/modules/system/templates/blocks/system_block_online.tpl");
		//unset($module);
		//$tpl->display('db:system_block_online.tpl');
        break;
    case "topposters":
        //$moduleHandler = xoops_getHandler('module');
		//$module  = $moduleHandler->get($mid);
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		$o = $tools->getBlockOptions("b_system_topposters_show");
		$result = b_system_topposters_show($o);
		$tpl->assign('block', $result);	
		$tpl->display(XOOPS_ROOT_PATH . "/modules/system/templates/blocks/system_block_topusers.tpl");
		//unset($module);
		//$tpl->display('db:system_block_online.tpl');
        break;
    case "newmembers":
		//$moduleHandler = xoops_getHandler('module');
		//$module  = $moduleHandler->get($mid);
		$tpl = new XoopsTpl();
		$tpl->caching = 0;
		$o = $tools->getBlockOptions("b_system_newmembers_show");
		$result = b_system_newmembers_show($o);
		$tpl->assign('block', $result);	
		$tpl->display(XOOPS_ROOT_PATH . "/modules/system/templates/blocks/system_block_newusers.tpl");
		//unset($module);
		//$tpl->display('db:system_block_online.tpl');
        break;
}

$GLOBALS['xoopsLogger']->activated = false;

