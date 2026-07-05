-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2024 at 07:39 PM
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
-- Database: `readcycle`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_books`
--

CREATE TABLE `add_books` (
  `book_id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `book_condition` varchar(30) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `actual_price` float NOT NULL,
  `price` float NOT NULL,
  `author` varchar(30) NOT NULL,
  `subcategory` varchar(30) NOT NULL,
  `book_image` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `admin_cut` decimal(10,2) DEFAULT 0.00,
  `condition_deduction` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_books`
--

INSERT INTO `add_books` (`book_id`, `category`, `book_condition`, `book_name`, `actual_price`, `price`, `author`, `subcategory`, `book_image`, `name`, `email`, `quantity`, `admin_cut`, `condition_deduction`) VALUES
(2, 'non-fiction', 'good', '1857 che Swatantyasamar', 0, 90, 'Swatantraveer Sawarkar', 'history', 'images/1857.jpg', 'Admin', 'readcycle@gmail.com', 70, 0.00, 0.00),
(3, 'poetry', 'average', 'Aaj Kal', 0, 80, 'Pankaj Gupta', 'epic', 'images/aaj kal.webp', 'Admin', 'readcycle@gmail.com', 10, 0.00, 0.00),
(4, 'academic-textbook', 'good', 'Applied Science', 0, 120, 'S Chand', 'textbook', 'images/Applied Science.jpg', 'Admin', 'readcycle@gmail.com', 50, 0.00, 0.00),
(5, 'fiction', 'average', 'Nakshtra', 0, 100, 'Sandhya Ranade', 'short-story', 'images/nakshatra.jpg', 'Admin', 'readcycle@gmail.com', 90, 0.00, 0.00),
(7, 'fiction', 'good', '2 poranchi 1 gosht', 0, 70, 'Prakash Deshpande', 'short-story', 'images/2 poranchi 1 gosht.jpg', 'Admin', 'readcycle@gmail.com', 195, 0.00, 0.00),
(8, 'non-fiction', 'good', 'A life in the shadows', 0, 120, 'A. S. Daulat', 'memoir', 'images/a life in the shadows.jpg', 'Swagati Kokane', 'swagatikokane@gmail.com', 47, 0.00, 0.00),
(9, 'non-fiction', 'new', 'A memoir of my former self', 0, 200, 'Hilary Mantel', 'memoir', 'images/a memoir of my former self.jpg', 'Swagati Kokane', 'swagatikokane@gmail.com', 73, 0.00, 0.00),
(10, 'academic-textbook', 'average', 'Artificial Intelligence', 0, 250, 'R B', 'textbook', 'images/AI.jpg', 'Swagati Kokane', 'swagatikokane@gmail.com', 60, 0.00, 0.00),
(11, 'academic-textbook', 'new', 'Algorithms', 0, 139, 'Sartaj Sahni', 'textbook', 'images/Algorithms.jpg', 'Swagati Kokane', 'swagatikokane@gmail.com', 11, 0.00, 0.00),
(12, 'academic-textbook', 'good', 'Applied Electronics', 0, 150, 'R S Sedha', 'textbook', 'images/Applied Electronics.jpg', 'Swagati Kokane', 'swagatikokane@gmail.com', 23, 0.00, 0.00),
(13, 'fiction', 'good', 'Aapulki', 60, 0, 'P.L deshpande', 'novel', 'images/Apulaki.jpg', 'Tejaswini Sonar', 'tejaswinisonar02@gmail.com', 20, 0.00, 0.00),
(14, 'childrens-literature', 'average', 'Aamch Gav', 50, 31.5, 'Swami Dattavadhoot Virchit', 'picture-books', 'images/aamch gav.jpg', 'Tejaswini Sonar', 'tejaswinisonar02@gmail.com', 50, 0.00, 0.00),
(21, 'fiction', 'poor', 'beyond the heart', 60, 54, 'Jeanie P Johnson', 'Novel', 'images/beyond the heart.webp', 'Tejaswini Sonar', 'tejaswinisonar02@gmail.com', 26, 6.00, 0.00),
(22, 'religious-spiritual', 'poor', 'aamogh', 399, 259.35, 'hgv', 'hindu', 'images/amogh.jpg', 'Tejaswini Sonar', 'tejaswinisonar02@gmail.com', 87, 39.90, 99.75),
(24, 'childrens-literature', 'new', 'Aapan Sare Bhau', 70, 63, 'Sane Guruji', 'young-adult', 'images/AApn Sare Bhau.jpg', 'Rashmi Jagdale', 'rashmijagdale2005@gmail.com', 40, 7.00, 0.00),
(25, 'religious-spiritual', 'average', 'abhang dnyaneshwari', 120, 84, 'Swami  Swarupanand', 'hindu', 'images/abhang dnyaneshwari.jpg', 'Rashmi Jagdale', 'rashmijagdale2005@gmail.com', 12, 12.00, 24.00),
(26, 'childrens-literature', 'new', 'adrushya sadra adrushya frock', 50, 45, 'V. N. Walsangkar', 'chapter-books', 'images/adrushya sadra adrushya frock.jpg', 'Rashmi Jagdale', 'rashmijagdale2005@gmail.com', 18, 5.00, 0.00),
(27, 'non-fiction', 'poor', 'Agnipankh', 120, 78, 'Dr. A. P. J. Abdul Kalam', 'biography/autobiography', 'images/Agnipankh.jpg', 'Rashmi Jagdale', 'rashmijagdale2005@gmail.com', 18, 12.00, 30.00),
(28, 'academic-textbook', 'average', 'Artificial Intelligence', 350, 245, 'R. B Mishra', 'textbook', 'images/AI.jpg', 'Akanksha Dongare', 'akankshadongare@gmail.com', 4, 35.00, 70.00),
(29, 'fiction', 'good', 'Amrutvel', 60, 45, 'V. S. Khandekar', 'short-story', 'images/Amrutvel.jpg', 'Akanksha Dongare', 'akankshadongare@gmail.com', 27, 6.00, 9.00),
(30, 'fiction', 'good', 'An orphans war', 179, 134.25, 'molly green', 'mystery/thriller', 'images/An orphans war.jpg', 'Akanksha Dongare', 'akankshadongare@gmail.com', 31, 17.90, 26.85),
(31, 'academic-textbook', 'average', 'ASP.NET', 370, 259, 'Davemarcer', 'textbook', 'images/ASP.NET.jpg', 'Asmita Jadhav', 'prasmita@gmail.com', 8, 37.00, 74.00),
(32, 'academic-textbook', 'poor', 'Applied Electronics', 230, 149.5, 'S. Chand', 'textbook', 'images/Applied Mathematics.jpg', 'Asmita Jadhav', 'prasmita@gmail.com', 5, 23.00, 57.50),
(33, 'academic-textbook', 'poor', 'Applied science ', 339, 220.35, 'S. Chand', 'textbook', 'images/Applied Science.jpg', 'Asmita Jadhav', 'prasmita@gmail.com', 15, 33.90, 84.75),
(34, 'fiction', 'good', 'Aapulki', 69, 51.75, 'P. L. Deshpande', 'short-story', 'images/Apulaki.jpg', 'Asmita Jadhav', 'prasmita@gmail.com', 67, 6.90, 10.35),
(35, 'poetry', 'good', 'bapu tuzya deshat', 59, 44.25, 'Ashok J. Kambale', 'epic', 'images/bapu tuzya deshat.jpg', 'Gauri Padwal', 'gauripadwal@gmail.com', 29, 5.90, 8.85),
(36, 'fiction', 'poor', 'Bahishkrut', 49, 31.85, 'Dr. Ashok Aadhav', 'fantasy', 'images/bahishkrut.jpg', 'Gauri Padwal', 'gauripadwal@gmail.com', 21, 4.90, 12.25),
(37, 'academic-textbook', 'good', 'Basic Managerial Skills', 210, 157.5, 'E. H. McGrath, S. J.', 'textbook', 'images/Basic Managerial Skills.jpg', 'Gauri Padwal', 'gauripadwal@gmail.com', 39, 21.00, 31.50),
(38, 'poetry', 'new', 'Aaj Kal', 49, 44.1, 'Pankaj Gupta', 'verse', 'images/aaj kal.webp', 'Gauri Padwal', 'gauripadwal@gmail.com', 20, 4.90, 0.00),
(39, 'fiction', 'poor', 'batatyachi chal', 79, 51.35, 'P. L. Deshpande', 'fantasy', 'images/Batatyachi Chal.jpg', 'Gauri Padwal', 'gauripadwal@gmail.com', 11, 7.90, 19.75),
(40, 'poetry', 'average', 'beyond the heart', 69, 48.3, 'Yashee Jain', 'epic', 'images/beyond the heart.webp', 'Gauri Padwal', 'gauripadwal@gmail.com', 21, 6.90, 13.80),
(41, 'religious-spiritual', 'new', 'Bhagvadgeeta', 220, 198, 'unknown', 'hindu', 'images/Bhagavad Gita.webp', 'Jyoti Pingale', 'jyotipingale@gmail.com', 12, 22.00, 0.00),
(42, 'academic-textbook', 'poor', 'buddhimapan chachni', 309, 200.85, 'Anil Ankalgi', 'textbook', 'images/buddhimapan chachni.jpg', 'Jyoti Pingale', 'jyotipingale@gmail.com', 15, 30.90, 77.25),
(43, 'academic-textbook', 'new', 'c++', 319, 287.1, 'Robert Lafore', 'textbook', 'images/C++.jpg', 'Jyoti Pingale', 'jyotipingale@gmail.com', 20, 31.90, 0.00),
(44, 'fiction', 'average', 'Chakva', 78, 54.6, 'Mandakini Bharadwaj', 'mystery/thriller', 'images/chakva.jpg', 'Jyoti Pingale', 'jyotipingale@gmail.com', 10, 7.80, 15.60),
(45, 'non-fiction', 'average', 'Chanakya Neeti', 109, 76.3, 'Chanakya', 'memoir', 'images/Chanakya Neeti.jpg', 'Jyoti Pingale', 'jyotipingale@gmail.com', 15, 10.90, 21.80),
(46, 'non-fiction', 'good', 'Chatrapati Shivaji Maharaj', 89, 66.75, 'Krushnarao Arjun Veluskar', 'history', 'images/Chatrapati Shivaji Maharaj.jpg', 'Prachi Londhe', 'prachilondhe26@gmail.com', 13, 8.90, 13.35),
(47, 'academic-textbook', 'poor', 'chemistry module6', 302, 196.3, 'Bakliwal Tutorials', 'textbook', 'images/chemistry module6.jpg', 'Prachi Londhe', 'prachilondhe26@gmail.com', 8, 30.20, 75.50),
(48, 'drama', 'good', 'chhava', 89, 66.75, 'Shivaji Savant', 'play', 'images/Chhava.jpg', 'Prachi Londhe', 'prachilondhe26@gmail.com', 12, 8.90, 13.35),
(49, 'academic-textbook', 'average', 'Developing Communication Skills', 120, 84, 'Krishna Mohan Meera Banerji', 'textbook', 'images/Communication Skills.jpg', 'Prachi Londhe', 'prachilondhe26@gmail.com', 17, 12.00, 24.00),
(50, 'academic-textbook', 'poor', 'Computer Funadementals Architecture and Organizati', 409, 265.85, 'B. Ram', 'textbook', 'images/Computer Funadementals.jpg', 'Prachi Londhe', 'prachilondhe26@gmail.com', 17, 40.90, 102.25),
(51, 'academic-textbook', 'average', 'Principals of Interactive Computer Graphics', 419, 293.3, 'William M. Newman', 'textbook', 'images/Computer Graphics.jpg', 'Prachi Londhe', 'prachilondhe26@gmail.com', 27, 41.90, 83.80),
(52, 'academic-textbook', 'good', 'Control System Engineering', 302, 226.5, 'M. Gopal', 'textbook', 'images/Control System Engineering.jpg', 'Pranali Londhe', 'pranalilondhe145@gmail.com', 16, 30.20, 45.30),
(53, 'poetry', 'poor', 'craze', 45, 29.25, 'Aparna Sardeshpande', 'epic', 'images/craze.jpg', 'Pranali Londhe', 'pranalilondhe145@gmail.com', 18, 4.50, 11.25),
(54, 'academic-textbook', 'average', 'Creativity and Problem Solving', 259, 181.3, 'Phil Lowe', 'textbook', 'images/Creativity and Problem Solving.jpg', 'Pranali Londhe', 'pranalilondhe145@gmail.com', 23, 25.90, 51.80),
(55, 'religious-spiritual', 'good', 'Dasbodh', 305, 228.75, 'Suryakant Kulkarni', 'hindu', 'images/dasbodh.jpg', 'Pranali Londhe', 'pranalilondhe145@gmail.com', 23, 30.50, 45.75),
(56, 'drama', 'average', 'Savkhedcha dhanaji nayak', 55, 38.5, 'ad. nanasaheb kambale', 'script', 'images/dhanaji nayak.jpg', 'Pranali Londhe', 'pranalilondhe145@gmail.com', 34, 5.50, 11.00),
(57, 'religious-spiritual', 'good', 'dnyaneshwar mauli', 169, 126.75, 'Dnyaneshwar M. Kulkarni', 'hindu', 'images/dnyaneshwar mauli.jpg', 'Pranali Londhe', 'pranalilondhe145@gmail.com', 19, 16.90, 25.35),
(58, 'academic-textbook', 'good', 'Electrical Technology', 489, 366.75, 'B. L. Theraja', 'textbook', 'images/Electrical Technology.jpg', 'Payal Waykar', 'payalwaykar2005@gmail.com', 19, 48.90, 73.35),
(59, 'academic-textbook', 'good', 'Electronic Communication System', 189, 141.75, 'Kennedy Davis', 'textbook', 'images/Electronic Communication System.jpg', 'Payal Waykar', 'payalwaykar2005@gmail.com', 36, 18.90, 28.35),
(60, 'academic-textbook', 'average', 'Engineering Chemistery', 279, 195.3, 'S. S. Dara', 'textbook', 'images/Engineering Chemistery.jpg', 'Payal Waykar', 'payalwaykar2005@gmail.com', 43, 27.90, 55.80),
(61, 'academic-textbook', 'average', 'English Grammar & Composition ', 79, 55.3, 'R. C. Jain', 'textbook', 'images/English Grammer.jpg', 'Payal Waykar', 'payalwaykar2005@gmail.com', 56, 7.90, 15.80),
(62, 'academic-textbook', 'poor', 'Entrepreneurship Developement & Small Business Ent', 130, 84.5, 'Poornima M. Charantimath', 'textbook', 'images/Entrepreneurship Developement.jpg', 'Payal Waykar', 'payalwaykar2005@gmail.com', 12, 13.00, 32.50),
(63, 'non-fiction', 'good', 'Fakira', 120, 90, 'Anna Bhau Sathe', 'history', 'images/fakira.jpg', 'Payal Waykar', 'payalwaykar2005@gmail.com', 34, 12.00, 18.00),
(64, 'fiction', 'good', 'Garudzep Ek Dhyeyveda Pravas', 99, 74.25, 'Bharat Andhale', 'novel', 'images/Garudzep.jpg', 'Payal Waykar', 'payalwaykar2005@gmail.com', 56, 9.90, 14.85),
(65, 'drama', 'average', 'Gathhoda', 99, 69.3, 'P. L. Deshpande', 'script', 'images/Gathod.jpg', 'Payal Waykar', 'payalwaykar2005@gmail.com', 76, 9.90, 19.80),
(66, 'religious-spiritual', 'new', 'Geeta Parichay', 140, 126, 'N. Vinayak Gogate', 'hindu', 'images/geeta parichay.jpg', 'Payal Waykar', 'payalwaykar2005@gmail.com', 38, 14.00, 0.00),
(67, 'religious-spiritual', 'new', 'geetarthavilas', 159, 143.1, 'Rajendra Madhukar Manerikar', 'hindu', 'images/geetarthavilas.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 43, 15.90, 0.00),
(68, 'non-fiction', 'good', 'Bhartiya Genius', 89, 66.75, 'Achyut Godbole', 'science', 'images/Genius.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 19, 8.90, 13.35),
(69, 'academic-textbook', 'average', 'ghataknihay sarav prashnasanch', 209, 146.3, 'Atul Kotalwar', 'textbook', 'images/ghataknihay sarav prashnasanch.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 65, 20.90, 41.80),
(70, 'non-fiction', 'good', 'Great Men of India', 89, 66.75, 'L. F. Williams', 'history', 'images/Great Men of India.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 59, 8.90, 13.35),
(71, 'childrens-literature', 'new', 'hasa mulanno hasa', 79, 71.1, 'Muktaranga prakashan', 'picture-books', 'images/hasa mulanno hasa.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 79, 7.90, 0.00),
(72, 'childrens-literature', 'new', 'hasyanagricha badhasha', 79, 71.1, 'Namdev Shete', 'chapter-books', 'images/hasyanagricha badhasha.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 68, 7.90, 0.00),
(73, 'academic-textbook', 'average', 'Higher Algebra', 309, 216.3, 'S. Chand', 'textbook', 'images/Higher Algebra.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 34, 30.90, 61.80),
(74, 'academic-textbook', 'average', 'HTML and XHTML 4th Edition', 409, 286.3, 'Thomas A. Powell', 'textbook', 'images/HTML and XHTML.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 34, 40.90, 81.80),
(75, 'poetry', 'new', 'indradhanuche toran', 68, 61.2, 'Devba Shivaji Patil', 'verse', 'images/indradhanuche toran.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 55, 6.80, 0.00),
(76, 'academic-textbook', 'poor', 'Introduction to networking', 339, 220.35, 'Richard A. McMahon Sr.', 'textbook', 'images/Introduction to networking.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 21, 33.90, 84.75),
(77, 'childrens-literature', 'good', 'jangal tod modli khod', 59, 44.25, 'Prashant Gautam', 'chapter-books', 'images/jangal tod modli khod.jpg', 'Mrunal Nighot', 'mrunalnighot11@gmail.com', 67, 5.90, 8.85),
(78, 'academic-textbook', 'poor', 'Irrigation Engineering & Hydraulic Structures', 210, 136.5, 'Santosh Kumar Garg', 'textbook', 'images/Irrigation Engineering.jpg', 'Admin', 'readcycle@gmail.com', 21, 21.00, 52.50),
(79, 'academic-textbook', 'poor', 'Irrigation Engineering & Hydraulic Structures', 210, 136.5, 'Santosh Kumar Garg', 'textbook', 'images/Irrigation Engineering.jpg', 'Admin', 'readcycle@gmail.com', 21, 21.00, 52.50),
(80, 'academic-textbook', 'average', 'Programming with Java', 409, 286.3, 'E Balagurusamy', 'textbook', 'images/Java.jpg', 'Admin', 'readcycle@gmail.com', 21, 40.90, 81.80),
(81, 'poetry', 'good', 'jivanvichar Janatlya Manatle', 120, 90, 'Ramchandra Jorvar', 'haiku', 'images/jivanvichar.jpg', 'Admin', 'readcycle@gmail.com', 44, 12.00, 18.00),
(82, 'academic-textbook', 'average', 'Journal of Information Security Research', 79, 55.3, 'A DLine Journal ', 'research-papers', 'images/Journal.jpg', 'Admin', 'readcycle@gmail.com', 18, 7.90, 15.80),
(83, 'poetry', 'good', 'khudlela ropta', 89, 66.75, 'Harshada Bhure Bavankar', 'epic', 'images/khudlela ropta.jpg', 'Admin', 'readcycle@gmail.com', 51, 8.90, 13.35),
(84, 'poetry', 'average', 'khwahishein', 99, 69.3, 'Sangit Bhalerao', 'epic', 'images/khwahishein.webp', 'Admin', 'readcycle@gmail.com', 56, 9.90, 19.80),
(85, 'fiction', 'good', 'krantiveer', 78, 58.5, 'gurunath naik', 'historical-fiction', 'images/krantiveer.jpg', 'Admin', 'readcycle@gmail.com', 32, 7.80, 11.70),
(86, 'fiction', 'good', 'Kubhand', 89, 66.75, 'Bhagvantrao Patil', 'short-story', 'images/kumbhad.jpg', 'Admin', 'readcycle@gmail.com', 42, 8.90, 13.35),
(87, 'fiction', 'poor', 'Let Us C', 135, 87.75, 'Yashwant Kanetkar', 'science-fiction', 'images/Let Us C.jpg', 'Admin', 'readcycle@gmail.com', 21, 13.50, 33.75),
(88, 'academic-textbook', 'good', 'Linux Bible', 307, 230.25, 'wiley', 'textbook', 'images/Linux.jpg', 'Admin', 'readcycle@gmail.com', 45, 30.70, 46.05),
(89, 'academic-textbook', 'good', 'Longman dictionary of Contemporary English', 305, 228.75, 'unknown', 'textbook', 'images/Longman.jpg', 'Admin', 'readcycle@gmail.com', 45, 30.50, 45.75),
(90, 'academic-textbook', 'poor', 'Machine Design', 230, 149.5, 'S. Chand', 'textbook', 'images/Machine Design.jpg', 'Admin', 'readcycle@gmail.com', 23, 23.00, 57.50),
(91, 'non-fiction', 'average', 'Mahatma Gandhi A Social Performer', 78, 54.6, 'Dr. Tanuja Trivedi', 'history', 'images/Mahatma Gandhi.jpg', 'Admin', 'readcycle@gmail.com', 45, 7.80, 15.60),
(92, 'childrens-literature', 'good', 'mamachya gavala jauya', 45, 33.75, 'v. n. valsangkar', 'chapter-books', 'images/mamachya gavala jauya.jpg', 'Admin', 'readcycle@gmail.com', 56, 4.50, 6.75);

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`Username`, `Password`) VALUES
('ADMIN', 'readcycle@1234');

-- --------------------------------------------------------

--
-- Table structure for table `cart_books`
--

CREATE TABLE `cart_books` (
  `cart_id` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_books`
--

INSERT INTO `cart_books` (`cart_id`, `User_ID`, `book_id`, `quantity`, `price`) VALUES
(28, 1, 12, 1, 0.00),
(47, 4, 28, 1, 0.00),
(54, 2, 5, 1, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `order_date` date NOT NULL,
  `del_status` varchar(30) NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `total_bill` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_method` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `User_ID`, `book_id`, `delivery_date`, `order_date`, `del_status`, `payment_status`, `total_bill`, `quantity`, `payment_method`) VALUES
(4, 3, 8, '2024-02-24', '2024-02-21', 'on the way', '', 480, 4, 'online'),
(5, 3, 10, '2024-02-24', '2024-02-21', 'on the way', '', 750, 3, 'cash'),
(6, 3, 8, '2024-02-24', '2024-02-21', 'Cancel', '', 120, 1, 'cash'),
(7, 3, 9, '2024-02-24', '2024-02-21', 'on the way', '', 200, 1, 'cash'),
(10, 3, 5, '2024-02-24', '2024-02-21', 'Delivered', 'Paid', 200, 2, 'cash'),
(12, 1, 2, '2024-02-24', '2024-02-21', 'Delivered', 'Paid', 90, 1, 'cash'),
(13, 1, 2, '2024-02-24', '2024-02-21', 'Delivered', 'Paid', 90, 1, 'cash'),
(14, 2, 5, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 100, 1, 'cash'),
(15, 2, 7, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 70, 1, 'cash'),
(16, 2, 7, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 70, 1, 'cash'),
(17, 2, 11, '2024-04-02', '2024-03-30', 'on the way', '', 139, 1, 'cash'),
(18, 2, 10, '2024-04-02', '2024-03-30', 'on the way', '', 250, 1, 'cash'),
(19, 2, 9, '2024-04-02', '2024-03-30', 'on the way', '', 200, 1, 'cash'),
(20, 2, 2, '2024-03-16', '2024-03-12', 'Delivered', 'Paid', 90, 1, 'cash'),
(21, 2, 2, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 7200, 80, 'cash'),
(22, 2, 2, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 1440, 16, 'cash'),
(23, 2, 2, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 0, 0, 'cash'),
(24, 2, 2, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 0, 0, 'cash'),
(25, 2, 2, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 0, 0, 'cash'),
(26, 2, 2, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 0, 0, 'cash'),
(27, 2, 2, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 0, 0, 'cash'),
(28, 2, 2, '2024-04-02', '2024-03-30', 'Delivered', 'Paid', 0, 0, 'cash'),
(29, 2, 8, '2024-04-02', '2024-03-30', 'on the way', '', 360, 3, 'cash'),
(30, 2, 9, '2024-04-02', '2024-03-30', 'on the way', '', 600, 3, 'cash'),
(31, 2, 8, '2024-04-02', '2024-03-30', 'on the way', '', 360, 3, 'cash'),
(32, 2, 10, '2024-04-03', '2024-03-31', 'on the way', '', 250, 1, 'cash'),
(33, 2, 7, '2024-04-03', '2024-03-31', 'Delivered', 'Paid', 70, 1, 'cash'),
(34, 1, 11, '2024-04-03', '2024-03-31', 'on the way', '', 0, 0, 'cash'),
(35, 1, 11, '2024-04-03', '2024-03-31', 'on the way', '', 0, 0, 'cash'),
(36, 1, 11, '2024-04-03', '2024-03-31', 'on the way', '', 278, 2, 'cash'),
(37, 1, 2, '2024-04-03', '2024-03-31', 'Delivered', 'Paid', 90, 1, 'cash'),
(38, 1, 7, '2024-04-03', '2024-03-31', 'Delivered', 'Paid', 70, 1, 'cash'),
(39, 1, 8, '2024-04-03', '2024-03-31', 'on the way', '', 120, 1, 'cash'),
(40, 1, 5, '2024-04-03', '2024-03-31', 'Delivered', 'Paid', 100, 1, 'online'),
(41, 1, 3, '2024-04-03', '2024-03-31', 'Delivered', 'Paid', 80, 1, 'online'),
(42, 1, 11, '2024-04-03', '2024-03-31', 'on the way', '', 139, 1, 'online'),
(43, 1, 11, '2024-04-03', '2024-03-31', 'on the way', '', 139, 1, 'online'),
(44, 1, 11, '2024-04-03', '2024-03-31', 'on the way', '', 139, 1, 'online'),
(45, 1, 10, '2024-04-03', '2024-03-31', 'on the way', '', 250, 1, 'online'),
(46, 2, 12, '2024-04-09', '2024-04-06', 'on the way', '', 150, 1, 'cash'),
(47, 2, 9, '2024-04-09', '2024-04-06', 'on the way', '', 200, 1, 'cash'),
(48, 2, 11, '2024-04-09', '2024-04-06', 'on the way', '', 139, 1, 'cash'),
(49, 2, 10, '2024-04-09', '2024-04-06', 'on the way', '', 250, 1, 'cash'),
(50, 2, 8, '2024-04-09', '2024-04-06', 'on the way', '', 120, 1, 'cash'),
(51, 2, 8, '2024-04-09', '2024-04-06', 'on the way', '', 120, 1, 'cash'),
(52, 2, 10, '2024-04-09', '2024-04-06', 'on the way', '', 250, 1, 'online'),
(53, 2, 12, '2024-04-09', '2024-04-06', 'on the way', '', 150, 1, 'online'),
(54, 2, 10, '2024-04-09', '2024-04-06', 'on the way', '', 250, 1, 'online'),
(55, 2, 10, '2024-04-09', '2024-04-06', 'on the way', '', 250, 1, 'online'),
(56, 2, 9, '2024-04-10', '2024-04-07', 'on the way', '', 200, 1, 'cash'),
(57, 2, 11, '2024-04-10', '2024-04-07', 'on the way', '', 139, 1, 'cash'),
(58, 2, 2, '2024-04-10', '2024-04-07', 'on the way', '', 90, 1, 'cash'),
(59, 2, 5, '2024-04-10', '2024-04-07', 'on the way', '', 100, 1, 'cash'),
(60, 2, 7, '2024-04-10', '2024-04-07', 'on the way', '', 70, 1, 'cash'),
(61, 2, 21, '2024-04-10', '2024-04-07', 'Delivered', 'Paid', 54, 1, 'cash'),
(62, 2, 21, '2024-04-10', '2024-04-07', 'on the way', '', 162, 3, 'cash'),
(63, 14, 11, '2024-04-11', '2024-04-08', 'on the way', '', 139, 1, 'cash'),
(64, 14, 31, '2024-04-11', '2024-04-08', 'on the way', '', 259, 1, 'cash'),
(65, 12, 35, '2024-04-11', '2024-04-08', 'on the way', '', 44.25, 1, 'cash'),
(66, 12, 38, '2024-04-11', '2024-04-08', 'on the way', '', 44.1, 1, 'cash'),
(67, 12, 75, '2024-04-11', '2024-04-08', 'on the way', '', 61.2, 1, 'cash'),
(68, 2, 5, '2024-04-12', '2024-04-09', 'on the way', '', 100, 1, 'cash'),
(69, 2, 5, '2024-04-12', '2024-04-09', 'on the way', '', 400, 4, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `review1`
--

CREATE TABLE `review1` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review1`
--

INSERT INTO `review1` (`id`, `rating`, `comment`, `photo`, `created_at`) VALUES
(1, 5, 'nice', 'images/2 poranchi 1 gosht.jpg', '2024-04-09 16:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `Review_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Experience` text DEFAULT NULL,
  `StarRating` int(11) DEFAULT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`Review_ID`, `User_ID`, `Experience`, `StarRating`, `Created_At`) VALUES
(1, 2, 'I recently discovered Readcycle while searching for a rare edition of my favorite book, and I couldn\'t be happier with my experience. Not only did they have exactly what I was looking for, but the ordering process was seamless and the book arrived in pristine condition. I\'ll definitely be returning for all my future book purchases!', 5, '2024-04-08 10:37:40'),
(2, 1, 'I\'ve been using Readcycle for a while now, and I\'m always impressed by their competitive prices and speedy delivery. Whether I\'m looking for a new release or a classic favorite, I can always count on them to have what I need at a price that fits my budget. Plus, their packaging ensures that my books arrive in perfect condition every time.', 5, '2024-04-08 10:38:45'),
(3, 2, 'I recently had a question about an order I placed on Readcycle, and I was blown away by the level of customer service I received. The support team was incredibly responsive and helpful, and they went above and beyond to ensure that my issue was resolved quickly and satisfactorily. It\'s clear that they truly care about their customers, and I\'ll definitely be recommending them to all my book-loving friends!', 5, '2024-04-08 10:40:10'),
(4, 4, 'As someone who frequently sells books online, I can\'t say enough good things about readcycle. Their platform is easy to use, and I love that I can list my books quickly and easily without any hassle. Plus, their transparent pricing and efficient payment process make it a breeze to sell my books and earn some extra cash. I wouldn\'t trust anyone else with my book-selling needs!', 5, '2024-04-08 10:41:37'),
(5, 5, 'Readcycle is like heaven for book lovers like me! Their vast selection of titles covers everything from bestsellers to hidden gems, and I love that I can always find something new and exciting to add to my collection. With their user-friendly interface and intuitive search features, it\'s never been easier to discover my next favorite read. Thanks, [Website Name], for making my book-buying experience so enjoyable!', 5, '2024-04-08 10:43:29'),
(6, 7, 'I\'ve been shopping on Readcycle for years, and I\'ve never been disappointed. Their reliability and trustworthiness make them my go-to destination for all things books. From the browsing experience to the checkout process, everything is seamless and efficient. Highly recommended!', 4, '2024-04-08 10:47:21'),
(7, 6, 'Readcycle is like a treasure trove of literary finds waiting to be discovered. Whether you\'re searching for a rare first edition or a recent bestseller, you\'re sure to find it here. Their diverse selection and excellent prices make them stand out from the crowd.', 5, '2024-04-08 10:48:19'),
(8, 14, 'One thing I love about Readcycle is how easy it is to navigate and find exactly what you\'re looking for. With intuitive search filters and categories, I can quickly narrow down my options and find the perfect book in no time. It\'s a bookworm\'s dream come true!', 5, '2024-04-08 11:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `User_ID` int(11) NOT NULL,
  `Full_Name` varchar(50) NOT NULL,
  `Mobile_Number` bigint(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Colony_HouseNo` varchar(50) NOT NULL,
  `City_Pin` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`User_ID`, `Full_Name`, `Mobile_Number`, `Email`, `Colony_HouseNo`, `City_Pin`, `Country`, `State`, `Password`) VALUES
(1, 'Swagati Kokane', 8698030341, 'swagatikokane@gmail.com', 'Palastika, Narodi', 'pune', 'India', 'Maharashtra', '12345'),
(2, 'Tejaswini Sonar', 9970745940, 'tejaswinisonar02@gmail.com', 'Madhavbag Colony, 20A', 'pune', 'India', 'Maharashtra', 'teju@1212'),
(3, 'Rashmi Jagdale', 7896325632, 'rashmijagdale2005@gmail.com', 'Swami Colony, 40D', 'pune', 'India', 'Maharashtra', 'akanksha@1234'),
(4, 'Akanksha Dongare', 7896336521, 'akankshadongare@gmail.com', 'kale Colony, 30B', 'pune', 'India', 'Maharashtra', '98076'),
(5, 'Asmita Jadhav', 7865454565, 'prasmita@gmail.com', 'prasmita colony, 308', 'rajgurunagar 410503', 'India', 'Maharashtra', 'prasmita'),
(6, 'Gauri Padwal', 9745342313, 'gauripadwal@gmail.com', '123, Green Park,', 'New Delhi - 110016', 'India', 'Dehli', 'abc78'),
(7, 'Jyoti Pingale', 9543654323, 'jyotipingale@gmail.com', '56, Anna Salai', 'India', 'Chennai - 600002', 'Tamil Nadu ', 'itzjyo!'),
(8, 'Prachi Londhe', 8564534567, 'prachilondhe26@gmail.com', '890, Rajaji Nagar', 'Pune - 411005', 'India', 'Maharashtra ', 'jsdhkf342'),
(9, 'Pranali Londhe', 8765456565, 'pranalilondhe145@gmail.com', 'londhe mala, 90', 'manchar 410503', 'india', 'Maharashtra', 'pl3456`'),
(10, 'Payal Waykar', 9656745340, 'payalwaykar2005@gmail.com', 'sultanpur 507', 'manchar 410503', 'India', 'Maharashtra', 'pw6758%'),
(11, 'Mrunal Nighot', 8765456545, 'mrunalnighot11@gmail.com', 'ashtavinayak society, A/502 ', 'manchar 410503', 'India', 'Maharashtra', 'mn67540'),
(12, 'Ganesh Kulkarni', 8976989876, 'ganeshkulkarni@gmail.com', 'vrindavan, 709', 'khadki pimpalgoan, 410503', 'India', 'Maharashtra', 'shivganesh'),
(13, 'kiran kulkarni', 8976564567, 'kirankulkarni@gmail.com', 'vrindavan, 709', 'khadki pimpalgoan, 410503', 'India', 'Maharashtra', 'anu@25'),
(14, 'Kartiki Belhekar', 9867564534, 'kartikibelhekar11@gmail.com', 'Diya nivas, 70', 'Sudumbare 678456', 'India', 'Maharashtra', '68diyu34'),
(15, 'Om Honawale', 8976567654, 'omsai@gmail.com', 'omsai nivas, 709', 'Sudumbare 678456', 'India', 'Maharashtra', 'os@OS'),
(16, 'Aditya Satpute', 8976565467, 'adisatpute45@gmail.com', '67, Sector 22', 'Noida, 201301', 'India', ' Uttar Pradesh', 'as%fet43'),
(17, 'Aadesh Dhonde', 7898765645, 'adeshdhonde34@gmail.com', '34, Gomti Nagar', 'Lucknow, 226010', 'India', 'Uttar Pradesh', 'adu@$%1'),
(18, 'Neeraj Waliya', 9867565677, 'nirajwaliya45@gmail.com', '456, Jubilee Hills', 'Hyderabad, 500033', 'India', 'Telangana ', 'nw34#%'),
(19, 'Harish kolhe', 9087676756, 'harryk@gmail.com', '78, Ambala Cantt', 'Ambala, 133001', 'India', 'Haryana ', 'codewithharryH#3'),
(20, 'Shraddha Khapra', 9867566766, 'shraddhakhapra45@gmail.com', '234, Kankaria', 'Ahmedabad, 380002', 'India', 'Gujarat ', 'sk@345'),
(21, 'Aman Dhattarwal', 9012321380, 'amandhattarwal@gmail.com', '890, Gandhipuram', 'Coimbatore, 641012', 'India', 'Tamil Nadu', ''),
(22, 'Vinayak Mali', 8976909089, 'vinayakmali@gmail.com', '56, Durgapur', 'Bhubaneswar-751001', 'India', 'Odisha ', 'dadus#23'),
(23, 'Darshan Raval', 8976787656, 'darshanravaldz@gmail.com', '34, Patna City', 'Patna-800008', 'India', 'Bihar ', 'dz@890'),
(24, 'Arjit Singh', 9078656765, 'arjitsingh67@gmail.com', '456, Salt Lake City', 'Kolkata-700064', 'India', ' West Bengal', 'ars45%^7'),
(25, 'Shruti Daine', 7865456765, 'shrutidaine@gmail.com', '78, Thane West', 'Thane-400601', 'India', 'Maharashtra ', 'sd15sonya'),
(26, 'Gurpreet Saini', 8876775567, 'gurpreet56@gmail.com', '234, Raja Park', 'Jaipur-302004', 'India', 'Rajasthan ', 'gsDZ89#'),
(27, 'TusharNighojkar', 8965676512, 'tusharnigojkar@gmail.com', 'omsai recidensy b/802', 'chakan 410504', 'India', 'Maharashtra', '89tn$90'),
(28, 'Omkar Nighojkar', 9078654561, 'omkarnigojkar@gmail.com', 'onsai recidensy b/802', 'chakan 410504', 'India', 'Maharashtra', 'vsk@on'),
(29, 'Armaan Malik', 8786121234, 'armanmalik@gmail.com', '890, Hinjewadi', 'Pune 411057', 'India', 'Maharashtra ', 'am89(68)&'),
(30, 'Anirag Sai', 9812321110, 'anuragsai@gmail.com', '56, Vijayanagar', 'Mysore-570017', 'India', 'Karnataka ', 'anrgsi45%'),
(31, 'Ankit Tiwari', 8965432190, 'ankittiwari4@gmail.com', '34, Sector 14', 'Gurgaon-122001', 'India', 'Haryana ', 'atiwari89*');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `Wishlist_id` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`Wishlist_id`, `User_ID`, `book_id`) VALUES
(3, 3, 2),
(6, 3, 5),
(8, 3, 7),
(9, 3, 11),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(13, 2, 8),
(14, 2, 9),
(15, 2, 2),
(16, 4, 28),
(18, 14, 11),
(19, 14, 31),
(20, 12, 35),
(21, 12, 38),
(22, 12, 75),
(23, 2, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_books`
--
ALTER TABLE `add_books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `cart_books`
--
ALTER TABLE `cart_books`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `review1`
--
ALTER TABLE `review1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`Wishlist_id`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_books`
--
ALTER TABLE `add_books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `cart_books`
--
ALTER TABLE `cart_books`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `review1`
--
ALTER TABLE `review1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `Review_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `Wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_books`
--
ALTER TABLE `cart_books`
  ADD CONSTRAINT `cart_books_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `userinfo` (`User_ID`),
  ADD CONSTRAINT `cart_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `add_books` (`book_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `userinfo` (`User_ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `add_books` (`book_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `userinfo` (`User_ID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `userinfo` (`User_ID`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `add_books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
