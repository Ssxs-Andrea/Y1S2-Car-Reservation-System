-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 03:30 PM
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
-- Database: `comp1044_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_details`
--

CREATE TABLE `car_details` (
  `Car_ID` varchar(30) NOT NULL,
  `Type` varchar(30) DEFAULT NULL,
  `Brand` varchar(30) DEFAULT NULL,
  `Model` varchar(30) DEFAULT NULL,
  `Colour` varchar(30) DEFAULT NULL,
  `License_Plate_Number` varchar(30) NOT NULL,
  `Daily_Rental_Fee` float DEFAULT NULL,
  `Car_Image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_details`
--

INSERT INTO `car_details` (`Car_ID`, `Type`, `Brand`, `Model`, `Colour`, `License_Plate_Number`, `Daily_Rental_Fee`, `Car_Image`) VALUES
('CC001', 'Classics Car', 'Jaguar', 'MK 2', 'White', 'BCS 1234', 2200, 'carimage\\CC001.jpg'),
('CC002', 'Classics Car', 'Rolls Royce', 'Silver Spirit Limousine', 'Georgian Silver', 'AWX 520', 3200, 'carimage\\CC002.jpg'),
('CC003', 'Classics Car', 'MG', 'TD', 'Red', 'BD 19', 2500, 'carimage\\CC003.jpg'),
('LC001', 'Luxurious Car', 'Rolls Royce', 'Phantom', 'Blue', 'BKM 6196', 9800, 'carimage\\LC001.jpg'),
('LC002', 'Luxurious Car', 'Bentley', 'Continental Flying Spur', 'White', 'BKX 9978', 4800, 'carimage\\LC002.jpg'),
('LC003', 'Luxurious Car', 'Mercedes Benz', 'CLS 350', 'Silver', 'BX 4040', 1350, 'carimage\\LC003.jpg'),
('LC004', 'Luxurious Car', 'Jaguar', 'S Type', 'Champagne', 'BKN 8888', 1350, 'carimage\\LC004.jpg'),
('SC001', 'Sports Car', 'Ferrari', 'F430 Scuderia', 'Red', 'BXC 5501', 6000, 'carimage\\SC001.jpg'),
('SC002', 'Sports Car', 'Lamborghini', 'Murcielago LP640', 'Matte Black', 'BSC 3402', 7000, 'carimage\\SC002.jpg'),
('SC003', 'Sports Car', 'Porsche', 'Boxster', 'White', 'BAN 1232', 2800, 'carimage\\SC003.jpg'),
('SC004', 'Sports Car', 'Lexus', 'SC430', 'Black', 'BMW 8989', 1600, 'carimage\\SC004.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `Customer_ID` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone_Number` varchar(255) NOT NULL,
  `Email_Address` varchar(255) NOT NULL,
  `Home_Address` varchar(255) NOT NULL,
  `Postcode` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_details`
--

CREATE TABLE `reservation_details` (
  `Reservation_ID` varchar(255) NOT NULL,
  `Staff_ID` varchar(255) NOT NULL,
  `Customer_ID` varchar(255) DEFAULT NULL,
  `Rental_Start_Date` date DEFAULT NULL,
  `Rental_End_Date` date DEFAULT NULL,
  `Number_Of_Days` int(10) NOT NULL,
  `Total_Fee` float NOT NULL,
  `Car_ID` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_details`
--

CREATE TABLE `staff_details` (
  `Staff_ID` varchar(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Email_Address` varchar(255) DEFAULT NULL,
  `Phone_Number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_details`
--
ALTER TABLE `car_details`
  ADD PRIMARY KEY (`Car_ID`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `reservation_details`
--
ALTER TABLE `reservation_details`
  ADD PRIMARY KEY (`Reservation_ID`);

--
-- Indexes for table `staff_details`
--
ALTER TABLE `staff_details`
  ADD PRIMARY KEY (`Staff_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
