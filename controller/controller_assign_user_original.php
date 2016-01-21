<?php
/* 
   Nom : controller_assign_user.php
   Créé par : Simon Roy
   Gestion de la vue view_assign_user.php
*/

   	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	include_once("../assets/constants.php");
	include_once(REQUETES_BD);

	// Si on a reçu les données d'un formulaire
	if( isset( $_POST[ 'user_list_all' ] ))
	{
		$user = $_POST["user_list_all"];

		if(isset( $_POST[ 'class_list_all' ] ) && !empty( $_POST[ 'class_list_all' ] ))
		{
			// on crée un plan-cadre en élaboration pour un cours qui n'a pas
			// déjà de plan-cadre en élaboration
			// puis on lui assigne l'utilisateur choisi
			$codecours = $_POST["class_list_all"];

			$etat = "Élaboration";

			$id = createPlanCadre($codecours, $etat);
			
			assignUserPlanCadre($id, $user);

			$_SESSION[ 'info_assign' ] = 'Assignation effectuée avec succès';

			header('Location: ../view/view_assign_user.php');
		}

		else if(isset( $_POST[ 'plan_cadre_elaboration_list' ] ) && !empty( $_POST[ 'plan_cadre_elaboration_list' ] ))
		{
			// on ajoute un élaborateur à un plan-cadre en élaboration

			if(empty(getPlanCadreUser($_POST[ 'plan_cadre_elaboration_list' ], $user)))
            {
				// Lorsqu'on choisi cette option, cela ne supprime pas l'asssignation précédente, mais rajoute un nouvel
				// élaborateur qui peut avoir accès à ce plan-cadre
				assignUserPlanCadre($_POST[ 'plan_cadre_elaboration_list' ], $user);

				$_SESSION[ 'info_assign' ] = 'Assignation effectuée avec succès';
			}

			else
			{
				$_SESSION[ 'info_assign' ] = 'Cet utilisateur est déjà assigné à ce plan-cadre';
			}

			header('Location: ../view/view_assign_user.php');

		}

		else
		{
			$_SESSION[ 'info_assign' ] = 'Vous devez sélectionné un cours ou un plan-cadre déjà existant';

			header('Location: ../view/view_assign_user.php');
		}
	}

?>