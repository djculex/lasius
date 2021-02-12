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
 
use Xmf\Module\Admin;
use XoopsModules\Lasius\{
    Helper
};
/** @var Admin $adminObject */
/** @var Helper $helper */

//require dirname(__DIR__) . '/preloads/autoloader.php';

include dirname(__DIR__, 3) . '/include/cp_header.php';
include_once \dirname(__DIR__) . '/include/common.php';

$helper = Helper::getInstance();

$sysPathIcon16   = $helper->getModule()->getInfo('sysicons16');
$sysPathIcon32   = $helper->getModule()->getInfo('sysicons32');

$modPathIcon16   = LASIUS_URL . '/' . $GLOBALS['xoopsModule']->getInfo('modicons16') . '/';
$modPathIcon32   = LASIUS_URL . '/' . $GLOBALS['xoopsModule']->getInfo('modicons32') . '/';
$myts = MyTextSanitizer::getInstance();
$helper        = Helper::getInstance();
// 
if (!isset($xoopsTpl) || !\is_object($xoopsTpl)) {
	include_once XOOPS_ROOT_PATH . '/class/template.php';
	$xoopsTpl = new \XoopsTpl();
}

// Load languages
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');

xoops_cp_header();

// System icons path
$GLOBALS['xoopsTpl']->assign('sysPathIcon16', $sysPathIcon16);
$GLOBALS['xoopsTpl']->assign('sysPathIcon32', $sysPathIcon32);
$GLOBALS['xoopsTpl']->assign('modPathIcon16', $modPathIcon16);
$GLOBALS['xoopsTpl']->assign('modPathIcon32', $modPathIcon32);

$adminObject = Admin::getInstance();
$style = LASIUS_URL . '/assets/css/admin/style.css';
