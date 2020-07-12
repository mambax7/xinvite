

CREATE TABLE `xinvites_interfaces` (
  `iid` int(10) NOT NULL AUTO_INCREMENT,
  `type` int(10) DEFAULT '0',
  `interface` varchar(255) NOT NULL,
  `source` enum('openinviter.com') DEFAULT 'openinviter.com',
  PRIMARY KEY (`iid`,`interface`)
) ENGINE=MyISAM;

insert into xinvites_interfaces values (1,0,'abv','openinviter.com');
insert into xinvites_interfaces values (2,0,'aol','openinviter.com');
insert into xinvites_interfaces values (3,0,'apropo','openinviter.com');
insert into xinvites_interfaces values (4,0,'azet','openinviter.com');
insert into xinvites_interfaces values (5,0,'badoo','openinviter.com');
insert into xinvites_interfaces values (6,0,'bebo','openinviter.com');
insert into xinvites_interfaces values (7,0,'bigstring','openinviter.com');
insert into xinvites_interfaces values (8,0,'bookcrossing','openinviter.com');
insert into xinvites_interfaces values (9,0,'brazencareerist','openinviter.com');
insert into xinvites_interfaces values (10,0,'care2','openinviter.com');
insert into xinvites_interfaces values (11,0,'clevergo','openinviter.com');
insert into xinvites_interfaces values (12,0,'cyworld','openinviter.com');
insert into xinvites_interfaces values (14,0,'doramail','openinviter.com');
insert into xinvites_interfaces values (15,0,'eons','openinviter.com');
insert into xinvites_interfaces values (16,0,'evite','openinviter.com');
insert into xinvites_interfaces values (17,0,'facebook','openinviter.com');
insert into xinvites_interfaces values (18,0,'faces','openinviter.com');
insert into xinvites_interfaces values (19,0,'famiva','openinviter.com');
insert into xinvites_interfaces values (20,0,'fastmail','openinviter.com');
insert into xinvites_interfaces values (21,0,'fdcareer','openinviter.com');
insert into xinvites_interfaces values (22,0,'flickr','openinviter.com');
insert into xinvites_interfaces values (23,0,'flingr','openinviter.com');
insert into xinvites_interfaces values (24,0,'flixster','openinviter.com');
insert into xinvites_interfaces values (25,0,'fm5','openinviter.com');
insert into xinvites_interfaces values (26,0,'friendfeed','openinviter.com');
insert into xinvites_interfaces values (27,0,'friendster','openinviter.com');
insert into xinvites_interfaces values (28,0,'gawab','openinviter.com');
insert into xinvites_interfaces values (29,0,'gmail','openinviter.com');
insert into xinvites_interfaces values (30,0,'gmx_net','openinviter.com');
insert into xinvites_interfaces values (31,0,'hi5','openinviter.com');
insert into xinvites_interfaces values (32,0,'hotmail','openinviter.com');
insert into xinvites_interfaces values (33,0,'hushmail','openinviter.com');
insert into xinvites_interfaces values (34,0,'hyves','openinviter.com');
insert into xinvites_interfaces values (35,0,'inbox','openinviter.com');
insert into xinvites_interfaces values (37,0,'indiatimes','openinviter.com');
insert into xinvites_interfaces values (38,0,'interia','openinviter.com');
insert into xinvites_interfaces values (39,0,'katamail','openinviter.com');
insert into xinvites_interfaces values (40,0,'kincafe','openinviter.com');
insert into xinvites_interfaces values (41,0,'konnects','openinviter.com');
insert into xinvites_interfaces values (42,0,'lastfm','openinviter.com');
insert into xinvites_interfaces values (43,0,'libero','openinviter.com');
insert into xinvites_interfaces values (44,0,'linkedin','openinviter.com');
insert into xinvites_interfaces values (45,0,'livejournal','openinviter.com');
insert into xinvites_interfaces values (46,0,'lovento','openinviter.com');
insert into xinvites_interfaces values (47,0,'lycos','openinviter.com');
insert into xinvites_interfaces values (48,0,'mail_com','openinviter.com');
insert into xinvites_interfaces values (49,0,'mail_in','openinviter.com');
insert into xinvites_interfaces values (50,0,'mail_ru','openinviter.com');
insert into xinvites_interfaces values (51,0,'meinvz','openinviter.com');
insert into xinvites_interfaces values (52,0,'mevio','openinviter.com');
insert into xinvites_interfaces values (53,0,'motortopia','openinviter.com');
insert into xinvites_interfaces values (54,0,'multiply','openinviter.com');
insert into xinvites_interfaces values (55,0,'mycatspace','openinviter.com');
insert into xinvites_interfaces values (56,0,'mydogspace','openinviter.com');
insert into xinvites_interfaces values (57,0,'mynet','openinviter.com');
insert into xinvites_interfaces values (58,0,'myspace','openinviter.com');
insert into xinvites_interfaces values (59,0,'netaddress','openinviter.com');
insert into xinvites_interfaces values (60,0,'netlog','openinviter.com');
insert into xinvites_interfaces values (61,0,'nz11','openinviter.com');
insert into xinvites_interfaces values (62,0,'operamail','openinviter.com');
insert into xinvites_interfaces values (63,0,'orkut','openinviter.com');
insert into xinvites_interfaces values (64,0,'perfspot','openinviter.com');
insert into xinvites_interfaces values (65,0,'plaxo','openinviter.com');
insert into xinvites_interfaces values (66,0,'plazes','openinviter.com');
insert into xinvites_interfaces values (67,0,'plurk','openinviter.com');
insert into xinvites_interfaces values (68,0,'popstarmail','openinviter.com');
insert into xinvites_interfaces values (69,0,'rambler','openinviter.com');
insert into xinvites_interfaces values (70,0,'rediff','openinviter.com');
insert into xinvites_interfaces values (71,0,'sapo','openinviter.com');
insert into xinvites_interfaces values (72,0,'skyrock','openinviter.com');
insert into xinvites_interfaces values (73,0,'tagged','openinviter.com');
insert into xinvites_interfaces values (74,0,'terra','openinviter.com');
insert into xinvites_interfaces values (75,0,'twitter','openinviter.com');
insert into xinvites_interfaces values (76,0,'uk2','openinviter.com');
insert into xinvites_interfaces values (77,0,'vimeo','openinviter.com');
insert into xinvites_interfaces values (78,0,'virgilio','openinviter.com');
insert into xinvites_interfaces values (79,0,'vkontakte','openinviter.com');
insert into xinvites_interfaces values (80,0,'walla','openinviter.com');
insert into xinvites_interfaces values (81,0,'web_de','openinviter.com');
insert into xinvites_interfaces values (82,0,'wpl','openinviter.com');
insert into xinvites_interfaces values (83,0,'xanga','openinviter.com');
insert into xinvites_interfaces values (84,0,'xing','openinviter.com');
insert into xinvites_interfaces values (85,0,'xuqa','openinviter.com');
insert into xinvites_interfaces values (86,0,'yahoo','openinviter.com');
insert into xinvites_interfaces values (87,0,'yandex','openinviter.com');
insert into xinvites_interfaces values (88,0,'zapak','openinviter.com');


CREATE TABLE `xinvites_invites` (
  `xinvite_id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(20) default NULL,
  `contact_name` varchar(40) NOT NULL default '',
  `contact_email` varchar(255) NOT NULL default '',
  `type` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`xinvite_id`)
) ENGINE=MyISAM;
