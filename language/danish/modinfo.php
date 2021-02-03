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

include_once 'common.php';

// ---------------- Admin Main ----------------
\define('_MI_LASIUS_NAME', 'Lasius');
\define('_MI_LASIUS_DESC', 'This module is for doing following...');
// ---------------- Admin Menu ----------------
\define('_MI_LASIUS_ADMENU1', 'Dashboard');
\define('_MI_LASIUS_ADMENU2', 'Feedback');
\define('_MI_LASIUS_ABOUT', 'About');
// Config
\define('_MI_LASIUS_KEYWORDS', 'Keywords');
\define('_MI_LASIUS_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
\define('_MI_LASIUS_NUMB_COL', 'Number Columns');
\define('_MI_LASIUS_NUMB_COL_DESC', 'Number Columns to View.');
\define('_MI_LASIUS_DIVIDEBY', 'Divide By');
\define('_MI_LASIUS_DIVIDEBY_DESC', 'Divide by columns number.');
\define('_MI_LASIUS_TABLE_TYPE', 'Table Type');
\define('_MI_LASIUS_TABLE_TYPE_DESC', 'Table Type is the bootstrap html table.');
\define('_MI_LASIUS_PANEL_TYPE', 'Panel Type');
\define('_MI_LASIUS_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div.');
\define('_MI_LASIUS_IDPAYPAL', 'Paypal ID');
\define('_MI_LASIUS_IDPAYPAL_DESC', 'Insert here your PayPal ID for donactions.');
\define('_MI_LASIUS_ADVERTISE', 'Advertisement Code');
\define('_MI_LASIUS_ADVERTISE_DESC', 'Insert here the advertisement code');
\define('_MI_LASIUS_MAINTAINEDBY', 'Maintained By');
\define('_MI_LASIUS_MAINTAINEDBY_DESC', 'Allow url of support site or community');
\define('_MI_LASIUS_BOOKMARKS', 'Social Bookmarks');
\define('_MI_LASIUS_BOOKMARKS_DESC', 'Show Social Bookmarks in the single page');
\define('_MI_LASIUS_FACEBOOK_COMMENTS', 'Facebook comments');
\define('_MI_LASIUS_FACEBOOK_COMMENTS_DESC', 'Allow Facebook comments in the single page');
\define('_MI_LASIUS_DISQUS_COMMENTS', 'Disqus comments');
\define('_MI_LASIUS_DISQUS_COMMENTS_DESC', 'Allow Disqus comments in the single page');
// ---------------- End ----------------
