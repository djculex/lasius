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
 * SmallWorld
 *
 * @package      \XoopsModules\Lasius
 * @license      GNU GPL (https://www.gnu.org/licenses/gpl-2.0.html/)
 * @copyright    The XOOPS Project (https://xoops.org)
 * @copyright    2011 Culex
 * @author       Michael Albertsen (http://culex.dk) <culex@culex.dk>
 * @link         https://github.com/XoopsModules25x/smallworld
 * @since        1.0
 */

use Xmf\Request;
use XoopsModules\Lasius\{
	Tools,
	Db
};
use XoopsModules\Lasius\Constants;

require_once __DIR__ . '/header.php';

require_once $helper->path('include/functions.php');
$GLOBALS['xoopsLogger']->activated = true;
$Db = new Db();
$configid       = Request::getString('configid', $default = '', $hash = 'default', $mask = 0);
$configname		= Request::getString('configname', $default = '', $hash = 'default', $mask = 0);
$configvalue 	= Request::getInt('configvalue', $default = '', $hash = 'default', $mask = 0);

$Db->setVar($configid, $configvalue, $type='save');
