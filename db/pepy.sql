-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2023 at 11:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pepy`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attr_id` int(11) NOT NULL,
  `attr_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attr_id`, `attr_name`) VALUES
(1, 'Size'),
(2, 'Fabric'),
(3, 'Sleeve');

-- --------------------------------------------------------

--
-- Table structure for table `attr_property`
--

CREATE TABLE `attr_property` (
  `attr_property_id` int(11) NOT NULL,
  `attr_id` int(11) NOT NULL,
  `attr_property_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attr_property`
--

INSERT INTO `attr_property` (`attr_property_id`, `attr_id`, `attr_property_value`) VALUES
(1, 1, 'S'),
(2, 1, 'M'),
(3, 1, 'L'),
(4, 1, 'XL'),
(5, 2, 'Cotton'),
(6, 2, 'Lenin'),
(7, 2, 'Derby'),
(8, 3, 'Half Sleeve'),
(9, 3, 'Full Sleeve'),
(10, 3, 'Sleeveless');

-- --------------------------------------------------------

--
-- Table structure for table `attr_variation`
--

CREATE TABLE `attr_variation` (
  `attr_variation_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `attr_variation_name` varchar(500) NOT NULL,
  `attr_variation_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attr_variation`
--

INSERT INTO `attr_variation` (`attr_variation_id`, `pro_id`, `attr_variation_name`, `attr_variation_price`) VALUES
(1, 1, 'S', '10.00'),
(2, 1, 'M', '20.00'),
(3, 2, 'Cotton-S', '555.00'),
(4, 2, 'Cotton-M', '666.00'),
(5, 2, 'Lenin-S', '777.00'),
(6, 2, 'Lenin-M', '888.00'),
(7, 3, 'Lenin-S-Full Sleeve', '98765.00');

-- --------------------------------------------------------

--
-- Table structure for table `prodetails`
--

CREATE TABLE `prodetails` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodetails`
--

INSERT INTO `prodetails` (`pro_id`, `pro_name`) VALUES
(1, 'pro1'),
(2, 'pro2'),
(3, 'pro3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attr_id`);

--
-- Indexes for table `attr_property`
--
ALTER TABLE `attr_property`
  ADD PRIMARY KEY (`attr_property_id`);

--
-- Indexes for table `attr_variation`
--
ALTER TABLE `attr_variation`
  ADD PRIMARY KEY (`attr_variation_id`);

--
-- Indexes for table `prodetails`
--
ALTER TABLE `prodetails`
  ADD PRIMARY KEY (`pro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attr_property`
--
ALTER TABLE `attr_property`
  MODIFY `attr_property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attr_variation`
--
ALTER TABLE `attr_variation`
  MODIFY `attr_variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prodetails`
--
ALTER TABLE `prodetails`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
