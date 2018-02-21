-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2017 at 06:55 PM
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
  `addr_org` varchar(100) DEFAULT NULL COMMENT 'Defines the organization the subject belongs to.',
  `addr_address_1` varchar(255) DEFAULT NULL COMMENT 'Defines the primary address of the entry.',
  `addr_address_2` varchar(255) DEFAULT NULL COMMENT 'Defines any additional address information of the entry',
  `addr_city` varchar(255) DEFAULT NULL COMMENT 'Defines the city of the entry',
  `addr_state` int(10) UNSIGNED DEFAULT NULL COMMENT 'Defines the state of an entry',
  `addr_postcode` varchar(10) DEFAULT NULL COMMENT 'Defines the post code of an entry',
  `addr_country` int(10) UNSIGNED DEFAULT NULL COMMENT 'Foreign Key.  Defines the country of the entry.  Referenced ''common_countries_id'' from table ''common_countries''.',
  `addr_lat` decimal(10,7) DEFAULT NULL,
  `addr_lng` decimal(10,7) DEFAULT NULL,
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

INSERT INTO `addr` (`addr_id`, `addr_prefix`, `addr_fname`, `addr_lname`, `addr_mname`, `addr_nname`, `addr_suffix`, `addr_title`, `addr_org`, `addr_address_1`, `addr_address_2`, `addr_city`, `addr_state`, `addr_postcode`, `addr_country`, `addr_lat`, `addr_lng`, `addr_org_phone`, `addr_org_phone_ext`, `addr_org_fax`, `addr_direct`, `addr_mobile`, `addr_email`, `addr_url`, `addr_admin_newsletter`, `addr_admin_calendars`, `addr_admin_gifts`, `addr_type_vendor`, `addr_type_client`, `addr_type_consultant`, `addr_date_created`, `addr_date_updated`) VALUES
(1, 1, 'Sami', 'Mized\'s', 'Lutfi', 'Joe Bob', 1, 'Director Of It & Marketing', 'Cape Design Engineering Co.', '775 E. Merritt Island Cswy.', 'Suite 230', 'Merritt Island', 9, '32952', 237, '28.3565261', '-80.6882724', '321-799-2970', '104', '321-799-0375', NULL, '321-544-2856', 'samim@cdeco.com', 'cdeco.com', 0, 1, 1, 1, 1, 1, '2017-10-20 16:11:39', '2017-10-31 15:56:11'),
(12, 1, 'Test', 'Sets', 'Etsetse', 'Tsets', 1, 'Etsetse', 'Sets', '1150 St. George Rd.', NULL, 'Merritt Island', 9, '32952', 237, NULL, NULL, '321-544-2856', 'sdfsdf', '321-544-2856', '321-544-2856', '321-544-2856', 'punk0mi@gmail.com', 'sdfsdfsdf', 0, 0, 0, 0, 0, 0, '2017-11-06 11:19:40', '2017-11-06 16:19:40'),
(13, 1, 'Break', 'Middle', '', 'No', 1, 'No', 'No', '191 Center Street', NULL, 'Cape Canaveral', 9, '32920', 237, '28.3813303', '-80.6071649', '321-321-6554', '321654988', '321-684-684', '846-565-184', '418-641-641', 'no@no.com', 'no', 0, 0, 0, 0, 0, 0, '2017-11-06 14:40:35', '2017-11-06 19:40:35');

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
(1, 'Sami', 'Mized', 'Lutfi', 1, 1, '1982-07-21', '1150 St. George Rd.', NULL, 'Merritt Island', 9, '32952', 237, '(321) 544-2856', '(321) 544-2856', '2000-01-01', 1, 1, 0, 'samim', '$2y$10$pwWbwA3AuCtwOuExC4EKju1xXAkYDNdUiScU9gDeeRLSwWsU5SOwG', '2017-10-06 13:12:27', '2017-10-10 16:51:16'),
(2, 'John', 'Doe', 'Apple', 1, 8, '1985-01-01', '1234 Blah', NULL, 'Herp', 1, '12346', 237, '(321) 654-9870', '(987) 654-6540', '2002-02-02', 4, 1, 0, 'johnd', '$2y$10$epy1uZQQ1DVxO6ShY22XSO7L5KfdDhYeQYFzqjgjhh7An1OcjbUPO', '2017-10-06 16:38:16', '2017-10-10 16:50:07'),
(3, 'Jane', 'Doe', 'Lynn', 2, 8, '1986-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10', 4, 1, 0, 'janed', '$2y$10$q/WsIjatnUs67xkk7Pr05.UXKCA/tvPmYu8EPvUWmajmnIJhn/Qny', '2017-10-06 16:56:22', '2017-10-06 16:56:22'),
(4, 'Test', 'Ytest', 'Test', 1, 2, '2017-10-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-19', 4, 1, 0, 'testy', '$2y$10$t1a91ZCKQjcIFy1AOSH4suL009d9zQZuA//Zsf37nwLng3dCT73tq', '2017-10-26 16:07:24', '2017-10-26 16:07:24'),
(5, 'Larry', 'Johnson', 'Awea', 1, 11, '2017-10-12', '1150 St. George Rd.', NULL, 'Merritt Island', 9, '32952', 237, '321-544-2856', '321-544-2856', '2017-10-09', 4, 1, 0, 'testesssa', '$2y$10$CBVrBfi0KVh1p3hjCZboyufOBtd8mjVNXl93HaVqzNtb5A/93bI4i', '2017-10-26 16:07:44', '2017-11-07 10:59:10');

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
(41, 1, 1, 'laffvjoril34k3rr36g65ie4n1', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2017-11-07 14:27:39');

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
  ADD KEY `fk_addr-prefix_idx` (`addr_prefix`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addr`
--
ALTER TABLE `addr`
  MODIFY `addr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Unique identifier for an address entry.', AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `common_countries`
--
ALTER TABLE `common_countries`
  MODIFY `common_countries_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
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
  MODIFY `employee_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.  Employee ID.', AUTO_INCREMENT=6;
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
  MODIFY `security_sessions_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `addr`
--
ALTER TABLE `addr`
  ADD CONSTRAINT `fk_addr-countries` FOREIGN KEY (`addr_country`) REFERENCES `common_countries` (`common_countries_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
