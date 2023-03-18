-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2023 at 02:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_SapangMIS`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcements`
--

CREATE TABLE `tbl_announcements` (
  `announcementID` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `datePosted` timestamp NOT NULL DEFAULT current_timestamp(),
  `postedBy` int(11) NOT NULL,
  `recepients` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_announcements`
--

INSERT INTO `tbl_announcements` (`announcementID`, `message`, `datePosted`, `postedBy`, `recepients`) VALUES
(1, 'Greetings to all Ka-Barangays!\n\nPlease join us for a special program on Wednesday, Nov 3 at 10:00 a.m. in the Baranngay covered court. Our guest speaker will be Dr. Jane Smith, a renowned expert on the field of medicine. Dr. Smith will share her insights on the importance of having safety protocols in todays pandemic. A question and answer period will follow her presentation.', '2023-03-06 18:29:02', 29, 'All Residents'),
(2, 'Due to the severe weather conditions, all boat transportation services have been cancelled until further notice. Please stay indoors and do not attempt to travel in these conditions. Keep Safe, everyone', '2023-03-06 18:29:02', 29, 'All Residents'),
(3, 'We are pleased to announce that the monthly pay out will be released on the first of next month. Please be sure to have all required documentation turned in by the end of the day.', '2023-03-06 18:29:02', 29, 'All Employeees');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  ADD PRIMARY KEY (`announcementID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  MODIFY `announcementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
