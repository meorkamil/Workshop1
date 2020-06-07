-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2019 at 05:00 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sesms`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `category_id`, `brand_name`) VALUES
(4, 0, 'Nike'),
(5, 0, 'Adidas'),
(6, 8, 'Gray Nicolls'),
(7, 8, 'GM'),
(8, 9, 'Polygon');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(5, 'Football'),
(6, 'Running'),
(7, 'Rugby'),
(8, 'Cricket'),
(9, 'Cycling'),
(10, 'Fashion');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_status` varchar(13) NOT NULL,
  `file_path` varchar(250) NOT NULL,
  `tracking_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_status`, `file_path`, `tracking_id`) VALUES
(1, 'Success', 'upload/c87be650a953c1e8b4eeb360b2176e5csubjek.JPG', ''),
(2, 'Success', 'upload/120fea3120ed19c69f8a47ed8027dff0subjek.JPG', ''),
(3, 'Pay Later', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_quantity` int(7) NOT NULL,
  `product_price` int(10) NOT NULL,
  `file_path` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_quantity`, `product_price`, `file_path`) VALUES
(14, 6, 5, 'Ultraboost 19', 18, 890, 'upload/ultraboost19.jpg'),
(15, 6, 4, 'Air VaporMax Utility', 28, 950, 'upload/air-vapormax-utility-mens-shoe-l6QV6Q.jpg'),
(16, 5, 4, 'Mercurial Vapor Superfly', 48, 1122, 'upload/superfly-6-elite-fg-game-over-football-boot-LZ1PZD.jpg'),
(17, 6, 5, 'NMD_R1 Shoes', 31, 640, 'upload/NMD_R1.jpg'),
(18, 8, 6, 'Supernova Pro Performance Cricket Bat', 19, 2670, 'upload/supernova.jpg'),
(19, 5, 5, 'NEMEZIZ 18.1 FIRM GROUND BOOTS', 10, 1000, 'upload/NEMEZIZ 18.1 FIRM GROUND BOOTS.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `product_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` varchar(13) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` int(4) NOT NULL,
  `order_date` date NOT NULL,
  `order_address` varchar(250) NOT NULL,
  `order_status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`product_order_id`, `product_id`, `user_id`, `payment_id`, `quantity`, `price`, `order_date`, `order_address`, `order_status`) VALUES
(4, 15, 'user', 1, 1, 950, '2019-04-04', 'NO 197 durian tunggal melaka', 'Paid'),
(5, 17, 'user', 1, 1, 640, '2019-04-04', 'NO 197 durian tunggal melaka', 'Paid'),
(7, 16, 'user', 2, 1, 1122, '2019-04-04', 'qaqaq', 'Paid'),
(8, 16, 'user', 2, 1, 1122, '2019-04-04', 'qaqaq', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(13) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `user_name`, `role`) VALUES
('meor', 'meorkamil97@gmail.com', '263e449ce69e47bd7a853c1dc7c28ce3', 'meor muhammad kamil', 'user'),
('sysadmin', 'test@test.com', '0192023a7bbd73250516f069df18b500', 'MEOR MUHAMMAD KAMIL BIN MEOR', 'admin'),
('tester', 'tester@gmail.com', '8e607a4752fa2e59413e5790536f2b42', 'saya tester', 'user'),
('user', 'workshop1test@gmail.com', '6ad14ba9986e3615423dfca256d04e3f', 'SAYA USER', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`product_order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `product_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
