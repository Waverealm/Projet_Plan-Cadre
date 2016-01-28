<?php
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}
	
	function estAdmin()
	{
		return ( isset($_SESSION[ "type_utilisateur" ]) && $_SESSION[ "type_utilisateur" ] == "Administrateur");
	}
	// conseiller pédagogique
    function estCP()
	{
		return ( isset($_SESSION[ "type_utilisateur" ]) && $_SESSION[ "type_utilisateur" ] == "Conseiller pédagogique");	
	}
	function estElaborateur()
	{
		return ( isset($_SESSION[ "type_utilisateur" ]) && $_SESSION[ "type_utilisateur" ] == "Conseiller pédagogique");
	}
	function estConnecter()
	{
		return ( isset($_SESSION[ "type_utilisateur" ]) );
	}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?php echo BASE_PATH . "/public/css/header.css" ; ?>">

<title>Projet Plan-Cadre</title>
<style>
</style>
</head>
<body>
		<div class="header"><h1>PLAN-CADRE</h1></div>
		<nav class="navbar navbar-default nav-bar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo BASE_PATH ?>">
						Accueil
					</a>
				</div>
				<ul class="nav navbar-nav">
				<?php
					if(estConnecter())
					{
				?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Plan-cadre
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Recherche</a></li>
								<li><a href="#">Élaborer un plan-cadre</a></li>
							</ul>
						</li>
				<?php
					}
					else
					{
				?>
						<li><a href="<?php echo BASE_PATH . "/" . "plancadres" . "/" . "recherche"; ?>">Plan-cadre</a></li>
				<?php
					}
					if( estAdmin() || estCP() )
					{
						// gestion de l'information
						// gestion des utilisateurs
					?>
					<?php
					}
					?>
					<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Gestion de l'information
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
								<li class="dropdown-header"> Cours </li>
								<li><a href="#">Ajouter un cours</a></li>
								<li><a href="#">Modifier un cours</a></li>
								<li class="divider"></li>
								<li class="dropdown-header"> Programme </li>
								<li><a href="#">Ajouter un programme</a></li>
								<li><a href="#">Modifier un programme</a></li>
								<li class="divider"></li>
								<li class="dropdown-header"> Plan-cadre </li>
								<li><a href="#">Modifier les consignes </a></li>
						</ul>
					</li>
					<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Gestion des utilisateurs
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
								<li class="dropdown-header"> Compte </li>
								<li><a href="#"> Créer un compte </a></li>
								<li><a href="#"> Assigner un nouveau mot de passe</a></li>
								<li class="divider"></li>
								<li class="dropdown-header"> Plan-cadre </li>
								<li><a href="#"> Ajouter une assignation </a></li>
								<li><a href="#"> Retirer une assignation </a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo BASE_PATH . "/" . "utilisateurs" . "/" . "connexion" ;?>"><span class="glyphicon glyphicon-log-in"></span> Connexion </a></li>
				</ul>
			</div>
		</nav>
<div class="container">