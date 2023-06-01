-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 09:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` bigint(20) NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `member_email` varchar(50) DEFAULT NULL,
  `member_phone` varchar(20) DEFAULT NULL,
  `member_uni` bigint(20) NOT NULL,
  `member_join_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `member_email`, `member_phone`, `member_uni`, `member_join_date`) VALUES
(1, 'Hilmeng', 'mail@upi.edu', '42069', 1, '2023-06-01');

--
-- Triggers `members`
--
DELIMITER $$
CREATE TRIGGER `add_member` AFTER INSERT ON `members` FOR EACH ROW begin
    update universities as A
    set uni_members = uni_members + 1
    where A.uni_id = NEW.member_uni;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sub_member` AFTER DELETE ON `members` FOR EACH ROW begin
    update universities as A
    set uni_members = uni_members - 1
    where A.uni_id = OLD.member_uni;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `uni_id` bigint(20) NOT NULL,
  `uni_name` varchar(25) DEFAULT NULL,
  `uni_city` varchar(30) NOT NULL,
  `uni_members` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`uni_id`, `uni_name`, `uni_city`, `uni_members`) VALUES
(1, 'UPI', 'Bandung', 1),
(2, 'ITS', 'Surabaya', 0),
(3, 'UGM', 'Yogyakarta', 0),
(4, 'IPB', 'Bogor', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `member_email` (`member_email`),
  ADD UNIQUE KEY `member_phone` (`member_phone`),
  ADD KEY `member_uni` (`member_uni`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`uni_id`),
  ADD UNIQUE KEY `uni_name` (`uni_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `uni_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`member_uni`) REFERENCES `universities` (`uni_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
