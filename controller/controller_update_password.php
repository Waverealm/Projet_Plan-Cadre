<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-03
 * Time: 12:38
 */
session_start();

header("Content-type: text/html; charset=UTF-8");
ini_set('mbstring.internal_encoding', 'UTF-8');

require_once('../model/queries.php');
require_once('password_functions.php');

$i = 0;
$error_fieldsempty = NULL;
$error_passwordconfirm = NULL;
$error_passwordwrongsize = NULL;

$noUser = null;
$newPassword = null;
$newPasswordConfirm = null;

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle
if(isset($_POST["user_list_all"]) && isset($_POST['NewPassword']) && isset($_POST['NewPasswordConfirm']))
{
    $noUser = $_POST["user_list_all"];
    $newPassword = $_POST['NewPassword'];
    $newPasswordConfirm = $_POST['NewPasswordConfirm'];
}

// On vérifie si des champs sont vides
if (empty($newPassword) || empty($newPasswordConfirm))
{
    $error_fieldsempty = '- Un ou plusieurs champs de texte sont vides. Veuillez les remplir. \n';
    $i++;
}

if($newPassword != $newPasswordConfirm)
{
    $error_passwordconfirm = '- Le mot de passe et sa confirmation sont différents. \n';
    $i++;
}

if (strlen($newPassword) < 6 && !empty($newPassword))
{
  $error_passwordwrongsize = '- Votre mot de passe doit contenir au minimum huit caractères. \n';
  $i++;
}

// S'il n'y a aucune erreur
if ($i == 0)
{
    updatePassword($noUser, createHash($newPassword));
    header('Location: ../view/view_index.php');

    $_SESSION[ 'success_update_password' ] = "Mot de passe modifié avec succès";
}

else
{
    setErrors();
    header('Location: ../view/view_update_password.php');
}

function setErrors()
{
  global $error_passwordconfirm, $error_fieldsempty, $error_passwordwrongsize;
    $_SESSION[ 'errors_update_password' ] = 'Une ou plusieurs erreurs se sont produites : \n\n'.$error_passwordconfirm.$error_fieldsempty.$error_passwordwrongsize;
}

?>