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
use XoopsModules\Lasius\{Helper
};

/** @var Helper $helper */

include dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);
$helper             = Helper::getInstance();

$sysPathIcon32 = Admin::menuIconPath('');

$adminmenu[] = [
    'title' => _MI_LASIUS_ADMENU1,
    'link'  => 'admin/index.php',
    'icon'  => $sysPathIcon32 . '/dashboard.png',
];
$adminmenu[] = [
    'title' => _MI_LASIUS_ADMENU2,
    'link'  => 'admin/feedback.php',
    'icon'  => $sysPathIcon32 . '/mail_foward.png',
];
$adminmenu[] = [
    'title' => _MI_LASIUS_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $sysPathIcon32 . '/about.png',
];
