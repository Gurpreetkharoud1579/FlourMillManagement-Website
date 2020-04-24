-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 22, 2020 at 04:12 PM
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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `paymentDue` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `username`, `address`, `contactNumber`, `paymentDue`, `password`, `created_at`, `firstName`, `lastName`) VALUES
(3, 'gurpreet15', 'sidhuwal', '932792375', 45, '932792375', '2020-04-17 14:16:50', 'ram', 'malhotra'),
(24, 'gurpreet1579', 'sidhuwal', '230472938', 140, '230472938', '2020-04-17 18:34:41', 'gurpreet', 'singh'),
(25, 'harjaap', 'Sangrur', '894859894', 80, '894859894', '2020-04-18 23:54:11', 'Harjaap', 'Singh'),
(26, 'haymant', 'Moga', '340983083', 199, '340983083', '2020-04-21 17:52:22', 'Haymant', 'Mangla'),
(27, 'gursimran', 'Moga', '9847537387', 0, '9847537387', '2020-04-21 17:58:32', 'Gursimran', 'Brar'),
(28, 'kuldeep', 'sidhuwal', '4035804985', 150, '4035804985', '2020-04-22 16:36:26', 'kuldeep', 'kaur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
