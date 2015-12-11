-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 11 Décembre 2015 à 17:38
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `plan_cadre`
--

-- --------------------------------------------------------

--
-- Structure de la table `plancadre`
--

CREATE TABLE IF NOT EXISTS `plancadre` (
  `No_PlanCadre` int(11) NOT NULL AUTO_INCREMENT,
  `Cours_CodeCours` char(10) NOT NULL,
  `Etat` varchar(30) DEFAULT NULL,
  `Officiel` tinyint(1) NOT NULL,
  `DateAdoption` date DEFAULT NULL,
  `DateAjout` date DEFAULT NULL,
  `Presentation_Cours` varchar(100) DEFAULT NULL,
  `Objectifs_Integration` varchar(100) DEFAULT NULL,
  `Evaluation_Apprentissage` varchar(100) DEFAULT NULL,
  `Enonce_Competences` varchar(100) DEFAULT NULL,
  `Objectifs_Apprentissage` varchar(100) DEFAULT NULL,
  `Manuel_Obligatoire` varchar(100) DEFAULT NULL,
  `Recommandation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`No_PlanCadre`),
  KEY `PlanCadre_Cours_FK` (`Cours_CodeCours`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=198 ;

--
-- Contenu de la table `plancadre`
--

INSERT INTO `plancadre` (`No_PlanCadre`, `Cours_CodeCours`, `Etat`, `Officiel`, `DateAdoption`, `DateAjout`, `Presentation_Cours`, `Objectifs_Integration`, `Evaluation_Apprentissage`, `Enonce_Competences`, `Objectifs_Apprentissage`, `Manuel_Obligatoire`, `Recommandation`) VALUES
(177, '420-EDA-05', 'Élaboration', 0, NULL, '2015-12-11', '../plancadre/../plancadre/3_420-EDA-05_presentation.txt', '../plancadre/../plancadre/3_420-EDA-05_integration.txt', '../plancadre/../plancadre/3_420-EDA-05_evaluation.txt', '../plancadre/../plancadre/3_420-EDA-05_competences.txt', '../plancadre/../plancadre/3_420-EDA-05_apprentissage.txt', NULL, NULL),
(178, '393-DE0-LG', 'Élaboration', 0, NULL, '2015-12-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, '202-NYA-05', 'Élaboration', 0, NULL, '2015-12-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(192, '340-101-MQ', 'Élaboration', 0, NULL, '2015-12-11', '../plancadre/../plancadre/4_340-101-MQ_presentation.txt', '../plancadre/../plancadre/4_340-101-MQ_integration.txt', '../plancadre/../plancadre/4_340-101-MQ_evaluation.txt', '../plancadre/../plancadre/4_340-101-MQ_competences.txt', '../plancadre/../plancadre/4_340-101-MQ_apprentissage.txt', NULL, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `plancadre`
--
ALTER TABLE `plancadre`
  ADD CONSTRAINT `PlanCadre_Cours_FK` FOREIGN KEY (`Cours_CodeCours`) REFERENCES `cours` (`CodeCours`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
