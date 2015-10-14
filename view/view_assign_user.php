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
    </head>
    <script type="text/javascript">

        // Author: Justin Whitford
        // Source: www.evolt.org
        // http://evolt.org/node/55035/

        /*
            CBX_Filter(filter, list)
            filter : est une chaine de charactère qui va servir de filtre
            list : est une référence à un objet de type select (ComboBox)

            La liste est réorganisée pour que les éléments qui contiennent le filtre se retrouvent
            en haut de la liste.

            exemple : <input type="text" name="uneZoneTexte" onchange="CBX_filter(this.value, this.form.CBX_nom)">
            <select name="CBX_select">
            <option></option>
            <option value="valeurVoulue" ><*option>
        */
        function CBX_Filter(filter, list)
        {
            //si on n'a pas déjà un backup de la liste
            //en faire un maintenant
            if(!list.backUp)
            {
                list.backUp = new Array();
                for(i = 0; i < list.length; i++)
                {
                    list.backUp[list.backUp.length] = new Array(list[i].value, list[i].text);
                }
            }
            match = new Array();
            nomatch = new Array();

            for(i = 0; i < list.backUp.length; i++)
            {
                if(list.backUp[i][1].toLowerCase().indexOf(filter.toLowerCase()) != -1)
                {
                    // ajouter l'élément à la fin de l'array
                    match[match.length] = new Array(list.backUp[i][0], list.backUp[i][1]);
                }
                else
                {
                    nomatch[nomatch.length] = new Array(list.backUp[i][0], list.backUp[i][1]);
                }
            }

            // ajoute les éléments qui contiennent le filtre en premier
            for(i = 0; i < list.backUp.length; i++)
            {
                list[i].value = match[n][0];
                list[i].text = match[n][1];
            }
            // ajoute les éléments qui ne contiennent pas le filtre après ceux qui le contiennent
            for(i = 0; i < nomatch.length; i++)
            {
                list[i+match.length].value = nomatch[n][0];
                list[i+match.length].text = nomatch[n][1];
            }

            //pour qu'on voit immédiatement que la liste a été modifiée lorsqu'on utilise le filtre
            list.selectedIndex = 0;
        }

    </script>

    <body>


        <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>

            </br>

            Choisir un utilisateur :
            </br>

            <input name=""></input>

            <select name="CBX_ListeCours">
                <?php
                    $array = fillComboBoxUser();
                    for ($i = 0; $i < count($array); $i++)
                    {
                        echo $array[$i];
                    }
                ?>
            </select>

            </br>
            <!-- Trouver une solution pour faire de l'espace -->
            </br>

            Choisir un plan-cadre :

            </br>

            <input></input>

            <select>
            </select>


            </br>

            <div class="col-md-offset-2 col-md-2">
                        <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
            </div>

        </div>
    </body>

</html>

