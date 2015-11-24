<?php

include_once("../model/queries.php");

if(isset($_GET['codecours']))
 {
 	$classCode = $_GET['codecours'];

 	$result = fetchInformationPlanCadre($classCode);

 	createPlanCadreCopy([0][ "CodeCours" ], [0][ "Etat" ], [0][ "Presentation_Cours" ], [0][ "Objectifs_Integration" ], [0][ "Evaluation_Apprentissage" ], 
 						[0][ "Enonce_Competences" ], [0][ "Objectifs_Apprentissage" ], [0][ "Manuel_Obligatoire" ], [0][ "Recommandation" ]);

 	updatePlanCadreState($classCode);
 }