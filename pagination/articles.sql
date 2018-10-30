-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 16 nov. 2017 à 17:41
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exercices`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `author` varchar(30) NOT NULL,
  `content` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `date`, `author`, `content`) VALUES
(1, '6795', '2006-12-19', 'Moi', 'Blabla'),
(2, '1652', '2007-06-27', 'Moi', 'Blabla'),
(3, '5656', '2006-11-07', 'Moi', 'Blabla'),
(4, '4367', '2006-11-20', 'Moi', 'Blabla'),
(5, '1865', '2012-03-28', 'Moi', 'Blabla'),
(6, '4942', '2010-12-01', 'Moi', 'Blabla'),
(7, '3089', '2002-04-02', 'Moi', 'Blabla'),
(8, '177', '2005-01-09', 'Moi', 'Blabla'),
(9, '1139', '2014-03-13', 'Moi', 'Blabla'),
(10, '8372', '2006-12-06', 'Moi', 'Blabla'),
(11, '1774', '2003-08-21', 'Moi', 'Blabla'),
(12, '1347', '2002-07-15', 'Moi', 'Blabla'),
(13, '4320', '2010-04-04', 'Moi', 'Blabla'),
(14, '534', '2004-12-03', 'Moi', 'Blabla'),
(15, '3833', '2017-02-11', 'Moi', 'Blabla'),
(16, '9694', '2016-09-30', 'Moi', 'Blabla'),
(17, '2434', '2011-02-08', 'Moi', 'Blabla'),
(18, '788', '2011-08-04', 'Moi', 'Blabla'),
(19, '1267', '2003-06-30', 'Moi', 'Blabla'),
(20, '9070', '2003-08-18', 'Moi', 'Blabla'),
(21, '1418', '2010-02-01', 'Moi', 'Blabla'),
(22, '1020', '2004-09-28', 'Moi', 'Blabla'),
(23, '7495', '2009-08-17', 'Moi', 'Blabla'),
(24, '2687', '2011-10-07', 'Moi', 'Blabla'),
(25, '2953', '2011-01-05', 'Moi', 'Blabla'),
(26, '5162', '2014-08-18', 'Moi', 'Blabla'),
(27, '1104', '2012-10-31', 'Moi', 'Blabla'),
(28, '3640', '2007-07-01', 'Moi', 'Blabla'),
(29, '4444', '2005-07-12', 'Moi', 'Blabla'),
(30, '3575', '2014-04-30', 'Moi', 'Blabla'),
(31, '9006', '2006-07-27', 'Moi', 'Blabla'),
(32, '6205', '2015-01-11', 'Moi', 'Blabla'),
(33, '2231', '2009-07-20', 'Moi', 'Blabla'),
(34, '9156', '2007-08-24', 'Moi', 'Blabla'),
(35, '5097', '2002-07-27', 'Moi', 'Blabla'),
(36, '7023', '2010-04-02', 'Moi', 'Blabla'),
(37, '5678', '2008-05-06', 'Moi', 'Blabla'),
(38, '6726', '2013-05-14', 'Moi', 'Blabla'),
(39, '8969', '2010-12-17', 'Moi', 'Blabla'),
(40, '8906', '2008-02-07', 'Moi', 'Blabla'),
(41, '338', '2004-01-23', 'Moi', 'Blabla'),
(42, '2822', '2011-09-15', 'Moi', 'Blabla'),
(43, '5016', '2008-02-29', 'Moi', 'Blabla'),
(44, '4691', '2006-08-16', 'Moi', 'Blabla'),
(45, '4343', '2005-05-13', 'Moi', 'Blabla'),
(46, '5291', '2005-10-16', 'Moi', 'Blabla'),
(47, '1266', '2015-08-23', 'Moi', 'Blabla'),
(48, '1437', '2017-03-24', 'Moi', 'Blabla'),
(49, '6444', '2002-08-24', 'Moi', 'Blabla'),
(50, '6236', '2013-05-16', 'Moi', 'Blabla');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
