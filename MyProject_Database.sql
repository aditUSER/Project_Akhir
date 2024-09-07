-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2024 at 07:50 PM
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
-- Database: `tsa_web`
--
CREATE DATABASE IF NOT EXISTS `tsa_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tsa_web`;

-- --------------------------------------------------------

--
-- Table structure for table `booking_data`
--

CREATE TABLE `booking_data` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `client_address` text DEFAULT NULL,
  `client_region` varchar(100) DEFAULT NULL,
  `client_city` varchar(100) DEFAULT NULL,
  `client_phone` varchar(50) DEFAULT NULL,
  `client_postal_code` varchar(20) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `number_of_order` int(11) DEFAULT NULL,
  `special_request` text DEFAULT NULL,
  `identity_card` varchar(255) DEFAULT NULL,
  `driver_license` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `relation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country_codes`
--

CREATE TABLE `country_codes` (
  `id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country_codes`
--

INSERT INTO `country_codes` (`id`, `country_name`, `country_code`) VALUES
(1, 'Afghanistan', '+93'),
(2, 'Albania', '+355'),
(3, 'Algeria', '+213'),
(4, 'Andorra', '+376'),
(5, 'Angola', '+244'),
(6, 'Argentina', '+54'),
(7, 'Armenia', '+374'),
(8, 'Australia', '+61'),
(9, 'Austria', '+43'),
(10, 'Azerbaijan', '+994'),
(11, 'Bahamas', '+1-242'),
(12, 'Bahrain', '+973'),
(13, 'Bangladesh', '+880'),
(14, 'Barbados', '+1-246'),
(15, 'Belarus', '+375'),
(16, 'Belgium', '+32'),
(17, 'Belize', '+501'),
(18, 'Benin', '+229'),
(19, 'Bhutan', '+975'),
(20, 'Bolivia', '+591'),
(21, 'Bosnia and Herzegovina', '+387'),
(22, 'Botswana', '+267'),
(23, 'Brazil', '+55'),
(24, 'Brunei', '+673'),
(25, 'Bulgaria', '+359'),
(26, 'Burkina Faso', '+226'),
(27, 'Burundi', '+257'),
(28, 'Cambodia', '+855'),
(29, 'Cameroon', '+237'),
(30, 'Canada', '+1'),
(31, 'Cape Verde', '+238'),
(32, 'Central African Republic', '+236'),
(33, 'Chad', '+235'),
(34, 'Chile', '+56'),
(35, 'China', '+86'),
(36, 'Colombia', '+57'),
(37, 'Comoros', '+269'),
(38, 'Congo (Brazzaville)', '+242'),
(39, 'Congo (Kinshasa)', '+243'),
(40, 'Costa Rica', '+506'),
(41, 'Croatia', '+385'),
(42, 'Cuba', '+53'),
(43, 'Cyprus', '+357'),
(44, 'Czech Republic', '+420'),
(45, 'Denmark', '+45'),
(46, 'Djibouti', '+253'),
(47, 'Dominica', '+1-767'),
(48, 'Dominican Republic', '+1-809'),
(49, 'Dominican Republic', '+1-829'),
(50, 'Dominican Republic', '+1-849'),
(51, 'East Timor', '+670'),
(52, 'Ecuador', '+593'),
(53, 'Egypt', '+20'),
(54, 'El Salvador', '+503'),
(55, 'Equatorial Guinea', '+240'),
(56, 'Eritrea', '+291'),
(57, 'Estonia', '+372'),
(58, 'Eswatini', '+268'),
(59, 'Ethiopia', '+251'),
(60, 'Faroe Island', '+298'),
(61, 'Falkland Island', '+500'),
(62, 'Fiji', '+679'),
(63, 'Finland', '+358'),
(64, 'France', '+33'),
(65, 'Gabon', '+241'),
(66, 'Gambia', '+220'),
(67, 'Georgia', '+995'),
(68, 'Germany', '+49'),
(69, 'Greenland', '+299'),
(70, 'Ghana', '+233'),
(71, 'Gibraltar', '+350'),
(72, 'Greece', '+30'),
(73, 'Grenada', '+1-473'),
(74, 'Guatemala', '+502'),
(75, 'Guinea', '+224'),
(76, 'Guernsey', '+44'),
(77, 'Guinea-Bissau', '+245'),
(78, 'Guyana', '+592'),
(79, 'Haiti', '+509'),
(80, 'Honduras', '+504'),
(81, 'Hungary', '+36'),
(82, 'Iceland', '+354'),
(83, 'India', '+91'),
(84, 'Indonesia', '+62'),
(85, 'Iran', '+98'),
(86, 'Iraq', '+964'),
(87, 'Ireland', '+353'),
(88, 'Israel', '+972'),
(89, 'Isle of Man', '+44'),
(90, 'Italy', '+39'),
(91, 'Ivory Coast', '+225'),
(92, 'Jamaica', '+1-876'),
(93, 'Japan', '+81'),
(94, 'Jersey', '+44'),
(95, 'Jordan', '+962'),
(96, 'Kazakhstan', '+7'),
(97, 'Kenya', '+254'),
(98, 'Kiribati', '+686'),
(99, 'Korea, North', '+850'),
(100, 'Korea, South', '+82'),
(101, 'Kosovo', '+383'),
(102, 'Kuwait', '+965'),
(103, 'Kyrgyzstan', '+996'),
(104, 'Laos', '+856'),
(105, 'Latvia', '+371'),
(106, 'Lebanon', '+961'),
(107, 'Lesotho', '+266'),
(108, 'Liberia', '+231'),
(109, 'Libya', '+218'),
(110, 'Liechtenstein', '+423'),
(111, 'Lithuania', '+370'),
(112, 'Luxembourg', '+352'),
(113, 'Madagascar', '+261'),
(114, 'Malawi', '+265'),
(115, 'Malaysia', '+60'),
(116, 'Maldives', '+960'),
(117, 'Mali', '+223'),
(118, 'Malta', '+356'),
(119, 'Marshall Islands', '+692'),
(120, 'Mauritania', '+222'),
(121, 'Mauritius', '+230'),
(122, 'Mexico', '+52'),
(123, 'Micronesia', '+691'),
(124, 'Moldova', '+373'),
(125, 'Monaco', '+377'),
(126, 'Mongolia', '+976'),
(127, 'Montserrat', '+1-664'),
(128, 'Montenegro', '+382'),
(129, 'Morocco', '+212'),
(130, 'Mozambique', '+258'),
(131, 'Myanmar', '+95'),
(132, 'Namibia', '+264'),
(133, 'Nauru', '+674'),
(134, 'Nepal', '+977'),
(135, 'Netherlands', '+31'),
(136, 'New Zealand', '+64'),
(137, 'Nicaragua', '+505'),
(138, 'Niger', '+227'),
(139, 'Nigeria', '+234'),
(140, 'North Macedonia', '+389'),
(141, 'Norway', '+47'),
(142, 'Oman', '+968'),
(143, 'Pakistan', '+92'),
(144, 'Pakistan', '+970'),
(145, 'Palau', '+680'),
(146, 'Panama', '+507'),
(147, 'Papua New Guinea', '+675'),
(148, 'Paraguay', '+595'),
(149, 'Peru', '+51'),
(150, 'Philippines', '+63'),
(151, 'Poland', '+48'),
(152, 'Portugal', '+351'),
(153, 'Qatar', '+974'),
(154, 'Romania', '+40'),
(155, 'Russia', '+7'),
(156, 'Rwanda', '+250'),
(157, 'Saint Kitts and Nevis', '+1-869'),
(158, 'Saint Lucia', '+1-758'),
(159, 'Saint Vincent and the Grenadines', '+1-784'),
(160, 'Samoa', '+685'),
(161, 'San Marino', '+378'),
(162, 'Sao Tome and Principe', '+239'),
(163, 'Saudi Arabia', '+966'),
(164, 'Senegal', '+221'),
(165, 'Serbia', '+381'),
(166, 'Seychelles', '+248'),
(167, 'Sierra Leone', '+232'),
(168, 'Singapore', '+65'),
(169, 'Slovakia', '+421'),
(170, 'Slovenia', '+386'),
(171, 'Solomon Islands', '+677'),
(172, 'Somalia', '+252'),
(173, 'South Africa', '+27'),
(174, 'South Sudan', '+211'),
(175, 'Spain', '+34'),
(176, 'Sri Lanka', '+94'),
(177, 'Sudan', '+249'),
(178, 'Suriname', '+597'),
(179, 'Sweden', '+46'),
(180, 'Switzerland', '+41'),
(181, 'Syria', '+963'),
(182, 'Taiwan', '+886'),
(183, 'Tajikistan', '+992'),
(184, 'Tanzania', '+255'),
(185, 'Thailand', '+66'),
(186, 'Togo', '+228'),
(187, 'Tonga', '+676'),
(188, 'Trinidad and Tobago', '+1-868'),
(189, 'Tunisia', '+216'),
(190, 'Turkey', '+90'),
(191, 'Turkmenistan', '+993'),
(192, 'Tuvalu', '+688'),
(193, 'Uganda', '+256'),
(194, 'Ukraine', '+380'),
(195, 'United Arab Emirates', '+971'),
(196, 'United Kingdom', '+44'),
(197, 'United States', '+1'),
(198, 'Uruguay', '+598'),
(199, 'Uzbekistan', '+998'),
(200, 'Vanuatu', '+678'),
(201, 'Vatican City', '+379'),
(202, 'Venezuela', '+58'),
(203, 'Vietnam', '+84'),
(204, 'Western Sahara', '+212'),
(205, 'Yemen', '+967'),
(206, 'Zambia', '+260'),
(207, 'Zimbabwe', '+263');

-- --------------------------------------------------------

--
-- Table structure for table `motor_brands`
--

CREATE TABLE `motor_brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motor_brands`
--

INSERT INTO `motor_brands` (`id`, `brand_name`) VALUES
(1, 'Aprilia'),
(2, 'Ariel'),
(3, 'AJS'),
(4, 'Avinton'),
(5, 'Bajaj'),
(6, 'BMW'),
(7, 'Benelli'),
(8, 'Buell'),
(9, 'BSA'),
(10, 'Cagiva'),
(11, 'Can-Am'),
(12, 'Cafe Racer'),
(13, 'CFMoto'),
(14, 'Ceres'),
(15, 'Ducati'),
(16, 'Derbi'),
(17, 'Dongfang'),
(18, 'EBR'),
(19, 'Enfield'),
(20, 'Fantic'),
(21, 'Force'),
(22, 'Guzzi'),
(23, 'Gilera'),
(24, 'Greeves'),
(25, 'Gas Gas'),
(26, 'Honda'),
(27, 'Husqvarna'),
(28, 'Hyosung'),
(29, 'Indian'),
(30, 'Italmoto'),
(31, 'Italjet'),
(32, 'Jawa'),
(33, 'Jianshe'),
(34, 'Kawasaki'),
(35, 'KTM'),
(36, 'Kymco'),
(37, 'Laverda'),
(38, 'Lambretta'),
(39, 'Lifan'),
(40, 'Moto Guzzi'),
(41, 'Montesa'),
(42, 'MV Agusta'),
(43, 'Minarelli'),
(44, 'Mahindra'),
(45, 'Norton'),
(46, 'Nishiki'),
(47, 'Otokar'),
(48, 'Oset'),
(49, 'Piaggio'),
(50, 'Peugeot'),
(51, 'PGO'),
(52, 'Qianjiang'),
(53, 'Royal Enfield'),
(54, 'Rieju'),
(55, 'Raptor'),
(56, 'Suzuki'),
(57, 'Sym'),
(58, 'Sherco'),
(59, 'Sachs'),
(60, 'Triumph'),
(61, 'TGB'),
(62, 'Taro'),
(63, 'Ural'),
(64, 'UM Motorcycles'),
(65, 'Vespa'),
(66, 'Victory'),
(67, 'Wuyang'),
(68, 'Yamaha'),
(69, 'Yangtze'),
(70, 'Zero Motorcycles'),
(71, 'Zongshen');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `user_id`, `product_name`, `price`) VALUES
(4, NULL, 'Sepeda Gunung', 1500000.00),
(5, NULL, 'Sepeda Lipat', 2500000.00),
(6, NULL, 'Sepeda Balap', 3500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_code` varchar(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `verification_token`, `role`, `is_verified`, `verification_code`, `created_at`, `verified`) VALUES
(23, 'Admin', 'aditmaajid2@gmail.com', '081233053291', '$2y$10$aR9Ut54lVEWqGDV2rsvczeLQwS2r43wPZgCjJp9wYqvlxvC1OCQIa', NULL, 'user', 0, NULL, '2024-09-07 17:08:59', 1),
(24, 'asemwi', '', '', '$2y$10$W8BMpb3HH4qAkBihsymbme.m5jNQicFH2Kett8rdWt5kQgyERpa6G', NULL, 'admin', 0, NULL, '2024-09-07 17:39:34', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_data`
--
ALTER TABLE `booking_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_codes`
--
ALTER TABLE `country_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motor_brands`
--
ALTER TABLE `motor_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_data`
--
ALTER TABLE `booking_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `country_codes`
--
ALTER TABLE `country_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `motor_brands`
--
ALTER TABLE `motor_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
