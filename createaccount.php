<?php
require_once("include/verify.php");
require_once("include/funktion.php");
require_once("include/layout.php");
$pdo = db_con();
$zugang = readRegister($pdo);
createUser($pdo, $zugang);
?>
