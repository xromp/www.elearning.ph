-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2018 at 02:48 PM
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
  `account_id` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pword` varchar(60) NOT NULL,
  `accountTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `studID`, `email`, `pword`, `accountTypeID`) VALUES
(1, 1, 'e@e.com', '$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy', 2),
(2, 2, 'r@r.com', '$2y$10$6C6VlaYAEUk.gA.ceS5y6OhXyFKRtZ/lJWuXi8qSRVaCO/toEhVSi', 2),
(3, 3, 'c@c.com', '$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu', 1),
(4, 4, 'a@a.com', '$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu', 2),
(5, 5, 'b@b.com', '$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu', 2),
(6, 6, 'c@c.com', '$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu', 2),
(7, 7, 'q1@com', '$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy', 2),
(8, 8, 'q2@com', '$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy', 2),
(9, 9, 'q3@com', '$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy', 2),
(10, 10, 'admin1@com', '$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy', 1),
(11, 11, 'answer1@com', '$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy', 2);

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
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `achievement_id` int(11) NOT NULL,
  `achievement_code` varchar(250) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `is_achieved` bit(1) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `question_code` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `answer` varchar(1000) DEFAULT NULL,
  `is_correct` bit(1) DEFAULT NULL,
  `points` decimal(18,3) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `answer_multiple_choices`
--

CREATE TABLE `answer_multiple_choices` (
  `answer_choices_id` int(11) NOT NULL,
  `answer_id` varchar(10) NOT NULL,
  `answer` varchar(150) NOT NULL,
  `points` int(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(2) NOT NULL,
  `category_code` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_code`, `description`, `created_at`, `updated_at`) VALUES
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
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `forum_id` int(11) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forums_comments`
--

CREATE TABLE `forums_comments` (
  `forum_comment_id` int(11) NOT NULL,
  `forum_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `log_description` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `multiple_choices`
--

CREATE TABLE `multiple_choices` (
  `multiple_choice_id` int(11) NOT NULL,
  `question_code` varchar(10) NOT NULL,
  `choice_code` varchar(10) NOT NULL,
  `choice_desc` varchar(150) NOT NULL,
  `is_correct` int(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `is_approved` int(1) DEFAULT NULL,
  `question_code` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `points` decimal(18,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `reward_id` int(11) NOT NULL,
  `achievement_code` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `icon_path` varchar(150) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `active` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `entity1` varchar(45) DEFAULT NULL,
  `entity2` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`reward_id`, `achievement_code`, `description`, `title`, `icon_path`, `type`, `active`, `created_at`, `update_at`, `entity1`, `entity2`) VALUES
(1, 'ASK-01', 'Reached 25 points from asking', 'Inquisitive', 'inquisitive.png', 'ASKING', b'1', NULL, NULL, NULL, NULL),
(2, 'ASK-02', 'Asked 1st question ', 'Can you help me?', 'first-question.png', 'ASKING', b'1', NULL, NULL, NULL, NULL),
(3, 'ASK-03', '1st Approved question', 'Good question', 'approved.png', 'ASKING', b'1', NULL, NULL, NULL, NULL),
(4, 'ASK-04', 'Having 20 questions approved', 'Insatiably curious', 'curious.png', 'ASKING', b'1', NULL, NULL, NULL, NULL),
(5, 'ANS-01', 'Reached 75 points from answering', 'Knowledgeable!', 'knowledge.png', 'ANSWER', b'1', NULL, NULL, NULL, NULL),
(6, 'ANS-02', 'Answered 1st question', 'Trying my best', 'first-answer.png', 'ANSWER', b'1', NULL, NULL, NULL, NULL),
(7, 'ANS-03', '1st correct answer', 'I know something', 'right-right.png', 'ANSWER', b'1', NULL, NULL, NULL, NULL),
(8, 'ANS-04', '1st Answer marked as correct in a coding type question', 'I can code', 'can-code.png', 'ANSWER', b'1', NULL, NULL, NULL, NULL),
(9, 'PTP-01', 'Mastered All Categories', 'Master of All', 'scholar.png', 'PARTICIPATION', b'1', NULL, NULL, NULL, NULL),
(10, 'PTP-02', 'Mastered Abstract Factory Category', 'Abstract Master', 'abstract-shape.png', 'PARTICIPATION', b'1', NULL, NULL, 'ABSTRACT-FACTORY', 'CATEGORYGROUP'),
(11, 'PTP-03', 'Mastered Adapter Category', 'Adapter Master', 'adapter.png', 'PARTICIPATION', b'1', NULL, NULL, 'ADAPTER', 'CATEGORYGROUP'),
(12, 'PTP-04', 'Mastered Composite Category', 'Composite Master', 'composer.png', 'PARTICIPATION', b'1', NULL, NULL, 'COMPOSITE', 'CATEGORYGROUP'),
(13, 'PTP-05', 'Mastered Decorator Category', 'Decorator Master', 'decorator.png', 'PARTICIPATION', b'1', NULL, NULL, 'DECORATOR', 'CATEGORYGROUP'),
(14, 'PTP-06', 'Mastered Factory Method Category', 'Factory Method Master', 'factory.png', 'PARTICIPATION', b'1', NULL, NULL, 'FACTORY-METHOD', 'CATEGORYGROUP'),
(15, 'PTP-07', 'Mastered Observer Category', 'Observer Master', 'observer.png', 'PARTICIPATION', b'1', NULL, NULL, 'OBSERVER', 'CATEGORYGROUP'),
(16, 'PTP-08', 'Mastered Observer Category', 'Strategy Master', 'strategy.png', 'PARTICIPATION', b'1', NULL, NULL, 'STRATEGY', 'CATEGORYGROUP'),
(17, 'PTP-09', 'Mastered Template Method Category', 'Template Master', 'template.png', 'PARTICIPATION', b'1', NULL, NULL, 'TEMPLATE-METHOD', 'CATEGORYGROUP'),
(18, 'PTP-10', 'Reach 25 points overall', 'Approaching the base', '25.png', 'PARTICIPATION', b'1', NULL, NULL, NULL, 'REACHINGGROUP'),
(19, 'PTP-11', 'Reach 50 points overall', 'Halfway there', '50.png', 'PARTICIPATION', b'1', NULL, NULL, NULL, 'REACHINGGROUP'),
(20, 'PTP-12', 'Reach 100 points overall', 'Accomplished', '100.png', 'PARTICIPATION', b'1', NULL, NULL, NULL, 'REACHINGGROUP'),
(21, 'PTP-13', 'Reach 150 points overall', 'Still going?', 'hooked.png', 'PARTICIPATION', b'1', NULL, NULL, NULL, 'REACHINGGROUP'),
(22, 'PTP-14', 'Reach 200 points overall', 'Programming Junkie', 'programming-junkie.png', 'PARTICIPATION', b'1', NULL, NULL, NULL, 'REACHINGGROUP'),
(23, 'PTP-15', 'Reach 500 points overall', 'Programming Genius', 'programming-junkie.png', 'PARTICIPATION', b'1', NULL, NULL, NULL, 'REACHINGGROUP'),
(24, 'PTP-16', '1st Question to be rejected by the admin', 'N O P E ', 'reject.png', 'PARTICIPATION', b'1', NULL, NULL, NULL, NULL),
(25, 'SCA-01', 'Getting 5 replies to your forum post', 'Social', 'social.png', 'SOCIAL', b'1', NULL, NULL, NULL, NULL),
(26, 'SCA-02', 'Posted 5 topics in forum', 'Conversationalist', 'forum.png', 'SOCIAL', b'1', NULL, NULL, NULL, NULL),
(27, 'FNA-01', 'Get first achievement.', 'Baby Steps', 'climbing-stairs.png', 'FUN', b'1', NULL, NULL, NULL, NULL),
(28, 'FNA-02', 'Get all the achievements.', 'The Curator', 'curator.png', 'FUN', b'1', NULL, NULL, NULL, NULL),
(29, 'ARQ-01', 'Getting your first “5 star” rating', 'Five Stars', 'five-stars.png', 'RATINGS', b'1', NULL, NULL, NULL, NULL),
(30, 'ARQ-02', '1st Question rated', 'Rated', 'rated.png', 'RATINGS', b'1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `fName` varchar(25) NOT NULL,
  `mName` varchar(25) NOT NULL,
  `lName` varchar(25) NOT NULL,
  `suffix` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `fName`, `mName`, `lName`, `suffix`, `created_at`, `updated_at`) VALUES
(1, 'Erik', 'Bosi', 'Son', '', NULL, NULL),
(2, 'Rom', 'Wal', 'Do', '', NULL, NULL),
(3, 'Bry', 'Po', 'Gi', 'Jr', NULL, NULL),
(4, 'a', 'a', 'a', 'a', NULL, NULL),
(5, 'b', 'b', 'b', 'b', NULL, NULL),
(6, 'c', 'c', 'c', 'c', NULL, NULL),
(7, 'q1', '', '', '', NULL, NULL),
(8, 'q2', '', '', '', NULL, NULL),
(9, 'q3', '', '', '', NULL, NULL),
(10, 'admin 1', '', '', '', NULL, NULL),
(11, 'answer 1', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `type_code` varchar(45) DEFAULT NULL,
  `description` varchar(60) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'CODING', 'Coding', NULL, NULL),
(2, 'MULTIPLE_CHOICE', 'Multiple Choice', NULL, NULL),
(3, 'IDENTIFICATION', 'Identification', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `accounttypes`
--
ALTER TABLE `accounttypes`
  ADD PRIMARY KEY (`accountTypeID`);

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`achievement_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `answer_multiple_choices`
--
ALTER TABLE `answer_multiple_choices`
  ADD PRIMARY KEY (`answer_choices_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`forum_id`);

--
-- Indexes for table `forums_comments`
--
ALTER TABLE `forums_comments`
  ADD PRIMARY KEY (`forum_comment_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `multiple_choices`
--
ALTER TABLE `multiple_choices`
  ADD PRIMARY KEY (`multiple_choice_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`reward_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `accounttypes`
--
ALTER TABLE `accounttypes`
  MODIFY `accountTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `achievement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answer_multiple_choices`
--
ALTER TABLE `answer_multiple_choices`
  MODIFY `answer_choices_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forums_comments`
--
ALTER TABLE `forums_comments`
  MODIFY `forum_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `multiple_choices`
--
ALTER TABLE `multiple_choices`
  MODIFY `multiple_choice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
