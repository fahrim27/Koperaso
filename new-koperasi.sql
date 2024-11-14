-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2024 pada 08.51
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agt_cart`
--

CREATE TABLE `agt_cart` (
  `id` bigint(11) NOT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `id_produk` bigint(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT '1',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `tgl_checkout` date DEFAULT NULL,
  `is_checkout` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `agt_transaksi`
--

CREATE TABLE `agt_transaksi` (
  `id` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `id_norek` bigint(11) NOT NULL,
  `nominal` double(15,2) NOT NULL DEFAULT '0.00',
  `jenis` varchar(255) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `lampiran` longtext,
  `status` enum('Menunggu Konfirmasi','Berhasil','Ditolak') DEFAULT 'Menunggu Konfirmasi',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `agt_trx_tiket`
--

CREATE TABLE `agt_trx_tiket` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_trx` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `hpp` double(15,2) NOT NULL DEFAULT '0.00',
  `harga` double(15,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '0',
  `total` double(15,2) NOT NULL DEFAULT '0.00',
  `diskon` double(15,2) NOT NULL DEFAULT '0.00',
  `jangka` int(11) NOT NULL DEFAULT '0',
  `pembayaran` enum('Tunai','Transfer Bank','Bayar Nanti (PG)','Cicilan 3x','Cicilan 6x','Cicilan 12x') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `ket_batal` text COLLATE utf8mb4_unicode_ci,
  `status_order` enum('Menunggu Konfirmasi','Menunggu Pembayaran','Dibatalkan','Diproses','Selesai','Siap Diambil') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akt_arsipshu`
--

CREATE TABLE `akt_arsipshu` (
  `id` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `shu` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akt_finance`
--

CREATE TABLE `akt_finance` (
  `id` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_bukti` varchar(30) NOT NULL DEFAULT '',
  `kde_akun` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `debet` double(15,2) NOT NULL DEFAULT '0.00',
  `kredit` double(15,2) NOT NULL DEFAULT '0.00',
  `jns_mutasi` varchar(35) NOT NULL DEFAULT '',
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akt_finance_rev`
--

CREATE TABLE `akt_finance_rev` (
  `id` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_bukti` varchar(30) NOT NULL DEFAULT '',
  `kde_akun` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `debet` double(15,2) NOT NULL DEFAULT '0.00',
  `kredit` double(15,2) NOT NULL DEFAULT '0.00',
  `jns_mutasi` varchar(35) NOT NULL DEFAULT '',
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akt_mutasi`
--

CREATE TABLE `akt_mutasi` (
  `id` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_bukti` varchar(30) NOT NULL DEFAULT '',
  `kde_akun` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `debet` double(15,2) NOT NULL DEFAULT '0.00',
  `kredit` double(15,2) NOT NULL DEFAULT '0.00',
  `jns_mutasi` varchar(35) NOT NULL DEFAULT '',
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akt_mutasirev`
--

CREATE TABLE `akt_mutasirev` (
  `id` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_bukti` varchar(30) NOT NULL DEFAULT '',
  `kde_akun` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `debet` double(15,2) NOT NULL DEFAULT '0.00',
  `kredit` double(15,2) NOT NULL DEFAULT '0.00',
  `jns_mutasi` varchar(35) NOT NULL DEFAULT '',
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akt_setting`
--

CREATE TABLE `akt_setting` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `akun_kas` varchar(255) NOT NULL DEFAULT '',
  `akun_persediaan` varchar(255) NOT NULL DEFAULT '',
  `shu_thnberjalan` varchar(255) NOT NULL DEFAULT '',
  `shu_thnlalu` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akt_setting`
--

INSERT INTO `akt_setting` (`id`, `akun_kas`, `akun_persediaan`, `shu_thnberjalan`, `shu_thnlalu`, `created_at`, `updated_at`) VALUES
(1, '00110201', '00110401', '00120401', '00120402', '2023-09-04 01:19:22', '2023-09-04 01:19:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chart_account`
--

CREATE TABLE `chart_account` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL DEFAULT '',
  `kde_akun` varchar(15) NOT NULL DEFAULT '',
  `nma_akun` varchar(255) NOT NULL DEFAULT '',
  `pos_akun` int(1) NOT NULL,
  `saldo_awal` double(15,2) NOT NULL DEFAULT '0.00',
  `debet` double(15,2) NOT NULL DEFAULT '0.00',
  `kredit` double(15,2) NOT NULL DEFAULT '0.00',
  `saldo_akhir` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chart_account`
--

INSERT INTO `chart_account` (`id`, `jenis`, `kde_akun`, `nma_akun`, `pos_akun`, `saldo_awal`, `debet`, `kredit`, `saldo_akhir`, `created_at`, `updated_at`) VALUES
(1, 'Aktiva', '001101', 'KAS', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 17:53:38', '2023-09-09 18:21:13'),
(2, 'Aktiva', '001102', 'BANK', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 17:53:48', '2023-05-02 17:53:48'),
(3, 'Aktiva', '00110201', '  Bank BCA', 2, 302466183.75, 65407600.00, 70803600.00, 0.00, '2023-05-02 17:53:57', '2024-11-01 05:26:06'),
(4, 'Aktiva', '001103', 'PINJAMAN', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 17:55:44', '2023-05-02 17:55:44'),
(5, 'Aktiva', '00110301', '  Pinjaman Anggota', 2, 296591981.00, 64842000.00, 37518401.00, 0.00, '2023-05-02 17:55:54', '2024-11-01 05:26:06'),
(6, 'Aktiva', '001104', 'PERSEDIAAN', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 17:56:37', '2023-05-02 17:56:37'),
(7, 'Aktiva', '00110401', '  Persediaan Barang', 2, 16714734.00, 0.00, 4851155.00, 0.00, '2023-05-02 17:56:47', '2024-11-01 05:26:06'),
(8, 'Aktiva', '001105', 'INVENTARIS', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 17:57:15', '2023-05-02 17:57:15'),
(9, 'Aktiva', '00110501', '  Tanah', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 17:57:30', '2023-05-02 17:57:30'),
(10, 'Aktiva', '00110502', '  Bangunan', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 17:57:37', '2023-05-02 17:57:37'),
(12, 'Pasiva', '00120203', '  Simpanan Sukarela', 2, 195202000.00, 0.00, 0.00, 0.00, '2023-05-02 17:58:53', '2024-11-01 01:20:56'),
(13, 'Pasiva', '001202', 'MODAL', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 17:59:43', '2023-05-02 17:59:43'),
(14, 'Pasiva', '00120201', '  Simpanan Pokok', 2, 12900000.00, 300000.00, 0.00, 0.00, '2023-05-02 17:59:54', '2024-11-01 05:26:06'),
(15, 'Pasiva', '00120202', '  Simpanan Wajib', 2, 260650000.00, 3850000.00, 14900000.00, 0.00, '2023-05-02 18:00:02', '2024-11-01 05:26:06'),
(16, 'Pasiva', '00120204', '  Modal Penyertaan', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:10:28', '2023-06-04 22:57:46'),
(18, 'Pasiva', '001203', 'DANA CADANGAN', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:15:09', '2023-05-02 18:15:09'),
(19, 'Pasiva', '001204', 'SISA HASIL USAHA', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:17:47', '2023-05-02 18:17:47'),
(20, 'Pasiva', '00120401', '  SHU Tahun Berjalan', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:18:04', '2024-11-01 05:26:06'),
(21, 'Pasiva', '00120402', '  SHU Tahun Lalu', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:18:12', '2023-05-02 18:18:12'),
(22, 'Pendapatan', '001401', 'PENDAPATAN OPERASIONAL UTAMA', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:18:35', '2023-05-02 18:18:35'),
(23, 'Pendapatan', '00140101', '  Pendapatan Jasa/Bunga Pinjaman Anggota', 2, 4676100.00, 0.00, 782900.00, 0.00, '2023-05-02 18:19:49', '2024-11-01 05:26:06'),
(24, 'Pendapatan', '00140103', '  Pendapatan Adm Pinjaman', 2, 2355710.00, 0.00, 324210.00, 0.00, '2023-05-02 18:19:57', '2024-11-01 05:26:06'),
(25, 'Pendapatan', '00140104', '  Pendapatan Adm Simpanan', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:20:12', '2023-05-02 18:20:12'),
(26, 'Pendapatan', '00140105', '  Pendapatan Provisi', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:20:22', '2023-05-02 18:20:22'),
(27, 'Pendapatan', '00140106', '  Pendapatan Notariel', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:20:39', '2023-05-02 18:20:39'),
(28, 'Pendapatan', '001402', 'PENDAPATAN NON OPERASIONAL', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:21:08', '2023-06-13 15:43:29'),
(30, 'Pendapatan', '00140202', '  Pendapatan Sewa', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:21:25', '2023-06-22 09:09:22'),
(31, 'Pendapatan', '00140107', '  Pendapatan Materai', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:22:35', '2023-05-02 18:22:35'),
(32, 'Biaya', '001501', 'BIAYA OPERASIONAL', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:23:57', '2023-05-02 18:23:57'),
(33, 'Biaya', '00150101', '  Biaya Tenaga Kerja', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:24:18', '2023-05-02 18:24:18'),
(34, 'Biaya', '00150102', '  Biaya Pengurus dan Pengawas', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:24:35', '2023-05-02 18:24:35'),
(35, 'Biaya', '00150103', '  Biaya Konsumsi', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:24:57', '2023-05-11 03:44:44'),
(36, 'Biaya', '00150104', '  Biaya Perkoperasian', 2, 700000.00, 0.00, 0.00, 0.00, '2023-05-02 18:25:07', '2024-10-31 04:21:44'),
(37, 'Biaya', '00150105', '  Biaya Listrik, Air, Telpon', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:25:29', '2023-05-02 18:25:29'),
(38, 'Biaya', '00150106', '  Biaya Alat Tulis Kantor', 2, 100000.00, 0.00, 0.00, 0.00, '2023-05-02 18:25:49', '2024-10-31 04:21:44'),
(39, 'Biaya', '00150107', '  Biaya Sumbangan / Sosial', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:26:13', '2023-05-02 18:26:13'),
(40, 'Biaya', '00150108', '  Biaya RAT', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:26:26', '2023-05-02 18:26:26'),
(41, 'Biaya', '00150109', '  Biaya Transport', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:27:03', '2023-05-02 18:27:03'),
(42, 'Biaya', '00150110', '  Biaya Keamanan dan Kebersihan', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:27:19', '2023-05-02 18:27:19'),
(43, 'Biaya', '001502', 'BIAYA NON OPERASIONAL', 1, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:28:00', '2023-05-02 18:28:00'),
(44, 'Biaya', '00150201', '  Biaya Adm Bank', 2, 840000.00, 30000.00, 0.00, 0.00, '2023-05-02 18:28:22', '2024-11-01 05:26:06'),
(45, 'Biaya', '00150202', '  Biaya Pajak Bank', 2, 0.00, 0.00, 0.00, 0.00, '2023-05-02 18:28:35', '2023-05-02 18:28:35'),
(46, 'Aktiva', '00110302', '  Cicilan Barang', 2, -67340629.00, 1781600.00, 4312323.00, 0.00, '2023-05-24 05:51:46', '2024-11-01 05:26:06'),
(47, 'Pendapatan', '00140102', '  Pendapatan Jasa/Bunga Cicilan Barang', 2, 1531265.75, 0.00, 112119.00, 0.00, '2023-05-24 05:52:53', '2024-11-01 05:26:06'),
(49, 'Pendapatan', '00140108', '  Pendapatan Penjualan Barang', 2, 144204010.00, 0.00, 7457647.00, 0.00, '2023-06-26 07:20:52', '2024-11-01 05:26:06'),
(50, 'Aktiva', '00110303', '  Pinjaman Project', 2, 18500000.00, 0.00, 0.00, 0.00, '2023-09-13 07:26:20', '2024-10-31 04:21:44'),
(51, 'Pendapatan', '00140109', '  Pendapatan Jasa/Bunga Pinjaman Project', 2, 0.00, 0.00, 0.00, 0.00, '2023-09-13 07:26:39', '2023-09-13 07:26:39'),
(52, 'Biaya', '00150111', '  Biaya Pos / Kurir', 2, 40000.00, 0.00, 0.00, 0.00, '2023-10-05 09:14:09', '2024-08-05 07:16:05'),
(53, 'Pasiva', '001205', 'HUTANG DAGANG', 1, 0.00, 0.00, 0.00, 0.00, '2023-10-05 09:20:00', '2023-10-05 09:20:00'),
(54, 'Pasiva', '00120501', '  Hutang pd Pantarei', 2, 44511396.00, 0.00, 0.00, 0.00, '2023-10-05 09:20:50', '2024-10-31 04:21:44'),
(55, 'Pasiva', '00120502', '  Hutang pd PMA', 2, 25606000.00, 0.00, 0.00, 0.00, '2023-10-05 09:21:04', '2024-10-31 04:21:44'),
(56, 'Aktiva', '00110503', '  Software', 2, 13000000.00, 0.00, 0.00, 0.00, '2023-10-05 09:50:58', '2024-08-05 07:14:00'),
(57, 'Pasiva', '00120503', '  Hutang pd PINC', 2, 19000000.00, 0.00, 0.00, 0.00, '2023-10-05 09:52:28', '2024-08-05 07:16:05'),
(58, 'Aktiva', '00110504', '  Furniture dan Peralatan Kantor', 2, 6000000.00, 0.00, 0.00, 0.00, '2023-10-05 09:57:37', '2024-08-05 07:16:05'),
(59, 'Biaya', '001503', 'HPP', 1, 123024212.00, 4851155.00, 0.00, 0.00, '2023-11-21 05:09:37', '2024-11-01 05:26:06'),
(61, 'Pasiva', '001206', 'HUTANG PAJAK', 1, 0.00, 0.00, 0.00, 0.00, '2024-06-20 10:20:11', '2024-06-20 10:20:11'),
(62, 'Pasiva', '00120601', '  Pajak PPh 21', 2, 0.00, 0.00, 0.00, 0.00, '2024-06-20 10:20:24', '2024-06-20 10:20:24'),
(63, 'Biaya', '00150112', '  Proses Data', 2, 0.00, 0.00, 0.00, 0.00, '2024-06-20 10:22:17', '2024-06-20 10:22:17'),
(64, 'Aktiva', '00110304', '  Cicilan Tiket', 2, 0.00, 0.00, 0.00, 0.00, '2024-08-06 08:48:43', '2024-10-31 04:21:44'),
(65, 'Pendapatan', '00140110', '  Pendapatan Penjualan Tiket', 2, 0.00, 0.00, 0.00, 0.00, '2024-08-06 08:49:05', '2024-08-06 08:49:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jb_mutasi_stok`
--

CREATE TABLE `jb_mutasi_stok` (
  `id` bigint(20) NOT NULL,
  `id_pembelian` bigint(20) NOT NULL,
  `id_produk` bigint(20) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `masuk` int(11) NOT NULL DEFAULT '0',
  `keluar` int(11) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jb_order`
--

CREATE TABLE `jb_order` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `no_trx` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `total` double(15,2) NOT NULL DEFAULT '0.00',
  `diskon` double(15,2) NOT NULL DEFAULT '0.00',
  `jangka` int(3) NOT NULL DEFAULT '12',
  `pembayaran` enum('Tunai','Transfer Bank','Bayar Nanti (PG)','Cicilan 3x','Cicilan 6x','Cicilan 12x') NOT NULL DEFAULT 'Bayar Nanti (PG)',
  `notes` varchar(255) DEFAULT '''''',
  `ket_batal` varchar(255) NOT NULL DEFAULT '',
  `status_order` enum('Dibatalkan','Menunggu Konfirmasi','Diproses','Siap Diambil','Selesai','Menunggu Pembayaran') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jb_order_detail`
--

CREATE TABLE `jb_order_detail` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `id_order` bigint(11) NOT NULL,
  `id_produk` bigint(11) NOT NULL,
  `hpp` bigint(11) NOT NULL,
  `harga` double(15,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_07_082604_create_anggota_table', 1),
(4, '2019_02_07_082623_create_tabungan_table', 1),
(5, '2019_02_07_082624_create_setoran_table', 1),
(6, '2019_02_07_082626_create_penarikan_table', 1),
(7, '2019_02_07_082724_create_riwayat_tabungan_table', 1),
(8, '2019_02_07_082725_create_bunga_tabungan_table', 1),
(9, '2019_02_09_093543_add_tahun_to_bunga_tabungan_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_agen`
--

CREATE TABLE `ms_agen` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_agen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_anggota`
--

CREATE TABLE `ms_anggota` (
  `id` bigint(11) UNSIGNED NOT NULL,
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
  `foto_ktp` longtext,
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `alamat_domisili` varchar(255) DEFAULT '',
  `status_keanggotaan` enum('Aktif','Non-Aktif','Menunggu','Non Anggota') NOT NULL,
  `tgl_registrasi` date DEFAULT NULL,
  `tgl_nonaktif` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_department`
--

CREATE TABLE `ms_department` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ms_department`
--

INSERT INTO `ms_department` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(3, '-', NULL, NULL),
(4, 'ACCOUNT', NULL, NULL),
(5, 'BOD KOONTJIE', NULL, NULL),
(6, 'BOD PMA', NULL, NULL),
(7, 'BOD W3P', NULL, NULL),
(8, 'CREATIVE', NULL, NULL),
(9, 'DIGITAL', NULL, NULL),
(10, 'HR', NULL, NULL),
(11, 'IMADI', NULL, NULL),
(12, 'INDOSAT B2B', NULL, NULL),
(13, 'INDOSAT B2C', NULL, NULL),
(14, 'MATA ANGIN', NULL, NULL),
(15, 'MEDIA TJIPTA PARAGON', NULL, NULL),
(16, 'MULTIBRAND', NULL, NULL),
(17, 'MULTIBRAND (ADIRA DLL)', NULL, NULL),
(18, 'MULTIBRAND 1', NULL, NULL),
(19, 'MULTIBRAND 1 & 2', NULL, NULL),
(20, 'MULTIBRAND 2', NULL, NULL),
(21, 'PANTAREI', NULL, NULL),
(22, 'PINC', NULL, NULL),
(23, 'STRATEGY', NULL, NULL),
(24, 'SUPPORT', NULL, NULL),
(25, 'SUPPORT PAN', NULL, NULL),
(26, 'SUPPORT PMA', NULL, NULL),
(27, 'TRI', NULL, NULL),
(28, 'W3P', NULL, NULL),
(36, 'DIREKSI', '2023-07-21 13:18:29', '2023-07-21 13:18:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_jabatan`
--

CREATE TABLE `ms_jabatan` (
  `id` bigint(11) NOT NULL,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `simp_pokok` double(15,2) NOT NULL DEFAULT '0.00',
  `simp_wajib` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ms_jabatan`
--

INSERT INTO `ms_jabatan` (`id`, `nama`, `simp_pokok`, `simp_wajib`, `created_at`, `updated_at`) VALUES
(1, 'Non Staff', 100000.00, 50000.00, '2023-05-04 06:33:15', '2023-05-04 06:33:15'),
(2, 'Staff - Senior Officer', 100000.00, 150000.00, '2023-05-04 06:33:37', '2023-05-04 06:33:37'),
(3, 'Manager - Senior Manager', 100000.00, 250000.00, '2023-05-04 06:33:53', '2023-05-04 06:33:53'),
(4, 'Director', 100000.00, 500000.00, '2023-05-04 06:34:39', '2023-05-04 06:34:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_kategori`
--

CREATE TABLE `ms_kategori` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `kategori` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ms_kategori`
--

INSERT INTO `ms_kategori` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'BAHAN POKOK', '2023-05-11 08:01:16', '2023-05-11 08:01:16'),
(2, 'ELEKTRONIK', '2023-05-11 08:01:23', '2023-05-11 08:01:23'),
(3, 'FURNITURE & FASHION', '2023-05-11 08:01:33', '2023-05-11 08:01:33'),
(4, 'SEPEDA MOTOR', '2023-05-11 08:01:38', '2023-05-11 08:01:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_perusahaan`
--

CREATE TABLE `ms_perusahaan` (
  `id` bigint(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `inisial` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ms_perusahaan`
--

INSERT INTO `ms_perusahaan` (`id`, `nama`, `inisial`, `created_at`, `updated_at`) VALUES
(1, 'PT Example', 'EXP', '2023-05-04 05:27:08', '2023-05-04 05:27:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_produk`
--

CREATE TABLE `ms_produk` (
  `id` bigint(20) NOT NULL,
  `id_kategori` bigint(20) NOT NULL DEFAULT '0',
  `nama_barang` varchar(225) NOT NULL DEFAULT '',
  `deskripsi` varchar(255) NOT NULL DEFAULT '',
  `harga_beli` double(15,2) NOT NULL DEFAULT '0.00',
  `harga_jual` double(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('PreOrder','Ready Stock','Discontinue','Out of Stock') NOT NULL DEFAULT 'PreOrder',
  `estimasi` int(11) NOT NULL DEFAULT '0',
  `cicilan` varchar(1) NOT NULL DEFAULT 'Y',
  `bayar_penuh` varchar(1) NOT NULL DEFAULT 'Y',
  `foto` longtext NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_suplier`
--

CREATE TABLE `ms_suplier` (
  `id` bigint(11) NOT NULL,
  `nama_suplier` varchar(255) NOT NULL DEFAULT '',
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `kontak` varchar(20) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_tickets`
--

CREATE TABLE `ms_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_tiket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_tiket` enum('Tiket Pesawat','Tiket Kereta Api','Tiket Bus & Travel','Hotel','Tiket Festival dan Hiburan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_tiket` text COLLATE utf8mb4_unicode_ci,
  `tgl_berlaku` date NOT NULL,
  `harga_beli` double(15,2) NOT NULL,
  `harga_jual` double(15,2) NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `status_tiket` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pby_import`
--

CREATE TABLE `pby_import` (
  `id` bigint(11) NOT NULL,
  `id_norek` bigint(11) NOT NULL,
  `no_rek` varchar(25) NOT NULL DEFAULT '',
  `nama_anggota` varchar(255) NOT NULL DEFAULT '',
  `nama_pinjaman` varchar(100) NOT NULL DEFAULT '',
  `angs_pokok` double(15,2) NOT NULL DEFAULT '0.00',
  `angs_jasa` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pby_jadwal`
--

CREATE TABLE `pby_jadwal` (
  `id` bigint(11) NOT NULL,
  `id_norek` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `angske` int(4) NOT NULL DEFAULT '0',
  `angs_pokok` double(15,2) NOT NULL DEFAULT '0.00',
  `angs_jasa` double(15,2) NOT NULL DEFAULT '0.00',
  `tag_pokok` double(15,2) NOT NULL DEFAULT '0.00',
  `tag_jasa` double(15,2) NOT NULL DEFAULT '0.00',
  `status` varchar(5) NOT NULL DEFAULT '',
  `user_id` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pby_master`
--

CREATE TABLE `pby_master` (
  `id` bigint(20) NOT NULL,
  `kode` varchar(2) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `akun_produk` varchar(20) NOT NULL DEFAULT '',
  `akun_jasa` varchar(20) NOT NULL DEFAULT '',
  `akun_adm` varchar(20) NOT NULL DEFAULT '',
  `bya_adm` double(5,2) NOT NULL DEFAULT '0.00',
  `bya_adm_na` double(5,2) NOT NULL DEFAULT '0.00' COMMENT 'Biaya Adm Khusus Non Anggota',
  `persen_jasa` double(5,2) NOT NULL DEFAULT '0.00',
  `persen_jasa_na` double(5,2) NOT NULL DEFAULT '0.00' COMMENT 'Jasa Khusus Non Anggota',
  `jenis_pinjaman` enum('Tunai','Barang','Tiket') NOT NULL DEFAULT 'Tunai',
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pby_master`
--

INSERT INTO `pby_master` (`id`, `kode`, `nama`, `akun_produk`, `akun_jasa`, `akun_adm`, `bya_adm`, `bya_adm_na`, `persen_jasa`, `persen_jasa_na`, `jenis_pinjaman`, `status`, `created_at`, `updated_at`) VALUES
(1, '50', 'Pinjaman Biasa', '00110301', '00140101', '00140103', 0.50, 0.00, 0.35, 0.00, 'Tunai', 'Y', '2023-05-04 05:50:28', '2023-05-04 05:50:28'),
(4, '51', 'Cicilan Barang', '00110302', '00140102', '00140103', 0.00, 0.00, 0.35, 0.00, 'Barang', 'Y', '2023-05-24 05:51:04', '2023-05-24 05:51:04'),
(6, '53', 'Pinjaman Khusus', '00110301', '00140101', '00140103', 0.00, 0.00, 0.50, 0.00, 'Tunai', 'Y', '2023-06-14 05:44:27', '2023-06-14 05:44:27'),
(7, '54', 'Pinjaman Project', '00110303', '00140109', '00140103', 0.00, 0.00, 1.75, 0.00, 'Tunai', 'Y', '2023-09-13 07:29:07', '2023-09-13 07:29:07'),
(8, '55', 'Cicilan Tiket', '00110304', '00140110', '00140103', 0.00, 0.00, 0.35, 0.00, 'Tiket', 'Y', '2024-08-06 08:47:49', '2024-08-06 08:50:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pby_mutasi`
--

CREATE TABLE `pby_mutasi` (
  `id` bigint(11) NOT NULL,
  `id_norek` bigint(11) NOT NULL,
  `no_bukti` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `angske` int(4) NOT NULL DEFAULT '0',
  `no_rek` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `angs_pokok` double(15,2) NOT NULL DEFAULT '0.00',
  `angs_jasa` double(15,2) NOT NULL DEFAULT '0.00',
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pby_pengajuan`
--

CREATE TABLE `pby_pengajuan` (
  `id` bigint(11) NOT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `id_order` bigint(11) NOT NULL,
  `id_pinjaman` bigint(11) NOT NULL,
  `no_rek` varchar(20) NOT NULL,
  `no_pengajuan` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `jenis` enum('Pinjaman Tunai','Cicilan Barang','Cicilan Tiket') NOT NULL DEFAULT 'Pinjaman Tunai',
  `nominal` double(15,2) NOT NULL DEFAULT '0.00',
  `jangka` int(3) NOT NULL DEFAULT '0',
  `keperluan` varchar(255) NOT NULL DEFAULT '',
  `jaminan` enum('Tanpa Jaminan','BPKB','Sertifikat','Lainnya') NOT NULL DEFAULT 'Tanpa Jaminan',
  `user_id` int(10) NOT NULL,
  `status_pengajuan` enum('Menunggu Persetujuan HR','Menunggu Persetujuan CFO','Disetujui HR','Disetujui CFO','Menunggu Pencairan','Pencairan Selesai','Tidak Disetujui HR','Tidak Disetujui CFO','Tidak Disetujui','Pencairan Dibatalkan') NOT NULL DEFAULT 'Menunggu Persetujuan HR',
  `tgl_ubah` date DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `approve_by_hr` int(1) NOT NULL DEFAULT '0',
  `approve_by_cfo` int(1) NOT NULL DEFAULT '0',
  `foto_ttd` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pby_rekening`
--

CREATE TABLE `pby_rekening` (
  `id` bigint(11) NOT NULL,
  `id_anggota` bigint(11) NOT NULL DEFAULT '0',
  `id_pinjaman` bigint(11) NOT NULL DEFAULT '0',
  `id_pengajuan` bigint(11) NOT NULL DEFAULT '0',
  `no_rek` varchar(20) NOT NULL,
  `tgl_cair` date DEFAULT NULL,
  `jangka` int(3) NOT NULL DEFAULT '0',
  `jth_tempo` date DEFAULT NULL,
  `plafond` double(15,2) NOT NULL DEFAULT '0.00',
  `bya_adm` double(15,2) NOT NULL DEFAULT '0.00',
  `angske` int(3) NOT NULL DEFAULT '0',
  `saldo_awal_pokok_sys` double(15,2) NOT NULL DEFAULT '0.00',
  `saldo_awal_jasa_sys` double(15,2) NOT NULL DEFAULT '0.00',
  `saldo_akhir` double(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('Aktif','Lunas') NOT NULL DEFAULT 'Aktif',
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pby_simulasi`
--

CREATE TABLE `pby_simulasi` (
  `id` bigint(11) NOT NULL,
  `angske` int(4) NOT NULL DEFAULT '0',
  `angs_pokok` double(15,2) NOT NULL DEFAULT '0.00',
  `angs_jasa` double(15,2) NOT NULL DEFAULT '0.00',
  `user_id` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_tiket`
--

CREATE TABLE `pembelian_tiket` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `id_agen` int(10) UNSIGNED NOT NULL,
  `pembayaran` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci,
  `subtotal` double(15,2) NOT NULL DEFAULT '0.00',
  `diskon` double(15,2) NOT NULL DEFAULT '0.00',
  `total` double(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('Menunggu','Disetujui','Ditolak','Dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu',
  `id_user` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_tiket_detail`
--

CREATE TABLE `pembelian_tiket_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pembelian` int(10) UNSIGNED NOT NULL,
  `id_tiket` int(10) UNSIGNED NOT NULL,
  `harga_beli` double(15,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '0',
  `subtotal` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shu_jasaagt`
--

CREATE TABLE `shu_jasaagt` (
  `id` bigint(11) NOT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_trx` varchar(20) NOT NULL DEFAULT '',
  `hpp` double(15,2) NOT NULL DEFAULT '0.00',
  `harga_jual` double(15,2) NOT NULL DEFAULT '0.00',
  `nominal` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `simp_import`
--

CREATE TABLE `simp_import` (
  `id` bigint(11) NOT NULL,
  `id_norek` bigint(11) NOT NULL,
  `no_rek` varchar(25) NOT NULL DEFAULT '',
  `nama_anggota` varchar(255) NOT NULL DEFAULT '',
  `nama_simpanan` varchar(100) NOT NULL DEFAULT '',
  `nominal` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `simp_master`
--

CREATE TABLE `simp_master` (
  `id` bigint(20) NOT NULL,
  `kode` varchar(2) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `akun_produk` varchar(20) NOT NULL DEFAULT '',
  `akun_jasa` varchar(20) NOT NULL DEFAULT '',
  `persen_jasa` double(15,2) NOT NULL DEFAULT '0.00',
  `modal` varchar(1) NOT NULL DEFAULT 'N',
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `simp_master`
--

INSERT INTO `simp_master` (`id`, `kode`, `nama`, `akun_produk`, `akun_jasa`, `persen_jasa`, `modal`, `status`, `created_at`, `updated_at`) VALUES
(1, '01', 'Simpanan Pokok', '00120201', '', 0.00, 'Y', 'Y', '2023-05-04 05:50:28', '2023-05-04 05:50:28'),
(2, '02', 'Simpanan Wajib', '00120202', '', 0.00, 'Y', 'Y', '2023-05-04 05:50:34', '2023-05-04 05:50:34'),
(3, '03', 'Simpanan Sukarela', '00120203', '00150104', 0.00, 'Y', 'Y', '2023-05-04 05:50:47', '2023-06-13 13:17:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simp_mutasi`
--

CREATE TABLE `simp_mutasi` (
  `id` bigint(11) NOT NULL,
  `id_norek` bigint(11) NOT NULL,
  `no_bukti` varchar(30) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `no_rek` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `debet` double(15,2) NOT NULL DEFAULT '0.00',
  `kredit` double(15,2) NOT NULL DEFAULT '0.00',
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `simp_rekening`
--

CREATE TABLE `simp_rekening` (
  `id` bigint(11) NOT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `id_simpanan` bigint(11) NOT NULL,
  `no_rek` varchar(15) NOT NULL DEFAULT '',
  `tgl_buka` date DEFAULT NULL,
  `tgl_tutup` date DEFAULT NULL,
  `jasa_persen` double(5,2) NOT NULL DEFAULT '0.00',
  `status_aktif` varchar(1) NOT NULL DEFAULT 'Y',
  `status_blokir` varchar(1) NOT NULL DEFAULT 'N',
  `saldo_awal_sys` double(15,2) NOT NULL DEFAULT '0.00',
  `saldo_akhir` double(15,2) NOT NULL DEFAULT '0.00',
  `setoran` double(15,2) DEFAULT '0.00',
  `is_setor` int(1) NOT NULL DEFAULT '0',
  `jmlskip_tagih` int(3) NOT NULL DEFAULT '0',
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_notification`
--

CREATE TABLE `sys_notification` (
  `id` bigint(11) NOT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `id_reksimp` bigint(11) NOT NULL,
  `id_rekpby` bigint(11) NOT NULL,
  `id_pengajuan` bigint(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` enum('Pinjaman','Simpanan','Anggota','Setoran','Angsuran','Pengajuan') NOT NULL,
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `role` enum('Anggota','Admin') NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_pengesah`
--

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

--
-- Dumping data untuk tabel `sys_pengesah`
--

INSERT INTO `sys_pengesah` (`ketua`, `sekretaris`, `bendahara`, `manager`, `ko`, `keuangan`, `marketing`, `kasir`, `kabag_pby`, `saksi1`, `saksi2`) VALUES
('Ketua', 'Sekretaris', 'Bendahara', 'Manager', '', 'Akunting', '', 'Kasir', 'Ka. Pembiayaan', 'Saksi 1', 'Saksi 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_pengurus`
--

CREATE TABLE `sys_pengurus` (
  `id` bigint(11) NOT NULL,
  `posisi` enum('Ketua','Sekretaris','Bendahara','Jual Beli') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sys_pengurus`
--

INSERT INTO `sys_pengurus` (`id`, `posisi`, `nama`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Ketua', 'Ketua', 'ketua@example.com', '2023-06-10 19:43:23', '2023-06-10 19:43:23'),
(2, 'Sekretaris', 'Sekretaris', 'sekertaris@example.com', '2023-06-10 19:43:28', '2023-06-10 19:43:23'),
(3, 'Bendahara', 'Bendahara', 'bendahara@example.com', '2023-06-10 19:43:41', '2023-06-10 19:43:23'),
(4, 'Jual Beli', 'UJB', 'jualbeli@example.com', '2023-09-11 22:33:31', '2023-06-10 19:43:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_periode`
--

CREATE TABLE `sys_periode` (
  `id` bigint(11) NOT NULL,
  `kde_kantor` char(3) COLLATE latin1_general_ci DEFAULT NULL,
  `tgl_aktif` date DEFAULT NULL,
  `tgl_hariini` date DEFAULT NULL,
  `tgl_mulaitag` date NOT NULL,
  `tgl_selesaitag` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `sys_periode`
--

INSERT INTO `sys_periode` (`id`, `kde_kantor`, `tgl_aktif`, `tgl_hariini`, `tgl_mulaitag`, `tgl_selesaitag`) VALUES
(1, '001', '2020-01-01', '2020-03-31', '2024-10-13', '2024-11-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_perush`
--

CREATE TABLE `sys_perush` (
  `id` int(11) NOT NULL,
  `kde_wilayah` varchar(4) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'id order',
  `kde_kantor` char(3) COLLATE latin1_general_ci DEFAULT NULL,
  `nma_perush` varchar(255) COLLATE latin1_general_ci DEFAULT '',
  `nma_cabang` varchar(30) COLLATE latin1_general_ci DEFAULT '0',
  `alm_perush` varchar(255) COLLATE latin1_general_ci DEFAULT '',
  `kta_perush` varchar(25) COLLATE latin1_general_ci DEFAULT '',
  `tlp_perush` varchar(20) COLLATE latin1_general_ci DEFAULT '',
  `eml_perush` varchar(35) COLLATE latin1_general_ci DEFAULT '',
  `website` varchar(70) COLLATE latin1_general_ci DEFAULT '',
  `paket` double DEFAULT '1',
  `sn` varchar(30) COLLATE latin1_general_ci DEFAULT '',
  `notification` int(1) DEFAULT '0',
  `email` int(1) DEFAULT '0',
  `stok_inventory` int(1) DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `sys_perush`
--

INSERT INTO `sys_perush` (`id`, `kde_wilayah`, `kde_kantor`, `nma_perush`, `nma_cabang`, `alm_perush`, `kta_perush`, `tlp_perush`, `eml_perush`, `website`, `paket`, `sn`, `notification`, `email`, `stok_inventory`, `updated_at`, `created_at`) VALUES
(2, '3174', '001', 'KOPERASI KARYAWAN UNTUNG BARENG', 'JAKARTA', 'Jakarta', 'DKI Jakarta', '(021) 000000', 'admin@example.com', 'www.example.com', 1, '', 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_rekapshu`
--

CREATE TABLE `sys_rekapshu` (
  `tahun` double NOT NULL DEFAULT '0',
  `no` double NOT NULL DEFAULT '0',
  `poin` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `persen` double(5,2) NOT NULL DEFAULT '0.00',
  `perolehan` double(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_setshu`
--

CREATE TABLE `sys_setshu` (
  `no` double NOT NULL,
  `nama` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `persen` double(5,2) NOT NULL,
  `akun` varchar(14) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `sys_setshu`
--

INSERT INTO `sys_setshu` (`no`, `nama`, `persen`, `akun`) VALUES
(1, 'Jasa Simpanan', 20.00, ''),
(2, 'Jasa Pembiayaan', 25.00, ''),
(3, 'Dana Cadangan', 55.00, '001203');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tgh_anggota`
--

CREATE TABLE `tgh_anggota` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `periode` varchar(255) DEFAULT '',
  `id_anggota` bigint(11) NOT NULL,
  `simp_pokok` double(15,2) NOT NULL DEFAULT '0.00',
  `simp_wajib` double(15,2) NOT NULL DEFAULT '0.00',
  `simp_sukarela` double(15,2) NOT NULL DEFAULT '0.00',
  `cicilan_barang` double(15,2) NOT NULL DEFAULT '0.00',
  `pinjaman_tunai` double(15,2) NOT NULL DEFAULT '0.00',
  `total_tagihan` double(15,2) NOT NULL DEFAULT '0.00',
  `user_id` bigint(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tgh_anggota_detail`
--

CREATE TABLE `tgh_anggota_detail` (
  `id` bigint(11) NOT NULL,
  `periode` varchar(255) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `id_anggota` bigint(11) NOT NULL,
  `id_reksimpanan` bigint(11) NOT NULL,
  `id_rekpinjaman` bigint(11) NOT NULL,
  `nominal_pokok` double(15,2) NOT NULL DEFAULT '0.00',
  `nominal_jasa` double(15,2) NOT NULL DEFAULT '0.00',
  `angske` int(11) NOT NULL DEFAULT '0',
  `jenis` varchar(255) NOT NULL DEFAULT '',
  `id_user` bigint(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tgh_anggota_new`
--

CREATE TABLE `tgh_anggota_new` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `periode` varchar(255) DEFAULT '',
  `id_anggota` bigint(11) NOT NULL,
  `simp_pokok` double(15,2) NOT NULL DEFAULT '0.00',
  `simp_wajib` double(15,2) NOT NULL DEFAULT '0.00',
  `simp_sukarela` double(15,2) NOT NULL DEFAULT '0.00',
  `cicilan_barang` double(15,2) NOT NULL DEFAULT '0.00',
  `tenor_cicil` int(11) NOT NULL DEFAULT '0',
  `angske_cicil` int(11) NOT NULL DEFAULT '0',
  `pinjaman_tunai` double(15,2) NOT NULL DEFAULT '0.00',
  `tenor_tunai` int(11) NOT NULL DEFAULT '0',
  `angske_tunai` int(11) NOT NULL DEFAULT '0',
  `cicilan_tiket` double(15,2) NOT NULL DEFAULT '0.00',
  `tenor_tiket` int(11) NOT NULL DEFAULT '0',
  `angske_tiket` int(11) NOT NULL DEFAULT '0',
  `total_tagihan` double(15,2) NOT NULL DEFAULT '0.00',
  `user_id` bigint(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_cart`
--

CREATE TABLE `tmp_cart` (
  `id` bigint(11) NOT NULL,
  `id_user` bigint(11) NOT NULL,
  `id_produk` bigint(11) NOT NULL,
  `harga` double(15,2) NOT NULL DEFAULT '0.00',
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_tiket`
--

CREATE TABLE `tmp_tiket` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_pembelian`
--

CREATE TABLE `trx_pembelian` (
  `id` bigint(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_suplier` bigint(11) DEFAULT NULL,
  `pembayaran` varchar(255) NOT NULL DEFAULT '''''',
  `keterangan` longtext,
  `subtotal` double(15,2) NOT NULL DEFAULT '0.00',
  `diskon` double(15,2) NOT NULL DEFAULT '0.00',
  `total` double(15,2) NOT NULL DEFAULT '0.00',
  `id_user` bigint(11) NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak','') NOT NULL DEFAULT 'Menunggu',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_pembelian_detail`
--

CREATE TABLE `trx_pembelian_detail` (
  `id` bigint(11) NOT NULL,
  `id_pembelian` bigint(11) NOT NULL,
  `id_produk` bigint(11) NOT NULL,
  `harga_beli` double(15,2) NOT NULL DEFAULT '0.00',
  `qty` int(8) NOT NULL DEFAULT '0',
  `subtotal` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Anggota') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Anggota',
  `department` enum('CFO','HR','USP','UJB','ADMIN','AGT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `department`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'ADMIN', '', 'MSq3dK1ONA1go2i3DKKgCBfn99J7H0omb4HNv4NkHxozulb6AMjcApByfuy8', '2023-03-27 04:57:50', '2024-09-06 05:52:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agt_cart`
--
ALTER TABLE `agt_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `agt_transaksi`
--
ALTER TABLE `agt_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `agt_trx_tiket`
--
ALTER TABLE `agt_trx_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akt_arsipshu`
--
ALTER TABLE `akt_arsipshu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akt_finance`
--
ALTER TABLE `akt_finance`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akt_finance_rev`
--
ALTER TABLE `akt_finance_rev`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akt_mutasi`
--
ALTER TABLE `akt_mutasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akt_mutasirev`
--
ALTER TABLE `akt_mutasirev`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akt_setting`
--
ALTER TABLE `akt_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `chart_account`
--
ALTER TABLE `chart_account`
  ADD PRIMARY KEY (`id`,`kde_akun`);

--
-- Indeks untuk tabel `jb_mutasi_stok`
--
ALTER TABLE `jb_mutasi_stok`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `jb_order`
--
ALTER TABLE `jb_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jb_order_detail`
--
ALTER TABLE `jb_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_agen`
--
ALTER TABLE `ms_agen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_anggota`
--
ALTER TABLE `ms_anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_department`
--
ALTER TABLE `ms_department`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_jabatan`
--
ALTER TABLE `ms_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_kategori`
--
ALTER TABLE `ms_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_perusahaan`
--
ALTER TABLE `ms_perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_produk`
--
ALTER TABLE `ms_produk`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `ms_suplier`
--
ALTER TABLE `ms_suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_tickets`
--
ALTER TABLE `ms_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pby_import`
--
ALTER TABLE `pby_import`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pby_jadwal`
--
ALTER TABLE `pby_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pby_master`
--
ALTER TABLE `pby_master`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pby_mutasi`
--
ALTER TABLE `pby_mutasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pby_pengajuan`
--
ALTER TABLE `pby_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pby_rekening`
--
ALTER TABLE `pby_rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pby_simulasi`
--
ALTER TABLE `pby_simulasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian_tiket`
--
ALTER TABLE `pembelian_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian_tiket_detail`
--
ALTER TABLE `pembelian_tiket_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `shu_jasaagt`
--
ALTER TABLE `shu_jasaagt`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simp_import`
--
ALTER TABLE `simp_import`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simp_master`
--
ALTER TABLE `simp_master`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simp_mutasi`
--
ALTER TABLE `simp_mutasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simp_rekening`
--
ALTER TABLE `simp_rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sys_notification`
--
ALTER TABLE `sys_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sys_pengurus`
--
ALTER TABLE `sys_pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sys_periode`
--
ALTER TABLE `sys_periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sys_perush`
--
ALTER TABLE `sys_perush`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tgh_anggota`
--
ALTER TABLE `tgh_anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tgh_anggota_detail`
--
ALTER TABLE `tgh_anggota_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tgh_anggota_new`
--
ALTER TABLE `tgh_anggota_new`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tmp_cart`
--
ALTER TABLE `tmp_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tmp_tiket`
--
ALTER TABLE `tmp_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trx_pembelian`
--
ALTER TABLE `trx_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trx_pembelian_detail`
--
ALTER TABLE `trx_pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agt_cart`
--
ALTER TABLE `agt_cart`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1323;

--
-- AUTO_INCREMENT untuk tabel `agt_transaksi`
--
ALTER TABLE `agt_transaksi`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `agt_trx_tiket`
--
ALTER TABLE `agt_trx_tiket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `akt_arsipshu`
--
ALTER TABLE `akt_arsipshu`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `akt_finance`
--
ALTER TABLE `akt_finance`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

--
-- AUTO_INCREMENT untuk tabel `akt_finance_rev`
--
ALTER TABLE `akt_finance_rev`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;

--
-- AUTO_INCREMENT untuk tabel `akt_mutasi`
--
ALTER TABLE `akt_mutasi`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1392;

--
-- AUTO_INCREMENT untuk tabel `akt_mutasirev`
--
ALTER TABLE `akt_mutasirev`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1385;

--
-- AUTO_INCREMENT untuk tabel `akt_setting`
--
ALTER TABLE `akt_setting`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `chart_account`
--
ALTER TABLE `chart_account`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `jb_mutasi_stok`
--
ALTER TABLE `jb_mutasi_stok`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2214;

--
-- AUTO_INCREMENT untuk tabel `jb_order`
--
ALTER TABLE `jb_order`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT untuk tabel `jb_order_detail`
--
ALTER TABLE `jb_order_detail`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1361;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ms_agen`
--
ALTER TABLE `ms_agen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `ms_anggota`
--
ALTER TABLE `ms_anggota`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT untuk tabel `ms_department`
--
ALTER TABLE `ms_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `ms_jabatan`
--
ALTER TABLE `ms_jabatan`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ms_kategori`
--
ALTER TABLE `ms_kategori`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ms_perusahaan`
--
ALTER TABLE `ms_perusahaan`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ms_produk`
--
ALTER TABLE `ms_produk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=543;

--
-- AUTO_INCREMENT untuk tabel `ms_suplier`
--
ALTER TABLE `ms_suplier`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ms_tickets`
--
ALTER TABLE `ms_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pby_import`
--
ALTER TABLE `pby_import`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pby_jadwal`
--
ALTER TABLE `pby_jadwal`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=638;

--
-- AUTO_INCREMENT untuk tabel `pby_master`
--
ALTER TABLE `pby_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pby_mutasi`
--
ALTER TABLE `pby_mutasi`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=624;

--
-- AUTO_INCREMENT untuk tabel `pby_pengajuan`
--
ALTER TABLE `pby_pengajuan`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT untuk tabel `pby_rekening`
--
ALTER TABLE `pby_rekening`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT untuk tabel `pby_simulasi`
--
ALTER TABLE `pby_simulasi`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1570;

--
-- AUTO_INCREMENT untuk tabel `pembelian_tiket`
--
ALTER TABLE `pembelian_tiket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pembelian_tiket_detail`
--
ALTER TABLE `pembelian_tiket_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `shu_jasaagt`
--
ALTER TABLE `shu_jasaagt`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT untuk tabel `simp_import`
--
ALTER TABLE `simp_import`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `simp_master`
--
ALTER TABLE `simp_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `simp_mutasi`
--
ALTER TABLE `simp_mutasi`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1871;

--
-- AUTO_INCREMENT untuk tabel `simp_rekening`
--
ALTER TABLE `simp_rekening`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT untuk tabel `sys_notification`
--
ALTER TABLE `sys_notification`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=451;

--
-- AUTO_INCREMENT untuk tabel `sys_pengurus`
--
ALTER TABLE `sys_pengurus`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sys_periode`
--
ALTER TABLE `sys_periode`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sys_perush`
--
ALTER TABLE `sys_perush`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tgh_anggota`
--
ALTER TABLE `tgh_anggota`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1123;

--
-- AUTO_INCREMENT untuk tabel `tgh_anggota_detail`
--
ALTER TABLE `tgh_anggota_detail`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3414;

--
-- AUTO_INCREMENT untuk tabel `tgh_anggota_new`
--
ALTER TABLE `tgh_anggota_new`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3605;

--
-- AUTO_INCREMENT untuk tabel `tmp_cart`
--
ALTER TABLE `tmp_cart`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tmp_tiket`
--
ALTER TABLE `tmp_tiket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `trx_pembelian`
--
ALTER TABLE `trx_pembelian`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `trx_pembelian_detail`
--
ALTER TABLE `trx_pembelian_detail`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
