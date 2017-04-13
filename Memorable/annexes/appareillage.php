<?php

/*
 * appareillage.php sert uniquement à l'administrateur pour ajouter plus rapidement
 * des questionnaire dont les questions sont déjà présentes dans la base de données
 * (via l'upload d'un fichier excel par exemple)
 */

require ('../requetes.php');

class Appareillage {

    public $info1;
    public $info2;

}

$dbh = Database::connect();
$tab = array();
$query = "SELECT * FROM `appareillage`";
$sth = $dbh->prepare($query);
$sth->setFetchMode(PDO::FETCH_CLASS, 'Appareillage');
$sth->execute(array());

while ($question = $sth->fetch()) {
    $tab[] = $question;
}

Questionnaire::insererQuestionnaire($dbh, "les prefectures 2", "guillaumot.theo", 0, " ");
$compteur = 1;
$idquestionnaire = Questionnaire::getQuestionnaire($dbh, "les prefectures 2", "guillaumot.theo")->id;
foreach($tab as $elem){
    Question::insererQuestion($dbh, $elem->info1, $elem->info2, $idquestionnaire, $compteur);
    $compteur +=1 ;
}