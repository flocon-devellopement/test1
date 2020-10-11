<?php

// Session 
session_start();
include 'header.php';

// Admin connecté
if ( $_SESSION['role'] != 'user' && !empty($_SESSION) ){
	
	// Affichage 
	$database = new Site();
	// Articles
	$result_Articles = $database->articles();
	// Commandes
	$result_Commandes = $database->commandes();




	// Gestion
	$admin = new Admin();
	// Affichage User 
	$result_User = $admin->user();
	// Ajout Header
	$admin->header_Post();
	// Ajout Articles
	$admin->articles_Post();
	// Ajout Commandes
	$admin->commandes_Post();
	// Suprimer Articles / Commandes / Header / User
	$admin->delete_Post();

	$result_Comm = $database->comments();

}

// Redirection
else{
	header('Location: index.php');
	exit();
}

// Templating
$template = 'admin';
include 'layout.phtml';

?>


