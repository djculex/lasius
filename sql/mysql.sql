CREATE TABLE `lasius_config` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `configname` text NOT NULL,
  `configvalue` int(11) DEFAULT NULL,
  `configactive` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;