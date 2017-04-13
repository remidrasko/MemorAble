<?php

if ((isset($_POST["choix"]) && $_POST["choix"]=="valider") || (isset($_SESSION["choix"]) && $_SESSION["choix"]=="valider")){
    /*
     * configuration dans laquelle l'utilisateur vient de rentrer la réponse 
     * à une question; on doit tester $_POST["choix"] et $_SESSION["choix"]
     * car l'utilisateur peut valdier sa réponse en cliquant sur un submit
     * (ce qui donne une valeur via post à choix) ou en appuyant sur entrée
     * (ce qui via du javascript donne une valeur à la variable de session choix)
     */
    $choix = 1;
}
else{
    /*
     * configuration dans laquelle il faut afficher une nouvelle question
     * à l'utilisateur
     */
    $choix = 0;
}
if ($choix == 0) {
    if (!isset($_SESSION["nbreponses"])) {
     /*
     * si l'utilisateur vient d'arriver sur le questionnaire
     * on initialise certaines variables de sessions
     * notamment tabqueprod qui contient le tableau des 
     * produits question-utilisateur avec les pondérations
     * de bonnes et de mauvaises réponses qui vont déterminer
     * la fréquence d'apparition de chaque question
     */
        $_SESSION["idquestionnaire"] = $_GET["idquestionnaire"];
        $_SESSION["queprod"] = Utilisateur_Questionnaire::getQuestionnaireProduit($dbh, $_SESSION["login"], $_GET["idquestionnaire"], 0);

        $_SESSION["tabqueprod"] = Utilisateur_Question::getQuestionsProduit($dbh, $_SESSION["queprod"]->idquestionnaire, $_SESSION["queprod"]->login);

        $_SESSION["longquestionnaire"] = count($_SESSION["tabqueprod"]);
        $_SESSION["nbreponses"] = 0;
    } else {
     /*
     * on met à jour le tableau des produits
     * question-utilistauer pour adapter la fréquence
     * des questions en fonction de la réponse
     * précédente
     */
        $_SESSION["tabqueprod"] = Utilisateur_Question::getQuestionsProduit($dbh, $_SESSION["queprod"]->idquestionnaire, $_SESSION["queprod"]->login);
    }
 /*
 * on utilise la fonction aleatqr pour déterminer une
 * question au hasard en fonction du tableau du nombre
 * de bonnes et de mauvaises réponses
 */
    $_SESSION["questionprodcourante"] = aleatqr($_SESSION["tabqueprod"]);
    $_SESSION["questioncourante"] = Question::getQuestion($dbh, $_SESSION["questionprodcourante"]->idquestion);

    ?>
    <div id="creationquestion">
        <form method = "post" id="form1" action="index.php?page=test">
            <row>
                <div class="col-md-6 form-group">
                    <h3>Question</h3>
                    <p><?php echo $_SESSION["questioncourante"]->question ?></p>
                </div>
                <div class="col-md-6 form-group">
                    <label for="reponse">Réponse:</label>
                    <textarea class="form-control" rows="5" id="reponse" name="reponse" onkeydown="validation(event);"></textarea>
                </div>
            </row>
            <row>
                <div class="form-group">
                    <button type="submit"  name="choix" class="btn btn-success btn-block" value="valider">Valider</button>
                    <button name="choix" style ="float:right " class="btn btn-info btn-block" value="arreter">Arrêter le questionnaire</button>
                </div>
            </row>

        </form>

      

    </div>
    <?php
} else {
    unset($_SESSION["choix"]);
    /*
     * on détermine si la réponse était correcte et on modifie dans la base de données
     * le produit question-utilisateur pour garder en mémoire si la réponse était 
     * correcte ou non; on affiche à l'utilisateur la bonne réponse
     */
    $bonnereponse = reco($_POST["reponse"], $_SESSION["questioncourante"]->reponse);
    $_SESSION["questionprodcourante"]->incrementerUtilisateurQuestion($dbh, $bonnereponse);
    ?>
    <div id="creationquestion">
        <form method = "post" action="index.php?page=test">
            <row>
                <div class="col-md-4">
                    <h3>Question</h3>
                    <h4><?php echo $_SESSION["questioncourante"]->question ?></h4>
                </div>
                <div class="col-md-4">
                    <h3>Votre réponse</h3>
                    <?php
                    if ($bonnereponse) {
                        echo "<h4 style='color:greenyellow'>" . $_POST['reponse'] . "</h4>";
                    } else {
                        echo "<h4 style='color:red'>" . $_POST['reponse'] . "</h4>";
                    }
                    ?>
                </div>
                <div class="col-md-4">
                    <h3>La bonne réponse:</h3>
                    <h4 style="color:greenyellow"><?php echo $_SESSION["questioncourante"]->reponse ?></h4>
                </div>
            </row>
            <row>
                <div class="form-group">
                    <button type="submit"  name="choix" class="btn btn-success btn-block" value="continuer">Continuer</button>
                    <button  name="choix" class="btn btn-info btn-block" value="arreter">Arrêter le questionnaire</button>
                </div>
            </row>

        </form>

    </div>
    <?php
}
?>