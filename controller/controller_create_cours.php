<?php

session_start();

include_once('../model/queries.php');

// i est un compteur pour le nombre d'erreur
$i = 0;


$codeCours = 101;
$nomCours = NULL;
$typeCours = NULL;
$ponderation = NULL;
$unites = NULL;
$heures = NULL;
$progCours = 101;
$dateAjout = NULL;

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle

if(isset($_POST['CodeCours']) && isset($_POST['NomCours']) && isset($_POST['TypeCours']) && isset($_POST['Ponderation']) && isset($_POST['NombreUnites']) && isset($_POST['NombreHeures']) && isset($_POST['Programme_CodeProgramme']) && isset($_POST['DateAjout']))
{
  $codeCours = 	$_POST['CodeCours'];
  $nomCours = $_POST['NomCours'];
  $typeCours = $_POST['TypeCours'];
  $ponderation = $_POST['Ponderation'];
  $unites = $_POST['NombreUnites'];
  $heures = $_POST['NombreHeures'];
  $progCours = $_POST['Programme_CodeProgramme'];
  $dateAjout = $_POST['DateAjout'];
}
   
// On vérifie si des champs sont vides
if (empty($codeCours) || empty($nomCours) || empty($typeCours) || empty($ponderation) || empty($unites) || empty($heures) || empty($progCours) || empty($dateAjout))
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

  createCours($codeCours, $nomCours, $typeCours, $ponderation, $unites,  $heures, $progCours, $dateAjout);


  header('Location: ../view/view_Login.php');
}
else 
{
  setErrors();
  header('Location: ../view/view_create_account.php');
}
?>