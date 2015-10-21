<?php
/**
 * Created by PhpStorm.
 * User: 201087112//AntoineLatendresse
 * Date: 2015-10-21
 * Time: 10:48
 */
// session_start() reprend une session existante si valide ou crée une nouvelle session 
session_start();


include_once('../model/queries.php');


// i est un compteur pour le nombre d'erreur
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

if(isset($_POST['UserName']) && isset($_POST['Password']) && ($_POST['Nom']) && isset($_POST['Prenom']) && isset($_POST['PasswordConfirmation']) && isset($_POST['Email']))
{
  $userName = $_POST['UserName'];
  $password = $_POST['Password'];
  $nom = $_POST['Nom'];
  $prenom = $_POST['Prenom'];
  $passwordConfirmation = $_POST['PasswordConfirmation'];
  $email = $_POST['Email'];

}
   
$bdd = dbConnect();

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
if (empty($userName) || empty($password) || empty($nom) || empty($prenom) || empty($passwordConfirmation) || empty($email))
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

  /*   
   // On s'assure de l'existence des variables du POST
  if( isset( $_POST[ 'email_usager' ] ) && isset( $_POST[ 'nom' ] ) && isset( $_POST[ 'prenom' ] ) 
  && isset( $_POST[ 'type_utilisateur' ] ) && isset( $_POST[ 'mot_de_passe' ] )
  && isset( $_POST[ 'mot_de_passe_confirmation' ]) &&  isset( $_POST[ 'num_ad_stagiaire' ] ) 
  && isset( $_POST[ 'lieu_stage_stagiaire' ] ) && isset( $_POST[ 'type_resp' ] ))
  {
        // On récupère les attributs du formulaire
         $email = $_POST['email_usager'];
         $last_name = $_POST['nom'];
         $first_name = $_POST['prenom'];
         $user_type = $_POST['type_utilisateur'];
         $pass = $_POST['mot_de_passe'];
         $pass_confirm = $_POST['mot_de_passe_confirmation'];
        
         $admission_number = $_POST[ 'num_ad_stagiaire'];
         $traineeship_place = $_POST[ 'lieu_stage_stagiaire' ];
         $resp_type = $_POST[ 'type_resp' ];

         $_SESSION['email'] = $email;
         $_SESSION['last_name'] = $last_name;
         $_SESSION['first_name'] = $first_name;
  }
  */

    //$bdd = dbConnect();

    // Cette fonction retourne si l'adresse email est disponible ou non
    //$email_free = countUsersSpecificEmail($bdd, $email);
    
    /*
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
    if ($pass != $pass_confirm)
    {
        $error_passwordconfirm = "Votre mot de passe et votre confirmation sont diff&eacuterents.";
        $i++;
    }

    if (strlen($pass) < 6 && !empty($pass))
    {
        $error_passwordtooshort = "Votre mot de passe est trop court, il doit contenir au minimum six caractères.";
        $i++;
    }

    // On vérifie si des champs sont vides
    if (empty($email) || empty($pass_confirm) || empty($pass) || empty($last_name) || empty($first_name) || $user_type == 'Default')
    {
        $error_fieldsempty = "Un ou plusieurs champs de texte sont vides. Veuillez les remplir.";
        $i++;
    }

    else if ($user_type == 'Stagiaire' && (empty($admission_number) || empty($traineeship_place)))
    {
        $error_fieldsempty = "Veuillez spécifier votre numéro d'admission ainsi que le lieu de votre stage.";
        $i++;
    }

    else if ($user_type == 'Responsable' && $resp_type == "choix1")
    {
        $error_fieldsempty = "Veuillez spécifier le type de responsable.";
        $i++;
    }
    */

/*
    // S'il n'y a aucune erreur
   if ($i == 0)
   {
      $crypted_pass = getCryptedPassword($pass);

      registerUser($bdd, $email, $last_name, $first_name, $crypted_pass, $user_type);

      if ($user_type == 'Stagiaire')
      {
          registerTrainee($bdd, $email, $admission_number);
          createTraineeship($bdd, $email, $traineeship_place);
          createJournal($bdd, 'Prive', $email);
      }

      else if ($user_type == 'Responsable')
      {
          registerResponsible($bdd, $email, $resp_type);
      }

      unset($_SESSION[ 'email' ]);
      unset($_SESSION[ 'last_name' ]);
      unset($_SESSION[ 'first_name' ]);

      $_SESSION[ "registered" ] = true;

      header('Location: ../view/index.php');

    }

    else 
    {
        setErrors();
        header('Location: ../view/registration_view.php');
    }

*/

/*
    function setErrors()
    {
      global $error_emailfree, $error_emailformat, $error_passwordconfirm, $error_fieldsempty, $error_passwordtooshort;
      $_SESSION[ 'erreurs_inscription' ] = '<h4>Une ou plusieurs erreurs se sont produites : </h4><p>'.$error_emailfree.'</p>
                                            <p>'.$error_emailformat.'</p><p>'.$error_passwordconfirm.'</p><p>'.$error_fieldsempty.'</p>'
                                            .'<p>'.$error_passwordtooshort.'</p>';
    }

    */

  ?>