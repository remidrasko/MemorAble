
<div class="container">
    <h2>Mes questionnaires</h2>
    <table class="table table-bordered">
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
                <td><a href="index.php?page=test&idquestionnaire=$quest->id">$quest->nom </a></td>
                <td>$quest->nbquestions </td>
CHAINE_DE_FIN;
                echo "<td>".$quest->getPourcentage($dbh, $login)."% </td></tr>";
                
            }
            unset($_SESSION["nbreponses"]);
            ?>
        </tbody>
    </table>
</div>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

