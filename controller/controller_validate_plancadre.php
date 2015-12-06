<?php

// Nom : controller_validate_plancadre.php
// Fait par Léa Kelly
// Traitement lorsqu'un utilisateur valide un plan-cadre


include_once("../model/queries.php");

if(isset($_GET['codecours']) && isset($_GET['versionplan']))
 {
 	// On récupère les données
 	$No_PlanCadre = $_GET['versionplan'];
 	$classCode = $_GET['codecours'];
 	$state = "Validé";

 	// On va chercher les informations du plan-cadre que l'on valide
 	$result = fetchInformationPlanCadre($No_PlanCadre);

 	$noValidatePlanCadre = getPlanCadreIdByState($classCode, $state);

 	// S'il existe déjà une version validée du plan-cadre
 	if (!empty($noValidatePlanCadre[0][ "No_PlanCadre" ]))
 	{
 		// Afin de refaire l'assignation de la copie, on doit aller récupérer le numéro de compte de l'élaborateur
 		$plannerId = getAssignationPlanner($classCode,$state);

 		// Alors on le supprime ainsi que son assignation
 		deleteAssignationPlanCadre($noValidatePlanCadre[0][ "No_PlanCadre" ]);
 		deleteOldVersionPlanCadre($noValidatePlanCadre[0][ "No_PlanCadre" ]);
 	}

 	// S'il n'y a pas encore de copie validée
 	else
 	{
 		$plannerId = getAssignationPlanner($classCode,"Élaboration");
 	}

 	// On change l'état de "Élaboration" à "Validé"
 	updatePlanCadreState($No_PlanCadre, $state);

 	// On créé une copie qui restera en mode "Élaboration"
 	createPlanCadreCopy($classCode, $result[0][ "Etat" ], $result[0][ "Presentation_Cours" ], $result[0][ "Objectifs_Integration" ], $result[0][ "Evaluation_Apprentissage" ], 
 						$result[0][ "Enonce_Competences" ], $result[0][ "Objectifs_Apprentissage" ], $result[0][ "Manuel_Obligatoire" ], $result[0][ "Recommandation" ]);


 	// On doit pouvoir recréer l'assignation pour cette copie en allant chercher l'id du plan-cadre
 	// puis on fait l'assignation
 	$copyPlanCadreId = getPlanCadreIdByState($classCode, "Élaboration");
 	if (!empty($copyPlanCadreId[0][ "No_PlanCadre" ]) && !empty($plannerId[0][ "Utilisateurs_NoUtilisateur" ]))
 		assignUserPlanCadre($copyPlanCadreId[0][ "No_PlanCadre" ], $plannerId[0][ "Utilisateurs_NoUtilisateur" ]);

 	header('Location: ../view/view_search_plan_cadre.php');
 }

 ?>