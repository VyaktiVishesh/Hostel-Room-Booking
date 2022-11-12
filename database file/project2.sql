-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2022 at 11:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin', 'admin@mail.com', 'D00F5D5217896FB7FD601412CB890830', '2022-10-29 08:39:45', '2022-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `comp_type` text NOT NULL,
  `comp` text NOT NULL,
  `issuer` int(10) NOT NULL,
  `comp_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_sn` varchar(255) NOT NULL,
  `course_fn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_sn`, `course_fn`) VALUES
(10, 'BTECH-I', 'Bachelors of Technology (1st year)'),
(11, 'BTECH-II', 'Bachelors of Technology (2nd year)'),
(12, 'BTECH-III', 'Bachelors of Technology (3rd year)'),
(13, 'BTECH-IIII', 'Bachelors of Technology (4th year)'),
(14, 'MTECH-I', 'Masters of Technology (1st year)'),
(15, 'MTECH-II', 'Masters of Technology (2nd year)'),
(16, 'PHD', 'Doctor of Philosophy');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_id` int(10) NOT NULL DEFAULT 0,
  `roll` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_id`, `roll`) VALUES
(29, 46, 210001071),
(30, 46, 210001070),
(31, 46, 210001069),
(32, 46, 210001034),
(33, 1, 210001071),
(34, 46, 210001068),
(35, 53, 210001081),
(36, 53, 210001079),
(37, 54, 210001080),
(38, 55, 210001075),
(39, 56, 210001048),
(40, 56, 210001032),
(44, 60, 210001080),
(45, 60, 210001098),
(46, 60, 210001069),
(47, 63, 210001043),
(48, 65, 212312322);

-- --------------------------------------------------------

--
-- Table structure for table `group_invite`
--

CREATE TABLE `group_invite` (
  `id` int(11) NOT NULL,
  `user_from` int(10) NOT NULL,
  `user_to` int(10) NOT NULL,
  `time_req` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_invite`
--

INSERT INTO `group_invite` (`id`, `user_from`, `user_to`, `time_req`) VALUES
(1, 46, 38, '2022-11-08 01:50:51'),
(4, 48, 38, '2022-11-08 02:32:53'),
(5, 48, 38, '2022-11-08 02:40:15'),
(6, 48, 38, '2022-11-08 02:40:47'),
(10, 52, 52, '2022-11-09 16:18:28'),
(11, 54, 38, '2022-11-09 16:39:01'),
(16, 59, 58, '2022-11-10 01:09:57'),
(17, 59, 58, '2022-11-10 01:09:59'),
(18, 59, 58, '2022-11-10 01:10:02'),
(19, 59, 58, '2022-11-10 01:10:04'),
(20, 59, 58, '2022-11-10 01:10:06'),
(21, 59, 58, '2022-11-10 01:10:07'),
(22, 59, 58, '2022-11-10 01:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `unit_no` int(11) NOT NULL,
  `room` varchar(1) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `unit_no`, `room`, `status`) VALUES
(18, 101, 'A', 0),
(19, 101, 'B', 0),
(20, 101, 'C', 0),
(21, 101, 'D', 0),
(22, 101, 'E', 0),
(23, 102, 'A', 210001012),
(24, 102, 'B', 2147483647),
(25, 102, 'C', 0),
(26, 102, 'D', 0),
(27, 102, 'E', 2123123),
(28, 103, 'A', 210001079),
(29, 103, 'B', 210001081),
(30, 103, 'C', 0),
(31, 103, 'D', 0),
(32, 103, 'E', 0),
(33, 104, 'A', 210001079),
(34, 104, 'B', 210001076),
(35, 104, 'C', 210001075),
(36, 104, 'D', 212312322),
(37, 104, 'E', 212312333),
(38, 105, 'A', 210001071),
(39, 105, 'B', 210001070),
(40, 105, 'C', 210001069),
(41, 105, 'D', 210001034),
(42, 105, 'E', 210001068),
(43, 106, 'A', 0),
(44, 106, 'B', 0),
(45, 106, 'C', 0),
(46, 106, 'D', 0),
(47, 106, 'E', 0),
(48, 107, 'A', 210001043),
(49, 107, 'B', 210001080),
(50, 107, 'C', 210001098),
(51, 107, 'D', 210001069),
(52, 107, 'E', 0),
(53, 108, 'A', 0),
(54, 108, 'B', 0),
(55, 108, 'C', 0),
(56, 108, 'D', 0),
(57, 108, 'E', 0),
(58, 109, 'A', 0),
(59, 109, 'B', 0),
(60, 109, 'C', 0),
(61, 109, 'D', 0),
(62, 109, 'E', 0),
(63, 110, 'A', 210001072),
(64, 110, 'B', 0),
(65, 110, 'C', 0),
(66, 110, 'D', 0),
(67, 110, 'E', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `userIp`, `city`, `country`, `loginTime`) VALUES
(29, 33, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-03 16:21:05'),
(30, 33, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-03 16:28:21'),
(31, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-03 18:42:34'),
(32, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-03 19:21:02'),
(33, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-03 20:30:04'),
(34, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-04 06:25:35'),
(35, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-04 07:20:31'),
(36, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-04 08:46:19'),
(37, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-04 08:48:32'),
(38, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-05 12:45:36'),
(39, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-05 12:50:33'),
(40, 34, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-05 12:53:58'),
(41, 38, 'cse210001077@iiti.ac.in', 0x3a3a31, '', '', '2022-11-06 07:04:57'),
(42, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-06 11:55:57'),
(43, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-06 12:28:40'),
(44, 40, 'lksahf@gmail.com', 0x3a3a31, '', '', '2022-11-06 13:12:59'),
(45, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-06 13:13:43'),
(46, 40, 'lksahf@gmail.com', 0x3a3a31, '', '', '2022-11-06 13:16:19'),
(47, 42, '1@gmail.com', 0x3a3a31, '', '', '2022-11-06 13:55:24'),
(48, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-06 17:29:42'),
(49, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-06 17:45:04'),
(50, 40, 'lksahf@gmail.com', 0x3a3a31, '', '', '2022-11-06 18:42:09'),
(51, 42, '1@gmail.com', 0x3a3a31, '', '', '2022-11-07 03:52:23'),
(52, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-07 03:52:43'),
(53, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-07 03:55:17'),
(54, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-07 03:56:24'),
(55, 43, '2@gmail.com', 0x3a3a31, '', '', '2022-11-07 03:57:47'),
(56, 43, '2@gmail.com', 0x3a3a31, '', '', '2022-11-07 04:04:55'),
(57, 43, '2@gmail.com', 0x3a3a31, '', '', '2022-11-07 04:15:18'),
(58, 43, '2@gmail.com', 0x3a3a31, '', '', '2022-11-07 04:16:33'),
(59, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-07 05:45:04'),
(60, 39, 'palakprintersbnl@gmail.com', 0x3a3a31, '', '', '2022-11-07 07:26:02'),
(61, 43, '2@gmail.com', 0x3a3a31, '', '', '2022-11-07 07:26:22'),
(62, 42, '1@gmail.com', 0x3a3a31, '', '', '2022-11-07 07:38:37'),
(63, 43, '2@gmail.com', 0x3a3a31, '', '', '2022-11-07 07:40:58'),
(64, 43, '2@gmail.com', 0x3a3a31, '', '', '2022-11-07 08:38:22'),
(65, 43, '2@gmail.com', 0x3a3a31, '', '', '2022-11-07 09:47:56'),
(66, 43, '2@gmail.com', 0x3a3a31, '', '', '2022-11-07 18:12:47'),
(67, 45, '3@gmail.com', 0x3a3a31, '', '', '2022-11-07 18:15:39'),
(68, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-07 18:19:58'),
(69, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-07 18:20:00'),
(70, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-07 18:20:20'),
(71, 45, '3@gmail.com', 0x3a3a31, '', '', '2022-11-07 18:28:40'),
(72, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-07 19:00:00'),
(73, 45, '3@gmail.com', 0x3a3a31, '', '', '2022-11-07 19:01:57'),
(74, 45, '3@gmail.com', 0x3a3a31, '', '', '2022-11-07 19:31:48'),
(75, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-07 19:32:25'),
(76, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-07 20:36:24'),
(77, 47, '4@gmail.com', 0x3a3a31, '', '', '2022-11-07 20:37:04'),
(78, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-07 20:57:53'),
(79, 48, '5@gmail.com', 0x3a3a31, '', '', '2022-11-07 21:00:49'),
(80, 49, '6l@gmail.com', 0x3a3a31, '', '', '2022-11-07 21:11:16'),
(81, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-08 05:16:28'),
(82, 47, '4@gmail.com', 0x3a3a31, '', '', '2022-11-08 12:22:14'),
(83, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-08 12:22:44'),
(84, 50, '8@gmail.com', 0x3a3a31, '', '', '2022-11-08 12:23:46'),
(85, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-08 12:24:36'),
(86, 50, '8@gmail.com', 0x3a3a31, '', '', '2022-11-08 12:27:36'),
(87, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-08 18:11:46'),
(88, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-08 18:49:23'),
(89, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-09 05:42:58'),
(90, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-09 05:59:05'),
(91, 51, '9@gmail.com', 0x3a3a31, '', '', '2022-11-09 06:19:10'),
(92, 51, '9@gmail.com', 0x3a3a31, '', '', '2022-11-09 06:25:34'),
(93, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-09 10:35:12'),
(94, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-09 10:35:22'),
(95, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-09 10:37:50'),
(96, 52, '11@gmail.com', 0x3a3a31, '', '', '2022-11-09 10:39:29'),
(97, 53, '12@gmail.com', 0x3a3a31, '', '', '2022-11-09 10:40:59'),
(98, 52, '11@gmail.com', 0x3a3a31, '', '', '2022-11-09 10:41:47'),
(99, 54, '13@gmail.com', 0x3a3a31, '', '', '2022-11-09 11:08:39'),
(100, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-09 13:26:01'),
(101, 55, 'Golu@gmail.com', 0x3a3a31, '', '', '2022-11-09 13:42:05'),
(102, 55, 'Golu@gmail.com', 0x3a3a31, '', '', '2022-11-09 14:30:05'),
(103, 55, 'Golu@gmail.com', 0x3a3a31, '', '', '2022-11-09 14:48:38'),
(104, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-09 17:32:33'),
(105, 56, '99@gmail.com', 0x3a3a31, '', '', '2022-11-09 17:33:45'),
(106, 56, '99@gmail.com', 0x3a3a31, '', '', '2022-11-09 18:28:44'),
(107, 57, '89@gmail.com', 0x3a3a31, '', '', '2022-11-09 18:29:12'),
(108, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-09 19:36:52'),
(109, 57, '89@gmail.com', 0x3a3a31, '', '', '2022-11-09 19:38:07'),
(110, 59, '45@gmail.com', 0x3a3a31, '', '', '2022-11-09 19:39:31'),
(111, 58, 'v@gmail.com', 0x3a3a31, '', '', '2022-11-09 19:40:20'),
(112, 59, '45@gmail.com', 0x3a3a31, '', '', '2022-11-09 19:48:21'),
(113, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-09 19:55:49'),
(114, 60, '21@gmail.com', 0x3a3a31, '', '', '2022-11-09 19:59:41'),
(115, 61, '22@gmail.com', 0x3a3a31, '', '', '2022-11-09 20:00:28'),
(116, 62, '23@gmail.com', 0x3a3a31, '', '', '2022-11-09 20:01:16'),
(117, 63, '24@gmail.com', 0x3a3a31, '', '', '2022-11-09 20:01:52'),
(118, 60, '21@gmail.com', 0x3a3a31, '', '', '2022-11-09 20:03:01'),
(119, 60, '21@gmail.com', 0x3a3a31, '', '', '2022-11-09 20:13:39'),
(120, 60, '21@gmail.com', 0x3a3a31, '', '', '2022-11-09 20:46:56'),
(121, 65, '88@gmail.com', 0x3a3a31, '', '', '2022-11-09 20:47:49'),
(122, 66, '880@gmail.com', 0x3a3a31, '', '', '2022-11-09 20:53:48'),
(123, 66, '880@gmail.com', 0x3a3a31, '', '', '2022-11-09 21:01:19'),
(124, 46, '18@gmail.com', 0x3a3a31, '', '', '2022-11-10 03:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL,
  `regNo` int(10) NOT NULL DEFAULT 0,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `course` varchar(50) NOT NULL,
  `unit_no` int(10) NOT NULL DEFAULT 0,
  `room_no` varchar(1) NOT NULL DEFAULT 'o',
  `group_id` int(10) NOT NULL DEFAULT 0,
  `gender` varchar(255) NOT NULL,
  `contactNo` bigint(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(45) NOT NULL,
  `passUdateDate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `regNo`, `firstName`, `lastName`, `course`, `unit_no`, `room_no`, `group_id`, `gender`, `contactNo`, `city`, `state`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`) VALUES
(38, 210001077, 'Vishesh', 'Garg', 'Computer Sc', 0, 'o', 0, 'Male', 9983782378, 'Barnala', 'Punjab', 'cse210001077@iiti.ac.in', '81dc9bdb52d04dc20036dbd8313ed055', '2022-11-06 07:04:29', '', '06-11-2022 01:17:24'),
(39, 210001079, 'rege', 'ser', 'Computer Sc', 104, 'A', 0, 'Male', 9983782378, 'Barnala', 'Punjab', 'palakprintersbnl@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-06 11:55:45', '', ''),
(40, 210001076, 'mother teacher', 'se', 'Computer Sc', 104, 'B', 0, 'Male', 9983782378, 'Barnala', 'Punjab', 'lksahf@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-06 13:12:49', '', ''),
(42, 2123123, 'ede', 'ere', 'Computer Sc', 102, 'E', 0, 'Others', 9983782378, 'Barnala', 'Punjab', '1@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-06 13:54:50', '', ''),
(43, 2147483647, 'rtrt', 'rtrt', 'Computer Sc', 102, 'B', 0, 'Male', 9983782378, 'Barnala', 'Punjab', '2@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-07 03:57:23', '', ''),
(45, 210001072, 'rishabh', 'pant', 'Computer Sc', 110, 'A', 0, 'Male', 9983782378, 'Barnala', 'Punjab', '3@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-07 18:15:22', '', ''),
(46, 210001071, 'virat', 'Barnala', 'Computer Sc', 105, 'A', 46, 'Male', 9983782378, 'Punjab', 'kohli', '18@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-07 18:18:39', '09-11-2022 07:40:14', ''),
(47, 210001070, 'Rohit ', 'Sharma', 'Computer Sc', 105, 'B', 46, 'Male', 9983782378, 'Barnala', 'Punjab', '4@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-07 20:22:38', '', ''),
(48, 210001069, 'Yuzi', 'Chahal', 'Computer Sc', 105, 'C', 46, 'Male', 9983782378, 'Barnala', 'Punjab', '5@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-07 21:00:22', '', ''),
(49, 210001034, 'wer', 'wer', 'Computer Sc', 105, 'D', 46, 'Male', 9983782378, 'Barnala', 'Punjab', '6l@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-07 21:10:42', '', ''),
(50, 210001068, 'Ravindra', 'Jadeja', 'Computer Sc', 105, 'E', 46, 'Male', 9983782378, 'Barnala', 'Punjab', '8@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-08 12:23:25', '', ''),
(51, 210001012, 'werwer', 'werwer', 'Computer Sc', 102, 'A', 0, 'Male', 9983782378, 'Barnala', 'Punjab', '9@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 06:18:55', '', ''),
(52, 210001079, 'Vivek', 'Malhotra', 'Computer Sc', 103, 'A', 53, 'Male', 9983782378, 'Barnala', 'Punjab', '11@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 10:39:12', '', ''),
(53, 210001081, 'vishesh', 'xee', 'Computer Sc', 103, 'B', 53, 'Male', 9983782378, 'Barnala', 'Punjab', '12@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 10:40:38', '', ''),
(54, 210001080, 'sushil', 'yadav', 'Computer Sc', 0, 'o', 54, 'Male', 9983782378, 'Barnala', 'Punjab', '13@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 11:08:23', '', ''),
(55, 210001075, 'Goleshwar', 'Kumar', 'Computer Sc', 104, 'C', 55, 'Male', 9983782378, 'Barnala', 'Punjab', 'Golu@gmail.com', '92a703b77bf382c196cf3fd802c47226', '2022-11-09 13:41:48', '', '09-11-2022 09:47:47'),
(56, 210001048, 'Sachin', 'Tendulkar', 'Computer Sc', 0, 'o', 56, 'Male', 9983782378, 'Barnala', 'Punjab', '99@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 17:30:11', '', ''),
(57, 210001032, 'ede', 'xee', 'Computer Sc', 0, 'o', 56, 'Male', 9983782378, 'Barnala', 'Punjab', '89@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 18:28:31', '', ''),
(60, 210001080, 'Vishesh', 'Garg', 'Computer Science', 107, 'B', 60, 'Male', 9983782378, 'Barnala', 'Punjab', '21@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 19:57:41', '', ''),
(61, 210001098, 'Vikas', 'Maurya', 'Computer Science', 107, 'C', 60, 'Male', 9983782378, 'Barnala', 'Punjab', '22@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 19:58:12', '', ''),
(62, 210001069, 'Vishnu', 'Jaddipal', 'Computer Science', 107, 'D', 60, 'Male', 9983782378, 'Barnala', 'Punjab', '23@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 19:58:48', '', ''),
(63, 210001043, 'Mayank', 'Bharti', 'Computer Science', 107, 'A', 63, 'Male', 9983782378, 'Barnala', 'Punjab', '24@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 19:59:22', '', ''),
(64, 212312334, 'mother teacher', 'Garg', 'Computer Science', 0, 'o', 0, 'Male', 9983782378, 'Barnala', 'Punjab', '345@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 20:35:12', '', ''),
(65, 212312322, 'Vishesh Garg', 'barnala', 'Computer Science', 104, 'D', 65, 'Male', 9983782378, 'Barnala', 'Punjab', '88@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 20:47:40', '', ''),
(66, 212312333, 'Vishesh', 'xee', 'Computer Science', 104, 'E', 0, 'Male', 9983782378, 'Barnala', 'Punjab', '880@gmail.com', '6afe0fe1ff8212fef7b6e63b9ba3cefb', '2022-11-09 20:53:36', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roll` (`roll`);

--
-- Indexes for table `group_invite`
--
ALTER TABLE `group_invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`,`regNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `group_invite`
--
ALTER TABLE `group_invite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
