CREATE TABLE IF NOT EXISTS `home` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`events_title` varchar(100) NULL,
`events_image_ios` varchar(255) NULL,
`events_image_android` varchar(255) NULL,
`education_title` varchar(100) NULL,
`education_image_ios` varchar(255) NULL,
`education_image_android` varchar(255) NULL,
`videos_title` varchar(100) NULL,
`videos_image_ios` varchar(255) NULL,
`videos_image_android` varchar(255) NULL,
`magazines_title` varchar(100) NULL,
`magazines_image_ios` varchar(255) NULL,
`magazines_image_android` varchar(255) NULL,
`books_title` varchar(100) NULL,
`books_image_ios` varchar(255) NULL,
`books_image_android` varchar(255) NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--NODE--

INSERT INTO `home`(id) VALUES(NULL)