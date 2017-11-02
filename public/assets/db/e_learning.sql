-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2017 at 07:26 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pword` varchar(25) NOT NULL,
  `accountTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `studID`, `email`, `pword`, `accountTypeID`) VALUES
(1, 1, 'e@e.com', '123', 2),
(2, 2, 'r@r.com', '1234', 1),
(3, 3, 'c@c.com', '12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `accounttypes`
--

CREATE TABLE `accounttypes` (
  `accountTypeID` int(11) NOT NULL,
  `accountType` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounttypes`
--

INSERT INTO `accounttypes` (`accountTypeID`, `accountType`) VALUES
(1, 'Student'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `ans_id` int(11) NOT NULL,
  `question_code` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ans_id`, `question_code`, `student_id`) VALUES
(1, 'Q0103-001', 2),
(2, 'Q0103-001', 3),
(3, '2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `assigned_roles`
--

CREATE TABLE `assigned_roles` (
  `assigned_role_id` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `accountTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_roles`
--

INSERT INTO `assigned_roles` (`assigned_role_id`, `studID`, `accountTypeID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(2) NOT NULL,
  `category_code` varchar(50) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_code`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'ADAPTER', 'Adapter', '2017-10-29 01:03:03', '2017-10-29 01:03:03'),
(2, 'COMPOSITE', 'Composite', '2017-10-29 01:03:03', '2017-10-29 01:03:03'),
(3, 'DECORATOR', 'Decorator', '2017-10-29 01:03:03', '2017-10-29 01:03:03'),
(4, 'OBSERVER', 'Observer', '2017-10-29 01:03:03', '2017-10-29 01:03:03'),
(5, 'STRATEGY', 'Strategy', '2017-10-29 01:03:03', '2017-10-29 01:03:03'),
(6, 'ABSTRACT-FACTORY', 'Abstract-Factory', '2017-10-29 01:03:03', '2017-10-29 01:03:03'),
(7, 'FACTORY-METHOD', 'Factory-Method', '2017-10-29 01:03:03', '2017-10-29 01:03:03'),
(8, 'TEMPLATE-METHOD', 'Template-Method', '2017-10-29 01:03:03', '2017-10-29 01:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country`) VALUES
(1, 'Phil'),
(2, 'America');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `log_description` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `log_description`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 'Answered a question', 1, '0000-00-00 00:00:00', '2017-10-28 19:14:38'),
(2, 'Answered a question1', 2, '0000-00-00 00:00:00', '2017-10-28 19:15:45'),
(3, 'Posted a question', 1, '0000-00-00 00:00:00', '2017-10-28 19:17:35'),
(4, 'Posted a question', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Answered a question', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Answered a question', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'updated', 1, '2017-10-28 15:38:28', '2017-10-28 15:52:33'),
(8, 'erikson', 4, '2017-10-28 16:51:32', '2017-10-28 19:12:21'),
(9, 'erikson', 1, '2017-10-28 16:52:42', '2017-10-28 16:52:42'),
(10, 'noskire1111', 2, '2017-10-28 17:02:21', '2017-10-28 19:14:04'),
(11, 'adf', 2, '2017-10-28 17:18:19', '2017-10-28 17:18:19'),
(12, 'adf', 2, '2017-10-28 17:18:54', '2017-10-28 17:18:54'),
(13, 'asdf', 3, '2017-10-28 19:28:04', '2017-10-28 19:28:04'),
(14, 'asdf', 1, '2017-10-28 19:28:17', '2017-10-28 19:28:17'),
(15, 'noskiressss', 2, '2017-10-28 19:29:37', '2017-10-28 19:29:37'),
(16, 'noskiressss', 2, '2017-10-28 19:29:55', '2017-10-28 19:29:55'),
(17, 'noskiressss', 2, '2017-10-28 19:30:14', '2017-10-28 19:30:14'),
(18, 'noskiressss', 2, '2017-10-28 19:31:32', '2017-10-28 19:31:32'),
(19, 'aaannn', 3, '2017-10-28 19:32:31', '2017-10-28 19:32:31'),
(20, 'erikson b syonet', 3, '2017-10-28 19:32:45', '2017-10-28 19:32:45'),
(21, 'nothing nothing', 2, '2017-10-29 11:52:49', '2017-10-29 11:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `multiple_choice`
--

CREATE TABLE `multiple_choice` (
  `multiple_choice_id` int(11) NOT NULL,
  `question_code` varchar(10) NOT NULL,
  `choice` varchar(10) NOT NULL,
  `choice_desc` varchar(150) NOT NULL,
  `is_correct` int(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multiple_choice`
--

INSERT INTO `multiple_choice` (`multiple_choice_id`, `question_code`, `choice`, `choice_desc`, `is_correct`, `created_at`, `updated_at`) VALUES
(1, 'Q0103-001', 'a', 'Erap', 0, '2017-11-03 01:34:21', '2017-11-03 01:34:21'),
(2, 'Q0103-001', 'b', 'Gloria', 0, '2017-11-03 01:34:21', '2017-11-03 01:34:21'),
(3, 'Q0103-001', 'c', 'Erik', 0, '2017-11-03 01:34:21', '2017-11-03 01:34:21'),
(4, 'Q0103-001', 'd', 'Duterte', 0, '2017-11-03 01:34:21', '2017-11-03 01:34:21'),
(5, 'Q0103-002', 'a', 'Rome', 0, '2017-11-03 01:43:21', '2017-11-03 01:43:21'),
(6, 'Q0103-002', 'b', 'Adm', 0, '2017-11-03 01:43:21', '2017-11-03 01:43:21'),
(7, 'Q0103-002', 'c', 'Bry', 0, '2017-11-03 01:43:21', '2017-11-03 01:43:21'),
(8, 'Q0103-002', 'd', 'Jeric', 0, '2017-11-03 01:43:21', '2017-11-03 01:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `multiple_choice_answer`
--

CREATE TABLE `multiple_choice_answer` (
  `question_answer_id` int(11) NOT NULL,
  `question_code` varchar(10) NOT NULL,
  `answer` varchar(150) NOT NULL,
  `student_id` int(11) NOT NULL,
  `points` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multiple_choice_answer`
--

INSERT INTO `multiple_choice_answer` (`question_answer_id`, `question_code`, `answer`, `student_id`, `points`) VALUES
(1, 'Q0103-001', '4', 3, 0),
(2, 'Q0103-001', '2', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`) VALUES
(1, 1, 'Post 1'),
(2, 1, 'Post 2'),
(3, 1, 'Post 3'),
(4, 2, 'Post 4'),
(5, 2, 'Post 5');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `category_code` varchar(50) NOT NULL,
  `type_code` varchar(30) NOT NULL,
  `is_verified` int(1) NOT NULL,
  `question_code` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `description`, `title`, `category_code`, `type_code`, `is_verified`, `question_code`, `student_id`, `created_at`, `updated_at`) VALUES
(1, '<div><!--block-->Who is the current president of the Philippines?</div>', 'President', 'ADAPTER', 'MULTIPLE_CHOICE', 0, 'Q0103-001', 1, '2017-11-03 01:34:21', '2017-11-03 01:34:21'),
(3, '<div><!--block-->Who is the founder of facebook?</div>', 'Social Media', 'COMPOSITE', 'MULTIPLE_CHOICE', 0, 'Q0103-002', 1, '2017-11-03 01:43:21', '2017-11-03 01:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `fName` varchar(25) NOT NULL,
  `mName` varchar(25) NOT NULL,
  `lName` varchar(25) NOT NULL,
  `suffix` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `fName`, `mName`, `lName`, `suffix`) VALUES
(1, 'Erik', 'Bosi', 'Son', ''),
(2, 'Rom', 'Wal', 'Do', ''),
(3, 'Bry', 'Po', 'Gi', 'Jr');

-- --------------------------------------------------------

--
-- Table structure for table `users-x`
--

CREATE TABLE `users-x` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `slug` text NOT NULL,
  `userType` text NOT NULL,
  `ask_points` int(11) NOT NULL,
  `answer_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users-x`
--

INSERT INTO `users-x` (`id`, `username`, `password`, `fname`, `lname`, `slug`, `userType`, `ask_points`, `answer_points`) VALUES
(48, 'a@a.com', '$2y$10$UgV86vHt9B4NvEEhpDKavukAoJINIPz9nTLSvYIrOs8lz4aSnF3jq', 'John', 'Doe', 'John.Doe', 'student', 2, 0),
(49, 'b@b.com', '$2y$10$wIkN7/jteb5Hfbu75JL.luqudv5Lpe4sVyrfG7QWu3cExtBJLnYLi', 'Juan', 'Doe', 'Juan.Doe', 'student', 0, 0),
(80, 'admin@admin.com', '$2y$10$MOpeJpMcwtMo9lawliracehdm5IIWcIHs2fg5xV.mB3pVUMAitGva', 'admin', 'admin', 'admin.admin', 'admin', 0, 0),
(94, 'c@c.com', '$2y$10$dTbDyMYVeIT3pbXR.CN5leAW0t43vhEOCSiGTW79K3Hdstb3wQ9Yi', 'John', 'Juan', 'John.Juan', 'student', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `accounttypes`
--
ALTER TABLE `accounttypes`
  ADD PRIMARY KEY (`accountTypeID`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`ans_id`);

--
-- Indexes for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD PRIMARY KEY (`assigned_role_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `multiple_choice`
--
ALTER TABLE `multiple_choice`
  ADD PRIMARY KEY (`multiple_choice_id`);

--
-- Indexes for table `multiple_choice_answer`
--
ALTER TABLE `multiple_choice_answer`
  ADD PRIMARY KEY (`question_answer_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users-x`
--
ALTER TABLE `users-x`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `accounttypes`
--
ALTER TABLE `accounttypes`
  MODIFY `accountTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `ans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  MODIFY `assigned_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `multiple_choice`
--
ALTER TABLE `multiple_choice`
  MODIFY `multiple_choice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `multiple_choice_answer`
--
ALTER TABLE `multiple_choice_answer`
  MODIFY `question_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users-x`
--
ALTER TABLE `users-x`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
