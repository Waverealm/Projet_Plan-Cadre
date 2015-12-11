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


  $codeCours = NULL;
  $nomCours = NULL;
  $typeCours = NULL;
  $ponderation = NULL;
  $unites = NULL;
  $heures = NULL;
  $progCours = NULL;

  //isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle

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
    
/*     
  // On vérifie si des champs sont vides
  if (empty($codeCours) || empty($nomCours) || empty($typeCours) || empty($ponderation) || empty($unites) || empty($heures) || empty($codeProgramme))
  {
    $error_fieldsempty = "Un ou plusieurs champs de texte sont vides. Veuillez les remplir.";
    $i++;
  }
*/
  

  // S'il n'y a aucune erreur
  if ($i === 0)
  {
    createClass($codeCours, $nomCours, $typeCours, $ponderation, $unites,  $heures, $codeProgramme);
    $_SESSION["selected_CodeCours"] = $codeCours;
    header('Location: ../view/view_create_class.php');
  }
  else 
  {
    // setErrors();
    header('Location: ../view/view_create_class.php');
  }
?>