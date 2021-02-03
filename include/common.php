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
if (!\defined('XOOPS_ICONS32_PATH')) {
	\define('XOOPS_ICONS32_PATH', XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
}
if (!\defined('XOOPS_ICONS32_URL')) {
	\define('XOOPS_ICONS32_URL', XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
}
\define('LASIUS_DIRNAME', 'lasius');
\define('LASIUS_PATH', XOOPS_ROOT_PATH . '/modules/' . LASIUS_DIRNAME);
\define('LASIUS_URL', XOOPS_URL . '/modules/' . LASIUS_DIRNAME);
\define('LASIUS_ICONS_PATH', LASIUS_PATH . '/assets/icons');
\define('LASIUS_ICONS_URL', LASIUS_URL . '/assets/icons');
\define('LASIUS_IMAGE_PATH', LASIUS_PATH . '/assets/images');
\define('LASIUS_IMAGE_URL', LASIUS_URL . '/assets/images');
\define('LASIUS_UPLOAD_PATH', XOOPS_UPLOAD_PATH . '/' . LASIUS_DIRNAME);
\define('LASIUS_UPLOAD_URL', XOOPS_UPLOAD_URL . '/' . LASIUS_DIRNAME);
\define('LASIUS_UPLOAD_FILES_PATH', LASIUS_UPLOAD_PATH . '/files');
\define('LASIUS_UPLOAD_FILES_URL', LASIUS_UPLOAD_URL . '/files');
\define('LASIUS_UPLOAD_IMAGE_PATH', LASIUS_UPLOAD_PATH . '/images');
\define('LASIUS_UPLOAD_IMAGE_URL', LASIUS_UPLOAD_URL . '/images');
\define('LASIUS_UPLOAD_SHOTS_PATH', LASIUS_UPLOAD_PATH . '/images/shots');
\define('LASIUS_UPLOAD_SHOTS_URL', LASIUS_UPLOAD_URL . '/images/shots');
\define('LASIUS_ADMIN', LASIUS_URL . '/admin/index.php');
$localLogo = LASIUS_IMAGE_URL . '/culex_logo.png';
// Module Information
$copyright = "<a href='http://culex.dk' title='culex.dk' target='_blank'><img src='" . $localLogo . "' alt='culex.dk' /></a>";
include_once XOOPS_ROOT_PATH . '/class/xoopsrequest.php';
include_once LASIUS_PATH . '/include/functions.php';
