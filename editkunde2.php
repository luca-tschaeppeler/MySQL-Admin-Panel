<?php
require_once("include/verify.php");
require_once("include/funktion.php");
require_once("include/layout.php");

//Started Session and load all
ini_page();
$pdo = db_con();

//check if session aktiv
validLogin();

htmlHeader();

htmlMenue();
sideMenue();
htmlFooter();

if(!isset($_POST) || !isset($_POST["id"]) || !is_numeric($_POST["id"]) || $_POST["id"] < 1){
	
}	
$editID = $_POST["id"];
echo "<p>User ID: " . $editID."</p><br>";
kundeAendern($pdo, $editID);

?>
