-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 04:23 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aloalo`
--
CREATE DATABASE IF NOT EXISTS `aloalo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `aloalo`;

-- --------------------------------------------------------

--
-- Table structure for table `logindata`
--

CREATE TABLE `logindata` (
  `iduser` int(15) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT current_timestamp(),
  `screenresolution` varchar(15) DEFAULT NULL,
  `operatingsystem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wscart`
--

CREATE TABLE `wscart` (
  `idcart` int(15) NOT NULL,
  `iduser` int(15) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wscartitem`
--

CREATE TABLE `wscartitem` (
  `idcartitem` int(25) NOT NULL,
  `cartid` int(25) NOT NULL,
  `productid` int(15) NOT NULL,
  `amount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wscategory`
--

CREATE TABLE `wscategory` (
  `categoryid` int(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wscategory`
--

INSERT INTO `wscategory` (`categoryid`, `title`, `description`) VALUES
(1, 'Damenuhr', 'damenuhren'),
(2, 'Herrenuhr', 'herrenuhren');

-- --------------------------------------------------------

--
-- Table structure for table `wsorder`
--

CREATE TABLE `wsorder` (
  `idorder` int(15) NOT NULL,
  `iduser` int(15) NOT NULL,
  `idcart` int(15) NOT NULL,
  `totalvalue` float(15,2) NOT NULL,
  `shippingmethod` varchar(20) NOT NULL DEFAULT 'dpd',
  `shippingname` varchar(50) NOT NULL,
  `shippingemail` varchar(50) NOT NULL,
  `shippingaddress` varchar(50) NOT NULL,
  `zip` int(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `paymentmethod` varchar(50) DEFAULT NULL,
  `paymentname` varchar(50) DEFAULT NULL,
  `paymentnumber` int(11) DEFAULT NULL,
  `placedtime` timestamp NULL DEFAULT current_timestamp(),
  `isclosed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wsproduct`
--

CREATE TABLE `wsproduct` (
  `productid` int(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `categoryid` int(15) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` float(10,2) NOT NULL,
  `productamount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wsproduct`
--

INSERT INTO `wsproduct` (`productid`, `title`, `description`, `categoryid`, `image`, `price`, `productamount`) VALUES
(1, 'Festina Damenuhr', 'Festina Damenuhr mit goldenem Armband und Kristall', 1, 'image/female_watch1.jpg', 119.00, 3000),
(2, 'Fossil Damenuhr', 'Fossil Damenuhr wei&szlig; mit wei&szlig;em Armband und ros&eacute;gold Uhrzeiger', 1, 'image/female_watch2.jpg', 99.00, 2000),
(3, 'Gigandel Damenuhr', 'Gigandel Damenuhr ros&eacute;gold mit ros&eacute;goldem Armband', 1, 'image/female_watch3.jpg', 149.99, 1000),
(4, 'Dugena Damenuhr', 'Dugena Damenuhr gold mit goldenem Armband und Uhrzeiger', 1, 'image/female_watch4.jpg', 79.00, 4000),
(5, 'Regent Damenuhr', 'Regent Damenuhr violet silver mit silver Armband', 1, 'image/female_watch5.jpg', 99.00, 3000),
(6, 'Adora Damenuhr', 'Adora Damenuhr gold wei&szlig; mit gro&szlig;en Uhrzeitangaben', 1, 'image/female_watch6.jpg', 74.99, 2000),
(7, 'Candino Sapphire ', 'Candino Sapphire Damenuhr gold mit goldenen Uhrzeigern und Uhrzeitangaben', 1, 'image/female_watch7.jpg', 119.49, 1000),
(8, 'Jobo Damenuhr', 'Jobo Damenuhr wei&szlig; gold mit Saphirglas mit Datumangaben', 1, 'image/female_watch8.jpg', 149.99, 2300),
(9, 'Bering Ceramic', 'Bering Ceramic Damenuhr dunkel ros&eacute;gold krystal Uhrzeitangaben', 1, 'image/female_watch9.jpg', 249.99, 1500),
(10, 's.Oliver Damenuhr', 's.Oliver Damenuhr weiß rosegold mit ros&eacute;golden Uhrzeitangaben und Armband', 1, 'image/female_watch10.jpg', 119.00, 2991),
(11, 'Rolex Oyster Perpetual', 'Rolex Oyster Perpetual Herrenuhr luxuriös – die Quintessenz der Oyster und Verkörperung eines klassischen und universellen Stils.', 2, 'image/male_watch1.jpg', 4199.00, 234),
(12, 'A.Lange und Söhne Herrenuhr', 'A.Lange und Söhne Herrenuhr mit Lederarmband Datumangaben Monatangaben Glash&uuml;tte r&ouml;mische Uhrzeiger', 2, 'image/male_watch2.jpg', 999.99, 1000),
(13, 'Maurice Lacroix', 'Maurice Lacroix Chronograph Automatic Automaticuhr mit Lederarmband', 2, 'image/male_watch3.jpg', 149.99, 4001),
(14, 'Patek Philippe', 'Patek Philippe Geneve silver Datumangaben Swiss ', 2, 'image/male_watch4.jpg', 99.00, 5000),
(15, 'Audemarz Piguez', 'Audemarz Piguez Automatikuhr Silver automatic Datumangaben', 2, 'image/male_watch5.jpg', 74.99, 6700),
(16, 'Rolex Oyster Perpetual Submariner', 'Rolex Oyster Perpetual Submariner luxuriös Superlativer Chronometer Officially Certified ', 2, 'image/male_watch6.jpg', 14999.99, 150),
(17, 'Lacoste Herrenuhr', 'Lacoste Herrenuhr since 1927 dunkel schwarz schwarzem Armband', 2, 'image/male_watch7.jpg', 179.00, 3000),
(18, 'Festina Herrenuhr', 'Festina Herrenuhr weiß mit Lederarmband Tachymeter Datumangaben', 2, 'image/male_watch8.jpg', 199.99, 2480),
(19, 'Fossil Herrenuhr', 'Fossil Herrenuhr weiß mit Lederarmband', 2, 'image/male_watch9.jpg', 164.99, 957),
(20, 'Jobo Herrenuhr', 'Jobo Herrenuhr blau mit Lederarmband Datumangaben', 2, 'image/male_watch10.jpg', 124.90, 2789),
(21, 'Rolex Oyster Perpetual', 'Rolex Oyster Perpetual Herrenuhr luxuriös – die Quintessenz der Oyster und Verkörperung eines klassischen und universellen Stils.', 2, 'image/male_watch1.jpg', 4199.00, 234),
(22, 'A.Lange und Söhne Herrenuhr', 'A.Lange und Söhne Herrenuhr mit Lederarmband Datumangaben Monatangaben Glash&uuml;tte r&ouml;mische Uhrzeiger', 2, 'image/male_watch2.jpg', 999.99, 1000),
(23, 'Maurice Lacroix', 'Maurice Lacroix Chronograph Automatic Automaticuhr mit Lederarmband', 2, 'image/male_watch3.jpg', 149.99, 4001),
(24, 'Patek Philippe', 'Patek Philippe Geneve silver Datumangaben Swiss ', 2, 'image/male_watch4.jpg', 99.00, 5000),
(25, 'Audemarz Piguez', 'Audemarz Piguez Automatikuhr Silver automatic Datumangaben', 2, 'image/male_watch5.jpg', 74.99, 6700),
(26, 'Rolex Oyster Perpetual Submariner', 'Rolex Oyster Perpetual Submariner luxuriös Superlativer Chronometer Officially Certified ', 2, 'image/male_watch6.jpg', 14999.99, 150),
(27, 'Lacoste Herrenuhr', 'Lacoste Herrenuhr since 1927 dunkel schwarz schwarzem Armband', 2, 'image/male_watch7.jpg', 179.00, 3000),
(28, 'Festina Herrenuhr', 'Festina Herrenuhr weiß mit Lederarmband Tachymeter Datumangaben', 2, 'image/male_watch8.jpg', 199.99, 2480),
(29, 'Fossil Herrenuhr', 'Fossil Herrenuhr weiß mit Lederarmband', 2, 'image/male_watch9.jpg', 164.99, 957),
(30, 'Jobo Herrenuhr', 'Jobo Herrenuhr blau mit Lederarmband Datumangaben', 2, 'image/male_watch10.jpg', 124.90, 2789);

-- --------------------------------------------------------

--
-- Table structure for table `wsuser`
--

CREATE TABLE `wsuser` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(512) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `lastlogin` timestamp(6) NULL DEFAULT current_timestamp(6),
  `ispwreseted` tinyint(1) NOT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logindata`
--
ALTER TABLE `logindata`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `wscart`
--
ALTER TABLE `wscart`
  ADD PRIMARY KEY (`idcart`);

--
-- Indexes for table `wscartitem`
--
ALTER TABLE `wscartitem`
  ADD PRIMARY KEY (`idcartitem`),
  ADD KEY `productid` (`productid`),
  ADD KEY `cartid` (`cartid`);

--
-- Indexes for table `wscategory`
--
ALTER TABLE `wscategory`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `wsorder`
--
ALTER TABLE `wsorder`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `idcart` (`idcart`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `wsproduct`
--
ALTER TABLE `wsproduct`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `categoryid` (`categoryid`),
  ADD KEY `categoryid_2` (`categoryid`),
  ADD KEY `categoryid_3` (`categoryid`);

--
-- Indexes for table `wsuser`
--
ALTER TABLE `wsuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logindata`
--
ALTER TABLE `logindata`
  MODIFY `iduser` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wscart`
--
ALTER TABLE `wscart`
  MODIFY `idcart` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wscartitem`
--
ALTER TABLE `wscartitem`
  MODIFY `idcartitem` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wscategory`
--
ALTER TABLE `wscategory`
  MODIFY `categoryid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wsorder`
--
ALTER TABLE `wsorder`
  MODIFY `idorder` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wsproduct`
--
ALTER TABLE `wsproduct`
  MODIFY `productid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `wsuser`
--
ALTER TABLE `wsuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wscartitem`
--
ALTER TABLE `wscartitem`
  ADD CONSTRAINT `cartitem_cart` FOREIGN KEY (`cartid`) REFERENCES `wscart` (`idcart`),
  ADD CONSTRAINT `cartitem_product` FOREIGN KEY (`productid`) REFERENCES `wsproduct` (`productid`);

--
-- Constraints for table `wsorder`
--
ALTER TABLE `wsorder`
  ADD CONSTRAINT `order_cart` FOREIGN KEY (`idcart`) REFERENCES `wscart` (`idcart`),
  ADD CONSTRAINT `order_user` FOREIGN KEY (`iduser`) REFERENCES `wsuser` (`id`);

--
-- Constraints for table `wsproduct`
--
ALTER TABLE `wsproduct`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`categoryid`) REFERENCES `wscategory` (`categoryid`);
--
-- Database: `customerportal`
--
CREATE DATABASE IF NOT EXISTS `customerportal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `customerportal`;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `BranchID` char(4) NOT NULL,
  `street` varchar(13) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `plz` char(7) DEFAULT NULL,
  `managerFK` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BranchID`, `street`, `city`, `plz`, `managerFK`, `phone`) VALUES
('B001', '23 Abbots Dri', 'Edinburgh', 'AB34 01', 2, '+44 131 774-5632'),
('B002', '56 Clover Dr', 'London', 'NW10 6E', 1, '+44 171 848-1825'),
('B003', '163 Main St', 'Glasgow', 'G11 9QX', 3, '+44 141 357-7419'),
('B004', '32 Manse Rd', 'Bristol', 'BS99 1N', 4, '+44 117 943-1728'),
('B005', '22 Deer Rd', 'London', 'SW1 4EH', 14, '+44 181 225-7025'),
('B006', '123 Coast Lan', 'Brighton', 'BC71 15', 33, '+45 1273 199-300'),
('B007', '16 Argyll St', 'Aberdeen', 'AB2 3SU', 40, '+44 1224 861-212'),
('B008', '17 Hogart Bd', 'Derby', 'RX01 5A', 26, '+44 1332 769-301'),
('B009', '52 Gutter St', 'Exeter', 'A11 R15', 34, '+44 1392 129-375'),
('B010', '6 Lawrence St', 'Newcastle', 'PG22 5A', 6, '+44 1782 196-720'),
('B011', '13 Dale Rd', 'Liverpool', 'AL8  83', 8, '+44 151 543-0973'),
('B012', '2 Manor Rd', 'Manchester', 'ABC 015', 13, '+44 161 390-7428'),
('B013', '5 Novar Drive', 'Leeds', 'LX17 AK', 16, '+44 113 142-2899'),
('B014', '61 Queens Cir', 'Liverpool', 'AL8 L14', 25, '+44 151 834-2344');

-- --------------------------------------------------------

--
-- Stand-in structure for view `branchsmall`
-- (See below for the actual view)
--
CREATE TABLE `branchsmall` (
`branchFK` char(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `female`
-- (See below for the actual view)
--
CREATE TABLE `female` (
`branchFK` char(4)
,`female` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `geschlechtanteil`
-- (See below for the actual view)
--
CREATE TABLE `geschlechtanteil` (
`branchFK` char(4)
,`gender` varchar(1)
,`AnzahlMa` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `salary1`
-- (See below for the actual view)
--
CREATE TABLE `salary1` (
`supervisorFK` int(11)
,`max` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `EmpID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` varchar(1) DEFAULT NULL CHECK (`gender` in ('F','M')),
  `salary` decimal(10,2) DEFAULT NULL,
  `supervisorFK` int(11) DEFAULT NULL,
  `branchFK` char(4) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL CHECK (`position` in ('Director','Manager','Supervisor','Assistant'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`EmpID`, `name`, `gender`, `salary`, `supervisorFK`, `branchFK`, `position`) VALUES
(1, 'Robert King', 'M', '143000.00', NULL, 'B002', 'Director'),
(2, 'Rafael McDonalds', 'M', '72000.00', 1, 'B001', 'Manager'),
(3, 'John White', 'M', '60000.00', 1, 'B003', 'Manager'),
(4, 'Susan Brand', 'F', '55000.00', 1, 'B004', 'Manager'),
(5, 'Cathy Brown', 'F', '32000.00', 2, 'B001', 'Supervisor'),
(6, 'Claire Dujeune', 'F', '79000.00', 1, 'B010', 'Manager'),
(7, 'Patty Summer', 'F', '23000.00', 2, 'B001', 'Supervisor'),
(8, 'Mary Fleming', 'F', '43000.00', 1, 'B011', 'Manager'),
(9, 'Carl Maier', 'M', '31000.00', 64, 'B011', 'Assistant'),
(10, 'Anne Beech', 'F', '26000.00', 5, 'B001', 'Assistant'),
(12, 'Paul Coplien', 'M', '27000.00', 3, 'B003', 'Supervisor'),
(13, 'David Ford', 'M', '41000.00', 1, 'B012', 'Manager'),
(14, 'Mary Howe', 'F', '55000.00', 1, 'B005', 'Manager'),
(15, 'Julie Lee', 'F', '34000.00', 3, 'B003', 'Supervisor'),
(16, 'Aaron Young', 'M', '74000.00', 1, 'B013', 'Manager'),
(17, 'Albert Thomson', 'M', '25000.00', 13, 'B012', 'Supervisor'),
(18, 'Christine McDonalds', 'F', '38000.00', 4, 'B004', 'Supervisor'),
(19, 'Elisa Pinkerton', 'F', '36000.00', 16, 'B013', 'Supervisor'),
(20, 'Eric Montgomery', 'M', '33000.00', 7, 'B001', 'Assistant'),
(21, 'Alexander Reynolds', 'M', '37000.00', 5, 'B001', 'Assistant'),
(22, 'Edward Robinson', 'M', '28000.00', 7, 'B001', 'Assistant'),
(23, 'Jesse Owens', 'M', '34000.00', 4, 'B004', 'Supervisor'),
(25, 'Johnatan Hunter', 'M', '45000.00', 1, 'B014', 'Manager'),
(26, 'Lenita Kennedy', 'F', '56000.00', 1, 'B009', 'Manager'),
(27, 'Lisa Miller', 'F', '34000.00', 25, 'B014', 'Supervisor'),
(28, 'Lilly Jennings', 'F', '36000.00', 14, 'B005', 'Supervisor'),
(29, 'Rafaela Johnson', 'F', '23000.00', 12, 'B003', 'Assistant'),
(32, 'Harry Anderson', 'M', '40000.00', 12, 'B003', 'Assistant'),
(33, 'George Bailey', 'M', '73000.00', 1, 'B006', 'Manager'),
(34, 'Salomon Beckett', 'M', '46000.00', 1, 'B008', 'Manager'),
(35, 'Susan Armstrong', 'F', '28000.00', 15, 'B003', 'Assistant'),
(36, 'Rosa Hemingway', 'F', '30000.00', 15, 'B003', 'Assistant'),
(37, 'Martha McDonalds', 'F', '31000.00', 15, 'B003', 'Assistant'),
(38, 'Anna-Isabell Green', 'F', '32000.00', 33, 'B006', 'Supervisor'),
(39, 'Tina Hall-Becker', 'F', '34000.00', 18, 'B004', 'Assistant'),
(40, 'Thomas Harrison', 'M', '42000.00', 1, 'B007', 'Manager'),
(42, 'Winston Hughes', 'M', '22000.00', 40, 'B007', 'Supervisor'),
(44, 'Walter Jefferson', 'M', '23000.00', 18, 'B004', 'Assistant'),
(45, 'Zara Newton', 'F', '24000.00', 23, 'B004', 'Assistant'),
(46, 'Nina McDonalds', 'F', '25000.00', 23, 'B004', 'Assistant'),
(47, 'Naomi Campell', 'F', '26000.00', 63, 'B010', 'Assistant'),
(48, 'Carol Moore', 'M', '27000.00', 40, 'B007', 'Supervisor'),
(49, 'Tony McDonalds', 'M', '28000.00', 63, 'B010', 'Assistant'),
(50, 'Margret McElroy', 'F', '29000.00', 64, 'B011', 'Assistant'),
(51, 'Alexander Porter', 'M', '29000.00', 17, 'B012', 'Assistant'),
(52, 'Maria Quasimodo', 'M', '30000.00', 17, 'B012', 'Assistant'),
(53, 'Bertrand Russel', 'M', '31000.00', 34, 'B008', 'Supervisor'),
(54, 'Ashley Parker', 'M', '25500.00', 28, 'B005', 'Assistant'),
(55, 'John Stuart', 'M', '23500.00', 28, 'B005', 'Assistant'),
(56, 'Ruth Sanderss', 'F', '27700.00', 19, 'B013', 'Assistant'),
(57, 'Rafael Smith', 'M', '32000.00', 19, 'B013', 'Assistant'),
(58, 'Viola Rutherford', 'F', '21000.00', 27, 'B014', 'Assistant'),
(59, 'Sammy Churchill', 'M', '22000.00', 27, 'B014', 'Assistant'),
(60, 'Miriam Thorne', 'F', '26000.00', 27, 'B014', 'Assistant'),
(61, 'Sally Thatcher', 'F', '36000.00', 34, 'B008', 'Supervisor'),
(62, 'Larry Escott', 'M', '33000.00', 26, 'B009', 'Supervisor'),
(63, 'William Spencer', 'M', '32000.00', 6, 'B010', 'Supervisor'),
(64, 'Diana Ashley-Bell', 'F', '38000.00', 8, 'B011', 'Supervisor'),
(65, 'Audrey Thorne', 'F', '25000.00', 62, 'B009', 'Assistant'),
(66, 'Paula Burns', 'F', '24000.00', 62, 'B002', 'Assistant'),
(67, 'Amanda Wallis', 'F', '23000.00', 38, 'B006', 'Assistant'),
(68, 'Patty Stokes', 'F', '22000.00', 53, 'B008', 'Assistant'),
(69, 'Holly Fields', 'F', '21500.00', 53, 'B008', 'Assistant'),
(70, 'Martha McCulloch', 'F', '26000.00', 61, 'B008', 'Assistant'),
(71, 'Maurin Best', 'F', '22500.00', 42, 'B007', 'Assistant'),
(72, 'Martha McDonalds', 'F', '23500.00', 27, 'B014', 'Assistant'),
(73, 'Barrigan', NULL, '23500.00', 27, 'B013', 'Assistant'),
(74, 'Carly Fiorina', 'F', '31000.00', 64, 'B001', 'Assistant');

-- --------------------------------------------------------

--
-- Stand-in structure for view `supervisor`
-- (See below for the actual view)
--
CREATE TABLE `supervisor` (
`branchFK` char(4)
,`gender` int(1)
,`anzahl` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total`
-- (See below for the actual view)
--
CREATE TABLE `total` (
`branchFK` char(4)
,`total` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `branchsmall`
--
DROP TABLE IF EXISTS `branchsmall`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `branchsmall`  AS  (select `staff`.`branchFK` AS `branchFK` from `staff` where `staff`.`position` = 'assistant' group by `staff`.`branchFK` having count(0) < 2) ;

-- --------------------------------------------------------

--
-- Structure for view `female`
--
DROP TABLE IF EXISTS `female`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `female`  AS SELECT `staff`.`branchFK` AS `branchFK`, count(0) AS `female` FROM `staff` WHERE `staff`.`gender` = 'F' GROUP BY `staff`.`branchFK` ORDER BY `staff`.`branchFK` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `geschlechtanteil`
--
DROP TABLE IF EXISTS `geschlechtanteil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `geschlechtanteil`  AS SELECT `staff`.`branchFK` AS `branchFK`, `staff`.`gender` AS `gender`, count(0) AS `AnzahlMa` FROM `staff` GROUP BY `staff`.`branchFK`, `staff`.`gender` ;

-- --------------------------------------------------------

--
-- Structure for view `salary1`
--
DROP TABLE IF EXISTS `salary1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `salary1`  AS  (select `staff`.`supervisorFK` AS `supervisorFK`,max(`staff`.`salary`) AS `max` from `staff` group by `staff`.`supervisorFK`) ;

-- --------------------------------------------------------

--
-- Structure for view `supervisor`
--
DROP TABLE IF EXISTS `supervisor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supervisor`  AS SELECT `staff`.`branchFK` AS `branchFK`, CASE WHEN `staff`.`gender` = 'F' THEN 1 ELSE 2 END AS `gender`, count(0) AS `anzahl` FROM `staff` WHERE `staff`.`position` = 'supervisor' GROUP BY `staff`.`branchFK` ORDER BY `staff`.`branchFK` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `total`
--
DROP TABLE IF EXISTS `total`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total`  AS SELECT `staff`.`branchFK` AS `branchFK`, count(0) AS `total` FROM `staff` GROUP BY `staff`.`branchFK` ORDER BY `staff`.`branchFK` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`BranchID`),
  ADD KEY `managerFK` (`managerFK`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`EmpID`),
  ADD KEY `staff_ibfk_1` (`supervisorFK`),
  ADD KEY `branchFK` (`branchFK`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `branchFK` FOREIGN KEY (`branchFK`) REFERENCES `branch` (`BranchID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`supervisorFK`) REFERENCES `staff` (`EmpID`) ON DELETE SET NULL ON UPDATE CASCADE;
--
-- Database: `fportal`
--
CREATE DATABASE IF NOT EXISTS `fportal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fportal`;

-- --------------------------------------------------------

--
-- Table structure for table `fpfriends`
--

CREATE TABLE `fpfriends` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `studycourse` varchar(150) NOT NULL,
  `semester` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fpfriends`
--

INSERT INTO `fpfriends` (`id`, `uid`, `firstname`, `lastname`, `city`, `studycourse`, `semester`) VALUES
(1, 1, 'Tom', 'Berger', 'Stuttgart', '', '4'),
(2, 1, 'Saskia', 'Müller', 'Reutlingen', 'Medien- und Kommunikationsinformatik', '2'),
(4, 2, 'Clara', 'Sass', 'Stuttgart', 'MKI', '4');

-- --------------------------------------------------------

--
-- Table structure for table `fpuser`
--

CREATE TABLE `fpuser` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fpuser`
--

INSERT INTO `fpuser` (`id`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'Timm', 'Wohl', 'tw', 12),
(2, 'Matt', 'Gut', 'mg', 12),
(4, 'Thomas', 'Müller', 'tm', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fpfriends`
--
ALTER TABLE `fpfriends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fpuser`
--
ALTER TABLE `fpuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fpfriends`
--
ALTER TABLE `fpfriends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fpuser`
--
ALTER TABLE `fpuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Dumping data for table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"angular_direct\":\"direct\",\"relation_lines\":\"true\",\"snap_to_grid\":\"off\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"webshop\",\"table\":\"wsuser\"},{\"db\":\"webshop\",\"table\":\"wsorder\"},{\"db\":\"webshop\",\"table\":\"logindata\"},{\"db\":\"webshop\",\"table\":\"wscart\"},{\"db\":\"webshop\",\"table\":\"wscartitem\"},{\"db\":\"webshop\",\"table\":\"wscategory\"},{\"db\":\"webshop\",\"table\":\"wsproduct\"},{\"db\":\"aloalo\",\"table\":\"wsuser\"},{\"db\":\"aloalo\",\"table\":\"wsproduct\"},{\"db\":\"aloalo\",\"table\":\"wsorder\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- Dumping data for table `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('customerportal', 'staff', 'name'),
('webshop', 'logindata', 'screenresolution'),
('webshop', 'wsorder', 'shippingname'),
('webshop', 'wsproduct', 'title');

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'customerportal', 'staff', '{\"sorted_col\":\"`staff`.`supervisorFK` ASC\"}', '2021-06-25 00:01:09'),
('root', 'webshop', 'wsorder', '[]', '2021-06-21 21:40:04'),
('root', 'webshop', 'wsuser', '{\"CREATE_TIME\":\"2021-06-12 15:21:46\",\"sorted_col\":\"`id` ASC\"}', '2021-06-13 18:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2021-07-02 14:22:35', '{\"Console\\/Mode\":\"show\",\"Console\\/Height\":-28.022999999999996}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `webshop`
--
CREATE DATABASE IF NOT EXISTS `webshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webshop`;

-- --------------------------------------------------------

--
-- Table structure for table `logindata`
--

CREATE TABLE `logindata` (
  `iduser` int(15) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `screenresolution` varchar(15) DEFAULT NULL,
  `operatingsystem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logindata`
--

INSERT INTO `logindata` (`iduser`, `logintime`, `screenresolution`, `operatingsystem`) VALUES
(7, '2021-06-30 23:12:13', '1536x864', 'Windows 10'),
(7, '2021-07-01 13:48:17', '1536x864', 'Windows 10'),
(30, '2021-07-01 17:49:00', '1536x864', 'Windows 10'),
(30, '2021-07-01 18:08:58', '1536x864', 'Windows 10'),
(30, '2021-07-01 18:34:40', '1536x864', 'Windows 10'),
(30, '2021-07-01 22:29:05', '1536x864', 'Windows 10'),
(30, '2021-07-02 13:28:12', '1536x864', 'Windows 10'),
(30, '2021-07-02 13:42:51', '1536x864', 'Windows 10'),
(30, '2021-07-02 13:48:41', '1536x864', 'Windows 10');

-- --------------------------------------------------------

--
-- Table structure for table `wscart`
--

CREATE TABLE `wscart` (
  `idcart` int(15) NOT NULL,
  `iduser` int(11) NOT NULL,
  `createdat` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wscart`
--

INSERT INTO `wscart` (`idcart`, `iduser`, `createdat`) VALUES
(3, 3, '2021-06-14 14:13:44.000000'),
(5, 3, '2021-06-14 14:29:34.000000'),
(6, 8, '2021-06-14 14:56:21.000000'),
(7, 7, '2021-06-14 15:44:20.000000'),
(8, 7, '2021-06-14 15:44:42.000000'),
(9, 7, '2021-06-14 15:45:59.000000'),
(10, 7, '2021-06-14 15:46:48.000000'),
(11, 7, '2021-06-14 15:49:14.000000'),
(12, 7, '2021-06-14 15:51:34.000000'),
(13, 7, '2021-06-14 15:52:01.000000'),
(14, 7, '2021-06-20 16:04:57.000000'),
(15, 7, '2021-06-21 22:17:46.000000'),
(16, 7, '2021-06-21 23:45:12.000000'),
(17, 7, '2021-06-21 23:49:24.000000'),
(18, 30, '2021-07-01 17:49:00.000000'),
(19, 30, '2021-07-01 18:08:58.000000'),
(20, 30, '2021-07-01 18:12:07.000000'),
(21, 30, '2021-07-02 13:45:08.000000');

-- --------------------------------------------------------

--
-- Table structure for table `wscartitem`
--

CREATE TABLE `wscartitem` (
  `idcartitem` int(25) NOT NULL,
  `cartid` int(15) NOT NULL,
  `productid` int(15) NOT NULL,
  `amount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wscartitem`
--

INSERT INTO `wscartitem` (`idcartitem`, `cartid`, `productid`, `amount`) VALUES
(38, 18, 10, 1),
(39, 18, 20, 11),
(40, 18, 2, 14),
(41, 19, 2, 12),
(42, 19, 7, 1),
(43, 19, 9, 1),
(44, 19, 14, 10),
(47, 20, 7, 3),
(49, 20, 1, 1),
(50, 20, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `wscategory`
--

CREATE TABLE `wscategory` (
  `categoryid` int(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wscategory`
--

INSERT INTO `wscategory` (`categoryid`, `title`, `description`) VALUES
(1, 'Damenuhr', 'damenuhren'),
(2, 'Herrenuhr', 'herrenuhren');

-- --------------------------------------------------------

--
-- Table structure for table `wsorder`
--

CREATE TABLE `wsorder` (
  `idorder` int(15) NOT NULL,
  `iduser` int(15) NOT NULL,
  `idcart` int(15) NOT NULL,
  `totalvalue` float(15,2) NOT NULL,
  `shippingmethod` varchar(20) NOT NULL DEFAULT 'dpd',
  `shippingname` varchar(50) NOT NULL,
  `shippingemail` varchar(50) NOT NULL,
  `shippingaddress` varchar(50) NOT NULL,
  `zip` int(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `paymentmethod` varchar(50) DEFAULT NULL,
  `paymentname` varchar(50) DEFAULT NULL,
  `paymentnumber` int(11) DEFAULT NULL,
  `placedtime` timestamp NULL DEFAULT current_timestamp(),
  `isclosed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wsorder`
--

INSERT INTO `wsorder` (`idorder`, `iduser`, `idcart`, `totalvalue`, `shippingmethod`, `shippingname`, `shippingemail`, `shippingaddress`, `zip`, `city`, `paymentmethod`, `paymentname`, `paymentnumber`, `placedtime`, `isclosed`) VALUES
(45, 7, 16, 332.48, 'dhl-express', 'Viet Dung Bui', 'vodok262@gmail.com', '', 70372, '', 'sepa', 'Thi Hai Nguyen', 2147483647, '2021-06-21 23:49:22', 1),
(46, 7, 17, 0.00, '', 'Thomas Müller', 'tm@gmail.com', '', 0, '', NULL, NULL, NULL, NULL, 0),
(47, 7, 16, 332.48, 'dhl-express', 'Viet Dung Bui', 'vodok262@gmail.com', '', 70372, '', 'sepa', 'Thi Hai Nguyen', 2147483647, '2021-06-21 23:52:29', 1),
(49, 30, 19, 2235.77, 'dhl-express', 'Thi Nguyen', 'nguyenyen281099@gmail.com', 'Wilhelmstr. 122', 72764, 'Reutlingen', 'sepa', 'Viet Dung Bui', 2147483647, '2021-07-01 18:12:04', 1),
(50, 30, 20, 1407.11, 'dpd', 'Abc Nguyen', 'nguyenyen281099@gmail.com', 'Wilhelmstr. 122', 72764, 'Reutlingen', 'sepa', 'Thi Hai Yen Nguyen', 123123123, '2021-07-02 13:45:05', 1),
(51, 30, 19, 2235.77, 'dhl-express', 'Thi Nguyen', 'nguyenyen281099@gmail.com', 'Wilhelmstr. 122', 72764, 'Reutlingen', 'sepa', 'Viet Dung Bui', 2147483647, '2021-07-01 18:12:42', 1),
(52, 30, 21, 0.00, '', 'Thi Nguyen', 'nguyenyen281099@gmail.com', 'Wilhelmstr. 122', 72764, 'Reutlingen', NULL, NULL, NULL, NULL, 0),
(53, 30, 19, 2235.77, 'dhl-express', 'Thi Nguyen', 'nguyenyen281099@gmail.com', 'Wilhelmstr. 122', 72764, 'Reutlingen', 'sepa', 'Viet Dung Bui', 2147483647, '2021-07-02 13:45:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wsproduct`
--

CREATE TABLE `wsproduct` (
  `productid` int(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `categoryid` int(15) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` float(10,2) NOT NULL,
  `productamount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wsproduct`
--

INSERT INTO `wsproduct` (`productid`, `title`, `description`, `categoryid`, `image`, `price`, `productamount`) VALUES
(1, 'Festina Damenuhr', 'Festina Damenuhr mit goldenem Armband und Kristall', 1, 'image/female_watch1.jpg', 119.00, 963),
(2, 'Fossil Damenuhr', 'Fossil Damenuhr wei&szlig; mit wei&szlig;em Armband und ros&eacute;gold Uhrzeiger', 1, 'image/female_watch2.jpg', 99.00, 1891),
(3, 'Gigandel Damenuhr', 'Gigandel Damenuhr ros&eacute;gold mit ros&eacute;goldem Armband', 1, 'image/female_watch3.jpg', 149.99, 1493),
(4, 'Dugena Damenuhr', 'Dugena Damenuhr gold mit goldenem Armband und Uhrzeiger', 1, 'image/female_watch4.jpg', 79.00, 2945),
(5, 'Regent Damenuhr', 'Regent Damenuhr violet silver mit silver Armband', 1, 'image/female_watch5.jpg', 99.00, 3000),
(6, 'Adora Damenuhr', 'Adora Damenuhr gold wei&szlig; mit gro&szlig;en Uhrzeitangaben', 1, 'image/female_watch6.jpg', 74.99, 3489),
(7, 'Candino Sapphire ', 'Candino Sapphire Damenuhr gold mit goldenen Uhrzeigern und Uhrzeitangaben', 1, 'image/female_watch7.jpg', 119.49, 2992),
(8, 'Jobo Damenuhr', 'Jobo Damenuhr wei&szlig; gold mit Saphirglas mit Datumangaben', 1, 'image/female_watch8.jpg', 149.99, 2000),
(9, 'Bering Ceramic', 'Bering Ceramic Damenuhr dunkel ros&eacute;gold krystal Uhrzeitangaben', 1, 'image/female_watch9.jpg', 249.99, 1486),
(10, 's.Oliver Damenuhr', 's.Oliver Damenuhr weiß rosegold mit ros&eacute;golden Uhrzeitangaben und Armband', 1, 'image/female_watch10.jpg', 119.00, 1996),
(11, 'Rolex Oyster Perpetual', 'Rolex Oyster Perpetual Herrenuhr luxuriös – die Quintessenz der Oyster und Verkörperung eines klassischen und universellen Stils.', 2, 'image/male_watch1.jpg', 4199.00, 70),
(12, 'A.Lange und Söhne Herrenuhr', 'A.Lange und Söhne Herrenuhr mit Lederarmband Datumangaben Monatangaben Glash&uuml;tte r&ouml;mische Uhrzeiger', 2, 'image/male_watch2.jpg', 999.99, 499),
(13, 'Maurice Lacroix', 'Maurice Lacroix Chronograph Automatic Automaticuhr mit Lederarmband', 2, 'image/male_watch3.jpg', 149.99, 3000),
(14, 'Patek Philippe', 'Patek Philippe Geneve silver Datumangaben Swiss ', 2, 'image/male_watch4.jpg', 99.00, 3468),
(15, 'Audemarz Piguez', 'Audemarz Piguez Automatikuhr Silver automatic Datumangaben', 2, 'image/male_watch5.jpg', 74.99, 3999),
(16, 'Rolex Oyster Perpetual Submariner', 'Rolex Oyster Perpetual Submariner luxuriös Superlativer Chronometer Officially Certified ', 2, 'image/male_watch6.jpg', 14999.99, 50),
(17, 'Lacoste Herrenuhr', 'Lacoste Herrenuhr since 1927 dunkel schwarz schwarzem Armband', 2, 'image/male_watch7.jpg', 179.00, 2390),
(18, 'Festina Herrenuhr', 'Festina Herrenuhr weiß mit Lederarmband Tachymeter Datumangaben', 2, 'image/male_watch8.jpg', 199.99, 1260),
(19, 'Fossil Herrenuhr', 'Fossil Herrenuhr weiß mit Lederarmband', 2, 'image/male_watch9.jpg', 164.99, 2500),
(20, 'Jobo Herrenuhr', 'Jobo Herrenuhr blau mit Lederarmband Datumangaben', 2, 'image/male_watch10.jpg', 124.90, 1976);

-- --------------------------------------------------------

--
-- Table structure for table `wsuser`
--

CREATE TABLE `wsuser` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(512) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `lastlogin` timestamp(6) NULL DEFAULT current_timestamp(6),
  `ispwreseted` tinyint(1) NOT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wsuser`
--

INSERT INTO `wsuser` (`id`, `username`, `firstname`, `lastname`, `password`, `address`, `city`, `zip`, `active`, `lastlogin`, `ispwreseted`, `token`) VALUES
(7, 'tm@gmail.com', 'Thomas', 'Müller', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Lüftestr. 42', 'Reutlingen', 72762, 1, '2021-07-01 13:48:17.000000', 1, NULL),
(8, 'mg@gmail.com', 'Matt', 'Gutt', '263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62', 'Lüftestr. 41', 'Reutlingen', 72762, 1, '2021-06-13 18:48:54.000000', 1, NULL),
(30, 'nguyenyen281099@gmail.com', 'Thi', 'Nguyen', '263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62', 'Wilhelmstr. 122', 'Reutlingen', 72764, 1, '2021-07-02 13:48:41.000000', 7, '18833b7b983e44ec8f6563c33155bfe5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logindata`
--
ALTER TABLE `logindata`
  ADD KEY `logindata_user` (`iduser`);

--
-- Indexes for table `wscart`
--
ALTER TABLE `wscart`
  ADD PRIMARY KEY (`idcart`);

--
-- Indexes for table `wscartitem`
--
ALTER TABLE `wscartitem`
  ADD PRIMARY KEY (`idcartitem`),
  ADD KEY `cardid` (`cartid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `wscategory`
--
ALTER TABLE `wscategory`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `wsorder`
--
ALTER TABLE `wsorder`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idcart` (`idcart`);

--
-- Indexes for table `wsproduct`
--
ALTER TABLE `wsproduct`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `wsuser`
--
ALTER TABLE `wsuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wscart`
--
ALTER TABLE `wscart`
  MODIFY `idcart` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `wscartitem`
--
ALTER TABLE `wscartitem`
  MODIFY `idcartitem` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `wscategory`
--
ALTER TABLE `wscategory`
  MODIFY `categoryid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wsorder`
--
ALTER TABLE `wsorder`
  MODIFY `idorder` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `wsproduct`
--
ALTER TABLE `wsproduct`
  MODIFY `productid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wsuser`
--
ALTER TABLE `wsuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logindata`
--
ALTER TABLE `logindata`
  ADD CONSTRAINT `logindata_user` FOREIGN KEY (`iduser`) REFERENCES `wsuser` (`id`);

--
-- Constraints for table `wscartitem`
--
ALTER TABLE `wscartitem`
  ADD CONSTRAINT `cartitem_cart` FOREIGN KEY (`cartid`) REFERENCES `wscart` (`idcart`),
  ADD CONSTRAINT `cartitem_product` FOREIGN KEY (`productid`) REFERENCES `wsproduct` (`productid`);

--
-- Constraints for table `wsorder`
--
ALTER TABLE `wsorder`
  ADD CONSTRAINT `order_cart` FOREIGN KEY (`idcart`) REFERENCES `wscart` (`idcart`),
  ADD CONSTRAINT `order_user` FOREIGN KEY (`iduser`) REFERENCES `wsuser` (`id`);

--
-- Constraints for table `wsproduct`
--
ALTER TABLE `wsproduct`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`categoryid`) REFERENCES `wscategory` (`categoryid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
