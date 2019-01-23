-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 21 jan. 2019 à 19:08
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cars2`
--

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `num_id` int(11) NOT NULL,
  `moyenne` float NOT NULL,
  `dle` int(11) NOT NULL,
  `aps` int(11) NOT NULL,
  `arv` int(11) NOT NULL,
  `ihm` int(11) NOT NULL,
  `fdt` int(11) NOT NULL,
  `ars` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `num_id` (`num_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `num_id`, `moyenne`, `dle`, `aps`, `arv`, `ihm`, `fdt`, `ars`) VALUES
(7, 11400931, 18, 5, 1, 2, 3, 4, 6),
(11, 11400932, 15, 1, 2, 3, 4, 5, 6),
(12, 11400933, 13, 5, 1, 2, 3, 4, 6),
(13, 11400934, 14, 3, 4, 5, 1, 2, 6),
(14, 11400936, 10, 4, 5, 1, 2, 3, 6),
(15, 11400939, 19, 3, 4, 5, 1, 2, 6),
(16, 11400937, 17, 2, 3, 4, 5, 1, 6),
(17, 11400935, 12, 2, 3, 4, 5, 1, 6),
(18, 11400938, 16, 4, 5, 1, 2, 3, 6),
(20, 11400930, 19.5, 1, 2, 3, 4, 5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `rendu`
--

DROP TABLE IF EXISTS `rendu`;
CREATE TABLE IF NOT EXISTS `rendu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_choix` varchar(255) NOT NULL,
  `premier` int(11) DEFAULT NULL,
  `deuxieme` int(11) DEFAULT NULL,
  `troisieme` int(11) DEFAULT NULL,
  `quatrieme` int(11) DEFAULT NULL,
  `cinquieme` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rendu`
--

INSERT INTO `rendu` (`id`, `option_choix`, `premier`, `deuxieme`, `troisieme`, `quatrieme`, `cinquieme`) VALUES
(1, 'dle', 11400930, 11400939, 11400937, 11400936, 11400935),
(2, 'aps', 11400930, 11400931, 11400937, 11400932, 11400936),
(3, 'arv', 11400930, 11400931, 11400938, 11400932, 11400933),
(4, 'ihm', 11400939, 11400931, 11400938, 11400934, 11400933),
(5, 'fdt', 11400939, 11400937, 11400938, 11400934, 11400935),
(6, 'ars', 11400935, 11400934, 11400936, 11400933, 11400932);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
