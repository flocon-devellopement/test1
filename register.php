<?php

// Session 
session_start();

// Class 
include 'class/Request.class.php';
include 'class/Connect.class.php';

// Champs remplis 
if(empty($_POST) == false) {
	// Appel de class 
	$register_User = new Connect();
	$register_User->register($_POST);

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