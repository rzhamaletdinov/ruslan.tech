CREATE DATABASE `gulden_site` /*!40100 DEFAULT CHARACTER SET utf8 */;

CREATE TABLE `rent_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(45) DEFAULT NULL,
  `contact_organization` varchar(45) DEFAULT NULL,
  `contact_phone` varchar(45) DEFAULT NULL,
  `contact_mail` varchar(45) DEFAULT NULL,
  `size_min` int(11) DEFAULT NULL,
  `size_max` int(11) DEFAULT NULL,
  `amount_payment` varchar(45) DEFAULT NULL,
  `tenement` varchar(45) DEFAULT NULL,
  `comment` varchar(45) DEFAULT NULL,
  `creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
