<?php
require_once("include/verify.php");
require_once("include/funktion.php");

//Started Session and load all
ini_page();
$pdo = db_con();

//check if session aktiv
validLogin();

$zugang = readLoeschen($pdo);
kundeLoeschen($pdo, $zugang);
$pdo = null;
header('Location: listkunden.php');

?>
