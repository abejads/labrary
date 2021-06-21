-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 10 Jun 2021 pada 13.32
-- Versi Server: 5.7.34-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labrary`
--
CREATE DATABASE IF NOT EXISTS `labrary` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `labrary`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `courseID` int(11) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `courseDetails` varchar(255) NOT NULL,
  `courseAuthor` varchar(255) NOT NULL,
  `courseURL` varchar(255) NOT NULL,
  `courseImage` varchar(255) NOT NULL,
  `isPremium` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`courseID`, `courseName`, `courseDetails`, `courseAuthor`, `courseURL`, `courseImage`, `isPremium`) VALUES
(1, 'Basic Web Security', 'Websites all around the world are programmed using various programming languages. While there are specific vulnerabilities in each programming langage that the developer should be aware of.', 'Cyber Security IPB', 'https://www.youtube.com/embed/videoseries?list=PLhixgUqwRTjx2BmNF5-GddyqZcizwLLGP', 'web-security.jpg', 0),
(2, 'Basic Binary Exploitation', 'Binary Exploitation is a broad topic within Cyber Security which really comes down to finding a vulnerability in the program and exploiting it to gain control of a shell or modifying the program\'s functions.', 'Cyber Security IPB', 'REDACTED', 'binex.jpeg', 0),
(3, 'Basic Reverse Engineering', 'Reverse Engineering is typically the process of taking a compiled (machine code, bytecode) program and converting it back into a more human readable format.', 'Cyber Security IPB', 'REDACTED', 'reversing.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `idTransaction` varchar(255) NOT NULL,
  `idAccount` int(10) NOT NULL,
  `detailTransaction` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`idTransaction`, `idAccount`, `detailTransaction`) VALUES
('4d6252b5e32e60c22b8ae7201fb171cf', 1, 'monthly'),
('dd4155bb8a7bc04ed892f863526d1acd', 1, 'monthly'),
('150a9c8f40561e455c774f294faa10c6', 1, 'monthly'),
('902a85cf713db6b0861a5f5aab0a786f', 1, 'monthly'),
('65b65bec009237a59f7c1b85cc2abed4', 1, 'monthly'),
('1db2d42e588585f2ff5472babedb8bf1', 1, 'monthly'),
('d0e69f5cc04b1fdbb4161305e57b0ee3', 1, 'monthly'),
('aa7fecd67a44ae4df0f90ba1e9d3159f', 1, 'monthly');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `premium` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `telephone`, `address`, `premium`) VALUES
(1, 'ryo', 'ryo@yahoo.com', '$2y$10$A/XV1OM1h.hHs16FKfEPT.kKIm25MdaNz35UK1d9w6yqoD6HKPYCO', '8123818888888', '123123312', 0),
(2, 'asd', 'asd@asd.com', '$2y$10$gceUthg4ObkB3V2kc2mkeeR.RZcBiNH64kWRywnUeFA500LuTfyra', 'asdds', 'asddas', 0),
(3, 'Fujimori', 'fujimori@gmail.com', '$2y$10$JCKuc0BvqDwD.aFaqlkSCOQH4M.Q6IQEy.JO14Uhkqwa/tMA84wQ6', '', '', 0),
(4, 'test', 'test@test.com', '$2y$10$AD5qYs4G/T74E0UweyyYB.Ek/xiIy8TA3KdsEzFxz0uLnqwiX7UrC', '', '', 0),
(5, 'asd', 'res@res.com', '$2y$10$HXwQIbxZs9/bbU0USqmCIu0aGwzEnbYstKzG6jximYWH.o0zyJi0u', '', '', 0),
(6, 'Jessica Geofanie', 'geofanie48@gmail.com', '$2y$10$BEyT662qkdgkS9jDWbI4cu2pKew.sbKqdvXHRo9fauN26K2r2D9iG', '', '', 0),
(7, 'rubil', 'rubil_m@hotmail.com', '$2y$10$GFPqJYxlf34QNlGZZUGiwOiDUFvJjGCtFy4qqk3yjiQsbuXjWGAE6', '', '', 0),
(8, 'ryo juga', 'test@ryo.com', '$2y$10$cKQ6.R6Zi1Yv8JUrE8EX1eCxT10IaUrapKffvA0rr7nWBzjgUFK/G', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
