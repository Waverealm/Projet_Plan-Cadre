<?php
/**
 * Created by PhpStorm.
 * User: 201087112//AntoineLatendresse
 * Date: 2015-10-21
 * Time: 10:48
 */
session_start();

//Create File Name
$myfile = fopen($_POST['sauvergarde'] . ".txt", "w");

include_once('../model/queries.php');

if(isset($_POST['submit']) || isset($_POST['save'])) {

    //Enter values from website to variables
    $cours = $_POST['NumeroDeCours'];
    $presentation = $_POST['Presentation'];
    $objectifs = $_POST['Objectifs'];
    $Evaluation = $_POST['Evaluation'];
    $ObjsApprend = $_POST['ObjectifsApprentissage'];

    //Write values in file
    fwrite($myfile, $cours . "\n");
    fwrite($myfile, $presentation . "\n");
    fwrite($myfile, $objectifs . "\n");
    fwrite($myfile, $Evaluation . "\n");
    fwrite($myfile, $ObjsApprend . "\n");
}
else if (isset($_POST['open'])){

}
?>