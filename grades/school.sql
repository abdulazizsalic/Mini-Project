-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2018 at 02:41 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `edpcode` varchar(5) DEFAULT NULL,
  `idno` varchar(8) DEFAULT NULL,
  `midtermgrade` varchar(5) DEFAULT NULL,
  `finalgrade` varchar(5) DEFAULT NULL,
  KEY `edpcode` (`edpcode`,`idno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`edpcode`, `idno`, `midtermgrade`, `finalgrade`) VALUES
('00001', '0001', '1.0', '1.0'),
('00001', '0002', NULL, NULL),
('00001', '0003', NULL, NULL),
('00001', '0004', NULL, NULL),
('00002', '0001', NULL, NULL),
('00002', '0002', NULL, NULL),
('00002', '0003', NULL, NULL),
('00002', '0004', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `idno` varchar(8) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `mi` char(1) DEFAULT NULL,
  `courseyr` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`idno`, `lastname`, `firstname`, `mi`, `courseyr`) VALUES
('0001', 'PATINO', 'JOAQUIN', 'S', 'BSIT 4'),
('0002', 'DELA CRUZ', 'JUAN', 'A', 'BSIT 4'),
('0003', 'AGUAS', 'IVY', 'A', 'BSIT 3'),
('0004', 'CRUZ', 'LILY', 'A', 'BSIT 3'),
('0005', 'VICERAL', 'JOSE MARIE', 'A', 'BSIT 3'),
('0006', 'NAVARRO', 'VHONG', 'A', 'BSIT 3');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `edpcode` varchar(5) NOT NULL,
  `subject` varchar(20) DEFAULT NULL,
  `schedule` varchar(20) DEFAULT NULL,
  `days` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`edpcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`edpcode`, `subject`, `schedule`, `days`) VALUES
('00001', 'ITELEC PHP', '6:31-7:31 PM', 'MW'),
('00002', 'FIL 1', '5:31-6:31 PM', 'MWF');
