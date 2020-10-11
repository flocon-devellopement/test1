<?php

// Session open 
session_start();

// Session close 
session_destroy();

// Redirection
header('Location: index.php');
exit();

?>