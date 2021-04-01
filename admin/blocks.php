<?php

use XoopsModules\Lasius\{
	Tools,
	Db
};
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Lasius module for xoops
 *
 * @copyright      2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        lasius
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         Culex - Email:<culex@culex.dk> - Website:<http://culex.dk>
 */

require __DIR__ . '/header.php';
$GLOBALS['xoTheme']->addStylesheet($helper->url('assets/css/admin/style.css'));
$GLOBALS['xoTheme']->addScript($helper->url('assets/js/admin.js'));
include_once XOOPS_ROOT_PATH .'/modules/system/class/block.php';
global $xoopsDB;
$tools = new Tools();
$Db = new Db();
$ti = [];
$si = [];
$nab = [];

$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('blocks.php'));
$db = $xoopsDB;
$all = new \XoopsBlockHandler($db);

// Get all visible blocks
$s = new Criteria('visible', $value = '1', $operator = '=', $prefix = '', $function = '');
$ab = $all->getList($criteria = $s);
	foreach ($ab as $k => $v) {
		$nab[$Db->getBlockTitleFromId($k)] = $Db->getBlockTitleFromName($v);
	}
$xoopsTpl->assign('activeblocks', $nab);

// Get all blocks supported by this module
$xoopsTpl->assign('supportedblocks', $tools->getBlockArray());
foreach ($tools->getBlockArray() as $k => $v) {
	$ti[$v] = hoursRange( 0, 3600, 15 );
	$si[$v] = $Db->getSetSelected($Db->getBlockNameFromTitle($v));
	$ai[$v] = $Db->getSetActivated($Db->getBlockNameFromTitle($v));
}

$xoopsTpl->assign('timeInterval',$ti);
$xoopsTpl->assign('selected',$si);
$xoopsTpl->assign('activated',$ai);

// Get array of intervals to template
$xoopsTpl->assign('timeInterval', hoursRange( 0, 3600, 15 ));
$xoopsTpl->display('db:lasius_admin_blocks.tpl');

require __DIR__ . '/footer.php';