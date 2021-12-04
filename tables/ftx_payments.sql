-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 05:05 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtcamp_1906645`
--

-- --------------------------------------------------------

--
-- Table structure for table `ftx_payments`
--

CREATE TABLE `ftx_payments` (
  `id` int(11) NOT NULL,
  `uniqlink` varchar(20) NOT NULL,
  `seller` bigint(10) NOT NULL,
  `buyernumber` bigint(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `txnid` varchar(220) NOT NULL,
  `orderid` varchar(220) NOT NULL,
  `paymnet_mode` varchar(220) NOT NULL,
  `txndate` datetime NOT NULL,
  `email_buyer` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ftx_payments`
--

INSERT INTO `ftx_payments` (`id`, `uniqlink`, `seller`, `buyernumber`, `amount`, `txnid`, `orderid`, `paymnet_mode`, `txndate`, `email_buyer`) VALUES
(1, '92F8xb9', 6205836061, 916205836061, 10, 'pay_ITJdm8Zo4RVApM', 'order_ITJdbibjKqyq86', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(2, '92F8xb9', 6205836061, 916205836061, 10, 'pay_ITJzGEMnzw1rFD', 'order_ITJz4GVqnPGDiv', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(3, '92F8xb9', 6205836061, 916205836061, 10, 'pay_ITKUdMKS4KeGd8', 'order_ITKUTRZ4gQe5tU', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(4, 'FTX-n3u24h941', 1234567890, 916205836061, 10, 'pay_ITL8YO7663F0nm', 'order_ITL7ydCE78d8cW', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(5, 'FTX-n3u24h941', 1234567890, 916205836061, 10, 'pay_ITL9dPCArLo5EM', 'order_ITL9WPwY5RZva9', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(6, '92F8xb9', 6205836061, 916205836061, 10, 'pay_ITLEsJr3sBrFcN', 'order_ITLEZCBJrOIMlz', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(7, 'FTX-d9t32x776', 1234567890, 916205836061, 10, 'pay_ITLHkOYUF7EgvY', 'order_ITLHBqRiMzMek9', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(8, 'FTXz8a27k216', 1234567890, 916205836061, 10, 'pay_ITLJmfROCzXkcJ', 'order_ITLJdX9F3FOG0l', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(9, 'FTX-d9t32x776', 1234567890, 916205836061, 10, 'pay_ITLO6ZN5ZSnYeK', 'order_ITLLaOcV73Me5I', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(10, 'FTXu4l74t885', 6205836061, 916205836061, 10, 'pay_ITLX8AMg00GDn8', 'order_ITLWeJfOE05oUq', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(11, 'FTXq0y36x554', 6205836061, 916205836061, 10, 'pay_ITLles7ID6lq8f', 'order_ITLlIOF26eF8K7', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(12, 'FTXq0q13n915', 6205836061, 916205836061, 10, 'pay_ITLzJQnmSYzo6F', 'order_ITLytvbCjy1TVh', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(13, 'FTXc6g37u917', 6205836061, 916205836061, 10, 'pay_ITM4jQ4kfeIcL1', 'order_ITM4NZSS73G7lA', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(14, 'FTXm7j20j154', 6205836061, 916205836061, 10, 'pay_ITM9qa8RCDMq0Q', 'order_ITM9ZTENkixJLp', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(15, 'FTXn6f62e411', 6205836061, 916205836061, 10, 'pay_ITMDMJwUo7D63A', 'order_ITMCx8507U6aOj', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(16, 'FTXy4h16o619', 6205836061, 916205836061, 10, 'pay_ITMMEtS9b4mmfO', 'order_ITMLgGKd8H2jzd', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(17, 'FTXa4z28p512', 6205836061, 916205836061, 10, 'pay_ITMUBz4zrMmuG0', 'order_ITMTjRT1LBcOWn', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(18, 'FTXo6u66z315', 6205836061, 916205836061, 10, 'pay_ITMgmXiICIefIJ', 'order_ITMgUfGTGGEsMr', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(19, 'FTXu3e84c176', 6205836061, 916205836061, 10, 'pay_ITMjZwxeEuRenL', 'order_ITMj8I3lB3EI8M', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com'),
(20, 'FTXv4d54n201', 6205836061, 916205836061, 10, 'pay_ITMog7DYJVwbGC', 'order_ITMoJTJNi37Ocu', 'wallet', '0000-00-00 00:00:00', 'vikash14609@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ftx_payments`
--
ALTER TABLE `ftx_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `txnid` (`txnid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ftx_payments`
--
ALTER TABLE `ftx_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
