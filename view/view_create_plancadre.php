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
include_once("../controller/controller_create_plancadre.php");

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

    if( isset($_SESSION['id_plancadre']) )
    {
        $plancadre = getPlanCadre($_SESSION['id_plancadre']);
        $prealable = getPrealableCours($plancadre[0]["CodeCours"]);

        $save_path = "../plancadre/". $plancadre[0]['VersionPlan'] . "_" . $plancadre[0]['CodeCours'] . "_";

        $path_presentation = $save_path . "presentation" . ".txt";
        $path_integration = $save_path . "integration" .".txt";
        $path_evalutation = $save_path . "evaluation" . ".txt";
        $path_competences = $save_path . "competences" . ".txt";
        $path_apprentissage = $save_path . "apprentissage" . ".txt";

    }
    ?>

    </br>

    <fieldset>
        <legend>Creation Plan-Cadre</legend>
        </br>

        <form action="../controller/controller_create_plancadre.php" method="post">
            
            <input type='hidden' name='save_path' value = 
                <?php 
                    // le nom des fichiers textes serra :
                    // clé primaire du plancadre + code ou le nom du cours + le nom de la section
                    // exemple : 2_420-EDA-05_PresentationCours.txt
                    echo '\'' . $save_path . '\''; 
                ?> 
            />
            <input type='hidden' name='id_plancadre' value = 
                <?php 
                    echo '\'' . $_SESSION['id_plancadre'] . '\''; 
                ?> 
            />  

            <TABLE>
                <tr>
                    <td>
                        <label class="control-label col-md-2">
                            Titre du cours : 
                            <?php
                                echo $plancadre[0]["NomCours"];
                            ?>
                        </label>
                    </td>
                    <td>
                        <label class="control-label col-md-2">
                            Numero du cours : 
                            <?php
                                echo $plancadre[0]["CodeCours"];
                            ?>
                        </label>
                    </td>
                    <td>
                        <label class="control-label col-md-2">
                            Programme : 
                            <?php
                                echo $plancadre[0]["CodeProgramme"] . " " . $plancadre[0]["NomProgramme"];
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="control-label col-md-2">
                            Pondération : 
                            <?php
                                echo $plancadre[0]["Ponderation"];
                            ?>
                        </label>
                    </td>
                    <td>
                        <label class="control-label col-md-2">
                            Nombre d'unité(s) : 
                            <?php
                                echo $plancadre[0]["NombreUnites"];
                            ?>
                        </label>
                    </td>
                    <td>
                        <label class="control-label col-md-2">
                            Préalable(s) : 
                            <?php

                                //faire une fonction
                                // select
                                // if hasrow codecours + titre cours
                                // else "Aucun"

                                if(!empty($prealable) )
                                {
                                    for ($i = 0; $i < count($prealable); $i++)
                                    {
                                        echo 
                                        "<ul>
                                            <li>" 
                                                . $prealable[0]["Cours_CodeCoursPrealable"] 
                                                . " " . $prealable[0]["NomCours"] .
                                            "li>
                                        <ul>";

                                    }
                                }
                                else
                                {
                                    echo "Aucun";
                                }
                            ?>
                        </label>
                    </td>
                </tr>
            </TABLE>

            </br>

            <label class="control-label col-md-2">Type d'enseignement : </label>
            </br>
            <select>
                <option value="Enseignement regulier">Enseignement regulier </option>
                <option value="Formation continue">Formation continue </option>
            </select>
            </br>
            </br>

            <label class="control-label col-md-2">Presentation du cours : </label>
            </br>
            <div class="col-md-10">
                <textarea name="Presentation" rows="12" cols="50">
                    <?php
                        $handle = fopen($path_presentation, "rb");
                        $text = fread($handle, filesize($path_presentation));
                    ?>
                </textarea>
            </div>
            </br>

            <label class="control-label col-md-2">Objectifs d'integration : </label>
            </br>
            <div class="col-md-10">
                <textarea name="ObjectifsIntegration" rows="12" cols="50">
                    <?php
                        $handle = fopen($path_integration, "rb");
                        $text = fread($handle, filesize($path_integration));
                        //fclose($handle);

                    ?>
                </textarea>
            </div>
            </br>

            <label class="control-label col-md-2">Evaluation des apprentissage : </label>
            </br>
            <div class="col-md-10">
                <textarea name="Evaluation" rows="12" cols="50">
                    <?php
                        $handle = fopen($path_evalutation, "rb");
                        $text = fread($handle, filesize($path_evalutation));
                        //fclose($handle);
                    ?>
                </textarea>
            </div>
            </br>

            <label class="control-label col-md-2">Énoncé des compétences : </label>
            </br>
            <div class="col-md-10">
                <textarea name="Competences" rows="12" cols="50">
                    <?php
                        $handle = fopen($path_competences, "rb");
                        $text = fread($handle, filesize($path_competences));
                        //fclose($handle);
                    ?>
                </textarea>
            </div>
            </br>

            <label class="control-label col-md-2">Objectifs d'apprentissage : </label>
            </br>
            <div class="col-md-10">
                <textarea name="ObjectifsApprentissage" rows="12" cols="50">
                    <?php
                        $handle = fopen($path_apprentissage, "rb");
                        $text = fread($handle, filesize($path_apprentissage));
                        //fclose($handle);
                    ?>
                </textarea>
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


