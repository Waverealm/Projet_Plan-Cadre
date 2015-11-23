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