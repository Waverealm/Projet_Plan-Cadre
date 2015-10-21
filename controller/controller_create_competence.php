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


$codeCompetence = 102;
$nomCompetence = NULL;
$descriptionCompetence = NULL;
$dateAjoutCompetence = NULL;

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle

if(isset($_POST['CodeCompetence']) && isset($_POST['NomCompetence']) && isset($_POST['DescriptionCompetence']) && isset($_POST['DateAjoutCompetence']))
{
  $codeCompentence = 	$_POST['CodeCompetence'];
  $nomCompetence = $_POST['NomCompetence'];
  $descriptionCompetence = $_POST['DescriptionCompetence'];
  $dateAjoutCompetence = $_POST['DateAjoutCompetence'];
}

// On vérifie si des champs sont vides
if (empty($codeCompetence) || empty($nomCompetence) || empty($descriptionCompetence) || empty($dateAjoutCompetence))
{
  $error_fieldsempty = "Un ou plusieurs champs de texte sont vides. Veuillez les remplir.";
  $i++;
}
   
$bdd = dbConnect();

// S'il n'y a aucune erreur
if ($i == 0)
{
  // encryption du mot de pass pour la bd
  // doit pouvoir le décrypter aussi
  // 2 fonctions à faire
  //$crypted_pass = getCryptedPassword($pass);

  //fonction qui permet de créer l'utilisateur

  createCompetence($codeCompetence, $nomCompetence, $descriptionCompetence, $dateAjoutCompetence);


  header('Location: ../view/view_Login.php');
}
else 
{
  //setErrors();
  header('Location: ../view/view_create_account.php');
}
?>