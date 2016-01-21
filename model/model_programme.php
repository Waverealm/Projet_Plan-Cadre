<?php
/*
	---------------------------------------------------------------------------
	nom du fichier : model_programme.php
	Ce fichier contient 
	

	---------------------------------------------------------------------------
*/


    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	include_once(REQUETES_BD);


	// function temporaire
	// à garder en attendant de pouvoir la remplacer correctement
	function showProgramListAll()
    {
        $list = selectAllPrograms();

        echo "<form action='../controller/controller_save_program_code.php' method='post'>";
            echo "<select name=\"CodeProgramme\" id=\"CodeProgramme\" style='width: 300px'>";
                echo "<option value='Tous' ".isSelected('Tous').">Afficher tous les plans-cadre</option>";
            if(sizeof($list) > 0)
            {
                foreach ($list as $row)
                {
                    echo "<option value=\"".$row['CodeProgramme']."\" ".isSelected($row['CodeProgramme']).">".$row['CodeProgramme']. " " . $row['NomProgramme']  ."</option>";
                }
            }
            else
            {
                echo "<option>"."Aucun Programme"."</option>";
            }
            echo "</select>";

            echo "<input type='submit' value='Rechercher'>";
        echo "</form>";
    }

	function showListPrograms()
    {
        $list = selectAllPrograms();

        echo '<select name="CodeProgramme">';
            echo '<option value="">' . '</option>';
        foreach ($list as $row)
        {
            echo '<option value="'.$row['CodeProgramme'].'">'.$row['CodeProgramme']. ' ' .$row['NomProgramme']. '</option>';
        }
        echo "</select>";
    }



	function showListProgramsWithSelected()
    {
        $list = selectAllPrograms();
        echo '<select name="program_list_all">';
            echo '<option value="">' . '</option>';
        foreach ($list as $row)
        {
            if(isset($_SESSION["selected_CodeProgramme"]))
            {
                if($row["CodeProgramme"] == $_SESSION["selected_CodeProgramme"])
                {
                    echo '<option selected value="'.$row['CodeProgramme'].'">'.$row['CodeProgramme']. ' ' .$row['NomProgramme']. '</option>';
                    unset($_SESSION["selected_CodeProgramme"]);
                }
                else
                {
                    echo '<option value="'.$row['CodeProgramme'].'">'.$row['CodeProgramme']. ' ' .$row['NomProgramme']. '</option>';
                }
            }
            else
            {
                echo '<option value="'.$row['CodeProgramme'].'">'.$row['CodeProgramme']. ' ' .$row['NomProgramme']. '</option>';
            }
        }

           echo "</select>";
    }