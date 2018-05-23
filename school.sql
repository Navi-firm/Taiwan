-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 05, 2015 at 07:45 AM
-- Server version: 5.6.24-0ubuntu2
-- PHP Version: 5.6.4-4ubuntu6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `school`
--
CREATE DATABASE IF NOT EXISTS `school` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `school`;

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE IF NOT EXISTS `class_rooms` (
`class_room_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `is_missed` int(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`class_room_id`, `schedule_id`, `teacher_id`, `student_id`, `notes`, `is_missed`, `created_by`, `time_created`) VALUES
(1, 1, 5, 2, '1st class', 0, 5, '2015-08-03 08:20:18'),
(2, 2, 5, 2, '2nd class', 0, 5, '2015-08-03 08:20:38'),
(3, 3, 5, 2, 'Business class', 0, 5, '2015-08-03 08:22:19'),
(4, 4, 3, 4, 'Chemistry class', 0, 3, '2015-08-03 08:40:54'),
(5, 5, 3, 5, 'PE', 0, 3, '2015-08-03 08:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `hours_purchase`
--

CREATE TABLE IF NOT EXISTS `hours_purchase` (
`purchase_id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `hours` varchar(255) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hours_purchase`
--

INSERT INTO `hours_purchase` (`purchase_id`, `student_id`, `hours`, `time_created`) VALUES
(1, '2', '3', '2015-08-03 08:01:10'),
(2, '4', '3', '2015-08-03 08:01:16'),
(3, '5', '3', '2015-08-03 08:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
`schedule_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `teacher_id`, `start_date`, `end_date`, `status`, `time_created`) VALUES
(1, 5, '2015-08-03 11:00:00', '2015-08-03 12:00:00', 1, '2015-08-03 08:20:18'),
(2, 5, '2015-08-03 14:00:00', '2015-08-03 15:00:00', 1, '2015-08-03 08:20:38'),
(3, 5, '2015-08-04 08:00:00', '2015-08-04 09:00:00', 1, '2015-08-03 08:22:19'),
(4, 3, '2015-08-03 14:00:00', '2015-08-03 15:00:00', 1, '2015-08-03 08:40:54'),
(5, 3, '2015-08-03 16:00:00', '2015-08-03 17:00:00', 1, '2015-08-03 08:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`student_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `skype_id` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `status` int(1) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `fname`, `lname`, `email_address`, `skype_id`, `mobile`, `start_date`, `status`, `created_by`, `time_created`) VALUES
(2, 'James', 'Musyoki', 'jmusyoki@gmail.com', 'j.musyoki', '0712649444', '2015-08-10', 1, '1', '2015-07-30 17:55:14'),
(3, 'Joe', 'Alex', 'joealex@gmail.com', '', '0723683365', '2015-08-10', 5, '1', '2015-08-01 09:28:25'),
(4, 'Nelius', 'Wairimu', 'nmunderitu@gmail.com', 'nmunderitu', '0708872571', '2015-08-10', 1, '1', '2015-08-01 09:40:20'),
(5, 'Frank', 'Lampard', 'superfrank@gmail.com', 'super.frankie', '+44 (0)1452 828 001', '2015-08-03', 1, '1', '2015-08-03 08:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `training_material`
--

CREATE TABLE IF NOT EXISTS `training_material` (
`tm_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `time_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_material`
--

INSERT INTO `training_material` (`tm_id`, `teacher_id`, `title`, `file`, `file_type`, `file_size`, `uploaded_by`, `time_uploaded`) VALUES
(6, 4, 'Skrill Documentaion', 'Skrill_PHP_Library_Guide.pdf', 'application/pdf', 733, 1, '2015-08-01 08:47:24'),
(7, 0, 'Change Request', 'change_request.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 182, 1, '2015-08-03 07:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fname`, `lname`, `email_address`, `mobile`, `password`, `activation`, `user_type`, `created_by`, `status`, `time_created`) VALUES
(1, 'admin', '', '', 'iamuteti@gmail.com', '', '4b9db269c5f978e1264480b0a7619eea', '', 100, '1', 1, '2015-07-27 16:40:25'),
(3, 'john.muteti', 'John', 'Muteti', 'johnsymple@gmail.com', '0700001600', '4a7d1ed414474e4033ac29ccb8653d9b', '', 101, '1', 1, '2015-07-30 19:36:27'),
(4, 'lilian.kyalo', 'Lilian', 'Kyalo', 'lilianmwende@gmail.com', '0715811011', '4a7d1ed414474e4033ac29ccb8653d9b', '', 101, '1', 5, '2015-08-01 09:10:34'),
(5, 'jose.mourinho', 'Jose', 'Mourinho', 'iamuteti@codekrystal.com', '0700001700', '4a7d1ed414474e4033ac29ccb8653d9b', '', 101, '1', 1, '2015-07-31 05:25:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_rooms`
--
ALTER TABLE `class_rooms`
 ADD PRIMARY KEY (`class_room_id`);

--
-- Indexes for table `hours_purchase`
--
ALTER TABLE `hours_purchase`
 ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
 ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `training_material`
--
ALTER TABLE `training_material`
 ADD PRIMARY KEY (`tm_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
MODIFY `class_room_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hours_purchase`
--
ALTER TABLE `hours_purchase`
MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `training_material`
--
ALTER TABLE `training_material`
MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
