-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2023 at 03:18 PM
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
-- Database: `polus_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_details`
--

CREATE TABLE `item_details` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL COMMENT 'product name',
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `tax` int(11) NOT NULL COMMENT 'percentage of tax',
  `sub_total` double NOT NULL,
  `sub_total_tax` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_details`
--

INSERT INTO `item_details` (`id`, `pname`, `quantity`, `unit_price`, `tax`, `sub_total`, `sub_total_tax`) VALUES
(1, 'product1', 1, 1, 1, 0, '0'),
(2, 'produt2', 2, 2, 0, 0, '0'),
(3, 'p', 1, 1, 0, 0, '0'),
(4, 'd1', 1, 1, 0, 0, '0'),
(5, 'aS', 33, 3, 0, 0, '0'),
(6, 'aS', 33, 3, 0, 0, '0'),
(7, 'aS', 33, 3, 0, 0, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_details`
--
ALTER TABLE `item_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_details`
--
ALTER TABLE `item_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
