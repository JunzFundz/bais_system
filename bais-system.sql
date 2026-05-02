-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 23, 2026 at 09:04 AM
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
-- Table structure for table `tbl_gender`
--

CREATE TABLE `tbl_gender` (
  `GENDER_ID` int(11) NOT NULL,
  `GENDER_NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gender`
--

INSERT INTO `tbl_gender` (`GENDER_ID`, `GENDER_NAME`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `NOTIF_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `MESSAGE` longtext NOT NULL,
  `STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `OFF_SIGNATURE` longtext DEFAULT NULL,
  `DATE_STARTED` date NOT NULL,
  `DATE_ENDED` date DEFAULT NULL,
  `STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_officials`
--

INSERT INTO `tbl_officials` (`OFFICIAL_ID`, `PHOTO`, `EMP_ID`, `F_NAME`, `L_NAME`, `M_NAME`, `DOB`, `POB`, `CIVIL_STATUS`, `EMAIL`, `CONTACT`, `POSITION`, `BRGY_ID`, `TITLE`, `OFF_SIGNATURE`, `DATE_STARTED`, `DATE_ENDED`, `STATUS`) VALUES
(15, '../profiles/avatar_15_1775446683.png', '09537217937', 'Junz', 'Fundador', 'Fundz', '2025-11-05', 'Manjuyod', 2, 'junzfundador142@gmail.com', '12345678912', 1, 9, 'Honorable', '../uploads/official_15_1775446878.png', '2026-04-02', NULL, 'active'),
(16, '69d1defb9960b.jpeg', '342434223', 'Diongie', 'Eran', 'Eran', '2026-02-19', 'Cdaya', 2, 'fundadordiongie@gmail.com', '234234234234', 2, 9, 'junzcf.devs', 'official_16_1775995949.png', '2026-04-05', '2026-04-20', 'ended');

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
  `DOB` date NOT NULL,
  `POB` varchar(255) NOT NULL,
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

INSERT INTO `tbl_personal_info` (`PI_ID`, `USER_ID`, `FNAME`, `MNAME`, `LNAME`, `CITIZEN`, `SEX`, `CIVIL`, `AGE`, `DOB`, `POB`, `CONTACT`, `EMAIL`, `STREET`, `BRGY_ID`, `CITY`, `TYPE`, `PHOTO`, `SIGNATURE`, `DATE_ADDED`, `PI_STATUS`) VALUES
(44, 72, 'Dione', 'Junz', 'Fundador', 'filipino', 'Female', 'Single', '79', '2019-02-12', 'Bais city', '09319158015', 'crestinemaemendezromano0217@gmail.com', 'Cannibol street', 1, 'Bais City', '1', 'photo_users_1776912648_69e98908969da.jpg', 'signature_users_1776907733_69e975d5ba3c6.png', '2026-04-23 02:50:48', 'active');

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
(1, 'Captain', '2026-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `ID` int(11) NOT NULL,
  `BRGY_ID` int(11) DEFAULT NULL,
  `TITLE` longtext NOT NULL,
  `DESCRIPTION` longtext NOT NULL,
  `FILES` longtext NOT NULL,
  `TYPE` varchar(255) DEFAULT NULL,
  `DATE_CREATED` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`ID`, `BRGY_ID`, `TITLE`, `DESCRIPTION`, `FILES`, `TYPE`, `DATE_CREATED`, `STATUS`) VALUES
(8, 9, 'Dimension Chorus 2nd', 'I love youuuu', '[\"1775208480_INFINITY___Premium_Dashboard.pdf\",\"1775208480_REVISED-Online_Reservation_System_for_Cugon_Bamboo_Resort__Chapter_1-4__FINALLE.pdf\",\"1775208480_02-28-2026.pdf\",\"1775208480_02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\",\"1775208480_signature_1773053444659.png\",\"1775208480_0d8f0c0e-3319-48c5-b9a0-3f27bf88d862.jpeg\",\"1775208480_2ts3nfs9-qr.png\",\"1775208480_4zkxxeuy-qr.png\",\"1775208480_8e1f8aa3-b073-4e73-877f-70a6db58812b.jpeg\"]', '', '2026-04-11 12:46:40', 3),
(9, 9, 'Dimension Chorus 2nd', 'New uploads please be advise', '[\"1775945832_69dac8685813e.png\",\"1775945832_69dac86858203.png\",\"1775952750_69dae36e4669c.jpeg\",\"1775952750_69dae36e4678a.jpeg\",\"1775952750_69dae36e46815.docx\",\"1775952750_69dae36e46a99.pdf\",\"1775952750_69dae36e46b2f.png\",\"1775952750_69dae36e46bbd.png\",\"1775952801_69dae3a109f87.jpeg\",\"1775952801_69dae3a10a464.png\",\"1775952801_69dae3a10a9a2.png\",\"1775952801_69dae3a10aaa5.jpeg\",\"1775952801_69dae3a10ad62.docx\",\"1775952801_69dae3a10af11.pdf\"]', '', '2026-04-12 05:34:32', 3),
(10, 9, 'Dimension Chorus 2nd', 'dsfasdfasdfsadfsafdsadf', '[\"1775220079_ANNEX-H-3-CS-Form-No.-212-Revised-2025-Attachment-Guide-to-Filling-Up-the-Personal-Data-Sheet-new.pdf\",\"1775220079_Black_White_Modern_Festive_New_Year_Party_Photo_Collage_Facebook_Post.pdf\",\"1775220079_Black_White_Modern_Festive_New_Year_Party_Photo_Collage_Facebook_Post.png\",\"1775220079_cid-2026-0010_deployment_of_54_student_teachers_for_teaching_internship_from_norsu_bais_city_campus.pdf\",\"1775220079_CLEARANCE-PTI-20252026_UPDATED-EXTERNAL-CAMPUS-BAIS.docx\",\"1775220079_danilo_cover_page___1_.pdf\",\"1775220079_DLP_IN_MATH-5_literal_wownga_final.docx\",\"1775220079_FINAL-Llera.Rhoann.Detailed.Lesson.Plan.In.Grade.5.docx\",\"1775220079_GE_6_ARTS_APPRECIATION_GARIANDO.pdf\"]', '', '2026-04-12 01:15:23', 3),
(11, 9, 'sdfsadfsadf', 'sfasfsad', '[\"1775220156_576921887_689445843814502_2162802240117555914_n.jpg\",\"1775220156_590235744_1415104546912614_4354408474593096173_n.png\",\"1775220156_ACCOMPLISHMENT-REPORT-ON-AWA-AND-TASKS__1_.docx\",\"1775220156_ARTICLE_2_3.pdf\",\"1775220156_ARTICLE_2_3.docx\",\"1775220156_b9d3b75d-c75b-42e1-a683-858a30eb048f.jpeg\"]', '', '2026-04-11 08:38:18', 3),
(12, 1, 'Dimension Chorus 2nd', 'Nive\'ssdlf;lsdf;lsmdf', '[\"1775286900_INFINITY___Premium_Dashboard.pdf\",\"1775286900_REVISED-Online_Reservation_System_for_Cugon_Bamboo_Resort__Chapter_1-4__FINALLE.pdf\",\"1775286900_02-28-2026.pdf\",\"1775286900_02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\",\"1775286900_4zkxxeuy-qr.png\",\"1775286900_8e1f8aa3-b073-4e73-877f-70a6db58812b.jpeg\",\"1775286900_9d73273b-c49e-43d2-8377-42767990b2e6.jpeg\",\"1775286900_52d1dde0-3fae-45b6-8c42-7112c3fa8012.jpeg\",\"1775286900_75b73661-24e8-4f18-8d6e-6886f2f80b13.jpeg\"]', '', '2026-04-11 02:07:56', 3),
(13, 1, 'dfsadfsadf', 'asdasdas', '[\"1775305289_02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\"]', '', '2026-04-20 08:03:00', 3),
(14, 1, 'asdasdas', 'asdasdasdasd', '[\"1775306032_02-28-2026.pdf\"]', '', '2026-04-23 07:04:09', 2),
(15, 1, 'asdasd', 'asdasdasd', '[\"1775306206_02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\"]', '', '2026-04-11 02:08:05', 1),
(16, 1, 'Dimension Chorus 2nd', 'sdfsfsdf', '[\"1775306361_02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\"]', '', '2026-04-20 08:03:02', 3),
(17, 1, 'sdfsdfsd', 'cvdfvdfvgdfsg', '[\"1775306427_02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\"]', '', '2026-04-11 02:07:58', 3),
(18, 1, 'gwapo', 'sdfsdf', '[\"1775306537_02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\"]', '', '2026-04-11 02:07:59', 3),
(19, 1, 'gwapo', 'asdasdasd', '[\"1775306621_DTR_Generator.pdf\"]', '', '2026-04-11 02:07:57', 3),
(20, 9, 'asdasDasda', 'SDFSDCVDGREGERR12132', '[\"1775945347_69dac6834d32e.78477e75-1927-4d2c-89da-e1e53d728809.jpeg\",\"1775945347_69dac6834dd01.663945648_1635250854347152_9083900348541672114_n.jpeg\",\"1775945347_69dac6834e1ac.663945648_1635250854347152_9083900348541672114_n.png\",\"1775945347_69dac6834e548.665963680_921199930814398_8603127925936450867_n.png\"]', NULL, '2026-04-12 00:06:25', 3),
(21, 9, '5435sdfsdf', 'sdfsdfsadfsadfsadfsadfasdfsad', '[\"1775946813_69dacc3d5f1fa.78477e75-1927-4d2c-89da-e1e53d728809.jpeg\",\"1775946813_69dacc3d604cb.663945648_1635250854347152_9083900348541672114_n.jpeg\",\"1775946813_69dacc3d60831.663945648_1635250854347152_9083900348541672114_n.png\",\"1775946813_69dacc3d60ef0.02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\",\"1775946813_69dacc3d613b3.Fundador.-Final-exam.docx\",\"1775946813_69dacc3d61e16.Group_4.pdf\"]', '', '2026-04-23 01:12:00', 3),
(22, 9, 'Dimension Chorus 2nd', 'FSDFSDFDSFSDAF', '[\"1775946919_69dacca72566e.78477e75-1927-4d2c-89da-e1e53d728809.jpeg\",\"1775946919_69dacca725c99.663945648_1635250854347152_9083900348541672114_n.jpeg\",\"1775946919_69dacca726219.663945648_1635250854347152_9083900348541672114_n.png\",\"1775946919_69dacca726533.665963680_921199930814398_8603127925936450867_n.png\"]', 'announcements', '2026-04-11 22:35:52', 3),
(23, 9, 'Dimension Chorus 2nd', 'FSDFSDFDSFSDAF', '[\"1775946919_69dacca7255e2.78477e75-1927-4d2c-89da-e1e53d728809.jpeg\",\"1775946919_69dacca725d28.663945648_1635250854347152_9083900348541672114_n.jpeg\",\"1775946919_69dacca726297.663945648_1635250854347152_9083900348541672114_n.png\",\"1775946919_69dacca726665.665963680_921199930814398_8603127925936450867_n.png\"]', 'announcements', '2026-04-12 01:22:07', 3),
(33, 9, 'SDFDFSDF', 'ASDASDASDASD', '[\"1775953172_69dae514f1406.jpeg\",\"1775953172_69dae514f15bc.jpeg\",\"1775953172_69dae514f16b5.png\",\"1775953172_69dae514f17a6.png\",\"1775953172_69dae514f1889.jpeg\",\"1775953172_69dae514f1970.docx\",\"1775953172_69dae514f1a49.pdf\"]', 'activities', '2026-04-12 01:22:08', 3),
(34, 9, 'Gloryy 2.6 (BYL) V3', 'sadadasd', '[\"1775947269_69dace05d6423.78477e75-1927-4d2c-89da-e1e53d728809.jpeg\",\"1775947269_69dace05d6cd7.663945648_1635250854347152_9083900348541672114_n.jpeg\",\"1775947269_69dace05d71d8.663945648_1635250854347152_9083900348541672114_n.png\",\"1775947269_69dace05d748c.665963680_921199930814398_8603127925936450867_n.png\"]', 'activities', '2026-04-12 01:57:47', 3),
(35, 9, 'Staccato Pop 2nd', 'sdfsdafsdafsdaf', '[\"1775947445_69daceb56a40e.78477e75-1927-4d2c-89da-e1e53d728809.jpeg\",\"1775947445_69daceb56a70d.663945648_1635250854347152_9083900348541672114_n.jpeg\",\"1775947445_69daceb56a9f2.663945648_1635250854347152_9083900348541672114_n.png\",\"1775947445_69daceb56acc6.665963680_921199930814398_8603127925936450867_n.png\"]', 'activities', '2026-04-12 00:05:34', 3),
(36, 9, 'asdasdasd', 'asdfsdfsdf', '[\"1775955188_69daecf44c336.docx\",\"1775955217_69daed1152e51.jpeg\",\"1775955217_69daed1152f60.jpeg\",\"1775955217_69daed1152ff4.png\"]', 'announcements', '2026-04-12 01:57:45', 3),
(37, 9, 'asdasd', 'dasdasd', '[\"1775947663_69dacf8f07ff9.663945648_1635250854347152_9083900348541672114_n.png\",\"1775947663_69dacf8f0826a.665963680_921199930814398_8603127925936450867_n.png\",\"1775947663_69dacf8f0849d.02e60fb4-d321-4c7b-97fb-69ff6ae2f5cf.jpeg\"]', 'announcements', '2026-04-12 00:05:35', 3),
(38, 9, 'Staccato Pop 2nd', 'dfsdfsdfsdsdfsdfsdfsdf', '[\"1775952426_69dae22aefbe6.INFINITY___Premium_Dashboard.pdf\",\"1775952426_69dae22aeffa5.print.docx\",\"1775952426_69dae22af0354.REVISED-Online_Reservation_System_for_Cugon_Bamboo_Resort__Chapter_1-4__FINALLE.pdf\",\"1775952426_69dae22af07a5.signature_1773053444659.png\",\"1775952426_69dae22af0c46.signature_1773141321456.png\"]', 'announcements', '2026-04-12 00:07:22', 3),
(39, 9, 'Staccato Pop 2nd', 'dfsdfsdfsdsdfsdfsdfsdf', '[\"1775952426_69dae22af00cd.INFINITY___Premium_Dashboard.pdf\",\"1775952426_69dae22af056c.print.docx\",\"1775952426_69dae22af09e8.REVISED-Online_Reservation_System_for_Cugon_Bamboo_Resort__Chapter_1-4__FINALLE.pdf\",\"1775952426_69dae22af0e52.signature_1773053444659.png\",\"1775952426_69dae22af131a.signature_1773141321456.png\"]', 'announcements', '2026-04-12 00:11:23', 3);

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
(85, 72, 1, 'asdasdasdasd', '', '9227-1221-7411', '2026-04-11 12:35:48', 'pending'),
(86, 72, 3, 'asdasdasdasd', '', '5547-7780-9026', '2026-04-11 12:37:43', 'pending'),
(87, 72, 3, 'dsfddfsghjghjgh', '', '9047-6598-0571', '2026-04-11 12:39:16', 'pending'),
(88, 72, 3, 'asdasdasd', '', '1934-6251-7615', '2026-04-11 12:49:14', 'pending'),
(89, 72, 3, 'asdaDasdasdas', '', '1399-8122-0950', '2026-04-11 13:07:05', 'pending'),
(90, 72, 3, 'Motorcycle Loan', '', '1845-5448-7243', '2026-04-11 13:09:34', 'pending'),
(91, 72, 3, 'sdfsdfsdfsdf', '', '6115-0516-9547', '2026-04-11 16:23:32', 'pending'),
(92, 72, 3, 'Motorcycle Loan', '', '9851-5301-9436', '2026-04-11 16:34:22', 'approved'),
(93, 72, 3, 'Motorcycle Loan', '', '2703-6799-1907', '2026-04-20 20:46:58', 'pending'),
(94, 72, 3, 'sdfsdfsd', '', '4462-2167-3653', '2026-04-23 09:19:22', 'pending'),
(95, 72, 3, 'Motorcycle Loan', '', '9749-3731-5299', '2026-04-23 10:50:48', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_login`
--

CREATE TABLE `tbl_staff_login` (
  `OFFICIALS_LOG_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `OFFICIALS_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `TOKEN` varchar(255) NOT NULL,
  `LOG_STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_staff_login`
--

INSERT INTO `tbl_staff_login` (`OFFICIALS_LOG_ID`, `USER_ID`, `OFFICIALS_ID`, `EMPLOYEE_ID`, `PASSWORD`, `TOKEN`, `LOG_STATUS`) VALUES
(2, 71, 15, '12345', '$2y$10$AL/YuyGMJaUDt2UcAqStI.8lyZMzxEXLRHf.JXQXIpjEzEDxYeFW.', 'cf8844d7a098a27f2b483c2b446c5014aed24d66b022d368842b918a0e8144c5', 'active'),
(4, 73, 16, '342434223', '$2y$10$fHcdIHQUZ3fesLIF619lhOqMrAaM15x.ZyvBNkzXJgBp355oyzYgy', '48f785d126eadc6a7e59b47c07cc6b618e206f677d5575d0c6207603f4ea4a6b', 'active');

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
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `student_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`student_id`, `email`, `pass`, `date_created`) VALUES
(10, 'fundadordiongie@gmail.com', 'sdsdfsdf', '2026-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `TR_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `MESSAGE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `u_id` int(11) NOT NULL,
  `google_uid` longtext DEFAULT NULL,
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
(71, NULL, NULL, 'junzfundador142@gmail.com', NULL, '$2y$10$AL/YuyGMJaUDt2UcAqStI.8lyZMzxEXLRHf.JXQXIpjEzEDxYeFW.', 1, NULL, '2026-04-02 11:36:37', '2026-04-20 10:52:21', 'no'),
(72, 'Ydl0XiOVPkaprY0PsEq4hpO3DeF2', '../profiles/avatar_72_1776927620.png', 'crestinemaemendezromano0217@gmail.com', NULL, '$2y$10$pXtztsgkzmLaa2CmqAuuY.Lm9UN4vw5JKDPteUVA.eYG/eX7et.F.', 3, NULL, NULL, '2026-04-05 07:26:54', 'yes'),
(73, NULL, NULL, 'fundadordiongie@gmail.com', NULL, '$2y$10$fHcdIHQUZ3fesLIF619lhOqMrAaM15x.ZyvBNkzXJgBp355oyzYgy', 2, NULL, '2026-04-05 12:03:07', '2026-04-05 12:03:07', 'yes');

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
-- Indexes for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  ADD PRIMARY KEY (`GENDER_ID`);

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
  ADD PRIMARY KEY (`OFFICIALS_LOG_ID`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`STATUS_ID`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`TR_ID`);

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
-- AUTO_INCREMENT for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  MODIFY `GENDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_officials`
--
ALTER TABLE `tbl_officials`
  MODIFY `OFFICIAL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_personal_info`
--
ALTER TABLE `tbl_personal_info`
  MODIFY `PI_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `POSITION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  MODIFY `REQ_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `tbl_staff_login`
--
ALTER TABLE `tbl_staff_login`
  MODIFY `OFFICIALS_LOG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `TR_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
