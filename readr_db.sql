-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Nov 2025 pada 16.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `readr_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comics`
--

CREATE TABLE `comics` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `type` enum('manga','manhwa','manhua') NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `genre` varchar(150) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `status` enum('ongoing','completed') DEFAULT 'ongoing',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `comics`
--

INSERT INTO `comics` (`id`, `title`, `slug`, `author`, `type`, `cover_image`, `banner_image`, `desc`, `genre`, `release_date`, `status`, `updated_at`, `uploaded_at`) VALUES
(1, 'One Piece', NULL, 'Eiichiro Oda', 'manga', 'covers/onepiece.jpg', 'banners/onepiece.jpg', 'Petualangan bajak laut mencari One Piece.', 'Action, Adventure, Comedy', '1997-07-22', 'ongoing', '2025-11-10 04:26:29', '2025-11-10 04:26:29'),
(2, 'Solo Leveling', NULL, 'Chugong', 'manhwa', 'covers/sololeveling.jpg', 'banners/sololeveling.jpg', 'Seorang hunter lemah yang menjadi yang terkuat.', 'Action, Fantasy', '2018-03-04', 'completed', '2025-11-10 04:26:29', '2025-11-10 04:26:29'),
(3, 'Tales of Demons and Gods', NULL, 'Mad Snail', 'manhua', 'covers/tales.jpg', 'banners/tales.jpg', 'Reinkarnasi seorang ahli bela diri di masa lalu.', 'Fantasy, Martial Arts', '2015-05-12', 'ongoing', '2025-11-10 04:26:29', '2025-11-10 04:26:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `profile_banner` varchar(255) DEFAULT NULL,
  `level` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_image`, `profile_banner`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$12$XNAd7BHnMCc2i5x1nIKzFO2CNBgYz3xDIt11Y1hiPb2vthdrKRuPW', 'profile/tales.jpg', 'profile_banners/tales.jpg\r\n', 'admin', '2025-11-09 20:27:46', '2025-11-12 15:28:54'),
(2, 'Hengker', 'hengker@hengker.com', '$2y$12$w.1eeufiwhZKb2E54MOQyOkMxQskD3VvN5YT/lw5EySttNtCCcwW6', NULL, NULL, 'user', '2025-11-09 20:58:51', '2025-11-09 20:58:51');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
