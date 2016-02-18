<?php

class PDOQuery {
	protected $_dbHandle;
	protected $_dbHandle;
    protected $_result;
	protected $_query;
	protected $_table;
	protected $_describe = array();

	protected $_orderBy;
	protected $_order;
	protected $_extraConditions;
	protected $_hO;
	protected $_hM;
	protected $_hMABTM;
	protected $_page;
	protected $_limit;
	
	function dbConnect($host = "localhost", $name = "projet_plan-cadre", $user = "root", $pass = "")
	{
		try
		{
		  $connexion = new PDO('mysql:host=' . $host . ';dbname=' . $name,  $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		  $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		  return $connexion;
		}
		catch (Exception $erreur)
		{
		  die('Erreur : ' . $erreur->getMessage());
		}
	}
	
	
	
	
	
	
	
	
/* 
  Nom de la fonction : selectWithNoParam($call_select)
  Fait par Simon Roy
  Prend un string en paramètre, le string représente une procédure stockée 
  dans la base de données qui serra éxécutée. La valeur de retour est un 
  array qui contient le résultat du select.

  Cette fonction ne devrait être utilisée pour éxécuter autre chose 
  que des selects.
*/
  function selectWithNoParam($call_select)
  {
    $query = dbConnect()->prepare($call_select);

    $query->execute();

    $result = $query->fetchAll();
    $query->closeCursor();

    return $result;
  }
  
  
  
/*
    Nom de la fonction : fetchId($id, $call_select)
    Fait par Simon Roy
    Prend un string en paramètre, le string représente une procédure stockée 
    dans la base de données qui serra éxécutée. La variable id est pour limiter
    la recherche à l'identifiant choisi.

    La valeur de retour est un array qui contient le résultat du select.
*/

  function fetchId($id, $call_select)
  {
    $query = dbConnect()->prepare($call_select);

    $query->bindParam(1, $id, PDO::PARAM_STR);

    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();

    return $result;
  }
  
  
}