<?php
// Nom : controller_create_account.php
// Fait par Léa Kelly
// Controleur appelé lorsqu'un utilisateur veut créer un compte

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
$error_usernamewrongsize = NULL;
$error_fieldsempty = NULL;

$username = NULL;
$password = NULL;
$pass_confirm = NULL;
$email = NULL;
$last_name = NULL;
$first_name = NULL;
$user_type = NULL;

// isset($var) vérifie que la variable a été créé et qu'elle n'est pas nulle
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['pass_confirm']) && isset($_POST['email']) && ($_POST['last_name']) 
  && isset($_POST['first_name']) && isset($_POST['user_type']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $pass_confirm = $_POST['pass_confirm'];
  $email = $_POST['email'];
  $last_name = $_POST['last_name'];
  $first_name = $_POST['first_name'];
  $user_type = $_POST['user_type'];

  // On déclare ces variables pour les récupérer dans le formulaire de création d'un compte
  // en cas d'erreur
  $_SESSION['new_account_username'] = $username;
  $_SESSION['new_account_email'] = $email;
  $_SESSION['new_account_last_name'] = $last_name;
  $_SESSION['new_account_first_name'] = $first_name;
}

// Ces fonctions retournent la disponibilité de l'email et du nom d'utilisateur
$username_free = countUsersSpecificUsername($username);
$email_free = countUsersSpecificEmail($email);

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
  $error_emailformat = '- L\'adresse courriel n\'a pas un format valide. \n';
  $i++;
}
  
//Vérification du mot de passe
if (!empty($password) && !empty($pass_confirm) && $password != $pass_confirm)
{
  $error_passwordconfirm = '- Le mot de passe et sa confirmation sont différents. \n';
  $i++;
}

// Vérification de la taille du mot de passe
if (strlen($password) < 6 && !empty($password))
{
  $error_passwordwrongsize = '- Le mot de passe doit contenir au minimum huit caractères. \n';
  $i++;
}

// Vérification de la taille du nom d'utilisateur
if (strlen($username) < 6 && !empty($username))
{
  $error_usernamewrongsize = '- Le nom d\'utilisateur doit contenir au minimum six caractères. \n';
  $i++;
}

// On vérifie si des champs sont vides
if (empty($username) || empty($password) || empty($pass_confirm) || empty($email) || empty($last_name) || empty($first_name))
{
  $error_fieldsempty = '- Un ou plusieurs champs de texte sont vides. Veuillez les remplir. \n';
  $i++;
}


// S'il n'y a aucune erreur
if ($i == 0)
{
  // Fonction qui créé l'utilisateur dans la base de données
  createUser($username, createHash($password), $email, $last_name, $first_name, $user_type);

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

// Fonction permettant d'initialiser les erreurs dans une variable de session afin de les faire apparaître
// une fois de retour sur la vue
function setErrors()
{
  global $error_usernamefree, $error_emailfree, $error_emailformat, $error_passwordconfirm, $error_fieldsempty, $error_passwordwrongsize, $error_usernamewrongsize;
    $_SESSION[ 'errors_create_user' ] = 'Une ou plusieurs erreurs se sont produites : \n\n'.$error_usernamefree.$error_emailfree.$error_emailformat.$error_passwordconfirm.$error_fieldsempty.$error_passwordwrongsize.$error_usernamewrongsize;
}

?>