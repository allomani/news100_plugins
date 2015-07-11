﻿CREATE TABLE `comments_data` (
  `id` int(11) NOT NULL auto_increment,
  `news_id` int(11) NOT NULL default '0',
  `name` text NOT NULL,
  `email` text NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `active` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
)   AUTO_INCREMENT=1;