-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 06. čen 2023, 21:16
-- Verze serveru: 10.4.27-MariaDB
-- Verze PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `sp`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_books`
--

CREATE TABLE `sp_books` (
  `book_id` smallint(6) NOT NULL,
  `book_description` text NOT NULL,
  `book_name` varchar(512) NOT NULL,
  `book_author` varchar(512) NOT NULL,
  `price` int(11) NOT NULL,
  `thumbnail_url` varchar(512) NOT NULL,
  `edited_by` varchar(255) DEFAULT NULL,
  `opened_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_books`
--

INSERT INTO `sp_books` (`book_id`, `book_description`, `book_name`, `book_author`, `price`, `thumbnail_url`, `edited_by`, `opened_at`) VALUES
(1, 'It\'s a book about Harry Potter. What else could you want to know?', 'Harry Potter and the philosopher', 'J. K. Rowling', 120, 'https://www.jkrowling.com/wp-content/uploads/2018/01/SorcerersStone_2017.png', 'admin@outlook.com', 1686058823),
(5, 'It\'s a book about Harry Potter. What else could you want to know?', 'Harry Potter and the Prisoner of Azkaban', 'J. K. Rowling', 130, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1630547330i/5.jpg', 'smap01@vse.cz', 1686058809),
(6, 'It\'s a book about Harry Potter. What else could you want to know?', 'Harry Potter and the philosopher\'s stone.', 'J. K. Rowling', 130, 'https://m.media-amazon.com/images/I/81iqZ2HHD-L._AC_UF1000,1000_QL80_.jpg', NULL, NULL),
(7, 'It\'s a book about Harry Potter. What else could you want to know?', 'Harry Potter and the philosopher\'s stone.', 'J. K. Rowling', 130, 'https://m.media-amazon.com/images/I/81iqZ2HHD-L._AC_UF1000,1000_QL80_.jpg', NULL, NULL),
(10, 'Lord of the rings :)', 'Lord of the rings', 'J. Tolkien', 140, 'https://m.media-amazon.com/images/I/71jLBXtWJWL._AC_UF1000,1000_QL80_.jpg', 'smap01@vse.cz', 1685973170),
(11, 'It\'s a book about a dystopian future. It was banned in US and USSR.', '1984', 'George Orwell', 90, 'https://www.knihydobrovsky.cz/thumbs/book-detail/mod_eshop/produkty/598646/1984.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_orders`
--

CREATE TABLE `sp_orders` (
  `order_id` smallint(6) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_user_id` smallint(6) NOT NULL,
  `order_address` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_orders`
--

INSERT INTO `sp_orders` (`order_id`, `order_date`, `order_user_id`, `order_address`) VALUES
(19, '2023-06-06 15:35:58', 1, 'somewhere'),
(20, '2023-06-06 15:36:10', 1, 'somewhere'),
(21, '2023-06-06 15:36:21', 1, 'somewhere'),
(22, '2023-06-06 15:37:20', 2, 'Praha'),
(24, '2023-06-06 21:12:18', 5, 'Facebook');

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_order_item`
--

CREATE TABLE `sp_order_item` (
  `price` int(255) NOT NULL,
  `amount` smallint(6) NOT NULL,
  `order_item_order_id` smallint(6) NOT NULL,
  `order_item_book_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_order_item`
--

INSERT INTO `sp_order_item` (`price`, `amount`, `order_item_order_id`, `order_item_book_id`) VALUES
(420, 3, 19, 10),
(120, 1, 20, 1),
(120, 1, 21, 1),
(130, 1, 21, 5),
(130, 1, 21, 6),
(140, 1, 22, 10),
(270, 3, 22, 11),
(390, 3, 24, 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_reviews`
--

CREATE TABLE `sp_reviews` (
  `review_id` smallint(6) NOT NULL,
  `review_title` varchar(255) NOT NULL,
  `review_text` varchar(255) NOT NULL,
  `review_stars` smallint(6) NOT NULL,
  `review_book_id` smallint(6) NOT NULL,
  `review_user_id` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_reviews`
--

INSERT INTO `sp_reviews` (`review_id`, `review_title`, `review_text`, `review_stars`, `review_book_id`, `review_user_id`) VALUES
(1, 'Great book', 'It\'s a very exciting book.', 5, 1, 2),
(2, 'Good book', 'There\'s nothing less you can say about this story.', 4, 1, 1),
(3, 'Fine book', 'agaegg', 1, 1, 2),
(6, 'Fine book', 'egagag', 4, 1, 2),
(7, 'Fine book', 'geagaeg', 1, 1, 2),
(8, 'Fine book', 'gageagage', 1, 1, 2),
(9, 'Fine book', 'A breathtaking book', 5, 1, 2),
(10, 'Amazing book', 'It was so exciting while reading about the adbventures of our company.', 5, 10, 1),
(11, 'Interesting reading', 'It is a very interesting reading.', 5, 10, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_users`
--

CREATE TABLE `sp_users` (
  `user_id` smallint(6) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(512) NOT NULL,
  `user_privilege` smallint(6) NOT NULL,
  `user_address` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_users`
--

INSERT INTO `sp_users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_privilege`, `user_address`) VALUES
(1, 'admin', 'admin@outlook.com', '$2y$10$eJonkGmN0Hz8V2w8AL0FVeM5oEk4ubeDzXkJMjQtDIvaaLNvlmN0W', 2, 'somewhere'),
(2, 'Patrik Šmátrala', 'smap01@vse.cz', '$2y$10$/ZxnbFkfo1pP75u/6DRLQum90.Fxg0SKiG2rB5RsXoH0KiVtXzoxa', 2, 'Praha'),
(5, 'Patrik Šmátrala', 'patriksmatrala@seznam.cz', 'EAAvPy7WDv0YBAHdGoYwx1THkneiyTysZAhKgalNfTS7nVZCqNcIvmfWuZBDPwqkdLU8rsB0pqj3P3wTfnnSPddmR6zxW9y1OKuWvlxDHofEF0ZBRczjLjU8FWMTAEgtNqRZAOjo2dO3ecYZBS9l2yKbEe8Upr1frhTa0AYU5rdftlQlXUTZC1o8fOGEfidjX0mfA3llhMW6MZCVmtg9ZCxNPdSNPIpHDyXVta2VBwx8i9qaS4RAE8ZCfFHnexN82OMxZBcZD', 1, 'Facebook');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `sp_books`
--
ALTER TABLE `sp_books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `edited_by` (`edited_by`);

--
-- Indexy pro tabulku `sp_orders`
--
ALTER TABLE `sp_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_user_id` (`order_user_id`),
  ADD KEY `orders_user_id_2` (`order_user_id`);

--
-- Indexy pro tabulku `sp_order_item`
--
ALTER TABLE `sp_order_item`
  ADD KEY `order_item_order_id` (`order_item_order_id`),
  ADD KEY `order_item_book_id` (`order_item_book_id`);

--
-- Indexy pro tabulku `sp_reviews`
--
ALTER TABLE `sp_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `review_book_id` (`review_book_id`),
  ADD KEY `review_user_id` (`review_user_id`);

--
-- Indexy pro tabulku `sp_users`
--
ALTER TABLE `sp_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`) USING BTREE;

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `sp_books`
--
ALTER TABLE `sp_books`
  MODIFY `book_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pro tabulku `sp_orders`
--
ALTER TABLE `sp_orders`
  MODIFY `order_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pro tabulku `sp_reviews`
--
ALTER TABLE `sp_reviews`
  MODIFY `review_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pro tabulku `sp_users`
--
ALTER TABLE `sp_users`
  MODIFY `user_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `sp_books`
--
ALTER TABLE `sp_books`
  ADD CONSTRAINT `sp_books_ibfk_1` FOREIGN KEY (`edited_by`) REFERENCES `sp_users` (`user_email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `sp_orders`
--
ALTER TABLE `sp_orders`
  ADD CONSTRAINT `sp_orders_ibfk_1` FOREIGN KEY (`order_user_id`) REFERENCES `sp_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sp_order_item`
--
ALTER TABLE `sp_order_item`
  ADD CONSTRAINT `sp_order_item_ibfk_1` FOREIGN KEY (`order_item_book_id`) REFERENCES `sp_books` (`book_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sp_order_item_ibfk_2` FOREIGN KEY (`order_item_order_id`) REFERENCES `sp_orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `sp_reviews`
--
ALTER TABLE `sp_reviews`
  ADD CONSTRAINT `sp_reviews_ibfk_1` FOREIGN KEY (`review_user_id`) REFERENCES `sp_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sp_reviews_ibfk_2` FOREIGN KEY (`review_book_id`) REFERENCES `sp_books` (`book_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
