<?php

// Session 
session_start();
include 'header.php';

// User connecté
if (array_key_exists( 'firstName', $_SESSION ) && empty($_SESSION) == false ){

	// Modification Session 
    $database = new User();
    //  Nom, Prénom, Age, Mail 
    $database->info_Maj();
    //  Avatar
    $database->avatar_Maj();
	//  Psw 
    $database->psw_Maj();

    // Templating
    $template = 'profil';
    include 'layout.phtml'; 
}

// Redirection
else{
	header('Location: index.php');
	exit();
}

?>
