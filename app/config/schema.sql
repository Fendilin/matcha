-- phpMyAdmin SQL Dump
-- version 4.8.0-dev
-- https://www.phpmyadmin.net/
--
-- Host: 192.168.30.23
-- Generation Time: Jan 25, 2018 at 08:23 PM
-- Server version: 8.0.3-rc-log
-- PHP Version: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matcha`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `blocker_id` int(11) NOT NULL,
  `blocked_id` int(11) NOT NULL,
  `block_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `content` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `date` datetime NOT NULL,
  `read` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `connected`
--

CREATE TABLE `connected` (
  `user_id` int(11) NOT NULL,
  `connect_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fake`
--

CREATE TABLE `fake` (
  `faker_id` int(11) NOT NULL,
  `faked_id` int(11) NOT NULL,
  `fake_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `liked_id` int(11) NOT NULL,
  `like_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `img` varchar(125) COLLATE latin1_general_ci NOT NULL,
  `date` datetime NOT NULL,
  `read` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(125) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'video game'),
(2, 'photography'),
(3, 'travel'),
(4, 'food'),
(5, 'cinema'),
(6, 'computer'),
(7, 'money'),
(8, 'microsoft'),
(9, 'actifact'),
(10, 'flaming skull'),
(11, 'swaping face'),
(12, 'wizard'),
(13, 'crush ennemies'),
(14, 'white wizard'),
(15, 'saruman'),
(16, 'eat Humans'),
(17, 'multipass'),
(18, 'korben'),
(19, 'elements'),
(20, 'bow & arrow'),
(21, 'trees'),
(22, 'rings'),
(23, 'amazons'),
(24, 'sword & shield'),
(25, 'be a girl'),
(26, 'be a princess');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(125) COLLATE latin1_general_ci NOT NULL,
  `last_name` varchar(125) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(125) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(125) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(125) COLLATE latin1_general_ci NOT NULL,
  `birthdate` datetime DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `orientation` int(11) DEFAULT NULL,
  `bio` text COLLATE latin1_general_ci,
  `country` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `state` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `zip` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `file_1` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `file_2` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `file_3` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `file_4` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `file_5` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `score` int(11) DEFAULT '0',
  `token` varchar(125) COLLATE latin1_general_ci NOT NULL,
  `token_date` datetime NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `register` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `birthdate`, `gender`, `orientation`, `bio`, `country`, `state`, `city`, `zip`, `file_1`, `file_2`, `file_3`, `file_4`, `file_5`, `score`, `token`, `token_date`, `active`, `register`, `created_at`, `updated_at`) VALUES
(1, "bill", "gate", "bgate", "bgate@hotmail.fr", "$2y$10$D2clTL3/2T2WFyRUXhPmCuO40vL0zI25CZ06NykdJRQlzGDxecKm.", "1955-10-28 00:00:00", 1, 1, "William Henry Gates III, dit Bill Gates, né le 28 octobre 1955 à Seattle (État de Washington), est un informaticien et entrepreneur américain, pionnier dans le domaine de la micro-informatique. Il a fondé en 1975, à l\"âge de 20 ans, avec son ami Paul Allen, la société de logiciels de micro-informatique Micro-Soft (rebaptisée depuis Microsoft). Son entreprise acheta le système d\"exploitation QDOS pour en faire le MS-DOS, puis conçut le système d\"exploitation Windows, tous deux en situation de quasi-monopole mondial.", "France", "Île-de-France", "Nanterre", "92150", "../942f1737abf20b24.jpg", "../0433ff3c68897ea4.jpg", NULL, NULL, NULL, 0, "", "0000-00-00 00:00:00", 1, 1, "2017-09-25 23:40:04", "2017-09-25 23:40:04"),
(2, "nicolas", "cage", "ncage", "ncage@gmail.com", "$2y$10$Xkxza8FS0tQnmrKx.Dx70OmCcAyyxlb83d2fK79h8U6pr9Bc0z8RG", "1964-01-07 00:00:00", 1, 3, "Nicolas Kim Coppola (born January 7, 1964),[2] known professionally as Nicolas Cage, is an American actor, director and producer. During his early career, Cage starred in a variety of films such as Valley Girl (1983), Racing with the Moon (1984), Birdy (1984), Peggy Sue Got Married (1986), Raising Arizona (1987), Moonstruck (1987), Vampire\"s Kiss (1989), Wild at Heart (1990), Fire Birds (1990), Honeymoon in Vegas (1992), and Red Rock West (1993).", "France", "Île-de-France", "Paris", "75011", "../9d828d636d5e1900.jpg", "../tmp558671889711497218.jpg", "../iwpzjy3ggdpapoagr8av.jpg", NULL, NULL, 0, "", "0000-00-00 00:00:00", 1, 1, "2017-09-25 23:40:04", "2017-09-25 23:40:04"),
(3, "lurtz", "of isengard", "ugluk", "uglúk@middleEarth.com", "$2y$10$Qj68AEp7W/4EoZWIpkas7OjjWTc7evhcZFIotNBsrcKqkFCVZ32ve", "1942-12-09 00:00:00", 1, 2, "Lurtz was the first leader of the Uruk-hai Scouts created specifically for Peter Jackson\"s movie The Lord of the Rings: The Fellowship of the Ring. He was portrayed by New Zealand actor Lawrence Makoare in the first film, Fellowship of the Ring, in which he kills Boromir, and is later slain by Aragorn.", "Middle Earth", "Gondor", "Isengard", "66666", "../861184321846.jpg", "../98462189453218321684651.jpg", NULL, NULL, NULL, 0, "", "0000-00-00 00:00:00", 1, 1, "2017-09-25 23:40:04", "2017-09-25 23:40:04"),
(4, "leeloo", "dallas", "supremBeing", "leeloo@multipass.com", "$2y$10$8tWhF6HIPpWD2jnXr5hecOUMcBCRrxDNPxUxQRcpG9BXBEFrcrp7i", "1991-12-05 00:00:00", 2, 1, "Leeloominaï Lekatariba Lamina-Tchaï Ekbat De Sebat (A.K.A Leeloo) is one of the Supreme Beings of the Universe. She was sent to Earth in corporeal form to become the Fifth Element, the final piece of a powerful weapon to destroy the Great Evi", "sweden", "västra götaland", "stroemstad", "452 38", "../gdusvw39hf20vsd8s829vs8d.jpg", "../6000417994a7574608131l.jpg", "../c26dbfb9ec270ac249c75cedfc6a1abb.jpg", NULL, NULL, 0, "", "0000-00-00 00:00:00", 1, 1, "2017-11-04 16:12:23", "2017-11-04 16:12:23"),
(5, "galadriel", "lorien", "ladyOfLorien", "blackForest@elven.com", "$2y$10$RzuTojbfd1eIiNFMOAHQtOfmNRhxpCFStVhllPX1gk8d2VbvPOM6u", "1900-07-15 00:00:00", 2, 3, "The main part of this article relates to the last versions of Middle-earth\"s history, and as such may controvert parts of The Silmarillion. See Middle-earth canon for a discussion. This subject\"s portrayal in earlier or alternative versions is discussed in the other versions of the legendarium section.", "middle earth", "rivendel", "lothlorien", "6666", "../3587660-5489214.jpg", "../25479221584697.jpg", "../876354792459546924-943-526.jpg", NULL, NULL, 0, "", "0000-00-00 00:00:00", 1, 1, "2017-11-04 16:12:23", "2017-11-04 16:12:23"),
(6, "wonder", "woman", "wonderWoman", "woman@amazon.com", "$2y$10$DwBv9vztgZUSlNEM.VBVvOKPM2CjsONSxJk6zoLdsId/PCSvL8HzC", "1991-05-21 00:00:00", 2, 2, "nder Woman is a fictional superhero appearing in American comic books published by DC Comics.[2] The character is a founding member of the Justice League, goddess, and Ambassador-at-Large of the Amazonian people. The character first appeared in All Star Comics #8 in October 1941 and first cover-dated on Sensation Comics #1, January 1942.", "greece", "attica", "athens", "104 31", "../images59844321497.jpeg", "../téléchargement21684984231687661.jpeg", "../v1aDsxMzM3OTA7ajsxNzUwNjsxMjAwOzEwODA7MTMyNQ.jpeg", "../wonder-woman-reviews.jpg", NULL, 0, "", "0000-00-00 00:00:00", 1, 1, "2017-11-04 16:12:23", "2017-11-04 16:12:23");

-- --------------------------------------------------------

--
-- Table structure for table `user_tag`
--

CREATE TABLE `user_tag` (
  `user_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user_tag`
--

INSERT INTO `user_tag` (`user_id`, `tag_id`) VALUES
(1, 6),
(1, 7),
(1, 8),
(2, 9),
(2, 10),
(2, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(4, 17),
(4, 18),
(4, 19),
(5, 20),
(5, 21),
(5, 22),
(6, 23),
(6, 24),
(6, 25);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `viewer_id` int(11) NOT NULL,
  `viewed_id` int(11) NOT NULL,
  `view_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;