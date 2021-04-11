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

// 
$moduleDirName      = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);
// ------------------- Informations ------------------- //
$modversion = [
	'name'                => _MI_LASIUS_NAME,
	'version'             => 1.18,
	'description'         => _MI_LASIUS_DESC,
	'author'              => 'Culex',
	'author_mail'         => 'culex@culex.dk',
	'author_website_url'  => 'http://culex.dk',
	'author_website_name' => 'culex.dk',
	'credits'             => 'culex',
	'license'             => 'GPL 3.0 or later',
	'license_url'         => 'http://www.gnu.org/licenses/gpl-3.0.en.html',
	'help'                => 'page=help',
	'release_info'        => 'release_info',
	'release_file'        => XOOPS_URL . '/modules/lasius/docs/release_info file',
	'release_date'        => '2021/02/01',
	'manual'              => 'link to manual file',
	'manual_file'         => XOOPS_URL . '/modules/lasius/docs/install.txt',
	'min_php'             => '7.1',
	'min_xoops'           => '2.5.9',
	'min_admin'           => '1.2',
	'min_db'              => ['mysql' => '5.5', 'mysqli' => '5.0'],
    'image'               => 'assets/images/logoModule.png',
	'dirname'             => basename(__DIR__),
	'sqlfile'             => ['mysql' => 'sql/mysql.sql'],
	// Tables created by sql file (without prefix!)
	'tables'              => [
        $moduleDirName . '_' . 'config',
	],
	'sysicons16'          => '../../Frameworks/moduleclasses/icons/16',
	'sysicons32'          => '../../Frameworks/moduleclasses/icons/32',
	'modicons16'          => 'assets/icons/16',
	'modicons32'          => 'assets/icons/32',
	'demo_site_url'       => 'https://xoops.org',
	'demo_site_name'      => 'XOOPS Demo Site',
	'support_url'         => 'https://xoops.org/modules/newbb',
	'support_name'        => 'Support Forum',
	'module_website_url'  => 'www.xoops.org',
	'module_website_name' => 'XOOPS Project',
	'release'             => '05/25/2020',
	'module_status'       => 'RC 3',
	'system_menu'         => 1,
	'hasAdmin'            => 1,
	'hasMain'             => 1,
	'adminindex'          => 'admin/index.php',
	'adminmenu'           => 'admin/menu.php',
	'onInstall'           => 'include/install.php',
	'onUninstall'         => 'include/uninstall.php',
	'onUpdate'            => 'include/update.php',
];
// ------------------- Templates ------------------- //
$modversion['templates'] = [
	// Admin templates
	['file' => 'lasius_admin_about.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'lasius_admin_header.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'lasius_admin_index.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'lasius_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'lasius_admin_blocks.tpl', 'description' => '', 'type' => 'admin'],
	// User templates
	['file' => 'lasius_header.tpl', 'description' => ''],
	['file' => 'lasius_index.tpl', 'description' => ''],
	['file' => 'lasius_breadcrumbs.tpl', 'description' => ''],
	['file' => 'lasius_footer.tpl', 'description' => ''],
];

// Update js frameworks
$modversion['config'][] = [
	'name'        => 'updatejquery',
	'title'       => '_MI_LASIUS_UPDJQUERY',
	'description' => '_MI_LASIUS_UPDJQUERY_DESC',
	'formtype'    => 'yesno',
	'valuetype'   => 'int',
	'default'     => 0,
];

$modversion['config'][] = [
	'name'        => 'updatejqueryui',
	'title'       => '_MI_LASIUS_UPDJQUERYUI',
	'description' => '_MI_LASIUS_UPDJQUERYUI_DESC',
	'formtype'    => 'yesno',
	'valuetype'   => 'int',
	'default'     => 0,
];

// replace popups with jqueryUI dialog
$modversion['config'][] = [
	'name'        => 'LASIUSUSEDIALOG',
	'title'       => '_MI_LASIUS_USEDIALOG',
	'description' => '_MI_LASIUS_USEDIALOG_DESC',
	'formtype'    => 'yesno',
	'valuetype'   => 'int',
	'default'     => 0,
];

// Maintained by
$modversion['config'][] = [
	'name'        => 'maintainedby',
	'title'       => '_MI_LASIUS_MAINTAINEDBY',
	'description' => '_MI_LASIUS_MAINTAINEDBY_DESC',
	'formtype'    => 'textbox',
	'valuetype'   => 'text',
	'default'     => 'https://xoops.org/modules/newbb',
];
