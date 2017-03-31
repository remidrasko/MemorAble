<?php

function logIn($dbh){
    $Utilisateur = new Utilisateur();
    $user = $Utilisateur->getUtilisateur($dbh, $_POST["login"]);
    if ($user != NULL && $user->motdepasse == sha1($_POST["motdepasse"])){
        $_SESSION["loggedIn"] = 1;
        $_SESSION["login"] = $user->login;
    }
}

function logOut(){
    unset($_SESSION['loggedIn']);
    unset($_SESSION["login"]);
}

?>