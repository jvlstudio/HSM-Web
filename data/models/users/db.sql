CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(140) NOT NULL,
`slug` varchar(150) NOT NULL,
`email` varchar(150) NOT NULL,
`phone` varchar(20) NULL,
`cellphone` varchar(20) NULL,
`company` varchar(150) NULL,
`role` varchar(150) NULL,
`website` varchar(150) NULL,
`password` varchar(20) NOT NULL,
`barcolor` enum('undefined','green','gold','red') DEFAULT 'undefined',
`os` enum('desktop','ios','android') DEFAULT 'ios',
`date_register` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;