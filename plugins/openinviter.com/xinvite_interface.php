<?php
class xinviteResource extends XoopsObject {
	function xinviteResource(){
		$this->XoopsObject();
		$this->initVar("xinvite_id", XOBJ_DTYPE_INT);
		$this->initVar("uid", XOBJ_DTYPE_INT);
		$this->initVar("contact_email", XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar("contact_name", XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar("type", XOBJ_DTYPE_TXTBOX, '', true, 32);
	}
}

class xinvite_interface {

	var $inviter;
	var $type;
	var $oi_services;
	var $plugType;
	var $contacts = array();
	var $ers = array();
	var $db;
	var $db_table;
	var $perm_handler;
	var $perm_name = 'xinvite_';
	var $obj_class = 'xinviteResource';
		
	function xinvite_interface($interface) {
		include_once('openinviter.php');
		$this->type = $interface;
		$this->inviter=new OpenInviter();
		$this->oi_services=$this->inviter->getPlugins();
		if (isset($interface)) 
		{
			if (isset($oi_services['email'][$interface])) $this->plugType='email';
			elseif (isset($oi_services['social'][$interface])) $this->plugType='social';
			else $this->plugType='';
		}
		
		if (!isset($db)&&!empty($db))
		{
			$this->db =& $db;
		} else {
			global $xoopsDB;
			$this->db =& $GLOBALS['xoopsDB'];
		}
		$this->db_table = $this->db->prefix('xinvites_invites');
		$this->perm_handler =& xoops_gethandler('groupperm');
	}
	
	function xinvite_send_invite($provider, $session_id, $message, $contacts) {
		@$this->inviter->startPlugin($provider);
		return intval($this->inviter->sendMessage($session_id,$message,$contacts));		
	}
	
	function xinviter_session_id($interface) {
	
		if (is_object($this->inviter->plugin))
			return $this->inviter->plugin->getSessionID();
		else
			return false;
	}
	
	function xinvite_get_contacts($email, $password, $interface) {
		ini_set("max_execution_time", "600");  
		if ($_SERVER['REQUEST_METHOD']=='POST')
		{
			$this->inviter->startPlugin($interface);
			$internal=$this->inviter->getInternalError();
			if ($internal)
				$this->ers['inviter']=$internal;
			elseif (!$this->inviter->login($email,$password))
				{
				$internal=$this->inviter->getInternalError();
				$this->ers['login']=($internal?$internal:"Login failed. Please check the email and password you have provided and try again later");
				}
			elseif (false===$contacts=$this->inviter->getMyContacts())
				$this->ers['contacts']="Unable to get contacts.";
			else {
					foreach($contacts as $email => $name){
						$xinvite_objs = new $this->obj_class();
						$xinvite_objs->setVar('contact_email', $email);
						$xinvite_objs->setVar('contact_name', $name);
						$xinvite_objs->setVar('type', $this->type);
						$xi_objects[$ii] = $xinvite_objs;
					
						global $xoopsUser;
						if (isset($xoopsUser)&&!empty($xoopsUser))
							$xi_objects[$ii]->setVar('uid', $xoopsUser->uid());
						else
							$xi_objects[$ii]->setVar('uid', $uid);
						
						@$this->insert($xi_objects[$ii], true);
						$ii++;
					}
					
					$this->contacts = $xi_objects;					
				}
			}
		
		return array('errors' => $this->ers, 'contacts' => $this->contacts);
	}
		
	function &get($id, $fields='*'){
		$id = intval($id);
		if( $id > 0 ){
			$sql = 'SELECT '.$fields.' FROM '.$this->db_table.' WHERE xinvite_id='.$id;
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
		if( $xinvite_obj->isNew() || empty($xinvite_id) ){
			$xinvite_id = $this->db->genId($this->db_table."_xinvite_id_seq");
			$sql = sprintf("INSERT INTO %s (
				xinvite_id, uid, contact_name, contact_email, type
				) VALUES (
				%u, %u, %s, %s, %s
				)",
				$this->db_table,
				$xinvite_id,
				$this->db->quoteString($uid),
				$this->db->quoteString($myts->addslashes($contact_name)),
				$this->db->quoteString($myts->addslashes($contact_email)),
				$this->db->quoteString($myts->addslashes($type))
			);
		}else{
			$sql = sprintf("UPDATE %s SET
				uid = %s,
				contact_name = %s,
				contact_email = %s,
				type = %s,
   			    WHERE xinvite_id = %s",
				$this->db_table,
				$this->db->quoteString($uid),
				$this->db->quoteString($myts->addslashes($contact_name)),
				$this->db->quoteString($myts->addslashes($contact_email)),	
				$this->db->quoteString($xinvite_id)
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
		if( empty($xinvite_id) ){
			$xinvite_id = $this->db->getInsertId();
		}
        $xinvite_obj->assignVar('xinvite_id', $xinvite_id);
		return $xinvite_id;
	}
	
	function delete(&$xinvite_obj, $force = false){
		if( strtolower(get_class($xinvite_obj)) != strtolower($this->obj_class) ){
			return false;
		}
		$sql = "DELETE FROM ".$this->db_table." WHERE xinvite_id=".$xinvite_obj->getVar("xinvite_id")."";
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
				$fields = 'xinvite_id,parent_id,title,summary,visible,nocomments,address,submenu';
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
			$xinvite_objs = new $this->obj_class();
			$xinvite_objs->assignVars($myrow);
			if( !$id_as_key ){
				$ret[] =& $xinvite_objs;
			}else{
				$ret[$myrow['xinvite_id']] =& $xinvite_objs;
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
}
?>