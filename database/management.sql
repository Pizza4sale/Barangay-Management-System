-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 12, 2023 at 07:25 AM
-- Server version: 5.7.42
-- PHP Version: 8.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management`
--
DROP DATABASE IF EXISTS `management`;
CREATE DATABASE IF NOT EXISTS `management` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `management`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brgy`
--

CREATE TABLE `tbl_brgy` (
  `brgy_id` int(11) NOT NULL,
  `brgy_title` varchar(250) NOT NULL,
  `brgy_details` text NOT NULL,
  `posted_date` varchar(250) NOT NULL,
  `news_img` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brgy`
--

INSERT INTO `tbl_brgy` (`brgy_id`, `brgy_title`, `brgy_details`, `posted_date`, `news_img`, `status`) VALUES
(3, 'Barangay Assembly Day.', 'Pursuant to Proclamation No. 260 dated 30 September 2011, the Barangay Assembly Day for the first semester of CY 2015 is set on March 28, 2015. Relative thereto and in accordance with Section 3978 (b) of the Local Government Code, every barangay is enjoined to undertake the following activities:Pursuant to Proclamation No. 260 dated 30 September 2011, the Barangay Assembly Day for the first semester of CY 2015 is set on March 28, 2015. Relative thereto and in accordance with Section 3978 (b)', '2023-08-04 11:15:14', 'iatf.jpg', 'OPEN'),
(4, 'COVID-19 UPDATE ONLY', 'An emergency meeting of Municipal Inter-Agency Task Force (IATF) spearheaded by Mayor Jun Capistrano together with the Barangay Council of Poblacion, Salay, Misamis Oriental, addressing the issues and concerns with regards to the rising number of new recorded confirmed cases of COVID-19 here in Salay specifically at Barangay Poblacion.\r\n\r\nThe increase of local cases in the municipality for just a month is alarming, the local IATF conducted enhanced action planning, discussed additional rigid guidelines and its strict implementation meant to prevent the spread of COVID-19 in our municipality.', '2023-08-04 11:15:32', '10.jpg', 'OPEN'),
(5, 'Muling aarangkada ang ating Mobile Botika sa ibat-ibang bahagi na ating BARANGAY.', 'Muling aarangkada ang ating Mobile Botika at mamamahagi ng libreng mga pangunahing gamot at bitamina sa mga sumusunod na Purok.\r\n\r\nUnang tutunguhin nito sa Miyerkules (July 15) ang Purok 2 na kasalukuyang nasa ilalim ng total lockdown. Dito ay house to house ang paghahatid natin ng mga pangunahing gamot at bitamina para hindi na kailangan pang lumabas ng mga residente.', '2023-08-04 11:14:57', '1.jpg', 'OPEN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brgyclearance`
--

CREATE TABLE `tbl_brgyclearance` (
  `cl_id` int(11) NOT NULL,
  `datetimereq` varchar(250) NOT NULL,
  `reqnum` varchar(250) NOT NULL,
  `ctrl_num` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `pbirth` varchar(250) NOT NULL,
  `bday` varchar(250) NOT NULL,
  `age` varchar(150) NOT NULL,
  `gender` varchar(150) NOT NULL,
  `civil` varchar(150) NOT NULL,
  `length` varchar(250) NOT NULL,
  `company` varchar(500) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `voter` varchar(100) NOT NULL,
  `fileupload` varchar(250) NOT NULL,
  `photoupload` varchar(250) NOT NULL,
  `status` varchar(150) NOT NULL,
  `datereleased` varchar(250) NOT NULL,
  `date_rel` varchar(150) NOT NULL,
  `captain` varchar(250) NOT NULL,
  `fromuser` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cancelledreq`
--

CREATE TABLE `tbl_cancelledreq` (
  `id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `reqnum` varchar(250) NOT NULL,
  `fromuser` varchar(250) NOT NULL,
  `datetimeproc` varchar(250) NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaindetails`
--

CREATE TABLE `tbl_complaindetails` (
  `comd_id` int(11) NOT NULL,
  `com_ctrl` varchar(250) NOT NULL,
  `action_date` varchar(250) NOT NULL,
  `action_taken` varchar(250) NOT NULL,
  `action_result` varchar(250) NOT NULL,
  `assistedby` varchar(250) NOT NULL,
  `encodedby` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `com_id` int(11) NOT NULL,
  `reqnum` varchar(250) NOT NULL,
  `com_ctrl` varchar(250) NOT NULL,
  `datereceived` varchar(250) NOT NULL,
  `from` varchar(250) NOT NULL,
  `emailadd` varchar(250) NOT NULL,
  `phoneno` varchar(250) NOT NULL,
  `to` varchar(250) NOT NULL,
  `dateincident` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `details` text NOT NULL,
  `upload` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `date_closed` varchar(250) NOT NULL,
  `visitsched` varchar(150) NOT NULL,
  `fromuser` varchar(250) NOT NULL,
  `datesent` varchar(250) NOT NULL,
  `captain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_covid`
--

CREATE TABLE `tbl_covid` (
  `covid_id` int(11) NOT NULL,
  `patient_name` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `birthday` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `civil` varchar(250) NOT NULL,
  `homeaddress` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `date_end` varchar(250) NOT NULL,
  `date_start` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `id` int(11) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `question` text NOT NULL,
  `answer` longtext NOT NULL,
  `voter` varchar(250) NOT NULL,
  `nonvoter` varchar(250) NOT NULL,
  `date_added` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`id`, `purpose`, `question`, `answer`, `voter`, `nonvoter`, `date_added`) VALUES
(4, 'population', '5008', '', '5008', '', ''),
(6, 'voter', '', '', '5', '3', ''),
(10, 'faq', 'How to Apply for Online Services?', '(1.) Go to Login Page to Create an Account. (2.) Once done, input your respective username and password. (3.) Inside the dashboard page are the list of online services, Just Click \"Apply Now\" as any of the document as desired.', '', '', '2023-08-04 11:24:09'),
(13, 'faq', 'What are the Requirements Needed to Request the Online Services?', 'All of the Online Services Offered except for the Solo Parent and Complaint requires the following:  Barangay ID / Voters ID and Payment of ₱35.00.', '', '', '2023-08-04 11:25:48'),
(14, 'faq', 'Do you have an Online Payment Option?', 'Yes, we offered an online payment option through GCASH.', '', '', '2023-08-04 11:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_increments`
--

CREATE TABLE `tbl_increments` (
  `inc_id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `num` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_increments`
--

INSERT INTO `tbl_increments` (`inc_id`, `type`, `num`) VALUES
(1, 'residency', '1'),
(2, 'brgyclearance', '15'),
(3, 'permit', '2'),
(4, 'complaint', '0'),
(5, 'request', '17'),
(6, 'soloparent', '2'),
(7, 'indigency', '1'),
(8, 'lowincome', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_indigency`
--

CREATE TABLE `tbl_indigency` (
  `id` int(11) NOT NULL,
  `reqnum` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `age` varchar(50) NOT NULL,
  `bday` varchar(250) NOT NULL,
  `marital` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `status` varchar(250) NOT NULL,
  `pay_status` varchar(250) NOT NULL,
  `photoupload` varchar(250) NOT NULL,
  `datereleased` varchar(250) NOT NULL,
  `date_rel` varchar(150) NOT NULL,
  `datetimereq` varchar(250) NOT NULL,
  `uploadreq` varchar(250) NOT NULL,
  `fromuser` varchar(250) NOT NULL,
  `captain` varchar(50) NOT NULL,
  `old_ctrl` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job`
--

CREATE TABLE `tbl_job` (
  `job_id` int(11) NOT NULL,
  `jobid` varchar(150) NOT NULL,
  `job_title` varchar(250) NOT NULL,
  `job_details` text NOT NULL,
  `posted_date` varchar(250) NOT NULL,
  `closed_date` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job`
--

INSERT INTO `tbl_job` (`job_id`, `jobid`, `job_title`, `job_details`, `posted_date`, `closed_date`, `status`) VALUES
(4, 'JB-004', 'Information System Analyst III', 'Place of assignment is in Information Systems and Technology Management Service. 1 vacancy for this position.', '2022-03-19', '', 'OPEN'),
(5, 'JB-005', 'Administrative Assistant III', ' - Under direct supervision of the Regional Convergence Coordinator, perform administrative and support functions in the implementation of the Convergence Strategy;\r\n- Reviews, records, and track all incoming and outgoing communications (thru different channels) and maintain files and records of these documents relative to convergence;', '2022-03-19', '', 'OPEN'),
(6, 'JB-006', 'Attorney II', 'Place of Assignment is in Legal and Legislative Liaison Service. 2 vacancy for this position', '2022-03-19', '', 'OPEN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobquali`
--

CREATE TABLE `tbl_jobquali` (
  `q_id` int(11) NOT NULL,
  `job_id` varchar(150) NOT NULL,
  `jobname` varchar(250) NOT NULL,
  `jqualify` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jobquali`
--

INSERT INTO `tbl_jobquali` (`q_id`, `job_id`, `jobname`, `jqualify`) VALUES
(13, 'JB-004', 'Information System Analyst III', 'Bachelor\'s Degree Relevant to the Job'),
(14, 'JB-004', 'Information System Analyst III', 'Two (2) years Relevant Experience'),
(15, 'JB-004', 'Information System Analyst III', 'Eight (8) hours relevant Training'),
(16, 'JB-005', 'Administrative Assistant III', 'Completion of 2 Years studies in College or High School Graduate with Relevant Vocation / Trade Course'),
(17, 'JB-005', 'Administrative Assistant III', 'One (1) year relevant experience'),
(18, 'JB-005', 'Administrative Assistant III', 'Four (4) Hours relevant Training'),
(19, 'JB-006', 'Attorney II', 'Minimum Educational Attainment: BS Business Administration and any other related courses.Bachelor of Laws'),
(20, 'JB-006', 'Attorney II', 'Eligibility Needed: RA 1080'),
(28, 'JB-005', 'Administrative Assistant III', 'CS Sub Professional-1st level eligibility');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lowincome`
--

CREATE TABLE `tbl_lowincome` (
  `id` int(11) NOT NULL,
  `reqnum` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `age` varchar(50) NOT NULL,
  `bday` varchar(250) NOT NULL,
  `marital` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `work` varchar(250) NOT NULL,
  `workadd` varchar(250) NOT NULL,
  `monthly_income` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `pay_status` varchar(250) NOT NULL,
  `photoupload` varchar(250) NOT NULL,
  `datereleased` varchar(250) NOT NULL,
  `date_rel` varchar(150) NOT NULL,
  `datetimereq` varchar(250) NOT NULL,
  `uploadreq` varchar(250) NOT NULL,
  `fromuser` varchar(250) NOT NULL,
  `captain` varchar(50) NOT NULL,
  `old_ctrl` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_org`
--

CREATE TABLE `tbl_org` (
  `org_id` int(2) NOT NULL,
  `org_pos` varchar(250) DEFAULT NULL,
  `org_name` varchar(250) DEFAULT NULL,
  `org_pic` varchar(250) DEFAULT NULL,
  `date_added` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_org`
--

INSERT INTO `tbl_org` (`org_id`, `org_pos`, `org_name`, `org_pic`, `date_added`) VALUES
(1, 'Brgy. Captain', 'Ferdinand T. Orbita', 'boy.png', '2022-12-13 09:08:54'),
(2, 'Sanggunian', 'Cesaria E. Pujeda', 'girl.png', '2022-10-28 15:56:46'),
(3, 'Sanggunian', 'Pacifico T. Zuniga', 'boy.png', '10/28/2022'),
(4, 'Sanggunian', 'Ronaldo A. Avellano', 'boy.png', '10/28/2022'),
(5, 'Sanggunian', 'Eduardo P. Penamante', 'boy.png', '10/28/2022'),
(6, 'Sanggunian', 'Randy P. Larita', 'boy.png', '10/28/2022'),
(7, 'Sanggunian', 'Yolenie P. Ebio', 'girl.png', '10/28/2022'),
(8, 'Sanggunian', 'Elena F. Casabuena', 'girl.png', '10/28/2022'),
(9, 'Secretary', 'Lyca C. Prudente', 'girl.png', '10/28/2022'),
(10, 'Treasurer', 'Ireen D. Laurel', 'girl.png', '10/28/2022'),
(21, 'BHW', 'Lea C. Casabuena', 'girl.png', '10/28/2022'),
(22, 'BHW', 'Cleo P. Ibanez', 'boy.png', '10/28/2022'),
(23, 'BHW', 'Jocelyn A. Jaridinazo', 'girl.png', '10/28/2022'),
(24, 'BHW', 'Imelda D. Morilla', 'girl.png', '10/28/2022'),
(25, 'BHW', 'Racquel C. Encarguez', 'girl.png', '10/28/2022'),
(26, 'BNS', 'Nenita A. Ruzol', 'girl.png', '10/28/2022'),
(27, 'BSI', 'Vivian B. Aquino', 'girl.png', '10/28/2022'),
(28, 'Tanod', 'Arsenio G. Nolledo', 'boy.png', '10/28/2022'),
(29, 'Tanod', 'Ryan R. Dorado', 'boy.png', '10/28/2022'),
(30, 'Tanod', 'Oliver M. Laurel', 'boy.png', '10/28/2022'),
(31, 'Tanod', 'Rodilito B. Llaneta', 'boy.png', '10/28/2022'),
(32, 'Tanod', 'Guillernito R. Orbita', 'boy.png', '10/28/2022'),
(33, 'Tanod', 'Rey B. Penamante', 'boy.png', '10/28/2022'),
(34, 'Tanod', 'Wenifredo P. Asis', 'boy.png', '10/28/2022'),
(35, 'DCW', 'Alona O. Salcedo', 'girl.png', '10/28/2022'),
(36, 'DCW', 'Glaiza O. Eneria', 'girl.png', '10/28/2022'),
(37, 'SK Chairman', 'Genry Tena', 'boy.png', '10/28/2022'),
(38, 'SK Kagawad', 'Jacky De leon', 'girl.png', '10/28/2022'),
(39, 'SK Kagawad', 'Jay-ar Abrigo', 'boy.png', '10/28/2022'),
(40, 'SK Kagawad', 'Denver Tena', 'boy.png', '10/28/2022'),
(41, 'SK Kagawad', 'Lizalyn Nolledo', 'girl.png', '10/28/2022'),
(42, 'SK Kagawad', 'Fernando Peñamante', 'boy.png', '10/28/2022'),
(43, 'SK Kagawad', 'Melchor Roldan', 'boy.png', '10/28/2022'),
(45, 'Sanggunian', 'zcx', '4_20210402_184851_0003.png', '2022-11-29 21:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payid` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `cnum` varchar(250) NOT NULL,
  `oldcnum` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `typee` varchar(250) NOT NULL,
  `payment_type` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `refnum` varchar(250) NOT NULL,
  `photoupload` varchar(250) NOT NULL,
  `datepaid` date NOT NULL,
  `dateprocessed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permit`
--

CREATE TABLE `tbl_permit` (
  `permit_id` int(11) NOT NULL,
  `datetimereq` varchar(250) NOT NULL,
  `reqnum` varchar(250) NOT NULL,
  `permit_num` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `tin_no` varchar(250) NOT NULL,
  `phone_num` varchar(250) NOT NULL,
  `tel_num` varchar(250) NOT NULL,
  `corponame` varchar(500) NOT NULL,
  `business_name` varchar(500) NOT NULL,
  `bus_tin` varchar(250) NOT NULL,
  `bus_address` varchar(500) NOT NULL,
  `ownership` varchar(250) NOT NULL,
  `capital_breakdown` text NOT NULL,
  `status` varchar(250) NOT NULL,
  `fromuser` varchar(250) NOT NULL,
  `photoupload` varchar(250) NOT NULL,
  `uploadreq` varchar(250) NOT NULL,
  `datereleased` varchar(250) NOT NULL,
  `date_rel` varchar(150) NOT NULL,
  `captain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_portfolio`
--

CREATE TABLE `tbl_portfolio` (
  `id` int(11) NOT NULL,
  `img_port` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_portfolio`
--

INSERT INTO `tbl_portfolio` (`id`, `img_port`) VALUES
(1, '2.jpg'),
(2, '3.jpg'),
(8, '8.jpg'),
(20, '359383369_590321023262658_8705192340157054774_n.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_released`
--

CREATE TABLE `tbl_released` (
  `id` int(11) NOT NULL,
  `typee` varchar(150) NOT NULL,
  `control_num` varchar(150) NOT NULL,
  `requestor` varchar(250) NOT NULL,
  `datereleased` varchar(250) NOT NULL,
  `forr` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_renewal`
--

CREATE TABLE `tbl_renewal` (
  `renew_id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `oldctrl` varchar(250) NOT NULL,
  `newctrl` varchar(250) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `upload` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `datereleased` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `request_id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `cnum` varchar(250) NOT NULL,
  `oldcnum` varchar(250) NOT NULL,
  `datesent` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `expiredate` datetime NOT NULL,
  `request_type` varchar(250) NOT NULL,
  `fromuser` varchar(250) NOT NULL,
  `datedeleted` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_residency`
--

CREATE TABLE `tbl_residency` (
  `res_id` int(11) NOT NULL,
  `datetimereq` varchar(250) NOT NULL,
  `reqnum` varchar(250) NOT NULL,
  `res_name` varchar(250) NOT NULL,
  `res_mname` varchar(250) NOT NULL,
  `res_lname` varchar(250) NOT NULL,
  `res_email` varchar(150) NOT NULL,
  `res_number` varchar(150) NOT NULL,
  `res_purok` varchar(250) NOT NULL,
  `res_bgy` varchar(250) NOT NULL,
  `civil` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `voter` varchar(250) NOT NULL,
  `res_ctrl` varchar(250) NOT NULL,
  `reqfile` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `photoupload` varchar(250) NOT NULL,
  `datereleased` varchar(250) NOT NULL,
  `date_rel` varchar(150) NOT NULL,
  `fromuser` varchar(250) NOT NULL,
  `captain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident`
--

CREATE TABLE `tbl_resident` (
  `id` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `bday` varchar(150) NOT NULL,
  `civilstat` varchar(150) NOT NULL,
  `purok` varchar(150) NOT NULL,
  `brgy` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `country` varchar(150) NOT NULL,
  `voter` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `gender` varchar(150) NOT NULL,
  `occupation` varchar(150) NOT NULL,
  `citizenship` varchar(150) NOT NULL,
  `bplace` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soloparent`
--

CREATE TABLE `tbl_soloparent` (
  `id` int(11) NOT NULL,
  `reqnum` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `age` varchar(50) NOT NULL,
  `bday` varchar(250) NOT NULL,
  `marital` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `phonenumber` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `work` varchar(250) NOT NULL,
  `workadd` varchar(250) NOT NULL,
  `child` varchar(5) NOT NULL,
  `pay_status` varchar(250) NOT NULL,
  `photoupload` varchar(250) NOT NULL,
  `datereleased` varchar(250) NOT NULL,
  `date_rel` varchar(150) NOT NULL,
  `datetimereq` varchar(250) NOT NULL,
  `uploadreq` varchar(250) NOT NULL,
  `fromuser` varchar(250) NOT NULL,
  `captain` varchar(50) NOT NULL,
  `old_ctrl` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `name` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `position` varchar(250) NOT NULL,
  `bday` varchar(250) NOT NULL,
  `emailadd` varchar(250) NOT NULL,
  `datereq` varchar(250) NOT NULL,
  `timereq` varchar(250) NOT NULL,
  `question1` varchar(150) NOT NULL,
  `answer1` varchar(250) NOT NULL,
  `question2` varchar(150) NOT NULL,
  `answer2` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `name`, `firstname`, `middlename`, `lastname`, `position`, `bday`, `emailadd`, `datereq`, `timereq`, `question1`, `answer1`, `question2`, `answer2`) VALUES
(1, 'admin2', '17a870b798e107a3a62ddde4693fbd7e', 'LYCA C. PRUDENTE', '', '', '', 'SUPERADMIN', '1999-06-02', '', '2022-03-06', '18:59:43', '', '', '', ''),
(43, 'admin1', '17a870b798e107a3a62ddde4693fbd7e', 'FERDINAND T. ORBITA', '', '', '', 'ADMIN02', '2023-04-27', 'kkk@gmail.com', '2023-04-27', '14:50:59', '', '', '222', '22'),
(47, 'joshuaming.jm@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Ricohermoso,Joshua Ming ', 'Joshua Ming', '', 'Ricohermoso', 'USER', '2000-08-06', 'joshuaming.jm@gmail.com', '2023-08-11', '16:56:41', 'What is the name of your favorite childhood friend?', 'asd', 'What is the name of your favorite childhood friend?', 'asd'),
(48, 'admin3', '17a870b798e107a3a62ddde4693fbd7e', 'JOHN SMITH', '', '', '', 'TREASURER', '2023-04-27', 'kkk@gmail.com', '2023-04-27', '14:50:59', '', '', '222', '22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brgy`
--
ALTER TABLE `tbl_brgy`
  ADD PRIMARY KEY (`brgy_id`);

--
-- Indexes for table `tbl_brgyclearance`
--
ALTER TABLE `tbl_brgyclearance`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `tbl_cancelledreq`
--
ALTER TABLE `tbl_cancelledreq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_complaindetails`
--
ALTER TABLE `tbl_complaindetails`
  ADD PRIMARY KEY (`comd_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `tbl_covid`
--
ALTER TABLE `tbl_covid`
  ADD PRIMARY KEY (`covid_id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_increments`
--
ALTER TABLE `tbl_increments`
  ADD PRIMARY KEY (`inc_id`);

--
-- Indexes for table `tbl_indigency`
--
ALTER TABLE `tbl_indigency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_job`
--
ALTER TABLE `tbl_job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tbl_jobquali`
--
ALTER TABLE `tbl_jobquali`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `tbl_lowincome`
--
ALTER TABLE `tbl_lowincome`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_org`
--
ALTER TABLE `tbl_org`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payid`);

--
-- Indexes for table `tbl_permit`
--
ALTER TABLE `tbl_permit`
  ADD PRIMARY KEY (`permit_id`);

--
-- Indexes for table `tbl_portfolio`
--
ALTER TABLE `tbl_portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_released`
--
ALTER TABLE `tbl_released`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_renewal`
--
ALTER TABLE `tbl_renewal`
  ADD PRIMARY KEY (`renew_id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_residency`
--
ALTER TABLE `tbl_residency`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_soloparent`
--
ALTER TABLE `tbl_soloparent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brgy`
--
ALTER TABLE `tbl_brgy`
  MODIFY `brgy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_brgyclearance`
--
ALTER TABLE `tbl_brgyclearance`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cancelledreq`
--
ALTER TABLE `tbl_cancelledreq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_complaindetails`
--
ALTER TABLE `tbl_complaindetails`
  MODIFY `comd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_covid`
--
ALTER TABLE `tbl_covid`
  MODIFY `covid_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_increments`
--
ALTER TABLE `tbl_increments`
  MODIFY `inc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_indigency`
--
ALTER TABLE `tbl_indigency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_job`
--
ALTER TABLE `tbl_job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_jobquali`
--
ALTER TABLE `tbl_jobquali`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_lowincome`
--
ALTER TABLE `tbl_lowincome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_org`
--
ALTER TABLE `tbl_org`
  MODIFY `org_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_permit`
--
ALTER TABLE `tbl_permit`
  MODIFY `permit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_portfolio`
--
ALTER TABLE `tbl_portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_renewal`
--
ALTER TABLE `tbl_renewal`
  MODIFY `renew_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_residency`
--
ALTER TABLE `tbl_residency`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_soloparent`
--
ALTER TABLE `tbl_soloparent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_brgy`
--
ALTER TABLE `tbl_brgy`
  ADD CONSTRAINT `tbl_brgy_ibfk_1` FOREIGN KEY (`brgy_id`) REFERENCES `tbl_org` (`org_id`);

--
-- Constraints for table `tbl_complaindetails`
--
ALTER TABLE `tbl_complaindetails`
  ADD CONSTRAINT `tbl_complaindetails_ibfk_1` FOREIGN KEY (`comd_id`) REFERENCES `tbl_complaint` (`com_id`);

--
-- Constraints for table `tbl_released`
--
ALTER TABLE `tbl_released`
  ADD CONSTRAINT `tbl_released_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_payments` (`payid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
