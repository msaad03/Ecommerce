-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2018 at 05:53 AM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `before_update_price`
--

CREATE TABLE `before_update_price` (
  `shipper_id` int(10) NOT NULL,
  `old_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `before_update_price`
--

INSERT INTO `before_update_price` (`shipper_id`, `old_price`) VALUES
(1, 500);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(3, 'Samsung'),
(4, 'Hitachi'),
(5, 'Gucci'),
(6, 'Edenrobe'),
(7, 'Reebok');

--
-- Triggers `brand`
--
DELIMITER $$
CREATE TRIGGER `delete_brand_trigger` AFTER DELETE ON `brand` FOR EACH ROW DELETE FROM product WHERE brand_id=OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'Electronics'),
(4, 'Clothing'),
(5, 'Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(2, 'Karachi'),
(3, 'Hyderabad'),
(4, 'Islamabad');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `email`, `phone`, `password`) VALUES
(3, 'anas', 'jsbdj', 'anas@gmail.com', 78523, 'anas'),
(4, 'ali', 'sdnfj', 'ali@gmail.com', 812, 'ali'),
(5, 'ahmed', 'ac jbadjc', 'ahmed@gmail.com', 85628, 'ahmed'),
(6, 'saad', 'kadfj', 'saad@gmail.com', 87451245, 'saad'),
(7, 'talha', 'jsjdnvj', 'talha@gmail.com', 4854125, 'talha'),
(10, 'aneesh', 'jsdf njn', 'aneesh@gmail.com', 48515, 'aneesh'),
(11, 'taha', 'sbdfh uahfui', 'taha@gmail.com', 525854121, 'taha'),
(12, 'Haris Mughal', 'Hassan Square', 'k163759@nu.edu.pk', 0, 'haris'),
(13, 'Moiz', 'Numaish', '852345', 0, 'moiz'),
(14, 'Muhammad Saad', 'Light house', '525562396', 0, 'saad'),
(15, 'Shehmeer Adil', 'KDA', 'k163807@nu.edu.pk', 85258, 'shehmeer'),
(16, 'Muhammad Adil', 'Jama', 'adilmemon887@gmail.com', 2147483647, 'fast123'),
(17, 'Ahsan', 'malir', 'ahsan@gmail.com', 845184, 'ahsan'),
(18, 'Shaan', 'jabcj', 'shaan@gmail.com', 8452054, 'shaan');

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `customer_history_trigger` AFTER DELETE ON `customer` FOR EACH ROW INSERT INTO customer_history VALUES(OLD.id,OLD.name,OLD.address)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_history`
--

CREATE TABLE `customer_history` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_history`
--

INSERT INTO `customer_history` (`id`, `name`, `address`) VALUES
(0, '', ''),
(2, 'skh', 'oasudh7'),
(1, 'cus1', 'eahjkladklj'),
(2, 'anas', 'kidsfi');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reviews`
--

CREATE TABLE `customer_reviews` (
  `id` int(10) NOT NULL,
  `cus_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `review` varchar(500) NOT NULL,
  `rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `delivery_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`order_id`, `product_id`, `quantity`, `delivery_status`) VALUES
(30, 17, 1, 1),
(31, 18, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderr`
--

CREATE TABLE `orderr` (
  `id` int(10) NOT NULL,
  `cus_id` int(10) NOT NULL,
  `ordering_address` varchar(100) NOT NULL,
  `shipment_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `delivery_time` date NOT NULL,
  `delivery_date` time NOT NULL,
  `total_bill` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderr`
--

INSERT INTO `orderr` (`id`, `cus_id`, `ordering_address`, `shipment_id`, `date`, `time`, `delivery_time`, `delivery_date`, `total_bill`) VALUES
(6, 5, 'karimabad', 1, '2018-12-08', '08:33:09', '0000-00-00', '00:00:00', 2692),
(7, 5, 'gul plaza', 7, '2018-12-08', '08:35:41', '0000-00-00', '00:00:00', 1908),
(9, 3, 'ajbd', 5, '2018-12-08', '10:22:12', '0000-00-00', '00:00:00', 336),
(10, 3, 'ajbd', 5, '2018-12-08', '10:31:41', '0000-00-00', '00:00:00', 336),
(11, 3, 'a knk', 1, '2018-12-08', '10:32:17', '0000-00-00', '00:00:00', 383),
(12, 3, 'wkent', 1, '2018-12-08', '10:34:13', '0000-00-00', '00:00:00', 1704),
(13, 3, 'kasnfk', 2, '2018-12-08', '10:43:31', '0000-00-00', '00:00:00', 2646),
(14, 3, 'aasd', 2, '2018-12-08', '10:44:30', '0000-00-00', '00:00:00', 5288),
(15, 12, 'Hassan Square', 1, '2018-12-09', '09:49:24', '0000-00-00', '00:00:00', 58),
(18, 12, 'af', 1, '2018-12-09', '09:55:59', '0000-00-00', '00:00:00', 1371),
(20, 12, 'asdasd', 1, '2018-12-09', '10:06:54', '0000-00-00', '00:00:00', 383),
(21, 3, 'ksdfnk', 5, '2018-12-09', '11:47:49', '0000-00-00', '00:00:00', 336),
(22, 3, 'asd', 5, '2018-12-09', '01:42:31', '0000-00-00', '00:00:00', 336),
(23, 3, 'asd', 2, '2018-12-09', '03:03:09', '0000-00-00', '00:00:00', 2646),
(24, 3, 'aasd', 2, '2018-12-09', '03:05:08', '0000-00-00', '00:00:00', 1174),
(25, 3, 'aasd', 9, '2018-12-09', '03:06:44', '0000-00-00', '00:00:00', 676),
(26, 3, 'af', 2, '2018-12-09', '09:09:05', '0000-00-00', '00:00:00', 16),
(27, 3, 'aasd', 2, '2018-12-10', '04:11:14', '0000-00-00', '00:00:00', 250),
(28, 3, 'asd', 2, '2018-12-10', '04:35:27', '0000-00-00', '00:00:00', 8),
(29, 3, 'aasd', 5, '2018-12-10', '04:38:54', '0000-00-00', '00:00:00', 27),
(30, 3, 'asd', 3, '2018-12-10', '04:49:23', '0000-00-00', '00:00:00', 28),
(31, 3, 'asd', 2, '2018-12-10', '04:53:04', '0000-00-00', '00:00:00', 108);

--
-- Triggers `orderr`
--
DELIMITER $$
CREATE TRIGGER `AFTER_DELETE_TRIGGER` AFTER DELETE ON `orderr` FOR EACH ROW DELETE FROM payment WHERE order_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `category_id` int(10) NOT NULL,
  `price` float NOT NULL,
  `brand_id` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `size` text NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `price`, `brand_id`, `image`, `size`, `description`) VALUES
(9, 'Branded Handsfree', 3, 333, 3, '../public/product_images/5c0c96a195efe0.91312524.jpg', 'L', 'k asf  jasbj'),
(11, 'Half sleeves shirt', 4, 3.5, 6, '../public/product_images/5c0c97216570c9.15375920.jpg', 'M', 'Half sleeves shirt Half sleeves shirt Half sleeves shirt'),
(12, 'Black t-shirt', 4, 2.4, 7, '../public/product_images/5c0c9777b6c6f5.61675618.jpg', 'L', 'sjkfj ceae j cj dsdjc dj c'),
(13, 'Checked Shirts', 4, 5, 5, '../public/product_images/5c0c97a6b61e61.75287253.jpg', 'M', 'ajf ja fjk'),
(16, 'Round neck T-Shirts', 4, 12, 5, '../public/product_images/5c0d108b9f9c17.11805183.jpg', 'Select Size', 'pack of 3'),
(17, 'product1', 4, 23, 5, '../public/product_images/5c0de203189247.46672467.jpg', 'M', 'js ghajh '),
(18, 'product2', 3, 52, 3, '../public/product_images/5c0de2c68a8145.63500426.jpg', '-', 'a vjajkv sdjv dasj vjksd vjad cvjkA vnk adjv');

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `product_history_trigger` AFTER DELETE ON `product` FOR EACH ROW INSERT INTO product_history VALUES(OLD.id,OLD.name,OLD.category_id,OLD.brand_id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_history`
--

CREATE TABLE `product_history` (
  `product_id` int(10) NOT NULL,
  `product_name` text NOT NULL,
  `cat_id` int(10) NOT NULL,
  `brand_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_history`
--

INSERT INTO `product_history` (`product_id`, `product_name`, `cat_id`, `brand_id`) VALUES
(1, 'product1', 1, 1),
(1, 'Samsung s8', 3, 3),
(2, 'product1', 3, 4),
(3, 'shoes 45', 4, 5),
(4, 'product8', 5, 6),
(7, 'product3', 4, 6),
(15, 'Shirts', 4, 5),
(14, 'Bravo Shirt', 4, 5),
(5, 'Note 8', 3, 4),
(6, 'Smart Watch', 3, 5),
(8, 'Joggers', 4, 7),
(10, 'HeadPhones', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shipment_charges`
--

CREATE TABLE `shipment_charges` (
  `id` int(10) NOT NULL,
  `shipper_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `charges` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipment_charges`
--

INSERT INTO `shipment_charges` (`id`, `shipper_id`, `city_id`, `charges`) VALUES
(1, 3, 2, 50),
(2, 4, 2, 4),
(3, 4, 3, 5),
(5, 5, 2, 3),
(7, 5, 3, 8),
(9, 6, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `shipper`
--

CREATE TABLE `shipper` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `reg_no` int(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipper`
--

INSERT INTO `shipper` (`id`, `name`, `address`, `phone_no`, `reg_no`, `email`, `password`) VALUES
(3, 'tcs', 'sjdfh', 7845, 8452, 'tcs@gmail.com', 'tcs'),
(4, 'leopard', 'siudjv  jisdncj', 8952587, 2147483647, 'leopard@gmail.com', 'leopard'),
(5, 'shipper2', 'sldvm kdc k k sndjv ksj  js vj s jis v sn ', 852858, 454852545, 'shipper2@gmail.com', 'shipper2'),
(6, 'DHL Karachi', 'lalukhet', 6512895, 485415, 'dhlkhi@gmail.com', 'dhl');

--
-- Triggers `shipper`
--
DELIMITER $$
CREATE TRIGGER `shipper_history_trigger` AFTER DELETE ON `shipper` FOR EACH ROW INSERT INTO shipper_history VALUES(OLD.id,OLD.name)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `shipper_history`
--

CREATE TABLE `shipper_history` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipper_history`
--

INSERT INTO `shipper_history` (`id`, `name`) VALUES
(1, 'shipper1'),
(1, 'shipper1'),
(2, 'shipper3');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `reg_no` int(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `address`, `phone_no`, `reg_no`, `email`, `password`) VALUES
(4, 'shop2', 'ahbd hbu', 897412, 123, 'shop2@gmail.com', 'shop2'),
(5, 'shop3', 'wknef jbwjf', 985, 325, 'shop3@gmail.com', 'shop3'),
(6, 'shop4', 'ajs jabsfj', 8451895, 754, 'shop4@gmail.com', 'shop4'),
(7, 'Furniture Mart', 'gole market', 485120, 541, 'furnituremart@gmail.com', 'furnituremart');

--
-- Triggers `shop`
--
DELIMITER $$
CREATE TRIGGER `delete_shop_trigger` BEFORE DELETE ON `shop` FOR EACH ROW DELETE FROM stock WHERE shop_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(10) NOT NULL,
  `shop_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `shop_id`, `product_id`, `quantity`) VALUES
(11, 4, 9, 3),
(13, 4, 11, 50),
(14, 4, 12, 15),
(15, 4, 13, 8),
(18, 5, 16, 47),
(19, 6, 17, 6),
(20, 6, 18, 54);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`(20));

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `customer_reviews_ibfk_2` (`product_id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `shipment_id` (`shipment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `shipment_charges`
--
ALTER TABLE `shipment_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipper_id` (`shipper_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `shipper`
--
ALTER TABLE `shipper`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orderr`
--
ALTER TABLE `orderr`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shipment_charges`
--
ALTER TABLE `shipment_charges`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shipper`
--
ALTER TABLE `shipper`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD CONSTRAINT `customer_reviews_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD CONSTRAINT `ordered_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordered_products_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orderr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderr`
--
ALTER TABLE `orderr`
  ADD CONSTRAINT `orderr_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderr_ibfk_2` FOREIGN KEY (`shipment_id`) REFERENCES `shipment_charges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipment_charges`
--
ALTER TABLE `shipment_charges`
  ADD CONSTRAINT `shipment_charges_ibfk_1` FOREIGN KEY (`shipper_id`) REFERENCES `shipper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipment_charges_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
