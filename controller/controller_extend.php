<?php

include_once("../model/queries.php");


if(!isset($_SESSION)) 
{
    session_start(); 
}

if(isset($_SESSION[ "connected" ]))
{
    if(isset($_SESSION[ "id_plancadre" ]))
    {
        $pdo = dbConnect();
     
        $pdo->beginTransaction();
        
        $updating = $pdo->prepare('CALL PLANCADRES_UPDATE_UPDATING(?,?)');
        
        $updating->bindParam(1, $_SESSION['id_plancadre'], PDO::PARAM_STR);
        $i = 1;
        $updating->bindParam(2, $i, PDO::PARAM_STR);
        
        $updating->execute();
        $pdo->commit();
    }
}
