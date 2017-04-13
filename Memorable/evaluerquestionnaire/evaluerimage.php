
<?php
if ((isset($_POST["choix"]) && $_POST["choix"] == "valider") || (isset($_SESSION["choix"]) && $_SESSION["choix"] == "valider")) {
    /*
     * correspond à la configuration ou l'utilisateur vient de répondre à une question 
     * et où il faut alors lui afficher la bonne réponse
     */
    $choix = 1;
} else {
    /*
     * configuration dans laquelle une question va être posée (ou que 
     * l'utilisateur a cliqué sur continuer ou qu'il vient juste
     * d'arriver sur la page d'évaluation)
     */
    $choix = 0;
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
        $_SESSION["adressecourante"] = Questionnaire::getQuestionnaireById($dbh, $_SESSION["idquestionnaire"])->adresseimage;

        $_SESSION["tableauquestion"] = Question_Image::getQuestions($dbh, $_SESSION["idquestionnaire"]);

        $_SESSION["longquestionnaire"] = count($_SESSION["tableauquestion"]);
        $_SESSION["nbreponses"] = 0;
        $_SESSION["bonnesreponses"] = 0;
        $_SESSION["permutation"] = range(0, $_SESSION["longquestionnaire"] - 1);
        shuffle($_SESSION["permutation"]);
    }
    $_SESSION["questioncourante"] = $_SESSION["tableauquestion"][$_SESSION["permutation"][$_SESSION["nbreponses"]]];
    $_SESSION["abscissecourante"] = $_SESSION["questioncourante"]->abscisse;
    $_SESSION["ordonneecourante"] = $_SESSION["questioncourante"]->ordonnee;
    ?>

    <form style="position: fixed;" class ="form-inline" method = "post" action="index.php?page=evaluer">

        <div class="form-group">
            <label for="reponse">Réponse:</label>
            <input type="text" class="form-control"  id="reponse" name="reponse"></input>
        </div>

        <button type="submit"  name="choix" width="100px" class="btn btn-success" value="valider">Valider</button>
        <button type="submit" name="choix" width="100px" class="btn btn-info " value="arreter">Arrêter le questionnaire</button>




    </form>



    <?php
} else {
    unset($_SESSION["choix"]);
    $_SESSION["nbreponses"] += 1;
    /* 
     * reconnaissance de la réponse et incrémentation
     * du compteur de bonne réponse si elle est valide
     */
    $bonnereponse = reco($_POST["reponse"], $_SESSION["questioncourante"]->reponse);
    if ($bonnereponse) {
        $_SESSION["bonnesreponses"] += 1;
    }
    /*
     * on affiche un formulaire différent selon 
     * qu'il reste encore des questions ou que
     * l'évaluation est terminée
     */
    if ($_SESSION["nbreponses"] < $_SESSION["longquestionnaire"]) {
        ?>
        <div id="creationquestion">
            <form method = "post" action="index.php?page=evaluer">
                <row>
                    <div class="col-md-6">
                        <h3>Votre réponse</h3>
                        <?php
                        if ($bonnereponse) {
                            echo "<h4 style='color:greenyellow'>" . $_POST['reponse'] . "</h4>";
                        } else {
                            echo "<h4 style='color:red'>" . $_POST['reponse'] . "</h4>";
                        }
                        ?>
                    </div>
                    <div class="col-md-6">
                        <h3>La bonne réponse:</h3>
                        <h4 style="color:greenyellow"><?php echo $_SESSION["questioncourante"]->reponse ?></h4>
                    </div>
                </row>
                <row>
                    <div class="form-group">
                        <button type="submit"  name="choix" class="btn btn-success btn-block" value="continuer">Continuer</button>
                        <button type="submit" name="choix" class="btn btn-info btn-block" value="arreter">Arrêter le questionnaire</button>
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
                    <div class="col-md-6">
                        <h3>Votre réponse</h3>
                        <?php
                        if ($bonnereponse) {
                            echo "<h4 style='color:greenyellow'>" . $_POST['reponse'] . "</h4>";
                        } else {
                            echo "<h4 style='color:red'>" . $_POST['reponse'] . "</h4>";
                        }
                        ?>
                    </div>
                    <div class="col-md-6">
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


    <canvas id="canvas" style="margin: auto; display: block;" width="1100" height="700">
        <img src="images/imagequestionnaire/<?php echo $_SESSION["adressecourante"] ?>" align="middle" alt=""/>
    </canvas>



    <script type="text/javascript">
        function init(a, o) {
            var canvas = document.getElementById("canvas");
            var ctx = canvas.getContext("2d");
            var fond = new Image();
            fond.src = 'images/imagequestionnaire/<?php echo $_SESSION["adressecourante"]; ?>';
            fond.onload = function () {
                var x = fond.width;
                var y = fond.height;
                ctx.drawImage(fond, 550 - 0.5 * x, 350 - 0.5 * y, x, y);
            }
            var pointeur = new Image();
            pointeur.src = 'images/pointeur.png';
            pointeur.onload = function () {
                var abscisse = a * canvas.width;
                var ordonnee = o * canvas.height;
                ctx.drawImage(pointeur, abscisse - 10, ordonnee - 30, 20, 30);
            }
        }


        init(<?php echo $_SESSION["abscissecourante"] . "," . $_SESSION["ordonneecourante"] ?>);

</script>