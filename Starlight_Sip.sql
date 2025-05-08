-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2025 at 01:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Starlight_Sip`
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coffees`
--
ALTER TABLE `coffees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`TABLE_NO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coffees`
--
ALTER TABLE `coffees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
