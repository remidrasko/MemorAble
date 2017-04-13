<?php
/* page appelée via XMLHttprRequest qui
 * permet la promotion d'un test sur la page d'accueil
 * une fois le bouton correspondant sollicité 
 */
Questionnaire::promouvoir($dbh, $_GET["id"]);
