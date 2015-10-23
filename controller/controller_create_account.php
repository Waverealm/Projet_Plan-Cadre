<?php
/**
 * Created by PhpStorm.
 * User: 201087112//AntoineLatendresse
 * Date: 2015-10-21
 * Time: 10:48
 */
session_start();


include_once('../model/queries.php');


// i est un compteur pour le nombre d'erreurs
$i = 0;
$error_emailfree = NULL;
$error_emailformat = NULL;
$error_passwordconfirm = NULL;
$error_passwordtooshort = NULL;
$error_fieldsempty = NULL;
$crypted_pass = NULL;

$userName = NULL;
$password = NULL;
$nom = NULL;
$prenom = NULL;
$passwordConfirmation = NULL;
$email = NULL;

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
  $_SESSION['username'] = $email;
  $_SESSION['email'] = $email;
  $_SESSION['last_name'] = $last_name;
  $_SESSION['first_name'] = $first_name;
}
   
$bdd = dbConnect();

// Ces fonctions retournent la disponibilité de l'email du nom d'utilisateur
$username_free = countUsersSpecificUsername($bdd, $userName);
$email_free = countUsersSpecificEmail($bdd, $email);

// Vérification de la disponibilité du nom d'utilisateur
if(!$username_free)
{
  $error_emailfree = "Ce nom d'utilisateur est d&eacutej&agrave utilisé par un autre utilisateur.";
  $i++;
}

// Vérification de la disponibilité de l'adresse email
if(!$email_free)
{
  $error_emailfree = "Cette adresse courriel est d&eacutej&agrave utilisée par un autre utilisateur.";
  $i++;
}


// Vérification du format de l'adresse email
if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) && !empty($email))
{
  $error_emailformat = "Votre adresse courriel n'a pas un format valide";
  $i++;
}
  
//Vérification du mot de passe
if ($password != $passwordConfirmation && !strcmp($password, $passwordConfirmation))
{
  $error_passwordconfirm = "Votre mot de passe et votre confirmation sont diff&eacuterents.";
  $i++;
}

if (strlen($password) < 6 && !empty($password))
{
  $error_passwordtooshort = "Votre mot de passe est trop court, il doit contenir au minimum six caractères.";
  $i++;
}

// On vérifie si des champs sont vides
if (empty($userName) || empty($password) || empty($passwordConfirmation) || empty($email)) || empty($lastName) || empty($firstName) || empty($userType))
{
  $error_fieldsempty = "Un ou plusieurs champs de texte sont vides. Veuillez les remplir.";
  $i++;
}


// S'il n'y a aucune erreur
if ($i == 0)
{
  // encryption du mot de pass pour la bd
  // doit pouvoir le décrypter aussi
  // 2 fonctions à faire
  //$crypted_pass = getCryptedPassword($pass);

  //fonction qui permet de créer l'utilisateur

  createUser($userName, $password, $nom, $prenom, $passwordConfirmation, $email);


  header('Location: ../view/view_Login.php');
}
else 
{
  setErrors();
  header('Location: ../view/view_create_account.php');
}

function setErrors()
{
  global $error_emailfree, $error_emailformat, $error_passwordconfirm, $error_fieldsempty, $error_passwordtooshort;
    $_SESSION[ 'erreurs_inscription' ] = '<h4>Une ou plusieurs erreurs se sont produites : </h4><p>'.$error_emailfree.'</p>
    <p>'.$error_emailformat.'</p><p>'.$error_passwordconfirm.'</p><p>'.$error_fieldsempty.'</p>'
    .'<p>'.$error_passwordtooshort.'</p>';
}

?>