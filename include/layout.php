<?php
function htmlHeader(){
	?>
<!DOCTYPE html>
<html><head>
<meta charset="UTF-8" />
<meta name="Author" content="Luca Tschäppeler" />
<link href="other/style.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Login V1</title>
</head><body>


<?php
}

function standard(){
	validLogin();
	htmlHeader();
	htmlMenue();
	sideMenue();
	echo '<div id="main-body">';
}
function htmlMenue(){
?>

<div class="menuetop">

<ul>

  <li><a style="font-size:22px;cursor:pointer" href="logout.php">Logout</a></li>
  <li><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></li>
</ul>
</div>

<?php
}

function htmlMenuelogin(){
?>

<div class="menuetop">

<ul>

  <li></li>
</ul>
</div>


<?php
}

function sideMenue(){
?>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="listkunden.php">Home</a>

</div>



  


<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
}
</script>

<?php
}


function htmlFooter(){
?>
</div>
</body>
</html>




<?php	
}

?>
