<?php

  function dbConnect() 
  {
     try
     {
       return new PDO('mysql:host=localhost;dbname=plancadre', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
     }
     catch (Exception $e)
     {
      die('Erreur : ' . $e->getMessage());
     }
  }

    function createUser($bdd, $email, $last_name, $first_name, $pass, $user_type)
  {
        $query = $bdd->prepare("CALL INSERT_USER(?,?,?,?,?)");

        $query->bindParam(1, $email, PDO::PARAM_STR);
        $query->bindParam(2, $last_name, PDO::PARAM_STR);
        $query->bindParam(3, $first_name, PDO::PARAM_STR);
        $query->bindParam(4, $pass, PDO::PARAM_STR);
        $query->bindParam(5, $user_type, PDO::PARAM_STR);

        $query->execute();
        $query->CloseCursor();
  }

?>