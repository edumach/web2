<?php 
require "pripojeni.php";

$dotaz='SELECT nazev,urlnazev FROM texty WHERE urlnazev NOT LIKE "error404"'; //z tabulky vytáhni všechny názevy a URL bez stránky error404 		
$vysledek=mysqli_query($db,$dotaz); //výsledek ulož do pole $vysledek

@$aktivni=htmlspecialchars(strip_tags($_GET['page'])); //zjisti, která stránka je aktivní
    if($aktivni==''){ //pokud je hodnota "page" prázdná 
        $aktivni='index'; //nastav ji hodnotu index
    }

while($radek = mysqli_fetch_assoc($vysledek)){ //projdi pole $vysledek polozku po položce
    if($aktivni==$radek['urlnazev']){ // pokud urlnazev odpovídá aktivní, pošli řádek s bootstrapovou třídou "active"  
        echo '<li class="nav-item"><a class="nav-link active" href="index.php?page='.$radek['urlnazev'].'">'.$radek['nazev'].'</a></li>'; 
    } else {
        echo '<li class="nav-item"><a class="nav-link" href="index.php?page='.$radek['urlnazev'].'">'.$radek['nazev'].'</a></li>'; 
    }
}
?>
