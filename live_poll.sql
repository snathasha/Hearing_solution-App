-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2021 at 08:32 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `live_poll`
--

-- --------------------------------------------------------

--
-- Table structure for table `audience`
--

CREATE TABLE `audience` (
  `id` int(10) NOT NULL,
  `audience_id` varchar(30) NOT NULL,
  `audience_key` varchar(30) NOT NULL,
  `audience_session_room_id` varchar(30) NOT NULL,
  `audience_ip` varchar(200) NOT NULL,
  `audience_visit_status` enum('0','1') NOT NULL,
  `audience_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audience`
--

INSERT INTO `audience` (`id`, `audience_id`, `audience_key`, `audience_session_room_id`, `audience_ip`, `audience_visit_status`, `audience_datetime`) VALUES
(1, 'aud8WSnSd6aDfqB', 'audkeyIcXcREprNhl0', 'sesscztXdEIS9fMw', '::1', '1', '2021-01-27 18:51:27'),
(2, 'audxOFm72XQlVEJ', 'audkeyuNS3pxoRebYX', 'sessjLmVx3IWmoT0', '::1', '1', '2021-01-27 22:41:51'),
(3, 'audW93RbU1jKx8K', 'audkeym8v1C50ooSig', 'sess6ZhL4Xo4hiXy', '::1', '1', '2021-01-28 00:06:21'),
(4, 'aud48botqLq2CxV', 'audkeyYNmIw5PxiX8o', 'sess1pWeMPOOyuH7', '::1', '1', '2021-01-28 00:34:56'),
(5, 'audaCxjMePezGsx', 'audkey2t7wIZ8jWrWN', 'sessIWv5ASZ5NF8z', '::1', '1', '2021-01-28 00:47:29'),
(6, 'audjQBs6xz2woH0', 'audkeyekli50GJ92bi', 'sess576gOsigrsJD', '::1', '1', '2021-01-28 00:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `audience_response`
--

CREATE TABLE `audience_response` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `live_session_id` varchar(30) NOT NULL,
  `live_question_id` varchar(30) NOT NULL,
  `audience_id` varchar(30) NOT NULL,
  `audience_key` varchar(30) NOT NULL,
  `audience_like_status` enum('0','1','2','3') NOT NULL,
  `audience_answer` varchar(150) NOT NULL,
  `audience_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audience_response`
--

INSERT INTO `audience_response` (`id`, `user_id`, `live_session_id`, `live_question_id`, `audience_id`, `audience_key`, `audience_like_status`, `audience_answer`, `audience_datetime`) VALUES
(1, '', 'sesscztXdEIS9fMw', 'livequesK1fkEWU3kPLX', '', 'audkeyIcXcREprNhl0', '2', '', '2021-01-27 19:04:45'),
(2, '', 'sesscztXdEIS9fMw', 'livequesBldvLxzTo7R8', '', 'audkeyIcXcREprNhl0', '1', '', '2021-01-27 19:12:02'),
(3, '', 'sesscztXdEIS9fMw', 'livequesBldvLxzTo7R9', '', 'audkeyIcXcREprNhl0', '1', '', '2021-01-27 19:25:45'),
(4, '', 'sesscztXdEIS9fMw', 'livequesBldvLxzToitg', '', 'audkeyIcXcREprNhl0', '2', '', '2021-01-27 19:25:47'),
(5, '', 'sesscztXdEIS9fMw', 'livequesBldvLxzTfdgt', '', 'audkeyIcXcREprNhl0', '3', '', '2021-01-27 19:25:50'),
(6, '', 'sesscztXdEIS9fMw', 'livequesBldvLxzTjndr', '', 'audkeyIcXcREprNhl0', '3', '', '2021-01-27 19:25:57'),
(7, '', 'sesscztXdEIS9fMw', 'livequesBldvLxzcdvbr', '', 'audkeyIcXcREprNhl0', '1', '', '2021-01-27 19:25:59'),
(8, '', 'sesscztXdEIS9fMw', 'livequesUYn7ZpIBlNTA', '', 'audkeyIcXcREprNhl0', '2', '', '2021-01-27 19:26:02'),
(9, '', 'sessjLmVx3IWmoT0', 'livequesgTNBl7FGmGJH', '', 'audkeyuNS3pxoRebYX', '1', '', '2021-01-27 22:42:30'),
(10, '', 'sess6ZhL4Xo4hiXy', 'livequesqUrTJJF1S3jB', '', 'audkeym8v1C50ooSig', '1', '', '2021-01-28 00:06:56'),
(11, '', 'sess6ZhL4Xo4hiXy', 'livequesNBd3K4rR4Y84', '', 'audkeym8v1C50ooSig', '2', '', '2021-01-28 00:07:19'),
(12, '', 'sess6ZhL4Xo4hiXy', 'liveques0tVKvp5y12Yb', '', 'audkeym8v1C50ooSig', '3', '', '2021-01-28 00:07:38'),
(13, '', 'sess1pWeMPOOyuH7', 'livequesaGAgLY8pJgxW', '', 'audkeyYNmIw5PxiX8o', '1', '', '2021-01-28 00:35:35'),
(14, '', 'sess1pWeMPOOyuH7', 'livequesowVAB7hGFXUr', '', 'audkeyYNmIw5PxiX8o', '2', '', '2021-01-28 00:36:04'),
(15, '', 'sess1pWeMPOOyuH7', 'livequesdW6OoNE5zJLZ', '', 'audkeyYNmIw5PxiX8o', '3', '', '2021-01-28 00:36:29'),
(16, '', 'sess576gOsigrsJD', 'liveques65EAVG9lRk6U', '', 'audkeyekli50GJ92bi', '1', '', '2021-01-28 00:54:37'),
(17, '', 'sess576gOsigrsJD', 'livequesNbGCSL9TUmBa', '', 'audkeyekli50GJ92bi', '2', '', '2021-01-28 00:55:08'),
(18, '', 'sess576gOsigrsJD', 'livequesIJeBjDaghG7p', '', 'audkeyekli50GJ92bi', '3', '', '2021-01-28 00:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `live_questions`
--

CREATE TABLE `live_questions` (
  `id` int(10) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `session_id` varchar(30) NOT NULL,
  `live_question_id` varchar(30) NOT NULL,
  `live_session_question` varchar(200) NOT NULL,
  `live_session_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `live_questions`
--

INSERT INTO `live_questions` (`id`, `user_id`, `session_id`, `live_question_id`, `live_session_question`, `live_session_datetime`) VALUES
(1, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'livequesK1fkEWU3kPLX', 'Should the Project be developed with Angular?', '2021-01-27 18:52:35'),
(2, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'livequesBldvLxzTo7R8', 'Should the Project be Developed with React ?', '2021-01-27 19:06:13'),
(3, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'livequesBldvLxzTo7R9', 'Database Should be MongoDB ?', '2021-01-27 19:11:33'),
(4, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'livequesBldvLxzToitg', 'Using Vue.js ?', '2021-01-27 19:12:31'),
(5, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'livequesBldvLxzTfdgt', 'Distribute some parts to hired 3rd Party Company ?', '2021-01-27 19:14:39'),
(6, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'livequesBldvLxzTjndr', 'Should we bring in New Engineers?', '2021-01-27 19:14:57'),
(7, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'livequesBldvLxzcdvbr', 'If project cost estimation goes over 2k ?', '2021-01-27 19:16:40'),
(8, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'livequesUYn7ZpIBlNTA', 'Can we invest 5k in this project?', '2021-01-27 19:25:18'),
(9, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'liveques0JtAS4FvZ1gE', 'Do we need sponsors ?', '2021-01-27 19:33:51'),
(10, 'usernBT66gNX97e6', 'sesscztXdEIS9fMw', 'livequespUycz2q8uuFx', 'It needs more investment ?', '2021-01-27 19:35:39'),
(11, 'usernBT66gNX97e6', 'sessjLmVx3IWmoT0', 'livequesgTNBl7FGmGJH', 'Meteor will hit the Earth', '2021-01-27 22:42:14'),
(20, 'usernBT66gNX97e6', 'sess576gOsigrsJD', 'liveques65EAVG9lRk6U', 'Test Poll 1', '2021-01-28 00:54:27'),
(21, 'usernBT66gNX97e6', 'sess576gOsigrsJD', 'livequesNbGCSL9TUmBa', 'Test Poll 2', '2021-01-28 00:54:56'),
(22, 'usernBT66gNX97e6', 'sess576gOsigrsJD', 'livequesIJeBjDaghG7p', 'Test Poll 3', '2021-01-28 00:55:20'),
(23, 'usernBT66gNX97e6', 'sess576gOsigrsJD', 'liveques6AlRqIsThqcl', 'Test Poll 4', '2021-01-28 00:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `session_room`
--

CREATE TABLE `session_room` (
  `id` int(11) NOT NULL,
  `session_id` varchar(30) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `session_live_status` enum('0','1','2') NOT NULL,
  `session_topic` varchar(100) NOT NULL,
  `session_creation_time` datetime NOT NULL,
  `session_start_time` datetime NOT NULL,
  `session_end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session_room`
--

INSERT INTO `session_room` (`id`, `session_id`, `user_id`, `session_live_status`, `session_topic`, `session_creation_time`, `session_start_time`, `session_end_time`) VALUES
(1, 'sesscztXdEIS9fMw', 'usernBT66gNX97e6', '2', 'Project Design', '2021-01-27 18:50:53', '2021-01-27 18:51:24', '2021-01-28 00:24:24'),
(2, 'sessFj7ziHqiIgmj', 'usernBT66gNX97e6', '0', 'UI/UX Design Overview', '2021-01-27 18:52:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'sessjLmVx3IWmoT0', 'usernBT66gNX97e6', '2', 'Structure Based Storage', '2021-01-27 19:41:45', '2021-01-27 19:42:08', '2021-01-28 00:05:04'),
(4, 'sessPrOYOE8FXEav', 'usernBT66gNX97e6', '0', 'Agile Methodology', '2021-01-27 19:41:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'sess576gOsigrsJD', 'usernBT66gNX97e6', '2', 'Test Session', '2021-01-28 00:53:12', '2021-01-28 00:53:22', '2021-01-28 00:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `user_id` varchar(16) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pwd` varchar(40) NOT NULL,
  `token_id` varchar(40) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `first_name`, `last_name`, `email`, `pwd`, `token_id`, `date_time`) VALUES
(1, 'usernBT66gNX97e6', 'Stella', 'Rose', 'stellarose@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'e9HSK6JqRa99eK8TMSCX', '2021-01-27 18:50:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audience`
--
ALTER TABLE `audience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audience_response`
--
ALTER TABLE `audience_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_questions`
--
ALTER TABLE `live_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_room`
--
ALTER TABLE `session_room`
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
-- AUTO_INCREMENT for table `audience`
--
ALTER TABLE `audience`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `audience_response`
--
ALTER TABLE `audience_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `live_questions`
--
ALTER TABLE `live_questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `session_room`
--
ALTER TABLE `session_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
