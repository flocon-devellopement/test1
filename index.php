<?php

// Session 
session_start();
include 'header.php';

// User connecté
if (array_key_exists( 'firstName', $_SESSION )){
	
	$index_View = new Site();
	// Affichage Articles 
	$result_Articles = $index_View->articles();
	// Affichage Comments 
	$result_Comm = $index_View->comments();
}

// Templating
$template = 'index';
include 'layout.phtml';

?>