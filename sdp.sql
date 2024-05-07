-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 11:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdp`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `otp` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `type`, `pass`, `otp`) VALUES
(0, 'a', 2, 'a', NULL),
(1, '2003parv@gmail.com', 2, 'aa', 6065),
(2, '1256sur@gmail.com', 2, 'sur', NULL),
(3, 'shahkhushi3107@gmail.com', 2, 'abc', NULL),
(4, 'e', 2, 'e', NULL),
(5, 'b', 2, 'b', NULL),
(6, 'c', 2, 'c', NULL),
(7, 'd', 2, 'd', NULL),
(9, 'teacher', 3, 'teacher', NULL),
(10, 'admin', 1, 'admin', NULL),
(11, 'teacher2', 3, 'teacher2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `sid` int(10) NOT NULL,
  `branch` varchar(3) NOT NULL,
  `enrollmentyear` int(5) NOT NULL,
  `sem` int(2) NOT NULL,
  `subject` varchar(10) NOT NULL,
  `sess1` int(3) NOT NULL DEFAULT 0,
  `att1` int(3) DEFAULT NULL,
  `sess2` int(3) DEFAULT NULL,
  `att2` int(3) DEFAULT NULL,
  `sess3` int(3) DEFAULT NULL,
  `att3` int(3) DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `viva` int(11) DEFAULT NULL,
  `practical` int(11) DEFAULT NULL,
  `termwork` int(11) DEFAULT NULL,
  `external` int(11) DEFAULT NULL,
  `sub_grade` varchar(3) NOT NULL,
  `sub_point` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`sid`, `branch`, `enrollmentyear`, `sem`, `subject`, `sess1`, `att1`, `sess2`, `att2`, `sess3`, `att3`, `block`, `viva`, `practical`, `termwork`, `external`, `sub_grade`, `sub_point`) VALUES
(4, 'CS', 2021, 1, 's1', 15, 10, 6, 3, 7, 0, 0, 20, 10, 9, 19, 'CC', 6),
(4, 'CS', 2021, 1, 's2', 15, 8, 3, 0, 12, 0, 0, 0, 0, 0, 35, 'CC', 6),
(5, 'CS', 2021, 1, 's1', 30, 14, 22, 2, 34, 0, 0, 20, 11, 10, 55, 'AB', 9),
(5, 'CS', 2021, 1, 's2', 35, 9, 35, 14, 30, 15, 0, 0, 0, 0, 50, 'AA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `sem`
--

CREATE TABLE `sem` (
  `sem` int(10) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `sess1` int(10) DEFAULT NULL,
  `sess2` int(10) DEFAULT NULL,
  `sess3` int(10) DEFAULT NULL,
  `viva` int(10) DEFAULT NULL,
  `external` int(10) DEFAULT NULL,
  `att1` int(3) DEFAULT NULL,
  `att2` int(3) DEFAULT NULL,
  `att3` int(3) DEFAULT NULL,
  `total_att_1` int(3) DEFAULT NULL,
  `total_att_2` int(3) DEFAULT NULL,
  `total_att_3` int(3) DEFAULT NULL,
  `block` int(3) DEFAULT NULL,
  `practical` int(10) DEFAULT NULL,
  `termwork` int(11) DEFAULT NULL,
  `sub_point` int(5) DEFAULT NULL,
  `sub_credit` float DEFAULT NULL,
  `sub_gread` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sem`
--

INSERT INTO `sem` (`sem`, `branch`, `subject`, `sess1`, `sess2`, `sess3`, `viva`, `external`, `att1`, `att2`, `att3`, `total_att_1`, `total_att_2`, `total_att_3`, `block`, `practical`, `termwork`, `sub_point`, `sub_credit`, `sub_gread`) VALUES
(1, 'CS', 'new', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(1, 'CS', 's1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8.8, NULL),
(1, 'CS', 's2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2.5, NULL),
(1, 'IT', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(1, 'IT', 's11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL),
(1, 'IT', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(2, 'CS', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(2, 'CS', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(2, 'IT', 'demo', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(2, 'IT', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(3, 'CS', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(3, 'CS', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(3, 'IT', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(3, 'IT', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(4, 'CS', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(4, 'CS', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(4, 'IT', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(4, 'IT', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(5, 'CS', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(5, 'CS', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(5, 'IT', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(5, 'IT', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(6, 'CS', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(6, 'CS', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(6, 'IT', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(6, 'IT', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(7, 'CS', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(7, 'CS', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(7, 'IT', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(7, 'IT', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(8, 'CS', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(8, 'CS', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(8, 'IT', 's1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(8, 'IT', 's2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentbasicinfo`
--

CREATE TABLE `studentbasicinfo` (
  `name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` varchar(10) NOT NULL,
  `birthplace` varchar(200) NOT NULL,
  `enrollmentyear` int(10) NOT NULL,
  `branch` varchar(5) NOT NULL,
  `sid` int(50) NOT NULL,
  `acpc_rank` int(50) NOT NULL,
  `cast_category` varchar(50) NOT NULL,
  `subcast` varchar(50) NOT NULL,
  `motherTongue` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `after` varchar(10) NOT NULL DEFAULT '12th',
  `degree` varchar(10) NOT NULL DEFAULT 'B.Tech'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentbasicinfo`
--

INSERT INTO `studentbasicinfo` (`name`, `gender`, `birthdate`, `birthplace`, `enrollmentyear`, `branch`, `sid`, `acpc_rank`, `cast_category`, `subcast`, `motherTongue`, `nationality`, `after`, `degree`) VALUES
('x', 'male', '1', '1', 2022, 'CS', 0, 3500, 'hindu', 'vaisnav', 'gujrati', 'india', '12th', 'B.Tech'),
('abc', 'male', '2003-05-12', 'baroda', 2021, 'IT', 1, 3500, 'hindu', 'vaisnav', 'gujrati', 'india', '12th', 'B.Tech'),
('sur', 'male', '2003-11-20', 'baroda', 2021, 'IT', 2, 3500, 'hindu', 'vaisnav', 'gujrati', 'india', '12th', 'Betech'),
('Shah Khushi Birenkumar', 'Female', '0000-00-00', 'Godhra', 2022, 'IT', 3, 3045, 'OPEN', 'Hindu Jain', 'Gujarati', 'Indian', '12th', 'Betech'),
('y', 'male', '1', '1', 2021, 'CS', 4, 3500, 'hindu', 'vaisnav', 'gujrati', 'india', '12th', 'B.Tech'),
('aaa', 'male', '2003-05-12', 'baroda', 2021, 'CS', 5, 3500, 'hindu', 'vaisnav', 'gujrati', 'india', '12th', 'B.Tech'),
('aaa', 'male', '2003-05-12', 'baroda', 2022, 'IT', 6, 3500, 'hindu', 'vaisnav', 'gujrati', 'india', '12th', 'B.Tech'),
('aaa', 'male', '2003-05-12', 'baroda', 2022, 'CS', 7, 3500, 'hindu', 'vaisnav', 'gujrati', 'india', '12th', 'B.Tech');

-- --------------------------------------------------------

--
-- Table structure for table `studentsem`
--

CREATE TABLE `studentsem` (
  `sid` int(10) NOT NULL,
  `semno` int(2) NOT NULL,
  `semrollno` int(5) NOT NULL,
  `spi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentsem`
--

INSERT INTO `studentsem` (`sid`, `semno`, `semrollno`, `spi`) VALUES
(4, 1, 2, 6),
(4, 2, 2, 0),
(5, 1, 1, 9.5),
(5, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacherbasicinfo`
--

CREATE TABLE `teacherbasicinfo` (
  `name` varchar(200) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `birthdate` varchar(12) NOT NULL,
  `birthplace` varchar(10) NOT NULL,
  `joiningdate` varchar(12) NOT NULL,
  `btechinfo` varchar(50) NOT NULL,
  `mtechinfo` varchar(50) NOT NULL,
  `phdinfo` varchar(50) NOT NULL,
  `contactnumber` varchar(11) NOT NULL,
  `facultyid` int(10) NOT NULL,
  `department` varchar(10) NOT NULL,
  `subjects` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacherbasicinfo`
--

INSERT INTO `teacherbasicinfo` (`name`, `gender`, `birthdate`, `birthplace`, `joiningdate`, `btechinfo`, `mtechinfo`, `phdinfo`, `contactnumber`, `facultyid`, `department`, `subjects`) VALUES
('teacher', 'male', '11/11/2011', 'nadiad', '11/11/1111', 'ddu', 'ddu', 'ddu', '9510719027', 9, 'CS', '[s1,s2]'),
('teacher2', 'male', '11/11/2011', 'nadiad', '11/11/1111', 'ddu', 'ddu', 'ddu', '0010719028', 11, 'IT', '[s1,s1]');

-- --------------------------------------------------------

--
-- Table structure for table `totalatt`
--

CREATE TABLE `totalatt` (
  `total_att1` int(5) DEFAULT NULL,
  `total_att2` int(5) DEFAULT NULL,
  `total_att3` int(5) DEFAULT NULL,
  `branch` varchar(5) NOT NULL,
  `sem` int(2) NOT NULL,
  `subject` varchar(10) NOT NULL,
  `enrollmentyear` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `totalatt`
--

INSERT INTO `totalatt` (`total_att1`, `total_att2`, `total_att3`, `branch`, `sem`, `subject`, `enrollmentyear`) VALUES
(15, 15, 15, 'CS', 1, 's1', 2021),
(15, 15, 15, 'CS', 1, 's2', 2021);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD UNIQUE KEY `unique_candidate_key` (`sid`,`branch`,`enrollmentyear`,`sem`,`subject`);

--
-- Indexes for table `sem`
--
ALTER TABLE `sem`
  ADD UNIQUE KEY `unique_sem_branch_subject` (`sem`,`branch`,`subject`);

--
-- Indexes for table `studentbasicinfo`
--
ALTER TABLE `studentbasicinfo`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `studentsem`
--
ALTER TABLE `studentsem`
  ADD PRIMARY KEY (`sid`,`semno`,`semrollno`);

--
-- Indexes for table `teacherbasicinfo`
--
ALTER TABLE `teacherbasicinfo`
  ADD PRIMARY KEY (`facultyid`);

--
-- Indexes for table `totalatt`
--
ALTER TABLE `totalatt`
  ADD UNIQUE KEY `constraint_name` (`sem`,`branch`,`subject`,`enrollmentyear`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
