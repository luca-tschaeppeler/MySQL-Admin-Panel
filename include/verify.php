<?php
function ini_page(){
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	session_start();
}

function formularLogin(){
	echo '<div class="login"><form method="post" action="access.php">' . "\n";
	
	//Username Formular
	echo '<label>Login</label><div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input style="width: 20%;" size="20" maxlength="20" class="form-control" name="username" type="text" placeholder="Username" /></div><br>';
	
	//Passwort Formular
	echo '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input style="width: 20%;" size="30" maxlength="30" name="passwort" class="form-control" type="password" placeholder="Passwort" /></div><br>';
	
	//Submit Button
	echo '<input style="width: 48%;" type="submit" class="btn btn-info" id="submit" value="Login" />';
	
	echo '</form><br><br><a href="register.php">Register here!</a></div>';
}

function formularRegister(){
		echo '<div class="login"><form method="post" action="createaccount.php">' . "\n";
	
	//Username Formular
	echo '<label>Login</label><div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input style="width: 20%;" size="20" maxlength="20" class="form-control" name="username" type="text" placeholder="Username" /></div><br>';
	
	//Email formular
	
	echo '<div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input style="width: 20%;" size="40" maxlength="40" class="form-control" name="email" type="text" placeholder="Email" /></div><br>';
	
	//Passwort Formular
	echo '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input style="width: 20%;" size="30" maxlength="30" name="passwort" class="form-control" type="password" placeholder="Passwort" /></div><br>';
	
	//Submit Button
	echo '<input style="width: 48%;" type="submit" class="btn btn-info" id="submit" value="Register" />';
	
	echo '</form><br><br><a href="register.php">Login here!</a></div>';
}
function readRegister($pdo){
	
		$zugang = array();

	/*if($row["email"] = $_POST['email']){
		header('Location: list.php');
	}*/
	if (!isset($_POST["username"]) || !isset($_POST["passwort"]) || !isset($_POST["email"]) || strlen($_POST["username"]) == 0  || strlen($_POST["passwort"]) == 0  || strlen($_POST["email"]) == 0){
		return $zugang;
		header('Location: register.php');
	}
	/*if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-Z ]*$/",$_POST["username"]) ) {
  header('Location: register.php');
}*/
	
	$zugang["username"] = $pdo->quote($_POST['username']);
	$zugang["passwort"] = $pdo->quote($_POST['passwort']);
	$zugang["email"] = $pdo->quote($_POST['email']);
	//echo $zugang["email"];
		$sql = "SELECT email FROM user WHERE email like ".$zugang["email"];
	$res = $pdo->prepare($sql);
	$res->execute();
	$row = $res->fetch(PDO::FETCH_ASSOC);
	//print_r ($row);

	if($row["email"] == $zugang["email"]){
		header('Location: register.php');
	}


}

function createUser($pdo, $zugang){

	$sql = "INSERT INTO user set name=".$zugang["username"].", passwort=".$zugang["passwort"].", email=".$zugang["email"];
	$res = $pdo->prepare($sql);
	//echo 'sql: ' . $sql;
	$res->execute();
	//echo "account created";
	header('Location: login.php');
}


function db_con(){
	$db_host = 'localhost';
	$db_name = 'db_schema';
	$db_user = 'db_root';
	$db_password = 'db_password';
	$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
	
	return $pdo;
}

//Check if User have a session
function validLogin(){
	if (!isset($_SESSION) || !isset($_SESSION["user_id"]) || $_SESSION["user_id"] == 0){
		header('Location: relogin.php');
	}

}
function checkAccess($pdo, $zugang){
//	$res = $pdo->prepare("select count(*) as cnt from user where name like ':name' and passwort like 'nopwd'");
//	$res->bindParam(':name', $zugang["username"]);
//	$res->bindParam(':passwort', $zugang["passwort"]);

	$res = $pdo->prepare("select id from user where name like " . $zugang["username"] . " and passwort like " . $zugang["passwort"]);
	
	$res->execute();
	if ($res->rowCount() == 0){
		header('Location: relogin.php');
	}
	$row = $res->fetch(PDO::FETCH_ASSOC);
	
	$_SESSION["user_id"] = $row["id"];
	$res->closeCursor();
}

function joinlist(){
	header('Location: listkunden.php');
}


?>
