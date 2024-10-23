-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 11:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `costomer`
--

CREATE TABLE `costomer` (
  `Customer_id` int(11) NOT NULL COMMENT 'Primary',
  `Customer_Name` varchar(50) NOT NULL,
  `Customer_Lastname` varchar(100) NOT NULL,
  `Gender` varchar(5) NOT NULL,
  `Age` int(11) NOT NULL,
  `Birthdate` varchar(10) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `Zipcode` varchar(5) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Customer_Description` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `costomer`
--

INSERT INTO `costomer` (`Customer_id`, `Customer_Name`, `Customer_Lastname`, `Gender`, `Age`, `Birthdate`, `Address`, `Province`, `Zipcode`, `Telephone`, `Customer_Description`, `username`, `password`, `status`) VALUES
(1, 'ยุทธพงค์', 'ขอดขันคำ', 'male', 13, '11-1-2554', '91 หมู่6 ต.ป่าแป๋ อ.แม่แตง', 'เชียงใหม่', '50150', '0932257656', 'jubjubkkkkkkkkkkkkkk', 'yuttaphong', '1234', 0),
(2, 'อ้ายคำ', 'แบกไม้', 'male', 37, '5-4-2530', '100 หมู่6 ต.ดอยเต่า อ.ดอยเต่า', 'เชียงใหม่', '55555', '1234567890', 'sexrdcftvygbuhnjimko,', 'NICEnpx', '123456', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `costomer`
--
ALTER TABLE `costomer`
  ADD PRIMARY KEY (`Customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `costomer`
--
ALTER TABLE `costomer`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
