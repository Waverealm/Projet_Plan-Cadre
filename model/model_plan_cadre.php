<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include_once("../assets/constants.php");
include_once(REQUETES_BD);
require_once '../assets/PHPWord-Master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();   









/*
    Nom de la fonction : listerPlanCadre
    Fait par : Simon Roy
    Cette fonction permet d'afficher une liste déroulante des plans-cadres
    contenues dans la liste passé en paramètre.
*/
function listerPlanCadre($list, $nom_liste = 'liste_plan_cadre', $id_liste = 'liste_plan_cadre')
{
    echo "<select name='".$nom_liste."' id='".$nom_liste."' style='width: 300px' >";
        echo "<option value=\"" . "\">" . "</option>";
    if(sizeof($list) > 0)
    {
        foreach ($list as $row)
        {
                
            echo "<option value=\"".$row["No_PlanCadre"]."\">".
            "(".$row["DateAjout"].")"." ".$row["CodeCours"]." ".$row["NomCours"]."</option>";
        }
    }
    else
    {
        echo "<option>"."Aucun plan-cadre en élaboration"."</option>";
    }
    echo "</select>";
}






/*
    Nom de la fonction : getPlanCadreElaboration
    Fait par : Simon Roy
    Cette fonction retourne une liste de tous les plans-cadres en élaboration
*/
function getPlanCadreElaboration()
{
    return selectPlanCadreElaboration();
}

function getSpecificPlanCadre( $id )
{
    return fetchPlanCadreElaboration_PlanCadre($id);
}

/*
    Nom de la fonction : showPlanCadreElaboration
    Fait par : Simon Roy
    Cette fonction permet d'afficher une liste déroulante de tous 
    les plans-cadres en élaboration
*/
function showPlanCadreElaboration()
{
    listerPlanCadre( selectPlanCadreElaboration(), 'plan_cadre_elaboration_list' );
}

function showInfoPlancadre( $liste, $nom_tableau =  "tableau_plancadre")
{
    if( !empty($liste) )
    {
        echo "<table name='$nom_tableau' id='$nom_tableau'>";
            echo "<thead>
                <th>Date ajout du plan-cadre</th>
                <th>Code du cours</th>
                <th>Nom du cours</th>
                </thead>";
        foreach ($liste as $row)
        {
                echo "<tr>
                    <td>" . $row["DateAjout"] . "</td>
                    <td>" . $row["CodeCours"] . "</td>
                    <td>" . $row["NomCours"] . "</td>
                    
                </tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "<b>Aucun plan-cadre</b>";
    }
}




/*
    Nom de la fonction : TableauPlanCadre
    Fait par : Simon Roy
    Cette fonction permet d'afficher un tableau des plans-cadres
    contenues dans la liste passé en paramètre.
*/
function tableauPlanCadreElaboration( $nom_tableau = "plan_cadre_elaboration" )
{
    $liste = getPlanCadreElaboration();
    if( !empty($liste) )
    {
        echo "<table name='$nom_tableau' id='$nom_tableau'>";
            echo "<thead>
                <th>Code du cours</th>
                <th>Nom du cours</th>
                <th>Date ajout</th>
                <th>Ajouter un élaborateur</th>
                </thead>";
        foreach ($liste as $row)
        {
                echo "<tr>
                    <td>" . $row["CodeCours"] . "</td>
                    <td>" . $row["NomCours"] . "</td>
                    <td>" . $row["DateAjout"] . "</td>
                    <td>" . "<button name='plan_cadre_elaboration' type='submit'" .
                    "value='" . $row["No_PlanCadre"] . "'> + </button>" . "</td>
                </tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "<b>Aucun plan-cadre en élaboration</b>";
    }
}

function showInstructionToggle($codeInstruction)
{
    $descriptionConsigne = fetchDescriptionInstruction($codeInstruction);

    ?>
        <br>
        <a class="toggler">Afficher/masquer la consigne</a>
        <p class="toggled"><?php echo $descriptionConsigne[0][ "DescriptionConsigne" ]; ?></p>
        <br>
        <br>
    <?php
}

function buildToggleString( $inside_toggle, $titre_toggle = "Afficher/Masquer" )
{
    return "<br>
    <a class='toggler'>" . $titre_toggle . "</a>" .
    "<p class='toggled'>" . $inside_toggle . "</p>".
    "<br>
    <br>";
}





/*----------------------------------------------

    Section sur la création du document Microsoft Word

----------------------------------------------*/
// ----------------------------------------------
// début de la définition des différents styles
// possibilité d'exporter cela dans un autre document
// pour mieux paramétrer le processus de création du document
// http://phpword.readthedocs.org/en/latest/styles.html

    $GLOBALS["style_font_titre"] = array('size'=> 14,
        'bold'=>true);

    $GLOBALS["style_font_texte"] = array('size'=>12);

    $GLOBALS["style_align_right"] = array("align"=>"right");


    $GLOBALS["style_align_center"] = array("align"=>"center");

    $GLOBALS["style_table"] = array('width'=> 50000,
        'borderSize'=>6,
        'cellMargin'=>100,
        'align'=>'center');

    $GLOBALS["style_cellule_titre"] = array('valign'=>'center',
        'gridspan'=> 3);

    $GLOBALS["style_row"] = array(
        'cantSplit'=>true,
        'exactHeight'=>500
        );
    $GLOBALS["style_row_titre"] = array('tblHeader'=>false,
        'cantSplit'=>true,
        'exactHeight'=>500
        );

    // à vérifier si ça fait quelque chose
    $GLOBALS["table_width"] = 10000;

    // variable avec nom significatif pour son utilisation
    // à confirmer
    $GLOBALS["saut_ligne"] = "";

// Fin de la définiton des styles
// ----------------------------------------------




/*
----------------------------------------------
	buildPlanCadre ($primary_key)
	Cette fonction permet de construire un document Word
	et de le sauvegarder. Les données utilisées dépendent
	des documents liés à la clé primaire du plan-cadre qui
	a été passé en paramètre.
----------------------------------------------
*/
function buildPlanCadre($id_plancadre)
{

	$result = fetchAllInfoPlanCadre($id_plancadre);
	$info_plancadre = $result[0];

    $etat = $info_plancadre["Etat"];

	$nom_cours = "Titre du cours : " . $info_plancadre["NomCours"];
    $code_cours = "Numéro du cours : " . $info_plancadre["CodeCours"];
    $nom_programme = $info_plancadre["NomProgramme"];
    $code_programme = $info_plancadre["CodeProgramme"];
    $programme_cours = $nom_programme ."(". $code_programme .")";
    $ponderation_cours = "Pondération : " . $info_plancadre["Ponderation"];
    $nombre_unites_cours = "Nombre d'unité(s) : " . $info_plancadre["NombreUnites"];

    $prealable_cours = "Préalable(s) : " . "Aucun";
    $type_enseignement = $info_plancadre['TypeCours'];



    // le nom des fichiers textes serra :
    // clé primaire du plancadre + code ou le nom du cours + le nom de la section
    // exemple : 2_420-EDA-05_PresentationCours.txt

    $path_presentation = "../plancadre/". $id_plancadre . "_" . $code_cours . "_" . "presentation" . ".txt";
    $path_integration = "../plancadre/". $id_plancadre . "_" . $code_cours . "_" . "integration" . ".txt";
    $path_evalutation = "../plancadre/". $id_plancadre . "_" . $code_cours . "_" . "evaluation" . ".txt";
    $path_competences = "../plancadre/". $id_plancadre . "_" . $code_cours . "_" . "competences" . ".txt";
    $path_apprentissage = "../plancadre/". $id_plancadre . "_" . $code_cours . "_" . "apprentissage" . ".txt";


    $presentation = ReadFrom($path_presentation);
    $integration = ReadFrom($path_integration);
    $evaluation = ReadFrom($path_evalutation);
    $competences = ReadFrom($path_competences);
    $apprentissage = ReadFrom($path_apprentissage);

/*
    ----------------------------------------------
    Début de la création du document.
    Le code qui suit pourrait être considéré comme un template si 
    on arrive à le paramétrer correctement.
     ----------------------------------------------
*/
    $php_word = new \PhpOffice\PhpWord\PhpWord();

    // ----------------------------------------------
    // ajout des styles au document
    $php_word->addParagraphStyle( "style_align_right", $GLOBALS["style_align_right"] );
    $php_word->addParagraphStyle( "style_align_center", $GLOBALS["style_align_center"] );
    
    $php_word->addTableStyle('style_table', $GLOBALS["style_table"]);
    // ----------------------------------------------



// ----------------------------------------------
// Section de l'indentification du cours 
    $section_template = $php_word->addSection();

    //
    $nom_etablissement = "Collège Lionel-Groulx";
    $section_template->addText($nom_etablissement);
    
    $section_template->addText($type_enseignement, null, "style_align_right");
    $section_template->addText( $programme_cours, null, "style_align_right" );



	switch ($info_plancadre["Etat"]) 
    {
        case 'Adopté':
            if($info_plancadre["Officiel"] > 0)
            {
                $titre_document = "Plan-cadre officiel";
            }
            else
            {
                $titre_document = "Plan-cadre en archive";
            }
            break;
        case 'Validé':
        case 'Élaboration':
        default:
            $titre_document = "Plan-cadre en élaboration";
            break;
    }


    // espace avant et après le titre du document
    $section_template->addText($GLOBALS["saut_ligne"]);

    $section_template->addText( $titre_document, $GLOBALS["style_font_titre"], $GLOBALS["style_align_center"] );

    $section_template->addText($GLOBALS["saut_ligne"]);


    $table_identification = $section_template->addTable('style_table');

    $nombre_colonnes = 3;
    $cell_width = $GLOBALS["table_width"] / $nombre_colonnes;

    $table_identification->addRow($GLOBALS["style_row"]);

    $table_identification->addCell($cell_width, $GLOBALS["style_cellule_titre"])->addText("Identification du cours", 
        $GLOBALS["style_font_titre"], $GLOBALS["style_align_center"]);

    $table_identification->addRow($GLOBALS["style_row"]);   
    $table_identification->addCell($cell_width)->addText("Discipline", null, $GLOBALS["style_align_center"]);
    $table_identification->addCell($cell_width)->addText($nom_cours, null, $GLOBALS["style_align_center"]);
    $table_identification->addCell($cell_width)->addText($code_cours, null, $GLOBALS["style_align_center"]);

    $table_identification->addRow($GLOBALS["style_row"]);
    $table_identification->addCell($cell_width)->addText($ponderation_cours, null, $GLOBALS["style_align_center"]);
    $table_identification->addCell($cell_width)->addText($nombre_unites_cours, null, $GLOBALS["style_align_center"]);
    $table_identification->addCell($cell_width)->addText("test", null, $GLOBALS["style_align_center"]);

// Fin de la section de l'indentification du cours 
// ----------------------------------------------

// ----------------------------------------------
// Section de la présentation du cours 
    $titre = "Présentation du cours";

    addSection($php_word, $titre, $presentation);

// Fin de la section de la présentation du cours 
// ----------------------------------------------
    


// ----------------------------------------------
// Section de l'objectif d'intégration 
    $titre = "Objectif d'intégration";

    addSection($php_word, $titre, $integration);

// Fin de la section de l'objectif d'intégration 
// ----------------------------------------------
    

// ----------------------------------------------
// Section de l'évaluation des apprentissages 

    $titre = 'Évaluation des apprentissages';
    addSection($php_word, $titre, $evaluation);

// Fin de la section de l'évaluation des apprentissages 
// ----------------------------------------------
    
// ----------------------------------------------
// Section de l'énoncé des compétences

    $titre_section = "Énoncé des compétences";

    addSection($php_word, $titre, $competences);

// Fin de la section de l'énoncé des compétences
// ----------------------------------------------
    

// ----------------------------------------------
// Section des objectifs d'apprentissage
    $titre = "Objectifs d'apprentissage";
    addSection($php_word, $titre, $apprentissage);

// Fin de la section des objectifs d'apprentissage
// ----------------------------------------------
    

    $path_docx = "../plancadre/". $id_plancadre . "_" . $code_cours . ".docx";
    $php_word->save($path_docx);
}

function addSection($php_word, $titre_section, $contenu_section)
{
    $section = $php_word->addSection();

    $table = $section->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $GLOBALS["table_width"] / $nombre_colonnes;
    
    $table->addRow($GLOBALS["style_row_titre"]);
    $cellule_titre = $table->addCell($cell_width)->addText($titre_section, 
        $GLOBALS["style_font_titre"], $GLOBALS["style_align_center"]);

    $table->addRow($GLOBALS["style_row"]);
    $cellule_contenu = $table->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $contenu_section);
}




/*
    readFrom($path)
    Cette fonction retourne le contenu du fichier texte qui se
    trouve à l'emplacement spécifié sur le serveur. Si le fichier 
    n'existe pas alors une chaine vide est retourné. Si le fichier 
    n'a pas de contenu alors une chaine vide est retournée.
*/
function readFrom($path)
{
    if(file_exists($path))
    {
        if(filesize($path) > 0)
        {
            $handle = fopen($path, "rb");
            $text = fread($handle, filesize($path));
            return $text;
        }
        else
        {
            $fichier_vide = "";
            return $fichier_vide;
        }
    }
    else
    {
        $fichier_inexistant = "";
        return $fichier_inexistant;
    }
}



