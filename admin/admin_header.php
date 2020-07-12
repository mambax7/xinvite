<?php
/**
 * $Id: admin_header.php v 1.13 06 july 2004 Catwolf Exp $
 * Module: X-Torrent
 * Version: v2.06
 * Release Date: 11 July 2008 *
 * Author: Simon Roberts
 * URL: http://www.chronolabs.org.au
 * Licence: GNU
 */
 
include '../../../mainfile.php';
include '../../../include/cp_header.php';
include '../include/functions.php';

include_once XOOPS_ROOT_PATH . '/class/xoopstree.php';
include_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
	
if (is_object($xoopsUser)) {
    $xoopsModule = XoopsModule::getByDirname("xinvite");
    if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
        redirect_header(XOOPS_URL . "/", 3, _NOPERM);
        exit();
    } 
} else {
    redirect_header(XOOPS_URL . "/", 1, _NOPERM);
    exit();
}
$myts = &MyTextSanitizer::getInstance();
	
?>