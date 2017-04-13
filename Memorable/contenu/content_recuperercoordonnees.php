<?php
/*
 * fait le lien entre l'événement "clic" lors de la création
 * d'un test de type image et la mise à jour des variables de 
 * session correspond aux coordonnées du point désigné par le clic
 */
header("Content-Type: text/plain");
$_SESSION["abscisse"]=$_GET["abscisse"];
$_SESSION["ordonnee"]=$_GET["ordonnee"];
?>
