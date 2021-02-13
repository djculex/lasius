<?php
use XoopsModules\Lasius;

include __DIR__ . '/preloads/autoloader.php';
require_once dirname(__DIR__, 2) . '/mainfile.php';

$moduleDirName = basename(__DIR__);
$modulePath    = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName;

//require XOOPS_ROOT_PATH . '/header.php';

$helper = Lasius\Helper::getInstance();
// Load language files
$helper->loadLanguage('main');

$myts   = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoTheme']) || !$GLOBALS['xoTheme'] instanceof \xos_opal_Theme) {
    require $GLOBALS['xoops']->path('class/theme.php');
    $GLOBALS['xoTheme'] = new \xos_opal_Theme();
}

if (!isset($GLOBALS['xoopsTpl']) || !$GLOBALS['xoopsTpl'] instanceof \XoopsTpl) {
    require $GLOBALS['xoops']->path('class/template.php');
    $GLOBALS['xoopsTpl'] = new \XoopsTpl();
}
