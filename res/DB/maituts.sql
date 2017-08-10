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
  `emp_station` varchar(10) NOT NULL,
  `emp_name` varchar(20) NOT NULL,
  `emp_work_start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `emp_work_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`emp_userid`, `emp_password`, `emp_station`, `emp_name`, `emp_work_start`, `emp_work_end`) VALUES
('user', 'user', 'ghy', 'nitigya', '2017-07-10 02:30:00', '2017-07-10 12:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `vehicle_type` varchar(10) NOT NULL,
  `base_price` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `reg_no` varchar(100) NOT NULL,
  `cust_name` varchar(20) NOT NULL,
  `cust_number` bigint(20) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `vehicle_no` varchar(20) NOT NULL,
  `station_id` varchar(10) NOT NULL,
  `slot_fpno` int(11) NOT NULL,
  `Book_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `chkin_time` timestamp NULL DEFAULT NULL,
  `chkin_emp_userid` varchar(50) DEFAULT NULL,
  `chkout_time` timestamp NULL DEFAULT NULL,
  `chkout_emp_userid` varchar(50) DEFAULT NULL,
  `commit_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`reg_no`, `cust_name`, `cust_number`, `cust_email`, `vehicle_no`, `station_id`, `slot_fpno`, `Book_time`, `chkin_time`, `chkin_emp_userid`, `chkout_time`, `chkout_emp_userid`, `commit_status`) VALUES
('ghy2w10001201708101735', 'nitigya sharma', 2147483647, 'a@b.com', 'de57d9f5', 'ghy', 10001, '2017-08-10 15:35:43', NULL, NULL, NULL, NULL, 'initialised');

-- --------------------------------------------------------

--
-- Table structure for table `slot_detail`
--

CREATE TABLE `slot_detail` (
  `station_id` varchar(10) NOT NULL,
  `vehicle_type` varchar(10) NOT NULL,
  `slot_fpno` bigint(11) NOT NULL,
  `status_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slot_detail`
--

INSERT INTO `slot_detail` (`station_id`, `vehicle_type`, `slot_fpno`, `status_id`) VALUES
('ghy', '2w', 10001, 'YELLOW'),
('ghy', '2w', 10002, 'GREEN'),
('ghy', '2w', 10003, 'GREEN'),
('ghy', '4w', 10001, 'GREEN'),
('ghy', '4w', 10002, 'GREEN');

-- --------------------------------------------------------

--
-- Table structure for table `slot_status`
--

CREATE TABLE `slot_status` (
  `status_id` varchar(10) NOT NULL,
  `status_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slot_status`
--

INSERT INTO `slot_status` (`status_id`, `status_type`) VALUES
('GREEN', 'vacant'),
('RED', 'occupied'),
('YELLOW', 'booked');

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

--
-- Dumping data for table `station_parking_info`
--

INSERT INTO `station_parking_info` (`station_id`, `station_name`, `station_class`, `tot_2w_park`, `avail_2w_park`, `occ_2w_park`, `res_2w_Park`, `tot_4w_park`, `avail_4w_park`, `occ_4w_park`, `res_4w_Park`) VALUES
('ghy', 'guwahati', 'junction', 100, 49, 25, 26, 100, 50, 25, 25),
('ndls', 'new delhi railway station', 'junction', 100, 50, 25, 25, 100, 50, 25, 25);

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
  ADD PRIMARY KEY (`vehicle_type`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `slot_detail`
--
ALTER TABLE `slot_detail`
  ADD PRIMARY KEY (`station_id`,`vehicle_type`,`slot_fpno`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
