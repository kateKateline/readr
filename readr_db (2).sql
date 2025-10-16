-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Okt 2025 pada 04.19
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
  `user_id` int(11) DEFAULT NULL,
  `comic_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `comic_id`, `created_at`) VALUES
(1, 1, 2, '2025-10-15 03:35:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comics`
--

CREATE TABLE `comics` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `type` enum('Manga','Manhwa','Manhua','') DEFAULT NULL,
  `status` enum('ongoing','completed','hiatus','cancelled') DEFAULT 'ongoing',
  `age_rating` varchar(10) DEFAULT '13+',
  `synopsis` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `cover_banner` varchar(255) DEFAULT NULL,
  `chapters` int(11) DEFAULT 0,
  `rating` decimal(3,1) DEFAULT 0.0,
  `rank` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `comics`
--

INSERT INTO `comics` (`id`, `title`, `author`, `type`, `status`, `age_rating`, `synopsis`, `cover_image`, `cover_banner`, `chapters`, `rating`, `rank`, `created_at`, `updated_at`) VALUES
(1, 'jujur aku kasian', 'Gege gaming aku lari', 'Manga', 'completed', '13+', 'berlari dan kasian, ada edi lauk, ada sahril lumpat, restu dengdeng , apalagi ya ga tau isinya random biar keliatan ini tuh sinopsis yang panjang padahal mah isinya ga tau apaan, mana nanti gua bingung nanti gimana cara implementasi manga nya bodo lah yang penting ini selesai, btw laravel enak banget anjir, meskipun ada hal yang baru tapi ya 11/12 sama lah ya kaya native beda nya di sini sangat di permudah, terimakasih bapak bapak yang mirip jhon sins yang buat laravel aku mencitaimu muah muah ', 'jjk.png', 'jjk_banner.png', 222, 8.9, 5, '2025-10-13 14:14:16', '2025-10-13 14:14:16'),
(2, 'Boku no Dodol Academia', 'Kamisan', 'Manga', 'cancelled', '18+', 'Ambalabu dan lain lain bla bla bla bla bla bla bla bla ', 'bk.jpg', 'bk.jpg', 0, 0.0, 0, '2025-10-15 03:33:46', '2025-10-15 03:33:46'),
(3, 'test cenah', 'cenah', 'Manhwa', 'completed', '10+', 'Manage API key and secret pairs for your product environment. To build the environment variable for each pair, copy the provided format and substitute your actual values for the placeholders. Make sure to store your secrets securely.', 'cover_1760532675.png', 'banner_1760532675.png', 232, 8.1, 2, '2025-10-15 05:51:15', '2025-10-15 05:51:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comic_genre`
--

CREATE TABLE `comic_genre` (
  `comic_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `comic_genre`
--

INSERT INTO `comic_genre` (`comic_id`, `genre_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comic_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `comic_id`, `created_at`) VALUES
(1, 1, 1, '2025-10-13 16:09:25'),
(2, 1, 2, '2025-10-15 05:38:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) DEFAULT NULL,
  `following_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `follows`
--

INSERT INTO `follows` (`id`, `follower_id`, `following_id`, `created_at`) VALUES
(1, 2, 1, '2025-10-13 16:08:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(5, 'Comedy'),
(6, 'Drama'),
(3, 'Fantasy'),
(14, 'Historical'),
(7, 'Horror'),
(19, 'Isekai'),
(20, 'Magic'),
(16, 'Martial Arts'),
(17, 'Music'),
(9, 'Mystery'),
(18, 'Psychological'),
(4, 'Romance'),
(15, 'School'),
(8, 'Sci-Fi'),
(10, 'Slice of Life'),
(12, 'Sports'),
(11, 'Supernatural'),
(13, 'Thriller');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT 'default.png',
  `banner` varchar(255) DEFAULT 'banner.png',
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile`, `banner`, `role`, `created_at`) VALUES
(1, 'MIce', 'mice@gmail.com', '$2y$12$6Uo2Dv4VcWo4IWPedDCvNuwO2yxPZD2WDsMjkyOGmF5ktfscHpEP.', 'default.png', 'banner.png', 'admin', '2025-10-10 15:29:19'),
(2, 'KevinHere', 'kevin1@gmail.com', '$2y$10$dnMBJifWIKxO0eIlXA6FsO2gM0X.Q4CUVYO8eXPIJgDCDgOvMix52', 'default.png', 'banner.png', 'user', '2025-10-11 08:39:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comic_id` (`comic_id`);

--
-- Indeks untuk tabel `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `comic_genre`
--
ALTER TABLE `comic_genre`
  ADD PRIMARY KEY (`comic_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indeks untuk tabel `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comic_id` (`comic_id`);

--
-- Indeks untuk tabel `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `following_id` (`following_id`);

--
-- Indeks untuk tabel `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comic_genre`
--
ALTER TABLE `comic_genre`
  ADD CONSTRAINT `comic_genre_ibfk_1` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comic_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
