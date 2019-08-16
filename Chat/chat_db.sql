/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.1.37-MariaDB : Database - aretha
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`aretha` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `aretha`;

/*Table structure for table `auth` */

DROP TABLE IF EXISTS `auth`;

CREATE TABLE `auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsr` int(10) NOT NULL,
  `usr` varchar(20) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `encrypt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsr` int(10) unsigned NOT NULL,
  `color_fondo` varchar(20) NOT NULL,
  `fuente_texto` varchar(20) NOT NULL,
  `avatar` varchar(40) DEFAULT 'avatar_default.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_rol` tinyint(4) DEFAULT NULL,
  `rol` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `salas_chat` */

DROP TABLE IF EXISTS `salas_chat`;

CREATE TABLE `salas_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `cantidad_maxima` int(10) NOT NULL DEFAULT '2',
  `idUsr_creacion` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Table structure for table `usr` */

DROP TABLE IF EXISTS `usr`;

CREATE TABLE `usr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsr` int(10) unsigned NOT NULL,
  `mail` varchar(25) NOT NULL,
  `rol` int(2) unsigned NOT NULL DEFAULT '1',
  `status` int(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Table structure for table `usr_sala` */

DROP TABLE IF EXISTS `usr_sala`;

CREATE TABLE `usr_sala` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsr` int(10) NOT NULL,
  `sala` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
