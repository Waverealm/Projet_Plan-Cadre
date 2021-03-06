<?php
  /**
   * Created by PhpStorm.
   * User: 201087112//AntoineLatendresse
   * Date: 2015-10-21
   * Time: 10:48
   */
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 

  include_once('../model/queries.php');

  // i est un compteur pour le nombre d'erreur
  $i = 0;
  $error_program_already_exist = NULL;


  $codeProgramme = NULL;
  $nomProgramme = NULL;
  $typeProgramme = NULL;
  $typeSanction = NULL;

  //isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle

  // on vérifie que les variables ont bien été envoyées au serveur
  if( isset($_POST['CodeProgramme']) && isset($_POST['NomProgramme']) && isset($_POST['TypeProgramme']) )
  {
    $codeProgramme = 	$_POST['CodeProgramme'];
    $nomProgramme = $_POST['NomProgramme'];
    $typeProgramme = $_POST['TypeProgramme'];
    //$typeSanction = $_POST['TypeSanction'];
  }

  if (!empty(fetchProgram($codeProgramme)))
  {
    $error_program_already_exist = '- Ce programme existe déjà. Veuillez rentrez un autre code. \n';
    $i++;
  }

  // On vérifie si des champs sont vides
  if ( empty($codeProgramme) || empty($nomProgramme) || empty($typeProgramme) )
  {
    $error_fieldsempty = "Un ou plusieurs champs de texte sont vides. Veuillez les remplir.";
    $i++;
  }

  // S'il n'y a aucune erreur
  if ($i == 0)
  {
    switch($typeProgramme)
    {
        case "Technique":
        case "Pré-universitaire":
            $typeSanction = "Diplôme d'études collégiales";
            break;
        case "Attestation d'études collégiales":
            $typeSanction = "Attestation d'études collégiales";
            break;
        default:
            $typeSanction = "Attestation d'études collégiales";
    }
    
    createProgram($codeProgramme, $nomProgramme, $typeProgramme, $typeSanction);
    $_SESSION["selected_CodeProgramme"] = $codeProgramme;

    $_SESSION[ 'success_add_program' ] = "Programme ajouté avec succès";

    header('Location: ../view/view_create_program.php');
  }
  else 
  {
    setErrors();

    $_SESSION['CodeProgramme'] =  $_POST['CodeProgramme'];
    $_SESSION['NomProgramme'] = $_POST['NomProgramme'];
    $_SESSION['TypeProgramme'] = $_POST['TypeProgramme'];
    $_SESSION['TypeSanction'] = $_POST['TypeSanction'];

    header('Location: ../view/view_create_program.php');
  }

  function setErrors()
  {
    global $error_program_already_exist;
    $_SESSION[ 'errors_add_program' ] = 'Une ou plusieurs erreurs se sont produites : \n\n'.$error_program_already_exist;
  }
?>