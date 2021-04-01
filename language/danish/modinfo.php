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
define('_MI_LASIUS_DESC', 'Dette modul holder dine blokke i live uden du skal opdatere din browser');
// ---------------- Admin Menu ----------------
define('_MI_LASIUS_ADMENU1', 'Præferencer');
define('_MI_LASIUS_ADMENU2', 'Feedback');
define('_MI_LASIUS_ABOUT', 'Om');
define('_MI_LASIUS_ADMENU3', 'Blockindstillinger');
// Config
define('_MI_LASIUS_KEYWORDS', 'Nøgleord');
define('_MI_LASIUS_KEYWORDS_DESC', 'Indsæt her dine nøgleord (adskil med ',' komma)');
define('_MI_LASIUS_NUMB_COL', 'Antal søjler');
define('_MI_LASIUS_NUMB_COL_DESC', 'Antal søjler der skal ses.');
define('_MI_LASIUS_DIVIDEBY', 'Divider med');
define('_MI_LASIUS_DIVIDEBY_DESC', 'Divide med antal kolonner.');
define('_MI_LASIUS_TABLE_TYPE', 'Tabeltype');
define('_MI_LASIUS_TABLE_TYPE_DESC', 'Tabeltype er bootstrap html table.');
define('_MI_LASIUS_PANEL_TYPE', 'Paneltype');
define('_MI_LASIUS_PANEL_TYPE_DESC', 'Paneltype er bootstrap html div.');
define('_MI_LASIUS_IDPAYPAL', 'Paypal ID');
define('_MI_LASIUS_IDPAYPAL_DESC', 'Insæt her dit paypal Id for donationer.');
define('_MI_LASIUS_ADVERTISE', 'Reklame code');
define('_MI_LASIUS_ADVERTISE_DESC', 'Indsæt her din reklamekode');
define('_MI_LASIUS_MAINTAINEDBY', 'Opretholdt af');
define('_MI_LASIUS_MAINTAINEDBY_DESC', 'Tillad URL på support side');
define('_MI_LASIUS_BOOKMARKS', 'Social Bookmarks');
define('_MI_LASIUS_BOOKMARKS_DESC', 'Vis Social bookmarks på enkelt side');
define('_MI_LASIUS_FACEBOOK_COMMENTS', 'Facebookkommentarer');
define('_MI_LASIUS_FACEBOOK_COMMENTS_DESC', 'Tillad Facebookkommentarer på enkelt side');
define('_MI_LASIUS_DISQUS_COMMENTS', 'Debatkommentarer');
define('_MI_LASIUS_DISQUS_COMMENTS_DESC', 'Tillad debatkommentarer på enkelt side');
// update js frameworks
define('_MI_LASIUS_UPDJQUERY', 'Opdater jQuery til det nyeste');
define('_MI_LASIUS_UPDJQUERY_DESC', 'Overskriv jQyery, hvis den allerede er indlæst i din skabelon til den nyeste version. <br> Hvis den ikke allerede er indlæst, vil den blive inkluderet. Og hvis \'NEJ\' vil xoops / theme jquery blive brugt.');
define('_MI_LASIUS_UPDJQUERYUI', 'Inkluder jQueryUI ?');
define('_MI_LASIUS_UPDJQUERYUI_DESC', 'Medtag jquery UI, hvis det ikke er til stede <br> Hvis \'NO\', vil det kun være til stede, hvis det allerede er indlæst af xoops/tema.');

// use Jquery dialog instead of pop-update
define('_MI_LASIUS_USEDIALOG', 'Erstat pop-ups med dialog?');
define('_MI_LASIUS_USEDIALOG_DESC', 'Brug jQueryUI dialog i stedet for pop op? <br> Hvis \'NO\' standard Xoops popups bruges. Else jquerUI dialog bruges <a href = "https://jqueryui.com/dialog/" target = "_BLANK" >Se demo her</a>.');

// ---------------- End ----------------
