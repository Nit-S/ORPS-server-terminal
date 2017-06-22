-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2017 at 09:43 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maituts`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `emp_userid` varchar(20) NOT NULL,
  `emp_password` varchar(20) NOT NULL,
  `emp_name` varchar(20) NOT NULL,
  `emp_work_start` time NOT NULL DEFAULT '00:00:00',
  `emp_work_end` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `vehical_type` varchar(10) NOT NULL,
  `base_price` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `reg_no` int(11) NOT NULL,
  `cust_name` varchar(20) NOT NULL,
  `cust_number` int(10) NOT NULL,
  `cust_email` int(50) NOT NULL,
  `vehical_no` varchar(20) NOT NULL,
  `station_id` varchar(10) NOT NULL,
  `slot_fpno` int(11) NOT NULL,
  `book_time` time NOT NULL,
  `chkin_time` time NOT NULL,
  `chkin_emp_userid` int(11) NOT NULL,
  `chkout_time` time NOT NULL,
  `chkout_emp_userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slot_detail`
--

CREATE TABLE `slot_detail` (
  `station_id` varchar(10) NOT NULL,
  `vehical_type` varchar(10) NOT NULL,
  `slot_fpno` int(11) NOT NULL,
  `status_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slot_status`
--

CREATE TABLE `slot_status` (
  `status_id` varchar(10) NOT NULL,
  `status_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `station_parking_info`
--

CREATE TABLE `station_parking_info` (
  `station_id` varchar(10) NOT NULL,
  `station_name` varchar(50) NOT NULL,
  `station_class` varchar(20) NOT NULL,
  `tot_2w_park` int(11) NOT NULL,
  `avail_2w_park` int(11) NOT NULL DEFAULT '0',
  `occ_2w_park` int(11) NOT NULL DEFAULT '0',
  `res_2w_Park` int(11) NOT NULL DEFAULT '0',
  `tot_4w_park` int(11) NOT NULL,
  `avail_4w_park` int(11) NOT NULL DEFAULT '0',
  `occ_4w_park` int(11) NOT NULL DEFAULT '0',
  `res_4w_Park` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehical`
--

CREATE TABLE `vehical` (
  `vehical_no` varchar(20) NOT NULL,
  `vehical_type` varchar(10) NOT NULL DEFAULT '4 wheeler',
  `vehical_name` varchar(50) DEFAULT 'dummy',
  `vehical_color` varchar(20) DEFAULT 'white'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`emp_userid`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`vehical_type`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `slot_detail`
--
ALTER TABLE `slot_detail`
  ADD PRIMARY KEY (`station_id`,`vehical_type`,`slot_fpno`);

--
-- Indexes for table `slot_status`
--
ALTER TABLE `slot_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `station_parking_info`
--
ALTER TABLE `station_parking_info`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `vehical`
--
ALTER TABLE `vehical`
  ADD PRIMARY KEY (`vehical_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
