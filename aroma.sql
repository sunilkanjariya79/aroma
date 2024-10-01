-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 01, 2024 at 04:30 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aroma`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

DROP TABLE IF EXISTS `block`;
CREATE TABLE IF NOT EXISTS `block` (
  `blid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `blocker` int NOT NULL,
  PRIMARY KEY (`blid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_post`
--

DROP TABLE IF EXISTS `book_post`;
CREATE TABLE IF NOT EXISTS `book_post` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `bcover` varchar(255) NOT NULL,
  `btitle` varchar(50) NOT NULL,
  `btag` varchar(15) NOT NULL,
  `bcontent` varchar(255) NOT NULL,
  `babout` varchar(180) NOT NULL,
  `bdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_post`
--

INSERT INTO `book_post` (`bid`, `uid`, `bcover`, `btitle`, `btag`, `bcontent`, `babout`, `bdate`) VALUES
(1, 8, '1727330067loki.jpg', 'Some Random Story', 'book-story', '66f4f7139c9b4.html', 'this book is just with random story, nothing special about it, it says some random story taken from internet to try how this actually works', '2024-09-26 05:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `casual_post`
--

DROP TABLE IF EXISTS `casual_post`;
CREATE TABLE IF NOT EXISTS `casual_post` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `ptitle` varchar(50) NOT NULL,
  `ptag` varchar(10) NOT NULL,
  `pcontent` varchar(255) NOT NULL,
  `pdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `casual_post`
--

INSERT INTO `casual_post` (`pid`, `uid`, `ptitle`, `ptag`, `pcontent`, `pdate`) VALUES
(1, 5, 'a', 'a', '66ec40698cee4.html', '2024-09-19 15:20:52'),
(2, 5, 'hello', 'greeting', '66ec41fe51727.html', '2024-09-19 15:23:42'),
(3, 5, 'hello 2', 'greeting 2', '66ec4481546b1.html', '2024-09-19 15:34:25'),
(4, 5, 'hello 3', 'greeting 3', '66ec44f10066e.html', '2024-09-19 15:36:17'),
(5, 5, 'hello, my first post', 'introducti', '66ed8e95de2d7.html', '2024-09-20 15:35:45'),
(6, 8, 'hi', 'intro', '66f23ec4b5d34.html', '2024-09-24 04:23:32'),
(7, 8, 'title', 'tag', '66f4e7409dde1.html', '2024-09-26 04:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `cid` int NOT NULL,
  `uid` int NOT NULL,
  `cpost` int NOT NULL,
  `cbook` int NOT NULL,
  `c-content` varchar(420) NOT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

DROP TABLE IF EXISTS `follower`;
CREATE TABLE IF NOT EXISTS `follower` (
  `fid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `follower` int NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`fid`, `uid`, `follower`) VALUES
(1, 5, 8),
(2, 8, 5),
(3, 4, 8),
(4, 1, 8),
(5, 2, 8),
(6, 3, 8),
(7, 7, 8),
(8, 8, 9),
(9, 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `lid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `lpost` int NOT NULL,
  `lbook` int NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `from_user_id` int NOT NULL,
  `to_user_id` int NOT NULL,
  `msg` varchar(600) NOT NULL,
  `read_status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `nid` int NOT NULL AUTO_INCREMENT,
  `to_user_id` int NOT NULL,
  `message` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from_user_id` int NOT NULL,
  `read_status` int NOT NULL DEFAULT '0',
  `pid` int NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `rid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `rpost` int NOT NULL,
  `rcomment` int NOT NULL,
  `rbook` int NOT NULL,
  `reporter-id` int NOT NULL,
  `report-text` varchar(520) NOT NULL,
  `report-time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `umail` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `gender` int NOT NULL,
  `udate` date NOT NULL,
  `uprofile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'profile.jpeg',
  `uabout` varchar(320) NOT NULL,
  `upassword` varchar(20) NOT NULL,
  `udate_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `udate_updated` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ulast_login` timestamp NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `umail`, `username`, `uname`, `gender`, `udate`, `uprofile_photo`, `uabout`, `upassword`, `udate_created`, `udate_updated`, `ulast_login`) VALUES
(1, 'nnnronit@gmail.com', 'name', 'name', 1, '2005-09-13', 'profile.jpeg', 'about', 'pass', '2024-09-12 17:02:25', '2024-09-18 05:21:09', '0000-00-00 00:00:00'),
(2, 'nnnronit@gmail.com', 'name', 'name', 1, '2005-09-13', 'profile.jpeg', 'about', 'pass', '2024-09-12 17:02:25', '2024-09-18 05:26:36', '0000-00-00 00:00:00'),
(3, 'ronit@gmail.com', 'username', 'name', 1, '2002-05-12', 'profile.jpeg', 'this is about me', 'pass', '2024-09-17 13:17:03', '2024-09-18 05:26:40', '0000-00-00 00:00:00'),
(4, 'ronit@gmail.com', 'username', 'name', 1, '2002-05-12', 'profile.jpeg', 'this is about me', 'pass', '2024-09-17 13:17:03', '2024-09-18 05:26:45', '0000-00-00 00:00:00'),
(5, 'sss@a', 'sss', 'vv', 1, '1998-05-12', '1726674165loki.jpg', 'ssss', 'ss', '2024-09-18 03:43:29', '2024-09-18 15:42:45', '0000-00-00 00:00:00'),
(8, 'mail@m', 'b', 'b', 1, '2005-05-05', 'profile.jpeg', 'b', 'b', '2024-09-24 04:23:11', '2024-09-26 04:39:36', '0000-00-00 00:00:00'),
(7, 'a@gmail', 'a', 'a', 1, '2006-05-04', 'profile.jpeg', 'about', 'a', '2024-09-18 05:24:27', '2024-09-18 05:26:49', '0000-00-00 00:00:00'),
(9, 'mymail@mail.com', 'something', 'name1', 1, '2005-09-13', '', 'i only want to say that i am me, and me is i', 'password', '2024-09-30 03:54:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
