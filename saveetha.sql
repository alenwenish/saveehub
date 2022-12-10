-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2022 at 05:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saveetha`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `club_name` varchar(32) NOT NULL,
  `club_email` varchar(32) NOT NULL,
  `club_password` varchar(32) NOT NULL,
  `club_sc` varchar(32) NOT NULL,
  `club_fc` varchar(32) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(32) DEFAULT NULL,
  `pic` varchar(32) DEFAULT NULL,
  `bio` varchar(32) DEFAULT NULL,
  `link` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id`, `club_name`, `club_email`, `club_password`, `club_sc`, `club_fc`, `created_at`, `name`, `pic`, `bio`, `link`) VALUES
(1, 'Innovation Club', 'innov@ac.in', '123', 'Sathish', 'Indhumathy', '2022-12-02 08:55:26', 'Innovation King', 'innovation.png', 'universe for innovative ideas\r\n ', 'sih'),
(2, 'Coders Mania', 'codec@ac.in', '999', 'SK', 'SEC', '2022-12-03 09:59:39', NULL, NULL, NULL, NULL),
(3, 'Maths Magic', 'math@ac.in', '8989', 'SK', 'SSE', '2022-12-03 10:03:26', 'Maths Math', 'maths.png', ' Game of maths', 'www.google.com'),
(4, 'Yuva_Club', 'yuva@gmail.com', '123', 'SK', 'AK', '2022-12-08 07:40:29', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `club_pics`
--

CREATE TABLE `club_pics` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `post` varchar(32) NOT NULL,
  `caption` varchar(256) DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club_pics`
--

INSERT INTO `club_pics` (`id`, `username`, `post`, `caption`, `likes`, `created_at`) VALUES
(4, 'Coders Mania', 'coders.png', NULL, 3, '2022-12-03 15:38:36'),
(6, 'Innovation Club', 'innovation.png', 'innovative ideas', 2, '2022-12-08 21:34:02'),
(10, 'Innovation Club', 'maths.png', 'Math magic', 1, '2022-12-09 23:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `club_pics_comments`
--

CREATE TABLE `club_pics_comments` (
  `comment_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `owner` varchar(32) NOT NULL,
  `commenter` varchar(32) NOT NULL,
  `comments` varchar(192) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club_pics_comments`
--

INSERT INTO `club_pics_comments` (`comment_id`, `image_id`, `owner`, `commenter`, `comments`, `created_at`) VALUES
(1, 10, 'Innovation Club', 'Maths Magic', 'A great iniative for maths', '2022-12-10 16:40:44'),
(2, 4, 'Coders Mania', 'Maths Magic', 'Competitive world competitive programming', '2022-12-10 16:45:37'),
(3, 6, 'Innovation Club', 'pk', 'Innovative innovation', '2022-12-10 16:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `account` varchar(32) NOT NULL,
  `follower_name` varchar(32) NOT NULL,
  `accepted_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `account`, `follower_name`, `accepted_time`) VALUES
(1, 'SK', 'pk', '2022-11-26 20:52:09'),
(3, 'pk', 'saveetha', '2022-11-27 14:58:35'),
(4, 'saveetha', 'SK', '2022-11-27 15:11:46'),
(5, 'saveetha', 'pk', '2022-11-27 15:11:47'),
(6, 'SK', 'saveetha', '2022-12-02 13:54:40'),
(8, 'Maths Magic', 'Coders Mania', '2022-12-03 15:44:59'),
(9, 'Maths Magic', 'SK', '2022-12-03 15:47:06'),
(10, 'Maths Magic', 'Innovation Club', '2022-12-03 15:49:02'),
(11, 'Innovation Club', 'Maths Magic', '2022-12-03 15:57:13'),
(13, 'Alen', 'pk', '2022-12-04 12:03:17'),
(14, 'Alen', 'Innovation Club', '2022-12-04 12:04:04'),
(17, 'SK', 'raji', '2022-12-05 15:08:24'),
(18, 'SK', 'kishore', '2022-12-06 21:29:25'),
(19, 'Coders Mania', 'Innovation Club', '2022-12-07 23:16:26'),
(20, 'Innovation Club', 'pk', '2022-12-08 19:13:56'),
(21, 'pk', 'Innovation Club', '2022-12-08 22:36:11'),
(24, 'SK', 'Innovation Club', '2022-12-10 14:44:14'),
(25, 'pk', 'SK', '2022-12-10 14:46:24'),
(26, 'Innovation Club', 'SK', '2022-12-10 22:04:45'),
(27, 'Maths Magic', 'pk', '2022-12-10 22:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `post` varchar(64) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `username`, `post`, `caption`, `likes`, `created_at`) VALUES
(44, 'SK', 'road.jpeg', 'Go for a walk, covered by trees', 3, '2022-12-10 06:52:21'),
(45, 'pk', 'mountains.jpeg', 'A click of mountain', 2, '2022-12-10 09:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `image_comments`
--

CREATE TABLE `image_comments` (
  `comment_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `commenter` varchar(32) NOT NULL,
  `owner` varchar(32) NOT NULL,
  `comments` varchar(192) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image_comments`
--

INSERT INTO `image_comments` (`comment_id`, `image_id`, `commenter`, `owner`, `comments`, `created_at`) VALUES
(1, 45, 'SK', 'pk', 'Good pic', '2022-12-10 13:01:55'),
(2, 45, 'SK', 'pk', 'Mass pic', '2022-12-10 13:05:58'),
(3, 45, 'Alen', 'pk', 'Fantastic pic', '2022-12-10 13:22:09'),
(4, 44, 'pk', 'SK', 'What a pic', '2022-12-10 13:34:46'),
(5, 44, 'Maths Magic', 'SK', 'Pathway to Win', '2022-12-10 16:12:55'),
(6, 45, 'Innovation Club', 'pk', 'Great Click', '2022-12-10 16:35:11'),
(7, 45, 'Maths Magic', 'pk', 'Hi pk! fantastic post', '2022-12-10 16:43:17'),
(8, 44, 'pk', 'SK', 'Path to success', '2022-12-10 16:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `no` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `age` int(11) NOT NULL,
  `number` varchar(15) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `pic` varchar(32) DEFAULT NULL,
  `bio` varchar(128) DEFAULT NULL,
  `link` varchar(128) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`no`, `username`, `email`, `password`, `age`, `number`, `name`, `pic`, `bio`, `link`, `created_at`) VALUES
(5, 'SK', 'sk@gmail.com', '123', 20, '1234567890', 'Sathish Kumar', 'Pic.jpg', 'Computer Science Engineer ', 'www.google.com', '2022-10-12 23:54:04'),
(6, 'pk', 'pk@gmail.com', '999', 18, '1234567891', 'Name', 'mountains.jpeg', ' Bio', 'Link', '2022-10-13 15:15:55'),
(7, 'saveetha', 'saveetha@gmail.com', '456', 18, '1921921920', NULL, NULL, NULL, NULL, '2022-10-27 13:31:26'),
(8, 'Alen', 'alen@gmail.com', '000', 20, '1821821820', NULL, NULL, NULL, NULL, '2022-12-04 11:36:35'),
(9, 'kishore', 'kishore@gmail.com', '123', 20, '1829090901', NULL, NULL, NULL, NULL, '2022-12-04 11:38:16'),
(10, 'raji', 'raji@gmail.com', '888', 20, '1234567890', NULL, NULL, NULL, NULL, '2022-12-04 11:39:03'),
(11, 'Hari', 'hari@gmail.com', '555', 19, '1234567890', NULL, NULL, NULL, NULL, '2022-12-08 12:39:22'),
(12, 'Vishnu', 'vishnu@gmail.com', '444', 20, '9991119990', NULL, NULL, NULL, NULL, '2022-12-08 12:41:15'),
(16, 'saveehub', 'saveehub@gmail.com', '888', 21, '7778887778', NULL, NULL, NULL, NULL, '2022-12-08 12:44:02'),
(17, 'abc', 'abc@gmail.com', '145', 20, '7676767676', NULL, NULL, NULL, NULL, '2022-12-08 12:46:01'),
(24, 'def', 'def@gmail.com', '66634', 34, '8787878787', NULL, NULL, NULL, NULL, '2022-12-08 12:55:00'),
(25, 'viji', 'viji@gmail.com', '9090', 18, '1234567890', NULL, NULL, NULL, NULL, '2022-12-08 12:56:04'),
(42, 'test', 'test@gmail.com', '123', 91, '1919191919', NULL, NULL, NULL, NULL, '2022-12-08 13:07:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_pics`
--
ALTER TABLE `club_pics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_pics_comments`
--
ALTER TABLE `club_pics_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_comments`
--
ALTER TABLE `image_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `club_pics`
--
ALTER TABLE `club_pics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `club_pics_comments`
--
ALTER TABLE `club_pics_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `image_comments`
--
ALTER TABLE `image_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
