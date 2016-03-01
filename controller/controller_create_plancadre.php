<?php



if(!isset($_SESSION))
{
    session_start();
}

include_once( "../assets/constants.php" );

include_once( REQUETES_BD );
include_once( MODEL_PLAN_CADRE );

require_once '../assets/PHPWord-Master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();


if( ( isset($_POST['submit']) || isset($_POST['save']) ) && isset($_SESSION['id_plancadre']) ) 
{
	
	$update = true;
	
	$pdo = dbConnect();
     
    $pdo->beginTransaction();
	
	try
	{
		if( isset($_POST['sections_effacer']) && !empty($_POST['sections_effacer']) )
		{
			foreach( $_POST['sections_effacer'] as $section_id )
			{
				enleverSection($section_id, $pdo);
			}
		}
		
		if( isset($_POST['titres']) && !empty($_POST['titres']) )
		{
			foreach( $_POST['textes'] as $i => $texte )
			{
				$emplacement = $i + 1;
				updatesection( $_POST["section_id"][$i], $emplacement , $_POST['titres'][$i] , $pdo);
			}
		}
	
		
		if( isset($_POST['new_titres']) && !empty($_POST['new_titres']) )
		{
			$result = getcountsections($_SESSION['id_plancadre']);
			
			if( !empty($result))
			{
				$new_emplacement = $result[0]['nbr'];
				
			}
			else
			{
					$new_emplacement = 1;
			}
			foreach( $_POST['new_textes'] as $i => $new_texte )
			{
				insert_section($_SESSION['id_plancadre'], $new_emplacement, $_POST['new_titres'][$i], $pdo);
				$new_emplacement++;
			}
		}
		if( isset($_POST['textes']) && !empty($_POST['textes']) )
		{
			foreach( $_POST['textes'] as $i => $texte )
			{
				$emplacement = $i;
				$save_texte = fopen($_POST['save_path'] . $emplacement . ".txt" , "w");
				fwrite($save_texte, $texte);
				fclose($save_texte);
			}
		}
		if( isset($_POST['new_textes']) && !empty($_POST['new_textes']) )
		{
			foreach( $_POST['new_textes'] as $i => $new_texte )
			{
				$emplacement = $i;
				$save_texte = fopen($_POST['save_path'] . $new_emplacement . ".txt" , "w");
				fwrite($save_texte, $new_texte);
				fclose($save_texte);
			}
		}
		$fin_update = $pdo->prepare('CALL PLANCADRES_UPDATE_UPDATING(?,?)');
        
        $fin_update->bindParam(1, $_SESSION['id_plancadre'], PDO::PARAM_STR);
        $i = 0;
        $fin_update->bindParam(2, $i, PDO::PARAM_STR);
        
        $fin_update->execute();
		$pdo->commit();
	}
	catch( Exception $e)
	{
		echo $e->getCode() . ' ' . $e->getMessage() . ' ' . $e->getLine() . ' in ' . $e->getFile();
		$pdo->rollback();
		$update = false;
	}
    
    
// ----------------------------------------------
 


/*
    ----------------------------------------------
    Début de la création du document.
    Le code qui suit pourrait être considéré comme un template si 
    on arrive à le paramétrer correctement.
     ----------------------------------------------
*/
    $result = fetchAllInfoPlanCadre($_SESSION['id_plancadre']);
    
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
    
    $sections = getsections($_SESSION["id_plancadre"]);
    foreach($sections as $i => $section)
    {
        addSection( $php_word, $section["titre"], readFrom($_POST['save_path'] . $section["emplacement"] . ".txt") );
    }
    $path_docx = "../plancadre/". $_SESSION["id_plancadre"] . "_" . $info_plancadre["CodeCours"] . ".docx";
    $php_word->save($path_docx);
    
    header('Location: ../view/view_create_plancadre.php');
}
else if ( isset($_POST['open']) )
{
    header('Location: ../view/view_elaboration_plancadre.php');
}








function getPlanCadre($id_plancadre)
{
    return fetchPlanCadreElaboration_PlanCadre($id_plancadre);
}
function getPrealableCours($id_cours)
{
    return fetchPrealableCours_Id($id_cours);
}



