<?php
$host='localhost';          //téměř vždy localhost
$uzivatel='10XPrijmeniJ';   //respektujte velikost znaků
$heslo='vase_skolni_heslo'; //opravdu je v otevřené podobě, buďte obezřetní
$databaze=$uzivatel;        //jméno i název databáze jsou stejné 

$db = mysqli_connect($host, $uzivatel, $heslo, $databaze);

//kontrola připojení
if (mysqli_connect_errno()) {
  echo "Neda se pripojit k serveru: <mark>" . mysqli_connect_error()."</mark>";
  exit();
  }
?>