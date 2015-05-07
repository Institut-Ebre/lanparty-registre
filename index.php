<?php
//invoca el fitxer que inclou tots els models necesaries per a l'aplicació
require_once "includes.php";

//Creem la primera connexió a la BBDD
$inici = new Inici();
//redireccionem a la pàgina inicial de la nostra aplicació (v_inici.php);
header('Location:includes/vistes/v_inici.php');
?>