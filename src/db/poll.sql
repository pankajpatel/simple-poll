-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2014 at 11:18 AM
-- Server version: 5.6.16
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `poll`
--

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE IF NOT EXISTS `poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `poll_options`
--

INSERT INTO `poll_options` (`id`, `question_id`, `option_text`, `timestamp`) VALUES
(1, 1, 'Batman', '2014-10-16 04:12:38'),
(2, 1, 'Superman', '2014-10-16 04:12:38'),
(3, 2, 'Facebook', '2014-10-16 05:17:29'),
(4, 2, 'Google+', '2014-10-16 05:17:29'),
(5, 2, 'LinkedIn', '2014-10-16 05:17:29'),
(6, 2, 'Twitter', '2014-10-16 05:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `poll_questions`
--

CREATE TABLE IF NOT EXISTS `poll_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `poll_questions`
--

INSERT INTO `poll_questions` (`id`, `question`, `timestamp`) VALUES
(1, 'Who is better?', '2014-10-16 04:12:38'),
(2, 'Which social network is better?', '2014-10-16 05:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `poll_responses`
--

CREATE TABLE IF NOT EXISTS `poll_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `poll_responses`
--

INSERT INTO `poll_responses` (`id`, `email_id`, `question_id`, `option_id`, `timestamp`) VALUES
(1, 'pankaj.njoy@gmail.com', 1, 1, '2014-10-16 05:14:05'),
(2, 'pankaj.njoy@gmail.com', 2, 3, '2014-10-16 05:19:14'),
(3, 'patel.pankaj@live.in', 1, 2, '2014-10-16 05:24:03'),
(4, 'patel.pankaj@live.in', 2, 4, '2014-10-16 05:47:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
