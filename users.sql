-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 31, 2022 at 10:30 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `examiners`
--

DROP TABLE IF EXISTS `examiners`;
CREATE TABLE IF NOT EXISTS `examiners` (
  `Event_ID` int(11) NOT NULL,
  `subid` varchar(30) NOT NULL,
  `Examiner` varchar(110) DEFAULT NULL,
  `timeslot` int(11) NOT NULL,
  `participant_mail` varchar(150) DEFAULT NULL,
  `field` varchar(110) NOT NULL,
  `mark` decimal(10,0) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examiners`
--

INSERT INTO `examiners` (`Event_ID`, `subid`, `Examiner`, `timeslot`, `participant_mail`, `field`, `mark`, `comment`) VALUES
(38, '38a', 'exmainer1', 0, 'part1', 'field1', NULL, NULL),
(38, '38a', 'exmainer1', 0, 'part1', 'field2', NULL, NULL),
(38, '38a', 'examiner1', 0, 'part2', 'field1', NULL, NULL),
(38, '38a', 'examiner1', 0, 'part2', 'field2', NULL, NULL),
(38, '38b', 'exmainer2', 0, 'parta', 'field3', NULL, NULL),
(38, '38b', 'exmainer2', 0, 'parta', 'field4', NULL, NULL),
(38, '38b', 'examiner2', 0, 'partb', 'field3', NULL, NULL),
(38, '38b', 'examiner2', 0, 'partb', 'field4', NULL, NULL),
(39, '39sdfsdf', 'ex1', 0, 'part3234', 'sdadfsd', '40', 'zdas;aksmkcznas'),
(40, '40sdfsdsdfsdg', 'sdfsd', 0, 'sdfsdfdf', 'ddddd', NULL, NULL),
(42, '42Electronic', 'ex1', 0, 'part1', 'f1', '100', 'comment'),
(42, '42Electronic', 'ex1', 0, 'part1', 'f2', '48', 'comment1'),
(42, '42Electronic', 'ex1', 0, 'part1', 'f3', '50', 'comment3\r\n'),
(42, '42Electronic', 'wx2', 0, 'part2', 'f1', NULL, NULL),
(42, '42Electronic', 'wx2', 0, 'part2', 'f2', NULL, NULL),
(42, '42Electronic', 'wx2', 0, 'part2', 'f3', NULL, NULL),
(42, '42computer', 'ex3', 0, 'part4', 'fb', '45', 'dfgdfhbc'),
(42, '42computer', 'ex3', 0, 'part4', 'fc', '7', 'kbmb'),
(42, '42computer', 'ex3', 0, 'part4', 'fd', '9', 'khgk'),
(45, '45OD', 'exxxx', 0, 'sdfd', 'pie', '11', 'lkhlh'),
(45, '45OD', 'exxxx', 0, 'sdfd', 'pieee', '8', 'lhjh'),
(45, '45OD', 'exxxx', 0, 'sdfd', 'vva', '8', 'jkj'),
(45, '45OD', 'exxxx', 0, 'sdfd', 'xde', '9', 'ajhaks'),
(45, '45OD', 'exxxx', 0, 'sdfd', 'eee', '76', 'akjahka'),
(45, '45OD', 'exxxx', 1, 'aaa', 'pie', '22', 'dsd'),
(45, '45OD', 'exxxx', 1, 'aaa', 'pieee', '33', 'kjbk'),
(45, '45OD', 'exxxx', 1, 'aaa', 'vva', '86', 'lkjlj'),
(45, '45OD', 'exxxx', 1, 'aaa', 'xde', '87', 'kk'),
(45, '45OD', 'exxxx', 1, 'aaa', 'eee', '9', 'hgj'),
(46, '46sdfd', 'dfs', 0, 'fdd', 'ddd', NULL, NULL),
(50, '50suba', 'ex1a', 0, 'particiapnta', 'Fielda', NULL, NULL),
(50, '50suba', 'ex1a', 0, 'particiapnta', 'Fieldb', NULL, NULL),
(50, '50subb', 'ex2', 0, 'participantb', 'Field', '100', 'addsd'),
(50, '50subb', 'ex2', 0, 'participantb', 'FIeldc', '34', 'adsdsafsd'),
(50, '50subb', 'ex3', 0, 'particpantc', 'Field', NULL, NULL),
(50, '50subb', 'ex3', 0, 'particpantc', 'FIeldc', NULL, NULL),
(52, '52a', 'ex1a', 0, 'PA', 'fa', '10', 'hgfhgf'),
(52, '52a', 'ex1a', 0, 'PA', 'fb', '87', 'hg'),
(52, '52a', 'ex1a', 1, 'exb', 'fa', '98', 'hhlh'),
(52, '52a', 'ex1a', 1, 'exb', 'fb', '97', 'nhfj'),
(52, '52a', 'ex1a', 2, 'partb', 'fa', '75', 'kjg'),
(52, '52a', 'ex1a', 2, 'partb', 'fb', '86', 'mvm'),
(53, '53a', 'ex', 0, 'bbb', 'c', '100', 'shittty mark'),
(55, '55aaa', 'exam', 0, 'sss', 'f1', '22', 'kjhkjh'),
(55, '55aaa', 'exam', 0, 'sss', 'f2', '7', 'iut'),
(55, '55aaa', 'exam', 1, 'kjhk', 'f1', '76', 'it'),
(55, '55aaa', 'exam', 1, 'kjhk', 'f2', '7', 'nmhg'),
(57, '57pk', 'raiva', 0, 'luna', 'poes_claps', NULL, NULL),
(57, '57pk', 'raiva', 0, 'luna', 'kicks', NULL, NULL),
(57, '57pc', 'reggie', 0, 'stix', 'poesclaps', NULL, NULL),
(57, '57pc', 'reggie', 0, 'stix', 'kicks', NULL, NULL),
(57, '57pc', 'dix', 0, 'solz', 'poesclaps', '100', 'very good'),
(57, '57pc', 'dix', 0, 'solz', 'kicks', '60', 'bad'),
(58, '58erter', '', 0, '', '', NULL, NULL),
(58, '58erter', '', 1, '', '', NULL, NULL),
(58, '58erter', '', 2, '', '', NULL, NULL),
(58, '58erter', '', 3, '', '', NULL, NULL),
(58, '58erter', '', 4, '', '', NULL, NULL),
(58, '58erter', '', 5, '', '', NULL, NULL),
(58, '58erter', '', 6, '', '', NULL, NULL),
(58, '58erter', '', 7, '', '', NULL, NULL),
(58, '58erter', '', 8, '', '', NULL, NULL),
(58, '58erter', '', 9, '', '', NULL, NULL),
(58, '58erter', '', 10, '', '', NULL, NULL),
(58, '58erter', '', 11, '', '', NULL, NULL),
(58, '58erter', '', 12, '', '', NULL, NULL),
(58, '58erter', '', 13, '', '', NULL, NULL),
(58, '58erter', '', 14, '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `infotb`
--

DROP TABLE IF EXISTS `infotb`;
CREATE TABLE IF NOT EXISTS `infotb` (
  `sub_ID` varchar(30) NOT NULL,
  `Event_ID` int(11) NOT NULL,
  `sub_event` varchar(150) NOT NULL,
  `e_day` int(11) NOT NULL,
  `t_slot` int(11) NOT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `participants` varchar(400) DEFAULT NULL,
  `co_hosts` varchar(200) DEFAULT NULL,
  `ts_desc` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `infotb`
--

INSERT INTO `infotb` (`sub_ID`, `Event_ID`, `sub_event`, `e_day`, `t_slot`, `starttime`, `endtime`, `duration`, `participants`, `co_hosts`, `ts_desc`) VALUES
('38a', 38, 'a', 0, 0, '10:47:00', '10:53:00', 6, 'part1,', 'exmainer1,', NULL),
('38a', 38, 'a', 1, 0, '10:48:00', '12:48:00', 120, 'part2,', 'examiner1,', NULL),
('38b', 38, 'b', 0, 0, '11:48:00', '13:48:00', 120, 'parta,', 'exmainer2,', NULL),
('38b', 38, 'b', 1, 0, '14:48:00', '16:48:00', 120, 'partb,', 'examiner2,', NULL),
('39sdfsdf', 39, 'sdfsdf', 0, 0, '12:10:00', '14:10:00', 120, 'part3234,', 'ex1,', NULL),
('40sdfsdsdfsdg', 40, 'sdfsdsdfsdg', 0, 0, '11:16:00', '14:16:00', 180, 'sdfsdfdf,', 'sdfsd,', NULL),
('41sdfsdf', 41, 'sdfsdf', 0, 0, '13:45:00', '14:45:00', 60, NULL, NULL, NULL),
('42Electronic', 42, 'Electronic', 0, 0, '16:05:00', '17:05:00', 60, 'part1,', 'ex1,', NULL),
('42Electronic', 42, 'Electronic', 1, 0, '16:05:00', '16:05:00', 0, 'part2,', 'wx2,', NULL),
('42computer', 42, 'computer', 0, 0, '19:05:00', '18:05:00', -60, 'part4,', 'ex3,', NULL),
('44Pres', 44, 'Pres', 0, 0, '14:00:00', '17:30:00', 210, NULL, NULL, NULL),
('44Pres', 44, 'Pres', 0, 1, '18:00:00', '21:00:00', 180, NULL, NULL, NULL),
('45OD', 45, 'OD', 0, 0, '14:10:00', '17:30:00', 200, 'sdfd,', 'exxxx,', NULL),
('45OD', 45, 'OD', 0, 1, '18:00:00', '21:00:00', 180, 'aaa,', 'exxxx,', NULL),
('46sdfd', 46, 'sdfd', 0, 0, '16:42:00', '16:42:00', 0, 'fdd,', 'dfs,', NULL),
('48Internal_Moderation', 48, 'Internal_Moderation', 0, 0, '09:00:00', '12:00:00', 180, NULL, NULL, NULL),
('48Award_Presentation', 48, 'Award_Presentation', 0, 0, '12:00:00', '14:00:00', 120, NULL, NULL, NULL),
('48Public_Viewing', 48, 'Public_Viewing', 0, 0, '14:00:00', '17:00:00', 180, NULL, NULL, NULL),
('48Coctail_Party', 48, 'Coctail_Party', 0, 0, '18:00:00', '00:00:00', -1080, NULL, NULL, NULL),
('49OPENDAY_SCHEDULE', 49, 'OPENDAY_SCHEDULE', 0, 0, '09:00:00', '12:00:00', 180, 'Internal_Moderation,', NULL, NULL),
('49OPENDAY_SCHEDULE', 49, 'OPENDAY_SCHEDULE', 0, 1, '12:00:00', '13:00:00', 60, 'Award_Announcement,', NULL, NULL),
('49OPENDAY_SCHEDULE', 49, 'OPENDAY_SCHEDULE', 0, 2, '13:00:00', '14:00:00', 60, 'Break,', NULL, NULL),
('49OPENDAY_SCHEDULE', 49, 'OPENDAY_SCHEDULE', 0, 3, '14:00:00', '17:30:00', 210, 'Public_Viewing,', NULL, NULL),
('49OPENDAY_SCHEDULE', 49, 'OPENDAY_SCHEDULE', 0, 4, '18:00:00', '23:59:00', 359, 'Coctail_Party,', NULL, NULL),
('50suba', 50, 'suba', 0, 0, '17:00:00', '23:00:00', 360, 'particiapnta,', 'ex1a,', NULL),
('50subb', 50, 'subb', 0, 0, '23:09:00', '03:59:00', -1150, 'participantb,', 'ex2,', NULL),
('50subb', 50, 'subb', 1, 0, '23:49:00', '03:59:00', -1190, 'particpantc,', 'ex3,', NULL),
('51a', 51, 'a', 0, 0, '22:00:00', '12:00:00', -600, 'PARTA,', 'exa,', NULL),
('51a', 51, 'a', 0, 1, '11:00:00', '13:00:00', 120, 'PARTB,', 'exa,', NULL),
('51a', 51, 'a', 1, 0, '15:00:00', '18:00:00', 180, 'PARTC,', 'EX2,', NULL),
('51', 51, '', 0, 0, '15:01:00', '16:00:00', 59, 'PART4,', 'EX3,', NULL),
('52a', 52, 'a', 0, 0, '14:00:00', '15:00:00', 60, 'PA,', 'ex1a,', NULL),
('52a', 52, 'a', 0, 1, '11:11:00', '04:53:00', -378, 'exb,', 'ex1a,', NULL),
('52a', 52, 'a', 0, 2, '23:04:00', '03:55:00', -1149, 'partb,', 'ex1a,', NULL),
('53a', 53, 'a', 0, 0, '13:00:00', '23:00:00', 600, 'bbb,', 'ex,', NULL),
('55aaa', 55, 'aaa', 0, 0, '13:23:00', '04:45:00', -518, 'sss,', 'exam,', NULL),
('55aaa', 55, 'aaa', 0, 1, '04:04:00', '05:59:00', 115, 'kjhk,', 'exam,', NULL),
('56mourning', 56, 'mourning', 0, 0, '00:00:00', '00:00:00', 0, 'p1,', 'r,', NULL),
('56moremoourning', 56, 'moremoourning', 0, 0, '00:00:00', '00:00:00', 0, 'p,', 'r2,', NULL),
('57pk', 57, 'pk', 0, 0, '04:32:00', '05:04:00', 32, 'luna,', 'raiva,', NULL),
('57pc', 57, 'pc', 0, 0, '06:54:00', '06:54:00', 0, 'stix,', 'reggie,', NULL),
('57pc', 57, 'pc', 1, 0, '07:59:00', '07:59:00', 0, 'solz,', 'dix,', NULL),
('58erter', 58, 'erter', 0, 0, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 1, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 2, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 3, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 4, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 5, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 6, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 7, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 8, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 9, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 10, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 11, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 12, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 13, '00:00:00', '00:00:00', 0, ',', ',', NULL),
('58erter', 58, 'erter', 0, 14, '00:00:00', '00:00:00', 0, ',', ',', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regusr`
--

DROP TABLE IF EXISTS `regusr`;
CREATE TABLE IF NOT EXISTS `regusr` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `Total_projects` int(11) DEFAULT NULL,
  `login_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regusr`
--

INSERT INTO `regusr` (`ID`, `email`, `pass`, `Total_projects`, `login_count`) VALUES
(2, 'kameer.sookoo@gmail.com', 'Pass12345', 1, 8),
(54, 'jon@gmail.com', 'passPass11', NULL, 7),
(55, '214523294@stu.ukzn.ac.za', 'Pass12345', NULL, 31);

-- --------------------------------------------------------

--
-- Table structure for table `subevent`
--

DROP TABLE IF EXISTS `subevent`;
CREATE TABLE IF NOT EXISTS `subevent` (
  `sub_ID` varchar(150) NOT NULL,
  `Event_ID` int(11) NOT NULL,
  `sub_event` varchar(150) NOT NULL,
  `e_day` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  KEY `sub_ID` (`sub_ID`),
  KEY `Event_ID` (`Event_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subevent`
--

INSERT INTO `subevent` (`sub_ID`, `Event_ID`, `sub_event`, `e_day`, `startdate`, `enddate`, `starttime`, `endtime`) VALUES
('38a', 38, 'a', 0, '2022-11-14', '2022-11-15', '10:46:00', '11:46:00'),
('38a', 38, 'a', 1, '2022-11-14', '2022-11-15', '11:46:00', '12:47:00'),
('38b', 38, 'b', 0, '2022-11-14', '2022-11-15', '11:47:00', '12:47:00'),
('38b', 38, 'b', 1, '2022-11-14', '2022-11-15', '12:47:00', '13:49:00'),
('39sdfsdf', 39, 'sdfsdf', 0, '2022-11-14', '2022-11-14', '13:10:00', '12:10:00'),
('40sdfsdsdfsdg', 40, 'sdfsdsdfsdg', 0, '2022-11-14', '2022-11-14', '12:16:00', '13:16:00'),
('41sdfsdf', 41, 'sdfsdf', 0, '2022-11-14', '2022-11-14', '12:44:00', '14:45:00'),
('42Electronic', 42, 'Electronic', 0, '2022-11-14', '2022-11-15', '15:05:00', '17:05:00'),
('42Electronic', 42, 'Electronic', 1, '2022-11-14', '2022-11-15', '16:05:00', '15:06:00'),
('42computer', 42, 'computer', 0, '2022-11-14', '2022-11-14', '15:05:00', '16:05:00'),
('44Pres', 44, 'Pres', 0, '2022-11-18', '2022-11-18', '14:00:00', '20:00:00'),
('45OD', 45, 'OD', 0, '2022-11-18', '2022-11-18', '14:00:00', '17:30:00'),
('46sdfd', 46, 'sdfd', 0, '2022-11-18', '2022-11-18', '11:42:00', '18:42:00'),
('47INTERNAL MODERATION', 47, 'INTERNAL MODERATION', 0, '2022-11-18', '2022-11-18', '00:00:00', '00:00:00'),
('47AWARD PRESENTATION', 47, 'AWARD PRESENTATION', 0, '2022-11-18', '2022-11-18', '00:00:00', '00:00:00'),
('47PUBLIC VIEWING', 47, 'PUBLIC VIEWING', 0, '2022-11-18', '2022-11-18', '00:00:00', '00:00:00'),
('47COCKTAIL PARTY', 47, 'COCKTAIL PARTY', 0, '2022-11-18', '2022-11-18', '00:00:00', '00:00:00'),
('48Internal_Moderation', 48, 'Internal_Moderation', 0, '2022-11-18', '2022-11-18', '09:00:00', '12:00:00'),
('48Award_Presentation', 48, 'Award_Presentation', 0, '2022-11-18', '2022-11-18', '12:00:00', '14:00:00'),
('48Public_Viewing', 48, 'Public_Viewing', 0, '2022-11-18', '2022-11-18', '14:00:00', '17:30:00'),
('48Coctail_Party', 48, 'Coctail_Party', 0, '2022-11-18', '2022-11-18', '18:00:00', '00:00:00'),
('49OPENDAY_SCHEDULE', 49, 'OPENDAY_SCHEDULE', 0, '2022-11-18', '2022-11-18', '09:00:00', '23:59:00'),
('50suba', 50, 'suba', 0, '2022-11-18', '2022-11-18', '12:00:00', '13:00:00'),
('50subb', 50, 'subb', 0, '2022-11-18', '2022-11-19', '14:00:00', '16:00:00'),
('50subb', 50, 'subb', 1, '2022-11-18', '2022-11-19', '17:00:00', '18:00:00'),
('51a', 51, 'a', 0, '2022-11-21', '2022-11-22', '12:00:00', '16:06:00'),
('51a', 51, 'a', 1, '2022-11-21', '2022-11-22', '22:08:00', '23:00:00'),
('51', 51, '', 0, '2022-11-22', '2022-11-22', '16:00:00', '16:00:00'),
('52a', 52, 'a', 0, '2022-11-18', '2022-11-18', '14:00:00', '16:00:00'),
('53a', 53, 'a', 0, '2022-11-18', '2022-11-18', '15:00:00', '18:00:00'),
('54erfer', 54, 'erfer', 0, '2022-11-18', '2022-11-18', '15:03:00', '17:03:00'),
('55aaa', 55, 'aaa', 0, '2022-11-18', '2022-11-18', '12:12:00', '03:34:00'),
('56mourning', 56, 'mourning', 0, '2022-11-18', '2022-11-18', '12:00:00', '15:00:00'),
('56moremoourning', 56, 'moremoourning', 0, '2022-11-18', '2022-11-18', '15:00:00', '16:00:00'),
('57pk', 57, 'pk', 0, '2022-11-19', '2022-11-19', '10:00:00', '11:00:00'),
('57pc', 57, 'pc', 0, '2022-11-19', '2022-11-20', '12:00:00', '23:59:00'),
('57pc', 57, 'pc', 1, '2022-11-19', '2022-11-20', '13:59:00', '06:05:00'),
('58erter', 58, 'erter', 0, '2022-12-07', '2022-12-07', '11:03:00', '13:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `usertb`
--

DROP TABLE IF EXISTS `usertb`;
CREATE TABLE IF NOT EXISTS `usertb` (
  `Event_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Event_name` varchar(100) NOT NULL,
  `ID` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `subevent_no` int(11) DEFAULT NULL,
  `process_count` int(11) DEFAULT NULL,
  `reminder_date` date DEFAULT NULL,
  `publickey` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Event_ID`),
  KEY `userid` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertb`
--

INSERT INTO `usertb` (`Event_ID`, `Event_name`, `ID`, `startdate`, `enddate`, `subevent_no`, `process_count`, `reminder_date`, `publickey`) VALUES
(38, 'eventa', 54, '2022-11-14', '2022-11-16', 2, 6, '2022-11-13', '38pubaccess'),
(39, 'eve', 54, '2022-11-14', '2022-11-15', 1, 6, NULL, NULL),
(40, 'sdfd', 54, '2022-11-14', '2022-11-15', 1, 7, '2022-11-13', '40pubaccess'),
(41, 'asdwe', 54, '2022-11-14', '2022-11-14', 1, 7, '2022-11-13', '41pubaccess'),
(42, 'Design', 55, '2022-11-13', '2022-11-15', 2, 7, '2022-11-12', '42pubaccess'),
(44, 'Open Day', 55, '2022-11-18', '2022-11-18', 1, 4, NULL, NULL),
(45, 'OpenDay2', 55, '2022-11-18', '2022-11-18', 1, 7, '2022-11-16', '45pubaccess'),
(46, 'asddfs', 55, '2022-11-18', '2022-11-18', 1, 7, '2022-11-15', '46pubaccess'),
(47, 'ECEE OPEN DAY 2022', 55, '2022-11-18', '2022-11-18', 4, 3, NULL, NULL),
(48, 'OPENDAY 2022', 55, '2022-11-18', '2022-11-18', 4, 7, '2022-11-17', '48pubaccess'),
(49, 'OPENDAY EECE 2022', 55, '2022-11-18', '2022-11-18', 1, 7, '2022-11-17', '49pubaccess'),
(50, 'Event', 55, '2022-11-18', '2022-11-19', 2, 7, '2022-11-17', '50pubaccess'),
(51, 'rve', 55, '2022-11-20', '2022-11-23', 2, 5, NULL, NULL),
(52, 'Eventa', 55, '2022-11-18', '2022-11-19', 1, 7, '2022-11-17', '52pubaccess'),
(53, 'demo', 55, '2022-11-18', '2022-11-19', 1, 7, '2022-11-17', '53pubaccess'),
(54, 'aAAAA', 55, '2022-11-18', '2022-11-19', 1, 3, NULL, NULL),
(55, 'aaa', 55, '2022-11-16', '2022-11-18', 1, 7, '2022-11-14', '55pubaccess'),
(56, 'dsgfdfgdfg', 55, '2022-11-18', '2022-11-18', 2, 7, '2022-11-16', '56pubaccess'),
(57, 'tpk', 55, '2022-11-19', '2022-11-20', 2, 7, '2022-11-17', '57pubaccess'),
(58, 'egtt', 55, '2022-12-07', '2022-12-08', 1, 6, NULL, NULL),
(59, 'a', 55, '2022-12-31', '2022-12-31', NULL, 1, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subevent`
--
ALTER TABLE `subevent`
  ADD CONSTRAINT `subevent_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `usertb` (`Event_ID`);

--
-- Constraints for table `usertb`
--
ALTER TABLE `usertb`
  ADD CONSTRAINT `usertb_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `regusr` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
