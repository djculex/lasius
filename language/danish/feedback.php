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
 * feedback plugin for xoops modules
 *
 * @copyright      Lasius module for xoops
 * @license        GPL 3.0 or later
 * @package        general
 * @since          1.0
 * @min_xoops      2.5.11+
 * @author         XOOPS - Website:<https://xoops.org>
 */
$moduleDirName      = \basename(dirname(__DIR__, 2));
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

\define('CO_' . $moduleDirNameUpper . '_' . 'FB_FORM_TITLE', 'Send feedback');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_RECIPIENT', 'Modtager');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_NAME', 'Navn');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_NAME_PLACEHOLER', 'Skriv dit navn');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SITE', 'Webside');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SITE_PLACEHOLER', 'Skriv din webside');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_MAIL', 'Email');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_MAIL_PLACEHOLER', 'Skriv din email');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE', 'Type på feedback');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_SUGGESTION', 'Forslag');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_BUGS', 'Fejl');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_TESTIMONIAL', 'Udtalelser');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_FEATURES', 'Funktioner');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_OTHERS', 'Andet');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_CONTENT', 'Feedback indhold');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SEND_FOR', 'Feedback for modul ');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SEND_SUCCESS', 'Feedback blev sendt');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SEND_ERROR', 'Der opstod en fejl, da feedback blev sendt!');
