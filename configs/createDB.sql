-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2021 at 05:05 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET @@auto_increment_offset=5;
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `localhost-sites` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `localhost-sites`;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites` (
  `websiteID` int(11) NOT NULL,
  `websiteText` varchar(255) NOT NULL,
  `websiteURL` varchar(255) NOT NULL,
  `websiteSort` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`websiteID`, `websiteText`, `websiteURL`, `websiteSort`) VALUES
(10, 'Google (Canada)', 'http%3A%2F%2Fwww.google.ca%2F', 10),
(20, 'Google (US)', 'http%3A%2F%2Fwww.google.com%2F', 20),
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`websiteID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `websiteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;
