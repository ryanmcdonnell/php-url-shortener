CREATE TABLE IF NOT EXISTS `redirect` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `url` varchar(620) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
