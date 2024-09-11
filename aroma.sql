-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 11, 2024 at 11:44 AM
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
-- Table structure for table `book-post`
--

DROP TABLE IF EXISTS `book-post`;
CREATE TABLE IF NOT EXISTS `book-post` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `bcover` varchar(255) NOT NULL,
  `btitle` varchar(50) NOT NULL,
  `btag` varchar(15) NOT NULL,
  `bcontent` varchar(255) NOT NULL,
  `babout` varchar(180) NOT NULL,
  `bdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `casual-post`
--

DROP TABLE IF EXISTS `casual-post`;
CREATE TABLE IF NOT EXISTS `casual-post` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `ptitle` varchar(50) NOT NULL,
  `ptag` varchar(10) NOT NULL,
  `pcontent` varchar(255) NOT NULL,
  `pdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `uprofile_photo` varchar(255) NOT NULL,
  `uabout` varchar(320) NOT NULL,
  `upassword` varchar(20) NOT NULL,
  `udate_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `udate_updated` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ulast_login` timestamp NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
