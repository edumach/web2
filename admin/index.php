<?php
session_start();
//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE); //vypnutí hlášek na mém localhostu
$jmeno = "admin"; //změnit
$heslo = "1234";  //změnit
if($_SESSION['prihlasen']=="" and $_POST['login']!="") {
	if($_POST['login']==$jmeno and $_POST['heslo']==$heslo){
		$_SESSION['prihlasen']=$jmeno;
	}
}
?>
<!DOCTYPE html>
<html lang="cs">
   <head>
      <meta charset="utf-8">
      <title>Administrační zóna</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="shortcut icon" href="../img/logo.png">
      <meta name="robots" content="noindex,nofollow">
   </head>
   <body>
   <div class="container">
   <?php
   if($_SESSION['prihlasen']!=$jmeno){
	   require "login.php";
   } else {
	   $volej="ano";
	   require "admin.php";
   }
   ?>
   </div>
   </body>
</html>

