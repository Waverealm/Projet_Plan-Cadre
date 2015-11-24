<?php
$currentVisitor = 'assignuser';
$currentElaborator = 'assignuser';
$currentConseiller = 'assignuser';
$currentAdmin = 'assignuser';
  session_start();

  //
  include_once("../controller/interface_functions.php");
  //
  include_once("../controller/pages_access.php");
  include_once("../controller/controller_assign_user.php");

  verifyAccessPages();
  isPlanner();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link rel="Stylesheet" href="../assets/pure.css">
        <link rel="Stylesheet" href="../assets/styles.css">
        <link rel="Stylesheet" href="../assets/others.css">

        <script type="text/javascript" src="../assets/js_global.js" ></script>

    </head>
    

    <body>


        <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>

            <br>

            <fieldset>
                <form action="../controller/controller_assign_user.php" method="post">

                    Choisir un utilisateur :
                    
                    <br>
                    <?php
                        showUserListAll();
                    ?>

                    <input type="text" name="search_user" 
                    onKeyUp="arrayFilter(this.value, this.form.user_list_all)" 
                    onChange="arrayFilter(this.value, this.form.user_list_all)"
                    >

                    <br>
                    <br>

                    Choisir un cours :

                    <br>

                    <?php
                        showClassListAll();
                    ?>
                    
                    <input type="text" name="search_class" 
                    onKeyUp="arrayFilter(this.value, this.form.class_list_all)" 
                    onChange="arrayFilter(this.value, this.form.class_list_all)"
                    >

                    <br>
                    <br>

                    <div class="col-md-offset-2 col-md-2">
                            <input type="submit" value="Assigner le plan-cadre" class="btn btn-default" /> 
                            
                            <br>
                            <br>

                    </div>

                </form>
            </fieldset>
        </div>
    </body>

</html>

