<?php
	
// Nom : controller_update_class.php
// Fait par Léa Kelly
// Contrôleur appelé lorsque l'utilisateur modifie un cours

  session_start();

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
  if(isset($_POST['class_list_all']) && isset($_POST['NomCours']) && isset($_POST['TypeCours']) 
    && isset($_POST['Ponderation']) && isset($_POST['NombreUnites']) && isset($_POST['NombreHeures']) 
    && isset($_POST['CodeProgramme']))
  {
    $codeCours = $_POST['class_list_all'];
    $nomCours = $_POST['NomCours'];
    $typeCours = $_POST['TypeCours'];
    $ponderation = $_POST['Ponderation'];
    $unites = $_POST['NombreUnites'];
    $heures = $_POST['NombreHeures'];
    $codeProgramme = $_POST['CodeProgramme'];
  }


   if(empty($codeProgramme))
   {
    	$error_program_code_missing = '- Veuillez sélectionner un code de programme. \n';
    	$i++;
   }


  if(isset($_POST['CodeCours']) && !empty($_POST['CodeCours']))
  {
  	$newCodeCours = $_POST['CodeCours'];

  	if (!empty(fetchClass($newCodeCours)))
	{
	  $error_class_already_exist = '- Veuillez entrez un code de cours différent. \n';
	  $i++;
	}

	// S'il n'y a aucune erreur
	if ($i == 0)
	{
	  // On va récupérer les informations du cours
	  $resut = fetchClassInfos($codeCours);

	  // On créer une "copie" du cours avec les mêmes attributs, excepté que le code sera différent
	  //...

	  $_SESSION[ 'success_update_class' ] = "Cours modifié avec succès";

	  header('Location: ../view/view_manage_class.php');
	}
	else 
	{
	  setErrors();
	  header('Location: ../view/view_manage_class.php');
	}
  }

  else
  {
  	// S'il n'y a aucune erreur
	if ($i == 0)
	{
	  updateClass($codeCours, $nomCours, $typeCours, $ponderation, $unites, $heures, $codeProgramme);
	 
	  $_SESSION[ 'success_update_class' ] = "Cours modifié avec succès";

	  header('Location: ../view/view_manage_class.php');
	}
	else 
	{
	  setErrors();
	  header('Location: ../view/view_manage_class.php');
	}
  } 

  function setErrors()
  {
    global $error_class_already_exist, $error_program_code_missing;
    $_SESSION[ 'errors_update_class' ] = 'Une ou plusieurs erreurs se sont produites : \n\n'.$error_class_already_exist.$error_program_code_missing;
  }
?>