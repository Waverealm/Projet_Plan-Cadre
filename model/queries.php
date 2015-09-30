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

  function createUser($UserName, $MotDePasse, $PasswordConfirmation, $Email)
  {
      if($UserName && $MotDePasse && $PasswordConfirmation)
      {
        $confirmcode = rand();
        $query = mysql_query("INSERT INTO utilisateurs VALUES ('$UserName','$MotDePasse','1','$confirmcode','0','$Email') ");

        $message = 
        "
          Veuillez confirmez votre Courriel 
          Clicker sur le lien en dessous pour verifier votre compte
          http://www.plancadre.com/ConfirmationDeCourriel.php?UserName=$UserName&NoUtilisateur=$confirmcode
        ";

        mail($email,"Plan-Cadre confirmation de courriel", $message, "From: DoNotReply@plancadre.com");

        echo "Merci, s'il vous plait veuillez confirmez votre adresse courriel"
      }
  }

  function SendConfirmEmail()
  {

    $UserName = $_GET['UserName'];
    $NoUtilisateur = $_GET['NoUtilisateur'];

    $query = mysql_query("SELECT * FROM 'utilisateurs' WHERE 'UserName'='$UserName'");
    while($row = mysql_fetch_assoc($query))
    {
      $db_NoUtilisateur = $row['NoUtilisateur'];
    }
    if ($NoUtilisateur == $db_NoUtilisateur) 
    {
      mysql_query("UPDATE 'utilisateur' SET 'Etat'='1' ");
      mysql_query("UPDATE 'utilisateur' SET 'NoUtilisateur'='0' ");
    }
    else
    {
      echo "Nom d'usager et le numéro d'utilisateur ne marche pas ensemble"
    }
  }


?>