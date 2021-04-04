<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          XOOPS Project <www.xoops.org> <www.xoops.ir>
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');
use XoopsModules\Lasius\{
	Tools,
	Db
};
use XoopsModules\Lasius\Constants;
/**
 * Class LasiusCorePreload
 */
class LasiusCorePreload extends \XoopsPreloadItem
{

	public static function eventCoreIncludeCommonEnd($args)
    {
        include __DIR__ . '/autoloader.php';
    }
	
    public static function eventCoreHeaderAddmeta()
    {
		$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL ."/modules/lasius/assets/css/style.css");
		// initiate XoopsCache class
		$xc = new \XoopsCache();
		// Collect old cached to avoid double include script vars
		$xc->gc();
		$_SESSION["lasiusCoreEvents"] = 0;		
		$tools = new Tools();
		$tools->setJqueryScript();
		
	}

}
