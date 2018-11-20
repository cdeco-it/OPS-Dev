-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2018 at 10:03 PM
-- Server version: 5.7.14-log
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
-- Table structure for table `addr`
--

CREATE TABLE `addr` (
  `addr_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for an address entry.',
  `addr_prefix` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key.  Defines a formal title name prefix.  References ''common_prefix_id'' from table ''common_prefix''. (RF)',
  `addr_fname` varchar(30) DEFAULT NULL COMMENT 'Defines the first name of the entry. (RF)',
  `addr_lname` varchar(30) DEFAULT NULL COMMENT 'Defines the last name of the entry. (RF)',
  `addr_mname` varchar(30) DEFAULT NULL COMMENT 'Defines the middle name of the entry (Optional field)',
  `addr_nname` varchar(30) DEFAULT NULL COMMENT 'Defines a nickname or alternate common name for the entry.',
  `addr_suffix` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key.  Defines a common naming suffix.  References ''common_suffix_id'' from the table ''common_suffix''',
  `addr_title` varchar(100) DEFAULT NULL COMMENT 'Defines the official job title of the subject.',
  `addr_org_id` int(10) UNSIGNED DEFAULT NULL,
  `addr_address_1` varchar(255) DEFAULT NULL COMMENT 'Defines the primary address of the entry.',
  `addr_address_2` varchar(255) DEFAULT NULL COMMENT 'Defines any additional address information of the entry',
  `addr_city` varchar(255) DEFAULT NULL COMMENT 'Defines the city of the entry',
  `addr_state` int(10) UNSIGNED DEFAULT NULL COMMENT 'Defines the state of an entry',
  `addr_postcode` varchar(10) DEFAULT NULL COMMENT 'Defines the post code of an entry',
  `addr_country` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key.  Defines the country of the entry.  Referenced ''common_countries_id'' from table ''common_countries''.',
  `addr_lat` float(10,6) DEFAULT NULL,
  `addr_lng` float(10,6) DEFAULT NULL,
  `addr_org_phone` varchar(20) DEFAULT NULL COMMENT 'Defines the main phone number of entry.',
  `addr_org_phone_ext` varchar(20) DEFAULT NULL COMMENT 'Defines main phone number extension for entry.',
  `addr_org_fax` varchar(20) DEFAULT NULL COMMENT 'Define fax number for entry',
  `addr_direct` varchar(20) DEFAULT NULL COMMENT 'Defines a direct dial number for entry.',
  `addr_mobile` varchar(20) DEFAULT NULL COMMENT 'Defines a mobile phone number for entry.',
  `addr_email` varchar(255) DEFAULT NULL COMMENT 'Defines an email address for entry.',
  `addr_url` varchar(255) DEFAULT NULL COMMENT 'Defines a website for the entry.',
  `addr_admin_newsletter` tinyint(1) DEFAULT NULL COMMENT 'A flagging field to determin if the entry should recieve a newsletter.',
  `addr_admin_calendars` tinyint(1) DEFAULT NULL COMMENT 'A flagging field that will determine if a entry should recieve a end of year calendar mailing.',
  `addr_admin_gifts` tinyint(1) DEFAULT NULL COMMENT 'A flagging field to define if the entry should recieve an end of year gift mailing',
  `addr_type_vendor` tinyint(1) DEFAULT NULL COMMENT 'A flagging field to determin if the entry is a vendor.',
  `addr_type_client` tinyint(1) DEFAULT NULL COMMENT 'A flagging field to determine if the entry is a client.',
  `addr_type_consultant` tinyint(1) DEFAULT NULL COMMENT 'A flagging field to determine if an entry is a consultant',
  `addr_date_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `addr_date_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change was made to the entry.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='addr - Contains address book entries.  All related tables have ''addr'' prefix.';

--
-- Dumping data for table `addr`
--

INSERT INTO `addr` (`addr_id`, `addr_prefix`, `addr_fname`, `addr_lname`, `addr_mname`, `addr_nname`, `addr_suffix`, `addr_title`, `addr_org_id`, `addr_address_1`, `addr_address_2`, `addr_city`, `addr_state`, `addr_postcode`, `addr_country`, `addr_lat`, `addr_lng`, `addr_org_phone`, `addr_org_phone_ext`, `addr_org_fax`, `addr_direct`, `addr_mobile`, `addr_email`, `addr_url`, `addr_admin_newsletter`, `addr_admin_calendars`, `addr_admin_gifts`, `addr_type_vendor`, `addr_type_client`, `addr_type_consultant`, `addr_date_created`, `addr_date_updated`) VALUES
(1, 1, 'Bryan', 'Brotheridge', '', '', 1, 'Project Manager', 9, '8910 Astronaut Blvd.', 'Suite 206', 'Cape Canaveral', 9, '32920', 237, 28.398891, -80.613647, '321-543-5743', NULL, NULL, NULL, NULL, 'bbrotheridge@blueorigin.com', 'blueorigin.com', 0, 0, 0, 0, 1, 0, '2018-02-06 10:33:08', '2018-02-06 18:16:50'),
(2, 1, 'Sami', 'Mized', 'Lutfi', '', 1, 'Director Of It', 8, '915 E. Waikiki Dr.', NULL, 'Merritt Island', 9, '32953', 237, 28.372709, -80.693871, '321-799-2970', '104', '321-799-2970', '321-799-2970', '321-799-2970', 'samim@cdeco.com', 'cdeco.com', 1, 0, 0, 0, 1, 0, '2018-02-06 10:37:54', '2018-02-23 16:59:38'),
(3, 1, 'Jordan', 'Pupa', '', '', 1, 'Sales/marketing Consultant', 10, '505 Canal St.', NULL, 'New Smyrna Beach', 9, '32168', 237, 29.024061, -80.925812, '407-695-0299', NULL, NULL, NULL, '321-412-1579', 'jordan@promos4u.com', 'promos4u.com', 0, 0, 0, 1, 0, 0, '2018-02-06 11:03:19', '2018-02-06 18:17:19'),
(5, 1, 'Some', 'Guy', 'Test', 'Test', 1, 'Test', 9, '1150 Saint George Rd', NULL, 'Merritt Island', 9, '32952-6149', 237, 28.295624, -80.678513, '321-544-2856', NULL, '321-544-2856', '321-544-2856', '321-544-2856', 'punk0mi@gmail.com', 'gmail.com', 1, 0, 0, 0, 1, 0, '2018-02-07 17:02:03', '2018-02-23 16:57:56'),
(6, 1, 'Lutfi', 'Mized', '', 'Lou', 8, 'President', 8, '775 E. Merritt Island Cswy.', 'Suite 230', 'Merritt Island', 9, '32952', 237, 28.356569, -80.688263, '321-799-0375', '103', '321-799-0375', NULL, '321-258-4140', 'lutfim@cdeco.com', 'cdeco.com', 0, 0, 0, 0, 0, 0, '2018-02-19 16:13:24', '2018-02-23 16:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `addr_orgs`
--

CREATE TABLE `addr_orgs` (
  `addr_orgs_id` int(10) UNSIGNED NOT NULL,
  `addr_orgs_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addr_orgs`
--

INSERT INTO `addr_orgs` (`addr_orgs_id`, `addr_orgs_name`) VALUES
(1, 'Test Alpha'),
(2, 'Test Beta'),
(3, 'Test Gamma'),
(5, 'Test Delta'),
(6, 'Test Eta'),
(7, 'Test Zeta'),
(8, 'Cape Design Engineering Co.'),
(9, 'Blue Origin'),
(10, 'Promos4u Printing & Promotional Products'),
(11, 'No No No');

-- --------------------------------------------------------

--
-- Table structure for table `common_cons_milestones`
--

CREATE TABLE `common_cons_milestones` (
  `common_cons_milestones_id` int(10) UNSIGNED NOT NULL,
  `common_cons_milestones_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_cons_milestones - A lookup table of the most common construction milestones for construction.';

--
-- Dumping data for table `common_cons_milestones`
--

INSERT INTO `common_cons_milestones` (`common_cons_milestones_id`, `common_cons_milestones_desc`) VALUES
(1, 'Date Contract Issued'),
(2, 'Submittals Due'),
(3, 'Long Lead Items Due'),
(4, 'NTP Issued'),
(5, 'SOV Due'),
(6, 'Schedule Due'),
(7, 'Closeout Date'),
(8, 'Completion Date'),
(9, 'Contract Modification');

-- --------------------------------------------------------

--
-- Table structure for table `common_countries`
--

CREATE TABLE `common_countries` (
  `common_countries_id` int(10) UNSIGNED NOT NULL,
  `common_countries_abbr` varchar(2) DEFAULT NULL,
  `common_countries_full` varchar(80) DEFAULT NULL,
  `common_countries_proper` varchar(80) DEFAULT NULL,
  `common_countries_iso3` char(3) DEFAULT NULL,
  `common_countries_numcode` smallint(6) DEFAULT NULL,
  `common_countries_phonecode` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_countries - A lookup table holding two letter abbreviations and full spelings of countries throughout the world.';

--
-- Dumping data for table `common_countries`
--

INSERT INTO `common_countries` (`common_countries_id`, `common_countries_abbr`, `common_countries_full`, `common_countries_proper`, `common_countries_iso3`, `common_countries_numcode`, `common_countries_phonecode`) VALUES
(1, 'AF', 'Afghanistan', 'Afghanistan', 'AFG', 4, 93),
(2, 'AX', 'Aland Islands', 'Aland Islands', 'ALA', 248, 358),
(3, 'AL', 'Albania', 'Albania', 'ALB', 8, 355),
(4, 'DZ', 'Algeria', 'Algeria', 'DZA', 12, 213),
(5, 'AS', 'American Samoa', 'American Samoa', 'ASM', 16, NULL),
(6, 'AD', 'Andorra', 'Andorra', 'AND', 20, 376),
(7, 'AO', 'Angola', 'Angola', 'AGO', 24, 244),
(8, 'AI', 'Anguilla', 'Anguilla', 'AIA', 660, NULL),
(9, 'AQ', 'Antarctica', 'Antarctica', 'ATA', 10, NULL),
(10, 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda', 'ATG', 28, NULL),
(11, 'AR', 'Argentina', 'Argentina', 'ARG', 32, 54),
(12, 'AM', 'Armenia', 'Armenia', 'ARM', 51, 374),
(13, 'AW', 'Aruba', 'Aruba', 'ABW', 533, 297),
(14, 'AU', 'Australia', 'Australia', 'AUS', 36, 61),
(15, 'AT', 'Austria', 'Austria', 'AUT', 40, 43),
(16, 'AZ', 'Azerbaijan', 'Azerbaijan', 'AZE', 31, 994),
(17, 'BS', 'Bahamas', 'Bahamas', 'BHS', 44, NULL),
(18, 'BH', 'Bahrain', 'Bahrain', 'BHR', 48, 973),
(19, 'BD', 'Bangladesh', 'Bangladesh', 'BGD', 50, 880),
(20, 'BB', 'Barbados', 'Barbados', 'BRB', 52, NULL),
(21, 'BY', 'Belarus', 'Belarus', 'BLR', 112, 375),
(22, 'BE', 'Belgium', 'Belgium', 'BEL', 56, 32),
(23, 'BZ', 'Belize', 'Belize', 'BLZ', 84, 501),
(24, 'BJ', 'Benin', 'Benin', 'BEN', 204, 229),
(25, 'BM', 'Bermuda', 'Bermuda', 'BMU', 60, NULL),
(26, 'BT', 'Bhutan', 'Bhutan', 'BTN', 64, 975),
(27, 'BO', 'Bolivia, Plurinational State of', 'Bolivia', 'BOL', 68, 591),
(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', 'BES', 70, 599),
(29, 'BA', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'BWA', 72, 387),
(30, 'BW', 'Botswana', 'Botswana', 'BVT', 74, 267),
(31, 'BV', 'Bouvet Island', 'Bouvet Island', 'BRA', 76, NULL),
(32, 'BR', 'Brazil', 'Brazil', 'VGB', 92, 55),
(33, 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'IOT', 86, 246),
(34, 'BN', 'Brunei Darussalam', 'Brunei Darussalam', 'BRN', 96, 673),
(35, 'BG', 'Bulgaria', 'Bulgaria', 'BGR', 100, 359),
(36, 'BF', 'Burkina Faso', 'Burkina Faso', 'BFA', 854, 226),
(37, 'BI', 'Burundi', 'Burundi', 'BDI', 108, 257),
(38, 'KH', 'Cambodia', 'Cambodia', 'KHM', 116, 855),
(39, 'CM', 'Cameroon', 'Cameroon', 'CMR', 120, 237),
(40, 'CA', 'Canada', 'Canada', 'CAN', 124, NULL),
(41, 'CV', 'Cape Verde', 'Cape Verde', 'CPV', 132, 238),
(42, 'KY', 'Cayman Islands', 'Cayman Islands', 'CYM', 136, NULL),
(43, 'CF', 'Central African Republic', 'Central African Republic', 'CAF', 140, 236),
(44, 'TD', 'Chad', 'Chad', 'TCD', 148, 235),
(45, 'CL', 'Chile', 'Chile', 'CHL', 152, 56),
(46, 'CN', 'China', 'China', 'CHN', 156, 86),
(47, 'CX', 'Christmas Island', 'Christmas Island', 'CXR', 162, 61),
(48, 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'CCK', 166, 61),
(49, 'CO', 'Colombia', 'Colombia', 'COL', 170, 57),
(50, 'KM', 'Comoros', 'Comoros', 'COM', 174, 269),
(51, 'CG', 'Congo', 'Congo', 'COG', 178, 242),
(52, 'CD', 'Congo, the Democratic Republic of the', 'Congo DR', 'COD', 180, 243),
(53, 'CK', 'Cook Islands', 'Cook Islands', 'COK', 184, 682),
(54, 'CR', 'Costa Rica', 'Costa Rica', 'CRI', 188, 506),
(55, 'CI', 'Cote d\'Ivoire', 'Cote d\'Ivoire', 'CIV', 384, 225),
(56, 'HR', 'Croatia', 'Croatia', 'HRV', 191, 385),
(57, 'CU', 'Cuba', 'Cuba', 'CUB', 192, 53),
(58, 'CW', 'Curacao', 'Curacao', 'CUW', 531, 599),
(59, 'CY', 'Cyprus', 'Cyprus', 'CYP', 196, 357),
(60, 'CZ', 'Czech Republic', 'Czech Republic', 'CZE', 203, 420),
(61, 'DK', 'Denmark', 'Denmark', 'DNK', 208, 45),
(62, 'DJ', 'Djibouti', 'Djibouti', 'DJI', 262, 253),
(63, 'DM', 'Dominica', 'Dominica', 'DMA', 212, NULL),
(64, 'DO', 'Dominican Republic', 'Dominican Republic', 'DOM', 214, NULL),
(65, 'EC', 'Ecuador', 'Ecuador', 'ECU', 218, 593),
(66, 'EG', 'Egypt', 'Egypt', 'EGY', 818, 20),
(67, 'SV', 'El Salvador', 'El Salvador', 'SLV', 222, 503),
(68, 'GQ', 'Equatorial Guinea', 'Equatorial Guinea', 'GNQ', 226, 240),
(69, 'ER', 'Eritrea', 'Eritrea', 'ERI', 232, 291),
(70, 'EE', 'Estonia', 'Estonia', 'EST', 233, 372),
(71, 'ET', 'Ethiopia', 'Ethiopia', 'ETH', 231, 251),
(72, 'FK', 'Falkland Islands (Malvinas)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(73, 'FO', 'Faroe Islands', 'Faroe Islands', 'FRO', 234, 298),
(74, 'FJ', 'Fiji', 'Fiji', 'FJI', 242, 679),
(75, 'FI', 'Finland', 'Finland', 'FIN', 246, 358),
(76, 'FR', 'France', 'France', 'FRA', 250, 33),
(77, 'GF', 'French Guiana', 'French Guiana', 'GUF', 254, 594),
(78, 'PF', 'French Polynesia', 'French Polynesia', 'PYF', 258, 689),
(79, 'TF', 'French Southern Territories', 'French Southern Territories', 'ATF', 260, 262),
(80, 'GA', 'Gabon', 'Gabon', 'GAB', 266, 241),
(81, 'GM', 'Gambia', 'Gambia', 'GMB', 270, 220),
(82, 'GE', 'Georgia', 'Georgia', 'GEO', 268, 995),
(83, 'DE', 'Germany', 'Germany', 'DEU', 276, 49),
(84, 'GH', 'Ghana', 'Ghana', 'GHA', 288, 233),
(85, 'GI', 'Gibraltar', 'Gibraltar', 'GIB', 292, 350),
(86, 'GR', 'Greece', 'Greece', 'GRC', 300, 30),
(87, 'GL', 'Greenland', 'Greenland', 'GRL', 304, 299),
(88, 'GD', 'Grenada', 'Grenada', 'GRD', 308, NULL),
(89, 'GP', 'Guadeloupe', 'Guadeloupe', 'GLP', 312, 590),
(90, 'GU', 'Guam', 'Guam', 'GUM', 316, NULL),
(91, 'GT', 'Guatemala', 'Guatemala', 'GTM', 320, 502),
(92, 'GG', 'Guernsey', 'Guernsey', 'GGY', 831, 44),
(93, 'GN', 'Guinea', 'Guinea', 'GIN', 324, 224),
(94, 'GW', 'Guinea-Bissau', 'Guinea-Bissau', 'GNB', 624, 245),
(95, 'GY', 'Guyana', 'Guyana', 'GUY', 328, 592),
(96, 'HT', 'Haiti', 'Haiti', 'HTI', 332, 509),
(97, 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'HMD', 334, 0),
(98, 'VA', 'Holy See (Vatican City State)', 'Vatican City', 'VAT', 336, 379),
(99, 'HN', 'Honduras', 'Honduras', 'HND', 340, 504),
(100, 'HK', 'Hong Kong, SAR', 'Hong Kong', 'HKG', 344, 852),
(101, 'HU', 'Hungary', 'Hungary', 'HUN', 348, 36),
(102, 'IS', 'Iceland', 'Iceland', 'ISL', 352, 354),
(103, 'IN', 'India', 'India', 'IND', 356, 91),
(104, 'ID', 'Indonesia', 'Indonesia', 'IDN', 360, 62),
(105, 'IR', 'Iran, Islamic Republic of', 'Iran', 'IRN', 364, 98),
(106, 'IQ', 'Iraq', 'Iraq', 'IRQ', 368, 964),
(107, 'IE', 'Ireland', 'Ireland', 'IRL', 372, 353),
(108, 'IM', 'Isle of Man', 'Isle of Man', 'IMN', 833, 44),
(109, 'IL', 'Israel', 'Israel', 'ISR', 376, 972),
(110, 'IT', 'Italy', 'Italy', 'ITA', 380, 39),
(111, 'JM', 'Jamaica', 'Jamaica', 'JAM', 388, NULL),
(112, 'JP', 'Japan', 'Japan', 'JPN', 392, 81),
(113, 'JE', 'Jersey', 'Jersey', 'JEY', 832, 44),
(114, 'JO', 'Jordan', 'Jordan', 'JOR', 400, 962),
(115, 'KZ', 'Kazakhstan', 'Kazakhstan', 'KAZ', 398, 7),
(116, 'KE', 'Kenya', 'Kenya', 'KEN', 404, 254),
(117, 'KI', 'Kiribati', 'Kiribati', 'KIR', 296, 686),
(118, 'KP', 'Korea, Democratic People\'s Republic of', 'North Korea', 'PRK', 408, 850),
(119, 'KR', 'Korea, Republic of', 'South Korea', 'KOR', 410, 82),
(120, 'KW', 'Kuwait', 'Kuwait', 'KWT', 414, 965),
(121, 'KG', 'Kyrgyzstan', 'Kyrgyzstan', 'KGZ', 417, 996),
(122, 'LA', 'Lao, People\'s Democratic Republic of', 'Laos', 'LAO', 418, 856),
(123, 'LV', 'Latvia', 'Latvia', 'LVA', 428, 371),
(124, 'LB', 'Lebanon', 'Lebanon', 'LBN', 422, 961),
(125, 'LS', 'Lesotho', 'Lesotho', 'LSO', 426, 266),
(126, 'LR', 'Liberia', 'Liberia', 'LBR', 430, 231),
(127, 'LY', 'Libya', 'Libya', 'LBY', 434, 218),
(128, 'LI', 'Liechtenstein', 'Liechtenstein', 'LIE', 438, 423),
(129, 'LT', 'Lithuania', 'Lithuania', 'LTU', 440, 370),
(130, 'LU', 'Luxembourg', 'Luxembourg', 'LUX', 442, 352),
(131, 'MO', 'Macao, Special Administrative Region', 'Macao', 'MAC', 446, 853),
(132, 'MK', 'Macedonia, Republic of', 'Macedonia', 'MKD', 807, 389),
(133, 'MG', 'Madagascar', 'Madagascar', 'MDG', 450, 261),
(134, 'MW', 'Malawi', 'Malawi', 'MWI', 454, 265),
(135, 'MY', 'Malaysia', 'Malaysia', 'MYS', 458, 80),
(136, 'MV', 'Maldives', 'Maldives', 'MDV', 462, 960),
(137, 'ML', 'Mali', 'Mali', 'MLI', 466, 223),
(138, 'MT', 'Malta', 'Malta', 'MLT', 470, 356),
(139, 'MH', 'Marshall Islands', 'Marshall Islands', 'MHL', 584, 692),
(140, 'MQ', 'Martinique', 'Martinique', 'MTQ', 474, 596),
(141, 'MR', 'Mauritania', 'Mauritania', 'MRT', 478, 222),
(142, 'MU', 'Mauritius', 'Mauritius', 'MUS', 480, 230),
(143, 'YT', 'Mayotte', 'Mayotte', 'MYT', 175, 262),
(144, 'MX', 'Mexico', 'Mexico', 'MEX', 484, 52),
(145, 'FM', 'Micronesia, Federated States of', 'Micronesia', 'FSM', 583, 691),
(146, 'MD', 'Moldova, Republic of', 'Moldova', 'MDA', 498, 373),
(147, 'MC', 'Monaco', 'Monaco', 'MCO', 492, 377),
(148, 'MN', 'Mongolia', 'Mongolia', 'MNG', 496, 976),
(149, 'ME', 'Montenegro', 'Montenegro', 'MNE', 499, 382),
(150, 'MS', 'Montserrat', 'Montserrat', 'MSR', 500, NULL),
(151, 'MA', 'Morocco', 'Morocco', 'MAR', 504, 212),
(152, 'MZ', 'Mozambique', 'Mozambique', 'MOZ', 508, 258),
(153, 'MM', 'Myanmar', 'Myanmar', 'MMR', 104, 95),
(154, 'NA', 'Namibia', 'Namibia', 'NAM', 516, 264),
(155, 'NR', 'Nauru', 'Nauru', 'NRU', 520, 674),
(156, 'NP', 'Nepal', 'Nepal', 'NPL', 524, 977),
(157, 'NL', 'Netherlands', 'Netherlands', 'NLD', 528, 31),
(158, 'AN', 'Netherlands Antilles', 'Netherlands Antilles', 'ANT', 530, 599),
(159, 'NC', 'New Caledonia', 'New Caledonia', 'NCL', 540, 687),
(160, 'NZ', 'New Zealand', 'New Zealand', 'NZL', 554, 64),
(161, 'NI', 'Nicaragua', 'Nicaragua', 'NIC', 558, 505),
(162, 'NE', 'Niger', 'Niger', 'NER', 562, 227),
(163, 'NG', 'Nigeria', 'Nigeria', 'NGA', 566, 234),
(164, 'NU', 'Niue', 'Niue', 'NIU', 570, 683),
(165, 'NF', 'Norfolk Island', 'Norfolk Island', 'NFK', 574, 672),
(166, 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands', 'MNP', 580, NULL),
(167, 'NO', 'Norway', 'Norway', 'NOR', 578, 47),
(168, 'OM', 'Oman', 'Oman', 'OMN', 512, 968),
(169, 'PK', 'Pakistan', 'Pakistan', 'PAK', 586, 92),
(170, 'PW', 'Palau', 'Palau', 'PLW', 585, 680),
(171, 'PS', 'Palestine, State of', 'Palestine', 'PSE', 275, 970),
(172, 'PA', 'Panama', 'Panama', 'PAN', 591, 507),
(173, 'PG', 'Papua New Guinea', 'Papua New Guinea', 'PNG', 598, 675),
(174, 'PY', 'Paraguay', 'Paraguay', 'PRY', 600, 595),
(175, 'PE', 'Peru', 'Peru', 'PER', 604, 51),
(176, 'PH', 'Philippines', 'Philippines', 'PHL', 608, 63),
(177, 'PN', 'Pitcairn', 'Pitcairn', 'PCN', 612, 870),
(178, 'PL', 'Poland', 'Poland', 'POL', 616, 48),
(179, 'PT', 'Portugal', 'Portugal', 'PRT', 620, 351),
(180, 'PR', 'Puerto Rico', 'Puerto Rico', 'PRI', 630, NULL),
(181, 'QA', 'Qatar', 'Qatar', 'QAT', 634, 974),
(182, 'RE', 'Reunion', 'Reunion', 'REU', 638, 262),
(183, 'RO', 'Romania', 'Romania', 'ROU', 642, 40),
(184, 'RU', 'Russian Federation', 'Russia', 'RUS', 643, 7),
(185, 'RW', 'Rwanda', 'Rwanda', 'RWA', 646, 250),
(186, 'BL', 'Saint Barthelemy', 'Saint Barthelemy', 'BLM', 652, 590),
(187, 'SH', 'Saint Helena, Ascension and Tristan da Cunha', 'Saint Helena, Ascension and Tristan da Cunha', 'SHN', 654, 290),
(188, 'KN', 'Saint Kitts and Nevis', 'Saint Kitts and Nevis', 'KNA', 659, NULL),
(189, 'LC', 'Saint Lucia', 'Saint Lucia', 'LCA', 662, NULL),
(190, 'MF', 'Saint Martin (French part)', 'Saint Martin (French)', 'MAF', 663, 590),
(191, 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(192, 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'VCT', 670, NULL),
(193, 'WS', 'Samoa', 'Samoa', 'WSM', 882, 685),
(194, 'SM', 'San Marino', 'San Marino', 'SMR', 674, 378),
(195, 'ST', 'Sao Tome and Principe', 'Sao Tome and Principe', 'STP', 678, 239),
(196, 'SA', 'Saudi Arabia, Kingdom of', 'Saudi Arabia', 'SAU', 682, 966),
(197, 'SN', 'Senegal', 'Senegal', 'SEN', 686, 221),
(198, 'RS', 'Serbia', 'Serbia', 'SRB', 688, 381),
(199, 'SC', 'Seychelles', 'Seychelles', 'SYC', 690, 248),
(200, 'SL', 'Sierra Leone', 'Sierra Leone', 'SLE', 694, 232),
(201, 'SG', 'Singapore', 'Singapore', 'SGP', 702, 65),
(202, 'SX', 'Sint Maarten (Dutch part)', 'Sint Maarten (Dutch)', 'SXM', 534, NULL),
(203, 'SK', 'Slovakia', 'Slovakia', 'SVK', 703, 421),
(204, 'SI', 'Slovenia', 'Slovenia', 'SVN', 705, 386),
(205, 'SB', 'Solomon Islands', 'Solomon Islands', 'SLB', 90, 677),
(206, 'SO', 'Somalia', 'Somalia', 'SOM', 706, 252),
(207, 'ZA', 'South Africa', 'South Africa', 'ZAF', 710, 27),
(208, 'GS', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'SGS', 239, 500),
(209, 'SS', 'South Sudan', 'South Sudan', 'SSD', 728, 211),
(210, 'ES', 'Spain', 'Spain', 'ESP', 724, 34),
(211, 'LK', 'Sri Lanka', 'Sri Lanka', 'LKA', 144, 94),
(212, 'SD', 'Sudan', 'Sudan', 'SDN', 736, 249),
(213, 'SR', 'Suriname', 'Suriname', 'SUR', 740, 597),
(214, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(215, 'SZ', 'Swaziland', 'Swaziland', 'SWZ', 748, 268),
(216, 'SE', 'Sweden', 'Sweden', 'SWE', 752, 46),
(217, 'CH', 'Switzerland', 'Switzerland', 'CHE', 756, 41),
(218, 'SY', 'Syrian Arab Republic', 'Syria', 'SYR', 760, 963),
(219, 'TW', 'Taiwan, Province of China', 'Taiwan', 'TWN', 158, 886),
(220, 'TJ', 'Tajikistan', 'Tajikistan', 'TJK', 762, 992),
(221, 'TZ', 'Tanzania, United Republic of', 'Tanzania', 'TZA', 834, 255),
(222, 'TH', 'Thailand', 'Thailand', 'THA', 764, 66),
(223, 'TL', 'Timor-Leste', 'Timor-Leste', 'TLS', 626, 670),
(224, 'TG', 'Togo', 'Togo', 'TGO', 768, 228),
(225, 'TK', 'Tokelau', 'Tokelau', 'TKL', 772, 690),
(226, 'TO', 'Tonga', 'Tonga', 'TON', 776, 676),
(227, 'TT', 'Trinidad and Tobago', 'Trinidad and Tobago', 'TTO', 780, NULL),
(228, 'TN', 'Tunisia', 'Tunisia', 'TUN', 788, 216),
(229, 'TR', 'Turkey', 'Turkey', 'TUR', 792, 90),
(230, 'TM', 'Turkmenistan', 'Turkmenistan', 'TKM', 795, 993),
(231, 'TC', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'TCA', 796, NULL),
(232, 'TV', 'Tuvalu', 'Tuvalu', 'TUV', 798, 688),
(233, 'UG', 'Uganda', 'Uganda', 'UGA', 800, 256),
(234, 'UA', 'Ukraine', 'Ukraine', 'UKR', 804, 380),
(235, 'AE', 'United Arab Emirates', 'United Arab Emirates', 'ARE', 784, 971),
(236, 'GB', 'United Kingdom', 'United Kingdom', 'GBR', 826, 44),
(237, 'US', 'United States', 'United States', 'USA', 840, NULL),
(238, 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'UMI', 581, NULL),
(239, 'UY', 'Uruguay', 'Uruguay', 'URY', 858, 598),
(240, 'UZ', 'Uzbekistan', 'Uzbekistan', 'UZB', 860, 998),
(241, 'VU', 'Vanuatu', 'Vanuatu', 'VUT', 548, 678),
(242, 'VE', 'Venezuela, Bolivarian Republic of', 'Venezuela', 'VEN', 862, 58),
(243, 'VN', 'Viet Nam', 'Viet Nam', 'VNM', 704, 84),
(244, 'VG', 'Virgin Islands, British', 'British Virgin Islands', 'VGB', 92, NULL),
(245, 'VI', 'Virgin Islands, U.S.', 'US Virgin Islands', 'VIR', 850, NULL),
(246, 'WF', 'Wallis and Futuna', 'Wallis and Futuna', 'WLF', 876, 681),
(247, 'EH', 'Western Sahara', 'Western Sahara', 'ESH', 732, 212),
(248, 'YE', 'Yemen', 'Yemen', 'YEM', 887, 967),
(249, 'ZM', 'Zambia', 'Zambia', 'ZMB', 894, 260),
(250, 'ZW', 'Zimbabwe', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `common_eng_milestones`
--

CREATE TABLE `common_eng_milestones` (
  `common_eng_milestones_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a common engineering milestone label.',
  `common_eng_milestones_desc` varchar(255) DEFAULT NULL COMMENT 'Defines the actual label value of the engineering milestone.',
  `common_eng_milestones_group` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_eng_milestones - A lookup table of the most common engineering milestones for work.';

--
-- Dumping data for table `common_eng_milestones`
--

INSERT INTO `common_eng_milestones` (`common_eng_milestones_id`, `common_eng_milestones_desc`, `common_eng_milestones_group`) VALUES
(1, 'Notice to Proceed', 0),
(2, '15% Redlines Due', 15),
(3, '15% All stop for QC', 15),
(4, '15% QC Completion Date', 15),
(5, '15% Due to Client', 15),
(6, '15% Design Review Meeting', 15),
(7, 'Schematic Redlines Due', 17),
(8, 'Schematic All stop for QC', 17),
(9, 'Schematic QC Completion Date', 17),
(10, 'Schematic Due to Client', 17),
(11, 'Schematic Design Review Meeting', 17),
(12, '30% Redlines Due', 30),
(13, '30% All stop for QC', 30),
(14, '30% QC Completion Date', 30),
(15, '30% Due to Client', 30),
(16, '30% Design Review Meeting', 30),
(17, '35% Redlines Due', 35),
(18, '35% All stop for QC', 35),
(19, '35% QC Completion Date', 35),
(20, '35% Due to Client', 35),
(21, '35% Design Review Meeting', 35),
(22, '40% Redlines Due', 40),
(23, '40% All stop for QC', 40),
(24, '40% QC Completion Date', 40),
(25, '40% Due to Client', 40),
(26, '40% Design Review Meeting', 40),
(27, '45% Redlines Due', 45),
(28, '45% All stop for QC', 45),
(29, '45% QC Completion Date', 45),
(30, '45% Due to Client', 45),
(31, '45% Design Review Meeting', 45),
(32, '50% Redlines Due', 50),
(33, '50% All stop for QC', 50),
(34, '50% QC Completion Date', 50),
(35, '50% Due to Client', 50),
(36, '50% Design Review Meeting', 50),
(37, '55% Redlines Due', 55),
(38, '55% All stop for QC', 55),
(39, '55% QC Completion Date', 55),
(40, '55% Due to Client', 55),
(41, '55% Design Review Meeting', 55),
(42, '60% Redlines Due', 60),
(43, '60% All stop for QC', 60),
(44, '60% QC Completion Date', 60),
(45, '60% Due to Client', 60),
(46, '60% Design Review Meeting', 60),
(47, '65% Redlines Due', 65),
(48, '65% All stop for QC', 65),
(49, '65% QC Completion Date', 65),
(50, '65% Due to Client', 65),
(51, '65% Design Review Meeting', 65),
(52, '70% Redlines Due', 70),
(53, '70% All stop for QC', 70),
(54, '70% QC Completion Date', 70),
(55, '70% Due to Client', 70),
(56, '70% Design Review Meeting', 70),
(57, '75% Redlines Due', 75),
(58, '75% All stop for QC', 75),
(59, '75% QC Completion Date', 75),
(60, '75% Due to Client', 75),
(61, '75% Design Review Meeting', 75),
(62, '80% Redlines Due', 80),
(63, '80% All stop for QC', 80),
(64, '80% QC Completion Date', 80),
(65, '80% Due to Client', 80),
(66, '80% Design Review Meeting', 80),
(67, '85% Redlines Due', 85),
(68, '85% All stop for QC', 85),
(69, '85% QC Completion Date', 85),
(70, '85% Due to Client', 85),
(71, '85% Design Review Meeting', 85),
(72, '90% Redlines Due', 90),
(73, '90% All stop for QC', 90),
(74, '90% QC Completion Date', 90),
(75, '90% Due to Client', 90),
(76, '90% Design Review Meeting', 90),
(77, '90% for Review Redlines Due', 90),
(78, '90% for Review All stop for QC', 90),
(79, '90% for Review QC Completion Date', 90),
(80, '90% for Review Due to Client', 90),
(81, '90% for Review Design Review Meeting', 90),
(82, '95% Redlines Due', 95),
(83, '95% All stop for QC', 95),
(84, '95% QC Completion Date', 95),
(85, '95% Due to Client', 95),
(86, '95% Design Review Meeting', 95),
(87, '100% Redlines Due', 100),
(88, '100% All stop for QC', 100),
(89, '100% QC Completion Date', 100),
(90, '100% Due to Client', 100),
(91, '100% Design Review Meeting', 100),
(92, '100% for Review Redlines Due', 100),
(93, '100% for Review All stop for QC', 100),
(94, '100% for Review QC Completion Date', 100),
(95, '100% for Review Due to Client', 100),
(96, '100% for Review Design Review Meeting', 100),
(97, 'Bid Set Redlines Due', 110),
(98, 'Bid Set All stop for QC', 110),
(99, 'Bid Set QC Completion Date', 110),
(100, 'Bid Set Due to Client', 110),
(101, 'Bid Set Design Review Meeting', 110),
(102, 'Permit Set Redlines Due', 110),
(103, 'Permit Set All stop for QC', 110),
(104, 'Permit Set QC Completion Date', 110),
(105, 'Permit Set Due to Client', 110),
(106, 'Permit Set Design Review Meeting', 110),
(107, 'Final Redlines Due', 120),
(108, 'Final All stop for QC', 120),
(109, 'Final QC Completion Date', 120),
(110, 'Final Due to Client', 120),
(111, 'Final Design Review Meeting', 120),
(112, 'Revision Redlines Due', 130),
(113, 'Revision All stop for QC', 130),
(114, 'Revision QC Completion Date', 130),
(115, 'Revision Due to Client', 130);

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
(1, 'Mr. ', 'Mr.'),
(2, 'Mrs. ', 'Mrs.'),
(3, 'Miss ', 'Miss'),
(4, 'Dr. ', 'Dr.'),
(5, 'Hon.', 'Honorable'),
(6, 'Prof.', 'Professor'),
(7, 'Rev.', 'Reverend'),
(8, 'Pvt.', 'Pvt (Army Private)'),
(9, 'Pv2. ', 'Pv2 (Army Private 2)'),
(10, 'PFC. ', 'PFC (Army Private 1 Class)'),
(11, 'Spc. ', 'Spc (Army Specialist)'),
(12, 'Cpl. ', 'Cpl (Army Corporal)'),
(13, 'Sgt. ', 'Sgt (Army Sergeant)'),
(14, 'SSg. ', 'Ssg (Army Staff Sgt.)'),
(15, 'Sfc. ', 'Sfc (Army Sgt. 1st Class)'),
(16, 'Msg. ', 'Msg (Army Master Sgt.)'),
(17, '1Sg. ', '1Sg (Army 1st Sgt.)'),
(18, 'Sgm. ', 'Sgm (AF Sgt. Maj.)'),
(19, 'CSM. ', 'CSM (AF Cmd. Sgt Maj.)'),
(20, 'SMA. ', 'SMA (AF Sgt. Maj. OTA)'),
(21, 'WO1.', 'WO1 (Army Warrant Ofc.)'),
(22, 'CW2.', 'CW2 (Army Chief Warrant Ofc. 2)'),
(23, 'CW3.', 'CW3 (Army Chief Warrant Ofc. 3)'),
(24, 'CW4.', 'CW4 (Army Chief Warrant Ofc. 4)'),
(25, 'CW5.', 'CW5 (Army Chief Warrant Ofc. 5)'),
(26, '2LT.', '2LT (Army 2nd Lieutenant)'),
(27, '1LT.', '1LT (Army 1st Lieutenant)'),
(28, 'Cpt. ', 'Cpt. (AF Captian)'),
(29, 'Maj. ', 'Maj. (AF Major)'),
(30, 'LTC.', 'LTC. (AF Lt. Colonel)'),
(31, 'Col. ', 'Col. (AF Colonel)'),
(32, 'BG. ', 'BG. (Army Brigadier Gen. 1 Star)'),
(33, 'MG. ', 'MG. (Army Maj. Gen. 2 Star)'),
(34, 'LTG. ', 'LTG. (Army Lt. Gen. 3 Star)'),
(35, 'Gen. ', 'Gen. (AF General 4 Star)'),
(36, 'SN. ', 'SN. (Navy Seaman)'),
(37, 'PO3.', 'PO3. (Navy Petty Ofc. 3rd)'),
(38, 'PO2.', 'PO2. (Navy Petty Ofc. 2nd)'),
(39, 'PO1. ', 'PO1. (Navy Petty Ofc. 1st)'),
(40, 'CPO. ', 'CPO. (Navy Chief Petty Ofc.)'),
(41, 'SCPO. ', 'SCPO. (Navy Sr. Chief Petty Ofc.)'),
(42, 'MCPO. ', 'MCPO. (Navy Master Ch. Petty Ofc.)'),
(43, 'MCPON. ', 'MCPON. (Navy Mas. Ch. Petty OTN)'),
(44, 'Ens. ', 'Ens. (Navy Ensign)'),
(45, 'LtJg. ', ' LtJG. (Navy Lt. Jr. Grade)'),
(46, 'Lt. ', 'Lt. (Navy Lieutenant)'),
(47, 'LCDR. ', 'LCDR. (Navy Lt. Cmdr.)'),
(48, 'CDR. ', 'CDR. (Navy Commander)'),
(49, 'Capt. ', 'Capt. (Navy Captian)'),
(50, 'RDML. ', 'RDML. (Navy Rear Adm. Lower - 1 Star)'),
(51, 'RADM. ', 'RADM. (Navy Rear Adm. Upper - 2 Star)'),
(52, 'VADM. ', 'VADM. (Navy Vice Adm. - 3Star)'),
(53, 'ADM. ', 'ADM. (Navy Adm. Chief of Ops. - 4 Star)'),
(54, 'Amn. ', 'Amn. (AF Airman)'),
(55, 'A1C. ', 'A1C (AF Airman 1 CLass)'),
(56, 'SrA. ', 'SrA. (AF Sr. Airman)'),
(57, 'SSgt. ', 'SSgt.(AF AF StaffSgt.)'),
(58, 'TSgt. ', 'Tsgt.(AF Tech. Staff Sgt.)'),
(59, 'MSgt. ', 'MSgt.(AF Mas. Sgt)'),
(60, 'SMSgt. ', 'SMSgt.(AF Sr. Master Staff Sgt.)'),
(61, 'CMSgt. ', 'CMSgt.(AF Chief Master Sgt.)'),
(62, 'CCM. ', 'CCM.(AF Cmdr. Chief Master Sgt.)'),
(63, 'CMSAF. ', 'CMSAF. (AF Chief Master Sgt OTAF)'),
(64, '2d Lt ', '2d Lt. (AF 2nd Lieutenant)'),
(65, '1st Lt ', '1st Lt (AF 1st Lieutenant)'),
(66, 'Brig. Gen. ', 'Brig. Gen. (AF Brigadier Gen. 1 Star)'),
(67, 'Maj. Gen. ', 'Maj. Gen. (AF Maj. Gen. 2 Star)'),
(68, 'Lt. Gen. ', 'Lt. Gen. (AF Lt. Gen. 3 Star)');

-- --------------------------------------------------------

--
-- Table structure for table `common_prop_milestones`
--

CREATE TABLE `common_prop_milestones` (
  `common_prop_milestones_id` int(10) UNSIGNED NOT NULL,
  `common_prop_milestones_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_prop_milestones - A lookup table of the most common proposal milestones for work.';

-- --------------------------------------------------------

--
-- Table structure for table `common_rfisub_responses`
--

CREATE TABLE `common_rfisub_responses` (
  `common_rfisub_responses_id` int(10) UNSIGNED NOT NULL,
  `common_rfisub_responses_type` int(1) DEFAULT NULL,
  `common_rfisub_responses_value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_rfisubs_responses - A lookup table containing the most typical RFI/Submittal responses.';

--
-- Dumping data for table `common_rfisub_responses`
--

INSERT INTO `common_rfisub_responses` (`common_rfisub_responses_id`, `common_rfisub_responses_type`, `common_rfisub_responses_value`) VALUES
(1, 1, 'In Progress'),
(2, 1, 'Answered'),
(3, 1, 'Recalled'),
(4, 2, 'In Progress'),
(5, 2, 'No Exception Taken'),
(6, 2, 'Rejected'),
(7, 2, 'Comments Attached'),
(8, 2, 'Note Markings'),
(9, 2, 'Submit Specified Item'),
(10, 2, 'Resubmit'),
(11, 2, 'Confirm in Writing'),
(12, 2, 'Respond in Days'),
(13, 2, 'Recalled'),
(14, 3, 'In Progress'),
(15, 3, 'Approved'),
(16, 3, 'Return for Correction and Resubmittal');

-- --------------------------------------------------------

--
-- Table structure for table `common_roles`
--

CREATE TABLE `common_roles` (
  `common_roles_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identified for a common role.',
  `common_roles_desc` varchar(255) DEFAULT NULL COMMENT 'Defines the label of a common role.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_roles - A lookup table containing the most common job roles held within the company for any type of work.';

--
-- Dumping data for table `common_roles`
--

INSERT INTO `common_roles` (`common_roles_id`, `common_roles_desc`) VALUES
(1, 'Project Manager'),
(2, 'Construction Manager'),
(3, 'Sr. Structural Engineer'),
(4, 'Structrural Engineer'),
(5, 'Structural Consultant'),
(6, 'Sr. Mechanical Engineer'),
(7, 'Mechanical Engineer'),
(8, 'Mechanical Consultant'),
(9, 'Sr. Electrical Engineer'),
(10, 'Electrical Engineer'),
(11, 'Electrical Consultant'),
(12, 'Sr. Plumbing Engineer'),
(13, 'Plumbing Engineer'),
(14, 'Plumbing Consultant'),
(15, 'Sr. Architect'),
(16, 'Architect'),
(17, 'Architect Consultant'),
(18, 'Sr. Civil Engineering'),
(19, 'Civil Engineer'),
(20, 'Civil Consultant'),
(21, 'LEED Manager'),
(22, 'Commissioning Professional'),
(23, 'Project Administrator'),
(24, 'Site Superintendant'),
(25, 'Construction Project Administrator'),
(26, 'T&B Consultant'),
(27, 'Interior Designer'),
(28, 'Landscape Architect'),
(29, 'Threshold Inspector'),
(30, 'Special Inspector'),
(31, 'Permitting Agent'),
(32, 'Speciality Consultant'),
(33, 'General Contractor');

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
-- Table structure for table `common_support_milestones`
--

CREATE TABLE `common_support_milestones` (
  `common_support_milestones_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  A uniquie identifier for a support milestone.',
  `common_support_milestones_desc` varchar(45) DEFAULT NULL COMMENT 'The descriptive value of a single milestone.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_support_milestones - A lookup table of the most common support  milestones for work.';

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
-- Table structure for table `common_work_tags`
--

CREATE TABLE `common_work_tags` (
  `common_work_tags_id` int(10) UNSIGNED NOT NULL,
  `common_work_tags_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='common_work_tags - A lookup table of the most common tags that associate a work item or work phase to a definition.';

--
-- Dumping data for table `common_work_tags`
--

INSERT INTO `common_work_tags` (`common_work_tags_id`, `common_work_tags_desc`) VALUES
(1, 'Design'),
(2, 'Construction');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Employee ID.',
  `employee_fname` varchar(30) DEFAULT NULL COMMENT 'Employee first name',
  `employee_lname` varchar(30) DEFAULT NULL COMMENT 'Employee last name',
  `employee_mname` varchar(30) DEFAULT NULL COMMENT 'Employee middle name (if any)',
  `employee_prefix` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to PREFIX table.  Name prefix.',
  `employee_suffix` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to SUFFIX table.  Name suffix',
  `employee_dob` date DEFAULT NULL COMMENT 'Date of Birth',
  `employee_addr_1` varchar(150) DEFAULT NULL COMMENT 'Address line 1',
  `employee_addr_2` varchar(150) DEFAULT NULL COMMENT 'Address Line 2',
  `employee_city` varchar(150) DEFAULT NULL COMMENT 'City',
  `employee_state` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to USSATES table. Address state.',
  `employee_postcode` varchar(6) DEFAULT NULL COMMENT 'Postcode',
  `employee_country` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign key to COUNTRIES table. Address country.',
  `employee_home_phone` varchar(20) DEFAULT NULL COMMENT 'Phone for home',
  `employee_mobile_phone` varchar(20) DEFAULT NULL COMMENT 'Phone for mobile',
  `employee_hiredate` date DEFAULT NULL COMMENT 'Date of hire.',
  `employee_acl` int(11) DEFAULT NULL COMMENT 'Foreign Key to ACL table.  ACL level is the access level at which an employee can go.',
  `employee_status` int(11) DEFAULT NULL COMMENT 'Foreign key to EMPLOYEE_STATUS table.  Defines the employees current status.',
  `employee_subscription` int(1) DEFAULT NULL COMMENT 'Does the employee want email subscription.',
  `employee_username` varchar(50) DEFAULT NULL COMMENT 'Generated username',
  `employee_password` varchar(60) DEFAULT NULL COMMENT 'Generated passwoed in BCRYPT format hash',
  `employee_created` datetime DEFAULT NULL COMMENT 'Initial creation date.',
  `employee_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='employee - A table containing all the information related to an employee.';

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_fname`, `employee_lname`, `employee_mname`, `employee_prefix`, `employee_suffix`, `employee_dob`, `employee_addr_1`, `employee_addr_2`, `employee_city`, `employee_state`, `employee_postcode`, `employee_country`, `employee_home_phone`, `employee_mobile_phone`, `employee_hiredate`, `employee_acl`, `employee_status`, `employee_subscription`, `employee_username`, `employee_password`, `employee_created`, `employee_modified`) VALUES
(1, 'Sami', 'Mized', 'Lutfi', 1, 1, '1982-07-21', '1150 St. George Rd.', NULL, 'Merritt Island', 9, '32952', 237, '321-544-2856', '321-544-2856', '2000-01-01', 1, 1, 0, 'samim', '$2y$10$pwWbwA3AuCtwOuExC4EKju1xXAkYDNdUiScU9gDeeRLSwWsU5SOwG', '2017-10-06 13:12:27', '2018-02-08 10:09:27'),
(2, 'John', 'Doe', 'Apple', 1, 8, '1985-01-01', '1234 Blah', NULL, 'Herp', 1, '12346', 237, '(321) 654-9870', '(987) 654-6540', '2002-02-02', 4, 1, 0, 'johnd', '$2y$10$epy1uZQQ1DVxO6ShY22XSO7L5KfdDhYeQYFzqjgjhh7An1OcjbUPO', '2017-10-06 16:38:16', '2017-10-10 16:50:07'),
(3, 'Jane', 'Doe', 'Lynn', 2, 8, '1986-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10', 4, 1, 0, 'janed', '$2y$10$q/WsIjatnUs67xkk7Pr05.UXKCA/tvPmYu8EPvUWmajmnIJhn/Qny', '2017-10-06 16:56:22', '2017-10-06 16:56:22'),
(4, 'Test', 'Ytest', 'Test', 1, 2, '2017-10-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-19', 4, 1, 0, 'testy', '$2y$10$t1a91ZCKQjcIFy1AOSH4suL009d9zQZuA//Zsf37nwLng3dCT73tq', '2017-10-26 16:07:24', '2017-10-26 16:07:24'),
(5, 'Larry', 'Johnson', 'Awea', 1, 11, '2017-10-12', '1150 St. George Rd.', NULL, 'Merritt Island', 9, '32952', 237, '321-544-2856', '321-544-2856', '2017-10-09', 4, 1, 0, 'testesssa', '$2y$10$CBVrBfi0KVh1p3hjCZboyufOBtd8mjVNXl93HaVqzNtb5A/93bI4i', '2017-10-26 16:07:44', '2018-02-08 15:29:44'),
(6, 'No', 'No', 'Sami', 1, 1, '2018-02-09', '123456', NULL, 'Here', 1, '32165', 237, NULL, '321-654-6544', '2018-02-21', 4, 1, 0, 'non', '$2y$10$3iM52j1Evvp.C7V0U5qGPeskMwvHm4fOm.YCE.2EiF1sFw9sC4//2', '2018-02-06 15:36:27', '2018-02-06 15:37:01'),
(7, 'Krutika', 'Kanfade', '', 3, 1, '1993-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-02-12', 4, 1, 0, 'krutikak', '$2y$10$XWu8QGmrBtNEZ2Rj80jeQ.bNOiuZrF700I.acThYXs7DdeL.6ZV6W', '2018-02-09 09:43:45', '2018-02-09 09:43:45'),
(8, 'Laura', 'Varley', 'Anne', 2, 1, '1985-04-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-06-10', 4, 1, 0, 'laurav', '$2y$10$VFl0TtHvLNbg.ISHmG0MWeaWRbkDvKmr44FWt7v96azjrBNLUyPrO', '2018-11-16 17:30:26', '2018-11-16 17:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `employee_status`
--

CREATE TABLE `employee_status` (
  `employee_status_id` int(11) NOT NULL,
  `employee_status_desc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='employee_status - A lookup table containing all employee statuses';

--
-- Dumping data for table `employee_status`
--

INSERT INTO `employee_status` (`employee_status_id`, `employee_status_desc`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'Consultant'),
(4, 'Disability');

-- --------------------------------------------------------

--
-- Table structure for table `security_acl_groups`
--

CREATE TABLE `security_acl_groups` (
  `security_acl_id` int(11) NOT NULL,
  `security_acl_desc` varchar(200) DEFAULT NULL,
  `security_acl_permission` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `security_acl_groups`
--

INSERT INTO `security_acl_groups` (`security_acl_id`, `security_acl_desc`, `security_acl_permission`) VALUES
(1, 'Root/Superuser', 'Root'),
(2, 'Management Level', 'Management Level'),
(3, 'Limited Administrative Access', 'Limited Administrative Access'),
(4, 'Basic Access', 'Basic Access');

-- --------------------------------------------------------

--
-- Table structure for table `security_sessions`
--

CREATE TABLE `security_sessions` (
  `security_sessions_id` bigint(20) NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `employee_acl` int(11) NOT NULL,
  `security_sessions_key` varchar(60) NOT NULL,
  `security_sessions_address` varchar(200) NOT NULL,
  `security_sessions_useragent` varchar(200) NOT NULL,
  `security_sessions_expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `security_sessions`
--

INSERT INTO `security_sessions` (`security_sessions_id`, `employee_id`, `employee_acl`, `security_sessions_key`, `security_sessions_address`, `security_sessions_useragent`, `security_sessions_expires`) VALUES
(8, 1, 1, 'r1fenme6fh62l788g6f7t91l71', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-10 15:23:22'),
(9, 1, 1, 'r1fenme6fh62l788g6f7t91l71', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-10 17:51:17'),
(10, 1, 1, 'esjl7h28m9qc8n7gu0r6lfhrn2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-12 10:14:34'),
(11, 1, 1, 'esjl7h28m9qc8n7gu0r6lfhrn2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-12 17:47:04'),
(12, 1, 1, 'a0t83qlv7t0dkfismm8nnl9n22', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-13 12:23:37'),
(13, 1, 1, '0lbtqjhq18q57a2an8gg3utpj0', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-16 13:02:12'),
(14, 1, 1, '0lbtqjhq18q57a2an8gg3utpj0', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-16 15:54:38'),
(15, 1, 1, 'vrp8kakm7riafcu4r6rrn9lh03', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-18 13:05:31'),
(16, 1, 1, 'vrp8kakm7riafcu4r6rrn9lh03', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-18 17:33:30'),
(17, 1, 1, 'b2hnd430qbfa66dvbo54u4ll53', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-19 10:51:16'),
(18, 1, 1, 'b2hnd430qbfa66dvbo54u4ll53', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-19 12:52:33'),
(19, 1, 1, 'b2hnd430qbfa66dvbo54u4ll53', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-19 17:34:57'),
(20, 1, 1, 'ib48goqcl87507edborht2emf2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-19 18:00:31'),
(21, 1, 1, 'lo7gev399c6bl18aafgpva7e01', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-20 12:05:32'),
(22, 1, 1, 'lo7gev399c6bl18aafgpva7e01', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-20 17:43:22'),
(23, 1, 1, 'ff0u7081qlud9i69f4fvc4j9a3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-23 14:55:50'),
(24, 1, 1, 'j7jot77p3lvf7vdl34ufof9900', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-23 15:42:33'),
(25, 1, 1, 'j7jot77p3lvf7vdl34ufof9900', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-23 17:26:05'),
(26, 1, 1, 'mqafv98or286r6qivrusb424v1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-24 15:59:12'),
(27, 1, 1, 'mqafv98or286r6qivrusb424v1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-24 18:04:34'),
(28, 1, 1, 'libd5pm4q9kjup7ouq9j0iurg1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-25 11:43:30'),
(29, 1, 1, 'libd5pm4q9kjup7ouq9j0iurg1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-25 15:53:54'),
(30, 1, 1, 'libd5pm4q9kjup7ouq9j0iurg1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-25 18:23:07'),
(31, 1, 1, 'llcho7o9g3g18t44o3asqdpbv3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-26 12:37:39'),
(32, 1, 1, 'llcho7o9g3g18t44o3asqdpbv3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-26 17:29:26'),
(33, 1, 1, 'o1qsnavbt6chjlfb7huekb45q0', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-27 12:15:33'),
(34, 1, 1, '1q45pk973rcil5r16espf94o17', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-27 12:29:35'),
(35, 1, 1, 'orqljldln5la33ameog2kj9992', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-31 12:56:38'),
(36, 1, 1, 'orqljldln5la33ameog2kj9992', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-10-31 15:22:15'),
(37, 1, 1, 'kiesbp8r077djg0jvduhufub62', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-03 14:46:19'),
(38, 1, 1, 'ldbdi0lrmq78jjdbesrk7lmtg2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-06 12:20:43'),
(39, 1, 1, 'ldbdi0lrmq78jjdbesrk7lmtg2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-06 15:40:47'),
(40, 1, 1, 'laffvjoril34k3rr36g65ie4n1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-07 12:03:48'),
(41, 1, 1, 'laffvjoril34k3rr36g65ie4n1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-07 14:27:39'),
(42, 1, 1, 'laffvjoril34k3rr36g65ie4n1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-07 16:28:47'),
(43, 1, 1, 'h17csau1877eniptv4rqpu6sj5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-08 12:07:23'),
(44, 1, 1, 'h17csau1877eniptv4rqpu6sj5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-08 16:03:26'),
(45, 1, 1, '2caf1qgieiattfq2dij414fh77', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-13 11:58:44'),
(46, 1, 1, '2caf1qgieiattfq2dij414fh77', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-13 16:45:23'),
(47, 1, 1, '8uvqc1farsn9a56gsk51asdqh5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-14 15:35:10'),
(48, 1, 1, '82l5v9ljstr26df1t8887scjq4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-16 15:38:14'),
(49, 1, 1, 'p9i197v1dcmm8uh5alnihere10', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', '2017-11-17 12:08:26'),
(50, 1, 1, 'l2aupq54co5v02ol0k7beoh0m3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', '2018-01-05 12:00:58'),
(51, 1, 1, '6inad1cgv0k3ejs2upuq61f9g2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-17 11:18:16'),
(52, 1, 1, '6inad1cgv0k3ejs2upuq61f9g2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-17 12:55:19'),
(53, 1, 1, '6inad1cgv0k3ejs2upuq61f9g2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-17 14:42:47'),
(54, 1, 1, 'qj8gvimuqd072fom6eofvvjnh6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-23 12:05:16'),
(55, 1, 1, 's1bb91cmoa1liahvmbi6r5l6f2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-24 15:35:03'),
(56, 1, 1, 'oks0r43n7vslurm3bj7vv0j5k5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-31 12:32:21'),
(57, 1, 1, 'oks0r43n7vslurm3bj7vv0j5k5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-31 17:01:23'),
(58, 1, 1, 't4ccpv5to4ksvp7m64h28pj254', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '2018-01-31 17:05:51'),
(59, 1, 1, '53o5imt8d3ec4rmgij351d81l7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-01-31 18:20:36'),
(60, 1, 1, '7o1h0tr5e7vhq4m74ospbikb80', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-01 12:23:09'),
(61, 1, 1, 'ivj7ggpfh8gmvvh8afm38ntcm4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-01 13:09:24'),
(62, 1, 1, 'ivj7ggpfh8gmvvh8afm38ntcm4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-01 16:47:48'),
(63, 1, 1, 'ae72k1b4b233269f4skoktf1i3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-01 18:27:13'),
(64, 1, 1, '98t89pdvvujp0o7vei8t13qkl0', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-02 10:34:10'),
(65, 1, 1, 'u47geprhak03leogq9ei1fapc6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-02 12:42:00'),
(66, 1, 1, 'u47geprhak03leogq9ei1fapc6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-02 18:38:29'),
(67, 1, 1, '4n8r4g4124101eo518n9thdlp5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-05 12:55:54'),
(68, 1, 1, '4n8r4g4124101eo518n9thdlp5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-05 18:14:03'),
(69, 1, 1, '76keogr2mr7fjvp62niprhhev1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-06 12:04:42'),
(70, 1, 1, '76keogr2mr7fjvp62niprhhev1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-06 14:48:00'),
(71, 1, 1, '0nsp8936uf25pso09ine2fvlc5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-06 16:35:43'),
(72, 1, 1, 'bh8g14qqi6hel8qpa2lls4lbn4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-06 16:37:30'),
(73, 1, 1, 'bh8g14qqi6hel8qpa2lls4lbn4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-06 17:58:08'),
(74, 1, 1, '3hc7ma22aumihudd0ju4jab652', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-06 18:17:12'),
(75, 1, 1, '11p2enq3bf2ljq9k7c84m62cv3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-07 10:03:20'),
(76, 1, 1, '11p2enq3bf2ljq9k7c84m62cv3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-07 11:48:36'),
(77, 1, 1, '11p2enq3bf2ljq9k7c84m62cv3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-07 12:52:09'),
(78, 1, 1, '11p2enq3bf2ljq9k7c84m62cv3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-07 15:58:52'),
(79, 1, 1, '5th0p3ct3002reqq22od55t6u5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-07 16:10:34'),
(80, 1, 1, 'ivlgfrnngsprtuj535q29e7ok0', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-07 18:56:55'),
(81, 1, 1, 'u7k152viivqs0vuimbhurcvov7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 10:46:58'),
(82, 1, 1, 'drm14sghtk45261pr7dvo5cs75', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 11:09:38'),
(83, 1, 1, 'drm14sghtk45261pr7dvo5cs75', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 16:19:54'),
(84, 1, 1, 'n5dpt9hfbr1k1105bub38dq1p7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 16:57:19'),
(85, 1, 1, '6lkvf59s0a7sir5ulucarrnaj7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-08 17:28:18'),
(86, 1, 1, 'bubau5dq0qsv0ttc3sbk6s4d03', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 10:43:55'),
(87, 1, 1, 'bubau5dq0qsv0ttc3sbk6s4d03', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-09 15:57:30'),
(88, 1, 1, 'qkiutfel08fahvp5mf670u0445', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-12 16:30:07'),
(89, 1, 1, '34ntujls3cb939t4aouthfot71', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-12 17:27:50'),
(90, 1, 1, 'l67sgc1httfc7htea6vidp7jf6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-13 11:51:57'),
(91, 1, 1, 'l67sgc1httfc7htea6vidp7jf6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-13 17:04:06'),
(92, 1, 1, 'pormp6g5v50f5edhi3upj88li3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-14 13:05:33'),
(93, 1, 1, 'pormp6g5v50f5edhi3upj88li3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-14 17:24:14'),
(94, 1, 1, '33us3sggj8bidln187j6bsl7r6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-15 12:32:59'),
(95, 1, 1, 'i9s11fjga20n08ulci9lathf85', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-16 10:16:01'),
(96, 1, 1, '86spp647c47c64fb91m0u7v212', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-19 12:03:21'),
(97, 1, 1, '86spp647c47c64fb91m0u7v212', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-19 15:29:05'),
(98, 1, 1, '86spp647c47c64fb91m0u7v212', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-19 17:15:41'),
(99, 1, 1, '3v385ab0idv74c8g78svdmod15', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-20 11:33:03'),
(100, 1, 1, '3v385ab0idv74c8g78svdmod15', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-20 14:38:46'),
(101, 1, 1, 'qgene7g0j41s5e3bq3n54uaov1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-20 17:51:20'),
(102, 1, 1, '3778fs5v24l6qj1psk20fdu8n6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-21 10:55:18'),
(103, 1, 1, '3spbpaasjqn179n89ajmhrjop3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-21 11:00:31'),
(104, 1, 1, '3spbpaasjqn179n89ajmhrjop3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-21 12:59:05'),
(105, 1, 1, '3spbpaasjqn179n89ajmhrjop3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-21 15:05:22'),
(106, 1, 1, 'fontf0rqooscf9j3jffeqclaa6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-21 15:18:42'),
(107, 1, 1, 'fontf0rqooscf9j3jffeqclaa6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-21 17:08:21'),
(108, 1, 1, '9h9ansj80lu541gbvmrisqace7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-21 17:25:32'),
(111, 1, 1, 'ucjb7mqckvjh73drc0b9bdup97', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-22 16:39:38'),
(112, 1, 1, 'cco0rkru1vq8jvh3rsnmc1fqn7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-22 18:02:04'),
(113, 1, 1, 'gt6u4tmce1o1od86kvct3h2r96', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-22 18:04:25'),
(114, 1, 1, 'k55qukij19un4df68o2aef5va5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-22 18:06:08'),
(115, 1, 1, 'ibhg7s18fvgvaji3vouo31lca6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-22 18:23:27'),
(116, 1, 1, 'm9375vohspk9msco25v6bdatp6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-23 11:20:51'),
(117, 1, 1, 'm9375vohspk9msco25v6bdatp6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-23 13:00:07'),
(118, 1, 1, 'm9375vohspk9msco25v6bdatp6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36', '2018-02-23 18:03:14'),
(119, 1, 1, 'ranvtc4npq46jmqfot81hmg8b3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36', '2018-03-15 12:48:24'),
(120, 1, 1, 'osughmj7mbtdf5kld88ri3a193', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', '2018-04-10 15:27:25'),
(121, 1, 1, 'nohf8moh22ses0ebvtgj2g19k1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', '2018-04-11 10:56:10'),
(122, 1, 1, 'nohf8moh22ses0ebvtgj2g19k1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', '2018-04-11 17:13:35'),
(123, 1, 1, 'plg01eeipq3f5hr6hs28nsrud3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', '2018-04-12 13:00:11'),
(124, 1, 1, 'plg01eeipq3f5hr6hs28nsrud3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', '2018-04-12 15:53:15'),
(125, 1, 1, 'plg01eeipq3f5hr6hs28nsrud3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', '2018-04-12 17:45:06'),
(126, 1, 1, 'rvrq7hccfcior2ofp8dlaoqn82', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', '2018-04-16 12:40:12'),
(127, 1, 1, '4joho1mfp4s6ve3rma3g67is35', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', '2018-04-18 11:37:29'),
(128, 1, 1, '61dafltfuf8pgu706ud8bfjv02', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', '2018-05-10 11:39:58'),
(129, 1, 1, '61dafltfuf8pgu706ud8bfjv02', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', '2018-05-10 15:57:29'),
(130, 1, 1, 'cdfekshqj5485gbjp946a9g906', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', '2018-05-11 12:20:19'),
(131, 1, 1, '2u9n3u9t84h6h6qj43sr1fiu80', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', '2018-05-15 11:04:13'),
(132, 1, 1, 'ptkvsc5npj2vab4k45jt6eun77', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-23 11:55:40'),
(133, 1, 1, '7joc9qc7jeajvdrir9uu057su6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-24 14:28:43'),
(134, 1, 1, 'kthgbk8oouud54jkb3qodm67n3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-24 15:05:57'),
(135, 1, 1, 'kthgbk8oouud54jkb3qodm67n3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-24 16:55:55'),
(136, 1, 1, 'h4eblmmbr6q9e7rllm958l4ol5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-25 12:42:51'),
(137, 1, 1, 'oflglm0k30lvcv4o7m35885qc2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-29 12:45:48'),
(138, 1, 1, 'oflglm0k30lvcv4o7m35885qc2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-29 15:18:12'),
(139, 1, 1, 'oe15fi8s979fu38o6fplg37cq3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-30 12:45:15'),
(140, 1, 1, 'oe15fi8s979fu38o6fplg37cq3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-30 16:51:18'),
(141, 1, 1, 'hpm67aldnq4d1npcli59fufbq3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-31 10:45:05'),
(142, 1, 1, 'hpm67aldnq4d1npcli59fufbq3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-31 13:03:48'),
(143, 1, 1, 'hpm67aldnq4d1npcli59fufbq3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-05-31 18:16:12'),
(144, 1, 1, 'bmmhnnam9nie18piqbvkqenlf0', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-01 11:05:53'),
(145, 1, 1, 'cn8i3h00qeqgt9uv9hqvet3jh1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-01 12:59:57'),
(148, 1, 1, 'c5ga6iulrogfdei6k98jresmn3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-01 18:01:00'),
(149, 1, 1, 'ijq6fq2fh8l62pod480q1s64q6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-04 11:37:26'),
(150, 1, 1, '7n0om4cv79r9ep96r1ok7s4au7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-05 12:43:23'),
(151, 1, 1, '7n0om4cv79r9ep96r1ok7s4au7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-05 16:12:44'),
(152, 1, 1, '7n0om4cv79r9ep96r1ok7s4au7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-05 17:45:44'),
(153, 1, 1, '24fijm6po6qo5drhhufan0pof7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-06 10:16:29'),
(154, 1, 1, 'gg81kfa0tf0of6n66vp4p0efu5', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-07 11:42:20'),
(155, 1, 1, 'c91gf00g4hr9hq15jip698qko7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-07 12:40:36'),
(156, 1, 1, 'c91gf00g4hr9hq15jip698qko7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-07 17:47:41'),
(157, 1, 1, 'ff2fh7vbe996niicbivcslrec4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36', '2018-06-08 10:39:32'),
(158, 1, 1, 'ff2fh7vbe996niicbivcslrec4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36', '2018-06-08 12:58:31'),
(159, 1, 1, 'ff2fh7vbe996niicbivcslrec4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36', '2018-06-08 15:30:47'),
(160, 1, 1, 'ff2fh7vbe996niicbivcslrec4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36', '2018-06-08 17:49:43'),
(161, 1, 1, 'pqpl5ll78ajcgq9b7ldgrj48e7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36', '2018-06-11 12:38:12'),
(162, 1, 1, '75e5jri16qnu0kvob3ivtfgtu7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36', '2018-06-21 10:50:51'),
(163, 1, 1, '75e5jri16qnu0kvob3ivtfgtu7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36', '2018-06-21 12:18:38'),
(164, 1, 1, 'fe3a38lka3n8f5v353hjo20f57', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '2018-07-24 12:21:04'),
(165, 1, 1, 'me2vlqb2ubrquv8e7ot4qkcjd3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36', '2018-08-02 11:34:00'),
(166, 1, 1, 'me2vlqb2ubrquv8e7ot4qkcjd3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36', '2018-08-02 13:07:48'),
(167, 1, 1, 'me2vlqb2ubrquv8e7ot4qkcjd3', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36', '2018-08-02 16:21:37'),
(168, 1, 1, 'b102ke8um8abmgb3ard9517j90', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36', '2018-08-03 11:15:56'),
(169, 1, 1, 'q3cajv71nsqisgtvjgl679l9e2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '2018-10-09 12:09:59'),
(170, 1, 1, '9kugmvbn62mh9oagmofroltbm2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '2018-10-10 12:35:16'),
(171, 1, 1, '9kugmvbn62mh9oagmofroltbm2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '2018-10-10 16:13:16'),
(172, 1, 1, 'f9ahuiss0hj6ttcm6j15nqp1n2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '2018-10-11 11:13:05'),
(173, 1, 1, 'f9ahuiss0hj6ttcm6j15nqp1n2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '2018-10-11 12:57:52'),
(174, 1, 1, 'r6b5oa32gtnn1f4r3ot2kg3au0', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '2018-10-12 12:49:18'),
(175, 1, 1, 'r6b5oa32gtnn1f4r3ot2kg3au0', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '2018-10-12 15:08:14'),
(176, 1, 1, 'djn462m7qrnav63phlbne81v67', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0', '2018-10-12 15:15:33'),
(177, 1, 1, 'vuep07l76uq5d1pebdbv3nebm1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-15 12:34:23'),
(178, 1, 1, 'vuep07l76uq5d1pebdbv3nebm1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-15 15:50:42'),
(179, 1, 1, '53t6hdlh3kb7nm666md52ok210', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-17 10:38:23'),
(180, 1, 1, '53t6hdlh3kb7nm666md52ok210', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-17 12:52:36'),
(181, 1, 1, '53t6hdlh3kb7nm666md52ok210', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-17 15:44:32'),
(182, 1, 1, 'ssvvv3u0bhda6kp35jomqj6sd2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-17 16:10:56'),
(183, 1, 1, 'cnptrd5lva7a90cae4dgvrr8c0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-22 12:46:00'),
(184, 1, 1, 'cnptrd5lva7a90cae4dgvrr8c0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-22 15:04:10'),
(185, 1, 1, '9231mudrmbcejp2ai93jme78h5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-25 11:16:01'),
(186, 1, 1, '9231mudrmbcejp2ai93jme78h5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-25 12:44:50'),
(187, 1, 1, '9231mudrmbcejp2ai93jme78h5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-25 18:23:53'),
(188, 1, 1, 'niiqh32udabmdm5516ntf1hqg2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-10-26 17:08:36'),
(189, 1, 1, '0i5vhll6ck4o0763d0gc6djpv6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-10-31 16:13:23'),
(190, 1, 1, '39648nmh89hb5f6ovvmr5t5r11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-01 17:23:20'),
(191, 1, 1, '9ec20e07l0k4do01hmebi1b9h3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-05 16:01:16'),
(192, 1, 1, '9ec20e07l0k4do01hmebi1b9h3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-05 17:11:55'),
(195, 1, 1, 'bs8rpv1qr8jehu8jkepf0nuaa4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-06 13:03:24'),
(196, 1, 1, 'bs8rpv1qr8jehu8jkepf0nuaa4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-06 18:08:44'),
(197, 1, 1, 'j81sfahlusmr09ebpn6ecfh6h1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-07 17:45:57'),
(198, 1, 1, 'q751rocaue58pb0idms98qgmt5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-08 12:40:44'),
(199, 1, 1, 'q751rocaue58pb0idms98qgmt5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-08 16:15:31'),
(201, 1, 1, 'f1f0nnn6o5gs2kf6sm8jgrmlc1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-09 13:01:22'),
(202, 1, 1, 'f1f0nnn6o5gs2kf6sm8jgrmlc1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-09 16:39:42'),
(203, 1, 1, '21o78sk73u1mkg8k9tii20p3f5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-13 13:02:03'),
(204, 1, 1, '21o78sk73u1mkg8k9tii20p3f5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-13 17:11:59'),
(207, 2, 4, '5c0gabq9hcl8cphqhvioto7ql7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-14 17:35:54'),
(208, 1, 1, 'qb9vglgsv0ft50qocoodnr9lb1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-15 12:57:31'),
(209, 1, 1, 'qb9vglgsv0ft50qocoodnr9lb1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-15 18:14:17'),
(210, 1, 1, 'ukr1ghc3d17at75mj384o6dd13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-19 14:29:17'),
(211, 1, 1, 'ukr1ghc3d17at75mj384o6dd13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-19 16:05:57'),
(212, 1, 1, 'ukr1ghc3d17at75mj384o6dd13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-11-19 18:00:28');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_addr_formal`
-- (See below for the actual view)
--
CREATE TABLE `view_addr_formal` (
`addr_id` int(10) unsigned
,`addr_fname` varchar(30)
,`addr_lname` varchar(30)
,`addr_suffix` int(10) unsigned
,`common_suffix_abbr` varchar(45)
,`addr_org_id` int(10) unsigned
,`addr_org` text
,`addr_org_phone` varchar(20)
,`addr_org_fax` varchar(20)
,`addr_address_1` varchar(255)
,`addr_address_2` varchar(255)
,`addr_city` varchar(255)
,`addr_state` varchar(2)
,`addr_postcode` varchar(10)
,`addr_country` varchar(80)
,`addr_org_phone_ext` varchar(20)
,`addr_direct` varchar(20)
,`addr_mobile` varchar(20)
,`addr_email` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_work_j_milestones`
-- (See below for the actual view)
--
CREATE TABLE `view_work_j_milestones` (
`work_j_milestones_id` int(10) unsigned
,`work_j_id` int(10) unsigned
,`common_eng_milestones_desc` varchar(255)
,`common_eng_milestones_group` int(11)
,`work_j_milestones_value` date
,`work_j_milestones_created` datetime
,`work_j_milestones_updated` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  A unique identifier for work entries.',
  `work_year` year(4) DEFAULT NULL COMMENT 'Defines the archive year of the project in YEAR only format',
  `work_number` int(10) UNSIGNED NOT NULL COMMENT 'Defines the job number suffix.  Format is YY-XXX',
  `work_title` text NOT NULL COMMENT 'Defines the title of the job.',
  `work_client` int(10) UNSIGNED NOT NULL COMMENT 'Foreign key to the ADDR_ORGS table.',
  `work_client_rep` int(10) UNSIGNED NOT NULL COMMENT 'The name from the ADDR entry',
  `work_db` tinyint(1) DEFAULT NULL COMMENT 'Defines if a project is a Design/Build project',
  `work_status` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key that related to the work_status table.',
  `work_j_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to J phase.',
  `work_c_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign key to C phase.',
  `work_p_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign key to P phase.',
  `work_b_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign key to B phase.',
  `work_s_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign key to S phase.',
  `work_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change to the entry was created.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work - The master table for all work/projects.  All child tables underneath this table will begin with the previd work_.';

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `work_year`, `work_number`, `work_title`, `work_client`, `work_client_rep`, `work_db`, `work_status`, `work_j_id`, `work_c_id`, `work_p_id`, `work_b_id`, `work_s_id`, `work_created`, `work_updated`) VALUES
(1, 2018, 1, 'Test Project', 1, 2, 0, 2, 1, NULL, NULL, NULL, NULL, '2018-10-22 11:25:25', '2018-10-22 15:33:28'),
(2, 2018, 2, 'Test Project 2', 2, 2, 0, 2, 2, NULL, NULL, NULL, NULL, '2018-10-26 10:05:54', '2018-11-06 16:57:55'),
(3, 2018, 3, 'Roof', 9, 1, 0, 2, 3, NULL, NULL, NULL, NULL, '2018-11-16 17:18:44', '2018-11-16 22:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `work_b`
--

CREATE TABLE `work_b` (
  `work_b_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key. Work B ID',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work table.  ',
  `work_b_number` int(10) UNSIGNED NOT NULL COMMENT '	The actual B phase ID',
  `work_b_assoc_num` varchar(45) DEFAULT NULL COMMENT ' 	Defines associated numbers ',
  `work_status_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to WORK STATUS table.  Defines the status.',
  `work_b_fcv` decimal(10,2) DEFAULT '0.00' COMMENT 'Final Contract Value',
  `work_b_percentcomp` decimal(10,0) DEFAULT NULL COMMENT 'Percent Complete',
  `work_b_sow` text COMMENT 'Statement of Work',
  `work_b_created` datetime DEFAULT NULL COMMENT 'Initial creation date',
  `work_b_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_b - A chile table that holds all relvant infomrionat related to B phase projects.  All child tables underneat this table will begin with work_b_.';

-- --------------------------------------------------------

--
-- Table structure for table `work_b_actions`
--

CREATE TABLE `work_b_actions` (
  `work_b_actions_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Work B Actions ID.',
  `work_b_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work_B table.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work table',
  `work_b_actions_assignedto` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to the Employee table.  Dictates whom the action was assigned to.',
  `work_b_actions_assigned` date DEFAULT NULL COMMENT 'Date assigned.',
  `work_b_actions_date_completed` date DEFAULT NULL COMMENT 'Date completed.',
  `work_b_actions_task` text COMMENT 'Details of the Task.',
  `work_b_actions_comments` text COMMENT 'Comments about task.',
  `work_b_actions_is_complete` tinyint(1) DEFAULT NULL COMMENT 'Marks an action as complete.',
  `work_b_actions_created` datetime DEFAULT NULL COMMENT 'Initial creation date.',
  `work_b_actions_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_b_actions - A child table that contains all register of actions.';

-- --------------------------------------------------------

--
-- Table structure for table `work_b_discussions`
--

CREATE TABLE `work_b_discussions` (
  `work_b_discussions_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Work B Discussion ID.',
  `work_b_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work B table.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work table.',
  `work_b_discussions_entry` text COMMENT 'Discussion entry.',
  `work_b_discussions_created` datetime DEFAULT NULL COMMENT 'Initial date created.',
  `work_b_discussions_updated` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_b_discussions - A child table that holds all discussions related to the B phase work.';

-- --------------------------------------------------------

--
-- Table structure for table `work_b_milestones`
--

CREATE TABLE `work_b_milestones` (
  `work_b_milestones_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Work B Milestons ID.',
  `work_b_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work B table.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work table.',
  `work_b_milestones_common_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Common Cons Milestones table.',
  `work_b_milestones_value` date DEFAULT NULL COMMENT 'Date of milestone.',
  `work_b_milestones_created` datetime DEFAULT NULL COMMENT 'Initial date created.',
  `work_b_milestones_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_b_milestones - A child table that holds all relevant milestones related to a B phase project.';

-- --------------------------------------------------------

--
-- Table structure for table `work_b_subcontractors`
--

CREATE TABLE `work_b_subcontractors` (
  `work_b_subcontractors_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Work B Subcontractor ID.',
  `work_b_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work B table.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work table.',
  `addr_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to address table.  Defines the address of the subcontractor.',
  `work_b_subcontractors_role` text COMMENT 'Defines the role of subcontractor.',
  `work_b_subcontractors_created` datetime DEFAULT NULL COMMENT 'Initial date created.',
  `work_b_subcontractors_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `work_b_subcontractorscol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_b_subcontractor - A child table that holds all related subcontractors that participate in the B phase work.';

-- --------------------------------------------------------

--
-- Table structure for table `work_b_team`
--

CREATE TABLE `work_b_team` (
  `work_b_team_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Work B Team ID.',
  `work_b_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work_B table.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Work table.',
  `employee_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Employee table.  Defines a member of the team.',
  `work_b_team_leader` tinyint(1) DEFAULT NULL COMMENT 'Defines a team leader',
  `work_b_team_created` datetime DEFAULT NULL COMMENT 'Initial creation date',
  `work_b_team_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_b_team - A child table that holds all the associated internal team members to a B phase project.';

-- --------------------------------------------------------

--
-- Table structure for table `work_c`
--

CREATE TABLE `work_c` (
  `work_c_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key. Unique identifier for a C phase work project.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `work_c_number` int(10) UNSIGNED NOT NULL COMMENT '	The actual C phase ID',
  `work_c_assoc_num` int(45) DEFAULT NULL COMMENT 'Defines an associated number',
  `work_status_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Defines the status of the C phase. Refers to values held in table ''work_status''.',
  `work_c_percentcomp` decimal(10,2) DEFAULT NULL COMMENT 'Defines the percentage of completion for a J phase project.',
  `work_c_sow` text COMMENT 'Defines the statement of work for a J phase project.',
  `work_c_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_c_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change to the C phase entry was created.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_c - A child table that contains all relevant project informatino related to C phase projects.  All child tables underneath this table will begin with work_c_.';

-- --------------------------------------------------------

--
-- Table structure for table `work_c_discussions`
--

CREATE TABLE `work_c_discussions` (
  `work_c_discussions_id` int(10) UNSIGNED NOT NULL,
  `work_c_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `work_c_discussions_entry` text,
  `work_c_discussions_created` datetime DEFAULT NULL,
  `work_c_discussions_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_c_discussions - A child table that holds all relevant disuccsions for C phase Work assignment';

-- --------------------------------------------------------

--
-- Table structure for table `work_c_milestones`
--

CREATE TABLE `work_c_milestones` (
  `work_c_milestones_id` int(10) UNSIGNED NOT NULL,
  `work_c_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `common_cons_milestones_id` int(10) UNSIGNED NOT NULL,
  `work_c_milestones_value` date DEFAULT NULL,
  `work_c_milestones_created` datetime DEFAULT NULL,
  `work_c_milestones_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_c_milestones - A child table that holds  all milestone events for a C phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_c_subcontractors`
--

CREATE TABLE `work_c_subcontractors` (
  `work_c_subcontractors_id` int(10) UNSIGNED NOT NULL,
  `work_c_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `addr_id` int(10) UNSIGNED NOT NULL,
  `work_c_subcontractors_role` varchar(100) DEFAULT NULL,
  `work_c_subcontractors_created` datetime DEFAULT NULL,
  `work_c_subcontractors_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_c_subcontractors - A child table that holds all related subcontractors that may be working on a C phase Work assignment';

-- --------------------------------------------------------

--
-- Table structure for table `work_c_team`
--

CREATE TABLE `work_c_team` (
  `work_c_team_id` int(10) UNSIGNED NOT NULL,
  `work_c_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `work_c_team_leader` tinyint(1) DEFAULT NULL,
  `work_c_team_created` datetime DEFAULT NULL,
  `work_c_team_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_c_team - A child table that holds all related employees assigned to the C phase of a Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_j`
--

CREATE TABLE `work_j` (
  `work_j_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a J phase work project.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `work_j_number` int(10) UNSIGNED NOT NULL,
  `work_j_assoc_num` varchar(45) DEFAULT NULL,
  `work_status_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Defines the status of the J phase.  Refers to values held in table ''work_status''.',
  `work_j_percentcomp` decimal(10,2) DEFAULT NULL COMMENT 'Defines the percentage of completion for a J phase project.',
  `work_j_sow` text COMMENT 'Defines the statement of work for a J phase project.',
  `work_j_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_j_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change to the S phase entry was created.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j - A child table that contains all relevant project information related J phase projects.  All child tables underneath this table will be begin with work_j_.\n\n';

--
-- Dumping data for table `work_j`
--

INSERT INTO `work_j` (`work_j_id`, `work_id`, `work_j_number`, `work_j_assoc_num`, `work_status_id`, `work_j_percentcomp`, `work_j_sow`, `work_j_created`, `work_j_updated`) VALUES
(1, 1, 1, NULL, 2, '27.80', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod lorem eu lacus accumsan, eget tincidunt ex lobortis. Fusce elementum quam eget augue congue, vel tincidunt libero condimentum. In viverra lacus vel molestie convallis. Fusce sollicitudin lectus eu volutpat semper. Sed hendrerit leo et est volutpat tempor. Sed lobortis est id nulla condimentum malesuada. Integer ligula diam, euismod non libero eu, ultrices consectetur turpis. Sed quis sem lorem. Proin nec varius tellus, in aliquam sem. Mauris nec venenatis quam.</p>\r\n<p>Etiam vulputate quam at purus scelerisque, in aliquet risus hendrerit. Pellentesque volutpat, purus vel convallis viverra, felis leo consequat nibh, et aliquet leo augue sed nibh. Donec ultrices ex sapien, non pretium massa tristique et. Vivamus non neque lorem. Donec mattis fermentum metus non luctus. Donec nec nisl vitae nulla bibendum egestas. Pellentesque at varius tellus. Fusce feugiat ullamcorper erat euismod congue. Donec nec sem dictum orci tempor cursus ac eget risus.</p>\r\n<p>Cras ac metus faucibus tortor blandit tempor. Suspendisse pellentesque euismod lectus, id sagittis sapien viverra non. Maecenas pellentesque tincidunt semper. Nunc sagittis, est at blandit placerat, mauris sem maximus mi, at volutpat nisi ipsum eu risus. Suspendisse quis ornare metus, vehicula maximus libero. Phasellus eleifend elit sem, ac maximus lectus vulputate id. Curabitur lorem velit, placerat ut mauris non, vulputate rhoncus sem. Proin id elementum libero. Integer dictum, quam non maximus scelerisque, sem nunc tincidunt odio, eget placerat odio nisi quis elit. Proin molestie eleifend ipsum, sit amet aliquet lacus. In elit ipsum, dapibus eget ante convallis, commodo posuere dolor. Suspendisse tincidunt aliquam purus, a lobortis purus porta sit amet. Pellentesque aliquam faucibus quam sed cursus. Suspendisse mollis elit non ultricies maximus.</p>', '2018-10-22 11:25:25', '2018-11-15 19:25:36'),
(2, 2, 1, NULL, 3, '0.00', NULL, '2018-11-06 11:57:55', '2018-11-06 16:57:55'),
(3, 3, 1, NULL, 2, '10.00', '<p>dasaskjmfc</p>', '2018-11-16 17:18:44', '2018-11-16 22:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `work_j_acct_info`
--

CREATE TABLE `work_j_acct_info` (
  `work_j_acct_info_id` int(10) UNSIGNED NOT NULL,
  `work_j_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `work_j_acct_info_istm` tinyint(1) DEFAULT NULL,
  `work_j_acct_info_contract_value` decimal(15,2) DEFAULT NULL,
  `work_j_acct_info_created` datetime DEFAULT NULL,
  `work_j_acct_info_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_acct_info - A child table that holds all relevant accounting information for a J phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_j_acct_info_mods`
--

CREATE TABLE `work_j_acct_info_mods` (
  `work_j_acct_info_mods_id` int(10) UNSIGNED NOT NULL,
  `work_j_acct_info_id` int(10) UNSIGNED NOT NULL,
  `work_j_acct_info_mods_value` decimal(10,2) DEFAULT NULL,
  `work_j_acct_info_mods_notes` text,
  `work_j_acct_info_mods_created` datetime DEFAULT NULL,
  `work_j_acct_info_mods_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `work_j_acct_info_notes`
--

CREATE TABLE `work_j_acct_info_notes` (
  `work_j_acct_info_notes_id` int(10) UNSIGNED NOT NULL,
  `work_j_acct_info_id` int(10) UNSIGNED NOT NULL,
  `work_j_acct_info_notes_text` text,
  `work_j_acct_info_notes_created` datetime DEFAULT NULL,
  `work_j_acct_info_notes_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `work_j_acct_inv`
--

CREATE TABLE `work_j_acct_inv` (
  `work_j_acct_inv_id` int(10) UNSIGNED NOT NULL,
  `work_j_acct_info_id` int(10) UNSIGNED NOT NULL,
  `work_j_acct_inv_amount` decimal(10,2) DEFAULT NULL,
  `work_j_acct_inv_date` date DEFAULT NULL,
  `work_j_acct_inv_ispaid` tinyint(1) DEFAULT NULL,
  `work_j_acct_inv_created` datetime DEFAULT NULL,
  `work_j_acct_inv_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_acct_inv - A child table that holds the records of invoices applied to the J phase project.';

-- --------------------------------------------------------

--
-- Table structure for table `work_j_acct_subs`
--

CREATE TABLE `work_j_acct_subs` (
  `work_j_acct_subs_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a subs that are contracted.',
  `work_j_acct_info_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Refers to the ''work_j_acct_id'' column of the work_j_acct_info table.',
  `work_j_consultants` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Refers to the ''work_j_consultants_id'' column of the work_j_consultant table',
  `work_j_acct_subs_ca` decimal(10,2) DEFAULT NULL COMMENT 'Contract amount agreed to by sub',
  `work_j_acct_subs_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a record was created.',
  `work_j_acct_subs_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change has been made to the record.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_acc - A child tbale that holds all related work account information for subs.';

-- --------------------------------------------------------

--
-- Table structure for table `work_j_acct_subs_inv`
--

CREATE TABLE `work_j_acct_subs_inv` (
  `work_j_acct_subs_inv_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a subs that are contracted.',
  `work_j_acct_info_id` int(10) UNSIGNED NOT NULL,
  `work_j_acct_subs_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Refers to the ''work_j_acct_subs_id'' column in the work_j_acct_subs table.',
  `work_j_acct_subs_inv_number` varchar(45) NOT NULL COMMENT 'The invoice number from sub.',
  `work_j_acct_subs_inv_amount` decimal(10,2) DEFAULT NULL COMMENT 'Amount of the invoice.',
  `work_j_acct_subs_inv_date` date DEFAULT NULL COMMENT 'Date invoice was received.',
  `work_j_acct_subs_inv_ispaid` tinyint(1) DEFAULT NULL COMMENT 'Flag to mark if invoice has been paid or not.',
  `work_j_acct_subs_inv_date_paid` date DEFAULT NULL COMMENT 'Date invocie was paid by CDE.',
  `work_j_acct_subs_inv_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a record was created.',
  `work_j_acct_subs_inv_updated` timestamp NULL DEFAULT NULL COMMENT 'Historical reference as to when a record was updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `work_j_actions`
--

CREATE TABLE `work_j_actions` (
  `work_j_actions_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for an action assignment entry.',
  `work_j_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_j_id'' on parent table ''work_j''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `work_j_actions_assignedto` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Defines who was assigned to the task.  References ''employee_id'' from table ''employee''.',
  `work_j_actions_assigned` date DEFAULT NULL COMMENT 'Defines the date the assignment was given.',
  `work_j_actions_due` date DEFAULT NULL COMMENT 'Defines the date the assignment is due to be completed.',
  `work_j_actions_date_completed` date DEFAULT NULL COMMENT 'Defines the actual date of completion.',
  `work_j_actions_task` text COMMENT 'Defines the task assigned in plain text.',
  `work_j_actions_comments` text COMMENT 'Defines any comments related to an action assignment in plain text.',
  `work_j_actions_is_complete` tinyint(1) DEFAULT NULL COMMENT 'A flagging field that defines if a task has been accomplished.',
  `work_j_actions_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_j_actions_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change was made to the record.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_actions - A child table that holds all related action items/tasks for a J phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_j_consultants`
--

CREATE TABLE `work_j_consultants` (
  `work_j_consultants_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a individual memebers of a the external team. ',
  `work_j_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. References value ''work_j_id'' on parent table ''work_j''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''. ',
  `addr_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''addr_id'' from the addr table.',
  `common_roles_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''common_roles_id'' of parent table ''common_roles''. ',
  `work_j_consultants_created` datetime DEFAULT NULL,
  `work_j_consultants_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_consultants - A child table that holds all related consultants that may be working on a J phase Work assignment.';

--
-- Dumping data for table `work_j_consultants`
--

INSERT INTO `work_j_consultants` (`work_j_consultants_id`, `work_j_id`, `work_id`, `addr_id`, `common_roles_id`, `work_j_consultants_created`, `work_j_consultants_updated`) VALUES
(1, 3, 3, 1, 12, '2018-11-16 17:20:11', '2018-11-16 22:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `work_j_delays`
--

CREATE TABLE `work_j_delays` (
  `work_j_delays_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a work delay entry.',
  `work_j_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_j_id'' on parent table ''work_j''.',
  `work_j_milestones_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `work_j_delays_reason` text COMMENT 'Defines the reason for a delay in plain text.',
  `work_j_delays_finalized_date` date DEFAULT NULL COMMENT 'Defines the date the delay was recognized.',
  `work_j_delays_cause` int(1) DEFAULT NULL COMMENT 'A flagging field that will define if the delay was caused by an internal reason or an external reason (0 = Internal, 1 = external)',
  `work_j_delays_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_j_delays_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change to the record was performed.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_delays - A child tbale that holds all related work delay information for a J phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_j_discussions`
--

CREATE TABLE `work_j_discussions` (
  `work_j_discussions_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key. Unique identifier for a discussion entry.',
  `work_j_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_j_id'' on parent table ''work_j''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `work_j_discussions_entry` text COMMENT 'Defines the discussion value in plain text.',
  `work_j_discussions_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_j_discussions_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change was made to the record.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_discussions - A child table that holds all relevant discussions for a J phase Work assignment.';

--
-- Dumping data for table `work_j_discussions`
--

INSERT INTO `work_j_discussions` (`work_j_discussions_id`, `work_j_id`, `work_id`, `work_j_discussions_entry`, `work_j_discussions_created`, `work_j_discussions_updated`) VALUES
(1, 1, 1, '<p><strong>Lorem ipsum</strong></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris gravida gravida tellus commodo rutrum. In lorem enim, dictum nec massa at, congue tincidunt nisi. Pellentesque posuere vel justo ac mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce blandit mi et elit semper, a porttitor dolor mollis. Integer vestibulum, purus vitae lacinia tempor, diam ipsum bibendum neque, id malesuada purus quam id turpis. Proin nec odio porttitor, posuere justo id, mollis urna. Sed dapibus finibus ipsum, vel faucibus felis cursus non. Nulla a consectetur felis, in blandit erat. Donec tortor tellus, rutrum ut venenatis eget, rhoncus porta erat. Ut suscipit pharetra odio, non tincidunt ligula condimentum quis. Maecenas fringilla nunc eu lobortis semper. Sed ut felis porttitor, tempus leo sit amet, luctus orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>', '2018-11-15 17:04:34', NULL),
(2, 1, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris gravida gravida tellus commodo rutrum. In lorem enim, dictum nec massa at, congue tincidunt nisi. Pellentesque posuere vel justo ac mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce blandit mi et elit semper, a porttitor dolor mollis. I<span style="background-color: #ffff00;">nteger vestibulum, purus vitae lacinia tempor, diam ipsum bibendum neque, id malesuada purus quam id turpis.</span> Proin nec odio porttitor, posuere justo id, mollis urna. Sed dapibus finibus ipsum, vel faucibus felis cursus non. <span style="color: #ff0000;">Nulla a consectetur felis</span>, in blandit erat. Donec tortor tellus, rutrum ut venenatis eget, rhoncus porta erat. Ut suscipit pharetra odio, non tincidunt ligula condimentum quis. Maecenas fringilla nunc eu lobortis semper. Sed ut felis porttitor, tempus leo sit amet, luctus orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>', '2018-11-15 17:08:26', NULL),
(3, 1, 1, '<p><span style="text-decoration: line-through;">lkajsndlkjadnslfbajsdlf</span></p>', '2018-11-15 17:12:29', '2018-11-16 21:19:50'),
(5, 2, 2, '<p>#discussion_entries</p>', '2018-11-16 16:13:03', NULL),
(6, 1, 1, '<p>BOOGER GAS</p>', '2018-11-16 16:19:41', NULL),
(7, 1, 1, '<p>re vel justo ac mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce blandit mi et elit semper, a porttitor dolor mollis. Integer vestibulum, purus vitae lacinia tempor, diam ipsum bibendum neque, id malesuada purus quam id turpis. Proin nec odio porttitor, posuere justo id, mollis urna. Sed dapibus finibus ipsum, vel faucibus felis cursus non. Nulla a consectetur felis, in blandit erat. Donec tortor tellus, rutrum ut venenatis eget, rhoncus porta erat. Ut suscipit pharetra odio, non tincidunt ligula condimentum quis. Maecenas fringilla n</p>\r\n<p>re vel justo ac mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce blandit mi et elit semper, a porttitor dolor mollis. Integer vestibulum, purus vitae lacinia tempor, diam ipsum bibendum neque, id malesuada purus quam id turpis. Proin nec odio porttitor, posuere justo id, mollis urna. Sed dapibus finibus ipsum, vel faucibus felis cursus non. Nulla a consectetur felis, in blandit erat. Donec tortor tellus, rutrum ut venenatis eget, rhoncus porta erat. Ut suscipit pharetra odio, non tincidunt ligula condimentum quis. Maecenas fringilla n</p>\r\n<p>re vel justo ac mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce blandit mi et elit semper, a porttitor dolor mollis. Integer vestibulum, purus vitae lacinia tempor, diam ipsum bibendum neque, id malesuada purus quam id turpis. Proin nec odio porttitor, posuere justo id, mollis urna. Sed dapibus finibus ipsum, vel faucibus felis cursus non. Nulla a consectetur felis, in blandit erat. Donec tortor tellus, rutrum ut venenatis eget, rhoncus porta erat. Ut suscipit pharetra odio, non tincidunt ligula condimentum quis. Maecenas fringilla n</p>', '2018-11-16 16:32:35', NULL),
(8, 3, 3, '<p>fkf\'skfaf</p>', '2018-11-16 17:20:52', NULL),
(9, 3, 3, '<p>lkdfasfjkfv,lz,mvX&lt;z</p>', '2018-11-16 17:21:06', '2018-11-16 22:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `work_j_manhours`
--

CREATE TABLE `work_j_manhours` (
  `work_j_manhours_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a manhour entry.',
  `work_j_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_j_id'' on parent table ''work_j''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `common_roles_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Defines the labeling for a manhour entry.  References ''common_roles_id'' on the table ''common_roles''.',
  `work_j_manhours_est` int(11) DEFAULT NULL COMMENT 'Defines the estimated hours set aside for a project.',
  `work_j_manhours_act` int(11) DEFAULT NULL COMMENT 'Defines the acutal number of hours spent on a project.',
  `work_j_manhours_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_j_manhours_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when the entry was updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_manhours - A child table that holds all programmed manhour information related to a J Phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_j_milestones`
--

CREATE TABLE `work_j_milestones` (
  `work_j_milestones_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for milestone enrty for a J phase work project.',
  `work_j_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_j_id'' on parent table ''work_j''.',
  `work_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `work_j_common_milestones_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Defines a labeling of a milestone entry.  References ''common_eng_milestones_id'' on table ''common_eng_milestones''.',
  `work_j_milestones_value` date DEFAULT NULL COMMENT 'Defines the value of the milestone in a DATE format.',
  `work_j_milestones_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_j_milestones_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change to the entry was made.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_milestones - A child table that holds all milestone events for a J phase Work assignment.';

--
-- Dumping data for table `work_j_milestones`
--

INSERT INTO `work_j_milestones` (`work_j_milestones_id`, `work_j_id`, `work_id`, `work_j_common_milestones_id`, `work_j_milestones_value`, `work_j_milestones_created`, `work_j_milestones_updated`) VALUES
(2, 3, 3, 1, '2018-11-15', '2018-11-16 17:21:30', '2018-11-16 22:21:30'),
(3, 3, 3, 5, '2018-11-21', '2018-11-16 17:21:42', '2018-11-16 22:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `work_j_rfisub_log`
--

CREATE TABLE `work_j_rfisub_log` (
  `work_j_rfisub_log_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for milestone enrty for a J phase SUB/RFI entry.',
  `work_j_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_j_id'' on parent table ''work_j''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `work_j_rfisub_log_type` int(1) NOT NULL COMMENT 'Defines if an entry is a submittal (0) or and rfi (1).',
  `work_j_rfisub_log_status` int(1) NOT NULL DEFAULT '1' COMMENT 'Defines the status of an entry.  Values available...',
  `work_j_rfisub_log_internal_track` int(5) DEFAULT NULL COMMENT 'Defines CDE''s internal tracking number.',
  `work_j_rfisub_log_external_track` varchar(45) DEFAULT NULL COMMENT 'Defines the external source tracking number.',
  `work_j_rfisub_log_receivedby` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Identifies who recieved the document from the ''employee'' table.',
  `work_j_rfisub_log_date_received` date DEFAULT NULL COMMENT 'Defines the date recieved.',
  `work_j_rfisub_log_qty_received` int(11) DEFAULT NULL COMMENT 'Defines the quantity recieved.',
  `work_j_rfisub_log_due_date` date DEFAULT NULL COMMENT 'Defines the due date.',
  `work_j_rfisub_log_subject` varchar(255) DEFAULT NULL COMMENT 'Defines the subject of the SUB/RFI.',
  `work_j_rfisub_log_disposition` int(10) UNSIGNED DEFAULT NULL COMMENT 'Defines the pre-defined disposition.',
  `work_j_rfisub_log_notes` text COMMENT 'Defines any notes related to the SUBS/RFI.',
  `work_j_rfisub_log_date_returned` date DEFAULT NULL COMMENT 'Defines the date the documents were actually returned.',
  `work_j_rfisub_log_qty_returned` int(3) DEFAULT NULL COMMENT 'Defines the quantity that was returned.',
  `work_j_rfisub_log_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_j_rfisub_log_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change to the record was performed.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_rfisub_log - A Child table that holds all RFI/Submittal infromation for a J phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_j_rfisub_log_reviewers`
--

CREATE TABLE `work_j_rfisub_log_reviewers` (
  `work_j_rfisub_log_reviewers_id` int(10) UNSIGNED NOT NULL,
  `work_j_rfisub_log_id` int(10) UNSIGNED NOT NULL,
  `work_j_rfisub_log_reviewers_employee` int(10) UNSIGNED NOT NULL,
  `work_j_rfisub_log_reviewers_consultants` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_rfisubs_log_reviewers - A child table that holds all related reviewers of RFI/Submittal entries.';

-- --------------------------------------------------------

--
-- Table structure for table `work_j_team`
--

CREATE TABLE `work_j_team` (
  `work_j_team_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a individual memebers of a team.',
  `work_j_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_j_id'' on parent table ''work_j''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `employee_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Defines the employee who is part of the team. References ''employee_id'' of the table ''employee''.',
  `work_j_team_leader` tinyint(1) NOT NULL COMMENT 'A flagging field to define an individual as a team leader.',
  `common_roles_id` int(10) UNSIGNED NOT NULL,
  `work_j_team_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_j_team_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change has been made to the record.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_j_team - A child table that holds all related employees assigned to the J phase of a Work assignment.';

--
-- Dumping data for table `work_j_team`
--

INSERT INTO `work_j_team` (`work_j_team_id`, `work_j_id`, `work_id`, `employee_id`, `work_j_team_leader`, `common_roles_id`, `work_j_team_created`, `work_j_team_updated`) VALUES
(2, 3, 3, 5, 1, 1, '2018-11-16 17:19:55', '2018-11-16 22:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `work_p`
--

CREATE TABLE `work_p` (
  `work_p_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key. Unique identifier for a P phase work project.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `work_p_number` int(10) UNSIGNED NOT NULL COMMENT '	The actual P phase ID',
  `work_p_assoc_num` int(45) DEFAULT NULL COMMENT 'Defines associated numbers',
  `work_status_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Defines the status of the P phase. Refers to values held in table ''work_status''.',
  `work_p_fcv` decimal(10,2) DEFAULT '0.00' COMMENT 'Defines the Final contract value for a P phase project',
  `work_p_percentcomp` decimal(10,0) DEFAULT NULL COMMENT 'Defines the percentage of completion for a P phase project.',
  `work_p_sow` text COMMENT 'Defines the statement of work for a P phase project.',
  `work_p_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when the entry was created.',
  `work_p_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change to the P phase entry was created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_p - A child table that contains all relevant project information related P phase projects.  All child tables underneath this table will be begin with work_p_.fcv - final contract value';

-- --------------------------------------------------------

--
-- Table structure for table `work_p_acct_info`
--

CREATE TABLE `work_p_acct_info` (
  `work_p_acct_id` int(10) UNSIGNED NOT NULL,
  `work_p_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `work_p_acct_info_amt` decimal(10,2) DEFAULT NULL,
  `work_p_acct_info_submitted` date DEFAULT NULL,
  `work_p_acct_info_isrevision` tinyint(1) DEFAULT NULL,
  `work_p_acct_info_awarded` tinyint(1) DEFAULT NULL,
  `work_p_acct_info_created` datetime DEFAULT NULL,
  `work_p_acct_info_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_p_acct_info - A child table that holds all relevant accounting information for a P phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_p_actions`
--

CREATE TABLE `work_p_actions` (
  `work_p_actions_id` int(10) UNSIGNED NOT NULL,
  `work_p_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `work_p_actions_assignedto` int(10) UNSIGNED NOT NULL,
  `work_p_actions_assigned` date DEFAULT NULL,
  `work_p_actions_due` date DEFAULT NULL,
  `work_p_actions_date_completed` date DEFAULT NULL,
  `work_p_actions_task` text,
  `work_p_actions_comments` text,
  `work_p_actions_is_complete` tinyint(1) DEFAULT NULL,
  `work_p_actions_created` datetime DEFAULT NULL,
  `work_p_actions_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_p_actions - A child table that holds all related action items/tasks for a P phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_p_consultants`
--

CREATE TABLE `work_p_consultants` (
  `work_p_consultants_id` int(10) UNSIGNED NOT NULL,
  `work_p_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `addr_id` int(10) UNSIGNED NOT NULL,
  `work_p_consultants_role` varchar(45) DEFAULT NULL,
  `work_p_consultants_created` datetime DEFAULT NULL,
  `work_p_consultants_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_p_consultants - A child table that holds all related consultants that may be working on a P phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_p_delays`
--

CREATE TABLE `work_p_delays` (
  `work_p_delays_id` int(10) UNSIGNED NOT NULL,
  `work_p_id` int(10) UNSIGNED NOT NULL,
  `work_p_milestones_id` int(10) UNSIGNED NOT NULL,
  `work_p_delays_reason` text,
  `work_p_delays_finalized_date` date DEFAULT NULL,
  `work_p_delays_caused` int(1) DEFAULT NULL,
  `work_p_created` datetime DEFAULT NULL,
  `work_p_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_p_delays - A child tbale that holds all related work delay information for a P phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_p_discussions`
--

CREATE TABLE `work_p_discussions` (
  `work_p_discussions_id` int(10) UNSIGNED NOT NULL,
  `work_p_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `work_p_discussions_entry` text,
  `work_p_discussions_created` datetime DEFAULT NULL,
  `work_p_discussions_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_p_discussions - A child table that holds all relevant discussions for a P phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_p_milestones`
--

CREATE TABLE `work_p_milestones` (
  `work_p_milestones_id` int(10) UNSIGNED NOT NULL,
  `work_p_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `work_p_common_milestones_id` int(10) UNSIGNED NOT NULL,
  `work_p_milestones_value` date DEFAULT NULL,
  `work_p_milestones_created` datetime DEFAULT NULL,
  `work_p_milestones_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_p_milestones - A child table that holds all milestone events for a P phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_p_team`
--

CREATE TABLE `work_p_team` (
  `work_p_team_id` int(10) UNSIGNED NOT NULL,
  `work_p_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `work_p_team_leader` tinyint(1) DEFAULT NULL,
  `work_p_team_created` datetime DEFAULT NULL,
  `work_p_team_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_p_team - A child table that holds all related employees assigned to the P phase of a Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s`
--

CREATE TABLE `work_s` (
  `work_s_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a S phase work project.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Refernces to ''work_id'' of parent table ''work''.',
  `work_s_assoc_num` varchar(45) DEFAULT NULL COMMENT 'Defines associated numbers',
  `work_s_number` int(10) UNSIGNED NOT NULL COMMENT '	The actual S phase ID',
  `work_status_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key. Defines the status of the S phase.  Refers to values held in table ''work_status''.',
  `work_s_percentcomp` decimal(10,2) DEFAULT NULL COMMENT 'Defines a percentage of completion for the S phase.',
  `work_s_sow` text COMMENT 'Statement of work definition in text',
  `work_s_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a change to the S phase entry was created.',
  `work_s_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a change to the entry was created.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s - A child table that contains all relevant project informatino related to S phase projects.  All child tables underneath this table will begin with work_s_.';

-- --------------------------------------------------------

--
-- Table structure for table `work_status`
--

CREATE TABLE `work_status` (
  `work_status_id` int(10) UNSIGNED NOT NULL,
  `work_status_desc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_status - A lookup table of all work status that a Work assignment as well as independent phases under a Work assignment.';

--
-- Dumping data for table `work_status`
--

INSERT INTO `work_status` (`work_status_id`, `work_status_desc`) VALUES
(1, 'Closed'),
(2, 'Open'),
(3, 'On Hold'),
(4, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `work_s_acct_info`
--

CREATE TABLE `work_s_acct_info` (
  `work_s_acct_info_id` int(10) UNSIGNED NOT NULL,
  `work_s_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `work_s_acct_info_istm` tinyint(1) DEFAULT NULL COMMENT 'A flagging field to define if a S phase is a Time and Materials job.',
  `work_s_acct_info_pinv` decimal(10,2) DEFAULT NULL COMMENT 'Defines the current amount invoiced.',
  `work_s_acct_info_last_invoice_date` date DEFAULT NULL COMMENT 'Defines the last date of invoice.',
  `work_s_acct_info_contract_value` decimal(15,2) DEFAULT NULL COMMENT 'Defines the dollar amount of a S phase work.',
  `work_s_acct_info_amount_inv_todate` decimal(15,2) DEFAULT NULL COMMENT 'Defines the acutal amount invoiced to date.',
  `work_s_acct_info_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a particular milestone entry was created.',
  `work_s_acct_info_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a particular milestone entry was last updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_acct_info - A child table that holds all relevant accounting information for a S phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s_actions`
--

CREATE TABLE `work_s_actions` (
  `work_s_actions_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for a action assignment entry.',
  `work_s_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References ''work_s_id'' on parent table ''work_s''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References ''work_id'' on master table ''work''.',
  `work_s_actions_assignedto` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Defines who an action task was assigned.  References ''employee_id'' from table ''employees''.',
  `work_s_actions_assigned` date DEFAULT NULL COMMENT 'Defines the date the action assignment was assigned.',
  `work_s_actions_due` date DEFAULT NULL COMMENT 'Defines the due date of a particular action assignment entry.',
  `work_s_actions_date_completed` date DEFAULT NULL COMMENT 'Defines the actual date the action task was completed.',
  `work_s_actions_task` text COMMENT 'Definition of the task assigned in plain text.',
  `work_s_actions_comments` text COMMENT 'Defines any comments related to an action task entry.',
  `work_s_actions_is_complete` tinyint(1) DEFAULT NULL COMMENT 'A flagging field to define if a item has been completed or not. (0 = false; 1 = true).',
  `work_s_actions_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a particular milestone entry was created.',
  `work_s_actions_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a particular milestone entry was last updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_actions - A child table that holds all related action items/tasks for a S phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s_consultants`
--

CREATE TABLE `work_s_consultants` (
  `work_s_consultants_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  Unique identifier for S phase work consultant entry.',
  `work_s_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References the ''work_s_id'' on the parent table ''work_s''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References the ''work_id'' value on the master table ''work''.',
  `addr_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Defines a consultant for the entry.  References ''addr_id'' on the ''addr'' table.',
  `work_s_consultants_role` varchar(45) DEFAULT NULL COMMENT 'Defines the role a consultant plays on the S phase in plain text.',
  `work_s_consultants_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a particular milestone entry was created.',
  `work_s_consultants_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a particular milestone entry was last updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_consultants - A child table that holds all related consultants that may be working on a S phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s_delays`
--

CREATE TABLE `work_s_delays` (
  `work_s_delays_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  A unique identifier for a work delay entry.',
  `work_s_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_s_id'' on parent table ''work_s''.',
  `work_s_milestones_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References a milestone value that has been impacted by delay.  References ''work_s_milestones_id'' on table ''work_s_milestones''.',
  `work_s_delays_reason` text COMMENT 'Reason for delay written in plain text.',
  `work_s_delays_finalized_date` date DEFAULT NULL,
  `work_s_delays_cause` int(1) DEFAULT NULL COMMENT 'An identifier table to mark if a delay was caused by internal issues (value = 0) or external issues (value = 1)',
  `work_s_delays_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a particular milestone entry was created.',
  `work_s_delays_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a particular milestone entry was last updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_delays - A child tbale that holds all related work delay information for a S phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s_discussions`
--

CREATE TABLE `work_s_discussions` (
  `work_s_discussions_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  A unique identifier for a S phase discussion entry.',
  `work_s_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_s_id'' on parent table ''work_s''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_id'' on parent table ''work''.',
  `work_s_discussions_entry` text COMMENT 'Discussion entry in plain text.',
  `work_s_discussions_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a particular milestone entry was created.',
  `work_s_discussions_updated` timestamp NULL DEFAULT NULL COMMENT 'Historical reference as to when a particular milestone entry was last updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_discussions - A child table that holds all relevant discussions for a S phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s_manhours`
--

CREATE TABLE `work_s_manhours` (
  `work_s_manhours_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key. Unique identifier for a manhour entry in S phase.',
  `work_s_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_s_id'' on parent table ''work_s''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_id'' on parent table ''work''.',
  `common_roles_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Defines the label of the manhour entry.  References ''common_roles_id'' on table ''common_roles''.',
  `work_s_manhours_accounting_est` int(11) DEFAULT NULL COMMENT 'Defines the values of ESTIMATED manhours prescribed for an S phase manhour entry.',
  `work_s_manhours_accounting_act` int(11) DEFAULT NULL COMMENT 'Defines the values of ACTUAL manhours prescribed for an S phase manhour entry.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_manhours - A child table that holds all programmed manhour information related to a S Phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s_milestones`
--

CREATE TABLE `work_s_milestones` (
  `work_s_milestones_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key. Unique identifier for a S phase milestone entry.',
  `work_s_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_s_id'' on parent table ''work_s''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Reference to the master record in table ''work''.',
  `work_s_common_milestones_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Defines the descrptive labeling of a milestone.  References table ''common_support_milestones''.',
  `work_s_milestones_value` date DEFAULT NULL COMMENT 'Defines the due date of the milestone.',
  `work_s_milestones_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a particular milestone entry was created.',
  `work_s_milestones_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a particular milestone entry was last updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_milestones - A child table that holds all milestone events for a S phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s_rfisubs_log`
--

CREATE TABLE `work_s_rfisubs_log` (
  `work_s_rfisubs_log_id` int(10) UNSIGNED NOT NULL,
  `work_s_id` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `work_s_rfisubs_log_type` int(1) NOT NULL COMMENT 'Flagging field to define if an entry is a RFI or Submittal (0 = RFI; 1 = Submittal).',
  `work_s_rfisubs_log_status` int(11) NOT NULL COMMENT 'A flagging field to define the status of a RFILOG entery. (0 = closed; 1 = open)',
  `work_s_rfisubs_log_internal_track` int(5) DEFAULT NULL COMMENT 'Defines a INTERNAL tracking number for the entry',
  `work_s_rfisubs_log_external_track` varchar(45) DEFAULT NULL COMMENT 'Defines the EXTERNAL tracking number from client organization',
  `work_s_rfisubs_log_receivedby` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References ''employee_id'' on the table ''employee''.',
  `work_s_rfisubs_log_qty_recieved` int(11) DEFAULT NULL COMMENT 'Defines the quantity of inquries recieved from other party.',
  `work_s_rfisubs_log_due_date` date DEFAULT NULL COMMENT 'Defines the due date of the entry.',
  `work_s_rfisubs_log_subject` varchar(255) DEFAULT NULL COMMENT 'Defines the subject matter of the RFISUB entry.',
  `work_s_rfisubs_log_disposition` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References ''common_rfisubs_responses_id'' on table ''common_rfisubs_responses'' table.',
  `work_s_rfisubs_log_notes` text COMMENT 'Defines and notes on the entry in plaintext.',
  `work_s_rfisubs_log_date_returned` date DEFAULT NULL COMMENT 'Defines the date the response was returned.',
  `work_s_rfisubs_log_qty_returned` int(3) DEFAULT NULL COMMENT 'Defines the amount of responses returned',
  `work_s_rfisubs_log_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a particular milestone entry was created.',
  `work_s_rfisubs_log_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a particular milestone entry was last updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_rfisub_log - A Child table that holds all RFI/Submittal infromation for a S phase Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s_rfisubs_log_reviewers`
--

CREATE TABLE `work_s_rfisubs_log_reviewers` (
  `work_s_rfisubs_log_reviewers_id` int(10) UNSIGNED NOT NULL,
  `work_s_rfisubs_log_id` int(10) UNSIGNED NOT NULL,
  `work_s_rfisubs_log_reviewers_employee` int(10) UNSIGNED DEFAULT NULL,
  `work_s_rfisubs_log_reviewers_consultants` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_rfisubs_log_reviewers - A child table that holds all related reviewers of RFI/Submittal entries.';

-- --------------------------------------------------------

--
-- Table structure for table `work_s_team`
--

CREATE TABLE `work_s_team` (
  `work_s_team_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  A unique identifier for a work team entry.',
  `work_s_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References value ''work_s_id'' on parent table ''work_s''.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References to ''work_id'' on master table ''work''.',
  `employee_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  References a ''employee_id'' on the table ''employee''.',
  `work_s_team_leader` tinyint(1) DEFAULT NULL COMMENT 'A flagging field to designate the entry as the team leader (0 = false; 1 = true).',
  `work_s_team_created` datetime DEFAULT NULL COMMENT 'Historical reference as to when a particular milestone entry was created.',
  `work_s_team_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Historical reference as to when a particular milestone entry was last updated.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_s_team - A child table that holds all related employees assigned to the S phase of a Work assignment.';

-- --------------------------------------------------------

--
-- Table structure for table `work_tags`
--

CREATE TABLE `work_tags` (
  `work_tags_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key.  A unique identifier for a work tag entry.',
  `work_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Used to associate an entry to a particular work entry. References ''work_id'' from table ''work''.',
  `common_work_tags_id` int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key.  Used to define a tag that is associated to the entry.  References ''common_work_tags_id'' from table ''common_work_tags''.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='work_tags - A table that holds tagging information for each work entry.';

-- --------------------------------------------------------

--
-- Structure for view `view_addr_formal`
--
DROP TABLE IF EXISTS `view_addr_formal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_addr_formal`  AS  select `addr`.`addr_id` AS `addr_id`,`addr`.`addr_fname` AS `addr_fname`,`addr`.`addr_lname` AS `addr_lname`,`addr`.`addr_suffix` AS `addr_suffix`,`common_suffix`.`common_suffix_abbr` AS `common_suffix_abbr`,`addr`.`addr_org_id` AS `addr_org_id`,`addr_orgs`.`addr_orgs_name` AS `addr_org`,`addr`.`addr_org_phone` AS `addr_org_phone`,`addr`.`addr_org_fax` AS `addr_org_fax`,`addr`.`addr_address_1` AS `addr_address_1`,`addr`.`addr_address_2` AS `addr_address_2`,`addr`.`addr_city` AS `addr_city`,`organization`.`common_usstates_abbr` AS `addr_state`,`addr`.`addr_postcode` AS `addr_postcode`,`common_countries`.`common_countries_full` AS `addr_country`,`addr`.`addr_org_phone_ext` AS `addr_org_phone_ext`,`addr`.`addr_direct` AS `addr_direct`,`addr`.`addr_mobile` AS `addr_mobile`,`addr`.`addr_email` AS `addr_email` from ((((`addr` left join `common_countries` on((`common_countries`.`common_countries_id` = `addr`.`addr_country`))) left join `common_usstates` `organization` on((`organization`.`common_usstates_id` = `addr`.`addr_state`))) left join `addr_orgs` on((`addr_orgs`.`addr_orgs_id` = `addr`.`addr_org_id`))) left join `common_suffix` on((`addr`.`addr_suffix` = `common_suffix`.`common_suffix_id`))) order by `addr`.`addr_lname` ;

-- --------------------------------------------------------

--
-- Structure for view `view_work_j_milestones`
--
DROP TABLE IF EXISTS `view_work_j_milestones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_work_j_milestones`  AS  select `work_j_milestones`.`work_j_milestones_id` AS `work_j_milestones_id`,`work_j_milestones`.`work_j_id` AS `work_j_id`,`common_eng_milestones`.`common_eng_milestones_desc` AS `common_eng_milestones_desc`,`common_eng_milestones`.`common_eng_milestones_group` AS `common_eng_milestones_group`,`work_j_milestones`.`work_j_milestones_value` AS `work_j_milestones_value`,`work_j_milestones`.`work_j_milestones_created` AS `work_j_milestones_created`,`work_j_milestones`.`work_j_milestones_updated` AS `work_j_milestones_updated` from (`work_j_milestones` left join `common_eng_milestones` on((`work_j_milestones`.`work_j_common_milestones_id` = `common_eng_milestones`.`common_eng_milestones_id`))) order by `common_eng_milestones`.`common_eng_milestones_group`,`common_eng_milestones`.`common_eng_milestones_desc` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addr`
--
ALTER TABLE `addr`
  ADD PRIMARY KEY (`addr_id`),
  ADD KEY `fk_addr-states_idx` (`addr_state`),
  ADD KEY `fk_addr-countries_idx` (`addr_country`),
  ADD KEY `fk_addr-suffix_idx` (`addr_suffix`),
  ADD KEY `fk_addr-prefix_idx` (`addr_prefix`),
  ADD KEY `fk_addr-orgs_idx` (`addr_org_id`);

--
-- Indexes for table `addr_orgs`
--
ALTER TABLE `addr_orgs`
  ADD PRIMARY KEY (`addr_orgs_id`);

--
-- Indexes for table `common_cons_milestones`
--
ALTER TABLE `common_cons_milestones`
  ADD PRIMARY KEY (`common_cons_milestones_id`);

--
-- Indexes for table `common_countries`
--
ALTER TABLE `common_countries`
  ADD PRIMARY KEY (`common_countries_id`);

--
-- Indexes for table `common_eng_milestones`
--
ALTER TABLE `common_eng_milestones`
  ADD PRIMARY KEY (`common_eng_milestones_id`);

--
-- Indexes for table `common_prefix`
--
ALTER TABLE `common_prefix`
  ADD PRIMARY KEY (`common_prefix_id`);

--
-- Indexes for table `common_prop_milestones`
--
ALTER TABLE `common_prop_milestones`
  ADD PRIMARY KEY (`common_prop_milestones_id`);

--
-- Indexes for table `common_rfisub_responses`
--
ALTER TABLE `common_rfisub_responses`
  ADD PRIMARY KEY (`common_rfisub_responses_id`);

--
-- Indexes for table `common_roles`
--
ALTER TABLE `common_roles`
  ADD PRIMARY KEY (`common_roles_id`);

--
-- Indexes for table `common_suffix`
--
ALTER TABLE `common_suffix`
  ADD PRIMARY KEY (`common_suffix_id`);

--
-- Indexes for table `common_support_milestones`
--
ALTER TABLE `common_support_milestones`
  ADD PRIMARY KEY (`common_support_milestones_id`);

--
-- Indexes for table `common_usstates`
--
ALTER TABLE `common_usstates`
  ADD PRIMARY KEY (`common_usstates_id`);

--
-- Indexes for table `common_work_tags`
--
ALTER TABLE `common_work_tags`
  ADD PRIMARY KEY (`common_work_tags_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `fk_common_usstates_state_idx` (`employee_state`),
  ADD KEY `fk_common_countries_country_idx` (`employee_country`),
  ADD KEY `fk_employee-prefix_idx` (`employee_prefix`),
  ADD KEY `fk_employee-suffix_idx` (`employee_suffix`),
  ADD KEY `fk_employee-status_idx` (`employee_status`),
  ADD KEY `fk_employee-secacl_idx` (`employee_acl`);

--
-- Indexes for table `employee_status`
--
ALTER TABLE `employee_status`
  ADD PRIMARY KEY (`employee_status_id`);

--
-- Indexes for table `security_acl_groups`
--
ALTER TABLE `security_acl_groups`
  ADD PRIMARY KEY (`security_acl_id`);

--
-- Indexes for table `security_sessions`
--
ALTER TABLE `security_sessions`
  ADD PRIMARY KEY (`security_sessions_id`),
  ADD KEY `fk_sec_empid_idx` (`employee_id`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`work_id`),
  ADD KEY `fk_work_status_idx` (`work_status`),
  ADD KEY `fk_work_client_id_idx` (`work_client_rep`),
  ADD KEY `fk_client_id_idx` (`work_client`);

--
-- Indexes for table `work_b`
--
ALTER TABLE `work_b`
  ADD PRIMARY KEY (`work_b_id`),
  ADD KEY `fk_work_b-status_id_idx` (`work_status_id`),
  ADD KEY `fk_work_b-work_id_idx` (`work_id`);

--
-- Indexes for table `work_b_actions`
--
ALTER TABLE `work_b_actions`
  ADD PRIMARY KEY (`work_b_actions_id`),
  ADD KEY `fk_b_actions-work_b_id_idx` (`work_b_id`),
  ADD KEY `fk_b_actions-employee_id_idx` (`work_b_actions_assignedto`);

--
-- Indexes for table `work_b_discussions`
--
ALTER TABLE `work_b_discussions`
  ADD PRIMARY KEY (`work_b_discussions_id`,`work_b_discussions_updated`),
  ADD KEY `fk_b_discussions-work_b_id_idx` (`work_b_id`);

--
-- Indexes for table `work_b_milestones`
--
ALTER TABLE `work_b_milestones`
  ADD PRIMARY KEY (`work_b_milestones_id`),
  ADD KEY `fk_b_milestones-common_cons_milestones_id_idx` (`work_b_milestones_common_id`),
  ADD KEY `fk_b_milestones-b-id_idx` (`work_b_id`);

--
-- Indexes for table `work_b_subcontractors`
--
ALTER TABLE `work_b_subcontractors`
  ADD PRIMARY KEY (`work_b_subcontractors_id`),
  ADD KEY `fk_b_subconsultants_work_id_idx` (`work_b_id`),
  ADD KEY `fk_b_subcontractors_addr_id_idx` (`addr_id`);

--
-- Indexes for table `work_b_team`
--
ALTER TABLE `work_b_team`
  ADD PRIMARY KEY (`work_b_team_id`),
  ADD KEY `fk_b_team_work_id_idx` (`work_b_id`),
  ADD KEY `fk_b_team_employee_id_idx` (`employee_id`);

--
-- Indexes for table `work_c`
--
ALTER TABLE `work_c`
  ADD PRIMARY KEY (`work_c_id`),
  ADD KEY `fk_work_c_status_id_idx` (`work_status_id`),
  ADD KEY `fk_c_work-work_id_idx` (`work_id`);

--
-- Indexes for table `work_c_discussions`
--
ALTER TABLE `work_c_discussions`
  ADD PRIMARY KEY (`work_c_discussions_id`),
  ADD KEY `fk_work_c_discussions_work_c_work_c_id_idx` (`work_c_id`);

--
-- Indexes for table `work_c_milestones`
--
ALTER TABLE `work_c_milestones`
  ADD PRIMARY KEY (`work_c_milestones_id`),
  ADD UNIQUE KEY `work_c_milestones_created_UNIQUE` (`work_c_milestones_created`),
  ADD KEY `fk_work_c_milestones_common_cons_milestones_common_cons_mil_idx` (`common_cons_milestones_id`),
  ADD KEY `fk_work_c_milestones_work_c_work_c_id_idx` (`work_c_id`);

--
-- Indexes for table `work_c_subcontractors`
--
ALTER TABLE `work_c_subcontractors`
  ADD PRIMARY KEY (`work_c_subcontractors_id`),
  ADD KEY `fk_work_c_subcontractors_work_c_work_c_id_idx` (`work_c_id`),
  ADD KEY `fk_work_c_subcontractor_addr_addr_id_idx` (`addr_id`);

--
-- Indexes for table `work_c_team`
--
ALTER TABLE `work_c_team`
  ADD PRIMARY KEY (`work_c_team_id`),
  ADD KEY `fk_work_c_team_employeee_employee_id_idx` (`employee_id`),
  ADD KEY `fk_work_c_team_work_c_work_c_id_idx` (`work_c_id`);

--
-- Indexes for table `work_j`
--
ALTER TABLE `work_j`
  ADD PRIMARY KEY (`work_j_id`),
  ADD KEY `fk_work_status_id_idx` (`work_status_id`),
  ADD KEY `fk_work_j-work_id_idx` (`work_id`);

--
-- Indexes for table `work_j_acct_info`
--
ALTER TABLE `work_j_acct_info`
  ADD PRIMARY KEY (`work_j_acct_info_id`),
  ADD KEY `fk_work_j_id_idx` (`work_j_id`);

--
-- Indexes for table `work_j_acct_info_mods`
--
ALTER TABLE `work_j_acct_info_mods`
  ADD PRIMARY KEY (`work_j_acct_info_mods_id`),
  ADD KEY `fk_j_acct_info_mods-acct_info_idx` (`work_j_acct_info_id`);

--
-- Indexes for table `work_j_acct_info_notes`
--
ALTER TABLE `work_j_acct_info_notes`
  ADD PRIMARY KEY (`work_j_acct_info_notes_id`),
  ADD KEY `fk_acct_info_notes-work_acct_info_idx` (`work_j_acct_info_id`);

--
-- Indexes for table `work_j_acct_inv`
--
ALTER TABLE `work_j_acct_inv`
  ADD PRIMARY KEY (`work_j_acct_inv_id`),
  ADD KEY `fj_j_acct_inv-acct_info_id_idx` (`work_j_acct_info_id`);

--
-- Indexes for table `work_j_acct_subs`
--
ALTER TABLE `work_j_acct_subs`
  ADD PRIMARY KEY (`work_j_acct_subs_id`),
  ADD KEY `fj_j_acct_subs-acct_info_id_idx` (`work_j_acct_info_id`),
  ADD KEY `fj_j_acct_subs-j_consultants_idx` (`work_j_consultants`);

--
-- Indexes for table `work_j_acct_subs_inv`
--
ALTER TABLE `work_j_acct_subs_inv`
  ADD PRIMARY KEY (`work_j_acct_subs_inv_id`),
  ADD KEY `fk_subs_inv-acct_subs_idx` (`work_j_acct_subs_id`),
  ADD KEY `fk_subs_inv-acct_info_id_idx` (`work_j_acct_info_id`);

--
-- Indexes for table `work_j_actions`
--
ALTER TABLE `work_j_actions`
  ADD PRIMARY KEY (`work_j_actions_id`),
  ADD KEY `fk_work_j_id_idx` (`work_j_id`),
  ADD KEY `fk_work_j_actions_employees_work_j_actions_assignedto_idx` (`work_j_actions_assignedto`);

--
-- Indexes for table `work_j_consultants`
--
ALTER TABLE `work_j_consultants`
  ADD PRIMARY KEY (`work_j_consultants_id`),
  ADD KEY `fk_addr_id_idx` (`addr_id`),
  ADD KEY `fk_work_j_id_idx` (`work_j_id`),
  ADD KEY `fk_j_consultants-common_roles_id_idx` (`common_roles_id`);

--
-- Indexes for table `work_j_delays`
--
ALTER TABLE `work_j_delays`
  ADD PRIMARY KEY (`work_j_delays_id`),
  ADD KEY `fk_j_delays-work_j_id_idx` (`work_j_id`),
  ADD KEY `fk_j_delays_work_j_milestones_id_idx` (`work_j_milestones_id`);

--
-- Indexes for table `work_j_discussions`
--
ALTER TABLE `work_j_discussions`
  ADD PRIMARY KEY (`work_j_discussions_id`),
  ADD KEY `fk_work_j_discussions_work_j_work_j_id_idx` (`work_j_id`);

--
-- Indexes for table `work_j_manhours`
--
ALTER TABLE `work_j_manhours`
  ADD PRIMARY KEY (`work_j_manhours_id`),
  ADD KEY `fk_work_j_id_idx` (`work_j_id`),
  ADD KEY `fk_common_roles_id_idx` (`common_roles_id`);

--
-- Indexes for table `work_j_milestones`
--
ALTER TABLE `work_j_milestones`
  ADD PRIMARY KEY (`work_j_milestones_id`),
  ADD KEY `fk_work_j_id_idx` (`work_j_id`),
  ADD KEY `fk_common_eng_milestones_idx` (`work_j_common_milestones_id`);

--
-- Indexes for table `work_j_rfisub_log`
--
ALTER TABLE `work_j_rfisub_log`
  ADD PRIMARY KEY (`work_j_rfisub_log_id`),
  ADD KEY `fk_work_j_rfisub_log_common_rfisub_responses_work_j_rfisu_idx` (`work_j_rfisub_log_disposition`),
  ADD KEY `fk_work_j_rfisub_log_work_j_work_j_id_idx` (`work_j_id`),
  ADD KEY `fk_work_j_rfisub_log_employee_work_j_rfisub_recievedby_idx` (`work_j_rfisub_log_receivedby`);

--
-- Indexes for table `work_j_rfisub_log_reviewers`
--
ALTER TABLE `work_j_rfisub_log_reviewers`
  ADD PRIMARY KEY (`work_j_rfisub_log_reviewers_id`),
  ADD KEY `fk_work_j_rfisub_log_reviewrs_employee_work_j_rfisub_log__idx` (`work_j_rfisub_log_reviewers_employee`),
  ADD KEY `fk_work_j_rfisub_log_reviewers_workj_rfisub_log_work_j_lo_idx` (`work_j_rfisub_log_id`),
  ADD KEY `fk_j_rfisubs-j_consultant_idx` (`work_j_rfisub_log_reviewers_consultants`);

--
-- Indexes for table `work_j_team`
--
ALTER TABLE `work_j_team`
  ADD PRIMARY KEY (`work_j_team_id`),
  ADD KEY `fk_employee_id_idx` (`employee_id`),
  ADD KEY `fk_work_j_id_idx` (`work_j_id`),
  ADD KEY `fk_j_team-common_roles_idx` (`common_roles_id`);

--
-- Indexes for table `work_p`
--
ALTER TABLE `work_p`
  ADD PRIMARY KEY (`work_p_id`),
  ADD KEY `fk_work_p-status_id_idx` (`work_status_id`),
  ADD KEY `fk_work_p-work_id_idx` (`work_id`);

--
-- Indexes for table `work_p_acct_info`
--
ALTER TABLE `work_p_acct_info`
  ADD PRIMARY KEY (`work_p_acct_id`),
  ADD KEY `fk_p_acct-work_p_id_idx` (`work_p_id`);

--
-- Indexes for table `work_p_actions`
--
ALTER TABLE `work_p_actions`
  ADD PRIMARY KEY (`work_p_actions_id`),
  ADD KEY `fk_p_actions-p_id_idx` (`work_p_id`),
  ADD KEY `fk_p_actions_assignedto-employee_id_idx` (`work_p_actions_assignedto`);

--
-- Indexes for table `work_p_consultants`
--
ALTER TABLE `work_p_consultants`
  ADD PRIMARY KEY (`work_p_consultants_id`),
  ADD KEY `fk_p_consultants-p_id_idx` (`work_p_id`),
  ADD KEY `fk_p_consultants-addr_id_idx` (`addr_id`);

--
-- Indexes for table `work_p_delays`
--
ALTER TABLE `work_p_delays`
  ADD PRIMARY KEY (`work_p_delays_id`),
  ADD KEY `fk_p_delays-work_p_id_idx` (`work_p_id`),
  ADD KEY `fk_p_delays-milestones_id_idx` (`work_p_milestones_id`);

--
-- Indexes for table `work_p_discussions`
--
ALTER TABLE `work_p_discussions`
  ADD PRIMARY KEY (`work_p_discussions_id`),
  ADD KEY `fk_p_discussions-work_p_id_idx` (`work_p_id`);

--
-- Indexes for table `work_p_milestones`
--
ALTER TABLE `work_p_milestones`
  ADD PRIMARY KEY (`work_p_milestones_id`),
  ADD KEY `fk_work_p_id-work_id_idx` (`work_p_id`),
  ADD KEY `fk_common_milestones-prop_ms_id_idx` (`work_p_common_milestones_id`);

--
-- Indexes for table `work_p_team`
--
ALTER TABLE `work_p_team`
  ADD PRIMARY KEY (`work_p_team_id`),
  ADD KEY `fk_p_team-work_p_id_idx` (`work_p_id`),
  ADD KEY `fk_p_team-employee_id_idx` (`employee_id`);

--
-- Indexes for table `work_s`
--
ALTER TABLE `work_s`
  ADD PRIMARY KEY (`work_s_id`),
  ADD KEY `fk_work_s-work_status_id_idx` (`work_status_id`),
  ADD KEY `fk_work_s-work-id_idx` (`work_id`);

--
-- Indexes for table `work_status`
--
ALTER TABLE `work_status`
  ADD PRIMARY KEY (`work_status_id`);

--
-- Indexes for table `work_s_acct_info`
--
ALTER TABLE `work_s_acct_info`
  ADD PRIMARY KEY (`work_s_acct_info_id`),
  ADD KEY `fk_work_s_acct_info-work_s_id_idx` (`work_s_id`);

--
-- Indexes for table `work_s_actions`
--
ALTER TABLE `work_s_actions`
  ADD PRIMARY KEY (`work_s_actions_id`),
  ADD KEY `fk_work_s_actions-work_s_id_idx` (`work_s_id`),
  ADD KEY `fk_work_s_assignedto-employee_id_idx` (`work_s_actions_assignedto`);

--
-- Indexes for table `work_s_consultants`
--
ALTER TABLE `work_s_consultants`
  ADD PRIMARY KEY (`work_s_consultants_id`),
  ADD KEY `fk_work_s_consultants-work_s_id_idx` (`work_s_id`),
  ADD KEY `fk_work_s_consultants-addr_id_idx` (`addr_id`);

--
-- Indexes for table `work_s_delays`
--
ALTER TABLE `work_s_delays`
  ADD PRIMARY KEY (`work_s_delays_id`),
  ADD KEY `fk_work_s_delays-work_s_id_idx` (`work_s_id`),
  ADD KEY `fk_work_s_delays-work_s_milestones_id_idx` (`work_s_milestones_id`);

--
-- Indexes for table `work_s_discussions`
--
ALTER TABLE `work_s_discussions`
  ADD PRIMARY KEY (`work_s_discussions_id`),
  ADD KEY `fk_work_s_discussions-work_s_id_idx` (`work_s_id`);

--
-- Indexes for table `work_s_manhours`
--
ALTER TABLE `work_s_manhours`
  ADD PRIMARY KEY (`work_s_manhours_id`),
  ADD KEY `fk_work_s_manhours-common_roles_id_idx` (`common_roles_id`),
  ADD KEY `fk_work_s_manhours-work_s_id_idx` (`work_s_id`);

--
-- Indexes for table `work_s_milestones`
--
ALTER TABLE `work_s_milestones`
  ADD PRIMARY KEY (`work_s_milestones_id`),
  ADD KEY `fk_work_s_milestones-common_milestones_id_idx` (`work_s_common_milestones_id`),
  ADD KEY `fk_work_s_milestones-work_s_id_idx` (`work_s_id`);

--
-- Indexes for table `work_s_rfisubs_log`
--
ALTER TABLE `work_s_rfisubs_log`
  ADD PRIMARY KEY (`work_s_rfisubs_log_id`),
  ADD KEY `fk_work_s_rfisubs_log-work_s_id_idx` (`work_s_id`),
  ADD KEY `fk_work_s-rfisubs_log-employee_id_idx` (`work_s_rfisubs_log_receivedby`),
  ADD KEY `fk_work_s_rfisubs_log-response_id_idx` (`work_s_rfisubs_log_disposition`);

--
-- Indexes for table `work_s_rfisubs_log_reviewers`
--
ALTER TABLE `work_s_rfisubs_log_reviewers`
  ADD PRIMARY KEY (`work_s_rfisubs_log_reviewers_id`),
  ADD KEY `fk_work_s_rfi-employee_id_idx` (`work_s_rfisubs_log_reviewers_employee`),
  ADD KEY `fk_work_s_rfi-addr_ir_idx` (`work_s_rfisubs_log_reviewers_consultants`),
  ADD KEY `fk_work_s_rfi-rfilog_id_idx` (`work_s_rfisubs_log_id`);

--
-- Indexes for table `work_s_team`
--
ALTER TABLE `work_s_team`
  ADD PRIMARY KEY (`work_s_team_id`),
  ADD KEY `fk_work_s_team-employee_id_idx` (`employee_id`),
  ADD KEY `fk_work_s_team-work_s_id_idx` (`work_s_id`);

--
-- Indexes for table `work_tags`
--
ALTER TABLE `work_tags`
  ADD PRIMARY KEY (`work_tags_id`),
  ADD KEY `fk_work_tags-work_id_idx` (`work_id`),
  ADD KEY `fk_common_tags-common_tags_id_idx` (`common_work_tags_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addr`
--
ALTER TABLE `addr`
  MODIFY `addr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for an address entry.', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `addr_orgs`
--
ALTER TABLE `addr_orgs`
  MODIFY `addr_orgs_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `common_cons_milestones`
--
ALTER TABLE `common_cons_milestones`
  MODIFY `common_cons_milestones_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `common_countries`
--
ALTER TABLE `common_countries`
  MODIFY `common_countries_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT for table `common_eng_milestones`
--
ALTER TABLE `common_eng_milestones`
  MODIFY `common_eng_milestones_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for a common engineering milestone label.', AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `common_prefix`
--
ALTER TABLE `common_prefix`
  MODIFY `common_prefix_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `common_prop_milestones`
--
ALTER TABLE `common_prop_milestones`
  MODIFY `common_prop_milestones_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `common_rfisub_responses`
--
ALTER TABLE `common_rfisub_responses`
  MODIFY `common_rfisub_responses_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `common_roles`
--
ALTER TABLE `common_roles`
  MODIFY `common_roles_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identified for a common role.', AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `common_suffix`
--
ALTER TABLE `common_suffix`
  MODIFY `common_suffix_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `common_support_milestones`
--
ALTER TABLE `common_support_milestones`
  MODIFY `common_support_milestones_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  A uniquie identifier for a support milestone.';
--
-- AUTO_INCREMENT for table `common_usstates`
--
ALTER TABLE `common_usstates`
  MODIFY `common_usstates_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `common_work_tags`
--
ALTER TABLE `common_work_tags`
  MODIFY `common_work_tags_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Employee ID.', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `employee_status`
--
ALTER TABLE `employee_status`
  MODIFY `employee_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `security_acl_groups`
--
ALTER TABLE `security_acl_groups`
  MODIFY `security_acl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `security_sessions`
--
ALTER TABLE `security_sessions`
  MODIFY `security_sessions_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;
--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  A unique identifier for work entries.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_b`
--
ALTER TABLE `work_b`
  MODIFY `work_b_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key. Work B ID';
--
-- AUTO_INCREMENT for table `work_b_actions`
--
ALTER TABLE `work_b_actions`
  MODIFY `work_b_actions_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Work B Actions ID.';
--
-- AUTO_INCREMENT for table `work_b_discussions`
--
ALTER TABLE `work_b_discussions`
  MODIFY `work_b_discussions_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Work B Discussion ID.';
--
-- AUTO_INCREMENT for table `work_b_milestones`
--
ALTER TABLE `work_b_milestones`
  MODIFY `work_b_milestones_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Work B Milestons ID.';
--
-- AUTO_INCREMENT for table `work_b_subcontractors`
--
ALTER TABLE `work_b_subcontractors`
  MODIFY `work_b_subcontractors_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Work B Subcontractor ID.';
--
-- AUTO_INCREMENT for table `work_b_team`
--
ALTER TABLE `work_b_team`
  MODIFY `work_b_team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Work B Team ID.';
--
-- AUTO_INCREMENT for table `work_c`
--
ALTER TABLE `work_c`
  MODIFY `work_c_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key. Unique identifier for a C phase work project.';
--
-- AUTO_INCREMENT for table `work_c_discussions`
--
ALTER TABLE `work_c_discussions`
  MODIFY `work_c_discussions_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_c_milestones`
--
ALTER TABLE `work_c_milestones`
  MODIFY `work_c_milestones_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_c_subcontractors`
--
ALTER TABLE `work_c_subcontractors`
  MODIFY `work_c_subcontractors_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_c_team`
--
ALTER TABLE `work_c_team`
  MODIFY `work_c_team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_j`
--
ALTER TABLE `work_j`
  MODIFY `work_j_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for a J phase work project.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_j_acct_info`
--
ALTER TABLE `work_j_acct_info`
  MODIFY `work_j_acct_info_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_j_acct_inv`
--
ALTER TABLE `work_j_acct_inv`
  MODIFY `work_j_acct_inv_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_j_acct_subs`
--
ALTER TABLE `work_j_acct_subs`
  MODIFY `work_j_acct_subs_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for a subs that are contracted.';
--
-- AUTO_INCREMENT for table `work_j_actions`
--
ALTER TABLE `work_j_actions`
  MODIFY `work_j_actions_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for an action assignment entry.';
--
-- AUTO_INCREMENT for table `work_j_consultants`
--
ALTER TABLE `work_j_consultants`
  MODIFY `work_j_consultants_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for a individual memebers of a the external team. ', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `work_j_delays`
--
ALTER TABLE `work_j_delays`
  MODIFY `work_j_delays_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for a work delay entry.';
--
-- AUTO_INCREMENT for table `work_j_discussions`
--
ALTER TABLE `work_j_discussions`
  MODIFY `work_j_discussions_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key. Unique identifier for a discussion entry.', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `work_j_manhours`
--
ALTER TABLE `work_j_manhours`
  MODIFY `work_j_manhours_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for a manhour entry.';
--
-- AUTO_INCREMENT for table `work_j_milestones`
--
ALTER TABLE `work_j_milestones`
  MODIFY `work_j_milestones_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for milestone enrty for a J phase work project.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work_j_rfisub_log`
--
ALTER TABLE `work_j_rfisub_log`
  MODIFY `work_j_rfisub_log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for milestone enrty for a J phase SUB/RFI entry.';
--
-- AUTO_INCREMENT for table `work_j_rfisub_log_reviewers`
--
ALTER TABLE `work_j_rfisub_log_reviewers`
  MODIFY `work_j_rfisub_log_reviewers_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_j_team`
--
ALTER TABLE `work_j_team`
  MODIFY `work_j_team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for a individual memebers of a team.', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_p`
--
ALTER TABLE `work_p`
  MODIFY `work_p_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key. Unique identifier for a P phase work project.';
--
-- AUTO_INCREMENT for table `work_p_acct_info`
--
ALTER TABLE `work_p_acct_info`
  MODIFY `work_p_acct_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_p_actions`
--
ALTER TABLE `work_p_actions`
  MODIFY `work_p_actions_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_p_consultants`
--
ALTER TABLE `work_p_consultants`
  MODIFY `work_p_consultants_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_p_delays`
--
ALTER TABLE `work_p_delays`
  MODIFY `work_p_delays_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_p_discussions`
--
ALTER TABLE `work_p_discussions`
  MODIFY `work_p_discussions_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_p_milestones`
--
ALTER TABLE `work_p_milestones`
  MODIFY `work_p_milestones_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_p_team`
--
ALTER TABLE `work_p_team`
  MODIFY `work_p_team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_s`
--
ALTER TABLE `work_s`
  MODIFY `work_s_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for a S phase work project.';
--
-- AUTO_INCREMENT for table `work_status`
--
ALTER TABLE `work_status`
  MODIFY `work_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_s_acct_info`
--
ALTER TABLE `work_s_acct_info`
  MODIFY `work_s_acct_info_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_s_actions`
--
ALTER TABLE `work_s_actions`
  MODIFY `work_s_actions_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for a action assignment entry.';
--
-- AUTO_INCREMENT for table `work_s_consultants`
--
ALTER TABLE `work_s_consultants`
  MODIFY `work_s_consultants_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for S phase work consultant entry.';
--
-- AUTO_INCREMENT for table `work_s_delays`
--
ALTER TABLE `work_s_delays`
  MODIFY `work_s_delays_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  A unique identifier for a work delay entry.';
--
-- AUTO_INCREMENT for table `work_s_discussions`
--
ALTER TABLE `work_s_discussions`
  MODIFY `work_s_discussions_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  A unique identifier for a S phase discussion entry.';
--
-- AUTO_INCREMENT for table `work_s_manhours`
--
ALTER TABLE `work_s_manhours`
  MODIFY `work_s_manhours_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key. Unique identifier for a manhour entry in S phase.';
--
-- AUTO_INCREMENT for table `work_s_milestones`
--
ALTER TABLE `work_s_milestones`
  MODIFY `work_s_milestones_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key. Unique identifier for a S phase milestone entry.';
--
-- AUTO_INCREMENT for table `work_s_rfisubs_log`
--
ALTER TABLE `work_s_rfisubs_log`
  MODIFY `work_s_rfisubs_log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_s_rfisubs_log_reviewers`
--
ALTER TABLE `work_s_rfisubs_log_reviewers`
  MODIFY `work_s_rfisubs_log_reviewers_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_s_team`
--
ALTER TABLE `work_s_team`
  MODIFY `work_s_team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  A unique identifier for a work team entry.';
--
-- AUTO_INCREMENT for table `work_tags`
--
ALTER TABLE `work_tags`
  MODIFY `work_tags_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  A unique identifier for a work tag entry.';
--
-- Constraints for dumped tables
--

--
-- Constraints for table `addr`
--
ALTER TABLE `addr`
  ADD CONSTRAINT `fk_addr-countries` FOREIGN KEY (`addr_country`) REFERENCES `common_countries` (`common_countries_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_addr-orgs` FOREIGN KEY (`addr_org_id`) REFERENCES `addr_orgs` (`addr_orgs_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_addr-prefix` FOREIGN KEY (`addr_prefix`) REFERENCES `common_prefix` (`common_prefix_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_addr-states` FOREIGN KEY (`addr_state`) REFERENCES `common_usstates` (`common_usstates_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_addr-suffix` FOREIGN KEY (`addr_suffix`) REFERENCES `common_suffix` (`common_suffix_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_employee-country` FOREIGN KEY (`employee_country`) REFERENCES `common_countries` (`common_countries_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee-prefix` FOREIGN KEY (`employee_prefix`) REFERENCES `common_prefix` (`common_prefix_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee-secacl` FOREIGN KEY (`employee_acl`) REFERENCES `security_acl_groups` (`security_acl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee-state` FOREIGN KEY (`employee_state`) REFERENCES `common_usstates` (`common_usstates_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee-status` FOREIGN KEY (`employee_status`) REFERENCES `employee_status` (`employee_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee-suffix` FOREIGN KEY (`employee_suffix`) REFERENCES `common_suffix` (`common_suffix_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `security_sessions`
--
ALTER TABLE `security_sessions`
  ADD CONSTRAINT `fk_sec_empid` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`work_client`) REFERENCES `addr_orgs` (`addr_orgs_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_client_id` FOREIGN KEY (`work_client_rep`) REFERENCES `addr` (`addr_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_status` FOREIGN KEY (`work_status`) REFERENCES `work_status` (`work_status_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `work_b`
--
ALTER TABLE `work_b`
  ADD CONSTRAINT `fk_work_b-status_id` FOREIGN KEY (`work_status_id`) REFERENCES `work_status` (`work_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_work_b-work_id` FOREIGN KEY (`work_id`) REFERENCES `work` (`work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_b_actions`
--
ALTER TABLE `work_b_actions`
  ADD CONSTRAINT `fk_b_actions-employee_id` FOREIGN KEY (`work_b_actions_assignedto`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_b_actions-work_b_id` FOREIGN KEY (`work_b_id`) REFERENCES `work_b` (`work_b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_b_discussions`
--
ALTER TABLE `work_b_discussions`
  ADD CONSTRAINT `fk_b_discussions-work_b_id` FOREIGN KEY (`work_b_id`) REFERENCES `work_b` (`work_b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_b_milestones`
--
ALTER TABLE `work_b_milestones`
  ADD CONSTRAINT `fk_b_milestones-b-id` FOREIGN KEY (`work_b_id`) REFERENCES `work_b` (`work_b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_b_milestones-common_cons_milestones_id` FOREIGN KEY (`work_b_milestones_common_id`) REFERENCES `common_cons_milestones` (`common_cons_milestones_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_b_subcontractors`
--
ALTER TABLE `work_b_subcontractors`
  ADD CONSTRAINT `fk_b_subcontractors-addr_id` FOREIGN KEY (`addr_id`) REFERENCES `addr` (`addr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_b_subcontractors-work_id` FOREIGN KEY (`work_b_id`) REFERENCES `work_b` (`work_b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_b_team`
--
ALTER TABLE `work_b_team`
  ADD CONSTRAINT `fk_b_team-employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_b_team-work_id` FOREIGN KEY (`work_b_id`) REFERENCES `work_b` (`work_b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_c`
--
ALTER TABLE `work_c`
  ADD CONSTRAINT `fk_c_work-status_id` FOREIGN KEY (`work_status_id`) REFERENCES `work_status` (`work_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_c_work-work_id` FOREIGN KEY (`work_id`) REFERENCES `work` (`work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_c_discussions`
--
ALTER TABLE `work_c_discussions`
  ADD CONSTRAINT `fk_work_c_discussions_work_c_work_c_id` FOREIGN KEY (`work_c_id`) REFERENCES `work_c` (`work_c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_c_milestones`
--
ALTER TABLE `work_c_milestones`
  ADD CONSTRAINT `fk_c_milestones-milestones_id` FOREIGN KEY (`common_cons_milestones_id`) REFERENCES `common_cons_milestones` (`common_cons_milestones_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_c_milestones-work_c_id` FOREIGN KEY (`work_c_id`) REFERENCES `work_c` (`work_c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_c_subcontractors`
--
ALTER TABLE `work_c_subcontractors`
  ADD CONSTRAINT `fk_c_subcontractor-addr_id` FOREIGN KEY (`addr_id`) REFERENCES `addr` (`addr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_c_subcontractors-work_c_id` FOREIGN KEY (`work_c_id`) REFERENCES `work_c` (`work_c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_c_team`
--
ALTER TABLE `work_c_team`
  ADD CONSTRAINT `fk_c_team-employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_c_team-work_c_id` FOREIGN KEY (`work_c_id`) REFERENCES `work_c` (`work_c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j`
--
ALTER TABLE `work_j`
  ADD CONSTRAINT `fk_work_j-status_id` FOREIGN KEY (`work_status_id`) REFERENCES `work_status` (`work_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_work_j-work_id` FOREIGN KEY (`work_id`) REFERENCES `work` (`work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_j_acct_info`
--
ALTER TABLE `work_j_acct_info`
  ADD CONSTRAINT `fk_j_acctinfo-work_j_id` FOREIGN KEY (`work_j_id`) REFERENCES `work_j` (`work_j_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_acct_info_mods`
--
ALTER TABLE `work_j_acct_info_mods`
  ADD CONSTRAINT `fk_j_acct_info_mods-acct_info` FOREIGN KEY (`work_j_acct_info_id`) REFERENCES `work_j_acct_info` (`work_j_acct_info_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `work_j_acct_info_notes`
--
ALTER TABLE `work_j_acct_info_notes`
  ADD CONSTRAINT `fk_j_acct_info_notes-work_acct_info` FOREIGN KEY (`work_j_acct_info_id`) REFERENCES `work_j_acct_info` (`work_j_acct_info_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `work_j_acct_inv`
--
ALTER TABLE `work_j_acct_inv`
  ADD CONSTRAINT `fk_j_acct_inv-acct_info_id` FOREIGN KEY (`work_j_acct_info_id`) REFERENCES `work_j_acct_info` (`work_j_acct_info_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_acct_subs`
--
ALTER TABLE `work_j_acct_subs`
  ADD CONSTRAINT `fj_j_acct_subs-j_consultants` FOREIGN KEY (`work_j_consultants`) REFERENCES `work_j_consultants` (`work_j_consultants_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_j_acct_subs-acct_info_id` FOREIGN KEY (`work_j_acct_info_id`) REFERENCES `work_j_acct_info` (`work_j_acct_info_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_j_acct_subs_inv`
--
ALTER TABLE `work_j_acct_subs_inv`
  ADD CONSTRAINT `fk_subs_inv-acct_info_id` FOREIGN KEY (`work_j_acct_info_id`) REFERENCES `work_j_acct_info` (`work_j_acct_info_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subs_inv-acct_subs_id` FOREIGN KEY (`work_j_acct_subs_id`) REFERENCES `work_j_acct_subs` (`work_j_acct_subs_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_j_actions`
--
ALTER TABLE `work_j_actions`
  ADD CONSTRAINT `fk_j_actions-employees` FOREIGN KEY (`work_j_actions_assignedto`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_j_actions-work_j_id` FOREIGN KEY (`work_j_id`) REFERENCES `work_j` (`work_j_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_consultants`
--
ALTER TABLE `work_j_consultants`
  ADD CONSTRAINT `fk_j_consultants-addr_id` FOREIGN KEY (`addr_id`) REFERENCES `addr` (`addr_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_j_consultants-common_roles_id` FOREIGN KEY (`common_roles_id`) REFERENCES `common_roles` (`common_roles_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_j_consultants-work_j_id` FOREIGN KEY (`work_j_id`) REFERENCES `work_j` (`work_j_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_delays`
--
ALTER TABLE `work_j_delays`
  ADD CONSTRAINT `fk_j_delays-work_j_id` FOREIGN KEY (`work_j_id`) REFERENCES `work_j` (`work_j_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_j_delays_work_j_milestones_id` FOREIGN KEY (`work_j_milestones_id`) REFERENCES `work_j_milestones` (`work_j_milestones_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_discussions`
--
ALTER TABLE `work_j_discussions`
  ADD CONSTRAINT `fk_j_discussions-work_j_id` FOREIGN KEY (`work_j_id`) REFERENCES `work_j` (`work_j_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_manhours`
--
ALTER TABLE `work_j_manhours`
  ADD CONSTRAINT `fk_j_manhours-roles_id` FOREIGN KEY (`common_roles_id`) REFERENCES `common_roles` (`common_roles_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_j_manhours-work_j_id` FOREIGN KEY (`work_j_id`) REFERENCES `work_j` (`work_j_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_milestones`
--
ALTER TABLE `work_j_milestones`
  ADD CONSTRAINT `fk_j_milestones-milestones_id` FOREIGN KEY (`work_j_common_milestones_id`) REFERENCES `common_eng_milestones` (`common_eng_milestones_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_j_milestones-work_j_id` FOREIGN KEY (`work_j_id`) REFERENCES `work_j` (`work_j_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_rfisub_log`
--
ALTER TABLE `work_j_rfisub_log`
  ADD CONSTRAINT `fk_j_rfisub-responses` FOREIGN KEY (`work_j_rfisub_log_disposition`) REFERENCES `common_rfisub_responses` (`common_rfisub_responses_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_j_rfisubs-recievedby` FOREIGN KEY (`work_j_rfisub_log_receivedby`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_j_rfisubs-work_j_id` FOREIGN KEY (`work_j_id`) REFERENCES `work_j` (`work_j_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_rfisub_log_reviewers`
--
ALTER TABLE `work_j_rfisub_log_reviewers`
  ADD CONSTRAINT `fk_j_rfisubs-employee` FOREIGN KEY (`work_j_rfisub_log_reviewers_employee`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_j_rfisubs-j_consultant` FOREIGN KEY (`work_j_rfisub_log_reviewers_consultants`) REFERENCES `work_j_consultants` (`work_j_consultants_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_j_rfisubs-log_id` FOREIGN KEY (`work_j_rfisub_log_id`) REFERENCES `work_j_rfisub_log` (`work_j_rfisub_log_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_j_team`
--
ALTER TABLE `work_j_team`
  ADD CONSTRAINT `fk_j_team-common_roles` FOREIGN KEY (`common_roles_id`) REFERENCES `common_roles` (`common_roles_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_j_team-employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_j_team-work_j_id` FOREIGN KEY (`work_j_id`) REFERENCES `work_j` (`work_j_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_p`
--
ALTER TABLE `work_p`
  ADD CONSTRAINT `fk_work_p-status_id` FOREIGN KEY (`work_status_id`) REFERENCES `work_status` (`work_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_work_p-work_id` FOREIGN KEY (`work_id`) REFERENCES `work` (`work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_p_acct_info`
--
ALTER TABLE `work_p_acct_info`
  ADD CONSTRAINT `fk_p_acct_info-work_p_id` FOREIGN KEY (`work_p_id`) REFERENCES `work_p` (`work_p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_p_actions`
--
ALTER TABLE `work_p_actions`
  ADD CONSTRAINT `fk_p_actions-p_id` FOREIGN KEY (`work_p_id`) REFERENCES `work_p` (`work_p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_p_actions_assignedto-employee_id` FOREIGN KEY (`work_p_actions_assignedto`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `work_p_consultants`
--
ALTER TABLE `work_p_consultants`
  ADD CONSTRAINT `fk_p_consultants-addr_id` FOREIGN KEY (`addr_id`) REFERENCES `addr` (`addr_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_p_consultants-p_id` FOREIGN KEY (`work_p_id`) REFERENCES `work_p` (`work_p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_p_delays`
--
ALTER TABLE `work_p_delays`
  ADD CONSTRAINT `fk_p_delays-work_p_id` FOREIGN KEY (`work_p_id`) REFERENCES `work_p` (`work_p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_p_delays-work_p_milestones_id` FOREIGN KEY (`work_p_milestones_id`) REFERENCES `work_p_milestones` (`work_p_milestones_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_p_discussions`
--
ALTER TABLE `work_p_discussions`
  ADD CONSTRAINT `fk_p_discussions-work_p_id` FOREIGN KEY (`work_p_id`) REFERENCES `work_p` (`work_p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_p_milestones`
--
ALTER TABLE `work_p_milestones`
  ADD CONSTRAINT `fk_common_milestones-prop_ms_id` FOREIGN KEY (`work_p_common_milestones_id`) REFERENCES `common_prop_milestones` (`common_prop_milestones_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_p_id-work_id` FOREIGN KEY (`work_p_id`) REFERENCES `work_p` (`work_p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_p_team`
--
ALTER TABLE `work_p_team`
  ADD CONSTRAINT `fk_p_team-employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_p_team-work_p_id` FOREIGN KEY (`work_p_id`) REFERENCES `work_p` (`work_p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s`
--
ALTER TABLE `work_s`
  ADD CONSTRAINT `fk_work_s-work-id` FOREIGN KEY (`work_id`) REFERENCES `work` (`work_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_work_s-work_status_id` FOREIGN KEY (`work_status_id`) REFERENCES `work_status` (`work_status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_acct_info`
--
ALTER TABLE `work_s_acct_info`
  ADD CONSTRAINT `fk_work_s_acct_info-work_s_id` FOREIGN KEY (`work_s_id`) REFERENCES `work_s` (`work_s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_actions`
--
ALTER TABLE `work_s_actions`
  ADD CONSTRAINT `fk_work_s_actions-work_s_id` FOREIGN KEY (`work_s_id`) REFERENCES `work_s` (`work_s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_assignedto-employee_id` FOREIGN KEY (`work_s_actions_assignedto`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_consultants`
--
ALTER TABLE `work_s_consultants`
  ADD CONSTRAINT `fk_work_s_consultants-addr_id` FOREIGN KEY (`addr_id`) REFERENCES `addr` (`addr_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_consultants-work_s_id` FOREIGN KEY (`work_s_id`) REFERENCES `work_s` (`work_s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_delays`
--
ALTER TABLE `work_s_delays`
  ADD CONSTRAINT `fk_work_s_delays-work_s_id` FOREIGN KEY (`work_s_id`) REFERENCES `work_s` (`work_s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_delays-work_s_milestones_id` FOREIGN KEY (`work_s_milestones_id`) REFERENCES `work_s_milestones` (`work_s_milestones_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_discussions`
--
ALTER TABLE `work_s_discussions`
  ADD CONSTRAINT `fk_work_s_discussions-work_s_id` FOREIGN KEY (`work_s_id`) REFERENCES `work_s` (`work_s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_manhours`
--
ALTER TABLE `work_s_manhours`
  ADD CONSTRAINT `fk_work_s_manhours-common_roles_id` FOREIGN KEY (`common_roles_id`) REFERENCES `common_roles` (`common_roles_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_manhours-work_s_id` FOREIGN KEY (`work_s_id`) REFERENCES `work_s` (`work_s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_milestones`
--
ALTER TABLE `work_s_milestones`
  ADD CONSTRAINT `fk_work_s_milestones-common_milestones_id` FOREIGN KEY (`work_s_common_milestones_id`) REFERENCES `common_support_milestones` (`common_support_milestones_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_milestones-work_s_id` FOREIGN KEY (`work_s_id`) REFERENCES `work_s` (`work_s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_rfisubs_log`
--
ALTER TABLE `work_s_rfisubs_log`
  ADD CONSTRAINT `fk_work_s-rfisubs_log-employee_id` FOREIGN KEY (`work_s_rfisubs_log_receivedby`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_rfisubs_log-response_id` FOREIGN KEY (`work_s_rfisubs_log_disposition`) REFERENCES `common_rfisubs_responses` (`common_rfisubs_responses_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_rfisubs_log-work_s_id` FOREIGN KEY (`work_s_id`) REFERENCES `work_s` (`work_s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_rfisubs_log_reviewers`
--
ALTER TABLE `work_s_rfisubs_log_reviewers`
  ADD CONSTRAINT `fk_work_s_rfi-addr_ir` FOREIGN KEY (`work_s_rfisubs_log_reviewers_consultants`) REFERENCES `addr` (`addr_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_rfi-employee_id` FOREIGN KEY (`work_s_rfisubs_log_reviewers_employee`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_rfi-rfilog_id` FOREIGN KEY (`work_s_rfisubs_log_id`) REFERENCES `work_s_rfisubs_log` (`work_s_rfisubs_log_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_s_team`
--
ALTER TABLE `work_s_team`
  ADD CONSTRAINT `fk_work_s_team-employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_s_team-work_s_id` FOREIGN KEY (`work_s_id`) REFERENCES `work_s` (`work_s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_tags`
--
ALTER TABLE `work_tags`
  ADD CONSTRAINT `fk_common_tags-common_tags_id` FOREIGN KEY (`common_work_tags_id`) REFERENCES `common_work_tags` (`common_work_tags_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_work_tags-work_id` FOREIGN KEY (`work_id`) REFERENCES `work` (`work_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
