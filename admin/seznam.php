<?php
//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE); //vypnutí hlášek na mém localhostu
if($volej!="ano"){
	echo '<a href=".">Musíte se přihlásit.</a>';
	exit();
}
require "../pripojeni.php";
$dotaz='SELECT * FROM texty';		
$vysledek=mysqli_query($db,$dotaz);
echo '<div class="list-group">';
while($zaznam=mysqli_fetch_array($vysledek)){
	echo '<a href="index.php?page=texty&id='.$zaznam['idtextu'].'" class="list-group-item list-group-item-action">'.$zaznam['nazev'].'</a>';
}
echo '</div>';

echo '<br><button type="button" class="btn btn-primary"><a href="index.php?page=texty&id=new" style="text-decoration:none;color:inherit;">Přidat stránku</a></button>';

?>
