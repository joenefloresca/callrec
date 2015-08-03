/*
SQLyog Community v11.42 (64 bit)
MySQL - 5.6.17 : Database - callrec
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`callrec` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `callrec`;

/*Table structure for table `clients` */

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClientName` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `clients` */

/*Table structure for table `designations` */

DROP TABLE IF EXISTS `designations`;

CREATE TABLE `designations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Users_id` int(11) DEFAULT NULL,
  `Recordings_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `designations` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `recordings` */

DROP TABLE IF EXISTS `recordings`;

CREATE TABLE `recordings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClientName` varchar(255) DEFAULT NULL,
  `Path` varchar(255) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `Hash_Key` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `recordings` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `access_level` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`access_level`,`status`,`remember_token`,`created_at`,`updated_at`) values (1,'Joene Floresca','joenefloresca@gmail.com','$2y$10$GkLM4nWW1odwYYg.kgGp.Os1FpZHT0q9rMkASTb3Iq6r./YO9HI3a',1,1,'vsk5gGrGqr3LUWvV0ow8Xql0aKA8FP02vsqRnn2BXf8R8oTqXtd4b3itSvXA','2015-05-26 15:13:38','2015-07-28 12:01:31'),(5,'Naruto Uzumaki','naruto@gmail.com','$2y$10$A02QLa2PD3jLwB9BqatAh.0aISt3iZChCU3owGI/f4k.jYb9uhQZe',0,1,'rM73t6NB6ZjO5fUghRxaWieU0fTs5d190GKWqsGZPs4HMZCIJG9E90pI7ib8','2015-05-27 13:31:32','2015-07-28 09:47:08'),(10,'Krishna Rao','krishna.rao@qdf-phils.com','$2y$10$0rvtXCpWieD73NniD1XoJ.LVzqM0d8GQl38klhxGlTWy53qfKdkqm',1,0,NULL,'2015-07-28 09:32:18','2015-07-28 09:32:18'),(11,'Argel Piamonte','argel.piamonte@qdf-phils.com','$2y$10$jSJij4QtuehS2DF8RmwYPOlIiOAveC/wW.B.jBXGAosFICY3xtyS6',1,0,NULL,'2015-07-28 09:32:33','2015-07-28 09:32:33'),(22,'Hashirama Senju','hashirama@gmail.com','$2y$10$R7OLteExDir7vrPzvoyAsO33mm0VICsc478POmgFZythjutiwAGFK',0,0,NULL,'2015-07-28 11:14:01','2015-07-28 11:14:01');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
