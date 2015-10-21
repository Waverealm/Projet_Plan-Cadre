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
$dateAjoutProgramme = NULL;

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle

if(isset($_POST['CodeProgramme']) && isset($_POST['NomProgramme']) && isset($_POST['TypeProgramme']) && isset($_POST['TypeSanction']) && isset($_POST['DateAjout']))
{
  $codeProgramme = 	$_POST['CodeProgramme'];
  $nomProgramme = $_POST['NomProgramme'];
  $typeProgramme = $_POST['TypeProgramme'];
  $typeSanction = $_POST['TypeSanction'];
  $dateAjoutProgramme = $_POST['DateAjout'];
}

// On vérifie si des champs sont vides
if (empty($codeProgramme) || empty($nomProgramme) || empty($typeProgramme) || empty($typeSanction) || empty($dateAjoutProgramme))
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

  createProgramme($codeProgramme, $nomProgramme, $typeProgramme, $typeSanction, $dateAjoutProgramme);


  header('Location: ../view/view_Login.php');
}
else 
{
  setErrors();
  header('Location: ../view/view_create_account.php');
}
?>