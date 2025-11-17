-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Nov 2025 pada 16.31
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
-- Struktur dari tabel `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL,
  `comic_id` int(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comics`
--

CREATE TABLE `comics` (
  `id` int(20) NOT NULL,
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
(1, 'One Piece', 'one-piece', 'Eiichiro Oda', 'manga', 'covers/onepiece.jpg', 'banners/onepiece.jpg', 'Petualangan bajak laut mencari One Piece.', 'Action, Adventure, Comedy', '1997-07-22', 'ongoing', '2025-11-13 12:48:56', '2025-11-10 04:26:29'),
(2, 'Solo Leveling', NULL, 'Chugong', 'manhwa', 'covers/sololeveling.jpg', 'banners/sololeveling.jpg', 'Seorang hunter lemah yang menjadi yang terkuat.', 'Action, Fantasy', '2018-03-04', 'completed', '2025-11-10 04:26:29', '2025-11-10 04:26:29'),
(3, 'Tales of Demons and Gods', NULL, 'Mad Snail', 'manhua', 'covers/tales.jpg', 'banners/tales.jpg', 'Reinkarnasi seorang ahli bela diri di masa lalu.', 'Fantasy, Martial Arts', '2015-05-12', 'ongoing', '2025-11-10 04:26:29', '2025-11-10 04:26:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mangas`
--

CREATE TABLE `mangas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manga_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `cover_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mangas`
--

INSERT INTO `mangas` (`id`, `manga_id`, `title`, `type`, `cover_file`, `created_at`, `updated_at`) VALUES
(1, '32d76d19-8a05-4db0-9fc2-e0b0648fe9d0', 'No Title', 'ko', 'e90bdc47-c8b9-4df7-b2c0-17641b645ee1.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(2, 'aa6c76f7-5f5f-46b6-a800-911145f81b9b', 'Sono Bisque Doll wa Koi wo Suru', 'ja', 'd3e909b9-c667-48a5-beec-ac96f23fa228.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(3, '77bee52c-d2d6-44ad-a33a-1734c1fe696a', 'No Title', 'ja', '9231bf92-2999-4fa2-b93f-2c2994c2ca1e.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(4, 'e1e38166-20e4-4468-9370-187f985c550e', 'No Title', 'ja', '39e4f1b9-9bb2-41c3-840d-d7208432830b.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(5, 'e78a489b-6632-4d61-b00b-5206f5b8b22b', 'No Title', 'ja', 'cdbc549f-9704-4453-915a-12542583e982.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(6, 'b0b721ff-c388-4486-aa0f-c2b0bb321512', 'No Title', 'ja', 'f6fb40bf-f4e5-4163-a2c7-f103200873c3.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(7, '801513ba-a712-498c-8f57-cae55b38cc92', 'Berserk', 'ja', '81e1c82d-6672-400c-8c58-4ff9bfb89031.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(8, 'a77742b1-befd-49a4-bff5-1ad4e6b0ef7b', 'Chainsaw Man', 'ja', 'd34fa144-0e6c-4f1a-8bd4-90e91eb5b3cf.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(9, 'd8a959f7-648e-4c8d-8f23-f1f3f8e129f3', 'No Title', 'ja', 'fce3cf93-474a-4e96-98b4-cd45a1f09129.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(10, 'bd6d0982-0091-4945-ad70-c028ed3c0917', 'No Title', 'ja', '7a0f2758-07c4-45da-8d11-a42038f66c29.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(11, '28c77530-dfa1-4b05-8ec3-998960ba24d4', 'No Title', 'ja', '2a87c2b5-83ab-4cfa-96fd-da840f6f0e6f.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(12, 'a96676e5-8ae2-425e-b549-7f15dd34a6d8', 'Komi-san wa Komyushou Desu.', 'ja', 'f8f44329-1dd7-4301-9ec7-a4a76182e8eb.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(13, '1389d660-b9b1-4c6a-81af-eab4dbf3f22b', 'No Title', 'ja', 'c9ceccd1-be1a-4e59-a431-9538a04adc7e.png', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(14, 'd86cf65b-5f6c-437d-a0af-19a31f94ec55', 'No Title', 'ja', '5e4a4e0e-b2a6-4e7e-8e6e-169a8d26c7a8.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(15, '58bc83a0-1808-484e-88b9-17e167469e23', 'No Title', 'ja', '4d4383c4-fa7c-436b-85e3-f1967eec9d13.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(16, 'eb2d1a45-d4e7-4e32-a171-b5b029c5b0cb', 'No Title', 'ja', '1c3917ec-7cb3-4786-bcf2-d259c89562d7.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(17, '7643e9f6-8455-4a58-b7e8-bf6cd00f5251', 'Tsuki ga Michibiku Isekai Douchuu', 'ja', '79b51099-ce55-4d19-b755-f94b93375696.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(18, 'bd38c075-8b12-450a-aeee-125e3ac5da4b', 'No Title', 'ja', 'b8632315-3701-4656-a668-1137d07c68dc.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(19, 'da88b8f1-0b6f-4e69-a07f-ec1c624b2aa7', 'Reincarnation Coliseum: The Weakest Skill Conquers the Strongest Women and Creates a Harem', 'ja', 'da202537-9298-4a6e-94ed-0705bb99c90b.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02'),
(20, '6670ee28-f26d-4b61-b49c-d71149cd5a6e', 'Mieruko-chan', 'ja', '715a15ee-4e9a-44f2-a9b7-2eefcc1ef949.jpg', '2025-11-17 08:19:02', '2025-11-17 08:19:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_11_14_134803_create_cache_table', 1),
(2, '2025_11_17_151507_create_mangas_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
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
-- Indeks untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_comic` (`user_id`,`comic_id`),
  ADD KEY `fk_bookmarks_comic` (`comic_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mangas`
--
ALTER TABLE `mangas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mangas_manga_id_unique` (`manga_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
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
-- AUTO_INCREMENT untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `mangas`
--
ALTER TABLE `mangas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `fk_bookmarks_comic` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bookmarks_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
