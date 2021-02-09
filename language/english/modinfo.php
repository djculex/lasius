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

//include_once 'common.php';

// ---------------- Admin Main ----------------
define('_MI_LASIUS_NAME', 'Lasius');
define('_MI_LASIUS_DESC', 'This module is for doing following...');
// ---------------- Admin Menu ----------------
define('_MI_LASIUS_ADMENU1', 'Dashboard');
define('_MI_LASIUS_ADMENU2', 'Feedback');
define('_MI_LASIUS_ABOUT', 'About');
// Config
define('_MI_LASIUS_KEYWORDS', 'Keywords');
define('_MI_LASIUS_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
define('_MI_LASIUS_NUMB_COL', 'Number Columns');
define('_MI_LASIUS_NUMB_COL_DESC', 'Number Columns to View.');
define('_MI_LASIUS_DIVIDEBY', 'Divide By');
define('_MI_LASIUS_DIVIDEBY_DESC', 'Divide by columns number.');
define('_MI_LASIUS_TABLE_TYPE', 'Table Type');
define('_MI_LASIUS_TABLE_TYPE_DESC', 'Table Type is the bootstrap html table.');
define('_MI_LASIUS_PANEL_TYPE', 'Panel Type');
define('_MI_LASIUS_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div.');
define('_MI_LASIUS_IDPAYPAL', 'Paypal ID');
define('_MI_LASIUS_IDPAYPAL_DESC', 'Insert here your PayPal ID for donactions.');
define('_MI_LASIUS_ADVERTISE', 'Advertisement Code');
define('_MI_LASIUS_ADVERTISE_DESC', 'Insert here the advertisement code');
define('_MI_LASIUS_MAINTAINEDBY', 'Maintained By');
define('_MI_LASIUS_MAINTAINEDBY_DESC', 'Allow url of support site or community');
define('_MI_LASIUS_BOOKMARKS', 'Social Bookmarks');
define('_MI_LASIUS_BOOKMARKS_DESC', 'Show Social Bookmarks in the single page');
define('_MI_LASIUS_FACEBOOK_COMMENTS', 'Facebook comments');
define('_MI_LASIUS_FACEBOOK_COMMENTS_DESC', 'Allow Facebook comments in the single page');
define('_MI_LASIUS_DISQUS_COMMENTS', 'Disqus comments');
define('_MI_LASIUS_DISQUS_COMMENTS_DESC', 'Allow Disqus comments in the single page');
// update js frameworks
define('_MI_LASIUS_UPDJQUERY', 'Opdate jQuery to newest');
define('_MI_LASIUS_UPDJQUERY_DESC', 'Overwrite jQyery if already loaded in your template to newest version.<br>If not already loaded it will be included. And if \'NO\' the xoops/theme jquery will be used.');
define('_MI_LASIUS_UPDJQUERYUI', 'Include jQueryUI ?');
define('_MI_LASIUS_UPDJQUERYUI_DESC', 'Include jquery UI if not present<br>If \'NO\' it will only be present if already loaded by xoops/theme.');

// use Jquery dialog instead of pop-update
define('_MI_LASIUS_USEDIALOG', 'Replace pop-ups with dialog ?');
define('_MI_LASIUS_USEDIALOG_DESC', 'Use jQueryUI dialog instead of popups?<br>If \'NO\' default Xoops popups will be used.Else jquerUI dialog will be used <a href="https://jqueryui.com/dialog/" target="_BLANK"> Se demo here </a>.');

// revive blocks
// system blocks
define('_MI_LASIUS_REVIVE_ONLINEUSERS_BLOCK', 'Auto refresh \'Online users\' block ?');
define('_MI_LASIUS_REVIVE_ONLINEUSERS_BLOCK_DESC', 'Automaticly refresh the block \'Online users\' block every x seconds');
define('_MI_LASIUS_REVIVE_ONLINEUSERS_BLOCKSECS', 'Refresh \'online users\' every ?? secons ?');
define('_MI_LASIUS_REVIVE_TOPPOSTERS_BLOCK', 'Auto refresh \'Top posters\' block ?');
define('_MI_LASIUS_REVIVE_TOPPOSTERS_BLOCK_DESC', 'Automaticly refresh the block \'Top posters\' block every x seconds');
define('_MI_LASIUS_REVIVE_TOPPOSTERS_BLOCKSECS', 'Refresh \'Top posters\' every ?? secons ?');

define('_MI_LASIUS_REVIVE_NEWMEMBERS_BLOCK', 'Auto refresh \'New Members\' block ?');
define('_MI_LASIUS_REVIVE_NEWMEMBERS_BLOCK_DESC', 'Automaticly refresh the block \'New Members\' block every x seconds');
define('_MI_LASIUS_REVIVE_NEWMEMBERS_BLOCKSECS', 'Refresh \'New Members\' every ?? secons ?');

define('_MI_LASIUS_REVIVE_RECENTCOMMENTS_BLOCK', 'Auto refresh \'Recent comments\' block ?');
define('_MI_LASIUS_REVIVE_RECENTCOMMENTS_BLOCK_DESC', 'Automaticly refresh the block \'Recent comments\' block every x seconds');
define('_MI_LASIUS_REVIVE_RECENTCOMMENTS_BLOCKSECS', 'Refresh \'Recent comments\' every ?? secons ?');

// publisher blocks
define('_MI_LASIUS_REVIVE_RECENTPUBLISHERARTICLES_BLOCK', 'Auto refresh \'Recent articles\' block ?');
define('_MI_LASIUS_REVIVE_RECENTPUBLISHERARTICLES_BLOCK_DESC', 'Automaticly refresh the publisher block \'Recent articles\' block every x seconds');

define('_MI_LASIUS_REVIVE_RECENTPUBLISHERNEWS_BLOCK', 'Auto refresh \'Recent Puclisher News\' block ?');
define('_MI_LASIUS_REVIVE_RECENTPUBLISHERNEWS_BLOCK_DESC', 'Automaticly refresh the publisher News block \'Recent Publisher News\' block every x seconds');

// ---------------- End ----------------
