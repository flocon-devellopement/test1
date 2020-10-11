<?php

include 'class/Request.class.php';
include 'class/Connect.class.php';
include 'class/Site.class.php';
include 'class/User.class.php';
include 'class/Admin.class.php';


// Affichage Header 
$database = new Site();
$result_Header = $database->header();

?>