-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2013 at 07:31 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wukwebbi_grupp3`
--
CREATE DATABASE IF NOT EXISTS `wukwebbi_grupp3` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `wukwebbi_grupp3`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_block`
--

CREATE TABLE IF NOT EXISTS `tbl_block` (
  `block_id` int(11) NOT NULL AUTO_INCREMENT,
  `block_name` varchar(255) NOT NULL,
  `block_startdate` datetime NOT NULL,
  `block_enddate` datetime NOT NULL,
  PRIMARY KEY (`block_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_block`
--

INSERT INTO `tbl_block` (`block_id`, `block_name`, `block_startdate`, `block_enddate`) VALUES
(1, 'Testprogram 1', '2013-11-26 00:00:00', '2014-08-27 00:00:00'),
(2, 'Testprogram 2', '2014-01-01 00:00:00', '2014-12-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE IF NOT EXISTS `tbl_booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_starttime` datetime NOT NULL COMMENT 'tid på dagen (t.ex. 0000-00-00 09:00)',
  `booking_endtime` datetime NOT NULL COMMENT 'tid på dagen (t.ex. 0000-00-00 12:00)',
  `booking_startdate` datetime NOT NULL COMMENT 'datum (t.ex. 2013-01-01 00:00)',
  `booking_enddate` datetime NOT NULL COMMENT 'datum (t.ex. 2013-06-30 00:00)',
  `course_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'person som gjorde bokningen',
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_starttime`, `booking_endtime`, `booking_startdate`, `booking_enddate`, `course_id`, `classroom_id`, `user_id`) VALUES
(1, '0000-00-00 09:00:00', '0000-00-00 12:00:00', '2013-11-26 00:00:00', '2014-03-26 00:00:00', 1, 3, 1),
(2, '0000-00-00 09:00:00', '0000-00-00 16:00:00', '2014-01-01 00:00:00', '2014-06-30 00:00:00', 3, 1, 2),
(3, '0000-00-00 13:00:00', '0000-00-00 16:00:00', '2013-11-26 00:00:00', '2014-03-26 00:00:00', 5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE IF NOT EXISTS `tbl_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `event_startdate` datetime NOT NULL,
  `event_enddate` datetime NOT NULL,
  `block_id` int(11) NOT NULL,
  `feedback_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`event_id`, `course_name`, `event_startdate`, `event_enddate`, `block_id`, `feedback_id`) VALUES
(1, 'Testkurs 1', '2013-11-26 00:00:00', '2014-03-26 00:00:00', 1, NULL),
(2, 'Testkurs 2', '2014-03-30 00:00:00', '2014-06-26 00:00:00', 1, NULL),
(3, 'Testkurs 3', '2014-01-01 00:00:00', '2014-06-30 00:00:00', 2, NULL),
(4, 'Testkurs 4', '2014-07-01 00:00:00', '2014-12-31 00:00:00', 2, NULL),
(5, 'Fristående kurs 1', '2013-11-01 00:00:00', '2013-11-30 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_grade` varchar(100) DEFAULT NULL,
  `feedback_com` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL COMMENT 'elev som betyget är ägnat till',
  `course_id` int(11) NOT NULL COMMENT 'kurs som betyget är ägnat till',
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_grade`, `feedback_com`, `user_id`, `course_id`) VALUES
(1, 'G', 'Blablabla gränsfall men klarade G', 6, 1),
(2, 'VG', 'Blablabla jobbat bra ', 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan`
--

CREATE TABLE IF NOT EXISTS `tbl_loan` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_serialnumber` varchar(255) NOT NULL,
  `loan_available` tinyint(1) NOT NULL,
  `loan_loandate` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_loan`
--

INSERT INTO `tbl_loan` (`loan_id`, `loan_serialnumber`, `loan_available`, `loan_loandate`, `user_id`) VALUES
(1, 'ASDF1234GHG', 1, '0000-00-00 00:00:00', 0),
(2, 'JHGFi456oFG3', 0, '2013-11-20 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_participant`
--

CREATE TABLE IF NOT EXISTS `tbl_participant` (
  `attendant_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL DEFAULT '0' COMMENT '0 om elev går program. elev måste ha kurs ELLER program, ej båda',
  `program_id` int(11) NOT NULL DEFAULT '0' COMMENT '0 om elev går fristående kurs. elev måste ha kurs ELLER program, ej båda',
  PRIMARY KEY (`attendant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_participant`
--

INSERT INTO `tbl_participant` (`attendant_id`, `user_id`, `course_id`, `program_id`) VALUES
(1, 3, 0, 1),
(2, 4, 0, 1),
(3, 5, 0, 2),
(4, 6, 0, 2),
(5, 7, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE IF NOT EXISTS `tbl_place` (
  `classroom_id` int(11) NOT NULL AUTO_INCREMENT,
  `classroom_name` varchar(255) NOT NULL,
  `classroom_type` int(11) NOT NULL,
  `classroom_numberofseats` int(11) NOT NULL,
  `classroom_equipment` varchar(255) NOT NULL,
  PRIMARY KEY (`classroom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`classroom_id`, `classroom_name`, `classroom_type`, `classroom_numberofseats`, `classroom_equipment`) VALUES
(1, 'Sal 1', 1, 25, 'Whiteboard, projektor'),
(2, 'Sal 2', 1, 30, 'Whiteboard, projektor'),
(3, 'Datasal 1', 2, 20, 'Projektor, stationära datorer'),
(4, 'Grupprum 1', 3, 10, 'Whiteboard');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_placetype`
--

CREATE TABLE IF NOT EXISTS `tbl_placetype` (
  `classroomtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `classroomtype_name` varchar(255) NOT NULL,
  PRIMARY KEY (`classroomtype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_placetype`
--

INSERT INTO `tbl_placetype` (`classroomtype_id`, `classroomtype_name`) VALUES
(1, 'Lektionssal'),
(2, 'Datorsal'),
(3, 'Grupprum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phonenumber` varchar(255) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_lastlogin` datetime NOT NULL,
  `usertype_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_phonenumber`, `user_username`, `user_password`, `user_lastlogin`, `usertype_id`) VALUES
(1, 'Samuel', 'Johansson', 'test@test.se', '070123123', 'samuel', 'samuel', '0000-00-00 00:00:00', 2),
(2, 'Robert', 'Karlsson', 'test@test.se', '070321321', 'robert', 'robert', '0000-00-00 00:00:00', 2),
(3, 'Pelle', 'Pellsson', 'test@test.se', '070111111', 'ppp', 'ppp', '0000-00-00 00:00:00', 1),
(4, 'Bosse', 'Boss', 'test@test.se', '070111111', 'bbb', 'bbb', '0000-00-00 00:00:00', 1),
(5, 'Mia', 'Yoo', 'test@test.se', '070111111', 'mmm', 'mmm', '0000-00-00 00:00:00', 1),
(6, 'Frida', 'Falkman', 'test@test.se', '070111111', 'fff', 'fff', '0000-00-00 00:00:00', 1),
(7, 'Woody', 'Wood', 'test@test.se', '070111111', 'www', 'www', '0000-00-00 00:00:00', 1),
(8, 'Elin', 'Testsson', 'test@test.se', '070888888', 'eee', 'eee', '0000-00-00 00:00:00', 3),
(9, 'Jens', 'Jensen', 'test@test.se', '070999999', 'jjj', 'jjj', '0000-00-00 00:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE IF NOT EXISTS `tbl_usertype` (
  `usertype_id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype_name` varchar(255) NOT NULL,
  `usertype_rights` int(11) NOT NULL COMMENT 'avgör vad användaren ska kunna göra i systemet',
  PRIMARY KEY (`usertype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`usertype_id`, `usertype_name`, `usertype_rights`) VALUES
(1, 'Elev', 1),
(2, 'Lärare', 2),
(3, 'Utbildningsledare', 4),
(4, 'Administratör', 16);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
