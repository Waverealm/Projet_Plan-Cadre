-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 11 Décembre 2015 à 02:46
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `COUNT_USER_SPECIFIC_EMAIL`(IN `PEMAIL` VARCHAR(50))
    NO SQL
BEGIN
    SELECT COUNT(*) AS nbr FROM utilisateurs WHERE Email = PEMAIL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `COUNT_USER_SPECIFIC_USERNAME`(IN `PUSERNAME` VARCHAR(20))
    NO SQL
BEGIN
    SELECT COUNT(*) AS nbr FROM utilisateurs WHERE Username = PUSERNAME;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_ASSIGNATION_PLAN_CADRE`(IN `PNOPLANCADRE` INT(11))
    NO SQL
BEGIN
	DELETE FROM elaborateurplancadre
    WHERE PlanCadre_No = PNOPLANCADRE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_OLD_VERSION_PLANCADRE`(IN `PNOPLANCADRE` INT(11))
    NO SQL
BEGIN 
    DELETE FROM plancadre
    WHERE  No_PlanCadre = PNOPLANCADRE; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_COMPETENCE`(IN `PCODECOMPETENCE` CHAR(6), IN `PNOMCOMPETENCE` VARCHAR(30), IN `PDESCRIPTIONCOMPETENCE` VARCHAR(50))
    NO SQL
BEGIN
  INSERT INTO COMPETENCE (CodeCompetence, NomCompetence,        DescriptionCompetence, DateAjout)
    VALUES (PCODECOMPETENCE, PNOMCOMPETENCE,              PDESCRIPTIONCOMPETENCE, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_CONSIGNE_PLAN_CADRE`(IN `PDescriptionConsigne` VARCHAR(30), IN `PEnonceConsigne` VARCHAR(50))
    NO SQL
BEGIN
  INSERT INTO consignesplancadre (EnonceConsigne, DescriptionConsigne) VALUES(PEnonceConsigne, DescriptionConsigne);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_COPY_PLAN_CADRE`(IN `PCODECOURS` CHAR(10), IN `PETAT` VARCHAR(30), IN `PPRENSENTATIONCOURS` VARCHAR(100), IN `POBJECTIFSINTEGRATION` VARCHAR(100), IN `PEVALUATIONAPPRENTISSAGE` VARCHAR(100), IN `PENONCECOMPETENCES` VARCHAR(100), IN `POBJECTIFSAPPRENTISSAGE` VARCHAR(100), IN `PMANUELOBLIGATOIRE` VARCHAR(100), IN `PRECOMMANDATION` VARCHAR(100))
    NO SQL
BEGIN
	INSERT INTO plancadre (Cours_CodeCours, Etat, DateAjout, Presentation_Cours, Objectifs_Integration, Evaluation_Apprentissage, Enonce_Competences, Objectifs_Apprentissage, Manuel_Obligatoire, Recommandation)
    VALUES (PCODECOURS, PETAT, CURRENT_TIMESTAMP, PPRENSENTATIONCOURS, POBJECTIFSINTEGRATION, PEVALUATIONAPPRENTISSAGE, PENONCECOMPETENCES, POBJECTIFSAPPRENTISSAGE, PMANUELOBLIGATOIRE, PRECOMMANDATION);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_COURS`(IN `PCODECOURS` CHAR(10), IN `PNOMCOURS` VARCHAR(30), IN `PTYPECOURS` VARCHAR(30), IN `PPONDERATION` VARCHAR(6), IN `PNOMBREUNITES` INT(11), IN `PNOMBREHEURES` INT(11), IN `PCODEPROGRAMME` CHAR(6))
    NO SQL
BEGIN
  INSERT INTO cours (CodeCours, NomCours, TypeCours, Ponderation, NombreUnites, NombreHeures, Programme_CodeProgramme, DateAjout)
    VALUES (PCODECOURS, PNOMCOURS, PTYPECOURS, PPONDERATION, PNOMBREUNITES, PNOMBREHEURES, PCODEPROGRAMME, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_ELABORATEUR_PLAN_CADRE`(IN `PVersion` INT(11), IN `PNoUtilisateur` INT(11))
    NO SQL
BEGIN
    INSERT INTO elaborateurplancadre (PlanCadre_No,         Utilisateurs_NoUtilisateur, DateAjout)
    VALUES (PVersion, PNoUtilisateur, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_PLAN_CADRE`(IN `PCODE` CHAR(10), IN `PETAT` VARCHAR(10))
    NO SQL
BEGIN
    INSERT INTO plancadre (Cours_CodeCours, Etat, DateAjout)
    VALUES (PCode, PEtat, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_PROGRAMME`(IN `PCODEPROGRAMME` CHAR(6), IN `PNOMPROGRAMME` VARCHAR(30), IN `PTYPEPROGRAMME` VARCHAR(30), IN `PTYPESANCTION` VARCHAR(30))
    NO SQL
BEGIN
  INSERT INTO programme (CodeProgramme, NomProgramme, TypeProgramme, TypeSanction, DateAjout)
    VALUES (PCODEPROGRAMME, PNOMPROGRAMME, PTYPEPROGRAMME, PTYPESANCTION, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_USER`(IN `PUSERNAME` VARCHAR(20), IN `PMOTDEPASSE` VARCHAR(150), IN `PEMAIL` VARCHAR(50), IN `PNOM` VARCHAR(30), IN `PPRENOM` VARCHAR(30), IN `PTYPEUTILISATEUR` VARCHAR(30), IN `PETAT` VARCHAR(20))
    NO SQL
BEGIN
  INSERT INTO utilisateurs (Username, MotDePasse, Email, Nom, Prenom, TypeUtilisateur, Etat)
    VALUES (PUSERNAME, PMOTDEPASSE, PEMAIL, PNOM, PPRENOM, PTYPEUTILISATEUR, PETAT);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT CONSIGNE_PLAN_CADRE_ID`(IN `PCodeConsigne` INT)
    NO SQL
BEGIN
  SELECT CodeConsigne, EnonceConsigne, DescriptionConsigne FROM consignesplancadre WHERE CodeConsigne = PCodeConsigne;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_CLASSES`()
    NO SQL
BEGIN
    SELECT CodeCours, NomCours, TypeCours, Programme_CodeProgramme FROM cours;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_CONSIGNES_PLAN_CADRE`()
    NO SQL
BEGIN
  SELECT CodeConsigne, TitreConsigne, EnonceConsigne, DescriptionConsigne FROM consignesplancadre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_PLANNERS`(IN `PTYPEUTILISATEUR` VARCHAR(30))
    NO SQL
BEGIN
    SELECT NoUtilisateur, Nom, Prenom, UserName, Email FROM utilisateurs WHERE TypeUtilisateur = PTYPEUTILISATEUR;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_PLAN_CADRE`()
    NO SQL
BEGIN
  SELECT No_PlanCadre, Nom, Prenom, CodeCours, NomCours, CodeProgramme, NomProgramme, plancadre.Etat, Officiel, plancadre.DateAjout, DateAdoption, Presentation_Cours, Objectifs_Integration, Evaluation_Apprentissage Enonce_Competences, Objectifs_Apprentissage, Manuel_Obligatoire, Recommandation FROM plancadre
  INNER JOIN cours ON Cours_CodeCours = CodeCours
  INNER JOIN programme ON Programme_CodeProgramme = CodeProgramme
  INNER JOIN elaborateurplancadre ON No_PlanCadre = 	PlanCadre_No
  INNER JOIN utilisateurs ON Utilisateurs_NoUtilisateur = NoUtilisateur
  ORDER BY CodeCours, plancadre.DateAjout;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_PLAN_CADRE_OFFICIEL`(IN `POFFICIEL` BOOLEAN)
    NO SQL
BEGIN
  SELECT No_PlanCadre, CodeCours, NomCours, CodeProgramme, NomProgramme, Etat, Officiel, plancadre.DateAjout, DateAdoption, Presentation_Cours, Objectifs_Integration, Evaluation_Apprentissage Enonce_Competences, Objectifs_Apprentissage, Manuel_Obligatoire, Recommandation FROM plancadre
  INNER JOIN cours ON Cours_CodeCours = CodeCours
  INNER JOIN programme on Programme_CodeProgramme = CodeProgramme
  WHERE Officiel = POFFICIEL
  ORDER BY CodeCours, plancadre.DateAjout;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_PROGRAMS`()
    NO SQL
BEGIN
  SELECT CodeProgramme FROM programme;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_PROGRAMS_WITH_NAME`()
    NO SQL
BEGIN
SELECT CodeProgramme, NomProgramme FROM Programme;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_USERS`()
    NO SQL
BEGIN
    SELECT NoUtilisateur, Nom, Prenom, UserName, Email FROM utilisateurs;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ALL_VALID_PLAN_CADRE`()
    NO SQL
BEGIN
  SELECT PlanCadre_No, CodeCours, NomCours, CodeProgramme, NomProgramme, Etat, plancadre.DateAjout, DateAdoption, Presentation_Cours, Objectifs_Integration, Evaluation_Apprentissage Enonce_Competences, Objectifs_Apprentissage, Manuel_Obligatoire, Recommandation FROM plancadre
  INNER JOIN cours ON Cours_CodeCours = CodeCours
  INNER JOIN programme on Programme_CodeProgramme = CodeProgramme
  WHERE Etat = 'Valide'
  ORDER BY CodeCours;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_DESCRIPTION_INSTRUCTION`(IN `PCODECONSIGNE` INT(11))
    NO SQL
BEGIN
	SELECT DescriptionConsigne FROM consignesplancadre
    WHERE CodeConsigne = PCODECONSIGNE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ELABORATEUR_ASSIGNATION`(IN `PCODECOURS` CHAR(10), IN `PETAT` VARCHAR(30))
    NO SQL
BEGIN
	SELECT Utilisateurs_NoUtilisateur FROM elaborateurplancadre
    WHERE PlanCadre_No = (SELECT No_PlanCadre FROM plancadre WHERE Cours_CodeCours = PCODECOURS AND Etat = PETAT);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ELABORATION_PLAN_CADRE`(IN `PUtilisateur` INT(11))
    NO SQL
BEGIN
    SELECT CodeCours, NomCours, PlanCadre_No,                 NoUtilisateur FROM utilisateurs
    INNER JOIN elaborateurplancadre
    ON NoUtilisateur = Utilisateurs_NoUtilisateur
    INNER JOIN plancadre
    ON PlanCadre_No = No_PlanCadre
    INNER JOIN cours
    ON plancadre.Cours_CodeCours = cours.CodeCours
    WHERE NoUtilisateur = PUtilisateur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PASSWORD`(IN `PUSERNAME` VARCHAR(20))
    NO SQL
BEGIN
	SELECT MotDePasse FROM utilisateurs WHERE Username = PUSERNAME;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PLAN_CADRE_ELABORATION`()
    NO SQL
BEGIN
  SELECT No_PlanCadre, CodeCours, NomCours, plancadre.Etat, Officiel, plancadre.DateAjout, DateAdoption FROM plancadre
  INNER JOIN cours ON Cours_CodeCours = CodeCours
  WHERE Etat = 'Élaboration';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PLAN_CADRE_ELABORATION_USER`(IN `PUtilisateur` INT(11))
    NO SQL
BEGIN
    SELECT CodeCours, NomCours, No_PlanCadre,                 NoUtilisateur FROM utilisateurs
    INNER JOIN elaborateurplancadre
    ON NoUtilisateur = Utilisateurs_NoUtilisateur
    INNER JOIN plancadre
    ON PlanCadre_No = No_PlanCadre
    INNER JOIN cours
    ON plancadre.Cours_CodeCours = cours.CodeCours
    WHERE NoUtilisateur = PUtilisateur
    AND plancadre.Etat = 'Élaboration';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PLAN_CADRE_ID`(IN `PNoPlanCadre` INT(11))
    NO SQL
BEGIN
SELECT CodeCours, NomCours, TypeCours, Ponderation, NombreUnites, NombreHeures, CodeProgramme, NomProgramme, No_PlanCadre FROM plancadre INNER JOIN cours ON Cours_CodeCours = CodeCours
INNER JOIN programme ON CodeProgramme = Programme_CodeProgramme
WHERE No_PlanCadre = PNoPlanCadre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PLAN_CADRE_INFOS`(IN `PNoPLAN` INT(11))
    NO SQL
BEGIN
	SELECT Etat, Presentation_Cours, Objectifs_Integration, Evaluation_Apprentissage, Enonce_Competences, Objectifs_Apprentissage, Manuel_Obligatoire, Recommandation FROM plancadre
    WHERE No_PlanCadre = PNoPLAN;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PLAN_CADRE_OFFICIAL_CLASS`(IN `PCODECOURS` CHAR(10), IN `POFFICIEL` BOOLEAN)
    NO SQL
BEGIN
	SELECT No_PlanCadre FROM plancadre
    WHERE Cours_CodeCours = PCODECOURS
    AND Officiel = POFFICIEL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PLAN_CADRE_OFFICIEL_PROGRAM`(IN `POFFICIEL` BOOLEAN, IN `PCODEPROGRAMME` CHAR(6))
    NO SQL
BEGIN
  SELECT No_PlanCadre, CodeCours, NomCours, CodeProgramme, NomProgramme, Etat, Officiel, plancadre.DateAjout, DateAdoption, Presentation_Cours, Objectifs_Integration, Evaluation_Apprentissage Enonce_Competences, Objectifs_Apprentissage, Manuel_Obligatoire, Recommandation FROM plancadre
  INNER JOIN cours ON Cours_CodeCours = CodeCours
  INNER JOIN programme on Programme_CodeProgramme = CodeProgramme
  WHERE Officiel = POFFICIEL AND Programme_CodeProgramme = PCODEPROGRAMME
  ORDER BY CodeCours, plancadre.DateAjout;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PLAN_CADRE_PROGRAM`(IN `PCODEPROGRAMME` CHAR(6))
    NO SQL
BEGIN
  SELECT No_PlanCadre, CodeCours, NomCours, CodeProgramme, NomProgramme, Etat, Officiel, plancadre.DateAjout, DateAdoption, Presentation_Cours, Objectifs_Integration, Evaluation_Apprentissage Enonce_Competences, Objectifs_Apprentissage, Manuel_Obligatoire, Recommandation FROM plancadre
  INNER JOIN cours ON Cours_CodeCours = CodeCours
  INNER JOIN programme on Programme_CodeProgramme = CodeProgramme
  WHERE Programme_CodeProgramme = PCODEPROGRAMME
  ORDER BY CodeCours, plancadre.DateAjout;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PREALABLE_COURS_ID`(IN `PCodeCours` CHAR(10))
    NO SQL
BEGIN
SELECT Cours_CodeCours, Cours_CodeCoursPrealable, NomCours FROM prealablecours INNER JOIN cours ON Cours_CodeCours = CodeCours
WHERE Cours_CodeCours = PCodeCours;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_USER`(IN `PUSERNAME` VARCHAR(30))
    NO SQL
BEGIN
  SELECT Nom, Prenom, MotDePasse, NoUtilisateur, TypeUtilisateur, Etat FROM utilisateurs WHERE Username = PUSERNAME;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_VERSION_PLAN_CADRE_BY_STATE`(IN `PCODECOURS` CHAR(10), IN `PETAT` VARCHAR(30))
    NO SQL
BEGIN
	SELECT No_PlanCadre
    FROM plancadre
    WHERE Cours_CodeCours = PCODECOURS AND Etat = PETAT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_INSTRUCTION`(IN `PCODECONSIGNE` INT(11), IN `PENONCECONSIGNE` VARCHAR(200), IN `PDESCRIPTIONCONSIGNE` VARCHAR(5000))
    NO SQL
BEGIN
    UPDATE consignesplancadre
    SET EnonceConsigne = PENONCECONSIGNE, DescriptionConsigne = PDESCRIPTIONCONSIGNE
    WHERE CodeConsigne = PCODECONSIGNE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_OFFICIAL_PLANCADRE`(IN `PNOPLANCADRE` INT(11), IN `POFFICIEL` BOOLEAN)
    NO SQL
BEGIN
	UPDATE plancadre
    SET Officiel = POFFICIEL,
    DateAdoption = CURRENT_TIMESTAMP
    WHERE No_PlanCadre = PNOPLANCADRE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_PASSWORD_USER`(IN `PNOUTILISATEUR` INT(11), IN `PMOTDEPASSE` VARCHAR(150))
    NO SQL
BEGIN
    UPDATE utilisateurs
    SET MotDePasse = PMOTDEPASSE
    WHERE NoUtilisateur = PNOUTILISATEUR;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_PLAN_CADRE_FICHIERS`(IN `Ppresentation` VARCHAR(100), IN `Pintegration` VARCHAR(100), IN `Pevaluation` VARCHAR(100), IN `Pcompetences` VARCHAR(100), IN `Pobjectifs` VARCHAR(100), IN `PNoPlanCadre` INT(11))
    NO SQL
BEGIN
UPDATE plancadre
SET Presentation_Cours = Ppresentation,
Objectifs_Integration = Pintegration,
Evaluation_Apprentissage = Pevaluation,
Enonce_Competences = Pcompetences,
Objectifs_Apprentissage = Pobjectifs
WHERE No_PlanCadre = PNoPlanCadre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_STATE_PLANCADRE`(IN `PNoPlanCadre` INT(11), IN `PETAT` VARCHAR(30))
    NO SQL
BEGIN
	UPDATE plancadre
    SET Etat = PETAT
    WHERE No_PlanCadre = PNoPlanCadre;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

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

CREATE TABLE IF NOT EXISTS `consignesplancadre` (
  `CodeConsigne` int(11) NOT NULL AUTO_INCREMENT,
  `TitreConsigne` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `EnonceConsigne` varchar(200) DEFAULT NULL,
  `DescriptionConsigne` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`CodeConsigne`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `consignesplancadre`
--

INSERT INTO `consignesplancadre` (`CodeConsigne`, `TitreConsigne`, `EnonceConsigne`, `DescriptionConsigne`) VALUES
(1, 'Présentation du cours', 'Donnez un aperçu global (description) du cours', 'Donnez un aperçu global (description) du cours: cet aperçu pourra être repris en tout ou en partie dans d’autres documents d’information. Cet aperçu pourra être utilisé par l’enseignant pour rédiger la présentation qu’il fera de son cours dans son plan de cours. S’il s’agit du plan-cadre du cours porteur de l’épreuve synthèse de programme (ESP), précisez cette information ici.\r\n'),
(2, 'Objectif d''intégration', 'Apportez ici des précisions sur la cible à atteindre au terme du cours, c’est-à-dire l’objectif d’intégration. Ce dernier découle directement de la ou des compétences développées dans le cours.', 'Apportez ici des précisions sur la cible à atteindre au terme du cours, c’est-à-dire l’objectif d’intégration. Ce dernier découle directement de la ou des compétences développées dans le cours. L’objectif d’intégration énonce, à l’aide de verbes traduisant une action mesurable, une tâche complexe qui permet d’intégrer les objectifs d’apprentissage du cours et qui conditionne la production finale d’intégration. Dans cette production finale d’intégration, l’étudiant démontre qu’il est en mesure de mobiliser, de manière autonome et efficace, ses acquis, il doit donc faire appel à ses connaissances et à ses habiletés ainsi qu’adopter les attitudes appropriées en fonction de la ou des compétences développées dans le cours.\r\nL’écriture d’un plan-cadre est un processus linéaire. Ainsi, il est probable que la rédaction de la présente rubrique et des deux subséquentes nécessite des allers-retours entre celles-ci.'),
(3, 'Évalutation des apprentissages', 'Il est essentiel de se référer à la PIEA, pour la rubrique “Évaluation des apprentissages”', 'Il est essentiel de se référer à la PIEA, pour la rubrique “Évaluation des apprentissages”, car il y a des règles à respecter en matière d’évaluation des apprentissages.\r\nPar ailleurs s’il s’agit d’un plan-cadre d’un cours porteur d’un ESP, conformément à la PIEA, il faut faire mention ici des conditions particulières de réussite liées à l’ESP. Lorsqu’il s’agit de ce cours porteur, on doit également se référer au Cadre de référence de l’épreuve-synthèse de programme.\r\n\r\nProduction finale d''intégration\r\n\r\nPrécisez ci-dessus la nature de la production finale d’intégration. Ses caractéristiques doivent permettre de s’assurer que l’étudiant a atteint l’objectif d’intégration dans le contexte d’une situation complexe et la plus authentique possible. Il ne s’agit pas nécessairement de décrire une production finale d’intégration unique, mais plutôt de définir ce qui sera acceptable comme production finale d’intégration, soit sous forme de balises, soit en fournissant une liste d’options parmi lesquelles l’enseignant doit choisir.'),
(4, 'Énoncé de la ou des compétences du devis ministéri', 'Vide', '&lt;&lt; Énoncé de compétence &gt;&gt; (code) Développement partiel intermédiaire OU développement partiel terminal OU développement complet.\r\nÉléments de compétences et critères de performance : inscrire soit (Tous les éléments et tous les critères&gt; OU indiquer les numéros des éléments de compétence et critères de performance s''appliquant au cours.');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `No_Cours` int(11) NOT NULL AUTO_INCREMENT,
  `CodeCours` char(10) NOT NULL,
  `NomCours` varchar(30) DEFAULT NULL,
  `TypeCours` varchar(30) DEFAULT NULL,
  `Ponderation` varchar(6) DEFAULT NULL,
  `NombreUnites` decimal(8,6) DEFAULT NULL,
  `NombreHeures` int(11) DEFAULT NULL,
  `Programme_CodeProgramme` char(6) NOT NULL,
  `DateAjout` date DEFAULT NULL,
  PRIMARY KEY (`No_Cours`),
  UNIQUE KEY `Unique_Cours` (`CodeCours`),
  KEY `Cours_Programme_FK` (`Programme_CodeProgramme`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`No_Cours`, `CodeCours`, `NomCours`, `TypeCours`, `Ponderation`, `NombreUnites`, `NombreHeures`, `Programme_CodeProgramme`, `DateAjout`) VALUES
(0, '340-101-MQ', 'Philosophie et rationalité', NULL, '3-1-3', '1.000000', 20, '111.GE', '2015-10-04'),
(1, '393-DE0-LG', 'Catalogage', 'cours du programme', '2-2-1', '1.333330', 30, '393.A0', NULL),
(2, '420-EDA-05', 'Notions de base en informatiqu', 'cours du programme', '2-3-1', '0.666670', 30, '393.A0', '2015-10-05'),
(3, '202-NYA-05', 'Chimie générale : la matière', 'Enseignement régulier', '3-2-3', '5.000000', 60, '200.B0', '2015-12-10'),
(4, '202-NYB-05', 'Chimie des solutions', 'Enseignement régulier', '3-2-3', '4.000000', 70, '200.B0', '2015-12-10');

-- --------------------------------------------------------

--
-- Structure de la table `elaborateurplancadre`
--

CREATE TABLE IF NOT EXISTS `elaborateurplancadre` (
  `PlanCadre_No` int(11) NOT NULL,
  `Utilisateurs_NoUtilisateur` int(11) NOT NULL,
  `DateAjout` date DEFAULT NULL,
  PRIMARY KEY (`PlanCadre_No`,`Utilisateurs_NoUtilisateur`),
  KEY `Elaborateur_Utilisateurs_FK` (`Utilisateurs_NoUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `elaborateurplancadre`
--

INSERT INTO `elaborateurplancadre` (`PlanCadre_No`, `Utilisateurs_NoUtilisateur`, `DateAjout`) VALUES
(150, 14, '2015-12-10'),
(154, 14, '2015-12-10'),
(167, 14, '2015-12-10');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=170 ;

--
-- Contenu de la table `plancadre`
--

INSERT INTO `plancadre` (`No_PlanCadre`, `Cours_CodeCours`, `Etat`, `Officiel`, `DateAdoption`, `DateAjout`, `Presentation_Cours`, `Objectifs_Integration`, `Evaluation_Apprentissage`, `Enonce_Competences`, `Objectifs_Apprentissage`, `Manuel_Obligatoire`, `Recommandation`) VALUES
(150, '420-EDA-05', 'Élaboration', 0, NULL, '2015-12-06', '../plancadre/../plancadre/3_420-EDA-05_presentation.txt', '../plancadre/../plancadre/3_420-EDA-05_integration.txt', '../plancadre/../plancadre/3_420-EDA-05_evaluation.txt', '../plancadre/../plancadre/3_420-EDA-05_competences.txt', '../plancadre/../plancadre/3_420-EDA-05_apprentissage.txt', NULL, NULL),
(154, '393-DE0-LG', 'Élaboration', 0, NULL, '2015-12-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, '340-101-MQ', 'Élaboration', 0, NULL, '2015-12-10', '../plancadre/../plancadre/4_340-101-MQ_presentation.txt', '../plancadre/../plancadre/4_340-101-MQ_integration.txt', '../plancadre/../plancadre/4_340-101-MQ_evaluation.txt', '../plancadre/../plancadre/4_340-101-MQ_competences.txt', '../plancadre/../plancadre/4_340-101-MQ_apprentissage.txt', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `prealablecours`
--

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

CREATE TABLE IF NOT EXISTS `programme` (
  `CodeProgramme` char(6) NOT NULL,
  `NomProgramme` varchar(30) DEFAULT NULL,
  `TypeProgramme` varchar(30) DEFAULT NULL,
  `TypeSanction` varchar(30) DEFAULT NULL,
  `DateAjout` date DEFAULT NULL,
  UNIQUE KEY `Unique_Programme` (`CodeProgramme`)
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

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `NoUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) DEFAULT NULL,
  `MotDePasse` varchar(150) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `TypeUtilisateur` varchar(30) DEFAULT NULL,
  `Etat` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`NoUtilisateur`),
  FULLTEXT KEY `TypeUtilisateur` (`TypeUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`NoUtilisateur`, `Username`, `MotDePasse`, `Email`, `Nom`, `Prenom`, `TypeUtilisateur`, `Etat`) VALUES
(13, 'johanne', 'sha256:1000:j29v2OplUYfCxZjyLcZmtZhy4RqMqbHh:Y7ADo/4axjbWp+0WzalcSreet/+AAtyb', 'johanne.raymond@clg.qc.ca', 'Raymond', 'Johanne', 'Conseiller pédagogique', 'Actif'),
(14, 'saliha', 'sha256:1000:04EUCMmKdiYx8NZEtddJfnUJJ6xbkCbl:9HnfNrwc4lkF7xmRRnSoGgiaWtZN7VeS', 'saliha.yacoub@clg.qc.ca', 'Yacoub', 'Saliha', 'Élaborateur', 'Actif'),
(15, 'admintest', 'sha256:1000:HdK48HvYjg5eOyob0fcHdJlwtJyhAsHJ:GS2y4wWKxJbsGRWFXR8IFPxs9izYs0O8', 'admin@gmail.com', 'Test', 'Admin', 'Administrateur', 'Actif');

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
  ADD CONSTRAINT `ElaborateurPlanCadre_PlanCadre_FK` FOREIGN KEY (`PlanCadre_No`) REFERENCES `plancadre` (`No_PlanCadre`),
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
