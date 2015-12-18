<?php

session_start();

require_once('../model/queries.php');

$i = 0;
$error_fieldsempty = NULL;

$codeInstruction = null;
$newStatement = null;
$newDescription = null;

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle

// On vérifie que les variables ont bien été envoyées au serveur
if(isset($_POST["consigne_list"]) && isset($_POST['enonce']) && isset($_POST['description']))
{
    $codeInstruction = $_POST["consigne_list"];
	$newStatement = $_POST['enonce'];
	$newDescription = $_POST['description'];
}

// On vérifie si des champs sont vides
if (empty($newStatement) || empty($newDescription))
{
    $error_fieldsempty = '- Un ou plusieurs champs de texte sont vides. Veuillez les remplir. \n';
    $i++;
}

// S'il n'y a aucune erreur
if ($i == 0)
{
    updateInstruction($codeInstruction, $newStatement, $newDescription);
    header('Location: ../view/view_update_instructions.php');
}

else
{
    setErrors();
    header('Location: ../view/view_update_instructions.php');
}

function setErrors()
{
  	global $error_fieldsempty;
  	$_SESSION[ 'errors_update_instructions' ] = 'Une ou plusieurs erreurs se sont produites : \n\n'.$error_fieldsempty;
}

?>






