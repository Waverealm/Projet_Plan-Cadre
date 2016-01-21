<?php
/* 
	constant.php
	Ce fichier définie toutes les constantes qui 
	seront utilitées par le site.
	Fait par Antoine Latendresse
*/


/*
------------------------------------------------------------------------------------
	
	début des variables qui contiennent le chemin des différentes pages
	
	Les constantes sont regroupées selon leur rôle.
	Les vues sont suivies de leur controlleur si elles en ont un.
------------------------------------------------------------------------------------
*/

define("INTERFACE_FUNCTIONS", "../controller/interface_functions.php");
define("REQUETES_BD", "../model/queries.php");

define("MODEL_PAGE", "../model/model_page.php");
define("MODEL_PAGE_ACCESS", "../model/model_pages_access.php");
define("MODEL_COURS", "../model/model_cours.php");
define("MODEL_PROGRAMME", "../model/model_programme.php");
define("MODEL_UTILISATEUR", "../model/model_utilisateur.php");
define("MODEL_PLAN_CADRE", "../model/model_plan_cadre.php");
define("MODEL_SEARCH_PLAN_CADRE", "../model/model_search_plan_cadre.php");



// lien avec le compte utilisateur

define("VIEW_LOGIN", "../view/view_login.php");
define("CONTROLLER_LOGIN", "../controller/controller_login.php");

define("VIEW_CREATE_ACCOUNT", "../view/view_create_account.php");
define("CONTROLLER_CREATE_ACCOUNT", "../controller/controller_create_account.php");

define("VIEW_UPDATE_PASSWORD", "../view/view_update_password.php");
define("CONTROLLER_UPDATE_PASSWORD", "../controller/controller_update_password.php");

define("CONTROLLER_LOGOUT", "../controller/controller_logout.php");


//accueil
define("VIEW_INDEX", "../view/view_index.php");
define("ABOUT", "../view/about.php");

define("VIEW_SEARCH_PLAN_CADRE", "../view/view_search_plan_cadre.php");


// lien avec des données à entrer ou modifier
define("VIEW_CREATE_PROGRAM", "../view/view_create_program.php");
define("CONTROLLER_CREATE_PROGRAM", "../controller/controller_create_program.php");


define("VIEW_MANAGE_CLASS", "../view/view_manage_class.php");
define("CONTROLLER_CREATE_CLASS", "../controller/controller_create_class.php");
define("CONTROLLER_UPDATE_CLASS", "../controller/controller_update_class.php");


define("VIEW_UPDATE_INSTRUCTIONS", "../view/view_update_instructions.php");
define("CONTROLLER_UPDATE_INSTRUCTIONS", "../controller/controller_update_instructions.php");


/*
// les compétences ne sont pas intégrées pour le moment
define("VIEW_CREATE_COMPETENCE", "../view/view_create_competence.php");
define("CONTROLLER_CREATE_COMPETENCE", "../controller/controller_create_competence.php");
*/

// en lien avec le plancadre
define("VIEW_ASSIGN_PLANCADRE", "../view/view_assign_plancadre.php");
define("VIEW_ASSIGN_USER", "../view/view_assign_user.php");
define("CONTROLLER_ASSIGN_USER", "../controller/controller_assign_user.php");

define("VIEW_ELABORATION_PLANCADRE", "../view/view_elaboration_plancadre.php");
define("CONTROLLER_ELABORATION_PLANCADRE", "../controller/controller_elaboration_plancadre.php");

define("VIEW_CREATE_PLANCADRE", "../view/view_create_plancadre.php");
define("CONTROLLER_CREATE_PLANCADRE", "../controller/controller_create_plancadre.php");

// ** à confirmer pourrait être inutile **
define("CONTROLLER_SEND_FILE", "../controller/controller_send_file.php");


/*
------------------------------------------------------------------------------------
	
	fin des variables qui contiennent le chemin des différentes pages

------------------------------------------------------------------------------------
*/







