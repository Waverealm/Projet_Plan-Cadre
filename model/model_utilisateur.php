<?php


include_once("../assets/constant.php");
include_once(REQUETES_BD);




if(!isset($_SESSION)) 
{ 
    session_start(); 
} 



/*
    Nom de la fonction : showUserListAll
    Fait par : Simon Roy
    Cette fonction permet d'afficher une liste d'utilisateur
    dans une liste déroulante. La liste d'utilisateur est obtenue par fecthAllUser
*/
function showUserListAll()
{
    if ($_SESSION[ 'user_type' ] == 'Administrateur')
    {
        $list = fetchAllUser();
    }
    else if ($_SESSION[ 'user_type' ] == 'Conseiller pédagogique')
    {
        $list = fetchAllPlanners("Élaborateur");
    }
    echo "<select class='field' name='user_list_all'>";
    if(sizeof($list) > 0)
    {
        foreach ($list as $row)
        {
            echo "<option value=\"".$row['NoUtilisateur']."\">".$row['Prenom']." ".$row['Nom']."</option>";
        }
    }
    else
    {
        echo "<option>"."Aucun utilisateur"."</option>";
    }
        
    echo "</select>";
}

