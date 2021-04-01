<?php

declare(strict_types=1);
/**
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright       The XUUPS Project http://sourceforge.net/projects/xuups/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @since           1.0
 * @author          trabis <lusopoemas@gmail.com>
 * @author          The SmartFactory <www.smartfactory.ca>
 */

use XoopsModules\Lasius;
use XoopsModules\Lasius\Constants;

require_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require_once dirname(__DIR__) . '/include/common.php';

/**
 * Vars defined by inclusion of .include/common.php
 *
 * @var \XoopsModules\Smallworld\Helper $helper
 * @var \XoopsModules\Smallworld\Admin $admin
 * @var \XoopsModules\Smallworld\SwUserHandler $swUserHandler
 * @var \XoopsModules\Smallworld\DoSync $d
 * @var \XoopsModules\Smallworld\User $check
 * @var \XoopsModules\Smallworld\SwDatabase $swDB
 * @var \XoopsModules\Smallworld\WallUpdates $wall
 * @var string $moduleDirName
 * @var string $moduleDirNameUpper
 */

if (!$helper->isUserAdmin()) {
    redirect_header(XOOPS_URL . '/', Constants::REDIRECT_DELAY_MEDIUM, _NOPERM);
}

/** @var Xmf\Module\Admin $adminObject */
$adminObject = \Xmf\Module\Admin::getInstance();

if (!$GLOBALS['xoopsTpl'] instanceof \XoopsTpl) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $GLOBALS['xoopsTpl'] = new \XoopsTpl();
}

// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('main');