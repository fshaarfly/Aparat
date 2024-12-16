-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 04:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aparat`
--

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `alasan` text NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `tanggal_buat` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `user_id`, `nama`, `nim`, `tahun_ajaran`, `jurusan`, `prodi`, `alasan`, `jenis_surat`, `tanggal_buat`) VALUES
(16, 3, 'agus', '12345', '2123', 'Informatika', 'TRPL', 'Untuk bla', 'SKM', '2024-12-16'),
(19, 3, 'asdasd', 'asdasdas', 'asdasdas', 'dasdasd', 'asdasda', 'sdasdas', 'SKM', '2024-12-16'),
(35, 1, 'asdas', 'asdas', 'asdas', 'asdas', 'asd', 'asdas', 'SKM', '2024-12-16'),
(36, 1, 'dasd', 'asd', 'asd', 'asd', 'asd', 'asd', 'LKA', '2024-12-16'),
(37, 1, 'asdasd', 'asdasd', 'asdas', 'asdas', 'asd', 'asda', 'SKM', '2024-12-16'),
(38, 4, 'apis', '23', '2024', 'infor', 'fit', 'test 123', 'SKM', '2024-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `role`, `remember_token`) VALUES
(1, 'fshaarfly', 'fasha123', '2024-12-16 16:53:42', 0, 'f71dce3b93557ddd8868a2a0301cda8c'),
(2, 'admin', 'admin', '2024-12-16 16:54:15', 1, '10dbca1cad73b24549c8ba34557c68c6'),
(3, 'radhi', 'radhi123', '2024-12-16 17:55:09', 0, 'f6f8cc337175ad419529e317b360e283'),
(4, 'apis', 'apis123', '2024-12-16 22:08:12', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
