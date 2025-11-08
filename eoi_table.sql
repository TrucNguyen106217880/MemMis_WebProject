-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 01:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
 /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 /*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--


-- Jobs table here:
CREATE TABLE `jobs` (
  `job_id` INT NOT NULL AUTO_INCREMENT,
  `job_name` VARCHAR(255) NOT NULL,
  `position_reference_number` VARCHAR(255) NOT NULL,
  `about_the_role` TEXT NOT NULL,
  `responsibility` TEXT NOT NULL,
  `required_qualifications` TEXT NOT NULL,
  `nice_to_have_qualifications` TEXT NOT NULL,
  `salary_and_benefits` TEXT NOT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Skills table here:
CREATE TABLE `skills` (
  `skills_id` INT NOT NULL AUTO_INCREMENT,
  `skills` TEXT NOT NULL,
  PRIMARY KEY (`skills_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Eoi table here:
CREATE TABLE `eoi` (
  `eoi_number` INT NOT NULL AUTO_INCREMENT,
  `job_reference_number` VARCHAR(20) NOT NULL,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `gender` ENUM('Male','Female','Other') NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `street_address` VARCHAR(100) NOT NULL,
  `suburb_town` VARCHAR(50) NOT NULL,
  `state` VARCHAR(3) NOT NULL,
  `postcode` VARCHAR(4) NOT NULL,
  `email_address` VARCHAR(100) NOT NULL,
  `phone_number` VARCHAR(20) NOT NULL,
  `skill_1` INT DEFAULT NULL,
  `skill_2` INT DEFAULT NULL,
  `skill_3` INT DEFAULT NULL,
  `skill_4` INT DEFAULT NULL,
  `skill_5` INT DEFAULT NULL,
  `skill_6` INT DEFAULT NULL,
  `skill_7` INT DEFAULT NULL,
  `skill_8` INT DEFAULT NULL,
  `skill_9` INT DEFAULT NULL,
  `skill_10` INT DEFAULT NULL,
  `other_skills` TEXT DEFAULT NULL,
  `status` ENUM('New','Current','Final') DEFAULT 'New',
  PRIMARY KEY (`eoi_number`),
  FOREIGN KEY (`skill_1`) REFERENCES `skills`(`skills_id`),
  FOREIGN KEY (`skill_2`) REFERENCES `skills`(`skills_id`),
  FOREIGN KEY (`skill_3`) REFERENCES `skills`(`skills_id`),
  FOREIGN KEY (`skill_4`) REFERENCES `skills`(`skills_id`),
  FOREIGN KEY (`skill_5`) REFERENCES `skills`(`skills_id`),
  FOREIGN KEY (`skill_6`) REFERENCES `skills`(`skills_id`),
  FOREIGN KEY (`skill_7`) REFERENCES `skills`(`skills_id`),
  FOREIGN KEY (`skill_8`) REFERENCES `skills`(`skills_id`),
  FOREIGN KEY (`skill_9`) REFERENCES `skills`(`skills_id`),
  FOREIGN KEY (`skill_10`) REFERENCES `skills`(`skills_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
 /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
 /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
