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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `designations` */

insert  into `designations`(`id`,`Users_id`,`Recordings_id`,`status`,`created_at`,`updated_at`) values (1,5,2,1,'2015-05-27 13:46:47','2015-05-27 13:46:47');

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
  `ClientName` varchar(100) DEFAULT NULL,
  `Path` varchar(300) DEFAULT NULL,
  `FileName` varchar(300) DEFAULT NULL,
  `Status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `recordings` */

insert  into `recordings`(`id`,`ClientName`,`Path`,`FileName`,`Status`,`created_at`,`updated_at`) values (1,'GreenGuys','uploads/GreenGuys/01313313116_SoniaSantos482UK_2015-04-28-20-22-25.wav','01313313116_SoniaSantos482UK_2015-04-28-20-22-25.wav',1,'2015-05-27 11:26:38','2015-05-27 11:26:38'),(2,'GreenGuys 2','uploads/GreenGuys 2/01313313116_SoniaSantos482UK_2015-04-28-20-22-25.wav','01313313116_SoniaSantos482UK_2015-04-28-20-22-25.wav',1,'2015-05-27 12:51:43','2015-05-27 12:51:43');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`access_level`,`status`,`remember_token`,`created_at`,`updated_at`) values (1,'Joene Floresca','joenefloresca@gmail.com','$2y$10$GkLM4nWW1odwYYg.kgGp.Os1FpZHT0q9rMkASTb3Iq6r./YO9HI3a',1,1,'slpHJLIXQ191AB8a2833g0a0A0mgbxGpyWzltekihE4Ud96Rc4euxnvnY4sK','2015-05-26 15:13:38','2015-05-27 13:48:24'),(3,'Joene Floresca3','joenefloresca@gmail.com3','$2y$10$P9ht.C/xSlCf.YNwpA24VuOhe4XvsCQwxFZyQYTXuZLijjS2363uq',0,0,'CoPWcTa0p5pASQchifLyJrPUAb5ZqL4vDA664z3YEvBLT4uBPkvGnGdmUSek','2015-05-26 15:29:58','2015-05-27 13:23:24'),(5,'Naruto Uzumaki','naruto@gmail.com','$2y$10$A02QLa2PD3jLwB9BqatAh.0aISt3iZChCU3owGI/f4k.jYb9uhQZe',0,1,'yySVWxhfeFZQ3HJrD7p3aluzCkDB7Ib1m1AP1Zcj73nRxnHuzC6SpORnvLmG','2015-05-27 13:31:32','2015-05-27 13:32:06'),(8,'hasirama senju','hokage@gmail.com','$2y$10$kfG7u3YJJ2POOJ23tWYF6.X7XX9vhYH2jSE9H8ads.wp3ynxQFXdy',0,0,'iyPtLB77fMQn7F6zc6UXQ1OjpH0Dpg3EzXoePFjiLOIdsWwYQC4G0Y3wVtAX','2015-05-27 13:42:18','2015-05-27 13:42:35');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
