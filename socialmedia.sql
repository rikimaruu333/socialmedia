-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 09:41 PM
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
-- Database: `socialmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment_content`, `comment_date`) VALUES
(6, 12, 5, 'comment 2', '2024-04-29 13:26:23'),
(7, 8, 6, 'own comment', '2024-05-01 04:27:34'),
(8, 10, 6, 'comment1 ', '2024-05-01 04:58:03'),
(9, 10, 6, 'abcdefg', '2024-05-01 05:00:09'),
(10, 10, 6, 'Gaming Setup: Neon Lights Gaming Setup: Neon Lights Gaming Setup: Neon Lights Gaming Setup: Neon Lights Gaming Setup: Neon Lights Gaming Setup: Neon Lights #socialmediam3rge #fbxintagram', '2024-05-01 07:13:29'),
(11, 12, 5, 'yoooooooooooooo', '2024-05-04 04:49:18'),
(13, 10, 6, 'wazup', '2024-05-04 04:50:47'),
(14, 10, 6, 'wazup', '2024-05-04 04:50:47'),
(15, 9, 6, 'aaaa', '2024-05-05 17:02:25'),
(16, 9, 6, 'a', '2024-05-04 04:50:58'),
(17, 11, 6, 'hey', '2024-05-04 04:52:52'),
(18, 11, 6, 'hey', '2024-05-04 04:52:52'),
(19, 8, 6, 'a', '2024-05-04 04:53:10'),
(20, 8, 6, 'a', '2024-05-04 04:53:10'),
(21, 11, 6, '', '2024-05-04 04:53:41'),
(22, 11, 6, '', '2024-05-04 04:53:41'),
(23, 12, 6, 'a', '2024-05-04 04:55:31'),
(24, 11, 6, 'bbbb', '2024-05-05 16:56:47'),
(25, 8, 6, '', '2024-05-04 04:56:15'),
(26, 12, 6, 'hi', '2024-05-04 05:18:32'),
(27, 15, 5, 'asd', '2024-05-05 03:43:22'),
(29, 17, 5, 'asbaskjfbasjkas asdas da aasbaskjfbasjkas asdas da aasbaskjfbasjkas asdas da aasbaskjfbasjkas asdas da a', '2024-05-05 15:26:35'),
(30, 12, 5, 'yo', '2024-05-05 18:49:44'),
(31, 12, 5, 'yo again', '2024-05-05 18:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `follow_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`follow_id`, `follower_id`, `following_id`) VALUES
(4, 6, 5),
(5, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `post_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `caption`, `picture`, `post_created`) VALUES
(9, 6, 'Gaming Setup: Neon Lights Gaming Setup: Neon Lights Gaming Setup: Neon Lights Gaming Setup: Neon Lights Gaming Setup: Neon Lights Gaming Setup: Neon Lights #socialmediam3rge #fbxintagram', '', '2024-04-28 08:45:29'),
(11, 5, '$(document).ready(function() {\r\n    $.ajax({\r\n        url: \'fetch_userposts.php\',\r\n        type: \'GET\',\r\n        dataType: \'json\',\r\n        success: function(response) {\r\n            if (!response.error) {\r\n                populateCard(response.postsWithP', 'pics/post_6636f96fcef44_neon lights.jpg', '2024-05-05 03:13:51'),
(12, 5, '$(document).ready(function() {\r\n    $.ajax({\r\n        url: \'fetch_userposts.php\',\r\n        type: \'GET\',\r\n        dataType: \'json\',\r\n        success: function(response) {\r\n            if (!response.error) {\r\n                populateCard(response.postsWithP', '', '2024-05-04 13:27:28'),
(13, 6, 'Post with picture', 'pics/post_6635c4cd075e0_a.jpg', '2024-05-04 05:17:01'),
(17, 5, 'testttttttttttttttttt', '', '2024-05-05 14:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `birthdate`, `gender`, `profile`, `nickname`) VALUES
(5, 'Ricky', 'Monsales', '09616186617', '$2y$10$JtUDmlv2VsA4Ez..dtQOsurkg6kqIigdgKXSQuCnvHQmJjnGKElOS', '1969-10-14', 'Male', 'pics/profile_5.png', 'shendelzaresilkwood'),
(6, 'Stealth', 'Assassin', 'rikimaru@email.com', '$2y$10$WhbgbrVaEDR.bp2GkoNHCumssGD1Dp8.zFNzBDK1W.K1oLDo9cyUq', '2010-01-01', 'Male', 'pics/profile_6.jpg', 'rikimaruu'),
(7, 'Roth', 'Gedling', 'rgedling0@deliciousdays.com', '$2a$04$9UTIC2WB4iZpVdk79d8Ucu6Sykpw/rFkcbmdL.qZadMvcmgh9pIdq', '2001-01-11', 'Female', 'pics/profile_7.jpg', 'Justice Grape Scent ANTI BAC HAND SANITIZER'),
(8, 'Jodie', 'Habergham', 'jhabergham1@arstechnica.com', '$2a$04$MxUJnpzUiCHxjkpes9iw2OPZ8u8PahYqTqUp9KIp5jjtrNd4GwD7W', '1992-12-03', 'Other', 'pics/profile_8.jpg', 'Myozyme'),
(9, 'Pavlov', 'Kidstone', 'pkidstone2@dropbox.com', '$2a$04$TsEPa2hoD5WKM6jGtRqZs.4iQ6PJE1/DjWcylMUHtXzkPh1wbJ8hK', '1991-06-08', 'Other', 'pics/profile_9.jpg', 'CVS Gentle Laxative'),
(10, 'Sadie', 'Hacun', 'shacun3@youtu.be', '$2a$04$FHc9JrEifDdH4qcgwxEbAus/f2Php.SC5.UyM226896ONZJUEGAAu', '2001-06-02', 'Male', 'pics/profile_10.jpg', 'Ludens Honey Lemon Throat Drops'),
(11, 'Allene', 'Croci', 'acroci4@imageshack.us', '$2a$04$LiND269A4aAIefD2oKbi8.S3nXdxmZ59aVvhx.ntGdOo7HbBmgz7S', '1992-05-17', 'Other', 'pics/profile_11.jpg', 'up and up acetaminophen'),
(12, 'Clyve', 'Follan', 'cfollan5@ow.ly', '$2a$04$3np8UN5rwNC.SE8OXhVtk.VXAGk57ekiwcSfEFjVHCkReib64.PUK', '2003-01-08', 'Male', 'pics/profile_6.jpg', 'Lamotrigine'),
(13, 'Murdoch', 'Lorryman', 'mlorryman6@freewebs.com', '$2a$04$B7Z.4jb56U.k8Az2ofzYO.QoE/drkt2tlXvdlCMn9uDJFhYx7Qq4G', '2000-05-01', 'Male', 'pics/profile_6.jpg', 'Chlorpheniramine maleate'),
(14, 'Elysha', 'Berthon', 'eberthon7@tamu.edu', '$2a$04$r97EdoaJlNVfQacmYGBnSO8G7Yp0N.ARxK2wSuOdm/EST0.F.6.JK', '1993-09-23', 'Other', 'pics/profile_6.jpg', 'Extra-Virt Plus DHA'),
(15, 'Lainey', 'Newall', 'lnewall8@yellowbook.com', '$2a$04$gb79abZ62HTtyQDLKLNgtOeWQdvnv/0orGgmCQwIbO3e8KPEKlHNS', '1998-10-07', 'Female', 'pics/profile_6.jpg', 'Topcare Tussin'),
(16, 'Mozelle', 'Kaminski', 'mkaminski9@buzzfeed.com', '$2a$04$jdp2Fe0We4SbdC.l1jKtdutwRJhVGGc33u80Gw70mnRqdnKkBUu/W', '2000-03-17', 'Female', 'pics/profile_6.jpg', 'dg health aller ease'),
(17, 'Korry', 'Maslin', 'kmaslina@purevolume.com', '$2a$04$JrqnGJ/xYIUgsJMtMHwRWOZOpqi/9fYUnXs9XVYp5ACR8d5t1Hdka', '2002-11-23', 'Male', 'pics/profile_6.jpg', 'Venlafaxine Hydrochloride'),
(18, 'Lombard', 'Thornhill', 'lthornhillb@walmart.com', '$2a$04$KyhunEBZIeJBW843c6g./.DtofDjWa8hfQfHkfAtVrq0GFA58HGdC', '1997-01-26', 'Male', 'pics/profile_6.jpg', 'CARBOplatin'),
(19, 'Emilio', 'Frean', 'efreanc@about.me', '$2a$04$zdSo2UKNmeuIbhHoOok83.rJl7bXA/WlUvKh8eeH79xNepxfU4.Uq', '2004-12-12', 'Other', 'pics/profile_6.jpg', 'Dry Idea A.Dry Inv.Sol. Antiperspirant Cool Blast'),
(20, 'Weston', 'Keune', 'wkeuned@cocolog-nifty.com', '$2a$04$7nzSvcy7/ZVvj5CLdns1EO7FM.iFn164ZFWZWV5xflpkgsD6GvkDq', '1995-02-23', 'Other', 'pics/profile_5.jpg', 'Colds and Cough'),
(21, 'Jule', 'Smieton', 'jsmietone@wix.com', '$2a$04$tSzaDXIKC46yP3qX0ho0dupgrC4EAuF6EUxwEQ8MJ8P7WlVjepfam', '1999-12-11', 'Other', 'pics/profile_7.jpg', 'risperidone'),
(22, 'Rachelle', 'Hughson', 'rhughsonf@redcross.org', '$2a$04$ZjDlThKCtLsM5SxoqXmtB.MrUDiGsCM8Oo7.fWclYEU5IprtwfS6S', '2005-01-10', 'Male', 'pics/profile_5.jpg', 'Conazol'),
(23, 'Lizette', 'Phillipps', 'lphillippsg@themeforest.net', '$2a$04$dje/MoAbXZy7x5nXC8xOpuxZlnWgnT.CGM3TNEDlIe74VZbaUXfZy', '1996-09-05', 'Male', 'pics/profile_5.jpg', 'Tamsulosin Hydrochloride'),
(24, 'Brigida', 'Keller', 'bkellerh@who.int', '$2a$04$oWW9KLZGwa5ISmGbMrSy4.sF16SDcOdoHYsbUcc8XMOmwjAo7WjGu', '1999-07-20', 'Other', 'pics/profile_6.jpg', 'healthy accents sore throat'),
(25, 'Christophe', 'Butte', 'cbuttei@163.com', '$2a$04$SvQtXuRgfOuqEnUyygD7f.l6d/DL8eH4652YPneJklHnn5/m8JC8S', '2003-05-24', 'Other', 'pics/profile_6.jpg', 'ASPIRIN'),
(26, 'Haley', 'Lardiner', 'hlardinerj@paginegialle.it', '$2a$04$ptHrcZQ3sny/pzr6A8MbnOPhl9W0uH0Np25fkYb8GLuoaViWKgq1.', '2003-07-28', 'Female', 'pics/profile_6.jpg', 'Fosphenytoin Sodium'),
(27, 'Edan', 'Empringham', 'eempringhamk@exblog.jp', '$2a$04$v1aUYSXrTRWvctPNol6mWuossS1A0qR8wFNqFrfp5XAjy5E/vT/sW', '2000-10-27', 'Female', 'pics/profile_6.jpg', 'Neutrogena Healthy Skin Compact Makeup'),
(28, 'Ralph', 'Gally', 'rgallyl@ocn.ne.jp', '$2a$04$0pcLBFQeGB.IthuODxoER.Qt.m2MuBZHZK.4p/JtuM/1u7rvFON4a', '1991-09-22', 'Male', 'pics/profile_6.jpg', 'Lansoprazole'),
(29, 'Yetta', 'Scripture', 'yscripturem@issuu.com', '$2a$04$cx8actI0IUtX6y7uUnGFJOi7hvMr19vQ8.FM/Ppp73ZvV6OWJxpZm', '2005-10-12', 'Male', 'pics/profile_6.jpg', 'Childrens Night Time'),
(30, 'Obadiah', 'Cheyney', 'ocheyneyn@printfriendly.com', '$2a$04$5xiqsr6dmcag7DFprRJ02uiEOJcDt..6a/HcwO2KiCRFsH1Ml4laW', '1996-01-21', 'Other', 'pics/profile_6.jpg', 'DIPYRIDAMOLE'),
(31, 'Rickey', 'Cudihy', 'rcudihyo@over-blog.com', '$2a$04$Gb12.IEeZglv1XBinTzTLemXJusF4R7IzjvpfrZNGpcrbZkARBkMa', '1993-01-06', 'Male', 'pics/profile_6.jpg', 'Ciprofloxacin'),
(32, 'Boigie', 'Wayland', 'bwaylandp@nationalgeographic.com', '$2a$04$dMN9RfO0QOxo4XIcknzWI.BhOS813PmWoc/luvHLz5rBjBklqc4hS', '1993-05-26', 'Other', 'pics/profile_6.jpg', 'Paroxetine'),
(33, 'Vassily', 'Tilburn', 'vtilburnq@reference.com', '$2a$04$y10yUiT198eeg8yU.brkhOLYvOhQfJmtT9.EsuZW28Or9FOqFzA22', '1998-11-20', 'Female', 'pics/profile_6.jpg', 'Headache RELIEF'),
(34, 'Allayne', 'Van Waadenburg', 'avanwaadenburgr@symantec.com', '$2a$04$/LUjIJoNw/9O8nvL31KYnuxWaqV5IvVB6oMXa8v3iMIMiqeEAqTIi', '1996-03-20', 'Male', 'pics/profile_6.jpg', 'phendimetrazine tartrate'),
(35, 'Ilaire', 'Stollenbecker', 'istollenbeckers@prnewswire.com', '$2a$04$So1rmIgVdq32CdMHYJTerurtwlAXGXiHCAjoPrrfAqkmHlfubKeaq', '1996-03-13', 'Other', 'pics/profile_6.jpg', 'First Force'),
(36, 'Griff', 'Bumpass', 'gbumpasst@ox.ac.uk', '$2a$04$OsreJ.jZ2GHsJZvG/mLIzuKfb3LwGWWHXzPnkqXz75aa7WId6fQda', '2001-08-15', 'Female', 'pics/profile_6.jpg', 'Molds, Penicillium Mix'),
(37, 'Garrek', 'Broune', 'gbrouneu@jigsy.com', '$2a$04$11wI1L4kYgHSd0QOzgQclegnViu4tzJnCN3vPOMQC7SahBLv9s8XW', '1995-11-18', 'Other', 'pics/profile_6.jpg', 'Hydrogen Peroxide'),
(38, 'Lisbeth', 'Bladesmith', 'lbladesmithv@liveinternet.ru', '$2a$04$6EkNbQHgQdbeFzVaE8Wa0OFrOjgSSNOk0UNBUmlVaRtFcBmRb4wum', '1996-02-13', 'Female', 'pics/profile_6.jpg', 'LANEIGE SATIN FINISH TWIN PACT NO. 23'),
(39, 'Pegeen', 'Weeke', 'pweekew@google.fr', '$2a$04$PSNbz2NBw.US1ic025Cx6uanoZz9kd0tpwNuy3jC261XAyUIRlX0O', '2003-09-09', 'Male', 'pics/profile_6.jpg', 'Tetracycline Hydrochloride'),
(40, 'Berne', 'Meyer', 'bmeyerx@bbb.org', '$2a$04$09XTQMcf8qpog9BKksEXAeq/mQjx2SXUKkSCMTeCnWmCrBEE8g6Ta', '1995-11-09', 'Male', 'pics/profile_6.jpg', 'meijer kids'),
(41, 'Puff', 'MacAnulty', 'pmacanultyy@utexas.edu', '$2a$04$lDXKljRSL4evWj8UNki6E.sp5LEWx59slsEyEsZdLZ3ySvhEtFy72', '1995-09-01', 'Male', 'pics/profile_6.jpg', 'Depo-Testosterone'),
(42, 'Riannon', 'Tuffield', 'rtuffieldz@apache.org', '$2a$04$WRvwHXfM34PXBoxinVG9E./EUQFJxV34cG7/oCnHzG1hBiynO6rz2', '1998-08-25', 'Female', 'pics/profile_6.jpg', 'Gabapentin'),
(43, 'Kathrine', 'Chaundy', 'kchaundy10@japanpost.jp', '$2a$04$yYF2ez48GK9yftREJh5Lw.x2EtqxMeXhneXa0Lqd2RBnIXmQYy0/S', '2004-01-13', 'Male', 'pics/profile_6.jpg', 'FLUOXETINE'),
(44, 'Palm', 'Blowes', 'pblowes11@joomla.org', '$2a$04$5.wQb9EH4p.iY8jpk3SHi.83mn6Q/56KbUkjZWZWpysasDqfgRRvm', '2002-05-31', 'Male', 'pics/profile_6.jpg', 'NU-DERM STARTER SET NORMAL-OILY'),
(45, 'Genni', 'Cantera', 'gcantera12@xinhuanet.com', '$2a$04$XgyH1FYGe.I8zJ1kdRN9pOHlLm5k60rvu39x8KuNjY8yHkPOev4ce', '2001-04-22', 'Female', 'pics/profile_6.jpg', 'Cold Spot'),
(46, 'Candis', 'Dury', 'cdury13@rambler.ru', '$2a$04$qUO.YZQS3B.tEgqD0YBBB.FH2IZAyiEEqRS43k/W9L9/iqWTTgP4m', '2004-08-28', 'Male', 'pics/profile_6.jpg', 'English Walnut'),
(47, 'Eveleen', 'Tribell', 'etribell14@soup.io', '$2a$04$UVkP0UUGzBCPaeITEbOoPuwJqjLAL6Q.WDyy8rgQR39g59aDgdEq.', '2000-10-31', 'Male', 'pics/profile_6.jpg', 'Anticavity Fluoride Rinse'),
(48, 'Bent', 'Prettejohns', 'bprettejohns15@merriam-webster.com', '$2a$04$NGYwKAXVfbOijVMRM19TL.fxDnjjcxKo3cpViCPdt3.ifY4XoAFZ2', '1994-06-19', 'Other', 'pics/profile_6.jpg', 'AZITHROMYCIN'),
(49, 'Charlean', 'Fawcett', 'cfawcett16@sphinn.com', '$2a$04$7.EbfUy8r6tFVQDxZPuuquVYIcN.5R7uY.oE1GwrC30f.VusCTUNC', '1996-06-25', 'Male', 'pics/profile_6.jpg', 'PHYTOGENIC INFINITE FOUNDATION'),
(50, 'Blithe', 'Pavis', 'bpavis17@imgur.com', '$2a$04$92BkcVWdxUrOZ27y4NHxlO5i3ohKGmiOFM6kAvZJ8Aa4SlWVQaIZe', '2004-05-10', 'Female', 'pics/profile_6.jpg', 'PURELL Advanced Instant Hand Sanitizer'),
(51, 'Brittani', 'Eric', 'beric18@smh.com.au', '$2a$04$NqWVzvrvBKvM4rEZmtdjsuGa3wNy69mHhOl9UDS0uZySsJopJsOJO', '1996-12-04', 'Female', 'pics/profile_6.jpg', 'Fluoxetine'),
(52, 'Clo', 'McDell', 'cmcdell19@desdev.cn', '$2a$04$r/biDoR2npmFxrreOAXIEORTVayCXrA9vrsLOhVKiN5Lx/WaesmlO', '2004-06-20', 'Male', 'pics/profile_6.jpg', 'EUPATORIUM CAPILLIFOLIUM POLLEN'),
(53, 'Laurens', 'Ruppelin', 'lruppelin1a@theguardian.com', '$2a$04$rJNpITQ9hiSTXkWsJalr9up1rL/UolFC81sTVXb96FsH7cvLwVv.q', '1994-12-05', 'Other', 'pics/profile_6.jpg', 'Cefepime'),
(54, 'Britney', 'Parkin', 'bparkin1b@php.net', '$2a$04$RDuGVbP5nfRwPqffF.YBGuTP6/7ULOkV3bsvKuwtcDq23adx1Zdpq', '1993-08-12', 'Male', 'pics/profile_6.jpg', 'Calamine'),
(55, 'Yolanthe', 'Escofier', 'yescofier1c@reuters.com', '$2a$04$YpDg/b0ILZzGj7vARogaR.Gmbmk3FKNFPHsBLsprRaViEvbal5tIi', '1994-03-24', 'Female', 'pics/profile_6.jpg', 'FRAXINUS AMERICANA POLLEN'),
(56, 'Duncan', 'Rainton', 'drainton1d@cafepress.com', '$2a$04$0gAusMijG0XEkogaHy93f.8stSx2FKoJjLZgCs/2LhEmZYiD74OxG', '1999-04-13', 'Male', 'pics/profile_6.jpg', 'Methocarbamol');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
