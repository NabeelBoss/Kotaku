-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 11:44 AM
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
-- Database: `kotaku`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `message_text` varchar(255) DEFAULT NULL,
  `sent_time` datetime DEFAULT current_timestamp(),
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `message_text`, `sent_time`, `sender_id`, `receiver_id`) VALUES
(6, 'Hi', '2024-09-25 18:16:20', 11, 17),
(7, 'afnan here', '2024-09-25 18:16:29', 11, 17),
(8, 'How are you', '2024-09-25 21:48:56', 11, 17),
(9, 'REPLY?', '2024-09-25 21:59:09', 11, 17),
(10, 'Hi', '2024-09-26 00:13:14', 18, 17),
(11, 'Arham Here', '2024-09-26 00:13:30', 18, 17),
(12, 'Hi Arham', '2024-09-26 02:38:51', 11, 18),
(13, 'Mai Afnan', '2024-09-26 02:42:19', 11, 18),
(14, 'G Bhai', '2024-09-26 02:49:21', 17, 11),
(15, 'Bolo', '2024-09-26 02:49:41', 17, 11),
(16, 'kuch nh', '2024-09-27 07:46:20', 11, 17),
(33, 'ab bolo', '2024-09-27 09:08:37', 17, 11),
(46, 'hello arham', '2024-09-27 09:41:33', 17, 18),
(54, '...', '2024-09-27 10:29:51', 17, 18),
(55, 'sss', '2024-09-27 10:46:27', 18, 17),
(58, 'Hi', '2024-09-28 01:26:27', 16, 11),
(59, '', '2024-09-28 01:27:06', 11, 16),
(60, 'lk', '2024-09-28 01:28:22', 11, 17),
(61, 'hlo', '2024-09-28 13:06:10', 11, 17),
(62, 'hlo', '2024-09-28 14:17:02', 11, 17),
(63, 'heheh', '2024-09-28 14:27:57', 11, 17),
(64, 'asdf', '2024-09-28 14:38:39', 17, 11),
(65, 'okok', '2024-09-28 14:55:21', 11, 17),
(66, 'iuiiuuiui', '2024-09-28 15:15:30', 11, 17);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friend_id` int(11) NOT NULL,
  `user_one` int(11) DEFAULT NULL,
  `user_two` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend_id`, `user_one`, `user_two`) VALUES
(7, 6, 11),
(8, 9, 11),
(10, 9, 16),
(11, 11, 16),
(13, 17, 11),
(14, 6, 9),
(15, 17, 9),
(16, 6, 15),
(17, 17, 15),
(18, 17, 16),
(19, 17, 18),
(20, 9, 18),
(21, 11, 18),
(22, 15, 18),
(23, 16, 18),
(24, 15, 11),
(25, 9, 21),
(26, 11, 21),
(27, 15, 21),
(28, 16, 21),
(29, 17, 21),
(30, 18, 21),
(31, 9, 20),
(32, 11, 20),
(33, 15, 20),
(34, 16, 20),
(35, 17, 20),
(36, 9, 19),
(37, 11, 19),
(38, 15, 19),
(39, 16, 19),
(40, 17, 19),
(41, 15, 9),
(42, 15, 16);

-- --------------------------------------------------------

--
-- Table structure for table `frnd_req`
--

CREATE TABLE `frnd_req` (
  `frndreq_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `frnd_req`
--

INSERT INTO `frnd_req` (`frndreq_id`, `sender_id`, `receiver_id`) VALUES
(59, 16, 6),
(68, 17, 6);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameid` int(11) NOT NULL,
  `gamename` varchar(255) NOT NULL,
  `gameimage` varchar(255) DEFAULT NULL,
  `gameurl` varchar(255) DEFAULT NULL,
  `gameperms` varchar(55) DEFAULT NULL,
  `gameprice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameid`, `gamename`, `gameimage`, `gameurl`, `gameperms`, `gameprice`) VALUES
(1, 'Memory Card', 'assets/img/memorycard.png', 'memorycards.php', 'unlocked', NULL),
(2, 'Typing Speed Test', 'assets/img/typingtest.png', 'typingtest.php', 'locked', 50),
(4, 'Hangman', 'assets/img/hangman.png', 'hangman.php', 'locked', NULL),
(5, 'Rock Paper Scissors', 'assets/img/rps.png', 'RPS.php', 'unlocked', NULL),
(6, 'Guess The Word', 'assets/img/guesstheword.png', 'wordguessing.php', 'unlocked', NULL),
(7, 'Snake', 'assets/img/snake.png', 'snake.php', 'unlocked', NULL),
(8, 'Tic Tac Toe', 'assets/img/tictactoe.png', 'tictactoe.php', 'unlocked', NULL),
(9, 'Word Scramble', 'assets/img/wordscramble.png', 'wordscramble.php', 'unlocked', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `scoreid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `scoreplayer` int(11) DEFAULT NULL,
  `scoregame` int(11) DEFAULT NULL,
  `gametoken` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`scoreid`, `score`, `scoreplayer`, `scoregame`, `gametoken`) VALUES
(3, 460, 6, 1, 0),
(6, 326, 9, 2, 0),
(7, 378, 6, 2, 0),
(16, 90, 9, 4, 0),
(18, 1148, 9, 2, 0),
(20, 1274, 11, 2, 0),
(21, 1224, 11, 2, 0),
(22, 1348, 11, 2, 0),
(23, 204, 16, 1, 0),
(24, 2, 17, 7, 0),
(25, 0, 6, 4, 0),
(26, 250, 6, 1, 0),
(27, 250, 6, 1, 0),
(28, 220, 6, 2, 0),
(29, 54, 6, 7, 0),
(30, 32, 6, 7, 0),
(31, 0, 6, 7, 0),
(32, 0, 6, 7, 0),
(33, 0, 6, 7, 0),
(34, 0, 6, 7, 0),
(35, 3, 6, 7, 0),
(36, 1, 6, 7, 0),
(37, 0, 6, 7, 0),
(38, 2, 6, 7, 0),
(39, 24, 6, 7, 0),
(40, 0, 6, 4, 0),
(41, 0, 6, 4, 0),
(42, 0, 6, 4, 0),
(43, 0, 6, 4, 0),
(44, 0, 6, 4, 0),
(45, 0, 6, 4, 0),
(46, 0, 6, 4, 0),
(47, 0, 6, 4, 0),
(48, 0, 6, 4, 0),
(49, 200, 6, 4, 0),
(50, 100, 16, 4, 0),
(51, 250, 16, 4, 0),
(52, 300, 16, 1, 0),
(53, 101, 16, 1, 0),
(54, 250, 11, 1, 20),
(55, 50, 11, 4, 5),
(56, 200, 11, 4, 20),
(57, 188, 11, 2, 0),
(58, 238, 11, 2, 0),
(59, 219, 11, 2, 30),
(60, 17, 11, 7, 8),
(61, 1, 11, 7, 0),
(62, 1, 11, 7, 0),
(63, 1, 11, 7, 0),
(64, 2, 11, 7, 1),
(65, 6, 11, 7, 3),
(66, 14, 11, 7, 7),
(67, 4, 11, 7, 2),
(68, 3, 11, 7, 1),
(69, 1, 11, 7, 0),
(70, 0, 17, 8, 0),
(71, 10, 17, 8, 0),
(72, 300, 17, 1, 30),
(73, 3, 17, 7, 1),
(74, 1, 11, 7, 0),
(75, 1, 11, 7, 0);

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
(6, 'Spider', '03069696969', 'Spider@gmail.com', '123', 'ADMIN', 'assets/img/spider.png', 'assets/img/spider.gif'),
(9, 'Mohsin', '03069696969', 'mohsin@gmail.com', '123', 'PLAYER', 'assets/img/avatar1.png', 'assets/img/download.jfif'),
(11, 'Afnan', '03092486110', 'affu@gmail.com', '123', 'PLAYER', 'assets/img/affu.jpg', 'assets/img/neon.gif'),
(15, 'Ali', '03069696969', 'ali@gmail.com', '123', 'PLAYER', 'assets/img/ali.jpg', 'assets/img/nabeelgif.webp'),
(16, 'Shaheer', '03092486110', 'shaheer@gmail.com', '123', 'PLAYER', 'assets/img/nn.jpg', 'assets/img/huzaifagif.webp'),
(17, 'Nabeel', '0312636404', 'nabeel@gmail.com', '123', 'PLAYER', 'assets/img/IMG_E2903.JPG', 'assets/img/gifimagenabeel.webp'),
(18, 'Arham', '03132648710', 'arham@gmail.com', '123', 'PLAYER', 'assets/img/arham.jpg', 'assets/img/arhamgif.webp'),
(19, 'Razzaq', '0312315841', 'razzaq@gmail.com', '123', 'PLAYER', 'assets/img/razzaap1.jpg', 'assets/img/razzaqgif.webp'),
(20, 'Basit', '0313262324', 'basit@gmail.com', '123', 'PLAYER', 'assets/img/razzap2.jpg', 'assets/img/razzaqgif2.webp'),
(21, 'Huzaifa', '03132645444', 'huzaifa@gmail.com', '123', 'PLAYER', 'assets/img/huzaifabbc.jpg', 'assets/img/extragif.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friend_id`),
  ADD KEY `user_one` (`user_one`),
  ADD KEY `user_two` (`user_two`);

--
-- Indexes for table `frnd_req`
--
ALTER TABLE `frnd_req`
  ADD PRIMARY KEY (`frndreq_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

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
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `frnd_req`
--
ALTER TABLE `frnd_req`
  MODIFY `frndreq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `scoreid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `userreg`
--
ALTER TABLE `userreg`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `userreg` (`userid`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `userreg` (`userid`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_one`) REFERENCES `userreg` (`userid`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`user_two`) REFERENCES `userreg` (`userid`);

--
-- Constraints for table `frnd_req`
--
ALTER TABLE `frnd_req`
  ADD CONSTRAINT `frnd_req_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `userreg` (`userid`),
  ADD CONSTRAINT `frnd_req_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `userreg` (`userid`);

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
