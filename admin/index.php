<?php

declare(strict_types=1);

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


//use XoopsModules\Lasius\Common;

use Xmf\Module\Admin;
use XoopsModules\Lasius;

include_once \dirname(__DIR__) . '/preloads/autoloader.php';
require __DIR__ . '/header.php';

// Template Index
$templateMain = 'lasius_admin_index.tpl';

// Count elements

// InfoBox Statistics
$adminObject->addInfoBox(_AM_LASIUS_STATISTICS);
// Info elements
$adminObject->addInfoBoxLine(\sprintf( '<label>' . 'No statistics' . '</label>', 0));
// Render Index
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('index.php'));
// Test Data
if ($helper->getConfig('displaySampleButton')) {
	\xoops_loadLanguage('admin/modulesadmin', 'system');
	include_once \dirname(__DIR__) . '/testdata/index.php';
//	$adminObject->addItemButton(\constant('CO_' . $moduleDirNameUpper . '_ADD_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=load', 'add');
//	$adminObject->addItemButton(\constant('CO_' . $moduleDirNameUpper . '_SAVE_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=save', 'add');
//	$adminObject->addItemButton(\constant('CO_' . $moduleDirNameUpper . '_EXPORT_SCHEMA'), '__DIR__ . /../../testdata/index.php?op=exportschema', 'add');
	$adminObject->displayButton('left');
}
$GLOBALS['xoopsTpl']->assign('index', $adminObject->displayIndex());
// End Test Data
require __DIR__ . '/footer.php';
