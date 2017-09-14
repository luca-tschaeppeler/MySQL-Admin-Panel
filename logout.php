<?php
require_once("include/verify.php");
require_once("include/funktion.php");
ini_page();
session_destroy();
header("location: login.php");
?>
