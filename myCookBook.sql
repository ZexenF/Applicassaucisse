-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Jun 19, 2022 at 02:06 PM
-- Server version: 8.0.29
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myCookBook`
--
DROP DATABASE IF EXISTS `myCookBook`;
CREATE DATABASE `myCookBook` DEFAULT CHARACTER SET utf8;
USE `myCookBook`;
-- --------------------------------------------------------

--
-- Table structure for table `tIngredients`
--

CREATE TABLE `tIngredients` (
  `iIngredientID` int NOT NULL,
  `iIngredientName` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tIngredients`
--

INSERT INTO `tIngredients` (`iIngredientID`, `iIngredientName`) VALUES
(2, 'Saucisse'),
(3, 'Carotte'),
(4, 'Courgette'),
(5, 'Salade'),
(6, 'Tomate'),
(7, 'Semoule'),
(8, 'Sel'),
(9, 'Poivre');

-- --------------------------------------------------------

--
-- Table structure for table `tRecipes`
--

CREATE TABLE `tRecipes` (
  `rRecipeID` int NOT NULL,
  `rRecipeTitle` varchar(255) NOT NULL,
  `rCookTime` int NOT NULL,
  `rPrepTime` int NOT NULL,
  `rRecipeDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tRecipesIngredients`
--

CREATE TABLE `tRecipesIngredients` (
  `riRecipeIngredientID` int NOT NULL,
  `riIngredientAmount` float NOT NULL,
  `rRecipeID` int NOT NULL,
  `iIngredientID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tRecipesSteps`
--

CREATE TABLE `tRecipesSteps` (
  `rsRecipeStepID` int NOT NULL,
  `rsRecipeStepInstruction` varchar(255) NOT NULL,
  `rRecipeStepNumber` int NOT NULL,
  `rRecipeID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tUsers`
--

CREATE TABLE `tUsers` (
  `uUserID` int NOT NULL,
  `uUserMail` varchar(255) NOT NULL,
  `uUserName` varchar(255) NOT NULL,
  `rRecipeID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tIngredients`
--
ALTER TABLE `tIngredients`
  ADD PRIMARY KEY (`iIngredientID`);

--
-- Indexes for table `tRecipes`
--
ALTER TABLE `tRecipes`
  ADD PRIMARY KEY (`rRecipeID`),
  ADD KEY `rRecipeID` (`rRecipeID`);

--
-- Indexes for table `tRecipesIngredients`
--
ALTER TABLE `tRecipesIngredients`
  ADD PRIMARY KEY (`riRecipeIngredientID`),
  ADD KEY `rRecipeID` (`rRecipeID`),
  ADD KEY `iIngredientID` (`iIngredientID`);

--
-- Indexes for table `tRecipesSteps`
--
ALTER TABLE `tRecipesSteps`
  ADD PRIMARY KEY (`rsRecipeStepID`),
  ADD KEY `rRecipeID` (`rRecipeID`);

--
-- Indexes for table `tUsers`
--
ALTER TABLE `tUsers`
  ADD PRIMARY KEY (`uUserID`),
  ADD KEY `rRecipeID` (`rRecipeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tIngredients`
--
ALTER TABLE `tIngredients`
  MODIFY `iIngredientID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tRecipes`
--
ALTER TABLE `tRecipes`
  MODIFY `rRecipeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tRecipesIngredients`
--
ALTER TABLE `tRecipesIngredients`
  MODIFY `riRecipeIngredientID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tUsers`
--
ALTER TABLE `tUsers`
  MODIFY `uUserID` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tRecipesIngredients`
--
ALTER TABLE `tRecipesIngredients`
  ADD CONSTRAINT `tRecipesIngredients_ibfk_1` FOREIGN KEY (`rRecipeID`) REFERENCES `tRecipes` (`rRecipeID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tRecipesIngredients_ibfk_2` FOREIGN KEY (`iIngredientID`) REFERENCES `tIngredients` (`iIngredientID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tRecipesSteps`
--
ALTER TABLE `tRecipesSteps`
  ADD CONSTRAINT `tRecipesSteps_ibfk_1` FOREIGN KEY (`rRecipeID`) REFERENCES `tRecipes` (`rRecipeID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tUsers`
--
ALTER TABLE `tUsers`
  ADD CONSTRAINT `tUsers_ibfk_1` FOREIGN KEY (`rRecipeID`) REFERENCES `tRecipes` (`rRecipeID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
