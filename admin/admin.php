<?php
//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE); //vypnutí hlášek na mém localhostu
if($volej!="ano"){
	echo '<a href=".">Musíte se přihlásit.</a>';
	exit();
}
?>
<div class="card">
	<div class="card-header">
		<ul class="nav">
		<li class="nav-item"><a href="odhlas.php" class="nav-link">Odhlásit se</a></li> 
		<li class="nav-item"><a href="index.php?page=texty" class="nav-link">Seznam textů</a></li> 
		<li class="nav-item"><a href='http://<?php echo $_SERVER['SERVER_NAME']."/web2";?>' target="_blank" class="nav-link">Zobrazit web</a></li>
		</ul>
    </div>

    <div class="card-body">
		<?php 
		if($_GET['page']=="texty") {
			if($_GET['id']==""){
				require "seznam.php"; 
			} else {
				require "edit-text.php";
			}
		}
		?>
    </div>
</div>
