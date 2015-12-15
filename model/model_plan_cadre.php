<?php
include_once("../assets/constant.php");
include_once("../model/queries.php");
require_once '../assets/PHPWord-Master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();   



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

/*
	buildPlanCadre
	Cette fonction permet de construire un document Word
	et de le sauvegarder. Les données utilisées dépendent
	des documents liés à la clé primaire du plan-cadre qui
	a été passé en paramètre.
*/
function buildPlanCadre($primary_key)
{

	$result = fetchAllInfoPlanCadre($primary_key);
	$info_plancadre = $result[0];
	$id_plancadre = $primary_key;

    $etat = $info_plancadre["Etat"];

	$nom_cours = "Titre du cours : " . $info_plancadre["NomCours"];
    $code_cours = "Numéro du cours : " . $info_plancadre["CodeCours"];
    $nom_programme = $info_plancadre["NomProgramme"];
    $code_programme = $info_plancadre["CodeProgramme"];
    $programme_cours = $nom_programme ."(". $code_programme .")";
    $ponderation_cours = "Pondération : " . $info_plancadre["Ponderation"];
    $nombre_unites_cours = "Nombre d'unité(s) : " . $info_plancadre["NombreUnites"];

    $prealable_cours = "Préalable(s) : " . "Aucun";
    $type_enseignement = $_POST['TypeEnseignement'];



    // le nom des fichiers textes serra :
    // clé primaire du plancadre + code ou le nom du cours + le nom de la section
    // exemple : 2_420-EDA-05_PresentationCours.txt

    $path_presentation = "../plancadre/". $id_plancadre . "_" . $code_cours . "presentation" . ".txt";
    $path_integration = "../plancadre/". $id_plancadre . "_" . $code_cours . "integration" . ".txt";
    $path_evalutation = "../plancadre/". $id_plancadre . "_" . $code_cours . "evaluation" . ".txt";
    $path_competences = "../plancadre/". $id_plancadre . "_" . $code_cours . "competences" . ".txt";
    $path_apprentissage = "../plancadre/". $id_plancadre . "_" . $code_cours . "apprentissage" . ".txt";


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
// début de la définition des différents styles
// possibilité d'exporter cela dans un autre document
// pour mieux paramétrer le
// http://phpword.readthedocs.org/en/latest/styles.html

    $style_font_titre = array('size'=> 14,
        'bold'=>true);

    $style_font_texte = array('size'=>12);

    $style_align_right = array("align"=>"right");
    $php_word->addParagraphStyle( "style_align_right", $style_align_right);

    $style_align_center = array("align"=>"center");
    $php_word->addParagraphStyle( "style_align_center", $style_align_center);

    $style_table = array('width'=> 50000,
        'borderSize'=>6,
        'cellMargin'=>100,
        'align'=>'center');
    $php_word->addTableStyle('style_table', $style_table);

    //$style_first_row = array('bgcolor'=>'66BBFF');

    $style_cellule_titre = array('valign'=>'center',
        'gridspan'=> 3);

    $style_row = array(
        'cantSplit'=>true,
        'exactHeight'=>500
        );
    $style_row_titre = array('tblHeader'=>false,
        'cantSplit'=>true,
        'exactHeight'=>500
        );

    $table_width = 10000;

    // variable avec nom significatif pour son utilisation
    $saut_ligne = "";

// Fin de la définiton des styles
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
                $titre_documentt = "Plan-cadre officiel";
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
    $section_template->addText($saut_ligne);

    $section_template->addText($titre_document, $style_font_titre, $style_align_center);

    $section_template->addText($saut_ligne);


    $table_identification = $section_template->addTable('style_table');
    $nombre_colonnes = 3;
    $cell_width = $table_width / $nombre_colonnes;

    $table_identification->addRow($style_row);

    $table_identification->addCell($cell_width, $style_cellule_titre)->addText("Identification du cours", $style_font_titre, $style_align_center);

    $table_identification->addRow($style_row);   
    $table_identification->addCell($cell_width)->addText("Discipline", null, $style_align_center);
    $table_identification->addCell($cell_width)->addText($nom_cours, null, $style_align_center);
    $table_identification->addCell($cell_width)->addText($code_cours, null, $style_align_center);

    $table_identification->addRow($style_row);
    $table_identification->addCell($cell_width)->addText($ponderation_cours, null, $style_align_center);
    $table_identification->addCell($cell_width)->addText($nombre_unites_cours, null, $style_align_center);
    $table_identification->addCell($cell_width)->addText("test", null, $style_align_center);

// Fin de la section de l'indentification du cours 
// ----------------------------------------------

// ----------------------------------------------
// Section de la présentation du cours 
    $section_presentation = $php_word->addSection();

    $titre = "Présentation du cours";

    $table_presentation = $section_presentation->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $table_width / $nombre_colonnes;
    
    $table_presentation->addRow($style_row_titre);
    $cellule_titre = $table_presentation->addCell($cell_width)->addText($titre, $style_font_titre, $style_align_center);

    $table_presentation->addRow($style_row);
    $cellule_contenu = $table_presentation->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $presentation);

// Fin de la section de la présentation du cours 
// ----------------------------------------------
    


// ----------------------------------------------
// Section de l'objectif d'intégration 
    $section_integration = $php_word->addSection();

    $titre = "Objectif d'intégration";

    $table_integration = $section_integration->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $table_width / $nombre_colonnes;
    
    $table_integration->addRow($style_row_titre);
    $cellule_titre = $table_integration->addCell($cell_width)->addText($titre, $style_font_titre, $style_align_center);

    $table_integration->addRow($style_row);
    $cellule_contenu = $table_integration->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $integration);

// Fin de la section de l'objectif d'intégration 
// ----------------------------------------------
    

// ----------------------------------------------
// Section de l'évaluation des apprentissages 
    
    $section_evaluation = $php_word->addSection();

    $titre = 'Évaluation des apprentissages';

    $table_evaluation = $section_evaluation->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $table_width / $nombre_colonnes;
    
    $table_evaluation->addRow($style_row_titre);
    $cellule_titre = $table_evaluation->addCell($cell_width)->addText($titre, $style_font_titre, $style_align_center);

    $table_evaluation->addRow($style_row);
    $cellule_contenu = $table_evaluation->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $evaluation);

// Fin de la section de l'évaluation des apprentissages 
// ----------------------------------------------
    
// ----------------------------------------------
// Section de l'énoncé des compétences
    
    $section_competences = $php_word->addSection();

    $titre = "Énoncé des compétences";

    $table_competences = $section_competences->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $table_width / $nombre_colonnes;
    
    $table_competences->addRow($style_row_titre);
    $cellule_titre = $table_competences->addCell($cell_width)->addText($titre, $style_font_titre, $style_align_center);

    $table_competences->addRow($style_row);
    $cellule_contenu = $table_competences->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $competences);

// Fin de la section de l'énoncé des compétences
// ----------------------------------------------
    

// ----------------------------------------------
// Section des objectifs d'apprentissage

    $section_apprentissage = $php_word->addSection();

    $titre = "Objectifs d'apprentissage";

    $table_apprentissage = $section_apprentissage->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $table_width / $nombre_colonnes;
    
    $table_apprentissage->addRow($style_row_titre);
    $cellule_titre = $table_apprentissage->addCell($cell_width)->addText($titre, $style_font_titre, $style_align_center);

    $table_apprentissage->addRow($style_row);
    $cellule_contenu = $table_apprentissage->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $apprentissage);

// Fin de la section des objectifs d'apprentissage
// ----------------------------------------------
    

    $path_docx = "../plancadre/". $id_plancadre . "_" . $code_cours . ".docx";
    $php_word->save($path_docx);
}









