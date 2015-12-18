<?php
/*
 *  controller_create_class.php
 *  
 *  S'occupe de la gestion de la création d'un nouveau cours
 *  et de la vérification de la validité des variables
 *
 */

  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 

  include_once('../model/queries.php');

  // i est un compteur pour le nombre d'erreur
  $i = 0;
  $error_class_already_exist = NULL;
  $error_program_code_missing = NULL;

  $codeCours = NULL;
  $nomCours = NULL;
  $typeCours = NULL;
  $ponderation = NULL;
  $unites = NULL;
  $heures = NULL;
  $progCours = NULL;

  //isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle

  // on vérifie que les variables nécessaires à la création d'un cours ont bien été
  // envoyées au serveur
  if(isset($_POST['CodeCours']) && isset($_POST['NomCours']) && isset($_POST['TypeCours']) 
    && isset($_POST['Ponderation']) && isset($_POST['NombreUnites']) && isset($_POST['NombreHeures']) 
    && isset($_POST['CodeProgramme']))
  {
    $codeCours = 	$_POST['CodeCours'];
    $nomCours = $_POST['NomCours'];
    $typeCours = $_POST['TypeCours'];
    $ponderation = $_POST['Ponderation'];
    $unites = $_POST['NombreUnites'];
    $heures = $_POST['NombreHeures'];
    $codeProgramme = $_POST['CodeProgramme'];
  }
    
  if (!empty(fetchClass($codeCours)))
  {
    $error_class_already_exist = '- Ce cours existe déjà. Veuillez rentrez un autre code. \n';
    $i++;
  }

  if(empty($codeProgramme))
  {
    $error_program_code_missing = '- Veuillez sélectionner un code de programme. \n';
    $i++;
  }
    

  // S'il n'y a aucune erreur
  if ($i == 0)
  {
    // on peut créer un nouveau cours
    createClass($codeCours, $nomCours, $typeCours, $ponderation, $unites,  $heures, $codeProgramme);
    $_SESSION["selected_CodeCours"] = $codeCours;
    // message de confirmation pour l'utilisateur
    $_SESSION[ 'success_add_class' ] = "Cours ajouté avec succès";

    header('Location: ../view/view_manage_class.php');
  }
  else 
  {
    setErrors();
    $_SESSION['CodeCours'] =  $_POST['CodeCours'];
    $_SESSION['NomCours'] = $_POST['NomCours'];
    $_SESSION['TypeCours'] = $_POST['TypeCours'];
    $_SESSION['Ponderation'] = $_POST['Ponderation'];
    $_SESSION['NombreUnites'] = $_POST['NombreUnites'];
    $_SESSION['NombreHeures'] = $_POST['NombreHeures'];
    $_SESSION['CodeProgramme'] = $_POST['CodeProgramme'];
    $_SESSION['search_program'] = $_POST['search_program'];
    

    header('Location: ../view/view_manage_class.php');
  }

  function setErrors()
  {
    global $error_class_already_exist, $error_program_code_missing;
    $_SESSION[ 'errors_add_class' ] = 'Une ou plusieurs erreurs se sont produites : \n\n'.$error_class_already_exist.$error_program_code_missing;
  }
?>