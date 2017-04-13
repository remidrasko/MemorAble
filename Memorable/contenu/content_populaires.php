<!-- Ici on affiche la liste des tests publics avec le nombre de questions associé,
le pourcentage de réussite si l'internaute est authentifié, ainsi que la possibilité
d'épingler et de supprimer le test si l'utilisateur est administrateur
-->

<div class="container">
    <h2>Questionnaires publics</h2>
    <table id="datat" class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre de questions
                </th>
                <?php if (isset($_SESSION["login"])){echo "<th>Pourcentage de réussite</th>" ;}?>
                <th>Nombre de réalisations </th>
                <?php if (isset($_SESSION["admin"])){echo"<th>Promouvoir ce quiz</th><th>Supprimer ce quiz</th>";} ?>

            </tr>
        </thead>
        <tbody>
            <?php
            $tab = Questionnaire::getQuestionnairesPublics($dbh);
            foreach ($tab as $quest) {
                echo <<<CHAINE_DE_FIN
                <tr>
                <td><a href="index.php?page=presentation&idquestionnaire=$quest->id">$quest->nom </a></td>
                <td>$quest->nbquestions </td>
CHAINE_DE_FIN;
                if (isset($_SESSION["login"])) {echo "<td>" . $quest->getPourcentage($dbh, $_SESSION["login"]) . "% </td>";}
                echo "<td>$quest->realisations</td>";
                if (isset($_SESSION["admin"])){
                   echo "<td>";
                   if ($quest->pageaccueil == 0) {
                    echo "<button type='button' class='btn btn-default btn-xs' onclick='promouvoir(".$quest->id.")'><span class='glyphicon glyphicon-pushpin'></span></button>";
                }
                   echo "</td><td><button type='button' class='btn btn-default btn-xs' onclick='supprimer(".$quest->id.")'><span class='glyphicon glyphicon-trash'></span></button></td>";
                }
                echo "</tr>";
                
            }
            unset($_SESSION["nbreponses"]);
            ?>
        </tbody>
    </table>
</div>

