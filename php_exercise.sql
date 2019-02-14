-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 15, 2018 at 09:45 PM
-- Server version: 10.2.14-MariaDB
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_exercise`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `Full_Name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_Number` int(11) NOT NULL,
  `User_Name` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserType` varchar(255) NOT NULL,
  `AccessTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Image` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `Full_Name`, `email`, `phone_Number`, `User_Name`, `Password`, `UserType`, `AccessTime`, `Image`, `Address`) VALUES
(1, 'James May', 'theLord@therings.com', 723568947, 'enforcer', 'sudo1234', 'super_user', '2018-06-15 14:29:47', 'images/user_1_5b23cd5681ef2mountain.jpg', '104022 -00101 Nairobi'),
(2, 'Jane Doney', 'janey_girl@gmail.com', 722565947, 'admin', 'admin1234', 'administrator', '2018-06-15 21:44:51', 'images/user_2_5b243351661fdmountain.jpg', 'Noru'),
(4, 'the Start', 'you@theedn.com', 123, 'you4', 'you', 'student', '2018-06-15 19:02:40', 'images/user_1_5b240d25a0ac2okay.png', 'reading, UK'),
(5, 'The ShyMaid', 'main@red.com', 123, 'main', 'main', 'administrator', '2018-06-15 21:08:05', 'images/user_1_5b242ab2a3c6dIMG_20171130_215937.jpg', 'reading '),
(6, 'theThird', 'thried@read,com', 12443, 'thirds', 'thirds', 'administrator', '2018-06-15 19:21:07', 'images/user_1_5b2411849d10bIMG_20171104_095223.jpg', 'reading'),
(8, 'Most Many', 'many@mail.com', 123456, 'many', 'many', 'student', '2018-06-15 19:28:20', 'profile.png', 'Ronaldo, Spain'),
(9, 'Boolean', 'nool@mail.com', 1242, 'bool', 'bool', 'student', '2018-06-15 19:29:13', 'profile.png', 'Rest in Peace'),
(10, 'Last Add', 'you@gmail.com', 3842408, 'redding', 'redding', 'student', '2018-06-15 21:21:16', 'profile.png', 'Detroit 34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
