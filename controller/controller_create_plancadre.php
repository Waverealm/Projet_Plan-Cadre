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
    $competences = $_POST['Competences'];
    $apprentissage = $_POST['ObjectifsApprentissage'];


    // le nom des fichiers textes serra :
    // clé primaire du plancadre + code ou le nom du cours + le nom de la section
    // exemple : 2_420-EDA-05_PresentationCours.txt

    $path_presentation = "../plancadre/". $_POST['save_path'] . "presentation" . ".txt";
    $path_integration = "../plancadre/". $_POST['save_path'] . "integration" . ".txt";
    $path_evalutation = "../plancadre/". $_POST['save_path'] . "evaluation" . ".txt";
    $path_competences = "../plancadre/". $_POST['save_path'] . "competences" . ".txt";
    $path_apprentissage = "../plancadre/". $_POST['save_path'] . "apprentissage" . ".txt";

    /*
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


    // création d'un nouveau document
    $php_word = new \PhpOffice\PhpWord\PhpWord();


    $section_template = $php_word->addSection();


    $section_template->addText("Collège Lionel-Groulx");

    
    $style_align_right = array("align"=>"right");
    $php_word->addParagraphStyle( "style_align_right", $style_align_right);

    $section_template->addText("Placeholder pour le type d'enseignement", null, "style_align_right");
    $section_template->addText( $programme_cours,
    null, "style_align_right" );

    // faire de l'espace
    $section_template->addText("");


    $style_titre = array("");

    $style_table = array('borderColor'=>'006699',
              'borderSize'=>6,
              'cellMargin'=>50,
              'align'=>center);

    $style_frist_row = array('bgcolor'=>'66BBFF');

    $php_word->addTableStyle('style_table', $style_table, $style_frist_row);

    $table = $section_template->addTable('style_table');

    $table->addRow(200);
    $table->addCell(3600)->addText("TITRE");

    $table->addRow(200);
    $table->addCell(1200)->addText("");
    $table->addCell(1200)->addText($nom_cours);
    $table->addCell(1200)->addText($code_cours);

    $table->addRow(200);
    $table->addCell(1200)->addText($ponderation_cours);
    $table->addCell(1200)->addText($nombre_unites_cours);
    $table->addCell(1200)->addText("");


    // test pour confirmer que la section fonctionne
    \PhpOffice\PhpWord\Shared\Html::addHtml($section_template, 'test DU TEMPLATE');


    // fin du template et début de l'ajout des parties du plan-cadre 

    $debut_balise_titre = '<p  style="size:16px; text-align:center; "><strong>';
    $fin_balise_titre = '</strong></p>';

/*
    Exemple d'une section
    $section = $php_word->addSection();
    // Titre de la section
    $titre = "un titre";
    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $debut_balise_titre . $titre . $fin_balise_titre);
    // Le texte de la section
    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $texte);

*/

    $section_presentation = $php_word->addSection();
    
    // l'alignement ne fonctionne pas en texte mais la taille du texte fonctionne
    //$titre_presentation = 'Présentation du cours';
    //$section_presentation->addTitle( $titre_presentation, 'style_titre' );

    // l'alignement fonctionne en html mais pas la taille du texte
    
    $titre = "Présentation du cours";
    \PhpOffice\PhpWord\Shared\Html::addHtml($section_presentation, $debut_balise_titre . $titre . $fin_balise_titre);

    \PhpOffice\PhpWord\Shared\Html::addHtml($section_presentation, $presentation);


    $section_integration = $php_word->addSection();
    
    $titre = "Objectif d'intégration";
    \PhpOffice\PhpWord\Shared\Html::addHtml($section_integration, $debut_balise_titre . $titre . $fin_balise_titre);
    
    \PhpOffice\PhpWord\Shared\Html::addHtml($section_integration, $integration);


    $section_evaluation = $php_word->addSection();

    $titre = 'Évaluation des apprentissages';
    \PhpOffice\PhpWord\Shared\Html::addHtml($section_evaluation, $debut_balise_titre . $titre . $fin_balise_titre);
    
    \PhpOffice\PhpWord\Shared\Html::addHtml($section_evaluation, $evaluation);


    $section_competences = $php_word->addSection();

    $titre = "Énoncé des compétences";
    \PhpOffice\PhpWord\Shared\Html::addHtml($section_competences, $debut_balise_titre . $titre . $fin_balise_titre);

    \PhpOffice\PhpWord\Shared\Html::addHtml($section_competences, $competences);


    $section_apprentissage = $php_word->addSection();

    $titre = "Objectifs d'apprentissage";
    \PhpOffice\PhpWord\Shared\Html::addHtml($section_apprentissage, $debut_balise_titre . $titre . $fin_balise_titre);

    \PhpOffice\PhpWord\Shared\Html::addHtml($section_apprentissage, $apprentissage);

    $plancadre = fetchPlanCadreElaboration_PlanCadre( $_POST['id_plancadre'] );
    $path_docx = "../plancadre/". $plancadre[0]['No_PlanCadre'] . "_" . $plancadre[0]['CodeCours'] . ".docx";
    $php_word->save($path_docx);
    
    header('Location: ../view/view_create_plancadre.php');
}
else if ( isset($_POST['open']) )
{
    header('Location: ../view/view_elaboration_plancadre.php');
}




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



    


?>