<?php
if (!isset($_SESSION["nbquestions"])) {
    /*
     * si l'on est en début de questionnaire on doit initialiser certaines 
     * variables de session (nom du questionnaire, type, nombre de questions)
     * ainsi que procéder à l'insertion du questionnaire dans la base de données
     * 
     */
    $_SESSION["type"] = 2;
    $_SESSION["nbquestions"] = 0;
    $_SESSION["nomquestionnaire"] = $_POST["nom"];
    $prefixe = $_SESSION["login"] . "_" . $_POST["nom"] . "_";
    $nom_fichier = $prefixe . $_FILES['userfile']['name'];
    $_SESSION["adresseimage"] = $nom_fichier;
    Questionnaire::insererQuestionnaireAvecImage($dbh, $_POST["nom"], $_SESSION["login"], 2, $_POST["description"], $_POST["ouverture"], $nom_fichier);
    $uploaddir = "/xampp/htdocs/Memorable/images/imagequestionnaire/";
    $uploadfile = $uploaddir . basename($nom_fichier);
    if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Invalid file, possible file upload attack!\n";
    }
    $_SESSION["idquestionnaire"] = Questionnaire::getQuestionnaire($dbh, $_POST["nom"], $_SESSION["login"])->id;
} else {
    /*
     * sinon c'est que l'utilisateur vient de valider la création de la question précédente
     * il faut donc augmenter la valeur du nombre de questions du questionnaire
     * et insérer la question dans le questionnaire
     */
    $_SESSION["nbquestions"] += 1;
    Question_Image::insererQuestion($dbh, $_SESSION["idquestionnaire"], $_POST["reponse"], $_SESSION["adresseimage"], $_SESSION["abscisse"], $_SESSION["ordonnee"], $_SESSION["nbquestions"]);
}
?>

<!--
on affiche l'image correspondant au questionnaire grâce à canvas et du javascript
lorsque l'utilisateur clique dans le canvas un script php va permettre
de stocker les coordonnées du point voulu dans des variables de session
-->

<canvas id="canvas" style="margin: auto; display: block;" width="1100" height="700" onmousedown="mouseDownEventHandler(event);">
    <img src="images/imagequestionnaire/<?php echo $_SESSION["adresseimage"] ?>" align="middle" alt=""/>
</canvas>

<script type="text/javascript">
    function init() {
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var fond = new Image();
        fond.src = '/Memorable/images/imagequestionnaire/<?php echo $_SESSION["adresseimage"]; ?>';
        fond.onload = function () {
            var x = fond.width;
            var y = fond.height;
            ctx.drawImage(fond, 550 - 0.5 * x, 350 - 0.5 * y, x, y);
        }
    }

    function mouseDownEventHandler(e) {
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var clicx = e.clientX - canvas.getBoundingClientRect().left;
        var clicy = e.clientY - canvas.getBoundingClientRect().top;
        var abscisse = ((clicx) / canvas.width);
        var ordonnee = ((clicy) / canvas.height);
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?page=recuperercoordonnees&abscisse=' + abscisse + "&ordonnee=" + ordonnee);
        xhr.send(null)
        var pointeur = new Image();
        pointeur.src = '/Memorable/images/pointeur.png';
        pointeur.onload = function () {
            ctx.drawImage(pointeur, clicx - 10, clicy - 30, 20, 30);
        }

    }


    init();

</script>



<div id="creationquestion">
    <form method = "post" action="index.php?page=creation">
        <row>
            <div class="col-md-12 form-group">
                <label for="question">Reponse:</label>
                <textarea class="form-control" rows="5" id="information" name="reponse"></textarea>
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


