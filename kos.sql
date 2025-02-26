SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipe_kos` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `periode_penempatan` date NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` enum('PENDING','APPROVED','REJECTED') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `kamar` (
  `id_kamar` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'F',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ms_panorama` (
  `id` int(11) NOT NULL,
  `scene` varchar(30) NOT NULL,
  `text` varchar(30) NOT NULL,
  `namafile` varchar(30) NOT NULL,
  `hfov` varchar(11) NOT NULL DEFAULT '0',
  `pitch` varchar(11) NOT NULL DEFAULT '0',
  `yaw` varchar(11) NOT NULL DEFAULT '0',
  `default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ms_panorama` (`id`, `scene`, `text`, `namafile`, `hfov`, `pitch`, `yaw`, `default`) VALUES
(1, 'beranda', 'Beranda', 'panorama.jpeg', '160', '-10', '80', 1),
(2, 'kamarmandi', 'Kamar Mandi', 'km.jpeg', '120', '-12', '130', 0),
(3, 'jemur', 'Area Jemur', 'jmr.jpeg', '120', '-12', '355.5', 0);

CREATE TABLE `ms_tipe_kos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `harga` double NOT NULL,
  `bulan` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `panorama_hotspots` (
  `id` int(11) NOT NULL,
  `id_panorama` int(11) NOT NULL,
  `pitch` varchar(3) NOT NULL DEFAULT '0',
  `yaw` varchar(3) NOT NULL DEFAULT '0',
  `scene` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `panorama_hotspots` (`id`, `id_panorama`, `pitch`, `yaw`, `scene`) VALUES
(1, 1, '-9.', '257', 2),
(2, 1, '-9.', '78', 3),
(3, 2, '-8', '217', 3),
(4, 2, '-18', '217', 1),
(5, 3, '-4', '-6.', 2),
(6, 3, '-12', '-6', 1);

CREATE TABLE `payments` (
  `email` varchar(255) NOT NULL,
  `periode_tagihan` date NOT NULL,
  `total_tagihan` varchar(255) NOT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_verifikasi` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `penyewa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `no_kamar` varchar(255) NOT NULL,
  `tipe_kos` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `tanggal_menyewa` varchar(255) NOT NULL,
  `tanggal_jatuh_tempo` varchar(255) NOT NULL,
  `tanggal_booking` varchar(255) NOT NULL,
  `status_penyewaan` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_berakhir` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ms_panorama`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ms_tipe_kos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `panorama_hotspots`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payments`
  ADD PRIMARY KEY (`email`,`periode_tagihan`);

ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);


ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `ms_panorama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `ms_tipe_kos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `panorama_hotspots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `penyewa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
