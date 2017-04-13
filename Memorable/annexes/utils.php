<?php

function generateHTMLHeader($title, $cssfile) {
// on ecrit HTML
    echo <<<CHAINE_DE_FIN
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> $title </title>

        <!-- CSS Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/jquery.dataTables.min.css" rel="stylesheet">

        <!-- CSS Perso -->
        <link href="css/$cssfile" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script type="text/javascript" src="js/perso.js"></script>

    </head>
    <body>
CHAINE_DE_FIN;
}

function generateHTMLFooter() {
    echo <<<CHAINE_DE_FIN
</body>
</html>
CHAINE_DE_FIN;
}

// on définit l'ensemble des  pages auxquelles l'utilisateur peut accédeer

$pageList = array(
    array(
        "name" => "Accueil",
        "title" => "Accueil"
    ),
    array(
        "name" => "deleteUser",
        "title" => "Supprimer votre compte"
    ),
    array(
        "name" => "inscription",
        "title" => "S'inscrire"
    ),
    array(
        "name" => "changePassword",
        "title" => "Changer votre mot de passe"
    ),
    array(
        "name" => "creer",
        "title" => "Créer un nouveau questionnaire"
    ),
    array(
        "name" => "creation",
        "title" => "Créer une nouvelle question"
    ),
    array(
        "name" => "mesquestionnaires",
        "title" => "Mes questionnaires"
    ),
    array(
        "name" => "liste",
        "title" => "Liste de mes questionnaires"
    ),
    array(
        "name" => "test",
        "title" => "Viens t'entrainer"
    )
    , array(
        "name" => "populaires",
        "title" => "les plus populaires"
    ),
    array(
        "name" => "presentation",
        "title" => "presentation du test"
    ),
    array(
        "name" => "recuperercoordonnees",
        "title" => "recuperation"
    ),
    array(
        "name" => "aide",
        "title" => "aide"
    ),
    array(
        "name" => "valider",
        "title" => "validation"
    ),
    array(
        "name" => "evaluer",
        "title" => "evaluation"
    ),
    array(
        "name" => "bilanevaluation",
        "title" => "bilan"
    ),
    array(
        "name" => "promouvoir",
        "title" => "promotion"
    ),
    array(
        "name" => "supprimer",
        "title" => "suppression"
    )
);

function checkPage($askedPage) {
    global $pageList;
    foreach ($pageList as $page) {
        if ($askedPage == $page["name"]) {
            return true;
        }
    }
    return false;
}

function getPageTitle($askedPage) {
    global $pageList;
    foreach ($pageList as $page) {
        if ($askedPage == $page["name"]) {
            return $page["title"];
        }
    }
    return "Cette page n'existe pas";
}

?>