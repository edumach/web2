<?php 
require "pripojeni.php";
$php=@trim(htmlspecialchars(strip_tags($_GET['page'])));
if($php=="") { 
	$php="index"; 
}
$dotaz='SELECT * FROM texty WHERE urlnazev="'.$php.'"';		
$vysledek=mysqli_query($db,$dotaz);
$zaznam=mysqli_fetch_assoc($vysledek);
if($zaznam['nazev']!="") {
	$nazev=$zaznam['nazev'];
	$text=$zaznam['text'];
	$klicovaslova=$zaznam['klicovaslova'];
	$title=$zaznam['nazev'].' | '. $_SERVER['HTTP_HOST'];
	$metapopis=$zaznam['metapopis'];
}

//pokud je v proměnné page neexistující název 
if($nazev==""){
	echo '<html><meta http-equiv="REFRESH" content="0;index.php?page=error404"></html>';
	die();
}
?>
