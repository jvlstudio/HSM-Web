CREATE TABLE IF NOT EXISTS `ads` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`campaign_id` int(11) NOT NULL,
`client_id` int(11) NOT NULL,
`object_id` int(11) NOT NULL,
`table` enum('none','events','venues','categories') DEFAULT 'none',
`type` varchar(50) NOT NULL,
`image_ios` varchar(250) NOT NULL,
`image_ios_exp` varchar(250) NOT NULL,
`image_android` varchar(250) NOT NULL,
`image_android_exp` varchar(250) NOT NULL,
`link` text NOT NULL,
`count_views` int(11) DEFAULT 0,
`count_clicks` int(11) DEFAULT 0,
`position` int(2) DEFAULT 0,
`latlng` text NULL,
`date_register` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--NODE--

CREATE TABLE IF NOT EXISTS `ads_campaigns` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`client_id` int(11) NOT NULL,
`name` varchar(140) NOT NULL,
`slug` varchar(140) NOT NULL,
`options` text NOT NULL,
`date_start` datetime NOT NULL,
`date_end` datetime NOT NULL,
`date_register` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--NODE--

CREATE TABLE IF NOT EXISTS `ads_clients` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(140) NOT NULL,
`slug` varchar(140) NOT NULL,
`date_register` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--NODE--

CREATE TABLE IF NOT EXISTS `ads_activity` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`ad_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`latlng` text NOT NULL,
`date_register` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--NODE--

CREATE TABLE IF NOT EXISTS `ads_meta` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`parent_id` int(11) NOT NULL,
`meta_key` varchar(50) NOT NULL,
`meta_label` text NOT NULL,
`meta_value` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;