-- phpMyAdmin SQL Dump
-- version 4.9.0.1-mh4
-- https://www.phpmyadmin.net/
--
-- Host: u461885.mysql.masterhost.ru
-- Generation Time: Feb 12, 2020 at 03:11 PM
-- Server version: 5.6.40-log
-- PHP Version: 7.0.33-0+deb9u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u461885`
--

-- --------------------------------------------------------

--
-- Table structure for table `chess_games`
--

CREATE TABLE `chess_games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `player1Id` bigint(20) NOT NULL,
  `player2Id` bigint(20) NOT NULL,
  `player1RatingBefore` int(11) NOT NULL,
  `player1RatingAfter` int(11) NOT NULL,
  `player2RatingBefore` int(11) NOT NULL,
  `player2RatingAfter` int(11) NOT NULL,
  `result` int(11) NOT NULL,
  `tournament_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chess_games`
--

INSERT INTO `chess_games` (`id`, `date`, `player1Id`, `player2Id`, `player1RatingBefore`, `player1RatingAfter`, `player2RatingBefore`, `player2RatingAfter`, `result`, `tournament_id`) VALUES
(1, '2019-09-14 12:18:41', 1, 23, 800, 808, 800, 793, 1, 1),
(2, '2019-09-14 12:18:57', 2, 22, 800, 808, 800, 793, 1, 1),
(3, '2019-09-14 12:19:05', 15, 3, 800, 793, 800, 808, -1, 1),
(4, '2019-09-14 12:19:23', 5, 3, 800, 808, 808, 800, 1, 1),
(5, '2019-09-14 12:19:32', 1, 2, 808, 801, 808, 816, -1, 1),
(6, '2019-09-14 12:19:40', 2, 5, 816, 823, 808, 801, 1, 1),
(7, '2019-10-12 12:20:45', 4, 10, 800, 808, 800, 793, 1, 2),
(8, '2019-10-12 12:20:51', 4, 12, 808, 815, 800, 793, 1, 2),
(9, '2019-10-12 12:20:57', 4, 23, 815, 822, 793, 786, 1, 2),
(10, '2019-11-09 12:21:35', 16, 7, 800, 793, 800, 808, -1, 3),
(11, '2019-11-09 12:21:42', 17, 23, 800, 800, 786, 786, 0, 3),
(12, '2019-11-09 12:21:48', 17, 23, 800, 800, 786, 786, 0, 3),
(13, '2019-11-09 12:21:53', 17, 23, 800, 800, 786, 786, 0, 3),
(14, '2019-11-09 12:22:00', 17, 23, 800, 792, 786, 794, -1, 3),
(15, '2019-11-09 12:22:10', 8, 7, 800, 808, 808, 800, 1, 3),
(16, '2019-11-09 12:22:17', 10, 22, 793, 801, 793, 786, 1, 3),
(17, '2019-11-09 12:22:26', 18, 3, 800, 793, 800, 808, -1, 3),
(18, '2019-11-09 12:22:35', 12, 23, 793, 793, 794, 794, 0, 3),
(19, '2019-11-09 12:22:41', 12, 23, 793, 801, 794, 786, 1, 3),
(20, '2019-11-09 12:22:50', 10, 8, 801, 809, 808, 800, 1, 3),
(21, '2019-11-09 12:22:56', 3, 12, 808, 815, 801, 794, 1, 3),
(22, '2019-11-09 12:23:04', 3, 10, 815, 822, 809, 802, 1, 3),
(23, '2019-12-07 12:25:29', 3, 13, 822, 829, 800, 793, 1, 4),
(24, '2019-12-07 12:25:44', 4, 14, 822, 829, 800, 793, 1, 4),
(25, '2019-12-07 12:25:53', 6, 19, 800, 808, 800, 793, 1, 4),
(26, '2019-12-07 12:26:00', 20, 24, 800, 793, 800, 808, -1, 4),
(27, '2019-12-07 12:26:06', 9, 23, 800, 800, 786, 786, 0, 4),
(28, '2019-12-07 12:26:13', 9, 23, 800, 807, 786, 779, 1, 4),
(29, '2019-12-07 12:26:25', 3, 10, 829, 836, 802, 795, 1, 4),
(30, '2019-12-07 12:26:32', 4, 6, 829, 836, 808, 801, 1, 4),
(31, '2019-12-07 12:26:39', 11, 21, 800, 808, 800, 793, 1, 4),
(32, '2019-12-07 12:26:47', 9, 24, 807, 800, 808, 815, -1, 4),
(33, '2019-12-07 12:26:55', 3, 4, 836, 844, 836, 829, 1, 4),
(34, '2019-12-07 12:27:02', 11, 24, 808, 801, 815, 822, -1, 4),
(35, '2019-12-07 12:27:11', 3, 24, 844, 851, 822, 815, 1, 4),
(36, '2019-12-07 12:27:20', 11, 4, 801, 794, 829, 836, -1, 4),
(37, '2019-12-21 12:29:29', 2, 24, 823, 830, 815, 808, 1, 5),
(38, '2019-12-21 12:29:36', 3, 4, 851, 843, 836, 844, -1, 5),
(39, '2019-12-21 12:29:44', 3, 2, 843, 835, 830, 838, -1, 5),
(40, '2019-12-21 12:29:54', 24, 4, 808, 801, 844, 851, -1, 5),
(41, '2019-12-21 12:30:00', 4, 2, 851, 858, 838, 831, 1, 5),
(42, '2019-12-21 12:30:07', 3, 24, 835, 842, 801, 794, 1, 5),
(43, '2019-12-21 12:30:18', 2, 3, 831, 839, 842, 834, 1, 5),
(44, '2019-12-21 12:30:25', 4, 24, 858, 864, 794, 788, 1, 5),
(45, '2019-12-21 12:30:37', 24, 3, 788, 781, 834, 841, -1, 5),
(46, '2019-12-21 12:30:45', 2, 4, 839, 847, 864, 856, 1, 5),
(47, '2019-12-21 12:30:51', 3, 4, 841, 849, 856, 848, 1, 5),
(48, '2019-12-21 12:30:58', 24, 2, 781, 775, 847, 853, -1, 5),
(49, '2020-01-18 13:59:07', 23, 25, 779, 787, 800, 792, 1, 6),
(50, '2020-01-18 14:00:06', 26, 14, 800, 807, 793, 786, 1, 6),
(51, '2020-01-18 14:00:42', 11, 24, 794, 801, 775, 768, 1, 6),
(52, '2020-01-18 14:01:54', 11, 23, 801, 808, 787, 780, 1, 6),
(53, '2020-01-18 14:03:05', 27, 28, 800, 808, 800, 793, 1, 6),
(54, '2020-01-18 14:03:44', 13, 26, 793, 793, 807, 807, 0, 6),
(55, '2020-01-18 14:03:59', 13, 26, 793, 801, 807, 799, 1, 6),
(56, '2020-01-18 14:04:35', 26, 4, 799, 793, 848, 854, -1, 6),
(57, '2020-01-18 14:05:16', 27, 13, 808, 800, 801, 809, -1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `chess_migrations`
--

CREATE TABLE `chess_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chess_migrations`
--

INSERT INTO `chess_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_01_15_115132_create_players_table', 1),
(4, '2020_01_15_120040_create_games_table', 1),
(5, '2020_01_16_053938_create_tournaments_table', 2),
(6, '2020_01_16_055134_add_tournament_id_to_games_table', 3),
(7, '2020_01_16_081338_add_group_to_players_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `chess_password_resets`
--

CREATE TABLE `chess_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chess_players`
--

CREATE TABLE `chess_players` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `gamesPlayed` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `draws` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `averageOpponentRating` double(8,2) NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chess_players`
--

INSERT INTO `chess_players` (`id`, `name`, `rating`, `gamesPlayed`, `wins`, `draws`, `losses`, `averageOpponentRating`, `group`) VALUES
(1, 'Калинкин Данил', 801, 2, 1, 0, 1, 804.00, '10 А'),
(2, 'Бурнаев Андрей', 853, 9, 8, 0, 1, 823.55, '10 А'),
(3, 'Новиков Павел', 849, 15, 11, 0, 4, 814.13, '3 В'),
(4, 'Сабуров Семен', 854, 14, 11, 0, 3, 814.86, '4 В'),
(5, 'Шештанов Геннадий', 801, 2, 1, 0, 1, 812.00, '9 А'),
(6, 'Карпухин Никита', 801, 2, 1, 0, 1, 814.50, '8 В'),
(7, 'Шехевова Ксения', 800, 2, 1, 0, 1, 800.00, '0'),
(8, 'Сапрыкин Михаил', 800, 2, 1, 0, 1, 804.50, '2 Б'),
(9, 'Мелентович Артемий', 800, 3, 1, 1, 1, 793.33, '8 В'),
(10, 'Миронов Илья', 795, 5, 2, 0, 3, 809.00, '4 Г'),
(11, 'Тесля Тимофей', 808, 5, 3, 0, 2, 801.20, '5 Д'),
(12, 'Казанков Тихомир', 794, 4, 1, 1, 2, 801.00, '10 В'),
(13, 'Камышов Макар', 809, 4, 2, 1, 1, 811.00, '3 А'),
(14, 'Юдин Тимофей', 786, 2, 0, 0, 2, 811.00, '5 Д'),
(15, 'Набережных Яна', 793, 1, 0, 0, 1, 800.00, '5 А'),
(16, 'Манаев Максим', 793, 1, 0, 0, 1, 800.00, '1 Б'),
(17, 'Пьянзин Илья', 792, 4, 0, 3, 1, 786.00, '7 Г'),
(18, 'Григорьев Владимир', 793, 1, 0, 0, 1, 800.00, '1 Д'),
(19, 'Шишкин Александр', 793, 1, 0, 0, 1, 800.00, '8 В'),
(20, 'Акимов Георгий', 793, 1, 0, 0, 1, 800.00, '8 В'),
(21, 'Фитискина Еcения', 793, 1, 0, 0, 1, 800.00, '1 Д'),
(22, 'Карякин Афанасий', 786, 2, 0, 0, 2, 796.50, '3 Г'),
(23, 'Любавина Мария', 780, 12, 2, 5, 5, 800.17, '7 А'),
(24, 'Камышов Михаил', 768, 11, 3, 0, 8, 826.74, '7 Г'),
(25, 'Коротков Арсений', 792, 1, 0, 0, 1, 779.00, '5 Д'),
(26, 'Тесля Елисей', 793, 4, 1, 1, 2, 806.75, '3 Б'),
(27, 'Тесля Севастьян', 800, 2, 1, 0, 1, 800.50, '8 А'),
(28, 'Райх Григорий', 793, 1, 0, 0, 1, 800.00, '5 Д');

-- --------------------------------------------------------

--
-- Table structure for table `chess_tournaments`
--

CREATE TABLE `chess_tournaments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chess_tournaments`
--

INSERT INTO `chess_tournaments` (`id`, `name`) VALUES
(1, 'Сентябрьский турнир 2019'),
(2, 'Октябрьский турнир 2019'),
(3, 'Ноябрьский турнир 2019'),
(4, 'Декабрьский турнир 2019'),
(5, 'Итоговый турнир 2019'),
(6, 'Январский турнир 2020');

-- --------------------------------------------------------

--
-- Table structure for table `chess_users`
--

CREATE TABLE `chess_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chess_users`
--

INSERT INTO `chess_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Безуглов Сергей', 'Besuglov.S@Gmail.com', NULL, '$2y$10$.44tlVuS.IrOOYX7J7yFPeISyUJ4l69SXaJAg7qa1onfyVxaAKe7W', NULL, '2020-01-16 00:52:06', '2020-01-16 00:52:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chess_games`
--
ALTER TABLE `chess_games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chess_migrations`
--
ALTER TABLE `chess_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chess_password_resets`
--
ALTER TABLE `chess_password_resets`
  ADD KEY `chess_password_resets_email_index` (`email`);

--
-- Indexes for table `chess_players`
--
ALTER TABLE `chess_players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chess_tournaments`
--
ALTER TABLE `chess_tournaments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chess_users`
--
ALTER TABLE `chess_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chess_users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chess_games`
--
ALTER TABLE `chess_games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `chess_migrations`
--
ALTER TABLE `chess_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chess_players`
--
ALTER TABLE `chess_players`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `chess_tournaments`
--
ALTER TABLE `chess_tournaments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chess_users`
--
ALTER TABLE `chess_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
