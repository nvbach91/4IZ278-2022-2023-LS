-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 10:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(21, 'Computer'),
(22, 'Book'),
(23, 'Software'),
(24, 'Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `date`, `discount`, `user_id`) VALUES
(31, '2023-03-26 09:10:11', 5, 44),
(32, '2023-03-26 15:59:00', 10, 41),
(33, '2023-03-26 17:01:11', 0, 41),
(34, '2023-03-26 18:19:11', 0, 43),
(35, '2023-03-26 18:14:11', 20, 43),
(36, '2023-03-26 21:30:11', 15, 42);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `special` tinyint(1) NOT NULL,
  `image` text NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `special`, `image`, `category_id`) VALUES
(11, 'Lenovo E15 Laptop', '49.90', 0, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Mango_and_cross_section_edit.jpg', 21),
(12, 'Harry Potter', '60.90', 1, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 22),
(13, 'Moby Dick', '47.90', 0, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 22),
(14, 'Table and chair', '51.90', 0, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 24),
(15, 'Adobe Illustrator', '39.90', 1, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Mango_and_cross_section_edit.jpg', 23),
(16, 'Wardrobe', '59.90', 1, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 24),
(17, 'Samsung Galaxy S21', '899.99', 0, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Mango_and_cross_section_edit.jpg', 21),
(18, 'Apple MacBook Pro', '1499.99', 1, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 22),
(19, 'Sony PlayStation 5', '499.99', 0, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 22),
(20, 'Canon EOS R5', '3899.99', 0, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 23),
(21, 'Nike Air Max 90', '119.99', 1, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Mango_and_cross_section_edit.jpg', 24),
(22, 'Samsung 55\" 4K Smart TV', '899.99', 1, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 24),
(23, 'Apple iPhone 13 Pro', '999.99', 0, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Mango_and_cross_section_edit.jpg', 21),
(24, 'Dell XPS 13 Laptop', '1299.99', 1, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 22),
(25, 'Samsung Galaxy Watch 4', '349.99', 0, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 22),
(26, 'Nikon Z7 II', '2999.99', 0, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 23),
(27, 'Adidas Ultraboost 21', '179.99', 1, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Mango_and_cross_section_edit.jpg', 24),
(28, 'LG OLED 65\" 4K Smart TV', '1999.99', 1, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 24),
(29, 'Google Pixel 6', '799.99', 0, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Mango_and_cross_section_edit.jpg', 21),
(30, 'Amazon Echo Dot', '49.99', 1, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 22),
(31, 'Fitbit Versa 3', '229.99', 0, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 22),
(32, 'Microsoft Surface Pro 8', '1099.99', 0, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `registration_date`, `name`, `email`, `phone`, `address`) VALUES
(41, '2023-03-26 09:10:11', 'Bruce Wayne', 'bw@outlook.com', 123456789, 'Woodfield West'),
(42, '2023-03-26 15:59:00', 'Clark Kent', 'ck@outlook.com', 987654321, 'Rhosddu Road'),
(43, '2023-03-26 17:01:11', 'Lana Lang', 'lang@outlook.com', 456789123, 'Rutherford Poplars'),
(44, '2023-03-26 18:19:11', 'Lex Luthor', 'lx@outlook.com', 654987321, 'Cock & Dolphin Yard'),
(45, '2023-03-26 18:14:11', 'Lois Lane', 'lois@outlook.com', 741258963, 'Westcoombe Avenue'),
(46, '2023-03-26 21:30:11', 'Arthur Curry', 'arthur@outlook.com', 951847623, 'Miles Mews');

--
-- Indexes for dumped tables
--

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
