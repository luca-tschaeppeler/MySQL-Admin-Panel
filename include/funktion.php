<?php
function readformularLogin($pdo){
	$zugang = array();
	
	$zugang["username"] = $pdo->quote($_POST['username']);
	$zugang["passwort"] = $pdo->quote($_POST['passwort']);
	
	return $zugang;
}
function getKunden($pdo){
	$res = $pdo->prepare("select id, name, vorname, email, coins from kunden order by name, vorname");
	$res->execute();
	echo '<table rules="cols">';
	echo '<colgroup><col width="100px" /><col width="100px" /><col width="100px" /><col width="100px" /><col width="100px" /><col width="100px" /><col width="100px" /></colgroup>';
	echo "<tr><td>Name</td><td>Firstname</td><td>E-mail</td><td>Coins</td><td>edit</td><td>delete</td></tr>";
	while($row = $res->fetch(PDO::FETCH_ASSOC)){
		$form = '<form method="POST" action="editkunde2.php">'
			. '<input type="hidden" name="id" value="' . $row["id"] . '" />'
			. '<input type="submit" class="list" value="edit" />'	
			. '</form></td>' . "\n"
			. '<td><form method="POST" action="deletekunde.php">'
			. '<input type="hidden" name="id" value="' . $row["id"] . '" />'
			. '<input type="submit" class="list" value="delete" />'
			. '</form>' . "\n";
		echo "<tr><td>". $row["name"]."</td><td>".$row["vorname"]."</td><td>" .$row["email"]."</td><td>" .$row["coins"]."</td><td>"
		. $form . "</td></tr>";
	}
	echo "</table>";
	$res->closeCursor();
}
function kundeAendern($pdo, $editID){
		$res = $pdo->prepare("select name, vorname, email, coins from kunden where id =".$editID);
	$res->execute();
	$row = $res->fetch(PDO::FETCH_ASSOC);
	echo '<div id="editkundemiddle"><form method="post" action="editkunde.php">';
	
	echo '<input type="hidden" name="id" value="' . $editID . '" />';
	
	echo '<label>Stored Firstname: ' .$row["vorname"]. '</label><br>';
	
	echo '<div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input class="form-control" type="text" name="vorname" value="' . $row["vorname"] . '"/></div><br>';
	
	echo '<label>Stored Name: '.$row["name"]. '</label><br>';
	
	echo '<div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input class="form-control" type="text" name="name" value="' . $row["name"] . '"/></div><br>';
	
	echo '<label>Stored E-Mail: '.$row["email"].'</label><br>';
	
	echo '<div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input class="form-control" type="text" name="email" size="40" value="'.$row["email"].'"/></div><br>';
	
	echo '<label>Stored Coins: '.$row["coins"]. '</label><br>';
	
	echo '<div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input class="form-control" type="text" name="coins" value="' . $row["coins"] . '"/></div><br></br>';
	
	echo '<input style="width:20%; color: #000; background-color: green; border-color: green;" type="submit"  class="btn btn-info" value="Submit"/></br></br>';
	echo '<input style="width:20%; color: #000; background-color: red; border-color: red;" type="reset"  class="btn btn-info" value="Reset"/></form></div>';
	
$res->closeCursor();
}

function readLoeschen($pdo){
	$zugang = array();
		if (!isset($_POST) || !isset($_POST["id"]) || $_POST["id"] == 0){
		return $zugang;
	}
	$zugang["id"] = $_POST['id'];
	
	return $zugang;
}

function readKundenformular($pdo){
	$zugang = array();
	
	if (!isset($_POST) || !isset($_POST["id"]) || $_POST["id"] == 0){
		return $zugang;
	}
	
	$zugang["id"] = $_POST['id'];
	$zugang["name"] = $pdo->quote($_POST['name']);
	$zugang["vorname"] = $pdo->quote($_POST['vorname']);
	$zugang["email"] = $pdo->quote($_POST['email']);
	$zugang["coins"] = $pdo->quote($_POST['coins']);
	
	return $zugang;
}

function updateKunde($pdo, $zugang){
	$sql = "UPDATE kunden SET name=".$zugang["name"].", coins=".$zugang["coins"].", vorname=".$zugang["vorname"].", email=".$zugang["email"]." WHERE id =".$zugang["id"];
	$res = $pdo->prepare($sql);
	//echo 'sql: ' . $sql;
	$res->execute();

}

function kundeLoeschen($pdo, $zugang) {
	$sql = "DELETE FROM kunden WHERE id =".$zugang["id"];
	$res = $pdo->prepare($sql);
	//echo 'sql: ' . $sql;
	$res->execute();
}
function neuerKunde(){
		echo '<br><h4>Add Kunde</h4>';
	echo '<form method="post" action="addkunde.php">';
	
	echo '<label>Firstname</label><br>';
	
	echo '<div class="input-group">';
	
	echo '<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>';
	
	echo '<input size="20" maxlength="20" class="form-control" type="text" name="vorname" placeholder="Vorname"/><br>';
	
	echo '</div>';
	
	echo '<label>Name:</label><br>';
	
	echo '<div class="input-group">';
	
	echo '<span class="input-group-addon"><i class="glyphicon glyphicon-heart"></i></span>';
	
	echo '<input size="30" maxlength="30" class="form-control" type="text" name="name" placeholder="Name"/><br>';
	
	echo '</div>';
	
	echo '<label>E-Mail:</label><br>';
	
	echo '<div class="input-group">';
	
	echo '<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>';
	
	echo '<input size="30" maxlength="30" class="form-control" type="text" name="email" size="40" placeholder="Email"/><br>';
	
	echo '</div><br>';
	
	echo '<input style="width:42.5%; color: #000; background-color: #FFA500; border-color: #FFA500;" type="submit"  class="btn btn-info" value="Create Kunde"/>';
	echo '</form>';
	
}

function readAccount($pdo){
		$zugang = array();
	
	if (!isset($_POST["name"]) || !isset($_POST["vorname"]) || !isset($_POST["email"]) || strlen($_POST["name"]) == 0  || strlen($_POST["vorname"]) == 0  || strlen($_POST["email"]) == 0){
		return $zugang;
		header('Location: listkunden.php');
	}
	
	$zugang["name"] = $pdo->quote($_POST['name']);
	$zugang["vorname"] = $pdo->quote($_POST['vorname']);
	$zugang["email"] = $pdo->quote($_POST['email']);
	
	return $zugang;
}

function kundehinzuFuegen($pdo, $zugang){
	$sql = "INSERT INTO kunden set vorname=".$zugang["vorname"].", name=".$zugang["name"].", email=".$zugang["email"];
	$res = $pdo->prepare($sql);
	echo 'sql: ' . $sql;
	$res->execute();
	echo "account created";
}
?>
