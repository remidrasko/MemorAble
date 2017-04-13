<?php
/*si le choix de l'utilisateur est de s'arrêter avant la fin de l'évaluation on lui propose de revenir à la liste des questionnaires
 *sinon on poursuit l'évaluation et pour cela on require le fichier adapté en fonction du type de questionnaire
 */

if (isset($_POST["choix"]) && $_POST["choix"] == "arreter") {
    echo "<a href='index.php?page=populaires'>  Revenez à la liste des questionnaires </a>";
    unset($_SESSION["nbreponses"]);
    unset($_SESSION["typequestionnaire"]);
} else {
   if (!isset($_SESSION["typequestionnaire"])){
   $_SESSION["typequestionnaire"] = Questionnaire::getQuestionnaireById($dbh, $_GET["idquestionnaire"])->type;
   }
   if ($_SESSION["typequestionnaire"] == 0){
       require('../evaluerquestionnaire/evaluerqr.php');
   }
   else if ($_SESSION["typequestionnaire"] == 2){
       require('../evaluerquestionnaire/evaluerimage.php');
   }

}