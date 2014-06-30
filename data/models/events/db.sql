CREATE TABLE IF NOT EXISTS `events` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`slug` varchar(50) NOT NULL,
`description` text NULL,
`tiny_description` varchar(200) NULL,
`info_dates` varchar(50) NULL,
`info_hours` varchar(50) NULL,
`info_locale` varchar(50) NULL,
`date_register` datetime NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;