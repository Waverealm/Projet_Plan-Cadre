<?php

include_once("../model/queries.php");

if(isset($_GET['codecours']) && isset($_GET['versionplan']))
 {
 	$No_PlanCadre = $_GET['versionplan'];
 	$classCode = $_GET['codecours'];
 	$state = "Adopté";
 	$officiel = 1;

 	$result = fetchInformationPlanCadre($No_PlanCadre);

 	createPlanCadreCopy($classCode, $result[0][ "Etat" ], $result[0][ "Presentation_Cours" ], $result[0][ "Objectifs_Integration" ], $result[0][ "Evaluation_Apprentissage" ], $result[0][ "Enonce_Competences" ], $result[0][ "Objectifs_Apprentissage" ], $result[0][ "Manuel_Obligatoire" ], $result[0][ "Recommandation" ]);

 	updatePlanCadreState($No_PlanCadre, $state);
 	setPlanCadreOfficial($No_PlanCadre, $officiel);

 	$result = getPlanCadreOfficialState($classCode, $officiel);

 	if(!empty($result))
 	{
 		setPlanCadreOfficial($result, 0);
 	}

 	header('Location: ../view/view_search_plan_cadre.php');
 }

?>