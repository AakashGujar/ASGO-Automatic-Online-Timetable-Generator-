-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 12:25 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininformation`
--

CREATE TABLE `admininformation` (
  `srno` int(11) NOT NULL,
  `firstname` text,
  `lastname` text,
  `adminid` text,
  `password` text,
  `securityquestion` text,
  `recoveryans` text,
  `recoveryemailid` text,
  `recoveryphone` text,
  `institutetype` text,
  `institutefullname` text,
  `instituteshortname` text,
  `institutecode` text,
  `institutephoneno` text,
  `instituteemailid` text,
  `instituteadress` text,
  `institutecountry` text,
  `institutestate` text,
  `institutecity` text,
  `institutetown` text,
  `institutedistrict` text,
  `institutepincode` text,
  `plan` text,
  `price` text,
  `adress` text,
  `country` text,
  `state` text,
  `city` text,
  `town` text,
  `district` text,
  `pincode` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admininformation`
--

INSERT INTO `admininformation` (`srno`, `firstname`, `lastname`, `adminid`, `password`, `securityquestion`, `recoveryans`, `recoveryemailid`, `recoveryphone`, `institutetype`, `institutefullname`, `instituteshortname`, `institutecode`, `institutephoneno`, `instituteemailid`, `instituteadress`, `institutecountry`, `institutestate`, `institutecity`, `institutetown`, `institutedistrict`, `institutepincode`, `plan`, `price`, `adress`, `country`, `state`, `city`, `town`, `district`, `pincode`) VALUES
(1, 'het', 'sheth', 'hetsheth@aotg.com', 'hetsheth', 'What was your childhood nickname?', 'het', 'hetsheth40@gmail.com', '8291008132', 'college', 'Bhausaheb Vartak Polytechnic', 'B.V.P', '0093', '5151654565', 'hetsheth40@gmail.com', 'Vasai Road', 'India', 'Maharashtra', '', 'Vasai', 'Palghar', '401202', 'Pro', '$ 19.99 / year', 'Trishul Apt', 'India', 'Maharashtra', 'Mumbai', 'kandivali', 'Borivali', '400067');

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE `adminusers` (
  `srno` int(11) NOT NULL,
  `firstname` text,
  `lastname` text,
  `username` text,
  `password` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`srno`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'het', 'sheth', 'hetsheth@aotg.com', 'hetsheth');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_cm7details`
--

CREATE TABLE `hetsheth_cm7details` (
  `srno` int(11) DEFAULT NULL,
  `starttimehrs` text,
  `starttimemin` text,
  `endtimehrs` text,
  `endtimemin` text,
  `recessstarthrs1` text,
  `recessstartmin1` text,
  `recessendhrs1` text,
  `recessendmin1` text,
  `recessstarthrs2` text,
  `recessstartmin2` text,
  `recessendhrs2` text,
  `recessendmin2` text,
  `recesses` text,
  `dailyperiod` text,
  `saturday` text,
  `halfday` text,
  `saturdayperiod` text,
  `amorpm` text,
  `amorpm1` text,
  `amorpm2` text,
  `amorpm3` text,
  `amorpm4` text,
  `amorpm5` text,
  `totallecture` text,
  `loopvalue` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_cm7details`
--

INSERT INTO `hetsheth_cm7details` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue`) VALUES
(1, '9', '30', '16', '00', '13', '30', '14', '00', '', '', '', '', '1', '7', '1', '1', '', 'Am', 'Pm', 'Pm', 'Pm', 'Am', 'Am', '35', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_cm7subject`
--

CREATE TABLE `hetsheth_cm7subject` (
  `srno` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `piroity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_cm7subject`
--

INSERT INTO `hetsheth_cm7subject` (`srno`, `id`, `name`, `teacher`, `type`, `piroity`) VALUES
(1, 1, 'hindi', 'yash tailor', 'TH', 6),
(2, 1, 'hindi', 'yash tailor', 'TH', 6),
(3, 1, 'hindi', 'yash tailor', 'TH', 6),
(4, 1, 'hindi', 'yash tailor', 'TH', 6),
(5, 1, 'hindi', 'yash tailor', 'TH', 6),
(6, 1, 'hindi', 'yash tailor', 'TH', 6),
(7, 2, 'english', 'het', 'TH', 4),
(8, 2, 'english', 'het', 'TH', 4),
(9, 2, 'english', 'het', 'TH', 4),
(10, 2, 'english', 'het', 'TH', 4),
(11, 3, 'hindi', 'yash', 'PR', 6),
(12, 3, 'hindi', 'yash', 'PR', 6),
(13, 3, 'hindi', 'yash', 'PR', 6),
(14, 3, 'hindi', 'yash', 'PR', 6),
(15, 3, 'hindi', 'yash', 'PR', 6),
(16, 3, 'hindi', 'yash', 'PR', 6),
(17, 4, 'english', 'het', 'PR', 3),
(18, 4, 'english', 'het', 'PR', 3),
(19, 4, 'english', 'het', 'PR', 3),
(20, 5, 'maths', 'yash', 'PR', 6),
(21, 5, 'maths', 'yash', 'PR', 6),
(22, 5, 'maths', 'yash', 'PR', 6),
(23, 5, 'maths', 'yash', 'PR', 6),
(24, 5, 'maths', 'yash', 'PR', 6),
(25, 5, 'maths', 'yash', 'PR', 6),
(26, 6, 'lpr', 'het', 'TH', 6),
(27, 6, 'lpr', 'het', 'TH', 6),
(28, 6, 'lpr', 'het', 'TH', 6),
(29, 6, 'lpr', 'het', 'TH', 6),
(30, 6, 'lpr', 'het', 'TH', 6),
(31, 6, 'lpr', 'het', 'TH', 6),
(32, 7, 'lpr', 'yash', 'PR', 4),
(33, 7, 'lpr', 'yash', 'PR', 4),
(34, 7, 'lpr', 'yash', 'PR', 4),
(35, 7, 'lpr', 'yash', 'PR', 4);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_cm7timetable`
--

CREATE TABLE `hetsheth_cm7timetable` (
  `srno` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `code` text,
  `count` text,
  `classname` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_cm7timetable`
--

INSERT INTO `hetsheth_cm7timetable` (`srno`, `name`, `teacher`, `type`, `code`, `count`, `classname`) VALUES
(1, 'lpr', 'yash', 'PR', NULL, NULL, NULL),
(2, 'hindi', 'yash', 'PR', NULL, NULL, NULL),
(3, 'hindi', 'yash', 'PR', NULL, NULL, NULL),
(4, 'maths', 'yash', 'PR', NULL, NULL, NULL),
(5, 'lpr', 'het', 'TH', NULL, NULL, NULL),
(6, 'hindi', 'yash', 'PR', NULL, NULL, NULL),
(7, 'english', 'het', 'TH', NULL, NULL, NULL),
(8, 'english', 'het', 'TH', NULL, NULL, NULL),
(9, 'lpr', 'het', 'TH', NULL, NULL, NULL),
(10, 'maths', 'yash', 'PR', NULL, NULL, NULL),
(11, 'english', 'het', 'PR', NULL, NULL, NULL),
(12, 'hindi', 'yash', 'PR', NULL, NULL, NULL),
(13, 'english', 'het', 'TH', NULL, NULL, NULL),
(14, 'hindi', 'yash tailor', 'TH', NULL, NULL, NULL),
(15, 'hindi', 'yash tailor', 'TH', NULL, NULL, NULL),
(16, 'hindi', 'yash tailor', 'TH', NULL, NULL, NULL),
(17, 'maths', 'yash', 'PR', NULL, NULL, NULL),
(18, 'hindi', 'yash tailor', 'TH', NULL, NULL, NULL),
(19, 'lpr', 'het', 'TH', NULL, NULL, NULL),
(20, 'lpr', 'yash', 'PR', NULL, NULL, NULL),
(21, 'english', 'het', 'PR', NULL, NULL, NULL),
(22, 'lpr', 'yash', 'PR', NULL, NULL, NULL),
(23, 'maths', 'yash', 'PR', NULL, NULL, NULL),
(24, 'hindi', 'yash tailor', 'TH', NULL, NULL, NULL),
(25, 'maths', 'yash', 'PR', NULL, NULL, NULL),
(26, 'maths', 'yash', 'PR', NULL, NULL, NULL),
(27, 'hindi', 'yash', 'PR', NULL, NULL, NULL),
(28, 'hindi', 'yash', 'PR', NULL, NULL, NULL),
(29, 'hindi', 'yash tailor', 'TH', NULL, NULL, NULL),
(30, 'english', 'het', 'TH', NULL, NULL, NULL),
(31, 'english', 'het', 'PR', NULL, NULL, NULL),
(32, 'lpr', 'het', 'TH', NULL, NULL, NULL),
(33, 'lpr', 'yash', 'PR', NULL, NULL, NULL),
(34, 'lpr', 'het', 'TH', NULL, NULL, NULL),
(35, 'lpr', 'het', 'TH', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_cm10details`
--

CREATE TABLE `hetsheth_cm10details` (
  `srno` int(11) DEFAULT NULL,
  `starttimehrs` text,
  `starttimemin` text,
  `endtimehrs` text,
  `endtimemin` text,
  `recessstarthrs1` text,
  `recessstartmin1` text,
  `recessendhrs1` text,
  `recessendmin1` text,
  `recessstarthrs2` text,
  `recessstartmin2` text,
  `recessendhrs2` text,
  `recessendmin2` text,
  `recesses` text,
  `dailyperiod` text,
  `saturday` text,
  `halfday` text,
  `saturdayperiod` text,
  `amorpm` text,
  `amorpm1` text,
  `amorpm2` text,
  `amorpm3` text,
  `amorpm4` text,
  `amorpm5` text,
  `totallecture` text,
  `loopvalue` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_cm10details`
--

INSERT INTO `hetsheth_cm10details` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue`) VALUES
(1, '9', '30', '16', '00', '13', '30', '14', '00', '', '', '', '', '1', '7', '1', '1', '', 'Am', 'Pm', 'Pm', 'Pm', 'Am', 'Am', '35', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co1details`
--

CREATE TABLE `hetsheth_co1details` (
  `srno` int(11) DEFAULT NULL,
  `starttimehrs` text,
  `starttimemin` text,
  `endtimehrs` text,
  `endtimemin` text,
  `recessstarthrs1` text,
  `recessstartmin1` text,
  `recessendhrs1` text,
  `recessendmin1` text,
  `recessstarthrs2` text,
  `recessstartmin2` text,
  `recessendhrs2` text,
  `recessendmin2` text,
  `recesses` text,
  `dailyperiod` text,
  `saturday` text,
  `halfday` text,
  `saturdayperiod` text,
  `amorpm` text,
  `amorpm1` text,
  `amorpm2` text,
  `amorpm3` text,
  `amorpm4` text,
  `amorpm5` text,
  `totallecture` text,
  `loopvalue` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co1details`
--

INSERT INTO `hetsheth_co1details` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue`) VALUES
(1, '9', '00', '16', '30', '12', '00', '12', '30', '', '', '', '', '1', '7', '0', '0', '', 'Am', 'Pm', 'Pm', 'Pm', 'Am', 'Am', '42', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co2details`
--

CREATE TABLE `hetsheth_co2details` (
  `srno` int(11) DEFAULT NULL,
  `starttimehrs` text,
  `starttimemin` text,
  `endtimehrs` text,
  `endtimemin` text,
  `recessstarthrs1` text,
  `recessstartmin1` text,
  `recessendhrs1` text,
  `recessendmin1` text,
  `recessstarthrs2` text,
  `recessstartmin2` text,
  `recessendhrs2` text,
  `recessendmin2` text,
  `recesses` text,
  `dailyperiod` text,
  `saturday` text,
  `halfday` text,
  `saturdayperiod` text,
  `amorpm` text,
  `amorpm1` text,
  `amorpm2` text,
  `amorpm3` text,
  `amorpm4` text,
  `amorpm5` text,
  `totallecture` text,
  `loopvalue` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co2details`
--

INSERT INTO `hetsheth_co2details` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue`) VALUES
(1, '9', '30', '14', '00', '11', '30', '12', '00', '', '', '', '', '1', '4', '0', '1', '2', 'Am', 'Am', 'Am', 'Am', 'Am', 'Am', '22', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co3details`
--

CREATE TABLE `hetsheth_co3details` (
  `srno` int(11) DEFAULT NULL,
  `starttimehrs` text,
  `starttimemin` text,
  `endtimehrs` text,
  `endtimemin` text,
  `recessstarthrs1` text,
  `recessstartmin1` text,
  `recessendhrs1` text,
  `recessendmin1` text,
  `recessstarthrs2` text,
  `recessstartmin2` text,
  `recessendhrs2` text,
  `recessendmin2` text,
  `recesses` text,
  `dailyperiod` text,
  `saturday` text,
  `halfday` text,
  `saturdayperiod` text,
  `amorpm` text,
  `amorpm1` text,
  `amorpm2` text,
  `amorpm3` text,
  `amorpm4` text,
  `amorpm5` text,
  `totallecture` text,
  `loopvalue` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co3details`
--

INSERT INTO `hetsheth_co3details` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue`) VALUES
(1, '9', '00', '17', '30', '11', '00', '11', '15', '14', '15', '15', '30', '0', '7', '1', '1', '', 'Am', 'Pm', 'Am', 'Am', 'Pm', 'Pm', '35', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co7details`
--

CREATE TABLE `hetsheth_co7details` (
  `srno` int(11) DEFAULT NULL,
  `starttimehrs` text,
  `starttimemin` text,
  `endtimehrs` text,
  `endtimemin` text,
  `recessstarthrs1` text,
  `recessstartmin1` text,
  `recessendhrs1` text,
  `recessendmin1` text,
  `recessstarthrs2` text,
  `recessstartmin2` text,
  `recessendhrs2` text,
  `recessendmin2` text,
  `recesses` text,
  `dailyperiod` text,
  `saturday` text,
  `halfday` text,
  `saturdayperiod` text,
  `amorpm` text,
  `amorpm1` text,
  `amorpm2` text,
  `amorpm3` text,
  `amorpm4` text,
  `amorpm5` text,
  `totallecture` text,
  `loopvalue` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co7details`
--

INSERT INTO `hetsheth_co7details` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue`) VALUES
(1, '9', '00', '16', '30', '13', '00', '13', '30', '', '', '', '', '1', '', '1', '1', '', 'Am', 'Pm', 'Pm', 'Pm', 'Am', 'Am', '35', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co7subject`
--

CREATE TABLE `hetsheth_co7subject` (
  `srno` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `piroity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co7subject`
--

INSERT INTO `hetsheth_co7subject` (`srno`, `id`, `name`, `teacher`, `type`, `piroity`) VALUES
(1, 1, 'hindi', 'chitra sheth', 'TH', 6),
(2, 1, 'hindi', 'chitra sheth', 'TH', 6),
(3, 1, 'hindi', 'chitra sheth', 'TH', 6),
(4, 1, 'hindi', 'chitra sheth', 'TH', 6),
(5, 1, 'hindi', 'chitra sheth', 'TH', 6),
(6, 1, 'hindi', 'chitra sheth', 'TH', 6),
(7, 2, 'hindi', 'chitra', 'TH', 6),
(8, 2, 'hindi', 'chitra', 'TH', 6),
(9, 2, 'hindi', 'chitra', 'TH', 6),
(10, 2, 'hindi', 'chitra', 'TH', 6),
(11, 2, 'hindi', 'chitra', 'TH', 6),
(12, 2, 'hindi', 'chitra', 'TH', 6),
(13, 3, 'hindi', 'chitra', 'TH', 6),
(14, 3, 'hindi', 'chitra', 'TH', 6),
(15, 3, 'hindi', 'chitra', 'TH', 6),
(16, 3, 'hindi', 'chitra', 'TH', 6),
(17, 3, 'hindi', 'chitra', 'TH', 6),
(18, 3, 'hindi', 'chitra', 'TH', 6),
(19, 4, 'hindi', 'chitra', 'TH', 6),
(20, 4, 'hindi', 'chitra', 'TH', 6),
(21, 4, 'hindi', 'chitra', 'TH', 6),
(22, 4, 'hindi', 'chitra', 'TH', 6),
(23, 4, 'hindi', 'chitra', 'TH', 6),
(24, 4, 'hindi', 'chitra', 'TH', 6),
(25, 5, 'hindi', 'chitra', 'TH', 6),
(26, 5, 'hindi', 'chitra', 'TH', 6),
(27, 5, 'hindi', 'chitra', 'TH', 6),
(28, 5, 'hindi', 'chitra', 'TH', 6),
(29, 5, 'hindi', 'chitra', 'TH', 6),
(30, 5, 'hindi', 'chitra', 'TH', 6),
(31, 6, 'hindi', 'chitra', 'TH', 5),
(32, 6, 'hindi', 'chitra', 'TH', 5),
(33, 6, 'hindi', 'chitra', 'TH', 5),
(34, 6, 'hindi', 'chitra', 'TH', 5),
(35, 6, 'hindi', 'chitra', 'TH', 5);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co7timetable`
--

CREATE TABLE `hetsheth_co7timetable` (
  `srno` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `code` text,
  `count` text,
  `classname` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co7timetable`
--

INSERT INTO `hetsheth_co7timetable` (`srno`, `name`, `teacher`, `type`, `code`, `count`, `classname`) VALUES
(1, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(2, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(3, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(4, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(5, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(6, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(7, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(8, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(9, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(10, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(11, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(12, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(13, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(14, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(15, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(16, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(17, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(18, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(19, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(20, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(21, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(22, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(23, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(24, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(25, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(26, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(27, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(28, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(29, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(30, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(31, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(32, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(33, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(34, 'hindi', 'chitra', 'TH', NULL, NULL, NULL),
(35, 'hindi', 'chitra', 'TH', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co9details`
--

CREATE TABLE `hetsheth_co9details` (
  `srno` int(11) DEFAULT NULL,
  `starttimehrs` text,
  `starttimemin` text,
  `endtimehrs` text,
  `endtimemin` text,
  `recessstarthrs1` text,
  `recessstartmin1` text,
  `recessendhrs1` text,
  `recessendmin1` text,
  `recessstarthrs2` text,
  `recessstartmin2` text,
  `recessendhrs2` text,
  `recessendmin2` text,
  `recesses` text,
  `dailyperiod` text,
  `saturday` text,
  `halfday` text,
  `saturdayperiod` text,
  `amorpm` text,
  `amorpm1` text,
  `amorpm2` text,
  `amorpm3` text,
  `amorpm4` text,
  `amorpm5` text,
  `totallecture` text,
  `loopvalue` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co9details`
--

INSERT INTO `hetsheth_co9details` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue`) VALUES
(1, '9', '00', '15', '30', '11', '00', '11', '30', '', '', '', '', '1', '6', '1', '1', '', 'Am', 'Pm', 'Am', 'Am', 'Am', 'Am', '30', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co9subject`
--

CREATE TABLE `hetsheth_co9subject` (
  `srno` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `piroity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co9subject`
--

INSERT INTO `hetsheth_co9subject` (`srno`, `id`, `name`, `teacher`, `type`, `piroity`) VALUES
(1, 1, 'hindi', 'yash tailor', 'PR', 6),
(2, 1, 'hindi', 'yash tailor', 'PR', 6),
(3, 1, 'hindi', 'yash tailor', 'PR', 6),
(4, 1, 'hindi', 'yash tailor', 'PR', 6),
(5, 1, 'hindi', 'yash tailor', 'PR', 6),
(6, 1, 'hindi', 'yash tailor', 'PR', 6),
(7, 2, 'hindi', 'het', 'PR', 6),
(8, 2, 'hindi', 'het', 'PR', 6),
(9, 2, 'hindi', 'het', 'PR', 6),
(10, 2, 'hindi', 'het', 'PR', 6),
(11, 2, 'hindi', 'het', 'PR', 6),
(12, 2, 'hindi', 'het', 'PR', 6),
(13, 3, 'english', 'chitra', 'PR', 6),
(14, 3, 'english', 'chitra', 'PR', 6),
(15, 3, 'english', 'chitra', 'PR', 6),
(16, 3, 'english', 'chitra', 'PR', 6),
(17, 3, 'english', 'chitra', 'PR', 6),
(18, 3, 'english', 'chitra', 'PR', 6),
(19, 4, 'english', 'chitra', 'TH', 6),
(20, 4, 'english', 'chitra', 'TH', 6),
(21, 4, 'english', 'chitra', 'TH', 6),
(22, 4, 'english', 'chitra', 'TH', 6),
(23, 4, 'english', 'chitra', 'TH', 6),
(24, 4, 'english', 'chitra', 'TH', 6),
(25, 5, 'maths', 'yash', 'TH', 6),
(26, 5, 'maths', 'yash', 'TH', 6),
(27, 5, 'maths', 'yash', 'TH', 6),
(28, 5, 'maths', 'yash', 'TH', 6),
(29, 5, 'maths', 'yash', 'TH', 6),
(30, 5, 'maths', 'yash', 'TH', 6);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co9timetable`
--

CREATE TABLE `hetsheth_co9timetable` (
  `srno` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `code` text,
  `count` text,
  `classname` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co9timetable`
--

INSERT INTO `hetsheth_co9timetable` (`srno`, `name`, `teacher`, `type`, `code`, `count`, `classname`) VALUES
(1, 'english', 'chitra', 'TH', NULL, NULL, NULL),
(2, 'english', 'chitra', 'TH', NULL, NULL, NULL),
(3, 'english', 'chitra', 'PR', NULL, NULL, NULL),
(4, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(5, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(6, 'english', 'chitra', 'TH', NULL, NULL, NULL),
(7, 'hindi', 'yash tailor', 'PR', NULL, NULL, NULL),
(8, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(9, 'hindi', 'yash tailor', 'PR', NULL, NULL, NULL),
(10, 'hindi', 'het', 'PR', NULL, NULL, NULL),
(11, 'english', 'chitra', 'TH', NULL, NULL, NULL),
(12, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(13, 'hindi', 'yash tailor', 'PR', NULL, NULL, NULL),
(14, 'hindi', 'yash tailor', 'PR', NULL, NULL, NULL),
(15, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(16, 'english', 'chitra', 'PR', NULL, NULL, NULL),
(17, 'english', 'chitra', 'PR', NULL, NULL, NULL),
(18, 'hindi', 'yash tailor', 'PR', NULL, NULL, NULL),
(19, 'hindi', 'het', 'PR', NULL, NULL, NULL),
(20, 'english', 'chitra', 'PR', NULL, NULL, NULL),
(21, 'english', 'chitra', 'TH', NULL, NULL, NULL),
(22, 'english', 'chitra', 'TH', NULL, NULL, NULL),
(23, 'english', 'chitra', 'PR', NULL, NULL, NULL),
(24, 'hindi', 'het', 'PR', NULL, NULL, NULL),
(25, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(26, 'hindi', 'het', 'PR', NULL, NULL, NULL),
(27, 'hindi', 'yash tailor', 'PR', NULL, NULL, NULL),
(28, 'hindi', 'het', 'PR', NULL, NULL, NULL),
(29, 'english', 'chitra', 'PR', NULL, NULL, NULL),
(30, 'hindi', 'het', 'PR', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co10details`
--

CREATE TABLE `hetsheth_co10details` (
  `srno` int(11) DEFAULT NULL,
  `starttimehrs` text,
  `starttimemin` text,
  `endtimehrs` text,
  `endtimemin` text,
  `recessstarthrs1` text,
  `recessstartmin1` text,
  `recessendhrs1` text,
  `recessendmin1` text,
  `recessstarthrs2` text,
  `recessstartmin2` text,
  `recessendhrs2` text,
  `recessendmin2` text,
  `recesses` text,
  `dailyperiod` text,
  `saturday` text,
  `halfday` text,
  `saturdayperiod` text,
  `amorpm` text,
  `amorpm1` text,
  `amorpm2` text,
  `amorpm3` text,
  `amorpm4` text,
  `amorpm5` text,
  `totallecture` text,
  `loopvalue` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co10details`
--

INSERT INTO `hetsheth_co10details` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue`) VALUES
(1, '7', '30', '15', '00', '11', '30', '12', '00', '', '', '', '', '1', '6', '0', '1', '4', 'Am', 'Am', 'Am', 'Am', 'Am', 'Am', '34', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co10subject`
--

CREATE TABLE `hetsheth_co10subject` (
  `srno` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `piroity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co10subject`
--

INSERT INTO `hetsheth_co10subject` (`srno`, `id`, `name`, `teacher`, `type`, `piroity`) VALUES
(1, 1, 'hindi', 'chitra sheth', 'PR', 6),
(2, 1, 'hindi', 'chitra sheth', 'PR', 6),
(3, 1, 'hindi', 'chitra sheth', 'PR', 6),
(4, 1, 'hindi', 'chitra sheth', 'PR', 6),
(5, 1, 'hindi', 'chitra sheth', 'PR', 6),
(6, 1, 'hindi', 'chitra sheth', 'PR', 6),
(7, 2, 'english', 'yash', 'TH', 4),
(8, 2, 'english', 'yash', 'TH', 4),
(9, 2, 'english', 'yash', 'TH', 4),
(10, 2, 'english', 'yash', 'TH', 4),
(11, 3, 'english', 'het', 'PR', 5),
(12, 3, 'english', 'het', 'PR', 5),
(13, 3, 'english', 'het', 'PR', 5),
(14, 3, 'english', 'het', 'PR', 5),
(15, 3, 'english', 'het', 'PR', 5),
(16, 4, 'hindi', 'chitra', 'PR', 6),
(17, 4, 'hindi', 'chitra', 'PR', 6),
(18, 4, 'hindi', 'chitra', 'PR', 6),
(19, 4, 'hindi', 'chitra', 'PR', 6),
(20, 4, 'hindi', 'chitra', 'PR', 6),
(21, 4, 'hindi', 'chitra', 'PR', 6),
(22, 5, 'maths', 'het', 'TH', 6),
(23, 5, 'maths', 'het', 'TH', 6),
(24, 5, 'maths', 'het', 'TH', 6),
(25, 5, 'maths', 'het', 'TH', 6),
(26, 5, 'maths', 'het', 'TH', 6),
(27, 5, 'maths', 'het', 'TH', 6),
(28, 6, 'maths', 'yash', 'TH', 6),
(29, 6, 'maths', 'yash', 'TH', 6),
(30, 6, 'maths', 'yash', 'TH', 6),
(31, 6, 'maths', 'yash', 'TH', 6),
(32, 6, 'maths', 'yash', 'TH', 6),
(33, 6, 'maths', 'yash', 'TH', 6),
(34, 7, 'lpr', 'chitra', 'TH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co10timetable`
--

CREATE TABLE `hetsheth_co10timetable` (
  `srno` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `code` text,
  `count` text,
  `classname` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co10timetable`
--

INSERT INTO `hetsheth_co10timetable` (`srno`, `name`, `teacher`, `type`, `code`, `count`, `classname`) VALUES
(1, 'english', 'het', 'PR', NULL, NULL, NULL),
(2, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(3, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(4, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(5, 'hindi', 'chitra sheth', 'PR', NULL, NULL, NULL),
(6, 'lpr', 'chitra', 'TH', NULL, NULL, NULL),
(7, 'hindi', 'chitra sheth', 'PR', NULL, NULL, NULL),
(8, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(9, 'maths', 'het', 'TH', NULL, NULL, NULL),
(10, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(11, 'english', 'het', 'PR', NULL, NULL, NULL),
(12, 'english', 'yash', 'TH', NULL, NULL, NULL),
(13, 'hindi', 'chitra sheth', 'PR', NULL, NULL, NULL),
(14, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(15, 'maths', 'het', 'TH', NULL, NULL, NULL),
(16, 'maths', 'het', 'TH', NULL, NULL, NULL),
(17, 'hindi', 'chitra sheth', 'PR', NULL, NULL, NULL),
(18, 'maths', 'het', 'TH', NULL, NULL, NULL),
(19, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(20, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(21, 'hindi', 'chitra sheth', 'PR', NULL, NULL, NULL),
(22, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(23, 'maths', 'het', 'TH', NULL, NULL, NULL),
(24, 'hindi', 'chitra sheth', 'PR', NULL, NULL, NULL),
(25, 'english', 'yash', 'TH', NULL, NULL, NULL),
(26, 'english', 'het', 'PR', NULL, NULL, NULL),
(27, 'english', 'het', 'PR', NULL, NULL, NULL),
(28, 'english', 'het', 'PR', NULL, NULL, NULL),
(29, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(30, 'english', 'yash', 'TH', NULL, NULL, NULL),
(31, 'english', 'yash', 'TH', NULL, NULL, NULL),
(32, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(33, 'maths', 'yash', 'TH', NULL, NULL, NULL),
(34, 'maths', 'het', 'TH', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co14details`
--

CREATE TABLE `hetsheth_co14details` (
  `srno` int(11) DEFAULT NULL,
  `starttimehrs` text,
  `starttimemin` text,
  `endtimehrs` text,
  `endtimemin` text,
  `recessstarthrs1` text,
  `recessstartmin1` text,
  `recessendhrs1` text,
  `recessendmin1` text,
  `recessstarthrs2` text,
  `recessstartmin2` text,
  `recessendhrs2` text,
  `recessendmin2` text,
  `recesses` text,
  `dailyperiod` text,
  `saturday` text,
  `halfday` text,
  `saturdayperiod` text,
  `amorpm` text,
  `amorpm1` text,
  `amorpm2` text,
  `amorpm3` text,
  `amorpm4` text,
  `amorpm5` text,
  `totallecture` text,
  `loopvalue` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co14details`
--

INSERT INTO `hetsheth_co14details` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue`) VALUES
(1, '9', '30', '16', '00', '13', '30', '13', '00', '', '', '', '', '1', '7', '0', '1', '4', 'Am', 'Pm', 'Pm', 'Pm', 'Am', 'Am', '39', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co14subject`
--

CREATE TABLE `hetsheth_co14subject` (
  `srno` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `piroity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co14subject`
--

INSERT INTO `hetsheth_co14subject` (`srno`, `id`, `name`, `teacher`, `type`, `piroity`) VALUES
(1, 1, 'hindi', 'chitra sheth', 'TH', 4),
(2, 1, 'hindi', 'chitra sheth', 'TH', 4),
(3, 1, 'hindi', 'chitra sheth', 'TH', 4),
(4, 1, 'hindi', 'chitra sheth', 'TH', 4),
(5, 2, 'hindi', 'chitra', 'PR', 6),
(6, 2, 'hindi', 'chitra', 'PR', 6),
(7, 2, 'hindi', 'chitra', 'PR', 6),
(8, 2, 'hindi', 'chitra', 'PR', 6),
(9, 2, 'hindi', 'chitra', 'PR', 6),
(10, 2, 'hindi', 'chitra', 'PR', 6),
(11, 3, 'english', 'het', 'TH', 6),
(12, 3, 'english', 'het', 'TH', 6),
(13, 3, 'english', 'het', 'TH', 6),
(14, 3, 'english', 'het', 'TH', 6),
(15, 3, 'english', 'het', 'TH', 6),
(16, 3, 'english', 'het', 'TH', 6),
(17, 4, 'english', 'het', 'PR', 6),
(18, 4, 'english', 'het', 'PR', 6),
(19, 4, 'english', 'het', 'PR', 6),
(20, 4, 'english', 'het', 'PR', 6),
(21, 4, 'english', 'het', 'PR', 6),
(22, 4, 'english', 'het', 'PR', 6),
(23, 5, 'maths', 'chitra', 'TH', 1),
(24, 6, 'maths', 'het', 'PR', 6),
(25, 6, 'maths', 'het', 'PR', 6),
(26, 6, 'maths', 'het', 'PR', 6),
(27, 6, 'maths', 'het', 'PR', 6),
(28, 6, 'maths', 'het', 'PR', 6),
(29, 6, 'maths', 'het', 'PR', 6),
(30, 7, 'lpr', 'yash', 'TH', 6),
(31, 7, 'lpr', 'yash', 'TH', 6),
(32, 7, 'lpr', 'yash', 'TH', 6),
(33, 7, 'lpr', 'yash', 'TH', 6),
(34, 7, 'lpr', 'yash', 'TH', 6),
(35, 7, 'lpr', 'yash', 'TH', 6),
(36, 8, 'lpr', 'chitra', 'PR', 4),
(37, 8, 'lpr', 'chitra', 'PR', 4),
(38, 8, 'lpr', 'chitra', 'PR', 4),
(39, 8, 'lpr', 'chitra', 'PR', 4);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_co14timetable`
--

CREATE TABLE `hetsheth_co14timetable` (
  `srno` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `type` text NOT NULL,
  `code` text,
  `count` text,
  `classname` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_co14timetable`
--

INSERT INTO `hetsheth_co14timetable` (`srno`, `name`, `teacher`, `type`, `code`, `count`, `classname`) VALUES
(1, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(2, 'english', 'het', 'PR', NULL, NULL, NULL),
(3, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(4, 'lpr', 'yash', 'TH', NULL, NULL, NULL),
(5, 'english', 'het', 'TH', NULL, NULL, NULL),
(6, 'lpr', 'yash', 'TH', NULL, NULL, NULL),
(7, 'maths', 'chitra', 'TH', NULL, NULL, NULL),
(8, 'english', 'het', 'TH', NULL, NULL, NULL),
(9, 'english', 'het', 'PR', NULL, NULL, NULL),
(10, 'maths', 'het', 'PR', NULL, NULL, NULL),
(11, 'english', 'het', 'PR', NULL, NULL, NULL),
(12, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(13, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(14, 'english', 'het', 'PR', NULL, NULL, NULL),
(15, 'english', 'het', 'TH', NULL, NULL, NULL),
(16, 'lpr', 'chitra', 'PR', NULL, NULL, NULL),
(17, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(18, 'maths', 'het', 'PR', NULL, NULL, NULL),
(19, 'maths', 'het', 'PR', NULL, NULL, NULL),
(20, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(21, 'lpr', 'yash', 'TH', NULL, NULL, NULL),
(22, 'lpr', 'yash', 'TH', NULL, NULL, NULL),
(23, 'lpr', 'yash', 'TH', NULL, NULL, NULL),
(24, 'lpr', 'chitra', 'PR', NULL, NULL, NULL),
(25, 'english', 'het', 'PR', NULL, NULL, NULL),
(26, 'english', 'het', 'PR', NULL, NULL, NULL),
(27, 'lpr', 'yash', 'TH', NULL, NULL, NULL),
(28, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(29, 'lpr', 'chitra', 'PR', NULL, NULL, NULL),
(30, 'maths', 'het', 'PR', NULL, NULL, NULL),
(31, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(32, 'hindi', 'chitra sheth', 'TH', NULL, NULL, NULL),
(33, 'english', 'het', 'TH', NULL, NULL, NULL),
(34, 'english', 'het', 'TH', NULL, NULL, NULL),
(35, 'hindi', 'chitra', 'PR', NULL, NULL, NULL),
(36, 'lpr', 'chitra', 'PR', NULL, NULL, NULL),
(37, 'maths', 'het', 'PR', NULL, NULL, NULL),
(38, 'maths', 'het', 'PR', NULL, NULL, NULL),
(39, 'english', 'het', 'TH', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_hetsheth_filelist`
--

CREATE TABLE `hetsheth_hetsheth_filelist` (
  `srno` int(11) NOT NULL,
  `filename` text,
  `uploaddate` text,
  `modifydate` text,
  `studentpermission` text,
  `counts` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_hetsheth_filelist`
--

INSERT INTO `hetsheth_hetsheth_filelist` (`srno`, `filename`, `uploaddate`, `modifydate`, `studentpermission`, `counts`) VALUES
(1, 'Capture.PNG', '24/02/19 08:22:29pm', '01/03/19 12:46:33pm', 'no', 0),
(2, 'index.html', '24/02/19 08:22:48pm', '', 'no', NULL),
(3, '20-1.zip', '24/02/19 08:23:21pm', '', 'yes', NULL),
(4, 'aside-template.zip', '24/02/19 08:23:37pm', '', 'no', NULL),
(5, 'abc-20190209T074158Z-001.zip', '24/02/19 08:24:02pm', '', 'yes', NULL),
(6, 'aes-crypto-worker.js', '25/02/19 11:52:54am', '', 'yes', NULL),
(7, 'rsa-crypto-worker.js', '25/02/19 12:29:23pm', '', 'yes', NULL),
(8, 'elGamal-crypto-worker.js', '25/02/19 12:29:30pm', '', 'yes', NULL),
(9, 'app.js', '25/02/19 02:58:12pm', '', 'yes', NULL),
(10, 'add_vhost.php', '01/03/19 12:44:36pm', '', 'yes', NULL),
(11, 'blackbook_grp.pdf', '28/03/19 11:06:37am', '', 'yes', NULL),
(12, 'YASH__aotg.pdf', '28/03/19 11:07:00am', '', 'no', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_studentinformation`
--

CREATE TABLE `hetsheth_studentinformation` (
  `srno` int(11) NOT NULL,
  `firstname` text,
  `lastname` text,
  `studentid` text,
  `password` text,
  `securityquestion` text,
  `recoveryans` text,
  `recovery` text,
  `recoveryemailid` text,
  `recoveryphone` text,
  `adress` text,
  `country` text,
  `state` text,
  `city` text,
  `town` text,
  `district` text,
  `pincode` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_studentinformation`
--

INSERT INTO `hetsheth_studentinformation` (`srno`, `firstname`, `lastname`, `studentid`, `password`, `securityquestion`, `recoveryans`, `recovery`, `recoveryemailid`, `recoveryphone`, `adress`, `country`, `state`, `city`, `town`, `district`, `pincode`) VALUES
(1, 'yash', 'tailor', '3010@bvp.com', 'asdfg', 'What was your childhood nickname?', 'het', '', 'hetsheth40@gmail.com', '8291008132', 'trishul ', 'india', 'marastra', 'mumbai', 'kandivali', 'borivali', '400067'),
(2, 'yash', 'shah', '3012@bvp.com', 'GTA', 'What was your childhood nickname?', 'het', NULL, 'hetsheth40@gmail.com', '8291008132', 'trishul apt', 'india', 'marastra', 'mumbai', 'kandivali', 'borivali', '400067');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_studentusers`
--

CREATE TABLE `hetsheth_studentusers` (
  `srno` int(11) NOT NULL,
  `firstname` text,
  `lastname` text,
  `class` text NOT NULL,
  `rollno` int(11) NOT NULL,
  `adminusername` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `previewtimetable1` text,
  `previewtime1` text,
  `counts` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_studentusers`
--

INSERT INTO `hetsheth_studentusers` (`srno`, `firstname`, `lastname`, `class`, `rollno`, `adminusername`, `username`, `password`, `previewtimetable1`, `previewtime1`, `counts`) VALUES
(1, 'yash', 'tailor', 'co9', 3010, 'hetsheth', '3010@bvp.com', 'asdfg', 'hetsheth_co9timetable', 'hetsheth_co9details', 0),
(2, 'yash', 'shah', 'co9', 3012, 'hetsheth', '3012@bvp.com', 'GTA', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(3, NULL, NULL, 'co9', 3013, 'hetsheth', '3013@bvp.com', 'xF12`GJ35', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(4, NULL, NULL, 'co9', 3014, 'hetsheth', '3014@bvp.com', 'fj23*pY45', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(5, NULL, NULL, 'co9', 3015, 'hetsheth', '3015@bvp.com', 'jm36-zI78', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(6, NULL, NULL, 'co9', 3016, 'hetsheth', '3016@bvp.com', 'ak36_mQ89', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(7, NULL, NULL, 'co9', 3017, 'hetsheth', '3017@bvp.com', 'sH12`RU68', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(8, NULL, NULL, 'co9', 3018, 'hetsheth', '3018@bvp.com', 'er16%wE89', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(9, NULL, NULL, 'co9', 3019, 'hetsheth', '3019@bvp.com', 'qF14^MX59', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(10, NULL, NULL, 'co9', 3020, 'hetsheth', '3020@bvp.com', 'hl14_nB56', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(11, NULL, NULL, 'co9', 3021, 'hetsheth', '3021@bvp.com', 'hv14=LN78', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(12, NULL, NULL, 'co9', 3022, 'hetsheth', '3022@bvp.com', 'fB34=IS56', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(13, NULL, NULL, 'co9', 3023, 'hetsheth', '3023@bvp.com', 'af13!kP69', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(14, NULL, NULL, 'co9', 3024, 'hetsheth', '3024@bvp.com', 'ko34~UW79', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(15, NULL, NULL, 'co9', 3025, 'hetsheth', '3025@bvp.com', 'ov36`CN78', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(16, NULL, NULL, 'co9', 3026, 'hetsheth', '3026@bvp.com', 'gh35@AX79', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(17, NULL, NULL, 'co9', 3027, 'hetsheth', '3027@bvp.com', 'dA16@BM89', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(18, NULL, NULL, 'co9', 3028, 'hetsheth', '3028@bvp.com', 'do25+ET67', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(19, NULL, NULL, 'co9', 3029, 'hetsheth', '3029@bvp.com', 'jo23`st67', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(20, NULL, NULL, 'co9', 3030, 'hetsheth', '3030@bvp.com', 'ms23`PU47', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(21, NULL, NULL, 'co9', 3031, 'hetsheth', '3031@bvp.com', 'hl23_DN56', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(22, NULL, NULL, 'co9', 3032, 'hetsheth', '3032@bvp.com', 'oG36`QS78', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(23, NULL, NULL, 'co9', 3033, 'hetsheth', '3033@bvp.com', 'dr12@FG37', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(24, NULL, NULL, 'co9', 3034, 'hetsheth', '3034@bvp.com', 'hw67&SX89', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(25, NULL, NULL, 'co9', 3035, 'hetsheth', '3035@bvp.com', 'an23#rI79', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(26, NULL, NULL, 'co9', 3036, 'hetsheth', '3036@bvp.com', 'mv23$xY58', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(27, NULL, NULL, 'co9', 3037, 'hetsheth', '3037@bvp.com', 'dF13`LV46', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(28, NULL, NULL, 'co9', 3038, 'hetsheth', '3038@bvp.com', 'fn24%HY58', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(29, NULL, NULL, 'co9', 3039, 'hetsheth', '3039@bvp.com', 'kD35@JW79', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(30, NULL, NULL, 'co9', 3040, 'hetsheth', '3040@bvp.com', 'qF34$RU89', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(31, NULL, NULL, 'co9', 3041, 'hetsheth', '3041@bvp.com', 'nq34.vZ68', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(32, NULL, NULL, 'co9', 3042, 'hetsheth', '3042@bvp.com', 'ej12%py78', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(33, NULL, NULL, 'co9', 3043, 'hetsheth', '3043@bvp.com', 'aA12&KV78', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(34, NULL, NULL, 'co9', 3044, 'hetsheth', '3044@bvp.com', 'tw12&EK35', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(35, NULL, NULL, 'co9', 3045, 'hetsheth', '3045@bvp.com', 'BO14%PR69', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(36, NULL, NULL, 'co9', 3046, 'hetsheth', '3046@bvp.com', 'hm15^HN79', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(37, NULL, NULL, 'co9', 3047, 'hetsheth', '3047@bvp.com', 'in17$tT89', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(38, NULL, NULL, 'co9', 3048, 'hetsheth', '3048@bvp.com', 'zA25-UX67', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(39, NULL, NULL, 'co9', 3049, 'hetsheth', '3049@bvp.com', 'fo12%wB67', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(40, NULL, NULL, 'co9', 3050, 'hetsheth', '3050@bvp.com', 'yz13^IO46', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(41, NULL, NULL, 'co9', 3051, 'hetsheth', '3051@bvp.com', 'sv34%CY67', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(42, NULL, NULL, 'co9', 3052, 'hetsheth', '3052@bvp.com', 'jm12&KQ36', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(43, NULL, NULL, 'co9', 3053, 'hetsheth', '3053@bvp.com', 'no12^AL78', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(44, NULL, NULL, 'co9', 3054, 'hetsheth', '3054@bvp.com', 'rw13%zU79', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(45, NULL, NULL, 'co9', 3055, 'hetsheth', '3055@bvp.com', 'vA15$CQ67', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(46, NULL, NULL, 'co9', 3056, 'hetsheth', '3056@bvp.com', 'ef14#vG69', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(47, NULL, NULL, 'co9', 3057, 'hetsheth', '3057@bvp.com', 'bg24`iR78', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(48, NULL, NULL, 'co9', 3058, 'hetsheth', '3058@bvp.com', 'sA35$YZ69', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(49, NULL, NULL, 'co9', 3059, 'hetsheth', '3059@bvp.com', 'cl12`UY89', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(50, NULL, NULL, 'co9', 3060, 'hetsheth', '3060@bvp.com', 'cl16$KS89', 'hetsheth_co9timetable', 'hetsheth_co9details', NULL),
(51, NULL, NULL, 'co9', 3011, 'hetsheth', 'hetsheth@bvp.com', 'kB14~IW57', NULL, NULL, NULL),
(52, NULL, NULL, 'ssx', 1234, 'hetsheth', '1234@bvp.com', 'fj12`tv45', NULL, NULL, NULL),
(53, NULL, NULL, 'ssx', 1235, 'hetsheth', '1235@bvp.com', 'ov15~xY67', NULL, NULL, NULL),
(54, NULL, NULL, 'ssx', 1236, 'hetsheth', '1236@bvp.com', 'oz25#KN89', NULL, NULL, NULL),
(55, NULL, NULL, 'ssx', 1237, 'hetsheth', '1237@bvp.com', 'xJ23=SV69', NULL, NULL, NULL),
(56, NULL, NULL, 'ssx', 1238, 'hetsheth', '1238@bvp.com', 'px13%HI89', NULL, NULL, NULL),
(57, NULL, NULL, 'ssx', 1239, 'hetsheth', '1239@bvp.com', 'yG26~OS89', NULL, NULL, NULL),
(58, NULL, NULL, 'ssx', 1240, 'hetsheth', '1240@bvp.com', 'el23^sB67', NULL, NULL, NULL),
(59, NULL, NULL, 'ssx', 1241, 'hetsheth', '1241@bvp.com', 'oN24`TX58', NULL, NULL, NULL),
(60, NULL, NULL, 'ssx', 1242, 'hetsheth', '1242@bvp.com', 'wz35$FT68', NULL, NULL, NULL),
(61, NULL, NULL, 'ssx', 1243, 'hetsheth', '1243@bvp.com', 'hp12!GW79', NULL, NULL, NULL),
(62, NULL, NULL, 'ssx', 1244, 'hetsheth', '1244@bvp.com', 'iH24-IL79', NULL, NULL, NULL),
(63, NULL, NULL, 'ssx', 1245, 'hetsheth', '1245@bvp.com', 'dP23$SU59', NULL, NULL, NULL),
(64, NULL, NULL, 'ssx', 1246, 'hetsheth', '1246@bvp.com', 'ap14@PW57', NULL, NULL, NULL),
(65, NULL, NULL, 'ssx', 1247, 'hetsheth', '1247@bvp.com', 'fh34*CN68', NULL, NULL, NULL),
(66, NULL, NULL, 'ssx', 1248, 'hetsheth', '1248@bvp.com', 'hs46=CP89', NULL, NULL, NULL),
(67, NULL, NULL, 'ssx', 1249, 'hetsheth', '1249@bvp.com', 'rw12#IX57', NULL, NULL, NULL),
(68, NULL, NULL, 'ssx', 1250, 'hetsheth', '1250@bvp.com', 'rC12~KZ79', NULL, NULL, NULL),
(69, NULL, NULL, 'ssx', 1251, 'hetsheth', '1251@bvp.com', 'pL35!OX79', NULL, NULL, NULL),
(70, NULL, NULL, 'ssx', 1252, 'hetsheth', '1252@bvp.com', 'rB34%CF57', NULL, NULL, NULL),
(71, NULL, NULL, 'ssx', 1253, 'hetsheth', '1253@bvp.com', 'et12!PR56', NULL, NULL, NULL),
(72, NULL, NULL, 'ssx', 1254, 'hetsheth', '1254@bvp.com', 'ew13$JW79', NULL, NULL, NULL),
(73, NULL, NULL, 'ssx', 1255, 'hetsheth', '1255@bvp.com', 'rN23&QT46', NULL, NULL, NULL),
(74, NULL, NULL, 'ssx', 1256, 'hetsheth', '1256@bvp.com', 'bd25^kZ67', NULL, NULL, NULL),
(75, NULL, NULL, 'ssx', 1257, 'hetsheth', '1257@bvp.com', 'eu46+BX78', NULL, NULL, NULL),
(76, NULL, NULL, 'ssx', 1258, 'hetsheth', '1258@bvp.com', 'cn12&QR45', NULL, NULL, NULL),
(77, NULL, NULL, 'ssx', 1259, 'hetsheth', '1259@bvp.com', 'ck67@vB89', NULL, NULL, NULL),
(78, NULL, NULL, 'ssx', 1260, 'hetsheth', '1260@bvp.com', 'gm34!tD68', NULL, NULL, NULL),
(79, NULL, NULL, 'co2', 4000, 'hetsheth', '4000@bvp.com', 'ej23!HZ59', NULL, NULL, NULL),
(80, NULL, NULL, 'co2', 4001, 'hetsheth', '4001@bvp.com', 'ef26&rM89', NULL, NULL, NULL),
(81, NULL, NULL, 'co2', 4002, 'hetsheth', '4002@bvp.com', 'dq45&tP79', NULL, NULL, NULL),
(82, NULL, NULL, 'co2', 4003, 'hetsheth', '4003@bvp.com', 'hy24!SW67', NULL, NULL, NULL),
(83, NULL, NULL, 'co2', 4004, 'hetsheth', '4004@bvp.com', 'io15~HV67', NULL, NULL, NULL),
(84, NULL, NULL, 'co2', 4005, 'hetsheth', '4005@bvp.com', 'lR34@TV57', NULL, NULL, NULL),
(85, NULL, NULL, 'co2', 4006, 'hetsheth', '4006@bvp.com', 'no24`wY56', NULL, NULL, NULL),
(86, NULL, NULL, 'co2', 4007, 'hetsheth', '4007@bvp.com', 'gk13&yU46', NULL, NULL, NULL),
(87, NULL, NULL, 'co2', 4008, 'hetsheth', '4008@bvp.com', 'bd15`nE68', NULL, NULL, NULL),
(88, NULL, NULL, 'co2', 4009, 'hetsheth', '4009@bvp.com', 'pI23@NU78', NULL, NULL, NULL),
(89, NULL, NULL, 'co2', 4010, 'hetsheth', '4010@bvp.com', 'it35%EJ69', NULL, NULL, NULL),
(90, NULL, NULL, 'co2', 4011, 'hetsheth', '4011@bvp.com', 'vA12!JQ36', NULL, NULL, NULL),
(91, NULL, NULL, 'co2', 4012, 'hetsheth', '4012@bvp.com', 'er12=NR78', NULL, NULL, NULL),
(92, NULL, NULL, 'co2', 4013, 'hetsheth', '4013@bvp.com', 'jq25$sV89', NULL, NULL, NULL),
(93, NULL, NULL, 'co2', 4014, 'hetsheth', '4014@bvp.com', 'gj23~wE58', NULL, NULL, NULL),
(94, NULL, NULL, 'co2', 4015, 'hetsheth', '4015@bvp.com', 'di16_CQ79', NULL, NULL, NULL),
(95, NULL, NULL, 'co2', 4016, 'hetsheth', '4016@bvp.com', 'dF13%OX89', NULL, NULL, NULL),
(96, NULL, NULL, 'co2', 4017, 'hetsheth', '4017@bvp.com', 'lm14%EI67', NULL, NULL, NULL),
(97, NULL, NULL, 'co2', 4018, 'hetsheth', '4018@bvp.com', 'PQ24$XY67', NULL, NULL, NULL),
(98, NULL, NULL, 'co2', 4019, 'hetsheth', '4019@bvp.com', 'jL13!OZ79', NULL, NULL, NULL),
(99, NULL, NULL, 'co2', 4020, 'hetsheth', '4020@bvp.com', 'jG36%OW89', NULL, NULL, NULL),
(100, NULL, NULL, 'co2', 4021, 'hetsheth', '4021@bvp.com', 'mn24~vY57', NULL, NULL, NULL),
(101, NULL, NULL, 'co2', 4022, 'hetsheth', '4022@bvp.com', 'oq35_AZ89', NULL, NULL, NULL),
(102, NULL, NULL, 'co2', 4023, 'hetsheth', '4023@bvp.com', 'bq12$NO38', NULL, NULL, NULL),
(103, NULL, NULL, 'co2', 4024, 'hetsheth', '4024@bvp.com', 'du47*FU89', NULL, NULL, NULL),
(104, NULL, NULL, 'co2', 4025, 'hetsheth', '4025@bvp.com', 'vI12~PU58', NULL, NULL, NULL),
(105, NULL, NULL, 'co2', 4026, 'hetsheth', '4026@bvp.com', 'dn23@ES89', NULL, NULL, NULL),
(106, NULL, NULL, 'co2', 4027, 'hetsheth', '4027@bvp.com', 'fk12~BZ59', NULL, NULL, NULL),
(107, NULL, NULL, 'co2', 4028, 'hetsheth', '4028@bvp.com', 'iF12$JT89', NULL, NULL, NULL),
(108, NULL, NULL, 'co2', 4029, 'hetsheth', '4029@bvp.com', 'nE35@QX79', NULL, NULL, NULL),
(109, NULL, NULL, 'co2', 4030, 'hetsheth', '4030@bvp.com', 'ck45~vT68', NULL, NULL, NULL),
(110, NULL, NULL, 'co2', 4031, 'hetsheth', '4031@bvp.com', 'nz46*MZ78', NULL, NULL, NULL),
(111, NULL, NULL, 'co2', 4032, 'hetsheth', '4032@bvp.com', 'ek13$AH58', NULL, NULL, NULL),
(112, NULL, NULL, 'co2', 4033, 'hetsheth', '4033@bvp.com', 'ch14%EX59', NULL, NULL, NULL),
(113, NULL, NULL, 'co2', 4034, 'hetsheth', '4034@bvp.com', 'lt12~zQ34', NULL, NULL, NULL),
(114, NULL, NULL, 'co2', 4035, 'hetsheth', '4035@bvp.com', 'gj46-FL78', NULL, NULL, NULL),
(115, NULL, NULL, 'co2', 4036, 'hetsheth', '4036@bvp.com', 'av12~AL36', NULL, NULL, NULL),
(116, NULL, NULL, 'co2', 4037, 'hetsheth', '4037@bvp.com', 'rG35@WX69', NULL, NULL, NULL),
(117, NULL, NULL, 'co2', 4038, 'hetsheth', '4038@bvp.com', 'bj13@LW45', NULL, NULL, NULL),
(118, NULL, NULL, 'co2', 4039, 'hetsheth', '4039@bvp.com', 'eu12$EI49', NULL, NULL, NULL),
(119, NULL, NULL, 'co2', 4040, 'hetsheth', '4040@bvp.com', 'rI24!LZ57', NULL, NULL, NULL),
(120, NULL, NULL, 'co2', 4041, 'hetsheth', '4041@bvp.com', 'ch13!FO79', NULL, NULL, NULL),
(121, NULL, NULL, 'co2', 4042, 'hetsheth', '4042@bvp.com', 'oD14*IN59', NULL, NULL, NULL),
(122, NULL, NULL, 'co2', 4043, 'hetsheth', '4043@bvp.com', 'ac16^ns79', NULL, NULL, NULL),
(123, NULL, NULL, 'co2', 4044, 'hetsheth', '4044@bvp.com', 'xJ36$NO78', NULL, NULL, NULL),
(124, NULL, NULL, 'co2', 4045, 'hetsheth', '4045@bvp.com', 'ex25~CR67', NULL, NULL, NULL),
(125, NULL, NULL, 'co2', 4046, 'hetsheth', '4046@bvp.com', 'af12~wN45', NULL, NULL, NULL),
(126, NULL, NULL, 'co2', 4047, 'hetsheth', '4047@bvp.com', 'xC23!HU48', NULL, NULL, NULL),
(127, NULL, NULL, 'co2', 4048, 'hetsheth', '4048@bvp.com', 'EO13!XY69', NULL, NULL, NULL),
(128, NULL, NULL, 'co2', 4049, 'hetsheth', '4049@bvp.com', 'KP12@VX48', NULL, NULL, NULL),
(129, NULL, NULL, 'co2', 4050, 'hetsheth', '4050@bvp.com', 'wR46$VZ79', NULL, NULL, NULL),
(130, NULL, NULL, 'co2', 4051, 'hetsheth', '4051@bvp.com', 'jI27*TX89', NULL, NULL, NULL),
(131, NULL, NULL, 'co2', 4052, 'hetsheth', '4052@bvp.com', 'dg25*yN69', NULL, NULL, NULL),
(132, NULL, NULL, 'co2', 4053, 'hetsheth', '4053@bvp.com', 'af14-yG58', NULL, NULL, NULL),
(133, NULL, NULL, 'co2', 4054, 'hetsheth', '4054@bvp.com', 'pu12^CT89', NULL, NULL, NULL),
(134, NULL, NULL, 'co2', 4055, 'hetsheth', '4055@bvp.com', 'ij14#qA69', NULL, NULL, NULL),
(135, NULL, NULL, 'co2', 4056, 'hetsheth', '4056@bvp.com', 'fg23$tR57', NULL, NULL, NULL),
(136, NULL, NULL, 'co2', 4057, 'hetsheth', '4057@bvp.com', 'pI35$OY69', NULL, NULL, NULL),
(137, NULL, NULL, 'co2', 4058, 'hetsheth', '4058@bvp.com', 'dw12.XZ79', NULL, NULL, NULL),
(138, NULL, NULL, 'co2', 4059, 'hetsheth', '4059@bvp.com', 'hx27*zY89', NULL, NULL, NULL),
(139, NULL, NULL, 'co2', 4060, 'hetsheth', '4060@bvp.com', 'uN12%RT69', NULL, NULL, NULL),
(140, NULL, NULL, 'co2', 4061, 'hetsheth', '4061@bvp.com', 'hs34!FW69', NULL, NULL, NULL),
(141, NULL, NULL, 'co2', 4062, 'hetsheth', '4062@bvp.com', 'uD12*TZ48', NULL, NULL, NULL),
(142, NULL, NULL, 'co2', 4063, 'hetsheth', '4063@bvp.com', 'su12=VW49', NULL, NULL, NULL),
(143, NULL, NULL, 'co2', 4064, 'hetsheth', '4064@bvp.com', 'tB25^NV68', NULL, NULL, NULL),
(144, NULL, NULL, 'co2', 4065, 'hetsheth', '4065@bvp.com', 'dA12~JX89', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_subjects`
--

CREATE TABLE `hetsheth_subjects` (
  `srno` int(11) NOT NULL,
  `subjectname` text,
  `counts` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_subjects`
--

INSERT INTO `hetsheth_subjects` (`srno`, `subjectname`, `counts`) VALUES
(1, 'hindi', 0),
(2, 'english', NULL),
(3, 'maths', NULL),
(4, 'lpr', NULL),
(5, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_teacherinformation`
--

CREATE TABLE `hetsheth_teacherinformation` (
  `srno` int(11) NOT NULL,
  `firstname` text,
  `lastname` text,
  `teacherid` text,
  `password` text,
  `securityquestion` text,
  `recoveryans` text,
  `recoveryemailid` text,
  `recoveryphone` text,
  `adress` text,
  `country` text,
  `state` text,
  `city` text,
  `town` text,
  `district` text,
  `pincode` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_teacherinformation`
--

INSERT INTO `hetsheth_teacherinformation` (`srno`, `firstname`, `lastname`, `teacherid`, `password`, `securityquestion`, `recoveryans`, `recoveryemailid`, `recoveryphone`, `adress`, `country`, `state`, `city`, `town`, `district`, `pincode`) VALUES
(1, 'het', 'sheth', 'hetsheth@bvp.com', 'hetsheth', 'What was your childhood nickname?', 'het', 'hetsheth40@gmail.com', '                  ----', 'trishul apt', 'india', 'marastra', 'mumbai', 'kandivali', 'borivali', '400067'),
(2, 'chitra', 'sheth', 'chitrasheth@bvp.com', 'hetsheths', 'What was your childhood nickname?', 'het', 'hetsheth40@gmail.com', '8291008132', 'trishul apt', 'india', 'marastra', 'mumbai', 'kandivali', 'borivali', '400067'),
(3, 'yash', 'shah', 'yashtailor@bvp.com', 'het', 'What was your childhood nickname?', 'het', 'hetsheth40@gmail.com', '8291008132', 'trishul apt', 'india', 'marastra', 'mumbai', 'kandivali', 'borivali', '400067');

-- --------------------------------------------------------

--
-- Table structure for table `hetsheth_teacherusers`
--

CREATE TABLE `hetsheth_teacherusers` (
  `srno` int(11) NOT NULL,
  `firstname` text,
  `lastname` text,
  `username` text NOT NULL,
  `adminname` text NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `previewtimetable1` text,
  `previewtime1` text,
  `timecounts` int(11) DEFAULT NULL,
  `previewtimetable2` text,
  `previewtime2` text,
  `counts` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetsheth_teacherusers`
--

INSERT INTO `hetsheth_teacherusers` (`srno`, `firstname`, `lastname`, `username`, `adminname`, `name`, `password`, `previewtimetable1`, `previewtime1`, `timecounts`, `previewtimetable2`, `previewtime2`, `counts`) VALUES
(1, 'chitra', 'sheth', 'chitrasheth@bvp.com', 'hetsheth', 'chitra sheth', 'hetsheths', 'hetsheth_co2timetable', 'hetsheth_co2details', 3, 'hetsheth_co9timetable', 'hetsheth_co9details', 0),
(2, 'yash', 'shah', 'yashtailor@bvp.com', 'hetsheth', 'yash tailor', 'het', NULL, NULL, 1, NULL, NULL, NULL),
(3, 'het', 'sheth', 'hetsheth@bvp.com', 'hetsheth', 'het sheth', 'hetsheth', 'hetsheth_co9timetable', 'hetsheth_co9details', 3, 'hetsheth_co2timetable', 'hetsheth_co2details', NULL),
(4, NULL, NULL, 'chitrashah@bvp.com', 'hetsheth', 'chitra shah', 'oq35_AZ89', NULL, NULL, 1, NULL, NULL, NULL),
(5, NULL, NULL, 'yashshah@bvp.com', 'hetsheth', 'yash shah', 'bq12$NO38', NULL, NULL, 1, NULL, NULL, NULL),
(6, NULL, NULL, 'hetshah@bvp.com', 'hetsheth', 'het shah', 'du47*FU89', NULL, NULL, 1, NULL, NULL, NULL),
(7, NULL, NULL, 'yashtailor@bvp.com', 'hetsheth', 'yash tailor', 'di24#lo59', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admininformation`
--
ALTER TABLE `admininformation`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `adminusers`
--
ALTER TABLE `adminusers`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_cm7subject`
--
ALTER TABLE `hetsheth_cm7subject`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_cm7timetable`
--
ALTER TABLE `hetsheth_cm7timetable`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_co7subject`
--
ALTER TABLE `hetsheth_co7subject`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_co7timetable`
--
ALTER TABLE `hetsheth_co7timetable`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_co9subject`
--
ALTER TABLE `hetsheth_co9subject`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_co9timetable`
--
ALTER TABLE `hetsheth_co9timetable`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_co10subject`
--
ALTER TABLE `hetsheth_co10subject`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_co10timetable`
--
ALTER TABLE `hetsheth_co10timetable`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_co14subject`
--
ALTER TABLE `hetsheth_co14subject`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_co14timetable`
--
ALTER TABLE `hetsheth_co14timetable`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_hetsheth_filelist`
--
ALTER TABLE `hetsheth_hetsheth_filelist`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `hetsheth_studentinformation`
--
ALTER TABLE `hetsheth_studentinformation`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_studentusers`
--
ALTER TABLE `hetsheth_studentusers`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `hetsheth_subjects`
--
ALTER TABLE `hetsheth_subjects`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `hetsheth_teacherinformation`
--
ALTER TABLE `hetsheth_teacherinformation`
  ADD PRIMARY KEY (`srno`),
  ADD UNIQUE KEY `srno` (`srno`);

--
-- Indexes for table `hetsheth_teacherusers`
--
ALTER TABLE `hetsheth_teacherusers`
  ADD PRIMARY KEY (`srno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admininformation`
--
ALTER TABLE `admininformation`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `adminusers`
--
ALTER TABLE `adminusers`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hetsheth_cm7subject`
--
ALTER TABLE `hetsheth_cm7subject`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `hetsheth_cm7timetable`
--
ALTER TABLE `hetsheth_cm7timetable`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `hetsheth_co7subject`
--
ALTER TABLE `hetsheth_co7subject`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `hetsheth_co7timetable`
--
ALTER TABLE `hetsheth_co7timetable`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `hetsheth_co9subject`
--
ALTER TABLE `hetsheth_co9subject`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `hetsheth_co9timetable`
--
ALTER TABLE `hetsheth_co9timetable`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `hetsheth_co10subject`
--
ALTER TABLE `hetsheth_co10subject`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `hetsheth_co10timetable`
--
ALTER TABLE `hetsheth_co10timetable`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `hetsheth_co14subject`
--
ALTER TABLE `hetsheth_co14subject`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `hetsheth_co14timetable`
--
ALTER TABLE `hetsheth_co14timetable`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `hetsheth_hetsheth_filelist`
--
ALTER TABLE `hetsheth_hetsheth_filelist`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `hetsheth_studentinformation`
--
ALTER TABLE `hetsheth_studentinformation`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hetsheth_studentusers`
--
ALTER TABLE `hetsheth_studentusers`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `hetsheth_subjects`
--
ALTER TABLE `hetsheth_subjects`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hetsheth_teacherinformation`
--
ALTER TABLE `hetsheth_teacherinformation`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hetsheth_teacherusers`
--
ALTER TABLE `hetsheth_teacherusers`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
