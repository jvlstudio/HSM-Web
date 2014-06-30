CREATE TABLE IF NOT EXISTS `agenda` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type` enum('speech','break','session') DEFAULT 'speech',
`event_id` int(11) NULL,
`panelist_id` int(11) NULL,
`date` int(3) NOT NULL,
`date_start` datetime NOT NULL,
`date_end` datetime NOT NULL,
`theme_title` varchar(70) NULL,
`theme_description` text NULL,
`label` varchar(50) NULL,
`sublabel` varchar(50) NULL,
`image` varchar(150) NULL,
`date_register` datetime NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;