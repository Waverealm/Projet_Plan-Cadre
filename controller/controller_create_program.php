<?php
  /**
   * Created by PhpStorm.
   * User: 201087112//AntoineLatendresse
   * Date: 2015-10-21
   * Time: 10:48
   */
  session_start();

  include_once('../model/queries.php');

  // i est un compteur pour le nombre d'erreur
  $i = 0;


  $codeProgramme = NULL;
  $nomProgramme = NULL;
  $typeProgramme = NULL;
  $typeSanction = NULL;
  $dateAjoutProgramme = date('Y-m-d');

  //isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle

  if(isset($_POST['CodeProgramme']) && isset($_POST['NomProgramme']) && isset($_POST['TypeProgramme']) && isset($_POST['TypeSanction']))
  {
    $codeProgramme = 	$_POST['CodeProgramme'];
    $nomProgramme = $_POST['NomProgramme'];
    $typeProgramme = $_POST['TypeProgramme'];
    $typeSanction = $_POST['TypeSanction'];
  }

  // On vérifie si des champs sont vides
  if (empty($codeProgramme) || empty($nomProgramme) || empty($typeProgramme) || empty($typeSanction))
  {
    $error_fieldsempty = "Un ou plusieurs champs de texte sont vides. Veuillez les remplir.";
    $i++;
  }

  // S'il n'y a aucune erreur
  if ($i == 0)
  {

    createProgram($codeProgramme, $nomProgramme, $typeProgramme, $typeSanction);
    $_SESSION["selected_CodeProgramme"] = $codeProgramme;

    header('Location: ../view/view_create_program.php');
  }
  else 
  {
    // setErrors();
    header('Location: ../view/view_create_program.php');
  }


?>