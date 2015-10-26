<?php
/**
 * Created by PhpStorm.
 * User: 201087112//AntoineLatendresse
 * Date: 2015-10-21
 * Time: 10:48
 */
session_start();

include_once("../controller/interface_functions.php");
include_once("../controller/pages_access.php");

verifyAccessPages();
?>

<!DOCTYPE html>
<html>
<body>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <link rel="Stylesheet" href="../assets/pure.css">
    <link rel="Stylesheet" href="../assets/styles.css">
    <link rel="Stylesheet" href="../assets/others.css">
</head>
<div class="container">
    <?php
    showHeader();
    showAppropriateMenu();
    ?>

    </br>

    <fieldset>
        <legend>Creation Plan-Cadre</legend>
        </br>

        <form action="../controller/controller_create_plancadre.php" method="post">

            <label class="control-label col-md-2">Nom de la sauvergarde :</label>
            </br>
            <div class="col-md-10">
                <input id="sauvergarde" name="sauvergarde" type="text" value="" class="text-box single-line" " />
            </div>
            </br>

            <label class="control-label col-md-2">Numero du cours :</label>
            </br>
            <div class="col-md-10">
                <input id="NumeroDeCours" name="NumeroDeCours" type="text" value="" class="text-box single-line" " />
            </div>
            </br>

            <label class="control-label col-md-2">Type d'enseignement :</label>
            </br>
            <select>
                <option value="Enseignement regulier">Enseignement regulier</option>
                <option value="Formation continue">Formation continue</option>
            </select>
            </br>
            </br>

            <label class="control-label col-md-2">Presentation du cours :</label>
            </br>
            <div class="col-md-10">
                <textarea name="Presentation" rows="12" cols="50"></textarea>
            </div>
            </br>

            <label class="control-label col-md-2">Objectifs d'integration :</label>
            </br>
            <div class="col-md-10">
                <textarea name="Objectifs" rows="6" cols="50"></textarea>
            </div>
            </br>

            <label class="control-label col-md-2">Evaluation des apprentissage :</label>
            </br>
            <div class="col-md-10">
                <textarea name="Evaluation" rows="12" cols="50"></textarea>
            </div>
            </br>

            <label class="control-label col-md-2">Objectifs d'apprentissage :</label>
            </br>
            <div class="col-md-10">
                <textarea name="ObjectifsApprentissage" rows="12" cols="50"></textarea>
            </div>
            </br>

            <div class="col-md-offset-2 col-md-2">
                <input name="submit" type="submit" value="Soumettre..." class="btn btn-default" />
                <input name="save" type="submit" value="Sauvegarder..." class="btn btn-default" />
                <input name="open" type="submit" value="Ouvrir..." class="btn btn-default" />
            </div>

        </form>
    </fieldset>
</div>
</div>
</body>
</html>


