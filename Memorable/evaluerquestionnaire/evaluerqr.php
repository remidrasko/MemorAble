<?php
if ((isset($_POST["choix"]) && $_POST["choix"]=="valider") || (isset($_SESSION["choix"]) && $_SESSION["choix"]=="valider")){
    $choix = 1;
    /*
     * correspond à la configuration ou l'utilisateur vient de répondre à une question 
     * et où il faut alors lui afficher la bonne réponse
     */
}
else{
    $choix = 0;
    /*
     * configuration dans laquelle une question va être posée (ou que 
     * l'utilisateur a cliqué sur continuer ou qu'il vient juste
     * d'arriver sur la page d'évaluation)
     */
}
if ($choix == 0) {
    if (!isset($_SESSION["nbreponses"])) {
        /*
         * si l'on débute le questionnaire on initialise certaines
         * variables de session (notamment une contenant le tableau
         * des questions) et on détermine une permutation des questions;
         * on crée également une variable qui va stocker le 
         * nombre de bonnes réponses;
         */
        $_SESSION["idquestionnaire"] = $_GET["idquestionnaire"];
        $_SESSION["tableauquestion"] = Question::getQuestions($dbh, $_SESSION["idquestionnaire"]);
        $_SESSION["longquestionnaire"] = count($_SESSION["tableauquestion"]);
        $_SESSION["nbreponses"] = 0;
        $_SESSION["bonnesreponses"] = 0;
        $_SESSION["permutation"] = range(0,$_SESSION["longquestionnaire"]-1);
        shuffle($_SESSION["permutation"]);
    } 
    $_SESSION["questioncourante"] = $_SESSION["tableauquestion"][$_SESSION["permutation"][$_SESSION["nbreponses"]]];

    ?>
    <div id="creationquestion">
        <form method = "post" id="form1" action="index.php?page=evaluer">
            <row>
                <div class="col-md-6 form-group">
                    <h3>Question n°<?php echo $_SESSION["nbreponses"]+1;  ?></h3>
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
    $_SESSION["nbreponses"]+=1;
    /* 
     * reconnaissance de la réponse et incrémentation
     * du compteur de bonne réponse si elle est valide
     */
    $bonnereponse = reco($_POST["reponse"], $_SESSION["questioncourante"]->reponse);
    if ($bonnereponse){
        $_SESSION["bonnesreponses"] +=1;
    }
    /*
     * on affiche un formulaire différent selon 
     * qu'il reste encore des questions ou que
     * l'évaluation est terminée
     */
    if ($_SESSION["nbreponses"] < $_SESSION["longquestionnaire"]){
    ?>
    <div id="creationquestion">
        <form method = "post" action="index.php?page=evaluer">
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
else{
    ?>
<div id="creationquestion">
        <form method = "post" action="index.php?page=bilanevaluation">
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
                <!-- quand le questionnaire est terminé on redirige
                    vers une visualisation des résultats
                -->
                <div class="form-group">
                    <button type="submit"  name="choix" class="btn btn-success btn-block" value="continuer">Voir mes résultats</button>
                </div>
            </row>

        </form>

    </div>
<?php

}
}
?>