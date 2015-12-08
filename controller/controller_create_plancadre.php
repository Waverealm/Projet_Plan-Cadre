<?php
/**
 * Created by PhpStorm.
 * User: 201087112//AntoineLatendresse
 * Date: 2015-10-21
 * Time: 10:48
 */



if(!isset($_SESSION))
{
    session_start();
}
include_once('../model/queries.php');
require_once '../assets/PHPWord-Master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();   
   

if( isset($_POST['submit']) || isset($_POST['save']) ) 
{

    // Prend les valeurs qui ont été envoyé par la méthode post
    // et les place dans des variables

    $nom_cours = $_POST['NomCours'];
    $code_cours = $_POST['CodeCours'];
    $programme_cours = $_POST['Programme'];
    $ponderation_cours = $_POST['Ponderation'];
    $nombre_unites_cours = $_POST['NombreUnites'];
    $prealable_cours = $_POST['Prealables'];

    // le texte
    $presentation = $_POST['Presentation'];
    $integration = $_POST['ObjectifsIntegration'];
    $evaluation = $_POST['Evaluation'];
    $competences = $_POST['EnonceCompetences'];
    $apprentissage = $_POST['ObjectifsApprentissage'];


    // le nom des fichiers textes serra :
    // clé primaire du plancadre + code ou le nom du cours + le nom de la section
    // exemple : 2_420-EDA-05_PresentationCours.txt

    $path_presentation = "../plancadre/". $_POST['save_path'] . "presentation" . ".txt";
    $path_integration = "../plancadre/". $_POST['save_path'] . "integration" . ".txt";
    $path_evalutation = "../plancadre/". $_POST['save_path'] . "evaluation" . ".txt";
    $path_competences = "../plancadre/". $_POST['save_path'] . "competences" . ".txt";
    $path_apprentissage = "../plancadre/". $_POST['save_path'] . "apprentissage" . ".txt";

 
    // création du fichier
    // fopen(path, write/read)

    $fichier_presentation = fopen($path_presentation, "w");
    $fichier_integration = fopen($path_integration, "w");
    $fichier_evalutation = fopen($path_evalutation, "w");
    $fichier_competences = fopen($path_competences, "w");
    $fichier_apprentissage = fopen($path_apprentissage, "w");

    //écrire les valeurs dans les fichiers
    fwrite($fichier_presentation, $presentation);
    fwrite($fichier_integration, $integration);
    fwrite($fichier_evalutation, $evaluation);
    fwrite($fichier_competences, $competences);
    fwrite($fichier_apprentissage, $apprentissage);

 
/*
    Début de la création du document.
    Le code qui suit pourrait être considéré comme un template si 
    on arrive à le paramétrer correctement.
*/
    $php_word = new \PhpOffice\PhpWord\PhpWord();


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

    $style_row = array('cantSplit'=>true,
        'exactHeight'=>500
        );
    $style_row_titre = array('cantSplit'=>true,
        'exactHeight'=>500,
        'tblHeader'=>true
        );

    $table_width = 10000;

    $saut_ligne = "";

    // Fin de la définiton des styles


    $section_template = $php_word->addSection();

    $section_template->addText("Collège Lionel-Groulx");
    
    $section_template->addText("Placeholder pour le type d'enseignement", null, "style_align_right");
    $section_template->addText( $programme_cours, null, "style_align_right" );

    $section_template->addText($saut_ligne);

    $section_template->addText("Plan-cadre en élaboration", $style_font_titre, $style_align_center);

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



    $section_presentation = $php_word->addSection();

    $titre = "Présentation du cours";
    
    //\PhpOffice\PhpWord\Shared\Html::addHtml($section_presentation, '<br></br>');

    $table_presentation = $section_presentation->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $table_width / $nombre_colonnes;
    
    $table_presentation->addRow($style_row_titre);
    $cellule_titre = $table_presentation->addCell($cell_width)->addText($titre, $style_font_titre, $style_align_center);

    $table_presentation->addRow($style_row);
    $cellule_contenu = $table_presentation->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $presentation);




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



    $section_evaluation = $php_word->addSection();

    $titre = 'Évaluation des apprentissages';

    $table_evaluation = $section_integration->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $table_width / $nombre_colonnes;
    
    $table_evaluation->addRow($style_row_titre);
    $cellule_titre = $table_evaluation->addCell($cell_width)->addText($titre, $style_font_titre, $style_align_center);

    $table_evaluation->addRow($style_row);
    $cellule_contenu = $table_evaluation->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $evaluation);




    $section_competences = $php_word->addSection();

    $titre = "Énoncé des compétences";

    $table_competences = $section_integration->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $table_width / $nombre_colonnes;
    
    $table_competences->addRow($style_row_titre);
    $cellule_titre = $table_competences->addCell($cell_width)->addText($titre, $style_font_titre, $style_align_center);

    $table_competences->addRow($style_row);
    $cellule_contenu = $table_competences->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $competences);



    $section_apprentissage = $php_word->addSection();

    $titre = "Objectifs d'apprentissage";

    $table_apprentissage = $section_integration->addTable('style_table');
    $nombre_colonnes = 1;
    $cell_width = $table_width / $nombre_colonnes;
    
    $table_apprentissage->addRow($style_row_titre);
    $cellule_titre = $table_apprentissage->addCell($cell_width)->addText($titre, $style_font_titre, $style_align_center);

    $table_apprentissage->addRow($style_row);
    $cellule_contenu = $table_apprentissage->addCell($cell_width);
    \PhpOffice\PhpWord\Shared\Html::addHtml($cellule_contenu, $apprentissage);




    $plancadre = fetchPlanCadreElaboration_PlanCadre( $_POST['id_plancadre'] );
    $path_docx = "../plancadre/". $plancadre[0]['No_PlanCadre'] . "_" . $plancadre[0]['CodeCours'] . ".docx";
    $php_word->save($path_docx);
    
    header('Location: ../view/view_create_plancadre.php');
}
else if ( isset($_POST['open']) )
{
    header('Location: ../view/view_elaboration_plancadre.php');
}


// convert html to docx
// https://github.com/PHPOffice/PHPWord/issues/543
/*
function parseParagraph($node, $element, &$styles)
{
    $styles['paragraph'] = self::parseInlineStyle($node, $styles['paragraph']);
    $newElement = $element->addTextRun($styles['paragraph']);
    $newElement->addTextBreak(1);

    return $newElement;
}
*/


function getPlanCadre($id_plancadre)
{
    return fetchPlanCadreElaboration_PlanCadre($id_plancadre);;
}
function getPrealableCours($id_cours)
{
    return fetchPrealableCours_Id($id_cours);;
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



    


   /*
    code du template
    plus de besoin du template
    // création du fichier
    // fopen(path, write/read)

    $fichier_presentation = fopen($path_presentation, "w");
    $fichier_integration = fopen($path_integration, "w");
    $fichier_evalutation = fopen($path_evalutation, "w");
    $fichier_competences = fopen($path_competences, "w");
    $fichier_apprentissage = fopen($path_apprentissage, "w");

    //écrire les valeurs dans les fichiers
    fwrite($fichier_presentation, $presentation);
    fwrite($fichier_integration, $integration);
    fwrite($fichier_evalutation, $evaluation);
    fwrite($fichier_competences, $competences);
    fwrite($fichier_apprentissage, $apprentissage);

    //sauvegarder le tout dans la bd
    updatePlanCadre_Fichiers(
        $path_presentation,
        $path_integration,
        $path_evalutation,
        $path_competences,
        $path_apprentissage,
        $_POST['id_plancadre']
        );


    // document word fait à partir du template
    $plancadre = fetchPlanCadreElaboration_PlanCadre( $_POST['id_plancadre'] );
    $prealable_cours = fetchPrealableCours_Id( $plancadre[0]['CodeCours'] );

    $path_docx_template = "../plancadre/". $plancadre[0]['No_PlanCadre'] . "_" . $plancadre[0]['CodeCours'] . "_template". ".docx";

    $template_processor = new \PhpOffice\PhpWord\TemplateProcessor('../assets/template_elaboration.docx');

    $template_processor->setValue('type_enseignement', $plancadre[0]['TypeCours']);
    $template_processor->setValue('nom_programme', $plancadre[0]['NomProgramme']);
    $template_processor->setValue('code_programme', $plancadre[0]['CodeProgramme']);
    $template_processor->setValue('nom_discipline', 'PLACEHOLDER');
    $template_processor->setValue('nom_cours', $plancadre[0]['NomCours']);
    $template_processor->setValue('code_cours', $plancadre[0]['CodeCours']);
    $template_processor->setValue('ponderation_cours', $plancadre[0]['Ponderation']);
    $template_processor->setValue('unite_cours', $plancadre[0]['NombreUnites']);

    // extraire le code des cours prealable et l'entrer 
    // si il n'a pas de cours prealable entrer "aucun" 
    //$document->setValue('prealable_cours', 'u');

    $template_processor->saveAs($path_docx_template);

    plus de besoin du template
    */
