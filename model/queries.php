<?php

  function dbConnect() 
  {

     try
     {
       return new PDO('mysql:host=localhost;dbname=plan_cadre', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
       mysql_set_charset("utf8", PDO);
     }
     catch (Exception $e)
     {
      die('Erreur : ' . $e->getMessage());
     }
  }

  function getUser($bdd, $username)
  {
      $query = $bdd->prepare("CALL SELECT_USER(?)");
 
      $query->bindParam(1, $username, PDO::PARAM_STR);

      $query->execute();
      $result = $query->fetchAll();

      $query->closeCursor();
 
      return $result;
  }


  // Compte le nombre d'utilisateurs avec le nom d'utilisateur envoyé. Le résultait devrait toujours être 0 ou 1
  // 0 pour nom d'utilisateur disponible
  // 1 pour nom d'utilisateur déjà utilisé
  function countUsersSpecificUsername ($bdd, $username)
  {

      $query = $bdd->prepare("CALL COUNT_USER_SPECIFIC_USERNAME(?)");

      $query->bindParam(1, $username, PDO::PARAM_STR);

      $query->execute();
      $username_free = ($query->fetchColumn()==0)?1:0;

      $query->closeCursor();

      return $username_free;
  }

  // Compte le nombre d'utilisateurs avec l'adresse courriel envoyée. Le résultait devrait toujours être 0 ou 1
  // 0 pour adresse email disponible
  // 1 pour adresse email déjà utilisée
  function countUsersSpecificEmail ($bdd, $email)
  {

      $query = $bdd->prepare("CALL COUNT_USER_SPECIFIC_EMAIL(?)");

      $query->bindParam(1, $email, PDO::PARAM_STR);

      $query->execute();
      $email_free = ($query->fetchColumn()==0)?1:0;

      $query->closeCursor();

      return $email_free;
  }


  function createUser($bdd, $userName, $pass, $email, $lastName, $firstName, $userType)
  {
      $state = "Actif";
      $query = dbConnect()->prepare("CALL INSERT_USER(?,?,?,?,?,?,?)");

      $query->bindParam(1, $userName, PDO::PARAM_STR);
      $query->bindParam(2, $pass, PDO::PARAM_STR);
      $query->bindParam(3, $email, PDO::PARAM_STR);
      $query->bindParam(4, $lastName, PDO::PARAM_STR);
      $query->bindParam(5, $firstName, PDO::PARAM_STR);
      $query->bindParam(6, $userType, PDO::PARAM_STR);
      $query->bindParam(7, $state, PDO::PARAM_STR);

      $message = " Confirmation de création de compte. Merci de choisir Projet Plan-Cadre.";

      //mail($email,"Plan-Cadre confirmation de courriel", $message, "From: DoNotReply@PlanCadre.com");

      $query->execute();
      $query->CloseCursor();
  }

  function createCours($codeCours, $nomCours, $typeCours, $ponderation, $unites,  $heures, $progCours, $dateAjout)
  {
      $insert = dbConnect()->prepare("CALL INSERT_COURS(?,?,?,?,?,?,?,?)");

      $insert->bindParam(1, $codeCours, PDO::PARAM_STR);
      $insert->bindParam(2, $nomCours, PDO::PARAM_STR);
      $insert->bindParam(3, $typeCours, PDO::PARAM_STR);
      $insert->bindParam(4, $ponderation, PDO::PARAM_STR);
      $insert->bindParam(5, $unites, PDO::PARAM_STR);
      $insert->bindParam(6, $heures, PDO::PARAM_STR);
      $insert->bindParam(7, $progCours, PDO::PARAM_STR);
      $insert->bindParam(8, $dateAjout, PDO::PARAM_STR);

      $insert->execute();
      $insert->CloseCursor();
  }

  function createCompetence($codeCompetence, $nomCompetence, $descriptionCompetence, $dateAjoutCompetence)
  {
      $insert = dbConnect()->prepare("CALL INSERT_COMPETENCE(?,?,?,?)");

      $insert->bindParam(1, $codeCompetence, PDO::PARAM_STR);
      $insert->bindParam(2, $nomCompetence, PDO::PARAM_STR);
      $insert->bindParam(3, $descriptionCompetence, PDO::PARAM_STR);
      $insert->bindParam(4, $dateAjoutCompetence, PDO::PARAM_STR);

      $insert->execute();
      $insert->CloseCursor();
  }

  function createProgramme($codeProgramme, $nomProgramme, $typeProgramme, $typeSanction, $dateAjoutProgramme)
  {
      $insert = dbConnect()->prepare("CALL INSERT_PROGRAMME(?,?,?,?,?)");

      $insert->bindParam(1, $codeProgramme, PDO::PARAM_STR);
      $insert->bindParam(2, $nomProgramme, PDO::PARAM_STR);
      $insert->bindParam(3, $typeProgramme, PDO::PARAM_STR);
      $insert->bindParam(4, $typeSanction, PDO::PARAM_STR);
      $insert->bindParam(5, $dateAjoutProgramme, PDO::PARAM_STR);

      $insert->execute();
      $insert->CloseCursor();
  }

  function createPlanCadre($codecours, $etat)
  {
      $connection = dbConnect();
      $insert = $connection->prepare("CALL INSERT_PLAN_CADRE(?,?)");

      $insert->bindParam(1, $codecours, PDO::PARAM_STR);
      $insert->bindParam(2, $etat, PDO::PARAM_STR);

      $insert->execute();

      // faire une procédure/fonction stocké pour ça 
      $select = $connection->query("SELECT LAST_INSERT_ID()");
      $id = $select->fetch(PDO::FETCH_NUM);
      $id = $id[0];
      //

      $insert->CloseCursor();

      return $id;
  }
  

  function assignUserPlanCadre($id, $user)
  {
      $insert = dbConnect()->prepare("CALL INSERT_ELABORATEUR_PLAN_CADRE(?,?)");

      $insert->bindParam(1, $id, PDO::PARAM_STR);
      $insert->bindParam(2, $user, PDO::PARAM_STR);

      //echo $id . " " . $user;

      $insert->execute();
      $insert->CloseCursor();
  }



/* 
   fonction : fetchStoredProc($call_select)
   Créé par : Simon Roy
   Prend un string en paramètre, le string représente une procédure stockée 
   dans la base de données qui serra éxécutée. La valeur de retour est un 
   array qui contient le résultat du select.
*/
  function fetchStoredProc($call_select)
  {
    $bdd = dbConnect();
    $query = $bdd->prepare($call_select);

    $query->execute();

    $result = $query->fetchAll();
    $query->closeCursor();

    return $result;
  }
  function fetchAllUser()
  {
    return fetchStoredProc("CALL SELECT_ALL_USERS ()");
  }
  function fetchAllClass()
  {
    return fetchStoredProc("CALL SELECT_ALL_CLASSES ()");
  }

/*
  fin des fonctions qui appellent fetchStoredProc($call_select)
*/

/*
  fonction : fetchId($call_select, $id)
  Prend un string en paramètre, le string représente une procédure stockée 
   dans la base de données qui serra éxécutée. La variable id est pour obtenir 
   seulement ce résultat là.
   La valeur de retour est un array qui contient le résultat du select
*/

function fetchId($id, $call_select)
{
  $bdd = dbConnect();
  $query = $bdd->prepare($call_select);

  $query->bindParam(1, $id, PDO::PARAM_STR);

  $query->execute();
  $result = $query->fetchAll();
  $query->closeCursor();

  return $result;
}

function fetchPlanCadreElaboration_User($id_user)
{
  return fetchId( $id_user, "CALL SELECT_PLAN_CADRE_ELABORATION_USER(?)" );
}

function fetchPlanCadreElaboration_PlanCadre($id_plancadre)
{
  return fetchId( $id_plancadre, "CALL SELECT_PLAN_CADRE_ID(?)" );
}
function fetchPrealableCours_Id($id_plancadre)
{
  return fetchId( $id_plancadre, "CALL SELECT_PREALABLE_COURS_ID(?)" );
}



/*
  fin des fonctions qui appellent fetchId($id, $call_select)
*/
  /*function createUser($UserName, $MotDePasse, $PasswordConfirmation, $Email)
  {
      if($UserName && $MotDePasse && $PasswordConfirmation)
      {
        $confirmcode = rand();
        $query = mysql_query("INSERT INTO utilisateurs VALUES ('$UserName','$MotDePasse','1','$confirmcode','0','$Email') ");

        $message = 
        "
          Veuillez confirmez votre Courriel 
          Clicker sur le lien en dessous pour verifier votre compte
          http://www.plancadre.com/ConfirmationDeCourriel.php?UserName=$UserName&NoUtilisateur=$confirmcode
        ";

        mail($email,"Plan-Cadre confirmation de courriel", $message, "From: DoNotReply@plancadre.com");

        echo "Merci, s'il vous plait veuillez confirmez votre adresse courriel";
      }
  }

  function SendConfirmEmail()
  {

    $UserName = $_GET['UserName'];
    $NoUtilisateur = $_GET['NoUtilisateur'];

    $query = mysql_query("SELECT * FROM 'utilisateurs' WHERE 'UserName'='$UserName'");
    while($row = mysql_fetch_assoc($query))
    {
      $db_NoUtilisateur = $row['NoUtilisateur'];
    }
    if ($NoUtilisateur == $db_NoUtilisateur) 
    {
      mysql_query("UPDATE 'utilisateur' SET 'Etat'='1' ");
      mysql_query("UPDATE 'utilisateur' SET 'NoUtilisateur'='0' ");
    }
    else
    {
      echo "Nom d'usager et le numéro d'utilisateur ne marche pas ensemble"
    }
  }*/


?>