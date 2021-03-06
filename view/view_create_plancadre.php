<?php
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
    
    if( !isset($_SESSION['id_plancadre']) )
    {
        header("Location: " . VIEW_ELABORATION_PLANCADRE);
    }
    
    date_default_timezone_set('EST');
    
    $pdo = dbConnect();
     
    $pdo->beginTransaction();
    
    $query_datemodification = $pdo->prepare('CALL PLANCADRES_SELECT_DATEMODIFICATION(?)');
    
    $query_datemodification->bindParam(1, $_SESSION['id_plancadre'], PDO::PARAM_STR);
    
    $query_datemodification->execute();
    
    $result = $query_datemodification->fetchAll();
    
    $query_datemodification->closeCursor();
    
    
    if( ( strtotime( $result[0]['datemodification'] ) >= strtotime(date('Y-m-d H:i:s')) ) )
    {
        $pdo->rollback();
        $updating = false;
    }
    else
    {
        $_SESSION['plancadre_datemodification'] =  $result[0]['datemodification'];
        
        $updating = $pdo->prepare('CALL PLANCADRES_UPDATE_UPDATING(?,?)');
        
        $updating->bindParam(1, $_SESSION['id_plancadre'], PDO::PARAM_STR);
        $i = 1;
        $updating->bindParam(2, $i, PDO::PARAM_STR);
        
        $updating->execute();
        $pdo->commit();
        $updating = true;
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <link rel="Stylesheet" href="../assets/pure.css">
    <link rel="Stylesheet" href="../assets/styles.css">
    <link rel="Stylesheet" href="../assets/others.css">

    <script type="text/javascript" src="../assets/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../assets/js_global.js" ></script>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('a.toggler').click(function(){
                $(this).next('.toggled').toggle(500);
            });
        });
        
        var nb_sections = 0
        
        $(document).ready(function () {
            $(document).on("click", ".ajouter_section", function () {
                
                var nouvelle_section = document.createElement('DIV');
                nouvelle_section.setAttribute( 'id', 'section_' + (++nb_sections) );
                var section_id = nouvelle_section.id;
                nouvelle_section.name = 'nouvelle_section';
                
                var label = document.createElement('label');
                label.innerHTML = "Titre de la section : ";
                nouvelle_section.appendChild(label);
                
                
                var titre = document.createElement('input');
                titre.id = 'new_titre_' + nb_sections;
                // [] permet à php d'en faire un tableau lors d'un post
                titre.name = 'new_titres[]';
                titre.type = 'text';
                //titre.required = true;
                titre.maxLength = 100;
                
                nouvelle_section.appendChild(titre);
                
                var supprimer = document.createElement('button');
                supprimer.className = 'enlever_nouvelle_section';
                // si on veut ajouter plus d'une classe
                //supprimer.classList.add('enlever_section_temporaire');
                supprimer.type = 'button';
                supprimer.value = 'test';
                supprimer.innerHTML = 'Enlever et ne pas sauvegarder cette section'; 
                
                nouvelle_section.appendChild(supprimer);
                
                // fin de la ligne
                nouvelle_section.appendChild(document.createElement('br'));
                nouvelle_section.appendChild(document.createElement('br'));
                // permet au textarea d'être en dessous du titre
                
                var texte = document.createElement('textarea');
                texte.id = 'new_texte_' + nb_sections;
                texte.name = 'new_textes[]';
                //texte.class = 'ckeditor';
                
                nouvelle_section.appendChild(texte);
                // espace supplémentaire
                nouvelle_section.appendChild(document.createElement('br'));
                
                
                document.getElementById('nouvelles_sections').appendChild(nouvelle_section);
                
                // rien n'est affiché avec la fonction si CKEDITOR.replace() est avant appendChild(nouvelle_section)
                CKEDITOR.replace('new_texte_' + nb_sections);
                
                return false;
            });
        });
        $(document).ready(function(){
             $(document).on("click", ".enlever_nouvelle_section", function (event) {
                $(this).parent('div').remove();
                return false;
             });
        });
        $(document).ready(function(){
             $(document).on("click", ".enleverSection", function () {
                
                var note_effacer = document.createElement('input');
                note_effacer.type = 'hidden';
                note_effacer.name = 'sections_effacer[]';
                note_effacer.value = this.value;
                
                document.getElementById('effacer_sections').appendChild(note_effacer);
                
                $(this).parent('div').remove();
                return false;
             });
        });
    </script>
    <script>
      // Ressource : http://www.alessioatzeni.com/blog/simple-tooltip-with-jquery-only-text/
      $(document).ready(function() {
        // Tooltip only Text
        $('.masterTooltip').hover(function(){
            if ( !this.clicked)
                {
                    // Hover over code
                    var title = $(this).attr('title');
                    $(this).data('tipText', title).removeAttr('title');
                    $('<p class="tooltip"></p>')
                    .text(title)
                    .appendTo('body')
                    .fadeIn('slow');
                }
                
        }, function() {
                if ( !this.clicked)
                {
                    // Hover out code
                    $(this).attr('title', $(this).data('tipText'));
                    $('.tooltip').remove();
                }
                
        }).mousemove(function(e) {
                var mousex = e.pageX + 20; //Get X coordinates
                var mousey = e.pageY - 40; //Get Y coordinates
                $('.tooltip')
                .css({ top: mousey, left: mousex })
        });
        $(document).on("click", ".masterTooltip", function () {
            if ( !this.clicked)
            {
                this.clicked = true;
            }
            else
            {
                this.clicked = false;
            }
        });
      }); // end document ready
    </script>
    
    <script>
    <?php
        if($updating)
        {
        ?>
            function callExtent()
            {
                $.ajax( {
                    url: '../controller/controller_extend.php'
                } );
                setTimeout(callExtent, 30000);
            }
            $(document).ready( function(){
                setTimeout(callExtent, 30000);
            } );
            
        <?php
        }
    ?>
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
        
        
        $_SESSION["datemodification"] = $plancadre[0]["datemodification"];
        
        $save_path = '../plancadre/'. $plancadre[0]['No_PlanCadre'] . "_" . $plancadre[0]['CodeCours'] . "_";
        
        $path_presentation = $save_path . "presentation" . '.txt';
        $path_integration = $save_path . "integration" .".txt";
        $path_evalutation = $save_path . "evaluation" . ".txt";
        $path_competences = $save_path . "competences" . ".txt";
        $path_apprentissage = $save_path . "apprentissage" . ".txt";

    }
    ?>
    
    <br>

    <fieldset >
        <legend>Élaboration d'un Plan-Cadre</legend>
        <br>
        
        <?php
    
        ?>
        <?php
            if(!$updating)
            {
                ?>
                <h3 style="color: red;"> Un autre utilisateur est déjà en train de modifier ce plan-cadre. </h3>
                <h3 style="color: red;"> (Aucune modification possible) </h3>
                <?php            
            }
        ?>
        
        
        <form action="../controller/controller_create_plancadre.php" method="post" >
            
            <!-- ajouter un bouton sauvegarder ici -->
            <input name="save" type="submit" value="Sauvegarder..." <?php if(!$updating){ echo 'disabled="disabled"';} ?> class="btn btn-default" />
            
            <input type='hidden' name='save_path' value ='<?php 
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
            
            <br>
            
            <div id="sections" >
                
                <?php
                    $sections = getsections($_SESSION["id_plancadre"]);
                    $i = 1;
                    foreach($sections as $section)
                    {
                        if($i < 4)
                        {
                            
                        
                        $descriptionConsigne = fetchConsignesPlanCadre_Id($i);
                        ?>
                        <img src="../images/tooltip_icon.png" class="masterTooltip"
                         title="<?php echo $descriptionConsigne[0]["EnonceConsigne"]/*[ "DescriptionConsigne" ]*/; ?>"
                         />
                        <?php
                        }
                        $i++;
                        ?>
                        <div id="<?php echo $section["id"]; ?>">
                        Titre de la section : 
                        <input id="<?php echo "titre_". $section["id"]; ?>" name="titres[]" type="text" required="true" maxLength="100" value=" <?php echo $section["titre"]; ?>"  <?php if(!$updating){ echo 'readonly="readonly"';} ?>/>
                        <button type='button' class='enleverSection' value="<?php echo $section['id']?>"  <?php if(!$updating){ echo 'disabled="disabled"';} ?> > Effacer cette section </button>
                        <br>
                        <br>
                        <textarea id="<?php echo "texte_". $section["id"]; ?>" name='textes[]' class='ckeditor' <?php if(!$updating){ echo 'readonly="readonly"';} ?> >  <?php echo readFrom($save_path . $section["emplacement"] . ".txt");?> </textarea>
                        <input type='hidden' name='section_id[]' value="<?php echo $section["id"];?>" />
                        <br>
                        <br>
                        </div>
                        <?php
                    }
                
                ?>
            </div>
            <div id="effacer_sections"></div>
            <div id="nouvelles_sections"></div>
            <br>
            <button id="add" class="ajouter_section"type="button" <?php if(!$updating){ echo 'disabled="disabled"';} ?>> Ajouter une section </button>
            <br>

            <br>

            <?php showInstructionToggle('1'); ?>
            <label class="control-label col-md-2">Presentation du cours : </label>
            <br>
            <div class="col-md-10">
                <textarea class="ckeditor" id="Presentation" name="Presentation" rows="12" cols="50"><?php echo readFrom($path_presentation);
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
                <input name="save" type="submit" value="Sauvegarder..." <?php if(!$updating){ echo 'disabled="disabled"';} ?> class="btn btn-default" />
            </div>

        </form>
    </fieldset>
</div>
</body>
</html>


