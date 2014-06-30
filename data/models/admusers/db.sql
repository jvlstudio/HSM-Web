CREATE TABLE IF NOT EXISTS `admusers` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(140) NOT NULL,
`username` varchar(150) NOT NULL,
`password` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;