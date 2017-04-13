<?php

    if (!isset($_SESSION["nbreponses"])) {
     /*
     * si l'utilisateur vient d'arriver sur le questionnaire
     * on initialise certaines variables de sessions
     * notamment tabqueprod qui contient le tableau des 
     * produits information-utilisateur avec les pondérations
     * de "je sais"/"je sais à peu près"/"je ne sais pas" qui vont déterminer
     * la fréquence d'apparition de chaque information
     */
        $_SESSION["idquestionnaire"] = $_GET["idquestionnaire"];
        $_SESSION["queprod"] = Utilisateur_Questionnaire::getQuestionnaireProduit($dbh, $_SESSION["login"], $_GET["idquestionnaire"], 1);

        $_SESSION["tabqueprod"] = Utilisateur_Info::getInfosProduit($dbh, $_SESSION["queprod"]->idquestionnaire, $_SESSION["queprod"]->login);
        $_SESSION["longquestionnaire"] = count($_SESSION["tabqueprod"]);
        $_SESSION["nbreponses"] = 0;
    } else {
        $_SESSION["tabqueprod"] = Utilisateur_Info::getInfosProduit($dbh, $_SESSION["queprod"]->idquestionnaire, $_SESSION["queprod"]->login);
        $_SESSION["infoprodcourante"]->incrementerUtilisateurQuestion($dbh, $_POST["choix"]);
        
    }
    $_SESSION["infoprodcourante"] = aleatinfo($_SESSION["tabqueprod"]);
    $_SESSION["infocourante"] = Information::getInformation($dbh, $_SESSION["infoprodcourante"]->idinfo);
    ?>
    <div id="creationquestion">
        <form method = "post" action="index.php?page=test">
            <row>
                <div class="col-md-12 form-group">
                    <h2>Information</h3>
                    <h3><?php echo $_SESSION["infocourante"]->info ?></h3>
                    <br>
                    <br>
                </div>

            </row>
            <row>
                <div class="form-group">
                    <button type="submit"  name="choix" class="btn btn-success btn-block" value="2">Je le savais bien</button>
                    <button type="submit"  name="choix" class="btn btn-warning btn-block" value="1">Je le savais à peu près</button>
                    <button type="submit"  name="choix" class="btn btn-danger btn-block" value="0">Je ne le savais pas</button>
                    <button type="submit" name="choix" style ="float:right " class="btn btn-info btn-block" value="arreter">Arrêter le questionnaire</button>
                </div>
            </row>

        </form>

    </div>
