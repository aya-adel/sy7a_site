-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhostbuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fsa7ny`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `tel` int(30) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `tel`, `gender`) VALUES
(1, 'admin', 'admin@yahoo.com', 'admin', 1000000, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `price` int(30) NOT NULL,
  `location_id` int(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(300) NOT NULL,
  `longitude` int(30) NOT NULL,
  `latitude` int(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `country_id` int(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `description`, `longitude`, `latitude`, `image`, `country_id`) VALUES
(1, 'cairo', 'adsdasd', 31, 30, 'sdafdf', 1),
(2, 'Alexandria', 'Alexandria', 30, 31, 'Alexandria', 1),
(3, 'canal', 'canal', 23, 23, 'sdsd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city_rate`
--

CREATE TABLE IF NOT EXISTS `city_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `city_rate`
--

INSERT INTO `city_rate` (`id`, `city_id`, `user_id`, `rate`) VALUES
(1, 1, 1, 45),
(2, 2, 1, 2),
(3, 1, 2, 42),
(4, 2, 2, 23);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `content` varchar(100) NOT NULL,
  `post_id` int(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;
)
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `content`, `post_id`, `user_id`, `comment_time`) VALUES
(28, 'comment', 44, 1, '0000-00-00 00:00:00'),
(29, 'test', 44, 1, '0000-00-00 00:00:00'),
(30, 'good', 45, 1, '0000-00-00 00:00:00'),
(31, 'test', 44, 2, '0000-00-00 00:00:00'),
(74, 'zz', 45, 2, '0000-00-00 00:00:00'),
(75, 'zz', 45, 2, '0000-00-00 00:00:00');
(1, 'first commment', 1, 1, '0000-00-00 00:00:00'),
(2, 'second commment', 1, 1, '0000-00-00 00:00:00'),
(3, 'frst commment', 2, 1, '0000-00-00 00:00:00'),
(4, 'scnd commment', 2, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `description`, `image`) VALUES
(1, 'egypt', 'sdsd', 'sdsd'),
(2, 'Egyptv2', 'very good country', '/egypt');

-- --------------------------------------------------------

--
-- Table structure for table `country_rate`
--

CREATE TABLE IF NOT EXISTS `country_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `location_id` int(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `location_id`) VALUES
(1, 'ramsis', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `city_id`, `name`, `image`) VALUES
(1, 1, 'test', 'bl7');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `city_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `content` varchar(100) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;
)
--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `city_id`, `user_id`, `content`, `post_time`) VALUES
(44, 1, 1, 'test\n', '2016-04-06 13:33:22'),
(45, 1, 1, 'ali', '2016-04-06 13:33:40');
(1, 1, 1, 'eidted  post', '2016-04-05 07:32:01'),
(2, 1, 1, 'second post', '2016-04-04 17:02:35'),
(3, 1, 1, 'asasa', '2016-04-05 08:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `res_car`
--

CREATE TABLE IF NOT EXISTS `res_car` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `car_id` int(30) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_room`
--

CREATE TABLE IF NOT EXISTS `res_room` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `room_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `hotel_id` int(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `is_enable` int(10) NOT NULL DEFAULT '1',
  `tel` varchar(20) NOT NULL,
  `gender` enum('male','femal') NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `is_enable`, `tel`, `gender`, `image`) VALUES
(1, 'amr', 'amr@gmail.com', '1234', 1, '10', 'male', '/images/18.jpg'),
(2, 'amrfayad', 'amr@yahoo.com', '1234', 1, '144250674', 'male', '/images/17.jpg'),
(3, 'ali', 'ali@yahoo.com', '1234', 1, '0144250674', 'male', '/images/16.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city_rate`
--
ALTER TABLE `city_rate`
  ADD CONSTRAINT `city_rate_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `city_rate_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `country_rate`
--
ALTER TABLE `country_rate`
  ADD CONSTRAINT `country_rate_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `country_rate_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_car`
--
ALTER TABLE `res_car`
  ADD CONSTRAINT `res_car_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `res_car_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_room`,
--
ALTER TABLE `res_room`
  ADD CONSTRAINT `res_room_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `res_room_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
