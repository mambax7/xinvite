<?php

include 'header.php';

error_reporting(E_ALL);

include XOOPS_ROOT_PATH . '/header.php';

global $xoopsTpl, $xoopsUser, $xoopsConfig, $xoopsModuleConfig, $path_to_cookie, $browser_agent;

if (isset($_GET['uid']))
	$uid = (int)$_GET['uid'];
else
	$uid = is_object($xoopsUser) ? $xoopsUser->uid() : -mt_rand(100, 999999);


$xoopsTpl->assign('uid', $uid);
$xoopsTpl->assign('interface', $_REQUEST['interface']);

// Captions
$xoopsTpl->assign('header_title', $xoopsModuleConfig['header_title']);
$xoopsTpl->assign('header_p', $xoopsModuleConfig['header_p']);
$xoopsTpl->assign('message_p', $xoopsModuleConfig['message_p']);

ini_set("max_execution_time", "3600");  

switch ((string)$_GET['op'])
{
	case "submit":
		$xoopsOption['template_main'] = 'xinvite_contacts.html';
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];				
		$iid = $_REQUEST['id'];				
		$file = $_FILES['uploadfile'];
		$uid = (int)$_POST['uid'];
		error_reporting(E_ALL);
		$interface_handler =& xoops_getmodulehandler('interfaces', 'xinvite');
		$interface = $interface_handler->get($iid);
		
		switch($interface->getVar('type')) {
		default:
			include_once( XOOPS_ROOT_PATH.'/modules/xinvite/plugins/'.$interface->getVar('source')."/xinvite_interface.php" );
		}
		
		$interobj = new xinvite_interface($interface->getVar('interface'));
		$contacts = $interobj->xinvite_get_contacts($username, $password, $interface->getVar('interface'));
		
		if (!empty($contacts['errors']))
		{
			$xoopsOption['template_main'] = 'xinvite_errors.html';
			$xoopsTpl->assign('header_title', $xoopsModuleConfig['error_header_title']);
			$xoopsTpl->assign('header_p', $xoopsModuleConfig['error_header_p']);
			$xoopsTpl->assign('errors', $contacts['errors']);		
			include XOOPS_ROOT_PATH.'/footer.php';
			exit;
		}

		foreach($contacts['contacts'] as $contact)
		{
			$output = array();
			$output['name'] = $contact->getVar('contact_name');
			$output['pretty_name'] = ucfirst($contact->getVar('contact_name'));
			$output['uid'] = $contact->getVar('uid');
			$output['email'] = $contact->getVar('contact_email');
			$output['id'] = $contact->getVar('xinvite_id');
			$xoopsTpl->append('contacts', $output);
		}
		
		$xoopsTpl->assign('oi_session_id', $interobj->xinviter_session_id($interface->getVar('interface')));		
		break;
	
	case "sendmail":

			$interface_handler =& xoops_getmodulehandler('interfaces', 'xinvite');

			$criteria = new Criteria('interface', $_REQUEST['interface']);
			$interface = $interface_handler->getObjects($criteria);
			if (is_array($interface))
				$interface = $interface[0];
				
			switch($interface->getVar('type')) {
			default:
				require_once( XOOPS_ROOT_PATH.'/modules/xinvite/plugins/'.$interface->getVar('source')."/xinvite_interface.php" );
			}
			
			$interobj = new xinvite_interface($_REQUEST['interface']);

			$selected = array();
	        foreach($_POST['contact'] as $id => $data)
			{
				$invitee = $interobj->get($id);
				
				if (is_object($invitee)){
					$selected[$invitee->getVar('contact_email')] = $invitee->getVar('contact_name');
				}
			}


			$body = $xoopsModuleConfig['invitemessage'];
			$body = str_replace('{CUSTOMMESSAGE}', $_POST['custmsg'], $body);
			$body = str_replace('{X_SITENAME}', $xoopsConfig['sitename'], $body);
			$body = str_replace('{X_ADMINMAIL}', $xoopsConfig['adminmail'], $body);
			$body = str_replace('{X_SITEURL}', XOOPS_URL."/", $body);
			
			$name = $invitee->getVar('contact_name');
			$email = $invitee->getVar('contact_email');
			if (is_object($xoopsUser)&&!empty($xoopsUser))
				$profile = XOOPS_URL.'/userinfo.php?uid='.$xoopsUser->getVar('uid');
			$body = str_replace('{NAME}', $name, $body);
			$body = str_replace('{EMAIL}', $email, $body);
			$body = str_replace('{PROFILE}', $profile, $body);
			$body = str_replace('{EMAIL}', $email, $body);
			$subject = ("Invited to sign-up at ".$xoopsConfig['sitename']);		
			if ($interobj->xinvite_send_invite($_REQUEST['interface'], $_REQUEST['oi_session_id'], array('subject' => $subject, 'body' => $body), $selected)===-1)
			{
						
				foreach($_POST['contact'] as $id => $data)
				{
					if($data==1)
					{
						$invitee = $interobj->get($id);
	
						if (is_object($invitee)&&!empty($invitee))
						{
							$xoopsMailer =& xoops_getMailer();
							$xoopsMailer->useMail();
							
							if ( !$xoopsMailer->sendMail($email, $subject, $body) ) {
								$sent++;
							} else {
								echo $xoopsMailer->getErrors(true);
								$failed++;
							}
							
						}
						@$client_handler->delete($invitee, true);
					}
				}
			} else {
				$failed = "0";
				$sent = count($selected);
			}
			redirect_header("javascript:window.close();", 10, sprintf('The emails have been sent: %u & failed: %u <br/> Closing window',$failed, $sent));
			
		break;

	default:

		$xoopsOption['template_main'] = 'xinvite_index.html';
			
		if (isset($_GET['jointype']))
			$join = $_GET['jointype'];
		else
			$join = 1;
		
		
		$interface_handler =& xoops_getmodulehandler('interfaces', 'xinvite');
		
		$criteria = new CriteriaCompo(new Criteria('1', 1));
		$interfaces = $interface_handler->getObjects($criteria);
		
		if ($join>1&&count($interfaces)>$join)
			$xoopsTpl->assign('joinnext', $join+1);
		elseif ($join==1)
			$xoopsTpl->assign('joinnext', 2);
			
		if ($join>1&&count($interfaces)>=$join)
			$xoopsTpl->assign('joinprevious', $join-1);

		
		foreach($interfaces as $key => $interface)
		{
		
			if ($key==$join-1)
			{
				$output = array();
				$output['name'] = $interface->getVar('interface');
				$output['pretty_name'] = ucfirst($interface->getVar('interface'));
				$output['file'] = $interface->getVar('type');
				$output['file'] = ($output['file']!=1)?0:1;
				$output['id'] = $interface->getVar('iid');
				$output['key'] = $key;
				$output['image'] = XOOPS_URL.'/modules/xinvite/images/'.strtolower($output['name']).'.png';
				$xoopsTpl->append('interfaces', $output);
				
			} elseif ($join=="all") {
	
				$output = array();
				$output['name'] = $interface->getVar('interface');
				$output['pretty_name'] = ucfirst($interface->getVar('interface'));
				$output['file'] = $interface->getVar('type');
				$output['file'] = ($output['file']!=1)?0:1;
				$output['id'] = $interface->getVar('iid');
				$output['key'] = $key;
				$output['image'] = XOOPS_URL.'/modules/xinvite/images/'.strtolower($output['name']).'.png';
				$xoopsTpl->append('interfaces', $output);
			}
		}
	}

include XOOPS_ROOT_PATH.'/footer.php';

?>