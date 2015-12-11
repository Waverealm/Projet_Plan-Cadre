<?php
  session_start();

  $currentConseiller = 'assignuser';
  $currentAdmin = 'assignuser';

  include_once("../controller/interface_functions.php");
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script>
            $(function () {
                $('#assignation input[type=radio]').change(function(){
                    if ($(this).val() == "assign" ) {
                        $( "#class_list_all" ).prop( "disabled", false );
                        $( "#search_class" ).prop( "disabled", false );
                        $( "#plan_cadre_elaboration_list" ).prop( "disabled", true );
                        $( "#plan_cadre_elaboration_list" ).val("China");
                        $( "#search_plan_cadre_elaboration" ).prop( "disabled", true );
                    }

                    else if($(this).val() == "reassign") {
                        $( "#class_list_all" ).prop( "disabled", true );
                        $( "#class_list_all" ).val("China");
                        $( "#search_class" ).prop( "disabled", true );
                        $( "#plan_cadre_elaboration_list" ).prop( "disabled", false );
                        $( "#search_plan_cadre_elaboration" ).prop( "disabled", false );
                    }
                })
            })

            $( window ).load(function() {
                $( "#plan_cadre_elaboration_list" ).prop( "disabled", true );
                $( "#search_plan_cadre_elaboration" ).prop( "disabled", true );
            });
        </script>
    </head>
    

    <body>


        <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>

            <br>

            <fieldset id="assignation">
                <legend>Assignation : </legend>
                <form action="../controller/controller_assign_user.php" method="post">

                    &nbsp &nbsp Choisir un utilisateur :
                    
                    <br>

                    &nbsp &nbsp
                    <?php
                        showUserListAll();
                    ?>

                    <input type="text" name="search_user" 
                    onKeyUp="arrayFilter(this.value, this.form.user_list_all)" 
                    onChange="arrayFilter(this.value, this.form.user_list_all)"
                    >

                    <br>
                    <br>

                    &nbsp &nbsp 
                    Assigner l'utilisateur à l'élaboration d'un nouveau plan-cadre pour le cours sélectionné :

                    <br>
                    <input type="radio" name ="choix" value="assign" checked="checked"> 
                    <?php
                        showClassListAll();
                    ?>
                    <input type="text" name="search_class" id="search_class"
                    onKeyUp="arrayFilter(this.value, this.form.class_list_all)" 
                    onChange="arrayFilter(this.value, this.form.class_list_all)">

                    <br>
                    <br>

                    &nbsp &nbsp
                    Assigner l'utilisateur à l'élaboration d'un plan-cadre existant :
                    <br>
                    <input type="radio" name ="choix" value="reassign" > 
                    <?php
                        showPlanCadreElaboration();
                    ?>
                    <input type="text" name="search_plan_cadre_elaboration" id="search_plan_cadre_elaboration"
                    onKeyUp="arrayFilter(this.value, this.form.plan_cadre_elaboration_list)" 
                    onChange="arrayFilter(this.value, this.form.plan_cadre_elaboration_list)">

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

