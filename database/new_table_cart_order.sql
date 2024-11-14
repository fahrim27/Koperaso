/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.21-MariaDB : Database - koperasi_pinc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `agt_cart` */

DROP TABLE IF EXISTS `agt_cart`;

CREATE TABLE `agt_cart` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` bigint(11) NOT NULL,
  `id_produk` bigint(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `tgl_checkout` date DEFAULT NULL,
  `is_checkout` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `jb_order_detail` */

DROP TABLE IF EXISTS `jb_order_detail`;

CREATE TABLE `jb_order_detail` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_order` bigint(11) NOT NULL,
  `id_produk` bigint(11) NOT NULL,
  `hpp` bigint(11) NOT NULL,
  `harga` double(15,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
