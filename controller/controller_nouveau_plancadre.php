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

        if(isset( $_POST[ 'class_list_all' ] ) && !empty( $_POST[ 'class_list_all' ] ))
		{
			// on crée un plan-cadre en élaboration pour un cours qui n'a pas
			// déjà de plan-cadre en élaboration
			$codecours = $_POST["class_list_all"];

			$etat = "Élaboration";

			$plancadre_id = createPlanCadre($codecours, $etat);
			
			$titre = array("", "Présentation du cours","Objectifs d'intégration","Évaluation des apprentissages","Énoncé des compétences", "Objectifs d'apprentissage");
			
            for( $i = 1; $i <= 5; $i++)
			{
				insert_section($plancadre_id, $i, $titre[$i]);
			}
			
			
			if( isset( $_POST[ 'user_list_all' ] ) && !empty( $_POST[ 'user_list_all' ] ) )
			{
				assignUserPlanCadre($plancadre_id, $_POST["user_list_all"]);
			}
			
			
			$_SESSION[ 'info_assign' ] = 'Le plan-cadre a bien été ajouté';

			header('Location: ../view/view_nouveau_plancadre.php');
		}
		else
		{
			$_SESSION[ 'info_assign' ] = 'Vous devez sélectionné un cours pour ajouter un plan-cadre';

			header('Location: ../view/view_nouveau_plancadre.php');
		}

?>