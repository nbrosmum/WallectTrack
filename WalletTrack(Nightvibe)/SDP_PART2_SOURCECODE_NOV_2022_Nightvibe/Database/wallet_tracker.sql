-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2023 at 12:29 PM
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
-- Database: `wallet_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses_table`
--

CREATE TABLE `expenses_table` (
  `ExpensesID` int(50) NOT NULL,
  `Expenses_Type` varchar(255) NOT NULL,
  `Amount` int(255) NOT NULL,
  `DateTime` datetime NOT NULL,
  `Description` varchar(255) NOT NULL,
  `UserID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses_table`
--

INSERT INTO `expenses_table` (`ExpensesID`, `Expenses_Type`, `Amount`, `DateTime`, `Description`, `UserID`) VALUES
(4, 'Food', 150, '2023-01-10 21:31:36', 'dinner', 1),
(5, 'Entertainment', 25, '2023-02-14 10:57:08', 'sleeping', 1),
(6, 'Entertainment', 25, '2023-03-11 10:58:50', 'LOL', 1),
(7, 'Rent', 1000, '2023-03-11 13:50:01', 'Home rent', 1);

-- --------------------------------------------------------

--
-- Table structure for table `income_table`
--

CREATE TABLE `income_table` (
  `IncomeID` int(50) NOT NULL,
  `Amount` int(255) NOT NULL,
  `Datetime` datetime NOT NULL,
  `Description` varchar(255) NOT NULL,
  `UserID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income_table`
--

INSERT INTO `income_table` (`IncomeID`, `Amount`, `Datetime`, `Description`, `UserID`) VALUES
(7, 1300, '2023-03-08 12:34:48', 'side income', 1),
(8, 1300, '2023-02-13 15:36:21', 'salary', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`) VALUES
(1, 'Zorus', 'Zorus@gmail.com', 'Zorus@001'),
(4, 'Mum Choon jie', 'Test@gmail.com', 'tEST@001'),
(5, 'Ka joon', 'Test01@gmail.com', 'Test@002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses_table`
--
ALTER TABLE `expenses_table`
  ADD PRIMARY KEY (`ExpensesID`),
  ADD KEY `UserExpensesID` (`UserID`);

--
-- Indexes for table `income_table`
--
ALTER TABLE `income_table`
  ADD PRIMARY KEY (`IncomeID`),
  ADD KEY `UserIncomeID` (`UserID`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses_table`
--
ALTER TABLE `expenses_table`
  MODIFY `ExpensesID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `income_table`
--
ALTER TABLE `income_table`
  MODIFY `IncomeID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses_table`
--
ALTER TABLE `expenses_table`
  ADD CONSTRAINT `UserExpensesID` FOREIGN KEY (`UserID`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `income_table`
--
ALTER TABLE `income_table`
  ADD CONSTRAINT `UserIncomeID` FOREIGN KEY (`UserID`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
