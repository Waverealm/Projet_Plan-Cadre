<?php
/**
 * Created by PhpStorm.
 * User: 201087112//AntoineLatendresse
 * Date: 2015-10-21
 * Time: 10:48
 */
session_start();

header("Content-type: text/html; charset=UTF-8");
ini_set('mbstring.internal_encoding', 'UTF-8');

include_once('../model/queries.php');
include_once('password_functions.php');


// i est un compteur pour le nombre d'erreurs
$i = 0;
$error_usernamefree = NULL;
$error_emailfree = NULL;
$error_emailformat = NULL;
$error_passwordconfirm = NULL;
$error_passwordwrongsize = NULL;
// $error_usernamewrongsize = NULL;
$error_fieldsempty = NULL;
// $crypted_pass = NULL;

$userName = NULL;
$password = NULL;
$passwordConfirmation = NULL;
$email = NULL;
$lastName = NULL;
$firstName = NULL;
$userType = NULL;

//isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle
if(isset($_POST['UserName']) && isset($_POST['Password']) && isset($_POST['PasswordConfirmation']) && isset($_POST['Email']) && ($_POST['LastName']) 
  && isset($_POST['FirstName']) && isset($_POST['UserType']))
{
  $userName = $_POST['UserName'];
  $password = $_POST['Password'];
  $passwordConfirmation = $_POST['PasswordConfirmation'];
  $email = $_POST['Email'];
  $lastName = $_POST['LastName'];
  $firstName = $_POST['FirstName'];
  $userType = $_POST['UserType'];

  // On déclare ces variables pour les récupérer dans le formulaire d'inscription en cas d'erreurs.
  $_SESSION['new_account_username'] = $userName;
  $_SESSION['new_account_email'] = $email;
  $_SESSION['new_account_last_name'] = $lastName;
  $_SESSION['new_account_first_name'] = $firstName;
}
   
$bdd = dbConnect();

// Ces fonctions retournent la disponibilité de l'email et du nom d'utilisateur
$username_free = countUsersSpecificUsername($bdd, $userName);
$email_free = countUsersSpecificEmail($bdd, $email);

// Vérification de la disponibilité du nom d'utilisateur
if(!$username_free)
{
  $error_usernamefree = '- Ce nom d\'utilisateur est déjà utilisé par un autre utilisateur. \n';
  $i++;
}

// Vérification de la disponibilité de l'adresse email
if(!$email_free)
{
  $error_emailfree = '- Cette adresse courriel est déjà utilisée par un autre utilisateur. \n';
  $i++;
}


// Vérification du format de l'adresse email
if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) && !empty($email))
{
  $error_emailformat = '- Votre adresse courriel n\'a pas un format valide. \n';
  $i++;
}
  
//Vérification du mot de passe
if (!empty($password) && !empty($passwordConfirmation) && $password != $passwordConfirmation)
{
  $error_passwordconfirm = '- Votre mot de passe et votre confirmation sont difféterents. \n';
  $i++;
}

if (strlen($password) < 6 && !empty($password))
{
  $error_passwordwrongsize = '- Votre mot de passe doit contenir au minimum huit caractères. \n';
  $i++;
}


if (strlen($userName) < 6 && !empty($userName))
{
  $error_usernamewrongsize = '- Votre nom d\'utilisateur doit contenir au minimum six caractères. \n';
  $i++;
}

// On vérifie si des champs sont vides
if (empty($userName) || empty($password) || empty($passwordConfirmation) || empty($email) || empty($lastName) || empty($firstName))
{
  $error_fieldsempty = '- Un ou plusieurs champs de texte sont vides. Veuillez les remplir. \n';
  $i++;
}


// S'il n'y a aucune erreur
if ($i == 0)
{
  // encryption du mot de pass pour la bd
  // doit pouvoir le décrypter aussi
  // 2 fonctions à faire
  //$crypted_pass = getCryptedPassword($pass);

  // Fonction qui permet de créer l'utilisateur
  createUser($bdd, $userName, createHash($password), $email, $lastName, $firstName, $userType);

  // Si on s'est bien inscrit, alors on peut supprimer ces variables de session
  unset($_SESSION['new_account_username']);
  unset($_SESSION['new_account_email']);
  unset($_SESSION['new_account_last_name']);
  unset($_SESSION['new_account_first_name']);

  $_SESSION[ "new_account_success" ] = true;

  header('Location: ../view/view_Login.php');
}
else 
{
  setErrors();
  header('Location: ../view/view_create_account.php');
}

function setErrors()
{
  global $error_usernamefree, $error_emailfree, $error_emailformat, $error_passwordconfirm, $error_fieldsempty, $error_passwordwrongsize, $error_usernamewrongsize;
    $_SESSION[ 'errors_create_user' ] = 'Une ou plusieurs erreurs se sont produites : \n\n'.$error_usernamefree.$error_emailfree.$error_emailformat.$error_passwordconfirm.$error_fieldsempty.$error_passwordwrongsize.$error_usernamewrongsize;
}

?>