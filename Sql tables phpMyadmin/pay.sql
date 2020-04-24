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
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `customerID` int(11) NOT NULL,
  `payDate` date DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`customerID`, `payDate`, `amount`) VALUES
(3, '2020-04-11', 5),
(26, '2020-04-22', 50),
(26, '2020-04-18', 5),
(26, '2020-04-18', 4),
(26, '2020-04-04', 5),
(26, '2020-04-09', 3),
(28, '2020-04-17', 60),
(28, '2020-04-09', 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD KEY `customerID` (`customerID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pay`
--
ALTER TABLE `pay`
  ADD CONSTRAINT `pay_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
