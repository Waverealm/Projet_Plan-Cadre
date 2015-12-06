<?php

// Nom : controller_adopt_plancadre.php
// Fait par Léa Kelly
// Traitement lorsqu'un utilisateur adopte un plan-cadre

include_once("../model/queries.php");

if(isset($_GET['codecours']) && isset($_GET['versionplan']))
 {
 	// On récupère les données
 	$No_PlanCadre = $_GET['versionplan'];
 	$classCode = $_GET['codecours'];
 	$state = "Adopté";
 	// 1 pour true
 	$officiel = 1;

 	// On va chercher les informations du plan-cadre que l'on adopte
 	$result = fetchInformationPlanCadre($No_PlanCadre);

	// Afin de refaire l'assignation de la copie, on doit aller récupérer le numéro de compte de l'élaborateur
 	$plannerId = getAssignationPlanner($classCode, "Validé");

 	// On créé une copie qui restera en mode "Validé"
 	createPlanCadreCopy($classCode, $result[0][ "Etat" ], $result[0][ "Presentation_Cours" ], $result[0][ "Objectifs_Integration" ], $result[0][ "Evaluation_Apprentissage" ], $result[0][ "Enonce_Competences" ], $result[0][ "Objectifs_Apprentissage" ], $result[0][ "Manuel_Obligatoire" ], $result[0][ "Recommandation" ]);

 	// On va chercher la dernière version adopté
 	// $noOfficialPlanCadre va contenir quelque chose si une version adopté existe déjà
 	$noOfficialPlanCadre = getPlanCadreOfficialState($classCode, $officiel);

 	// On change l'état du plan-cadre pour "Adopté"
 	updatePlanCadreState($No_PlanCadre, $state);
 	// Étant donné que le plan-cadre que l'utilisateur veut adopté sera la version la plus récente, elle sera nécessairement
 	// aussi la version officielle
 	setPlanCadreOfficial($No_PlanCadre, $officiel);

 	// S'il existait déjà une autre version adoptée de ce plan-cadre, alors on lui enlève le statut de "Version officielle"
 	if(!empty($noOfficialPlanCadre[0]["No_PlanCadre"]))
 	{
 		setPlanCadreOfficial($noOfficialPlanCadre[0]["No_PlanCadre"], 0);
 	}

 	// On doit pouvoir recréer l'assignation pour la copie en allant chercher l'id du plan-cadre
 	// puis on fait l'assignation
 	$copyPlanCadreId = getPlanCadreIdByState($classCode, "Validé");
 	if (!empty($copyPlanCadreId[0][ "No_PlanCadre" ]) && !empty($plannerId[0][ "Utilisateurs_NoUtilisateur" ]))
 		assignUserPlanCadre($copyPlanCadreId[0][ "No_PlanCadre" ], $plannerId[0][ "Utilisateurs_NoUtilisateur" ]);

 	header('Location: ../view/view_search_plan_cadre.php');
 }

?>