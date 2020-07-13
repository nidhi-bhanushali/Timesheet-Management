-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 11:03 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timesheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `project_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `email`, `contact`, `address`, `project_name`) VALUES
(1, 'abc', 'abc@test.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', 'XYZ'),
(2, 'NIDHI CHANDRESH BHANUSHALI', 'nidhi.cb@somaiya.edu', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', 'test'),
(4, 'harshit', 'harshit.cb@gmail.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', 'test3');

-- --------------------------------------------------------

--
-- Table structure for table `client_project_junc`
--

CREATE TABLE `client_project_junc` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_project_junc`
--

INSERT INTO `client_project_junc` (`id`, `client_id`, `project_id`) VALUES
(15, 1, 10),
(18, 1, 10),
(21, 4, 16),
(22, 1, 10),
(25, 4, 20),
(26, 1, 21),
(27, 4, 22),
(29, 1, 24),
(30, 2, 25),
(31, 4, 26),
(32, 4, 27),
(33, 1, 28),
(34, 1, 29),
(35, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `task_id`) VALUES
(1, 'ldjwaihiaJoiJ;jfjflnfkjnnklnkfnvkjnflknfl', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `notes_id` int(11) NOT NULL,
  `notes_content` varchar(255) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`notes_id`, `notes_content`, `staff_id`, `task_id`) VALUES
(1, 'abcdefghijklmnop', 6, 1),
(3, 'damflmjkllllllhnkjhijhojosfvihnvkdvnlk', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `progress_id` int(11) NOT NULL,
  `progress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`progress_id`, `progress`) VALUES
(1, 'to do'),
(2, 'ongoing'),
(3, 'done');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `hosting_date` date NOT NULL,
  `amount` int(15) NOT NULL,
  `amount_received` int(15) NOT NULL,
  `amount_pending` int(15) NOT NULL,
  `staff_admin_id` int(11) NOT NULL,
  `document_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `client_name`, `start_date`, `end_date`, `status`, `hosting_date`, `amount`, `amount_received`, `amount_pending`, `staff_admin_id`, `document_url`) VALUES
(10, 'XYZ', 'abc', '2020-06-06', '2020-07-01', 'to do', '2020-07-02', 1000, 500, 500, 1, NULL),
(17, 'test3', 'harshit', '2020-06-06', '2020-07-01', 'to do', '2020-07-02', 1000, 300, 700, 1, NULL),
(20, 'test3', 'harshit', '2020-06-06', '2020-07-01', 'to do', '2020-07-02', 90, 45, 10, 1, NULL),
(22, 'MNO', 'harshit', '2020-06-06', '2020-07-01', 'ongoing', '2020-07-02', 55, 30, 25, 1, NULL),
(23, 'RRR', '', '2020-07-25', '2020-07-19', 'to do', '2020-07-24', 55, 35, 15, 1, '6174-'),
(24, 'RRR', 'abc', '2020-08-02', '2020-08-08', 'ongoing', '2020-08-09', 55, 5, 45, 1, '8500-'),
(25, 'kkk', 'NIDHI CHANDRESH BHANUSHALI', '2020-07-10', '2020-07-19', 'ongoing', '2020-07-24', 55, 52, 3, 1, '8215-'),
(26, 'hello', 'harshit', '2020-07-10', '2020-08-07', 'done', '2020-08-08', 3400, 500, 2900, 1, ''),
(27, 'hello', 'harshit', '2020-07-10', '2020-08-07', 'done', '2020-08-08', 3400, 500, 2900, 1, ''),
(28, 'hhh', 'abc', '2020-07-11', '2020-07-25', 'ongoing', '2020-07-27', 55, 35, 20, 1, ''),
(29, 'hhh', 'abc', '2020-07-11', '2020-07-25', 'ongoing', '2020-07-27', 55, 35, 20, 1, '694-'),
(30, 'hhh', 'abc', '2020-07-11', '2020-07-25', 'ongoing', '2020-07-27', 55, 35, 20, 1, '143-');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `social_media` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `social_media`) VALUES
(1, 'admin', 1),
(2, 'frontend development', 0),
(3, 'backend developer', 0),
(4, 'designer', 0),
(5, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role_id` int(11) NOT NULL,
  `document_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `email`, `contact`, `address`, `password`, `role_id`, `document_url`) VALUES
(1, 'NIDHI CHANDRESH BHANUSHALI', 'nidhi.cb@somaiya.edu', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '12345', 1, NULL),
(6, 'harshit', 'harshit.cb@gmail.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '3456', 2, NULL),
(7, 'abc', 'abc@test.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '8899', 3, NULL),
(8, 'john', 'john@test.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '1122', 4, NULL),
(9, 'harsh', 'harsh@test.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '4455', 3, NULL),
(10, 'omkar', 'omkar@test.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '444444', 2, '9657-wall1.jpg'),
(11, 'omkar', 'omkar@test.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '5555', 2, '5500-staff Diagram.png'),
(12, 'jash', 'jash@test.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '9999', 4, '2386-staff Diagram.png'),
(13, 'mayur', 'test@test.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '8888', 5, '2843-ProjectDocumentIndex.pdf'),
(14, 'raj', 'test@test.com', 2147483647, 'A-301, PREM KUNJ,CHANDAN PARK,NAVROJI LANE,GHATKOPAR WEST', '6565', 5, '7670-mario-bg.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff_project_junc`
--

CREATE TABLE `staff_project_junc` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_project_junc`
--

INSERT INTO `staff_project_junc` (`id`, `staff_id`, `project_id`) VALUES
(1, 6, 16),
(2, 7, 16),
(3, 6, 10),
(4, 8, 10),
(5, 7, 19),
(6, 8, 19),
(11, 7, 22),
(12, 9, 22),
(13, 6, 22),
(14, 10, 22),
(15, 8, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_content` varchar(255) NOT NULL,
  `Deadline` date NOT NULL,
  `project_id` int(11) NOT NULL,
  `progress_id` int(11) NOT NULL,
  `document_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_content`, `Deadline`, `project_id`, `progress_id`, `document_url`) VALUES
(1, 'task1', '2020-07-01', 16, 1, ''),
(2, 'task3', '2020-07-01', 10, 2, ''),
(3, 'task2', '2020-07-01', 19, 3, ''),
(6, 'task4', '2020-07-24', 22, 2, ''),
(7, 'task1', '2020-07-25', 22, 3, ''),
(8, 'task1', '2020-07-25', 22, 3, ''),
(9, 'task1', '2020-07-25', 22, 3, ''),
(10, 'task1', '2020-07-18', 22, 3, ''),
(11, 'task1', '2020-07-18', 22, 3, ''),
(12, 'task1', '2020-07-24', 22, 2, ''),
(13, 'task1', '2020-07-24', 22, 2, ''),
(14, 'task1', '2020-07-24', 22, 2, ''),
(15, 'task1', '2020-07-25', 17, 1, '5224-'),
(16, 'task1', '2020-07-25', 17, 1, '9737-'),
(17, 'task1', '2020-07-25', 17, 1, '4035-'),
(18, 'task4', '2020-07-18', 22, 3, '9616-'),
(19, 'MNO', '2020-07-25', 26, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `task_staff_junc`
--

CREATE TABLE `task_staff_junc` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_staff_junc`
--

INSERT INTO `task_staff_junc` (`id`, `staff_id`, `task_id`) VALUES
(1, 6, 1),
(2, 7, 1),
(3, 6, 2),
(4, 8, 2),
(5, 7, 3),
(6, 8, 3),
(7, 7, 6),
(8, 9, 6),
(9, 6, 18),
(10, 10, 18),
(11, 8, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_project_junc`
--
ALTER TABLE `client_project_junc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`notes_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`progress_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `staff_admin_id` (`staff_admin_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `staff_project_junc`
--
ALTER TABLE `staff_project_junc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_staff_junc`
--
ALTER TABLE `task_staff_junc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_project_junc`
--
ALTER TABLE `client_project_junc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `notes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staff_project_junc`
--
ALTER TABLE `staff_project_junc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `task_staff_junc`
--
ALTER TABLE `task_staff_junc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_project_junc`
--
ALTER TABLE `client_project_junc`
  ADD CONSTRAINT `client_project_junc_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `client_project_junc_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`staff_admin_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `staff_project_junc`
--
ALTER TABLE `staff_project_junc`
  ADD CONSTRAINT `staff_project_junc_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `staff_project_junc_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `task_staff_junc`
--
ALTER TABLE `task_staff_junc`
  ADD CONSTRAINT `task_staff_junc_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `task_staff_junc_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
