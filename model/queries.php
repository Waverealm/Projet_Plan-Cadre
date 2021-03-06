<?php
/*
  Nom : queries.php
  Fait par Simon Roy, Antoine Latendresse & Léa Kelly
  Contient toutes les requêtes que le site utilise pour manipuler la base de données
*/



/*
  Fonction : dbConnect()
  Cette fonction retourne une instance d'une connexion à la base de données

*/
  function dbConnect() 
  {
    try
    {
      return new PDO('mysql:host=localhost;dbname=plan_cadre', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      
      //mysql_set_charset("utf8", PDO);
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


/*
  Nom de la fonction : getUser($username)
  Fait par Léa Kelly
  Va chercher dans la base de données les informations de l'utilisateur
  envoyé en paramètre
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


/*
  Nom de la fonction : countUsersSpecificUsername($username)
  Fait par Léa Kelly
  Compte le nombre d'utilisateurs avec le nom d'utilisateur envoyé. Le résultait devrait toujours être 0 ou 1
  0 pour nom d'utilisateur disponible
  1 pour nom d'utilisateur déjà utilisé
*/
  function countUsersSpecificUsername ($username)
  {
      $query = dbConnect()->prepare("CALL COUNT_USER_SPECIFIC_USERNAME(?)");

      $query->bindParam(1, $username, PDO::PARAM_STR);

      $query->execute();
      $username_free = ($query->fetchColumn()==0)?1:0;

      $query->closeCursor();

      return $username_free;
  }

/*
  Nom de la fonction : countUsersSpecificEmail($email)
  Fait par Léa Kelly
  Compte le nombre d'utilisateurs avec l'adresse courriel envoyée. Le résultait devrait toujours être 0 ou 1
  0 pour adresse email disponible
  1 pour adresse email déjà utilisée
*/
  function countUsersSpecificEmail ($email)
  {

      $query = dbConnect() ->prepare("CALL COUNT_USER_SPECIFIC_EMAIL(?)");

      $query->bindParam(1, $email, PDO::PARAM_STR);

      $query->execute();
      $email_free = ($query->fetchColumn()==0)?1:0;

      $query->closeCursor();

      return $email_free;
  }


/* 
  Nom de la fonction : selectWithNoParam($call_select)
  Fait par Simon Roy
  Prend un string en paramètre, le string représente une procédure stockée 
  dans la base de données qui serra éxécutée. La valeur de retour est un 
  array qui contient le résultat du select.

  Cette fonction ne devrait être utilisée pour éxécuter autre chose 
  que des selects.
*/
  function selectWithNoParam($call_select)
  {
    $query = dbConnect()->prepare($call_select);

    $query->execute();

    $result = $query->fetchAll();
    $query->closeCursor();

    return $result;
  }
  function fetchAllUser()
  {
    try
    {
      return selectWithNoParam("CALL SELECT_ALL_USERS ()");
    }
    catch(Exception $ex)
    {
      throw($ex);
    }
  }
  function fetchAllClass()
  {
    try
    {
      return selectWithNoParam("CALL SELECT_ALL_CLASSES ()");
    }
    catch(Exception $ex)
    {
      throw($ex);
    }
  }
  function selectAllConsignesPlanCadre()
  {
    try
    {
      return selectWithNoParam("CALL SELECT_ALL_CONSIGNES_PLAN_CADRE ()");
    }
    catch(Exception $ex)
    {
      throw($ex);
    }
  }
  function selectAllPlanCadre()
  {
    try
    {
      return selectWithNoParam("CALL SELECT_ALL_PLAN_CADRE ()");
    }
    catch(Exception $ex)
    {
      throw($ex);
    }
  }
  function selectAllOfficielPlanCadre()
  {
    try
    {
      return selectWithNoParam("CALL SELECT_ALL_OFFICIEL_PLAN_CADRE()");
    }
    catch(Exception $ex)
    {
      throw($ex);
    }
  }
  function selectPlanCadreElaboration()
  {
    try
    {
      return selectWithNoParam("CALL SELECT_PLAN_CADRE_ELABORATION ()");
    }
    catch(Exception $ex)
    {
      throw($ex);
    }
  }
  function selectAllValidPlanCadre()
  {
    try
    {
      return selectWithNoParam("CALL SELECT_ALL_VALID_PLAN_CADRE ()");
    } 
    catch(Exception $ex)
    {
      throw($ex);
    }
  }
  function selectAllProgramCode()
  {
    try
    {
      return selectWithNoParam("CALL SELECT_ALL_PROGRAMS ()");
    }
    catch(Exception $ex)
    {
      throw($ex);
    }
  }
  function selectAllPrograms()
  {
    try
    {
      return selectWithNoParam("CALL SELECT_ALL_PROGRAMS_WITH_NAME ()");
    }
    catch(Exception $ex)
    {
      throw($ex);
    }
  }

/*
  ------------------------------------------------------------------------------------
    début des fonctions qui appellent fetchId($id, $call_select)
  ------------------------------------------------------------------------------------
    Nom de la fonction : fetchId($id, $call_select)
    Fait par Simon Roy
    Prend un string en paramètre, le string représente une procédure stockée 
    dans la base de données qui serra éxécutée. La variable id est pour limiter
    la recherche à l'identifiant choisi.

    La valeur de retour est un array qui contient le résultat du select.
*/

  function fetchId($id, $call_select)
  {
    $query = dbConnect()->prepare($call_select);

    $query->bindParam(1, $id, PDO::PARAM_STR);

    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();

    return $result;
  }

  
  function getsections($id)
  {
    return fetchId( $id, "CALL SELECT_SECTIONS_PLANCADRES_ID(?)");
  }
  
   function getcountsections($id)
  {
    return fetchId( $id, "CALL COUNT_SECTIONS_PLANCADREs(?)");
  }
  
  function getPublicUtilisateur( $id_utilisteur)
  {
     return fetchId( $id_utilisteur, "CALL SELECT_PUBLIC_INFORMATION_UTILISATEUR(?)");
  }
  
  
/*
   Nom : fetchPlanCadreElaboration_User($id_user)
   Fait par Simon Roy
   Cette fonction éxecute une procédure qui retourne tous 
   les plans-cadres qui ont l'utilisateur passé
   en paramètre parmi ses élaborateurs.
*/
  function fetchPlanCadreElaboration_User($id_user)
  {
    return fetchId( $id_user, "CALL SELECT_PLAN_CADRE_ELABORATION_USER(?)" );
  }

  function getListeElaborateursDisponibles( $id_plancadre)
  {
    return fetchId( $id_plancadre, "CALL SELECT_LISTE_ELABORATEURS_DISPONIBLES(?)" );
  }
  function getListeElaborateursPlancadre( $id_plancadre )
  {
    return fetchId( $id_plancadre, "CALL SELECT_ELABORATEURS_PLANCADRE(?)" );
  }
  
  
/*
   Nom : fetchPlanCadreElaboration_PlanCadre($id_plan_cadre)
   Fait par Simon Roy
   Cette fonction éxecute une procédure qui retourne les 
   données du plan-cadre qui possède l'identifiant passé 
   en paramètre.
*/
  function fetchPlanCadreElaboration_PlanCadre($id_plancadre)
  {
    return fetchId( $id_plancadre, "CALL SELECT_PLAN_CADRE_ID(?)" );
  }

/*
   Nom : fetchPrealableCours_Id($id_cours)
   Fait par Simon Roy
   Va récupérer les préalables du cours passé en paramètre
*/
  function fetchPrealableCours_Id($id_cours)
  {
    return fetchId( $id_cours, "CALL SELECT_PREALABLE_COURS_ID(?)" );
  }

/*
   Nom : fetchConsignesPlanCadre_Id($id_consigne)
   Fait par Simon Roy
   Va récupérer la consigne correspondant à l'id passé en paramètre
*/  
  function fetchConsignesPlanCadre_Id($id_consigne)
  {
    return fetchId( $id_consigne, "CALL SELECT_CONSIGNE_PLAN_CADRE_ID(?)" );
  }

/*
   Nom : fetchAllPlanners($user_type)
   Fait par Léa Kelly
   Va sélectionner tous les élaborateur parmi les utilisateurs
   $user_type contient essentiellement le terme "Élaborateur"
*/ 
  function fetchAllPlanners($user_type)
  {
    return fetchId( $user_type, "CALL SELECT_ALL_PLANNERS(?)" );
  }

/*
   Nom : fetchDescriptionInstruction($id_instruction)
   Fait par Léa Kelly
   Va récupérer la description correspondant à l'id de la consigne passé en paramètre
*/ 
  function fetchDescriptionInstruction($id_instruction)
  {
    return fetchId( $id_instruction, "CALL SELECT_DESCRIPTION_INSTRUCTION(?)" );
  }

/*
   Nom : fetchInformationPlanCadre($id_plancadre)
   Fait par Léa Kelly
   Va récupérer toutes les informations du plan-cadre correspondant à l'id passé en paramètre
*/ 
  function fetchInformationPlanCadre($id_plancadre)
  {
    return fetchId( $id_plancadre, "CALL SELECT_PLAN_CADRE_INFOS(?)");
  }

/*
   Nom : fetchPlanCadreProgram($code_programme)
   Fait par Léa Kelly
   Va récupérer toutes les versions de tous les plans-cadres appartenant au programme dont le code
   est envoyé en paramètre
*/ 
  function fetchPlanCadreProgram($code_programme)
  {
    return fetchId( $code_programme, "CALL SELECT_PLAN_CADRE_PROGRAM(?)");
  }

/*
   Nom : fetchAllPlanCadreOfficiel($officiel)
   Fait par Léa Kelly
   Va récupérer tous les plans-cadre officiels eixistants
*/ 
   function fetchAllPlanCadreOfficiel($officiel)
  {
    return fetchId( $officiel, "CALL SELECT_ALL_PLAN_CADRE_OFFICIEL(?)");
  }

/*
   Nom : fetchPlanCadreClass($class_code)
   Fait par Léa Kelly
   Va récupérer toutes les versions du plan-cadre appartenant au cours dont le code est envoyé
   en paramètre
*/ 
  function fetchPlanCadreClass($class_code)
  {
    return fetchId( $class_code, "CALL SELECT_PLAN_CADRE_CLASS(?)");
  }

/*
   Nom : fetchClass($class_code)
   Fait par Léa Kelly
   Va récupérer le numéro du cours dont le code est passé en paramètre
*/ 
  function fetchClass($class_code)
  {
    return fetchId( $class_code, "CALL SELECT_CLASS(?)");
  }

/*
   Nom : fetchClassInfos($class_code)
   Fait par Léa Kelly
   Va récupérer toutes les informations du cours dont le code est passé
   en paramètre
*/ 
  function fetchClassInfos($class_code)
  {
    return fetchId( $class_code, "CALL SELECT_CLASS_INFOS(?)");
  }

/*
   Nom : fetchProgram($program_code)
   Fait par Léa Kelly
   Va récupérer le code du programme dans la BD selon selui qu'on envoit en paramètre
   Cette requête est surtout utilisée afin de vérifier si un programme existe déjà ou non
*/ 
  function fetchProgram($program_code)
  {
    return fetchId( $program_code, "CALL SELECT_PROGRAM(?)");
  }
  
/*
   Nom : fetchAllInfoPlanCadre($id_plancadre)
   Fait par Simon Roy
   Va récupérer toutes les informations d'un plan-cadre, incluant les informations du cours
   auquel il appartient
*/ 
  function fetchAllInfoPlanCadre($id_plancadre)
  {
    return fetchId( $id_plancadre, "CALL SELECT_ALL_INFO_COURS_PLAN_CADRE_ID (?)");
  }

/*
  ------------------------------------------------------------------------------------
    fin des fonctions qui appellent fetchId($id, $call_select)
  ------------------------------------------------------------------------------------
*/

/*
  Nom : getPassword($username)
  Fait par Léa Kelly
  Va récupérer dans la BD le mot de passe de l'utilisateur passé en paramètre puis
  retourne ce dit mot de passe
*/
  function getPassword($username)
  {
      $query = dbConnect()->prepare("CALL SELECT_PASSWORD(?)");
 
      $query->bindParam(1, $username, PDO::PARAM_STR);

      $query->execute();
      $result = $query->fetchAll();

      $query->closeCursor();
 
      return $result[0][ "MotDePasse" ];
  }

/*
  Nom : getPassword($username)
  Fait par Léa Kelly
  Va récupérer dans la BD le mot de passe de l'utilisateur passé en paramètre puis
  retourne ce dit mot de passe
*/
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
  Nom : getPlanCadreOfficialState($classCode, $officiel)
  Fait par Léa Kelly
  Va récupérer le numéro du plan-cadre officiel du cours reçu en paramètre
  Cette requête est en fait utilisée afin de voir si un plan-cadre officiel existe déjà
  pour le cours ou non
*/
    function getPlanCadreOfficialState($classCode, $officiel)
  {
    $query = dbConnect()->prepare("CALL SELECT_PLAN_CADRE_OFFICIAL_CLASS(?,?)");

    $query->bindParam(1, $classCode, PDO::PARAM_STR);
    $query->bindParam(2, $officiel, PDO::PARAM_STR);

    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();

    return $result;
  }

/*
  Nom : getAssignationPlanner($classCode, $state)
  Fait par Léa Kelly
  Va récupérer l'élaborateur d'un plan-cadre en particulier
*/
  function getAssignationPlanner($classCode, $state)
  {
    $query = dbConnect()->prepare("CALL SELECT_ELABORATEUR_ASSIGNATION(?,?)");

    $query->bindParam(1, $classCode, PDO::PARAM_STR);
    $query->bindParam(2, $state, PDO::PARAM_STR);

    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();

    return $result;
  }

/*
  Nom : getPlanCadreIdByState($classCode, $state)
  Fait par Léa Kelly
  Va récupérer le plan-cadre correspondant au code du cours et l'état reçus en paramètres
  Considérez que $state sera toujours "Élaborateur" pour l'utilisation que l'on en fait
*/
  function getPlanCadreIdByState($classCode, $state)
  {
    $query = dbConnect()->prepare("CALL SELECT_VERSION_PLAN_CADRE_BY_STATE(?,?)");

    $query->bindParam(1, $classCode, PDO::PARAM_STR);
    $query->bindParam(2, $state, PDO::PARAM_STR);

    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();

    return $result;
  }

/*
  Nom : getPlanCadreUser($noPlanCadre, $noUser)
  Fait par Léa Kelly
  Va récupérer le numéro de l'utilisateur correspondant au numéro de plan-cadre et au numéro de
  l'utilisateur envoyé
  Cette fonction va venir servir en fait à savoir si une assignation existe déjà (empty())
*/
  function getPlanCadreUser($noPlanCadre, $noUser)
  {
    $query = dbConnect()->prepare("CALL SELECT_PLAN_CADRE_USER(?,?)");

    $query->bindParam(1, $noPlanCadre, PDO::PARAM_STR);
    $query->bindParam(2, $noUser, PDO::PARAM_STR);

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

  function insert_plancadres_sections($plancadre_id, $emplacement, $titre)
  {
      $state = "Actif";
      $query = dbConnect()->prepare("CALL PLANCADRES_SECTIONS_INSERT(?,?,?)");

      $query->bindParam(1, $plancadre_id, PDO::PARAM_STR);
      $query->bindParam(2, $emplacement, PDO::PARAM_STR);
      $query->bindParam(3, $titre, PDO::PARAM_STR);

      $query->execute();
      $query->CloseCursor();
  }

/*
  Nom : createUser($userName, $pass, $email, $lastName, $firstName, $userType)
  Fait par Léa Kelly
  Insère un nouvel utilisateur dans la BD
*/
  function createUser($userName, $pass, $email, $lastName, $firstName, $userType)
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

      // EMAIL DE CONFIRMATION NON-TESTÉ
      //mail($email,"Plan-Cadre confirmation de courriel", $message, "From: DoNotReply@PlanCadre.com");

      $query->execute();
      $query->CloseCursor();
  }

/*
  Nom : createClass($codeCours, $nomCours, $typeCours, $ponderation, $unites,  $heures, $progCours)
  Fait par Simon Roy
  Insère un nouveau cours dans la BD
*/
  function createClass($codeCours, $nomCours, $typeCours, $ponderation, $unites,  $heures, $progCours)
  {
      $insert = dbConnect()->prepare("CALL INSERT_COURS(?,?,?,?,?,?,?)");

      $insert->bindParam(1, $codeCours, PDO::PARAM_STR);
      $insert->bindParam(2, $nomCours, PDO::PARAM_STR);
      $insert->bindParam(3, $typeCours, PDO::PARAM_STR);
      $insert->bindParam(4, $ponderation, PDO::PARAM_STR);
      $insert->bindParam(5, $unites, PDO::PARAM_STR);
      $insert->bindParam(6, $heures, PDO::PARAM_STR);
      $insert->bindParam(7, $progCours, PDO::PARAM_STR);

      $insert->execute();
      $insert->CloseCursor();
  }

/*
  Nom : createCompetence($codeCompetence, $nomCompetence, $descriptionCompetence)
  Fait par Simon Roy
  Insère une nouvelle compétence dans la BD
  Les compétences ne sont présentements pas utilisées

  function createCompetence($codeCompetence, $nomCompetence, $descriptionCompetence)
  {
      $insert = dbConnect()->prepare("CALL INSERT_COMPETENCE(?,?,?)");

      $insert->bindParam(1, $codeCompetence, PDO::PARAM_STR);
      $insert->bindParam(2, $nomCompetence, PDO::PARAM_STR);
      $insert->bindParam(3, $descriptionCompetence, PDO::PARAM_STR);

      $insert->execute();
      $insert->CloseCursor();
  }
  */

/*
  Nom : createProgram($codeProgramme, $nomProgramme, $typeProgramme, $typeSanction)
  Fait par Simon Roy
  Insère un nouveau programme dans la BD
*/
  function createProgram($codeProgramme, $nomProgramme, $typeProgramme, $typeSanction)
  {
      $insert = dbConnect()->prepare("CALL INSERT_PROGRAMME(?,?,?,?)");

      $insert->bindParam(1, $codeProgramme, PDO::PARAM_STR);
      $insert->bindParam(2, $nomProgramme, PDO::PARAM_STR);
      $insert->bindParam(3, $typeProgramme, PDO::PARAM_STR);
      $insert->bindParam(4, $typeSanction, PDO::PARAM_STR);

      $insert->execute();
      $insert->CloseCursor();
  }

/*
  Nom : createPlanCadre($codecours, $etat)
  Fait par Simon Roy
  Insère un nouveau plan-cadre dans la BD
*/
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

/*
  Nom : createPlanCadre($codecours, $etat)
  Fait par Simon Roy
  Assigne un utilisateur au plan-cadre d'un cours
*/
  function assignUserPlanCadre($id, $user)
  {
    $insert = dbConnect()->prepare("CALL INSERT_ELABORATEUR_PLAN_CADRE(?,?)");

    $insert->bindParam(1, $id, PDO::PARAM_STR);
    $insert->bindParam(2, $user, PDO::PARAM_STR);

    $insert->execute();
    $insert->CloseCursor();
  }

  function insert_section($plancadre_id, $emplacement, $titre , &$pdo='')
  {
    if( empty($pdo) )
    {
      $pdo = dbConnect();
    }
    $insert = $pdo->prepare("CALL INSERT_PLANCADRES_SECTIONS(?,?,?)");

    $insert->bindParam(1, $plancadre_id, PDO::PARAM_STR);
    $insert->bindParam(2, $emplacement, PDO::PARAM_STR);
    $insert->bindParam(3, $titre, PDO::PARAM_STR);
    
    $insert->execute();
    $insert->CloseCursor();
  }
  
/*
  Nom : createPlanCadreCopy($codeCours, $etat, $presentationCours, $objectifsIntegration, $evaluationApprentissage, $enonceCompetence,
                               $objectifsApprentissage, $manuelObligatoire, $recommandation)
  Fait par Léa Kelly
  Créé la copie d'un plan-cadre
  Cette fonction est utilisée lorsqu'on valide et adopte un plan-cadre et reçoit les informations du plan-cadre déjà
  existant dont on souhaite faire la copie
*/
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
  Fait par Simon Roy
  Cette fonction éxécute une modification (requête update) sur 
  un plan-cadre qui est encore en élaboration.

  note: ajouter la restriction (dans la procédure) et ratrappé l'erreur
*/

function updatePlanCadre_Fichiers($presentation, $integration,  $evaluation, $competences, $apprentissage, $id)
{
  $update = dbConnect()->prepare("CALL UPDATE_PLAN_CADRE_FICHIERS (?,?,?,?,?,?)");

  $update->bindParam(1, $presentation, PDO::PARAM_STR);
  $update->bindParam(2, $integration, PDO::PARAM_STR);
  $update->bindParam(3, $evaluation, PDO::PARAM_STR);
  $update->bindParam(4, $competences, PDO::PARAM_STR);
  $update->bindParam(5, $apprentissage, PDO::PARAM_STR);
  $update->bindParam(6, $id, PDO::PARAM_STR);

  $update->execute();

  $update->closeCursor();
}

function updatesection($id, $emplacement, $titre, &$pdo = '')
{
  if( empty($pdo) )
  {
    $pdo = dbConnect();
  }
  $update = $pdo->prepare("CALL UPDATE_PLANCADRES_SECTIONS (?,?,?)");

  $update->bindParam(1, $id, PDO::PARAM_STR);
  $update->bindParam(2, $emplacement, PDO::PARAM_STR);
  $update->bindParam(3, $titre, PDO::PARAM_STR);

  $update->execute();

  $update->closeCursor();
}

/*
  Nom de la fonction : updateInstruction
  Fait par Simon Roy
  Cette fonction éxécute une modification (requête update) sur 
  une des consignes de la table consignesplancadre.
*/
function updateInstruction($id, $enonce, $description)
{
  $update = dbConnect()->prepare("CALL UPDATE_INSTRUCTION (?,?,?)");

  $update->bindParam(1, $id, PDO::PARAM_STR);
  $update->bindParam(2, $enonce, PDO::PARAM_STR);
  $update->bindParam(3, $description, PDO::PARAM_STR);

  $update->execute();

  $update->closeCursor();
}

/*
  Nom : updatePassword($user,$newPassword)
  Fait par Léa Kelly
  Modifie le mot de passe d'un utilisateur
*/
function updatePassword($user,$newPassword)
{
    $query = dbConnect()->prepare( "CALL UPDATE_PASSWORD_USER(?,?)" );

    $query->bindParam(1, $user, PDO::PARAM_STR);
    $query->bindParam(2, $newPassword, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}

/*
  Nom : updatePassword($user,$newPassword)
  Fait par Léa Kelly
  Change l'état d'un plan-cadre pour l'état reçu en paramètre
*/
function updatePlanCadreState($idPlanCadre,$state)
{
    $query = dbConnect()->prepare( "CALL UPDATE_STATE_PLANCADRE(?,?)" );

    $query->bindParam(1, $idPlanCadre, PDO::PARAM_STR);
    $query->bindParam(2, $state, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}

/*
  Nom : updatePassword($user,$newPassword)
  Fait par Léa Kelly
  Change l'état d'un plan-cadre pour l'état reçu en paramètre
*/
function setPlanCadreOfficial($noPlanCadre,$official)
{
    $query = dbConnect()->prepare( "CALL UPDATE_OFFICIAL_PLANCADRE(?,?)" );

    $query->bindParam(1, $noPlanCadre, PDO::PARAM_STR);
    $query->bindParam(2, $official, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}

/*
LA MODIFICATION D'UN COURS N'A PAS FINI D'ÊTRE IMPÉMENTÉE
function updateClass($codeCours, $nomCours,  $typeCours, $ponderation, $nombreUnites, $nombreHeures, codeProg)
{
  $update = dbConnect()->>prepare("CALL UPDATE_CLASS(?,?,?,?,?,?,?)");

  $update->bindParam(1, $codeCours, PDO::PARAM_STR);
  $update->bindParam(2, $nomCours, PDO::PARAM_STR);
  $update->bindParam(3, $typeCours, PDO::PARAM_STR);
  $update->bindParam(4, $ponderation, PDO::PARAM_STR);
  $update->bindParam(5, $nombreUnites, PDO::PARAM_STR);
  $update->bindParam(6, $nombreHeures, PDO::PARAM_STR);
  $update->bindParam(7, $codeProg, PDO::PARAM_STR);

  $update->execute();

  $update->closeCursor();
}*/


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
  Nom : deleteOldVersionPlanCadre($noValidatePlanCadre)
  Fait par Léa Kelly
  Supprime le plan-cadre dont le numéro est celui reçu en paramètre
*/
function deleteOldVersionPlanCadre($noValidatePlanCadre)
{
    $query = dbConnect()->prepare( "CALL DELETE_OLD_VERSION_PLANCADRE(?)" );

    $query->bindParam(1, $noValidatePlanCadre, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}

/*
  Nom : deleteAssignationPlanCadre($noValidatePlanCadre)
  Fait par Léa Kelly
  Lorsqu'une version d'un plan-sacre est supprimée, cette fonction vient également supprimer l'assignation
  reliée à ce plan-cadre
*/
function deleteAssignationPlanCadre($noValidatePlanCadre)
{
    $query = dbConnect()->prepare( "CALL DELETE_ASSIGNATION_PLAN_CADRE(?)" );

    $query->bindParam(1, $noValidatePlanCadre, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}



function enleverSection($section_id, &$pdo = '')
{
    if( empty($pdo) )
    {
      $pdo = dbConnect();
    }
    $query = $pdo->prepare( "CALL PLANCADRES_SECTIONS_DELETE(?)" );

    $query->bindParam(1, $section_id, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}

/* 
------------------------------------------------------------------------------------
  fin des delete
------------------------------------------------------------------------------------
*/


// LA CONFIRMATION PAR COURRIEL N'A PAS ÉTÉ TESTÉ
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