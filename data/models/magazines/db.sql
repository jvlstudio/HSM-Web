CREATE TABLE IF NOT EXISTS `magazines` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`slug` varchar(50) NOT NULL,
`picture` varchar(255) NULL,
`description` text NULL,
`link` varchar(250) NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;