<?php

function b_xinvite_top_show($options)
{

    $block = array();

	$interface_handler =& xoops_getmodulehandler('interfaces', 'xinvite');
	
	$criteria = new CriteriaCompo(new Criteria('1', 1));
	$criteria->setSort('RAND()');
	
	$interfaces = $interface_handler->getObjects($criteria);

	if (count($interfaces)>0)
	{
		$interface = $interfaces[0];
		$output = array();
		$output['name'] = $interface->getVar('interface');
		$output['pretty_name'] = ucfirst($interface->getVar('interface'));
		$output['file'] = $interface->getVar('type');
		$output['file'] = ($output['file']!=1)?0:1;
		$output['id'] = $interface->getVar('iid');
		$output['key'] = $key;
		$output['image'] = XOOPS_URL.'/modules/xinvite/images/'.strtolower($output['name']).'.png';
		$output['module_path'] = XOOPS_URL.'/modules/xinvite/';
		$block['interfaces'] = array(0=>$output);
	}
    return $block;
}


function b_xinvite_top_edit($options)
{

	return $options;
}
?>
