<!-- Ici on affiche la liste des questionnaires de l'utilisateur
avec le nombre de question correspondant ainsi que le pourcentage
de réussite. On donne également l'attribue datat à la table pour
que le plugin Data-Table la transforme via le script javascript 
-->

<div class="container">
    <h2>Mes questionnaires</h2>
        <table id="datat" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre de questions
                </th>
                <th>Pourcentage de réussite</th>
                    
            </tr>
        </thead>
        <tbody>
            <?php 
            $tab = Questionnaire::getQuestionnaires($dbh, $_SESSION["login"]);
            $login =  $_SESSION["login"];
            foreach($tab as $quest){
                echo <<<CHAINE_DE_FIN
                <tr>
                <td><a href="index.php?page=presentation&idquestionnaire=$quest->id">$quest->nom </a></td>
                <td>$quest->nbquestions </td>
CHAINE_DE_FIN;
                echo "<td>".$quest->getPourcentage($dbh, $login)."% </td></tr>";
                
            }
            unset($_SESSION["nbreponses"]);
            ?>
        </tbody>
    </table>
</div>

