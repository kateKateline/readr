-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Nov 2025 pada 08.56
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
-- Struktur dari tabel `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comic_id` bigint(20) UNSIGNED NOT NULL,
  `mangadex_id` varchar(255) NOT NULL,
  `chapter_number` decimal(8,3) DEFAULT NULL,
  `volume` varchar(50) DEFAULT NULL,
  `publish_at` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `translated_language` varchar(10) NOT NULL DEFAULT 'en',
  `external_url` varchar(255) DEFAULT NULL,
  `is_unavailable` tinyint(1) DEFAULT 0,
  `md_updated_at` datetime DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `data` longtext DEFAULT NULL,
  `data_saver` longtext DEFAULT NULL,
  `pages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pages`)),
  `publish_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `chapters`
--

INSERT INTO `chapters` (`id`, `comic_id`, `mangadex_id`, `chapter_number`, `volume`, `publish_at`, `title`, `translated_language`, `external_url`, `is_unavailable`, `md_updated_at`, `hash`, `data`, `data_saver`, `pages`, `publish_date`, `created_at`, `updated_at`) VALUES
(67, 1, '2affc580-970b-4187-97fe-ff621d850368', 45.000, '1', '2025-04-23 14:08:57', NULL, 'he', NULL, 0, '2025-04-23 14:09:12', '13d023632e2abf1cb7b5b25790a702cf', '[\"1-5a2a5112b2dfac37972650740219b14074ad683e6575c41ff915a573e36e380a.jpg\",\"2-9298118b7c6c5c3ceddad87b60810fd048d3821db003ccbb0699e90958b33247.jpg\",\"3-2c82c511d5e71d5781b26c6939f4a252a8b9a61a1b614309e374cd171c80b01a.jpg\",\"4-ab95b01588ad93d6ca3670a592a3e458e5c97688ed551b88404543f20ec4c694.jpg\",\"5-7a1ca897ba96c44b5fb52392a2d7c94bf4463d95a44593cbc0fd83cfb306bed7.jpg\",\"6-42a954be305aa246161d9c165b5e204abcefcce7818011ed4ea994d87a18c7c5.jpg\",\"7-6b972f46c925ff0cceffd637b166e5eab6ef54d8c0f20ba2f0000f269c86782b.jpg\",\"8-320cbc0173328dc92eed3a4deb6a2323f1ae367caf2c7321f02b88df425c5b0e.jpg\",\"9-311f15941f958d94e90b00cc276bf6fdd92af88b82d780dacd4d175453c37097.jpg\",\"10-3ae8fa606fb980bfe794d419dbf97384d10ba490353310ebd158dd894639e01c.jpg\",\"11-7e4a5b9ad26337b4df1fad8e4f439c27c50a079ff5d4ec7f0925b49e47b6df97.jpg\",\"12-472abff4b7671786dce95b1ce0c316cb369e594d73280a6e4bce722e5463127e.jpg\",\"13-d268e11fe0787e43338058799fa2b6789f4aadd582058eea9402c1c0d2fc942d.jpg\",\"14-8ddb934e99f759770d2294706a1d934d76e00a484d142abec75aac8fb3f53b6e.jpg\",\"15-a99f71a3a008085e3bedb19bb7504ed6f10593fd810c6f586364e1fa81196d4f.jpg\",\"16-15166a755b3002a3d112e5e7c9d365abf48542f818fbe7c5b13e10c5070769f2.jpg\",\"17-1ce9e7059fc7bc5d90bb77a4484db7add9bcfec2ad82e33f919df20957b29ae2.jpg\",\"18-f0a15e696b66bb906b41aef045d312c851363c69ab758f0ebab49e479aed75b6.jpg\",\"19-d7a57569fbcc3789753ae31d3f0364ee46171be772ff549c508ff2eaad58cd5a.jpg\"]', '[\"1-550c716830148116724aa8d9920b1f5cb907da03b2f467d50166a857bc4da661.jpg\",\"2-b06045dd34e1eb3ed6374322c3a5fbe5516b14447743fe86999c1c2bf76140cc.jpg\",\"3-4caadffd7a9ebf03ae4620ea26d855ffa6002d5f6e86f3666cf304a1fafa72ee.jpg\",\"4-4264ec7554959d28b26268c53bb409b980be2f8d13b81fc5a0d48965a3688401.jpg\",\"5-567962012d5b9b97816e9738c92d72d526bff72d37df579d5c25e47298663300.jpg\",\"6-c6a74b966f876b082f16eaf6ab64b49cdbefbc61a69b6cc5b11cb8c6f31bf0e7.jpg\",\"7-91df565747a992c68d479d11f344d776d9e9978322423122ee07ec316e5d2156.jpg\",\"8-1a842fe2da16de9b9665669f2c8082257ca885f2f38c34bda05ad0b05244abbc.jpg\",\"9-d1bb2bb61cd52d9cc9872186e2f3eb5dea4f5b4f47c3d2734c7027dee150727a.jpg\",\"10-a796ca8d9e79c286e52aba0d7f1e93b28e9d2fb3bbe39a89aad4e7ecd3f2d275.jpg\",\"11-723d2403c389850e6a8689c35abfb423639764becf55c5ceb5c226800637fb8c.jpg\",\"12-043d6570032a5f58201aab82d6a708967696eed9695e64ea79675956ae7137a7.jpg\",\"13-f8ab92b2d85660ae23fb0b8c2894a33b3cb3d432af8caa717c6b564251825313.jpg\",\"14-a95fcc37f1a64f25ab492282e7d93b5aa5a23e30978ddcb3d1b0a2a468b1510e.jpg\",\"15-32ce1a1f8d611a6654b1b4ea7b1d836d359d16ccd9fe66db3565d1d4829c82a1.jpg\",\"16-9b9bccf5cccf3cba16410b10d342696479b1f43b488f45159f27f8fca19437d0.jpg\",\"17-a7a318985a71088a1d23baed9ede26118f60733121cbc65d1bedfdec9696e4b4.jpg\",\"18-f0ecc3a8600d233eb0540b92cf73320634b47d476bb9c9f4d0289b117ea48531.jpg\",\"19-5d33ea1c50d2bd8085d3b4373342f5e0564b09d355e730c14aa307e686192ec8.jpg\"]', '19', NULL, '2025-11-28 00:53:21', '2025-11-28 00:53:21'),
(68, 1, 'b05d81f7-ea38-4b36-8ad5-802169d61b38', 46.000, '1', '2025-04-27 18:59:21', NULL, 'he', NULL, 0, '2025-04-27 19:00:30', '848fd7decd2daa1dd27f88f62a001c70', '[\"1-a413348f7568a54e252c772a95f7e7c1ed84eb7114aaa671f0d0b5fcae768803.png\",\"2-a5aa6ca6368e04c5d244d65ce0c8be9f39096a07060baa1284fc0864e00a80c8.png\",\"3-ed126045e77516f011bcfb8e87f204e5d681f0f065968558345f86897cb59031.png\",\"4-9f8386c993661f2d650f1a066c130228f0f8af9590b29b9060b55bc0cea9f397.png\",\"5-de77ffb72901fbb2f4796b2513057a8b3213cf81b481ede30add5bc15751f7a6.png\",\"6-92e9f88058f0a039fdeb2499b1d35463eb9477a13b7a53f51cbf570d7552f905.png\",\"7-cc8b19024dce13a885d8de8c553f5b0974850b9f2ef472a8fd003c00dc9cf983.png\",\"8-7fe436044e6e6faefacfb0856ce5af3820cae2cc4e1fc5daa2622f77938b7c9c.png\",\"9-6cd2faa83dc19b845e2050b009c2490033f339b5bd57307e56b3bc4c47ee222b.png\",\"10-bacfd45af92e14189ce1913d0fb7862ac975d1368a0ba1d5cc891ecfffd3791c.png\",\"11-7a5de37cb68e39cdc607d71736b42ea9288ff159af6a046042ca539d780c8246.png\"]', '[\"1-325161d9ee9c306652bdb1aade3c1548e2960c78f1ee2b2901c681c76a5a15f1.jpg\",\"2-a57af4b31327f27f02439ca6faa66f356afda22adb148e4115ea2b8d6ca2cf6e.jpg\",\"3-007b71e38ff88b53ecebe1b5db4b084e2660778646a5861085da79eee322c16e.jpg\",\"4-448c24a621e6b3deafc53e86bb6115b0d46353aecdc8c6dd82b31bf1d1ce6479.jpg\",\"5-cbb1b572d532babbb1a4c43287e16852a8ec522ced60a3a594c2baa8ac3bef88.jpg\",\"6-9911beaa2d9515f0fa6d52b253e09914e3aae497291dd13ae9c3b71470f2371a.jpg\",\"7-d5440ac5b868bd7a47c91ec0e7d68f762a3b3ac6b7e7e35a91dff54e13192feb.jpg\",\"8-48560d3490883d6047e904a323e6a0699eda44d481a30f56d7a72e8dc42f6a7e.jpg\",\"9-40a64c96a629d41b7b555ab05d171f8b50e5acaf221d5e961c4a936be2c650e7.jpg\",\"10-90ae53658b5253e08cbb1995a1c1e09e082677ff14d848c0af63073c8230c914.jpg\",\"11-9df039b7b4f5a40eda471332dd3b01cb798ff12b1121f94470526d9c975e681a.jpg\"]', '11', NULL, '2025-11-28 00:53:22', '2025-11-28 00:53:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comics`
--

CREATE TABLE `comics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mangadex_id` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(200) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_sensitive` tinyint(1) NOT NULL DEFAULT 0,
  `last_update` timestamp NULL DEFAULT NULL,
  `last_chapter` varchar(255) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `rating_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `comics`
--

INSERT INTO `comics` (`id`, `mangadex_id`, `title`, `author`, `type`, `image`, `status`, `is_sensitive`, `last_update`, `last_chapter`, `rating`, `rating_count`, `created_at`, `updated_at`) VALUES
(1, '32d76d19-8a05-4db0-9fc2-e0b0648fe9d0', 'Na Honjaman Level-Up', 'h-goon (현군), Chugong (추공), Gi So-Ryeong (기소령)', 'ko', 'https://uploads.mangadex.org/covers/32d76d19-8a05-4db0-9fc2-e0b0648fe9d0/e90bdc47-c8b9-4df7-b2c0-17641b645ee1.jpg.256.jpg', 'completed', 0, '2025-11-25 08:47:37', '15', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 08:47:37'),
(2, 'aa6c76f7-5f5f-46b6-a800-911145f81b9b', 'Sono Bisque Doll wa Koi o Suru', 'Fukuda Shinichi', 'ja', 'https://uploads.mangadex.org/covers/aa6c76f7-5f5f-46b6-a800-911145f81b9b/d3e909b9-c667-48a5-beec-ac96f23fa228.jpg.256.jpg', 'completed', 0, '2025-09-05 08:33:07', '115.5', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:08'),
(3, '77bee52c-d2d6-44ad-a33a-1734c1fe696a', 'Kage no Jitsuryokusha ni Naritakute!', 'Sakano Anri, Aizawa Daisuke', 'ja', 'https://uploads.mangadex.org/covers/77bee52c-d2d6-44ad-a33a-1734c1fe696a/3994ae2b-37b5-4f5c-8ebe-35e3d7c6c959.jpg.256.jpg', 'ongoing', 0, '2025-04-30 22:52:16', '72.2', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:09'),
(4, 'e1e38166-20e4-4468-9370-187f985c550e', 'Mato Seihei no Slave', 'Takahiro', 'ja', 'https://uploads.mangadex.org/covers/e1e38166-20e4-4468-9370-187f985c550e/39e4f1b9-9bb2-41c3-840d-d7208432830b.jpg.256.jpg', 'ongoing', 0, '2025-05-03 15:24:34', '155', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:09'),
(5, 'e78a489b-6632-4d61-b00b-5206f5b8b22b', 'Tensei Shitara Slime datta Ken', 'Fuse', 'ja', 'https://uploads.mangadex.org/covers/e78a489b-6632-4d61-b00b-5206f5b8b22b/cdbc549f-9704-4453-915a-12542583e982.jpg.256.jpg', 'ongoing', 0, '2025-10-03 20:05:32', '134', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:10'),
(6, 'b0b721ff-c388-4486-aa0f-c2b0bb321512', 'Sousou no Frieren', 'Yamada Kanehito', 'ja', 'https://uploads.mangadex.org/covers/b0b721ff-c388-4486-aa0f-c2b0bb321512/f6fb40bf-f4e5-4163-a2c7-f103200873c3.jpg.256.jpg', 'ongoing', 0, '2025-09-19 07:58:28', '145', 9.54, 0, '2025-11-19 05:06:05', '2025-11-25 04:11:11'),
(7, '801513ba-a712-498c-8f57-cae55b38cc92', 'Berserk', 'Miura Kentarou, Mori Kouji', 'ja', 'https://uploads.mangadex.org/covers/801513ba-a712-498c-8f57-cae55b38cc92/81e1c82d-6672-400c-8c58-4ff9bfb89031.jpg.256.jpg', 'ongoing', 1, '2025-09-11 08:00:25', '383', 9.67, 0, '2025-11-19 05:06:05', '2025-11-25 04:11:11'),
(8, 'a77742b1-befd-49a4-bff5-1ad4e6b0ef7b', 'Chainsaw Man', 'Fujimoto Tatsuki', 'ja', 'https://uploads.mangadex.org/covers/a77742b1-befd-49a4-bff5-1ad4e6b0ef7b/d34fa144-0e6c-4f1a-8bd4-90e91eb5b3cf.jpg.256.jpg', 'ongoing', 1, '2025-11-11 08:07:07', '220', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:12'),
(9, 'd8a959f7-648e-4c8d-8f23-f1f3f8e129f3', 'One Punch-Man', 'ONE', 'ja', 'https://uploads.mangadex.org/covers/d8a959f7-648e-4c8d-8f23-f1f3f8e129f3/fce3cf93-474a-4e96-98b4-cd45a1f09129.jpg.256.jpg', 'ongoing', 1, '2025-11-21 01:33:18', '291', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:13'),
(10, 'bd6d0982-0091-4945-ad70-c028ed3c0917', 'Mushoku Tensei: Isekai Ittara Honki Dasu', 'Rifujin na Magonote', 'ja', 'https://uploads.mangadex.org/covers/bd6d0982-0091-4945-ad70-c028ed3c0917/7a0f2758-07c4-45da-8d11-a42038f66c29.jpg.256.jpg', 'ongoing', 0, '2025-06-14 16:03:35', '111', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:13'),
(11, '28c77530-dfa1-4b05-8ec3-998960ba24d4', 'Otome Game Sekai wa Mob ni Kibishii Sekai desu', 'Mishima Yomu', 'ja', 'https://uploads.mangadex.org/covers/28c77530-dfa1-4b05-8ec3-998960ba24d4/2a87c2b5-83ab-4cfa-96fd-da840f6f0e6f.jpg.256.jpg', 'completed', 0, '2025-01-03 14:50:28', '68.5', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:14'),
(12, 'a96676e5-8ae2-425e-b549-7f15dd34a6d8', 'Komi-san wa Komyushou Desu.', 'Oda Tomohito', 'ja', 'https://uploads.mangadex.org/covers/a96676e5-8ae2-425e-b549-7f15dd34a6d8/f8f44329-1dd7-4301-9ec7-a4a76182e8eb.jpg.256.jpg', 'completed', 0, '2025-04-04 07:39:24', '500.5', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:14'),
(13, '1389d660-b9b1-4c6a-81af-eab4dbf3f22b', 'Isekai Meikyuu de Harem wo', 'Sogano Shachi', 'ja', 'https://uploads.mangadex.org/covers/1389d660-b9b1-4c6a-81af-eab4dbf3f22b/c9ceccd1-be1a-4e59-a431-9538a04adc7e.png.256.jpg', 'ongoing', 0, '2025-11-08 04:32:10', '102', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:15'),
(14, 'd86cf65b-5f6c-437d-a0af-19a31f94ec55', 'Ijiranaide, Nagatoro-san', '774 (Nanashi)', 'ja', 'https://uploads.mangadex.org/covers/d86cf65b-5f6c-437d-a0af-19a31f94ec55/5e4a4e0e-b2a6-4e7e-8e6e-169a8d26c7a8.jpg.256.jpg', 'completed', 0, '2023-12-24 13:18:30', '2', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:15'),
(15, '58bc83a0-1808-484e-88b9-17e167469e23', 'Lv2 kara Cheat datta Moto Yuusha Kouho no Mattari Isekai Life', 'Kinojo Miya', 'ja', 'https://uploads.mangadex.org/covers/58bc83a0-1808-484e-88b9-17e167469e23/4d4383c4-fa7c-436b-85e3-f1967eec9d13.jpg.256.jpg', 'ongoing', 0, '2025-11-11 22:20:35', '67', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:16'),
(16, 'eb2d1a45-d4e7-4e32-a171-b5b029c5b0cb', 'Kumo desuga, Nani ka?', 'Baba Okina', 'ja', 'https://uploads.mangadex.org/covers/eb2d1a45-d4e7-4e32-a171-b5b029c5b0cb/1c3917ec-7cb3-4786-bcf2-d259c89562d7.jpg.256.jpg', 'ongoing', 0, '2025-11-23 13:48:33', '76.2', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:16'),
(17, '7643e9f6-8455-4a58-b7e8-bf6cd00f5251', 'Tsuki ga Michibiku Isekai Douchuu', 'Azumi Kei', 'ja', 'https://uploads.mangadex.org/covers/7643e9f6-8455-4a58-b7e8-bf6cd00f5251/79b51099-ce55-4d19-b755-f94b93375696.jpg.256.jpg', 'ongoing', 1, '2025-11-24 12:52:27', '112', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:17'),
(18, 'bd38c075-8b12-450a-aeee-125e3ac5da4b', 'Fukushuu wo Koinegau Saikyou Yuusha wa, Yami no Chikara de Senmetsu Musou Suru', 'Ononata Manimani', 'ja', 'https://uploads.mangadex.org/covers/bd38c075-8b12-450a-aeee-125e3ac5da4b/b8632315-3701-4656-a668-1137d07c68dc.jpg.256.jpg', 'ongoing', 1, '2025-11-11 02:52:06', '125', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:17'),
(19, 'da88b8f1-0b6f-4e69-a07f-ec1c624b2aa7', 'Reincarnation Coliseum: The Weakest Skill Conquers the Strongest Women and Creates a Harem', 'Harawata Saizou', 'ja', 'https://uploads.mangadex.org/covers/da88b8f1-0b6f-4e69-a07f-ec1c624b2aa7/da202537-9298-4a6e-94ed-0705bb99c90b.jpg.256.jpg', 'ongoing', 1, '2025-10-29 08:21:24', '34', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:18'),
(20, '6670ee28-f26d-4b61-b49c-d71149cd5a6e', 'Mieruko-chan', 'Izumi Tomoki', 'ja', 'https://uploads.mangadex.org/covers/6670ee28-f26d-4b61-b49c-d71149cd5a6e/715a15ee-4e9a-44f2-a9b7-2eefcc1ef949.jpg.256.jpg', 'ongoing', 0, '2025-10-22 10:34:20', '67.5', NULL, NULL, '2025-11-19 05:06:05', '2025-11-25 04:11:18'),
(21, '1044287a-73df-48d0-b0b2-5327f32dd651', 'JoJo\'s Bizarre Adventure, Part 7: Steel Ball Run (Official Colored)', 'Araki Hirohiko', 'ja', 'https://uploads.mangadex.org/covers/1044287a-73df-48d0-b0b2-5327f32dd651/e7e5e267-502f-4b77-9f19-b7ea1344f68f.jpg.256.jpg', 'completed', 1, '2018-01-30 16:08:19', '95', 9.66, 0, '2025-11-21 07:56:21', '2025-11-25 04:10:44'),
(22, 'd1a9fdeb-f713-407f-960c-8326b586e6fd', 'Vagabond', 'Inoue Takehiko, Yoshikawa Eiji', 'ja', 'https://uploads.mangadex.org/covers/d1a9fdeb-f713-407f-960c-8326b586e6fd/05f8dcb4-8ea1-48db-a0b1-3a8fbf695e5a.jpg.256.jpg', 'hiatus', 1, '2019-07-28 02:26:58', '324', 9.65, 0, '2025-11-21 07:56:21', '2025-11-25 04:10:45'),
(23, '418791c0-35cf-4f87-936b-acd9cddf0989', 'Kaoru Hana wa Rin to Saku', 'Mikami Saka', 'ja', 'https://uploads.mangadex.org/covers/418791c0-35cf-4f87-936b-acd9cddf0989/3ed6b6fd-0d3f-4ae0-8b39-4b79c9d6dbd6.jpg.256.jpg', 'ongoing', 0, '2025-09-08 10:37:13', '149.5', 9.63, 0, '2025-11-21 07:56:22', '2025-11-25 04:10:45'),
(24, '8b8102da-c875-4dae-a79c-c62e817ff3f5', 'On the Way to Meet Mom', 'Gomyang', 'ko', 'https://uploads.mangadex.org/covers/8b8102da-c875-4dae-a79c-c62e817ff3f5/c59932dc-ec0b-4ba0-9cd7-1a45398e38fa.jpg.256.jpg', 'completed', 0, '2025-05-12 08:08:47', '28', 9.63, 0, '2025-11-21 07:56:23', '2025-11-25 04:10:46'),
(25, '984df7d5-ae4c-43c6-aa65-737b9f37e5ef', 'My Bias Gets on the Last Train', 'JIXKSEE', 'ko', 'https://uploads.mangadex.org/covers/984df7d5-ae4c-43c6-aa65-737b9f37e5ef/95d6c603-5993-42b0-9347-960f79d33f1a.jpg.256.jpg', 'ongoing', 0, '2025-10-04 12:29:29', '49', 9.63, 0, '2025-11-21 07:56:24', '2025-11-25 04:10:46'),
(26, '0d4b349e-b7a2-4d63-9ce0-f864e790c4a2', 'Veil', 'Fukuda Ikumi', 'ja', 'https://uploads.mangadex.org/covers/0d4b349e-b7a2-4d63-9ce0-f864e790c4a2/d007f9f5-c959-4c03-9c8e-4f1bb19f5ecd.jpg.256.jpg', 'ongoing', 0, '2024-01-23 15:04:42', '67', 9.61, 0, '2025-11-21 07:56:25', '2025-11-25 04:10:47'),
(27, 'd7f56ace-cd30-48b9-8b64-afeca0077fca', 'Yeokdaegeum Yeongji Seolgyesa', 'Lee Hyunmin (이현민), BK_Moon (문백경)', 'ko', 'https://uploads.mangadex.org/covers/d7f56ace-cd30-48b9-8b64-afeca0077fca/c2613a1e-426f-4ee3-a6f7-caf003324dc7.jpg.256.jpg', 'completed', 0, '2025-11-20 14:12:51', '216', 9.61, 0, '2025-11-21 07:56:25', '2025-11-25 04:10:47'),
(28, 'd90ea6cb-7bc3-4d80-8af0-28557e6c4e17', 'Dungeon Meshi', 'Kui Ryouko', 'ja', 'https://uploads.mangadex.org/covers/d90ea6cb-7bc3-4d80-8af0-28557e6c4e17/d3430039-ea47-48c3-9b8b-cf80200d7f0b.jpg.256.jpg', 'completed', 0, '2025-05-10 08:20:12', '5', 9.59, 0, '2025-11-21 07:56:27', '2025-11-25 04:10:48'),
(29, '58be6aa6-06cb-4ca5-bd20-f1392ce451fb', 'Yotsuba to!', 'Azuma Kiyohiko', 'ja', 'https://uploads.mangadex.org/covers/58be6aa6-06cb-4ca5-bd20-f1392ce451fb/ff8d4f70-1797-4036-8241-c63b2237254e.jpg.256.jpg', 'ongoing', 0, '2025-03-08 18:14:32', '114', 9.58, 0, '2025-11-21 07:56:27', '2025-11-25 04:10:49'),
(30, '2c4b353f-d968-461b-be49-4f2599189a79', 'Pokemon - Ouja no Saiten', 'Seijun Tombo', 'ja', 'https://uploads.mangadex.org/covers/2c4b353f-d968-461b-be49-4f2599189a79/531cd3f0-6ace-4812-a74a-25dcc2271529.jpg.256.jpg', 'ongoing', 0, '2025-10-20 21:59:40', '18', 9.57, 0, '2025-11-21 07:56:28', '2025-11-25 04:10:49'),
(31, '3fba42cf-2ad6-4c30-a7ab-46cb8149208a', 'Bungou Stray Dogs', 'Asagiri Kafka', 'ja', 'https://uploads.mangadex.org/covers/3fba42cf-2ad6-4c30-a7ab-46cb8149208a/3dc662b2-def7-42d0-98fe-3e92a7224ca3.jpg.256.jpg', 'ongoing', 0, '2025-08-03 12:49:34', '124.5', 9.57, 0, '2025-11-21 07:56:29', '2025-11-25 04:10:49'),
(32, '9d3d3403-1a87-4737-9803-bc3d99db1424', 'Kininatteru Hito ga Otoko ja Nakatta', 'Arai Sumiko', 'ja', 'https://uploads.mangadex.org/covers/9d3d3403-1a87-4737-9803-bc3d99db1424/91935268-394e-4b25-ad34-355c5e2b9e75.jpg.256.jpg', 'ongoing', 0, '2025-11-23 00:53:51', '150', 9.57, 0, '2025-11-21 07:56:29', '2025-11-25 04:10:50'),
(33, '6ecc62e4-25ad-4102-b0d8-580a8023d2fb', 'Kimi to Tsuzuru Utakata', 'Yuama', 'ja', 'https://uploads.mangadex.org/covers/6ecc62e4-25ad-4102-b0d8-580a8023d2fb/571d1d00-9ab1-44ce-b6ab-aa72584ee2f9.jpg.256.jpg', 'completed', 0, '2025-02-08 22:49:20', '32.2', 9.57, 0, '2025-11-21 07:56:30', '2025-11-25 04:10:50'),
(34, 'b30dfee3-9d1d-4e8d-bfbe-8fcabc3c96f6', 'JoJo\'s Bizarre Adventure Part 7 - Steel Ball Run', 'Araki Hirohiko', 'ja', 'https://uploads.mangadex.org/covers/b30dfee3-9d1d-4e8d-bfbe-8fcabc3c96f6/88d9920d-2164-406e-a998-4e7a1789e101.jpg.256.jpg', 'completed', 1, '2018-06-28 12:47:46', '95', 9.56, 0, '2025-11-21 07:56:31', '2025-11-25 04:10:51'),
(35, 'a1c7c817-4e59-43b7-9365-09675a149a6f', 'ONE PIECE', 'Oda Eiichiro', 'ja', 'https://uploads.mangadex.org/covers/a1c7c817-4e59-43b7-9365-09675a149a6f/cb063999-b269-4a27-9fb5-f3ed067fe85a.jpg.256.jpg', 'ongoing', 1, '2025-11-23 08:06:43', '1166', 9.55, 0, '2025-11-21 07:56:31', '2025-11-25 04:10:51'),
(36, 'df9be021-ff37-419e-ba6e-dda3e28eb763', 'Kono Oto Tomare!', 'Sakura Amyuu', 'ja', 'https://uploads.mangadex.org/covers/df9be021-ff37-419e-ba6e-dda3e28eb763/8b07e521-5bb9-475b-b8ff-79ce8d07c5e8.jpg.256.jpg', 'ongoing', 0, '2025-05-07 15:03:28', '142', 9.54, 0, '2025-11-21 07:56:32', '2025-11-25 04:10:52'),
(37, '1693697a-783c-4d3c-a2d3-dc069e137a23', 'No Home', 'Wanan', 'ko', 'https://uploads.mangadex.org/covers/1693697a-783c-4d3c-a2d3-dc069e137a23/bc55de2a-47dd-41cb-9338-75b3f0650a69.jpg.256.jpg', 'completed', 0, '2025-05-08 18:19:39', '105', 9.54, 0, '2025-11-21 07:56:33', '2025-11-25 04:10:53'),
(38, '85b3504c-62e8-49e7-9a81-fb64a3f51def', 'Houkago Kitaku Biyori', 'Matsuda Mai', 'ja', 'https://uploads.mangadex.org/covers/85b3504c-62e8-49e7-9a81-fb64a3f51def/26156408-cd8f-4ecb-a2b7-7cf56cb63a5a.jpg.256.jpg', 'ongoing', 0, '2025-11-04 16:01:12', '46', 9.54, 0, '2025-11-21 07:56:35', '2025-11-25 04:10:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `global_chats`
--

CREATE TABLE `global_chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `global_chats`
--

INSERT INTO `global_chats` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, NULL, 'halo', '2025-11-20 21:10:48', '2025-11-20 21:10:48'),
(2, NULL, 'hallo', '2025-11-20 21:24:16', '2025-11-20 21:24:16'),
(3, NULL, 'hallo', '2025-11-20 21:41:15', '2025-11-20 21:41:15'),
(4, NULL, 'wiaodhjaihswda', '2025-11-20 21:41:21', '2025-11-20 21:41:21'),
(5, 1, 'hi', '2025-11-20 21:42:05', '2025-11-20 21:42:05'),
(6, NULL, 'safdad', '2025-11-21 01:04:22', '2025-11-21 01:04:22'),
(7, NULL, 'dasdsad', '2025-11-21 06:39:54', '2025-11-21 06:39:54'),
(8, NULL, 'asdasd', '2025-11-26 23:03:58', '2025-11-26 23:03:58'),
(9, NULL, 'asudfhksadjfalksdf', '2025-11-26 23:09:49', '2025-11-26 23:09:49'),
(10, NULL, 'sadfsagfdsgfrdshfsdh', '2025-11-26 23:10:06', '2025-11-26 23:10:06');

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
(4, '2025_11_19_135736_add_last_chapter_to_comics_table', 4),
(5, '2025_11_20_002721_add_censorship_enabled_to_users_table', 5),
(6, '2025_11_20_002740_add_is_sensitive_to_comics_table', 5),
(7, '2025_11_20_023230_add_author_to_comics_table', 5),
(8, '2025_11_20_025542_update_comics_author_charset', 5),
(9, '2025_11_20_052107_create_global_chats_table', 5),
(10, '2025_11_21_145234_add_rating_to_comics_table', 6),
(11, '2025_11_25_104914_chapters', 7),
(12, '2025_11_25_145811_chapters', 8);

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
  `censorship_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_image`, `profile_banner`, `level`, `censorship_enabled`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$zC.x5YSlufV8N1KbXpqpweUhJYs90/rqCQcw9JNSPxRaR.l.YwTfO', 'profile/tales.jpg', 'profile_banners/tales.jpg\r\n', 'admin', 0, '2025-11-09 20:27:46', '2025-11-21 15:24:44'),
(2, 'Hengker', 'hengker@hengker.com', '$2y$12$w.1eeufiwhZKb2E54MOQyOkMxQskD3VvN5YT/lw5EySttNtCCcwW6', NULL, NULL, 'user', 1, '2025-11-09 20:58:51', '2025-11-09 20:58:51');

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
-- Indeks untuk tabel `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chapters_mangadex_id_unique` (`mangadex_id`),
  ADD KEY `chapters_comic_id_chapter_num_index` (`comic_id`),
  ADD KEY `chapters_translated_language_index` (`translated_language`);

--
-- Indeks untuk tabel `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comics_mangadex_id_unique` (`mangadex_id`);

--
-- Indeks untuk tabel `global_chats`
--
ALTER TABLE `global_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `global_chats_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT untuk tabel `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `comics`
--
ALTER TABLE `comics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `global_chats`
--
ALTER TABLE `global_chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_comic_id_foreign` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `global_chats`
--
ALTER TABLE `global_chats`
  ADD CONSTRAINT `global_chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
