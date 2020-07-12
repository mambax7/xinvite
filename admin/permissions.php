<?php
/**
 * $Id: permissions.php v 1.03 05 july 2004 Liquid Exp $
 * Module: X-Torrent
 * Version: v2.06
 * Release Date: 11 July 2008 *
 * Author: Simon Roberts
 * URL: http://www.chronolabs.org.au
 * Licence: GNU
 */

include 'admin_header.php';
include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

xoops_cp_header();

	echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>"._X_INVITE_PERMHEADER."</legend>\n
		<div style='padding: 2px;'>\n";

	$cat_form = new XoopsGroupPermForm('', $xoopsModule->getVar('mid'), 'xinviteInterface_view', _X_INVITE_PERMDESC, '/admin/permissions.php');

	$result = $xoopsDB->query("SELECT iid, interface FROM " . $xoopsDB->prefix("xinvites_interfaces"));
	if ($xoopsDB->getRowsNum($result))
	{
		while ($cat_row = $xoopsDB->fetcharray($result))
		{
				$cat_form->addItem($cat_row['iid'], ucfirst($cat_row['interface']));
		} 
	} 
    echo $cat_form->render();
echo "</div></fieldset><br />";
unset ($cat_form);

xoops_cp_footer();

?>