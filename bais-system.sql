-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2026 at 11:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bais-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brgy`
--

CREATE TABLE `tbl_brgy` (
  `BRGY_ID` int(11) NOT NULL,
  `BARANGAY` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brgy`
--

INSERT INTO `tbl_brgy` (`BRGY_ID`, `BARANGAY`) VALUES
(1, 'dfgdfgfdg'),
(2, 'Juan Luna'),
(3, 'sdfsdfsd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_certificates`
--

CREATE TABLE `tbl_certificates` (
  `CERT_ID` int(11) NOT NULL,
  `CERT_NAME` varchar(50) NOT NULL,
  `CONTENTS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_certificates`
--

INSERT INTO `tbl_certificates` (`CERT_ID`, `CERT_NAME`, `CONTENTS`) VALUES
(1, 'Financial Assistance/Indigency', ''),
(2, 'Embalming', ''),
(3, 'Barangay Clearance', ''),
(4, 'Loan', ''),
(5, 'Burial Assistance', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_officials`
--

CREATE TABLE `tbl_officials` (
  `OFFICIAL_ID` int(11) NOT NULL,
  `F_NAME` varchar(25) NOT NULL,
  `L_NAME` varchar(25) NOT NULL,
  `M_NAME` varchar(25) NOT NULL,
  `DOB` date NOT NULL,
  `POB` varchar(255) NOT NULL,
  `CIVIL_STATUS` varchar(20) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CONTACT` varchar(15) NOT NULL,
  `POSITION` varchar(255) NOT NULL,
  `BRGY_ID` int(255) NOT NULL,
  `TITLE` varchar(20) NOT NULL,
  `STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_officials`
--

INSERT INTO `tbl_officials` (`OFFICIAL_ID`, `F_NAME`, `L_NAME`, `M_NAME`, `DOB`, `POB`, `CIVIL_STATUS`, `EMAIL`, `CONTACT`, `POSITION`, `BRGY_ID`, `TITLE`, `STATUS`) VALUES
(1, 'Dione', 'Fundador', 'Caday', '1998-08-25', 'manjuyod', 'Single', 'diongief@gmail.com', '09319158016', '1', 2, 'Honorable', 'NEW'),
(2, 'Dione', 'Fundador', 'Manaban', '1998-09-25', 'manjuyod', 'Single', 'fundadordiongie@gmail.com', '09319158016', 'captain', 2, '', 'NEW'),
(3, 'Diongie', 'Fundador', 'Caday', '2026-03-05', 'Manjuyod negros oriental', 'Single', 'devdhaif@gmail.com', '09537217937', 'captain', 2, 'Honorable', 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personal_info`
--

CREATE TABLE `tbl_personal_info` (
  `PI_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `FNAME` varchar(50) DEFAULT NULL,
  `MNAME` varchar(50) DEFAULT NULL,
  `LNAME` varchar(50) DEFAULT NULL,
  `CITIZEN` varchar(10) DEFAULT NULL,
  `SEX` varchar(10) DEFAULT NULL,
  `CIVIL` varchar(20) DEFAULT NULL,
  `AGE` varchar(255) DEFAULT NULL,
  `CONTACT` varchar(11) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `STREET` varchar(255) DEFAULT NULL,
  `BRGY` varchar(50) DEFAULT NULL,
  `CITY` varchar(50) DEFAULT NULL,
  `TYPE` varchar(20) DEFAULT NULL,
  `PHOTO` longtext DEFAULT NULL,
  `SIGNATURE` longtext DEFAULT NULL,
  `DATE_ADDED` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PI_STATUS` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_personal_info`
--

INSERT INTO `tbl_personal_info` (`PI_ID`, `USER_ID`, `FNAME`, `MNAME`, `LNAME`, `CITIZEN`, `SEX`, `CIVIL`, `AGE`, `CONTACT`, `EMAIL`, `STREET`, `BRGY`, `CITY`, `TYPE`, `PHOTO`, `SIGNATURE`, `DATE_ADDED`, `PI_STATUS`) VALUES
(34, 35, 'Gwapo ko', 'Manaban', 'Fundador', 'filipino', 'male', 'married', '79', '09319158016', 'fundadordiongie@gmail.com', 'juan luna', 'II', 'BAIS', '1', 'photo_1774246098_69c0d8d288f0b.jpg', 'signature_1774246098_69c0d8d2896ae.png', '2026-03-23 06:10:35', 'active'),
(42, 50, 'Dione', 'Manaban', 'Fundador', 'filipino', 'male', 'married', '79', '09319158016', 'junzfundador142@gmail.com', 'juan luna', 'II', 'BAIS', '2', 'photo_1774318496_69c1f3a037752.jpg', 'signature_1774318496_69c1f3a038b46.png', '2026-03-24 02:14:56', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `POSITION_ID` int(11) NOT NULL,
  `POSITION_NAME` varchar(255) NOT NULL,
  `DATE_ADDED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`POSITION_ID`, `POSITION_NAME`, `DATE_ADDED`) VALUES
(1, 'captain', '2026-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `ID` int(11) NOT NULL,
  `TITLE` longtext NOT NULL,
  `DESCRIPTION` longtext NOT NULL,
  `FILES` longtext NOT NULL,
  `DATE_CREATED` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`ID`, `TITLE`, `DESCRIPTION`, `FILES`, `DATE_CREATED`, `STATUS`) VALUES
(3, 'Dimension Chorus 2nd', 'Nice', '[\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774255077_02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\",\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774255077_signature_1773053444659.png\",\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774255077_signature_1773141321456.png\"]', '2026-03-24 13:07:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requests`
--

CREATE TABLE `tbl_requests` (
  `REQ_ID` int(11) NOT NULL,
  `USER_ID` int(255) NOT NULL,
  `CERT_ID` int(255) NOT NULL,
  `PURPOSE` varchar(255) NOT NULL,
  `LETTER` text DEFAULT NULL,
  `CTRL_NUM` varchar(20) NOT NULL,
  `REQ_DATE` datetime NOT NULL,
  `REQ_STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_requests`
--

INSERT INTO `tbl_requests` (`REQ_ID`, `USER_ID`, `CERT_ID`, `PURPOSE`, `LETTER`, `CTRL_NUM`, `REQ_DATE`, `REQ_STATUS`) VALUES
(41, 35, 3, '12hahaha', '', '5470-5038-7090', '2026-03-23 13:19:22', 'pending'),
(42, 35, 3, '12hahaha', '', '9854-7901-8108', '2026-03-23 13:20:55', 'pending'),
(43, 35, 3, '', '', '7800-4258-3865', '2026-03-23 13:24:03', 'pending'),
(44, 35, 3, '12hahaha', '', '7152-3817-0193', '2026-03-23 13:24:58', 'declined'),
(45, 35, 3, '12hahaha', '', '5251-8814-5528', '2026-03-23 13:25:39', 'pending'),
(46, 35, 4, '', '', '9536-9925-4023', '2026-03-23 13:36:11', 'pending'),
(47, 35, 4, '12hahaha', '', '7044-5268-1215', '2026-03-23 14:08:18', 'pending'),
(48, 35, 2, '12hahaha', '', '7651-4017-4873', '2026-03-23 14:10:08', 'pending'),
(49, 35, 2, '12hahaha', '', '6742-2032-9419', '2026-03-23 14:10:35', 'pending'),
(50, 35, 2, '12hahaha', '', '3999-1884-9128', '2026-03-23 14:11:10', 'pending'),
(51, 50, 3, '12hahaha', 'letter_1774318496_69c1f3a0395e1.png', '4043-9454-1088', '2026-03-24 10:14:56', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_login`
--

CREATE TABLE `tbl_staff_login` (
  `STAFF_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `EMPLOYEE_NO` varchar(255) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `TOKEN` varchar(255) NOT NULL,
  `LOG_STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `STATUS_ID` int(11) NOT NULL,
  `STATUS_NAME` varchar(255) NOT NULL,
  `DATE_ADDED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`STATUS_ID`, `STATUS_NAME`, `DATE_ADDED`) VALUES
(1, 'Single', '2026-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `u_id` int(11) NOT NULL,
  `google_uid` varchar(255) DEFAULT NULL,
  `PP` varchar(255) DEFAULT NULL,
  `u_email` varchar(255) DEFAULT NULL,
  `u_username` varchar(20) DEFAULT NULL,
  `u_password` varchar(255) DEFAULT NULL,
  `user_role` int(1) NOT NULL DEFAULT 3,
  `u_otp` varchar(10) DEFAULT NULL,
  `OTP_DATE` datetime DEFAULT NULL,
  `DATE_CREATED` datetime NOT NULL,
  `u_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`u_id`, `google_uid`, `PP`, `u_email`, `u_username`, `u_password`, `user_role`, `u_otp`, `OTP_DATE`, `DATE_CREATED`, `u_status`) VALUES
(35, NULL, '', 'fundadordiongie@gmail.com', NULL, '$2y$10$9RU0jTI473XiJVEFjD7ZC.63oYf6uGWdpcSa7voc7ou1do2hRJ0Zm', 1, '230483', '2026-03-16 20:43:28', '2026-03-16 20:43:28', 'yes'),
(53, NULL, NULL, 'junzfundador142@gmail.com', NULL, '$2y$10$qOEaqGZsstMFs0008pB9NuG..WaP1TF9fZDrKkmEm3.ULntEqSp2C', 3, '294871', '2026-03-25 15:03:52', '2026-03-25 15:03:52', 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brgy`
--
ALTER TABLE `tbl_brgy`
  ADD PRIMARY KEY (`BRGY_ID`);

--
-- Indexes for table `tbl_certificates`
--
ALTER TABLE `tbl_certificates`
  ADD PRIMARY KEY (`CERT_ID`);

--
-- Indexes for table `tbl_officials`
--
ALTER TABLE `tbl_officials`
  ADD PRIMARY KEY (`OFFICIAL_ID`);

--
-- Indexes for table `tbl_personal_info`
--
ALTER TABLE `tbl_personal_info`
  ADD PRIMARY KEY (`PI_ID`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`POSITION_ID`);

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  ADD PRIMARY KEY (`REQ_ID`);

--
-- Indexes for table `tbl_staff_login`
--
ALTER TABLE `tbl_staff_login`
  ADD PRIMARY KEY (`STAFF_ID`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`STATUS_ID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brgy`
--
ALTER TABLE `tbl_brgy`
  MODIFY `BRGY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_certificates`
--
ALTER TABLE `tbl_certificates`
  MODIFY `CERT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_officials`
--
ALTER TABLE `tbl_officials`
  MODIFY `OFFICIAL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_personal_info`
--
ALTER TABLE `tbl_personal_info`
  MODIFY `PI_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `POSITION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  MODIFY `REQ_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_staff_login`
--
ALTER TABLE `tbl_staff_login`
  MODIFY `STAFF_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
