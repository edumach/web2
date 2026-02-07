<?php
session_start();
//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE); //vypnutí hlášek na mém localhostu
if($volej!="ano"){
	echo '<a href=".">Musíte se přihlásit.</a>';
	exit();
}
require "../pripojeni.php";

if(isset($_POST["nazev"])){
	$nazev=$_POST["nazev"];
	$urlnazev=$_POST['urlnazev'];
	$text=$_POST['text'];
	$slova=$_POST['slova'];
	$metapopis=$_POST['metapopis'];
}

//editovat stránku
if(isset($_POST["nazev"]) && $_GET['id']!="new" && $_POST['del']!="ano") { 
	$dotaz="UPDATE texty SET nazev='".$nazev."', urlnazev='".$urlnazev."', text='".$text."', klicovaslova='".$slova."',   metapopis='".$metapopis."' WHERE idtextu='".$_GET['id']."' ";
	if(mysqli_query($db,$dotaz)) {
		echo '<div class="alert alert-success">Změny byly úspešne uloženy do databáze.</div>';
	} else {
		echo '<div class="alert alert-danger">Nepodařilo se uložit změny do databáze!</div>';
	}
}

//nová stránka
if(isset($_POST["nazev"]) && $_GET['id']=="new") {
	$dotaz = 'INSERT INTO texty (nazev, text, urlnazev, klicovaslova, metapopis) VALUES ("'. $nazev. '", "'. $text. '",  "'. $urlnazev. '", "'. $slova. '", "'. $metapopis. '")';
    $vysledky = mysqli_query($db,$dotaz) or die(mysqli_error($db));
	if($vysledky) {
		echo '<div class="alert alert-success">Text byl úspěšně přidán do databáze.</div>';
	} else {
		echo '<div class="alert alert-danger">Text se nepodařilo přidat do databáze.</div>';
	}
	echo '<html><meta http-equiv="REFRESH" content="5;index.php?page=texty"></html>';
	exit();
}

//výpis konkrétního textu (článku)
if($_GET['id']!="new"){
	$dotaz='SELECT * FROM texty WHERE idtextu="'.$_GET['id'].'"';
	$vysledek=mysqli_query($db,$dotaz);
	$zaznam=mysqli_fetch_array($vysledek);
}

//smazat stránku
if(isset($_POST["nazev"]) && $_POST['del']=="ano") {
	$dotaz = "DELETE FROM texty WHERE idtextu=".$_GET['id']."";
	$vysledky = mysqli_query($db,$dotaz) or die(mysqli_error($db));
	if($vysledky) {
		echo '<div class="alert alert-success">Text byl úspěšně odstraněn z databáze.</div>';
	} else {
		echo '<div class="alert alert-danger">Text se nepodařilo odstranit z databáze.</div>';
	}
	echo '<html><meta http-equiv="REFRESH" content="5;index.php?page=texty"></html>';
	exit();
}
?>

<form id="clanek" name="clanek" method="post">
<div class="form-group">
<label for="nazev">Název textu:</label>
<input type="text" class="form-control" name="nazev" id="nazev" value="<?php echo $zaznam['nazev']; ?>" required> 
</div>

<div class="form-group">
<label for="urlnazev">URLnázev:</label>
<input type="text" class="form-control" name="urlnazev" id="urlnazev" value="<?php echo $zaznam['urlnazev']; ?>" required>
</div>

<div class="form-group">
<label for="text">Text:</label>
<textarea name="text" class="form-control" id="text" rows="10" required><?php echo $zaznam['text']; ?></textarea>
</div>

<div class="form-group">
<label for="slova">Klíčová slova:</label>
<input type="text" class="form-control" name="slova" id="slova" value="<?php echo $zaznam['klicovaslova']; ?>">
</div>

<div class="form-group">
<label for="metapopis">Metapopis:</label>
<input name="metapopis" class="form-control" id="metapopis" value="<?php echo $zaznam['metapopis'];?>">

<?php
if($_GET['id']!="new"){ 
 echo "<br><input type='checkbox' name='del' value='ano'> <span class='text-danger'>Trvale odstranit tento text (akci nelze vrátit)</span>";
}
?>
</div>

<input type="submit" class="btn btn-primary" value="Uložit změny"><br>
</form>
