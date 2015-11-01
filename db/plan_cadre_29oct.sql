-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 29 Octobre 2015 à 19:16
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

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `COUNT_USER_SPECIFIC_EMAIL`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `COUNT_USER_SPECIFIC_EMAIL`(IN `PEMAIL` VARCHAR(50))
    NO SQL
BEGIN
    SELECT COUNT(*) AS nbr FROM utilisateurs WHERE Email = PEMAIL;
END$$

DROP PROCEDURE IF EXISTS `COUNT_USER_SPECIFIC_USERNAME`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `COUNT_USER_SPECIFIC_USERNAME`(IN `PUSERNAME` VARCHAR(20))
    NO SQL
BEGIN
    SELECT COUNT(*) AS nbr FROM utilisateurs WHERE Username = PUSERNAME;
END$$

DROP PROCEDURE IF EXISTS `INSERT_COMPETENCE`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_COMPETENCE`(IN `PCODECOMPETENCE` CHAR(6), IN `PNOMCOMPETENCE` VARCHAR(30), IN `PDESCRIPTIONCOMPETENCE` VARCHAR(50), IN `PDATEAJOUT` DATE)
    NO SQL
BEGIN
	INSERT INTO COMPETENCE (CodeCompetence, NomCompetence, 				DescriptionCompetence, DateAjout)
    VALUES (PCODECOMPETENCE, PNOMCOMPETENCE, 							PDESCRIPTIONCOMPETENCE, PDATEAJOUT);
END$$

DROP PROCEDURE IF EXISTS `INSERT_COURS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_COURS`(IN `PCODECOURS` CHAR(10), IN `PNOMCOURS` VARCHAR(30), IN `PTYPECOURS` VARCHAR(30), IN `PPONDERATION` VARCHAR(6), IN `PNOMBREUNITES` INT(11), IN `PNOMBREHEURES` INT(11), IN `PCODEPROGRAMME` CHAR(6), IN `PDATEAJOUT` DATE)
    NO SQL
BEGIN
	INSERT INTO cours (CodeCours, NomCours, TypeCours, Ponderation, NombreUnites, NombreHeures, Programme_CodeProgramme, DateAjout)
    VALUES (PCODECOURS, PNOMCOURS, PTYPECOURS, PPONDERATION, PNOMBREUNITES, PNOMBREHEURES, PCODEPROGRAMME, PDATEAJOUT);
END$$

DROP PROCEDURE IF EXISTS `INSERT_ELABORATEUR_PLAN_CADRE`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_ELABORATEUR_PLAN_CADRE`(IN `PVersion` INT(11), IN `PNoUtilisateur` INT(11))
    NO SQL
BEGIN
    INSERT INTO elaborateurplancadre (PlanCadre_VersionPlan,         Utilisateurs_NoUtilisateur, DateAjout)
    VALUES (PVersion, PNoUtilisateur, CURRENT_TIMESTAMP);
END$$

DROP PROCEDURE IF EXISTS `INSERT_PLAN_CADRE`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_PLAN_CADRE`(IN `PCODE` CHAR(10), IN `PETAT` VARCHAR(10))
    NO SQL
BEGIN
    INSERT INTO plancadre (Cours_CodeCours, Etat, DateAjout)
    VALUES (PCode, PEtat, CURRENT_TIMESTAMP);
END$$

DROP PROCEDURE IF EXISTS `INSERT_PROGRAMME`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_PROGRAMME`(IN `PCODEPROGRAMME` CHAR(6), IN `PNOMPROGRAMME` VARCHAR(30), IN `PTYPEPROGRAMME` VARCHAR(30), IN `PTYPESANCTION` VARCHAR(30), IN `PDATEAJOUT` DATE)
    NO SQL
BEGIN
	INSERT INTO programme (CodeProgramme, NomProgramme, TypeProgramme, TypeSanction, DateAjout)
    VALUES (PCODEPROGRAMME, PNOMPROGRAMME, PTYPEPROGRAMME, PTYPESANCTION, PDATEAJOUT);
END$$

DROP PROCEDURE IF EXISTS `INSERT_USER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_USER`(IN `PUSERNAME` VARCHAR(20), IN `PMOTDEPASSE` VARCHAR(20), IN `PEMAIL` VARCHAR(50), IN `PNOM` VARCHAR(30), IN `PPRENOM` VARCHAR(30), IN `PTYPEUTILISATEUR` VARCHAR(30), IN `PETAT` VARCHAR(20))
    NO SQL
BEGIN
	INSERT INTO utilisateurs (Username, MotDePasse, Email, Nom, Prenom, TypeUtilisateur, Etat)
    VALUES (PUSERNAME, PMOTDEPASSE, PEMAIL, PNOM, PPRENOM, PTYPEUTILISATEUR, PETAT);
END$$

DROP PROCEDURE IF EXISTS `SELECT_ALL_CLASSES`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_CLASSES`()
    NO SQL
BEGIN
    SELECT CodeCours, NomCours, TypeCours, Programme_CodeProgramme FROM cours;
END$$

DROP PROCEDURE IF EXISTS `SELECT_ALL_PROGRAMS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_PROGRAMS`()
    NO SQL
BEGIN
	SELECT CodeProgramme FROM programme;
END$$

DROP PROCEDURE IF EXISTS `SELECT_ALL_USERS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_USERS`()
    NO SQL
BEGIN
    SELECT NoUtilisateur, Nom, Prenom, UserName, Email FROM utilisateurs;
END$$

DROP PROCEDURE IF EXISTS `SELECT_ELABORATION_PLAN_CADRE`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ELABORATION_PLAN_CADRE`(IN `PUtilisateur` INT(11))
    NO SQL
BEGIN
    SELECT CodeCours, NomCours, PlanCadre_VersionPlan,                 NoUtilisateur FROM utilisateurs
    INNER JOIN elaborateurplancadre
    ON NoUtilisateur = Utilisateurs_NoUtilisateur
    INNER JOIN plancadre
    ON PlanCadre_VersionPlan = VersionPlan
    INNER JOIN cours
    ON plancadre.Cours_CodeCours = cours.CodeCours
    WHERE NoUtilisateur = PUtilisateur;
END$$

DROP PROCEDURE IF EXISTS `SELECT_USER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_USER`(IN `PUSERNAME` VARCHAR(30))
    NO SQL
BEGIN
	SELECT Nom, Prenom, MotDePasse, NoUtilisateur, TypeUtilisateur, Etat FROM utilisateurs WHERE Username = PUSERNAME;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `CodeCompetence` char(6) NOT NULL,
  `NomCompetence` varchar(30) DEFAULT NULL,
  `DescriptionCompetence` varchar(50) DEFAULT NULL,
  `DateAjout` date DEFAULT NULL,
  PRIMARY KEY (`CodeCompetence`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `competencecours`
--

DROP TABLE IF EXISTS `competencecours`;
CREATE TABLE IF NOT EXISTS `competencecours` (
  `NiveauDeveloppement` varchar(20) DEFAULT NULL,
  `Cours_CodeCours` char(10) NOT NULL,
  `Competence_CodeCompetence` char(6) NOT NULL,
  KEY `CompetenceCours_Competence_FK` (`Competence_CodeCompetence`),
  KEY `CompetenceCours_Cours_FK` (`Cours_CodeCours`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `consignesplancadre`
--

DROP TABLE IF EXISTS `consignesplancadre`;
CREATE TABLE IF NOT EXISTS `consignesplancadre` (
  `CodeConsigne` int(11) NOT NULL AUTO_INCREMENT,
  `DescriptionConsigne` varchar(50) DEFAULT NULL,
  `CourteDescription` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`CodeConsigne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `CodeCours` char(10) NOT NULL,
  `NomCours` varchar(30) DEFAULT NULL,
  `TypeCours` varchar(30) DEFAULT NULL,
  `Ponderation` varchar(6) DEFAULT NULL,
  `NombreUnites` int(11) DEFAULT NULL,
  `NombreHeures` int(11) DEFAULT NULL,
  `Programme_CodeProgramme` char(6) NOT NULL,
  `DateAjout` date DEFAULT NULL,
  PRIMARY KEY (`CodeCours`),
  KEY `Cours_Programme_FK` (`Programme_CodeProgramme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`CodeCours`, `NomCours`, `TypeCours`, `Ponderation`, `NombreUnites`, `NombreHeures`, `Programme_CodeProgramme`, `DateAjout`) VALUES
('340-101-MQ', 'Philosophie et rationalité', NULL, '3-1-3', 20, 20, '111.GE', '2015-10-04'),
('393-DE0-LG', 'Catalogage', 'cours du programme', '2-2-1', NULL, 30, '393.A0', NULL),
('420-EDA-05', 'Notions de base en informatiqu', 'cours du programme', '2-3-1', 10, 30, '393.A0', '2015-10-05');

-- --------------------------------------------------------

--
-- Structure de la table `elaborateurplancadre`
--

DROP TABLE IF EXISTS `elaborateurplancadre`;
CREATE TABLE IF NOT EXISTS `elaborateurplancadre` (
  `PlanCadre_VersionPlan` int(11) NOT NULL,
  `Utilisateurs_NoUtilisateur` int(11) NOT NULL,
  `DateAjout` date DEFAULT NULL,
  PRIMARY KEY (`PlanCadre_VersionPlan`,`Utilisateurs_NoUtilisateur`),
  KEY `Elaborateur_Utilisateurs_FK` (`Utilisateurs_NoUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `elaborateurplancadre`
--

INSERT INTO `elaborateurplancadre` (`PlanCadre_VersionPlan`, `Utilisateurs_NoUtilisateur`, `DateAjout`) VALUES
(1, 1, '2015-10-27');

-- --------------------------------------------------------

--
-- Structure de la table `plancadre`
--

DROP TABLE IF EXISTS `plancadre`;
CREATE TABLE IF NOT EXISTS `plancadre` (
  `VersionPlan` int(11) NOT NULL AUTO_INCREMENT,
  `Cours_CodeCours` char(10) NOT NULL,
  `Etat` varchar(10) DEFAULT NULL,
  `DateAdoption` date DEFAULT NULL,
  `DateAjout` date DEFAULT NULL,
  `Prensation_Cours` varchar(100) DEFAULT NULL,
  `Objectifs_Integration` varchar(100) DEFAULT NULL,
  `Evalutation_Apprentissage` varchar(100) DEFAULT NULL,
  `Enonce_Competences` varchar(100) DEFAULT NULL,
  `Objectifs_Apprentissage` varchar(100) DEFAULT NULL,
  `Manuel_Obligatoire` varchar(100) DEFAULT NULL,
  `Recommandation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`VersionPlan`),
  KEY `PlanCadre_Cours_FK` (`Cours_CodeCours`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `plancadre`
--

INSERT INTO `plancadre` (`VersionPlan`, `Cours_CodeCours`, `Etat`, `DateAdoption`, `DateAjout`, `Prensation_Cours`, `Objectifs_Integration`, `Evalutation_Apprentissage`, `Enonce_Competences`, `Objectifs_Apprentissage`, `Manuel_Obligatoire`, `Recommandation`) VALUES
(1, '340-101-MQ', 'elaboratio', NULL, '2015-10-27', NULL, NULL, NULL, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `prealablecours`
--

DROP TABLE IF EXISTS `prealablecours`;
CREATE TABLE IF NOT EXISTS `prealablecours` (
  `Cours_CodeCours` char(10) NOT NULL,
  `Cours_CodeCoursPrealable` char(10) NOT NULL,
  PRIMARY KEY (`Cours_CodeCours`),
  UNIQUE KEY `SECOND` (`Cours_CodeCoursPrealable`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

DROP TABLE IF EXISTS `programme`;
CREATE TABLE IF NOT EXISTS `programme` (
  `CodeProgramme` char(6) NOT NULL,
  `NomProgramme` varchar(30) DEFAULT NULL,
  `TypeProgramme` varchar(30) DEFAULT NULL,
  `TypeSanction` varchar(30) DEFAULT NULL,
  `DateAjout` date DEFAULT NULL,
  PRIMARY KEY (`CodeProgramme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `programme`
--

INSERT INTO `programme` (`CodeProgramme`, `NomProgramme`, `TypeProgramme`, `TypeSanction`, `DateAjout`) VALUES
('111.GE', 'Cours de la formation générale', 'aucun', NULL, '2015-10-01'),
('180.A0', 'Soins infirmiers', 'technique', NULL, '2015-10-19'),
('200.B0', 'Sciences de la nature', 'preuniversitaire', NULL, '2015-10-19'),
('393.A0', 'Techniques de la documentation', 'technique', NULL, '2015-10-15');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `NoUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) DEFAULT NULL,
  `MotDePasse` varchar(20) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `TypeUtilisateur` varchar(30) DEFAULT NULL,
  `Etat` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`NoUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`NoUtilisateur`, `Username`, `MotDePasse`, `Email`, `Nom`, `Prenom`, `TypeUtilisateur`, `Etat`) VALUES
(1, 'test', 'test', '', 'Tanguay', 'Gounter', NULL, NULL),
(7, 'lea', 'pouchi56', 'kelly.lea56@gmail.com', 'Kelly', 'Léa', 'Conseiller pédagogique', 'Actif'),
(8, 'admintest', 'test', 'test@gmail.com', 'Yacoub', 'Saliha', 'Administrateur', 'Actif'),
(9, 'elabo', '123456', 'elabo@gmail.com', 'Roy', 'Patrice', 'Élaborateur', 'Actif');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `competencecours`
--
ALTER TABLE `competencecours`
  ADD CONSTRAINT `CompetenceCours_Competence_FK` FOREIGN KEY (`Competence_CodeCompetence`) REFERENCES `competence` (`CodeCompetence`),
  ADD CONSTRAINT `CompetenceCours_Cours_FK` FOREIGN KEY (`Cours_CodeCours`) REFERENCES `cours` (`CodeCours`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`Programme_CodeProgramme`) REFERENCES `programme` (`CodeProgramme`),
  ADD CONSTRAINT `Cours_Programme_FK` FOREIGN KEY (`Programme_CodeProgramme`) REFERENCES `programme` (`CodeProgramme`);

--
-- Contraintes pour la table `elaborateurplancadre`
--
ALTER TABLE `elaborateurplancadre`
  ADD CONSTRAINT `ElaborateurPlanCadre_PlanCadre_FK` FOREIGN KEY (`PlanCadre_VersionPlan`) REFERENCES `plancadre` (`VersionPlan`),
  ADD CONSTRAINT `ElaborateurPlanCadre_Utilisateurs_FK` FOREIGN KEY (`Utilisateurs_NoUtilisateur`) REFERENCES `utilisateurs` (`NoUtilisateur`);

--
-- Contraintes pour la table `plancadre`
--
ALTER TABLE `plancadre`
  ADD CONSTRAINT `PlanCadre_Cours_FK` FOREIGN KEY (`Cours_CodeCours`) REFERENCES `cours` (`CodeCours`);

--
-- Contraintes pour la table `prealablecours`
--
ALTER TABLE `prealablecours`
  ADD CONSTRAINT `Prealable_CodeCours` FOREIGN KEY (`Cours_CodeCours`) REFERENCES `cours` (`CodeCours`),
  ADD CONSTRAINT `Prealable_CodeCoursPrealable` FOREIGN KEY (`Cours_CodeCoursPrealable`) REFERENCES `cours` (`CodeCours`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
