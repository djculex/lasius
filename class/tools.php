<?php
namespace XoopsModules\Lasius;

use XoopsModules\Lasius;
use XoopsModules\Lasius\Constants;

class tools
{
	/**
	* constructor
	*
	* @param mixed $id
	**/
	public function __construct($id = null)
	{
		//$this->initVar('bid', XOBJ_DTYPE_INT, null, false);
	}
	
	public function getBlockTitle($showfunc){
		$data = array();
		//SELECT title FROM `xoops2511_newblocks` WHERE `show_func` = "b_system_online_show"
		$query  = 'SELECT title FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE show_func = '" . addslashes($showfunc) . "' ORDER BY title ASC ";
		$result = $GLOBALS['xoopsDB']->queryF($query);
		$counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = $sqlfetch['title'];
            }
        }
		return $data;
	}
	
	public function getBlockOptions($showfunc){
		$data = array();
		//SELECT title FROM `xoops2511_newblocks` WHERE `show_func` = "b_system_online_show"
		$query  = 'SELECT options FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE show_func = '" . addslashes($showfunc) . "' ORDER BY options ASC ";
		$result = $GLOBALS['xoopsDB']->queryF($query);
		$counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = explode('|', $sqlfetch['options']);
            }
        }
		return $data;
	}
}