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
\defined('XOOPS_ROOT_PATH') || die('Restricted access.');
use XoopsModules\Lasius\{
	Tools
};
use XoopsModules\Lasius\Constants;
/**
 * Class LasiusCorePreload
 */
class LasiusCorePreload extends \XoopsPreloadItem
{

    public static function eventCoreHeaderAddmeta()
    {
		global $xoopsConfig;
		/** @var \XoopsModules\Lasius\Helper $helper */
		$helper = \XoopsModules\Lasius\Helper::getInstance();
		$tools = new Tools();
		$script = '';
		$name = basename($_SERVER['REQUEST_URI']);
		// language files
		$language = $xoopsConfig['language'];
		
		// Check prevents multiple loads
		//$script = "jQuery(document).ready(function(){"."\n";
		$script  = 'var Lasius_myID;' . "\n";
        $script  .= "if (typeof Lasius_myID === 'undefined') {"."\n";
        $script  .= "var Lasius_systemurl = '" . XOOPS_URL . "/modules/lasius';\n";
		
		$script  .= "var Lasius_myID = 1;\n";
		$script  .= "var Lasius_refurl = '".$name. "';\n";
		$script  .= 'var Lasius_usepopups = ' . $helper->getConfig('LASIUSUSEDIALOG') . ";\n";
		
		$script .= 'var Lasius_reviveonlineusersblock = ' . $helper->getConfig('reviveonlineusersblock') . ";\n";
		$script .= "var Lasius_reviveonlineusersblock_title = '" . $tools->getBlockTitle('b_system_online_show') . "';\n";
		
		$script .= 'var Lasius_revivetoppostersblock = ' . $helper->getConfig('revivetoppostersblock') . ";\n";
		$script .= "var Lasius_revivetoppostersblock_title = '" . $tools->getBlockTitle('b_system_topposters_show') . "';\n";
		
		$script .= 'var Lasius_revivenewmembersblock = ' . $helper->getConfig('revivenewmembersblock') . ";\n";
		$script .= "var Lasius_revivenewmembersblock_title = '" . $tools->getBlockTitle('b_system_newmembers_show') . "';\n";
		
		
		$script .= 'var Lasius_reviverecentcommentsblock = ' . $helper->getConfig('reviverecentcommentsblock') . ";\n";
		$script .= "var Lasius_reviverecentcommentsblock_title = '" . $tools->getBlockTitle('b_system_comments_show') . "';\n";
		
		$script .= 'var Lasius_reviverecentpub_art_block = ' . $helper->getConfig('reviverecentpub_art_block') . ";\n";
		$script .= "var Lasius_reviverecentpub_art_block_title = '" . $tools->getBlockTitle('publisher_items_recent_show') . "';\n";
		
		$script .= 'var Lasius_reviverecentpubnewsblock = ' . $helper->getConfig('reviverecentpubnewsblock') . ";\n";
		$script .= "var Lasius_reviverecentpubnewsblock_title = '" . $tools->getBlockTitle('publisher_latest_news_show') . "';\n";
		
		$script .= 'var Lasius_reviverecentnewbbpostsblock = ' . $helper->getConfig('reviverecnewbbpostsblk') . ";\n";
		$script .= "var Lasius_reviverecentnewbbpostsblock_title = '" . $tools->getBlockTitle('b_newbb_post_show') . "';\n";
		
		$script .= 'var Lasius_reviverecentextcalminicalblock = ' . $helper->getConfig('reviveextcalminiblk') . ";\n";
		$script .= "var Lasius_reviverecentextcalminicalblock_title = '" . $tools->getBlockTitle('bExtcalMinicalShow') . "';\n";
		
		$script .= '};' . "\n";
		//$script .= "});"."\n";
		$GLOBALS['xoTheme']->addScript('', '', $script);
		// Include jquery new or framework ?
		
		if ($helper->getConfig('updatejquery') > 0) {
			$GLOBALS['xoTheme']->addScript('https://code.jquery.com/jquery-latest.min.js');
		} else {
			$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
		}
		
		// Jquery ui
		if ($helper->getConfig('updatejqueryui') > 0) {
			$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/plugins/jquery.ui.js');
		}
		$GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/lasius/assets/js/agent.js');
		$GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/lasius/assets/js/lasius.js');
	}
    /**
     * @param $args
     */
    public static function eventCoreIncludeCommonEnd($args)
    {
        include __DIR__ . '/autoloader.php';
    }
}
