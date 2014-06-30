CREATE TABLE IF NOT EXISTS `panelists` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`event_id` int(11) NOT NULL,
`name` varchar(70) NOT NULL,
`slug` varchar(70) NOT NULL,
`description` text NULL,
`picture` varchar(150) NULL,
`date_register` datetime NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;