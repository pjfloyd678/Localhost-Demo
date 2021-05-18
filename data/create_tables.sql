-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2021 at 04:12 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `websiteID` int(11) NOT NULL AUTO_INCREMENT,
  `websiteText` varchar(255) NOT NULL,
  `websiteURL` varchar(255) NOT NULL,
  `websiteSort` int(11) DEFAULT '0',
  PRIMARY KEY (`websiteID`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`websiteText`, `websiteURL`, `websiteSort`) VALUES
('Google CA', 'https%3A%2F%2Fwww.google.ca%2F', 100);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `emailaddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `adminuser` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `emailaddress` (`emailaddress`)
) ENGINE=InnoDB AUTO_INCREMENT=12010 DEFAULT CHARSET=latin1;

COMMIT;
