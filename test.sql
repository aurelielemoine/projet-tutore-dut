-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 03 mars 2022 à 22:17
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `ID_administrateur` int(50) NOT NULL,
  `Identifiant` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mot_de_passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_perso` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_pro` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tel_perso` varchar(10) NOT NULL,
  `Tel_pro` varchar(10) NOT NULL,
  `Photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Validation_reglement` int(1) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`ID_administrateur`, `Identifiant`, `Mot_de_passe`, `Nom`, `Prenom`, `Email_perso`, `Email_pro`, `Tel_perso`, `Tel_pro`, `Photo`, `Validation_reglement`, `name`, `file_url`) VALUES
(8, 'superadmin', '$2y$10$BX5P8GvBTYi2nLK/sFxyaOG3viMyH.PKZup9RMxsZ/aXle8/EMEg2', 'ADMIN', 'Super', '', 'iut35400@gmail.com', '', '', NULL, 1, '', ''),
(6, 'tgaillard', '$2y$10$nPdptn6X8ABHouGiC0p4UenHId8aUboRVu52v99GjtpqGbD94wLAq', 'GAILLARD', 'Thierry', 'tgaillard@gmail.com', '', '0606060606', '', NULL, 1, 'Capture2.PNG', 'files/Capture2.PNG'),
(7, 'aprigent', '$2y$10$eZEUjhfYDA3vRrEJwiSB0.XEG64jMceCwDAF56ilzRcr/9bbo0FP6', 'PRIGENT', 'Anne', '', '', '', '', NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `alternant`
--

CREATE TABLE `alternant` (
  `ID_alternant` int(50) NOT NULL,
  `Identifiant` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mot_de_passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_perso` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_pro` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tel_perso` varchar(10) NOT NULL,
  `Tel_pro` varchar(10) NOT NULL,
  `Annee` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Photo` binary(255) DEFAULT NULL,
  `ID_tuteur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_superviseur` int(50) DEFAULT NULL,
  `ID2_superviseur` int(50) DEFAULT NULL,
  `ID_enseignant` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Validation_reglement` int(1) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `Code` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `alternant`
--

INSERT INTO `alternant` (`ID_alternant`, `Identifiant`, `Mot_de_passe`, `Nom`, `Prenom`, `Email_perso`, `Email_pro`, `Tel_perso`, `Tel_pro`, `Annee`, `Photo`, `ID_tuteur`, `ID_superviseur`, `ID2_superviseur`, `ID_enseignant`, `Validation_reglement`, `name`, `file_url`, `Code`) VALUES
(26, 'agossaume', '$2y$10$9dEmR2/HFG55M/nf/gMzP.0fWYV8ryX.neia9L0mDhIvL0Jkq.Oxm', 'GOSSAUME', 'Amandine', '', '', '0606060606', '', '2AP2', NULL, '9', NULL, NULL, '9', 1, 'Capture3.PNG', 'files/Capture3.PNG', 0),
(27, 'alemoine', '$2y$10$BX5P8GvBTYi2nLK/sFxyaOG3viMyH.PKZup9RMxsZ/aXle8/EMEg2', 'LEMOINE', 'Aurélie', 'aurelielemoine45@gmail.com', 'aurelielemoine45@gmail.com', '', '0612345678', '2AP1', NULL, '8', NULL, NULL, '6', 1, 'Capture1.PNG', 'files/Capture1.PNG', 2212),
(43, 'tlejeune', '$2y$10$LhIT5pM8vbnY4ueE7.Z5i.P/TETZ7T4LicEPhJldidBELQu.wBQ3W', 'LEJEUNE', 'Thomas', '', '', '', '', '1A', NULL, '11', NULL, NULL, '9', NULL, '', '', 0),
(32, 'mdelafosse', '$2y$10$1Za8FRy55HLEI6IAky0yNOijI3Tx5z7iCtCPPHqJVI0OWMYhh38Ai', 'DELAFOSSE', 'Martin', '', '', '', '', '2AP2', NULL, '9', NULL, NULL, '5', NULL, '', '', 0),
(36, 'sdesmontils', '$2y$10$HE3IvXGtrL/EMICMe.nKe.YSEaWnhRR5mVPNpnbjFfv7kz0zEFLFW', 'DESMONTILS', 'Simon', '', '', '', '', '2AP2', NULL, '11', NULL, NULL, '6', NULL, '', '', 0),
(42, 'eabeille', '$2y$10$.vj4ojeG8yoa4Ui9DfpLxuEi2SqfcJZDtnxtpPVarPYEeCAixWX4a', 'ABEILLE', 'Ewen', '', '', '', '', '1A', NULL, '11', NULL, NULL, '6', 1, '', '', 0),
(46, 'mthériault', '$2y$10$KsglN3tNdcWf7eYtU6tLHupXZRssik2qRwlGq7K2eO1y9IZwkAQ3u', 'THERIAULT', 'Martine', '', '', '', '', 'TRTE', NULL, '8', 0, 0, '6', NULL, '', '', 0),
(47, 'hbazin', '$2y$10$Esa1SNCgGUHHbueNejIWGeRKYsq6aBj.Y4.J52ETkxLBa2V6u52Ny', 'BAZIN', 'Hugo', '', '', '', '', 'TRTE', NULL, '10', 0, 0, '5', NULL, '', '', 0),
(48, 'mbourges', '$2y$10$ISfvRTRO.yNjJ0auUKKACudnC1pQWAgRJhivMjy4ewPx63k18.3Z6', 'BOURGES', 'Mathieu', '', '', '', '', '2AP1', NULL, '9', 2, 1, '5', 1, '', '', 0),
(49, 'tjubault', '$2y$10$LfkkNWQ2RM3IkOzV4nR.EeALlSm1lIgOIKSIqRVR.zJOwV3Gz2Nc2', 'JUBAULT', 'Thomas', '', '', '', '', '2AP1', NULL, '8', 1, 2, '9', 1, '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `calendriers`
--

CREATE TABLE `calendriers` (
  `1AA` varchar(255) NOT NULL,
  `1A` varchar(255) NOT NULL,
  `2A` varchar(255) NOT NULL,
  `TRTE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `calendriers`
--

INSERT INTO `calendriers` (`1AA`, `1A`, `2A`, `TRTE`) VALUES
('http://localhost/www/TRTE_FIFA/14-02-2021/data/1A-2020.csv', 'http://localhost/www/TRTE_FIFA/14-02-2021/data/1A-2020.csv', 'http://localhost/www/TRTE_FIFA/14-02-2021/data/2A-2020.csv', 'http://localhost/www/TRTE_FIFA/version%20pdf/10-03-2021/data/2020-TRTE.csv');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `ID_enseignant` int(50) NOT NULL,
  `Identifiant` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mot_de_passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_perso` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_pro` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tel_perso` varchar(10) NOT NULL,
  `Tel_pro` varchar(10) NOT NULL,
  `Photo` binary(255) DEFAULT NULL,
  `Validation_reglement` int(1) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `Code` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`ID_enseignant`, `Identifiant`, `Mot_de_passe`, `Nom`, `Prenom`, `Email_perso`, `Email_pro`, `Tel_perso`, `Tel_pro`, `Photo`, `Validation_reglement`, `name`, `file_url`, `Code`) VALUES
(6, 'fweis', '$2y$10$9EzivgiaMnNMiiBKbDQz/.plVpkqoOMQ5cRWvBtiarscSCmqwauL.', 'WEIS', 'Frederic', '', '', '', '', NULL, 1, '', '', 58383),
(5, 'lparize', '$2y$10$S2XsYDhD5uKH./S3M0CrPe98.0I4z8Io4saZFf9npBk48NSfp3eFG', 'PARIZE', 'Laurent', '', '', '', '', NULL, 1, '', '', 0),
(9, 'mpiel', '$2y$10$BX5P8GvBTYi2nLK/sFxyaOG3viMyH.PKZup9RMxsZ/aXle8/EMEg2', 'PIEL', 'Marie-B', '', '', '0102030405', '', NULL, NULL, '', '', 0),
(20, 'csimon', '$2y$10$TFPOXGbhwttzM/tYtXbWVOD85p.NABmgLZFQ4X1jn0VC1iRNERkwC', 'SIMON', 'Claude', '', '', '', '', NULL, NULL, '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `ID_entreprise` int(50) NOT NULL,
  `Entreprise` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`ID_entreprise`, `Entreprise`, `name`, `file_url`) VALUES
(1, 'Orange', 'orange.PNG', 'files/orange.PNG'),
(11, 'La Poste', '', ''),
(12, 'SNCF', '', ''),
(14, 'La Rance', '', ''),
(15, 'Larance', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `iut`
--

CREATE TABLE `iut` (
  `Nb_enregistrement` int(255) NOT NULL,
  `Annee` varchar(255) NOT NULL,
  `Date1` date NOT NULL,
  `Date2` date NOT NULL,
  `ID_alternant` int(255) NOT NULL,
  `Module` varchar(2000) NOT NULL,
  `Remarques` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `iut`
--

INSERT INTO `iut` (`Nb_enregistrement`, `Annee`, `Date1`, `Date2`, `ID_alternant`, `Module`, `Remarques`) VALUES
(5, '1AA', '2021-03-19', '2021-04-22', 27, '-> Maths\r\n-> Télécoms\r\n-> Electronique\r\n-> Réseaux\r\n-> Anglais\r\n', 'Très bon travail ce durant cette période IUT. '),
(6, '2A', '2021-01-08', '2021-02-11', 27, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', ''),
(7, '27', '2021-03-12', '2021-04-22', 2, '', ''),
(8, '27', '2021-03-12', '2021-04-22', 2, '', ''),
(9, '2A', '2021-03-12', '2021-04-22', 27, '', 'pas mal\r\nmais peut faire des progrès'),
(10, '1AA', '2021-01-29', '2021-02-25', 27, '', 'bien'),
(11, '1AA', '2020-09-25', '2020-10-29', 27, '--> Maths\r\n--> Electronique', ''),
(12, '2A', '2021-06-18', '2021-06-23', 27, '', 'très bien'),
(13, '1AA', '2021-05-14', '2021-07-01', 27, 'bcp de choses', 'très bien, parfait');

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `Identifiant` varchar(100) NOT NULL,
  `Date1` date NOT NULL,
  `Heure` time NOT NULL,
  `Adresse_IP` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `logs`
--

INSERT INTO `logs` (`Identifiant`, `Date1`, `Heure`, `Adresse_IP`) VALUES
('0', '0000-00-00', '00:00:00', '::1'),
('0', '2021-03-16', '00:00:00', '::1'),
('0', '2021-03-16', '00:00:00', '::1'),
('0', '2021-03-16', '00:00:00', '::1'),
('0', '2021-03-16', '00:00:00', '::1'),
('0', '2021-03-16', '00:00:00', '::1'),
('0', '2021-03-16', '19:39:39', '::1'),
('alemoine', '2021-03-16', '19:40:48', '::1'),
('tgaillard', '2021-03-16', '23:22:11', '::1'),
('alemoine', '2021-03-17', '00:09:36', '::1'),
('alemoine', '2021-03-17', '11:39:21', '::1'),
('alemoine', '2021-03-17', '13:51:24', '::1'),
('alemoine', '2021-03-17', '18:37:19', '::1'),
('alemoine', '2021-03-17', '19:08:03', '::1'),
('kfeuillet', '2021-03-17', '19:10:45', '::1'),
('cmiron', '2021-03-17', '19:11:01', '::1'),
('alemoine', '2021-03-17', '19:11:09', '::1'),
('fdumont', '2021-03-17', '19:11:20', '::1'),
('alemoine', '2021-03-17', '20:32:40', '::1'),
('tgaillard', '2021-03-17', '20:34:19', '::1'),
('alemoine', '2021-03-17', '20:35:42', '::1'),
('alemoine', '2021-03-20', '10:57:20', '::1'),
('alemoine', '2021-03-20', '11:38:56', '::1'),
('alemoine', '2021-03-20', '14:05:04', '::1'),
('alemoine', '2021-03-20', '14:56:09', '::1'),
('kfeuillet', '2021-03-20', '15:01:07', '::1'),
('alemoine', '2021-03-20', '15:09:34', '::1'),
('tgaillard', '2021-03-20', '16:16:11', '::1'),
('tgaillard', '2021-03-20', '17:16:40', '::1'),
('kfeuillet', '2021-03-20', '17:34:22', '::1'),
('tgaillard', '2021-03-20', '18:31:53', '::1'),
('tgaillard', '2021-03-20', '19:07:45', '::1'),
('tgaillard', '2021-03-20', '19:44:35', '::1'),
('alemoine', '2021-03-20', '19:56:50', '::1'),
('alemoine', '2021-03-21', '00:04:07', '::1'),
('kfeuillet', '2021-03-21', '00:06:02', '::1'),
('tgaillard', '2021-03-21', '00:09:56', '::1'),
('alemoine', '2021-03-21', '00:34:26', '::1'),
('tgaillard', '2021-03-21', '00:34:38', '::1'),
('alemoine', '2021-03-21', '00:35:15', '::1'),
('kfeuillet', '2021-03-21', '00:39:05', '::1'),
('tgaillard', '2021-03-21', '19:39:31', '::1'),
('kfeuillet', '2021-03-22', '01:47:47', '::1'),
('alemoine', '2021-03-22', '01:50:26', '::1'),
('kfeuillet', '2021-03-22', '01:50:50', '::1'),
('fdumont', '2021-03-22', '01:51:42', '::1'),
('alemoine', '2021-03-22', '01:58:55', '::1'),
('fdumont', '2021-03-22', '02:01:50', '::1'),
('alemoine', '2021-03-22', '02:02:52', '::1'),
('tgaillard', '2021-03-22', '02:05:33', '::1'),
('alemoine', '2021-03-22', '02:06:12', '::1'),
('fdumont', '2021-03-22', '02:07:03', '::1'),
('alemoine', '2021-03-22', '02:12:07', '::1'),
('fdumont', '2021-03-22', '02:13:38', '::1'),
('alemoine', '2021-03-22', '02:18:52', '::1'),
('alemoine', '2021-03-22', '10:29:01', '::1'),
('alemoine', '2021-03-22', '10:30:20', '::1'),
('fdumont', '2021-03-22', '10:30:33', '::1'),
('fdumont', '2021-03-22', '10:32:19', '::1'),
('fdumont', '2021-03-22', '10:37:47', '::1'),
('fdumont', '2021-03-22', '10:38:18', '::1'),
('fdumont', '2021-03-22', '10:39:13', '::1'),
('alemoine', '2021-03-22', '10:42:21', '::1'),
('fdumont', '2021-03-22', '10:45:02', '::1'),
('alemoine', '2021-03-22', '11:01:10', '::1'),
('fdumont', '2021-03-22', '11:04:21', '::1'),
('fdumont', '2021-03-22', '11:06:41', '::1'),
('alemoine', '2021-03-22', '11:07:53', '::1'),
('fdumont', '2021-03-22', '11:20:05', '::1'),
('alemoine', '2021-03-22', '11:20:29', '::1'),
('fdumont', '2021-03-22', '11:21:13', '::1'),
('alemoine', '2021-03-22', '11:44:10', '::1'),
('tgaillard', '2021-03-22', '15:49:23', '::1'),
('alemoine', '2021-03-22', '15:50:12', '::1'),
('kfeuillet', '2021-03-22', '15:51:46', '::1'),
('alemoine', '2021-03-22', '16:33:30', '::1'),
('kfeuillet', '2021-03-22', '16:34:02', '::1'),
('alemoine', '2021-03-22', '18:14:23', '::1'),
('fdumont', '2021-03-22', '18:30:33', '::1'),
('alemoine', '2021-03-22', '18:33:50', '::1'),
('kfeuillet', '2021-03-22', '18:34:18', '::1'),
('alemoine', '2021-03-22', '18:35:14', '::1'),
('fdumont', '2021-03-22', '18:37:01', '::1'),
('alemoine', '2021-03-22', '18:40:45', '::1'),
('kfeuillet', '2021-03-22', '18:42:15', '::1'),
('alemoine', '2021-03-22', '19:03:24', '::1'),
('kfeuillet', '2021-03-22', '19:05:16', '::1'),
('alemoine', '2021-03-22', '19:10:28', '::1'),
('kfeuillet', '2021-03-22', '19:17:49', '::1'),
('alemoine', '2021-03-22', '19:18:29', '::1'),
('kfeuillet', '2021-03-22', '19:20:58', '::1'),
('alemoine', '2021-03-22', '19:21:39', '::1'),
('fdumont', '2021-03-22', '19:22:22', '::1'),
('alemoine', '2021-03-22', '19:36:58', '::1'),
('fdumont', '2021-03-22', '19:38:08', '::1'),
('tgaillard', '2021-03-22', '19:43:38', '::1'),
('alemoine', '2021-03-22', '19:55:11', '::1'),
('kfeuillet', '2021-03-22', '19:56:19', '::1'),
('alemoine', '2021-03-22', '19:56:52', '::1'),
('tgaillard', '2021-03-22', '19:58:12', '::1'),
('alemoine', '2021-03-23', '09:36:56', '::1'),
('kfeuillet', '2021-03-23', '09:37:45', '::1'),
('fdumont', '2021-03-23', '09:38:13', '::1'),
('alemoine', '2021-03-24', '11:13:07', '::1'),
('alemoine', '2021-03-24', '11:41:06', '::1'),
('kfeuillet', '2021-03-24', '11:41:47', '::1'),
('alemoine', '2021-03-24', '11:57:26', '::1'),
('alemoine', '2021-03-24', '18:57:15', '::1'),
('kfeuillet', '2021-03-24', '19:00:00', '::1'),
('tgaillard', '2021-03-24', '20:25:28', '::1'),
('tgaillard', '2021-03-25', '19:14:18', '::1'),
('alemoine', '2021-03-25', '19:38:53', '::1'),
('tgaillard', '2021-03-25', '19:47:34', '::1'),
('tgaillard', '2021-03-26', '11:24:07', '::1'),
('alemoine', '2021-03-26', '14:26:29', '::1'),
('alemoine', '2021-03-26', '15:45:30', '::1'),
('tgaillard', '2021-03-26', '16:29:28', '::1'),
('alemoine', '2021-03-26', '21:28:00', '::1'),
('alemoine', '2021-03-26', '23:18:01', '::1'),
('kfeuillet', '2021-03-26', '23:23:08', '::1'),
('alemoine', '2021-03-26', '23:49:44', '::1'),
('tgaillard', '2021-03-26', '23:54:39', '::1'),
('tgaillard', '2021-03-28', '14:48:27', '::1'),
('tgaillard', '2021-03-28', '18:34:51', '::1'),
('tgaillard', '2021-03-28', '18:36:27', '::1'),
('jbussy', '2021-03-28', '18:42:59', '::1'),
('alemoine', '2021-03-28', '19:32:39', '::1'),
('mjaouen', '2021-03-28', '19:33:18', '::1'),
('tgaillard', '2021-03-30', '10:11:14', '::1'),
('tgaillard', '2021-03-30', '10:19:04', '::1'),
('alemoine', '2021-03-30', '10:36:09', '::1'),
('tgaillard', '2021-03-30', '10:36:24', '::1'),
('alemoine', '2021-03-30', '10:47:02', '::1'),
('tgaillard', '2021-03-30', '10:47:42', '::1'),
('alemoine', '2021-03-30', '10:48:33', '::1'),
('alemoine', '2021-03-30', '14:39:48', '::1'),
('tgaillard', '2021-03-30', '14:40:06', '::1'),
('alemoine', '2021-03-30', '14:43:08', '::1'),
('alemoine', '2021-03-30', '14:47:36', '::1'),
('alemoine', '2021-03-30', '14:54:36', '::1'),
('alemoine', '2021-03-30', '15:12:28', '::1'),
('alemoine', '2021-03-30', '15:57:13', '::1'),
('kfeuillet', '2021-03-30', '16:10:06', '::1'),
('tgaillard', '2021-03-30', '16:15:56', '::1'),
('tgaillard', '2021-03-30', '16:56:07', '::1'),
('alemoine', '2021-03-30', '16:59:10', '::1'),
('alemoine', '2021-03-30', '17:09:03', '::1'),
('alemoine', '2021-03-30', '17:18:56', '::1'),
('kfeuillet', '2021-03-30', '17:25:41', '::1'),
('superadmin', '2021-03-30', '17:30:56', '::1'),
('superadmin', '2021-03-30', '17:55:01', '::1'),
('superadmin', '2021-03-30', '23:37:12', '::1'),
('alemoine', '2021-03-30', '23:55:17', '::1'),
('alemoine', '2021-03-30', '23:55:47', '::1'),
('alemoine', '2021-03-31', '08:38:40', '::1'),
('kfeuillet', '2021-03-31', '08:43:51', '::1'),
('tgaillard', '2021-03-31', '08:47:45', '::1'),
('tgaillard', '2021-10-11', '17:42:02', '::1'),
('cmiron', '2021-10-11', '17:46:31', '::1'),
('agossaume', '2021-10-25', '09:42:59', '::1'),
('tgaillard', '2021-10-28', '13:13:54', '::1'),
('tgaillard', '2021-12-22', '14:44:57', '::1'),
('tgaillard', '2022-03-03', '21:09:31', '::1'),
('superadmin', '2022-03-03', '21:42:25', '::1'),
('superadmin', '2022-03-03', '21:42:40', '::1'),
('agossaume', '2022-03-03', '21:45:35', '::1'),
('alemoine', '2022-03-03', '21:46:20', '::1'),
('lparize', '2022-03-03', '21:47:25', '::1'),
('mpiel', '2022-03-03', '21:48:03', '::1'),
('pduclos', '2022-03-03', '21:49:02', '::1'),
('alemoine', '2022-03-03', '21:55:50', '::1'),
('cmiron', '2022-03-03', '22:03:21', '::1'),
('jmarseau', '2022-03-03', '22:06:03', '::1');

-- --------------------------------------------------------

--
-- Structure de la table `notes1`
--

CREATE TABLE `notes1` (
  `ID_alternant` int(255) NOT NULL,
  `UE1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE1bis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE1ter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE2bis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE2ter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notes1`
--

INSERT INTO `notes1` (`ID_alternant`, `UE1`, `UE1bis`, `UE1ter`, `UE2`, `UE2bis`, `UE2ter`) VALUES
(23, 'a:9:{s:3:\"ct1\";s:0:\"\";s:3:\"tp1\";s:2:\"10\";s:3:\"cp2\";s:0:\"\";s:3:\"cp3\";s:0:\"\";s:3:\"tp3\";s:0:\"\";s:3:\"tp4\";s:0:\"\";s:3:\"cp5\";s:0:\"\";s:4:\"cp52\";s:0:\"\";s:3:\"cp6\";s:0:\"\";}', 'a:9:{s:3:\"tp6\";s:0:\"\";s:3:\"ct7\";s:0:\"\";s:3:\"tp7\";s:0:\"\";s:3:\"tp8\";s:0:\"\";s:3:\"ct9\";s:0:\"\";s:3:\"tp9\";s:0:\"\";s:4:\"cp10\";s:0:\"\";s:4:\"tp10\";s:0:\"\";s:4:\"ct11\";s:0:\"\";}', 'a:8:{s:4:\"tp11\";s:0:\"\";s:4:\"cp12\";s:0:\"\";s:4:\"tp12\";s:0:\"\";s:4:\"ct13\";s:0:\"\";s:4:\"cp13\";s:0:\"\";s:4:\"tp13\";s:0:\"\";s:4:\"cc14\";s:0:\"\";s:4:\"cc15\";s:0:\"\";}', 'a:10:{s:4:\"ct16\";s:0:\"\";s:4:\"cc16\";s:0:\"\";s:5:\"cc161\";s:0:\"\";s:5:\"cc162\";s:0:\"\";s:4:\"ct17\";s:0:\"\";s:4:\"cc17\";s:0:\"\";s:5:\"cc171\";s:0:\"\";s:5:\"cc172\";s:0:\"\";s:4:\"ct18\";s:0:\"\";s:4:\"cc18\";s:0:\"\";}', 'a:10:{s:4:\"ct19\";s:0:\"\";s:4:\"cc19\";s:0:\"\";s:5:\"cc191\";s:0:\"\";s:4:\"cc20\";s:0:\"\";s:4:\"cp21\";s:0:\"\";s:5:\"cp212\";s:0:\"\";s:4:\"cp22\";s:0:\"\";s:5:\"cp222\";s:0:\"\";s:4:\"cp23\";s:0:\"\";s:5:\"cp232\";s:0:\"\";}', 'a:11:{s:4:\"ct24\";s:0:\"\";s:4:\"tp24\";s:0:\"\";s:4:\"cp25\";s:0:\"\";s:5:\"cp252\";s:0:\"\";s:4:\"tp25\";s:0:\"\";s:4:\"ct26\";s:0:\"\";s:4:\"cp26\";s:0:\"\";s:4:\"tp26\";s:0:\"\";s:4:\"ct27\";s:0:\"\";s:4:\"cp27\";s:0:\"\";s:4:\"tp27\";s:0:\"\";}'),
(25, 'a:9:{s:3:\"ct1\";s:2:\"18\";s:3:\"tp1\";s:2:\"10\";s:3:\"cp2\";s:0:\"\";s:3:\"cp3\";s:0:\"\";s:3:\"tp3\";s:2:\"20\";s:3:\"tp4\";s:0:\"\";s:3:\"cp5\";s:0:\"\";s:4:\"cp52\";s:0:\"\";s:3:\"cp6\";s:0:\"\";}', 'a:9:{s:3:\"tp6\";s:0:\"\";s:3:\"ct7\";s:0:\"\";s:3:\"tp7\";s:0:\"\";s:3:\"tp8\";s:0:\"\";s:3:\"ct9\";s:0:\"\";s:3:\"tp9\";s:0:\"\";s:4:\"cp10\";s:0:\"\";s:4:\"tp10\";s:0:\"\";s:4:\"ct11\";s:0:\"\";}', 'a:8:{s:4:\"tp11\";s:0:\"\";s:4:\"cp12\";s:0:\"\";s:4:\"tp12\";s:0:\"\";s:4:\"ct13\";s:0:\"\";s:4:\"cp13\";s:0:\"\";s:4:\"tp13\";s:0:\"\";s:4:\"cc14\";s:0:\"\";s:4:\"cc15\";s:0:\"\";}', 'a:10:{s:4:\"ct16\";s:0:\"\";s:4:\"cc16\";s:0:\"\";s:5:\"cc161\";s:0:\"\";s:5:\"cc162\";s:0:\"\";s:4:\"ct17\";s:0:\"\";s:4:\"cc17\";s:0:\"\";s:5:\"cc171\";s:0:\"\";s:5:\"cc172\";s:0:\"\";s:4:\"ct18\";s:0:\"\";s:4:\"cc18\";s:0:\"\";}', 'a:10:{s:4:\"ct19\";s:0:\"\";s:4:\"cc19\";s:0:\"\";s:5:\"cc191\";s:0:\"\";s:4:\"cc20\";s:0:\"\";s:4:\"cp21\";s:0:\"\";s:5:\"cp212\";s:0:\"\";s:4:\"cp22\";s:0:\"\";s:5:\"cp222\";s:0:\"\";s:4:\"cp23\";s:0:\"\";s:5:\"cp232\";s:0:\"\";}', 'a:11:{s:4:\"ct24\";s:0:\"\";s:4:\"tp24\";s:0:\"\";s:4:\"cp25\";s:0:\"\";s:5:\"cp252\";s:0:\"\";s:4:\"tp25\";s:0:\"\";s:4:\"ct26\";s:0:\"\";s:4:\"cp26\";s:0:\"\";s:4:\"tp26\";s:0:\"\";s:4:\"ct27\";s:0:\"\";s:4:\"cp27\";s:0:\"\";s:4:\"tp27\";s:0:\"\";}'),
(26, 'a:9:{s:3:\"ct1\";s:2:\"20\";s:3:\"tp1\";s:0:\"\";s:3:\"cp2\";s:0:\"\";s:3:\"cp3\";s:0:\"\";s:3:\"tp3\";s:0:\"\";s:3:\"tp4\";s:0:\"\";s:3:\"cp5\";s:0:\"\";s:4:\"cp52\";s:0:\"\";s:3:\"cp6\";s:0:\"\";}', 'a:9:{s:3:\"tp6\";s:0:\"\";s:3:\"ct7\";s:0:\"\";s:3:\"tp7\";s:0:\"\";s:3:\"tp8\";s:0:\"\";s:3:\"ct9\";s:0:\"\";s:3:\"tp9\";s:0:\"\";s:4:\"cp10\";s:0:\"\";s:4:\"tp10\";s:0:\"\";s:4:\"ct11\";s:0:\"\";}', 'a:8:{s:4:\"tp11\";s:0:\"\";s:4:\"cp12\";s:0:\"\";s:4:\"tp12\";s:0:\"\";s:4:\"ct13\";s:0:\"\";s:4:\"cp13\";s:0:\"\";s:4:\"tp13\";s:0:\"\";s:4:\"cc14\";s:0:\"\";s:4:\"cc15\";s:0:\"\";}', 'a:10:{s:4:\"ct16\";s:0:\"\";s:4:\"cc16\";s:0:\"\";s:5:\"cc161\";s:0:\"\";s:5:\"cc162\";s:0:\"\";s:4:\"ct17\";s:0:\"\";s:4:\"cc17\";s:0:\"\";s:5:\"cc171\";s:0:\"\";s:5:\"cc172\";s:0:\"\";s:4:\"ct18\";s:0:\"\";s:4:\"cc18\";s:0:\"\";}', 'a:10:{s:4:\"ct19\";s:0:\"\";s:4:\"cc19\";s:0:\"\";s:5:\"cc191\";s:0:\"\";s:4:\"cc20\";s:0:\"\";s:4:\"cp21\";s:0:\"\";s:5:\"cp212\";s:0:\"\";s:4:\"cp22\";s:0:\"\";s:5:\"cp222\";s:0:\"\";s:4:\"cp23\";s:0:\"\";s:5:\"cp232\";s:0:\"\";}', 'a:11:{s:4:\"ct24\";s:0:\"\";s:4:\"tp24\";s:0:\"\";s:4:\"cp25\";s:0:\"\";s:5:\"cp252\";s:0:\"\";s:4:\"tp25\";s:0:\"\";s:4:\"ct26\";s:0:\"\";s:4:\"cp26\";s:0:\"\";s:4:\"tp26\";s:0:\"\";s:4:\"ct27\";s:0:\"\";s:4:\"cp27\";s:0:\"\";s:4:\"tp27\";s:0:\"\";}'),
(27, 'a:9:{s:3:\"ct1\";s:2:\"13\";s:3:\"tp1\";s:2:\"12\";s:3:\"cp2\";s:2:\"10\";s:3:\"cp3\";s:0:\"\";s:3:\"tp3\";s:1:\"6\";s:3:\"tp4\";s:2:\"20\";s:3:\"cp5\";s:0:\"\";s:4:\"cp52\";s:2:\"20\";s:3:\"cp6\";s:2:\"20\";}', 'a:9:{s:3:\"tp6\";s:0:\"\";s:3:\"ct7\";s:0:\"\";s:3:\"tp7\";s:1:\"2\";s:3:\"tp8\";s:0:\"\";s:3:\"ct9\";s:0:\"\";s:3:\"tp9\";s:0:\"\";s:4:\"cp10\";s:1:\"0\";s:4:\"tp10\";s:0:\"\";s:4:\"ct11\";s:0:\"\";}', 'a:8:{s:4:\"tp11\";s:0:\"\";s:4:\"cp12\";s:0:\"\";s:4:\"tp12\";s:0:\"\";s:4:\"ct13\";s:0:\"\";s:4:\"cp13\";s:0:\"\";s:4:\"tp13\";s:0:\"\";s:4:\"cc14\";s:0:\"\";s:4:\"cc15\";s:0:\"\";}', 'a:10:{s:4:\"ct16\";s:0:\"\";s:4:\"cc16\";s:0:\"\";s:5:\"cc161\";s:0:\"\";s:5:\"cc162\";s:0:\"\";s:4:\"ct17\";s:0:\"\";s:4:\"cc17\";s:0:\"\";s:5:\"cc171\";s:0:\"\";s:5:\"cc172\";s:0:\"\";s:4:\"ct18\";s:0:\"\";s:4:\"cc18\";s:0:\"\";}', 'a:10:{s:4:\"ct19\";s:0:\"\";s:4:\"cc19\";s:0:\"\";s:5:\"cc191\";s:0:\"\";s:4:\"cc20\";s:0:\"\";s:4:\"cp21\";s:0:\"\";s:5:\"cp212\";s:0:\"\";s:4:\"cp22\";s:0:\"\";s:5:\"cp222\";s:0:\"\";s:4:\"cp23\";s:0:\"\";s:5:\"cp232\";s:0:\"\";}', 'a:11:{s:4:\"ct24\";s:0:\"\";s:4:\"tp24\";s:0:\"\";s:4:\"cp25\";s:0:\"\";s:5:\"cp252\";s:0:\"\";s:4:\"tp25\";s:0:\"\";s:4:\"ct26\";s:0:\"\";s:4:\"cp26\";s:0:\"\";s:4:\"tp26\";s:0:\"\";s:4:\"ct27\";s:0:\"\";s:4:\"cp27\";s:0:\"\";s:4:\"tp27\";s:0:\"\";}');

-- --------------------------------------------------------

--
-- Structure de la table `notes2`
--

CREATE TABLE `notes2` (
  `ID_alternant` int(11) NOT NULL,
  `UE1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE1bis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE1ter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE2bis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE2ter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE2quater` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notes2`
--

INSERT INTO `notes2` (`ID_alternant`, `UE1`, `UE1bis`, `UE1ter`, `UE2`, `UE2bis`, `UE2ter`, `UE2quater`) VALUES
(25, 'a:9:{s:3:\"ct1\";s:2:\"10\";s:3:\"tp1\";s:0:\"\";s:3:\"cp2\";s:2:\"20\";s:3:\"tp2\";s:0:\"\";s:3:\"cp3\";s:2:\"20\";s:3:\"cp4\";s:0:\"\";s:3:\"ct5\";s:0:\"\";s:3:\"tp5\";s:0:\"\";s:3:\"cc6\";s:0:\"\";}', 'a:9:{s:3:\"tp6\";s:0:\"\";s:3:\"cp7\";s:0:\"\";s:3:\"tp7\";s:0:\"\";s:3:\"cp8\";s:0:\"\";s:4:\"cp82\";s:0:\"\";s:3:\"tp8\";s:0:\"\";s:3:\"cc9\";s:0:\"\";s:4:\"cc10\";s:0:\"\";s:5:\"cc102\";s:0:\"\";}', 'a:7:{s:5:\"cc103\";s:0:\"\";s:4:\"cp11\";s:0:\"\";s:5:\"cp112\";s:0:\"\";s:4:\"cp12\";s:0:\"\";s:5:\"cp122\";s:0:\"\";s:4:\"cp13\";s:0:\"\";s:5:\"cp132\";s:0:\"\";}', 'a:8:{s:4:\"cp14\";s:0:\"\";s:5:\"cp142\";s:0:\"\";s:4:\"cc15\";s:0:\"\";s:5:\"cc152\";s:0:\"\";s:4:\"ct16\";s:0:\"\";s:4:\"cc16\";s:0:\"\";s:4:\"cc17\";s:0:\"\";s:4:\"cc18\";s:0:\"\";}', 'a:8:{s:4:\"cc19\";s:0:\"\";s:5:\"cc192\";s:0:\"\";s:4:\"cc20\";s:0:\"\";s:4:\"ct21\";s:0:\"\";s:4:\"cp22\";s:0:\"\";s:5:\"cp222\";s:0:\"\";s:5:\"cp223\";s:0:\"\";s:4:\"ct23\";s:0:\"\";}', 'a:8:{s:4:\"tp23\";s:0:\"\";s:4:\"cp24\";s:0:\"\";s:4:\"tp24\";s:0:\"\";s:4:\"cp25\";s:0:\"\";s:4:\"tp25\";s:0:\"\";s:4:\"cp26\";s:0:\"\";s:4:\"tp26\";s:0:\"\";s:4:\"ct27\";s:0:\"\";}', 'a:6:{s:4:\"tp27\";s:0:\"\";s:4:\"ct28\";s:0:\"\";s:4:\"tp28\";s:0:\"\";s:4:\"cp29\";s:0:\"\";s:5:\"cp292\";s:0:\"\";s:4:\"tp29\";s:0:\"\";}'),
(27, 'a:9:{s:3:\"ct1\";s:2:\"20\";s:3:\"tp1\";s:2:\"20\";s:3:\"cp2\";s:1:\"2\";s:3:\"tp2\";s:2:\"16\";s:3:\"cp3\";s:2:\"15\";s:3:\"cp4\";s:2:\"10\";s:3:\"ct5\";s:1:\"1\";s:3:\"tp5\";s:2:\"10\";s:3:\"cc6\";s:1:\"2\";}', 'a:9:{s:3:\"tp6\";s:1:\"2\";s:3:\"cp7\";s:1:\"1\";s:3:\"tp7\";s:1:\"2\";s:3:\"cp8\";s:1:\"1\";s:4:\"cp82\";s:0:\"\";s:3:\"tp8\";s:1:\"0\";s:3:\"cc9\";s:1:\"0\";s:4:\"cc10\";s:1:\"1\";s:5:\"cc102\";s:1:\"1\";}', 'a:7:{s:5:\"cc103\";s:1:\"1\";s:4:\"cp11\";s:2:\"10\";s:5:\"cp112\";s:1:\"1\";s:4:\"cp12\";s:2:\"11\";s:5:\"cp122\";s:1:\"1\";s:4:\"cp13\";s:2:\"12\";s:5:\"cp132\";s:1:\"1\";}', 'a:8:{s:4:\"cp14\";s:0:\"\";s:5:\"cp142\";s:0:\"\";s:4:\"cc15\";s:2:\"13\";s:5:\"cc152\";s:1:\"2\";s:4:\"ct16\";s:1:\"2\";s:4:\"cc16\";s:2:\"14\";s:4:\"cc17\";s:2:\"15\";s:4:\"cc18\";s:1:\"8\";}', 'a:8:{s:4:\"cc19\";s:0:\"\";s:5:\"cc192\";s:0:\"\";s:4:\"cc20\";s:0:\"\";s:4:\"ct21\";s:1:\"3\";s:4:\"cp22\";s:1:\"1\";s:5:\"cp222\";s:0:\"\";s:5:\"cp223\";s:0:\"\";s:4:\"ct23\";s:1:\"4\";}', 'a:8:{s:4:\"tp23\";s:0:\"\";s:4:\"cp24\";s:0:\"\";s:4:\"tp24\";s:1:\"2\";s:4:\"cp25\";s:1:\"2\";s:4:\"tp25\";s:2:\"10\";s:4:\"cp26\";s:0:\"\";s:4:\"tp26\";s:1:\"2\";s:4:\"ct27\";s:0:\"\";}', 'a:6:{s:4:\"tp27\";s:0:\"\";s:4:\"ct28\";s:0:\"\";s:4:\"tp28\";s:2:\"12\";s:4:\"cp29\";s:1:\"3\";s:5:\"cp292\";s:1:\"3\";s:4:\"tp29\";s:1:\"3\";}');

-- --------------------------------------------------------

--
-- Structure de la table `notes3`
--

CREATE TABLE `notes3` (
  `ID_alternant` int(11) NOT NULL,
  `UE1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE1bis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `UE1ter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notes3`
--

INSERT INTO `notes3` (`ID_alternant`, `UE1`, `UE1bis`, `UE1ter`) VALUES
(27, 'a:9:{s:3:\"cc1\";s:1:\"3\";s:3:\"ct2\";s:2:\"11\";s:3:\"tp2\";s:1:\"3\";s:3:\"ct3\";s:1:\"3\";s:3:\"tp3\";s:1:\"2\";s:3:\"ct4\";s:1:\"2\";s:3:\"tp4\";s:1:\"2\";s:3:\"cc5\";s:1:\"2\";s:3:\"tp6\";s:1:\"2\";}', 'a:9:{s:3:\"ct7\";s:1:\"2\";s:3:\"tp7\";s:1:\"2\";s:3:\"ct8\";s:1:\"2\";s:3:\"tp8\";s:1:\"2\";s:3:\"cc9\";s:1:\"2\";s:4:\"cc10\";s:1:\"2\";s:4:\"ct11\";s:1:\"2\";s:4:\"tp11\";s:1:\"5\";s:4:\"ct12\";s:1:\"2\";}', 'a:4:{s:4:\"tp12\";s:1:\"5\";s:4:\"cc13\";s:2:\"15\";s:4:\"cc14\";s:2:\"12\";s:4:\"cc15\";s:2:\"10\";}');

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE `periode` (
  `Nb_enregistrement` int(255) NOT NULL,
  `Annee` varchar(50) NOT NULL,
  `Date1` date NOT NULL,
  `Date2` date NOT NULL,
  `ID_alternant` int(50) NOT NULL,
  `missions` varchar(1000) NOT NULL,
  `difficultes` varchar(1000) NOT NULL,
  `commentaires` varchar(1000) NOT NULL,
  `competence1` varchar(2) NOT NULL,
  `competence2` varchar(2) NOT NULL,
  `competence3` varchar(2) NOT NULL,
  `competence4` varchar(2) NOT NULL,
  `competence5` varchar(2) NOT NULL,
  `competence6` varchar(2) NOT NULL,
  `competence7` varchar(2) NOT NULL,
  `competence8` varchar(2) NOT NULL,
  `competence9` varchar(2) NOT NULL,
  `competence10` varchar(2) NOT NULL,
  `competence11` varchar(2) NOT NULL,
  `competence12` varchar(2) NOT NULL,
  `competence13` varchar(2) NOT NULL,
  `competence14` varchar(2) NOT NULL,
  `competence15` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`Nb_enregistrement`, `Annee`, `Date1`, `Date2`, `ID_alternant`, `missions`, `difficultes`, `commentaires`, `competence1`, `competence2`, `competence3`, `competence4`, `competence5`, `competence6`, `competence7`, `competence8`, `competence9`, `competence10`, `competence11`, `competence12`, `competence13`, `competence14`, `competence15`) VALUES
(1, '1AA', '2021-02-26', '2021-03-18', 27, '- Configurer un routeur\r\n- Observer des captures Wireshark\r\n- Ajouter des adresses IP\r\n- Mettre en place un routage dynamique', '- Prendre des décisions\r\n- S\'affirmer\r\n- Manque d\'organisation', 'Très bon travail durant cette période entreprise !', 'A', 'B', 'A', 'C', 'B', 'C', 'B', 'A', 'B', 'B', 'C', 'D', 'A', '', ''),
(2, '1AA', '2021-02-26', '2021-03-18', 26, '', '', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'A', 'B', 'NE', 'NE', 'NE', 'NE', 'NE', 'NE', 'NE', 'NE', 'NE', 'NE', 'NE', '', ''),
(7, '2A', '2021-02-12', '2021-03-11', 27, '--> Maths\r\n--> Electronique\r\n--> Télécoms', 'Aucune difficulté', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, '1AA', '2020-10-30', '2020-11-26', 48, '', '', '', 'A', 'B', 'C', 'D', 'A', 'A', 'A', 'A', 'A', 'B', 'C', 'A', '', '', ''),
(9, 'TRTE', '2020-10-16', '2020-11-15', 47, '', '', '', 'A', 'A', 'A', 'A', 'A', 'B', 'C', 'D', 'NE', 'A', 'B', 'C', '', '', ''),
(10, '1AA', '2020-08-28', '2020-09-24', 27, '', '', '', 'A', 'B', 'C', 'D', 'A', 'B', 'C', 'D', 'NE', 'A', 'B', 'C', '', '', ''),
(11, '1AA', '2020-10-30', '2020-11-26', 27, '--> Maths', 'Aucune', '', 'B', 'A', 'B', 'A', 'A', 'B', 'A', 'B', 'A', 'A', 'B', 'A', '', '', ''),
(12, '2A', '2021-04-23', '2021-06-17', 27, '', '', '', 'A', 'A', 'A', 'A', 'B', 'B', 'B', 'B', 'C', 'C', 'C', 'C', 'C', '', ''),
(13, '2A', '2020-10-09', '2020-11-05', 27, '--> Configurer un routeur', 'Aucune', 'parfait', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, '2A', '2020-12-18', '2021-01-07', 27, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, '1AA', '2021-02-26', '2021-03-18', 49, '', '', 'bon travail', 'A', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 'TRTE', '2021-01-25', '2021-04-04', 46, '', '', 'bon travail', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, '1AA', '2021-07-02', '2021-08-01', 27, '--> Maths\r\n--> Réseaux\r\n--> Télécoms', 'Aucune', 'parfait', 'A', 'B', 'A', 'B', 'A', 'A', 'B', 'A', 'B', 'A', 'A', 'B', 'A', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `provisoire_iut`
--

CREATE TABLE `provisoire_iut` (
  `Nb_enregistrement` int(255) NOT NULL,
  `Annee` varchar(255) NOT NULL,
  `Date1` date NOT NULL,
  `Date2` date NOT NULL,
  `ID_alternant` int(255) NOT NULL,
  `Module` varchar(255) NOT NULL,
  `Remarques` varchar(255) NOT NULL,
  `Date_modification` int(255) NOT NULL,
  `Modif_alternant` int(1) NOT NULL,
  `Modif_tuteur` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `provisoire_periode`
--

CREATE TABLE `provisoire_periode` (
  `Nb_enregistrement` int(255) NOT NULL,
  `Annee` varchar(50) NOT NULL,
  `Date1` date NOT NULL,
  `Date2` date NOT NULL,
  `ID_alternant` int(50) NOT NULL,
  `missions` varchar(1000) NOT NULL,
  `difficultes` varchar(1000) NOT NULL,
  `commentaires` varchar(1000) NOT NULL,
  `competence1` varchar(2) NOT NULL,
  `competence2` varchar(2) NOT NULL,
  `competence3` varchar(2) NOT NULL,
  `competence4` varchar(2) NOT NULL,
  `competence5` varchar(2) NOT NULL,
  `competence6` varchar(2) NOT NULL,
  `competence7` varchar(2) NOT NULL,
  `competence8` varchar(2) NOT NULL,
  `competence9` varchar(2) NOT NULL,
  `competence10` varchar(2) NOT NULL,
  `competence11` varchar(2) NOT NULL,
  `competence12` varchar(2) NOT NULL,
  `competence13` varchar(2) NOT NULL,
  `competence14` varchar(2) NOT NULL,
  `competence15` varchar(2) NOT NULL,
  `Date_modification` int(255) NOT NULL,
  `Modif_alternant` int(1) NOT NULL,
  `Modif_tuteur` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `provisoire_periode`
--

INSERT INTO `provisoire_periode` (`Nb_enregistrement`, `Annee`, `Date1`, `Date2`, `ID_alternant`, `missions`, `difficultes`, `commentaires`, `competence1`, `competence2`, `competence3`, `competence4`, `competence5`, `competence6`, `competence7`, `competence8`, `competence9`, `competence10`, `competence11`, `competence12`, `competence13`, `competence14`, `competence15`, `Date_modification`, `Modif_alternant`, `Modif_tuteur`) VALUES
(11, '1AA', '2021-02-26', '2021-03-18', 27, '- Configurer un routeur\r\n- Observer des captures Wireshark\r\n- Ajouter des adresses IP\r\n- Mettre en place un routage dynamique', '- Prendre des décisions\r\n- S\'affirmer\r\n- Manque d\'organisation', 'Très bon travail durant cette période entreprise !', 'A', 'B', 'A', 'C', 'B', 'C', 'B', 'A', 'B', 'B', 'C', 'D', 'A', '', '', 1617173106, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `superviseur`
--

CREATE TABLE `superviseur` (
  `ID_superviseur` int(50) NOT NULL,
  `Identifiant` varchar(50) DEFAULT NULL,
  `Mot_de_passe` varchar(255) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `Email_perso` varchar(50) DEFAULT NULL,
  `Email_pro` varchar(50) DEFAULT NULL,
  `Tel_perso` varchar(10) DEFAULT NULL,
  `Tel_pro` varchar(10) DEFAULT NULL,
  `Photo` binary(255) DEFAULT NULL,
  `ID_entreprise` int(50) DEFAULT NULL,
  `Lieu_entreprise` varchar(255) DEFAULT NULL,
  `Ville` varchar(255) DEFAULT NULL,
  `Validation_reglement` int(1) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `superviseur`
--

INSERT INTO `superviseur` (`ID_superviseur`, `Identifiant`, `Mot_de_passe`, `Nom`, `Prenom`, `Email_perso`, `Email_pro`, `Tel_perso`, `Tel_pro`, `Photo`, `ID_entreprise`, `Lieu_entreprise`, `Ville`, `Validation_reglement`, `name`, `file_url`) VALUES
(1, 'pchalifour', '$2y$10$rtWzMuDPOm7FYXxand8Hy.2aEwTzJGkmyWZG6Z.WCtQcdZQ5Us/mK', 'CHALIFOUR', 'Pascal', '', '', '0606060606', '', NULL, 1, NULL, NULL, 1, NULL, NULL),
(2, 'jmarseau', '$2y$10$BX5P8GvBTYi2nLK/sFxyaOG3viMyH.PKZup9RMxsZ/aXle8/EMEg2', 'MARSEAU', 'Jean', '', '', '', '', NULL, 12, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tuteur`
--

CREATE TABLE `tuteur` (
  `ID_tuteur` int(50) NOT NULL,
  `Identifiant` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mot_de_passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_perso` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_pro` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tel_perso` varchar(10) NOT NULL,
  `Tel_pro` varchar(10) NOT NULL,
  `Photo` binary(255) DEFAULT NULL,
  `ID_entreprise` int(50) DEFAULT NULL,
  `Lieu_entreprise` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Validation_reglement` int(1) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `Code` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tuteur`
--

INSERT INTO `tuteur` (`ID_tuteur`, `Identifiant`, `Mot_de_passe`, `Nom`, `Prenom`, `Email_perso`, `Email_pro`, `Tel_perso`, `Tel_pro`, `Photo`, `ID_entreprise`, `Lieu_entreprise`, `Ville`, `Validation_reglement`, `name`, `file_url`, `Code`) VALUES
(10, 'pduclos', '$2y$10$NdIpkZyfByGw7hElgb6Q6OpQ5dSYFm4/JW7pcXtGcGrCvTN98Np06', 'DUCLOS', 'Philippe', '', '', '', '', NULL, 12, NULL, NULL, 1, '', '', 0),
(9, 'cmiron', '$2y$10$M3XHhWGVe2NC1EkyUx4bD.fHyrdq3K2qyt9WVfPbMQdFxNMErpqqW', 'MIRON', 'Catherine', '', '', '', '', NULL, 11, NULL, NULL, 1, '', '', 0),
(8, 'kfeuillet', '$2y$10$phGv8epRNwJ0OY5YDtfuheqssTrFmBFxNsVSIvzwNHFIxDjLw/8NS', 'FEUILLET', 'Karl', '', '', '', '', NULL, 1, NULL, NULL, 1, 'Capture2.PNG', 'files/Capture2.PNG', 46296);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`ID_administrateur`);

--
-- Index pour la table `alternant`
--
ALTER TABLE `alternant`
  ADD PRIMARY KEY (`ID_alternant`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`ID_enseignant`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`ID_entreprise`);

--
-- Index pour la table `iut`
--
ALTER TABLE `iut`
  ADD PRIMARY KEY (`Nb_enregistrement`);

--
-- Index pour la table `notes1`
--
ALTER TABLE `notes1`
  ADD PRIMARY KEY (`ID_alternant`);

--
-- Index pour la table `notes2`
--
ALTER TABLE `notes2`
  ADD PRIMARY KEY (`ID_alternant`);

--
-- Index pour la table `notes3`
--
ALTER TABLE `notes3`
  ADD PRIMARY KEY (`ID_alternant`);

--
-- Index pour la table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`Nb_enregistrement`);

--
-- Index pour la table `provisoire_iut`
--
ALTER TABLE `provisoire_iut`
  ADD PRIMARY KEY (`Nb_enregistrement`);

--
-- Index pour la table `provisoire_periode`
--
ALTER TABLE `provisoire_periode`
  ADD PRIMARY KEY (`Nb_enregistrement`);

--
-- Index pour la table `superviseur`
--
ALTER TABLE `superviseur`
  ADD PRIMARY KEY (`ID_superviseur`);

--
-- Index pour la table `tuteur`
--
ALTER TABLE `tuteur`
  ADD PRIMARY KEY (`ID_tuteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `ID_administrateur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `alternant`
--
ALTER TABLE `alternant`
  MODIFY `ID_alternant` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `ID_enseignant` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `ID_entreprise` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `iut`
--
ALTER TABLE `iut`
  MODIFY `Nb_enregistrement` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `notes1`
--
ALTER TABLE `notes1`
  MODIFY `ID_alternant` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `notes2`
--
ALTER TABLE `notes2`
  MODIFY `ID_alternant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `periode`
--
ALTER TABLE `periode`
  MODIFY `Nb_enregistrement` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `provisoire_iut`
--
ALTER TABLE `provisoire_iut`
  MODIFY `Nb_enregistrement` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `provisoire_periode`
--
ALTER TABLE `provisoire_periode`
  MODIFY `Nb_enregistrement` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `superviseur`
--
ALTER TABLE `superviseur`
  MODIFY `ID_superviseur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tuteur`
--
ALTER TABLE `tuteur`
  MODIFY `ID_tuteur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
