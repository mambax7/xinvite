<?php
// Module Info
// The name of this module

// INDEX
define('_X_INVITE_MESSAGE','Invite Message');
define('_X_INVITE_MESSAGE_DESC','This is the message that is sent when an invitation is made');

define('_X_INVITE_MESSAGE_DEFAULT','Hello {NAME},

A new site I signed upto recently called "{X_SITENAME}" is great, thats why your friend has invited you to join. Your address was on one of your friends mailing list.

A message for you from your friend is as follows:

{CUSTOMMESSAGE}

-----------

Please do not reply to this message.

-----------

{X_SITENAME} ({X_SITEURL}) 
webmaster
{X_ADMINMAIL}');

define('_X_INVITE_PERMISSIONS', 'Permissions');
define('_X_INVITE_HEADERTITLE','Index Title');
define('_X_INVITE_HEADERTITLE_DESC','This is the title of the index page.');
define('_X_INVITE_HEADERTITLE_DEFAULT', 'Invite your collegues and friends');
define('_X_INVITE_HEADERPARA','Index Paragraph');
define('_X_INVITE_HEADERPARA_DESC','This is the paragraph on the index page.');
define('_X_INVITE_HEADERPARA_DEFAULT', 'Select the items you want to invite to this website, there are options to upload or enter your username and password for the site containing your contacts. Simply fill-out your details and open a new window with your log-in details by clicking on Invite to Join. If you do not have some of the types of mail this is fine, click on next.');
define('_X_INVITE_MESSAGEPARA','Message Paragraph');
define('_X_INVITE_MESSAGEPARA_DESC','This is the paragraph on the contacts & custom message page.');
define('_X_INVITE_MESSAGEPARA_DEFAULT', 'Deselect any contacts that you do not want the person emailed an invite and include a custom message insert.');
define('_X_INVITE_ERROR_HEADERTITLE','Error Page Title');
define('_X_INVITE_ERROR_HEADERTITLE_DESC','This is the title of the error page page.');
define('_X_INVITE_ERROR_HEADERTITLE_DEFAULT', 'An Error Occured while Inviting your friends');
define('_X_INVITE_ERROR_HEADERPARA','Error Page Paragraph');
define('_X_INVITE_ERROR_HEADERPARA_DESC','This is the paragraph on the error page.');
define('_X_INVITE_ERROR_HEADERPARA_DEFAULT', 'An error has occurred  while retrieve the addresses you requested, please look at the error produced and attempt to retrieve the data again.');

// TEMPLATES
define('_X_INVITE_INDEX_DESC','Main Index');
define('_X_INVITE_CONTACTS_DESC','Send Mail to Contacts');

// BLOCKS
define('_X_INVITE_BLOCK_RANDOM_NAME','Invite your friends');
define('_X_INVITE_BLOCK_RANDOM_DESC','Shows update box for Invite your friends');
?>
