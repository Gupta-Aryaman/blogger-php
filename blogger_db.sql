-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 04:53 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogger_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_user`
--

CREATE TABLE `app_user` (
  `ID` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `password` text NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_user`
--

INSERT INTO `app_user` (`ID`, `first_name`, `last_name`, `password`, `username`) VALUES
(1, 'Anjali', 'Gupta', '12345', 'coral'),
(6, 'Aryaman', 'Gupta', 'secret12345', 'screamy'),
(7, 'Mark', 'Otto', 'pass12', 'marky'),
(8, 'Deepshikha', 'Gupta', 'abc123', 'dg'),
(9, 'vivek', 'gupta', '1234', 'vg'),
(10, 'Coral', 'Forever', 'itsmehi', 'corra');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `post_ID` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE `follower` (
  `ID` int(11) NOT NULL,
  `following_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`ID`, `following_ID`) VALUES
(7, 1),
(7, 6),
(1, 7),
(1, 6),
(9, 6),
(9, 8),
(6, 1),
(1, 8),
(9, 1),
(10, 6),
(10, 1),
(10, 8),
(10, 9),
(10, 7),
(8, 6),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `image_path` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `ID`, `image_path`, `description`) VALUES
(5, 1, 'uploaded_pics/GitHub-Mark.png', 'my github profile pic'),
(6, 1, 'uploaded_pics/1200px-Suricata_loro_parque.jpg', 'suricata test'),
(9, 1, 'uploaded_pics/pexels-vedant-sharma-440305.jpg', 'Eiffel Tower -Loved the visit'),
(10, 1, 'uploaded_pics/pexels-griffin-wooldridge-4811117.jpg', 'Diwali Dhamaka!!!'),
(12, 6, 'uploaded_pics/pexels-ray-piedra-1456706.jpg', 'Just added something new to my collection!'),
(15, 6, 'uploaded_pics/pexels-lil-artsy-1213447.jpg', 'Glossier, splashier, and a gratifying festival -Diwali'),
(16, 8, 'uploaded_pics/57823931869c289d525b2dcfc199800d632eb8f3.jpeg', 'check!'),
(18, 6, 'uploaded_pics/pexels-pedro-soler-martinez-5706797.jpg', 'found this in my garden today!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_ID` (`post_ID`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD KEY `following_ID` (`following_ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_ID`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id`) REFERENCES `app_user` (`ID`);

--
-- Constraints for table `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `follower_ibfk_1` FOREIGN KEY (`following_ID`) REFERENCES `app_user` (`ID`),
  ADD CONSTRAINT `follower_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `app_user` (`ID`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `app_user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
