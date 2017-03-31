<?php
if (isset($_POST["choix"]) && $_POST["choix"] == "arreter") {
//on unset les variables crees et on affiche un message de remerciement avec liens et stats du remplissage
    Questionnaire::incrementer($dbh, $_SESSION["idquestionnaire"]);
    $_SESSION["queprod"]->incrementer($dbh);
    echo "<a href='index.php?page=liste'>  Revenez à la liste des questionnaires </a>";
    unset($_SESSION["nbreponses"]);
    unset($_SESSION["typequestionnaire"]);
} else {
   if (!isset($_SESSION["typequestionnaire"])){
   $_SESSION["typequestionnaire"] = Questionnaire::getQuestionnaireById($dbh, $_GET["idquestionnaire"])->type;
   }
   if ($_SESSION["typequestionnaire"] == 0){
       require('testqr.php');
   }
   else if ($_SESSION["typequestionnaire"] == 1){
       require('testinfo.php');
   }

}