<?php
/* page appelée via XMLHttprRequest qui
 * permet la suppression d'un test 
 * une fois le bouton correspondant sollicité 
 */
Questionnaire::supprimer($dbh, $_GET["id"]);
