-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2025 pada 16.45
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `mangadex_id` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT NULL,
  `last_chapter` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `comics`
--

INSERT INTO `comics` (`id`, `mangadex_id`, `title`, `type`, `image`, `status`, `last_update`, `last_chapter`, `created_at`, `updated_at`) VALUES
(1, '32d76d19-8a05-4db0-9fc2-e0b0648fe9d0', 'Na Honjaman Level-Up', 'ko', 'https://uploads.mangadex.org/covers/32d76d19-8a05-4db0-9fc2-e0b0648fe9d0/e90bdc47-c8b9-4df7-b2c0-17641b645ee1.jpg.256.jpg', 'completed', '2024-02-18 14:59:55', '3', '2025-11-19 05:06:05', '2025-11-19 07:29:18'),
(2, 'aa6c76f7-5f5f-46b6-a800-911145f81b9b', 'Sono Bisque Doll wa Koi o Suru', 'ja', 'https://uploads.mangadex.org/covers/aa6c76f7-5f5f-46b6-a800-911145f81b9b/d3e909b9-c667-48a5-beec-ac96f23fa228.jpg.256.jpg', 'completed', '2025-09-05 08:33:07', '115.5', '2025-11-19 05:06:05', '2025-11-19 07:29:20'),
(3, '77bee52c-d2d6-44ad-a33a-1734c1fe696a', 'Kage no Jitsuryokusha ni Naritakute!', 'ja', 'https://uploads.mangadex.org/covers/77bee52c-d2d6-44ad-a33a-1734c1fe696a/3994ae2b-37b5-4f5c-8ebe-35e3d7c6c959.jpg.256.jpg', 'ongoing', '2025-04-30 22:52:16', '72.2', '2025-11-19 05:06:05', '2025-11-19 07:29:20'),
(4, 'e1e38166-20e4-4468-9370-187f985c550e', 'Mato Seihei no Slave', 'ja', 'https://uploads.mangadex.org/covers/e1e38166-20e4-4468-9370-187f985c550e/39e4f1b9-9bb2-41c3-840d-d7208432830b.jpg.256.jpg', 'ongoing', '2025-05-03 15:24:34', '155', '2025-11-19 05:06:05', '2025-11-19 07:29:21'),
(5, 'e78a489b-6632-4d61-b00b-5206f5b8b22b', 'Tensei Shitara Slime datta Ken', 'ja', 'https://uploads.mangadex.org/covers/e78a489b-6632-4d61-b00b-5206f5b8b22b/cdbc549f-9704-4453-915a-12542583e982.jpg.256.jpg', 'ongoing', '2025-10-03 20:05:32', '134', '2025-11-19 05:06:05', '2025-11-19 07:29:22'),
(6, 'b0b721ff-c388-4486-aa0f-c2b0bb321512', 'Sousou no Frieren', 'ja', 'https://uploads.mangadex.org/covers/b0b721ff-c388-4486-aa0f-c2b0bb321512/f6fb40bf-f4e5-4163-a2c7-f103200873c3.jpg.256.jpg', 'ongoing', '2025-09-19 07:58:28', '145', '2025-11-19 05:06:05', '2025-11-19 07:29:24'),
(7, '801513ba-a712-498c-8f57-cae55b38cc92', 'Berserk', 'ja', 'https://uploads.mangadex.org/covers/801513ba-a712-498c-8f57-cae55b38cc92/81e1c82d-6672-400c-8c58-4ff9bfb89031.jpg.256.jpg', 'ongoing', '2025-09-11 08:00:25', '383', '2025-11-19 05:06:05', '2025-11-19 07:29:24'),
(8, 'a77742b1-befd-49a4-bff5-1ad4e6b0ef7b', 'Chainsaw Man', 'ja', 'https://uploads.mangadex.org/covers/a77742b1-befd-49a4-bff5-1ad4e6b0ef7b/d34fa144-0e6c-4f1a-8bd4-90e91eb5b3cf.jpg.256.jpg', 'ongoing', '2025-11-11 08:07:07', '220', '2025-11-19 05:06:05', '2025-11-19 07:29:25'),
(9, 'd8a959f7-648e-4c8d-8f23-f1f3f8e129f3', 'One Punch-Man', 'ja', 'https://uploads.mangadex.org/covers/d8a959f7-648e-4c8d-8f23-f1f3f8e129f3/fce3cf93-474a-4e96-98b4-cd45a1f09129.jpg.256.jpg', 'ongoing', '2025-11-08 07:48:12', '218', '2025-11-19 05:06:05', '2025-11-19 07:29:26'),
(10, 'bd6d0982-0091-4945-ad70-c028ed3c0917', 'Mushoku Tensei: Isekai Ittara Honki Dasu', 'ja', 'https://uploads.mangadex.org/covers/bd6d0982-0091-4945-ad70-c028ed3c0917/7a0f2758-07c4-45da-8d11-a42038f66c29.jpg.256.jpg', 'ongoing', '2025-06-14 16:03:35', '111', '2025-11-19 05:06:05', '2025-11-19 07:29:26'),
(11, '28c77530-dfa1-4b05-8ec3-998960ba24d4', 'Otome Game Sekai wa Mob ni Kibishii Sekai desu', 'ja', 'https://uploads.mangadex.org/covers/28c77530-dfa1-4b05-8ec3-998960ba24d4/2a87c2b5-83ab-4cfa-96fd-da840f6f0e6f.jpg.256.jpg', 'completed', '2025-01-03 14:50:28', '68.5', '2025-11-19 05:06:05', '2025-11-19 07:29:27'),
(12, 'a96676e5-8ae2-425e-b549-7f15dd34a6d8', 'Komi-san wa Komyushou Desu.', 'ja', 'https://uploads.mangadex.org/covers/a96676e5-8ae2-425e-b549-7f15dd34a6d8/f8f44329-1dd7-4301-9ec7-a4a76182e8eb.jpg.256.jpg', 'completed', '2025-04-04 07:39:24', '500.5', '2025-11-19 05:06:05', '2025-11-19 07:29:27'),
(13, '1389d660-b9b1-4c6a-81af-eab4dbf3f22b', 'Isekai Meikyuu de Harem wo', 'ja', 'https://uploads.mangadex.org/covers/1389d660-b9b1-4c6a-81af-eab4dbf3f22b/c9ceccd1-be1a-4e59-a431-9538a04adc7e.png.256.jpg', 'ongoing', '2025-11-08 04:32:10', '102', '2025-11-19 05:06:05', '2025-11-19 07:29:28'),
(14, 'd86cf65b-5f6c-437d-a0af-19a31f94ec55', 'Ijiranaide, Nagatoro-san', 'ja', 'https://uploads.mangadex.org/covers/d86cf65b-5f6c-437d-a0af-19a31f94ec55/5e4a4e0e-b2a6-4e7e-8e6e-169a8d26c7a8.jpg.256.jpg', 'completed', '2023-12-24 13:18:30', '2', '2025-11-19 05:06:05', '2025-11-19 07:29:29'),
(15, '58bc83a0-1808-484e-88b9-17e167469e23', 'Lv2 kara Cheat datta Moto Yuusha Kouho no Mattari Isekai Life', 'ja', 'https://uploads.mangadex.org/covers/58bc83a0-1808-484e-88b9-17e167469e23/4d4383c4-fa7c-436b-85e3-f1967eec9d13.jpg.256.jpg', 'ongoing', '2025-11-11 22:20:35', '67', '2025-11-19 05:06:05', '2025-11-19 07:29:29'),
(16, 'eb2d1a45-d4e7-4e32-a171-b5b029c5b0cb', 'Kumo desuga, Nani ka?', 'ja', 'https://uploads.mangadex.org/covers/eb2d1a45-d4e7-4e32-a171-b5b029c5b0cb/1c3917ec-7cb3-4786-bcf2-d259c89562d7.jpg.256.jpg', 'ongoing', '2025-05-08 01:00:36', '74.2', '2025-11-19 05:06:05', '2025-11-19 07:29:30'),
(17, '7643e9f6-8455-4a58-b7e8-bf6cd00f5251', 'Tsuki ga Michibiku Isekai Douchuu', 'ja', 'https://uploads.mangadex.org/covers/7643e9f6-8455-4a58-b7e8-bf6cd00f5251/79b51099-ce55-4d19-b755-f94b93375696.jpg.256.jpg', 'ongoing', '2025-10-19 14:12:12', '111', '2025-11-19 05:06:05', '2025-11-19 07:29:31'),
(18, 'bd38c075-8b12-450a-aeee-125e3ac5da4b', 'Fukushuu wo Koinegau Saikyou Yuusha wa, Yami no Chikara de Senmetsu Musou Suru', 'ja', 'https://uploads.mangadex.org/covers/bd38c075-8b12-450a-aeee-125e3ac5da4b/b8632315-3701-4656-a668-1137d07c68dc.jpg.256.jpg', 'ongoing', '2025-11-11 02:52:06', '125', '2025-11-19 05:06:05', '2025-11-19 07:29:32'),
(19, 'da88b8f1-0b6f-4e69-a07f-ec1c624b2aa7', 'Reincarnation Coliseum: The Weakest Skill Conquers the Strongest Women and Creates a Harem', 'ja', 'https://uploads.mangadex.org/covers/da88b8f1-0b6f-4e69-a07f-ec1c624b2aa7/da202537-9298-4a6e-94ed-0705bb99c90b.jpg.256.jpg', 'ongoing', '2025-10-29 08:21:24', '34', '2025-11-19 05:06:05', '2025-11-19 07:29:32'),
(20, '6670ee28-f26d-4b61-b49c-d71149cd5a6e', 'Mieruko-chan', 'ja', 'https://uploads.mangadex.org/covers/6670ee28-f26d-4b61-b49c-d71149cd5a6e/715a15ee-4e9a-44f2-a9b7-2eefcc1ef949.jpg.256.jpg', 'ongoing', '2025-11-02 16:22:32', '67', '2025-11-19 05:06:05', '2025-11-19 07:29:33');

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
(2, '2025_11_17_151507_create_mangas_table', 2),
(3, '2025_11_19_120035_create_comics_table', 3),
(4, '2025_11_19_135736_add_last_chapter_to_comics_table', 4);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comics_mangadex_id_unique` (`mangadex_id`);

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
-- AUTO_INCREMENT untuk tabel `comics`
--
ALTER TABLE `comics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
