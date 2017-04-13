

<?php

if (!isset($_POST["choix"]) || $_POST["choix"]=="continuer") {
    /*
     * configurations dans laquelle on doit afficher
     * une nouvelle question (ou que l'utilisateur
     * vient d'arriver sur le questionnaire ou qu'il
     * a choisi de continuer)
     */
if (!isset($_SESSION["nbreponses"])){
    /*
     * si l'utilisateur vient d'arriver sur le questionnaire
     * on initialise certaines variables de sessions
     * notamment tabqueprod qui contient le tableau des 
     * produits question-utilisateur avec les pondérations
     * de bonnes et de mauvaises réponses qui vont déterminer
     * la fréquence d'apparition de chaque question
     */
$_SESSION["idquestionnaire"]= $_GET["idquestionnaire"];
$_SESSION["adressecourante"]=Questionnaire::getQuestionnaireById($dbh, $_SESSION["idquestionnaire"])->adresseimage;
$_SESSION["queprod"] = Utilisateur_Questionnaire::getQuestionnaireProduit($dbh, $_SESSION["login"], $_GET["idquestionnaire"], 2);

$_SESSION["tabqueprod"] = Utilisateur_Question::getQuestionsProduit($dbh, $_SESSION["queprod"]->idquestionnaire, $_SESSION["queprod"]->login);

$_SESSION["longquestionnaire"] = count($_SESSION["tabqueprod"]);
$_SESSION["nbreponses"] = 0;


}
else{
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
$_SESSION["questionprodcourante"]= aleatqr($_SESSION["tabqueprod"]);
$_SESSION["questioncourante"]= Question_Image::getQuestion($dbh, $_SESSION["questionprodcourante"]->idquestion);
$_SESSION["abscissecourante"]=$_SESSION["questioncourante"]->abscisse;
$_SESSION["ordonneecourante"]=$_SESSION["questioncourante"]->ordonnee;
$_SESSION["adressecourante"]=$_SESSION["questioncourante"]->adresseimage;


?>

    <form style="position: fixed;" class ="form-inline" method = "post" action="index.php?page=test">
       
            <div class="form-group">
                <label for="reponse">Réponse:</label>
                <input type="text" class="form-control"  id="reponse" name="reponse"></input>
            </div>

                <button type="submit"  name="choix" width="100px" class="btn btn-success" value="valider">Valider</button>
                <button type="submit" name="choix" width="100px" class="btn btn-info " value="arreter">Arrêter le questionnaire</button>
  
       
    

    </form>



<?php 
}
else{
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
            <div class="col-md-6">
                <h3>Votre réponse</h3>
                <?php 
                if ($bonnereponse){
                            echo "<h4 style='color:greenyellow'>".$_POST['reponse']."</h4>";
                        }
                        else{
                            echo "<h4 style='color:red'>".$_POST['reponse']."</h4>";
                        } ?>
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

?>


<canvas id="canvas" style="margin: auto; display: block;" width="1100" height="700">
<!--    <canvas id="canvas" width="740" height="485" onmousedown="affiche(0.758,0.823);">-->
    <img src="images/imagequestionnaire/<?php echo $_SESSION["adressecourante"] ?>" align="middle" alt=""/>
</canvas>


<!--
Le script gère l'affichage dans le canvas du pointeur correspondant à chaque
partie de l'image qu'on interroge dans une question
-->
<script type="text/javascript">
    function init(a, o) {
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var fond = new Image();
        fond.src = 'images/imagequestionnaire/<?php echo $_SESSION["adressecourante"]; ?>';
        fond.onload = function () {
            var x = fond.width;
            var y = fond.height;
            ctx.drawImage(fond, 550-0.5*x, 350-0.5*y, x, y);
        }
        var pointeur = new Image();
        pointeur.src = 'images/pointeur.png';
        pointeur.onload = function () {
            var abscisse = a * canvas.width;
            var ordonnee = o * canvas.height;
            ctx.drawImage(pointeur, abscisse-10, ordonnee-30, 20, 30);
        }
    }

    
    init(<?php echo $_SESSION["abscissecourante"].",".$_SESSION["ordonneecourante"] ?>);

</script>