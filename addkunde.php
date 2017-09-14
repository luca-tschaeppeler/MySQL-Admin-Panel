<?php

require_once("include/verify.php");
require_once("include/funktion.php");

ini_page();
$pdo = db_con();

validLogin();

$zugang = readAccount($pdo);

kundehinzuFuegen($pdo, $zugang);
header("location: listkunden.php");

?>
