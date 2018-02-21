-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2017 at 08:55 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opsdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `common_countries`
--

CREATE TABLE `common_countries` (
  `common_countries_id` int(10) UNSIGNED NOT NULL,
  `common_countries_abbr` varchar(2) DEFAULT NULL,
  `common_countries_full` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_countries - A lookup table holding two letter abbreviations and full spelings of countries throughout the world.';

--
-- Dumping data for table `common_countries`
--

INSERT INTO `common_countries` (`common_countries_id`, `common_countries_abbr`, `common_countries_full`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Aland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua and Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BQ', 'Bonaire/Sint Eustatius/Saba'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British Indian Ocean Territory'),
(34, 'BN', 'Brunei Darussalam'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CA', 'Canada'),
(41, 'CV', 'Cape Verde'),
(42, 'KY', 'Cayman Islands'),
(43, 'CF', 'Central African Republic'),
(44, 'TD', 'Chad'),
(45, 'CL', 'Chile'),
(46, 'CN', 'China'),
(47, 'CX', 'Christmas Island'),
(48, 'CC', 'Cocos (Keeling) Islands'),
(49, 'CO', 'Colombia'),
(50, 'KM', 'Comoros'),
(51, 'CG', 'Congo'),
(52, 'CD', 'Democratic Republic of the Congo'),
(53, 'CK', 'Cook Islands'),
(54, 'CR', 'Costa Rica'),
(55, 'CI', 'Côte d\'Ivoire'),
(56, 'HR', 'Croatia'),
(57, 'CU', 'Cuba'),
(58, 'CW', 'Curaçao'),
(59, 'CY', 'Cyprus'),
(60, 'CZ', 'Czech Republic'),
(61, 'DK', 'Denmark'),
(62, 'DJ', 'Djibouti'),
(63, 'DM', 'Dominica'),
(64, 'DO', 'Dominican Republic'),
(65, 'EC', 'Ecuador'),
(66, 'EG', 'Egypt'),
(67, 'SV', 'El Salvador'),
(68, 'GQ', 'Equatorial Guinea'),
(69, 'ER', 'Eritrea'),
(70, 'EE', 'Estonia'),
(71, 'ET', 'Ethiopia'),
(72, 'FK', 'Falkland Islands (Malvinas)'),
(73, 'FO', 'Faroe Islands'),
(74, 'FJ', 'Fiji'),
(75, 'FI', 'Finland'),
(76, 'FR', 'France'),
(77, 'GF', 'French Guiana'),
(78, 'PF', 'French Polynesia'),
(79, 'TF', 'French Southern Territories'),
(80, 'GA', 'Gabon'),
(81, 'GM', 'Gambia'),
(82, 'GE', 'Georgia'),
(83, 'DE', 'Germany'),
(84, 'GH', 'Ghana'),
(85, 'GI', 'Gibraltar'),
(86, 'GR', 'Greece'),
(87, 'GL', 'Greenland'),
(88, 'GD', 'Grenada'),
(89, 'GP', 'Guadeloupe'),
(90, 'GU', 'Guam'),
(91, 'GT', 'Guatemala'),
(92, 'GG', 'Guernsey'),
(93, 'GN', 'Guinea'),
(94, 'GW', 'Guinea-Bissau'),
(95, 'GY', 'Guyana'),
(96, 'HT', 'Haiti'),
(97, 'HM', 'Heard Island and McDonald Islands'),
(98, 'VA', 'Holy See (Vatican City State)'),
(99, 'HN', 'Honduras'),
(100, 'HK', 'Hong Kong'),
(101, 'HU', 'Hungary'),
(102, 'IS', 'Iceland'),
(103, 'IN', 'India'),
(104, 'ID', 'Indonesia'),
(105, 'IR', 'Iran'),
(106, 'IQ', 'Iraq'),
(107, 'IE', 'Ireland'),
(108, 'IM', 'Isle of Man'),
(109, 'IL', 'Israel'),
(110, 'IT', 'Italy'),
(111, 'JM', 'Jamaica'),
(112, 'JP', 'Japan'),
(113, 'JE', 'Jersey'),
(114, 'JO', 'Jordan'),
(115, 'KZ', 'Kazakhstan'),
(116, 'KE', 'Kenya'),
(117, 'KI', 'Kiribati'),
(118, 'KP', 'North Korea'),
(119, 'KR', 'South Korea'),
(120, 'KW', 'Kuwait'),
(121, 'KG', 'Kyrgyzstan'),
(122, 'LA', 'Lao People\'s Democratic Republic'),
(123, 'LV', 'Latvia'),
(124, 'LB', 'Lebanon'),
(125, 'LS', 'Lesotho'),
(126, 'LR', 'Liberia'),
(127, 'LY', 'Libya'),
(128, 'LI', 'Liechtenstein'),
(129, 'LT', 'Lithuania'),
(130, 'LU', 'Luxembourg'),
(131, 'MO', 'Macao'),
(132, 'MK', 'Macedonia'),
(133, 'MG', 'Madagascar'),
(134, 'MW', 'Malawi'),
(135, 'MY', 'Malaysia'),
(136, 'MV', 'Maldives'),
(137, 'ML', 'Mali'),
(138, 'MT', 'Malta'),
(139, 'MH', 'Marshall Islands'),
(140, 'MQ', 'Martinique'),
(141, 'MR', 'Mauritania'),
(142, 'MU', 'Mauritius'),
(143, 'YT', 'Mayotte'),
(144, 'MX', 'Mexico'),
(145, 'FM', 'Micronesia'),
(146, 'MD', 'Moldova'),
(147, 'MC', 'Monaco'),
(148, 'MN', 'Mongolia'),
(149, 'ME', 'Montenegro'),
(150, 'MS', 'Montserrat'),
(151, 'MA', 'Morocco'),
(152, 'MZ', 'Mozambique'),
(153, 'MM', 'Myanmar'),
(154, 'NA', 'Namibia'),
(155, 'NR', 'Nauru'),
(156, 'NP', 'Nepal'),
(157, 'NL', 'Netherlands'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestine'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Réunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'BL', 'Saint Barthélemy'),
(186, 'SH', 'Saint Helena Ascension and Tristan da Cunha'),
(187, 'KN', 'Saint Kitts and Nevis'),
(188, 'LC', 'Saint Lucia'),
(189, 'MF', 'Saint Martin (French part)'),
(190, 'PM', 'Saint Pierre and Miquelon'),
(191, 'VC', 'Saint Vincent and the Grenadines'),
(192, 'WS', 'Samoa'),
(193, 'SM', 'San Marino'),
(194, 'ST', 'Sao Tome and Principe'),
(195, 'SA', 'Saudi Arabia'),
(196, 'SN', 'Senegal'),
(197, 'RS', 'Serbia'),
(198, 'SC', 'Seychelles'),
(199, 'SL', 'Sierra Leone'),
(200, 'SG', 'Singapore'),
(201, 'SX', 'Sint Maarten'),
(202, 'SK', 'Slovakia'),
(203, 'SI', 'Slovenia'),
(204, 'SB', 'Solomon Islands'),
(205, 'SO', 'Somalia'),
(206, 'ZA', 'South Africa'),
(207, 'GS', 'South Georgia and the South Sandwich Islands'),
(208, 'SS', 'South Sudan'),
(209, 'ES', 'Spain'),
(210, 'LK', 'Sri Lanka'),
(211, 'SD', 'Sudan'),
(212, 'SR', 'Suriname'),
(213, 'SJ', 'Svalbard and Jan Mayen'),
(214, 'SZ', 'Swaziland'),
(215, 'SE', 'Sweden'),
(216, 'CH', 'Switzerland'),
(217, 'SY', 'Syrian Arab Republic'),
(218, 'TW', 'Taiwan'),
(219, 'TJ', 'Tajikistan'),
(220, 'TZ', 'Tanzania'),
(221, 'TH', 'Thailand'),
(222, 'TL', 'Timor-Leste'),
(223, 'TG', 'Togo'),
(224, 'TK', 'Tokelau'),
(225, 'TO', 'Tonga'),
(226, 'TT', 'Trinidad and Tobago'),
(227, 'TN', 'Tunisia'),
(228, 'TR', 'Turkey'),
(229, 'TM', 'Turkmenistan'),
(230, 'TC', 'Turks and Caicos Islands'),
(231, 'TV', 'Tuvalu'),
(232, 'UG', 'Uganda'),
(233, 'UA', 'Ukraine'),
(234, 'AE', 'United Arab Emirates'),
(235, 'GB', 'United Kingdom'),
(236, 'US', 'United States'),
(237, 'UM', 'United States Minor Outlying Islands'),
(238, 'UY', 'Uruguay'),
(239, 'UZ', 'Uzbekistan'),
(240, 'VU', 'Vanuatu'),
(241, 'VE', 'Venezuela'),
(242, 'VN', 'Viet Nam'),
(243, 'VG', 'British Virgin Islands'),
(244, 'VI', 'U.S. Virgin Islands'),
(245, 'WF', 'Wallis and Futuna'),
(246, 'EH', 'Western Sahara'),
(247, 'YE', 'Yemen'),
(248, 'ZM', 'Zambia'),
(249, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `common_prefix`
--

CREATE TABLE `common_prefix` (
  `common_prefix_id` int(10) UNSIGNED NOT NULL,
  `common_prefix_abbr` varchar(45) DEFAULT NULL,
  `common_prefix_desc` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_prefix - A lookup table of the most common name prefixes.';

--
-- Dumping data for table `common_prefix`
--

INSERT INTO `common_prefix` (`common_prefix_id`, `common_prefix_abbr`, `common_prefix_desc`) VALUES
(1, 'Mr. ', ' Mr.'),
(2, 'Mrs. ', ' Mrs.'),
(3, 'Miss ', ' Miss'),
(4, 'Dr. ', ' Dr.'),
(5, 'Hon.', 'Honorable'),
(6, 'Prof.', 'Professor'),
(7, 'Rev.', 'Reverend'),
(8, 'Pvt ', ' Pvt. (Army Private)'),
(9, 'Pv2 ', ' Pv2 (Army Private 2)'),
(10, 'PFC ', ' PFC (Army Private 1 Class)'),
(11, 'Spc. ', ' Spc.(ArmySpecialist)'),
(12, 'Cpl. ', ' Cpl.(Army Corporal)'),
(13, 'Sgt. ', ' Sgt.(Army Sereant)'),
(14, 'SSg. ', ' Ssg.(Army Staff Sgt.)'),
(15, 'Sfc. ', ' Sfc.(Army Sgt. 1st Class)'),
(16, 'Msg. ', ' Msg.(Army Master Sgt.)'),
(17, '1Sg. ', ' 1Sg. (Army 1st Sgt.)'),
(18, 'Sgm. ', ' Sgm. (AF Sgt. Maj.)'),
(19, 'CSM. ', ' CSM. (AF Cmd. Sgt Maj.)'),
(20, 'SMA. ', ' SMA. (AFSgt.Maj OTA)'),
(21, 'WO1 ', ' WO1 (Army Warrant Ofc.)'),
(22, 'CW2 ', ' CW2 (Army Chief Warrant Ofc. 2)'),
(23, 'CW3 ', ' CW3 (Army Chief Warrant Ofc. 3)'),
(24, 'CW4 ', ' CW4 (Army Chief Warrant Ofc. 4)'),
(25, 'CW5 ', ' CW5 (Army Chief Warrant Ofc. 5)'),
(26, '2LT ', ' 2LT (Army 2nd Lieutenant)'),
(27, '1LT ', ' 1LT (Army 1st Lieutenant)'),
(28, 'Cpt. ', ' Cpt. (AF Captian)'),
(29, 'Maj. ', ' Maj. (AF Major)'),
(30, 'LTC ', ' LTC. (AF Lt. Colonel)'),
(31, 'Col. ', ' Col. (AF Colonel)'),
(32, 'BG. ', ' BG. (Army Brigadier Gen. 1 Star)'),
(33, 'MG. ', ' MG. (Army Maj. Gen. 2 Star)'),
(34, 'LTG. ', ' LTG. (Army Lt. Gen. 3 Star)'),
(35, 'Gen. ', ' Gen. (AF General 4 Star)'),
(36, 'SN. ', ' SN. (Navy Seaman)'),
(37, 'PO3 ', ' PO3. (Navy Petty Ofc. 3rd)'),
(38, 'PO2 ', ' PO2. (Navy Petty Ofc. 2nd)'),
(39, 'PO1. ', ' PO1. (Navy Petty Ofc. 1st)'),
(40, 'CPO. ', ' CPO.(NavyChiefPetty Ofc.)'),
(41, 'SCPO. ', ' SCPO.(Navy Sr. Chief Petty Ofc.)'),
(42, 'MCPO. ', ' MCPO.(Navy Master Ch. Petty Ofc.)'),
(43, 'MCPON. ', ' MCPON.(Navy Mas. Ch. Petty OTN)'),
(44, 'Ens. ', ' Ens. (Navy Ensign)'),
(45, 'LtJg. ', ' LtJG. (Navy Lt. Jr. Grade)'),
(46, 'Lt. ', ' Lt. (Navy Lieutenant)'),
(47, 'LCDR. ', ' LCDR. (Navy Lt. Cmdr.)'),
(48, 'CDR. ', ' CDR. (Navy Commander)'),
(49, 'Capt. ', ' Capt. (Navy Captian)'),
(50, 'RDML. ', ' RDML. (Navy Rear Adm. Lower - 1 Star)'),
(51, 'RADM. ', ' RADM. (Navy Rear Adm. Upper - 2 Star)'),
(52, 'VADM. ', ' VADM. (Navy Vice Adm. - 3Star)'),
(53, 'ADM. ', ' ADM. (Navy Adm. Chief of Ops. - 4 Star)'),
(54, 'Amn. ', ' Amn. (AF Airman)'),
(55, 'A1C. ', ' A1C (AF Airman 1 CLass)'),
(56, 'SrA. ', ' SrA. (AF Sr. Airman)'),
(57, 'SSgt. ', ' SSgt.(AF AF StaffSgt.)'),
(58, 'TSgt. ', ' Tsgt.(AF Tech. Staff Sgt.)'),
(59, 'MSgt. ', ' MSgt.(AF Mas. Sgt)'),
(60, 'SMSgt. ', ' SMSgt.(AF Sr. Master Staff Sgt.)'),
(61, 'CMSgt. ', ' CMSgt.(AF Chief Master Sgt.)'),
(62, 'CCM. ', ' CCM.(AF Cmdr. Chief Master Sgt.)'),
(63, 'CMSAF. ', ' CMSAF. (AF Chief Master Sgt OTAF)'),
(64, '2d Lt ', ' 2d Lt. (AF 2nd Lieutenant)'),
(65, '1st Lt ', ' 1st Lt (AF 1st Lieutenant)'),
(66, 'Brig. Gen. ', ' Brig. Gen. (AF Brigadier Gen. 1 Star)'),
(67, 'Maj. Gen. ', ' Maj. Gen. (AF Maj. Gen. 2 Star)'),
(68, 'Lt. Gen. ', ' Lt. Gen. (AF Lt. Gen. 3 Star)');

-- --------------------------------------------------------

--
-- Table structure for table `common_suffix`
--

CREATE TABLE `common_suffix` (
  `common_suffix_id` int(10) UNSIGNED NOT NULL,
  `common_suffix_abbr` varchar(45) DEFAULT NULL,
  `common_suffix_desc` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_prefix - A lookup table of the most common name suffixes.';

--
-- Dumping data for table `common_suffix`
--

INSERT INTO `common_suffix` (`common_suffix_id`, `common_suffix_abbr`, `common_suffix_desc`) VALUES
(1, '', 'None'),
(2, 'Jr.', 'Junior'),
(3, 'Sr.', 'Senior'),
(4, 'II', 'The Second'),
(5, 'III', 'The Thrird'),
(6, 'IV', 'The Fourth'),
(7, 'Ret.', 'Retired'),
(8, 'P.E.', 'Professional Engineer'),
(9, 'R.A.', 'Registered Architect'),
(10, 'Ph.D', 'Doctor'),
(11, 'MD', 'Medical Doctor'),
(12, 'JD', 'Juris Doctor'),
(13, 'Esq.', 'Esquire'),
(14, 'Ed.D', 'Educational Doctor'),
(15, 'DO', 'Osteopathic Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `common_usstates`
--

CREATE TABLE `common_usstates` (
  `common_usstates_id` int(10) UNSIGNED NOT NULL,
  `common_usstates_abbr` varchar(2) DEFAULT NULL,
  `common_usstates_full` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_usstates - A lookup table containing the two letter abbreviation and complete spelling of US states.';

--
-- Dumping data for table `common_usstates`
--

INSERT INTO `common_usstates` (`common_usstates_id`, `common_usstates_abbr`, `common_usstates_full`) VALUES
(1, 'AL', 'Alabama'),
(2, 'AK', 'Alaska'),
(3, 'AZ', 'Arizona'),
(4, 'AR', 'Arkansas'),
(5, 'CA', 'California'),
(6, 'CO', 'Colorado'),
(7, 'CT', 'Connecticut'),
(8, 'DE', 'Delaware'),
(9, 'FL', 'Florida'),
(10, 'GA', 'Georgia'),
(11, 'HI', 'Hawaii'),
(12, 'ID', 'Idaho'),
(13, 'IL', 'Illinois'),
(14, 'IN', 'Indiana'),
(15, 'IA', 'Iowa'),
(16, 'KS', 'Kansas'),
(17, 'KY', 'Kentucky'),
(18, 'LA', 'Louisiana'),
(19, 'ME', 'Maine'),
(20, 'MD', 'Maryland'),
(21, 'MA', 'Massachusetts'),
(22, 'MI', 'Michigan'),
(23, 'MN', 'Minnesota'),
(24, 'MS', 'Mississippi'),
(25, 'MO', 'Missouri'),
(26, 'MT', 'Montana'),
(27, 'NE', 'Nebraska'),
(28, 'NV', 'Nevada'),
(29, 'NH', 'New Hampshire'),
(30, 'NJ', 'New Jersey'),
(31, 'NM', 'New Mexico'),
(32, 'NY', 'New York'),
(33, 'NC', 'North Carolina'),
(34, 'ND', 'North Dakota'),
(35, 'OH', 'Ohio'),
(36, 'OK', 'Oklahoma'),
(37, 'OR', 'Oregon'),
(38, 'PA', 'Pennsylvania'),
(39, 'RI', 'Rhode Island'),
(40, 'SC', 'South Carolina'),
(41, 'SD', 'South Dakota'),
(42, 'TN', 'Tennessee'),
(43, 'TX', 'Texas'),
(44, 'UT', 'Utah'),
(45, 'VT', 'Vermont'),
(46, 'VA', 'Virginia'),
(47, 'WA', 'Washington'),
(48, 'WV', 'West Virginia'),
(49, 'WI', 'Wisconsin'),
(50, 'WY', 'Wyoming'),
(51, 'AS', 'American Samoa'),
(52, 'DC', 'District of Columbia'),
(53, 'FM', 'Federated States of Micronesia'),
(54, 'GU', 'Guam'),
(55, 'MH', 'Marshall Islands'),
(56, 'MP', 'Northern Mariana Islands'),
(57, 'PW', 'Palau'),
(58, 'PR', 'Puerto Rico'),
(59, 'VI', 'Virgin Islands'),
(60, 'AE', 'Armed Forces Africa'),
(61, 'AA', 'Armed Forces Americas'),
(62, 'AE', 'Armed Forces Canada'),
(63, 'AE', 'Armed Forces Europe'),
(64, 'AE', 'Armed Forces Middle East'),
(65, 'AP', 'Armed Forces Pacific');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(10) UNSIGNED NOT NULL,
  `employee_uuid` char(36) DEFAULT NULL,
  `employee_fname` varchar(30) DEFAULT NULL,
  `employee_lname` varchar(30) DEFAULT NULL,
  `employee_mname` varchar(30) DEFAULT NULL,
  `employee_prefix` int(10) UNSIGNED DEFAULT NULL,
  `employee_suffix` int(10) UNSIGNED DEFAULT NULL,
  `employee_dob` date DEFAULT NULL,
  `employee_addr_1` varchar(45) DEFAULT NULL,
  `employee_addr_2` varchar(45) DEFAULT NULL,
  `employee_city` varchar(45) DEFAULT NULL,
  `employee_state` int(10) UNSIGNED DEFAULT NULL,
  `employee_postcode` varchar(6) DEFAULT NULL,
  `employee_country` int(10) UNSIGNED DEFAULT NULL,
  `employee_home_phone` varchar(20) DEFAULT NULL,
  `employee_mobile_phone` varchar(20) DEFAULT NULL,
  `employee_hiredate` date DEFAULT NULL,
  `employee_acl` varchar(45) DEFAULT NULL,
  `employee_status` tinyint(4) DEFAULT NULL,
  `employee_subscription` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='employee - A table containing all the information related to an employee.';

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_uuid`, `employee_fname`, `employee_lname`, `employee_mname`, `employee_prefix`, `employee_suffix`, `employee_dob`, `employee_addr_1`, `employee_addr_2`, `employee_city`, `employee_state`, `employee_postcode`, `employee_country`, `employee_home_phone`, `employee_mobile_phone`, `employee_hiredate`, `employee_acl`, `employee_status`, `employee_subscription`) VALUES
(1, NULL, 'Sami', 'Mized', 'Lutfi', 1, 1, '1982-07-21', NULL, NULL, NULL, NULL, NULL, NULL, '321-735-0000', '321-544-2856', '2000-01-22', NULL, 1, 1),
(2, NULL, 'Laura', 'Varley', 'Anne', 2, 1, '1985-05-25', '123 Any Street', NULL, 'Cape Canaveral', 23, '32920', 34, NULL, NULL, NULL, NULL, 1, NULL),
(3, NULL, 'Test', 'Alpha', '', 1, 1, '2017-09-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30', NULL, 1, 0),
(4, NULL, 'Test', 'Beta', '', 1, 1, '2017-09-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30', NULL, 1, 0),
(5, NULL, 'Test', 'Gamma', '', 1, 1, '2017-09-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30', NULL, 1, 0),
(6, NULL, 'Test', 'Delta', '', 1, 1, '2017-09-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30', NULL, 1, 0),
(7, NULL, 'Test', 'Epislon', '', 1, 1, '2017-09-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30', NULL, 1, 0),
(8, NULL, 'Test', 'Zeta', '', 1, 1, '2017-09-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30', NULL, 1, 0),
(9, NULL, 'Test', 'Chi', '', 1, 1, '2017-09-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-29', NULL, 1, 0),
(10, NULL, 'Test', 'Sigma', '', 1, 1, '2017-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-29', NULL, 1, 0),
(11, NULL, 'Test', 'Upsilon', '', 1, 1, '2017-09-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-24', NULL, 1, 0),
(12, NULL, 'Test', 'Theta', '', 1, 1, '2017-09-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-21', NULL, 1, 0),
(13, NULL, 'Test', 'Mu', '', 1, 1, '2017-09-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-28', NULL, 1, 0),
(14, NULL, 'Test', 'Iota', '', 1, 1, '2017-09-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-19', NULL, 1, 0),
(15, NULL, 'Test', 'Lambda', '', 1, 1, '2017-09-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-27', NULL, 1, 0),
(16, NULL, 'Test', 'Xi', '', 1, 1, '2017-09-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-28', NULL, 1, 0),
(17, NULL, 'Jerry', 'O\'neil', 'Larry', 1, 5, '2017-09-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30', NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `common_countries`
--
ALTER TABLE `common_countries`
  ADD PRIMARY KEY (`common_countries_id`);

--
-- Indexes for table `common_prefix`
--
ALTER TABLE `common_prefix`
  ADD PRIMARY KEY (`common_prefix_id`);

--
-- Indexes for table `common_suffix`
--
ALTER TABLE `common_suffix`
  ADD PRIMARY KEY (`common_suffix_id`);

--
-- Indexes for table `common_usstates`
--
ALTER TABLE `common_usstates`
  ADD PRIMARY KEY (`common_usstates_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_uuid_UNIQUE` (`employee_uuid`),
  ADD KEY `fk_common_usstates_state_idx` (`employee_state`),
  ADD KEY `fk_common_countries_country_idx` (`employee_country`),
  ADD KEY `fk_employee-prefix_idx` (`employee_prefix`),
  ADD KEY `fk_employee-suffix_idx` (`employee_suffix`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `common_countries`
--
ALTER TABLE `common_countries`
  MODIFY `common_countries_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;
--
-- AUTO_INCREMENT for table `common_prefix`
--
ALTER TABLE `common_prefix`
  MODIFY `common_prefix_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `common_suffix`
--
ALTER TABLE `common_suffix`
  MODIFY `common_suffix_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `common_usstates`
--
ALTER TABLE `common_usstates`
  MODIFY `common_usstates_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_employee-country` FOREIGN KEY (`employee_country`) REFERENCES `common_countries` (`common_countries_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee-prefix` FOREIGN KEY (`employee_prefix`) REFERENCES `common_prefix` (`common_prefix_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_employee-state` FOREIGN KEY (`employee_state`) REFERENCES `common_usstates` (`common_usstates_id`) ON DELETE NO ACTION ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_employee-suffix` FOREIGN KEY (`employee_suffix`) REFERENCES `common_suffix` (`common_suffix_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
