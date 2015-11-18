<?php
/* 
	constant.php définie toutes les constantes qui 
	seront utilitées par le site.
*/


/*
------------------------------------------------------------------------------------
	
	début des variables qui contiennent le chemin des différentes pages

------------------------------------------------------------------------------------
*/
define("PAGE_ACCESS", "../controller/page_acces.php");

// account
define("LOGOUT", "../controller/controller_logout.php");

define("VIEW_LOGIN", "../view/view_login.php");
define("VIEW_CREATE_ACCOUNT", "../view/view_create_account.php");
define("VIEW_UPDATE_PASSWORD", "../view/view_update_password.php");

define("CONTROLLER_LOGIN", "../controller/controller_login.php");
define("CONTROLLER_LOGOUT", "../controller/controller_logout.php");
define("CONTROLLER_CREATE_ACCOUNT", "../controller/controller_create_account.php");
define("CONTROLLER_UPDATE_PASSWORD", "../controller/controller_update_password.php");




//accueil
define("VIEW_INDEX", "../view/view_index.php");

// autre vues de base
define("VIEW_SEARCH_PLANCADRE", "../view/view_search_plan_cadre.php");


// données à entrer
define("VIEW_CREATE_PROGRAM", "../view/view_create_program.php");
define("VIEW_CREATE_CLASS", "../view/view_create_class.php");
define("VIEW_CREATE_COMPETENCE", "../view/view_create_competence.php");
define("VIEW_UPDATE_INSTRUCTIONS", "../view/view_update_instructions.php");


define("CONTROLLER_CREATE_CLASS", "../controller/controller_create_class.php");
define("CONTROLLER_CREATE_COMPETENCE", "../controller/controller_create_competence.php");
define("CONTROLLER_CREATE_PROGRAM", "../controller/controller_create_programe.php");



// plancadre
define("VIEW_ASSIGN_USER", "../view/view_assign_user.php");
define("VIEW_ELABORATION_PLANCADRE", "../view/view_elaboration_plancadre.php");
define("VIEW_CREATE_PLANCADRE", "../view/view_create_plancadre.php");

define("CONTROLLER_ASSIGN_USER", "../controller/controller_assign_user.php");
define("CONTROLLER_ELABORATION_PLANCADRE", "../controller/controller_elaboration_plancadre.php");
define("CONTROLLER_CREATE_PLANCADRE", "../controller/controller_create_plancadre.php");


define("CONTROLLER_SEND_FILE", "../controller/controller_send_file.php");




/*
------------------------------------------------------------------------------------
	
	fin des variables qui contiennent le chemin des différentes pages

------------------------------------------------------------------------------------
*/






