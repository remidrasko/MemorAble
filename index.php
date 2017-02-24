<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'requetes.php';

session_name("sesvis");
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
require('utils.php');
require('logInOut.php');
require('recoreponse.php');
require('aleat.php');

$dbh = Database::connect();
if (isset($_GET["todo"]) && $_GET["todo"] == "login") {
    logIn($dbh);
}
if (isset($_GET["todo"]) && $_GET["todo"] == "logout") {
    logOut($dbh);
}
if (isset($_GET['page'])) {
    $askedPage = $_GET['page'];
} else {
    $askedPage = 'Accueil';
}
$authorized = checkPage($askedPage);
if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
} else {
    $pageTitle = "Erreur";
}


generateHTMLheader($pageTitle, 'perso.css');
?>

<div class="container-fluid" >
    <nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"> MemorAble </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Accueil</a>
                    </li>
                    <?php if (isset($_SESSION["loggedIn"])){ ?>
                    <li>
                        <a href="index.php?page=mesquestionnaires" class="dropdown-toggle" data-toggle="dropdown" > Mes questionnaires <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?page=liste">Liste</a></li>
                            <li><a href="index.php?page=creer">Créer un nouveau questionnaire</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" > Découvrir <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?page=hasard">Un questionnaire au hasard</a></li>
                            <li><a href="index.php?page=populaire">Les plus populaires</a></li>
                            <li><a href="index.php?page=themes">Thèmes</a></li>
                        </ul>
                    </li>

                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Rechercher">
                    </div>
                    <button type="submit" class="btn btn-default">Envoyer</button>
                </form>
                <?php 
                if (isset($_SESSION["loggedIn"])){
 
                    ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><?php echo $_SESSION["login"] ?> </a>
                    <li><a href="index.php?todo=logout"><span class="glyphicon glyphicon-log-out"></span></a>
                </ul>
                <?php
                }
                else{ ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php?page=inscription"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <form role="form" method="post" action="index.php?todo=login" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                <label class="sr-only" for="login">login</label>
                                                <input type="text" class="form-control" id="login" placeholder="login" name="login" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="motdepasse">Password</label>
                                                <input type="password" class="form-control" id="motdepasse" placeholder="Password" name="motdepasse" required>
                                                <div class="help-block text-right"><a href="">Mot de passe oublié ?</a></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Rester connecté
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <?php 
                }
                ?>


            </div>


        </div>
    </nav>

    <div id="content">
        <?php
        if ($authorized) {
            require "content_$askedPage.php";
        } else {
            echo "Déso tu dégages";
        }
        ?>



    </div>
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
    <script src="js/perso.js"</script>
</body>
</html>
