<!-- A la fin d'une évaluation on affiche à l'utilisateur son score;
si d'autres internautes ont déjà effectué ce test on compare le score réalisé
aux scores précédemment réalisés; enfin on ajoute à la table des évaluations
le pourcentage courant;
-->

<h2>Questionnaire terminé !</h2>
<h3>Votre score est de <?php echo $_SESSION["bonnesreponses"]." / ".$_SESSION["longquestionnaire"]?></h3>
<?php
$a = $_SESSION["bonnesreponses"];
$b = $_SESSION["longquestionnaire"];
$comparaison = Resultat_Evaluation::comparaison($dbh, $_SESSION["idquestionnaire"], $a/$b);
if ($comparaison != null){
    echo "Vous avez fait mieux que ".$comparaison." % des internautes";
}
Resultat_Evaluation::insererPourcentage($dbh, $_SESSION["idquestionnaire"], (int)(100*$a/$b)/100);
echo "<a href='index.php?page=populaires'>  Revenez à la liste des questionnaires </a>";

?>