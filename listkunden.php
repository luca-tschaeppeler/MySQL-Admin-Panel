<?php

require_once("include/verify.php");
require_once("include/funktion.php");
require_once("include/layout.php");

//Started Session and load all
ini_page();
$pdo = db_con();

//check if session aktiv
standard();




getKunden($pdo);



neuerKunde();

htmlFooter();

?>

