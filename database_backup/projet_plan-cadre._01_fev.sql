-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 01 Février 2016 à 22:31
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet_plan-cadre`
--

-- --------------------------------------------------------

--
-- Structure de la table `consignes`
--

CREATE TABLE IF NOT EXISTS `consignes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `titre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `enonce` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `datemodification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ponderation` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `unite` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `heure` int(11) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `dateajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cours_code_unique` (`code`),
  KEY `cours_fk_programmes` (`programme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id`, `code`, `nom`, `type`, `ponderation`, `unite`, `heure`, `programme_id`, `dateajout`, `datemodification`) VALUES
(4, '393-DE0-LG', 'Catalogage', 'enseignement régulier', '2-2-1', '2', 30, 3, '2016-01-26 16:32:20', '0000-00-00 00:00:00'),
(5, '202-NYA-05', 'Chimie générale : la matière', 'enseignement régulier', '3-2-3', '1', 40, 2, '2016-01-26 16:33:50', '2016-01-26 16:33:50'),
(8, '101-NYA-05', 'Évolution et diversité du vivant', 'enseignement régulier', '3-2-3', '2', 40, 2, '2016-01-26 16:35:33', '2016-01-26 16:35:33'),
(9, '202-NYB-05', 'Chimie des solutions', 'enseignement régulier', '3-2-3', '3', 50, 2, '2016-01-26 16:35:33', '2016-01-26 16:35:33'),
(10, '393-EDB-05', 'Documents et producteurs', 'enseignement régulier', '2-3-1', '1', 45, 3, '2016-01-26 16:37:50', '2016-01-26 16:37:50'),
(13, '393-EDX-04', 'Outils de gestion de documents administratifs', 'enseignement régulier', '2-2-1', '2.3333', 45, 3, '2016-01-26 16:40:59', '2016-01-26 16:40:59'),
(14, '101-A12-VM', 'Biologie du corps humain 1', 'enseignement régulier', '5-2-4', '2.3333', 60, 1, '2016-01-26 16:44:34', '2016-01-26 16:44:34'),
(15, '180-101-VM', 'Principes de base en soins infirmiers', 'enseignement régulier', '6-6-4', '3.5', 75, 1, '2016-01-26 16:46:04', '2016-01-26 16:46:04');

-- --------------------------------------------------------

--
-- Structure de la table `elaborateurs`
--

CREATE TABLE IF NOT EXISTS `elaborateurs` (
  `utilisateur_id` int(11) NOT NULL,
  `plancadre_id` int(11) NOT NULL,
  `dateajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `elaborateurs_fk_utilisateurs` (`utilisateur_id`),
  KEY `elaborateurs_fk_plancadres` (`plancadre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plancadres`
--

CREATE TABLE IF NOT EXISTS `plancadres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `dateajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateadoption` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plancadres_fk_cours` (`cours_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `plancadres_sections`
--

CREATE TABLE IF NOT EXISTS `plancadres_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `programmes`
--

CREATE TABLE IF NOT EXISTS `programmes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dateajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `programmes_code_unique` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `programmes`
--

INSERT INTO `programmes` (`id`, `code`, `nom`, `Type`, `dateajout`, `datemodification`) VALUES
(1, '180.A0', 'Soins infirmiers', 'technique', '2016-01-26 15:47:24', '2016-01-26 15:47:24'),
(2, '200.B0', 'Sciences de la nature', 'préuniversitaire', '2016-01-26 15:47:24', '2016-01-26 15:47:24'),
(3, '393.A0', 'Techniques de la documentation', 'technique', '2016-01-26 15:48:38', '2016-01-26 15:48:38');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomutilisateur` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `motdepasse` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `etat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dateajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nomutilisateur`, `motdepasse`, `email`, `nom`, `prenom`, `type`, `etat`, `dateajout`, `datemodification`) VALUES
(1, 'admintest', 'sha256:1000:HdK48HvYjg5eOyob0fcHdJlwtJyhAsHJ:GS2y4wWKxJbsGRWFXR8IFPxs9izYs0O8', 'admin@gmail.com', 'Test', 'Admin', 'Administrateur', 'Actif', '2016-01-28 09:44:07', '2016-01-28 09:44:07');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`);

--
-- Contraintes pour la table `elaborateurs`
--
ALTER TABLE `elaborateurs`
  ADD CONSTRAINT `elaborateurs_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `elaborateurs_ibfk_2` FOREIGN KEY (`plancadre_id`) REFERENCES `plancadres` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `plancadres`
--
ALTER TABLE `plancadres`
  ADD CONSTRAINT `plancadres_ibfk_1` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
