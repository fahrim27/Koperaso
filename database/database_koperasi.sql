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
/*Table structure for table `akt_arsipshu` */

DROP TABLE IF EXISTS `akt_arsipshu`;

CREATE TABLE `akt_arsipshu` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `shu` double(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `akt_arsipshu` */

insert  into `akt_arsipshu`(`id`,`tanggal`,`shu`,`created_at`,`updated_at`) values (1,'2023-01-31',2500000.00,'2023-05-22 15:43:19','2023-05-22 15:43:19'),(2,'2023-02-28',5750000.00,'2023-05-22 15:43:25','2023-05-22 15:43:25'),(3,'2023-03-31',4500000.00,'2023-05-22 15:43:31','2023-05-22 15:43:31'),(4,'2023-04-30',7000000.00,'2023-05-22 15:43:37','2023-05-22 15:43:37'),(5,'2023-05-31',5250000.00,'2023-06-07 11:06:43','2023-06-07 11:06:43');

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

/*Data for the table `akt_mutasi` */

insert  into `akt_mutasi`(`id`,`tanggal`,`no_bukti`,`kde_akun`,`keterangan`,`debet`,`kredit`,`jns_mutasi`,`user_id`,`created_at`,`updated_at`) values (5,'2023-05-11','012305110003','00110201','Modal Awal',100000000.00,0.00,'NonKas',1,'2023-05-11 10:26:39','2023-05-11 10:26:39'),(6,'2023-05-11','012305110003','00120204','Modal Awal',0.00,100000000.00,'NonKas',1,'2023-05-11 10:26:39','2023-05-11 10:26:39'),(7,'2023-05-11','012305110004','001101','Tarik Tunai Bank',50000000.00,0.00,'MutasiKas',1,'2023-05-11 10:45:22','2023-05-11 10:45:22'),(8,'2023-05-11','012305110004','00110201','Tarik Tunai Bank',0.00,50000000.00,'MutasiKas',1,'2023-05-11 10:45:22','2023-05-11 10:45:22'),(41,'2023-05-24','012305240002','001101','Setoran Simpanan Wajib A.n Adi Purwanto',150000.00,0.00,'Simpanan',1,'2023-05-24 13:34:22','2023-05-24 13:34:22'),(42,'2023-05-24','012305240002','00120202','Setoran Simpanan Wajib A.n Adi Purwanto',0.00,150000.00,'Simpanan',1,'2023-05-24 13:34:22','2023-05-24 13:34:22'),(43,'2023-05-24','012305240003','001101','Setoran Simpanan Pokok A.n Adi Purwanto',100000.00,0.00,'Simpanan',1,'2023-05-24 15:08:11','2023-05-24 15:08:11'),(44,'2023-05-24','012305240003','00120201','Setoran Simpanan Pokok A.n Adi Purwanto',0.00,100000.00,'Simpanan',1,'2023-05-24 15:08:11','2023-05-24 15:08:11'),(45,'2023-05-24','012305240004','00110301','Pencairan Pinjaman A.n Adi Purwanto',10000000.00,0.00,'Pencairan',1,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(46,'2023-05-24','012305240004','001101','Pencairan Pinjaman A.n Adi Purwanto',0.00,10000000.00,'Pencairan',1,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(47,'2023-05-24','012305240004','001101','Pendptan Adm Pinjaman A.n Adi Purwanto',50000.00,0.00,'AdmPencairan',1,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(48,'2023-05-24','012305240004','00140102','Pendptan Adm Pinjaman A.n Adi Purwanto',0.00,50000.00,'AdmPencairan',1,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(49,'2023-05-24','012305240005','00110302','Pencairan Pinjaman A.n Adi Purwanto',21000000.00,0.00,'Pencairan',1,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(50,'2023-05-24','012305240005','001101','Pencairan Pinjaman A.n Adi Purwanto',0.00,21000000.00,'Pencairan',1,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(51,'2023-05-24','012305240005','001101','Pendptan Adm Pinjaman A.n Adi Purwanto',0.00,0.00,'AdmPencairan',1,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(52,'2023-05-24','012305240005','00140103','Pendptan Adm Pinjaman A.n Adi Purwanto',0.00,0.00,'AdmPencairan',1,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(53,'2023-06-07','012306070001','001101','Angsuran Pinjaman A.n Adi Purwanto',868333.00,0.00,'Angsuran',1,'2023-06-07 10:28:12','2023-06-07 10:28:12'),(54,'2023-06-07','012306070001','00110301','Angsuran Pinjaman A.n Adi Purwanto',0.00,833333.00,'Angsuran',1,'2023-06-07 10:28:12','2023-06-07 10:28:12'),(55,'2023-06-07','012306070001','00140101','Angsuran Pinjaman A.n Adi Purwanto',0.00,35000.00,'Angsuran',1,'2023-06-07 10:28:12','2023-06-07 10:28:12'),(56,'2023-06-07','012306070002','001101','Lain lain',1000000.00,0.00,'MutasiKas',1,'2023-06-07 10:29:16','2023-06-07 10:29:16'),(57,'2023-06-07','012306070002','001402','Lain lain',0.00,1000000.00,'MutasiKas',1,'2023-06-07 10:29:16','2023-06-07 10:29:16');

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

/*Data for the table `akt_mutasirev` */

insert  into `akt_mutasirev`(`id`,`tanggal`,`no_bukti`,`kde_akun`,`keterangan`,`debet`,`kredit`,`jns_mutasi`,`user_id`,`created_at`,`updated_at`) values (39,'2023-05-24','012305240001','001101','Setoran Simpanan Pokok A.n Adi Purwanto',100000.00,0.00,'Simpanan',1,'2023-05-24 13:18:57','2023-05-24 13:18:57'),(40,'2023-05-24','012305240001','00120201','Setoran Simpanan Pokok A.n Adi Purwanto',0.00,100000.00,'Simpanan',1,'2023-05-24 13:18:57','2023-05-24 13:18:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

/*Data for the table `chart_account` */

insert  into `chart_account`(`id`,`jenis`,`kde_akun`,`nma_akun`,`pos_akun`,`saldo_awal`,`debet`,`kredit`,`saldo_akhir`,`created_at`,`updated_at`) values (1,'Aktiva','001101','KAS',1,0.00,0.00,0.00,1868333.00,'2023-05-03 00:53:38','2023-06-07 10:29:19'),(2,'Aktiva','001102','BANK',1,0.00,0.00,0.00,0.00,'2023-05-03 00:53:48','2023-05-03 00:53:48'),(3,'Aktiva','00110201','  Bank BCA',2,0.00,0.00,0.00,0.00,'2023-05-03 00:53:57','2023-06-05 05:57:46'),(4,'Aktiva','001103','PINJAMAN',1,0.00,0.00,0.00,0.00,'2023-05-03 00:55:44','2023-05-03 00:55:44'),(5,'Aktiva','00110301','  Pinjaman Anggota',2,0.00,0.00,0.00,-833333.00,'2023-05-03 00:55:54','2023-06-07 10:28:18'),(6,'Aktiva','001104','PERSEDIAAN',1,0.00,0.00,0.00,0.00,'2023-05-03 00:56:37','2023-05-03 00:56:37'),(7,'Aktiva','00110401','  Persediaan Barang',2,0.00,0.00,0.00,0.00,'2023-05-03 00:56:47','2023-05-03 00:56:47'),(8,'Aktiva','001105','INVENTARIS',1,0.00,0.00,0.00,0.00,'2023-05-03 00:57:15','2023-05-03 00:57:15'),(9,'Aktiva','00110501','  Tanah',2,0.00,0.00,0.00,0.00,'2023-05-03 00:57:30','2023-05-03 00:57:30'),(10,'Aktiva','00110502','  Bangunan',2,0.00,0.00,0.00,0.00,'2023-05-03 00:57:37','2023-05-03 00:57:37'),(12,'Pasiva','00120203','  Simpanan Sukarela',2,0.00,0.00,0.00,0.00,'2023-05-03 00:58:53','2023-05-11 10:44:44'),(13,'Pasiva','001202','MODAL',1,0.00,0.00,0.00,0.00,'2023-05-03 00:59:43','2023-05-03 00:59:43'),(14,'Pasiva','00120201','  Simpanan Pokok',2,0.00,0.00,0.00,0.00,'2023-05-03 00:59:54','2023-06-05 05:57:46'),(15,'Pasiva','00120202','  Simpanan Wajib',2,0.00,0.00,0.00,0.00,'2023-05-03 01:00:02','2023-06-05 05:57:46'),(16,'Pasiva','00120204','  Modal Penyertaan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:10:28','2023-06-05 05:57:46'),(18,'Pasiva','001203','DANA CADANGAN',1,0.00,0.00,0.00,0.00,'2023-05-03 01:15:09','2023-05-03 01:15:09'),(19,'Pasiva','001204','SISA HASIL USAHA',1,0.00,0.00,0.00,0.00,'2023-05-03 01:17:47','2023-05-03 01:17:47'),(20,'Pasiva','00120401','  SHU Tahun Berjalan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:18:04','2023-05-03 01:18:04'),(21,'Pasiva','00120402','  SHU Tahun Lalu',2,0.00,0.00,0.00,0.00,'2023-05-03 01:18:12','2023-05-03 01:18:12'),(22,'Pendapatan','001401','PENDAPATAN OPERASIONAL UTAMA',1,0.00,0.00,0.00,0.00,'2023-05-03 01:18:35','2023-05-03 01:18:35'),(23,'Pendapatan','00140101','  Pendapatan Jasa/Bunga Pinjaman Anggota',2,0.00,0.00,0.00,35000.00,'2023-05-03 01:19:49','2023-06-07 10:28:18'),(24,'Pendapatan','00140103','  Pendapatan Adm Pinjaman',2,0.00,0.00,0.00,0.00,'2023-05-03 01:19:57','2023-05-24 13:07:58'),(25,'Pendapatan','00140104','  Pendapatan Adm Simpanan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:20:12','2023-05-03 01:20:12'),(26,'Pendapatan','00140105','  Pendapatan Provisi',2,0.00,0.00,0.00,0.00,'2023-05-03 01:20:22','2023-05-03 01:20:22'),(27,'Pendapatan','00140106','  Pendapatan Notariel',2,0.00,0.00,0.00,0.00,'2023-05-03 01:20:39','2023-05-03 01:20:39'),(28,'Pendapatan','001402','PENDAPATAN NON OPERASIONAL',1,0.00,0.00,0.00,1000000.00,'2023-05-03 01:21:08','2023-06-07 10:29:19'),(29,'Pendapatan','00140201','  Pendapatan Jasa/Bunga Bank',2,0.00,0.00,0.00,0.00,'2023-05-03 01:21:18','2023-05-03 01:21:18'),(30,'Pendapatan','00140202','  Pendapatan Sewa',2,0.00,0.00,0.00,0.00,'2023-05-03 01:21:25','2023-05-03 01:21:25'),(31,'Pendapatan','00140107','  Pendapatan Materai',2,0.00,0.00,0.00,0.00,'2023-05-03 01:22:35','2023-05-03 01:22:35'),(32,'Biaya','001501','BIAYA OPERASIONAL',1,0.00,0.00,0.00,0.00,'2023-05-03 01:23:57','2023-05-03 01:23:57'),(33,'Biaya','00150101','  Biaya Tenaga Kerja',2,0.00,0.00,0.00,0.00,'2023-05-03 01:24:18','2023-05-03 01:24:18'),(34,'Biaya','00150102','  Biaya Pengurus dan Pengawas',2,0.00,0.00,0.00,0.00,'2023-05-03 01:24:35','2023-05-03 01:24:35'),(35,'Biaya','00150103','  Biaya Konsumsi',2,0.00,0.00,0.00,0.00,'2023-05-03 01:24:57','2023-05-11 10:44:44'),(36,'Biaya','00150104','  Biaya Perkoperasian',2,0.00,0.00,0.00,0.00,'2023-05-03 01:25:07','2023-05-03 01:25:07'),(37,'Biaya','00150105','  Biaya Listrik, Air, Telpon',2,0.00,0.00,0.00,0.00,'2023-05-03 01:25:29','2023-05-03 01:25:29'),(38,'Biaya','00150106','  Biaya Alat Tulis Kantor',2,0.00,0.00,0.00,0.00,'2023-05-03 01:25:49','2023-05-03 01:25:49'),(39,'Biaya','00150107','  Biaya Sumbangan / Sosial',2,0.00,0.00,0.00,0.00,'2023-05-03 01:26:13','2023-05-03 01:26:13'),(40,'Biaya','00150108','  Biaya RAT',2,0.00,0.00,0.00,0.00,'2023-05-03 01:26:26','2023-05-03 01:26:26'),(41,'Biaya','00150109','  Biaya Transport',2,0.00,0.00,0.00,0.00,'2023-05-03 01:27:03','2023-05-03 01:27:03'),(42,'Biaya','00150110','  Biaya Keamanan dan Kebersihan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:27:19','2023-05-03 01:27:19'),(43,'Biaya','001502','BIAYA NON OPERASIONAL',1,0.00,0.00,0.00,0.00,'2023-05-03 01:28:00','2023-05-03 01:28:00'),(44,'Biaya','00150201','  Biaya Adm Bank',2,0.00,0.00,0.00,0.00,'2023-05-03 01:28:22','2023-05-03 01:28:22'),(45,'Biaya','00150202','  Biaya Pajak Bank',2,0.00,0.00,0.00,0.00,'2023-05-03 01:28:35','2023-05-03 01:28:35'),(46,'Aktiva','00110302','  Cicilan Barang',2,0.00,0.00,0.00,0.00,'2023-05-24 12:51:46','2023-06-05 05:57:46'),(47,'Pendapatan','00140102','  Pendapatan Jasa/Bunga Cicilan Barang',2,0.00,0.00,0.00,0.00,'2023-05-24 12:52:53','2023-06-05 05:57:46');

/*Table structure for table `jb_order` */

DROP TABLE IF EXISTS `jb_order`;

CREATE TABLE `jb_order` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_trx` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `id_produk` bigint(11) NOT NULL,
  `hpp` double(15,2) NOT NULL DEFAULT 0.00,
  `harga` double(15,2) NOT NULL DEFAULT 0.00,
  `qty` int(5) NOT NULL DEFAULT 0,
  `jangka` int(3) NOT NULL DEFAULT 12,
  `pembayaran` enum('Cicilan','Bayar Penuh') NOT NULL DEFAULT 'Cicilan',
  `notes` varchar(255) NOT NULL DEFAULT '',
  `ket_batal` varchar(255) NOT NULL DEFAULT '',
  `status_order` enum('Dibatalkan','Menunggu Konfirmasi','Diproses','Siap Diambil','Selesai') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jb_order` */

insert  into `jb_order`(`id`,`no_trx`,`tanggal`,`id_anggota`,`id_produk`,`hpp`,`harga`,`qty`,`jangka`,`pembayaran`,`notes`,`ket_batal`,`status_order`,`created_at`,`updated_at`) values (1,'T012305240001','2023-05-24',1,1,19500000.00,21000000.00,1,12,'Cicilan','','','Selesai','2023-05-24 15:40:02','2023-05-25 06:10:31'),(2,'T012306090001','2023-06-09',1,4,17850000.00,19000000.00,1,12,'Cicilan','','','Menunggu Konfirmasi','2023-06-09 15:21:07','2023-06-09 15:21:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_anggota` */

insert  into `ms_anggota`(`id`,`user_id`,`no_anggota`,`nik`,`nama_anggota`,`email`,`id_perusahaan`,`no_ktp`,`id_department`,`tempat_lahir`,`tgl_lahir`,`no_telpon`,`kontak_darurat`,`jenis_kelamin`,`status_karyawan`,`no_rekening`,`id_jabatan`,`foto_ktp`,`alamat`,`alamat_domisili`,`status_keanggotaan`,`created_at`,`updated_at`) values (1,18,'PNC0001','220184','Adi Purwanto','adi@pincgroup.id',1,'337500000',24,'Pekalongan','1993-07-14','0813555',NULL,'Laki-laki','Permanen','3435555',2,'1684909038236-img_ktp.png','Jl. Gajah Mada No. 4','Jl. Palem V','Aktif','2023-05-24 13:17:18','2023-05-26 13:55:46'),(2,20,'PNC0002','220122','Adi 2','adi.vfp9@gmail.com',1,'33337',24,'Pekalongan','1993-07-14','0808','897877','Laki-laki','Permanen','32323',2,'1686417592928-img_ktp.png','POncol','Jakarta','Menunggu','2023-06-11 00:19:53','2023-06-11 00:19:53'),(3,21,'TGG0001','21086','Ali','adi.vfp9@gmail.com',6,'333',24,'Pekalongan','1992-07-14','323','2323','Laki-laki','Kontrak','3243',2,'1686565465505-img_ktp.png','Jakarta','Jakarta','Menunggu','2023-06-12 17:24:25','2023-06-12 17:24:25'),(6,24,'PMA0001','111','A','a@mail.com',3,'1',13,'a','1111-11-11','1','1','Perempuan','Permanen','233',2,'1686566439454-img_ktp.png','ww','qqq','Menunggu','2023-06-12 17:40:39','2023-06-12 17:40:39');

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

insert  into `ms_kategori`(`id`,`kategori`,`created_at`,`updated_at`) values (1,'Sembako','2023-05-11 15:01:16','2023-05-11 15:01:16'),(2,'Gadget & Elektronik','2023-05-11 15:01:23','2023-05-11 15:01:23'),(3,'Furniture','2023-05-11 15:01:33','2023-05-11 15:01:33'),(4,'Kendaraan Bermotor','2023-05-11 15:01:38','2023-05-11 15:01:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_produk` */

insert  into `ms_produk`(`id`,`id_kategori`,`nama_barang`,`deskripsi`,`harga_beli`,`harga_jual`,`status`,`estimasi`,`cicilan`,`bayar_penuh`,`foto`,`created_at`,`updated_at`) values (1,2,'Macbook Pro M1','Macbook',19500000.00,21000000.00,'PreOrder',6,'Y','Y','1683877988685-QROsG0gbqAE8BIplZo6H2exI5WvJHs3t3TPae001.jpeg','2023-05-12 14:53:08','2023-05-12 14:53:08'),(3,3,'Meja Kerja L','meja kerja ukuran Large',2450000.00,2780000.00,'Ready Stock',0,'Y','N','1683884935885-Merk-Meja-Kantor-Terbaik.jpg','2023-05-12 16:48:55','2023-05-14 00:08:46'),(4,4,'Honda Beat Deluxe','Honda Beat',17850000.00,19000000.00,'PreOrder',12,'Y','N','1684727235929-deluxe-green-3-01022023-085857.jpg','2023-05-19 23:15:44','2023-05-22 10:47:15'),(5,2,'IPhone 14 Pro','Iphone 14 Pro 512GB',18900000.00,20000000.00,'PreOrder',6,'Y','Y','1685338992211-Iphone.jpg','2023-05-29 12:43:12','2023-05-29 12:43:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_jadwal` */

insert  into `pby_jadwal`(`id`,`id_norek`,`tanggal`,`angske`,`angs_pokok`,`angs_jasa`,`status`,`user_id`,`created_at`,`updated_at`) values (1,1,'2023-06-24',1,833333.00,35000.00,'OK',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(2,1,'2023-07-24',2,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(3,1,'2023-08-24',3,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(4,1,'2023-09-24',4,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(5,1,'2023-10-24',5,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(6,1,'2023-11-24',6,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(7,1,'2023-12-24',7,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(8,1,'2024-01-24',8,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(9,1,'2024-02-24',9,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(10,1,'2024-03-24',10,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(11,1,'2024-04-24',11,833333.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(12,1,'2024-05-24',12,833337.00,35000.00,'',0,'2023-05-24 15:32:07','2023-05-24 15:32:07'),(13,2,'2023-06-24',1,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(14,2,'2023-07-24',2,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(15,2,'2023-08-24',3,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(16,2,'2023-09-24',4,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(17,2,'2023-10-24',5,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(18,2,'2023-11-24',6,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(19,2,'2023-12-24',7,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(20,2,'2024-01-24',8,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(21,2,'2024-02-24',9,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(22,2,'2024-03-24',10,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(23,2,'2024-04-24',11,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31'),(24,2,'2024-05-24',12,1750000.00,0.00,'',0,'2023-05-24 15:54:31','2023-05-24 15:54:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_master` */

insert  into `pby_master`(`id`,`kode`,`nama`,`akun_produk`,`akun_jasa`,`akun_adm`,`bya_adm`,`persen_jasa`,`jenis_pinjaman`,`status`,`created_at`,`updated_at`) values (1,'50','Pinjaman Anggota','00110301','00140101','00140102',0.50,0.35,'Tunai','Y','2023-05-04 12:50:28','2023-05-04 12:50:28'),(4,'51','Cicilan Barang','00110302','00140102','00140103',0.00,0.00,'Barang','Y','2023-05-24 12:51:04','2023-05-24 12:51:04');

/*Table structure for table `pby_mutasi` */

DROP TABLE IF EXISTS `pby_mutasi`;

CREATE TABLE `pby_mutasi` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_norek` bigint(11) NOT NULL,
  `no_bukti` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `no_rek` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `angs_pokok` double(15,2) NOT NULL DEFAULT 0.00,
  `angs_jasa` double(15,2) NOT NULL DEFAULT 0.00,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_mutasi` */

insert  into `pby_mutasi`(`id`,`id_norek`,`no_bukti`,`tanggal`,`no_rek`,`keterangan`,`angs_pokok`,`angs_jasa`,`user_id`,`created_at`,`updated_at`) values (1,1,'012306070001','2023-06-07','0015000001','Angsuran Pinjaman A.n Adi Purwanto',833333.00,35000.00,1,'2023-06-07 10:28:12','2023-06-07 10:28:12');

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
  `status_pengajuan` enum('Menunggu Persetujuan','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu Persetujuan',
  `tgl_ubah` date DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_pengajuan` */

insert  into `pby_pengajuan`(`id`,`id_anggota`,`id_order`,`id_pinjaman`,`no_rek`,`no_pengajuan`,`tanggal`,`jenis`,`nominal`,`jangka`,`keperluan`,`jaminan`,`user_id`,`status_pengajuan`,`tgl_ubah`,`keterangan`,`created_at`,`updated_at`) values (2,1,0,1,'0015000001','P012305240001','2023-05-24','Pinjaman Tunai',10000000.00,12,'modal usaha','Tanpa Jaminan',18,'Disetujui','2023-05-24','','2023-05-24 15:13:51','2023-05-24 15:32:07'),(3,1,1,4,'0015100001','P012305240002','2023-05-24','Cicilan Barang',21000000.00,12,'Cicilan Macbook Pro M1','Tanpa Jaminan',18,'Disetujui','2023-05-24','','2023-05-24 15:40:02','2023-05-24 15:54:31'),(4,1,2,4,'','P012306090001','2023-06-09','Cicilan Barang',19000000.00,12,'Cicilan Honda Beat Deluxe','Tanpa Jaminan',18,'Menunggu Persetujuan',NULL,'','2023-06-09 15:21:07','2023-06-09 15:21:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_rekening` */

insert  into `pby_rekening`(`id`,`id_anggota`,`id_pinjaman`,`id_pengajuan`,`no_rek`,`tgl_cair`,`jangka`,`jth_tempo`,`plafond`,`bya_adm`,`angske`,`saldo_awal_pokok_sys`,`saldo_awal_jasa_sys`,`saldo_akhir`,`status`,`user_id`,`created_at`,`updated_at`) values (1,1,1,2,'0015000001','2023-05-24',12,'2024-05-24',10000000.00,50000.00,2,0.00,0.00,9166667.00,'Aktif',1,'2023-05-24 15:32:07','2023-06-07 10:28:12'),(2,1,4,3,'0015100001','2023-05-24',12,'2024-05-24',21000000.00,0.00,1,0.00,0.00,21000000.00,'Aktif',1,'2023-05-24 15:54:31','2023-05-24 15:54:31');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `shu_jasaagt` */

insert  into `shu_jasaagt`(`id`,`id_anggota`,`tanggal`,`no_trx`,`hpp`,`harga_jual`,`nominal`,`created_at`,`updated_at`) values (1,1,'2023-06-07','012306070001',0.00,0.00,35000.00,'2023-06-07 10:28:12','2023-06-07 10:28:12');

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

insert  into `simp_master`(`id`,`kode`,`nama`,`akun_produk`,`akun_jasa`,`persen_jasa`,`modal`,`status`,`created_at`,`updated_at`) values (1,'01','Simpanan Pokok','00120201','',0.00,'Y','Y','2023-05-04 12:50:28','2023-05-04 12:50:28'),(2,'02','Simpanan Wajib','00120202','',0.00,'Y','Y','2023-05-04 12:50:34','2023-05-04 12:50:34'),(3,'03','Simpanan Sukarela','00120203','',0.00,'N','Y','2023-05-04 12:50:47','2023-05-04 12:50:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `simp_mutasi` */

insert  into `simp_mutasi`(`id`,`id_norek`,`no_bukti`,`tanggal`,`no_rek`,`keterangan`,`debet`,`kredit`,`user_id`,`created_at`,`updated_at`) values (2,2,'012305240002','2023-05-24','0010200001','Setoran Simpanan Wajib A.n Adi Purwanto',0.00,150000.00,1,'2023-05-24 13:34:22','2023-05-24 13:34:22'),(3,1,'012305240003','2023-05-24','0010100001','Setoran Simpanan Pokok A.n Adi Purwanto',0.00,100000.00,1,'2023-05-24 15:08:11','2023-05-24 15:08:11');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `simp_rekening` */

insert  into `simp_rekening`(`id`,`id_anggota`,`id_simpanan`,`no_rek`,`tgl_buka`,`tgl_tutup`,`jasa_persen`,`status_aktif`,`status_blokir`,`saldo_awal_sys`,`saldo_akhir`,`user_id`,`created_at`,`updated_at`) values (1,1,1,'0010100001','2023-05-24',NULL,0.00,'Y','N',0.00,100000.00,18,'2023-05-24 13:17:33','2023-05-24 15:07:42'),(2,1,2,'0010200001','2023-05-24',NULL,0.00,'Y','N',0.00,150000.00,18,'2023-05-24 13:17:33','2023-05-24 13:17:33');

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
  `posisi` enum('Ketua','Sekretaris','Bendahara') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` tinyblob DEFAULT 'current_timestamp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `sys_pengurus` */

insert  into `sys_pengurus`(`posisi`,`nama`,`email`,`created_at`,`updated_at`) values ('Ketua','Ketua','adi.vfp9@gmail.com','2023-06-11 02:43:23','current_timestamp'),('Sekretaris','Sekretaris','adi.wanted009@gmail.com','2023-06-11 02:43:28','current_timestamp'),('Bendahara','Bendahara','adi@pincgroup.id','2023-06-11 02:43:41','current_timestamp');

/*Table structure for table `sys_periode` */

DROP TABLE IF EXISTS `sys_periode`;

CREATE TABLE `sys_periode` (
  `kde_kantor` char(3) COLLATE latin1_general_ci DEFAULT NULL,
  `tgl_aktif` date DEFAULT NULL,
  `tgl_hariini` date DEFAULT NULL,
  `bagi_hasil_reguler` double DEFAULT NULL,
  `bagi_hasil_berjangka` double DEFAULT NULL,
  `openclose` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `posting_penyusutan` double NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `sys_periode` */

insert  into `sys_periode`(`kde_kantor`,`tgl_aktif`,`tgl_hariini`,`bagi_hasil_reguler`,`bagi_hasil_berjangka`,`openclose`,`posting_penyusutan`) values ('001','2020-01-01','2020-03-31',1,0,'Buka',0);

/*Table structure for table `sys_perush` */

DROP TABLE IF EXISTS `sys_perush`;

CREATE TABLE `sys_perush` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kde_wilayah` varchar(4) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'id order',
  `kde_kantor` char(3) COLLATE latin1_general_ci DEFAULT NULL,
  `nma_perush` varchar(30) COLLATE latin1_general_ci DEFAULT '',
  `nma_cabang` varchar(30) COLLATE latin1_general_ci DEFAULT '0',
  `alm_perush` varchar(50) COLLATE latin1_general_ci DEFAULT '',
  `kta_perush` varchar(25) COLLATE latin1_general_ci DEFAULT '',
  `tlp_perush` varchar(20) COLLATE latin1_general_ci DEFAULT '',
  `eml_perush` varchar(35) COLLATE latin1_general_ci DEFAULT '',
  `slogan` varchar(70) COLLATE latin1_general_ci DEFAULT '',
  `paket` double DEFAULT 1,
  `sn` varchar(30) COLLATE latin1_general_ci DEFAULT '',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `sys_perush` */

insert  into `sys_perush`(`id`,`kde_wilayah`,`kde_kantor`,`nma_perush`,`nma_cabang`,`alm_perush`,`kta_perush`,`tlp_perush`,`eml_perush`,`slogan`,`paket`,`sn`,`updated_at`,`created_at`) values (1,'3326','001','KOPERASI PARAGON UNTUNG BARENG','JAKARTA','Jl. Falatehan I No. 38','Jakarta','',NULL,'',1,'','2023-04-10 15:53:39','0000-00-00 00:00:00');

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

insert  into `sys_setshu`(`no`,`nama`,`persen`,`akun`) values (1,'Jasa Simpanan',20.00,''),(2,'Jasa Pembiayaan',25.00,''),(3,'Dana Cadangan',55.00,'001203');

/*Table structure for table `sys_settfas` */

DROP TABLE IF EXISTS `sys_settfas`;

CREATE TABLE `sys_settfas` (
  `no_reklama` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `sys_settfas` */

insert  into `sys_settfas`(`no_reklama`) values (1);

/*Table structure for table `tabungan` */

DROP TABLE IF EXISTS `tabungan`;

CREATE TABLE `tabungan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `anggota_id` int(10) unsigned NOT NULL,
  `saldo` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tabungan_anggota_id_foreign` (`anggota_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tabungan` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Anggota') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Anggota',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`role`,`phone`,`remember_token`,`created_at`,`updated_at`) values (1,'Administrator','admin@gmail.com','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm','Admin','','tvtvQhp3OX6dcDxCKZvy4djs8sodS1rpSqknDdtI07f0KK2VNv4vmdgSqfiE','2023-03-27 11:57:50','2023-03-27 11:57:50'),(24,'A','a@mail.com','$2y$10$LTBCL/oU7T/ARm8BRbDN6OS7rOA3m7p0a7fsRxBbVq.FO5XXoJb0a','Anggota',NULL,NULL,'2023-06-12 17:40:39','2023-06-12 17:40:39'),(21,'Ali','adi.vfp9@gmail.com','$2y$10$o.4vfG2nHKTbcH4mmsSzjuDb2BU7JVSbRFmuFQ9fnNrMLzmzk1Kbu','Anggota',NULL,NULL,'2023-06-12 17:24:25','2023-06-12 17:24:25'),(20,'Adi 2','adi.vp9@gmail.com','$2y$10$eanRZRPLOF0tgqY6DBf5QONH/Rlo6gIOe83rMcOa0lmhWZIR2w2Vy','Anggota',NULL,NULL,'2023-06-11 00:19:53','2023-06-11 00:19:53'),(18,'Adi Purwanto','adi@pincgroup.id','$2y$10$cKICtnd5.ofm1m9hXa8uf.Ty2LrP2wsyAbKx6bVq4MIzjwPLVg0r2','Anggota',NULL,'sHu5CY390YlkaK1YD8MEaPl8FIZpPGfgYd6AHFQ0R4qxNXmIjknIkePE2Laf','2023-05-24 13:17:18','2023-05-24 13:17:18'),(19,'Admin 2','admin2@gmail.com','$2y$10$bfpx68T9DRygPfpfVeDMb./nJbO0CIwVPYjOZZ..9DF6ArW7.4FI2','Admin',NULL,NULL,'2023-05-29 15:32:39','2023-05-29 15:32:39');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
