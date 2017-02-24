<?php
if (isset($_POST["decision"]) && ($_POST["decision"]) == "arreter") {
    echo "<h2> Bravo vous avez fini de créer le questionnaire " . $_SESSION["nomquestionnaire"] . " qui contient " . $_SESSION["nbquestions"] . " questions !";
    unset($_SESSION["nbquestions"]);
    unset($_SESSION["nomquestionnaire"]);
    unset($_SESSION["idquestionnaire"]);
} else {
    if (!isset($_SESSION["nbquestions"])) {
        $_SESSION["nbquestions"] = 0;
        $_SESSION["nomquestionnaire"] = $_POST["nom"];
        Questionnaire::insererQuestionnaire($dbh, $_POST["nom"], $_SESSION["login"], $_POST["type"], $_POST["description"]);
        $_SESSION["idquestionnaire"] = Questionnaire::getQuestionnaire($dbh, $_POST["nom"], $_SESSION["login"])->id;
    } else {
        // code pour ajouter la question contenue dans le POST
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


<?php } ?>