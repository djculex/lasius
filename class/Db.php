<?php
namespace XoopsModules\Lasius;

use XoopsModules\Lasius;
use XoopsModules\Lasius\Constants;

class Db extends \XoopsPersistableObjectHandler
{
	public $db;
	public $configname;
	public $configvalue;
	public $helper;
    /**
     * constructor
     *
     * @param mixed $id
     **/
    public function __construct(\XoopsDatabase $db = null, $helper = null)
    {
		if (null === $helper) {
            $helper = Helper::getInstance();
        }
		$this->helper = $helper;
		if (null === $db) {
            $db = \XoopsDatabaseFactory::getDatabaseConnection();
        }
        $this->db = $db;
    }
	
	public function getVar($name)
	{
		$sql = 'SELECT * FROM ' . $this->db->prefix('lasius_config') . ' WHERE configname=' . $name;
            if (!$result = $this->db->queryF($sql)) {
                return false;
            }
            $numrows = $this->db->getRowsNum($result);
			return $result;
	}
	
	/**
	 * Insert config values to table
	 * @param string $name	The configname
	 * @param string $value	The configvalue
	 * @return bool $result
	 */
	public function setVar($name, $value, $type='save')
	{
		$name = addslashes($name);
		$value = addslashes($value);
		$check = $this->getSetSelected($name);
		if ($check == 0) {
			$type = 'save';
			$configactive = 1;
		}
		if ($check >= 1 && $value <= 0) {
			$type = "delete";
		}
		
		if ($check > 0 && $value >= 1) {
			$type = "update";
		}
		
		if ($type == 'save') {
			$sql = 'INSERT INTO ' . $this->db->prefix('lasius_config') . ' (configname, configvalue, configactive) VALUES ("'.$name.'", "'.$value.'", '.$configactive.')';
		} 
		if ($type == 'update'){
			$sql = 'UPDATE ' . $this->db->prefix('lasius_config') . ' SET configname="'.$name.'", configvalue = "'.$value.'" WHERE configname="'.$name.'"';
		}
		if ($type == 'delete') {
			$sql = 'DELETE FROM ' . $this->db->prefix('lasius_config') . ' WHERE configname="'.$name.'"';
		}
		
		if (!$result = $this->db->queryF($sql)) {
			return false;
		}
		$numrows = $this->db->getRowsNum($result);
		return $result;
	}
	
	public function getSetSelected($name)
	{
		$sum = 0;
		$sql = 'SELECT configvalue FROM ' . $this->db->prefix('lasius_config') . ' WHERE configname = "' . $name . '"';
		$result = $this->db->queryF($sql);
		$counter = $this->db->getRowsNum($result);
        while ($row = $this->db->fetchArray($result)) {
			$sum = $row['configvalue'];
        }
        return $sum;
	}
	
	public function getSetActivated($name)
	{
		$sum = 0;
		$sql = 'SELECT configactive FROM ' . $this->db->prefix('lasius_config') . ' WHERE configname = "' . $name . '"';
		$result = $this->db->queryF($sql);
        while ($row = $this->db->fetchArray($result)) {
            $sum = $row['configactive'];
        }
        if ('' == $sum) {
            $sum = 0;
        }
        return $sum;
	}
	
	public function getBlockTitle($showfunc)
    {
        //SELECT title FROM `xoops2511_newblocks` WHERE `show_func` = "b_system_online_show"
        $query   = 'SELECT title FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE show_func = '" . addslashes($showfunc) . "' ORDER BY title ASC ";
        $result  = $GLOBALS['xoopsDB']->queryF($query);
        $counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = $sqlfetch['title'];
            }
        }
        return $data;
    }
	
	public function getBlockName($showfunc)
    {
		$data = [];
        //SELECT title FROM `xoops2511_newblocks` WHERE `show_func` = "b_system_online_show"
        $query   = 'SELECT name FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE show_func = '" . addslashes($showfunc) . "' ORDER BY name ASC ";
        $result  = $GLOBALS['xoopsDB']->queryF($query);
        $counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = $sqlfetch['name'];
            }
        }
        return $data;
    }
	
	public function getBlockTitleFromId($id)
    {
        $data = [];
        $query   = 'SELECT name FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE bid = " . addslashes($id) . " ORDER BY name ASC ";
        $result  = $GLOBALS['xoopsDB']->queryF($query);
        $counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = $sqlfetch['name'];
            }
        }
        return $data;
    }
	
	public function getBlockTitleFromName($name)
    {
        $data = [];
        $query   = 'SELECT title FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE name = '" . addslashes($name) . "' ORDER BY title ASC ";
        $result  = $GLOBALS['xoopsDB']->queryF($query);
        $counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = $sqlfetch['title'];
            }
        }
        return $data;
    }
	
	public function getBlockNameFromTitle($title)
    {
        $data = [];
        $query   = 'SELECT name FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE title = '" . addslashes($title) . "' ORDER BY name ASC ";
        $result  = $GLOBALS['xoopsDB']->queryF($query);
        $counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = $sqlfetch['name'];
            }
        }
        return $data;
    }
	
	 public function getBlockOptions($showfunc)
    {
        $data = [];
        //SELECT title FROM `xoops2511_newblocks` WHERE `show_func` = "b_system_online_show"
        $query   = 'SELECT options FROM ' . $GLOBALS['xoopsDB']->prefix('newblocks') . " WHERE show_func = '" . addslashes($showfunc) . "' ORDER BY options ASC ";
        $result  = $GLOBALS['xoopsDB']->queryF($query);
        $counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = explode('|', $sqlfetch['options']);
            }
        }
        return $data;
    }

    public function moduleNameById($dir)
    {
        $n = '';
        $s = ($dir == 'htdocs') ? 'system' : $dir;
        //SELECT name FROM `xoops2511_modules` WHERE `mid` = 10
        $query   = 'SELECT name FROM ' . $GLOBALS['xoopsDB']->prefix('modules') . " WHERE dirname = '" . addslashes($s) . "' ORDER BY name ASC ";
        $result  = $GLOBALS['xoopsDB']->queryF($query);
        $counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $n = ($sqlfetch['name'][0] != 'Lasius') ? $sqlfetch['name'] : 'System';
            }
        }
        return $n;
    }
	
	public function moduleNameByMid($id)
    {
        //SELECT name FROM `xoops2511_modules` WHERE `mid` = 10
        $query   = 'SELECT name FROM ' . $GLOBALS['xoopsDB']->prefix('modules') . " WHERE mid = " . addslashes($id) . " ORDER BY name ASC ";
        $result  = $GLOBALS['xoopsDB']->queryF($query);
        $counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
             while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $data = $sqlfetch['name'];
            }
        }
        return $data;
    }

    public function midByName($name)
    {
        $n = '';
        //SELECT name FROM `xoops2511_modules` WHERE `mid` = 10
        $query   = 'SELECT mid FROM ' . $GLOBALS['xoopsDB']->prefix('modules') . " WHERE name = '" . addslashes($name) . "' ORDER BY mid ASC ";
        $result  = $GLOBALS['xoopsDB']->queryF($query);
        $counter = $GLOBALS['xoopsDB']->getRowsNum($result);
        if ($counter >= 1) {
            while ($sqlfetch = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $n = ($name == 'Lasius' or $name == 'htdocs' or $name == '' or $name = 'index.php') ? 1 : $sqlfetch['mid'];
            }
        }
        return $n;
    }

    public function CountMidByName($mbid)
    {
        $query  = 'SELECT count(*) FROM ' . $GLOBALS['xoopsDB']->prefix('modules') . " WHERE mid = '" . addslashes($mbid) . "'";
        $result = $GLOBALS['xoopsDB']->queryF($query);
        return $GLOBALS['xoopsDB']->getRowsNum($result);
    }

}
