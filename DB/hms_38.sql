-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2021 at 07:20 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms_38`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_registration`
--

CREATE TABLE `admin_registration` (
  `admin_id` int(11) NOT NULL,
  `admin_user_level` int(11) DEFAULT 4,
  `subject_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contactNo` bigint(20) NOT NULL,
  `address` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(45) NOT NULL,
  `passUdateDate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_registration`
--

INSERT INTO `admin_registration` (`admin_id`, `admin_user_level`, `subject_id`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `address`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`) VALUES
(1, 1, 1, 'super', 'admin', '', 'M', 1676122302, 'DHAKA', 'admin', '123', '2021-09-17 09:39:57', '', ''),
(2, 2, 4, 'hari', 'Sachi', 'saha', 'M', 1676122302, 'DHAKA', 'q@gmail.com', '123', '2021-09-17 10:31:37', '', ''),
(3, 3, 2, 'Krishna', 'Sachi', 'saha', 'F', 1676122302, 'DHAKA', 'krish@gmail.com', '123', '2021-09-17 10:34:07', '', ''),
(4, 4, 1, 'Ajay', 'Kumar', 'Dash', 'F', 1557788, 'DHAKA', 'ajay@gmail.com', '123', '2021-09-18 03:36:49', '', ''),
(5, 4, 2, 'Mihir', 'Kumar', 'Saha', 'M', 18779966, 'Khulna Bangladesh', 'mihir@gmail.com', '123', '2021-09-18 03:38:17', '', ''),
(7, 4, 2, 'S', 'A', 'B', 'M', 1676122302, 'Rajshahi', 'sab@gmail.com', '123', '2021-09-21 02:32:26', '', ''),
(8, 4, 2, 'R', 'E', 'NTU', 'M', 1676122303, 'DHAKA, Bangladesh', 'rentu@gmail.com', '123', '2021-09-21 02:43:39', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_level`
--

CREATE TABLE `admin_user_level` (
  `user_level_id` int(11) NOT NULL,
  `admin_user_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user_level`
--

INSERT INTO `admin_user_level` (`user_level_id`, `admin_user_level`) VALUES
(1, 'super_admin'),
(2, 'admin'),
(3, 'provost'),
(4, 'house_tutor');

-- --------------------------------------------------------

--
-- Table structure for table `floor_information`
--

CREATE TABLE `floor_information` (
  `floor_id` int(11) NOT NULL,
  `floor_name` varchar(20) NOT NULL,
  `hall_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floor_information`
--

INSERT INTO `floor_information` (`floor_id`, `floor_name`, `hall_id`) VALUES
(1, '1st Floor', 2),
(2, '2nd Floor', 2),
(3, '1st Floor', 1),
(4, '2nd Floor', 1),
(5, '3rd Floor', 1),
(6, '1st Floor', 3),
(7, '2nd Floor', 3),
(8, '3rd Floor', 3),
(9, '4th Floor', 3);

-- --------------------------------------------------------

--
-- Table structure for table `hall_information`
--

CREATE TABLE `hall_information` (
  `hall_id` int(11) NOT NULL,
  `hall_name` varchar(100) NOT NULL,
  `university_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hall_information`
--

INSERT INTO `hall_information` (`hall_id`, `hall_name`, `university_id`) VALUES
(1, 'Jagannath Hall', 1),
(2, 'AFR Rahman Hall', 1),
(3, 'SM HALL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_information`
--

CREATE TABLE `room_information` (
  `room_id` int(11) NOT NULL,
  `room_no` varchar(11) NOT NULL,
  `hall_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_information`
--

INSERT INTO `room_information` (`room_id`, `room_no`, `hall_id`, `floor_id`) VALUES
(1, 'AFR-1001', 2, 1),
(2, 'AFR-2001', 2, 2),
(3, 'J-1001', 1, 3),
(4, 'J-2001', 1, 4),
(5, 'J-3001', 1, 5),
(6, 'SM-1001', 3, 6),
(7, 'SM-2001', 3, 7),
(8, 'AFR-1002', 2, 1),
(9, 'J-2002', 1, 4),
(10, 'J-2003', 1, 4),
(11, 'SM-3001', 3, 8),
(12, 'SM-3002', 3, 8),
(13, 'AFR-1003', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seat_information`
--

CREATE TABLE `seat_information` (
  `seat_id` int(11) NOT NULL,
  `hall_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `seat_no` varchar(20) NOT NULL,
  `seat_status` varchar(10) NOT NULL DEFAULT '1',
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seat_information`
--

INSERT INTO `seat_information` (`seat_id`, `hall_id`, `floor_id`, `room_id`, `seat_no`, `seat_status`, `student_id`) VALUES
(1, 2, 1, 1, 'A', '1', NULL),
(2, 2, 1, 1, 'B', '1', NULL),
(3, 1, 3, 3, 'A', '2', 2),
(4, 1, 4, 4, 'A', '1', NULL),
(5, 2, 2, 2, 'A', '1', NULL),
(7, 1, 3, 3, 'B', '1', NULL),
(8, 1, 3, 3, 'c', '1', NULL),
(9, 1, 3, 3, 'D', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seat_status_information`
--

CREATE TABLE `seat_status_information` (
  `status_id` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seat_status_information`
--

INSERT INTO `seat_status_information` (`status_id`, `status`) VALUES
(1, 'Available'),
(2, 'Pending'),
(3, 'Not Available');

-- --------------------------------------------------------

--
-- Table structure for table `subject_information`
--

CREATE TABLE `subject_information` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `subject_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_information`
--

INSERT INTO `subject_information` (`subject_id`, `subject_name`, `subject_code`) VALUES
(1, 'Bangla', 'B-101'),
(2, 'Mathmatics', 'M-101'),
(3, 'Physics', 'P-101'),
(4, 'Chemistry', 'C-101');

-- --------------------------------------------------------

--
-- Table structure for table `university_information`
--

CREATE TABLE `university_information` (
  `id` int(11) NOT NULL,
  `university_name` text NOT NULL,
  `establishment_year` int(11) NOT NULL,
  `address` text NOT NULL,
  `world_ranking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `university_information`
--

INSERT INTO `university_information` (`id`, `university_name`, `establishment_year`, `address`, `world_ranking`) VALUES
(1, 'Dhaka University', 1921, 'DHAKA, Bangladesh', 1),
(2, 'Rajshahi University', 1953, 'Rajshahi, University', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL,
  `regNo` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contactNo` bigint(20) NOT NULL,
  `address` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(45) NOT NULL,
  `passUdateDate` varchar(45) NOT NULL,
  `seat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `regNo`, `subject_id`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `address`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`, `seat_id`) VALUES
(2, '2       ', 4, 'Ganga       ', '       ', 'Saha       ', 'M', 123456789, 'West Bengal     ', 'ganga@gmail.com', '1234', '2021-08-30 16:40:14', '2021-08-30 18:41:14', '11-09-2021 07:49:33', 0),
(3, '2       ', 4, 'Gita       ', '       ', 'Saha       ', 'female      ', 16789123, 'DHAKA, Bangladesh     ', 'gita@gmail.com       ', '123    ', '2021-09-05 15:31:07', '', '', 0),
(4, ' 123       ', 4, 'Krishna       ', 'Sachi       ', 'saha       ', 'male      ', 1676122302, 'DHAKA     ', 'abc@gmail.com       ', '123    ', '2021-09-13 15:52:00', '', '', NULL),
(5, ' 123       ', 1, 'hari       ', 'Sachi       ', 'saha       ', 'male      ', 1676122302, 'DHAKA     ', 'root@gmail.com       ', '123    ', '2021-09-13 15:54:53', '', '', NULL),
(6, ' 789       ', 4, 'Krishna       ', 'Sachi       ', 'saha       ', 'male      ', 1676122302, 'DHAKA     ', 'abcd@gmail.com       ', '123    ', '2021-09-13 15:59:53', '', '', NULL),
(7, ' 987       ', 1, 'hari       ', 'Sachi       ', 'saha       ', 'male      ', 1676122302, 'DHAKA     ', 'abc@gmail.com       ', '123    ', '2021-09-13 16:01:20', '', '', NULL),
(8, ' 123       ', 1, 'hari       ', 'Sachi       ', 'saha       ', 'male      ', 1676122302, 'DHAKA     ', 'abc@gmail.com       ', '123    ', '2021-09-13 16:03:16', '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_registration`
--
ALTER TABLE `admin_registration`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `fk_user_level` (`admin_user_level`);

--
-- Indexes for table `admin_user_level`
--
ALTER TABLE `admin_user_level`
  ADD PRIMARY KEY (`user_level_id`);

--
-- Indexes for table `floor_information`
--
ALTER TABLE `floor_information`
  ADD PRIMARY KEY (`floor_id`),
  ADD KEY `hall_id` (`hall_id`),
  ADD KEY `floor_id` (`floor_id`);

--
-- Indexes for table `hall_information`
--
ALTER TABLE `hall_information`
  ADD PRIMARY KEY (`hall_id`),
  ADD KEY `university_id` (`university_id`);

--
-- Indexes for table `room_information`
--
ALTER TABLE `room_information`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `hall_id` (`hall_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `floor_id` (`floor_id`);

--
-- Indexes for table `seat_information`
--
ALTER TABLE `seat_information`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `floor_id` (`floor_id`);

--
-- Indexes for table `seat_status_information`
--
ALTER TABLE `seat_status_information`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `subject_information`
--
ALTER TABLE `subject_information`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `university_information`
--
ALTER TABLE `university_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_registration`
--
ALTER TABLE `admin_registration`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin_user_level`
--
ALTER TABLE `admin_user_level`
  MODIFY `user_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `floor_information`
--
ALTER TABLE `floor_information`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hall_information`
--
ALTER TABLE `hall_information`
  MODIFY `hall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_information`
--
ALTER TABLE `room_information`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `seat_information`
--
ALTER TABLE `seat_information`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `seat_status_information`
--
ALTER TABLE `seat_status_information`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_information`
--
ALTER TABLE `subject_information`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `university_information`
--
ALTER TABLE `university_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_registration`
--
ALTER TABLE `admin_registration`
  ADD CONSTRAINT `fk_user_level` FOREIGN KEY (`admin_user_level`) REFERENCES `admin_user_level` (`user_level_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `floor_information`
--
ALTER TABLE `floor_information`
  ADD CONSTRAINT `fk` FOREIGN KEY (`hall_id`) REFERENCES `hall_information` (`hall_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `hall_information`
--
ALTER TABLE `hall_information`
  ADD CONSTRAINT `hall_information_ibfk_1` FOREIGN KEY (`university_id`) REFERENCES `university_information` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `room_information`
--
ALTER TABLE `room_information`
  ADD CONSTRAINT `room_information_ibfk_1` FOREIGN KEY (`floor_id`) REFERENCES `floor_information` (`floor_id`),
  ADD CONSTRAINT `room_information_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `hall_information` (`hall_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `seat_information`
--
ALTER TABLE `seat_information`
  ADD CONSTRAINT `floor_information_fk` FOREIGN KEY (`floor_id`) REFERENCES `floor_information` (`floor_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `seat_information_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room_information` (`room_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD CONSTRAINT `userregistration_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
