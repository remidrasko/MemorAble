<?php  if (isset($_POST["decision"]) && ($_POST["decision"]) == "arreter") {
    echo "<h2> Bravo vous avez fini de créer le questionnaire " . $_SESSION["nomquestionnaire"] . " qui contient " . $_SESSION["nbquestions"] . " questions !";
    unset($_SESSION["nbquestions"]);
    unset($_SESSION["nomquestionnaire"]);
    unset($_SESSION["idquestionnaire"]);
} else {
    if ((isset($_SESSION["type"]) && $_SESSION["type"]==0) || (isset($_POST["type"]) && $_POST["type"]==0)){
        require("creerqr.php");
    }
    else if ((isset($_SESSION["type"]) && $_SESSION["type"]==1) || (isset($_POST["type"]) && $_POST["type"]==1)){
        require("creerinfo.php");
    }
} 
    
    