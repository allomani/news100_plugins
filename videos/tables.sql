CREATE TABLE `videos_cats` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `cat` int(11) NOT NULL default '0',
  `type` text NOT NULL,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=1 ;

-- --------------------------------------------------------



CREATE TABLE `videos_data` (
  `id` int(11) NOT NULL auto_increment,
  `cat` int(11) NOT NULL default '0',
  `name` text NOT NULL,
  `url` text NOT NULL,
  `img` text NOT NULL,
  `downloads` int(11) NOT NULL default '0',
  `views` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `votes` int(11) NOT NULL default '0',
  `votes_total` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=1 ;