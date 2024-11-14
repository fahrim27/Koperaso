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

/*Data for the table `agt_cart` */

insert  into `agt_cart`(`id`,`id_anggota`,`id_produk`,`jumlah`,`keterangan`,`tgl_checkout`,`is_checkout`,`created_at`,`updated_at`) values (2,1,6,2,'','2023-07-26',1,'2023-07-23 22:26:47','2023-07-26 02:46:56'),(3,1,10,1,'','2023-07-26',1,'2023-07-23 22:26:55','2023-07-26 01:49:19'),(4,1,12,2,'','2023-07-26',1,'2023-07-24 14:50:21','2023-07-26 11:52:59'),(5,1,14,1,'','2023-07-26',1,'2023-07-24 14:50:34','2023-07-26 01:49:15');

/*Table structure for table `agt_transaksi` */

DROP TABLE IF EXISTS `agt_transaksi`;

CREATE TABLE `agt_transaksi` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `id_norek` bigint(11) NOT NULL,
  `nominal` double(15,2) NOT NULL DEFAULT 0.00,
  `jenis` varchar(255) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `lampiran` longtext DEFAULT NULL,
  `status` enum('Menunggu Konfirmasi','Berhasil','Ditolak') DEFAULT 'Menunggu Konfirmasi',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `agt_transaksi` */

/*Table structure for table `akt_arsipshu` */

DROP TABLE IF EXISTS `akt_arsipshu`;

CREATE TABLE `akt_arsipshu` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `shu` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `akt_arsipshu` */

/*Table structure for table `akt_mutasi` */

DROP TABLE IF EXISTS `akt_mutasi`;

CREATE TABLE `akt_mutasi` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `no_bukti` varchar(30) NOT NULL DEFAULT '',
  `kde_akun` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `debet` double(15,2) NOT NULL DEFAULT 0.00,
  `kredit` double(15,2) NOT NULL DEFAULT 0.00,
  `jns_mutasi` varchar(35) NOT NULL DEFAULT '',
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `akt_mutasi` */

insert  into `akt_mutasi`(`id`,`tanggal`,`no_bukti`,`kde_akun`,`keterangan`,`debet`,`kredit`,`jns_mutasi`,`user_id`,`created_at`,`updated_at`) values (1,'2023-07-21','012307210001','00110301','Pencairan Pinjaman A.n Adi Purwanto',5000000.00,0.00,'Pencairan',1,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(2,'2023-07-21','012307210001','001101','Pencairan Pinjaman A.n Adi Purwanto',0.00,5000000.00,'Pencairan',1,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(3,'2023-07-21','012307210001','001101','Pendptan Adm Pinjaman A.n Adi Purwanto',25000.00,0.00,'AdmPencairan',1,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(4,'2023-07-21','012307210001','00140102','Pendptan Adm Pinjaman A.n Adi Purwanto',0.00,25000.00,'AdmPencairan',1,'2023-07-21 16:42:22','2023-07-21 16:42:22');

/*Table structure for table `akt_mutasirev` */

DROP TABLE IF EXISTS `akt_mutasirev`;

CREATE TABLE `akt_mutasirev` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `no_bukti` varchar(30) NOT NULL DEFAULT '',
  `kde_akun` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `debet` double(15,2) NOT NULL DEFAULT 0.00,
  `kredit` double(15,2) NOT NULL DEFAULT 0.00,
  `jns_mutasi` varchar(35) NOT NULL DEFAULT '',
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `akt_mutasirev` */

/*Table structure for table `chart_account` */

DROP TABLE IF EXISTS `chart_account`;

CREATE TABLE `chart_account` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) NOT NULL DEFAULT '',
  `kde_akun` varchar(15) NOT NULL DEFAULT '',
  `nma_akun` varchar(255) NOT NULL DEFAULT '',
  `pos_akun` int(1) NOT NULL,
  `saldo_awal` double(15,2) NOT NULL DEFAULT 0.00,
  `debet` double(15,2) NOT NULL DEFAULT 0.00,
  `kredit` double(15,2) NOT NULL DEFAULT 0.00,
  `saldo_akhir` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`,`kde_akun`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

/*Data for the table `chart_account` */

insert  into `chart_account`(`id`,`jenis`,`kde_akun`,`nma_akun`,`pos_akun`,`saldo_awal`,`debet`,`kredit`,`saldo_akhir`,`created_at`,`updated_at`) values (1,'Aktiva','001101','KAS',1,0.00,0.00,0.00,-4975000.00,'2023-05-03 00:53:38','2023-07-22 03:51:32'),(2,'Aktiva','001102','BANK',1,0.00,0.00,0.00,0.00,'2023-05-03 00:53:48','2023-05-03 00:53:48'),(3,'Aktiva','00110201','  Bank BCA',2,0.00,0.00,0.00,0.00,'2023-05-03 00:53:57','2023-06-05 05:57:46'),(4,'Aktiva','001103','PINJAMAN',1,0.00,0.00,0.00,0.00,'2023-05-03 00:55:44','2023-05-03 00:55:44'),(5,'Aktiva','00110301','  Pinjaman Anggota',2,0.00,0.00,0.00,5000000.00,'2023-05-03 00:55:54','2023-07-22 03:51:32'),(6,'Aktiva','001104','PERSEDIAAN',1,0.00,0.00,0.00,0.00,'2023-05-03 00:56:37','2023-05-03 00:56:37'),(7,'Aktiva','00110401','  Persediaan Barang',2,0.00,0.00,0.00,0.00,'2023-05-03 00:56:47','2023-05-03 00:56:47'),(8,'Aktiva','001105','INVENTARIS',1,0.00,0.00,0.00,0.00,'2023-05-03 00:57:15','2023-05-03 00:57:15'),(9,'Aktiva','00110501','  Tanah',2,0.00,0.00,0.00,0.00,'2023-05-03 00:57:30','2023-05-03 00:57:30'),(10,'Aktiva','00110502','  Bangunan',2,0.00,0.00,0.00,0.00,'2023-05-03 00:57:37','2023-05-03 00:57:37'),(12,'Pasiva','00120203','  Simpanan Sukarela',2,0.00,0.00,0.00,0.00,'2023-05-03 00:58:53','2023-07-11 15:13:16'),(13,'Pasiva','001202','MODAL',1,0.00,0.00,0.00,0.00,'2023-05-03 00:59:43','2023-05-03 00:59:43'),(14,'Pasiva','00120201','  Simpanan Pokok',2,0.00,0.00,0.00,0.00,'2023-05-03 00:59:54','2023-07-17 09:30:50'),(15,'Pasiva','00120202','  Simpanan Wajib',2,0.00,0.00,0.00,0.00,'2023-05-03 01:00:02','2023-07-17 09:30:50'),(16,'Pasiva','00120204','  Modal Penyertaan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:10:28','2023-06-05 05:57:46'),(18,'Pasiva','001203','DANA CADANGAN',1,0.00,0.00,0.00,0.00,'2023-05-03 01:15:09','2023-05-03 01:15:09'),(19,'Pasiva','001204','SISA HASIL USAHA',1,0.00,0.00,0.00,0.00,'2023-05-03 01:17:47','2023-05-03 01:17:47'),(20,'Pasiva','00120401','  SHU Tahun Berjalan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:18:04','2023-05-03 01:18:04'),(21,'Pasiva','00120402','  SHU Tahun Lalu',2,0.00,0.00,0.00,0.00,'2023-05-03 01:18:12','2023-05-03 01:18:12'),(22,'Pendapatan','001401','PENDAPATAN OPERASIONAL UTAMA',1,0.00,0.00,0.00,0.00,'2023-05-03 01:18:35','2023-05-03 01:18:35'),(23,'Pendapatan','00140101','  Pendapatan Jasa/Bunga Pinjaman Anggota',2,0.00,0.00,0.00,0.00,'2023-05-03 01:19:49','2023-07-14 17:10:25'),(24,'Pendapatan','00140103','  Pendapatan Adm Pinjaman',2,0.00,0.00,0.00,0.00,'2023-05-03 01:19:57','2023-05-24 13:07:58'),(25,'Pendapatan','00140104','  Pendapatan Adm Simpanan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:20:12','2023-05-03 01:20:12'),(26,'Pendapatan','00140105','  Pendapatan Provisi',2,0.00,0.00,0.00,0.00,'2023-05-03 01:20:22','2023-05-03 01:20:22'),(27,'Pendapatan','00140106','  Pendapatan Notariel',2,0.00,0.00,0.00,0.00,'2023-05-03 01:20:39','2023-05-03 01:20:39'),(28,'Pendapatan','001402','PENDAPATAN NON OPERASIONAL',1,0.00,0.00,0.00,0.00,'2023-05-03 01:21:08','2023-06-13 22:43:29'),(30,'Pendapatan','00140202','  Pendapatan Sewa',2,0.00,0.00,0.00,0.00,'2023-05-03 01:21:25','2023-06-22 16:09:22'),(31,'Pendapatan','00140107','  Pendapatan Materai',2,0.00,0.00,0.00,0.00,'2023-05-03 01:22:35','2023-05-03 01:22:35'),(32,'Biaya','001501','BIAYA OPERASIONAL',1,0.00,0.00,0.00,0.00,'2023-05-03 01:23:57','2023-05-03 01:23:57'),(33,'Biaya','00150101','  Biaya Tenaga Kerja',2,0.00,0.00,0.00,0.00,'2023-05-03 01:24:18','2023-05-03 01:24:18'),(34,'Biaya','00150102','  Biaya Pengurus dan Pengawas',2,0.00,0.00,0.00,0.00,'2023-05-03 01:24:35','2023-05-03 01:24:35'),(35,'Biaya','00150103','  Biaya Konsumsi',2,0.00,0.00,0.00,0.00,'2023-05-03 01:24:57','2023-05-11 10:44:44'),(36,'Biaya','00150104','  Biaya Perkoperasian',2,0.00,0.00,0.00,0.00,'2023-05-03 01:25:07','2023-05-03 01:25:07'),(37,'Biaya','00150105','  Biaya Listrik, Air, Telpon',2,0.00,0.00,0.00,0.00,'2023-05-03 01:25:29','2023-05-03 01:25:29'),(38,'Biaya','00150106','  Biaya Alat Tulis Kantor',2,0.00,0.00,0.00,0.00,'2023-05-03 01:25:49','2023-05-03 01:25:49'),(39,'Biaya','00150107','  Biaya Sumbangan / Sosial',2,0.00,0.00,0.00,0.00,'2023-05-03 01:26:13','2023-05-03 01:26:13'),(40,'Biaya','00150108','  Biaya RAT',2,0.00,0.00,0.00,0.00,'2023-05-03 01:26:26','2023-05-03 01:26:26'),(41,'Biaya','00150109','  Biaya Transport',2,0.00,0.00,0.00,0.00,'2023-05-03 01:27:03','2023-05-03 01:27:03'),(42,'Biaya','00150110','  Biaya Keamanan dan Kebersihan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:27:19','2023-05-03 01:27:19'),(43,'Biaya','001502','BIAYA NON OPERASIONAL',1,0.00,0.00,0.00,0.00,'2023-05-03 01:28:00','2023-05-03 01:28:00'),(44,'Biaya','00150201','  Biaya Adm Bank',2,0.00,0.00,0.00,0.00,'2023-05-03 01:28:22','2023-05-03 01:28:22'),(45,'Biaya','00150202','  Biaya Pajak Bank',2,0.00,0.00,0.00,0.00,'2023-05-03 01:28:35','2023-05-03 01:28:35'),(46,'Aktiva','00110302','  Cicilan Barang',2,0.00,0.00,0.00,0.00,'2023-05-24 12:51:46','2023-07-14 17:10:25'),(47,'Pendapatan','00140102','  Pendapatan Jasa/Bunga Cicilan Barang',2,0.00,0.00,0.00,25000.00,'2023-05-24 12:52:53','2023-07-22 03:51:32'),(49,'Pendapatan','00140108','  Pendapatan Penjualan Barang',2,0.00,0.00,0.00,0.00,'2023-06-26 14:20:52','2023-07-11 15:13:16');

/*Table structure for table `jb_order` */

DROP TABLE IF EXISTS `jb_order`;

CREATE TABLE `jb_order` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_trx` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `total` double(15,2) NOT NULL DEFAULT 0.00,
  `diskon` double(15,2) NOT NULL DEFAULT 0.00,
  `jangka` int(3) NOT NULL DEFAULT 12,
  `pembayaran` enum('Tunai','Transfer Bank','Bayar Nanti (PG)','Cicilan 3x','Cicilan 6x','Cicilan 12x') NOT NULL DEFAULT 'Bayar Nanti (PG)',
  `notes` varchar(255) DEFAULT '',
  `ket_batal` varchar(255) NOT NULL DEFAULT '',
  `status_order` enum('Dibatalkan','Menunggu Konfirmasi','Diproses','Siap Diambil','Selesai','Menunggu Pembayaran') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jb_order` */

insert  into `jb_order`(`id`,`no_trx`,`tanggal`,`id_anggota`,`total`,`diskon`,`jangka`,`pembayaran`,`notes`,`ket_batal`,`status_order`,`created_at`,`updated_at`) values (2,'T012307260001','2023-07-26',1,92900.00,0.00,12,'Bayar Nanti (PG)','tes2','','Diproses','2023-07-26 15:19:35','2023-07-26 15:19:35');

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

/*Data for the table `jb_order_detail` */

insert  into `jb_order_detail`(`id`,`id_order`,`id_produk`,`hpp`,`harga`,`qty`,`created_at`,`updated_at`) values (1,2,6,2698,3000.00,2,'2023-07-26 15:19:35','2023-07-26 15:19:35'),(2,2,10,27433,32900.00,1,'2023-07-26 15:19:35','2023-07-26 15:19:35'),(3,2,12,14500,15000.00,2,'2023-07-26 15:19:35','2023-07-26 15:19:35'),(4,2,14,17200,24000.00,1,'2023-07-26 15:19:35','2023-07-26 15:19:35');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_02_07_082604_create_anggota_table',1),(4,'2019_02_07_082623_create_tabungan_table',1),(5,'2019_02_07_082624_create_setoran_table',1),(6,'2019_02_07_082626_create_penarikan_table',1),(7,'2019_02_07_082724_create_riwayat_tabungan_table',1),(8,'2019_02_07_082725_create_bunga_tabungan_table',1),(9,'2019_02_09_093543_add_tahun_to_bunga_tabungan_table',1);

/*Table structure for table `ms_anggota` */

DROP TABLE IF EXISTS `ms_anggota`;

CREATE TABLE `ms_anggota` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `no_anggota` varchar(20) NOT NULL DEFAULT '',
  `nik` varchar(20) NOT NULL DEFAULT '',
  `nama_anggota` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `id_perusahaan` bigint(11) NOT NULL,
  `no_ktp` varchar(20) NOT NULL DEFAULT '',
  `id_department` bigint(11) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL DEFAULT '',
  `tgl_lahir` date DEFAULT NULL,
  `no_telpon` varchar(20) NOT NULL DEFAULT '',
  `kontak_darurat` varchar(20) DEFAULT '',
  `jenis_kelamin` varchar(35) NOT NULL DEFAULT '',
  `status_karyawan` enum('Permanen','Kontrak','Probation') DEFAULT NULL,
  `no_rekening` varchar(20) NOT NULL DEFAULT '',
  `id_jabatan` bigint(11) NOT NULL,
  `foto_ktp` longtext DEFAULT NULL,
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `alamat_domisili` varchar(255) DEFAULT '',
  `status_keanggotaan` enum('Aktif','Non-Aktif','Menunggu') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_anggota` */

insert  into `ms_anggota`(`id`,`user_id`,`no_anggota`,`nik`,`nama_anggota`,`email`,`id_perusahaan`,`no_ktp`,`id_department`,`tempat_lahir`,`tgl_lahir`,`no_telpon`,`kontak_darurat`,`jenis_kelamin`,`status_karyawan`,`no_rekening`,`id_jabatan`,`foto_ktp`,`alamat`,`alamat_domisili`,`status_keanggotaan`,`created_at`,`updated_at`) values (1,62,'PNC0001','-','Adi Purwanto','adi@pincgroup.id',1,'4489828',24,'Pekalongan','1993-07-14','0988890','0-9008','Laki-laki','Permanen','32424',2,'1689528734912-img_ktp.png','Jakarta','Jakarta','Aktif','2023-07-17 00:32:15','2023-07-17 16:36:52'),(2,61,'PNC0002','-','Pandega','pandega@pincgroup.id',1,'444',24,'Jkt','1992-08-08','089','0899','Laki-laki','Permanen','88787',2,'1689585518892-img_ktp.png','Jkarta','Jkarta','Menunggu','2023-07-17 16:18:39','2023-07-17 16:23:21');

/*Table structure for table `ms_department` */

DROP TABLE IF EXISTS `ms_department`;

CREATE TABLE `ms_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_department` */

insert  into `ms_department`(`id`,`nama`,`created_at`,`updated_at`) values (3,'-',NULL,NULL),(4,'ACCOUNT',NULL,NULL),(5,'BOD KOONTJIE',NULL,NULL),(6,'BOD PMA',NULL,NULL),(7,'BOD W3P',NULL,NULL),(8,'CREATIVE',NULL,NULL),(9,'DIGITAL',NULL,NULL),(10,'HR',NULL,NULL),(11,'IMADI',NULL,NULL),(12,'INDOSAT B2B',NULL,NULL),(13,'INDOSAT B2C',NULL,NULL),(14,'MATA ANGIN',NULL,NULL),(15,'MEDIA TJIPTA PARAGON',NULL,NULL),(16,'MULTIBRAND',NULL,NULL),(17,'MULTIBRAND (ADIRA DLL)',NULL,NULL),(18,'MULTIBRAND 1',NULL,NULL),(19,'MULTIBRAND 1 & 2',NULL,NULL),(20,'MULTIBRAND 2',NULL,NULL),(21,'PANTAREI',NULL,NULL),(22,'PINC',NULL,NULL),(23,'STRATEGY',NULL,NULL),(24,'SUPPORT',NULL,NULL),(25,'SUPPORT PAN',NULL,NULL),(26,'SUPPORT PMA',NULL,NULL),(27,'TRI',NULL,NULL),(28,'W3P',NULL,NULL);

/*Table structure for table `ms_jabatan` */

DROP TABLE IF EXISTS `ms_jabatan`;

CREATE TABLE `ms_jabatan` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `simp_pokok` double(15,2) NOT NULL DEFAULT 0.00,
  `simp_wajib` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_jabatan` */

insert  into `ms_jabatan`(`id`,`nama`,`simp_pokok`,`simp_wajib`,`created_at`,`updated_at`) values (1,'Non Staff',100000.00,50000.00,'2023-05-04 13:33:15','2023-05-04 13:33:15'),(2,'Staff - Senior Officer',100000.00,150000.00,'2023-05-04 13:33:37','2023-05-04 13:33:37'),(3,'Manager - Senior Manager',100000.00,250000.00,'2023-05-04 13:33:53','2023-05-04 13:33:53'),(4,'Director',100000.00,500000.00,'2023-05-04 13:34:39','2023-05-04 13:34:39');

/*Table structure for table `ms_kategori` */

DROP TABLE IF EXISTS `ms_kategori`;

CREATE TABLE `ms_kategori` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_kategori` */

insert  into `ms_kategori`(`id`,`kategori`,`created_at`,`updated_at`) values (1,'BAHAN POKOK','2023-05-11 15:01:16','2023-05-11 15:01:16'),(2,'ELEKTRONIK','2023-05-11 15:01:23','2023-05-11 15:01:23'),(3,'FURNITURE','2023-05-11 15:01:33','2023-05-11 15:01:33'),(4,'SEPEDA MOTOR','2023-05-11 15:01:38','2023-05-11 15:01:38');

/*Table structure for table `ms_perusahaan` */

DROP TABLE IF EXISTS `ms_perusahaan`;

CREATE TABLE `ms_perusahaan` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `inisial` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_perusahaan` */

insert  into `ms_perusahaan`(`id`,`nama`,`inisial`,`created_at`,`updated_at`) values (1,'PINC','PNC','2023-05-04 12:27:08','2023-05-04 12:27:08'),(2,'Pantarei','PAN','2023-05-04 12:27:08','2023-05-04 12:27:08'),(3,'Mata Angin','PMA','2023-05-04 12:27:08','2023-05-31 14:15:47'),(4,'IMADI','IMD','2023-05-04 12:27:08','2023-05-04 12:27:08'),(5,'W3P','WTP','2023-05-04 12:27:08','2023-05-04 12:27:08'),(6,'TANGGA','TGG','2023-05-04 12:27:08','2023-05-04 12:27:08'),(7,'KOONTJIE','KNC','2023-05-04 12:27:08','2023-05-04 12:27:08'),(8,'MTP','MTP','2023-05-24 13:06:21','2023-05-24 13:06:21');

/*Table structure for table `ms_produk` */

DROP TABLE IF EXISTS `ms_produk`;

CREATE TABLE `ms_produk` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` bigint(11) NOT NULL DEFAULT 0,
  `nama_barang` varchar(225) NOT NULL DEFAULT '',
  `deskripsi` varchar(255) NOT NULL DEFAULT '',
  `harga_beli` double(15,2) NOT NULL DEFAULT 0.00,
  `harga_jual` double(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('PreOrder','Ready Stock','Discontinue','Out of Stock') NOT NULL DEFAULT 'PreOrder',
  `estimasi` int(8) NOT NULL DEFAULT 0,
  `cicilan` varchar(1) NOT NULL DEFAULT 'Y',
  `bayar_penuh` varchar(1) NOT NULL DEFAULT 'Y',
  `foto` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_produk` */

insert  into `ms_produk`(`id`,`id_kategori`,`nama_barang`,`deskripsi`,`harga_beli`,`harga_jual`,`status`,`estimasi`,`cicilan`,`bayar_penuh`,`foto`,`created_at`,`updated_at`) values (6,1,'Indomie Soto Mie 70gr','70 Gr',2698.00,3000.00,'Ready Stock',0,'N','Y','image001.jpg','2023-07-12 11:39:23','2023-07-12 11:39:23'),(7,1,'Indomie Ayam Bawang 69gr','69 Gr',2698.00,3000.00,'Ready Stock',0,'N','Y','image003.jpg','2023-07-12 11:39:23','2023-07-12 11:39:23'),(8,1,'Indomie Kari Ayam 72gr','72 Gr',2856.00,3300.00,'Ready Stock',0,'N','Y','image005.jpg','2023-07-12 11:39:23','2023-07-12 11:39:23'),(9,1,'Indomie Goreng SPC 80gr','80 Gr',2831.00,3200.00,'Ready Stock',0,'N','Y','image007.jpg','2023-07-12 11:39:23','2023-07-12 11:39:23'),(10,1,'Kopi Kapal Api Bubuk SPC 380gr','380 Gr',27433.00,32900.00,'Ready Stock',0,'N','Y','image009.jpg','2023-07-12 11:39:23','2023-07-12 11:39:23'),(11,1,'Sunlight Lime 650ml','Sabun Cuci Piring Sunlight Lime 650ml',13900.00,14900.00,'Ready Stock',0,'N','Y','image011.jpg','2023-07-12 11:39:23','2023-07-12 11:39:23'),(12,1,'Gulaku Gula Kuning 1kg','1000 ml',14500.00,15000.00,'Ready Stock',0,'N','Y','image013.jpg','2023-07-12 11:39:23','2023-07-12 11:39:23'),(13,1,'Tissue Multi MP08','-',48906.00,51900.00,'Ready Stock',0,'N','Y','image015.jpg','2023-07-12 11:39:23','2023-07-12 11:39:23'),(14,1,'Tissue Multi Non Perpum','-',17200.00,24000.00,'Ready Stock',0,'N','Y','image017.jpg','2023-07-12 11:39:24','2023-07-12 11:39:24'),(15,1,'Charm Night 35cm Isi 12','Pembalut Wanita Charm Night 35cm Isi 12',19800.00,24300.00,'Ready Stock',0,'N','Y','image019.jpg','2023-07-12 11:39:24','2023-07-12 11:39:24'),(16,1,'Charm Night 29cm Isi 20','Pembalut Wanita Charm Night 29cm Isi 20',17800.00,21000.00,'Ready Stock',0,'N','Y','image021.jpg','2023-07-12 11:39:24','2023-07-12 11:39:24'),(17,1,'Susu Dancow 3+ 750gr Vanila','750 Gr',96700.00,98000.00,'Ready Stock',0,'N','Y','image023.jpg','2023-07-12 11:39:24','2023-07-12 11:39:24'),(18,1,'Susu Dancow 3+ 750gr Madu','750 Gr',96800.00,98000.00,'Ready Stock',0,'N','Y','image025.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(19,1,'Minyak Goreng Tropical 2L','2000 ml',37400.00,39400.00,'Ready Stock',0,'N','Y','image027.jpg','2023-07-12 11:39:24','2023-07-12 11:39:24'),(20,1,'Mamy Poko pants XXL 24pack','Pempers Mamy Poko pants XXL 24pack',73500.00,79400.00,'Ready Stock',0,'N','Y','image029.jpg','2023-07-12 11:39:24','2023-07-12 11:39:24'),(21,1,'Mamy Poko pants L 28pack','isi 28',65900.00,70600.00,'Ready Stock',0,'N','Y','image031.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(22,1,'Mamy Poko pants XL 26pack','isi 26',71500.00,74900.00,'Ready Stock',0,'N','Y','image033.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(23,1,'So Klin Pemutih 500ml','500 ml',5500.00,7000.00,'Ready Stock',0,'N','Y','image035.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(24,1,'Saus Delmonte 1kg','1000ml',20300.00,25500.00,'Ready Stock',0,'N','Y','image037.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(25,1,'Baygon Spray 600ml','Obat Nyamuk / Baygon Spray 600ml',45900.00,46900.00,'Ready Stock',0,'N','Y','image039.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(26,1,'Baygon Tea Bloss 600ml','600ml',45900.00,46900.00,'Ready Stock',0,'N','Y','image041.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(27,1,'Glade Gel Lavender 180gr','Pengharum Ruangan Glade Gel Lavender 180gr',20950.00,24200.00,'Ready Stock',0,'N','Y','image043.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(28,1,'Kapur Bagus Ajaib','-',16900.00,17500.00,'Ready Stock',0,'N','Y','image045.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(29,1,'Glade Oud wood 146gr','Pengharum Ruangan Glade Oud wood 146gr',31900.00,34900.00,'Ready Stock',0,'N','Y','image047.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(30,1,'Sabun Mandi Biore 400ml','400ml',24300.00,27200.00,'Ready Stock',0,'N','Y','image049.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(31,1,'Glade Fresh Spray 350ml','Pengharum Ruangan Glade Fresh Spray 350ml',25700.00,31600.00,'Ready Stock',0,'N','Y','image051.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(32,1,'Kecap Bango 520ml','520ml',23500.00,26500.00,'Ready Stock',0,'N','Y','image053.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(33,1,'Rexona Women','-',16600.00,21800.00,'Ready Stock',0,'N','Y','image055.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(34,1,'Rejoice Rich 150ml','Shampo Rejoice Rich 150ml',22900.00,24000.00,'Ready Stock',0,'N','Y','image057.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(35,1,'Rejoice Friz 150ml','Shampo Rejoice Friz 150ml',22900.00,34000.00,'Ready Stock',0,'N','Y','image059.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(36,1,'Pantene Anti Ketombe 160ml','Shampo Pantene Anti Ketombe 160ml',26200.00,27200.00,'Ready Stock',0,'N','Y','image061.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(37,1,'Pantene HFC 160ml','Shampo Pantene HFC 160ml',26200.00,27200.00,'Ready Stock',0,'N','Y','image063.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(38,1,'Pantene SM.CR 160ml','Shampo Pantene SM.CR 160ml',26200.00,27200.00,'Ready Stock',0,'N','Y','image065.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(39,1,'Pantene Anti Lepek 160ml','Shampo Pantene Anti Lepek 160ml',26200.00,33400.00,'Ready Stock',0,'N','Y','image067.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(40,1,'Clear Man Cooll 160ml','Shampo Clear Man Cooll 160ml',28000.00,33000.00,'Ready Stock',0,'N','Y','image069.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(41,1,'Lem Tikus Bagus ','-',14500.00,15000.00,'Ready Stock',0,'N','Y','image071.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(42,1,'Spons Scotch Brite 12s','isi 12',38900.00,8000.00,'Ready Stock',0,'N','Y','image073.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(43,1,'SOS Flower 750ml','Pembersih Lantai SOS Flower 750ml',10500.00,11000.00,'Ready Stock',0,'N','Y','image075.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(44,1,'Lantai SOS Apple 750ml','Pembersih Lantai SOS Apple 750ml',10500.00,11000.00,'Ready Stock',0,'N','Y','image077.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(45,1,'Attack Jaz1 800gr','Deterjen Attack Jaz1 800gr',17700.00,19700.00,'Ready Stock',0,'N','Y','image079.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(46,1,'Teh Celup Sosro 50','isi 50',10000.00,13100.00,'Ready Stock',0,'N','Y','image081.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(47,1,'Pasta Gigi Pepsodent 190gr','Pasta Gigi Pepsodent 190gr',12600.00,15600.00,'Ready Stock',0,'N','Y','image083.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(48,1,'Porstex 1L','1000ml',20100.00,25100.00,'Ready Stock',0,'N','Y','image085.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(49,1,'Max Creamer 500gr','500gr',33000.00,38900.00,'Ready Stock',0,'N','Y','image087.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(50,1,'Kopi Kapal Api Krim kafe 500gr','500gr',29300.00,36900.00,'Ready Stock',0,'N','Y','image089.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(51,1,'Gudang Garam Signature 12 Slop','Rokok Gudang Garam Signature 12 Slop',213000.00,217000.00,'Ready Stock',0,'N','Y','image091.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(52,1,'Esse Change Applemint 20 Slop','Rokok Esse Change Applemint 20 Slop',335500.00,377000.00,'Ready Stock',0,'N','Y','image093.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(53,1,'Dunhill Fine Cut Filter 16 Slop','Rokok Dunhill Fine Cut Filter 16 Slop',249500.00,257500.00,'Ready Stock',0,'N','Y','image095.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(54,1,'Dunhill Fine Cut Mild 20 Slop','Rokok Dunhill Fine Cut Mild 20 Slop isi 20',320500.00,257500.00,'Ready Stock',0,'N','Y','image097.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(55,1,'Marlboro Light 20 Slop','Rokok Marlboro Light 20 Slop isi 20',362000.00,367000.00,'Ready Stock',0,'N','Y','image099.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(56,1,'Marlboro Hitam 20 Slop','Rokok Marlboro Hitam 20 Slop isi 20',362000.00,332000.00,'Ready Stock',0,'N','Y','image101.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(57,1,'Marlboro Burst 20 Slop','Rokok Marlboro Burst 20 Slop isi 20',361800.00,367000.00,'Ready Stock',0,'N','Y','image103.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(58,1,'Camel White 20 Slop','Rokok Camel White 20 Slop isi 20',255500.00,262000.00,'Ready Stock',0,'N','Y','image105.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(59,1,'Rokok Sampoerna Mild 16 Slop','isi 16 ',293600.00,301000.00,'Ready Stock',0,'N','Y','image107.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(60,1,'Rexona Man','-',16592.00,19000.00,'Ready Stock',0,'N','Y','image109.png','2023-07-12 11:39:24','2023-07-12 11:39:24'),(63,4,'Yamaha Fazio','Yamaha Fazio',18000000.00,19000000.00,'PreOrder',12,'Y','N','1689676369229-Yamaha-Fazzio.png','2023-07-18 17:32:49','2023-07-18 17:34:44');

/*Table structure for table `ms_produk_copy1` */

DROP TABLE IF EXISTS `ms_produk_copy1`;

CREATE TABLE `ms_produk_copy1` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` bigint(11) NOT NULL DEFAULT 0,
  `nama_barang` varchar(225) NOT NULL DEFAULT '',
  `deskripsi` varchar(255) NOT NULL DEFAULT '',
  `harga_beli` double(15,2) NOT NULL DEFAULT 0.00,
  `harga_jual` double(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('PreOrder','Ready Stock','Discontinue','Out of Stock') NOT NULL DEFAULT 'PreOrder',
  `estimasi` int(8) NOT NULL DEFAULT 0,
  `cicilan` varchar(1) NOT NULL DEFAULT 'Y',
  `bayar_penuh` varchar(1) NOT NULL DEFAULT 'Y',
  `foto` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_produk_copy1` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pby_import` */

DROP TABLE IF EXISTS `pby_import`;

CREATE TABLE `pby_import` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_norek` bigint(11) NOT NULL,
  `no_rek` varchar(25) NOT NULL DEFAULT '',
  `nama_anggota` varchar(255) NOT NULL DEFAULT '',
  `nama_pinjaman` varchar(100) NOT NULL DEFAULT '',
  `angs_pokok` double(15,2) NOT NULL DEFAULT 0.00,
  `angs_jasa` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_import` */

/*Table structure for table `pby_jadwal` */

DROP TABLE IF EXISTS `pby_jadwal`;

CREATE TABLE `pby_jadwal` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_norek` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `angske` int(4) NOT NULL DEFAULT 0,
  `angs_pokok` double(15,2) NOT NULL DEFAULT 0.00,
  `angs_jasa` double(15,2) NOT NULL DEFAULT 0.00,
  `status` varchar(5) NOT NULL DEFAULT '',
  `user_id` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_jadwal` */

insert  into `pby_jadwal`(`id`,`id_norek`,`tanggal`,`angske`,`angs_pokok`,`angs_jasa`,`status`,`user_id`,`created_at`,`updated_at`) values (1,1,'2023-08-21',1,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(2,1,'2023-09-21',2,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(3,1,'2023-10-21',3,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(4,1,'2023-11-21',4,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(5,1,'2023-12-21',5,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(6,1,'2024-01-21',6,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(7,1,'2024-02-21',7,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(8,1,'2024-03-21',8,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(9,1,'2024-04-21',9,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(10,1,'2024-05-21',10,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(11,1,'2024-06-21',11,416667.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22'),(12,1,'2024-07-21',12,416663.00,17500.00,'',0,'2023-07-21 16:42:22','2023-07-21 16:42:22');

/*Table structure for table `pby_master` */

DROP TABLE IF EXISTS `pby_master`;

CREATE TABLE `pby_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode` varchar(2) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `akun_produk` varchar(20) NOT NULL DEFAULT '',
  `akun_jasa` varchar(20) NOT NULL DEFAULT '',
  `akun_adm` varchar(20) NOT NULL DEFAULT '',
  `bya_adm` double(5,2) NOT NULL DEFAULT 0.00,
  `persen_jasa` double(5,2) NOT NULL DEFAULT 0.00,
  `jenis_pinjaman` enum('Tunai','Barang') NOT NULL DEFAULT 'Tunai',
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_master` */

insert  into `pby_master`(`id`,`kode`,`nama`,`akun_produk`,`akun_jasa`,`akun_adm`,`bya_adm`,`persen_jasa`,`jenis_pinjaman`,`status`,`created_at`,`updated_at`) values (1,'50','Pinjaman Biasa','00110301','00140101','00140102',0.50,0.35,'Tunai','Y','2023-05-04 12:50:28','2023-05-04 12:50:28'),(4,'51','Cicilan Barang','00110302','00140102','00140103',0.00,0.00,'Barang','Y','2023-05-24 12:51:04','2023-05-24 12:51:04'),(6,'53','Pinjaman Khusus','00110301','00140101','00140103',0.00,0.50,'Tunai','Y','2023-06-14 12:44:27','2023-06-14 12:44:27');

/*Table structure for table `pby_mutasi` */

DROP TABLE IF EXISTS `pby_mutasi`;

CREATE TABLE `pby_mutasi` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_norek` bigint(11) NOT NULL,
  `no_bukti` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `angske` int(4) NOT NULL DEFAULT 0,
  `no_rek` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `angs_pokok` double(15,2) NOT NULL DEFAULT 0.00,
  `angs_jasa` double(15,2) NOT NULL DEFAULT 0.00,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_mutasi` */

/*Table structure for table `pby_pengajuan` */

DROP TABLE IF EXISTS `pby_pengajuan`;

CREATE TABLE `pby_pengajuan` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` bigint(11) NOT NULL,
  `id_order` bigint(11) NOT NULL,
  `id_pinjaman` bigint(11) NOT NULL,
  `no_rek` varchar(20) NOT NULL,
  `no_pengajuan` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `jenis` enum('Pinjaman Tunai','Cicilan Barang') NOT NULL DEFAULT 'Pinjaman Tunai',
  `nominal` double(15,2) NOT NULL DEFAULT 0.00,
  `jangka` int(3) NOT NULL DEFAULT 0,
  `keperluan` varchar(255) NOT NULL DEFAULT '',
  `jaminan` enum('Tanpa Jaminan','BPKB','Sertifikat','Lainnya') NOT NULL DEFAULT 'Tanpa Jaminan',
  `user_id` int(10) NOT NULL,
  `status_pengajuan` enum('Menunggu Persetujuan HR','Menunggu Persetujuan CFO','Disetujui HR','Disetujui CFO','Menunggu Pencairan','Pencairan Selesai','Tidak Disetujui HR','Tidak Disetujui CFO','Tidak Disetujui','Pencairan Dibatalkan') NOT NULL DEFAULT 'Menunggu Persetujuan HR',
  `tgl_ubah` date DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `approve_by_hr` int(1) NOT NULL DEFAULT 0,
  `approve_by_cfo` int(1) NOT NULL DEFAULT 0,
  `foto_ttd` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_pengajuan` */

insert  into `pby_pengajuan`(`id`,`id_anggota`,`id_order`,`id_pinjaman`,`no_rek`,`no_pengajuan`,`tanggal`,`jenis`,`nominal`,`jangka`,`keperluan`,`jaminan`,`user_id`,`status_pengajuan`,`tgl_ubah`,`keterangan`,`approve_by_hr`,`approve_by_cfo`,`foto_ttd`,`created_at`,`updated_at`) values (2,1,0,1,'0015000001','P012307200001','2023-07-20','Pinjaman Tunai',5000000.00,12,'modal','Tanpa Jaminan',62,'Pencairan Selesai','2023-07-21','',1,1,'1689833529036-esign_new.png','2023-07-20 13:12:09','2023-07-21 16:42:22');

/*Table structure for table `pby_rekening` */

DROP TABLE IF EXISTS `pby_rekening`;

CREATE TABLE `pby_rekening` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` bigint(11) NOT NULL DEFAULT 0,
  `id_pinjaman` bigint(11) NOT NULL DEFAULT 0,
  `id_pengajuan` bigint(11) NOT NULL DEFAULT 0,
  `no_rek` varchar(20) NOT NULL,
  `tgl_cair` date DEFAULT NULL,
  `jangka` int(3) NOT NULL DEFAULT 0,
  `jth_tempo` date DEFAULT NULL,
  `plafond` double(15,2) NOT NULL DEFAULT 0.00,
  `bya_adm` double(15,2) NOT NULL DEFAULT 0.00,
  `angske` int(3) NOT NULL DEFAULT 0,
  `saldo_awal_pokok_sys` double(15,2) NOT NULL DEFAULT 0.00,
  `saldo_awal_jasa_sys` double(15,2) NOT NULL DEFAULT 0.00,
  `saldo_akhir` double(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('Aktif','Lunas') NOT NULL DEFAULT 'Aktif',
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_rekening` */

insert  into `pby_rekening`(`id`,`id_anggota`,`id_pinjaman`,`id_pengajuan`,`no_rek`,`tgl_cair`,`jangka`,`jth_tempo`,`plafond`,`bya_adm`,`angske`,`saldo_awal_pokok_sys`,`saldo_awal_jasa_sys`,`saldo_akhir`,`status`,`user_id`,`created_at`,`updated_at`) values (1,1,1,2,'0015000001','2023-07-21',12,'2024-07-21',5000000.00,25000.00,1,0.00,0.00,5000000.00,'Aktif',1,'2023-07-21 16:42:22','2023-07-21 16:42:22');

/*Table structure for table `pby_simulasi` */

DROP TABLE IF EXISTS `pby_simulasi`;

CREATE TABLE `pby_simulasi` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `angske` int(4) NOT NULL DEFAULT 0,
  `angs_pokok` double(15,2) NOT NULL DEFAULT 0.00,
  `angs_jasa` double(15,2) NOT NULL DEFAULT 0.00,
  `user_id` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_simulasi` */

/*Table structure for table `shu_jasaagt` */

DROP TABLE IF EXISTS `shu_jasaagt`;

CREATE TABLE `shu_jasaagt` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_trx` varchar(20) NOT NULL DEFAULT '',
  `hpp` double(15,2) NOT NULL DEFAULT 0.00,
  `harga_jual` double(15,2) NOT NULL DEFAULT 0.00,
  `nominal` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `shu_jasaagt` */

/*Table structure for table `simp_import` */

DROP TABLE IF EXISTS `simp_import`;

CREATE TABLE `simp_import` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_norek` bigint(11) NOT NULL,
  `no_rek` varchar(25) NOT NULL DEFAULT '',
  `nama_anggota` varchar(255) NOT NULL DEFAULT '',
  `nama_simpanan` varchar(100) NOT NULL DEFAULT '',
  `nominal` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `simp_import` */

/*Table structure for table `simp_master` */

DROP TABLE IF EXISTS `simp_master`;

CREATE TABLE `simp_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode` varchar(2) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `akun_produk` varchar(20) NOT NULL DEFAULT '',
  `akun_jasa` varchar(20) NOT NULL DEFAULT '',
  `persen_jasa` double(15,2) NOT NULL DEFAULT 0.00,
  `modal` varchar(1) NOT NULL DEFAULT 'N',
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `simp_master` */

insert  into `simp_master`(`id`,`kode`,`nama`,`akun_produk`,`akun_jasa`,`persen_jasa`,`modal`,`status`,`created_at`,`updated_at`) values (1,'01','Simpanan Pokok','00120201','',0.00,'Y','Y','2023-05-04 12:50:28','2023-05-04 12:50:28'),(2,'02','Simpanan Wajib','00120202','',0.00,'Y','Y','2023-05-04 12:50:34','2023-05-04 12:50:34'),(3,'03','Simpanan Sukarela','00120203','00150104',0.00,'N','Y','2023-05-04 12:50:47','2023-06-13 20:17:06');

/*Table structure for table `simp_mutasi` */

DROP TABLE IF EXISTS `simp_mutasi`;

CREATE TABLE `simp_mutasi` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_norek` bigint(11) NOT NULL,
  `no_bukti` varchar(30) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `no_rek` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `debet` double(15,2) NOT NULL DEFAULT 0.00,
  `kredit` double(15,2) NOT NULL DEFAULT 0.00,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `simp_mutasi` */

/*Table structure for table `simp_rekening` */

DROP TABLE IF EXISTS `simp_rekening`;

CREATE TABLE `simp_rekening` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` bigint(11) NOT NULL,
  `id_simpanan` bigint(11) NOT NULL,
  `no_rek` varchar(15) NOT NULL DEFAULT '',
  `tgl_buka` date DEFAULT NULL,
  `tgl_tutup` date DEFAULT NULL,
  `jasa_persen` double(5,2) NOT NULL DEFAULT 0.00,
  `status_aktif` varchar(1) NOT NULL DEFAULT 'Y',
  `status_blokir` varchar(1) NOT NULL DEFAULT 'N',
  `saldo_awal_sys` double(15,2) NOT NULL DEFAULT 0.00,
  `saldo_akhir` double(15,2) NOT NULL DEFAULT 0.00,
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `simp_rekening` */

insert  into `simp_rekening`(`id`,`id_anggota`,`id_simpanan`,`no_rek`,`tgl_buka`,`tgl_tutup`,`jasa_persen`,`status_aktif`,`status_blokir`,`saldo_awal_sys`,`saldo_akhir`,`user_id`,`created_at`,`updated_at`) values (1,2,1,'0010100001','2023-07-17',NULL,0.00,'Y','N',0.00,0.00,61,'2023-07-17 16:23:21','2023-07-17 16:23:21'),(2,2,2,'0010200001','2023-07-17',NULL,0.00,'Y','N',0.00,0.00,61,'2023-07-17 16:23:21','2023-07-17 16:23:21'),(3,1,1,'0010100002','2023-07-17',NULL,0.00,'Y','N',0.00,0.00,59,'2023-07-17 16:36:52','2023-07-17 16:36:52'),(4,1,2,'0010200002','2023-07-17',NULL,0.00,'Y','N',0.00,0.00,59,'2023-07-17 16:36:52','2023-07-17 16:36:52');

/*Table structure for table `sys_notification` */

DROP TABLE IF EXISTS `sys_notification`;

CREATE TABLE `sys_notification` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` bigint(11) NOT NULL,
  `id_reksimp` bigint(11) NOT NULL,
  `id_rekpby` bigint(11) NOT NULL,
  `id_pengajuan` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` enum('Pinjaman','Simpanan','Anggota','Setoran','Angsuran','Pengajuan') NOT NULL,
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `role` enum('Anggota','Admin') NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sys_notification` */

insert  into `sys_notification`(`id`,`id_anggota`,`id_reksimp`,`id_rekpby`,`id_pengajuan`,`tanggal`,`jenis`,`keterangan`,`role`,`is_read`,`user_id`,`created_at`,`updated_at`) values (1,0,0,0,1,'2023-07-18','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,1,'2023-07-18 05:36:44','2023-07-18 05:36:44'),(2,0,0,0,1,'2023-07-18','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,39,'2023-07-18 05:36:44','2023-07-18 05:36:44'),(3,0,0,0,1,'2023-07-18','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,60,'2023-07-18 05:36:44','2023-07-18 05:36:44'),(4,0,0,0,1,'2023-07-19','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,1,'2023-07-19 02:37:33','2023-07-19 02:37:33'),(5,0,0,0,1,'2023-07-19','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,39,'2023-07-19 02:37:33','2023-07-19 02:37:33'),(6,0,0,0,1,'2023-07-19','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,60,'2023-07-19 02:37:33','2023-07-19 02:37:33'),(7,0,0,0,2,'2023-07-20','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,1,'2023-07-20 13:12:18','2023-07-20 13:12:18'),(8,0,0,0,2,'2023-07-20','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,39,'2023-07-20 13:12:18','2023-07-20 13:12:18'),(9,0,0,0,2,'2023-07-20','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,60,'2023-07-20 13:12:18','2023-07-20 13:12:18');

/*Table structure for table `sys_pengesah` */

DROP TABLE IF EXISTS `sys_pengesah`;

CREATE TABLE `sys_pengesah` (
  `ketua` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sekretaris` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `bendahara` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `manager` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ko` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `keuangan` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `marketing` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `kasir` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `kabag_pby` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `saksi1` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `saksi2` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `sys_pengesah` */

insert  into `sys_pengesah`(`ketua`,`sekretaris`,`bendahara`,`manager`,`ko`,`keuangan`,`marketing`,`kasir`,`kabag_pby`,`saksi1`,`saksi2`) values ('Ketua','Sekretaris','Bendahara','Manager','','Akunting','','Kasir','Ka. Pembiayaan','Saksi 1','Saksi 2');

/*Table structure for table `sys_pengurus` */

DROP TABLE IF EXISTS `sys_pengurus`;

CREATE TABLE `sys_pengurus` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `posisi` enum('Ketua','Sekretaris','Bendahara','Jual Beli') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` tinyblob DEFAULT 'current_timestamp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sys_pengurus` */

insert  into `sys_pengurus`(`id`,`posisi`,`nama`,`email`,`created_at`,`updated_at`) values (1,'Ketua','Ketua','adi@pincgroup.id','2023-06-11 02:43:23','current_timestamp'),(3,'Bendahara','Bendahara','adi.vfp9@gmail.com','2023-06-11 02:43:41','current_timestamp'),(4,'Sekretaris','Sekretaris','adi.wanted009@gmail.com','2023-07-14 11:54:50','current_timestamp');

/*Table structure for table `sys_periode` */

DROP TABLE IF EXISTS `sys_periode`;

CREATE TABLE `sys_periode` (
  `kde_kantor` char(3) COLLATE latin1_general_ci DEFAULT NULL,
  `tgl_aktif` date DEFAULT NULL,
  `tgl_hariini` date DEFAULT NULL,
  `tgl_mulaitag` date NOT NULL,
  `tgl_selesaitag` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `sys_periode` */

insert  into `sys_periode`(`kde_kantor`,`tgl_aktif`,`tgl_hariini`,`tgl_mulaitag`,`tgl_selesaitag`) values ('001','2020-01-01','2020-03-31','2023-05-11','2023-06-10');

/*Table structure for table `sys_perush` */

DROP TABLE IF EXISTS `sys_perush`;

CREATE TABLE `sys_perush` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kde_wilayah` varchar(4) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'id order',
  `kde_kantor` char(3) COLLATE latin1_general_ci DEFAULT NULL,
  `nma_perush` varchar(255) COLLATE latin1_general_ci DEFAULT '',
  `nma_cabang` varchar(30) COLLATE latin1_general_ci DEFAULT '0',
  `alm_perush` varchar(255) COLLATE latin1_general_ci DEFAULT '',
  `kta_perush` varchar(25) COLLATE latin1_general_ci DEFAULT '',
  `tlp_perush` varchar(20) COLLATE latin1_general_ci DEFAULT '',
  `eml_perush` varchar(35) COLLATE latin1_general_ci DEFAULT '',
  `website` varchar(70) COLLATE latin1_general_ci DEFAULT '',
  `paket` double DEFAULT 1,
  `sn` varchar(30) COLLATE latin1_general_ci DEFAULT '',
  `notification` int(1) DEFAULT 0,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `sys_perush` */

insert  into `sys_perush`(`id`,`kde_wilayah`,`kde_kantor`,`nma_perush`,`nma_cabang`,`alm_perush`,`kta_perush`,`tlp_perush`,`eml_perush`,`website`,`paket`,`sn`,`notification`,`updated_at`,`created_at`) values (1,'3326','001','KOPERASI KARYAWAN UNTUNG BARENG','JAKARTA','Jl. Paletehan No.38, RT.2/RW.1, Melawai, Kec. Kby Baru, Jakarta Selatan','DKI Jakarta','(021) 7223157','admin@koperasiuntungbareng.com','www.koperasiuntungbareng.com',1,'',0,'2023-04-10 15:53:39','0000-00-00 00:00:00');

/*Table structure for table `sys_rekapshu` */

DROP TABLE IF EXISTS `sys_rekapshu`;

CREATE TABLE `sys_rekapshu` (
  `tahun` double NOT NULL DEFAULT 0,
  `no` double NOT NULL DEFAULT 0,
  `poin` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `persen` double(5,2) NOT NULL DEFAULT 0.00,
  `perolehan` double(15,2) NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `sys_rekapshu` */

/*Table structure for table `sys_setshu` */

DROP TABLE IF EXISTS `sys_setshu`;

CREATE TABLE `sys_setshu` (
  `no` double NOT NULL,
  `nama` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `persen` double(5,2) NOT NULL,
  `akun` varchar(14) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `sys_setshu` */

insert  into `sys_setshu`(`no`,`nama`,`persen`,`akun`) values (1,'Jasa Simpanan',20.00,''),(2,'Jasa Pinjaman',25.00,''),(3,'Dana Cadangan',55.00,'001203');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Anggota') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Anggota',
  `department` enum('CFO','HR','USP','UJB','ADMIN','AGT') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`role`,`department`,`phone`,`remember_token`,`created_at`,`updated_at`) values (1,'Administrator','admin@gmail.com','$2y$10$RkGeuJKhWuzsBGsbiDhI5OyxfEl7PzFWAS7Mxutd7jF9j1q/0HniS','Admin','ADMIN','','XAh9Jt3ejzWI5SgwS0gg0Y2rEozwcTZDgYScP0F699LEAZjmDioq7IN7lgZl','2023-03-27 11:57:50','2023-06-13 22:48:29'),(39,'HR','hr@pincgroup.id','$2y$10$RkGeuJKhWuzsBGsbiDhI5OyxfEl7PzFWAS7Mxutd7jF9j1q/0HniS','Admin','HR',NULL,NULL,NULL,NULL),(63,'Isam','isam@gmail.com','$2y$10$kmuCMlfyfiiRhe61JBo1xe5G8DPxKBxMospo/guc7E/jVd38jy2Mm','Admin','USP',NULL,NULL,'2023-07-22 03:59:12','2023-07-22 03:59:12'),(62,'Adi','adi@pincgroup.id','$2y$10$TC5chCqJcFhrcnVTS06CP.jGD9tik9RnFy0cVe.dGrcrYR9Msv6Tq','Anggota','AGT',NULL,'hAGm3eVSRDNYs3wk99SaE13ZRXDwlBdtodJ49t5rQEGmAB05GVk1Z3gu3b5R',NULL,NULL),(60,'CFO','cfo@pincgroup.id','$2y$10$RkGeuJKhWuzsBGsbiDhI5OyxfEl7PzFWAS7Mxutd7jF9j1q/0HniS','Admin','CFO',NULL,NULL,NULL,NULL),(61,'Pandega','pandega@pincgroup.id','$2y$10$TC5chCqJcFhrcnVTS06CP.jGD9tik9RnFy0cVe.dGrcrYR9Msv6Tq','Anggota','AGT',NULL,NULL,'2023-07-17 16:18:39','2023-07-17 16:18:39');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
