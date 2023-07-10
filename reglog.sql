-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 05:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reglog`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_project`
--

CREATE TABLE `tb_project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `project_description` text DEFAULT NULL,
  `project_industry` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `vision` varchar(255) DEFAULT NULL,
  `Mision` varchar(300) DEFAULT NULL,
  `pitchdeck` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_project`
--

INSERT INTO `tb_project` (`id`, `project_name`, `project_description`, `project_industry`, `created_at`, `image`, `vision`, `Mision`, `pitchdeck`) VALUES
(1, 'Nextstep', 'Social Media platforms to find exiciting project', 'technology', '2023-07-09 03:39:17', 'uploads/newlogons.png', 'Connecting people with exciting project', 'menjadi perusahaan social media yang produktiv', 'www.zaky.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(75) NOT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `username`, `email`, `password`, `bio`, `profile_picture`, `title`) VALUES
(1, 'Muhammad Zaky', 'zaky', 'jackdesign03@gmail.com', 'Jancokkalian123', 'nama saya muhammad zaky saya berasal dari sidoarjo dan saya seorang mahasiswa teknik informatik politeknik negeri jember angkatan 2023 dan saya berumur 20 tahun dan saya ingin menjadi seorang founder dan ceo nextstep sebuah social media', 'uploads/1.jpg', 'CEO - Nextstep'),
(2, 'Muhammad Ghufron', 'ghufron', 'ghufron123@gmail.com', 'jancok123', 'saya lahir di sidoarjo dan sma di sma antartika sidoarjo dan kuliah jurusan teknologi pendidikan universitas negeri surabaya\r\n', 'uploads/2.jpg', 'CEO - Nextstep');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
