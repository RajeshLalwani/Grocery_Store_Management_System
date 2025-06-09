-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 12:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(10) NOT NULL,
  `a_name` varchar(20) NOT NULL,
  `a_bank_detail` varchar(100) NOT NULL,
  `a_phoneno` bigint(10) NOT NULL,
  `a_email` varchar(25) NOT NULL,
  `a_password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_bank_detail`, `a_phoneno`, `a_email`, `a_password`) VALUES
(1, 'harsh', 'bob', 9016582212, 'sharmaharsh0702@gmail.com', '@Harsh7777'),
(5, 'Raj', 'sdxszxs', 8488984951, 'rajlalwani511@gmail.com', '@raj123');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(10) NOT NULL,
  `c_name` varchar(20) DEFAULT NULL,
  `c_email` varchar(25) DEFAULT NULL,
  `c_password` varchar(16) DEFAULT NULL,
  `c_confirmpassword` varchar(16) DEFAULT NULL,
  `c_phoneno` bigint(10) DEFAULT NULL,
  `c_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_email`, `c_password`, `c_confirmpassword`, `c_phoneno`, `c_address`) VALUES
(21, 'sharma rohit', 'sharmaharsh07045@gmail.co', '@Krishna77777', '@Krishna77777', 9016582212, 'bajwa,vadodara'),
(43, 'sharma', 'sharmaharsh07045@gmail.co', '$2y$10$sde0gAWij', NULL, 9016582212, 'bajwa,vadodara'),
(45, 'harsh sharma', 'sharmaharsh07045@gmail.co', '@Harsh7777', '@Harsh7777', 9016582212, 'bajwa,vadodara'),
(48, 'sharma rohit', 'sharmaharsh07045@gmail.co', '$2y$10$71HxEXd5U', NULL, 9016582212, 'bajwa,vadodara'),
(216, 'sharma rohit', 'sharmaharsh07045@gmail.co', '@Krishna4545', '@Krishna4545', 9016582212, 'bajwa,vadodara'),
(432, 'sharma rohit', 'sharmaharsh07045@gmail.co', '@Go99999', '@Go99999', 9016582212, 'bajwa,vadodara'),
(453, 'sharma rohit', 'sharmaharsh07045@gmail.co', '@Krishna4444', '@Krishna4444', 565656434, 'bajwa vadodara'),
(487, 'sharma rohit', 'sharmaharsh07045@gmail.co', '$2y$10$.QgvBJpl9', NULL, 9016582212, 'bajwa,vadodara'),
(543, 'sharma rohit', 'sharmaharsh07045@gmail.co', '$2y$10$a8xblgijy', NULL, 9016582212, 'bajwa,vadodara'),
(654, 'harsh', 'sharmaharsh07045@gmail.co', '@Harsh7777', '@Harsh7777', 9016582212, 'bajwa,vadodara'),
(4532, 'sharma rohit', 'sharmaharsh07045@gmail.co', '@Krishna4444', '@Krishna4444', 9064859745, 'bajwa vadodara'),
(4876, 'sharma rohit', 'sharmaharsh07045@gmail.co', '$2y$10$rUpi0FFMD', NULL, 9016582212, 'bajwa,vadodara'),
(5433, 'sharma rohit', 'sharmaharsh07045@gmail.co', '@Krishna565656', '@Krishna565656', 9016582212, 'bajwa,vadodara'),
(48765, 'sharma', 'sharmaharsh07045@gmail.co', '$2y$10$4PxWPrOBr', NULL, 9016582212, 'bajwa,vadodara'),
(48766, 'sharma rohit', 'sharmaharsh07045@gmail.co', '$2y$10$qDaIIuz/R', NULL, 9016582212, 'bajwa,vadodara'),
(216543, 'sharma rohit', 'sharmaharsh07045@gmail.co', '@Krishna77777', '@Krishna77777', 9016582212, 'bajwa,vadodara'),
(216544, 'golu', 'golu@gmail.com', 'golu', 'golu', 8989898989, 'dttrgth'),
(216545, 'sharma harsh', 'sharmaharsh07045@gmail.co', '@Krishna55555', NULL, 9016582212, 'vadodara , bajwa'),
(216546, 'Raj Lalwani', 'rajlalwani511@gmail.com', '      ', NULL, 8488984951, 'Anand'),
(216547, 'Raj Lalwani ', 'rajlalwani5111@gmail.com', 'kkkkkk', NULL, 8488984951, 'drgtrdtr');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `d_id` int(15) NOT NULL,
  `d_name` int(20) DEFAULT NULL,
  `d_email` int(20) DEFAULT NULL,
  `d_password` int(16) DEFAULT NULL,
  `d_phoneno` bigint(10) DEFAULT NULL,
  `d_bankdetail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(10) NOT NULL,
  `p_id` int(10) DEFAULT NULL,
  `c_id` int(10) DEFAULT NULL,
  `order_detail` varchar(50) DEFAULT NULL,
  `order_price` varchar(20) DEFAULT NULL,
  `order_quantity` varchar(10) DEFAULT NULL,
  `order_status` varchar(30) DEFAULT NULL,
  `order_date` datetime(6) DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `p_id`, `c_id`, `order_detail`, `order_price`, `order_quantity`, `order_status`, `order_date`) VALUES
(95, 15, 654, 'onion', '30', '1', 'Cancelled', NULL),
(96, 19, 654, 'cheese', '68', '1', 'Placed', NULL),
(104, 27, 216545, 'Hot Masala', '250', '1', 'Shipped', '2025-02-11 14:00:26.136313'),
(105, 3, 216544, 'Royal Gala Apple', '260', '1', 'Placed', '2025-04-06 11:38:30.133666'),
(106, 4, 216544, 'apple', '140', '1', 'Placed', '2025-04-06 11:42:39.739331'),
(110, 3, 216547, 'Royal Gala Apple', '260', '1', 'Placed', '2025-04-09 10:29:58.244537');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) NOT NULL,
  `p_type` varchar(50) DEFAULT NULL,
  `p_detail` varchar(20) DEFAULT NULL,
  `p_amount` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `p_type`, `p_detail`, `p_amount`) VALUES
(1, 'Cash on Delivery', 'nhmn', '400'),
(2, 'Cash on Delivery', 'fsedfd', '329'),
(3, 'Cash on Delivery', 'adsd', '329'),
(4, 'Cash on Delivery', 'adsd', '329'),
(5, 'Cash on Delivery', 'fsdf', '329'),
(6, 'Cash on Delivery', 'adsd', '1160'),
(7, 'Cash on Delivery', 'dfsfds', '1160'),
(8, 'Cash on Delivery', 'czsczc', '1160'),
(9, 'Cash on Delivery', 'adsd', '260');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(10) NOT NULL,
  `p_name` varchar(20) DEFAULT NULL,
  `p_price` varchar(20) DEFAULT NULL,
  `p_category` varchar(16) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `weight` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_price`, `p_category`, `image`, `weight`) VALUES
(2, 'mango', '120', 'fruit', 'badammango1.jpg', '1kg'),
(3, 'Royal Gala Apple', '260', 'fruit', 'apple2.jpg', '1kg'),
(4, 'apple', '140', 'fruit', 'apple1.jpg', '1kg'),
(5, 'pomegranate', '160', 'fruit', 'pomegranate1.jpg', '1kg'),
(6, 'grapes', '120', 'fruit', 'grapes1.jpg', '1kg'),
(7, 'kiwi', '90', 'fruit', 'kiwi1.jpg', '300g'),
(9, 'potato', '30', 'vegetable', 'patato.jpg', '1kg'),
(10, 'Tomato', '40', 'vegetable', 'tomato.jpg', '1kg'),
(11, 'capsicum', '60', 'vegetable', 'capsicum1.jpg', '1kg'),
(12, 'pea', '75', 'vegetable', 'pea1.jpg', '1kg'),
(13, 'chilli', '50', 'vegetable', 'chilli.jpg', '500g'),
(14, 'Lemon', '150', 'vegetable', 'lemon.jpg', '1kg'),
(15, 'onion', '30', 'vegetable', 'onion1.jpg', '1kg'),
(16, 'Garlic', '80', 'vegetable', 'garlic1.jpg', '500g'),
(17, 'Dragon Fruit', '90', 'fruit', 'dragon1.jpg', '500g'),
(18, 'butter', '45', 'milk product', 'butter1.jpg', '100g'),
(19, 'cheese', '68', 'milk product', 'cheese.jpg', '100g'),
(20, 'buttermilk', '11', 'milk product', 'buttermilk1.jpg', '400g'),
(21, 'Masti Dahi', '35', 'milk product', 'Dahi1.jpg', '400g'),
(22, 'Amul Lassi', '30', 'milk product', 'lassi2.jpg', '200g'),
(23, 'Paneer', '260', 'milk product', 'panner2.jpg', '500g'),
(24, 'Amul Ghee', '320', 'milk product', 'amulghee1.jpg', '500g'),
(25, 'Amul Milk', '32', 'milk product', 'milk.jpg', '500g'),
(26, 'Red Chilli ', '329', 'grains products', 'chilli1.jpg', '500g'),
(27, 'Hot Masala', '250', 'grains products', 'garam1.jpg', '500g'),
(3340, 'GHGF', '45', 'fruit', 'apple1.jpg', '1kg'),
(3341, 'conclusion', '300', 'milk', 'images.jpg', '1kg');

-- --------------------------------------------------------

--
-- Table structure for table `retail shopkeeper`
--

CREATE TABLE `retail shopkeeper` (
  `r_id` int(15) NOT NULL,
  `r_name` varchar(20) NOT NULL COMMENT 'none_5',
  `r_email` varchar(20) NOT NULL COMMENT 'none_5',
  `r_password` varchar(16) NOT NULL COMMENT 'none_5',
  `r_phoneno` bigint(10) NOT NULL,
  `r_address` varchar(100) NOT NULL,
  `r_bankdetail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `feedback_id` int(15) NOT NULL,
  `c_id` int(10) DEFAULT NULL,
  `c_name` varchar(20) DEFAULT NULL,
  `c_feedback` varchar(50) DEFAULT NULL,
  `c_email` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`feedback_id`, `c_id`, `c_name`, `c_feedback`, `c_email`) VALUES
(2, NULL, 'sharma', 'dfghdg', NULL),
(6, NULL, 'harsh v', 'gfhdgd', NULL),
(8, NULL, 'jainam patel ', 'jyhffg', NULL),
(9, NULL, 'Rohit sharma', 'your website good', 'sharmaharsh0705@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `fk` (`p_id`),
  ADD KEY `fp` (`c_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `retail shopkeeper`
--
ALTER TABLE `retail shopkeeper`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `gk` (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216548;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `d_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3342;

--
-- AUTO_INCREMENT for table `retail shopkeeper`
--
ALTER TABLE `retail shopkeeper`
  MODIFY `r_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `feedback_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`),
  ADD CONSTRAINT `fp` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `gk` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
