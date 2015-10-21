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


				//si on n'a pas déjà un backup de la liste
				//en faire un maintenant
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

                            <input class="text-box single-line" data-val="true" 
                            data-val-length="Le champ Nom d&#39;usager doit être une chaîne dont la longueur maximale est de 20 caractères." 
                            data-val-length-max="50" data-val-regex="Caractères illégaux." 
                            data-val-regex-pattern="^((?!^Name$)[-a-zA-Z0-9àâäçèêëéìîïòôöùûüÿñÀÂÄÇÈÊËÉÌÎÏÒÔÖÙÛÜ_])+$" 
                            data-val-required="Le champ Nom d&#39;usager est requis." 
                            id="UserName" name="UserName" type="text" 
                            value="<?php if (isset($_SESSION[ 'username' ])) echo htmlentities(trim($_SESSION[ 'username' ])); ?>" 
                            />


                <input type="text" name="search_user" onKeyUp="arrayFilter(this.value, this.form.select_userList)" onChange="arrayFilter(this.value, this.form.select_userList)">

                <select name="select_userList">
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

                Choisir un plan-cadre :

                <br>

                <input type="text" name="search_course" onKeyUp="arrayFilter(this.value, this.form.select_course_list)" onChange="arrayFilter(this.value, this.form.select_course_list)">
                <select name="select_course_list">
                    <option> </option>
                    <?php
                    //répétition de code ...
                        $array = getArrayCourse();
                        for ($i = 0; $i < count($array); $i++)
                        {
                            echo $array[$i];
                        }
                    ?>
                </select>


                <br>

                <div class="col-md-offset-2 col-md-2">
                        <input type="submit" value="Soumettre..." class="btn btn-default" /> 
                        
                        <br>
                        <br>

                </div>

            </form>
        </div>
    </body>

</html>

