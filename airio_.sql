-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 01, 2023 at 04:28 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airio_`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Num_of_employees` (IN `em_count` INT)  NO SQL
BEGIN
    DECLARE em_count INT;
    SELECT COUNT(*) INTO em_count FROM employees;
    SELECT em_count AS 'Total_employees';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(2) NOT NULL,
  `a_name` varchar(30) NOT NULL,
  `a_password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `a_name`, `a_password`) VALUES
(1, 'admin_', 'admin@2');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(3) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `flight_id` int(5) NOT NULL,
  `destination` varchar(30) NOT NULL,
  `journey_date` date NOT NULL,
  `journey_time` time NOT NULL,
  `num_seats` int(3) NOT NULL,
  `class` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `name`, `flight_id`, `destination`, `journey_date`, `journey_time`, `num_seats`, `class`) VALUES
(111, 'Deshna Katariya', 102, 'Hydrabad', '2023-10-26', '18:00:00', 3, 'Economy Class'),
(113, 'Samika Gandhi', 101, 'Jaipur', '2023-10-12', '03:00:00', 2, 'Economy Class'),
(114, 'Santosh Gandhi', 101, 'Jaipur', '2023-10-27', '14:20:00', 1, 'First Class'),
(115, 'Nidhi Gandhi', 103, 'Roorkee', '2023-11-07', '16:55:00', 2, 'Economy Class'),
(117, 'Pavan Gaikwad', 102, 'Hydrabad', '2023-11-09', '14:20:00', 1, 'Premium Economy Class');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `e_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `salary` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`e_id`, `name`, `dob`, `contact_no`, `email`, `type`, `salary`) VALUES
(4, 'Krutika Gundecha', '2002-10-01', '7498456437', 'krutika.gundecha2@gmail.com', 'Hostess', 1200000),
(6, 'Santosh Gandhi', '1998-06-12', '7456234345', 'santosh@gmail.com', 'Pilot', 1500000);

--
-- Triggers `employees`
--
DELIMITER $$
CREATE TRIGGER `em_backup` AFTER INSERT ON `employees` FOR EACH ROW INSERT INTO employees_backup (e_id, name, dob, contact_no, email, type, salary, date_time)
VALUES (new.e_id, new.name, new.dob, new.contact_no, new.email, new.type, new.salary, now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `em_backup_edit` AFTER UPDATE ON `employees` FOR EACH ROW UPDATE employees_backup
SET name = new.name,
    dob = new.dob,
    contact_no = new.contact_no,
    email = new.email,
    type = new.type,
    salary = new.salary,
    date_time = NOW()
WHERE e_id = new.e_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees_backup`
--

CREATE TABLE `employees_backup` (
  `e_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `salary` int(10) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees_backup`
--

INSERT INTO `employees_backup` (`e_id`, `name`, `dob`, `contact_no`, `email`, `type`, `salary`, `date_time`) VALUES
(4, 'Krutika Gundecha', '2002-10-01', '7498456437', 'krutika.gundecha2@gmail.com', 'Hostess', 1200000, '2023-10-31 21:03:13'),
(5, 'Samika Gandhi', '2001-02-16', '9189534568', 'samika@gmail.com', 'Pilot', 1500000, '2023-10-31 21:03:24'),
(6, 'Santosh Gandhi', '1998-06-12', '7456234345', 'santosh@gmail.com', 'Pilot', 1500000, '2023-11-01 16:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feed_id` int(3) NOT NULL,
  `que_1` varchar(50) NOT NULL,
  `que_2` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feed_id`, `que_1`, `que_2`, `name`, `email`) VALUES
(4, 'Very good', 'nothing', 'Pranav Doshi', 'pranav221@gmail.com'),
(5, 'Very bad', 'You could improve your font', 'Ojas Gundecha', 'ojasgundecha232@gmail.com'),
(6, 'Excellent', 'No. Everything is perfect! ', 'Vaishnavi Dudhe', 'vaishnavedudhe2@vit.edu');

-- --------------------------------------------------------

--
-- Table structure for table `flight_details`
--

CREATE TABLE `flight_details` (
  `flight_id` int(5) NOT NULL,
  `d_city` varchar(30) NOT NULL,
  `a_city` varchar(30) NOT NULL,
  `seats` int(3) NOT NULL,
  `d_time` time NOT NULL,
  `a_time` time NOT NULL,
  `airport_name` varchar(125) NOT NULL,
  `airport_address` varchar(250) NOT NULL,
  `first_class_cost` int(11) NOT NULL,
  `business_class_cost` int(10) NOT NULL,
  `pre_economy_class_cost` int(7) NOT NULL,
  `economy_class_cost` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flight_details`
--

INSERT INTO `flight_details` (`flight_id`, `d_city`, `a_city`, `seats`, `d_time`, `a_time`, `airport_name`, `airport_address`, `first_class_cost`, `business_class_cost`, `pre_economy_class_cost`, `economy_class_cost`) VALUES
(101, 'Pune', 'Jaipur', 230, '23:30:00', '01:55:00', 'Pune Airport', 'New Airport Rd, Pune International Airport Area, Lohegaon, Pune, Maharashtra 411032', 15000, 10000, 7200, 6199),
(102, 'New Delhi', 'Hydrabad', 230, '14:20:00', '16:45:00', 'Indira Gandhi International Airport', 'No.367, Badam Singh Market NH-8, near shiv murti, Rangpuri, New Delhi, Delhi 110037', 15000, 10000, 8499, 6200),
(103, 'Aurangabad', 'Roorkee', 250, '16:55:00', '19:48:00', 'Aurangabad Airport', 'Jalna Road, MIDC Industrial Area, Chilkalthana, Aurangabad, Maharashtra 431006', 12000, 8500, 6000, 5399);

-- --------------------------------------------------------

--
-- Table structure for table `passenger_reg`
--

CREATE TABLE `passenger_reg` (
  `passenger_id` int(5) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `u_password` varchar(15) NOT NULL,
  `age` varchar(3) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passenger_reg`
--

INSERT INTO `passenger_reg` (`passenger_id`, `u_name`, `u_password`, `age`, `gender`, `contact_no`, `email`) VALUES
(111, 'Deshna_Kat', 'Desh@1', '19', 'F', '7456234789', 'deshna.katariya1@gmail.com'),
(113, 'Samika_Gandhi', 'Samgan@1', '20', 'F', '9984534568', 'samika.gandhi22@vit.edu'),
(114, 'Santosh_gandhi', 'San_gan1', '45', 'M', '7456234346', 'santosh@gmail.com'),
(115, 'Nidhi_gandhi', 'Nidkid@2', '17', 'F', '9421223412', 'nidhigandhi22@gmail.com'),
(117, 'Pavan_Gaikwad', 'Pavan@2', '20', 'M', '8123896745', 'pavangaikwad221@gmail.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `ticket_data_1`
-- (See below for the actual view)
--
CREATE TABLE `ticket_data_1` (
`u_name` varchar(50)
,`passenger_id` int(5)
,`name` varchar(255)
,`flight_id` int(5)
,`d_city` varchar(30)
,`destination` varchar(30)
,`journey_date` date
,`journey_time` time
,`num_seats` int(3)
,`class` varchar(30)
);

-- --------------------------------------------------------

--
-- Structure for view `ticket_data_1`
--
DROP TABLE IF EXISTS `ticket_data_1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ticket_data_1`  AS  select `p`.`u_name` AS `u_name`,`p`.`passenger_id` AS `passenger_id`,`b`.`name` AS `name`,`b`.`flight_id` AS `flight_id`,`flight_details`.`d_city` AS `d_city`,`b`.`destination` AS `destination`,`b`.`journey_date` AS `journey_date`,`b`.`journey_time` AS `journey_time`,`b`.`num_seats` AS `num_seats`,`b`.`class` AS `class` from ((`passenger_reg` `p` join `booking` `b` on((`p`.`passenger_id` = `b`.`book_id`))) join `flight_details` on((`flight_details`.`flight_id` = `b`.`flight_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `booking_flight_id_fr` (`flight_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `employees_backup`
--
ALTER TABLE `employees_backup`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feed_id`);

--
-- Indexes for table `flight_details`
--
ALTER TABLE `flight_details`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `passenger_reg`
--
ALTER TABLE `passenger_reg`
  ADD PRIMARY KEY (`passenger_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `e_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees_backup`
--
ALTER TABLE `employees_backup`
  MODIFY `e_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feed_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flight_details`
--
ALTER TABLE `flight_details`
  MODIFY `flight_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `passenger_reg`
--
ALTER TABLE `passenger_reg`
  MODIFY `passenger_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_flight_id_fr` FOREIGN KEY (`flight_id`) REFERENCES `flight_details` (`flight_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
