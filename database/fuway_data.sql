-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2014 at 12:43 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fuway_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuway_data_version`
--

CREATE TABLE IF NOT EXISTS `fuway_data_version` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `tkb_filename` varchar(255) NOT NULL,
  `sdd_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fuway_schedule`
--

CREATE TABLE IF NOT EXISTS `fuway_schedule` (
`id` int(11) NOT NULL,
  `slotdate` date NOT NULL,
  `slot` int(11) NOT NULL,
  `person_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `person_code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `room` varchar(10) CHARACTER SET utf8 NOT NULL,
  `course` varchar(255) CHARACTER SET utf8 NOT NULL,
  `class` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fuway_data_version`
--
ALTER TABLE `fuway_data_version`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuway_schedule`
--
ALTER TABLE `fuway_schedule`
 ADD PRIMARY KEY (`id`), ADD KEY `email` (`email`), ADD KEY `person_name` (`person_name`,`person_code`), ADD KEY `slotdate` (`slotdate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fuway_data_version`
--
ALTER TABLE `fuway_data_version`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fuway_schedule`
--
ALTER TABLE `fuway_schedule`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
