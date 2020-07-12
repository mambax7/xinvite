<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 xoops.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Simon Roberts (aka wishcraft)                                     //
// Site: http://www.chronolabs.org.au                                        //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

//if( !defined('xinvite_ROOT_PATH') ){ exit(); }

class interfaceResource extends XoopsObject {
	function interfaceResource(){
		$this->XoopsObject();
		$this->initVar("iid", XOBJ_DTYPE_INT);
		$this->initVar("type", XOBJ_DTYPE_INT);
		$this->initVar("interface", XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar("source", XOBJ_DTYPE_OTHER, '', true, 128);
	}
}

class xinviteinterfacesHandler extends XoopsObjectHandler {
	var $db;
	var $db_table;
	var $perm_name = 'xinviteInterface_';
	var $obj_class = 'interfaceResource';
	var $type = 'interfaces';
	
	function xinviteinterfacesHandler(&$db){
		if (!isset($db)&&!empty($db))
		{
			$this->db =& $db;
		} else {
			global $xoopsDB;
			$this->db =& $xoopsDB;
		}
		$this->db_table = $this->db->prefix('xinvites_interfaces');
		$this->perm_handler =& xoops_gethandler('groupperm');
	}
	
	function &getInstance(&$db){
		static $instance;
		if( !isset($instance) ){
			$instance = new xinviteinterfacesHandler($db);
		}
		return $instance;
	}
	function &create(){
		return new $this->obj_class();
	}

	function &get($id, $fields='*'){
		$id = intval($id);
		if( $id > 0 ){
			$sql = 'SELECT '.$fields.' FROM '.$this->db_table.' WHERE iid='.$id;
		} else {
			return false;
		}
		if( !$result = $this->db->query($sql) ){
			return false;
		}
		$numrows = $this->db->getRowsNum($result);
		if( $numrows == 1 ){
			$xinvite_obj = new $this->obj_class();
			$xinvite_obj->assignVars($this->db->fetchArray($result));
			return $xinvite_obj;
		}
		return false;
	}

	function insert(&$xinvite_obj, $force = false){
        if( strtolower(get_class($xinvite_obj)) != strtolower($this->obj_class)){
            return false;
        }
        if( !$xinvite_obj->isDirty() ){
            return true;
        }
        if( !$xinvite_obj->cleanVars() ){
            return false;
        }
        
		foreach( $xinvite_obj->cleanVars as $k=>$v ){
			${$k} = $v;
		}
				
		$myts =& MyTextSanitizer::getInstance();
		if( $xinvite_obj->isNew() || empty($iid) ){
			$iid = $this->db->genId($this->db_table."_iid_seq");
			$sql = sprintf("INSERT INTO %s (
				iid, interface, type, source
				) VALUES (
				%u, %s, %u, %s
				)",
				$this->db_table,
				$iid,
				$this->db->quoteString($myts->addslashes($interface)),
				$this->db->quoteString($type),
				$this->db->quoteString($myts->addslashes($source))
			);
		}else{
			$sql = sprintf("UPDATE %s SET
				interface = %s,
				type = %s,
				source = %s
   			    WHERE iid = %s",
				$this->db_table,
				$this->db->quoteString($myts->addslashes($interface)),
				$this->db->quoteString($type),	
				$this->db->quoteString($myts->addslashes($source)),
				$this->db->quoteString($iid)
			);
		}
	
		if( false != $force ){
            $result = $this->db->queryF($sql);
        }else{
            $result = $this->db->query($sql);
        }
		if( !$result ){
			$xinvite_obj->setErrors("Could not store data in the database.<br />".$this->db->error().' ('.$this->db->errno().')<br />'.$sql);
			return false;
		}
		if( empty($iid) ){
			$iid = $this->db->getInsertId();
		}
        $xinvite_obj->assignVar('iid', $iid);
		return $iid;
	}
	
	function delete(&$xinvite_obj, $force = false){
		if( strtolower(get_class($xinvite_obj)) != strtolower($this->obj_class) ){
			return false;
		}
		$sql = "DELETE FROM ".$this->db_table." WHERE iid=".$xinvite_obj->getVar("iid")."";
        if( false != $force ){
            $result = $this->db->queryF($sql);
        }else{
            $result = $this->db->query($sql);
        }
		return true;
	}

	function &getObjects($criteria = null, $fields='*', $id_as_key = false){
		$ret = array();
		$limit = $start = 0;
		switch($fields){
			case 'elink':
				$fields = 'iid,parent_id,title,summary,visible,nocomments,address,submenu';
			break;
		}
		$sql = 'SELECT '.$fields.' FROM '.$this->db_table;
		if( isset($criteria) && is_subclass_of($criteria, 'criteriaelement') ){
			$sql .= ' '.$criteria->renderWhere();
			if( $criteria->getSort() != '' ){
				$sql .= ' ORDER BY '.$criteria->getSort().' '.$criteria->getOrder();
			}
			$limit = $criteria->getLimit();
			$start = $criteria->getStart();
		}

		$result = $this->db->query($sql, $limit, $start);
		if( !$result )
			return false;
		while( $myrow = $this->db->fetchArray($result) ){
			if ($this->getSingleXInvitePermission($myrow['iid'], 'view'))
			{
				$xinvite_objs = new $this->obj_class();
				$xinvite_objs->assignVars($myrow);
				if( !$id_as_key ){
					$ret[] =& $xinvite_objs;
				}else{
					$ret[$myrow['iid']] =& $xinvite_objs;
				}
			}
			unset($xinvite_objs);
		}
		return count($ret) > 0 ? $ret : false;
	}
	
    function getCount($criteria = null){
		$sql = 'SELECT COUNT(*) FROM '.$this->db_table;
		if( isset($criteria) && is_subclass_of($criteria, 'criteriaelement') ){
			$sql .= ' '.$criteria->renderWhere();
		}
		$result = $this->db->query($sql);
		if( !$result ){
			return 0;
		}
		list($count) = $this->db->fetchRow($result);
		return $count;
	}
    
    function deleteAll($criteria = null){
		$sql = 'DELETE FROM '.$this->db_table;
		if( isset($criteria) && is_subclass_of($criteria, 'criteriaelement') ){
			$sql .= ' '.$criteria->renderWhere();
		}
		if( !$result = $this->db->query($sql) ){
			return false;
		}
		return true;
	}
	
	function deleteXInvitePermissions($iid, $mode = "view"){
		global $xoopsModule;
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('gperm_itemid', $iid)); 
		$criteria->add(new Criteria('gperm_modid', $xoopsModule->getVar('mid')));
		$criteria->add(new Criteria('gperm_name', $this->perm_name.$mode)); 
		if( $old_perms =& $this->perm_handler->getObjects($criteria) ){
			foreach( $old_perms as $p ){
				$this->perm_handler->delete($p);
			}
		}
		return true;
	}
	
	function insertXInvitePermissions($iid, $group_ids, $mode = "view"){
		global $xoopsModule;
		foreach( $group_ids as $id ){
			$perm =& $this->perm_handler->create();
			$perm->setVar('gperm_name', $this->perm_name.$mode);
			$perm->setVar('gperm_itemid', $iid);
			$perm->setVar('gperm_groupid', $id);
			$perm->setVar('gperm_modid', $xoopsModule->getVar('mid'));
			$this->perm_handler->insert($perm);
			$ii++;
		}
		return "Permission ".$this->perm_name.$mode." set $ii times for "._C_ADMINTITLE." Record ID ".$iid;
	}
	
	function &getPermittedXInvites($xinvite_objs, $mode = "view"){
		global $xoopsUser, $xoopsModule;
		$ret=false;
		if (isset($xinvite_objs))
		{
			$ret = array();
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('gperm_itemid', $xinvite_objs->getVar('iid'), '='), 'AND');
			$criteria->add(new Criteria('gperm_modid', $xoopsModule->getVar('mid'), '='), 'AND');
			$criteria->add(new Criteria('gperm_name', $this->perm_name.$mode, '='), 'AND');						

			$gtObjperm = $this->perm_handler->getObjects($criteria);
			$groups=array();
			
			foreach ($gtObjperm as $v)
			{
				$ret[] = $v->getVar('gperm_groupid');
			}	
			return $ret;
			
		} else {
			$ret = array();
			$groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : 3;
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('center_order', 1, '>='), 'OR');
			$criteria->setSort('center_order');
			$criteria->setOrder('ASC');
			if( $xinvite_objs =& $this->getObjects($criteria, 'home_list') ){
				$ret = array();
				foreach( $xinvite_objs as $f ){
					if( false != $this->perm_handler->checkRight($this->perm_name.$mode, $f->getVar('iid'), $groups, $xoopsModule->getVar('mid')) ){
						$ret[] = $f;
						unset($f);
					}
				}
			}
		}
		return ret;
	}
	
	function getSingleXInvitePermission($iid, $mode = "view"){
		global $xoopsUser;
		$module_handler =& xoops_gethandler('module');
		$module =& $module_handler->getByDirname('xinvite');
		$groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : 3;
		if( false != $this->perm_handler->checkRight($this->perm_name.$mode, $iid, $groups, $module->getVar('mid')) ){
			return true;
		}
		return false;
	}
	
}

?>