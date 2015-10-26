<?php
  session_start();

  //
  include_once("../controller/interface_functions.php");
  //
  include_once("../controller/pages_access.php");
  include_once("../controller/controller_elaboration_plancadre.php");

  verifyAccessPages();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link rel="Stylesheet" href="../assets/pure.css">
        <link rel="Stylesheet" href="../assets/styles.css">
        <link rel="Stylesheet" href="../assets/others.css">

        <script type="text/javascript" src="../controller/javascript.js" ></script>

    </head>
    

    <body>


        <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>

            <br>

            <form action="../controller/controller_elaboration_plancadre.php" method="post">

                Choisir un utilisateur :
                
                <br>

                <input type="text" name="search_user" 
                onKeyUp="arrayFilter(this.value, this.form.select_user_list)" 
                onChange="arrayFilter(this.value, this.form.select_user_list)"
                >

                <select name="select_user_list" id="select_user_list">
                    <option> </option>
                    <?php
                        $array = getArrayPlanCadre();
                        for ($i = 0; $i < count($array); $i++)
                        {
                            echo $array[$i];
                        }
                    ?>
                </select>

                <br>
                <br>

                Choisir un cours :

                <br>

                <input type="text" name="search_class" 
                onKeyUp="arrayFilter(this.value, this.form.select_class_list)" 
                onChange="arrayFilter(this.value, this.form.select_class_list)"
                >

                <select name="select_class_list" id ="select_class_list">
                    <option> </option>
                    <?php
                        $array = getArrayPlanCadre();
                        for ($i = 0; $i < count($array); $i++)
                        {
                            echo $array[$i];
                        }
                    ?>
                </select>

                <br>
                <br>

                <div class="col-md-offset-2 col-md-2">
                        <input type="submit" value="Assigner le plan-cadre" class="btn btn-default" /> 
                        
                        <br>
                        <br>

                </div>

            </form>
        </div>
    </body>

</html>
