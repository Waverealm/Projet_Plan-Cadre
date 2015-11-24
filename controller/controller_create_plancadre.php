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
require_once '../assets/PHPWord.php';
   
   

if( isset($_POST['submit']) || isset($_POST['save']) ) 
{

    // Prend les valeurs qui ont été envoyé par la méthode post
    // et les place dans des variables
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
    updatePlanCadre_Fichiers($path_presentation,
        $path_integration,
        $path_evalutation,
        $path_competences,
        $path_apprentissage,
        $_POST['id_plancadre']
        );

    // document word fait à partir du template
    $plancadre = fetchPlanCadreElaboration_PlanCadre( $_POST['id_plancadre'] );
    $prealable_cours = fetchPrealableCours_Id( $plancadre[0]['CodeCours'] );

    $PHPWord = new PHPWord();

    $document = $PHPWord->loadTemplate('../assets/template_test.docx');

    //$document->setValue('type_enseignement', $plancadre[0]['TypeCours']);
    $document->setValue('nom_programme', $plancadre[0]['NomProgramme']);
    $document->setValue('code_programme', $plancadre[0]['CodeProgramme']);
    $document->setValue('nom_cours', $plancadre[0]['NomCours']);
    $document->setValue('code_cours', $plancadre[0]['CodeCours']);
    $document->setValue('ponderation_cours', $plancadre[0]['Ponderation']);
    $document->setValue('unite_cours', $plancadre[0]['NombreUnites']);
    // extraire le code des cours prealable et l'entrer 
    // si il n'a pas de cours prealable entrer "aucun" 
    //$document->setValue('prealable_cours', 'u');

    // test
    // obtient une erreur pour le text
    //$text = $presentation . " " . $integration . " " . $evaluation . " " . $competences . " " . $apprentissage;
    //$document->setValue('presentation', $text);

    $path_docx = "../plancadre/". $plancadre[0]['VersionPlan'] . "_" . $plancadre[0]['CodeCours'] . ".docx";

    $document->save($path_docx);

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