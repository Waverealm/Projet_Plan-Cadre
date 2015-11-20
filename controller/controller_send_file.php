<?php


//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename = "plancadre.pdf"');


// créer un nouveau fichier et l'envoyer au client
// la prochaine requête écrasera le fichier
// trouver comment changer le nom en fonction du plancadre choisi


////////////////////////////////////////////////////////////////////////////
require_once '../assets/PHPWord.php';



////////////////////////////////////////////////////////////////////////////
// ceci est l'exemple de basse de PHPWord et fonctione
/*
$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('../assets/template.docx');

$document->setValue('Value1', 'Sun');
$document->setValue('Value2', 'Mercury');
$document->setValue('Value3', 'Venus');
$document->setValue('Value4', 'Earth');
$document->setValue('Value5', 'Mars');
$document->setValue('Value6', 'Jupiter');
$document->setValue('Value7', 'Saturn');
$document->setValue('Value8', 'Uranus');
$document->setValue('Value9', 'Neptun');
$document->setValue('Value10', 'Pluto');

$document->setValue('weekday', date('l'));
$document->setValue('time', date('H:i'));

$document->save('../plancadre/Solarsystem.docx');

*/
////////////////////////////////////////////////////////////////////////////


$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('../assets/template1.docx');

$document->setValue('type_enseignement', 'Enseignement régulier');
$document->setValue('nom_programme', 'test');
$document->setValue('code_programme', '510.A0');
$document->setValue('code_cours', 'John');
$document->setValue('ponderation_cours', 'JBS Marketing');
$document->setValue('prealable_cours', 'u');

$name = 'test.docx';

$document->save('../plancadre/test.docx');

$file = '../plancadre/test.docx';

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



////////////////////////////////////////////////////////////////
// code pour envoyer un fichier au client (download)
/*

$file = '../assets/template.dotx';

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
// exemples au cas où on aurait besoin de changer quelque chose
//

/////////////////////////////////////////////////////////////////////////////////////////
// use phpWord ?
// http://phpword.codeplex.com/
// exemple de PHPWORD pour créer un document
// fonctione correctement, si rien ne fonctionne
// on va probablement devoir s'en servir pour créer
// le template avec du code ce qui n'est pas idéal si
// on veut pouvoir le changer sans changer le code
// (à moins qu'on fasse une interface pour ça ? pas une bonne idée)

/////////////////////////////////////////////////////////////////////////////////////////
// montre comment utiliser objet COM
// semble être mieux que les autres
// faire un essai sur un ordi qui possede office
// http://www.phpbuilder.com/columns/yunus20031124.php3?page=2

/////////////////////////////////////////////////////////////////////////////////////////
// http://www.phpbuilder.com/columns/venkatesan20030501.php3?page=2
// modifier les permissions sur le pc pour permettre à l'application d'être utiliser
// et doit modifier php.ini

/////////////////////////////////////////////////////////////////////////////////////////
// cpradio donne un exemple avec un template pdf
// http://www.sitepoint.com/community/t/filling-word-doc-from-mysql-database-using-php/22650/9

/////////////////////////////////////////////////////////////////////////////////////////
// autre solution, utiliser du html pour générer un document que Word peut ouvrir
// pour ensuite l'envoyer comme si c'était un document Word
// semble correct mais pas très efficace
// http://sebsauvage.net/wiki/doku.php?id=word_document_generation

/////////////////////////////////////////////////////
// trop de code pour très peu de bénéfices
// (savoir clairement ce qu'on envoie)
// pour le type des MIME :
// avec tous les MIME de Office 2007
// http://blogs.msdn.com/b/vsofficedeveloper/archive/2008/05/08/office-2007-open-xml-mime-types.aspx
// autre référence au cas où
// https://technet.microsoft.com/en-us/library/ee309278.aspx
//
// http://stackoverflow.com/questions/11518576/php-send-word-document-file-to-download
