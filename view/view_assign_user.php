<?php
  session_start();

  include_once("../controller/interface_functions.php");
  include_once("../controller/pages_access.php");
  include_once("../controller/controller_assign_user.php");

  verifyAccessPages();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="Stylesheet" href="../assets/pure.css">
        <link rel="Stylesheet" href="../assets/styles.css">
        <link rel="Stylesheet" href="../assets/others.css">


        <script type="text/javascript">

        // Author: Justin Whitford
        // Source: www.evolt.org
        // http://evolt.org/node/55035/

        /*
            arrayFilter(search, list)
            search : est une chaine de charactère qui va servir de filtre
            list : est une référence à un objet de type select (ComboBox)

            La liste est réorganisée pour que les éléments qui contiennent le filtre se retrouvent
            en haut de la liste.
			Il est suggérer de l'utiliser pour un select avec un input
            exemple : <input type="text" name="uneZoneTexte" onchange="arrayFilter(this.value, this.form.CBX_nom)"
			onKeyUp ="arrayFilter(this.value, this.form.CBX_nom)">
            <select name="selectName">
            <option></option>
            <option value="valeurVoulue" ><*option>
        */
			function arrayFilter(search, list){

                // si un backup de la liste n'existe pas on en fait un maintenant
				if (!list.backUp){

					list.backUp = new Array();

					for (n=0;n<list.length;n++){

						list.backUp[list.backUp.length] = new Array(list[n].value, list[n].text);
					}
				}

				match = new Array();

				nomatch = new Array();

				for (n=0;n<list.backUp.length;n++){

					if(list.backUp[n][1].toLowerCase().indexOf(search.toLowerCase())!=-1){

						// ajouter l'élément à la fin de l'array
						match[match.length] = new Array(list.backUp[n][0], list.backUp[n][1]);

					}else{

						nomatch[nomatch.length] = new Array(list.backUp[n][0], list.backUp[n][1]);
					}
				}


				// ajouter les éléments qui contiennent le filtre en premier
				for (n=0;n<match.length;n++){

					list[n].value = match[n][0];

					list[n].text = match[n][1];
				}

				  // ajouter les éléments qui ne contiennent pas le filtre après ceux qui le contiennent
				  for (n=0;n<nomatch.length;n++){

					list[n+match.length].value = nomatch[n][0];

					list[n+match.length].text = nomatch[n][1];
				  }

				//pour qu'on voit immédiatement que la liste a été modifiée et que le filtre a été utilisé
				list.selectedIndex=0;
			}

        </script>
    </head>
    

    <body>


        <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>

            <br>

            <form action="../controller/controller_assign_user.php" method="post">

                Choisir un utilisateur :
                
                <br>

                <input type="text" name="search_user" 
                onKeyUp="arrayFilter(this.value, this.form.select_user_list)" 
                onChange="arrayFilter(this.value, this.form.select_user_list)"
                >

                <select name="select_user_list" id="select_user_list">
                    <!-- on peut enlever l'option vide dans la version finale
                         pour le moment ça aide avec les tests
                    -->
                    <option> </option>
                    <?php
                        $array = getArrayUser();
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
                    //répétition de code ...
                        $array = getArrayClass();
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

