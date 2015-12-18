<?php
  /**
   *
   *non inclu et non fonctionnel pour ce projet
   *
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


  $codeCompetence = NULL;
  $nomCompetence = NULL;
  $descriptionCompetence = NULL;
  $dateAjoutCompetence = date('Y-m-d');

  //isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle
  if(isset($_POST['CodeCompetence']) && isset($_POST['NomCompetence']) && isset($_POST['DescriptionCompetence']))
  {
    $codeCompetence = 	$_POST['CodeCompetence'];
    $nomCompetence = $_POST['NomCompetence'];
    $descriptionCompetence = $_POST['DescriptionCompetence'];
  }

  // On vérifie si des champs sont vides
  if (empty($codeCompetence) || empty($nomCompetence) || empty($descriptionCompetence))
  {
    $error_fieldsempty = "Un ou plusieurs champs de texte sont vides. Veuillez les remplir.";
    $i++;
  }
     
  $bdd = dbConnect();

  // S'il n'y a aucune erreur
  if ($i == 0)
  {
    createCompetence($bdd, $codeCompetence, $nomCompetence, $descriptionCompetence, $dateAjoutCompetence);


    header('Location: ../view/view_index.php');
  }
  else 
  {
    //setErrors();
    header('Location: ../view/view_add_competence.php');
  }
?>