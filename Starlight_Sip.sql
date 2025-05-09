-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2025 at 02:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starlight_sip`
--

-- --------------------------------------------------------

--
-- Table structure for table `coffees`
--

CREATE TABLE `coffees` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffees`
--

INSERT INTO `coffees` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'Latte', 'Smooth blend of espresso and steamed milk.', 300.00, 'latte.jpg', 'HOT DRINKS'),
(2, 'Espresso', 'Strong and bold single-shot coffee.', 220.00, 'esspresso.jpg', 'HOT DRINKS'),
(3, 'Cappuccino', 'Espresso with steamed milk foam.', 300.00, 'cappuccino.jpg', 'HOT DRINKS'),
(4, 'Mocha', 'Espresso with chocolate and milk.', 380.00, 'MATCHA-COFFEE.jpg', 'HOT DRINKS'),
(5, 'Hot Chocolate', 'Rich cocoa blended with steamed milk.', 250.00, 'Hot-Chocolate.jpg', 'HOT DRINKS'),
(6, 'Iced Americano', 'Chilled espresso with water and ice.', 200.00, 'Iced_Americano.jpg', 'COLD DRINKS'),
(7, 'Mango Matcha', 'Fusion of sweet mango and earthy matcha.', 320.00, 'mangomacha.jpg', 'COLD DRINKS'),
(8, 'Iced Mocha', 'Chocolate and espresso over ice.', 280.00, 'icedMocha.jpg', 'COLD DRINKS'),
(9, 'Iced Latte', 'Espresso with cold milk and ice.', 260.00, 'icedlatte.jpg', 'COLD DRINKS'),
(10, 'Macchiato', 'Espresso topped with a dash of foamed milk.', 270.00, 'macchiato.jpg', 'HOT DRINKS'),
(11, 'Iced Macchiato', 'Chilled espresso with milk and foam over ice.', 290.00, 'coldmacchiato.jpg', 'COLD DRINKS'),
(12, 'Iced Tea', 'Refreshing brewed tea served over ice.', 180.00, 'Iced-Tea.JPG', 'COLD DRINKS');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `total_amount`, `status`, `payment_method`, `transaction_id`, `created_at`) VALUES
(1, 'shimlaakter763@gmail.com', 400.00, 'pending', NULL, NULL, '2025-05-08 17:50:29'),
(2, 'shimlaakter763@gmail.com', 2100.00, 'pending', NULL, NULL, '2025-05-08 17:55:42'),
(3, 'shimlaakter763@gmail.com', 1270.00, 'pending', NULL, NULL, '2025-05-08 17:57:49'),
(4, 'shimlaakter763@gmail.com', 280.00, 'pending', NULL, NULL, '2025-05-08 18:00:40'),
(5, 'shimlaakter763@gmail.com', 480.00, 'pending', NULL, NULL, '2025-05-08 18:16:39'),
(6, 'shimlaakter763@gmail.com', 320.00, 'pending', NULL, NULL, '2025-05-08 18:18:22'),
(7, 'shimlaakter763@gmail.com', 320.00, 'pending', NULL, NULL, '2025-05-08 18:21:52'),
(8, 'mimsamia476@gmail.com', 880.00, 'pending', NULL, NULL, '2025-05-09 09:37:19'),
(9, 'mimsamia476@gmail.com', 320.00, 'pending', NULL, NULL, '2025-05-09 09:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `coffee_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `coffee_id`, `quantity`, `price`) VALUES
(1, 1, 6, 2, 200.00),
(2, 2, 6, 1, 200.00),
(3, 2, 8, 2, 280.00),
(4, 2, 4, 1, 380.00),
(5, 2, 7, 3, 320.00),
(6, 3, 9, 2, 260.00),
(7, 3, 5, 3, 250.00),
(8, 4, 8, 1, 280.00),
(9, 5, 6, 1, 200.00),
(10, 5, 8, 1, 280.00),
(11, 6, 7, 1, 320.00),
(12, 7, 7, 1, 320.00),
(13, 8, 7, 1, 320.00),
(14, 8, 8, 2, 280.00),
(15, 9, 7, 1, 320.00);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `TABLE_NO` int(2) NOT NULL,
  `SEAT_NO` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`TABLE_NO`, `SEAT_NO`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'Shimla', 'Aktar', 'shimlaakter763@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(2, 'Mim', 'Samia', 'mimsamia@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'Mim', 'Samia', 'mimsamia476@gmail.com', '4de35585e43001e7436de75dae44b67f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coffees`
--
ALTER TABLE `coffees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `coffee_id` (`coffee_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`TABLE_NO`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coffees`
--
ALTER TABLE `coffees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`coffee_id`) REFERENCES `coffees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
