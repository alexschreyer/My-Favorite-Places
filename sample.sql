DROP TABLE IF EXISTS `submissions`;
CREATE TABLE `submissions` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(32) collate latin1_general_ci default NULL,
  `type` varchar(3) collate latin1_general_ci NOT NULL,
  `gender` varchar(3) collate latin1_general_ci NOT NULL,
  `location` varchar(3) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `lng` float(10,7) NOT NULL,
  `lat` float(10,7) NOT NULL,
  `ip` varchar(15) collate latin1_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;