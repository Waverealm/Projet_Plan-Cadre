<?php


//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename = "plancadre.pdf"');


// créer un nouveau fichier et l'envoyer au client
// la prochaine requête écrasera le fichier
// trouver comment changer le nom en fonction du plancadre choisi


// use phpWord ?
// http://phpword.codeplex.com/

require_once '../assets/PHPWord.php';

$file = '../assets/template.dotx';


$php_word = new PHPWord();

// After creating a section, you can append elements:
$section->addText('Hello world!')
// You can directly style your text by giving the addText function an array:
$section->addText('Hello world! I am formatted.', array('name'=>'Tahoma', 'size'=>16, 'bold'=>true));

// If you often need the same style again you can create a user defined style to the word document
// and give the addText function the name of the style:
$php_word->addFontStyle('myOwnStyle', array('name'=>'Verdana', 'size'=>14, 'color'=>'1B2232'));
$section->addText('Hello world! I am formatted by a user defined style', 'myOwnStyle');

// You can also putthe appended element to local object an call functions like this:
$myTextElement = $section->addText('Hello World!');
$myTextElement->setBold();
$myTextElement->setName('Verdana');
$myTextElement->setSize(22);

$writer = PHPWord_IOFactory::createWriter($php_word, 'Word2007');
$writer->save('../plancadre/testWord.docx');


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
















// cpradio donne un exemple avec un template pdf
// http://www.sitepoint.com/community/t/filling-word-doc-from-mysql-database-using-php/22650/9





// autre solution, utiliser un objet COM

// autre solution, utiliser du html pour générer un document que Word peut ouvrir
// pour ensuite l'envoyer comme si c'était un document Word
// semble correct mais pas très efficace
// http://sebsauvage.net/wiki/doku.php?id=word_document_generation











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
