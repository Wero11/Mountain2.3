-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2015 at 10:22 PM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mountd_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `accent`
--

CREATE TABLE IF NOT EXISTS `accent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `acting`
--

CREATE TABLE IF NOT EXISTS `acting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `agencies` bit(1) DEFAULT NULL,
  `shortflims` bit(1) DEFAULT NULL,
  `tvshows` bit(1) DEFAULT NULL,
  `musicvideos` bit(1) DEFAULT NULL,
  `radio` bit(1) DEFAULT NULL,
  `feauturesfilms` bit(1) DEFAULT NULL,
  `entertainers` bit(1) DEFAULT NULL,
  `theatre` bit(1) DEFAULT NULL,
  `representation` bit(1) DEFAULT NULL,
  `experince` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `ref_id_idx` (`experince`),
  KEY `ref_idx` (`experince`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `name`, `is_active`) VALUES
(1, 'US', 'United States', b'1'),
(2, 'CA', 'Canada', b'1'),
(3, 'AF', 'Afghanistan', b'1'),
(4, 'AL', 'Albania', b'1'),
(5, 'DZ', 'Algeria', b'1'),
(6, 'DS', 'American Samoa', b'1'),
(7, 'AD', 'Andorra', b'1'),
(8, 'AO', 'Angola', b'1'),
(9, 'AI', 'Anguilla', b'1'),
(10, 'AQ', 'Antarctica', b'1'),
(11, 'AG', 'Antigua and/or Barbuda', b'1'),
(12, 'AR', 'Argentina', b'1'),
(13, 'AM', 'Armenia', b'1'),
(14, 'AW', 'Aruba', b'1'),
(15, 'AU', 'Australia', b'1'),
(16, 'AT', 'Austria', b'1'),
(17, 'AZ', 'Azerbaijan', b'1'),
(18, 'BS', 'Bahamas', b'1'),
(19, 'BH', 'Bahrain', b'1'),
(20, 'BD', 'Bangladesh', b'1'),
(21, 'BB', 'Barbados', b'1'),
(22, 'BY', 'Belarus', b'1'),
(23, 'BE', 'Belgium', b'1'),
(24, 'BZ', 'Belize', b'1'),
(25, 'BJ', 'Benin', b'1'),
(26, 'BM', 'Bermuda', b'1'),
(27, 'BT', 'Bhutan', b'1'),
(28, 'BO', 'Bolivia', b'1'),
(29, 'BA', 'Bosnia and Herzegovina', b'1'),
(30, 'BW', 'Botswana', b'1'),
(31, 'BV', 'Bouvet Island', b'1'),
(32, 'BR', 'Brazil', b'1'),
(33, 'IO', 'British Indian Ocean Territory', b'1'),
(34, 'BN', 'Brunei Darussalam', b'1'),
(35, 'BG', 'Bulgaria', b'1'),
(36, 'BF', 'Burkina Faso', b'1'),
(37, 'BI', 'Burundi', b'1'),
(38, 'KH', 'Cambodia', b'1'),
(39, 'CM', 'Cameroon', b'1'),
(40, 'CV', 'Cape Verde', b'1'),
(41, 'KY', 'Cayman Islands', b'1'),
(42, 'CF', 'Central African Republic', b'1'),
(43, 'TD', 'Chad', b'1'),
(44, 'CL', 'Chile', b'1'),
(45, 'CN', 'China', b'1'),
(46, 'CX', 'Christmas Island', b'1'),
(47, 'CC', 'Cocos (Keeling) Islands', b'1'),
(48, 'CO', 'Colombia', b'1'),
(49, 'KM', 'Comoros', b'1'),
(50, 'CG', 'Congo', b'1'),
(51, 'CK', 'Cook Islands', b'1'),
(52, 'CR', 'Costa Rica', b'1'),
(53, 'HR', 'Croatia (Hrvatska)', b'1'),
(54, 'CU', 'Cuba', b'1'),
(55, 'CY', 'Cyprus', b'1'),
(56, 'CZ', 'Czech Republic', b'1'),
(57, 'DK', 'Denmark', b'1'),
(58, 'DJ', 'Djibouti', b'1'),
(59, 'DM', 'Dominica', b'1'),
(60, 'DO', 'Dominican Republic', b'1'),
(61, 'TP', 'East Timor', b'1'),
(62, 'EC', 'Ecuador', b'1'),
(63, 'EG', 'Egypt', b'1'),
(64, 'SV', 'El Salvador', b'1'),
(65, 'GQ', 'Equatorial Guinea', b'1'),
(66, 'ER', 'Eritrea', b'1'),
(67, 'EE', 'Estonia', b'1'),
(68, 'ET', 'Ethiopia', b'1'),
(69, 'FK', 'Falkland Islands (Malvinas)', b'1'),
(70, 'FO', 'Faroe Islands', b'1'),
(71, 'FJ', 'Fiji', b'1'),
(72, 'FI', 'Finland', b'1'),
(73, 'FR', 'France', b'1'),
(74, 'FX', 'France, Metropolitan', b'1'),
(75, 'GF', 'French Guiana', b'1'),
(76, 'PF', 'French Polynesia', b'1'),
(77, 'TF', 'French Southern Territories', b'1'),
(78, 'GA', 'Gabon', b'1'),
(79, 'GM', 'Gambia', b'1'),
(80, 'GE', 'Georgia', b'1'),
(81, 'DE', 'Germany', b'1'),
(82, 'GH', 'Ghana', b'1'),
(83, 'GI', 'Gibraltar', b'1'),
(84, 'GR', 'Greece', b'1'),
(85, 'GL', 'Greenland', b'1'),
(86, 'GD', 'Grenada', b'1'),
(87, 'GP', 'Guadeloupe', b'1'),
(88, 'GU', 'Guam', b'1'),
(89, 'GT', 'Guatemala', b'1'),
(90, 'GN', 'Guinea', b'1'),
(91, 'GW', 'Guinea-Bissau', b'1'),
(92, 'GY', 'Guyana', b'1'),
(93, 'HT', 'Haiti', b'1'),
(94, 'HM', 'Heard and Mc Donald Islands', b'1'),
(95, 'HN', 'Honduras', b'1'),
(96, 'HK', 'Hong Kong', b'1'),
(97, 'HU', 'Hungary', b'1'),
(98, 'IS', 'Iceland', b'1'),
(99, 'IN', 'India', b'1'),
(100, 'ID', 'Indonesia', b'1'),
(101, 'IR', 'Iran (Islamic Republic of)', b'1'),
(102, 'IQ', 'Iraq', b'1'),
(103, 'IE', 'Ireland', b'1'),
(104, 'IL', 'Israel', b'1'),
(105, 'IT', 'Italy', b'1'),
(106, 'CI', 'Ivory Coast', b'1'),
(107, 'JM', 'Jamaica', b'1'),
(108, 'JP', 'Japan', b'1'),
(109, 'JO', 'Jordan', b'1'),
(110, 'KZ', 'Kazakhstan', b'1'),
(111, 'KE', 'Kenya', b'1'),
(112, 'KI', 'Kiribati', b'1'),
(113, 'KP', 'Korea, Democratic People''s Republic of', b'1'),
(114, 'KR', 'Korea, Republic of', b'1'),
(115, 'XK', 'Kosovo', b'1'),
(116, 'KW', 'Kuwait', b'1'),
(117, 'KG', 'Kyrgyzstan', b'1'),
(118, 'LA', 'Lao People''s Democratic Republic', b'1'),
(119, 'LV', 'Latvia', b'1'),
(120, 'LB', 'Lebanon', b'1'),
(121, 'LS', 'Lesotho', b'1'),
(122, 'LR', 'Liberia', b'1'),
(123, 'LY', 'Libyan Arab Jamahiriya', b'1'),
(124, 'LI', 'Liechtenstein', b'1'),
(125, 'LT', 'Lithuania', b'1'),
(126, 'LU', 'Luxembourg', b'1'),
(127, 'MO', 'Macau', b'1'),
(128, 'MK', 'Macedonia', b'1'),
(129, 'MG', 'Madagascar', b'1'),
(130, 'MW', 'Malawi', b'1'),
(131, 'MY', 'Malaysia', b'1'),
(132, 'MV', 'Maldives', b'1'),
(133, 'ML', 'Mali', b'1'),
(134, 'MT', 'Malta', b'1'),
(135, 'MH', 'Marshall Islands', b'1'),
(136, 'MQ', 'Martinique', b'1'),
(137, 'MR', 'Mauritania', b'1'),
(138, 'MU', 'Mauritius', b'1'),
(139, 'TY', 'Mayotte', b'1'),
(140, 'MX', 'Mexico', b'1'),
(141, 'FM', 'Micronesia, Federated States of', b'1'),
(142, 'MD', 'Moldova, Republic of', b'1'),
(143, 'MC', 'Monaco', b'1'),
(144, 'MN', 'Mongolia', b'1'),
(145, 'ME', 'Montenegro', b'1'),
(146, 'MS', 'Montserrat', b'1'),
(147, 'MA', 'Morocco', b'1'),
(148, 'MZ', 'Mozambique', b'1'),
(149, 'MM', 'Myanmar', b'1'),
(150, 'NA', 'Namibia', b'1'),
(151, 'NR', 'Nauru', b'1'),
(152, 'NP', 'Nepal', b'1'),
(153, 'NL', 'Netherlands', b'1'),
(154, 'AN', 'Netherlands Antilles', b'1'),
(155, 'NC', 'New Caledonia', b'1'),
(156, 'NZ', 'New Zealand', b'1'),
(157, 'NI', 'Nicaragua', b'1'),
(158, 'NE', 'Niger', b'1'),
(159, 'NG', 'Nigeria', b'1'),
(160, 'NU', 'Niue', b'1'),
(161, 'NF', 'Norfolk Island', b'1'),
(162, 'MP', 'Northern Mariana Islands', b'1'),
(163, 'NO', 'Norway', b'1'),
(164, 'OM', 'Oman', b'1'),
(165, 'PK', 'Pakistan', b'1'),
(166, 'PW', 'Palau', b'1'),
(167, 'PA', 'Panama', b'1'),
(168, 'PG', 'Papua New Guinea', b'1'),
(169, 'PY', 'Paraguay', b'1'),
(170, 'PE', 'Peru', b'1'),
(171, 'PH', 'Philippines', b'1'),
(172, 'PN', 'Pitcairn', b'1'),
(173, 'PL', 'Poland', b'1'),
(174, 'PT', 'Portugal', b'1'),
(175, 'PR', 'Puerto Rico', b'1'),
(176, 'QA', 'Qatar', b'1'),
(177, 'RE', 'Reunion', b'1'),
(178, 'RO', 'Romania', b'1'),
(179, 'RU', 'Russian Federation', b'1'),
(180, 'RW', 'Rwanda', b'1'),
(181, 'KN', 'Saint Kitts and Nevis', b'1'),
(182, 'LC', 'Saint Lucia', b'1'),
(183, 'VC', 'Saint Vincent and the Grenadines', b'1'),
(184, 'WS', 'Samoa', b'1'),
(185, 'SM', 'San Marino', b'1'),
(186, 'ST', 'Sao Tome and Principe', b'1'),
(187, 'SA', 'Saudi Arabia', b'1'),
(188, 'SN', 'Senegal', b'1'),
(189, 'RS', 'Serbia', b'1'),
(190, 'SC', 'Seychelles', b'1'),
(191, 'SL', 'Sierra Leone', b'1'),
(192, 'SG', 'Singapore', b'1'),
(193, 'SK', 'Slovakia', b'1'),
(194, 'SI', 'Slovenia', b'1'),
(195, 'SB', 'Solomon Islands', b'1'),
(196, 'SO', 'Somalia', b'1'),
(197, 'ZA', 'South Africa', b'1'),
(198, 'GS', 'South Georgia South Sandwich Islands', b'1'),
(199, 'ES', 'Spain', b'1'),
(200, 'LK', 'Sri Lanka', b'1'),
(201, 'SH', 'St. Helena', b'1'),
(202, 'PM', 'St. Pierre and Miquelon', b'1'),
(203, 'SD', 'Sudan', b'1'),
(204, 'SR', 'Suriname', b'1'),
(205, 'SJ', 'Svalbard and Jan Mayen Islands', b'1'),
(206, 'SZ', 'Swaziland', b'1'),
(207, 'SE', 'Sweden', b'1'),
(208, 'CH', 'Switzerland', b'1'),
(209, 'SY', 'Syrian Arab Republic', b'1'),
(210, 'TW', 'Taiwan', b'1'),
(211, 'TJ', 'Tajikistan', b'1'),
(212, 'TZ', 'Tanzania, United Republic of', b'1'),
(213, 'TH', 'Thailand', b'1'),
(214, 'TG', 'Togo', b'1'),
(215, 'TK', 'Tokelau', b'1'),
(216, 'TO', 'Tonga', b'1'),
(217, 'TT', 'Trinidad and Tobago', b'1'),
(218, 'TN', 'Tunisia', b'1'),
(219, 'TR', 'Turkey', b'1'),
(220, 'TM', 'Turkmenistan', b'1'),
(221, 'TC', 'Turks and Caicos Islands', b'1'),
(222, 'TV', 'Tuvalu', b'1'),
(223, 'UG', 'Uganda', b'1'),
(224, 'UA', 'Ukraine', b'1'),
(225, 'AE', 'United Arab Emirates', b'1'),
(226, 'GB', 'United Kingdom', b'1'),
(227, 'UM', 'United States minor outlying islands', b'1'),
(228, 'UY', 'Uruguay', b'1'),
(229, 'UZ', 'Uzbekistan', b'1'),
(230, 'VU', 'Vanuatu', b'1'),
(231, 'VA', 'Vatican City State', b'1'),
(232, 'VE', 'Venezuela', b'1'),
(233, 'VN', 'Vietnam', b'1'),
(234, 'VG', 'Virgin Islands (British)', b'1'),
(235, 'VI', 'Virgin Islands (U.S.)', b'1'),
(236, 'WF', 'Wallis and Futuna Islands', b'1'),
(237, 'EH', 'Western Sahara', b'1'),
(238, 'YE', 'Yemen', b'1'),
(239, 'YU', 'Yugoslavia', b'1'),
(240, 'ZR', 'Zaire', b'1'),
(241, 'ZM', 'Zambia', b'1'),
(242, 'ZW', 'Zimbabwe', b'1'),
(243, 'PS', 'Palestine', b'1'),
(244, 'IM', 'Isle of Man', b'1'),
(245, 'JE', 'Jersey', b'1'),
(246, 'GK', 'Guernsey', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mountain_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `video_name` varchar(45) DEFAULT NULL,
  `is_reposted` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`),
  KEY `mountain1_idx` (`mountain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`id`, `mountain_id`, `user_id`, `description`, `video_name`, `is_reposted`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 1, 'Octoner Mountain Test', '14356789.mp4', '', 1, 1, NULL, NULL, b'1'),
(2, 1, 2, 'Octoner Mountain Test1', '14356789.mp4', '', 1, 1, NULL, NULL, b'1'),
(3, 1, 3, 'Mountain Test1', '14356789.mp4', '', 1, 1, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `feeds_abused`
--

CREATE TABLE IF NOT EXISTS `feeds_abused` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `reported_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `feed2_idx` (`feed_id`),
  KEY `user11_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feeds_abused`
--

INSERT INTO `feeds_abused` (`id`, `feed_id`, `user_id`, `description`, `reported_dttm`, `is_active`) VALUES
(1, 1, 1, NULL, '2015-10-22 05:12:58', b'0'),
(2, NULL, 1, NULL, '2015-10-22 05:16:19', b'1'),
(3, NULL, 1, NULL, '2015-10-22 05:17:25', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `feeds_like`
--

CREATE TABLE IF NOT EXISTS `feeds_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `like_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `feed2_idx` (`feed_id`),
  KEY `user11_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `feeds_like`
--

INSERT INTO `feeds_like` (`id`, `feed_id`, `user_id`, `like_dttm`, `is_active`) VALUES
(1, 1, 2, '2015-10-19 00:00:00', b'1'),
(2, 1, 3, '2015-10-19 00:00:00', b'1'),
(3, 2, 3, '2015-10-19 00:00:00', b'1'),
(4, 2, 1, '2015-10-19 00:00:00', b'1'),
(5, 2, 4, '2015-10-19 00:00:00', b'1'),
(9, 1, 1, '2015-10-20 09:50:45', b'0'),
(10, 1, 1, '2015-10-22 04:58:04', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `feeds_viewed`
--

CREATE TABLE IF NOT EXISTS `feeds_viewed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `viewed_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `feed2_idx` (`feed_id`),
  KEY `user11_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feeds_viewed`
--

INSERT INTO `feeds_viewed` (`id`, `feed_id`, `user_id`, `viewed_dttm`, `is_active`) VALUES
(1, 1, 2, '2015-10-19 00:00:00', b'1'),
(2, 1, 3, '2015-10-19 00:00:00', b'1'),
(3, 1, 1, '2015-10-22 05:06:15', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `feed_trending_tag`
--

CREATE TABLE IF NOT EXISTS `feed_trending_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hash_tag_id` int(11) DEFAULT NULL,
  `trending_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `feed32_idx` (`feed_id`),
  KEY `user41_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `feed_trending_tag`
--

INSERT INTO `feed_trending_tag` (`id`, `feed_id`, `user_id`, `hash_tag_id`, `trending_dttm`, `is_active`) VALUES
(1, 1, 1, 1, NULL, b'1'),
(2, 2, 2, 2, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `hash_tag_master`
--

CREATE TABLE IF NOT EXISTS `hash_tag_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `hash_tag` varchar(255) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `feed5_idx` (`feed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hash_tag_master`
--

INSERT INTO `hash_tag_master` (`id`, `feed_id`, `hash_tag`, `created_dttm`, `is_active`) VALUES
(1, 1, '#mountain', NULL, b'1'),
(2, 2, '#october', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE IF NOT EXISTS `judge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `profession` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modeling`
--

CREATE TABLE IF NOT EXISTS `modeling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `agenicies` bit(1) DEFAULT NULL,
  `pageants` bit(1) DEFAULT NULL,
  `fitting` bit(1) DEFAULT NULL,
  `music_video` bit(1) DEFAULT NULL,
  `print` bit(1) DEFAULT NULL,
  `tvcommercial` bit(1) DEFAULT NULL,
  `catwalk` bit(1) DEFAULT NULL,
  `event_promotion` bit(1) DEFAULT NULL,
  `hair_model` bit(1) DEFAULT NULL,
  `presenters` bit(1) DEFAULT NULL,
  `time_prints` bit(1) DEFAULT NULL,
  `others` varchar(45) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `user_idx` (`user_id`),
  KEY `exp1_idx` (`experience`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mountain`
--

CREATE TABLE IF NOT EXISTS `mountain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `is_main` bit(1) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `update_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mountain`
--

INSERT INTO `mountain` (`id`, `name`, `week`, `is_main`, `start_date`, `duration`, `created_by`, `updated_by`, `created_dttm`, `update_dttm`, `is_active`) VALUES
(1, 'October', 1, b'1', '2015-10-18 00:00:00', 5, 1, 1, '2015-10-19 00:00:00', NULL, b'1'),
(2, 'October', 2, b'1', '2015-10-20 00:00:00', 5, 1, 1, '2015-10-19 00:00:00', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `reference_domain`
--

CREATE TABLE IF NOT EXISTS `reference_domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `reference_domain`
--

INSERT INTO `reference_domain` (`id`, `code`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 'Height', NULL, NULL, NULL, NULL, b'1'),
(2, 'Weight', NULL, NULL, NULL, NULL, b'1'),
(3, 'Ethinicity', NULL, NULL, NULL, NULL, b'1'),
(4, 'SkinColor', NULL, NULL, NULL, NULL, b'1'),
(5, 'EyeColor', NULL, NULL, NULL, NULL, b'1'),
(6, 'Chest', NULL, NULL, NULL, NULL, b'1'),
(7, 'Waist', NULL, NULL, NULL, NULL, b'1'),
(8, 'Hips', NULL, NULL, NULL, NULL, b'1'),
(9, 'ShoeSize', NULL, NULL, NULL, NULL, b'1'),
(10, 'HairLength', NULL, NULL, NULL, NULL, b'1'),
(11, 'HairColor', NULL, NULL, NULL, NULL, b'1'),
(12, 'DressSizeLow', NULL, NULL, NULL, NULL, b'1'),
(13, 'DressSizeHigh', NULL, NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `reference_value`
--

CREATE TABLE IF NOT EXISTS `reference_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_id` int(11) DEFAULT NULL,
  `value` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `ref_id_idx` (`reference_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `reference_value`
--

INSERT INTO `reference_value` (`id`, `reference_id`, `value`, `code`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(3, 1, '166', '166', NULL, NULL, NULL, NULL, b'1'),
(4, 1, '174', '174', NULL, NULL, NULL, NULL, b'1'),
(5, 2, '54', '54', NULL, NULL, NULL, NULL, b'1'),
(6, 2, '50', '50', NULL, NULL, NULL, NULL, b'1'),
(7, 3, 'Tamils', 'Tamils', NULL, NULL, NULL, NULL, b'1'),
(8, 3, 'Behari', 'Behari', NULL, NULL, NULL, NULL, b'1'),
(9, 3, 'Kashmiris', 'Kashmiris', NULL, NULL, NULL, NULL, b'1'),
(10, 3, 'Punjabis', 'Punjabis', NULL, NULL, NULL, NULL, b'1'),
(11, 4, 'Dark skin', 'Dark skin', NULL, NULL, NULL, NULL, b'1'),
(12, 4, 'Light Skin', 'Light Skin', NULL, NULL, NULL, NULL, b'1'),
(13, 5, 'Brown', 'Brown', NULL, NULL, NULL, NULL, b'1'),
(14, 5, 'Black ', 'Black ', NULL, NULL, NULL, NULL, b'1'),
(15, 6, '30-32', '30-32', NULL, NULL, NULL, NULL, b'1'),
(16, 6, '34-36', '34-36', NULL, NULL, NULL, NULL, b'1'),
(17, 7, '34', '34', NULL, NULL, NULL, NULL, b'1'),
(18, 7, '36', '36', NULL, NULL, NULL, NULL, b'1'),
(19, 8, '30-32', '30-32', NULL, NULL, NULL, NULL, b'1'),
(20, 8, '32-34', '32-34', NULL, NULL, NULL, NULL, b'1'),
(21, 9, '6', '6', NULL, NULL, NULL, NULL, b'1'),
(22, 9, '8', '8', NULL, NULL, NULL, NULL, b'1'),
(23, 11, 'Brown', 'Brown', NULL, NULL, NULL, NULL, b'1'),
(24, 11, 'Black ', 'Black ', NULL, NULL, NULL, NULL, b'1'),
(25, 10, 'Short ', 'Short ', NULL, NULL, NULL, NULL, b'1'),
(26, 10, 'Medium', 'Medium', NULL, NULL, NULL, NULL, b'1'),
(27, 12, '6-8', '6-8', NULL, NULL, NULL, NULL, b'1'),
(28, 12, '8-10', '8-10', NULL, NULL, NULL, NULL, b'1'),
(29, 13, '10-12', '10-12', NULL, NULL, NULL, NULL, b'1'),
(30, 13, '12-14', '12-14', NULL, NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `name`, `is_active`) VALUES
(1, 99, 'ANDHRA PRADESH', b'1'),
(2, 99, 'ASSAM', b'1'),
(3, 99, 'ARUNACHAL PRADESH', b'1'),
(4, 99, 'GUJRAT', b'1'),
(5, 99, 'BIHAR', b'1'),
(6, 99, 'HARYANA', b'1'),
(7, 99, 'HIMACHAL PRADESH', b'1'),
(8, 99, 'JAMMU & KASHMIR', b'1'),
(9, 99, 'KARNATAKA', b'1'),
(10, 99, 'KERALA', b'1'),
(11, 99, 'MADHYA PRADESH', b'1'),
(12, 99, 'MAHARASHTRA', b'1'),
(13, 99, 'MANIPUR', b'1'),
(14, 99, 'MEGHALAYA', b'1'),
(15, 99, 'MIZORAM', b'1'),
(16, 99, 'NAGALAND', b'1'),
(17, 99, 'ORISSA', b'1'),
(18, 99, 'PUNJAB', b'1'),
(19, 99, 'RAJASTHAN', b'1'),
(20, 99, 'SIKKIM', b'1'),
(21, 99, 'TAMIL NADU', b'1'),
(22, 99, 'TRIPURA', b'1'),
(23, 99, 'UTTAR PRADESH', b'1'),
(24, 99, 'WEST BENGAL', b'1'),
(25, 99, 'DELHI', b'1'),
(26, 99, 'GOA', b'1'),
(27, 99, 'PONDICHERY', b'1'),
(28, 99, 'LAKSHDWEEP', b'1'),
(29, 99, 'DAMAN & DIU', b'1'),
(30, 99, 'DADRA & NAGAR', b'1'),
(31, 99, 'CHANDIGARH', b'1'),
(32, 99, 'ANDAMAN & NICOBAR', b'1'),
(33, 99, 'UTTARANCHAL', b'1'),
(34, 99, 'JHARKHAND', b'1'),
(35, 99, 'CHATTISGARH', b'1'),
(36, 1, 'Alaska', b'1'),
(37, 1, 'Alabama', b'1'),
(38, 1, 'American Samoa', b'1'),
(39, 1, 'Arizona', b'1'),
(40, 1, 'Arkansas', b'1'),
(41, 1, 'California', b'1'),
(42, 1, 'Colorado', b'1'),
(43, 1, 'Connecticut', b'1'),
(44, 1, 'Delaware', b'1'),
(45, 1, 'District of Columbia', b'1'),
(46, 1, 'Federated `state`(`county_id`,`state_name`,`state_code`) of ', b'1'),
(47, 1, 'Florida', b'1'),
(48, 1, 'Georgia', b'1'),
(49, 1, 'Guam', b'1'),
(50, 1, 'Hawaii', b'1'),
(51, 1, 'Idaho', b'1'),
(52, 1, 'Illinois', b'1'),
(53, 1, 'Indiana', b'1'),
(54, 1, 'Iowa', b'1'),
(55, 1, 'Kansas', b'1'),
(56, 1, 'Kentucky', b'1'),
(57, 1, 'Louisiana', b'1'),
(58, 1, 'Maine', b'1'),
(59, 1, 'Marshall Islands', b'1'),
(60, 1, 'Maryland', b'1'),
(61, 1, 'Massachusetts', b'1'),
(62, 1, 'Michigan', b'1'),
(63, 1, 'Minnesota', b'1'),
(64, 1, 'Mississippi', b'1'),
(65, 1, 'Missouri', b'1'),
(66, 1, 'Montana', b'1'),
(67, 1, 'Nebraska', b'1'),
(68, 1, 'Nevada', b'1'),
(69, 1, 'New Hampshire', b'1'),
(70, 1, 'New Jersey', b'1'),
(71, 1, 'New Mexico', b'1'),
(72, 1, 'New York', b'1'),
(73, 1, 'North Carolina', b'1'),
(74, 1, 'North Dakota', b'1'),
(75, 1, 'Northern Mariana Islands', b'1'),
(76, 1, 'Ohio', b'1'),
(77, 1, 'Oklahoma', b'1'),
(78, 1, 'Oregon', b'1'),
(79, 1, 'Palau', b'1'),
(80, 1, 'Pennsylvania', b'1'),
(81, 1, 'Puerto Rico', b'1'),
(82, 1, 'Rhode Island', b'1'),
(83, 1, 'South Carolina', b'1'),
(84, 1, 'South Dakota', b'1'),
(85, 1, 'Tennessee', b'1'),
(86, 1, 'Texas', b'1'),
(87, 1, 'Utah', b'1'),
(88, 1, 'Vermont', b'1'),
(89, 1, 'Virgin Islands', b'1'),
(90, 1, 'Virginia', b'1'),
(91, 1, 'Washington', b'1'),
(92, 1, 'West Virginia', b'1'),
(93, 1, 'Wisconsin', b'1'),
(94, 1, 'Wyoming', b'1'),
(95, 1, 'Armed Forces Africa', b'1'),
(96, 1, 'Armed Forces Americas (except Canada)', b'1'),
(97, 1, 'Armed Forces Canada', b'1'),
(98, 1, 'Armed Forces Europe', b'1'),
(99, 1, 'Armed Forces Middle East', b'1'),
(100, 1, 'Armed Forces Pacific', b'1'),
(101, 2, 'Alberta', b'1'),
(102, 2, 'British Columbia', b'1'),
(103, 2, 'Manitoba', b'1'),
(104, 2, 'New Brunswick', b'1'),
(105, 2, 'Newfoundland and Labrador', b'1'),
(106, 2, 'Northwest Territories', b'1'),
(107, 2, 'Nova Scotia', b'1'),
(108, 2, 'Nunavut', b'1'),
(109, 2, 'Ontario', b'1'),
(110, 2, 'Prince Edward Island', b'1'),
(111, 2, 'Quebec', b'1'),
(112, 2, 'Saskatchewan', b'1'),
(113, 2, 'Yukon', b'1'),
(114, 3, 'Balkh', b'1'),
(115, 3, 'Herat', b'1'),
(116, 3, 'Kabol', b'1'),
(117, 3, 'Qandahar', b'1'),
(118, 4, 'Tirana', b'1'),
(119, 5, 'Alger', b'1'),
(120, 5, 'Annaba', b'1'),
(121, 5, 'Batna', b'1'),
(122, 5, 'BÃ©char', b'1'),
(123, 5, 'BÃ©jaÃ¯a', b'1'),
(124, 5, 'Biskra', b'1'),
(125, 5, 'Blida', b'1'),
(126, 5, 'Chlef', b'1'),
(127, 5, 'Constantine', b'1'),
(128, 5, 'GhardaÃ¯a', b'1'),
(129, 5, 'Mostaganem', b'1'),
(130, 5, 'Oran', b'1'),
(131, 5, 'SÃ©tif', b'1'),
(132, 5, 'Sidi Bel AbbÃ¨s', b'1'),
(133, 5, 'Skikda', b'1'),
(134, 5, 'TÃ©bessa', b'1'),
(135, 5, 'Tiaret', b'1'),
(136, 5, 'Tlemcen', b'1'),
(137, 6, 'Tutuila', b'1'),
(138, 7, 'Andorra la Vella', b'1'),
(139, 8, 'Benguela', b'1'),
(140, 8, 'Huambo', b'1'),
(141, 8, 'Luanda', b'1'),
(142, 8, 'Namibe', b'1'),
(143, 9, 'Anguilla', b'1'),
(144, 10, 'Havlo', b'1'),
(145, 10, 'Victoria', b'1'),
(146, 10, 'North Antarctica', b'1'),
(147, 10, 'Byrdland', b'1'),
(148, 10, 'Newbin', b'1'),
(149, 10, 'Atchabinic', b'1'),
(150, 11, 'St John', b'1'),
(151, 12, 'Buenos Aires', b'1'),
(152, 12, 'Catamarca', b'1'),
(153, 12, 'CÃ³rdoba', b'1'),
(154, 12, 'Chaco', b'1'),
(155, 12, 'Chubut', b'1'),
(156, 12, 'Corrientes', b'1'),
(157, 12, 'Distrito Federal', b'1'),
(158, 12, 'Entre Rios', b'1'),
(159, 12, 'Formosa', b'1'),
(160, 12, 'Jujuy', b'1'),
(161, 12, 'La Rioja', b'1'),
(162, 12, 'Mendoza', b'1'),
(163, 12, 'Misiones', b'1'),
(164, 12, 'NeuquÃ©n', b'1'),
(165, 12, 'Salta', b'1'),
(166, 12, 'San Juan', b'1'),
(167, 12, 'San Luis', b'1'),
(168, 12, 'Santa FÃ©', b'1'),
(169, 12, 'Santiago del Estero', b'1'),
(170, 12, 'TucumÃ¡n', b'1'),
(171, 13, 'Lori', b'1'),
(172, 13, 'Yerevan', b'1'),
(173, 13, 'Å irak', b'1'),
(174, 15, 'Capital Region', b'1'),
(175, 15, 'New South Wales', b'1'),
(176, 15, 'Queensland', b'1'),
(177, 15, 'South Australia', b'1'),
(178, 15, 'Tasmania', b'1'),
(179, 15, 'Victoria', b'1'),
(180, 15, 'West Australia', b'1'),
(181, 16, 'KÃ¤rnten', b'1'),
(182, 16, 'North Austria', b'1'),
(183, 16, 'Salzburg', b'1'),
(184, 16, 'Steiermark', b'1'),
(185, 16, 'Tiroli', b'1'),
(186, 16, 'Wien', b'1'),
(187, 17, 'Baki', b'1'),
(188, 17, 'GÃ¤ncÃ¤', b'1'),
(189, 17, 'MingÃ¤Ã§evir', b'1'),
(190, 17, 'Sumqayit', b'1'),
(191, 18, 'New Providence', b'1'),
(192, 19, 'al-Manama', b'1'),
(193, 20, 'Barisal', b'1'),
(194, 20, 'Chittagong', b'1'),
(195, 20, 'Dhaka', b'1'),
(196, 20, 'Khulna', b'1'),
(197, 20, 'Rajshahi', b'1'),
(198, 20, 'Sylhet', b'1'),
(199, 21, 'St Michael', b'1'),
(200, 22, 'Brest', b'1'),
(201, 22, 'Gomel', b'1'),
(202, 22, 'Grodno', b'1'),
(203, 22, 'Horad Minsk', b'1'),
(204, 22, 'Minsk', b'1'),
(205, 22, 'Mogiljov', b'1'),
(206, 22, 'Vitebsk', b'1'),
(207, 23, 'Antwerpen', b'1'),
(208, 23, 'Bryssel', b'1'),
(209, 23, 'East Flanderi', b'1'),
(210, 23, 'Hainaut', b'1'),
(211, 23, 'LiÃ¨ge', b'1'),
(212, 23, 'Namur', b'1'),
(213, 23, 'West Flanderi', b'1'),
(214, 24, 'Belize City', b'1'),
(215, 24, 'Cayo', b'1'),
(216, 25, 'Atacora', b'1'),
(217, 25, 'Atlantique', b'1'),
(218, 25, 'Borgou', b'1'),
(219, 25, 'OuÃ©mÃ©', b'1'),
(220, 26, 'Hamilton', b'1'),
(221, 26, 'Saint GeorgeÂ´s', b'1'),
(222, 27, 'Thimphu', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `family_name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `ref_id_idx` (`gender`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `first_name`, `last_name`, `family_name`, `password`, `email`, `gender`, `dob`, `country`, `state`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 'aarukarthiga', 'Karthiga', 'Aaru', 'Arumugam', 'e10adc3949ba59abbe56e057f20f883e', 'karthiga.aaru09@gmial.com', '2', '1990-03-22', 99, 21, 1, 1, NULL, NULL, b'1'),
(2, 'idsi', 'Invigor', 'Digital', 'IDSI', 'e10adc3949ba59abbe56e057f20f883e', 'karthiga.arumugam@invigorgroup.com', '2', '1989-03-22', 99, 21, 1, 1, NULL, NULL, b'1'),
(3, 'idsiTesting', 'Invigor', 'Testing', 'IDSITesting', 'e10adc3949ba59abbe56e057f20f883e', 'karthiga.arumugam@gmail.com', '1', '1987-03-22', 99, 21, 1, 1, NULL, NULL, b'1'),
(4, 'idsiTest', 'Invigor', 'Test', 'IDSITest', 'e10adc3949ba59abbe56e057f20f883e', 'karthiga.arumugam1@gmail.com', '1', '1987-03-22', 99, 21, 1, 1, NULL, NULL, b'1'),
(5, 'idsiT', 'Invigor', 'T', 'IDSIT', 'e10adc3949ba59abbe56e057f20f883e', 'karthiga.arumugam2@gmail.com', '1', '1987-03-22', 99, 21, 1, 1, NULL, NULL, b'1'),
(6, 'prakash1', 'Praksah', 'Arumugam', 'parumugam', 'b24331b1a138cde62aa1f679164fc62f', 'prakash1@gmail.com', 'M', '1982-10-20', NULL, 19, NULL, NULL, '2015-10-20 12:41:54', NULL, b'1'),
(7, 'prakash2', 'Praksah', 'Arumugam', 'parumugam', 'b24331b1a138cde62aa1f679164fc62f', 'prakash2@gmail.com', 'M', '1982-10-20', NULL, 19, NULL, NULL, '2015-10-20 12:42:31', NULL, b'1'),
(8, 'prakash3', 'Praksah', 'Arumugam', 'parumugam', 'b24331b1a138cde62aa1f679164fc62f', 'prakash3@gmail.com', 'M', '1982-10-20', NULL, 19, NULL, NULL, '2015-10-20 12:42:57', NULL, b'1'),
(9, 'prakash', 'Praksah', 'Arumugam', 'parumugam', 'b24331b1a138cde62aa1f679164fc62f', 'prakash@gmail.com', 'M', '1982-10-20', NULL, 19, NULL, NULL, '2015-10-22 04:37:20', NULL, b'1'),
(10, 'testing3', 'test', NULL, 'test', '5fe43373c2db4deb851f3290080621f5', 'testing3@gmail.com', 'M', '2015-10-22', 1, 36, NULL, NULL, '2015-10-22 04:47:01', NULL, b'1'),
(11, 'nandha', 'Nandha', NULL, 'Nandha', 'e10adc3949ba59abbe56e057f20f883e', 'invigordigit@gmail.com', 'M', '1984-11-23', 99, 21, NULL, NULL, '2015-10-22 06:04:00', NULL, b'1'),
(12, '@89', '@98', NULL, '@98', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'r@t.tt', 'F', '2020-10-22', 1, 38, NULL, NULL, '2015-10-22 07:28:40', NULL, b'1'),
(13, 'sample', 'first', NULL, 'first', '5e8ff9bf55ba3508199d22e984129be6', 'test2@t.com', 'M', '2015-10-22', 2, 102, NULL, NULL, '2015-10-22 08:17:14', NULL, b'1'),
(14, 'prakash1ww', 'Praksah', 'Arumugam', 'parumugam', 'b24331b1a138cde62aa1f679164fc62f', 'prakash1ww@gmail.com', 'M', '1982-10-20', NULL, 19, NULL, NULL, '2015-10-22 09:01:54', NULL, b'1'),
(15, 'nanda', 'rshne', NULL, 'rshne', '7694f4a66316e53c8cdd9d9954bd611d', 'invigordigit@gmail.com', 'M', '2015-10-22', 2, 101, NULL, NULL, '2015-10-22 09:29:12', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user_attributes`
--

CREATE TABLE IF NOT EXISTS `user_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `ethinicity` int(11) DEFAULT NULL,
  `skin_color` int(11) DEFAULT NULL,
  `eye_color` int(11) DEFAULT NULL,
  `chest` int(11) DEFAULT NULL,
  `waist` int(11) DEFAULT NULL,
  `hips` int(11) DEFAULT NULL,
  `shoe_size` int(11) DEFAULT NULL,
  `hair_length` int(11) DEFAULT NULL,
  `hair_color` int(11) DEFAULT NULL,
  `dress_size_low` int(11) DEFAULT NULL,
  `dress_size_high` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`),
  KEY `ref_idx` (`height`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_attributes`
--

INSERT INTO `user_attributes` (`id`, `user_id`, `height`, `weight`, `ethinicity`, `skin_color`, `eye_color`, `chest`, `waist`, `hips`, `shoe_size`, `hair_length`, `hair_color`, `dress_size_low`, `dress_size_high`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 3, 5, 7, 11, 13, 15, 17, 19, 21, 23, 25, 27, 29, 1, NULL, '2015-10-22 08:42:50', NULL, b'1'),
(3, 3, 3, 5, 7, 11, 13, 15, 17, 19, 21, 23, 25, 27, 29, 3, NULL, '2015-10-22 10:36:57', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user_followers`
--

CREATE TABLE IF NOT EXISTS `user_followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `follower_id` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_followers`
--

INSERT INTO `user_followers` (`id`, `user_id`, `follower_id`, `description`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 2, 'test', NULL, NULL, '2015-10-22 05:18:55', NULL, b'0'),
(2, 1, 3, 'test', NULL, NULL, '2015-10-22 05:17:54', NULL, b'0'),
(3, 3, 1, 'test', NULL, NULL, NULL, NULL, b'1'),
(4, 2, 1, 'test', NULL, NULL, NULL, NULL, b'1'),
(5, 1, 3, NULL, NULL, NULL, '2015-10-22 05:22:13', NULL, b'0'),
(6, 1, 1, NULL, NULL, NULL, '2015-10-22 05:22:30', NULL, b'0'),
(7, 1, 2, NULL, NULL, NULL, '2015-10-22 05:22:08', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user_image`
--

CREATE TABLE IF NOT EXISTS `user_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `image_path` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `user8_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_image`
--

INSERT INTO `user_image` (`id`, `user_id`, `image_path`, `description`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 8, '1445344977.jpg', NULL, NULL, NULL, '2015-10-20 12:42:57', NULL, b'1'),
(2, 10, '1445489221.jpg', NULL, NULL, NULL, '2015-10-22 04:47:01', NULL, b'1'),
(3, 12, '1445498920.jpg', NULL, NULL, NULL, '2015-10-22 07:28:40', NULL, b'1'),
(4, 14, '1445504514.jpg', NULL, NULL, NULL, '2015-10-22 09:01:54', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user_inbox`
--

CREATE TABLE IF NOT EXISTS `user_inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` bit(1) DEFAULT NULL,
  `is_reportabuse` bit(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_inbox`
--

INSERT INTO `user_inbox` (`id`, `user_id`, `sender_id`, `message`, `is_read`, `is_reportabuse`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 2, 'test message', NULL, NULL, 1, NULL, '2015-10-22 05:25:02', NULL, b'1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accent`
--
ALTER TABLE `accent`
  ADD CONSTRAINT `user2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `acting`
--
ALTER TABLE `acting`
  ADD CONSTRAINT `ref` FOREIGN KEY (`experince`) REFERENCES `reference_value` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feeds`
--
ALTER TABLE `feeds`
  ADD CONSTRAINT `mountain1` FOREIGN KEY (`mountain_id`) REFERENCES `mountain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user7` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feeds_abused`
--
ALTER TABLE `feeds_abused`
  ADD CONSTRAINT `feed9` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user15` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feeds_like`
--
ALTER TABLE `feeds_like`
  ADD CONSTRAINT `feed2` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user11` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feeds_viewed`
--
ALTER TABLE `feeds_viewed`
  ADD CONSTRAINT `feed8` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user14` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feed_trending_tag`
--
ALTER TABLE `feed_trending_tag`
  ADD CONSTRAINT `feed15` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user18` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hash_tag_master`
--
ALTER TABLE `hash_tag_master`
  ADD CONSTRAINT `feed5` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `language`
--
ALTER TABLE `language`
  ADD CONSTRAINT `user3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `modeling`
--
ALTER TABLE `modeling`
  ADD CONSTRAINT `exp1` FOREIGN KEY (`experience`) REFERENCES `reference_value` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reference_value`
--
ALTER TABLE `reference_value`
  ADD CONSTRAINT `ref3` FOREIGN KEY (`reference_id`) REFERENCES `reference_domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
