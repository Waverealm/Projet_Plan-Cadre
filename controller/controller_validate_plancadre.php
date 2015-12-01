<?php

include_once("../model/queries.php");

if(isset($_GET['codecours']) && isset($_GET['versionplan']))
 {
 	$No_PlanCadre = $_GET['versionplan'];
 	$classCode = $_GET['codecours'];
 	$state = "Validé";

 	$result = fetchInformationPlanCadre($No_PlanCadre);

 	deleteOldVersionPlanCadre($classCode,$state);
 	updatePlanCadreState($No_PlanCadre, $state);

 	createPlanCadreCopy($classCode, $result[0][ "Etat" ], $result[0][ "Presentation_Cours" ], $result[0][ "Objectifs_Integration" ], $result[0][ "Evaluation_Apprentissage" ], 
 						$result[0][ "Enonce_Competences" ], $result[0][ "Objectifs_Apprentissage" ], $result[0][ "Manuel_Obligatoire" ], $result[0][ "Recommandation" ]);

 	header('Location: ../view/view_search_plan_cadre.php');
 }

 ?>