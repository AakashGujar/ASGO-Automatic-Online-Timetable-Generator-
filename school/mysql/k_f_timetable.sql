-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 04:26 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `k_f_timetable`
--

CREATE TABLE `k_f_timetable` (
  `srno` int(11) NOT NULL,
  `col_timming_id` text DEFAULT NULL,
  `col_timming` text DEFAULT NULL,
  `col_day` int(11) DEFAULT NULL,
  `col_day_wise_id` int(11) DEFAULT NULL,
  `col_available` int(11) DEFAULT NULL,
  `col_teacher_name` text DEFAULT NULL,
  `col_lecture_name` text DEFAULT NULL,
  `col_lecture_type` text DEFAULT NULL,
  `col_lecture_place` text DEFAULT NULL,
  `col_batch` text DEFAULT NULL,
  `col_batch_day` int(11) DEFAULT NULL,
  `col_batch_student` text DEFAULT NULL,
  `col_class_name` text DEFAULT NULL,
  `col_row_span` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_f_timetable`
--

INSERT INTO `k_f_timetable` (`srno`, `col_timming_id`, `col_timming`, `col_day`, `col_day_wise_id`, `col_available`, `col_teacher_name`, `col_lecture_name`, `col_lecture_type`, `col_lecture_place`, `col_batch`, `col_batch_day`, `col_batch_student`, `col_class_name`, `col_row_span`) VALUES
(1, 'before_recess1', '09.00 - 09.30', 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'before_recess1', '09.30 - 10.00', 0, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'before_recess1', '10.00 - 10.30', 0, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'recess', '10.30 - 11.00', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'after_recess', '11.00 - 11.30', 0, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'after_recess', '11.30 - 12.00', 0, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'after_recess', '12.00 - 12.30', 0, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'before_recess1', '09.00 - 09.30', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'before_recess1', '09.30 - 10.00', 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'before_recess1', '10.00 - 10.30', 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'recess', '10.30 - 11.00', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'after_recess', '11.00 - 11.30', 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'after_recess', '11.30 - 12.00', 1, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'after_recess', '12.00 - 12.30', 1, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'before_recess1', '09.00 - 09.30', 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'before_recess1', '09.30 - 10.00', 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'before_recess1', '10.00 - 10.30', 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'recess', '10.30 - 11.00', 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'after_recess', '11.00 - 11.30', 2, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'after_recess', '11.30 - 12.00', 2, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'after_recess', '12.00 - 12.30', 2, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'before_recess1', '09.00 - 09.30', 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'before_recess1', '09.30 - 10.00', 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'before_recess1', '10.00 - 10.30', 3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'recess', '10.30 - 11.00', 3, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'after_recess', '11.00 - 11.30', 3, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'after_recess', '11.30 - 12.00', 3, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'after_recess', '12.00 - 12.30', 3, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'before_recess1', '09.00 - 09.30', 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'before_recess1', '09.30 - 10.00', 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'before_recess1', '10.00 - 10.30', 4, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'recess', '10.30 - 11.00', 4, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'after_recess', '11.00 - 11.30', 4, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'after_recess', '11.30 - 12.00', 4, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'after_recess', '12.00 - 12.30', 4, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `k_f_timetable`
--
ALTER TABLE `k_f_timetable`
  ADD PRIMARY KEY (`srno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `k_f_timetable`
--
ALTER TABLE `k_f_timetable`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
