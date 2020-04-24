-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 22, 2020 at 04:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flourmillmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE `entry` (
  `entryID` int(11) NOT NULL,
  `entryDate` date DEFAULT NULL,
  `type` varchar(25) NOT NULL,
  `weight` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`entryID`, `entryDate`, `type`, `weight`, `customerID`) VALUES
(1, '2020-04-11', 'Atta', 34, 3),
(2, '2020-04-17', 'Atta', 534, 3),
(3, '2020-04-16', 'Atta', 502, 3),
(4, '2020-04-11', 'Atta', 34, 3),
(5, '2020-04-09', 'Danna', 50, 24),
(6, '2020-04-17', 'Atta', 50, 24),
(7, '2020-04-17', 'Atta', 40, 24),
(8, '2020-04-23', 'Atta', 30, 24),
(9, '2020-04-24', 'Atta', 40, 25),
(10, '2020-04-11', 'Atta', 50, 26),
(11, '2020-04-17', 'Atta', 40, 26),
(12, '2020-04-10', 'Atta', 43, 26),
(13, '2020-04-10', 'Atta', 30, 28),
(14, '2020-04-10', 'Danna', 100, 28),
(15, '2020-04-16', 'Danna', 200, 28),
(16, '2020-04-16', 'Danna', 100, 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`entryID`),
  ADD KEY `customerID` (`customerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `entryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entry`
--
ALTER TABLE `entry`
  ADD CONSTRAINT `entry_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
