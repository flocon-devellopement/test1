<?php

// Session 
session_start();

// Class 
include 'class/Request.class.php';
include 'class/Connect.class.php';

// Champs remplis 
if(empty($_POST) == false) {

	// Connexion Session
	$login_User = new Connect();
	$login_User->login($_POST);

	// Templating
	$template = "index";
	include 'layout.phtml';
}

// Redirection
else{
	header('Location: index.php');
	exit();
}

?>