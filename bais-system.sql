-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2026 at 08:24 AM
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
(1, 'Barangay I (Pob.)'),
(2, 'Barangay II (Pob.)'),
(3, 'Basak'),
(4, 'Biñohon'),
(5, 'Cabanlutan'),
(6, 'Calasga-an'),
(7, 'Cambagahan'),
(8, 'Cambaguio'),
(9, 'Cambanjao'),
(10, 'Cambuilao'),
(11, 'Canlargo'),
(12, 'Capiñahan'),
(13, 'Consolacion'),
(14, 'Dansulan'),
(15, 'Hangyad'),
(16, 'Katacgahan (Tacgahan)'),
(17, 'La Paz'),
(18, 'Lo-oc'),
(19, 'Lonoy'),
(20, 'Mabunao'),
(21, 'Manlipac'),
(22, 'Mansangaban'),
(23, 'Okiot'),
(24, 'Olympia'),
(25, 'Panala-an'),
(26, 'Panam-angan'),
(27, 'Rosario'),
(28, 'Sab-ahan'),
(29, 'San Isidro'),
(30, 'Tagpo'),
(31, 'Talungon'),
(32, 'Tamisu'),
(33, 'Tamogong'),
(34, 'Tangculogan'),
(35, 'Valencia');

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
  `PHOTO` text DEFAULT NULL,
  `EMP_ID` varchar(50) NOT NULL,
  `F_NAME` varchar(25) NOT NULL,
  `L_NAME` varchar(25) NOT NULL,
  `M_NAME` varchar(25) NOT NULL,
  `DOB` date NOT NULL,
  `POB` varchar(255) NOT NULL,
  `CIVIL_STATUS` int(11) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CONTACT` varchar(15) NOT NULL,
  `POSITION` int(11) NOT NULL,
  `BRGY_ID` int(255) NOT NULL,
  `TITLE` varchar(20) NOT NULL,
  `OFF_SIGNATURE` text DEFAULT NULL,
  `DATE_STARTED` date NOT NULL,
  `DATE_ENDED` date NOT NULL,
  `STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_officials`
--

INSERT INTO `tbl_officials` (`OFFICIAL_ID`, `PHOTO`, `EMP_ID`, `F_NAME`, `L_NAME`, `M_NAME`, `DOB`, `POB`, `CIVIL_STATUS`, `EMAIL`, `CONTACT`, `POSITION`, `BRGY_ID`, `TITLE`, `OFF_SIGNATURE`, `DATE_STARTED`, `DATE_ENDED`, `STATUS`) VALUES
(4, '1775013080_02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg', '90823492374', 'Junz', 'Caday', 'FUNDADOR', '2026-03-04', 'Caday', 1, 'diongief@gmail.com', '09537217937', 1, 2, 'ASFasdf', '', '2026-03-30', '2026-03-30', 'active'),
(5, '1774849561_signature_1773141321456.png', '90823492374', 'Diongie', 'Caday', 'Caday', '2026-03-04', 'Caday', 2, 'diongief@gmail.com', '09537217937', 1, 2, 'Junzcf.devs', '', '2026-03-30', '2026-03-30', 'active');

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
  `BRGY_ID` int(50) NOT NULL,
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

INSERT INTO `tbl_personal_info` (`PI_ID`, `USER_ID`, `FNAME`, `MNAME`, `LNAME`, `CITIZEN`, `SEX`, `CIVIL`, `AGE`, `CONTACT`, `EMAIL`, `STREET`, `BRGY_ID`, `CITY`, `TYPE`, `PHOTO`, `SIGNATURE`, `DATE_ADDED`, `PI_STATUS`) VALUES
(43, 54, 'Dione', 'Manaban', 'Fundador', 'filipino', 'male', 'Single', '79', '09319158016', 'junzfundador142@gmail.com', 'juan luna', 1, 'Bais', '2', 'photo_1775023214_69ccb46e4abd1.jpg', 'signature_1775023214_69ccb46e4c6b2.png', '2026-04-01 06:00:14', 'active');

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
(4, 'Dimension Chorus 2nd', 'Nice gwapa kaayo', '[\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774918828_259b0762-5ad2-4f4d-ad71-588408a0f085.jpeg\",\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774918828_2089a979-fd14-49fd-874b-685b36f59639.jpeg\",\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774918828_8277bf54-b8b6-46b6-80fa-743de9311778.jpeg\",\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774918828_394666e6-117b-4d5d-a4f6-3b8ac0fd7a54.jpeg\",\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774918828_574918406_1141073091485029_7399286479672047395_n.jpg\",\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774918828_576921887_689445843814502_2162802240117555914_n.jpg\",\"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/bais-documents\\/data\\/..\\/uploads\\/1774918828_590235744_1415104546912614_4354408474593096173_n.png\"]', '2026-03-31 01:00:28', 1);

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
(76, 54, 4, 'Motorcycle', '', '7892-4308-9756', '2026-04-01 14:00:14', 'pending');

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
(1, 'Single', '2026-02-28'),
(2, 'Married', '2026-03-28');

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
(35, NULL, '', 'fundadordiongie@gmail.com', NULL, '$2y$10$9RU0jTI473XiJVEFjD7ZC.63oYf6uGWdpcSa7voc7ou1do2hRJ0Zm', 1, '907916', '2026-03-16 20:43:28', '2026-03-16 20:43:28', 'yes'),
(54, 'i9Jz00YMjVUftt5PTcorNc5b69G3', 'https://lh3.googleusercontent.com/a/ACg8ocJ37R3iTIP6dmckKz2gK4a-kUfI5RQcUf2Qpu341XeE51bVYA=s96-c', 'junzfundador142@gmail.com', NULL, '$2y$10$wJ8aZ/s/cxRi60VqjEz9geU2bPJSUpR/2iMrh2utkgQt48AthSXrC', 3, NULL, NULL, '2026-03-28 17:34:39', 'yes'),
(55, 'oT0FfSF2rqOfH9pr2jlJkAENJPq2', 'https://lh3.googleusercontent.com/a/ACg8ocJL1qzIEkSb2UqBoiEqcJIhuSK73Jvg2gyi9Kh0KhPP2IVNvbk=s96-c', 'fundadordiongie@gmail.com', NULL, '$2y$10$lB6ftGN8bXGnNK9tr2jR9eVkQhldja89tFDu5HYg22dwZnI6eKx0a', 3, NULL, NULL, '2026-03-31 18:42:49', 'yes');

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
  MODIFY `BRGY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_certificates`
--
ALTER TABLE `tbl_certificates`
  MODIFY `CERT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_officials`
--
ALTER TABLE `tbl_officials`
  MODIFY `OFFICIAL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_personal_info`
--
ALTER TABLE `tbl_personal_info`
  MODIFY `PI_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `POSITION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  MODIFY `REQ_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tbl_staff_login`
--
ALTER TABLE `tbl_staff_login`
  MODIFY `STAFF_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
