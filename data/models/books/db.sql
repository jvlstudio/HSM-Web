CREATE TABLE IF NOT EXISTS `books` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`slug` varchar(50) NOT NULL,
`picture` varchar(255) NULL,
`description` text NULL,
`author_name` varchar(50) NULL,
`author_description` text NULL,
`link` varchar(250) NULL,
`date_register` datetime NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;