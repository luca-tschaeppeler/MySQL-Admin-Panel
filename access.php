<?php
require_once("include/verify.php");
require_once("include/funktion.php");

ini_page();
$pdo = db_con();

$zugang = readformularLogin($pdo);

//print_r($_POST);
//echo $zugang["username"];


checkAccess($pdo, $zugang);


$pdo = null;

header('Location: listkunden.php');
?>
