<?php

include_once("../model/queries.php");

if(isset($_GET['codecours']))
 {
 	$classCode = $_GET['codecours'];

 	$result = fetchInformationPlanCadre($classCode);

 	
 }