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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `agt_transaksi` */

insert  into `agt_transaksi`(`id`,`tanggal`,`id_anggota`,`id_norek`,`nominal`,`jenis`,`keterangan`,`lampiran`,`status`,`created_at`,`updated_at`) values (2,'2023-07-10',14,8,1500000.00,'Setoran','setoran','1688964755096-bukti_trf.png','Menunggu Konfirmasi','2023-07-10 11:52:35','2023-07-10 11:52:35');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

/*Data for the table `akt_mutasi` */

insert  into `akt_mutasi`(`id`,`tanggal`,`no_bukti`,`kde_akun`,`keterangan`,`debet`,`kredit`,`jns_mutasi`,`user_id`,`created_at`,`updated_at`) values (1,'2023-06-26','012306260001','001101','Setoran Simpanan Pokok A.n Adi Purwanto',100000.00,0.00,'Simpanan',1,'2023-06-26 10:30:54','2023-06-26 10:30:54'),(2,'2023-06-26','012306260001','00120201','Setoran Simpanan Pokok A.n Adi Purwanto',0.00,100000.00,'Simpanan',1,'2023-06-26 10:30:54','2023-06-26 10:30:54'),(3,'2023-06-26','012306260002','001101','Setoran Simpanan Pokok A.n Pandega',100000.00,0.00,'Simpanan',1,'2023-06-26 10:31:04','2023-06-26 10:31:04'),(4,'2023-06-26','012306260002','00120201','Setoran Simpanan Pokok A.n Pandega',0.00,100000.00,'Simpanan',1,'2023-06-26 10:31:04','2023-06-26 10:31:04'),(5,'2023-06-26','012306260003','001101','Setoran Simpanan Pokok A.n M. Ali Akbar',100000.00,0.00,'Simpanan',1,'2023-06-26 10:31:35','2023-06-26 10:31:35'),(6,'2023-06-26','012306260003','00120201','Setoran Simpanan Pokok A.n M. Ali Akbar',0.00,100000.00,'Simpanan',1,'2023-06-26 10:31:35','2023-06-26 10:31:35'),(7,'2023-06-26','012306260004','001101','Setoran Simpanan Wajib A.n Adi Purwanto',6100000.00,0.00,'Simpanan',1,'2023-06-26 10:32:39','2023-06-26 10:32:39'),(8,'2023-06-26','012306260004','00120202','Setoran Simpanan Wajib A.n Adi Purwanto',0.00,6100000.00,'Simpanan',1,'2023-06-26 10:32:39','2023-06-26 10:32:39'),(9,'2023-06-26','012306260005','001101','Setoran Simpanan Wajib A.n Pandega',6100000.00,0.00,'Simpanan',1,'2023-06-26 10:32:49','2023-06-26 10:32:49'),(10,'2023-06-26','012306260005','00120202','Setoran Simpanan Wajib A.n Pandega',0.00,6100000.00,'Simpanan',1,'2023-06-26 10:32:49','2023-06-26 10:32:49'),(11,'2023-06-26','012306260006','001101','Setoran Simpanan Wajib A.n M. Ali Akbar',6100000.00,0.00,'Simpanan',1,'2023-06-26 10:32:59','2023-06-26 10:32:59'),(12,'2023-06-26','012306260006','00120202','Setoran Simpanan Wajib A.n M. Ali Akbar',0.00,6100000.00,'Simpanan',1,'2023-06-26 10:32:59','2023-06-26 10:32:59'),(13,'2023-06-26','012306260007','00110301','Pencairan Pinjaman A.n Adi Purwanto',7000000.00,0.00,'Pencairan',1,'2023-06-26 11:13:12','2023-06-26 11:13:12'),(14,'2023-06-26','012306260007','001101','Pencairan Pinjaman A.n Adi Purwanto',0.00,7000000.00,'Pencairan',1,'2023-06-26 11:13:12','2023-06-26 11:13:12'),(15,'2023-06-26','012306260007','001101','Pendptan Adm Pinjaman A.n Adi Purwanto',35000.00,0.00,'AdmPencairan',1,'2023-06-26 11:13:12','2023-06-26 11:13:12'),(16,'2023-06-26','012306260007','00140102','Pendptan Adm Pinjaman A.n Adi Purwanto',0.00,35000.00,'AdmPencairan',1,'2023-06-26 11:13:12','2023-06-26 11:13:12'),(17,'2023-06-26','012306260008','001101','Angsuran Pinjaman A.n Adi Purwanto',1191167.00,0.00,'Angsuran',1,'2023-06-26 12:02:50','2023-06-26 12:02:50'),(18,'2023-06-26','012306260008','00110301','Angsuran Pinjaman A.n Adi Purwanto',0.00,1166667.00,'Angsuran',1,'2023-06-26 12:02:50','2023-06-26 12:02:50'),(19,'2023-06-26','012306260008','00140101','Angsuran Pinjaman A.n Adi Purwanto',0.00,24500.00,'Angsuran',1,'2023-06-26 12:02:50','2023-06-26 12:02:50'),(20,'2023-06-26','T012306260001','001101','Pendptn Penjualan Barang',330000.00,0.00,'Penjualan',1,'2023-06-26 14:22:52','2023-06-26 14:22:52'),(21,'2023-06-26','T012306260001','00140108','Pendptn Penjualan Barang',0.00,330000.00,'Penjualan',1,'2023-06-26 14:22:52','2023-06-26 14:22:52'),(22,'2023-06-30','012306300001','001101','Setoran Simpanan Sukarela A.n Adi Purwanto',1500000.00,0.00,'Simpanan',1,'2023-06-30 11:49:02','2023-06-30 11:49:02'),(23,'2023-06-30','012306300001','00120203','Setoran Simpanan Sukarela A.n Adi Purwanto',0.00,1500000.00,'Simpanan',1,'2023-06-30 11:49:02','2023-06-30 11:49:02'),(24,'2023-07-05','012307050001','001101','Angsuran Pinjaman A.n Adi Purwanto',1191167.00,0.00,'Angsuran',1,'2023-07-05 15:41:58','2023-07-05 15:41:58'),(25,'2023-07-05','012307050001','00110301','Angsuran Pinjaman A.n Adi Purwanto',0.00,1166667.00,'Angsuran',1,'2023-07-05 15:41:58','2023-07-05 15:41:58'),(26,'2023-07-05','012307050001','00140101','Angsuran Pinjaman A.n Adi Purwanto',0.00,24500.00,'Angsuran',1,'2023-07-05 15:41:58','2023-07-05 15:41:58');

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

insert  into `chart_account`(`id`,`jenis`,`kde_akun`,`nma_akun`,`pos_akun`,`saldo_awal`,`debet`,`kredit`,`saldo_akhir`,`created_at`,`updated_at`) values (1,'Aktiva','001101','KAS',1,0.00,0.00,0.00,1191167.00,'2023-05-03 00:53:38','2023-07-05 15:56:40'),(2,'Aktiva','001102','BANK',1,0.00,0.00,0.00,0.00,'2023-05-03 00:53:48','2023-05-03 00:53:48'),(3,'Aktiva','00110201','  Bank BCA',2,0.00,0.00,0.00,0.00,'2023-05-03 00:53:57','2023-06-05 05:57:46'),(4,'Aktiva','001103','PINJAMAN',1,0.00,0.00,0.00,0.00,'2023-05-03 00:55:44','2023-05-03 00:55:44'),(5,'Aktiva','00110301','  Pinjaman Anggota',2,0.00,0.00,0.00,-1166667.00,'2023-05-03 00:55:54','2023-07-05 15:56:40'),(6,'Aktiva','001104','PERSEDIAAN',1,0.00,0.00,0.00,0.00,'2023-05-03 00:56:37','2023-05-03 00:56:37'),(7,'Aktiva','00110401','  Persediaan Barang',2,0.00,0.00,0.00,0.00,'2023-05-03 00:56:47','2023-05-03 00:56:47'),(8,'Aktiva','001105','INVENTARIS',1,0.00,0.00,0.00,0.00,'2023-05-03 00:57:15','2023-05-03 00:57:15'),(9,'Aktiva','00110501','  Tanah',2,0.00,0.00,0.00,0.00,'2023-05-03 00:57:30','2023-05-03 00:57:30'),(10,'Aktiva','00110502','  Bangunan',2,0.00,0.00,0.00,0.00,'2023-05-03 00:57:37','2023-05-03 00:57:37'),(12,'Pasiva','00120203','  Simpanan Sukarela',2,0.00,0.00,0.00,0.00,'2023-05-03 00:58:53','2023-07-03 15:22:28'),(13,'Pasiva','001202','MODAL',1,0.00,0.00,0.00,0.00,'2023-05-03 00:59:43','2023-05-03 00:59:43'),(14,'Pasiva','00120201','  Simpanan Pokok',2,0.00,0.00,0.00,0.00,'2023-05-03 00:59:54','2023-07-03 15:22:28'),(15,'Pasiva','00120202','  Simpanan Wajib',2,0.00,0.00,0.00,0.00,'2023-05-03 01:00:02','2023-07-03 15:22:28'),(16,'Pasiva','00120204','  Modal Penyertaan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:10:28','2023-06-05 05:57:46'),(18,'Pasiva','001203','DANA CADANGAN',1,0.00,0.00,0.00,0.00,'2023-05-03 01:15:09','2023-05-03 01:15:09'),(19,'Pasiva','001204','SISA HASIL USAHA',1,0.00,0.00,0.00,0.00,'2023-05-03 01:17:47','2023-05-03 01:17:47'),(20,'Pasiva','00120401','  SHU Tahun Berjalan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:18:04','2023-05-03 01:18:04'),(21,'Pasiva','00120402','  SHU Tahun Lalu',2,0.00,0.00,0.00,0.00,'2023-05-03 01:18:12','2023-05-03 01:18:12'),(22,'Pendapatan','001401','PENDAPATAN OPERASIONAL UTAMA',1,0.00,0.00,0.00,0.00,'2023-05-03 01:18:35','2023-05-03 01:18:35'),(23,'Pendapatan','00140101','  Pendapatan Jasa/Bunga Pinjaman Anggota',2,0.00,0.00,0.00,24500.00,'2023-05-03 01:19:49','2023-07-05 15:56:40'),(24,'Pendapatan','00140103','  Pendapatan Adm Pinjaman',2,0.00,0.00,0.00,0.00,'2023-05-03 01:19:57','2023-05-24 13:07:58'),(25,'Pendapatan','00140104','  Pendapatan Adm Simpanan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:20:12','2023-05-03 01:20:12'),(26,'Pendapatan','00140105','  Pendapatan Provisi',2,0.00,0.00,0.00,0.00,'2023-05-03 01:20:22','2023-05-03 01:20:22'),(27,'Pendapatan','00140106','  Pendapatan Notariel',2,0.00,0.00,0.00,0.00,'2023-05-03 01:20:39','2023-05-03 01:20:39'),(28,'Pendapatan','001402','PENDAPATAN NON OPERASIONAL',1,0.00,0.00,0.00,0.00,'2023-05-03 01:21:08','2023-06-13 22:43:29'),(30,'Pendapatan','00140202','  Pendapatan Sewa',2,0.00,0.00,0.00,0.00,'2023-05-03 01:21:25','2023-06-22 16:09:22'),(31,'Pendapatan','00140107','  Pendapatan Materai',2,0.00,0.00,0.00,0.00,'2023-05-03 01:22:35','2023-05-03 01:22:35'),(32,'Biaya','001501','BIAYA OPERASIONAL',1,0.00,0.00,0.00,0.00,'2023-05-03 01:23:57','2023-05-03 01:23:57'),(33,'Biaya','00150101','  Biaya Tenaga Kerja',2,0.00,0.00,0.00,0.00,'2023-05-03 01:24:18','2023-05-03 01:24:18'),(34,'Biaya','00150102','  Biaya Pengurus dan Pengawas',2,0.00,0.00,0.00,0.00,'2023-05-03 01:24:35','2023-05-03 01:24:35'),(35,'Biaya','00150103','  Biaya Konsumsi',2,0.00,0.00,0.00,0.00,'2023-05-03 01:24:57','2023-05-11 10:44:44'),(36,'Biaya','00150104','  Biaya Perkoperasian',2,0.00,0.00,0.00,0.00,'2023-05-03 01:25:07','2023-05-03 01:25:07'),(37,'Biaya','00150105','  Biaya Listrik, Air, Telpon',2,0.00,0.00,0.00,0.00,'2023-05-03 01:25:29','2023-05-03 01:25:29'),(38,'Biaya','00150106','  Biaya Alat Tulis Kantor',2,0.00,0.00,0.00,0.00,'2023-05-03 01:25:49','2023-05-03 01:25:49'),(39,'Biaya','00150107','  Biaya Sumbangan / Sosial',2,0.00,0.00,0.00,0.00,'2023-05-03 01:26:13','2023-05-03 01:26:13'),(40,'Biaya','00150108','  Biaya RAT',2,0.00,0.00,0.00,0.00,'2023-05-03 01:26:26','2023-05-03 01:26:26'),(41,'Biaya','00150109','  Biaya Transport',2,0.00,0.00,0.00,0.00,'2023-05-03 01:27:03','2023-05-03 01:27:03'),(42,'Biaya','00150110','  Biaya Keamanan dan Kebersihan',2,0.00,0.00,0.00,0.00,'2023-05-03 01:27:19','2023-05-03 01:27:19'),(43,'Biaya','001502','BIAYA NON OPERASIONAL',1,0.00,0.00,0.00,0.00,'2023-05-03 01:28:00','2023-05-03 01:28:00'),(44,'Biaya','00150201','  Biaya Adm Bank',2,0.00,0.00,0.00,0.00,'2023-05-03 01:28:22','2023-05-03 01:28:22'),(45,'Biaya','00150202','  Biaya Pajak Bank',2,0.00,0.00,0.00,0.00,'2023-05-03 01:28:35','2023-05-03 01:28:35'),(46,'Aktiva','00110302','  Cicilan Barang',2,0.00,0.00,0.00,0.00,'2023-05-24 12:51:46','2023-06-14 15:57:32'),(47,'Pendapatan','00140102','  Pendapatan Jasa/Bunga Cicilan Barang',2,0.00,0.00,0.00,0.00,'2023-05-24 12:52:53','2023-07-03 15:22:28'),(49,'Pendapatan','00140108','  Pendapatan Penjualan Barang',2,0.00,0.00,0.00,0.00,'2023-06-26 14:20:52','2023-07-03 15:22:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jb_order` */

insert  into `jb_order`(`id`,`no_trx`,`tanggal`,`id_anggota`,`id_produk`,`hpp`,`harga`,`qty`,`jangka`,`pembayaran`,`notes`,`ket_batal`,`status_order`,`created_at`,`updated_at`) values (1,'T012306260001','2023-06-26',14,3,2450000.00,2780000.00,2,12,'Bayar Penuh','','','Selesai','2023-06-26 12:21:15','2023-06-26 14:22:52');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_anggota` */

insert  into `ms_anggota`(`id`,`user_id`,`no_anggota`,`nik`,`nama_anggota`,`email`,`id_perusahaan`,`no_ktp`,`id_department`,`tempat_lahir`,`tgl_lahir`,`no_telpon`,`kontak_darurat`,`jenis_kelamin`,`status_karyawan`,`no_rekening`,`id_jabatan`,`foto_ktp`,`alamat`,`alamat_domisili`,`status_keanggotaan`,`created_at`,`updated_at`) values (13,31,'PNC0001','22087','Adi Purwanto','adi@pincgroup.id',1,'333',24,'PKl','1999-12-07','333','5555','Laki-laki','Permanen','32245',2,'1686733902963-img_ktp.png','Pekalongan','Jakarta','Aktif','2023-06-14 16:11:43','2023-06-26 10:30:34'),(14,32,'PNC0002','122000','Pandega','pandega@pincgroup.id',1,'4454',24,'Jakarta','1990-06-11','222','232323','Laki-laki','Permanen','45555',2,'1687152147593-img_ktp.png','Jakarta','Jakarta','Aktif','2023-06-19 12:22:27','2023-06-26 10:30:38'),(15,33,'PNC0003','22001','M. Ali Akbar','ali@pincgroup.id',1,'34555',24,'Cirebon','1992-12-18','088888','09888877','Laki-laki','Kontrak','345662',2,'1687330410812-img_ktp.png','Depok','Depok','Aktif','2023-06-21 13:53:30','2023-06-26 10:30:41'),(20,38,'PMA0001','230012','Lukman Nul Hakim','lukman@mataangin.agency',3,'655777',26,'Jakarta','1990-12-05','0999','0999','Laki-laki','Permanen','342244',2,'1688717952909-img_ktp.png','Jakarta','Jakarta','Menunggu','2023-07-07 15:19:13','2023-07-07 15:19:13'),(21,40,'PAN0001','2312','Budi','budi@pantarei.id',2,'9',4,'k','2023-07-09','8','8','Laki-laki','Permanen','8',3,'1688842452333-img_ktp.png','8','8','Menunggu','2023-07-09 01:54:12','2023-07-09 01:54:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ms_produk` */

insert  into `ms_produk`(`id`,`id_kategori`,`nama_barang`,`deskripsi`,`harga_beli`,`harga_jual`,`status`,`estimasi`,`cicilan`,`bayar_penuh`,`foto`,`created_at`,`updated_at`) values (1,2,'Macbook Pro M1','Macbook',19500000.00,21000000.00,'PreOrder',6,'Y','Y','1683877988685-QROsG0gbqAE8BIplZo6H2exI5WvJHs3t3TPae001.jpeg','2023-05-12 14:53:08','2023-05-12 14:53:08'),(3,3,'Meja Kerja L','meja kerja ukuran Large',2450000.00,2780000.00,'Ready Stock',0,'Y','Y','1683884935885-Merk-Meja-Kantor-Terbaik.jpg','2023-05-12 16:48:55','2023-05-14 00:08:46'),(4,4,'Honda Beat Deluxe','Honda Beat',17850000.00,19000000.00,'PreOrder',12,'Y','N','1684727235929-deluxe-green-3-01022023-085857.jpg','2023-05-19 23:15:44','2023-06-14 16:20:30'),(5,2,'IPhone 14 Pro','Iphone 14 Pro 512GB',18900000.00,20000000.00,'PreOrder',6,'Y','Y','1685338992211-Iphone.jpg','2023-05-29 12:43:12','2023-05-29 12:43:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_jadwal` */

insert  into `pby_jadwal`(`id`,`id_norek`,`tanggal`,`angske`,`angs_pokok`,`angs_jasa`,`status`,`user_id`,`created_at`,`updated_at`) values (1,1,'2023-07-26',1,1166667.00,24500.00,'',0,'2023-06-26 11:13:12','2023-06-26 11:13:12'),(2,1,'2023-08-26',2,1166667.00,24500.00,'',0,'2023-06-26 11:13:12','2023-06-26 11:13:12'),(3,1,'2023-09-26',3,1166667.00,24500.00,'',0,'2023-06-26 11:13:12','2023-06-26 11:13:12'),(4,1,'2023-10-26',4,1166667.00,24500.00,'',0,'2023-06-26 11:13:12','2023-06-26 11:13:12'),(5,1,'2023-11-26',5,1166667.00,24500.00,'',0,'2023-06-26 11:13:12','2023-06-26 11:13:12'),(6,1,'2023-12-26',6,1166665.00,24500.00,'',0,'2023-06-26 11:13:12','2023-06-26 11:13:12');

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

insert  into `pby_master`(`id`,`kode`,`nama`,`akun_produk`,`akun_jasa`,`akun_adm`,`bya_adm`,`persen_jasa`,`jenis_pinjaman`,`status`,`created_at`,`updated_at`) values (1,'50','Pinjaman Biasa','00110301','00140101','00140102',0.50,0.35,'Tunai','Y','2023-05-04 12:50:28','2023-05-04 12:50:28'),(4,'51','Cicilan Barang','00110302','00140102','00140103',0.00,0.00,'Barang','Y','2023-05-24 12:51:04','2023-05-24 12:51:04'),(6,'53','PInjaman Khusus','00110301','00140101','00140103',0.00,0.50,'Tunai','Y','2023-06-14 12:44:27','2023-06-14 12:44:27');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

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
  `status_pengajuan` enum('Menunggu Persetujuan','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu Persetujuan',
  `tgl_ubah` date DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pby_pengajuan` */

insert  into `pby_pengajuan`(`id`,`id_anggota`,`id_order`,`id_pinjaman`,`no_rek`,`no_pengajuan`,`tanggal`,`jenis`,`nominal`,`jangka`,`keperluan`,`jaminan`,`user_id`,`status_pengajuan`,`tgl_ubah`,`keterangan`,`created_at`,`updated_at`) values (1,13,0,1,'0015000001','P012306260001','2023-06-26','Pinjaman Tunai',7000000.00,6,'modal','Tanpa Jaminan',31,'Disetujui','2023-06-26','','2023-06-26 11:10:35','2023-06-26 11:13:12'),(2,15,0,1,'','P012307100001','2023-07-10','Pinjaman Tunai',10000000.00,12,'modal','Tanpa Jaminan',33,'Menunggu Persetujuan',NULL,'','2023-07-10 01:34:47','2023-07-10 01:34:47');

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

insert  into `pby_rekening`(`id`,`id_anggota`,`id_pinjaman`,`id_pengajuan`,`no_rek`,`tgl_cair`,`jangka`,`jth_tempo`,`plafond`,`bya_adm`,`angske`,`saldo_awal_pokok_sys`,`saldo_awal_jasa_sys`,`saldo_akhir`,`status`,`user_id`,`created_at`,`updated_at`) values (1,13,1,1,'0015000001','2023-06-26',6,'2023-12-26',7000000.00,35000.00,1,0.00,0.00,7000000.00,'Aktif',1,'2023-06-26 11:13:12','2023-07-05 15:56:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `shu_jasaagt` */

insert  into `shu_jasaagt`(`id`,`id_anggota`,`tanggal`,`no_trx`,`hpp`,`harga_jual`,`nominal`,`created_at`,`updated_at`) values (3,14,'2023-06-26','T012306260001',2450000.00,0.00,330000.00,'2023-06-26 14:22:52','2023-06-26 14:22:52');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `simp_mutasi` */

insert  into `simp_mutasi`(`id`,`id_norek`,`no_bukti`,`tanggal`,`no_rek`,`keterangan`,`debet`,`kredit`,`user_id`,`created_at`,`updated_at`) values (1,1,'012306260001','2023-06-26','0010100001','Setoran Simpanan Pokok A.n Adi Purwanto',0.00,100000.00,1,'2023-06-26 10:30:54','2023-06-26 10:30:54'),(2,3,'012306260002','2023-06-26','0010100002','Setoran Simpanan Pokok A.n Pandega',0.00,100000.00,1,'2023-06-26 10:31:04','2023-06-26 10:31:04'),(3,5,'012306260003','2023-06-26','0010100003','Setoran Simpanan Pokok A.n M. Ali Akbar',0.00,100000.00,1,'2023-06-26 10:31:35','2023-06-26 10:31:35'),(4,2,'012306260004','2023-06-26','0010200001','Setoran Simpanan Wajib A.n Adi Purwanto',0.00,6100000.00,1,'2023-06-26 10:32:39','2023-06-26 10:32:39'),(5,4,'012306260005','2023-06-26','0010200002','Setoran Simpanan Wajib A.n Pandega',0.00,6100000.00,1,'2023-06-26 10:32:49','2023-06-26 10:32:49'),(6,6,'012306260006','2023-06-26','0010200003','Setoran Simpanan Wajib A.n M. Ali Akbar',0.00,6100000.00,1,'2023-06-26 10:32:59','2023-06-26 10:32:59'),(7,7,'012306300001','2023-06-30','0010300001','Setoran Simpanan Sukarela A.n Adi Purwanto',0.00,1500000.00,1,'2023-06-30 11:49:02','2023-06-30 11:49:02');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `simp_rekening` */

insert  into `simp_rekening`(`id`,`id_anggota`,`id_simpanan`,`no_rek`,`tgl_buka`,`tgl_tutup`,`jasa_persen`,`status_aktif`,`status_blokir`,`saldo_awal_sys`,`saldo_akhir`,`user_id`,`created_at`,`updated_at`) values (1,13,1,'0010100001','2023-06-26',NULL,0.00,'Y','N',0.00,100000.00,31,'2023-06-26 10:30:34','2023-06-26 10:30:34'),(2,13,2,'0010200001','2023-06-26',NULL,0.00,'Y','N',0.00,6100000.00,31,'2023-06-26 10:30:34','2023-06-26 10:30:34'),(3,14,1,'0010100002','2023-06-26',NULL,0.00,'Y','N',0.00,100000.00,32,'2023-06-26 10:30:38','2023-06-26 10:30:38'),(4,14,2,'0010200002','2023-06-26',NULL,0.00,'Y','N',0.00,6100000.00,32,'2023-06-26 10:30:38','2023-06-26 10:30:38'),(5,15,1,'0010100003','2023-06-26',NULL,0.00,'Y','N',0.00,100000.00,33,'2023-06-26 10:30:41','2023-06-26 10:30:41'),(6,15,2,'0010200003','2023-06-26',NULL,0.00,'Y','N',0.00,6100000.00,33,'2023-06-26 10:30:41','2023-06-26 10:30:41'),(7,13,3,'0010300001','2023-06-30',NULL,0.00,'Y','N',0.00,1500000.00,1,'2023-06-30 11:48:42','2023-06-30 11:48:42'),(8,14,3,'0010300002','2023-07-10',NULL,0.00,'Y','N',0.00,0.00,1,'2023-07-10 11:22:44','2023-07-10 11:22:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sys_notification` */

insert  into `sys_notification`(`id`,`id_anggota`,`id_reksimp`,`id_rekpby`,`id_pengajuan`,`tanggal`,`jenis`,`keterangan`,`role`,`is_read`,`user_id`,`created_at`,`updated_at`) values (1,20,0,0,0,'2023-07-07','Anggota','Mendaftar Sebagai Anggota','Admin',1,1,'2023-07-07 15:19:13','2023-07-08 00:29:48'),(3,21,0,0,0,'2023-07-09','Anggota','Mendaftar Sebagai Anggota','Admin',1,1,'2023-07-09 01:54:12','2023-07-09 01:54:12'),(4,21,0,0,0,'2023-07-09','Anggota','Mendaftar Sebagai Anggota','Admin',0,39,'2023-07-09 01:54:12','2023-07-09 01:54:12'),(5,15,0,0,2,'2023-07-10','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',1,1,'2023-07-10 01:34:47','2023-07-10 01:43:05'),(6,15,0,0,2,'2023-07-10','Pengajuan','Mengajukan Permohonan Pinjaman Biasa','Admin',0,39,'2023-07-10 01:34:47','2023-07-10 01:34:47'),(7,14,8,0,0,'2023-07-10','Setoran','Setoran Simpanan Sukarela A.n Pandega','Admin',1,1,'2023-07-10 11:52:35','2023-07-10 12:05:00'),(8,14,8,0,0,'2023-07-10','Setoran','Setoran Simpanan Sukarela A.n Pandega','Admin',0,39,'2023-07-10 11:52:35','2023-07-10 11:52:35');

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
  `posisi` enum('Ketua','Sekretaris','Bendahara','Jual Beli') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` tinyblob DEFAULT 'current_timestamp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `sys_pengurus` */

insert  into `sys_pengurus`(`posisi`,`nama`,`email`,`created_at`,`updated_at`) values ('Ketua','Ketua','adi@pincgroup.id','2023-06-11 02:43:23','current_timestamp'),('Sekretaris','Sekretaris','it@pincgroup.id','2023-06-11 02:43:28','current_timestamp'),('Bendahara','Bendahara','adi.vfp9@gmail.com','2023-06-11 02:43:41','current_timestamp');

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

insert  into `sys_periode`(`kde_kantor`,`tgl_aktif`,`tgl_hariini`,`tgl_mulaitag`,`tgl_selesaitag`) values ('001','2020-01-01','2020-03-31','2023-05-22','2023-06-21');

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

insert  into `sys_perush`(`id`,`kde_wilayah`,`kde_kantor`,`nma_perush`,`nma_cabang`,`alm_perush`,`kta_perush`,`tlp_perush`,`eml_perush`,`website`,`paket`,`sn`,`notification`,`updated_at`,`created_at`) values (1,'3326','001','KOPERASI KARYAWAN UNTUNG BARENG','JAKARTA','Jl. Paletehan No.38, RT.2/RW.1, Melawai, Kec. Kby Baru, Jakarta Selatan','DKI Jakarta','(021) 7223157','admin@koperasiuntungbareng.com','www.koperasiuntungbareng.com',1,'',1,'2023-04-10 15:53:39','0000-00-00 00:00:00');

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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`role`,`phone`,`remember_token`,`created_at`,`updated_at`) values (1,'Administrator','admin@gmail.com','$2y$10$RkGeuJKhWuzsBGsbiDhI5OyxfEl7PzFWAS7Mxutd7jF9j1q/0HniS','Admin','','oCtXVbxUpG8rHwmwfMahj1A5I7sqqm31VYVzmeMumWXODolmqYzrSq6UaAH7','2023-03-27 11:57:50','2023-06-13 22:48:29'),(39,'Admin 2','admin2@gmail.com','$2y$10$RkGeuJKhWuzsBGsbiDhI5OyxfEl7PzFWAS7Mxutd7jF9j1q/0HniS','Admin',NULL,NULL,NULL,NULL),(40,'ADA','adi@pantarei.id','$2y$10$7WUVi5eNGQkKsTTYtjRiEO4z26PTnCRULrj1i/FCxuCsNVXLM2CvC','Anggota',NULL,NULL,'2023-07-09 01:54:12','2023-07-09 01:54:12'),(38,'Lukman','lukman@mataangin.agency','$2y$10$72QqXCtxYSeN0QTWa5xKaeXR56W5GLtxVGWX79XsafZk740xxRHSW','Anggota',NULL,NULL,'2023-07-07 15:19:13','2023-07-07 15:19:13'),(32,'Pandega','pandega@pincgroup.id','$2y$10$BEr33p/uFZNPUzZlm08QDutAYSkHfM0Jp3UjraBjtgOA4U4VS6RJ6','Anggota',NULL,NULL,'2023-06-19 12:22:27','2023-06-19 12:22:27'),(33,'M. Ali Akbar','ali@pincgroup.id','$2y$10$yrPlFyrRdLFnqRl7Th36HOftdXglmUoE43vXFGIbmHTrQsjf2K8Cy','Anggota',NULL,'AT3yWlfFzzGpmMOzMqvZpE64p2SNM9Ttou4tPw6DfkocRsSCF9IM36Vo6Cmu','2023-06-21 13:53:30','2023-06-21 13:53:30'),(31,'Adi Purwanto','adi@pincgroup.id','$2y$10$ioCKaZPa5mnLBAJQ8Q4dkOietX7C9w56AfgheAA3XGf.jmba/Qa9G','Anggota',NULL,'vI7mH7r8nNyTXqde1W9EouiuoRYZPlLcq7mle5NECRslXkOZuuTpd4grdyx2','2023-06-14 16:11:43','2023-06-14 16:11:43');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
