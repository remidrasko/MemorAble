<?php
if (!isset($_SESSION["nbquestions"])) {
    /*
     * si l'on est en début de questionnaire on doit initialiser certaines 
     * variables de session (nom du questionnaire, type, nombre de questions)
     * ainsi que procéder à l'insertion du questionnaire dans la base de données
     * qui sera différencié selon que l'utilisateur a choisi ou non 
     * d'illustrer son questionnaire par une image
     * 
     */
    $_SESSION["type"] = 0;
    $_SESSION["nbquestions"] = 0;
    $_SESSION["nomquestionnaire"] = $_POST["nom"];
    if (isset($_FILES['userfile'])) {
        $prefixe = $_SESSION["login"] . "_" . $_POST["nom"] . "_";
        $nom_fichier = $prefixe . $_FILES['userfile']['name'];
        Questionnaire::insererQuestionnaireAvecImage($dbh, $_POST["nom"], $_SESSION["login"], 0, $_POST["description"], $_POST["ouverture"], $nom_fichier);
        $uploaddir = "/xampp/htdocs/Memorable/images/imagequestionnaire/";
        $uploadfile = $uploaddir . basename($nom_fichier);
        if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "Invalid file, possible file upload attack!\n";
        }
    } else {
        Questionnaire::insererQuestionnaire($dbh, $_POST["nom"], $_SESSION["login"], 0, $_POST["description"], $_POST["ouverture"]);
    }
    $_SESSION["idquestionnaire"] = Questionnaire::getQuestionnaire($dbh, $_POST["nom"], $_SESSION["login"])->id;
} else {
     /*
     * sinon c'est que l'utilisateur vient de valider la création de la question précédente
     * il faut donc augmenter la valeur du nombre de questions du questionnaire
     * et insérer la question dans le questionnaire
     */
    $_SESSION["nbquestions"] += 1;
    Question::insererQuestion($dbh, $_POST["question"], $_POST["reponse"], $_SESSION["idquestionnaire"], $_SESSION["nbquestions"]);
}
?>





<div id="creationquestion">
    <form method = "post" action="index.php?page=creation">
        <row>
            <div class="col-md-6 form-group">
                <label for="question">Question:</label>
                <textarea class="form-control" rows="5" id="question" name="question"></textarea>
            </div>
            <div class="col-md-6 form-group">
                <label for="reponse">Réponse:</label>
                <textarea class="form-control" rows="5" id="reponse" name="reponse"></textarea>
            </div>
        </row>
        <row>
            <div class="form-group">
                <button type="submit"  name="decision" class="btn btn-success btn-block" value="continuer">Valider</button>
                <button type="submit" name="decision" class="btn btn-info btn-block" value="arreter">Arrêter le questionnaire</button>
            </div>
        </row>

    </form>

</div>


