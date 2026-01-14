-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2026 at 11:03 AM
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
-- Database: `carsdekho`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '123', '2026-01-13 14:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `image`, `link`, `status`, `created_at`) VALUES
(1, 'The New PUNCH', 'Price starts at ₹5.59 Lakh*', '1768381963_banner.jpg', '#', 1, '2026-01-14 09:12:43'),
(2, 'CURVV', 'Price starts at ₹9.65 Lakh*', '1768382007_banner4.jpg', '#', 1, '2026-01-14 09:13:27'),
(3, 'Altroz', 'All New Altroz Feel Special', '1768382038_banner5.jpg', '#', 1, '2026-01-14 09:13:58'),
(4, 'Tigor', 'Sedan for the Stars', '1768382062_banner6.jpg', '#', 1, '2026-01-14 09:14:22'),
(5, 'Tiago iCNG AMT', 'It is Seriously fun', '1768382085_banner7.jpg', '#', 0, '2026-01-14 09:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `car_type` enum('Hatchback','Sedan','SUV') NOT NULL,
  `fuel_type` varchar(50) DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT 0,
  `is_latest` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `brand`, `price`, `image`, `car_type`, `fuel_type`, `is_popular`, `is_latest`, `status`, `created_at`) VALUES
(1, 'Nexon', 'Tata Motors', '7.31 Lakhs', '1768382344_car 1.jpg', 'SUV', 'Petrol', 1, 1, 1, '2026-01-14 09:19:04'),
(2, 'Tata Safari', 'Tata Motors', '7 Lakhs', '1768382521_car 2.jpg', 'Hatchback', 'Diesel', 1, 1, 1, '2026-01-14 09:22:01'),
(3, 'TATA Sierra Escape Mediocre', 'Tata Motors', '₹11.49 Lakh', '1768383128_car 3.jpg', 'Hatchback', 'Diesel', 1, 0, 1, '2026-01-14 09:32:08'),
(4, 'Tata Harrier', 'Tata Motors', '50 lakh', '1768383199_car4.jpg', 'Sedan', 'Hybrid', 0, 1, 1, '2026-01-14 09:33:19'),
(5, 'The New PUNCH', 'Tata Motors', '15.34 lakh', '1768383261_car 5.jpg', 'Sedan', 'Diesel', 0, 1, 1, '2026-01-14 09:34:21'),
(6, 'Tiago', 'Tata Motors', '9.31 Lakhs', '1768383297_car 6.jpg', 'SUV', 'Hybrid', 1, 0, 1, '2026-01-14 09:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `car_types` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `name`, `phone`, `email`, `address`, `car_types`, `created_at`) VALUES
(1, 'Blythe Saunders', '9758641230', 'Blythe@mailinator.com', 'Quia enim maxime et ', 'Hatchback', '2026-01-14 09:40:39'),
(2, 'Vanna Webb', '7894561230', 'Vanna@mailinator.com', 'Ea quo quisquam null', 'Hatchback, SUV', '2026-01-14 09:41:09'),
(3, 'Neville Baldwin', '6523147890', 'Neville@mailinator.com', 'Qui sint odio dolore', 'Hatchback, Sedan, SUV', '2026-01-14 09:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'site_name', 'CarsDekho', '2026-01-13 14:28:13'),
(2, 'site_tagline', 'Find Your Perfect Car', '2026-01-13 14:28:13'),
(3, 'contact_email', 'info@carsdekho.com', '2026-01-13 14:28:13'),
(4, 'contact_phone', '+91 999999999', '2026-01-13 17:56:23'),
(5, 'address', 'Kirti Nagar, New Delhi, Delhi, 110016', '2026-01-13 17:57:20'),
(6, 'facebook_url', '#', '2026-01-13 14:28:13'),
(7, 'twitter_url', '#', '2026-01-13 14:28:13'),
(8, 'instagram_url', '#', '2026-01-13 14:28:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
