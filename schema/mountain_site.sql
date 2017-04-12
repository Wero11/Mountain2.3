-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2015 at 12:25 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mountain_site`
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
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `accent`
--

INSERT INTO `accent` (`id`, `user_id`, `value`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 41, 1, 1, '2015-10-30 06:28:40', NULL, 1),
(2, 1, 32, 1, 1, '2015-10-30 06:28:40', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `acting`
--

CREATE TABLE IF NOT EXISTS `acting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `agencies` tinyint(4) DEFAULT NULL,
  `shortflims` tinyint(4) DEFAULT NULL,
  `tvshows` tinyint(4) DEFAULT NULL,
  `musicvideos` tinyint(4) DEFAULT NULL,
  `radio` tinyint(4) DEFAULT NULL,
  `feauturesfilms` tinyint(4) DEFAULT NULL,
  `entertainers` tinyint(4) DEFAULT NULL,
  `theatre` tinyint(4) DEFAULT NULL,
  `representation` tinyint(4) DEFAULT NULL,
  `experince` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `ref_id_idx` (`experince`),
  KEY `ref_idx` (`experince`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `acting`
--

INSERT INTO `acting` (`id`, `user_id`, `agencies`, `shortflims`, `tvshows`, `musicvideos`, `radio`, `feauturesfilms`, `entertainers`, `theatre`, `representation`, `experince`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 1, 0, 1, 0, 1, 0, 1, 0, 1, 33, 1, 1, '0000-00-00 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `time_zone` varchar(45) NOT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `name`, `time_zone`, `is_active`) VALUES
(1, 'US', 'United States', '', 1),
(2, 'CA', 'Canada', '', 1),
(3, 'AF', 'Afghanistan', '', 1),
(4, 'AL', 'Albania', '', 1),
(5, 'DZ', 'Algeria', '', 1),
(6, 'DS', 'American Samoa', '', 1),
(7, 'AD', 'Andorra', '', 1),
(8, 'AO', 'Angola', '', 1),
(9, 'AI', 'Anguilla', '', 1),
(10, 'AQ', 'Antarctica', '', 1),
(11, 'AG', 'Antigua and/or Barbuda', '', 1),
(12, 'AR', 'Argentina', '', 1),
(13, 'AM', 'Armenia', '', 1),
(14, 'AW', 'Aruba', '', 1),
(15, 'AU', 'Australia', '', 1),
(16, 'AT', 'Austria', '', 1),
(17, 'AZ', 'Azerbaijan', '', 1),
(18, 'BS', 'Bahamas', '', 1),
(19, 'BH', 'Bahrain', '', 1),
(20, 'BD', 'Bangladesh', '', 1),
(21, 'BB', 'Barbados', '', 1),
(22, 'BY', 'Belarus', '', 1),
(23, 'BE', 'Belgium', '', 1),
(24, 'BZ', 'Belize', '', 1),
(25, 'BJ', 'Benin', '', 1),
(26, 'BM', 'Bermuda', '', 1),
(27, 'BT', 'Bhutan', '', 1),
(28, 'BO', 'Bolivia', '', 1),
(29, 'BA', 'Bosnia and Herzegovina', '', 1),
(30, 'BW', 'Botswana', '', 1),
(31, 'BV', 'Bouvet Island', '', 1),
(32, 'BR', 'Brazil', '', 1),
(33, 'IO', 'British Indian Ocean Territory', '', 1),
(34, 'BN', 'Brunei Darussalam', '', 1),
(35, 'BG', 'Bulgaria', '', 1),
(36, 'BF', 'Burkina Faso', '', 1),
(37, 'BI', 'Burundi', '', 1),
(38, 'KH', 'Cambodia', '', 1),
(39, 'CM', 'Cameroon', '', 1),
(40, 'CV', 'Cape Verde', '', 1),
(41, 'KY', 'Cayman Islands', '', 1),
(42, 'CF', 'Central African Republic', '', 1),
(43, 'TD', 'Chad', '', 1),
(44, 'CL', 'Chile', '', 1),
(45, 'CN', 'China', '', 1),
(46, 'CX', 'Christmas Island', '', 1),
(47, 'CC', 'Cocos (Keeling) Islands', '', 1),
(48, 'CO', 'Colombia', '', 1),
(49, 'KM', 'Comoros', '', 1),
(50, 'CG', 'Congo', '', 1),
(51, 'CK', 'Cook Islands', '', 1),
(52, 'CR', 'Costa Rica', '', 1),
(53, 'HR', 'Croatia (Hrvatska)', '', 1),
(54, 'CU', 'Cuba', '', 1),
(55, 'CY', 'Cyprus', '', 1),
(56, 'CZ', 'Czech Republic', '', 1),
(57, 'DK', 'Denmark', '', 1),
(58, 'DJ', 'Djibouti', '', 1),
(59, 'DM', 'Dominica', '', 1),
(60, 'DO', 'Dominican Republic', '', 1),
(61, 'TP', 'East Timor', '', 1),
(62, 'EC', 'Ecuador', '', 1),
(63, 'EG', 'Egypt', '', 1),
(64, 'SV', 'El Salvador', '', 1),
(65, 'GQ', 'Equatorial Guinea', '', 1),
(66, 'ER', 'Eritrea', '', 1),
(67, 'EE', 'Estonia', '', 1),
(68, 'ET', 'Ethiopia', '', 1),
(69, 'FK', 'Falkland Islands (Malvinas)', '', 1),
(70, 'FO', 'Faroe Islands', '', 1),
(71, 'FJ', 'Fiji', '', 1),
(72, 'FI', 'Finland', '', 1),
(73, 'FR', 'France', '', 1),
(74, 'FX', 'France, Metropolitan', '', 1),
(75, 'GF', 'French Guiana', '', 1),
(76, 'PF', 'French Polynesia', '', 1),
(77, 'TF', 'French Southern Territories', '', 1),
(78, 'GA', 'Gabon', '', 1),
(79, 'GM', 'Gambia', '', 1),
(80, 'GE', 'Georgia', '', 1),
(81, 'DE', 'Germany', '', 1),
(82, 'GH', 'Ghana', '', 1),
(83, 'GI', 'Gibraltar', '', 1),
(84, 'GR', 'Greece', '', 1),
(85, 'GL', 'Greenland', '', 1),
(86, 'GD', 'Grenada', '', 1),
(87, 'GP', 'Guadeloupe', '', 1),
(88, 'GU', 'Guam', '', 1),
(89, 'GT', 'Guatemala', '', 1),
(90, 'GN', 'Guinea', '', 1),
(91, 'GW', 'Guinea-Bissau', '', 1),
(92, 'GY', 'Guyana', '', 1),
(93, 'HT', 'Haiti', '', 1),
(94, 'HM', 'Heard and Mc Donald Islands', '', 1),
(95, 'HN', 'Honduras', '', 1),
(96, 'HK', 'Hong Kong', '', 1),
(97, 'HU', 'Hungary', '', 1),
(98, 'IS', 'Iceland', '', 1),
(99, 'IN', 'India', '', 1),
(100, 'ID', 'Indonesia', '', 1),
(101, 'IR', 'Iran (Islamic Republic of)', '', 1),
(102, 'IQ', 'Iraq', '', 1),
(103, 'IE', 'Ireland', '', 1),
(104, 'IL', 'Israel', '', 1),
(105, 'IT', 'Italy', '', 1),
(106, 'CI', 'Ivory Coast', '', 1),
(107, 'JM', 'Jamaica', '', 1),
(108, 'JP', 'Japan', '', 1),
(109, 'JO', 'Jordan', '', 1),
(110, 'KZ', 'Kazakhstan', '', 1),
(111, 'KE', 'Kenya', '', 1),
(112, 'KI', 'Kiribati', '', 1),
(113, 'KP', 'Korea, Democratic People''s Republic of', '', 1),
(114, 'KR', 'Korea, Republic of', '', 1),
(115, 'XK', 'Kosovo', '', 1),
(116, 'KW', 'Kuwait', '', 1),
(117, 'KG', 'Kyrgyzstan', '', 1),
(118, 'LA', 'Lao People''s Democratic Republic', '', 1),
(119, 'LV', 'Latvia', '', 1),
(120, 'LB', 'Lebanon', '', 1),
(121, 'LS', 'Lesotho', '', 1),
(122, 'LR', 'Liberia', '', 1),
(123, 'LY', 'Libyan Arab Jamahiriya', '', 1),
(124, 'LI', 'Liechtenstein', '', 1),
(125, 'LT', 'Lithuania', '', 1),
(126, 'LU', 'Luxembourg', '', 1),
(127, 'MO', 'Macau', '', 1),
(128, 'MK', 'Macedonia', '', 1),
(129, 'MG', 'Madagascar', '', 1),
(130, 'MW', 'Malawi', '', 1),
(131, 'MY', 'Malaysia', '', 1),
(132, 'MV', 'Maldives', '', 1),
(133, 'ML', 'Mali', '', 1),
(134, 'MT', 'Malta', '', 1),
(135, 'MH', 'Marshall Islands', '', 1),
(136, 'MQ', 'Martinique', '', 1),
(137, 'MR', 'Mauritania', '', 1),
(138, 'MU', 'Mauritius', '', 1),
(139, 'TY', 'Mayotte', '', 1),
(140, 'MX', 'Mexico', '', 1),
(141, 'FM', 'Micronesia, Federated States of', '', 1),
(142, 'MD', 'Moldova, Republic of', '', 1),
(143, 'MC', 'Monaco', '', 1),
(144, 'MN', 'Mongolia', '', 1),
(145, 'ME', 'Montenegro', '', 1),
(146, 'MS', 'Montserrat', '', 1),
(147, 'MA', 'Morocco', '', 1),
(148, 'MZ', 'Mozambique', '', 1),
(149, 'MM', 'Myanmar', '', 1),
(150, 'NA', 'Namibia', '', 1),
(151, 'NR', 'Nauru', '', 1),
(152, 'NP', 'Nepal', '', 1),
(153, 'NL', 'Netherlands', '', 1),
(154, 'AN', 'Netherlands Antilles', '', 1),
(155, 'NC', 'New Caledonia', '', 1),
(156, 'NZ', 'New Zealand', '', 1),
(157, 'NI', 'Nicaragua', '', 1),
(158, 'NE', 'Niger', '', 1),
(159, 'NG', 'Nigeria', '', 1),
(160, 'NU', 'Niue', '', 1),
(161, 'NF', 'Norfolk Island', '', 1),
(162, 'MP', 'Northern Mariana Islands', '', 1),
(163, 'NO', 'Norway', '', 1),
(164, 'OM', 'Oman', '', 1),
(165, 'PK', 'Pakistan', '', 1),
(166, 'PW', 'Palau', '', 1),
(167, 'PA', 'Panama', '', 1),
(168, 'PG', 'Papua New Guinea', '', 1),
(169, 'PY', 'Paraguay', '', 1),
(170, 'PE', 'Peru', '', 1),
(171, 'PH', 'Philippines', '', 1),
(172, 'PN', 'Pitcairn', '', 1),
(173, 'PL', 'Poland', '', 1),
(174, 'PT', 'Portugal', '', 1),
(175, 'PR', 'Puerto Rico', '', 1),
(176, 'QA', 'Qatar', '', 1),
(177, 'RE', 'Reunion', '', 1),
(178, 'RO', 'Romania', '', 1),
(179, 'RU', 'Russian Federation', '', 1),
(180, 'RW', 'Rwanda', '', 1),
(181, 'KN', 'Saint Kitts and Nevis', '', 1),
(182, 'LC', 'Saint Lucia', '', 1),
(183, 'VC', 'Saint Vincent and the Grenadines', '', 1),
(184, 'WS', 'Samoa', '', 1),
(185, 'SM', 'San Marino', '', 1),
(186, 'ST', 'Sao Tome and Principe', '', 1),
(187, 'SA', 'Saudi Arabia', '', 1),
(188, 'SN', 'Senegal', '', 1),
(189, 'RS', 'Serbia', '', 1),
(190, 'SC', 'Seychelles', '', 1),
(191, 'SL', 'Sierra Leone', '', 1),
(192, 'SG', 'Singapore', '', 1),
(193, 'SK', 'Slovakia', '', 1),
(194, 'SI', 'Slovenia', '', 1),
(195, 'SB', 'Solomon Islands', '', 1),
(196, 'SO', 'Somalia', '', 1),
(197, 'ZA', 'South Africa', '', 1),
(198, 'GS', 'South Georgia South Sandwich Islands', '', 1),
(199, 'ES', 'Spain', '', 1),
(200, 'LK', 'Sri Lanka', '', 1),
(201, 'SH', 'St. Helena', '', 1),
(202, 'PM', 'St. Pierre and Miquelon', '', 1),
(203, 'SD', 'Sudan', '', 1),
(204, 'SR', 'Suriname', '', 1),
(205, 'SJ', 'Svalbard and Jan Mayen Islands', '', 1),
(206, 'SZ', 'Swaziland', '', 1),
(207, 'SE', 'Sweden', '', 1),
(208, 'CH', 'Switzerland', '', 1),
(209, 'SY', 'Syrian Arab Republic', '', 1),
(210, 'TW', 'Taiwan', '', 1),
(211, 'TJ', 'Tajikistan', '', 1),
(212, 'TZ', 'Tanzania, United Republic of', '', 1),
(213, 'TH', 'Thailand', '', 1),
(214, 'TG', 'Togo', '', 1),
(215, 'TK', 'Tokelau', '', 1),
(216, 'TO', 'Tonga', '', 1),
(217, 'TT', 'Trinidad and Tobago', '', 1),
(218, 'TN', 'Tunisia', '', 1),
(219, 'TR', 'Turkey', '', 1),
(220, 'TM', 'Turkmenistan', '', 1),
(221, 'TC', 'Turks and Caicos Islands', '', 1),
(222, 'TV', 'Tuvalu', '', 1),
(223, 'UG', 'Uganda', '', 1),
(224, 'UA', 'Ukraine', '', 1),
(225, 'AE', 'United Arab Emirates', '', 1),
(226, 'GB', 'United Kingdom', '', 1),
(227, 'UM', 'United States minor outlying islands', '', 1),
(228, 'UY', 'Uruguay', '', 1),
(229, 'UZ', 'Uzbekistan', '', 1),
(230, 'VU', 'Vanuatu', '', 1),
(231, 'VA', 'Vatican City State', '', 1),
(232, 'VE', 'Venezuela', '', 1),
(233, 'VN', 'Vietnam', '', 1),
(234, 'VG', 'Virgin Islands (British)', '', 1),
(235, 'VI', 'Virgin Islands (U.S.)', '', 1),
(236, 'WF', 'Wallis and Futuna Islands', '', 1),
(237, 'EH', 'Western Sahara', '', 1),
(238, 'YE', 'Yemen', '', 1),
(239, 'YU', 'Yugoslavia', '', 1),
(240, 'ZR', 'Zaire', '', 1),
(241, 'ZM', 'Zambia', '', 1),
(242, 'ZW', 'Zimbabwe', '', 1),
(243, 'PS', 'Palestine', '', 1),
(244, 'IM', 'Isle of Man', '', 1),
(245, 'JE', 'Jersey', '', 1),
(246, 'GK', 'Guernsey', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `peak_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `video_name` varchar(45) DEFAULT NULL,
  `is_reposted` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  `is_overwrite` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`),
  KEY `peak009_idx` (`peak_id`),
  KEY `country_idx` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`id`, `user_id`, `peak_id`, `country_id`, `description`, `video_name`, `is_reposted`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`, `is_overwrite`) VALUES
(1, 1, 5, 99, 'test', '1445517534.mp4', NULL, 1, 1, '2015-10-29 07:00:00', NULL, 1, NULL),
(2, 2, 1, 99, 'second feed', '1445517534.mp4', NULL, 2, 2, '2015-10-29 07:00:00', NULL, 1, NULL),
(3, 3, 1, 99, 'third feed', '1445517534.mp4', NULL, 3, 3, '2015-10-29 07:00:00', NULL, 1, NULL),
(4, 2, 5, 99, 'nike feed', '1445517534.mp4', NULL, 2, 2, '2015-10-29 07:00:00', NULL, 1, NULL);

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
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `feed2_idx` (`feed_id`),
  KEY `user11_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feeds_like`
--

CREATE TABLE IF NOT EXISTS `feeds_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `like_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `feed2_idx` (`feed_id`),
  KEY `user11_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `feeds_like`
--

INSERT INTO `feeds_like` (`id`, `feed_id`, `user_id`, `like_dttm`, `is_active`) VALUES
(1, 1, 2, '2015-10-29 14:00:00', 1),
(2, 1, 3, '2015-10-29 14:00:00', 1),
(3, 1, 4, '2015-10-29 14:00:00', 1),
(4, 2, 4, '2015-10-29 14:00:00', 1),
(5, 2, 3, '2015-10-29 14:00:00', 1),
(6, 3, 6, '2015-10-29 14:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feeds_viewed`
--

CREATE TABLE IF NOT EXISTS `feeds_viewed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `viewed_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `feed2_idx` (`feed_id`),
  KEY `user11_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `feeds_viewed`
--

INSERT INTO `feeds_viewed` (`id`, `feed_id`, `user_id`, `viewed_dttm`, `is_active`) VALUES
(1, 1, 2, '2015-10-29 10:00:00', 1),
(2, 1, 3, '2015-10-29 10:00:00', 1),
(3, 1, 4, '2015-10-29 10:00:00', 1),
(4, 1, 5, '2015-10-29 10:00:00', 1),
(5, 2, 1, '2015-10-29 10:00:00', 1),
(6, 2, 4, '2015-10-29 10:00:00', 1),
(7, 3, 6, '2015-10-29 10:00:00', 1);

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
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `feed32_idx` (`feed_id`),
  KEY `user41_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hash_tag_master`
--

CREATE TABLE IF NOT EXISTS `hash_tag_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `hash_tag` varchar(255) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `feed5_idx` (`feed_id`)
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
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `user_id`, `value`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 43, 1, 1, '2015-10-30 06:07:11', NULL, 1),
(2, 1, 41, 1, 1, NULL, NULL, 1),
(3, 1, 32, 1, NULL, '2015-10-30 06:08:34', NULL, 1),
(4, 1, 33, 1, NULL, '2015-10-30 06:08:34', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modeling`
--

CREATE TABLE IF NOT EXISTS `modeling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `agenicies` tinyint(4) DEFAULT NULL,
  `pageants` tinyint(4) DEFAULT NULL,
  `fitting` tinyint(4) DEFAULT NULL,
  `music_video` tinyint(4) DEFAULT NULL,
  `print` tinyint(4) DEFAULT NULL,
  `tvcommercial` tinyint(4) DEFAULT NULL,
  `catwalk` tinyint(4) DEFAULT NULL,
  `event_promotion` tinyint(4) DEFAULT NULL,
  `hair_model` tinyint(4) DEFAULT NULL,
  `presenters` tinyint(4) DEFAULT NULL,
  `time_prints` tinyint(4) DEFAULT NULL,
  `others` varchar(45) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `user_idx` (`user_id`),
  KEY `exp1_idx` (`experience`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `modeling`
--

INSERT INTO `modeling` (`id`, `user_id`, `agenicies`, `pageants`, `fitting`, `music_video`, `print`, `tvcommercial`, `catwalk`, `event_promotion`, `hair_model`, `presenters`, `time_prints`, `others`, `website`, `experience`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2015-10-30 06:19:50', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mountain`
--

CREATE TABLE IF NOT EXISTS `mountain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `is_main` bit(1) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `peak_duration` int(11) DEFAULT NULL,
  `no_of_peaks` int(11) DEFAULT NULL,
  `hash_tag` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `update_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mountain`
--

INSERT INTO `mountain` (`id`, `name`, `is_main`, `start_date`, `peak_duration`, `no_of_peaks`, `hash_tag`, `country_id`, `created_by`, `updated_by`, `created_dttm`, `update_dttm`, `is_active`) VALUES
(1, 'Default', b'1', '2015-10-29 06:00:00', 5, 4, 'Default', 0, 1, 1, NULL, NULL, 1),
(2, 'Nike', b'1', '2015-10-29 06:00:00', 4, 3, 'Nike', 99, 1, 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mountain_judges`
--

CREATE TABLE IF NOT EXISTS `mountain_judges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mountain_id` int(11) DEFAULT NULL,
  `judge_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `mountainid001_idx` (`mountain_id`),
  KEY `judge001_idx` (`judge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mountain_peak`
--

CREATE TABLE IF NOT EXISTS `mountain_peak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mountain_id` int(11) DEFAULT NULL,
  `peak_index` int(11) DEFAULT NULL,
  `is_finished` tinyint(4) DEFAULT '0',
  `start_dttm` datetime DEFAULT NULL,
  `end_dttm` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `mountainid008_idx` (`mountain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mountain_peak`
--

INSERT INTO `mountain_peak` (`id`, `mountain_id`, `peak_index`, `is_finished`, `start_dttm`, `end_dttm`, `created_by`, `is_active`) VALUES
(1, 1, 1, 0, '2015-10-29 06:00:00', '2015-11-03 06:00:00', 1, 1),
(2, 1, 2, NULL, '2015-10-03 06:00:00', '2015-11-08 06:00:00', 1, 1),
(3, 1, 3, NULL, '2015-10-08 06:00:00', '2015-11-13 06:00:00', 1, 1),
(4, 1, 4, NULL, '2015-10-13 06:00:00', '2015-11-18 06:00:00', 1, 1),
(5, 2, 1, 0, '2015-10-29 06:00:00', '2015-10-30 11:00:00', 1, 1),
(6, 2, 2, NULL, '2015-10-02 06:00:00', '2015-11-07 06:00:00', 1, 1),
(7, 2, 3, NULL, '2015-10-07 06:00:00', '2015-11-12 06:00:00', 1, 1);

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
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `reference_domain`
--

INSERT INTO `reference_domain` (`id`, `code`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 'Height', NULL, NULL, NULL, NULL, 1),
(2, 'Weight', NULL, NULL, NULL, NULL, 1),
(3, 'Ethinicity', NULL, NULL, NULL, NULL, 1),
(4, 'SkinColor', NULL, NULL, NULL, NULL, 1),
(5, 'EyeColor', NULL, NULL, NULL, NULL, 1),
(6, 'Chest', NULL, NULL, NULL, NULL, 1),
(7, 'Waist', NULL, NULL, NULL, NULL, 1),
(8, 'Hips', NULL, NULL, NULL, NULL, 1),
(9, 'ShoeSize', NULL, NULL, NULL, NULL, 1),
(10, 'HairLength', NULL, NULL, NULL, NULL, 1),
(11, 'HairColor', NULL, NULL, NULL, NULL, 1),
(12, 'DressSizeLow', NULL, NULL, NULL, NULL, 1),
(13, 'DressSizeHigh', NULL, NULL, NULL, NULL, 1),
(14, 'Accent', NULL, NULL, NULL, NULL, 1),
(15, 'ActingExp', NULL, NULL, NULL, NULL, 1),
(16, 'Language', NULL, NULL, NULL, NULL, 1),
(17, 'ModelingExp', NULL, NULL, NULL, NULL, 1);

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
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ref_id_idx` (`reference_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `reference_value`
--

INSERT INTO `reference_value` (`id`, `reference_id`, `value`, `code`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(3, 1, '166', '166', NULL, NULL, NULL, NULL, 1),
(4, 1, '174', '174', NULL, NULL, NULL, NULL, 1),
(5, 2, '54', '54', NULL, NULL, NULL, NULL, 1),
(6, 2, '50', '50', NULL, NULL, NULL, NULL, 1),
(7, 3, 'Tamils', 'Tamils', NULL, NULL, NULL, NULL, 1),
(8, 3, 'Behari', 'Behari', NULL, NULL, NULL, NULL, 1),
(9, 3, 'Kashmiris', 'Kashmiris', NULL, NULL, NULL, NULL, 1),
(10, 3, 'Punjabis', 'Punjabis', NULL, NULL, NULL, NULL, 1),
(11, 4, 'Dark skin', 'Dark skin', NULL, NULL, NULL, NULL, 1),
(12, 4, 'Light Skin', 'Light Skin', NULL, NULL, NULL, NULL, 1),
(13, 5, 'Brown', 'Brown', NULL, NULL, NULL, NULL, 1),
(14, 5, 'Black ', 'Black ', NULL, NULL, NULL, NULL, 1),
(15, 6, '30-32', '30-32', NULL, NULL, NULL, NULL, 1),
(16, 6, '34-36', '34-36', NULL, NULL, NULL, NULL, 1),
(17, 7, '34', '34', NULL, NULL, NULL, NULL, 1),
(18, 7, '36', '36', NULL, NULL, NULL, NULL, 1),
(19, 8, '30-32', '30-32', NULL, NULL, NULL, NULL, 1),
(20, 8, '32-34', '32-34', NULL, NULL, NULL, NULL, 1),
(21, 9, '6', '6', NULL, NULL, NULL, NULL, 1),
(22, 9, '8', '8', NULL, NULL, NULL, NULL, 1),
(23, 11, 'Brown', 'Brown', NULL, NULL, NULL, NULL, 1),
(24, 11, 'Black ', 'Black ', NULL, NULL, NULL, NULL, 1),
(25, 10, 'Short ', 'Short ', NULL, NULL, NULL, NULL, 1),
(26, 10, 'Medium', 'Medium', NULL, NULL, NULL, NULL, 1),
(27, 12, '6-8', '6-8', NULL, NULL, NULL, NULL, 1),
(28, 12, '8-10', '8-10', NULL, NULL, NULL, NULL, 1),
(29, 13, '10-12', '10-12', NULL, NULL, NULL, NULL, 1),
(30, 13, '12-14', '12-14', NULL, NULL, NULL, NULL, 1),
(31, 14, 'Australia', 'AUS', NULL, NULL, NULL, NULL, 1),
(32, 14, 'English', 'AUS', NULL, NULL, NULL, NULL, 1),
(33, 15, 'No Previous Experience', 'Agencies', NULL, NULL, NULL, NULL, 1),
(34, 16, 'English', 'Agencies', NULL, NULL, NULL, NULL, 1),
(35, 17, 'No Previous Experience', 'Agencies', NULL, NULL, NULL, NULL, 1),
(41, 14, 'Tamil', 'Agencies', NULL, NULL, NULL, NULL, 1),
(42, 16, 'Spanish', 'Agencies', NULL, NULL, NULL, NULL, 1),
(43, 16, 'Hindi', 'Agencies', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `country_idx` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `name`, `is_active`) VALUES
(1, 99, 'ANDHRA PRADESH', 1),
(2, 99, 'ASSAM', 1),
(3, 99, 'ARUNACHAL PRADESH', 1),
(4, 99, 'GUJRAT', 1),
(5, 99, 'BIHAR', 1),
(6, 99, 'HARYANA', 1),
(7, 99, 'HIMACHAL PRADESH', 1),
(8, 99, 'JAMMU & KASHMIR', 1),
(9, 99, 'KARNATAKA', 1),
(10, 99, 'KERALA', 1),
(11, 99, 'MADHYA PRADESH', 1),
(12, 99, 'MAHARASHTRA', 1),
(13, 99, 'MANIPUR', 1),
(14, 99, 'MEGHALAYA', 1),
(15, 99, 'MIZORAM', 1),
(16, 99, 'NAGALAND', 1),
(17, 99, 'ORISSA', 1),
(18, 99, 'PUNJAB', 1),
(19, 99, 'RAJASTHAN', 1),
(20, 99, 'SIKKIM', 1),
(21, 99, 'TAMIL NADU', 1),
(22, 99, 'TRIPURA', 1),
(23, 99, 'UTTAR PRADESH', 1),
(24, 99, 'WEST BENGAL', 1),
(25, 99, 'DELHI', 1),
(26, 99, 'GOA', 1),
(27, 99, 'PONDICHERY', 1),
(28, 99, 'LAKSHDWEEP', 1),
(29, 99, 'DAMAN & DIU', 1),
(30, 99, 'DADRA & NAGAR', 1),
(31, 99, 'CHANDIGARH', 1),
(32, 99, 'ANDAMAN & NICOBAR', 1),
(33, 99, 'UTTARANCHAL', 1),
(34, 99, 'JHARKHAND', 1),
(35, 99, 'CHATTISGARH', 1),
(36, 1, 'Alaska', 1),
(37, 1, 'Alabama', 1),
(38, 1, 'American Samoa', 1),
(39, 1, 'Arizona', 1),
(40, 1, 'Arkansas', 1),
(41, 1, 'California', 1),
(42, 1, 'Colorado', 1),
(43, 1, 'Connecticut', 1),
(44, 1, 'Delaware', 1),
(45, 1, 'District of Columbia', 1),
(46, 1, 'Federated `state`(`county_id`,`state_name`,`state_code`) of ', 1),
(47, 1, 'Florida', 1),
(48, 1, 'Georgia', 1),
(49, 1, 'Guam', 1),
(50, 1, 'Hawaii', 1),
(51, 1, 'Idaho', 1),
(52, 1, 'Illinois', 1),
(53, 1, 'Indiana', 1),
(54, 1, 'Iowa', 1),
(55, 1, 'Kansas', 1),
(56, 1, 'Kentucky', 1),
(57, 1, 'Louisiana', 1),
(58, 1, 'Maine', 1),
(59, 1, 'Marshall Islands', 1),
(60, 1, 'Maryland', 1),
(61, 1, 'Massachusetts', 1),
(62, 1, 'Michigan', 1),
(63, 1, 'Minnesota', 1),
(64, 1, 'Mississippi', 1),
(65, 1, 'Missouri', 1),
(66, 1, 'Montana', 1),
(67, 1, 'Nebraska', 1),
(68, 1, 'Nevada', 1),
(69, 1, 'New Hampshire', 1),
(70, 1, 'New Jersey', 1),
(71, 1, 'New Mexico', 1),
(72, 1, 'New York', 1),
(73, 1, 'North Carolina', 1),
(74, 1, 'North Dakota', 1),
(75, 1, 'Northern Mariana Islands', 1),
(76, 1, 'Ohio', 1),
(77, 1, 'Oklahoma', 1),
(78, 1, 'Oregon', 1),
(79, 1, 'Palau', 1),
(80, 1, 'Pennsylvania', 1),
(81, 1, 'Puerto Rico', 1),
(82, 1, 'Rhode Island', 1),
(83, 1, 'South Carolina', 1),
(84, 1, 'South Dakota', 1),
(85, 1, 'Tennessee', 1),
(86, 1, 'Texas', 1),
(87, 1, 'Utah', 1),
(88, 1, 'Vermont', 1),
(89, 1, 'Virgin Islands', 1),
(90, 1, 'Virginia', 1),
(91, 1, 'Washington', 1),
(92, 1, 'West Virginia', 1),
(93, 1, 'Wisconsin', 1),
(94, 1, 'Wyoming', 1),
(95, 1, 'Armed Forces Africa', 1),
(96, 1, 'Armed Forces Americas (except Canada)', 1),
(97, 1, 'Armed Forces Canada', 1),
(98, 1, 'Armed Forces Europe', 1),
(99, 1, 'Armed Forces Middle East', 1),
(100, 1, 'Armed Forces Pacific', 1),
(101, 2, 'Alberta', 1),
(102, 2, 'British Columbia', 1),
(103, 2, 'Manitoba', 1),
(104, 2, 'New Brunswick', 1),
(105, 2, 'Newfoundland and Labrador', 1),
(106, 2, 'Northwest Territories', 1),
(107, 2, 'Nova Scotia', 1),
(108, 2, 'Nunavut', 1),
(109, 2, 'Ontario', 1),
(110, 2, 'Prince Edward Island', 1),
(111, 2, 'Quebec', 1),
(112, 2, 'Saskatchewan', 1),
(113, 2, 'Yukon', 1),
(114, 3, 'Balkh', 1),
(115, 3, 'Herat', 1),
(116, 3, 'Kabol', 1),
(117, 3, 'Qandahar', 1),
(118, 4, 'Tirana', 1),
(119, 5, 'Alger', 1),
(120, 5, 'Annaba', 1),
(121, 5, 'Batna', 1),
(122, 5, 'BÃ©char', 1),
(123, 5, 'BÃ©jaÃ¯a', 1),
(124, 5, 'Biskra', 1),
(125, 5, 'Blida', 1),
(126, 5, 'Chlef', 1),
(127, 5, 'Constantine', 1),
(128, 5, 'GhardaÃ¯a', 1),
(129, 5, 'Mostaganem', 1),
(130, 5, 'Oran', 1),
(131, 5, 'SÃ©tif', 1),
(132, 5, 'Sidi Bel AbbÃ¨s', 1),
(133, 5, 'Skikda', 1),
(134, 5, 'TÃ©bessa', 1),
(135, 5, 'Tiaret', 1),
(136, 5, 'Tlemcen', 1),
(137, 6, 'Tutuila', 1),
(138, 7, 'Andorra la Vella', 1),
(139, 8, 'Benguela', 1),
(140, 8, 'Huambo', 1),
(141, 8, 'Luanda', 1),
(142, 8, 'Namibe', 1),
(143, 9, 'Anguilla', 1),
(144, 10, 'Havlo', 1),
(145, 10, 'Victoria', 1),
(146, 10, 'North Antarctica', 1),
(147, 10, 'Byrdland', 1),
(148, 10, 'Newbin', 1),
(149, 10, 'Atchabinic', 1),
(150, 11, 'St John', 1),
(151, 12, 'Buenos Aires', 1),
(152, 12, 'Catamarca', 1),
(153, 12, 'CÃ³rdoba', 1),
(154, 12, 'Chaco', 1),
(155, 12, 'Chubut', 1),
(156, 12, 'Corrientes', 1),
(157, 12, 'Distrito Federal', 1),
(158, 12, 'Entre Rios', 1),
(159, 12, 'Formosa', 1),
(160, 12, 'Jujuy', 1),
(161, 12, 'La Rioja', 1),
(162, 12, 'Mendoza', 1),
(163, 12, 'Misiones', 1),
(164, 12, 'NeuquÃ©n', 1),
(165, 12, 'Salta', 1),
(166, 12, 'San Juan', 1),
(167, 12, 'San Luis', 1),
(168, 12, 'Santa FÃ©', 1),
(169, 12, 'Santiago del Estero', 1),
(170, 12, 'TucumÃ¡n', 1),
(171, 13, 'Lori', 1),
(172, 13, 'Yerevan', 1),
(173, 13, 'Å irak', 1),
(174, 15, 'Capital Region', 1),
(175, 15, 'New South Wales', 1),
(176, 15, 'Queensland', 1),
(177, 15, 'South Australia', 1),
(178, 15, 'Tasmania', 1),
(179, 15, 'Victoria', 1),
(180, 15, 'West Australia', 1),
(181, 16, 'KÃ¤rnten', 1),
(182, 16, 'North Austria', 1),
(183, 16, 'Salzburg', 1),
(184, 16, 'Steiermark', 1),
(185, 16, 'Tiroli', 1),
(186, 16, 'Wien', 1),
(187, 17, 'Baki', 1),
(188, 17, 'GÃ¤ncÃ¤', 1),
(189, 17, 'MingÃ¤Ã§evir', 1),
(190, 17, 'Sumqayit', 1),
(191, 18, 'New Providence', 1),
(192, 19, 'al-Manama', 1),
(193, 20, 'Barisal', 1),
(194, 20, 'Chittagong', 1),
(195, 20, 'Dhaka', 1),
(196, 20, 'Khulna', 1),
(197, 20, 'Rajshahi', 1),
(198, 20, 'Sylhet', 1),
(199, 21, 'St Michael', 1),
(200, 22, 'Brest', 1),
(201, 22, 'Gomel', 1),
(202, 22, 'Grodno', 1),
(203, 22, 'Horad Minsk', 1),
(204, 22, 'Minsk', 1),
(205, 22, 'Mogiljov', 1),
(206, 22, 'Vitebsk', 1),
(207, 23, 'Antwerpen', 1),
(208, 23, 'Bryssel', 1),
(209, 23, 'East Flanderi', 1),
(210, 23, 'Hainaut', 1),
(211, 23, 'LiÃ¨ge', 1),
(212, 23, 'Namur', 1),
(213, 23, 'West Flanderi', 1),
(214, 24, 'Belize City', 1),
(215, 24, 'Cayo', 1),
(216, 25, 'Atacora', 1),
(217, 25, 'Atlantique', 1),
(218, 25, 'Borgou', 1),
(219, 25, 'OuÃ©mÃ©', 1),
(220, 26, 'Hamilton', 1),
(221, 26, 'Saint GeorgeÂ´s', 1),
(222, 27, 'Thimphu', 1);

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
  `user_type` varchar(45) DEFAULT NULL,
  `profession` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ref_id_idx` (`gender`),
  KEY `country_idx` (`country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `first_name`, `last_name`, `family_name`, `password`, `email`, `gender`, `dob`, `country`, `state`, `user_type`, `profession`, `description`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 'aarukarthiga', 'Karthiga', NULL, 'Arumugam', 'e10adc3949ba59abbe56e057f20f883e', 'karthiga.arumugam@invigorgroup.com', 'F', '1990-04-15', 99, 21, 'user', NULL, NULL, 1, 1, NULL, NULL, 1),
(2, 'sam', 'Sam', NULL, 'Shudeen', 'e10adc3949ba59abbe56e057f20f883e', 'shamsudheen.sahad@invigorgroup.co.in', 'M', '1985-04-15', 99, 21, 'user', NULL, NULL, 1, 1, NULL, NULL, 1),
(3, 'amutha', 'Amutha', NULL, 'Raju', 'e10adc3949ba59abbe56e057f20f883e', 'amutha.raju@invigorgroup.co.in', 'F', '1986-04-15', 99, 21, 'user', NULL, NULL, 1, 1, NULL, NULL, 1),
(4, 'prakash', 'Prakash', NULL, 'Arumugam', 'e10adc3949ba59abbe56e057f20f883e', 'prakash.arumugam@invigorgroup.co.in', 'M', '1986-04-15', 99, 21, 'user', NULL, NULL, 1, 1, NULL, NULL, 1),
(5, 'nandha', 'Nandha', NULL, 'Kumar', 'e10adc3949ba59abbe56e057f20f883e', 'nanda.narayanasamy@invigorgroup.co.in', 'M', '1986-04-15', 99, 21, 'user', NULL, NULL, 1, 1, NULL, NULL, 1),
(6, 'martin', 'Martin', NULL, 'Prabhu', 'e10adc3949ba59abbe56e057f20f883e', 'martin.prabhu@invigorgroup.co.in', 'M', '1986-04-15', 99, 21, 'user', NULL, NULL, 1, 1, NULL, NULL, 1),
(11, 'prakash1', 'Praksah', 'Arumugam', 'parumugam', 'b24331b1a138cde62aa1f679164fc62f', 'prakash@gmail.com', 'M', '1982-10-20', 99, 19, 'judge', NULL, NULL, NULL, NULL, '2015-10-29 11:26:27', NULL, 1);

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
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`),
  KEY `ref_idx` (`height`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_attributes`
--

INSERT INTO `user_attributes` (`id`, `user_id`, `height`, `weight`, `ethinicity`, `skin_color`, `eye_color`, `chest`, `waist`, `hips`, `shoe_size`, `hair_length`, `hair_color`, `dress_size_low`, `dress_size_high`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 3, 5, 7, 11, 13, 15, 17, 19, 21, 23, 25, 27, 29, 1, NULL, '2015-10-29 11:27:45', NULL, 1);

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
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_followers`
--

INSERT INTO `user_followers` (`id`, `user_id`, `follower_id`, `description`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 2, NULL, NULL, NULL, NULL, NULL, 1),
(4, 1, 3, NULL, NULL, NULL, '2015-10-29 12:27:53', NULL, 1),
(5, 1, 4, NULL, NULL, NULL, '2015-10-29 12:28:26', NULL, 1),
(6, 1, 5, NULL, NULL, NULL, '2015-10-29 12:28:48', NULL, 1),
(7, 3, 1, NULL, NULL, NULL, '2015-10-29 12:28:56', NULL, 1);

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
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user8_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_inbox`
--

CREATE TABLE IF NOT EXISTS `user_inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT NULL,
  `is_reportabuse` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `updated_dttm` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_inbox`
--

INSERT INTO `user_inbox` (`id`, `user_id`, `sender_id`, `message`, `is_read`, `is_reportabuse`, `created_by`, `updated_by`, `created_dttm`, `updated_dttm`, `is_active`) VALUES
(1, 1, 2, 'hi', 1, NULL, NULL, NULL, NULL, NULL, 1),
(2, 2, 1, 'hi', 1, NULL, NULL, NULL, NULL, NULL, 1),
(3, 1, 2, 'hello', 1, NULL, NULL, NULL, NULL, '2015-10-30 07:05:14', 0);

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
  ADD CONSTRAINT `peak7` FOREIGN KEY (`peak_id`) REFERENCES `mountain_peak` (`id`),
  ADD CONSTRAINT `country7` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
-- Constraints for table `mountain_judges`
--
ALTER TABLE `mountain_judges`
  ADD CONSTRAINT `judge001` FOREIGN KEY (`judge_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mountainid001` FOREIGN KEY (`mountain_id`) REFERENCES `mountain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mountain_peak`
--
ALTER TABLE `mountain_peak`
  ADD CONSTRAINT `mountainid008` FOREIGN KEY (`mountain_id`) REFERENCES `mountain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
