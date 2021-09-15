-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2021 at 01:04 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vcdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'avatar-default.png',
  `status` varchar(100) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `email`, `password`, `role`, `phone_no`, `image`, `status`) VALUES
('educator60bfb4053e1933.91262126', 'muhammad nurhafizi', 'muhammadnurhafizi3012@gmail.com', '$2y$10$Tf5ZVLD5J1.7S2go9KMarumskKBTfLoDDEr4co6z3U06OL.331wG2', 'educator', NULL, 'avatar-default.png', 'active'),
('educator60c0ffc170d606.47264031', 'aliff iqmal', 'aliffiqmal@gmail.com', '$2y$10$GAiv7Gu476eNOKWyAd2WY.3nw6QHCE5.Qpwsu33POfoAM9mFw75/q', 'educator', NULL, 'avatar-default.png', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `date_assigned` varchar(100) NOT NULL,
  `due_date` varchar(100) NOT NULL,
  `total_marks` varchar(10) NOT NULL,
  `channel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `title`, `description`, `date_assigned`, `due_date`, `total_marks`, `channel`) VALUES
('1', 'assignment 1 channel fizie 1', '<p>Install CTV3 Clue Browser and develop simple prototype search engine for ICD10 code.</p>  <p>Instruction: After you have complete perform A and B, construct task C and submit C1 and C2.</p>A. Install CTV3 Clue Browser      1. Download CTV3 CLUE BROWSER.ZIP      2. Install the CTV3 Clue Browser in your PC      3. Read Readme file and follow the instruction      4. After the installation is successful, explore the application to get the idea. Apply the concept and implement in your application B. Install and Create ICD10 tables and data.     1. Download icd10_codes.zip     2. Run the SQL scripts to create the tables     3. Develop search engine to lookup icd10 name      4. Embed into your apps C. Present the above tasks (A and B)     1. Show up 3 minutes a video to me on working CTV3 Clue Browser.     2. Show up 3 minutes or more a video on B - your prototype ICD10 search apps', '12:00:00 am 1-Jan-2020', '12:00:00 am 01-Jan-2021', '100', '1'),
('2', 'assignment 2 channel fizie 1', NULL, '12:00:00 am 1-Jan-2020', '12:00:00 am 1-Jan-2021', '100', '1'),
('3', 'assignment 1 channel fizie 2', NULL, '12:00:00 am 1-Jan-2020', '12:00:00 am 1-Jan-2021', '100', '2'),
('4', 'assignment 2 channel fizie 2', NULL, '12:00:00 am 1-Jan-2020', '12:00:00 am 1-Jan-2021', '100', '2'),
('5', 'assignment 1 channel alip 1', NULL, '12:00:00 am 1-Jan-2020', '12:00:00 am 1-Jan-2021', '100', '3'),
('6', 'assignment 2 channel alip 1', NULL, '12:00:00 am 1-Jan-2020', '12:00:00 am 1-Jan-2021', '100', '3'),
('7', 'assignment 1 channel alip 2', NULL, '12:00:00 am 1-Jan-2020', '12:00:00 am 1-Jan-2021', '100', '4'),
('8', 'assignment 2 channel alip 2', NULL, '12:00:00 am 1-Jan-2020', '12:00:00 am 1-Jan-2021', '100', '4'),
('assignment60d2873e922be9.69073900', 'front-end development', '', '08:58:38 am 23-Jun-2021', '08:58:00 am 23-Jun-2021', '100', 'channel60d0b5b349ad91.26292571');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `image_text` text NOT NULL,
  `educator` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `name`, `description`, `image_text`, `educator`) VALUES
('1', 'channel fizie 1', '', '', 'educator60bfb4053e1933.91262126'),
('2', 'channel fizie 2', NULL, 'james-harden.jpg', 'educator60bfb4053e1933.91262126'),
('3', 'channel alip 1', NULL, 'kevin-durrant.jpg', 'educator60c0ffc170d606.47264031'),
('4', 'channel alip 2', NULL, 'lebron-james.jpg', 'educator60c0ffc170d606.47264031'),
('channel60d0b5b349ad91.26292571', 'web development', 'description', '960x0.jpg', 'educator60bfb4053e1933.91262126'),
('channel60d0b5e0bd0e70.42371444', 'Final Year Project (FYP)', 'this is for the last year student who will take fyp for their project.', 'software.jpg', 'educator60bfb4053e1933.91262126'),
('channel60d0b608a86623.77342744', 'internet technology', 'it description', 'SEO-1560-bs-Professional-Development-Progr-270311620-1200x675.jpg', 'educator60bfb4053e1933.91262126'),
('channel60d0b71fe37f86.79225940', 'special topic software engineering', 'stse description', 'software.jpg', 'educator60bfb4053e1933.91262126'),
('channel60d0bb92f158c5.96645806', 'technology entrepreneurship', 'techno', 'types-of-software.png', 'educator60bfb4053e1933.91262126'),
('channel60d20f43544a02.32265782', 'Multimedia', 'multimedia description', '960x0.jpg', 'educator60bfb4053e1933.91262126');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `query` varchar(1000) NOT NULL,
  `reply` varchar(1000) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `query`, `reply`, `role`) VALUES
(1, 'chatbot?|bot?|?????|are you there?|.', 'I am here. 👋', 'all'),
(2, 'what is your name?|how can I call you?|what should I call you?|Do you have name?|who are you?', 'I am EDU-V Chatbot, you can call me chatbot or bot. Nice to meet you. 😁', 'all'),
(3, 'hi|hey|hello|helo|hy|good morning|good afternoon|good evening', 'Hello dear! 😀', 'all'),
(4, 'how are you？|how about you？|are you fine?|are you ok?', 'I am fine, I hope you are fine too. 😄', 'all'),
(5, 'thanks.|thank you.|thank a lot from you.|graceful.|terima kasih.|xie xie.|aligato.|arigatou.|gamsahabnida.|kamsahamida.', 'You are welcome. 🥰', 'all'),
(6, 'good bye.|good by.', 'Bye, see you soon. 😉', 'all'),
(7, 'how should I use this system?|can you teach me about this system?|can you tell me about this system?|what can this system do?|how should I use edu-v?|can you teach me about edu-v?|can you tell me about edu-v?|what can edu-v do?', 'EDU-V is your all-in-one place for teaching and learning. Our easy-to-use and secure tool helps educators and students to manage, measure, and enrich learning experiences.', 'all'),
(8, 'how to check profile?|how to see profile?|how to view profile?|how to change profile?|how to edit profile?|how to check email?|how to see email?|how to view email?|how to check password?|how to see password?|how to view password?|how to check name?|how to see name?|how to view name?|how to check full name?|how to see full name?|how to view full name?|how to check profile picture?|how to see profile picture?|how to view profile picture?|how to check picture?|how to see picture?|how to view picture?', 'To view your profile information, click your profile picture or name at the side navigation bar. Your personal information will be shown.', 'all'),
(9, 'how to change name?|how to edit name?|how to change full name?|how to edit full name?', 'To change your name:<br>- Click your profile picture or name at side navigation bar.<br>- Edit and enter your new name at the Full Name field.<br>- Click \"Save\".', 'all'),
(10, 'how to change profile picture?|how to edit profile picture?|how to upload profile picture?|how to change picture?|how to edit picture?|how to upload picture?', 'To change your profile picture:<br>- Click your profile picture or name at side navigation bar.<br>- Click browse to select picture from your device.<br>- Click \"Save\".', 'all'),
(11, 'how to change email?|how to edit email?|how to update email?', 'To change your email:<br>- Click your profile picture or name at side navigation bar.<br>- Click \"Change\" at beside your email.<br>- Enter and submit your current password to proceed.<br>- Enter you new email and click \"Update\".<br><br>The verification link will send to your new email address, the email will be updated after you verified the email.', 'all'),
(12, 'how to change password?|how to edit password?|how to update password?', 'To change your password:<br>- Click your profile picture or name at side navigation bar.<br>- Click \"Change\" at beside your password.<br>- Enter and submit your current password to proceed.<br>- Enter you new password with the confirmed password and click \"Update\".', 'all'),
(13, 'how to view channel?|how can I view channel?', 'To view channel:<br>- Click \"Channel\" at side navigation bar.<br>- Select a channel that you want to view the detail.', 'all'),
(14, 'how to create channel?|how to create new channel?|how can I create channel?|how can I create new channel?|how to add channel?|how to add new channel?|how can I add channel?|how can I add new channel?', 'To add new channel:<br>- Click \"Channel\" at side navigation bar.<br>- Click \"+\" at the bottom right.<br>- Enter the channel name, description and a suitable icon for your new channel.<br>- Click \"Save\".', 'educator'),
(15, 'how to create class?|how to create new class?|how can I create class?|how can I create new class?|how to add class?|how to add new class?|how can I add class?|how can I add new class?', 'To add new class:<br>- Click \"Channel\" at side navigation bar.<br>- Select a channel that you want to create class.<br>- Click \"Create Class\" at the top right.<br>- Enter the class name, description new class.<br>- Click \"Save\".', 'educator'),
(16, 'how to view attendance?|how can I view attendance?', 'To view attendance:<br>- Click \"Attendance\" at side navigation bar.<br>- The attendance for all channels will be shown.<br>- You can filter the attendance by selecting specific channel or date.', 'all'),
(17, 'how to view assignment?|how can I view assignment?', 'To view assignment:<br>- Click \"Assignment\" at side navigation bar.<br>- Select a assignment that you want to view the detail.', 'all'),
(18, 'how to create assignment?|how to create new assignment?|how can I create assignment?|how can I create new assignment?|how to add assignment?|how to add new assignment?|how can I add assignment?|how can I add new assignment?', 'To add new assignment:<br>- Click \"Assignment\" at side navigation bar.<br>- Click \"+\" at the bottom right.<br>- Enter the assignment name, description and the due date & time for your new assignment.<br>- Click \"Save\".', 'educator'),
(19, 'how to view examination?|how can I view examination?|how to view exam?|how can I view exam?|how to view questions?|how can I view questions?', 'To view examination:<br>- Click \"Examination\" at side navigation bar.<br>- Select a examination that you want to view the questions.', 'all'),
(20, 'how to create examination?|how to create new examination?|how can I create examination?|how can I create new examination?|how to add examination?|how to add new examination?|how can I add examination?|how can I add new examination?', 'To add new examination:<br>- Click \"Examination\" at side navigation bar.<br>- Click \"+\" at the bottom right.<br>- Enter the examination title, start date & time, exam duration and also the channel of your new examination.<br>- Click \"Save\".', 'educator'),
(21, 'where can I found|how can I found you you?|where are you?', 'You can found me by click the \"Chatbot\" at the side navigation bar. I am always ready for you. 😙', 'all'),
(22, 'how to use chatbot?|how can I chat with you?', 'Just ask whatever you want to ask me. Don\'t be shiny. 😊', 'all');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `channel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `description`, `date`, `time`, `channel`) VALUES
('class60d0ba9d60e4e1.62207541', 'week 5', 'week 5 description', '2021-06-25', '15:04:00', 'channel60d0b5b349ad91.26292571'),
('class60d0bac9146814.34928924', 'week 6', 'week 6', '2021-06-25', '00:14:00', 'channel60d0b5b349ad91.26292571'),
('class60d0bc25118587.10277188', 'week 14', 'week 14 description', '2021-06-22', '16:20:00', 'channel60d0b5b349ad91.26292571'),
('class60d2106b78fb57.29080361', 'week 13', 'progress 2 of project', '2021-06-24', '16:31:00', 'channel60d0b5e0bd0e70.42371444'),
('class60d2670e8a5888.76324036', 'week 4', 'learn about swot', '2021-06-23', '09:00:00', 'channel60d0bb92f158c5.96645806'),
('class60d283c74a8930.40782188', 'kelas alip', 'kelas jadi bapuk', '2021-06-24', '08:47:00', '3'),
('class60d2847496ef57.40706354', 'kelas alip 2', 'alip masterclass', '2021-07-10', '00:46:00', '3');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `channel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `title`, `date_time`, `duration`, `channel`) VALUES
('exam60d287f2717e19.74052799', 'Front-End Development', '2021-06-25 10:01:00', 90, 'channel60d0b5b349ad91.26292571');

-- --------------------------------------------------------

--
-- Table structure for table `exam_student`
--

CREATE TABLE `exam_student` (
  `id` int(11) NOT NULL,
  `exam` varchar(100) CHARACTER SET utf8 NOT NULL,
  `student` varchar(100) CHARACTER SET utf8 NOT NULL,
  `mark` double(11,2) NOT NULL,
  `datetime_submit` datetime DEFAULT NULL,
  `answers` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `comment` varchar(100) CHARACTER SET utf8 NOT NULL,
  `class` varchar(100) CHARACTER SET utf8 NOT NULL,
  `student` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `educator` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `comment`, `class`, `student`, `educator`) VALUES
('forum60d245c282b9d6.75647222', 'alright sir!', 'class60d2106b78fb57.29080361', '1', NULL),
('forum60d24a27ea3703.20887137', 'ok sir!', 'class60d0ba9d60e4e1.62207541', '4', NULL),
('forum60d2621141b2f6.96758305', 'thankyou sir', 'class60d0bac9146814.34928924', '1', NULL),
('forum60d26222c7d272.96189530', 'ok tq sir', 'class60d0bc25118587.10277188', '1', NULL),
('forum60d266ad0b7464.04795917', 'noted sir :)', 'class60d0ba9d60e4e1.62207541', '1', NULL),
('forum60d27bf9aa05e7.46689193', 'alright', 'class60d0ba9d60e4e1.62207541', NULL, 'educator60bfb4053e1933.91262126'),
('forum60d28061b19ae7.55550182', 'hello students', 'class60d0ba9d60e4e1.62207541', NULL, 'educator60bfb4053e1933.91262126'),
('forum60d2808b5861b0.74715893', 'welcome', 'class60d0bac9146814.34928924', NULL, 'educator60bfb4053e1933.91262126'),
('forum60d28386ab7e12.33048145', 'yes sir', 'class60d0ba9d60e4e1.62207541', '1', NULL),
('forum60d2842c59fd84.82053815', 'hello', 'class60d283c74a8930.40782188', '1', NULL),
('forum60d285b64342c2.21273711', 'hello', 'class60d0ba9d60e4e1.62207541', '1', NULL),
('forum60d28681a07e70.96391825', 'sir', 'class60d0bc25118587.10277188', '1', NULL),
('forum60d2868b2f2783.97736872', 'yes', 'class60d0bc25118587.10277188', NULL, 'educator60bfb4053e1933.91262126'),
('forum60d286974a6202.97176358', 'nothing', 'class60d0bc25118587.10277188', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `key_temp`
--

CREATE TABLE `key_temp` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `exp_date` varchar(100) DEFAULT NULL,
  `key_session` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `key_temp`
--

INSERT INTO `key_temp` (`id`, `email`, `exp_date`, `key_session`, `action`) VALUES
(2, 'aliffiqmal@gmail.com', '', '83740f5960749caf1f85a0fab9310513597fb20a2c', 'verify');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `student` varchar(100) NOT NULL,
  `room` varchar(100) NOT NULL,
  `join_time` datetime NOT NULL,
  `left_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `option1` varchar(100) CHARACTER SET latin1 NOT NULL,
  `option2` varchar(100) CHARACTER SET latin1 NOT NULL,
  `option3` varchar(100) CHARACTER SET latin1 NOT NULL,
  `option4` varchar(100) CHARACTER SET latin1 NOT NULL,
  `answer` varchar(100) CHARACTER SET latin1 NOT NULL,
  `exam` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` varchar(100) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `recorded_video` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `class` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'avatar-default.png',
  `status` varchar(100) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `password`, `role`, `phone_no`, `image`, `status`) VALUES
('1', 'student fizie 1', 'studentfizie1@gmail.com', '$2y$10$Tf5ZVLD5J1.7S2go9KMarumskKBTfLoDDEr4co6z3U06OL.331wG2', 'student', NULL, 'avatar-default.png', 'active'),
('2', 'student fizie 2', 'studentfizie2@gmail.com', '$2y$10$Tf5ZVLD5J1.7S2go9KMarumskKBTfLoDDEr4co6z3U06OL.331wG2', 'student', NULL, 'avatar-default.png', 'active'),
('3', 'student fizie 3', 'studentfizie3@gmail.com', '$2y$10$Tf5ZVLD5J1.7S2go9KMarumskKBTfLoDDEr4co6z3U06OL.331wG2', 'student', NULL, 'avatar-default.png', 'active'),
('4', 'student alip 1', 'studentalip1@gmail.com', '$2y$10$Tf5ZVLD5J1.7S2go9KMarumskKBTfLoDDEr4co6z3U06OL.331wG2', 'student', NULL, 'avatar-default.png', 'active'),
('5', 'student alip 2', 'studentalip2@gmail.com', '$2y$10$Tf5ZVLD5J1.7S2go9KMarumskKBTfLoDDEr4co6z3U06OL.331wG2', 'student', NULL, 'avatar-default.png', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_channel`
--

CREATE TABLE `student_channel` (
  `id` int(11) NOT NULL,
  `student` varchar(100) NOT NULL,
  `channel` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'in progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_channel`
--

INSERT INTO `student_channel` (`id`, `student`, `channel`, `status`) VALUES
(1, '1', '1', 'in progress'),
(2, '2', '1', 'in progress'),
(3, '3', '2', 'in progress'),
(4, '4', '3', 'in progress'),
(5, '5', '4', 'in progress'),
(6, '1', 'channel60d0b5b349ad91.26292571', 'in progress');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` varchar(100) NOT NULL,
  `student` varchar(100) NOT NULL,
  `assignment` varchar(100) NOT NULL,
  `date_submit` varchar(100) NOT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `marks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`id`, `student`, `assignment`, `date_submit`, `attachment`, `marks`) VALUES
('1', '1', '1', '12:00:00 am 1-Jan-2022', 'assignment1.docx', '90'),
('2', '2', '1', '12:00:01 am 1-Jan-2021', NULL, '50'),
('submission60c71c6a3cfae4.41241619', '1', '2', '05:07:54 pm 14-Jun-2021', 'Anger.PNG', '50'),
('submission60d28757034258.90684124', '1', 'assignment60d2873e922be9.69073900', '08:59:03 am 23-Jun-2021', 'Assignment.pdf', '100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_channel_fk` (`channel`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_student`
--
ALTER TABLE `exam_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `key_temp`
--
ALTER TABLE `key_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_channel`
--
ALTER TABLE `student_channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `key_temp`
--
ALTER TABLE `key_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_channel`
--
ALTER TABLE `student_channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
