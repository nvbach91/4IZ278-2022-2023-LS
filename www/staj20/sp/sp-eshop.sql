-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2023 at 08:28 PM
-- Server version: 10.10.3-MariaDB
-- PHP Version: 8.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp-eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `zip` int(11) NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `street` text NOT NULL,
  `additional_info` text DEFAULT NULL,
  `email` text NOT NULL,
  `phone` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `name`, `zip`, `country`, `city`, `street`, `additional_info`, `email`, `phone`, `user_id`, `address_type`) VALUES
(0, 'a', 0, 'a', 'a', 'a', '', 'asdfasdf@dh.cz', '', NULL, NULL),
(1, 'a', 1, 'a', 'a', 'a', '', 'asdfasdf@dh.cz', '', NULL, NULL),
(2, 'test2', 1234, 'test', 'test', 'test', '/ne', 'test@test.com', '', NULL, NULL),
(3, 'test', 1234, 'test', 'test', 'testq', '', 'test@test.com', '1234', NULL, NULL),
(4, 'test', 1, 'test', 'test', 'test', '', 'test@test.com', '', NULL, NULL),
(5, '1', 1, '1', '1', '1', '1', 'test@test.com', '1', NULL, NULL),
(6, '1', 1, '1', '1', '1', '1', 'test@test.com', '1', 0, NULL),
(7, 'googlelover', 1, 'google', 'google', 'google', '', 'google@google.zip', '1', NULL, NULL),
(8, '9', 9, '9', '9', '9', '9', 'test@test.com', '9', 2, NULL),
(9, '9', 9, '9', '9', '9', '9', 'test@test.com', '9', NULL, NULL),
(10, '9', 9, '9', '9', '9', '9', 'test@test.com', '9', 2, NULL),
(11, '8', 8, '8', '8', '8', '8', 'test@test.com', '8', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Krámy');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_status` int(11) DEFAULT NULL,
  `address_shipping` int(11) NOT NULL,
  `address_billing` int(11) NOT NULL,
  `total_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `last_status`, `address_shipping`, `address_billing`, `total_price`) VALUES
(0, 0, 2, 1, 1, 999),
(1, 0, 6, 1, 1, 1998),
(2, 1, 3, 2, 2, 999),
(3, 1, 5, 4, 4, 5697),
(4, 2, 7, 7, 7, 8991),
(5, 2, 8, 7, 7, 999),
(6, 2, 9, 11, 11, 999);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `price` double NOT NULL,
  `amount` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`price`, `amount`, `order_id`, `product_id`) VALUES
(999, 1, 0, 1),
(999, 2, 1, 1),
(999, 1, 2, 1),
(499, 1, 3, 2),
(1199, 1, 3, 3),
(3999, 1, 3, 5),
(999, 9, 4, 1),
(999, 1, 5, 1),
(999, 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` text NOT NULL,
  `information` text DEFAULT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `date`, `status`, `information`, `order_id`) VALUES
(0, '2023-06-19 15:24:23', 'Vytvoření objednávky', 'Vytvoření objednávky', 0),
(1, '2023-06-19 15:24:55', 'Vytvoření objednávky', 'Vytvoření objednávky', 1),
(2, '2023-06-19 15:25:13', 'Objednávka ignorována', '', 0),
(3, '2023-06-20 10:12:12', 'Vytvoření objednávky', 'Vytvoření objednávky', 2),
(4, '2023-06-20 14:06:17', 'Vytvoření objednávky', 'Vytvoření objednávky', 3),
(5, '2023-06-20 14:16:39', 'Objednávka zastavena', 'admin si myslí, že tyhle krámy nechcete', 3),
(6, '2023-06-20 14:17:27', 'test', '', 1),
(7, '2023-06-20 14:31:26', 'Vytvoření objednávky', 'Vytvoření objednávky', 4),
(8, '2023-06-20 15:05:35', 'Vytvoření objednávky', 'Vytvoření objednávky', 5),
(9, '2023-06-20 15:36:44', 'Vytvoření objednávky', 'Vytvoření objednávky', 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `internal_name` text NOT NULL,
  `description` text NOT NULL,
  `description_long` text NOT NULL,
  `img` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `status` text NOT NULL,
  `price` double NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `internal_name`, `description`, `description_long`, `img`, `stock`, `status`, `price`, `category_id`) VALUES
(1, 'Pozlacená sklenička', 'sklenvelka', 'Ozdobená pozlacená 100ml sklenička', 'Kvalitní pozlacená ozdobená sklenička z 40.let 20.století', '/assets/img/sklenvelka-min.jpg', 27, 'in stock', 999, 1),
(2, 'Pozlacená sklenička malá', 'sklenmala', 'Ozdobená pozlacená 20ml malá sklenička', 'Ozdobená pozlacená 20ml malá sklenička', '/assets/img/sklenmala-min.jpg', 8, 'in stock', 399, 1),
(3, 'Dřevěná nádoba', 'sud', 'Dřevěná uzavíratelná nádoba na pivo 500ml', 'Dřevěná uzavíratelná nádoba na pivo 500ml', '/assets/img/sud-min.jpg', 3, 'in stock', 1199, 1),
(4, 'Zdobená vása', 'vasa', 'Zlatem ozdobená keramická vása', 'Zlatem ozdobená keramická vása', '/assets/img/vasa-min.jpg', 0, 'out of stock', 1499, 1),
(5, 'Historická autíčka', 'auta', 'Historické sběratelské modely aut', 'Historické sběratelské modely aut', '/assets/img/auta-min.jpg', 2, 'in stock', 3999, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `privilege` int(11) NOT NULL,
  `default_address` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `privilege`, `default_address`) VALUES
(0, 'admin', 'sdfxcvsdfxcv@protonmail.com', '$2y$10$xDJ4gG/NmBidX4XwecVyGul/BgiM6Q3YxWoxn7JVy0mXQtMvfo2pm', 9001, NULL),
(1, 'test', 'test@test.com', '$2y$10$aK7Ti7N2Aq3TFkKyrKtkVeOqrI.ScMQe7AkS11k9INfPBCLYRsMYO', 1, NULL),
(2, '116216792965883450005', 'psaniac@protonmail.com', 'googleUser', 1, 8),
(3, 'lobster', 'lobster@a.info', '$2y$10$9NafAA4YSkJwYWwWEeotP.xF3m63q1GJkyzP3GWTxd9A69suaENBm', 1, NULL),
(4, 'psaniac', 'psaniac@gmail.com', '$2y$10$aenkwml/U76qS56aK0VfceHnDYFymiiXs.kRF1De/iAGWwp6/a/5K', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `users_idx` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `orders__idx` (`last_status`),
  ADD KEY `billing_address` (`address_billing`),
  ADD KEY `shipping_address` (`address_shipping`),
  ADD KEY `users_fk` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `products_fk` (`product_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`),
  ADD KEY `orders_fkv1` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_fk` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `default_address` (`default_address`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `user_address` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `billing_address` FOREIGN KEY (`address_billing`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `shipping_address` FOREIGN KEY (`address_shipping`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `orders_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `products_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `order_status`
--
ALTER TABLE `order_status`
  ADD CONSTRAINT `orders_fkv1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `default_address` FOREIGN KEY (`default_address`) REFERENCES `address` (`address_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
