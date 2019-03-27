-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2018 at 07:49 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aglr`
--

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `Id` int(11) NOT NULL,
  `FieldName` varchar(100) NOT NULL,
  `RegisterNumber` int(11) NOT NULL,
  `Dimensions` varchar(10) NOT NULL,
  `Zone` varchar(100) DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `Latitude` double DEFAULT NULL,
  `Longitude` double DEFAULT NULL,
  `ClimaticChars` varchar(300) DEFAULT NULL,
  `LandType` varchar(100) DEFAULT NULL,
  `Value` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`Id`, `FieldName`, `RegisterNumber`, `Dimensions`, `Zone`, `Address`, `Latitude`, `Longitude`, `ClimaticChars`, `LandType`, `Value`) VALUES
(1, 'sssss', 0, '', '', '', 0, 0, NULL, '', 0),
(2, 'teren', 1, '3', 'acasa', ' la bunici', 21000, 45354, 'eccho', 'arabil', 12000),
(3, 'buni', 1, '2', 'acasa', 'in oras', -11.07, 45.8797, 'oil', 'arable', 2000),
(198, 'FieldName', 123, '10000', 'clara', 'Str Sperantei la Parter', 47.1740186, 27.5728553, 'hot', 'arabil', 20000),
(208, 'ana', 0, '', '', '', 0, 0, NULL, '', 0),
(209, '', 0, '', 'sssss', '', 0, 0, NULL, '', 0),
(210, 'sssss', 0, '', '', '', 0, 0, NULL, '', 0),
(211, 'aaaaa', 0, '', '', 'asasa', 0, 0, NULL, '', 0),
(212, 'aaaaaasas', 0, '', '', '', 0, 0, NULL, '', 0),
(213, 'aaaaafsfsdf', 0, '', '', '', 0, 0, NULL, '', 0),
(214, 'ssssXad', 0, '', '', '', 0, 0, NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `Id` int(11) NOT NULL,
  `InterestLabel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intereststofields`
--

CREATE TABLE `intereststofields` (
  `InterestId` int(11) NOT NULL,
  `FieldId` int(11) NOT NULL,
  `InterestDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `Id` int(11) NOT NULL,
  `Description` varchar(30) NOT NULL,
  `FieldId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(124) NOT NULL,
  `UserType` smallint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `Email`, `Password`, `UserType`) VALUES
(12, 'ana', 'ana', 'ana@a.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 1),
(13, 'ana', 'are', 'ana@b.com', 'e9d71f5ee7c92d6dc9e92ffdad17b8bd49418f98', 1),
(14, 'ana', 'maria', 'anamaria@a.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usersfields`
--

CREATE TABLE `usersfields` (
  `UserId` int(11) NOT NULL,
  `FieldId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersfields`
--

INSERT INTO `usersfields` (`UserId`, `FieldId`) VALUES
(12, 1),
(12, 3),
(12, 208),
(12, 209),
(12, 210),
(12, 211),
(12, 212),
(12, 213),
(12, 214);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `Id` int(11) NOT NULL,
  `UserType` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`Id`, `UserType`) VALUES
(1, 'Individual'),
(2, 'Company'),
(3, 'Farm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FieldId` (`FieldId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `usersfields`
--
ALTER TABLE `usersfields`
  ADD PRIMARY KEY (`UserId`,`FieldId`),
  ADD UNIQUE KEY `UserId` (`UserId`,`FieldId`),
  ADD KEY `FK_users_fields_map` (`FieldId`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`FieldId`) REFERENCES `fields` (`Id`);

--
-- Constraints for table `usersfields`
--
ALTER TABLE `usersfields`
  ADD CONSTRAINT `FK_users_fields_map` FOREIGN KEY (`FieldId`) REFERENCES `fields` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usersfields_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`),
  ADD CONSTRAINT `usersfields_ibfk_2` FOREIGN KEY (`FieldId`) REFERENCES `fields` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
