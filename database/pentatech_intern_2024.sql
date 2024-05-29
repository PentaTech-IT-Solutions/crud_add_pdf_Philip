-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 09:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pentatech_intern_2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `firstname`, `lastname`, `position`, `department`, `about`, `image_url`) VALUES
(2, 'Maxwell', 'Ada', 'Senior Accountant', 'Account', 'Good friend, interesting, God fearing, best friend', 'uploads/din1.jpg'),
(4, 'Philip', 'Kofi-Aboagye', 'Senior Software Enginneer', 'IT', 'Good friend, interesting, God fearing, best friend', 'uploads/phil.jpg'),
(5, 'Emmanuella', 'Esiname', 'Teacher', 'Maths', 'Good friend, interesting, God fearing, best friend', 'uploads/can_try5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(70) NOT NULL,
  `email` varchar(60) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `salt`, `password`, `username`, `phone`) VALUES
(1, 'Philip Kofi Aboagye', 'philipab896@gmail.com', '6acc580345dfa2ce62ad7cd3de5f735e', '$2y$10$nX20JKcYyO10lXGtM33RBOJfu/n2fCOhOVVgf/Rqnf3H6TUwOB0SS', 'philip', '0553497824'),
(2, 'Philip Kofi Aboagye', 'philipab896@gmail.com', 'ba1dc53ae69cc230a35a66e45d2bcd57', '$2y$10$zhw/2VtWvFtJ1Dg9lxxv7OIEo1vI/S74eLo6aRSVNZiBJdrJWdfb.', 'aboagye', '0553497824'),
(3, 'Kofi Aboagye', 'phil@gmail.com', '2fd9d036bad8a5446ae1558611333402', '$2y$10$izxWpsGI1ia6AuX06Dss..UUtxE602AudBKf5ccM8eg5PIFFo3lLe', 'aboagye', '0553497824'),
(4, 'gh', 'phi@gmail.com', 'e4c29e15a88d594518405e77a7f4f97c', '$2y$10$HY2grz4KpLCsonfWvpRrWuP6BIZslO1OhyeTTt.nEXST8ZZ/XWXZq', 'gh', '0553497824'),
(5, 'kl', 'ph@gmail.com', 'cb683bae435b6978712dc1658764b7ec', '$2y$10$fr8dhbrqBKKruGtyVbbLVeCBsthjIpgbm3lSqT/.7jk21r3017/Im', 'kl2000', '0553497824'),
(6, 'hh', 'philip@gmail.com', '7eb1adce8192cd6b31b86762218cd216', '$2y$10$tzwjl52FzGfxTT8lCDZlFu.Z0OuoYcPC6jkuMIGCMJcRzyzSi1ljW', 'hjh', '0553497824'),
(7, 'Philip Kofi Aboagye', 'philip@gmail.com', '59e998393e07c50c534d4e3969eed933', '$2y$10$.ztSzHauEoY2RlXt.iH0autw/RaCjxg3F6TtmNizS2TdNbj1f1RQu', 'ph3333', '0553497824'),
(8, 'Philip Kofi Aboagye', 'philip@gmail.com', '9846897e08a5bddf1c66c156247a8915', '$2y$10$NQUZ2YFPtobDAQMYXT3TsOLqqAUCkiBPAOVUswhEDakHjjQo6nuYG', 'philip200', '0553497824'),
(9, 'Philip Kofi Aboagye', 'philip@gmail.com', '0e1121e661c8be6983923ae21fc8e395', '$2y$10$tS4UnZZ5qbJq4Hpj4qmRlegadGwj5t5HSVNUcXguqNpM1B1YaEGOG', 'ph1234', '0553497824');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
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
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
