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
    isAdmin();
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <link rel="Stylesheet" href="../assets/pure.css">
    <link rel="Stylesheet" href="../assets/styles.css">
    <link rel="Stylesheet" href="../assets/others.css">

    <script type="text/javascript" src="../assets/js_global.js" ></script>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('a.toggler').click(function(){
                $(this).next('.toggled').toggle(500);
            });
        });

    </script>
</head>
<body>
<div class="container">
    <?php
    showHeader();
    showAppropriateMenu();

    if( isset($_SESSION['id_plancadre']) )
    {
        $plancadre = getPlanCadre($_SESSION['id_plancadre']);
        $prealable = getPrealableCours($plancadre[0]["CodeCours"]);

        $save_path = "../plancadre/". $plancadre[0]['No_PlanCadre'] . "_" . $plancadre[0]['CodeCours'] . "_";

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
            
            <!-- bouton pour pouvoir tester sans avoir à scroll down -->
            <input name="save" type="submit" value="Sauvegarder..." class="btn btn-default" />
            <!-- enlever après la phase de test -->

            <input type='hidden' name='save_path' value = 
                <?php 
                    // le nom des fichiers textes serra :
                    // clé primaire du plancadre + code ou le nom du cours + le titre de la section
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
                        <input type="hidden" name="NomCours" value="Titre du cours :">
                        Titre du cours :
                            <?php
                                echo $plancadre[0]["NomCours"];
                            ?>
                        </label>
                    </td>
                    <td>
                        <input type="hidden" name="CodeCours" value="Numero du cours :">
                            Numero du cours : 
                            <?php
                                echo $plancadre[0]["CodeCours"];
                            ?>
                        </label>
                    </td>
                    <td>
                        <input type="hidden" name="Programme" value="Programme :">
                            Programme : 
                            <?php
                                echo $plancadre[0]["CodeProgramme"] . " " . $plancadre[0]["NomProgramme"];
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="Ponderation" value="Pondération :">
                            Pondération : 
                            <?php
                                echo $plancadre[0]["Ponderation"];
                            ?>
                        </label>
                    </td>
                    <td>
                        Nombre d'unité(s) : 
                            <?php
                                $nb_unites = $plancadre[0]["NombreUnites"];
                                
                                $entier = floor($nb_unites);
                                $decimale = $nb_unites - $entier;
                                if($decimale > 0)
                                {
                                    $nb_unites = $nb_unites;
                                }
                                else
                                {
                                    $nb_unites = $entier;
                                }
                                echo $nb_unites;
                            ?>
                        <input type="hidden" name="NombreUnites" value="Nombre d'unité(s) :<?php echo $nb_unites ?>">
                        </label>
                    </td>
                    <td>
                        <input type="hidden" name="Prealables" value="Préalable(s) :">
                            Préalable(s) : 
                            <?php

                                if(!empty($prealable) )
                                {
                                    for ($i = 0; $i < count($prealable); $i++)
                                    {
                                        echo 
                                        "<ul>"
                                            ."<li>"
                                                . $prealable[0]["Cours_CodeCoursPrealable"] 
                                                . " " . $prealable[0]["NomCours"]
                                            ."li>"
                                        ."<ul>";
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

            <?php showInstructionToggle('1'); ?>
            <label class="control-label col-md-2">Presentation du cours : </label>
            </br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="Presentation" rows="12" cols="50"><?php echo readFrom($path_presentation);
                    ?></textarea>
            </div>
            </br>

            <?php showInstructionToggle('2'); ?>
            <label class="control-label col-md-2">Objectifs d'integration : </label>
            </br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="ObjectifsIntegration" rows="12" cols="50"><?php
                        echo readFrom($path_integration); 
                    ?>
                </textarea>
            </div>
            </br>

            <?php showInstructionToggle('3'); ?>
            <label class="control-label col-md-2">Evaluation des apprentissage : </label>
            </br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="Evaluation" rows="12" cols="50"><?php
                        echo readFrom($path_evalutation);
                    ?>
                </textarea>
            </div>
            </br>

            <?php showInstructionToggle('4'); ?>
            <label class="control-label col-md-2">Énoncé des compétences : </label>
            </br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="Competences" rows="12" cols="50"><?php
                        echo readFrom($path_competences);
                    ?>
                </textarea>
            </div>
            </br>

            <label class="control-label col-md-2">Objectifs d'apprentissage : </label>
            </br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="ObjectifsApprentissage" rows="12" cols="50"><?php
                        echo readFrom($path_apprentissage);
                    ?>
                </textarea>
            </div>
            </br>

            <div class="col-md-offset-2 col-md-2">
                <input name="submit" type="submit" value="Soumettre..." class="btn btn-default" />
                <input name="save" type="submit" value="Sauvegarder..." class="btn btn-default" />
            </div>

        </form>
    </fieldset>
</div>
</div>
</body>
</html>


