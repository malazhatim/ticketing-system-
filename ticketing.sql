 -- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 12:18 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `DeviceID` int(11) NOT NULL,
  `DeviceName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`DeviceID`, `DeviceName`) VALUES
(1, 'Laptop'),
(2, 'PC');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `TicketID` int(11) NOT NULL,
  `TicketNumber` varchar(20) NOT NULL,
  `TicketNumberValue` int(11) NOT NULL,
  `TicketTitle` varchar(250) NOT NULL,
  `TicketDevice` int(11) NOT NULL,
  `TicketUserID` int(11) NOT NULL,
  `TicketDetails` text NOT NULL,
  `TicketStatus` int(11) NOT NULL,
  `TicketHandleBy` int(11) NOT NULL,
  `TicketTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_actions`
--

CREATE TABLE `ticket_actions` (
  `TicketActionID` int(11) NOT NULL,
  `TicketID` int(11) NOT NULL,
  `TicketActionBy` int(11) NOT NULL,
  `TicketActionTime` datetime NOT NULL,
  `TicketActionComment` text NOT NULL,
  `TicketActionPerviousStatus` int(11) NOT NULL,
  `TicketActionNewStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `UserPassword` varchar(100) NOT NULL,
  `UserPhone` varchar(20) NOT NULL,
  `UserType` int(11) NOT NULL,
  `UserSusspend` int(11) NOT NULL DEFAULT 0,
  `Deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserEmail`, `UserName`, `UserPassword`, `UserPhone`, `UserType`, `UserSusspend`, `Deleted`) VALUES
(1, 'admin@admin.com', 'Admin', '202cb962ac59075b964b07152d234b70', '01555788888', 1, 0, 0),
(2, 'support@sss.com', 'support', '202cb962ac59075b964b07152d234b70', '01239020202', 2, 0, 0),
(3, 'user@user.com', 'user', '202cb962ac59075b964b07152d234b70', '9229929292', 3, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`DeviceID`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`TicketID`);

--
-- Indexes for table `ticket_actions`
--
ALTER TABLE `ticket_actions`
  ADD PRIMARY KEY (`TicketActionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `DeviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_actions`
--
ALTER TABLE `ticket_actions`
  MODIFY `TicketActionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */; 
