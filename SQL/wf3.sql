-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 26 oct. 2018 à 11:13
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wf3`
--
CREATE DATABASE IF NOT EXISTS `wf3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wf3`;

-- --------------------------------------------------------

--
-- Structure de la table `fruits`
--

CREATE TABLE `fruits` (
  `id` int(11) NOT NULL,
  `fruit_name` varchar(20) NOT NULL,
  `fruit_color` varchar(20) DEFAULT NULL,
  `fruit_origin` varchar(50) NOT NULL,
  `fruit_description` varchar(5000) NOT NULL,
  `fruit_price` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fruits`
--

INSERT INTO `fruits` (`id`, `fruit_name`, `fruit_color`, `fruit_origin`, `fruit_description`, `fruit_price`) VALUES
(1, 'orange', 'orange', 'france', 'blabla', '2.56'),
(2, 'fraise', 'rouge', 'espagne', 'blabla', '6.56'),
(3, 'cerise', 'rouge', 'france', 'blabla', '8.98'),
(4, 'kiwi', 'vert', 'allemagne', 'blabla', '50.00'),
(5, 'papaye', 'orange', 'martinique', 'blabla', '89.56'),
(6, 'raisin', 'violet', 'allemagne', 'blabla', '2.35'),
(7, 'prune', 'violet', 'france', 'blabla', '78.41'),
(8, 'ananas', 'jaune', 'espagne', 'blabla', '4.69'),
(9, 'pomme', 'vert', 'france', 'blabla', '5.00'),
(10, 'pomme', 'rouge', 'espagne', 'blabla', '4.56');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fruits`
--
ALTER TABLE `fruits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `fruits`
--
ALTER TABLE `fruits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
