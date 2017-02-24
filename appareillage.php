<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require ('requetes.php');

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
    print_r($question);
}

Questionnaire::insererQuestionnaire($dbh, "les prefectures 2", "guillaumot.theo", 0, " ");
$compteur = 1;
$idquestionnaire = Questionnaire::getQuestionnaire($dbh, "les prefectures 2", "guillaumot.theo")->id;
foreach($tab as $elem){
    Question::insererQuestion($dbh, $elem->info1, $elem->info2, $idquestionnaire, $compteur);
    $compteur +=1 ;
}