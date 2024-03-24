-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 03:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(30) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `answer` text NOT NULL,
  `question_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `survey_id`, `user_id`, `answer`, `question_id`, `date_created`) VALUES
(12, 9, 4, 'VRdAn', 8, '2024-03-24 09:51:19'),
(13, 9, 4, 'HAHAH', 9, '2024-03-24 09:51:19'),
(14, 9, 4, '[tuKVU]', 10, '2024-03-24 09:51:19'),
(15, 9, 4, 'cwlGz', 8, '2024-03-24 09:56:24'),
(16, 9, 4, 'Secret', 9, '2024-03-24 09:56:24'),
(17, 9, 4, '[tuKVU]', 10, '2024-03-24 09:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `ID` int(11) NOT NULL,
  `departmentname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`ID`, `departmentname`) VALUES
(1, 'BEED');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(30) NOT NULL,
  `question` text NOT NULL,
  `frm_option` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `order_by` int(11) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `frm_option`, `type`, `order_by`, `survey_id`, `date_created`) VALUES
(1, 'Sample Survey Question using Radio Button', '{\"cKWLY\":\"Option 1\",\"esNuP\":\"Option 2\",\"dAWTD\":\"Option 3\",\"eZCpf\":\"Option 4\"}', 'radio_opt', 3, 1, '2020-11-10 12:04:46'),
(2, 'Question for Checkboxes', '{\"qCMGO\":\"Checkbox label 1\",\"JNmhW\":\"Checkbox label 2\",\"zZpTE\":\"Checkbox label 3\",\"dOeJi\":\"Checkbox label 4\"}', 'check_opt', 2, 1, '2020-11-10 12:25:13'),
(4, 'Sample question for the text field', '', 'textfield_s', 1, 1, '2020-11-10 13:34:21'),
(5, 'Tao Ka', '{\"jCTNi\":\"Yes\",\"XzMUn\":\"No\"}', 'radio_opt', 0, 6, '2024-03-23 19:15:39'),
(6, 'Tao Kaba?', '{\"DsAqY\":\"Yes\",\"beiPO\":\"No\"}', 'radio_opt', 0, 7, '2024-03-23 19:20:34'),
(7, 'Anong Status mo sa buhay?', '{\"yVSvD\":\"Single\",\"QxClz\":\"Kulang sa Aruga\"}', 'radio_opt', 0, 7, '2024-03-23 19:21:09'),
(8, 'Are you human?', '{\"VRdAn\":\"Yes\",\"cwlGz\":\"No\"}', 'radio_opt', 0, 9, '2024-03-24 08:21:00'),
(9, 'If you are human? Pano mo ipapaliwanag sa batang ikaw na hindi ito yung pangarap nya?', '', 'textfield_s', 0, 9, '2024-03-24 08:22:16'),
(10, 'What if', '{\"tuKVU\":\"Mahal ko pa ex ko\",\"tmzaM\":\"Hindi talaga ikaw ang gusto\",\"edrlB\":\"kinakausap ka lang nya kapg hindi nya kausap yung totoong gusto nya?\"}', 'check_opt', 0, 9, '2024-03-24 08:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `student_answe_status`
--

CREATE TABLE `student_answe_status` (
  `ID` int(11) NOT NULL,
  `surveyid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `STATUS` enum('ANSWERED','') NOT NULL,
  `dateanswered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_answe_status`
--

INSERT INTO `student_answe_status` (`ID`, `surveyid`, `studentid`, `STATUS`, `dateanswered`) VALUES
(1, 9, 4, 'ANSWERED', '2024-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `ID` int(11) NOT NULL,
  `Dept_ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `STUDENTID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`ID`, `Dept_ID`, `NAME`, `STUDENTID`) VALUES
(1, 0, 'Kent ', '20231'),
(2, 0, 'Kent ', '202'),
(4, 1, 'HAHHA', '123');

-- --------------------------------------------------------

--
-- Table structure for table `survey_set`
--

CREATE TABLE `survey_set` (
  `id` int(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(250) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_set`
--

INSERT INTO `survey_set` (`id`, `title`, `description`, `user_id`, `start_date`, `end_date`, `date_created`) VALUES
(9, 'Tao Test', 'This is to test that you are 100% human', 0, '2024-03-24T08:09', '2024-03-25T10:09', '2024-03-24 08:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2 = Staff, 3= Subscriber',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `type`, `date_created`) VALUES
(1, 'Admin', 'Admin', '', '+123456789', 'Sample address', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, '2020-11-10 08:43:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_answe_status`
--
ALTER TABLE `student_answe_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `survey_set`
--
ALTER TABLE `survey_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_answe_status`
--
ALTER TABLE `student_answe_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `survey_set`
--
ALTER TABLE `survey_set`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
