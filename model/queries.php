<?php
/*
  queris.php
*/



/*
  fonction : dbConnect()
  Cette fonction retourne une instance d'une connexion à la base de données

*/
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

/*
  ------------------------------------------------------------------------------------
  début des selects
  ------------------------------------------------------------------------------------
*/


  function getUser($username)
  {
      $query = dbConnect()->prepare("CALL SELECT_USER(?)");
 
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


/* 
  Nom de la fonction : selectWithNoParam($call_select)
  Fait par : Simon Roy
  Prend un string en paramètre, le string représente une procédure stockée 
  dans la base de données qui serra éxécutée. La valeur de retour est un 
  array qui contient le résultat du select.

  Cette fonction ne devrait pas prendre être utilisé pour éxécuter autre chose 
  que des selects.
*/
  function selectWithNoParam($call_select)
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
    return selectWithNoParam("CALL SELECT_ALL_USERS ()");
  }
  function fetchAllClass()
  {
    return selectWithNoParam("CALL SELECT_ALL_CLASSES ()");
  }
  function selectAllConsignesPlanCadre()
  {
    return selectWithNoParam("CALL SELECT_ALL_CONSIGNES_PLAN_CADRE ()");
  }
  function selectAllPlanCadre()
  {
    return selectWithNoParam("CALL SELECT_ALL_PLAN_CADRE ()");
  }
  function selectAllValidPlanCadre()
  {
    return selectWithNoParam("CALL SELECT_ALL_VALID_PLAN_CADRE ()");
  }
  function selectAllProgramCode()
  {
    return selectWithNoParam("CALL SELECT_ALL_PROGRAMS ()");
  }
  function selectAllPrograms()
  {
    return selectWithNoParam("CALL SELECT_ALL_PROGRAMS_WITH_NAME ()");
  }

/*
  ------------------------------------------------------------------------------------
    début des fonctions qui appellent fetchId($id, $call_select)
  ------------------------------------------------------------------------------------
    Nom de la fonction : fetchId($id, $call_select)
    Prend un string en paramètre, le string représente une procédure stockée 
    dans la base de données qui serra éxécutée. La variable id est pour limiter
    la recherche à l'identifiant choisi.

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

/*
   fetchPlanCadreElaboration_User($id_user)
   Cette fonction éxecute une procédure qui retourne tous 
   les plans-cadres qui ont l'utilisateur passé
   en paramètre parmi ses élaborateurs.
*/
  function fetchPlanCadreElaboration_User($id_user)
  {
    return fetchId( $id_user, "CALL SELECT_PLAN_CADRE_ELABORATION_USER(?)" );
  }
/*
   fetchPlanCadreElaboration_PlanCadre($id_user)
   Cette fonction éxecute une procédure qui retourne les 
   données du plan-cadre qui possède l'identifiant passé 
   en paramètre.
*/
  function fetchPlanCadreElaboration_PlanCadre($id_plancadre)
  {
    return fetchId( $id_plancadre, "CALL SELECT_PLAN_CADRE_ID(?)" );
  }
  function fetchPrealableCours_Id($id_cours)
  {
    return fetchId( $id_cours, "CALL SELECT_PREALABLE_COURS_ID(?)" );
  }
  function fetchConsignesPlanCadre_Id($id_consigne)
  {
    return fetchId( $id_consigne, "CALL SELECT_CONSIGNE_PLAN_CADRE_ID(?)" );
  }
  function fetchAllPlanners($user_type)
  {
    return fetchId( $user_type, "CALL SELECT_ALL_PLANNERS(?)" );
  }
  function fetchDescriptionInstruction($id_instruction)
  {
    return fetchId( $id_instruction, "CALL SELECT_DESCRIPTION_INSTRUCTION(?)" );
  }
  function fetchInformationPlanCadre($class_code)
  {
    return fetchId( $class_code, "CALL SELECT_PLAN_CADRE_INFOS(?)");
  }
  function fetchPlanCadreProgram($code_programme)
  {
    return fetchId( $code_programme, "CALL SELECT_PLAN_CADRE_PROGRAM(?)");
  }
   function fetchAllPlanCadreOfficiel($etat)
  {
    return fetchId( $etat, "CALL SELECT_ALL_PLAN_CADRE_OFFICIEL(?)");
  }
  
  function getPassword($username)
  {
      $query = dbConnect()->prepare("CALL SELECT_PASSWORD(?)");
 
      $query->bindParam(1, $username, PDO::PARAM_STR);

      $query->execute();
      $result = $query->fetchAll();

      $query->closeCursor();
 
      return $result[0][ "MotDePasse" ];
  }

  function getPlanCadreOfficielProgram($etat, $code_programme)
  {
    $query = dbConnect()->prepare("CALL SELECT_PLAN_CADRE_OFFICIEL_PROGRAM(?,?)");

    $query->bindParam(1, $etat, PDO::PARAM_STR);
    $query->bindParam(2, $code_programme, PDO::PARAM_STR);

    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();

    return $result;
  }

/*
  ------------------------------------------------------------------------------------
  fin des selects
  ------------------------------------------------------------------------------------
  ------------------------------------------------------------------------------------
  début des insertions (create)
  ------------------------------------------------------------------------------------
*/



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

  function createClass($bdd, $codeCours, $nomCours, $typeCours, $ponderation, $unites,  $heures, $progCours, $dateAjout)
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

  function createCompetence($bdd, $codeCompetence, $nomCompetence, $descriptionCompetence, $dateAjoutCompetence)
  {
      $insert = $bdd->prepare("CALL INSERT_COMPETENCE(?,?,?,?)");

      $insert->bindParam(1, $codeCompetence, PDO::PARAM_STR);
      $insert->bindParam(2, $nomCompetence, PDO::PARAM_STR);
      $insert->bindParam(3, $descriptionCompetence, PDO::PARAM_STR);
      $insert->bindParam(4, $dateAjoutCompetence, PDO::PARAM_STR);

      $insert->execute();
      $insert->CloseCursor();
  }

  function createProgram($codeProgramme, $nomProgramme, $typeProgramme, $typeSanction, $dateAjoutProgramme)
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
  
  function createConsignesPlanCadre($id, $enonce, $description)
  {      
    $connection = dbConnect();
    $insert = $connection->prepare("CALL INSERT_CONSIGNE_PLAN_CADRE(?,?,?)");

    $insert->bindParam(1, $id, PDO::PARAM_STR);
    $insert->bindParam(2, $enonce, PDO::PARAM_STR);
    $insert->bindParam(3, $description, PDO::PARAM_STR);
    
    $insert->execute();

    $insert->CloseCursor();
  }

  function assignUserPlanCadre($id, $user)
  {
    $insert = dbConnect()->prepare("CALL INSERT_ELABORATEUR_PLAN_CADRE(?,?)");

    $insert->bindParam(1, $id, PDO::PARAM_STR);
    $insert->bindParam(2, $user, PDO::PARAM_STR);

    $insert->execute();
    $insert->CloseCursor();
  }

  function createPlanCadreCopy($codeCours, $etat, $presentationCours, $objectifsIntegration, $evaluationApprentissage, $enonceCompetence,
                               $objectifsApprentissage, $manuelObligatoire, $recommandation)
  {
    $insert = dbConnect()->prepare("CALL INSERT_COPY_PLAN_CADRE(?,?,?,?,?,?,?,?,?)");

    $insert->bindParam(1, $codeCours, PDO::PARAM_STR);
    $insert->bindParam(2, $etat, PDO::PARAM_STR);
    $insert->bindParam(3, $presentationCours, PDO::PARAM_STR);
    $insert->bindParam(4, $objectifsIntegration, PDO::PARAM_STR);
    $insert->bindParam(5, $evaluationApprentissage, PDO::PARAM_STR);
    $insert->bindParam(6, $enonceCompetence, PDO::PARAM_STR);
    $insert->bindParam(7, $objectifsApprentissage, PDO::PARAM_STR);
    $insert->bindParam(8, $manuelObligatoire, PDO::PARAM_STR);
    $insert->bindParam(9, $recommandation, PDO::PARAM_STR);

    $insert->execute();
    $insert->CloseCursor();
  }

/* 
------------------------------------------------------------------------------------
  début des updates
------------------------------------------------------------------------------------
*/


/*
  Nom de la fonction : updatePlanCadre_Fichiers
  Fait par : Simon Roy
  Cette fonction éxécute une modification (requête update) sur 
  un plan-cadre qui est encore en élaboration.

  note: ajouter la restriction (dans la procédure) et ratrappé l'erreur
*/

function updatePlanCadre_Fichiers($presentation, $integration,  $evaluation, $competences, $apprentissage, $id)
{
  $bdd = dbConnect();
  $update = $bdd->prepare("CALL UPDATE_PLAN_CADRE_FICHIERS (?,?,?,?,?,?)");

  $update->bindParam(1, $presentation, PDO::PARAM_STR);
  $update->bindParam(2, $integration, PDO::PARAM_STR);
  $update->bindParam(3, $evaluation, PDO::PARAM_STR);
  $update->bindParam(4, $competences, PDO::PARAM_STR);
  $update->bindParam(5, $apprentissage, PDO::PARAM_STR);
  $update->bindParam(6, $id, PDO::PARAM_STR);

  $update->execute();

  $update->closeCursor();
}

/*
  Nom de la fonction : updateInstruction
  Fait par : Simon Roy
  Cette fonction éxécute une modification (requête update) sur 
  une des consignes de la table consignesplancadre.
*/
function updateInstruction($id, $enonce, $description)
{
  $bdd = dbConnect();
  $update = $bdd->prepare("CALL UPDATE_INSTRUCTION (?,?,?)");

  $update->bindParam(1, $id, PDO::PARAM_STR);
  $update->bindParam(2, $enonce, PDO::PARAM_STR);
  $update->bindParam(3, $description, PDO::PARAM_STR);

  $update->execute();

  $update->closeCursor();
}

// change to updatePassword
function updatePassword($user,$newPassword)
{
    $query = dbConnect()->prepare( "CALL UPDATE_PASSWORD_USER(?,?)" );

    $query->bindParam(1, $user, PDO::PARAM_STR);
    $query->bindParam(2, $newPassword, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}

// Change l'état du plan-cadre pour "validé"
function updatePlanCadreState($idPlanCadre,$state)
{
    $query = dbConnect()->prepare( "CALL UPDATE_STATE_PLANCADRE(?,?)" );

    $query->bindParam(1, $idPlanCadre, PDO::PARAM_STR);
    $query->bindParam(2, $state, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}


/* 
------------------------------------------------------------------------------------
  fin des updates
------------------------------------------------------------------------------------
*/

/* 
------------------------------------------------------------------------------------
  début des delete
------------------------------------------------------------------------------------
*/

/*
// Supprimer une vieille version validé d'un plan-cadre
  on devrait mettre une "protection", un plancadre adopté ne devrait jamais être effacé

  genre on pourrait placer un if pour confirmer qu'on efface pas un plan-cadre adopté et 
  on pourrait aussi enlever l'option d'appeler la fonction avec l'état en paramètre pour 
  limiter son accès. Dans tous les cas il faudra mettre des commentaires détaillés.
*/
function deleteOldVersionPlanCadre($classCode,$state)
{
    $query = dbConnect()->prepare( "CALL DELETE_OLD_VERSION_PLANCADRE(?,?)" );

    $query->bindParam(1, $classCode, PDO::PARAM_STR);
    $query->bindParam(2, $state, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}

/* 
------------------------------------------------------------------------------------
  fin des delete
------------------------------------------------------------------------------------
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