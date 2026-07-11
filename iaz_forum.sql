-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 07, 2026 at 02:55 PM
-- Server version: 8.0.42
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iaz_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `category` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Front-end Development'),
(2, 'Back-end Development'),
(3, 'Mobile Development'),
(4, 'Database Management'),
(5, 'Multi-platform App Development'),
(8, 'Game Development'),
(9, 'Game Development'),
(10, 'Machine Learning'),
(11, 'Deep Learning'),
(14, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int NOT NULL,
  `thread_id` int NOT NULL,
  `user_id` int NOT NULL,
  `star` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `thread_id`, `user_id`, `star`) VALUES
(59, 1212, 271, 5),
(60, 1212, 280, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rating_view`
-- (See below for the actual view)
--
CREATE TABLE `rating_view` (
`thread_id` int
,`star_sum` decimal(32,0)
,`star_count` bigint
,`rating` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int NOT NULL,
  `thread_id` int NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Maks. karakter 255.',
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `thread_id`, `content`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(115, 1212, '<p>Masalah biasanya karena <i>named route</i> yang awalnya sama tetapi kamu <strong>mendefinisikan ulang route tanpa nama saat memindahkan ke group, atau cache route masih memakai konfigurasi lama</strong>.</p><ol><li><p>Pastikan route di routes/web.php memakai -&gt;name(\'users.show\') di dalam group:&nbsp;</p><p>Route::prefix(\'admin\')-&gt;name(\'admin.\')-&gt;group(function () {</p><p>&nbsp; &nbsp;Route::get(\'users/{user}\', [UserController::class, \'show\'])-&gt;name(\'users.show\');&nbsp;</p><p>});</p></li><li>Perhatikan nama: sekarang route akan bernama admin.users.show. Panggilan route(\'users.show\', $id) tidak akan mengembalikan prefix — gunakan route(\'admin.users.show\', $id).</li><li>Jika ingin tetap menggunakan users.show tanpa admin.prefix, tambahkan -&gt;withoutPrefix() tidak ada di Laravel; jadi solusinya adalah menyesuaikan nama route atau memanggil route lama.</li><li><p>Hapus cache route:&nbsp;</p><p>&nbsp; &nbsp;php artisan route:clear</p><p>&nbsp; &nbsp;php artisan config:clear</p><p>&nbsp; &nbsp;php artisan cache:clear</p></li></ol><p>Intinya periksa nama route (named route) setelah dipindah — kemungkinan berubah.</p>', '2025-12-26 10:42:51', 280, '2025-12-26 13:53:51', 271);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `id` int NOT NULL,
  `title` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int NOT NULL,
  `content` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`id`, `title`, `category_id`, `content`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1212, 'Laravel Route() mengembalikan URL yang salah setelah dipindahkan kedalam group dengan prefix', 2, '<p>Saya punya route bernama <strong>users.show</strong> yang ada di <strong>web.php</strong> langsung. Setelah dipindahkan kedalam group dengan <strong>prefix(\'admin\')</strong>, pemanggilan route(\'users.show\', $id) menghasilkan URL tanpa prefix “admin”.&nbsp;</p><p>Excpected: <i>localhost:8080/admin/users/show/12x</i></p><p>What i got: <i>localhost:8080/users/show/12x</i></p><p>Saya sudah coba <strong>php artisan route:clear</strong> namun masalahnya belum hilang. Mengapa ini terjadi dan bagaimana memperbaikinya?</p>', '2025-12-25 14:09:46', 271, '2025-12-26 13:44:36', 271),
(1218, 'Migration: mengubah kolom ENUM menjadi string tanpa kehilangan data', 2, '<p>Di MySQL saya punya kolom status bertipe ENUM(\'draft\',\'published\'). Saya ingin menambah value baru dan akhirnya mengganti tipe menjadi string untuk fleksibilitas. Bagaimana migrasi yang aman agar data tidak hilang?</p>', '2025-12-31 07:53:46', 280, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `salt` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `birthdate` date NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Maks. 255 karakter(teks)',
  `phone_number` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('Admin','Member') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Member',
  `status` enum('Active','Not active','','') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Not active',
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `name`, `email`, `birthdate`, `address`, `phone_number`, `avatar`, `role`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(271, 'raihanys03', '0497b7a2f3c7a87d258cbfb453d43622', '68f5e116ed7133.95569068', 'Raihan Yudi Syukma', 'raihanys03@gmail.com', '2025-10-26', 'Jl. Purnama Sari, Cluster Taman Sari No. 1, Pekanbaru', '0819-9057-6161', '1766375980_650ee2100db754a37d2d.jpg', 'Admin', 'Active', '2025-10-20 07:13:26', 0, '2025-12-22 03:59:40', 0),
(280, 'Buds01', '5e4b06441489dd62e7d290401e169795', '694e6679d47052.59288447', 'Budiman Sanjaya', 'buds@gmail.com', '2007-07-29', 'Jl. Purnama Sari, Cluster Taman Sari No. 1', '0819-9057-6161', '1767168776_4f3152ebcc27d5a81e93.jpg', 'Member', 'Active', '2025-12-26 10:42:01', 0, '2025-12-31 08:12:56', 0),
(281, 'putirs07', '89c935b4b2c19d7d3ebe27f84750afb4', '694f3ef8d6fa73.08418833', 'Puti Raina Syahwara', 'puitrs07@gmail.com', '2007-07-29', 'Jl. Purnama Sari', '0819-9057-6161', '1766801144_bf693113cc8734ba9cae.jpg', 'Member', 'Active', '2025-12-27 02:05:44', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_ibfk_1` (`thread_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_thread` (`thread_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`category_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1219;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

-- --------------------------------------------------------

--
-- Structure for view `rating_view`
--
DROP TABLE IF EXISTS `rating_view`;

CREATE VIEW `rating_view`  AS SELECT `rating`.`thread_id` AS `thread_id`, sum(`rating`.`star`) AS `star_sum`, count(`rating`.`star`) AS `star_count`, round((sum(`rating`.`star`) / count(`rating`.`star`)),0) AS `rating` FROM `rating` GROUP BY `rating`.`thread_id` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thread_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thread_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
