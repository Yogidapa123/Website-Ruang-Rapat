-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2025 at 08:29 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webruang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `background_admin_photos`
--

CREATE TABLE `background_admin_photos` (
  `id` bigint UNSIGNED NOT NULL,
  `code` enum('admin','user','ruangan','pinjamSementara','pinjamRuang','fotoBackground') COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `background_admin_photos`
--

INSERT INTO `background_admin_photos` (`id`, `code`, `img`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'backgrounds/bg.png', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(2, 'user', 'backgrounds/bg.png', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(3, 'ruangan', 'backgrounds/bg.png', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(4, 'pinjamSementara', 'backgrounds/bg.png', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(5, 'pinjamRuang', 'backgrounds/bg.png', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(6, 'fotoBackground', 'backgrounds/bg.png', '2025-03-07 08:26:59', '2025-03-07 08:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `background_login_photos`
--

CREATE TABLE `background_login_photos` (
  `id` bigint UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `background_login_photos`
--

INSERT INTO `background_login_photos` (`id`, `img`, `created_at`, `updated_at`) VALUES
(1, 'backgrounds/Gapura Bupati.jpg', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(2, 'backgrounds/images1.jpg', '2025-03-07 08:26:59', '2025-03-07 08:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `background_utama_photos`
--

CREATE TABLE `background_utama_photos` (
  `id` bigint UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `background_utama_photos`
--

INSERT INTO `background_utama_photos` (`id`, `img`, `created_at`, `updated_at`) VALUES
(1, 'backgrounds/rapat.png', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(2, 'backgrounds/rapat3.png', '2025-03-07 08:26:59', '2025-03-07 08:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_21_021606_room', 1),
(6, '2022_05_21_022039_create_rooms_table', 1),
(7, '2022_05_21_031209_create_rents_table', 1),
(8, '2022_05_21_075939_create_admins_table', 1),
(9, '2022_05_21_082546_create_roles_table', 1),
(10, '2025_02_13_024514_create_background_login_photos_table', 1),
(11, '2025_02_13_024605_create_background_utama_photos_table', 1),
(12, '2025_02_18_085002_create_background_admin_photos_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `time_start_use` datetime NOT NULL,
  `time_end_use` datetime NOT NULL,
  `purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_start` datetime NOT NULL,
  `transaction_end` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(2, 'user', '2025-03-07 08:26:59', '2025-03-07 08:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `img`, `tempat`, `capacity`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Ruang Rapat Diskominfo', 'assets/images/ruangrapatdiskominfo3.jpg', 'Gedung Diskominfo Kabupaten Malang', 25, 'Jalan KH. Agus Salim Gedung C Lantai 3', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(2, ' Ruang Rapat Kepala Dinas', 'assets/images/RuangKepalaDinas.jpg', ' Gedung Diskominfo Kabupaten Malang', 10, 'Jalan KH. Agus Salim Gedung C Lantai 3', '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(3, 'Ruang Command Center', 'assets/images/RuangCommandCenter.jpg', 'Gedung Sekretariat Pemkab Malang', 50, 'Jalan Panji no.158 Kepanjen Lantai 9', '2025-03-07 08:26:59', '2025-03-07 08:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_handphone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nomor_handphone`, `username`, `username_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Novi', '6285891791600', 'Novi', NULL, '$2y$10$.wzx/mll0iDTtxCPhNNYw.RsDMW60CswrbNrUoLZUpePcHPv0uOyq', 1, NULL, '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(2, 'Joshua', '6285891791500', 'Joshua', NULL, '$2y$10$gI6YA6oVoSIKfaVVTbi9c.3AR39vTm14zA4rJyqYXwHgftSSlhxYG', 1, NULL, '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(3, 'Komunikasi', '6285891791501', 'Komunikasi', NULL, '$2y$10$wpNNHYX0gcTcjTKhgdDU1uiWM11waV/9oIlWaVO7tCwjVFo15cFA.', 2, NULL, '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(4, 'Aplikasi Informatika', '6285891791502', 'Aplikasi', NULL, '$2y$10$FvWJ1PvzDGBziih8e/Mm/uKENJpdg3rnYJVWzFaZTs6yjbkN49/36', 2, NULL, '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(5, 'Statistik dan Informasi', '6285891791504', 'Statistik', NULL, '$2y$10$gjf0O52pGyj1x7.tDcS00uD0H4gDyBsVmUfOB2MMz9nh9DPvlvGoG', 2, NULL, '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(6, 'Infrastuktur TIK', '6285891791505', 'Infrastuktur', NULL, '$2y$10$ev8HXavTCdXmqT3Wbp/cUu5cWVnkVIZzVT3kBgUaxXNG7ef1dntOq', 2, NULL, '2025-03-07 08:26:59', '2025-03-07 08:26:59'),
(7, 'Sekretariat', '6285891791506', 'Sekretariat', NULL, '$2y$10$kg9djHGn1C.ErN.BE6Rp7.4O3V.6ZeH9s2FfH0o0D0OAy6IGmQl56', 2, NULL, '2025-03-07 08:26:59', '2025-03-07 08:26:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `background_admin_photos`
--
ALTER TABLE `background_admin_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `background_login_photos`
--
ALTER TABLE `background_login_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `background_utama_photos`
--
ALTER TABLE `background_utama_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `background_admin_photos`
--
ALTER TABLE `background_admin_photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `background_login_photos`
--
ALTER TABLE `background_login_photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `background_utama_photos`
--
ALTER TABLE `background_utama_photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
