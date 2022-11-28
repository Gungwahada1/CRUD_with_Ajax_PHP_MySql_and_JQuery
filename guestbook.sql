/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - guestbook
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`guestbook` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `guestbook`;

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `website` varchar(30) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `comment` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4;

/*Data for the table `book` */

insert  into `book`(`id`,`name`,`email`,`website`,`date`,`comment`) values 
(86,'Anak Agung Made Semara Putra','gungwahada1@gmail.com','www.gungwahada1.com','2022-11-28 19:21:46','Hai'),
(87,'Arya Rai','arya@gmail.com','arya.com','2022-11-28 19:23:25','Hai saya arya'),
(88,'Gungwah','gungwah@gmail.com','gungwahada1.com','2022-11-28 19:23:52','Hai saya gungwah'),
(89,'Putra Jaya','putrajaya@gmail.com','putraaja.com','2022-11-28 19:24:11','Hai saya putra'),
(90,'Putra Rai','rai@gmail.com','rai@gmail.com','2022-11-28 19:24:50','Hai saya rai'),
(91,'Surya Putra','surya@gmail.com','surya.com','2022-11-28 19:25:33','Hai saya surya'),
(92,'Candra Suari','candra@gmail.com','candrasuari.com','2022-11-28 19:25:50','Hai saya candra'),
(93,'Ayu','ayu@gmail.com','AyuPutri.com','2022-11-28 19:26:12','Hai saya ayu'),
(94,'Vino Alutsista','vila@gmail.com','vino.com','2022-11-28 19:26:36','Hai saya vino'),
(95,'Wayan Kostarika','ksdnvdkm@gmail.com','kostarika.com','2022-11-28 19:26:58','Hai saya kos'),
(96,'yudha dani','yudha@gmail.com','yudha.com','2022-11-28 19:27:27','Hai saya yudha');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
