<?php
/* 

*/

   	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	include_once("../assets/constants.php");
	include_once(REQUETES_BD);

        if(isset( $_POST[ 'liste_plan_cadre' ] ) && !empty( $_POST[ 'liste_plan_cadre'  ] ))
		{
			
			header('Location: ../view/view_retirer_assignation_suite.php');
		}
        else if()
        {
            header('Location: ../view/view_retirer_assignation_suite.php');
        }
		else
		{
			$_SESSION[ 'info_assign' ] = '';

			header('Location: ../view/view_retirer_assignation.php');
		}

?>