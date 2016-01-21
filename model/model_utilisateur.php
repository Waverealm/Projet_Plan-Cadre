<?php


include_once("../assets/constants.php");
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


/*
    Nom de la fonction : showUserList
    Fait par : Simon Roy
    Cette fonction permet d'afficher une liste d'utilisateur dans une liste déroulante.
    Elle prend en paramètre une liste d'utilisateur et affiche son contenu.
    
*/
function showUserList($list, $nom_liste = 'user_list')
{
    echo "<select class='field' name='".$nom_liste."' style='width: 300px' >";
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


/*
    Nom de la fonction : getListUser
    Fait par : Simon Roy
    Cette fonction retourne une liste d'utilisateur
    Elle prend en paramètre un boolean pour déterminer
    si la liste contiendra tous les utilisateurs ou seulement
    ceux que l'utilisateur peut faire des modifications.
*/
function getListUser( $all_user = false)
{
    $list = 0;
    if($all_user)
    {
        $list = fetchAllUser();
    }
    else
    {
        if ($_SESSION[ 'user_type' ] == 'Administrateur')
        {
            $list = fetchAllUser();
        }
        else if ($_SESSION[ 'user_type' ] == 'Conseiller pédagogique')
        {
            $list = fetchAllPlanners("Élaborateur");
        }
    }
    return $list;
}



function showInfoUtilisateur( $liste, $nom_tableau = "tableau_info_utilisateur" )
{
    if( !empty($liste) )
    {
        echo "<table name='$nom_tableau' id='$nom_tableau'>";
            echo "<thead>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th></th>";
        foreach ($liste as $row)
        {
                echo "<tr>
                    <td>" . $row["Nom"] . "</td>
                    <td>" . $row["Prenom"] . "</td>
                    <td>" . $row["Email"] . "</td>
                </tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "<b>Aucun utilisateur</b>";
    } 
}

/*
    Nom de la fonction : getAllUser
    Fait par : Simon Roy
    Cette fonction retourne une liste de tous les utilisateurs.
*/
function getListAllUser( $all_user = true)
{
    return fetchAllUser();;
}



