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

include_once('../model/queries.php');

$i = 0;
$username = null;
$oldPassword = null;
$newPassword = null;
$newPasswordConfirm = null;

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle
if(isset($_POST['$Username']) && isset($_POST['$OldPassword']) && isset($_POST['$NewPassword']) && isset($_POST['NewPasswordConfirm']))
{
    $username = $_POST['$Username'];
    $oldPassword = $_POST['$OldPassword'];
    $newPassword = $_POST['$NewPassword'];
    $newPasswordConfirm = $_POST['NewPasswordConfirm'];
}

$bdd = dbConnect();

// On vérifie si des champs sont vides
if (empty($username) || empty($oldPassword) || empty($newPassword) || empty($newPasswordConfirm))
{
    $error_fieldsempty = "Un ou plusieurs champs de texte sont vides. Veuillez les remplir.";
    $i++;
}

// S'il n'y a aucune erreur
if ($i == 0)
{
    update_Password($username,$oldPassword,$newPassword,$newPasswordConfirm);
}
else
{
    setErrors();
    header('Location: ../view/view_create_account.php');
}

?>