-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 25 août 2020 à 08:07
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `veine`
--

-- --------------------------------------------------------

--
-- Structure de la table `have_contacts`
--

DROP TABLE IF EXISTS `have_contacts`;
CREATE TABLE IF NOT EXISTS `have_contacts` (
  `contacts_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`contacts_id`,`users_id`),
  KEY `HAVE_CONTACTS_lhp4_users0_FK` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `have_contacts`
--

INSERT INTO `have_contacts` (`contacts_id`, `users_id`) VALUES
(4, 17),
(6, 17),
(10, 14),
(11, 14),
(12, 14);

-- --------------------------------------------------------

--
-- Structure de la table `lhp4_bets`
--

DROP TABLE IF EXISTS `lhp4_bets`;
CREATE TABLE IF NOT EXISTS `lhp4_bets` (
  `bets_id` int(11) NOT NULL AUTO_INCREMENT,
  `bets_name` varchar(50) NOT NULL,
  `bets_description` varchar(255) NOT NULL,
  `bets_start_time` datetime NOT NULL,
  `bets_end_time` datetime NOT NULL,
  `bets_result` tinyint(1) NOT NULL,
  `bets_fulfilled` tinyint(1) NOT NULL,
  `bets_accepted` tinyint(1) NOT NULL,
  `contacts_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `bet_types_id` int(11) NOT NULL,
  PRIMARY KEY (`bets_id`),
  KEY `lhp4_bets_lhp4_contacts_FK` (`contacts_id`),
  KEY `lhp4_bets_lhp4_users0_FK` (`users_id`),
  KEY `lhp4_bets_lhp4_bet_types1_FK` (`bet_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lhp4_bet_types`
--

DROP TABLE IF EXISTS `lhp4_bet_types`;
CREATE TABLE IF NOT EXISTS `lhp4_bet_types` (
  `bet_types_id` int(11) NOT NULL AUTO_INCREMENT,
  `bet_types_name` varchar(255) NOT NULL,
  `bet_types_description` varchar(255) NOT NULL,
  `bet_types_img` varchar(255) NOT NULL,
  PRIMARY KEY (`bet_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lhp4_contacts`
--

DROP TABLE IF EXISTS `lhp4_contacts`;
CREATE TABLE IF NOT EXISTS `lhp4_contacts` (
  `contacts_id` int(11) NOT NULL AUTO_INCREMENT,
  `contacts_bookmark` tinyint(1) NOT NULL DEFAULT 0,
  `contacts_authorized` tinyint(1) NOT NULL DEFAULT 0,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`contacts_id`),
  KEY `lhp4_contacts_lhp4_users_FK` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lhp4_contacts`
--

INSERT INTO `lhp4_contacts` (`contacts_id`, `contacts_bookmark`, `contacts_authorized`, `users_id`) VALUES
(4, 0, 0, 16),
(6, 1, 0, 18),
(10, 0, 0, 21),
(11, 0, 0, 17),
(12, 0, 0, 14);

-- --------------------------------------------------------

--
-- Structure de la table `lhp4_users`
--

DROP TABLE IF EXISTS `lhp4_users`;
CREATE TABLE IF NOT EXISTS `lhp4_users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_mail` varchar(50) DEFAULT NULL,
  `users_pseudo` varchar(50) NOT NULL,
  `users_phone` varchar(50) DEFAULT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_birthdate` date NOT NULL,
  `users_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lhp4_users`
--

INSERT INTO `lhp4_users` (`users_id`, `users_mail`, `users_pseudo`, `users_phone`, `users_password`, `users_birthdate`, `users_token`) VALUES
(13, 'felix.noel3@orange.fr', 'Félix', '0605177615', '$2y$10$EBfjcmUOpnVwEssvRejthuoLnT/GxgaLSiQmd61nwDuTaV/C23yFu', '1998-11-05', NULL),
(14, 'test.test@test.fr', 'test', '0101010101', '$2y$10$5f1gkbxAzXnOz9ybkgaPGO2dpnF.GN/nmfaaOb5mm9Pw/HN1rxnxi', '1996-11-05', NULL),
(15, 'tist.test@test.fr', 'tototo', '0202020202', '$2y$10$tdQPy37os.O.urumu8X74OxrYItUUt2cM1KMfUOvJUq8tVupMS..e', '1998-11-05', NULL),
(16, 'tati.tata@tata.fr', 'tati', '0505050505', '$2y$10$rUR3LowRkP8sR/lHKc85cudMEXjAZFaas7ciIJX5c6AKbjpMrMRE6', '1963-02-01', NULL),
(17, 'quentin.quentin@quentin.fr', 'quentin', '0101010102', '$2y$10$oVt6TKeshT1kyIpjrDWhY.MD8LJIMcfycBsxNusPYwC0b9k9IkNWC', '1985-06-01', NULL),
(18, 'pauline.pauline@pauline.fr', 'pauline', '0606060606', '$2y$10$GetkHoZfqQME1nM7bmXsvenAbSHCixf/aPS1BETFpgIW2dXikiNlS', '1994-03-08', NULL),
(19, 'julien.julien@julein.fr', 'julien', '0202020202', '$2y$10$X/9fr/JGIk9gENwzl/S0BOfepMDd5mkr5mBuSuInv0cgDH1fy.Vhe', '1981-01-04', NULL),
(20, 'thibaud.thibaud@gmail.com', 'thibaud', '0606060606', '$2y$10$2SLb4UrbifvPFhcQNoscluuq2cn.sxrnomKjkrFAYFQS./VMMw/aq', '1999-12-08', NULL),
(21, 'athony.anthony@anthony.fr', 'anthony', '0606060606', '$2y$10$U7O670Xui9NBrJYaDA1ifuSdlXkNqsEsRSd4fqwIHJVpH/vCIANAa', '1987-04-10', NULL),
(22, 'coronavirus.cov19@covcov.fr', 'LaCOVID', '0606060606', '$2y$10$IUjwePm90JlSlWEeeLYAje/UpsiNKSv6ssaPKW7X3.WlOIChJZCGe', '2020-02-01', NULL),
(23, 'fefe.fefe@ttt.fr', 'qsdqsd', '0606060606', '$2y$10$BzkPEO97yMKCvFgOI8BwSOhvi2/UFsp1AlVIJAA.NXYjesIrqLFEW', '1998-11-05', NULL),
(24, 'quedddntin.quentin@quentin.fr', 'aaaaaa', '0606060606', '$2y$10$CMC6qVfwkx4e4YK7lW1doeRdLEL8/77ZZ.O4w3krQzn03kRv/1Lq2', '1998-11-05', NULL),
(25, 'michel.forever@gmail.com', 'michmich', '0699999999', '$2y$10$EfgxBTVOIeaG7GYHhWCed.h4r4ChI3nkVFQv4bC6GsX2RAJPAlvwS', '1987-10-10', NULL),
(26, 'quentin.touf@gmail.com', 'Stigly', '0645893255', '$2y$10$95LgdUyW3Ep4bR51jiZ2QOZEQEjP48uwBnTfLkftXfnuA87xILfxi', '1992-06-28', NULL),
(27, 'pepega@pepegaGaming.fr', 'PepegaGaming', '0258457595', '$2y$10$n/uI.gmn3ab/wEOLCpMpQexewIT.sNMkzeNiJe0htyDUlghqRmRjK', '1985-12-05', NULL),
(28, 'sabrina.monclair@hotmail.com', 'gouzouille', '0788477999', '$2y$10$f9lDB2D9mZO73nRmclX0heaxJs00eQ.SWQLTBuiDlMKPjwhTpBaa6', '1987-06-01', NULL),
(29, 'jcvd@gmail.com', 'GrandEcartMan', '0102010201', '$2y$10$bngTyeiXQ2pdFUBoYLl37.yFnpU5sKZAumWvwVxWl/8Fb34b4WB1C', '1984-08-22', NULL),
(30, 'psgfandu91@looser.fr', 'Psgfan', '0160193663', '$2y$10$tE/jo43RvX19uDeNerzS..3yiSjovCQsN25I9OmWf6F.ZBOfTI8ta', '2000-08-16', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `have_contacts`
--
ALTER TABLE `have_contacts`
  ADD CONSTRAINT `HAVE_CONTACTS_lhp4_contacts_FK` FOREIGN KEY (`contacts_id`) REFERENCES `lhp4_contacts` (`contacts_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `HAVE_CONTACTS_lhp4_users0_FK` FOREIGN KEY (`users_id`) REFERENCES `lhp4_users` (`users_id`);

--
-- Contraintes pour la table `lhp4_bets`
--
ALTER TABLE `lhp4_bets`
  ADD CONSTRAINT `lhp4_bets_lhp4_bet_types1_FK` FOREIGN KEY (`bet_types_id`) REFERENCES `lhp4_bet_types` (`bet_types_id`),
  ADD CONSTRAINT `lhp4_bets_lhp4_contacts_FK` FOREIGN KEY (`contacts_id`) REFERENCES `lhp4_contacts` (`contacts_id`),
  ADD CONSTRAINT `lhp4_bets_lhp4_users0_FK` FOREIGN KEY (`users_id`) REFERENCES `lhp4_users` (`users_id`);

--
-- Contraintes pour la table `lhp4_contacts`
--
ALTER TABLE `lhp4_contacts`
  ADD CONSTRAINT `lhp4_contacts_lhp4_users_FK` FOREIGN KEY (`users_id`) REFERENCES `lhp4_users` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
