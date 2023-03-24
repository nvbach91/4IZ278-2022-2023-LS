-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2023 at 06:09 PM
-- Server version: 10.5.18-MariaDB-0+deb11u1
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nguv03`
--

-- --------------------------------------------------------

--
-- Table structure for table `cv05_users`
--

CREATE TABLE `cv05_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv05_users`
--

INSERT INTO `cv05_users` (`user_id`, `email`, `password`, `privilege`, `name`) VALUES
(1, 'abc@def.com', 'blabla', 0, ''),
(2, 'ghu@qlweh.com', 'xxx', 0, ''),
(3, 'consolidation@abc.def', '$2y$10$wnlRt.0NjJ76ofT4B5kM/OuJge2b8jrMEQbT3ebwTKeeLI1elf/qi', 3, ''),
(4, 'nathan@drake.net', 'blabla', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cv06_categories`
--

CREATE TABLE `cv06_categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv06_categories`
--

INSERT INTO `cv06_categories` (`category_id`, `name`) VALUES
(13, 'Laptops'),
(14, 'Tablets'),
(15, 'Monitors'),
(16, 'Gaming computers'),
(17, 'TestCategory');

-- --------------------------------------------------------

--
-- Table structure for table `cv06_orders`
--

CREATE TABLE `cv06_orders` (
  `order_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `discount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cv06_order_items`
--

CREATE TABLE `cv06_order_items` (
  `order_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cv06_products`
--

CREATE TABLE `cv06_products` (
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `img` text NOT NULL,
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv06_products`
--

INSERT INTO `cv06_products` (`name`, `price`, `img`, `id`, `description`, `category_id`) VALUES
('xomethingelse', 149.9, 'http://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg', 1, 'nlablabla', 13),
('Ataulfo', 60.9, 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg', 2, '', 13),
('Kent', 47.9, 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg', 3, '', 14),
('Haden', 51.9, 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg', 4, '', 17),
('Keitt', 39.9, 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg', 5, '', 15),
('Francine', 59.9, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu', 6, '', 16);

-- --------------------------------------------------------

--
-- Table structure for table `cv06_slides`
--

CREATE TABLE `cv06_slides` (
  `slide_id` int(11) NOT NULL,
  `img` text NOT NULL,
  `alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cv06_slides`
--

INSERT INTO `cv06_slides` (`slide_id`, `img`, `alt`) VALUES
(1, 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 'First slide'),
(2, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Mango_and_cross_section_edit.jpg', 'Second slide'),
(3, 'https://img-aws.ehowcdn.com/877x500p/cpi.studiod.com/www_ehow_com/photos.demandstudios.com/getty/article/228/233/124812932.jpg', 'Third slide');

-- --------------------------------------------------------

--
-- Table structure for table `cv06_users`
--

CREATE TABLE `cv06_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv06_users`
--

INSERT INTO `cv06_users` (`user_id`, `email`, `password`, `privilege`, `name`) VALUES
(1, 'abc@def.com', '$2y$10$F/w39z0hgg8GerFPU6T4LeHKSQjwgVZh3A5IMSLpOTMeGB9nwAjR6', 0, ''),
(2, 'ghu@qlweh.com', '$2y$10$F/w39z0hgg8GerFPU6T4LeHKSQjwgVZh3A5IMSLpOTMeGB9nwAjR6', 0, ''),
(3, 'consolidation@abc.def', '$2y$10$F/w39z0hgg8GerFPU6T4LeHKSQjwgVZh3A5IMSLpOTMeGB9nwAjR6', 3, ''),
(4, 'nathan@drake.net', '$2y$10$F/w39z0hgg8GerFPU6T4LeHKSQjwgVZh3A5IMSLpOTMeGB9nwAjR6', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cv09_goods`
--

CREATE TABLE `cv09_goods` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv09_goods`
--

INSERT INTO `cv09_goods` (`id`, `name`, `price`, `description`, `img`) VALUES
(1, 'Tommy Atkins', 49.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'),
(2, 'Ataulfo', 60.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'),
(3, 'Kent', 47.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'),
(4, 'Haden', 51.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg'),
(5, 'Keitt', 39.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg'),
(6, 'Francine', 59.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu'),
(7, 'Tommy Atkins 2', 49.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'),
(8, 'Ataulfo 3', 60.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'),
(9, 'Kent 4', 47.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'),
(10, 'Haden 5', 51.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg'),
(11, 'Keitt', 39.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg'),
(12, 'Francine 6', 59.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu'),
(13, 'Tommy Atkins 7', 49.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'),
(14, 'Ataulfo 8', 60.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'),
(15, 'Kent 9', 47.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'),
(16, 'Haden 10', 51.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg'),
(17, 'Keitt 11', 39.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg'),
(18, 'Francine 12', 59.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu'),
(19, 'Tommy Atkins 13', 49.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'),
(20, 'Ataulfo 14', 60.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'),
(21, 'Kent 15', 47.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'),
(22, 'Haden 16', 51.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg'),
(23, 'Keitt 17', 39.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg'),
(24, 'Francine 18', 59.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu'),
(25, 'Tommy Atkins 19', 49.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'),
(26, 'Ataulfo 20', 60.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'),
(27, 'Kent 21', 47.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'),
(28, 'Haden 22', 51.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg'),
(29, 'Keitt 23', 39.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg'),
(30, 'Francine 24', 59.9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu');

-- --------------------------------------------------------

--
-- Table structure for table `cv09_products`
--

CREATE TABLE `cv09_products` (
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `img` text NOT NULL,
  `id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv09_products`
--

INSERT INTO `cv09_products` (`name`, `price`, `img`, `id`, `description`) VALUES
('xomethingelse', 149.9, 'http://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg', 1, 'nlablabla'),
('Ataulfo', 60.9, 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg', 2, ''),
('Kent', 47.9, 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg', 3, ''),
('Haden', 51.9, 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg', 4, ''),
('Keitt', 39.9, 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg', 5, ''),
('Francine', 59.9, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu', 6, '');

-- --------------------------------------------------------

--
-- Table structure for table `cv10_orders`
--

CREATE TABLE `cv10_orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cv10_products`
--

CREATE TABLE `cv10_products` (
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv10_products`
--

INSERT INTO `cv10_products` (`name`, `price`, `img`, `product_id`, `description`) VALUES
('xomethingelse', '149.9', 'http://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg', 1, 'nlablabla'),
('Ataulfo', '60.9', 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg', 2, ''),
('Kent', '47.9', 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg', 3, ''),
('Haden', '51.9', 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg', 4, ''),
('Keitt', '39.9', 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg', 5, ''),
('pikachull', '59', 'http://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg', 9, 'xxx');

-- --------------------------------------------------------

--
-- Table structure for table `cv10_users`
--

CREATE TABLE `cv10_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv10_users`
--

INSERT INTO `cv10_users` (`user_id`, `email`, `password`, `privilege`, `name`) VALUES
(1, 'abc@def.com', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 0, ''),
(2, 'ghu@qlweh.com', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 0, ''),
(3, 'consolidation@abc.def', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 3, ''),
(4, 'nathan@drake.net', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 1, ''),
(5, 'consolidation@abc.def', '$2y$10$KUMaJndXDeQqVFymERKvZuenb7NS1O0f5R9S5xlP1M2i5TGm5HATS', 0, 'pikachu');

-- --------------------------------------------------------

--
-- Table structure for table `cv11_products`
--

CREATE TABLE `cv11_products` (
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `img` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `last_updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv11_products`
--

INSERT INTO `cv11_products` (`name`, `price`, `img`, `product_id`, `description`, `last_updated_at`) VALUES
('xomethingelse', 149.9, 'http://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg', 1, 'nlablabla', '0000-00-00 00:00:00'),
('Ataulfo', 60.9, 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg', 2, '', '0000-00-00 00:00:00'),
('Kent', 47.9, 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg', 3, '', '0000-00-00 00:00:00'),
('Haden', 51.9, 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg', 4, '', '0000-00-00 00:00:00'),
('Keitt', 39.9, 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg', 5, '', '0000-00-00 00:00:00'),
('555', 50, 'http://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg', 8, 'xxx', '0000-00-00 00:00:00'),
('sss', 60, 'http://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg', 10, 'xxx', '2023-03-24 17:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `cv11_users`
--

CREATE TABLE `cv11_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv11_users`
--

INSERT INTO `cv11_users` (`user_id`, `email`, `password`, `privilege`, `name`) VALUES
(1, 'abc@def.com', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 0, ''),
(2, 'ghu@qlweh.com', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 0, ''),
(3, 'consolidation@abc.def', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 3, ''),
(4, 'nathan@drake.net', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 1, ''),
(5, 'consolidation@abc.def', '$2y$10$a.T2WU.A9lRCXtd08SsSKexJ5dwAx6XeyUE30ewe80vt2fz0CSQ9q', 0, 'pikachu'),
(6, 'consolidation@abc.def', '$2y$10$3RZ2/WOjCGi.7vQk0Ws0/.dLUTSQK0ApK/Vok/lB0CTTEkkRM4KeS', 0, 'pikachu'),
(7, 'consolidation@abc.def', '$2y$10$RLMnLppNbr4Di5YoXNiNROjyyjayuvEtpKGxw8X/uFrimu2dQJjGS', 0, 'pikachu'),
(8, 'consolidation@abc.def', '$2y$10$uX47QK246H.QK7doHVGEzeA1cKLlnCC0hWI73XqaNwCjvvAq458oq', 0, 'pikachu'),
(9, 'consolidation@abc.def', '$2y$10$cC9VAp66tZoVsoMHsp8I2eNHjtjW97TYtN23vuY0H4/hINreyNQXW', 0, 'pikachu');

-- --------------------------------------------------------

--
-- Table structure for table `cv12_users`
--

CREATE TABLE `cv12_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv12_users`
--

INSERT INTO `cv12_users` (`user_id`, `email`, `password`, `privilege`, `name`) VALUES
(1, 'abc@def.com', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 0, ''),
(2, 'ghu@qlweh.com', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 0, ''),
(3, 'consolidation@abc.def', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 3, ''),
(4, 'nathan@drake.net', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 1, ''),
(5, 'consolidation@abc.def', '$2y$10$a.T2WU.A9lRCXtd08SsSKexJ5dwAx6XeyUE30ewe80vt2fz0CSQ9q', 0, 'pikachu'),
(6, 'consolidation@abc.def', '$2y$10$3RZ2/WOjCGi.7vQk0Ws0/.dLUTSQK0ApK/Vok/lB0CTTEkkRM4KeS', 0, 'pikachu'),
(7, 'consolidation@abc.def', '$2y$10$RLMnLppNbr4Di5YoXNiNROjyyjayuvEtpKGxw8X/uFrimu2dQJjGS', 0, 'pikachu'),
(8, 'consolidation@abc.def', '$2y$10$uX47QK246H.QK7doHVGEzeA1cKLlnCC0hWI73XqaNwCjvvAq458oq', 0, 'pikachu'),
(9, 'consolidation@abc.def', '$2y$10$cC9VAp66tZoVsoMHsp8I2eNHjtjW97TYtN23vuY0H4/hINreyNQXW', 0, 'pikachu');

-- --------------------------------------------------------

--
-- Table structure for table `cv13_users`
--

CREATE TABLE `cv13_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv13_users`
--

INSERT INTO `cv13_users` (`user_id`, `email`, `password`, `privilege`, `name`) VALUES
(1, 'abc@def.com', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 0, ''),
(2, 'ghu@qlweh.com', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 0, ''),
(3, 'consolidation@abc.def', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 3, ''),
(4, 'nathan@drake.net', '$2y$10$Vleq79Q9XktOA8WmQ1VdseNwJpIgZP5e39hWF3y52USCIsYKPocgK', 1, ''),
(5, 'consolidation@abc.def', '$2y$10$a.T2WU.A9lRCXtd08SsSKexJ5dwAx6XeyUE30ewe80vt2fz0CSQ9q', 0, 'pikachu'),
(6, 'consolidation@abc.def', '$2y$10$3RZ2/WOjCGi.7vQk0Ws0/.dLUTSQK0ApK/Vok/lB0CTTEkkRM4KeS', 0, 'pikachu'),
(7, 'consolidation@abc.def', '$2y$10$RLMnLppNbr4Di5YoXNiNROjyyjayuvEtpKGxw8X/uFrimu2dQJjGS', 0, 'pikachu'),
(8, 'consolidation@abc.def', '$2y$10$uX47QK246H.QK7doHVGEzeA1cKLlnCC0hWI73XqaNwCjvvAq458oq', 0, 'pikachu'),
(9, 'consolidation@abc.def', '$2y$10$cC9VAp66tZoVsoMHsp8I2eNHjtjW97TYtN23vuY0H4/hINreyNQXW', 0, 'pikachu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cv05_users`
--
ALTER TABLE `cv05_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cv06_categories`
--
ALTER TABLE `cv06_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cv06_orders`
--
ALTER TABLE `cv06_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cv06_orders_FK_1` (`user_id`);

--
-- Indexes for table `cv06_order_items`
--
ALTER TABLE `cv06_order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `cv06_products`
--
ALTER TABLE `cv06_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv06_slides`
--
ALTER TABLE `cv06_slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `cv06_users`
--
ALTER TABLE `cv06_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cv09_goods`
--
ALTER TABLE `cv09_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv09_products`
--
ALTER TABLE `cv09_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv10_orders`
--
ALTER TABLE `cv10_orders`
  ADD KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cv10_products`
--
ALTER TABLE `cv10_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `cv10_users`
--
ALTER TABLE `cv10_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cv11_products`
--
ALTER TABLE `cv11_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `cv11_users`
--
ALTER TABLE `cv11_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cv12_users`
--
ALTER TABLE `cv12_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cv13_users`
--
ALTER TABLE `cv13_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cv05_users`
--
ALTER TABLE `cv05_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cv06_categories`
--
ALTER TABLE `cv06_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cv06_orders`
--
ALTER TABLE `cv06_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cv06_order_items`
--
ALTER TABLE `cv06_order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cv06_products`
--
ALTER TABLE `cv06_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cv06_slides`
--
ALTER TABLE `cv06_slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cv06_users`
--
ALTER TABLE `cv06_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cv09_goods`
--
ALTER TABLE `cv09_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `cv09_products`
--
ALTER TABLE `cv09_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cv10_products`
--
ALTER TABLE `cv10_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cv10_users`
--
ALTER TABLE `cv10_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cv11_products`
--
ALTER TABLE `cv11_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cv11_users`
--
ALTER TABLE `cv11_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cv12_users`
--
ALTER TABLE `cv12_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cv13_users`
--
ALTER TABLE `cv13_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
