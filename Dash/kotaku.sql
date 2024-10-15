-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 02:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kotaku`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameid` int(11) NOT NULL,
  `gamename` varchar(255) NOT NULL,
  `gameimage` varchar(255) DEFAULT NULL,
  `gameurl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameid`, `gamename`, `gameimage`, `gameurl`) VALUES
(2, 'FREE FIRE', 'User Images/free fire.jpeg', 'freefire.php'),
(3, 'PUBG', 'Game Images/pubg.jpeg', 'pubg.php');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `scoreid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `scoreplayer` int(11) DEFAULT NULL,
  `scoregame` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`scoreid`, `score`, `scoreplayer`, `scoregame`) VALUES
(2, 100, 12, 2),
(3, 200, 13, 3),
(4, 400, 16, 2),
(5, 500, 18, 2),
(7, 600, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userreg`
--

CREATE TABLE `userreg` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `usernumber` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `userrole` varchar(255) DEFAULT NULL,
  `userprofile` varchar(255) DEFAULT NULL,
  `userbanner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userreg`
--

INSERT INTO `userreg` (`userid`, `username`, `usernumber`, `useremail`, `userpass`, `userrole`, `userprofile`, `userbanner`) VALUES
(12, 'Imran Khan', '03132639403', 'imran@gmail.com', 'imran', 'ADMIN', 'User Images/imran.jpeg', 'User Banners/gif1.webp'),
(13, 'Chor', '03132639403', 'Chor@gmail.com', 'Chor', 'PLAYER', 'User Images/chor.jpeg', 'User Banners/gif2.webp'),
(16, 'Muhammad Nabeel', '03132639403', 'mn598833@gmail.com', 'nabeel', 'PLAYER', 'User Images/nabeel.jpg', 'User Banners/gifnabeel.webp'),
(18, 'Afnan', '0334349403', 'Afnan@gmail.com', 'Afnan', 'PLAYER', 'User Images/afnan.jpg', 'User Banners/gifaffu.webp'),
(19, 'Altaf hussain', '03126445425', 'altaf@gmail.com', 'altaf', 'PLAYER', 'User Images/altaf.jpeg', 'User Banners/aa.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameid`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`scoreid`),
  ADD KEY `scoreplayer` (`scoreplayer`),
  ADD KEY `scoregame` (`scoregame`);

--
-- Indexes for table `userreg`
--
ALTER TABLE `userreg`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `scoreid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userreg`
--
ALTER TABLE `userreg`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`scoreplayer`) REFERENCES `userreg` (`userid`),
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`scoregame`) REFERENCES `games` (`gameid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
