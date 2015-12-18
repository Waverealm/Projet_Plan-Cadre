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


    function showSessionMessage($errors)
    {
        // On affiche les erreurs s'il y en a
        if( isset($_SESSION[ $errors ]) )
        {
            ?>

            <script>alert("<?php echo $_SESSION[ $errors ]; ?>");</script>

            <?php

            unset($_SESSION[ $errors ]);
        }
    }