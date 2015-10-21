<?php

  function dbConnect() 
  {
     try
     {
       return new PDO('mysql:host=localhost;dbname=plan_cadre', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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


  function createUser($userName, $pass, $passConfirm, $email)
  {

      $typeUser = "elaborateur";
      $etat = "actif";
      $insert = dbConnect()->prepare("CALL INSERT_USER(?,?,?,?,?,?,?)");

      $insert->bindParam(1, $userName, PDO::PARAM_STR);
      $insert->bindParam(2, $pass, PDO::PARAM_STR);
      $insert->bindParam(3, $nom, PDO::PARAM_STR);
      $insert->bindParam(4, $prenom, PDO::PARAM_STR);
      $insert->bindParam(5, $typeUser, PDO::PARAM_STR);
      $insert->bindParam(6, $etat, PDO::PARAM_STR);
      $insert->bindParam(7, $email, PDO::PARAM_STR);

      $message = " Confirmation de création de compte. Merci de choisir Projet Plan-Cadre.";

      //mail($email,"Plan-Cadre confirmation de courriel", $message, "From: DoNotReply@PlanCadre.com");

      $insert->execute();


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
  }

  function createCompetence($codeCompetence, $nomCompetence, $descriptionCompetence, $dateAjoutCompetence)
  {
      $insert = dbConnect()->prepare("CALL INSERT_COMPETENCE(?,?,?,?)");

      $insert->bindParam(1, $codeCompetence, PDO::PARAM_STR);
      $insert->bindParam(2, $nomCompetence, PDO::PARAM_STR);
      $insert->bindParam(3, $descriptionCompetence, PDO::PARAM_STR);
      $insert->bindParam(4, $dateAjoutCompetence, PDO::PARAM_STR);

      $insert->execute();
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
  }
  

/* 
   fonction : fetchStoredProc($call_select)
   Créé par : Simon Roy
   Prend un string en paramètre, le string représente une procédure stockée 
   dans la base de données qui serra éxécutée. La valeur de retour est un 
   array qui contient le résultat du select
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
    return fetchStoredProc("CALL SELECT_USERS_LIST ()");
  }
  function fetchAllCourse()
  {
    return fetchStoredProc("CALL SELECT_COURSE_LIST ()");
  }


/*
  fin des fonctions qui appellent fetchStoredProc($call_select)
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