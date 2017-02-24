<?php
if (isset($_POST["choix"]) && $_POST["choix"] == "arreter") {
//on unset les variables crees et on affiche un message de remerciement avec liens et stats du remplissage
    echo "<a href='index.php?page=liste'>  Revenez à la liste des questionnaires </a>";
} else {
if (!isset($_POST["choix"]) || $_POST["choix"]=="continuer") {
if (!isset($_SESSION["nbreponses"])){
$_SESSION["queprod"] = Utilisateur_Questionnaire::getQuestionnaireProduit($dbh, $_SESSION["login"], $_GET["idquestionnaire"]);

$_SESSION["tabqueprod"] = Utilisateur_Question::getQuestionsProduit($dbh, $_SESSION["queprod"]->idquestionnaire, $_SESSION["queprod"]->login);

$_SESSION["longquestionnaire"] = count($_SESSION["tabqueprod"]);
$_SESSION["nbreponses"] = 0;


}
else{
    $_SESSION["tabqueprod"] = Utilisateur_Question::getQuestionsProduit($dbh, $_SESSION["queprod"]->idquestionnaire, $_SESSION["queprod"]->login);

}
$_SESSION["questionprodcourante"]= aleat($_SESSION["tabqueprod"]);
$_SESSION["questioncourante"]= Question::getQuestion($dbh, $_SESSION["questionprodcourante"]->idquestion);
/*$_SESSION["questionprodcourante"]=$_SESSION["tabqueprod"][rand(0, $_SESSION["longquestionnaire"]-1)];

$_SESSION["questioncourante"]= Question::getQuestion($dbh, $_SESSION["questionprodcourante"]->idquestion);*/

?>
<div id="creationquestion">
    <form method = "post" action="index.php?page=test">
        <row>
            <div class="col-md-6 form-group">
                <h3>Question</h3>
                <p><?php echo $_SESSION["questioncourante"]->question?></p>
            </div>
            <div class="col-md-6 form-group">
                <label for="reponse">Réponse:</label>
                <textarea class="form-control" rows="5" id="reponse" name="reponse"></textarea>
            </div>
        </row>
        <row>
            <div class="form-group">
                <button type="submit"  name="choix" class="btn btn-success btn-block" value="valider">Valider</button>
                <button type="submit" name="choix" style ="float:right " class="btn btn-info btn-block" value="arreter">Arrêter le questionnaire</button>
            </div>
        </row>

    </form>

</div>
<?php 
}
else{
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
                if ($bonnereponse){
                            echo "<h4 style='color:greenyellow'>".$_POST['reponse']."</h4>";
                        }
                        else{
                            echo "<h4 style='color:red'>".$_POST['reponse']."</h4>";
                        } ?>
            </div>
            <div class="col-md-4">
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
}
?>