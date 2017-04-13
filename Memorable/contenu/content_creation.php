<?php 
/*si l'utilisateur indique qu'il a fini de créer le questionnaire on lui retourne un message approprié
 *et on unset les variables de sessions pour s'assurer qu'elle ne perturbent pas les créations futures
 *sinon on require les fichiers correspondant au type de questionnaire en cours de création
 */

if (isset($_POST["decision"]) && ($_POST["decision"]) == "arreter") {
    echo "<h2> Bravo vous avez fini de créer le questionnaire " . $_SESSION["nomquestionnaire"] . " qui contient " . $_SESSION["nbquestions"] . " questions !";
    unset($_SESSION["nbquestions"]);
    unset($_SESSION["nomquestionnaire"]);
    unset($_SESSION["idquestionnaire"]);
    unset($_SESSION["type"]);
} else {
    if ((isset($_SESSION["type"]) && $_SESSION["type"]==0) || (isset($_POST["type"]) && $_POST["type"]==0)){
        require("/../creerquestionnaire/creerqr.php");
    }
    else if ((isset($_SESSION["type"]) && $_SESSION["type"]==1) || (isset($_POST["type"]) && $_POST["type"]==1)){
        require("/../creerquestionnaire/creerinfo.php");
    }
    else{
        require("/../creerquestionnaire/creerimage.php");
    }
} 
    
    