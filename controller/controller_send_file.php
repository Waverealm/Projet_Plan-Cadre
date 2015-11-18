<?php


//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename = "plancadre.pdf"');


// créer un nouveau fichier et l'envoyer au client
// la prochaine requête écrasera le fichier
// trouver comment changer le nom en fonction du plancadre choisi





// plus d'objet COM exemple
/*
com_load_typelib('Word.Application');
$word = new COM("word.application");
$word->Documents->Open('../plancadre/Doc1.doc');
$word->Visible = 1;
$word->ActiveDocument->FormFields("Text1")->Result = "something";
$word->ActiveDocument->Close(false);
$word->Quit();
unset($word);
*/


// exemple a tester 


// montre comment utiliser objet COM
// semble être mieux que les autres
// faire un essai sur un ordi qui possede office
// http://www.phpbuilder.com/columns/yunus20031124.php3?page=2

// http://www.phpbuilder.com/columns/venkatesan20030501.php3?page=2
// modifier les permissions sur le pc pour permettre à l'application d'être utiliser
// et doit modifier php.ini pour
/* 
[com]
; allow Distributed-COM calls com.allow_dcom = true ;
autoregister constants of a components typlib on com_load() com.autoregister_typelib = true ; 
register constants casesensitive ;
com.autoregister_casesensitive = false ; 
show warnings on duplicate constat registrations com.autoregister_verbose = true 
*/
/*

//1. Instanciate Word
$word = new COM("word.application") or die("Unable to instantiate Word");
//2. specify the MS Word template document (with Bookmark TODAYDATE inside)
$template_file = "../assets/template.docx";
//3. open the template document
$word->Documents->Open($template_file);
//4. get the current date MM/DD/YYYY
$current_date = date("m/d/Y");

//5. get the bookmark and create a new MS Word Range (to enable text substitution)
$bookmark_code_cours = "{code_cours}";
$objBookmark = $word->ActiveDocument->Bookmarks($bookmark_code_cours);
$range = $objBookmark->Range;
//6. now substitute the bookmark with actual value
$range->Text = $current_date;


//7. save the template as a new document (c:/reminder_new.doc)
$new_file = "../plancadre/template.docx";
$word->Documents[1]->SaveAs($new_file);
//8. free the object
$word->Quit();
$word->Release();
$word = null; 

*/



////////////////////////////////////////////////////////////////////////////
require_once '../assets/PHPWord.php';


$phpWord = new PHPWord();

$document = $phpWord->loadTemplate('../assets/template1.dotx');

$document->setValue('code_cours', 'John');
$document->setValue('ponderation_cours', 'JBS Marketing');
$document->setValue('prealable_cours', 'www.website.com.au');

$name = 'test.docx';

ob_clean();
$document->save('../plancadre/' . $name);
//rename($name, "results/{$name}");


/*
$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('../assets/template.docx');



$row = array('cours',
  'ponderation',
  'prealable');

// doit peut-être créer des bookmarks
// à regarder demain avant la rencontre
// les variables/bookmarks ont peut-être besoin de $ en avant
// par exemple ${nomvariable}

$document->setValue('code_cours', $row[0]);
$document->setValue('ponderation_cours', $row[1]);
$document->setValue('prealable_cours', $row[2]);

$file = '../plancadre/test.docx';

$document->save($file);

*/

/*
// use phpWord ?
// http://phpword.codeplex.com/
// exemple de PHPWORD pour créer un document
// fonctione correctement, si rien ne fonctionne
// on va probablement devoir s'en servir pour créer
// le template avec du code ce qui n'est pas idéal si
// on veut pouvoir le changer sans changer le code
// (à moins qu'on fasse une interface pour ça ? pas une bonne idée)
require_once '../assets/PHPWord.php';

$file = '../assets/template.dotx';

// Create a new PHPWord Object
$PHPWord = new PHPWord();

// Every element you want to append to the word document is placed in a section. So you need a section:
$section = $PHPWord->createSection();

// After creating a section, you can append elements:
$section->addText('Hello world!');

// You can directly style your text by giving the addText function an array:
$section->addText('Hello world! I am formatted.', array('name'=>'Tahoma', 'size'=>16, 'bold'=>true));

// If you often need the same style again you can create a user defined style to the word document
// and give the addText function the name of the style:
$PHPWord->addFontStyle('myOwnStyle', array('name'=>'Verdana', 'size'=>14, 'color'=>'1B2232'));
$section->addText('Hello world! I am formatted by a user defined style', 'myOwnStyle');

// You can also putthe appended element to local object an call functions like this:
$myTextElement = $section->addText('Hello World!');
//$myTextElement->setBold();
//$myTextElement->setName('Verdana');
//$myTextElement->setSize(22);

// At least write the document to webspace:
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('../plancadre/helloWorld.docx');

*/


////////////////////////////////////////////////////////////////
// code pour envoyer un fichier au client (download)
/*

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}

*/

////////////////////////////////////////////////////////////////








/////////////////////////////////////////////////////////////////////////////////////////




// cpradio donne un exemple avec un template pdf
// http://www.sitepoint.com/community/t/filling-word-doc-from-mysql-database-using-php/22650/9




////////////////////////////////////////////////////////////////////////////////

// autre solution, utiliser un objet COM

// autre solution, utiliser du html pour générer un document que Word peut ouvrir
// pour ensuite l'envoyer comme si c'était un document Word
// semble correct mais pas très efficace
// http://sebsauvage.net/wiki/doku.php?id=word_document_generation









/////////////////////////////////////////////////////

// trop de code pour très peu de bénéfices
// (savoir clairement ce qu'on envoie)

// on pourrait utiliser la fonction http_send_file($file)
// la fonction retourne un boolean donc peut-être 
// qu'il faut l'appeler dans une page normale

// pour le type des MIME :
// avec tous les MIME de Office 2007
// http://blogs.msdn.com/b/vsofficedeveloper/archive/2008/05/08/office-2007-open-xml-mime-types.aspx
// autre référence au cas où
// https://technet.microsoft.com/en-us/library/ee309278.aspx

/*
// http://stackoverflow.com/questions/11518576/php-send-word-document-file-to-download
$tmp = explode(".",$file['filename']);
switch ($tmp[count($tmp)-1]) {
  case "pdf": $ctype="application/pdf"; break;
  case "exe": $ctype="application/octet-stream"; break;
  case "zip": $ctype="application/zip"; break;
  case "docx":
  case "doc": $ctype="application/msword"; break;
  case "csv":
  case "xls":
  case "xlsx": $ctype="application/vnd.ms-excel"; break;
  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
  case "gif": $ctype="image/gif"; break;
  case "png": $ctype="image/png"; break;
  case "jpeg":
  case "jpg": $ctype="image/jpg"; break;
  case "tif":
  case "tiff": $ctype="image/tiff"; break;
  case "psd": $ctype="image/psd"; break;
  case "bmp": $ctype="image/bmp"; break;
  case "ico": $ctype="image/vnd.microsoft.icon"; break;
  default: $ctype="application/force-download";
}

header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: $ctype");
header("Content-Disposition: attachment; filename=\"".$filename."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$fsize);
ob_clean();
flush();
readfile( 'files/'.$file['filename'] );
*/
