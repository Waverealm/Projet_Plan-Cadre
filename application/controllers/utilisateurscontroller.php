<?php

class UtilisateursController extends VanillaController {
	
	function beforeAction () {

	}

	function view($programmeId = null) {

		$this->Programme->id = $programmeId;
		$this->Programme->showHasMany();
		$programme = $this->Programme->search();
	
		$this->set('programme',$programme);

	}
	
	
	function index() {
		$this->Programme->orderBy('nom','ASC');
		$programmes = $this->Programme->search();
		$this->set('programmes',$programmes);
	
	}
    
    function connexion()
    {
        if(isset($_POST['nom_utilisateur']) && !empty($_POST['nom_utilisateur']) && isset($_POST['mot_passe'])  && !empty($_POST['mot_passe']) )
        {
            if( confirmerConnexion($_POST['nom_utilisateur'], $_POST['mot_passe']) )
            {
               unset($_SESSION[ 'username' ]);
               $_SESSION[ 'username_usager' ] = $username;
               $_SESSION[ 'connected' ] = true;
               header('Location: ' . BASE_PATH);
            }
        }
    }

	function afterAction() {

	}

    
    
    function confirmerConnexion( $username, $password )
	{
        
        
        
		// On va récupérer l'utilisateur précis
		$reponse = getUser($username);
   
	   	// On vérifie si l'adresse email et mot de passe correspondent
	   	if (validatePassword($username, $password)) //($reponse[0][ "MotDePasse" ] == $password)
		{
			$connected = true;
            // le nom et le prénom servent à assurer à l'utilisateur qu'il est connecté
            // et connecté avec le bon compte
			$_SESSION['first_name'] = $reponse[0]['Prenom'];
			$_SESSION['last_name'] = $reponse[0]['Nom'];

            // nécessaire pour valider le niveau d'accès de l'utilisateur
			$_SESSION['user_type'] = $reponse[0]['TypeUtilisateur'];
			//nécessaire pour accéder à d'autres informations liées à l'utilisateur plus loin
            // dans la session
			$_SESSION['no_user'] = $reponse[0]['NoUtilisateur'];
		} else {
			$connected = false;
		}

	   return $connected;
	}

}