-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2020 at 05:13 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `svpvv_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitra_sheth_time_detail`
--

CREATE TABLE `chitra_sheth_time_detail` (
  `srno` int(11) NOT NULL,
  `col_institute_start_hour` int(11) DEFAULT NULL,
  `col_institute_start_minute` int(11) DEFAULT NULL,
  `col_institute_start_amorpm` text,
  `col_institute_end_hour` int(11) DEFAULT NULL,
  `col_institute_end_minute` int(11) DEFAULT NULL,
  `col_institute_end_amorpm` text,
  `col_recess_count` int(11) DEFAULT NULL,
  `col_first_recess_start_hour` int(11) DEFAULT NULL,
  `col_first_recess_start_minute` int(11) DEFAULT NULL,
  `col_first_recess_start_amorpm` text,
  `col_first_recess_end_hour` int(11) DEFAULT NULL,
  `col_first_recess_end_minute` int(11) DEFAULT NULL,
  `col_first_recess_end_amorpm` text,
  `col_second_recess_start_hour` int(11) DEFAULT NULL,
  `col_second_recess_start_minute` int(11) DEFAULT NULL,
  `col_second_recess_start_amorpm` text,
  `col_second_recess_end_hour` int(11) DEFAULT NULL,
  `col_second_recess_end_minute` int(11) DEFAULT NULL,
  `col_second_recess_end_amorpm` text,
  `col_daily_lecture_count` text,
  `col_holiday` text,
  `col_closed_day` text,
  `col_halfday` text,
  `col_opened_day` text,
  `col_halfday_lecture_count` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chitra_sheth_time_detail`
--

INSERT INTO `chitra_sheth_time_detail` (`srno`, `col_institute_start_hour`, `col_institute_start_minute`, `col_institute_start_amorpm`, `col_institute_end_hour`, `col_institute_end_minute`, `col_institute_end_amorpm`, `col_recess_count`, `col_first_recess_start_hour`, `col_first_recess_start_minute`, `col_first_recess_start_amorpm`, `col_first_recess_end_hour`, `col_first_recess_end_minute`, `col_first_recess_end_amorpm`, `col_second_recess_start_hour`, `col_second_recess_start_minute`, `col_second_recess_start_amorpm`, `col_second_recess_end_hour`, `col_second_recess_end_minute`, `col_second_recess_end_amorpm`, `col_daily_lecture_count`, `col_holiday`, `col_closed_day`, `col_halfday`, `col_opened_day`, `col_halfday_lecture_count`) VALUES
(1, 9, 30, 'Am', 16, 0, 'Pm', 1, 12, 0, 'Pm', 13, 0, 'Pm', 1, 0, 'Pm', 1, 0, 'Pm', '6', '1', '2', '1', '4', '3');

-- --------------------------------------------------------

--
-- Table structure for table `co1_time_detail`
--

CREATE TABLE `co1_time_detail` (
  `srno` int(11) NOT NULL,
  `col_institute_start_hour` int(11) DEFAULT NULL,
  `col_institute_start_minute` int(11) DEFAULT NULL,
  `col_institute_start_amorpm` text,
  `col_institute_end_hour` int(11) DEFAULT NULL,
  `col_institute_end_minute` int(11) DEFAULT NULL,
  `col_institute_end_amorpm` text,
  `col_recess_count` int(11) DEFAULT NULL,
  `col_first_recess_start_hour` int(11) DEFAULT NULL,
  `col_first_recess_start_minute` int(11) DEFAULT NULL,
  `col_first_recess_start_amorpm` text,
  `col_first_recess_end_hour` int(11) DEFAULT NULL,
  `col_first_recess_end_minute` int(11) DEFAULT NULL,
  `col_first_recess_end_amorpm` text,
  `col_second_recess_start_hour` int(11) DEFAULT NULL,
  `col_second_recess_start_minute` int(11) DEFAULT NULL,
  `col_second_recess_start_amorpm` text,
  `col_second_recess_end_hour` int(11) DEFAULT NULL,
  `col_second_recess_end_minute` int(11) DEFAULT NULL,
  `col_second_recess_end_amorpm` text,
  `col_student_count` int(11) DEFAULT NULL,
  `col_batch_count` int(11) DEFAULT NULL,
  `col_daily_lecture_count` text,
  `col_holiday` text,
  `col_closed_day` text,
  `col_halfday` text,
  `col_opened_day` text,
  `col_halfday_lecture_count` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `co1_time_detail`
--

INSERT INTO `co1_time_detail` (`srno`, `col_institute_start_hour`, `col_institute_start_minute`, `col_institute_start_amorpm`, `col_institute_end_hour`, `col_institute_end_minute`, `col_institute_end_amorpm`, `col_recess_count`, `col_first_recess_start_hour`, `col_first_recess_start_minute`, `col_first_recess_start_amorpm`, `col_first_recess_end_hour`, `col_first_recess_end_minute`, `col_first_recess_end_amorpm`, `col_second_recess_start_hour`, `col_second_recess_start_minute`, `col_second_recess_start_amorpm`, `col_second_recess_end_hour`, `col_second_recess_end_minute`, `col_second_recess_end_amorpm`, `col_student_count`, `col_batch_count`, `col_daily_lecture_count`, `col_holiday`, `col_closed_day`, `col_halfday`, `col_opened_day`, `col_halfday_lecture_count`) VALUES
(1, 9, 30, 'Am', 16, 30, 'Pm', 1, 12, 30, 'Pm', 13, 0, 'Pm', 14, 0, 'Pm', 14, 0, 'Pm', 60, 3, '6', '1', '1', '1', '5', '3');

-- --------------------------------------------------------

--
-- Table structure for table `het_sheth_time_detail`
--

CREATE TABLE `het_sheth_time_detail` (
  `srno` int(11) NOT NULL,
  `col_institute_start_hour` int(11) DEFAULT NULL,
  `col_institute_start_minute` int(11) DEFAULT NULL,
  `col_institute_start_amorpm` text,
  `col_institute_end_hour` int(11) DEFAULT NULL,
  `col_institute_end_minute` int(11) DEFAULT NULL,
  `col_institute_end_amorpm` text,
  `col_recess_count` int(11) DEFAULT NULL,
  `col_first_recess_start_hour` int(11) DEFAULT NULL,
  `col_first_recess_start_minute` int(11) DEFAULT NULL,
  `col_first_recess_start_amorpm` text,
  `col_first_recess_end_hour` int(11) DEFAULT NULL,
  `col_first_recess_end_minute` int(11) DEFAULT NULL,
  `col_first_recess_end_amorpm` text,
  `col_second_recess_start_hour` int(11) DEFAULT NULL,
  `col_second_recess_start_minute` int(11) DEFAULT NULL,
  `col_second_recess_start_amorpm` text,
  `col_second_recess_end_hour` int(11) DEFAULT NULL,
  `col_second_recess_end_minute` int(11) DEFAULT NULL,
  `col_second_recess_end_amorpm` text,
  `col_daily_lecture_count` text,
  `col_holiday` text,
  `col_closed_day` text,
  `col_halfday` text,
  `col_opened_day` text,
  `col_halfday_lecture_count` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `het_sheth_time_detail`
--

INSERT INTO `het_sheth_time_detail` (`srno`, `col_institute_start_hour`, `col_institute_start_minute`, `col_institute_start_amorpm`, `col_institute_end_hour`, `col_institute_end_minute`, `col_institute_end_amorpm`, `col_recess_count`, `col_first_recess_start_hour`, `col_first_recess_start_minute`, `col_first_recess_start_amorpm`, `col_first_recess_end_hour`, `col_first_recess_end_minute`, `col_first_recess_end_amorpm`, `col_second_recess_start_hour`, `col_second_recess_start_minute`, `col_second_recess_start_amorpm`, `col_second_recess_end_hour`, `col_second_recess_end_minute`, `col_second_recess_end_amorpm`, `col_daily_lecture_count`, `col_holiday`, `col_closed_day`, `col_halfday`, `col_opened_day`, `col_halfday_lecture_count`) VALUES
(1, 9, 30, 'Am', 16, 0, 'Pm', 1, 12, 30, 'Pm', 13, 0, 'Pm', 1, 0, 'Pm', 1, 0, 'Pm', '6', '1', '0', '1', '2', '4');

-- --------------------------------------------------------

--
-- Table structure for table `institute_time_detail`
--

CREATE TABLE `institute_time_detail` (
  `srno` int(11) NOT NULL,
  `col_institute_start_hour` int(11) DEFAULT NULL,
  `col_institute_start_minute` int(11) DEFAULT NULL,
  `col_institute_start_amorpm` text,
  `col_institute_end_hour` int(11) DEFAULT NULL,
  `col_institute_end_minute` int(11) DEFAULT NULL,
  `col_institute_end_amorpm` text,
  `col_recess_count` int(11) DEFAULT NULL,
  `col_first_recess_start_hour` int(11) DEFAULT NULL,
  `col_first_recess_start_minute` int(11) DEFAULT NULL,
  `col_first_recess_start_amorpm` text,
  `col_first_recess_end_hour` int(11) DEFAULT NULL,
  `col_first_recess_end_minute` int(11) DEFAULT NULL,
  `col_first_recess_end_amorpm` text,
  `col_second_recess_start_hour` int(11) DEFAULT NULL,
  `col_second_recess_start_minute` int(11) DEFAULT NULL,
  `col_second_recess_start_amorpm` text,
  `col_second_recess_end_hour` int(11) DEFAULT NULL,
  `col_second_recess_end_minute` int(11) DEFAULT NULL,
  `col_second_recess_end_amorpm` text,
  `col_daily_lecture_count` text,
  `col_holiday` text,
  `col_closed_day` text,
  `col_halfday` text,
  `col_opened_day` text,
  `col_halfday_lecture_count` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute_time_detail`
--

INSERT INTO `institute_time_detail` (`srno`, `col_institute_start_hour`, `col_institute_start_minute`, `col_institute_start_amorpm`, `col_institute_end_hour`, `col_institute_end_minute`, `col_institute_end_amorpm`, `col_recess_count`, `col_first_recess_start_hour`, `col_first_recess_start_minute`, `col_first_recess_start_amorpm`, `col_first_recess_end_hour`, `col_first_recess_end_minute`, `col_first_recess_end_amorpm`, `col_second_recess_start_hour`, `col_second_recess_start_minute`, `col_second_recess_start_amorpm`, `col_second_recess_end_hour`, `col_second_recess_end_minute`, `col_second_recess_end_amorpm`, `col_daily_lecture_count`, `col_holiday`, `col_closed_day`, `col_halfday`, `col_opened_day`, `col_halfday_lecture_count`) VALUES
(1, 9, 30, 'Am', 16, 0, 'Pm', 1, 12, 0, 'Pm', 13, 0, 'Pm', 1, 0, 'Pm', 1, 0, 'Pm', '6', '1', '2', '1', '4', '3');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_information`
--

CREATE TABLE `lecture_information` (
  `srno` int(11) NOT NULL,
  `col_lecture_full_name` text,
  `col_lecture_short_name` text,
  `col_lecture_type` text,
  `col_lecture_place` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture_information`
--

INSERT INTO `lecture_information` (`srno`, `col_lecture_full_name`, `col_lecture_short_name`, `col_lecture_type`, `col_lecture_place`) VALUES
(1, 'ProgrammingÂ usingÂ C', 'PIC', '0', '0'),
(2, 'ProgrammingÂ usingÂ C', 'PIC', '1', '1'),
(3, 'OOPÂ withÂ C++', 'OOP', '0', '0'),
(4, 'OOPÂ withÂ C++', 'OOP', '1', '1'),
(5, 'DatabaseÂ ManagementÂ System', 'DBMS', '0', '0'),
(6, 'Yoga', 'YOGA', '2', '3'),
(7, 'P.T', 'P.T', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_place_detail`
--

CREATE TABLE `lecture_place_detail` (
  `srno` int(11) NOT NULL,
  `col_lecture_place_name` text,
  `col_lecture_place` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture_place_detail`
--

INSERT INTO `lecture_place_detail` (`srno`, `col_lecture_place_name`, `col_lecture_place`) VALUES
(1, 'Lab-10', '1'),
(2, 'G1', '3'),
(3, 'A1', '2'),
(4, 'Lab-3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_detail`
--

CREATE TABLE `teacher_detail` (
  `srno` int(11) NOT NULL,
  `col_teacher_first_name` text,
  `col_teacher_middle_name` text,
  `col_teacher_last_name` text,
  `col_teacher_short_name` text,
  `col_teacher_id` text,
  `col_teacher_default_password` text,
  `col_teacher_password` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_detail`
--

INSERT INTO `teacher_detail` (`srno`, `col_teacher_first_name`, `col_teacher_middle_name`, `col_teacher_last_name`, `col_teacher_short_name`, `col_teacher_id`, `col_teacher_default_password`, `col_teacher_password`) VALUES
(1, 'Het', 'Gopal', 'Sheth', 'HET', 'svpvv_school_het@aotg.com', 'mE25#KN89', NULL),
(2, 'Chitra', 'Gopal', 'Sheth', 'CGS', 'svpvv_school_cgs@aotg.com', 'np34#yz79', NULL),
(3, 'Nishi', 'Gopal', 'Sheth', 'NGS', 'svpvv_school_ngs@aotg.com', 'cD37^IY89', NULL),
(4, 'Pranami', 'Gopal', 'Sheth', 'PGS', 'svpvv_school_pgs@aotg.com', 'KN34!PV59', NULL),
(5, 'Gopal', 'Navnichandra', 'Sheth', 'GNS', 'svpvv_school_gns@aotg.com', 'vw14~xJ57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitra_sheth_time_detail`
--
ALTER TABLE `chitra_sheth_time_detail`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `co1_time_detail`
--
ALTER TABLE `co1_time_detail`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `het_sheth_time_detail`
--
ALTER TABLE `het_sheth_time_detail`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `institute_time_detail`
--
ALTER TABLE `institute_time_detail`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `lecture_information`
--
ALTER TABLE `lecture_information`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `lecture_place_detail`
--
ALTER TABLE `lecture_place_detail`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `teacher_detail`
--
ALTER TABLE `teacher_detail`
  ADD PRIMARY KEY (`srno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecture_information`
--
ALTER TABLE `lecture_information`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lecture_place_detail`
--
ALTER TABLE `lecture_place_detail`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_detail`
--
ALTER TABLE `teacher_detail`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
