-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2024 at 01:57 PM
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
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `AdminPicture` text NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `DateOfBirth` text NOT NULL,
  `AdminPhone` text NOT NULL,
  `AdminType` enum('super admin','normal admin') NOT NULL,
  `StreetAddress` varchar(100) DEFAULT NULL,
  `StateAndCity` varchar(50) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminStatus` enum('Active','Closed','Blocked') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `AdminPicture`, `Password`, `Email`, `FirstName`, `LastName`, `DateOfBirth`, `AdminPhone`, `AdminType`, `StreetAddress`, `StateAndCity`, `PostalCode`, `RegistrationDate`, `AdminStatus`) VALUES
(1, '../Admin/adminPicture/gy.jpg', 'admin123.', '1211206342@student.mmu.edu.my', 'Graycen', 'Looi Guang Yong', '23 January 2003', '1688859511', 'super admin', '5, Jalan Taya Mus 2/2, Taman Taya Mus', 'Johor - Johor Bahru', '81300', '2023-11-10 05:56:36', 'Active'),
(7, '../Admin/adminPicture/Eric.jpg', 'undefined', '1211206774@student.mmu.edu.my', 'Eric', 'Ching Khai Jie', '11 February 2003', '1131838671', 'normal admin', '5, Jalan Busan, Taman Busan 5', 'Johor - Batu Pahat', '83000', '2024-01-13 02:42:29', 'Active'),
(8, '../Admin/adminPicture/jielun.jpg', 'undefined', '1211206521@student.mmu.edu.my', 'Chong', 'Jie Lun', '09 February 2000', '1110614689', 'normal admin', '15, Jalan Kusang 5, Taman Kusang', 'Johor - Batu Pahat', '81300', '2024-01-13 08:10:57', 'Active'),
(10, '../Admin/adminPicture/jiafu.jpeg', 'Eric1234@', 'looiguangyong@gmail.com', 'Lau', 'Jia Fu', '12 August 1998', '1688859511', 'normal admin', '26, Jalan Tinggi 16, Taman Tinggi', 'Johor - Kota Tinggi', '83000', '2024-01-13 14:05:42', 'Active'),
(16, '../Admin/adminPicture/graycen.jpeg', 'undefined', 'ericching342@gmail.com', 'Tan', 'Zheeng Yu', '05 January 2002', '1688859511', 'normal admin', '88, Jalan Gaya 14, Taman Gaya', 'Johor - Johor Bahru', '81300', '2024-01-27 11:08:38', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_career`
--

CREATE TABLE `applicant_career` (
  `ApplicantCareerID` int(11) NOT NULL,
  `ApplicationID` int(11) DEFAULT NULL,
  `JobTitle` varchar(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `StartDate` text NOT NULL,
  `EndDate` text DEFAULT NULL,
  `StillInRole` tinyint(1) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_education`
--

CREATE TABLE `applicant_education` (
  `EducationID` int(11) NOT NULL,
  `ApplicationID` int(11) DEFAULT NULL,
  `Institution` varchar(255) DEFAULT NULL,
  `Course_or_Qualification` varchar(255) DEFAULT NULL,
  `Course_Highlight` text DEFAULT NULL,
  `Qualification_complete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicant_education`
--

INSERT INTO `applicant_education` (`EducationID`, `ApplicationID`, `Institution`, `Course_or_Qualification`, `Course_Highlight`, `Qualification_complete`) VALUES
(1, 1, 'Multimedia University', 'Diploma In Information Technology', 'Cloud project about AWS academy\nMobile application design protocol', 0),
(2, 2, 'Multimedia University', 'Diploma In Information Technology', 'Cloud project about AWS academy\nMobile application design protocol', 0),
(3, 3, 'Taylor University', 'Bachelor in Computer Science', '', 0),
(4, 4, 'Taylor University', 'Bachelor in Computer Science', '', 0),
(5, 5, 'Multimedia University', 'Diploma In Information Technology', '', 1),
(6, 6, 'Multimedia University', 'Diploma In Information Technology', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `applicant_responses`
--

CREATE TABLE `applicant_responses` (
  `ResponseID` int(11) NOT NULL,
  `ApplicationID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `AnswerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicant_responses`
--

INSERT INTO `applicant_responses` (`ResponseID`, `ApplicationID`, `QuestionID`, `AnswerID`) VALUES
(1, 1, 2, 7),
(2, 2, 2, 9),
(3, 2, 8, 49),
(4, 2, 58, 306),
(5, 3, 2, 7),
(6, 4, 2, 9),
(7, 4, 7, 46),
(8, 4, 8, 49),
(9, 4, 39, 267),
(10, 5, 2, 6),
(11, 6, 2, 8),
(12, 6, 8, 48),
(13, 6, 58, 306);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `ApplicationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `JobID` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Profile_Description` text DEFAULT NULL,
  `ResumePath` text NOT NULL,
  `CoverLetterPath` text NOT NULL,
  `ApplyDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('Pending','Accepted','Rejected','Processed') DEFAULT 'Pending',
  `applicant_isDeleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`ApplicationID`, `UserID`, `JobID`, `FirstName`, `LastName`, `Phone`, `Email`, `Location`, `Profile_Description`, `ResumePath`, `CoverLetterPath`, `ApplyDate`, `Status`, `applicant_isDeleted`) VALUES
(1, 21, 13, 'Looi', 'Guang Yong', '1131838671', 'looiguangyong@gmail.com', 'Johor - Johor Bahru', 'I have some knowledge about the AWS academy.', '../User/applicant_resume/Looi Guang Yong Resume_21.pdf', '../User/applicant_cover_letter/2230_IndustrialTrainingSupportLetterforIT_2023_SIGNATURE2_21.pdf', '2024-02-21 08:16:33', 'Pending', 0),
(2, 21, 9, 'Looi', 'Guang Yong', '1131838671', 'looiguangyong@gmail.com', 'Johor - Johor Bahru', 'I have some knowledge about the AWS academy.', '../User/applicant_resume/Looi Guang Yong Resume_21.pdf', '../User/applicant_cover_letter/2230_IndustrialTrainingSupportLetterforIT_2023_SIGNATURE2_21.pdf', '2024-02-21 08:40:13', 'Pending', 0),
(3, 22, 13, 'Tan', 'Zheng Yu', '126666644', 'zhengyu@gmail.com', 'Johor - Johor Bahru', 'I have been done cloud computing research', '../User/applicant_resume/Tan Zheng Yu Resume_22.pdf', '../User/applicant_cover_letter/2230_IndustrialTrainingSupportLetterforIT_2023_SIGNATURE2_22.pdf', '2024-02-21 11:56:54', 'Pending', 0),
(4, 22, 2, 'Tan', 'Zheng Yu', '126666644', 'zhengyu@gmail.com', 'Johor - Johor Bahru', 'I have been done cloud computing research', '../User/applicant_resume/Tan Zheng Yu Resume_22.pdf', '../User/applicant_cover_letter/2230_IndustrialTrainingSupportLetterforIT_2023_SIGNATURE2_22.pdf', '2024-02-21 12:32:56', 'Pending', 0),
(5, 18, 13, 'Beh', 'Song You', '1688859511', '1211206774@student.mmu.edu.my', 'Johor - Johor Bahru', 'I am a student', '../User/applicant_resume/Beh Song You 1211207130 Resume_18.pdf', '../User/applicant_cover_letter/2230_IndustrialTrainingSupportLetterforIT_2023_SIGNATURE2_18.pdf', '2024-02-21 12:41:54', 'Pending', 0),
(6, 18, 9, 'Beh', 'Song You', '1688859511', '1211206774@student.mmu.edu.my', 'Johor - Johor Bahru', 'I am a student', '../User/applicant_resume/Beh Song You 1211207130 Resume_18.pdf', '', '2024-02-21 12:43:15', 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE `career` (
  `CareerID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `JobTitle` varchar(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `StartDate` text NOT NULL,
  `EndDate` text DEFAULT NULL,
  `StillInRole` tinyint(1) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`CareerID`, `UserID`, `JobTitle`, `CompanyName`, `StartDate`, `EndDate`, `StillInRole`, `Description`) VALUES
(87, 7, 'eric', 'werwer', '2024-01', '2024-01', 0, ''),
(88, 7, 'wqe', 'wqe', '2024-01', '2024-01', 1, ''),
(95, 15, 'System Tester', 'CUCC Lab', '2024-01', '2023-06', 1, 'I am a tester '),
(96, 15, 'Network Engineer', 'VIRTUAL NETWORK SOLUTIONS SDN BHD', '2024-02', '2024-02', 1, ''),
(97, 15, 'QA Lead', 'Double Eleven', '2023-02', '', 1, ''),
(101, 7, 'h', 'j', '2024-01', '2024-01', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `CompanyID` int(11) NOT NULL,
  `CompanyEmail` varchar(255) NOT NULL,
  `CompanyPassword` varchar(100) NOT NULL,
  `CompanyName` varchar(100) NOT NULL,
  `CompanyPhone` varchar(20) DEFAULT NULL,
  `ContactPerson` varchar(255) NOT NULL,
  `CompanySize` text NOT NULL,
  `RegistrationNo` text DEFAULT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `CompanyStatus` enum('Active','Verify','Closed','Blocked') DEFAULT 'Verify'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`CompanyID`, `CompanyEmail`, `CompanyPassword`, `CompanyName`, `CompanyPhone`, `ContactPerson`, `CompanySize`, `RegistrationNo`, `RegistrationDate`, `CompanyStatus`) VALUES
(1, 'Sunwayberhad73@gmail.com', 'Sunway4059!', 'Sunway Berhad\n', '183862559', 'John Doe', '1 - 50', '921551-D\n', '2023-11-16 05:12:56', 'Active'),
(2, 'Kraiburg876@gmail.com', 'TpeTech873#', 'Kraiburg Tpe Technology', '123348970', 'Song You', '51 - 200', '404829-V', '2024-02-14 02:44:01', 'Active'),
(3, 'Leaderland3865@gmail.com', 'Leaderland9274*', 'Leaderland Era Sdn Bhd\r\n', '113359087', 'Wei Wen', '1 - 50', '1159115-X\r\n', '2024-02-14 02:48:17', 'Active'),
(4, 'MANTASOFT445@gmail.com', 'MANTAsoft294&', 'MANTASOFT SDN. BHD.', '163468787', 'Jia Fu ', '1 - 50', '672444-A\r\n', '2024-02-14 02:48:17', 'Active'),
(5, 'GlobalEducare334@gmail.com', 'GlobalEducare334%', 'Global Educare\r\n', '110097465', 'Wei Zuen', '51 - 200', '837854-W\r\n', '2024-02-14 02:58:12', 'Active'),
(6, 'Samsung777@gmail.com', 'Samsung777^', 'Samsung Malaysia Electronics (SME) Sdn Bhd', '12658990', 'Guang Yong', '51 - 200', '629186-D\r\n', '2024-02-14 02:58:12', 'Active'),
(7, 'KIDEINTERNATIONAL887@gmail.com', 'KIDEinter456$', 'KIDE INTERNATIONAL SDN BHD', '167768080', 'Kah Hei', '51 - 200', '1233378-V', '2024-02-14 03:01:23', 'Active'),
(8, 'Chemopharm3918@gmail.com', 'Chemopharm3918(', 'Chemopharm3918', '1190683435', 'Zheng Yu', '1 - 50', '25504-W', '2024-02-14 03:02:49', 'Active'),
(9, 'ExactAsia887@gmail.com', 'ExactAsia887.', 'Exact Asia Development Centre Sdn Bhd', '127566890', 'Bryan Tan', '1001 - 2000', '526565-H', '2024-02-14 03:05:39', 'Active'),
(10, 'looiguangyong@gmail.com', 'Jielun0611.', 'MMU Melaka', '1110614689', 'Jie Lun', '1 - 50', '030611-C', '2024-02-14 03:07:12', 'Active'),
(11, 'BankIslam000@gmail.com', 'BankIslam000@', 'Bank Islam\r\n', '112345345', 'Goei Jin', '1001 - 2000', '98127-X\n', '2024-02-14 03:11:16', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `company_contact_us`
--

CREATE TABLE `company_contact_us` (
  `c_ContactID` int(11) NOT NULL,
  `CompanyEmail` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `Response` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `ResponseStatus` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_contact_us`
--

INSERT INTO `company_contact_us` (`c_ContactID`, `CompanyEmail`, `Subject`, `Message`, `Response`, `CreatedAt`, `ResponseStatus`) VALUES
(1, 'ericching342@gmail.com', 'Improve your system because some bug is find by me', 'Hi , can you improve your system, the filter is not smart i think\nHi , can you improve your system, the filter is not smart i think\nHi , can you improve your system, the filter is not smart i think\nHi , can you improve your system, the filter is not smart i think\nHi , can you improve your system, the filter is not smart i think\nHi , can you improve your system, the filter is not smart i think\nHi , can you improve your system, the filter is not smart i think\nHi , can you improve your system, the filter is not smart i think', NULL, '2024-02-05 22:02:06', 0),
(2, 'ericching342@gmail.com', 'Job Postings Inquiry', 'We are interested in understanding the process of posting job openings on your platform. Can you provide details on how companies can list their job opportunities?', NULL, '2024-02-01 22:54:40', 0),
(5, 'ericching342@gmail.com', 'User Interface Feedback', 'We have some feedback regarding the user interface of your platform. How can we share our suggestions for improvement?', 'Thanks for your suggestion about this problem, we will improve it', '2024-01-19 22:54:40', 1),
(6, '1211207130@student.mmu.my', 'Advertising Opportunities Inquiry', 'We are interested in exploring advertising opportunities on your platform. Can you provide information on available advertising packages and rates?', 'Thank you for your interest in advertising. Here are the available advertising packages and their respective rates...', '2024-01-20 22:54:40', 1),
(7, '1211207130@student.mmu.edu.my', 'Account Issues Support', 'One of our company accounts seems to be facing login issues. How can we resolve this matter?', 'We apologize for the inconvenience. Our support team will investigate the login issues with the account and provide a resolution...', '2024-01-21 22:54:40', 1),
(8, 'ericching342@gmail.com', 'Job Postings Inquiry', 'We are interested in understanding the process of posting job openings on your platform. Can you provide details on how companies can list their job opportunities?', 'Thank you for reaching out. Here is a guide on how companies can post job openings on our platform...', '2024-01-22 22:55:20', 1),
(11, 'ericching342@gmail.com', 'User Interface Feedback', 'We have some feedback regarding the user interface of your platform. How can we share our suggestions for improvement?', 'Thank you for sharing your feedback. We value your input, and our design team will review the suggestions to enhance the user interface...', '2024-01-25 22:55:20', 1),
(12, '1211207130@student.mmu.my', 'Advertising Opportunities Inquiry', 'We are interested in exploring advertising opportunities on your platform. Can you provide information on available advertising packages and rates?', 'Thank you for your interest in advertising. Here are the available advertising packages and their respective rates...', '2024-01-26 22:55:20', 1),
(13, '1211207130@student.mmu.edu.my', 'Account Issues Support', 'One of our company accounts seems to be facing login issues. How can we resolve this matter?', 'We apologize for the inconvenience. Our support team will investigate the login issues with the account and provide a resolution...', '2024-01-27 22:55:20', 1),
(14, '1211206521@student.mmu.edu.my', 'Collaboration Proposal', 'We are interested in exploring collaboration opportunities with your platform. Let\'s discuss potential synergies and collaboration possibilities.', 'Thank you for expressing interest in collaboration. Our partnership team will contact you to discuss potential collaborations...', '2024-01-28 22:55:20', 1),
(15, 'RocketsviewManagementSdnBhd123@gmail.com', 'Verification Process Inquiry', 'We received a request for account verification. Can you provide information on the verification process and the steps involved?', 'Thank you for reaching out. Our verification team will guide you through the account verification process. Here are the steps...', '2024-01-29 22:55:20', 1),
(16, '1211206342@student.mmu.edu.my', 'Blocked Account Assistance', 'One of our company accounts appears to be blocked. How can we resolve this matter and regain access?', 'We apologize for any inconvenience. Our support team will investigate the issue with the blocked account and provide a resolution...', '2024-01-30 22:55:20', 1),
(27, 'looiguangyong@gmail.com', 'restunbg', 'fdhh', 'hibbhfb', '2024-02-21 07:23:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `CreditCardID` int(1) NOT NULL,
  `CompanyID` int(11) DEFAULT NULL,
  `CreditCard_Type` text DEFAULT NULL,
  `CreditCard_Number` varchar(19) DEFAULT NULL,
  `CreditCard_Holder` text DEFAULT NULL,
  `CreditCard_ExpMonth` varchar(2) DEFAULT NULL,
  `CreditCard_ExpYear` varchar(4) DEFAULT NULL,
  `CreditCard_CVV` int(11) DEFAULT NULL,
  `CreditCard_isDeleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`CreditCardID`, `CompanyID`, `CreditCard_Type`, `CreditCard_Number`, `CreditCard_Holder`, `CreditCard_ExpMonth`, `CreditCard_ExpYear`, `CreditCard_CVV`, `CreditCard_isDeleted`) VALUES
(1, 10, 'mastercard', '5167 8909 8543 3456', 'JieLun', '02', '2024', 611, 0),
(2, 1, 'mastercard', '5167 8909 8543 3451', 'John Doe', '04', '2024', 655, 0),
(3, 2, 'mastercard', '5167 8909 8543 3452', 'Song You', '04', '2025', 652, 0),
(4, 3, 'mastercard', '5167 8909 8543 3453', 'Wei Wen', '04', '2025', 654, 0),
(5, 4, 'mastercard', '5167 8909 8543 3454', 'Jia Fu ', '06', '2025', 657, 0),
(6, 5, 'mastercard', '5167 8909 8543 3455', 'Wei Zuen', '06', '2025', 887, 0),
(7, 6, 'mastercard', '5167 8909 8543 3458', 'Guang Yong', '07', '2025', 445, 0),
(8, 7, 'mastercard', '5267 8909 8543 3451', 'Kah Hei', '07', '2025', 345, 0),
(9, 8, 'mastercard', '5347 8909 8543 3451', 'Zheng Yu', '09', '2025', 145, 0),
(10, 9, 'mastercard', '5347 8909 8543 3493', 'Bryan Tan', '09', '2024', 149, 0),
(11, 11, 'mastercard', '5547 8909 8543 3495', 'Goei Jin', '01', '2026', 228, 0);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `EducationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Institution` varchar(255) DEFAULT NULL,
  `Course_or_Qualification` varchar(255) DEFAULT NULL,
  `Course_Highlight` text DEFAULT NULL,
  `Qualification_complete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`EducationID`, `UserID`, `Institution`, `Course_or_Qualification`, `Course_Highlight`, `Qualification_complete`) VALUES
(14, 7, 'asd', 'asd', 'asdasd', 1),
(16, 15, 'Multimedia University', 'Degree in Engineering', 'CGPA 4.0', 1),
(17, 21, 'Multimedia University', 'Diploma In Information Technology', 'Cloud project about AWS academy\nMobile application design protocol', 0),
(18, 22, 'Taylor University', 'Bachelor in Computer Science', '', 0),
(19, 18, 'Multimedia University', 'Diploma In Information Technology', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_location`
--

CREATE TABLE `job_location` (
  `Job_Location_ID` int(11) NOT NULL,
  `Job_Location_Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_location`
--

INSERT INTO `job_location` (`Job_Location_ID`, `Job_Location_Name`) VALUES
(1, 'Johor'),
(2, 'Johor - Batu Pahat'),
(3, 'Johor - Johor Bahru'),
(4, 'Johor - Kluang'),
(5, 'Johor - Kota Tinggi'),
(6, 'Johor - Mersing'),
(7, 'Johor - Muar'),
(8, 'Johor - Pontian'),
(9, 'Johor - Segamat'),
(10, 'Johor - Others'),
(11, 'Kedah'),
(12, 'Kedah - Alor Setar'),
(13, 'Kedah - Jitra'),
(14, 'Kedah - Kulim'),
(15, 'Kedah - Langkawi'),
(16, 'Kuala Lumpur'),
(17, 'Selangor'),
(18, 'Kedah - Sungai Petani'),
(19, 'Kedah - Others'),
(20, 'Kelantan'),
(21, 'Kelantan - Kota Bharu'),
(22, 'Kelantan - Others'),
(23, 'Labuan'),
(24, 'Melaka'),
(25, 'Melaka - Alor Gajah'),
(26, 'Melaka - Jasin'),
(27, 'Melaka - Others'),
(28, 'Negeri Sembilan'),
(29, 'Negeri Sembilan - Bahau'),
(30, 'Negeri Sembilan - Kuala Pilah'),
(31, 'Negeri Sembilan - Nilai'),
(32, 'Negeri Sembilan - Port Dickson'),
(33, 'Negeri Sembilan - Seremban'),
(34, 'Negeri Sembilan - Tampin'),
(35, 'Negeri Sembilan - Others'),
(36, 'Penang'),
(37, 'Penang - Ayer Itam'),
(38, 'Penang - Bayan Lepas'),
(39, 'Penang - Bukit Mertajam'),
(40, 'Penang - Butterworth'),
(41, 'Penang - Gelugor'),
(42, 'Penang - George Town'),
(43, 'Penang - Perai'),
(44, 'Penang - Tanjung Bungah/Teluk Bahang'),
(45, 'Penang - Others'),
(46, 'Pahang'),
(47, 'Pahang - Bentong'),
(48, 'Pahang - Cameron Highlands'),
(49, 'Pahang - Jerantut'),
(50, 'Pahang - Kuantan'),
(51, 'Pahang - Pekan'),
(52, 'Pahang - Raub'),
(53, 'Pahang - Temerloh'),
(54, 'Pahang - Others'),
(55, 'Perak'),
(56, 'Perak - Bidor'),
(57, 'Perak - Ipoh'),
(58, 'Perak - Kuala Kangsar'),
(59, 'Perak - Lumut'),
(60, 'Perak - Taiping'),
(61, 'Perak - Tapah'),
(62, 'Perak - Teluk Intan'),
(63, 'Perak - Others'),
(64, 'Perlis'),
(65, 'Perlis - Kangar'),
(66, 'Perlis - Others'),
(67, 'Putrajaya'),
(68, 'Sabah'),
(69, 'Sabah - Keningau'),
(70, 'Sabah - Kota Kinabalu'),
(71, 'Sabah - Kudat'),
(72, 'Sabah - Lahad Datu'),
(73, 'Sabah - Sandakan'),
(74, 'Sabah - Tawau'),
(75, 'Sabah - Others'),
(76, 'Selangor - Ampang'),
(77, 'Selangor - Cheras'),
(78, 'Selangor - Cyberjaya'),
(79, 'Selangor - Kajang/Bangi/Serdang'),
(80, 'Selangor - Klang/Port Klang'),
(81, 'Selangor - Puchong'),
(82, 'Selangor - Rawang'),
(83, 'Selangor - Selayang'),
(84, 'Selangor - Semenyih'),
(85, 'Selangor - Shah Alam/Subang'),
(86, 'Selangor - Subang Jaya'),
(87, 'Selangor - Others'),
(88, 'Sarawak'),
(89, 'Sarawak - Bintulu'),
(90, 'Sarawak - Kapit'),
(91, 'Sarawak - Kota Samarahan'),
(92, 'Sarawak - Kuching'),
(93, 'Sarawak - Limbang'),
(94, 'Sarawak - Miri'),
(95, 'Sarawak - Sarikei'),
(96, 'Sarawak - Sibu'),
(97, 'Sarawak - Sri Aman'),
(98, 'Sarawak - Others'),
(99, 'Terengganu'),
(100, 'Terengganu - Dungun'),
(101, 'Terengganu - Kemaman'),
(102, 'Terengganu - Kuala Terengganu'),
(103, 'Terengganu - Others');

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

CREATE TABLE `job_post` (
  `Job_Post_ID` int(11) NOT NULL,
  `Job_Post_Title` text NOT NULL,
  `Job_Post_Position` text NOT NULL,
  `Job_Post_Exp` text NOT NULL,
  `Job_Post_MinSalary` text NOT NULL,
  `Job_Post_MaxSalary` text NOT NULL,
  `Job_Post_Description` text NOT NULL,
  `CompanyID` int(11) DEFAULT NULL,
  `AdStartDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdEndDate` timestamp NULL DEFAULT NULL,
  `Main_Category_ID` int(11) DEFAULT NULL,
  `Sub_Category_ID` int(11) DEFAULT NULL,
  `Job_Post_Type` int(11) NOT NULL,
  `Job_Location_ID` int(11) DEFAULT NULL,
  `job_status` enum('Active','Closed','Blocked','Draft') NOT NULL DEFAULT 'Draft',
  `Job_Post_Location` text NOT NULL,
  `Job_Post_Responsibilities` text DEFAULT NULL,
  `Job_Post_Benefits` text DEFAULT NULL,
  `Main_Category_Name` text DEFAULT NULL,
  `Sub_Category_Name` text DEFAULT NULL,
  `Job_Logo_Url` varchar(255) DEFAULT NULL,
  `Job_Cover_Url` varchar(255) DEFAULT NULL,
  `Job_isDeleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_post`
--

INSERT INTO `job_post` (`Job_Post_ID`, `Job_Post_Title`, `Job_Post_Position`, `Job_Post_Exp`, `Job_Post_MinSalary`, `Job_Post_MaxSalary`, `Job_Post_Description`, `CompanyID`, `AdStartDate`, `AdEndDate`, `Main_Category_ID`, `Sub_Category_ID`, `Job_Post_Type`, `Job_Location_ID`, `job_status`, `Job_Post_Location`, `Job_Post_Responsibilities`, `Job_Post_Benefits`, `Main_Category_Name`, `Sub_Category_Name`, `Job_Logo_Url`, `Job_Cover_Url`, `Job_isDeleted`) VALUES
(1, 'Senior Associate - Finance Operation, Sunway FSSC (SR 24629)', 'Junior Executive', '4 Years', '3500', '4500', 'The Sunway Group is the first Malaysian conglomerate to have a fully integrated Finance Shared Services Centre (Finance SSC). Finance SSC, the financial outsourcing arm of the Group, is a fully integrated accounting center which provides to its business operations financial and accounting support services from transaction processing to value added management decision support. To ensure continuous growth, the center has invested significantly in external training and in-house development programmes to further improve, equip and develop its staff. In line with our vision to provide world-class support services, we wish to invite qualified and dynamic individuals who share our passion for excellence, to be part of our family and bring the center to greater heights.\r\n\r\n', 1, '2024-02-13 20:29:05', '2024-04-13 20:29:05', 1, 8, 1, 86, 'Active', 'Selangor - Subang Jaya', 'Responsible and accountable for the accuracy and timely preparation of financial reports of companies in compliance with accounting standards and SSOPs under SSC umbrella – Sunway FSSC & Sunway Finpro\r\n\r\nProper matching of cost against revenue to mitigate the fluctuation of profits/(losses) for the reporting period.\r\n\r\nPreparation of management reports, financial analysis and any other ad-hoc reports to facilitate management decision.\r\n\r\nEnsure healthy cash flow by timely invoicing and collection of fees charged.\r\n\r\nAccountable and responsible for the petty cash float.\r\n\r\nEnsure timely and accurate preparation and submission of statutory reports.\r\n\r\nEnsure timely and accurate preparation of the tax information to submit to tax agent/Group Tax and submission of company\'s tax filing to IRB.\r\n\r\nEnsure timely and accurate preparation of tax estimation for Group Tax review and submission to IRB as per required timeline.\r\n\r\nPreparation of Annual Business Plan, Budget and Rolling Forecast with proper documentation of basis and assumptions for presentation to management.\r\n\r\nManage the financials to prevent cost overrun and ensure expenditure is within budget.\r\n\r\nEnsure availability and review of audit schedules to ensure timely adjustment of outstanding items to prevent potential audit issues.\r\n\r\nCompute Service Level Agreement (SLA) fees and track SLA fees against KPI and Business Case.\r\n\r\nPreparation of SLA agreements to Business Units and ensure return of signed copies.\r\n\r\nCompile and track the KPI and transaction volume of Finance Shared Services (FSSC) to ensure KPIs are met at all times.\r\n\r\nTo support incubation of new roll in companies\r\n\r\nAdvise management of any potential exposures or opportunities that will impact the financials of SSC, inclusive of tax leakages/penalty.\r\n\r\nCollaborate with other COE (Centre of Excellence) in FSSC in improving the financial reporting.\r\n\r\nCollaborate and get buy-in from COE in FSSC on implementation of cost improvement initiatives.\r\n\r\nLiaise with Business Units, External Auditors and Tax Agents where required.\r\n\r\nSubmit authority surveys as per required timeline.', 'Competitive Salary Packages: While pay isn\'t everything, it\'s essential. We offer competitive salary packages that reflect our commitment to recognizing and rewarding your skills and contributions.\r\n\r\nComprehensive Health Insurance: Your well-being matters to us. We provide comprehensive health insurance plans to ensure you and your family have access to quality healthcare, promoting a healthy work-life balance.\r\n\r\nFlexible Work Arrangements: We understand the importance of flexibility. Our company promotes a healthy work-life balance by offering flexible work arrangements, including remote work options, to accommodate your personal and professional needs.\r\n\r\nProfessional Development Opportunities: Your growth is our priority. We provide various opportunities for professional development, including training programs, workshops, and mentorship, to help you enhance your skills and advance your career.', 'Accounting', 'Bookkeeping & Small Practice Accounting', '../Company/logo/ee4dce1061f3f616224767ad58cb2fc751b8d2dc.jpeg', NULL, 0),
(2, 'Maintenance Technician', 'Entry Level', '1 Year', '2000', '2900', 'Report to Maintenance Supervisor.\r\nTo perform preventive maintenance activities and address all plant equipment problems effectively and efficiently with necessary corrective actions to minimize the loss in production time and capacity.\r\nPerforming the assigned work orders and PMs from ApiPro system.\r\nAttending breakdowns. Propose and implement corrective actions to avoid recurrence and minimize technical downtimes.\r\nConsume spare parts, consumable items & other resources of the department effectively & maintain proper record.\r\nTo ensure all troubleshooting, repairing and maintenance activities comply with environmental, health and safety rules & regulations.\r\nAny other assignments that may be assigned from time to time.\r\nTo cooperate with any energy, environmental, health & safety (EnEHS) activities or campaigns organized by the Company as well as to obey or to enforce company’s EnEHS rules and regulations.', 2, '2024-02-13 20:33:10', '2024-04-13 20:33:10', 12, 143, 1, 79, 'Active', 'Selangor - Kajang/Bangi/Serdang', 'Certificate or Diploma in Mechatronic, Mechanical, or Electrical Engineering.\r\nPreferably with minimum 1 years work experience in related capacity.\r\nWilling to work on shift rotation basis.\r\nProactive and results oriented.', 'Generous Vacation and Paid Time Off: Everyone needs a break to recharge. We offer generous vacation and paid time off policies to ensure you have the time to relax, travel, and spend quality moments with your loved ones.\r\n\r\nRetirement Savings Plans: Planning for the future is important. We offer retirement savings plans to help you secure your financial future, providing peace of mind as you build towards retirement.\r\n\r\nEmployee Assistance Programs: We care about your well-being beyond the workplace. Our employee assistance programs offer support for personal and professional challenges, ensuring you have access to resources to navigate life\'s complexities.\r\n\r\nDiverse and Inclusive Workplace: We value diversity and inclusion. Join a team that celebrates differences and fosters an inclusive environment where everyone feels heard, respected, and appreciated.', 'Engineering', 'Maintenance', '../Company/logo/ee4dce1061f3f616224767ad58cb2fc751b8d2dc (1).jpeg', '../Company/covers/a868bcb8fbb284f4e8301904535744d488ea93c1 (1).jpeg', 0),
(3, 'Kindergarten /Primary Tuition Teacher', 'Non-Executive', 'Not required', '3000', '4000', 'Teaching students in Homework / Tuition class (Primary).\r\nPreparing a weekly lesson plan for the subject(s) teach & tuition materials preparation.\r\nCoaching on students\' Leadership & Behaviors.\r\nOrganizing events & camps.\r\nBuilding a good rapport with students & parents.\r\nCommunicating with Parents on academic & training activities through phone calls', 3, '2024-02-13 20:33:47', '2024-05-13 20:33:47', 11, 124, 1, 36, 'Active', 'Penang', 'LOVE & PASSIONATE towards Education especially to Young leaders & Primary kids.\r\nAt least STPM/ Certificate/Diploma / Bachelors Degree or Above.\r\nExcellent written and communication skills in English, Bahasa Malaysia, and Mandarin (as the role requires the candidate to teach Mandarin Subjects)\r\nApplicant must be willing to work in Bayan Lepas.\r\nNo work experience is required. Training will be provided.', 'We will give you a full Teacher\'s Training\r\nMeal and miscellaneous allowances\r\nProfit-Sharing\r\nCareer Development & Entrepreneurship opportunities will be provided.\r\nYou can work in 4 branches in Johor.', 'Education & Training', 'Teaching - Early Childhood', '../Company/logo/ee4dce1061f3f616224767ad58cb2fc751b8d2dc (2).jpeg', '../Company/covers/a868bcb8fbb284f4e8301904535744d488ea93c1 (2).jpeg', 0),
(4, 'IT TECHNICIAN INTERNSHIP', 'Non-Executive', 'Not required', '500', '501', 'Job Requirements:\r\n\r\nPossess or currently pursuing a Diploma in related IT field\r\nExcellent written and verbal communication skills.\r\nPossess valid driving license (B2/D)\r\nGood problem-solving skills.\r\nWilling to work at JKR-HQ Kuala Lumpur', 4, '2024-02-13 20:34:17', '2024-06-13 20:34:17', 18, 239, 3, 16, 'Active', 'Kuala Lumpur', 'Installing and configuring hardware and software components to ensure usability.\r\nTroubleshooting hardware and software issues.\r\nEnsuring electrical safety standards are met.\r\nRepairing or replacing damaged hardware.\r\nUpgrading the entire system to enable compatible software on all computers.\r\nInstalling and upgrading anti-virus software to ensure security at the user level.\r\nPerforming tests and evaluations of new software and hardware.\r\nProviding support to users and being the first point of contact for error reporting.\r\nConducting daily backup operations.\r\nManaging technical documentation.\r\nAssisting in special project such as renovation and office shifting.', 'Performance-Based Bonuses: In addition to your regular salary, we believe in recognizing exceptional performance. Our performance-based bonus system rewards hard work and dedication.\r\n\r\nWorkplace Perks and Amenities: Enjoy a comfortable and inspiring workplace. We provide various perks and amenities, such as on-site gyms, wellness programs, and social events, to make your work environment enjoyable and fulfilling.', 'Information & Communication Technology', 'Help Desk & IT Support', '../Company/logo/ee4dce1061f3f616224767ad58cb2fc751b8d2dc (3).jpeg', '../Company/covers/a868bcb8fbb284f4e8301904535744d488ea93c1 (3).jpeg', 0),
(5, 'Human Resource Executive', 'Entry Level', '1 Year', '3300', '3500', 'Candidate must possess at least a Degree (HR). \r\nRequired language(s): Bahasa Malaysia, English.\r\nAt least 2 years (s) or more of working experience in the related field is required for this position.\r\nFull-time position available.\r\nThis position will be based at the Corporate Childcare Centre in Kuala Lumpur.\r\n\r\n', 5, '2024-02-13 20:34:43', '2024-07-13 20:34:43', 17, 220, 1, 16, 'Active', 'Kuala Lumpur', 'Responsible for formulating, streamlining and controlling the human resource policies & manuals, strategizing for hiring and retaining an adequate pool of talents and handling all employee-related matters. \r\n\r\nManagement \r\n\r\nEffective planning and management of resources for academics and curriculum (teachers and carers) \r\n\r\nEffective planning and management of resources for administrative and support personnel\r\n\r\nFinancial Management\r\n\r\nMake projections on manpower requirements and cost\r\n\r\nPrepare yearly budget for training room/materials\r\n\r\nHuman Resource Management\r\n\r\nForecast on manpower needs \r\n\r\nAssess requirement on critical talents \r\n\r\nDevelop sourcing strategy & criteria for talents \r\n\r\nResponsible for the full spectrum of hiring staff \r\n\r\nResponsible in ensuring compliance to all statutory requirements prior to employment (e.g., thypoid jab., full medical check-up, security screening) \r\n\r\nResponsible for administrating, managing and reviewing of the Centre’s performance management system, staff movement, annual increments, bonuses and yearly appraisal \r\n\r\nInvolve in the preparation of monthly payroll and ensure remittances under the statutory requirements are made in a timely manner\r\n\r\nTraining & Development \r\n\r\nEnsure compliance with statutory technical requirements (e.g., PERMATA course for nursery teachers, First Aid) \r\n\r\nIdentify and provide developmental opportunities and appropriate training to develop staff’s talents, skills and competencies \r\n\r\nDevelop a yearly training calendar.', 'Flexible Work Arrangements: We understand the importance of flexibility. Our company promotes a healthy work-life balance by offering flexible work arrangements, including remote work options, to accommodate your personal and professional needs.\r\n\r\nProfessional Development Opportunities: Your growth is our priority. We provide various opportunities for professional development, including training programs, workshops, and mentorship, to help you enhance your skills and advance your career.\r\n\r\nGenerous Vacation and Paid Time Off: Everyone needs a break to recharge. We offer generous vacation and paid time off policies to ensure you have the time to relax, travel, and spend quality moments with your loved ones.', 'Human Resources & Recruitment', 'Industrial & Employee Relations', '../Company/logo/ee4dce1061f3f616224767ad58cb2fc751b8d2dc (4).jpeg', '../Company/covers/a868bcb8fbb284f4e8301904535744d488ea93c1 (4).jpeg', 0),
(6, 'Channel Marketing, Assistant Manager', 'Entry Level', '4 Years', '3500', '4500', 'Possess a degree or diploma qualification in Marketing, Business Administration, Commerce or any relevant degree.\r\nPreferably with minimum 4 years working experiences in channel or trade marketing role with Consumer Electrical, FMCG or any relevant industry.\r\nUnderstand channel complexity and propose appropriate sell-out and promotions.\r\nExperience in market analysis and go-to-market strategy development.\r\nStrong commercial acumen, analytical and result oriented.\r\nEnjoy work as a team and connect with all levels of stakeholders with good interpersonal skills.\r\nExperience dealing with budget management, analysis on return on investment as well as opportunity costs.\r\nPossess strong communication skill with good proficiency in English.', 6, '2024-02-13 20:35:07', '2025-02-13 20:35:07', 22, 310, 1, 16, 'Active', 'Kuala Lumpur', 'Develop Local Launch Plan for NPD ensure 4R (Right Store, Product, Display, People) retail strategy and action plans are well defined and communicated clearly to Sales and trade.\r\nDevelop and ensure Retail Index Standard (RIS) by channel and store in related to each product proposition.\r\nDevelop all BTL POSM in related to in store sell out promotion and ensure all CI and brand identity are aligned with Corporate Marketing.\r\nEngage with Field force team to ensure all the retail marketing BTL execution is implemented timely and flawlessly.\r\nPropose customize sell-out mechanics based with Product marketing and Sales for selected account/regions.\r\nIn-store Communication & Display, work closely with innovation design team to ensure the display segmentation & guideline deliver the appropriate Communication visibility strategy.\r\nBe the category display and design gatekeeper with HQ to ensure right adaptation of category/range display and localize the Merchandising and Display guidelines (generic and new store planograms).\r\nAnalyze and execute right model mix for selected Strategic and Growth accounts (A, B stores) with well define SKU focus and prioritization.\r\nChannel Mapping/ Store Grading. Work closely with retail planning team to analyze business opportunity via channel mapping information by store/segment and develop relevant channel strategy by Store Segments.\r\nWork closely with Product marketing team & MDF team for Short and Midterm Budget Planning in related to Strategic launch BTL and POSM activities with full overview of Marketing Activities calendar.\r\nIdentify stores and develop action plans for Store Segmentation/ Upgradation/ Resources planning as the total RM resources.\r\nSet target, approve RIS, monitor, review and track flooring and display progress.\r\nAs the leader to develop and adapt all POSM for promotional campaigns, for all products (Generic POSM & Promotion POSM), by store type and range.\r\nRIS & SKU - Flooring and Range Optimization. \r\nTrack and Monitor the New Launches Flooring Progress, review the Flooring/Sell Out performance with PM, Sales and FF team & develop action plans.\r\nHandle project scheduling, budget and planning. Provide monthly budget planning for the respective category in charge to Planning team and ensure adhere budgeting submission and approval.', 'Employee Assistance Programs: We care about your well-being beyond the workplace. Our employee assistance programs offer support for personal and professional challenges, ensuring you have access to resources to navigate life\'s complexities.\r\n\r\nDiverse and Inclusive Workplace: We value diversity and inclusion. Join a team that celebrates differences and fosters an inclusive environment where everyone feels heard, respected, and appreciated.\r\n\r\nPerformance-Based Bonuses: In addition to your regular salary, we believe in recognizing exceptional performance. Our performance-based bonus system rewards hard work and dedication.', 'Marketing & Communications', 'Marketing Communications', '../Company/logo/ee4dce1061f3f616224767ad58cb2fc751b8d2dc (5).jpeg', '../Company/covers/a868bcb8fbb284f4e8301904535744d488ea93c1 (5).jpeg', 0),
(7, 'PROCUREMENT ASSISTANT / EXECUTIVE (SITE-BASED)', 'Senior Executive', '5 Years', '2700', '4000', 'Purchase major materials and machinery rentals to support CSA and MEP team.\r\nMeet with operational teams and deliver their buying requirements.\r\nEnsure savings, rebates and compliance are achieved in line with project strategy.\r\nSupport tender process for materials and plant packages.\r\nSupport account department in payment arrangement for suppliers or subcontractors.\r\nTo carry out all the assignments as per required by management from time to time.', 7, '2024-02-13 20:36:04', '2025-01-13 20:36:04', 21, 295, 1, 16, 'Active', 'Kuala Lumpur', 'Purchase major materials and machinery rentals to support CSA and MEP team.\r\nMeet with operational teams and deliver their buying requirements.\r\nEnsure savings, rebates and compliance are achieved in line with project strategy.\r\nSupport tender process for materials and plant packages.\r\nSupport account department in payment arrangement for suppliers or subcontractors.\r\nTo carry out all the assignments as per required by management from time to time.', 'Medical Claim\r\nGroup Insurances\r\n5 Working Days ', 'Manufacturing, Transport & Logistics', 'Purchasing, Procurement & Inventory', '../Company/logo/f3c5292cec0e05e4272d9bf9146f390d366481d0.png', '../Company/covers/7ee6b7b3aa8061afd4602616a4a88ea27339c0a9.jpeg', 0),
(9, 'Key Account Executive (Chemistry/Oil & Gas)', 'Junior Executive', '1 Year', '5000', '7000', 'To be successful in this role, you would require:\r\n\r\nAt least a degree in Chemistry or similar field.\r\nAt least 2-3 years’ experience in sales and marketing particularly in Oil & Gas Instrumentation.\r\nPossess good verbal and written communication skills in Bahasa Malaysia and English.\r\nPossess a car and valid Malaysian driving license.\r\nAble to travel extensively. ', 8, '2024-02-13 20:36:31', '2024-12-13 20:36:31', 26, 349, 1, 17, 'Active', 'Selangor', 'Manage key accounts in oil and gas industry to achieve sustainable business growth.\r\nBe the key contact point of customer for sales, services, technical support request.\r\nResponsible to develop new account to expand the oil & gas business.\r\nPromote and market product in assigned key account to achieve annual sales target.\r\nInvolve in marketing activities planning and strategy development.\r\nExecute/drive the marketing activity in assigned key account.\r\nStay abreast with market dynamics, competitor activities and industry trends. \r\nWork closely with application specialists, product specialists and service team to ensure customer expectation/requirement met.\r\nProvide accurate sales forecasts and contribute to overall business planning.', 'Competitive Salary Packages: While pay isn\'t everything, it\'s essential. We offer competitive salary packages that reflect our commitment to recognizing and rewarding your skills and contributions.\r\n\r\nComprehensive Health Insurance: Your well-being matters to us. We provide comprehensive health insurance plans to ensure you and your family have access to quality healthcare, promoting a healthy work-life balance.', 'Sales', 'Account & Relationship Management', '../Company/logo/ee4dce1061f3f616224767ad58cb2fc751b8d2dc (7).jpeg', '../Company/covers/a868bcb8fbb284f4e8301904535744d488ea93c1 (6).jpeg', 0),
(10, 'Collections Officer', 'Entry Level', '2 Years', '1800', '2599', 'To perform quality collection calls\r\nRemind customers on the overdue amount\r\nEducate customers on the awareness and the consequences of delaying and/ or nonpayment.\r\nTo negotiate, persuade and convince customer to pay. i.e. quick thinker with quick answer (versatile) when customer try evade payment\r\nMinimize and mitigate complaints\r\nTo achieve target set by the Bank\r\nMaintain professionalism and relationship with customers\r\nTo update all conversation and collection activities in Collections system.\r\nTo obtain customers’ new record i.e. contact number/ address and adhere to the approved process of verification.\r\nAny other tasks as reasonably requested by Bank Islam from time to time.\r\nTo ensure to remain calm when provoked by customers at any contact with customers.', 11, '2024-02-13 20:37:10', '2024-11-13 20:37:10', 4, 56, 1, 16, 'Active', 'Kuala Lumpur', 'Practice and display exemplary service excellence at all times.\r\n\r\nRecommend for Short Messaging System (SMS).\r\n\r\nTo perform escalation/ highlight cases that require further action i.e. change of telephone number, release debit request etc.\r\n\r\nTo ensure adherence to Bank’s code of conduct, Collections guiding note and / or any relevant policy & guideline provided by regulator / Bank Islam\r\n\r\nProvide feedback to management on runaway, dispute, fraud cases etc for analysis and action.\r\n\r\nEnsure adherence & compliance to all internal policies / guidelines and external regulators requirements\r\n\r\nSupport additional responsibilities by Team Leader / Supervision Team.', 'Generous Vacation and Paid Time Off: Everyone needs a break to recharge. We offer generous vacation and paid time off policies to ensure you have the time to relax, travel, and spend quality moments with your loved ones.\r\n\r\nRetirement Savings Plans: Planning for the future is important. We offer retirement savings plans to help you secure your financial future, providing peace of mind as you build towards retirement.\r\n\r\nEmployee Assistance Programs: We care about your well-being beyond the workplace. Our employee assistance programs offer support for personal and professional challenges, ensuring you have access to resources to navigate life\'s complexities.', 'Banking & Financial Services', 'Credit', '../Company/logo/ee4dce1061f3f616224767ad58cb2fc751b8d2dc (8).jpeg', '../Company/covers/a868bcb8fbb284f4e8301904535744d488ea93c1 (7).jpeg', 0),
(11, 'Senior / Software Engineer (C#, .net ) (Ipoh)', 'Entry Level', '1 Year', '3000', '3000', 'This = what you bring:\r\n\r\nDegree in Computer Science, Information Technology or equivalent.\r\nAt least 3 years of experience in software development.\r\nExperience on web development using C# or VB.Net, .NET or .NET framework, JavaScript (native and/or frameworks), MS SQL Server.\r\nKnowledge of design patterns such as ASP.NET MVC, unit testing, and performing code reviews.\r\nExperience in team collaboration on Azure DevOps will be an added advantage.\r\n ', 9, '2024-02-14 02:38:19', NULL, 18, 238, 1, 57, 'Draft', 'Perak - Ipoh', 'This = the job you are looking for:\r\n\r\nYou take ownership of the quality of all assigned software targets and codes.\r\nJob is fully base at IPOH.\r\nYou design, code and test business software applications and propose architectural decisions within a SCRUM team.\r\nYou troubleshoot and solve software bugs, but also inspire your colleagues and share your knowledge.', 'This = what you get:\r\n\r\nWe work hard and play hard. We believe in the need to balance personal and professional commitments. Our new office will be located at Ipoh,expanding our team to other states. Those SE who are interested to be base at Ipoh, Do apply!\r\n\r\nhybrid working.\r\nmaintain a good work-life balance with flexible working hours.\r\nenroll in physical/virtual training at your pace for continuous learning and career growth.\r\nunlimited access to LinkedIn Learning and company learning platform.\r\nexposure to AGILE Software Development Methodology -SCRUM.\r\nexpose in software engineering that uses modern best practices.\r\nchallenging and impactful work that brings value to customers.\r\nexperience a multicultural working environment.', 'Information & Communication Technology', 'Engineering - Software', '../Company/logo/ee4dce1061f3f616224767ad58cb2fc751b8d2dc (9).jpeg', '../Company/covers/a868bcb8fbb284f4e8301904535744d488ea93c1 (8).jpeg', 0),
(12, 'IT intern', 'Entry Level', 'Not required', '500', '500', 'The role of an Intern IT is designed to provide practical experience and exposure to various facets of Information Technology within an organizational setting. Interns will work closely with IT professionals to assist in the development, implementation, and maintenance of IT systems and infrastructure. This position offers an opportunity for hands-on learning and skill development in areas such as troubleshooting, software installation, network configuration, and technical support. Interns will also have the chance to collaborate on projects, contribute to team discussions, and gain insight into the day-to-day operations of an IT department. This role is ideal for individuals looking to kickstart their career in IT and gain valuable industry experience.\r\n\r\n', 10, '2024-02-13 20:20:59', '2024-03-13 20:20:59', 18, 237, 3, 24, 'Closed', 'Melaka', 'As an Intern IT, responsibilities will include providing technical assistance to end-users, troubleshooting hardware and software issues, and assisting with the installation and configuration of IT systems. Interns will participate in testing and quality assurance processes, documenting procedures and protocols, and collaborating with team members on various IT projects. Additionally, interns may be involved in researching new technologies, assisting in system upgrades, and contributing to the development of IT policies and procedures. This role requires strong communication skills, attention to detail, and a willingness to learn and adapt in a fast-paced environment. Interns will have the opportunity to apply their theoretical knowledge in a practical setting while gaining valuable insights into the IT industry.\r\n\r\n', 'Competitive Salary Packages: While pay isn\'t everything, it\'s essential. We offer competitive salary packages that reflect our commitment to recognizing and rewarding your skills and contributions.\r\n\r\nComprehensive Health Insurance: Your well-being matters to us. We provide comprehensive health insurance plans to ensure you and your family have access to quality healthcare, promoting a healthy work-life balance.', 'Information & Communication Technology', 'Engineering - Network', '../Company/logo/logo.png', '../Company/covers/logo.png', 0),
(13, 'IT intern', 'Entry Level', 'Not required', '500', '500', 'The role of an Intern IT is designed to provide practical experience and exposure to various facets of Information Technology within an organizational setting. Interns will work closely with IT professionals to assist in the development, implementation, and maintenance of IT systems and infrastructure. This position offers an opportunity for hands-on learning and skill development in areas such as troubleshooting, software installation, network configuration, and technical support. Interns will also have the chance to collaborate on projects, contribute to team discussions, and gain insight into the day-to-day operations of an IT department. This role is ideal for individuals looking to kickstart their career in IT and gain valuable industry experience.\r\n\r\n', 10, '2024-02-13 20:38:40', '2024-03-13 20:38:40', 18, 237, 3, 24, 'Active', 'Melaka', 'As an Intern IT, responsibilities will include providing technical assistance to end-users, troubleshooting hardware and software issues, and assisting with the installation and configuration of IT systems. Interns will participate in testing and quality assurance processes, documenting procedures and protocols, and collaborating with team members on various IT projects. Additionally, interns may be involved in researching new technologies, assisting in system upgrades, and contributing to the development of IT policies and procedures. This role requires strong communication skills, attention to detail, and a willingness to learn and adapt in a fast-paced environment. Interns will have the opportunity to apply their theoretical knowledge in a practical setting while gaining valuable insights into the IT industry.\r\n\r\n', 'Competitive Salary Packages: While pay isn\'t everything, it\'s essential. We offer competitive salary packages that reflect our commitment to recognizing and rewarding your skills and contributions.\r\n\r\nComprehensive Health Insurance: Your well-being matters to us. We provide comprehensive health insurance plans to ensure you and your family have access to quality healthcare, promoting a healthy work-life balance.', 'Information & Communication Technology', 'Engineering - Network', '../Company/logo/logo.png', '../Company/covers/logo.png', 0),
(14, 'IT intern', 'Entry Level', 'Not required', '500', '500', 'The role of an Intern IT is designed to provide practical experience and exposure to various facets of Information Technology within an organizational setting. Interns will work closely with IT professionals to assist in the development, implementation, and maintenance of IT systems and infrastructure. This position offers an opportunity for hands-on learning and skill development in areas such as troubleshooting, software installation, network configuration, and technical support. Interns will also have the chance to collaborate on projects, contribute to team discussions, and gain insight into the day-to-day operations of an IT department. This role is ideal for individuals looking to kickstart their career in IT and gain valuable industry experience.\r\n\r\n', 10, '2024-02-13 20:39:00', '2025-02-13 20:39:00', 18, 237, 3, 24, 'Blocked', 'Melaka', 'As an Intern IT, responsibilities will include providing technical assistance to end-users, troubleshooting hardware and software issues, and assisting with the installation and configuration of IT systems. Interns will participate in testing and quality assurance processes, documenting procedures and protocols, and collaborating with team members on various IT projects. Additionally, interns may be involved in researching new technologies, assisting in system upgrades, and contributing to the development of IT policies and procedures. This role requires strong communication skills, attention to detail, and a willingness to learn and adapt in a fast-paced environment. Interns will have the opportunity to apply their theoretical knowledge in a practical setting while gaining valuable insights into the IT industry.\r\n\r\n', 'Competitive Salary Packages: While pay isn\'t everything, it\'s essential. We offer competitive salary packages that reflect our commitment to recognizing and rewarding your skills and contributions.\r\n\r\nComprehensive Health Insurance: Your well-being matters to us. We provide comprehensive health insurance plans to ensure you and your family have access to quality healthcare, promoting a healthy work-life balance.', 'Information & Communication Technology', 'Engineering - Network', '../Company/logo/logo.png', '../Company/covers/logo.png', 0),
(15, 'IT intern', 'Entry Level', 'Not required', '500', '500', 'The role of an Intern IT is designed to provide practical experience and exposure to various facets of Information Technology within an organizational setting. Interns will work closely with IT professionals to assist in the development, implementation, and maintenance of IT systems and infrastructure. This position offers an opportunity for hands-on learning and skill development in areas such as troubleshooting, software installation, network configuration, and technical support. Interns will also have the chance to collaborate on projects, contribute to team discussions, and gain insight into the day-to-day operations of an IT department. This role is ideal for individuals looking to kickstart their career in IT and gain valuable industry experience.\r\n\r\n', 10, '2024-02-14 03:39:39', NULL, 18, 237, 3, 24, 'Draft', 'Melaka', 'As an Intern IT, responsibilities will include providing technical assistance to end-users, troubleshooting hardware and software issues, and assisting with the installation and configuration of IT systems. Interns will participate in testing and quality assurance processes, documenting procedures and protocols, and collaborating with team members on various IT projects. Additionally, interns may be involved in researching new technologies, assisting in system upgrades, and contributing to the development of IT policies and procedures. This role requires strong communication skills, attention to detail, and a willingness to learn and adapt in a fast-paced environment. Interns will have the opportunity to apply their theoretical knowledge in a practical setting while gaining valuable insights into the IT industry.\r\n\r\n', 'Competitive Salary Packages: While pay isn\'t everything, it\'s essential. We offer competitive salary packages that reflect our commitment to recognizing and rewarding your skills and contributions.\r\n\r\nComprehensive Health Insurance: Your well-being matters to us. We provide comprehensive health insurance plans to ensure you and your family have access to quality healthcare, promoting a healthy work-life balance.', 'Information & Communication Technology', 'Engineering - Network', '../Company/logo/logo.png', '../Company/covers/logo.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_post_questions`
--

CREATE TABLE `job_post_questions` (
  `JobPostQuestionID` int(11) NOT NULL,
  `JobID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_post_questions`
--

INSERT INTO `job_post_questions` (`JobPostQuestionID`, `JobID`, `QuestionID`) VALUES
(27, 11, 2),
(28, 12, 2),
(29, 1, 2),
(30, 1, 27),
(31, 2, 2),
(32, 2, 7),
(33, 2, 8),
(34, 2, 39),
(35, 3, 5),
(36, 5, 2),
(37, 6, 2),
(38, 6, 3),
(39, 6, 5),
(40, 6, 7),
(41, 7, 1),
(42, 7, 2),
(43, 7, 8),
(44, 7, 36),
(45, 7, 58),
(46, 9, 2),
(47, 9, 8),
(48, 9, 58),
(50, 13, 2),
(52, 14, 2),
(53, 15, 2),
(55, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_question`
--

CREATE TABLE `job_question` (
  `Job_Question_ID` int(11) NOT NULL,
  `Job_Question_Name` text DEFAULT NULL,
  `Recommended_Question` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_question`
--

INSERT INTO `job_question` (`Job_Question_ID`, `Job_Question_Name`, `Recommended_Question`) VALUES
(1, 'Which of the following statements best describes your right to work in Malaysia?', 1),
(2, 'What\'s your expected monthly basic salary?', 1),
(3, 'How would you rate your English language skills?', 1),
(4, 'Which of the following Microsoft Office products are you experienced with?', 1),
(5, 'Which of the following languages are you fluent in?', 1),
(6, 'How would you rate your Bahasa Malaysia language skills?', 1),
(7, 'Are you willing to undergo a pre-employment background check?', 1),
(8, 'How much notice are you required to give your current employer?', 1),
(9, 'Are you available to work public holidays?', 1),
(10, 'Are you willing to relocate for this role?', 1),
(11, 'What\'s your average typing speed?', 0),
(12, 'What\'s your preferred work type?', 0),
(13, 'What\'s the largest size team you have managed?', 0),
(14, 'What is the maximum weight that you are comfortable and able to lift?', 0),
(15, 'What\'s the highest level of IPMA certification you have completed?', 0),
(16, 'What\'s the highest level of ITIL qualification you have completed?', 0),
(17, 'What\'s the highest level of Cisco voice certification that you have completed?', 0),
(18, 'What\'s the highest level of Cisco wireless certification that you have completed?', 0),
(19, 'What\'s the highest level of Cisco collaboration certification that you have completed?', 0),
(20, 'Which of the following IIA auditing qualifications have you obtained?', 0),
(21, 'Which of the following sonography tests are you experienced with?', 0),
(22, 'Which of the following radiology tests are you experienced with?', 0),
(23, 'Which of the following accounting software are you experienced with?', 0),
(24, 'Which of the following Linux distributions are you familiar with?', 0),
(25, 'Which of the following Adobe products are you experienced with?', 0),
(26, 'Which of the following programming languages are you experienced in?', 0),
(27, 'Which of the following accounting tasks are you familiar with?', 0),
(28, 'Which of the following drilling methods are you experienced with?', 0),
(29, 'How far are you willing to travel to work?', 0),
(30, 'How many years\' experience do you have as a welder?', 0),
(31, 'How many years\' experience do you have as a cook?', 0),
(32, 'How many years\' experience do you have as a boilermaker?', 0),
(33, 'How many years\' experience do you have as a housekeeper?', 0),
(34, 'How many years\' experience do you have as a fabricator?', 0),
(35, 'How many years\' experience do you have as a waitperson?', 0),
(36, 'How would you rate your Mandarin language skills?', 0),
(37, 'How would you rate your Japanese language skills?', 0),
(38, 'How would you rate your Cantonese language skills?', 0),
(39, 'Do you have fabrication experience?', 0),
(40, 'Do you have reconciliations experience?', 0),
(41, 'Do you have purchasing experience?', 0),
(42, 'Do you have phlebotomy experience?', 0),
(43, 'Do you have secretarial experience?', 0),
(44, 'Do you have collections experience?', 0),
(45, 'Do you have professional floristry experience?', 0),
(46, 'Do you have freight forwarding experience?', 0),
(47, 'Do you have Plate profiling experience?', 0),
(48, 'Do you have workover drilling experience?', 0),
(49, 'Are you currently studying?', 0),
(50, 'Are you available for shift work?', 0),
(51, 'Are you available to work split shifts?', 0),
(52, 'Are you available to work school holidays?', 0),
(53, 'Are you licenced to drive a manual vehicle?', 0),
(54, 'Are you available to live on-site for the duration of this role?', 0),
(55, 'Are you available for short term contract work?', 0),
(56, 'Are you experienced with copy writing and content creation?', 0),
(57, 'Are you available to work outside your usual hours when required? (eg. weekends, evenings, public holidays)', 0),
(58, 'Are you willing to travel for this role when required?', 0),
(59, 'Are you available to provide on call support when required?', 0),
(60, 'Do you have the ability to work from home when required?', 0),
(61, 'Do you have an Amazon Web Services Solutions Architect certification?', 0),
(62, 'Do you have a Scaled Agile Framework (SAFe) Scrum Master certification?', 0),
(63, 'What\'s the highest level of Institute of Brewing & Distilling (IBD) qualification that you\'ve completed?', 0),
(64, 'Which of the following sized restaurants have you worked at?', 0),
(65, 'Which of the following statements best describes your Covid-19 vaccination status?', 0),
(66, 'Do you have experience working on residential construction projects?', 0),
(67, 'Have you worked in a role where you applied vehicle wraps?', 0),
(68, 'Have you worked in a role where you were responsible for vendor management?', 0),
(69, 'Have you worked in a role where you were responsible for brand planning?', 0),
(70, 'Have you worked in a role where you were responsible for yield management?', 0),
(71, 'Have you worked in a role where you installed satellites and terrestrial receivers?', 0),
(72, 'Have you worked in a role where you were responsible for stock control?', 0),
(73, 'Have you worked in a role where you used software design patterns?', 0),
(74, 'Have you worked in a role where you had to analyse and measure the success of a product?', 0),
(75, 'Have you worked in a role where you had team and or line management responsibility?', 0),
(76, 'Have you worked in a role where you carried out through-seam blasting?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_question_option`
--

CREATE TABLE `job_question_option` (
  `Job_Question_Option_ID` int(11) NOT NULL,
  `Job_Question_Option_Name` text DEFAULT NULL,
  `Job_Question_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_question_option`
--

INSERT INTO `job_question_option` (`Job_Question_Option_ID`, `Job_Question_Option_Name`, `Job_Question_ID`) VALUES
(1, 'I\'m a Malaysian citizen/permanent resident', 1),
(2, 'I have a Long Term Visit Pass with permission to work', 1),
(3, 'I have a Residence Pass-Talent (RP-T) from Talent Corp', 1),
(4, 'I have a visa that lets me stay in Malaysia, but not work', 1),
(5, 'I require sponsorship or a current job offer to work for a new employer (e.g. Employment Pass, Temporary Employment Pass)', 1),
(6, 'RM 1K to RM 2K', 2),
(7, 'RM 2K to RM 3K', 2),
(8, 'RM 3K to RM 4K', 2),
(9, 'RM 4K to RM 5K', 2),
(10, 'RM 5K to RM 6K', 2),
(11, 'RM 6K to RM 7K', 2),
(12, 'RM 7K to RM 8K', 2),
(13, 'RM 8K to RM 9K', 2),
(14, 'RM 9K to RM 10K', 2),
(15, 'RM 10K to RM 12K', 2),
(16, 'RM 12K to RM 15K', 2),
(17, 'RM 15K to RM 20K', 2),
(18, 'RM 20K to RM 30K', 2),
(19, 'RM 30K to RM 40K', 2),
(20, 'RM 40K to RM 50K or more', 2),
(21, 'Speaks proficiently in a professional setting', 3),
(22, 'Writes proficiently in a professional setting', 3),
(23, 'Limited proficiency', 3),
(24, 'Word', 4),
(25, 'Excel', 4),
(26, 'PowerPoint', 4),
(27, 'Outlook', 4),
(28, 'Access', 4),
(29, 'OneNote', 4),
(30, 'Publisher', 4),
(31, 'None of these', 4),
(32, 'English', 5),
(33, 'Bahasa Malaysia', 5),
(34, 'Mandarin', 5),
(35, 'Cantonese', 5),
(36, 'Bahasa Indonesia', 5),
(37, 'Vietnamese', 5),
(38, 'Thai', 5),
(39, 'Filipino', 5),
(40, 'Japanese', 5),
(41, 'Korean', 5),
(42, 'Other (language not listed)', 5),
(43, 'Speaks proficiently in a professional setting', 6),
(44, 'Writes proficiently in a professional setting', 6),
(45, 'Limited proficiency', 6),
(46, 'Yes', 7),
(47, 'No', 7),
(48, 'None, I\'m ready to go now', 8),
(49, 'Less than 2 weeks', 8),
(50, '1 month', 8),
(51, '2 months', 8),
(52, '3 months', 8),
(53, 'More than 3 months', 8),
(54, 'Yes', 9),
(55, 'No', 9),
(56, 'Yes', 10),
(57, 'No', 10),
(58, 'Less than 35 wpm', 11),
(59, '40 wpm', 11),
(60, '45 wpm', 11),
(61, '50 wpm', 11),
(62, '55 wpm', 11),
(63, '60 wpm', 11),
(64, '70 wpm', 11),
(65, '80 wpm', 11),
(66, '90 wpm', 11),
(67, '100+ wpm', 11),
(68, 'Permanent - full time', 12),
(69, 'Permanent - part time', 12),
(70, 'Contract - full time', 12),
(71, 'Contract - part time', 12),
(72, 'Casual', 12),
(73, 'No experience', 13),
(74, 'Less than 5', 13),
(75, '5 - 10', 13),
(76, '11 - 20', 13),
(77, '21 - 30', 13),
(78, '31 - 40', 13),
(79, '40+', 13),
(80, 'I am unable to lift heavy weights', 14),
(81, 'Up to 10kg', 14),
(82, 'Up to 15kg', 14),
(83, 'Up to 20kg', 14),
(84, 'Up to 25kg', 14),
(85, 'Up to 30kg', 14),
(86, 'Certified Project Management Associate (level D)', 15),
(87, 'Certified Project Manager (level C)', 15),
(88, 'Certified Senior Project Manager (level B)', 15),
(89, 'Certified Project Director (level A)', 15),
(90, 'No such certification', 15),
(91, 'Foundation level', 16),
(92, 'Practitioner level', 16),
(93, 'Intermediate level', 16),
(94, 'Expert level', 16),
(95, 'Master level', 16),
(96, 'No such qualification', 16),
(97, 'Cisco Certified Entry Networking Technician (CCENT)', 17),
(98, 'Cisco Certified Network Associate (CCNA)', 17),
(99, 'Cisco Certified Network Professional (CCNP)', 17),
(100, 'No such certification', 17),
(101, 'Cisco Certified Entry Networking Technician (CCENT)', 18),
(102, 'Cisco Certified Network Associate (CCNA)', 18),
(103, 'Cisco Certified Network Professional (CCNP)', 18),
(104, 'Cisco Certified Internetwork Expert (CCIE)', 18),
(105, 'No such certification', 18),
(106, 'Cisco Certified Network Associate (CCNA)', 19),
(107, 'Cisco Certified Network Professional (CCNP)', 19),
(108, 'Cisco Certified Internetwork Expert (CCIE)', 19),
(109, 'No such certification', 19),
(110, 'Certified Internal Auditor (CIA)', 20),
(111, 'Certification in Control Self-Assessment (CCSA)', 20),
(112, 'Certified Financial Services Auditor (CFSA)', 20),
(113, 'Certified Government Auditing Professional (CGAP)', 20),
(114, 'Certification in Risk Management Assurance (CRMA)', 20),
(115, 'Certified Process Safety Auditor (CPSA)', 20),
(116, 'Certified Professional Environmental Auditor (CPEA)', 20),
(117, 'Qualification in Internal Audit Leadership (QIAL)', 20),
(118, 'I have an auditing qualification which isn\'t listed', 20),
(119, 'I don\'t have a qualification in auditing', 20),
(120, 'Muscular skeletal', 21),
(121, 'Echocardiography', 21),
(122, 'Vascular', 21),
(123, 'Neurosonology', 21),
(124, 'Obstetrics and Gynaecology', 21),
(125, 'General', 21),
(126, 'None of these', 21),
(127, 'MRI', 22),
(128, 'CT / CAT', 22),
(129, 'X-Ray', 22),
(130, 'Ultrasound', 22),
(131, 'PET', 22),
(132, 'Mammography', 22),
(133, 'None of these', 22),
(134, 'MYOB', 23),
(135, 'Xero', 23),
(136, 'QuickBooks', 23),
(137, 'Microsoft Dynamics', 23),
(138, 'PeopleSoft', 23),
(139, 'Pronto', 23),
(140, 'Sage', 23),
(141, 'Astute Payroll', 23),
(142, 'Pastel', 23),
(143, 'Quicken', 23),
(144, 'Hyperion', 23),
(145, 'Caseware', 23),
(146, 'SQL', 23),
(147, 'None of these', 23),
(148, 'Red Hat (RHEL)', 24),
(149, 'Ubuntu', 24),
(150, 'CentOS', 24),
(151, 'SUSE', 24),
(152, 'Debian', 24),
(153, 'Fedora', 24),
(154, 'OpenWRT', 24),
(155, 'Vyatta', 24),
(156, 'Scientific Linux', 24),
(157, 'SME Server', 24),
(158, 'CoreOS', 24),
(159, 'Chromium', 24),
(160, 'Pentoo', 24),
(161, 'None of these', 24),
(162, 'Photoshop', 25),
(163, 'Illustrator', 25),
(164, 'InDesign', 25),
(165, 'Acrobat', 25),
(166, 'Flash', 25),
(167, 'Dreamweaver', 25),
(168, 'After Effects', 25),
(169, 'Audition', 25),
(170, 'Fireworks', 25),
(171, 'Premiere Pro', 25),
(172, 'Bridge', 25),
(173, 'None of these', 25),
(174, 'HTML', 26),
(175, 'CSS', 26),
(176, 'JavaScript', 26),
(177, 'Java', 26),
(178, 'C', 26),
(179, 'C#', 26),
(180, 'C++', 26),
(181, 'Objective-C', 26),
(182, 'Python', 26),
(183, 'Ruby', 26),
(184, 'PHP', 26),
(185, 'Swift', 26),
(186, 'Visual Basic', 26),
(187, '.NET', 26),
(188, 'None of these', 26),
(189, 'Accounts payable', 27),
(190, 'Accounts receivable', 27),
(191, 'General Ledger', 27),
(192, 'None of these', 27),
(193, 'Auger', 28),
(194, 'Percussion Rotary Air Blast (RAB)', 28),
(195, 'Reverse Circulation (RC)', 28),
(196, 'Air Core', 28),
(197, 'Diamond Core', 28),
(198, 'Sonic', 28),
(199, 'Mud Rotary', 28),
(200, 'Geotechnical', 28),
(201, 'None of these', 28),
(202, '5KM', 29),
(203, '10KM', 29),
(204, '15KM', 29),
(205, '20KM', 29),
(206, '40KM', 29),
(207, '60KM', 29),
(208, '80KM+', 29),
(209, 'No experience', 30),
(210, 'Less than 1 year', 30),
(211, '1 year', 30),
(212, '2 years', 30),
(213, '3 years', 30),
(214, '4 years', 30),
(215, '5 years', 30),
(216, 'More than 5 years', 30),
(217, 'No experience', 31),
(218, 'Less than 1 year', 31),
(219, '1 year', 31),
(220, '2 years', 31),
(221, '3 years', 31),
(222, '4 years', 31),
(223, '5 years', 31),
(224, 'More than 5 years', 31),
(225, 'No experience', 32),
(226, 'Less than 1 year', 32),
(227, '1 year', 32),
(228, '2 years', 32),
(229, '3 years', 32),
(230, '4 years', 32),
(231, '5 years', 32),
(232, 'More than 5 years', 32),
(233, 'No experience', 33),
(234, 'Less than 1 year', 33),
(235, '1 year', 33),
(236, '2 years', 33),
(237, '3 years', 33),
(238, '4 years', 33),
(239, '5 years', 33),
(240, 'More than 5 years', 33),
(241, 'No experience', 34),
(242, 'Less than 1 year', 34),
(243, '1 year', 34),
(244, '2 years', 34),
(245, '3 years', 34),
(246, '4 years', 34),
(247, '5 years', 34),
(248, 'More than 5 years', 34),
(249, 'No experience', 35),
(250, 'Less than 1 year', 35),
(251, '1 year', 35),
(252, '2 years', 35),
(253, '3 years', 35),
(254, '4 years', 35),
(255, '5 years', 35),
(256, 'More than 5 years', 35),
(257, 'Speaks proficiently in a professional setting', 36),
(258, 'Writes proficiently in a professional setting', 36),
(259, 'Limited proficiency', 36),
(260, 'Speaks proficiently in a professional setting', 37),
(261, 'Writes proficiently in a professional setting', 37),
(262, 'Limited proficiency', 37),
(263, 'Speaks proficiently in a professional setting', 38),
(264, 'Writes proficiently in a professional setting', 38),
(265, 'Limited proficiency', 38),
(266, 'Yes', 39),
(267, 'No', 39),
(268, 'Yes', 40),
(269, 'No', 40),
(270, 'Yes', 41),
(271, 'No', 41),
(272, 'Yes', 42),
(273, 'No', 42),
(274, 'Yes', 43),
(275, 'No', 43),
(276, 'Yes', 44),
(277, 'No', 44),
(278, 'Yes', 45),
(279, 'No', 45),
(280, 'Yes', 46),
(281, 'No', 46),
(282, 'Yes', 47),
(283, 'No', 47),
(284, 'Yes', 48),
(285, 'No', 48),
(286, 'Yes, full time', 49),
(287, 'Yes, part time', 49),
(288, 'No', 49),
(289, 'No, but I intend to start in the next 12 months', 49),
(290, 'Yes', 50),
(291, 'No', 50),
(292, 'Yes', 51),
(293, 'No', 51),
(294, 'Yes', 52),
(295, 'No', 52),
(296, 'Yes', 53),
(297, 'No', 53),
(298, 'Yes', 54),
(299, 'No', 54),
(300, 'Yes', 55),
(301, 'No', 55),
(302, 'Yes', 56),
(303, 'No', 56),
(304, 'Yes', 57),
(305, 'No', 57),
(306, 'Yes, domestic travel', 58),
(307, 'Yes, international travel', 58),
(308, 'No', 58),
(309, 'Yes', 59),
(310, 'No', 59),
(311, 'Yes', 60),
(312, 'No', 60),
(313, 'Yes, I have an Associate certification', 61),
(314, 'Yes, I have a Professional certification', 61),
(315, 'No such certification', 61),
(316, 'Yes, I have a Scrum Master certification', 62),
(317, 'Yes, I have an Advanced Scrum Master certification', 62),
(318, 'No such certification', 62),
(319, 'Fundamentals course', 63),
(320, 'General cerificate', 63),
(321, 'Diploma level', 63),
(322, 'Masters modules', 63),
(323, 'I don\'t have an IBD qualification', 63),
(324, 'Less than 50 seats', 64),
(325, '50 - 100 seats', 64),
(326, '100 - 200 seats', 64),
(327, '200 - 300 seats', 64),
(328, 'More than 300 seats', 64),
(329, 'I don\'t have restaurant experience', 64),
(330, 'I\'m fully vaccinated', 65),
(331, 'I have a medical exemption', 65),
(332, 'I\'m partially vaccinated', 65),
(333, 'I\'m planning to be vaccinated as soon as possible', 65),
(334, 'I haven\'t been vaccinated', 65),
(335, 'I\'d prefer not to say', 65),
(336, 'Yes, I\'ve worked on low rise construction projects', 66),
(337, 'Yes, I\'ve worked on mid rise construction projects', 66),
(338, 'Yes, I\'ve worked on high rise construction projects', 66),
(339, 'I don\'t have experience working on residential construction projects', 66),
(340, 'Yes', 67),
(341, 'No', 67),
(342, 'Yes', 68),
(343, 'No', 68),
(344, 'Yes', 69),
(345, 'No', 69),
(346, 'Yes', 70),
(347, 'No', 70),
(348, 'Yes', 71),
(349, 'No', 71),
(350, 'Yes', 72),
(351, 'No', 72),
(352, 'Yes', 73),
(353, 'No', 73),
(354, 'Yes', 74),
(355, 'No', 74),
(356, 'Yes', 75),
(357, 'No', 75),
(358, 'Yes', 76),
(359, 'No', 76);

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

CREATE TABLE `main_category` (
  `Main_Category_ID` int(11) NOT NULL,
  `Main_Category_Name` text NOT NULL,
  `MainCategory_isDeleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`Main_Category_ID`, `Main_Category_Name`, `MainCategory_isDeleted`) VALUES
(1, 'Accounting', 0),
(2, 'Administration & Office Support', 0),
(3, 'Advertising, Arts & Media', 0),
(4, 'Banking & Financial Services', 0),
(5, 'Call Centre & Customer Service', 0),
(6, 'CEO & General Management', 0),
(7, 'Community Services & Decelopment', 0),
(8, 'Construction', 0),
(9, 'Consulting & Strategy', 0),
(10, 'Design & Architecture', 0),
(11, 'Education & Training', 0),
(12, 'Engineering', 0),
(13, 'Farming, Animals & Conservation', 0),
(14, 'Government & Defence', 0),
(15, 'Healthcare & Medical', 0),
(16, 'Hospitality & Tourism', 0),
(17, 'Human Resources & Recruitment', 0),
(18, 'Information & Communication Technology', 0),
(19, 'Insurance & Superannuation', 0),
(20, 'Legal', 0),
(21, 'Manufacturing, Transport & Logistics', 0),
(22, 'Marketing & Communications', 0),
(23, 'Mining, Resources & Energy', 0),
(24, 'Real Estate & Property', 0),
(25, 'Retail & Consumer Products', 0),
(26, 'Sales', 0),
(27, 'Science & Technology', 0),
(28, 'Self Employment', 0),
(29, 'Sport & Recreation', 0),
(30, 'Trades & Services', 0),
(31, '3D modeler', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `CompanyID` int(11) DEFAULT NULL,
  `JobID` int(11) DEFAULT NULL,
  `CompanyName` text NOT NULL,
  `CompanyPhone` text NOT NULL,
  `ContactPerson` text NOT NULL,
  `CreditCard_Type` text DEFAULT NULL,
  `CreditCard_Number` varchar(19) DEFAULT NULL,
  `CreditCard_Holder` text DEFAULT NULL,
  `CreditCard_ExpMonth` varchar(2) DEFAULT NULL,
  `CreditCard_ExpYear` varchar(4) DEFAULT NULL,
  `CreditCard_CVV` int(11) DEFAULT NULL,
  `Payment_Duration` int(11) DEFAULT NULL,
  `Payment_Amount` decimal(10,2) DEFAULT NULL,
  `Payment_Receipt` varchar(255) DEFAULT NULL,
  `Payment_Date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `CompanyID`, `JobID`, `CompanyName`, `CompanyPhone`, `ContactPerson`, `CreditCard_Type`, `CreditCard_Number`, `CreditCard_Holder`, `CreditCard_ExpMonth`, `CreditCard_ExpYear`, `CreditCard_CVV`, `Payment_Duration`, `Payment_Amount`, `Payment_Receipt`, `Payment_Date`) VALUES
(1, 10, 12, 'MMU Melaka', '1110614689', 'Jie Lun', 'mastercard', '5167 8909 8543 3456', 'JieLun', '02', '2024', 611, 1, '103.88', '../Company/receipt/Job Post 12 Receipt.pdf', '2024-02-14 03:20:59'),
(2, 1, 1, 'Sunway Berhad\n', '183862559', 'John Doe', 'mastercard', '5167 8909 8543 3451', 'John Doe', '04', '2024', 655, 2, '207.76', '../Company/receipt/Job Post 1 Receipt.pdf', '2024-02-14 03:29:05'),
(3, 2, 2, 'Kraiburg Tpe Technology', '123348970', 'Song You', 'mastercard', '5167 8909 8543 3452', 'Song You', '04', '2025', 652, 2, '207.76', '../Company/receipt/Job Post 2 Receipt.pdf', '2024-02-14 03:33:10'),
(4, 3, 3, 'Leaderland Era Sdn Bhd\r\n', '113359087', 'Wei Wen', 'mastercard', '5167 8909 8543 3453', 'Wei Wen', '04', '2025', 654, 3, '311.64', '../Company/receipt/Job Post 3 Receipt.pdf', '2024-02-14 03:33:47'),
(5, 4, 4, 'MANTASOFT SDN. BHD.', '163468787', 'Jia Fu ', 'mastercard', '5167 8909 8543 3454', 'Jia Fu ', '06', '2025', 657, 4, '415.52', '../Company/receipt/Job Post 4 Receipt.pdf', '2024-02-14 03:34:17'),
(6, 5, 5, 'Global Educare\r\n', '110097465', 'Wei Zuen', 'mastercard', '5167 8909 8543 3455', 'Wei Zuen', '06', '2025', 887, 5, '519.40', '../Company/receipt/Job Post 5 Receipt.pdf', '2024-02-14 03:34:43'),
(7, 6, 6, 'Samsung Malaysia Electronics (SME) Sdn Bhd', '12658990', 'Guang Yong', 'mastercard', '5167 8909 8543 3458', 'Guang Yong', '07', '2025', 445, 12, '1246.56', '../Company/receipt/Job Post 6 Receipt.pdf', '2024-02-14 03:35:07'),
(8, 7, 7, 'KIDE INTERNATIONAL SDN BHD', '167768080', 'Kah Hei', 'mastercard', '5267 8909 8543 3451', 'Kah Hei', '07', '2025', 345, 11, '1142.68', '../Company/receipt/Job Post 7 Receipt.pdf', '2024-02-14 03:36:04'),
(9, 8, 9, 'Chemopharm3918', '1190683435', 'Zheng Yu', 'mastercard', '5347 8909 8543 3451', 'Zheng Yu', '09', '2025', 145, 10, '1038.80', '../Company/receipt/Job Post 9 Receipt.pdf', '2024-02-14 03:36:31'),
(10, 11, 10, 'Bank Islam\r\n', '112345345', 'Goei Jin', 'mastercard', '5547 8909 8543 3495', 'Goei Jin', '01', '2026', 228, 9, '934.92', '../Company/receipt/Job Post 10 Receipt.pdf', '2024-02-14 03:37:10'),
(11, 10, 13, 'MMU Melaka', '1110614689', 'Jie Lun', 'mastercard', '5167 8909 8543 3456', 'JieLun', '02', '2024', 611, 1, '103.88', '../Company/receipt/Job Post 13 Receipt.pdf', '2024-02-14 03:38:40'),
(12, 10, 14, 'MMU Melaka', '1110614689', 'Jie Lun', 'mastercard', '5167 8909 8543 3456', 'JieLun', '02', '2024', 611, 12, '1246.56', '../Company/receipt/Job Post 14 Receipt.pdf', '2024-02-14 03:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `save_job`
--

CREATE TABLE `save_job` (
  `Save_JobID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Job_Post_ID` int(11) DEFAULT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `Sub_Category_ID` int(11) NOT NULL,
  `Sub_Category_Name` text DEFAULT NULL,
  `Main_Category_ID` int(11) DEFAULT NULL,
  `SubCategory_isDeleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`Sub_Category_ID`, `Sub_Category_Name`, `Main_Category_ID`, `SubCategory_isDeleted`) VALUES
(1, 'Accounts Officers/Clerks', 1, 1),
(2, 'Accounts Payable', 1, 0),
(3, 'Accounts Receivable/Credit Control', 1, 0),
(4, 'Analysis & Reporting', 1, 0),
(5, 'Assistant Accountants', 1, 0),
(6, 'Audit - External', 1, 0),
(7, 'Audit - Internal', 1, 0),
(8, 'Bookkeeping & Small Practice Accounting', 1, 0),
(9, 'Business Services & Corporate Advisory', 1, 0),
(10, 'Company Secretaries', 1, 0),
(11, 'Compliance & Risk', 1, 0),
(12, 'Cost Accounting', 1, 0),
(13, 'Financial Accounting & Reporting', 1, 0),
(14, 'Financial Managers & Controllers', 1, 0),
(15, 'Forensic Accounting & Investigation', 1, 0),
(16, 'Insolvency & Corporate Recovery', 1, 0),
(17, 'Inventory & Fixed Assets', 1, 0),
(18, 'Management', 1, 0),
(19, 'Management Accounting & Budgeting', 1, 0),
(20, 'Payroll', 1, 0),
(21, 'Strategy & Planning', 1, 0),
(22, 'Systems Accounting & IT Audit', 1, 0),
(23, 'Taxation', 1, 0),
(24, 'Treasury', 1, 0),
(25, 'Other', 1, 0),
(26, 'Administrative Assistants', 2, 0),
(27, 'Client & Sales Administration', 2, 0),
(28, 'Contracts Administration', 2, 0),
(29, 'Data Entry & Word Processing', 2, 0),
(30, 'Office Management', 2, 0),
(31, 'PA, EA & Secretarial', 2, 0),
(32, 'Receptionists', 2, 0),
(33, 'Records Management & Document Control', 2, 0),
(34, 'Other', 2, 0),
(36, 'Agency Account Management', 3, 0),
(37, 'Art Direction', 3, 0),
(38, 'Editing & Publishing', 3, 0),
(39, 'Event Management', 3, 0),
(40, 'Journalism & Writing', 3, 0),
(41, 'Management', 3, 0),
(42, 'Media Strategy, Planning & Buying', 3, 0),
(43, 'Performing Arts', 3, 0),
(44, 'Photography', 3, 0),
(45, 'Programming & Production', 3, 0),
(46, 'Promotions', 3, 0),
(47, 'Other', 3, 0),
(48, 'Account & Relationship Management', 4, 0),
(49, 'Analysis & Reporting', 4, 0),
(50, 'Banking - Business', 4, 0),
(51, 'Banking - Corporate & Institutional', 4, 0),
(52, 'Banking - Retail/Branch', 4, 0),
(53, 'Client Services', 4, 0),
(54, 'Compliance & Risk', 4, 0),
(55, 'Corporate Finance & Investment Banking', 4, 0),
(56, 'Credit', 4, 0),
(57, 'Financial Planning', 4, 0),
(58, 'Funds Management', 4, 0),
(59, 'Management', 4, 0),
(60, 'Mortgages', 4, 0),
(61, 'Settlements', 4, 0),
(62, 'Stockbroking & Trading', 4, 0),
(63, 'Treasury', 4, 0),
(64, 'Other', 4, 0),
(65, 'Collections', NULL, 0),
(66, 'Customer Service - Call Centre', NULL, 0),
(67, 'Customer Service - Customer Facing', 5, 0),
(68, 'Management & Support', 5, 0),
(69, 'Sales - Inbound', 5, 0),
(70, 'Sales - Outbound', 5, 0),
(71, 'Supervisors/Team Leaders', 5, 0),
(72, 'Other', 5, 0),
(73, 'Board Appointments', 6, 0),
(74, 'CEO', 6, 0),
(75, 'COO & MD', 6, 0),
(76, 'General/Business Unit Manager', 6, 0),
(77, 'Other', 6, 0),
(78, 'Aged & Disability Support', 7, 0),
(79, 'Child Welfare, Youth & Family Services', 7, 0),
(80, 'Community Development', 7, 0),
(81, 'Employment Services', 7, 0),
(82, 'Fundraising', 7, 0),
(83, 'Housing & Homelessness Services', 7, 0),
(84, 'Indigenous & Multicultural Services', 7, 0),
(85, 'Management', 7, 0),
(86, 'Volunteer Coordination & Support', 7, 0),
(87, 'Other', 7, 0),
(88, 'Contracts Management', 8, 0),
(89, 'Estimating', 8, 0),
(90, 'Foreperson/Supervisors', 8, 0),
(91, 'Health, Safety & Environment', 8, 0),
(92, 'Management', 8, 0),
(93, 'Planning & Scheduling', 8, 0),
(94, 'Plant & Machinery Operators', 8, 0),
(95, 'Project Management', 8, 0),
(96, 'Quality Assurance & Control', 8, 0),
(97, 'Surveying', 8, 0),
(98, 'Other', 8, 0),
(99, 'Analysts', 9, 0),
(100, 'Corporate Development', 9, 0),
(101, 'Environment & Sustainability Consulting', 9, 0),
(102, 'Management & Change Consulting', 9, 0),
(103, 'Policy', 9, 0),
(104, 'Strategy & Planning', 9, 0),
(105, 'Other', 9, 0),
(106, 'Architectural Drafting', 10, 0),
(107, 'Architecture', 10, 0),
(108, 'Fashion & Textile Design', 10, 0),
(109, 'Graphic Design', 10, 0),
(110, 'Illustration & Animation', 10, 0),
(111, 'Industrial Design', 10, 0),
(112, 'Interior Design', 10, 0),
(113, 'Landscape Architecture', 10, 0),
(114, 'Urban Design & Planning', 10, 0),
(115, 'Web & Interaction Design', 10, 0),
(116, 'Other', 10, 0),
(117, 'Childcare & Outside School Hours Care', 11, 0),
(118, 'Library Services & Information Management', 11, 0),
(119, 'Management - Schools', 11, 0),
(120, 'Management - Universities', 11, 0),
(121, 'Management - Vocational', 11, 0),
(122, 'Research & Fellowships', 11, 0),
(123, 'Student Services', 11, 0),
(124, 'Teaching - Early Childhood', 11, 0),
(125, 'Teaching - Primary', 11, 0),
(126, 'Teaching - Secondary', 11, 0),
(127, 'Teaching - Tertiary', 11, 0),
(128, 'Teaching - Vocational', 11, 0),
(129, 'Teaching Aides & Special Needs', 11, 0),
(130, 'Tutoring', 11, 0),
(131, 'Workplace Training & Assessment', 11, 0),
(132, 'Other', 11, 0),
(133, 'Aerospace Engineering', 12, 0),
(134, 'Automotive Engineering', 12, 0),
(135, 'Building Services Engineering', 12, 0),
(136, 'Chemical Engineering', 12, 0),
(137, 'Civil/Structural Engineering', 12, 0),
(138, 'Electrical/Electronic Engineering', 12, 0),
(139, 'Engineering Drafting', 12, 0),
(140, 'Environmental Engineering', 12, 0),
(141, 'Field Engineering', 12, 0),
(142, 'Industrial Engineering', 12, 0),
(143, 'Maintenance', 12, 0),
(144, 'Management', 12, 0),
(145, 'Materials Handling Engineering', 12, 0),
(146, 'Mechanical Engineering', 12, 0),
(147, 'Process Engineering', 12, 0),
(148, 'Project Engineering', 12, 0),
(149, 'Project Management', 12, 0),
(150, 'Supervisors', 12, 0),
(151, 'Systems Engineering', 12, 0),
(152, 'Water & Waste Engineering', 12, 0),
(153, 'Other', 12, 0),
(154, 'Agronomy & Farm Services', 13, 0),
(155, 'Conservation, Parks & Wildlife', 13, 0),
(156, 'Farm Labour', 13, 0),
(157, 'Farm Management', 13, 0),
(158, 'Fishing & Aquaculture', 13, 0),
(159, 'Horticulture', 13, 0),
(160, 'Veterinary Services & Animal Welfare', 13, 0),
(161, 'Winery & Viticulture', 13, 0),
(162, 'Other', 13, 0),
(163, 'Air Force', 14, 0),
(164, 'Army', 14, 0),
(165, 'Emergency Services', 14, 0),
(166, 'Government - Federal', 14, 0),
(167, 'Government - Local', 14, 0),
(168, 'Government - State', 14, 0),
(169, 'Navy', 14, 0),
(170, 'Police & Corrections', 14, 0),
(171, 'Policy, Planning & Regulation', 14, 0),
(172, 'Other', 14, 0),
(173, 'Ambulance/Paramedics', 15, 0),
(174, 'Chiropractic & Osteopathic', 15, 0),
(175, 'Clinical/Medical Research', 15, 0),
(176, 'Dental', 15, 0),
(177, 'Dieticians', 15, 0),
(178, 'Environmental Services', 15, 0),
(179, 'General Practitioners', 15, 0),
(180, 'Management', 15, 0),
(181, 'Medical Administration', 15, 0),
(182, 'Medical Imaging', 15, 0),
(183, 'Medical Specialists', 15, 0),
(184, 'Natural Therapies & Alternative Medicine', 15, 0),
(185, 'Nursing - A&E, Critical Care & ICU', 15, 0),
(186, 'Nursing - Aged Care', 15, 0),
(187, 'Nursing - Community, Maternal & Child Health', 15, 0),
(188, 'Nursing - Educators & Facilitators', 15, 0),
(189, 'Nursing - General Medical & Surgical', 15, 0),
(190, 'Nursing - High Acuity', 15, 0),
(191, 'Nursing - Management', 15, 0),
(192, 'Nursing - Midwifery, Neo-Natal, SCN & NICU', 15, 0),
(193, 'Nursing - Paediatric & PICU', 15, 0),
(194, 'Nursing - Psych, Forensic & Correctional Health', 15, 0),
(195, 'Nursing - Theatre & Recovery', 15, 0),
(196, 'Optical', 15, 0),
(197, 'Pathology', 15, 0),
(198, 'Pharmaceuticals & Medical Devices', 15, 0),
(199, 'Pharmacy', 15, 0),
(200, 'Physiotherapy, OT & Rehabilitation', 15, 0),
(201, 'Psychology, Counselling & Social Work', 15, 0),
(202, 'Residents & Registrars', 15, 0),
(203, 'Sales', 15, 0),
(204, 'Speech Therapy', 15, 0),
(205, 'Other', 15, 0),
(206, 'Airlines', 16, 0),
(207, 'Bar & Beverage Staff', 16, 0),
(208, 'Chefs/Cooks', 16, 0),
(209, 'Front Office & Guest Services', 16, 0),
(210, 'Gaming', 16, 0),
(211, 'Housekeeping', 16, 0),
(212, 'Kitchen & Sandwich Hands', 16, 0),
(213, 'Management', 16, 0),
(214, 'Reservations', 16, 0),
(215, 'Tour Guides', 16, 0),
(216, 'Travel Agents/Consultants', 16, 0),
(217, 'Waiting Staff', 16, 0),
(218, 'Other', 16, 0),
(219, 'Consulting & Generalist HR', NULL, 0),
(220, 'Industrial & Employee Relations', 17, 0),
(221, 'Management - Agency', 17, 0),
(222, 'Management - Internal', 17, 0),
(223, 'Occupational Health & Safety', 17, 0),
(224, 'Organisational Development', 17, 0),
(225, 'Recruitment - Agency', 17, 0),
(226, 'Recruitment - Internal', 17, 0),
(227, 'Remuneration & Benefits', 17, 0),
(228, 'Training & Development', 17, 0),
(229, 'Other', 17, 0),
(230, 'Architects', 18, 0),
(231, 'Business/Systems Analysts', 18, 0),
(232, 'Computer Operators', 18, 0),
(233, 'Consultants', 18, 0),
(234, 'Database Development & Administration', 18, 0),
(235, 'Developers/Programmers', 18, 0),
(236, 'Engineering - Hardware', 18, 0),
(237, 'Engineering - Network', 18, 0),
(238, 'Engineering - Software', 18, 0),
(239, 'Help Desk & IT Support', 18, 0),
(240, 'Management', 18, 0),
(241, 'Networks & Systems Administration', 18, 0),
(242, 'Product Management & Development', 18, 0),
(243, 'Programme & Project Management', 18, 0),
(244, 'Sales - Pre & Post', 18, 0),
(245, 'Security', 18, 0),
(246, 'Team Leaders', 18, 0),
(247, 'Technical Writing', 18, 0),
(248, 'Telecommunications', 18, 0),
(249, 'Testing & Quality Assurance', 18, 0),
(250, 'Web Development & Production', 18, 0),
(251, 'Other', 18, 0),
(252, 'Actuarial', 19, 0),
(253, 'Assessment', 19, 0),
(254, 'Brokerage', 19, 0),
(255, 'Claims', 19, 0),
(256, 'Fund Administration', 19, 0),
(257, 'Management', 19, 0),
(258, 'Risk Consulting', 19, 0),
(259, 'Superannuation', 19, 0),
(260, 'Underwriting', 19, 0),
(261, 'Workers\' Compensation', 19, 0),
(262, 'Other', 19, 0),
(263, 'Banking & Finance Law', 20, 0),
(264, 'Construction Law', 20, 0),
(265, 'Corporate & Commercial Law', 20, 0),
(266, 'Criminal & Civil Law', 20, 0),
(267, 'Environment & Planning Law', 20, 0),
(268, 'Family Law', 20, 0),
(269, 'Generalists - In-house', 20, 0),
(270, 'Generalists - Law Firm', 20, 0),
(271, 'Industrial Relations & Employment Law', 20, 0),
(272, 'Insurance & Superannuation Law', 20, 0),
(273, 'Intellectual Property Law', 20, 0),
(274, 'Law Clerks & Paralegals', 20, 0),
(275, 'Legal Practice Management', 20, 0),
(276, 'Legal Secretaries', 20, 0),
(277, 'Litigation & Dispute Resolution', 20, 0),
(278, 'Personal Injury Law', 20, 0),
(279, 'Property Law', 20, 0),
(280, 'Tax Law', 20, 0),
(281, 'Other', 20, 0),
(282, 'Analysis & Reporting', 21, 0),
(283, 'Assembly & Process Work', 21, 0),
(284, 'Aviation Services', 21, 0),
(285, 'Couriers, Drivers & Postal Services', 21, 0),
(286, 'Fleet Management', 21, 0),
(287, 'Freight/Cargo Forwarding', 21, 0),
(288, 'Import/Export & Customs', 21, 0),
(289, 'Machine Operators', 21, 0),
(290, 'Management', 21, 0),
(291, 'Pattern Makers & Garment Technicians', 21, 0),
(292, 'Pickers & Packers', 21, 0),
(293, 'Production, Planning & Scheduling', 21, 0),
(294, 'Public Transport & Taxi Services', 21, 0),
(295, 'Purchasing, Procurement & Inventory', 21, 0),
(296, 'Quality Assurance & Control', 21, 0),
(297, 'Rail & Maritime Transport', 21, 0),
(298, 'Road Transport', 21, 0),
(299, 'Team Leaders/Supervisors', 21, 0),
(300, 'Warehousing, Storage & Distribution', 21, 0),
(301, 'Other', 21, 0),
(302, 'Brand Management', 22, 0),
(303, 'Digital & Search Marketing', 22, 0),
(304, 'Direct Marketing & CRM', 22, 0),
(305, 'Event Management', 22, 0),
(306, 'Internal Communications', 22, 0),
(307, 'Management', 22, 0),
(308, 'Market Research & Analysis', 22, 0),
(309, 'Marketing Assistants/Coordinators', 22, 0),
(310, 'Marketing Communications', 22, 0),
(311, 'Product Management & Development', 22, 0),
(312, 'Public Relations & Corporate Affairs', 22, 0),
(313, 'Trade Marketing', 22, 0),
(314, 'Other', 22, 0),
(315, 'Analysis & Reporting', 23, 0),
(316, 'Health, Safety & Environment', 23, 0),
(317, 'Management', 23, 0),
(318, 'Mining - Drill & Blast', 23, 0),
(319, 'Mining - Engineering & Maintenance', 23, 0),
(320, 'Mining - Exploration & Geoscience', 23, 0),
(321, 'Mining - Operations', 23, 0),
(322, 'Mining - Processing', 23, 0),
(323, 'Natural Resources & Water', 23, 0),
(324, 'Oil & Gas - Drilling', 23, 0),
(325, 'Oil & Gas - Engineering & Maintenance', 23, 0),
(326, 'Oil & Gas - Exploration & Geoscience', 23, 0),
(327, 'Oil & Gas - Operations', 23, 0),
(328, 'Oil & Gas - Production & Refinement', 23, 0),
(329, 'Power Generation & Distribution', 23, 0),
(330, 'Surveying', 23, 0),
(331, 'Other', 23, 0),
(332, 'Administration', 24, 0),
(333, 'Analysts', 24, 0),
(334, 'Body Corporate & Facilities Management', 24, 0),
(335, 'Commercial Sales, Leasing & Property Mgmt', 24, 0),
(336, 'Residential Leasing & Property Management', 24, 0),
(337, 'Residential Sales', 24, 0),
(338, 'Retail & Property Development', 24, 0),
(339, 'Valuation', 24, 0),
(340, 'Other', 24, 0),
(341, 'Buying', 25, 0),
(342, 'Management - Area/Multi-site', 25, 0),
(343, 'Management - Department/Assistant', 25, 0),
(344, 'Management - Store', 25, 0),
(345, 'Merchandisers', 25, 0),
(346, 'Planning', 25, 0),
(347, 'Retail Assistants', 25, 0),
(348, 'Other', 25, 0),
(349, 'Account & Relationship Management', 26, 0),
(350, 'Analysis & Reporting', 26, 0),
(351, 'Management', 26, 0),
(352, 'New Business Development', 26, 0),
(353, 'Sales Coordinators', 26, 0),
(354, 'Sales Representatives/Consultants', 26, 0),
(355, 'Other', 26, 0),
(356, 'Biological & Biomedical Sciences', 27, 0),
(357, 'Biotechnology & Genetics', 27, 0),
(358, 'Chemistry & Physics', 27, 0),
(359, 'Environmental, Earth & Geosciences', 27, 0),
(360, 'Food Technology & Safety', 27, 0),
(361, 'Laboratory & Technical Services', 27, 0),
(362, 'Materials Sciences', 27, 0),
(363, 'Mathematics, Statistics & Information Sciences', 27, 0),
(364, 'Modelling & Simulation', 27, 0),
(365, 'Quality Assurance & Control', 27, 0),
(366, 'Other', 27, 0),
(367, 'Self Employment', 28, 0),
(368, 'Coaching & Instruction', 29, 0),
(369, 'Fitness & Personal Training', 29, 0),
(370, 'Management', 29, 0),
(371, 'Other', 29, 0),
(372, 'Air Conditioning & Refrigeration', 30, 0),
(373, 'Automotive Trades', 30, 0),
(374, 'Bakers & Pastry Chefs', 30, 0),
(375, 'Building Trades', 30, 0),
(376, 'Butchers', 30, 0),
(377, 'Carpentry & Cabinet Making', 30, 0),
(378, 'Cleaning Services', 30, 0),
(379, 'Electricians', 30, 0),
(380, 'Fitters, Turners & Machinists', 30, 0),
(381, 'Floristry', 30, 0),
(382, 'Gardening & Landscaping', 30, 0),
(383, 'Hair & Beauty Services', 30, 0),
(384, 'Labourers', 30, 0),
(385, 'Locksmiths', 30, 0),
(386, 'Maintenance & Handyperson Services', 30, 0),
(387, 'Nannies & Babysitters', 30, 0),
(388, 'Painters & Sign Writers', 30, 0),
(389, 'Plumbers', 30, 0),
(390, 'Printing & Publishing Services', 30, 0),
(391, 'Security Services', 30, 0),
(392, 'Tailors & Dressmakers', 30, 0),
(393, 'Technicians', 30, 0),
(394, 'Welders & Boilermakers', 30, 0),
(395, 'Other', 30, 0),
(396, 'HR', 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UserStatus` enum('Active','Blocked','Deleted','Verify') DEFAULT 'Verify',
  `Profile_Description` text DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Resume_Path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FirstName`, `LastName`, `Phone`, `RegistrationDate`, `UserStatus`, `Profile_Description`, `Location`, `Resume_Path`) VALUES
(7, 'ericcc', '$2y$10$lWu3hx.TSM9b85rIv1fDueifzqgFLc.q4fylTZjU7X18vlWzaNm/a', '1211206342@student.mmu.edu.my', 'Eric', 'Ching Khai Jie', '168885851', '2023-12-07 04:15:05', 'Active', '', 'Johor - Mersing', NULL),
(15, '', '$2y$10$ja5BQtQQgKVCrQqTEM6z7O50X2TVoQAWY6yutf.naOQytXJ2ua4eC', 'ericching342@gmail.com', 'Lau', 'Jia Fu', '1212121212', '2024-01-14 07:29:48', 'Active', 'asdad', 'Johor - Johor Bahru', NULL),
(16, '', '$2y$10$p1rNzAIJQzgPsijW6P2.xOPe/eOcGs92Yuvw43Z1GrXaG6DUU9sNW', 'kahhei@gmail.com', 'Mah', 'Kah Hei', '1688859511', '2024-01-14 07:37:27', 'Verify', NULL, 'Johor - Batu Pahat', NULL),
(17, '', '$2y$10$WxpKuPXHHkotLXsC1DA71uIAvodX0LsUJQ2ljNk0kxvGwvWZrtmFm', 'jielun@gmail.com', 'Chong', 'Jie Lun', '1234567890', '2024-01-17 07:38:09', 'Verify', NULL, 'Johor - Batu Pahat', NULL),
(18, '', '$2y$10$Zf/RCIkxyl8LtzMpEsD50.VtNJvVj.J3IzJht6Bua7awwQj1kZV5O', '1211206774@student.mmu.edu.my', 'Beh', 'Song You', '1688859511', '2024-01-17 07:40:36', 'Active', 'I am a student', 'Johor - Johor Bahru', NULL),
(19, '', '$2y$10$0dfN2uafO0DOLK3PuzGP4OKx9Kgp59w38uRcb0CHen.DGfcz1TjLS', 'weizuen@gmail.com', 'Lim', 'Wei Zuen', '1688859511', '2024-01-24 02:39:45', 'Verify', NULL, 'Johor - Kota Tinggi', NULL),
(20, '', '$2y$10$KgW8Uj.VcMT/qpBErdZ6MusnmU5tBMtMd8XH52hCSVbZ3CI5nvxbi', 'sandy123@student.mmu.edu.my', 'Sandy', 'Lee wenxuan', '1212121212', '2024-02-11 08:14:12', 'Active', NULL, 'Johor - Johor Bahru', NULL),
(21, '', '$2y$10$tP1dW4fNJV04ClTahkNZmO6HqL588aAaCXtRRfEu39tJD7xr5gOwW', 'looiguangyong@gmail.com', 'Looi', 'Guang Yong', '1131838671', '2024-02-21 07:05:52', 'Active', 'I have some knowledge about the AWS academy.', 'Johor - Johor Bahru', NULL),
(22, '', '$2y$10$Ad1u3niNA2bMZ8QHy7iFM.iKNoCmA/ktqRJvMYNKzw156uIWamPIa', 'zhengyu@gmail.com', 'Tan', 'Zheng Yu', '126666644', '2024-02-21 11:50:29', 'Active', 'I have been done cloud computing research', 'Johor - Johor Bahru', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_contact_us`
--

CREATE TABLE `user_contact_us` (
  `u_ContactID` int(11) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `Response` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `ResponseStatus` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_contact_us`
--

INSERT INTO `user_contact_us` (`u_ContactID`, `UserEmail`, `Subject`, `Message`, `Response`, `CreatedAt`, `ResponseStatus`) VALUES
(1, 'ericching342@gmail.com', 'a', 'a', 'asdasdad', '2024-01-23 07:20:58', 1),
(2, 'ericching342@gmail.com', 'Company Reply', 'Why company always not reply my application', '', '2024-01-24 01:05:08', 0),
(3, 'ericching342@gmail.com', 'Forget password', 'may i take your attention about forget the password and how can i solve this problem, can you helpme?', '', '2024-02-09 07:31:11', 0),
(4, 'jielun111@gmai.com', 'Fix bug', 'Hi , can i take you attention about some bug about the home', '', '2024-02-09 07:43:16', 0),
(5, 'looiguangyong@gmail.com', ' job application update faster', 'please announce company update faster', '', '2024-02-21 08:26:20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `applicant_career`
--
ALTER TABLE `applicant_career`
  ADD PRIMARY KEY (`ApplicantCareerID`),
  ADD KEY `ApplicationID` (`ApplicationID`);

--
-- Indexes for table `applicant_education`
--
ALTER TABLE `applicant_education`
  ADD PRIMARY KEY (`EducationID`),
  ADD KEY `ApplicationID` (`ApplicationID`);

--
-- Indexes for table `applicant_responses`
--
ALTER TABLE `applicant_responses`
  ADD PRIMARY KEY (`ResponseID`),
  ADD KEY `ApplicationID` (`ApplicationID`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `applications_ibfk_2` (`JobID`);

--
-- Indexes for table `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`CareerID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`CompanyID`);

--
-- Indexes for table `company_contact_us`
--
ALTER TABLE `company_contact_us`
  ADD PRIMARY KEY (`c_ContactID`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`CreditCardID`),
  ADD KEY `fk_company_id` (`CompanyID`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`EducationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `job_location`
--
ALTER TABLE `job_location`
  ADD PRIMARY KEY (`Job_Location_ID`);

--
-- Indexes for table `job_post`
--
ALTER TABLE `job_post`
  ADD PRIMARY KEY (`Job_Post_ID`),
  ADD KEY `fk_company` (`CompanyID`),
  ADD KEY `Main_Category_ID` (`Main_Category_ID`),
  ADD KEY `Sub_Category_ID` (`Sub_Category_ID`),
  ADD KEY `job_post_ibfk3` (`Job_Location_ID`);

--
-- Indexes for table `job_post_questions`
--
ALTER TABLE `job_post_questions`
  ADD PRIMARY KEY (`JobPostQuestionID`),
  ADD KEY `JobID` (`JobID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- Indexes for table `job_question`
--
ALTER TABLE `job_question`
  ADD PRIMARY KEY (`Job_Question_ID`);

--
-- Indexes for table `job_question_option`
--
ALTER TABLE `job_question_option`
  ADD PRIMARY KEY (`Job_Question_Option_ID`),
  ADD KEY `Job_Question_ID` (`Job_Question_ID`);

--
-- Indexes for table `main_category`
--
ALTER TABLE `main_category`
  ADD PRIMARY KEY (`Main_Category_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `fk_jobpost_id` (`JobID`) USING BTREE,
  ADD KEY `fk_company_id` (`CompanyID`) USING BTREE;

--
-- Indexes for table `save_job`
--
ALTER TABLE `save_job`
  ADD PRIMARY KEY (`Save_JobID`),
  ADD KEY `Job_Post_ID` (`Job_Post_ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`Sub_Category_ID`),
  ADD KEY `Main_Category_ID` (`Main_Category_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user_contact_us`
--
ALTER TABLE `user_contact_us`
  ADD PRIMARY KEY (`u_ContactID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `applicant_career`
--
ALTER TABLE `applicant_career`
  MODIFY `ApplicantCareerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applicant_education`
--
ALTER TABLE `applicant_education`
  MODIFY `EducationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `applicant_responses`
--
ALTER TABLE `applicant_responses`
  MODIFY `ResponseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `ApplicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
  MODIFY `CareerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `CompanyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `company_contact_us`
--
ALTER TABLE `company_contact_us`
  MODIFY `c_ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `CreditCardID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `EducationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `job_location`
--
ALTER TABLE `job_location`
  MODIFY `Job_Location_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `job_post`
--
ALTER TABLE `job_post`
  MODIFY `Job_Post_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `job_post_questions`
--
ALTER TABLE `job_post_questions`
  MODIFY `JobPostQuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `job_question`
--
ALTER TABLE `job_question`
  MODIFY `Job_Question_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `job_question_option`
--
ALTER TABLE `job_question_option`
  MODIFY `Job_Question_Option_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT for table `main_category`
--
ALTER TABLE `main_category`
  MODIFY `Main_Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `save_job`
--
ALTER TABLE `save_job`
  MODIFY `Save_JobID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `Sub_Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_contact_us`
--
ALTER TABLE `user_contact_us`
  MODIFY `u_ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant_career`
--
ALTER TABLE `applicant_career`
  ADD CONSTRAINT `applicant_career_ibfk_1` FOREIGN KEY (`ApplicationID`) REFERENCES `applications` (`ApplicationID`);

--
-- Constraints for table `applicant_education`
--
ALTER TABLE `applicant_education`
  ADD CONSTRAINT `applicant_education_ibfk_1` FOREIGN KEY (`ApplicationID`) REFERENCES `applications` (`ApplicationID`);

--
-- Constraints for table `applicant_responses`
--
ALTER TABLE `applicant_responses`
  ADD CONSTRAINT `applicant_responses_ibfk_1` FOREIGN KEY (`ApplicationID`) REFERENCES `applications` (`ApplicationID`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`JobID`) REFERENCES `job_post` (`Job_Post_ID`);

--
-- Constraints for table `career`
--
ALTER TABLE `career`
  ADD CONSTRAINT `career_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD CONSTRAINT `fk_company_id` FOREIGN KEY (`CompanyID`) REFERENCES `companies` (`CompanyID`);

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `job_post`
--
ALTER TABLE `job_post`
  ADD CONSTRAINT `job_post_ibfk3` FOREIGN KEY (`Job_Location_ID`) REFERENCES `job_location` (`Job_Location_ID`),
  ADD CONSTRAINT `job_post_ibfk_1` FOREIGN KEY (`Main_Category_ID`) REFERENCES `main_category` (`Main_Category_ID`),
  ADD CONSTRAINT `job_post_ibfk_2` FOREIGN KEY (`Sub_Category_ID`) REFERENCES `sub_category` (`Sub_Category_ID`);

--
-- Constraints for table `job_post_questions`
--
ALTER TABLE `job_post_questions`
  ADD CONSTRAINT `job_post_questions_ibfk_2` FOREIGN KEY (`QuestionID`) REFERENCES `job_question` (`Job_Question_ID`);

--
-- Constraints for table `job_question_option`
--
ALTER TABLE `job_question_option`
  ADD CONSTRAINT `job_question_option_ibfk_1` FOREIGN KEY (`Job_Question_ID`) REFERENCES `job_question` (`Job_Question_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`CompanyID`) REFERENCES `companies` (`CompanyID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`JobID`) REFERENCES `job_post` (`Job_Post_ID`);

--
-- Constraints for table `save_job`
--
ALTER TABLE `save_job`
  ADD CONSTRAINT `save_job_ibfk_1` FOREIGN KEY (`Job_Post_ID`) REFERENCES `job_post` (`Job_Post_ID`),
  ADD CONSTRAINT `save_job_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`Main_Category_ID`) REFERENCES `main_category` (`Main_Category_ID`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_job_status` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-11-01 14:03:47' ENDS '2024-03-31 14:03:47' ON COMPLETION PRESERVE ENABLE DO UPDATE job_post
SET job_status = 'Closed'
WHERE NOW() > AdEndDate AND job_status = 'Active'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
