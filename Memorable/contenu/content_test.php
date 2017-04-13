<?php
/*
 * si l'utilisateur choisit d'arrêter de s'entrainer au questionnaire
 * on ajuste les statistiques associées à ce test (nombre de réalisations
 * du questionnaire ...) et on redirige vers la liste des questionnaires.
 * Sinon on require la page de test associée au type de test
 */
if (isset($_POST["choix"]) && $_POST["choix"] == "arreter") {
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
       require('/../testquestionnaire/testqr.php');
   }
   else if ($_SESSION["typequestionnaire"] == 1){
       require('/../testquestionnaire/testinfo.php');
   }
   else {
       require('/../testquestionnaire/testimage.php');
   }

}