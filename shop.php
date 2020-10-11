<?php

// Session 
session_start();
include 'header.php';

// User connecté
if (array_key_exists( 'firstName', $_SESSION ) && empty($_SESSION) == false ){

	// Affichage Commandes 
	$index_View = new Site();

	$result_Commandes = $index_View->commandes();
	$result_Category = $index_View->category_Commandes();

	// Templating
	$template = 'shop';
	include 'layout.phtml';

}

// Redirection
else{
	header('Location: index.php');
	exit();
}


?>