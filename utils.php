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

        <!-- CSS Perso -->
        <link href="css/$cssfile" rel="stylesheet">

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
        "name" =>"test",
        "title"=>"Viens t'entrainer"
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