-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 09:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `Userid` varchar(10) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Image` varchar(256) DEFAULT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`Userid`, `Password`, `Image`, `updationDate`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `ClassName` char(30) NOT NULL,
  `ClassId` int(2) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclasses`
--

INSERT INTO `tblclasses` (`ClassName`, `ClassId`, `updationDate`) VALUES
('M.Sc. Computer Science', 1, '2023-06-14 16:39:49'),
('M.Sc. Chemistry', 2, '2023-06-14 16:16:57'),
('B.Sc. Computer Science', 3, '2023-06-14 16:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `id` int(11) NOT NULL,
  `noticeTitle` varchar(255) DEFAULT NULL,
  `noticeDetails` mediumtext DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`id`, `noticeTitle`, `noticeDetails`, `updationDate`) VALUES
(5, 'Result Date Apr 2023', 'April 2023 Results will be published on 31.06.2023', '2023-06-19 05:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblresults`
--

CREATE TABLE `tblresults` (
  `StudentId` varchar(15) NOT NULL,
  `SubjectId` int(6) NOT NULL,
  `CIA` int(2) NOT NULL,
  `ESE` int(3) NOT NULL,
  `MonthYear` date NOT NULL,
  `StaffId` int(2) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblresults`
--

INSERT INTO `tblresults` (`StudentId`, `SubjectId`, `CIA`, `ESE`, `MonthYear`, `StaffId`, `updationDate`) VALUES
('2113112078015', 196601, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:54'),
('2113112078015', 196602, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:54'),
('2113112078015', 196603, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:54'),
('2113112078015', 196604, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:54'),
('2113112078015', 196621, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:54'),
('2113112078015', 195001, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:54'),
('2113112078024', 196601, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078024', 196602, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078024', 196603, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078024', 196604, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078024', 196621, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078024', 195001, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078015', 199999, 24, 5, '2022-04-01', 1, '2023-06-17 08:44:19'),
('2113112078015', 199998, 25, 37, '2022-04-01', 1, '2023-06-17 08:44:19'),
('2113112078030', 226554, 23, 42, '2022-11-01', 4, '2023-06-18 06:56:40'),
('2113112078015', 199998, 22, 44, '2022-12-01', 5, '2023-06-17 15:53:07'),
('2113112078015', 199999, 24, 7, '2022-11-01', 1, '2023-06-17 08:44:19'),
('2113112078015', 196605, 19, 50, '2022-04-01', 7, '2023-06-17 08:44:19'),
('2113112078015', 196606, 20, 40, '2022-04-01', 2, '2023-06-17 08:44:19'),
('2113112078015', 196607, 38, 60, '2022-04-01', 2, '2023-06-17 08:44:19'),
('2113112078015', 196626, 18, 51, '2022-04-01', 5, '2023-06-17 08:44:19'),
('2113112078015', 196141, 19, 61, '2022-04-01', 11, '2023-06-17 08:44:19'),
('2113112078015', 195002, 34, 60, '2022-04-01', 10, '2023-06-17 08:44:19'),
('2113112078024', 196605, 22, 66, '2022-04-01', 7, '2023-06-17 08:44:19'),
('2113112078024', 196606, 25, 52, '2022-04-01', 2, '2023-06-17 08:44:19'),
('2113112078024', 196607, 40, 60, '2022-04-01', 2, '2023-06-17 08:44:19'),
('2113112078024', 196626, 23, 64, '2022-04-01', 5, '2023-06-17 08:44:19'),
('2113112078024', 196141, 24, 58, '2022-04-01', 11, '2023-06-17 08:44:19'),
('2113112078024', 195002, 32, 57, '2022-04-01', 10, '2023-06-17 08:44:19'),
('2113112078031', 226602, 21, 51, '2021-11-01', 5, '2023-06-17 16:00:28'),
('2113112078024', 199999, 25, 47, '2022-12-01', 1, '2023-06-17 15:43:19'),
('211311207701', 196601, 23, 54, '2021-11-01', 5, '2023-06-17 08:44:19'),
('2113112078015', 196627, 24, 51, '2022-11-01', 4, '2023-06-17 08:44:19'),
('2113112078015', 196611, 20, 45, '2022-11-01', 6, '2023-06-17 08:44:19'),
('2113112078015', 196610, 20, 53, '2022-11-01', 7, '2023-06-17 08:44:19'),
('2113112078015', 196609, 40, 60, '2022-11-01', 5, '2023-06-17 08:44:19'),
('2113112078015', 196608, 19, 56, '2022-11-01', 5, '2023-06-17 08:44:19'),
('2113112078015', 196142, 21, 54, '2022-11-01', 11, '2023-06-17 08:44:19'),
('2113112078015', 195003, 28, 44, '2022-11-01', 10, '2023-06-17 08:44:19'),
('2113112078024', 196627, 24, 60, '2022-11-01', 4, '2023-06-17 08:44:19'),
('2113112078024', 196611, 23, 48, '2022-11-01', 6, '2023-06-17 08:44:19'),
('2113112078024', 196610, 21, 64, '2022-11-01', 7, '2023-06-17 08:44:19'),
('2113112078024', 196609, 40, 60, '2022-11-01', 5, '2023-06-17 08:44:19'),
('2113112078024', 196608, 22, 63, '2022-11-01', 5, '2023-06-17 08:44:19'),
('2113112078024', 196142, 19, 67, '2022-11-01', 11, '2023-06-17 08:44:19'),
('2113112078024', 195003, 30, 44, '2022-11-01', 10, '2023-06-17 08:44:19'),
('2113112078025', 196601, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078025', 196602, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078025', 196603, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078025', 196604, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078025', 196621, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078025', 195001, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078025', 196605, 22, 58, '2022-04-01', 7, '2023-06-17 08:44:19'),
('2113112078025', 196606, 25, 51, '2022-04-01', 2, '2023-06-17 08:44:19'),
('2113112078025', 196607, 40, 60, '2022-04-01', 2, '2023-06-17 08:44:19'),
('2113112078025', 196626, 23, 59, '2022-04-01', 5, '2023-06-17 08:44:19'),
('2113112078025', 196141, 24, 59, '2022-04-01', 11, '2023-06-17 08:44:19'),
('2113112078025', 195002, 32, 57, '2022-04-01', 10, '2023-06-17 08:44:19'),
('2113112078025', 196627, 24, 62, '2022-11-01', 4, '2023-06-17 08:44:19'),
('2113112078025', 196611, 22, 50, '2022-11-01', 6, '2023-06-17 08:44:19'),
('2113112078025', 196610, 21, 61, '2022-11-01', 7, '2023-06-17 08:44:19'),
('2113112078025', 196609, 40, 60, '2022-11-01', 5, '2023-06-17 08:44:19'),
('2113112078025', 196608, 22, 65, '2022-11-01', 5, '2023-06-17 08:44:19'),
('2113112078025', 196142, 19, 69, '2022-11-01', 11, '2023-06-17 08:44:19'),
('2113112078025', 195003, 30, 43, '2022-11-01', 10, '2023-06-17 08:44:19'),
('2113112078003', 196601, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078003', 196602, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078003', 196603, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078003', 196604, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078003', 196621, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078003', 195001, 25, 44, '2021-11-01', 10, '2023-06-17 14:21:55'),
('2113112078003', 196605, 20, 54, '2022-04-01', 7, '2023-06-17 08:44:19'),
('2113112078003', 196606, 25, 58, '2022-04-01', 2, '2023-06-17 08:44:19'),
('2113112078003', 196607, 40, 60, '2022-04-01', 2, '2023-06-17 08:44:19'),
('2113112078003', 196626, 24, 66, '2022-04-01', 5, '2023-06-17 08:44:19'),
('2113112078003', 196141, 22, 60, '2022-04-01', 11, '2023-06-17 08:44:19'),
('2113112078003', 195002, 36, 57, '2022-04-01', 10, '2023-06-17 08:44:19'),
('2113112078003', 196627, 24, 62, '2022-11-01', 4, '2023-06-17 08:44:19'),
('2113112078003', 196611, 22, 50, '2022-11-01', 6, '2023-06-17 08:44:19'),
('2113112078003', 196610, 21, 61, '2022-11-01', 7, '2023-06-17 08:44:19'),
('2113112078003', 196609, 40, 60, '2022-11-01', 5, '2023-06-17 08:44:19'),
('2113112078003', 196608, 22, 65, '2022-11-01', 5, '2023-06-17 08:44:19'),
('2113112078003', 196142, 19, 68, '2022-11-01', 11, '2023-06-17 08:44:19'),
('2113112078003', 195003, 30, 43, '2022-11-01', 10, '2023-06-17 08:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblstaffs`
--

CREATE TABLE `tblstaffs` (
  `StaffUserid` varchar(10) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `staffName` char(25) NOT NULL,
  `staffImage` varchar(255) DEFAULT NULL,
  `Department` char(20) NOT NULL,
  `emailId` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `gender` varchar(12) DEFAULT NULL,
  `StaffId` int(2) NOT NULL,
  `Usertype` varchar(5) NOT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstaffs`
--

INSERT INTO `tblstaffs` (`StaffUserid`, `Password`, `staffName`, `staffImage`, `Department`, `emailId`, `mobile`, `gender`, `StaffId`, `Usertype`, `updationDate`) VALUES
('CS HOD', 'hod@123', 'Dr. M. Ramesh Kumar', 'dc5f332df1621b60dd0b222bea43cf82.jpg', 'Computer Science', 'hodcs@gmail.com', '9999797777', 'Male', 0, 'hod', '2023-06-19 13:25:21'),
('MRK', 'mrk@123', 'Dr. M. Ramesh Kumar', '', 'Computer Science', '', '', 'Male', 1, 'staff', '2023-06-14 14:26:05'),
('VAT', 'vat@123', 'Dr. V.Asaithambi', '6af5776a3c93ad8f90722c0498f648ab.jpg', 'Computer Science', '', NULL, NULL, 2, 'staff', '2023-06-15 16:26:22'),
('VS', 'vs@123', 'Mrs. V.Surya', '0f8c002750682ade82d4c232e7ee261e.jpg', 'Computer Science', 'vs123@gmail.com', '9099999999', 'Female', 4, 'staff', '2023-06-15 11:52:57'),
('RTS', 'rts@123', 'Dr. R. Thirumalai Selvi', '', 'Computer Science', NULL, NULL, NULL, 5, 'staff', NULL),
('RK', 'rk@123', 'Dr. R. Kalai Magal', '', 'Computer Science', NULL, NULL, NULL, 6, 'staff', NULL),
('VR', 'vr@123', 'Mrs. V.Ramya', '', 'Computer Science', NULL, NULL, NULL, 7, 'staff', NULL),
('PR', 'pr@123', 'Dr.P.Roopana', '9686853512b866e6a5fdfb07409530b2.jpg', 'English', '', NULL, NULL, 10, 'staff', '2023-06-16 07:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `Userid` varchar(15) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `emailId` varchar(255) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `userImage` varchar(255) DEFAULT NULL,
  `Degree & Branch` varchar(50) NOT NULL,
  `Gender` char(6) NOT NULL,
  `DOB` date NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Batch Start` year(4) NOT NULL,
  `Batch End` year(4) NOT NULL,
  `ClassId` int(2) NOT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`Userid`, `Password`, `Name`, `emailId`, `mobile`, `userImage`, `Degree & Branch`, `Gender`, `DOB`, `Department`, `Batch Start`, `Batch End`, `ClassId`, `updationDate`) VALUES
('2113112078003', '01-01-02', 'GNANAVEL K', 'gnanavelkrish@gmail.com', '8056381488', '3e8f16bc41a94b17b19fa3862f0bf4f6.jpg', 'M.Sc. Computer Science', 'Male', '2001-01-02', 'Computer Science', 2021, 2023, 1, '2023-06-14 06:47:22'),
('2113112078012', '99-12-24', 'KRISHNAKUMAR S', NULL, NULL, NULL, 'M.Sc. Computer Science', 'Male', '1999-12-24', 'Computer Science', 2021, 2023, 1, NULL),
('2113112078015', '01-05-27', 'PRAKASH P', 'prakashpm2001@gmail.com', '8056988448', '18d8db3c23a492e96dfdb411c055d9f2.jpg', 'M.Sc. Computer Science', 'Male', '2001-05-27', 'Computer Science', 2021, 2023, 1, '2023-05-08 13:59:53'),
('2113112078019', '00-09-04', 'TAMILSELVAN D', '', '6666555555', NULL, 'M.Sc. Computer Science', 'Male', '2000-09-04', 'Computer Science', 2021, 2023, 1, '2023-06-19 10:56:32'),
('2113112078024', '99-07-24', 'UVARANI R', 'lathauvarani@gmail.com', '8147483645', 'dc5f332df1621b60dd0b222bea43cf82.jpg', 'M.Sc. Computer Science', 'Female', '1999-07-24', 'Computer Science', 2021, 2023, 1, '2023-06-19 10:45:33'),
('2113112078025', '99-07-24', 'UVASHREE R', NULL, NULL, '', 'M.Sc. Computer Science', 'Female', '1999-07-24', 'Computer Science', 2021, 2023, 1, '2023-05-01 11:17:32'),
('2113112078030', 'junior123', 'Arul', '', '8076543333', NULL, 'M.Sc. Chemistry', 'Male', '2002-07-24', 'Chemistry', 2021, 2023, 2, '2023-06-20 06:45:11'),
('2113112078031', 'junior1231', 'Kumar', NULL, NULL, NULL, 'M.Sc. Computer Science', 'Male', '1999-04-27', 'Computer Science', 2020, 2022, 1, NULL),
('2113112078050', '00-05-09', 'ak', 'ak@gmail.com', '0805638144', NULL, 'B.Sc. Computer Science', '', '2023-06-10', 'Computer Science', 2023, 2026, 3, '2023-06-14 07:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination`
--

CREATE TABLE `tblsubjectcombination` (
  `Id` int(3) NOT NULL,
  `ClassId` int(2) NOT NULL,
  `SubjectId` int(6) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubjectcombination`
--

INSERT INTO `tblsubjectcombination` (`Id`, `ClassId`, `SubjectId`, `updationDate`) VALUES
(1, 1, 196601, '2023-06-15 11:42:06'),
(2, 1, 196602, '2023-06-15 11:42:06'),
(3, 1, 196603, '2023-06-15 11:42:06'),
(4, 1, 196604, '2023-06-15 11:42:06'),
(5, 1, 196621, '2023-06-15 11:42:06'),
(6, 2, 195001, '2023-06-16 11:11:42'),
(7, 1, 196141, '2023-06-15 11:42:06'),
(8, 1, 196605, '2023-06-15 11:42:06'),
(9, 1, 196606, '2023-06-15 11:42:06'),
(10, 1, 196607, '2023-06-15 11:42:06'),
(11, 1, 196626, '2023-06-15 11:42:06'),
(12, 1, 199998, '2023-06-15 11:42:06'),
(13, 1, 199999, '2023-06-15 11:42:06'),
(14, 1, 195002, '2023-06-15 11:42:06'),
(15, 1, 195001, '2023-06-16 11:24:49'),
(16, 2, 226601, '2023-06-15 11:42:06'),
(17, 1, 226602, '2023-06-15 11:42:06'),
(18, 1, 196627, '2023-06-15 11:42:06'),
(19, 1, 196611, '2023-06-15 11:42:06'),
(20, 1, 196610, '2023-06-15 11:42:06'),
(21, 1, 196609, '2023-06-15 11:42:06'),
(22, 1, 196608, '2023-06-15 11:42:06'),
(23, 1, 196142, '2023-06-15 11:42:06'),
(24, 1, 195003, '2023-06-15 11:47:00'),
(25, 2, 195003, '2023-06-16 11:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `SubjectId` int(6) NOT NULL,
  `SubjectName` varchar(50) NOT NULL,
  `Semester` varchar(12) NOT NULL,
  `Year` varchar(3) NOT NULL,
  `Part` varchar(3) NOT NULL,
  `cia` int(2) NOT NULL,
  `ese` int(2) NOT NULL,
  `total` int(3) NOT NULL,
  `totalPass` int(2) NOT NULL,
  `esePass` int(2) NOT NULL,
  `BatchStart` year(4) NOT NULL,
  `BatchEnd` year(4) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`SubjectId`, `SubjectName`, `Semester`, `Year`, `Part`, `cia`, `ese`, `total`, `totalPass`, `esePass`, `BatchStart`, `BatchEnd`, `updationDate`) VALUES
(195001, 'DEVELOPING LIFE SKILLS', 'I', 'I', 'B', 40, 60, 100, 48, 30, 2019, 2023, '2023-06-14 17:25:34'),
(195002, 'LEADERSHIP', 'II', 'I', 'B', 40, 60, 100, 48, 30, 2019, 2023, '2023-06-14 17:25:34'),
(195003, 'PROFESSIONAL ETHICS', 'III', 'II', 'B', 40, 60, 100, 48, 30, 2019, 2023, '2023-06-16 11:20:08'),
(196141, 'OPTIMIZATION MODELS', 'II', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196142, 'RESOURCE MANAGEMENT TECHNIQUES', 'III', 'II', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196601, 'REAL-TIME JAVA POGRAMMING', 'I', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196602, 'MATHEMATICAL STRUCTURE FOR COMPUTER SCIENCE', 'I', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196603, 'REAL-TIME JAVA PROGRAMMING LAB', 'I', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196604, 'IOT AND ITS APPLICATION', 'I', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196605, 'DECISION SUPPORT SYSTEM', 'II', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196606, 'DESIGN AND ANALYSIS OF ALGORITHMS', 'II', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196607, 'DESIGN AND ANALYSIS OF ALGORITHMS LAB', 'II', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196608, 'MACHINE LEARNING', 'III', 'II', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196609, 'MACHINE LEARNING LAB', 'III', 'II', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196610, 'MODERN OPERATING SYSTEM', 'III', 'II', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196611, 'INTERNET TECHNOLOGIES', 'III', 'II', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196621, 'DATA WAREHOUSING AND DATA MINING', 'I', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196626, 'ARTIFICIAL INTELLIGENCE AND EXPERT SYSTEM', 'II', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(196627, 'BIG DATA ANALYTICS', 'III', 'II', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(199998, 'XXYYY', 'II', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-18 07:31:25'),
(199999, 'YYYY', 'II', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:39:32'),
(226601, 'CHEMISTRY', 'I', 'I', 'A', 25, 75, 100, 48, 38, 2019, 2023, '2023-06-14 17:25:34'),
(226602, 'REAL-TIME JAVA POGRAMMING', 'I', 'I', 'A', 25, 75, 100, 48, 38, 2015, 2019, '2023-06-14 17:25:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`Userid`);

--
-- Indexes for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`ClassId`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstaffs`
--
ALTER TABLE `tblstaffs`
  ADD PRIMARY KEY (`StaffId`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`Userid`);

--
-- Indexes for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ClassId` (`ClassId`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`SubjectId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
