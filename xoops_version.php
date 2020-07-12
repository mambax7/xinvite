<?php 
/**
 * $Id: xoops_version.php v 1.0.2 03 july 2004 Catwolf Exp $
 * Module: X-Invites
 * Version: v2.0.5a
 * Release Date: February 20, 2009
 * Author: X-Invite
 * Licence: GNU
 */

$modversion['name'] = 'X-Invites';
$modversion['version'] = 1.16;
$modversion['releasedate'] = "Fri: July 03, 2009";
$modversion['status'] = "Stable";
$modversion['description'] = 'X-Invites is a mass invite mailer with provider support';
$modversion['author'] = "Chronolabs Australia";
$modversion['credits'] = "Wishcraft.";
$modversion['teammembers'] = "Wishcraft";
$modversion['help'] = "xinvites.html";
$modversion['license'] = "GNU see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/xinvites_slogo.png";
$modversion['dirname'] = "xinvite";
/*
* added by Liquid. Based on code by Marcan
*/ 
$modversion['author_realname'] = "Simon Roberts";
$modversion['author_website_url'] = "http://www.chronolabs.org.au";
$modversion['author_website_name'] = "Chronolabs Australia";
$modversion['author_email'] = "simon@chronolabs.org.au";
$modversion['demo_site_url'] = "Unseen Development";
$modversion['demo_site_name'] = "http://www.unseen.org.au/modules/xinvite/";
$modversion['support_site_url'] = "http://www.chronolabs.org.au/modules/newbb/viewforum.php?forum=7";
$modversion['support_site_name'] = "x-Torrent";
$modversion['submit_bug'] = "http://www.chronolabs.org.au/modules/newbb/viewforum.php?forum=7";
$modversion['submit_feature'] = "http://www.chronolabs.org.au/modules/newbb/viewforum.php?forum=7";
$modversion['maillist_announcements'] = "";
$modversion['maillist_bugs'] = "";
$modversion['maillist_features'] = "";

$modversion['warning'] = '';
$modversion['author_credits'] = '';

$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

$modversion['hasMain'] = 1;

$modversion['sqlfile']['mysql'] = "sql/xinvite.sql";

$modversion['tables'][0] = "xinvites_invites";
$modversion['tables'][1] = "xinvites_interfaces";

// Search
$modversion['hasSearch'] = 0;
// Comments
$modversion['hasComments'] = 0;

// Templates
$modversion['templates'][1]['file'] = 'xinvite_index.html';
$modversion['templates'][1]['description'] = '_X_INIVTE_INDEX_DESC';
$modversion['templates'][2]['file'] = 'xinvite_contacts.html';
$modversion['templates'][2]['description'] = '_X_INVITE_CONTACTS_DESC';
$modversion['templates'][3]['file'] = 'xinvite_errors.html';
$modversion['templates'][3]['description'] = 'Default error messages to person';

$modversion['blocks'][1]['file'] = 'xinvites_random.php';
$modversion['blocks'][1]['name'] = 'Invite your friends';
$modversion['blocks'][1]['description'] = _X_INVITE_BLOCK_RANDOM_DESC;
$modversion['blocks'][1]['show_func'] = 'b_xinvite_top_show';
$modversion['blocks'][1]['edit_func'] = 'b_xinvite_top_edit';
$modversion['blocks'][1]['options'] = '';
$modversion['blocks'][1]['template'] = 'xinvite_random.html';

//Module config setting

$modversion['config'][1]['name'] = 'invitemessage';
$modversion['config'][1]['title'] = '_X_INVITE_MESSAGE';
$modversion['config'][1]['description'] = '_X_INVITE_MESSAGE_DESC';
$modversion['config'][1]['formtype'] = 'textarea';
$modversion['config'][1]['valuetype'] = 'text';
$modversion['config'][1]['default'] = _X_INVITE_MESSAGE_DEFAULT;

$modversion['config'][2]['name'] = 'header_title';
$modversion['config'][2]['title'] = '_X_INVITE_HEADERTITLE';
$modversion['config'][2]['description'] = '_X_INVITE_HEADERTITLE_DESC';
$modversion['config'][2]['formtype'] = 'textbox';
$modversion['config'][2]['valuetype'] = 'text';
$modversion['config'][2]['default'] = _X_INVITE_HEADERTITLE_DEFAULT;

$modversion['config'][3]['name'] = 'header_p';
$modversion['config'][3]['title'] = '_X_INVITE_HEADERPARA';
$modversion['config'][3]['description'] = '_X_INVITE_HEADERPARA_DESC';
$modversion['config'][3]['formtype'] = 'textarea';
$modversion['config'][3]['valuetype'] = 'text';
$modversion['config'][3]['default'] = _X_INVITE_HEADERPARA_DEFAULT;

$modversion['config'][4]['name'] = 'message_p';
$modversion['config'][4]['title'] = '_X_INVITE_MESSAGEPARA';
$modversion['config'][4]['description'] = '_X_INVITE_MESSAGEPARA_DESC';
$modversion['config'][4]['formtype'] = 'textarea';
$modversion['config'][4]['valuetype'] = 'text';
$modversion['config'][4]['default'] = _X_INVITE_MESSAGEPARA_DEFAULT;

$modversion['config'][5]['name'] = 'error_header_title';
$modversion['config'][5]['title'] = '_X_INVITE_ERROR_HEADERTITLE';
$modversion['config'][5]['description'] = '_X_INVITE_ERROR_HEADERTITLE_DESC';
$modversion['config'][5]['formtype'] = 'textbox';
$modversion['config'][5]['valuetype'] = 'text';
$modversion['config'][5]['default'] = _X_INVITE_ERROR_HEADERTITLE_DEFAULT;

$modversion['config'][6]['name'] = 'error_header_p';
$modversion['config'][6]['title'] = '_X_INVITE_ERROR_HEADERPARA';
$modversion['config'][6]['description'] = '_X_INVITE_ERROR_HEADERPARA_DESC';
$modversion['config'][6]['formtype'] = 'textarea';
$modversion['config'][6]['valuetype'] = 'text';
$modversion['config'][6]['default'] = _X_INVITE_ERROR_HEADERPARA_DEFAULT;
// Notification
$modversion['hasNotification'] = 0;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'xtorrent_notify_iteminfo';

?>
