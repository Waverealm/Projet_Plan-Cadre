<?php
    // SI ON ACCÈDE À CETTE PAGE EN RENTRANT À LA MAIN L'ADRESSE DANS LE NAVIGATEUR,
    // PLUSIEURS ERREURS PHP SON GÉNÉRÉES, IL FAUT EMPÊCHE L'ACCÈS À LA PAGE SI
    // ON L'ENTRE À LA MAIN

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    include_once("../assets/constants.php");
    include_once( MODEL_PAGE );
    include_once( CONTROLLER_CREATE_PLANCADRE );
    include_once( MODEL_PAGE_ACCESS );
    include_once( REQUETES_BD );
    
    
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

    <style>
        .toggler{
            color: #3561E1;
        }
    </style>
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

    <br>

    <fieldset>
        <legend>Création Plan-Cadre</legend>
        <br>
        <form action="../controller/controller_create_plancadre.php" method="post">
            
            <!-- bouton pour pouvoir tester sans avoir à scroll down >
            <input name="save" type="submit" value="Sauvegarder..." class="btn btn-default" />
            <!-- enlever après la phase de test -->

            <!-- ajouter un bouton sauvegarder ici -->


            <input type='hidden' name='save_path' value =' 
                <?php 
                    // le nom des fichiers textes serra :
                    // clé primaire du plancadre + code ou le nom du cours + le titre de la section
                    // exemple : 2_420-EDA-05_PresentationCours.txt
                    echo $save_path; 
                ?>' 
            />
            <input type='hidden' name='id_plancadre' value = 
                <?php 
                    echo '\'' . $_SESSION['id_plancadre'] . '\''; 
                ?> 
            />  
            <input type='hidden' name='TypeEnseignement' value = 
                <?php 
                    echo '\'' . $plancadre[0]["TypeCours"] . '\''; 
                ?> 
            />
            <div>
                Programme :
                <br>
                <?php
                    $programme = $plancadre[0]["NomProgramme"] . " " 
                     .  "(" . $plancadre[0]["CodeProgramme"] . ")";
                    echo $programme;
                ?>
                <input type="hidden" name="Programme" value="<?php echo $programme; ?>">
            </div>
            <TABLE>
                <tr>
                    <td>
                        Discipline :
                        <br>
                        <?php
                        
                        // ajouter Discipline du cours 
                        
                        ?>
                    </td>
                    <td>
                        Titre du cours : 
                        <br> 
                        <?php
                            $nomCours = $plancadre[0]["NomCours"];
                            echo  $nomCours;
                        ?>
                        <input type="hidden" name="NomCours" value="Titre du cours : <?php echo $nomCours; ?>">
                    </td>
                    <td>
                        Code du cours : 
                        <br>
                        <?php
                            $codeCours = $plancadre[0]["CodeCours"];
                            echo  $codeCours;
                        ?>
                        <input type="hidden" name="CodeCours" value="Numéro du cours : <?php echo $codeCours; ?>">
                    </td>

                </tr>
                <tr>
                    <td>
                        Pondération :
                        <br>
                        <?php
                            $ponderation = $plancadre[0]["Ponderation"];
                            echo $ponderation;
                        ?>
                        <input type="hidden" name="Ponderation" value="Pondération : <?php echo $ponderation; ?>">

                    </td>
                    <td>
                        Nombre d'unité(s) : 
                        <br>
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
                        <input type="hidden" name="NombreUnites" value="Nombre d'unité(s) : <?php echo $nb_unites; ?>">
                    </td>
                    <td>
                        Préalable(s) :
                        <br>
                        <?php
                        $prealables = "";
                        if(!empty($prealable) )
                        {
                            for ($i = 0; $i < count($prealable); $i++)
                            {
                                $prealables .=
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
                            $prealables = "Aucun";
                        }
                        echo $prealables;
                        ?>
                        <input type="hidden" name="Prealables" value="Préalable(s) : <?php echo $prealables; ?>">
                    </td>
                </tr>
            </TABLE>

            <br>

            <label class="control-label col-md-2">Type d'enseignement : </label>
            <br>
            <select>
                <option value="Enseignement regulier">Enseignement regulier </option>
                <option value="Formation continue">Formation continue </option>
            </select>
            <br>
            <br>

            <?php showInstructionToggle('1'); ?>
            <label class="control-label col-md-2">Presentation du cours : </label>
            <br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="Presentation" rows="12" cols="50"><?php echo readFrom($path_presentation);
                    ?></textarea>
            </div>
            <br>

            <?php showInstructionToggle('2'); ?>
            <label class="control-label col-md-2">Objectifs d'integration : </label>
            <br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="ObjectifsIntegration" rows="12" cols="50"><?php
                        echo readFrom($path_integration); 
                    ?>
                </textarea>
            </div>
            <br>

            <?php showInstructionToggle('3'); ?>
            <label class="control-label col-md-2">Evaluation des apprentissages : </label>
            <br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="Evaluation" rows="12" cols="50"><?php
                        echo readFrom($path_evalutation);
                    ?>
                </textarea>
            </div>
            <br>

            <?php showInstructionToggle('4'); ?>
            <label class="control-label col-md-2">Énoncé des compétences : </label>
            <br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="EnonceCompetences" rows="12" cols="50"><?php
                        echo readFrom($path_competences);
                    ?>
                </textarea>
            </div>
            <br>

            <label class="control-label col-md-2">Objectifs d'apprentissage : </label>
            <br>
            <div class="col-md-10">
                <textarea class="ckeditor" name="ObjectifsApprentissage" rows="12" cols="50"><?php
                        echo readFrom($path_apprentissage);
                    ?>
                </textarea>
            </div>
            <br>

            <div class="col-md-offset-2 col-md-2">
                <input name="save" type="submit" value="Sauvegarder..." class="btn btn-default" />
            </div>

        </form>
    </fieldset>
</div>
</body>
</html>


