<?php
/*
 * s'il y a correspondance entre le mot de passe enregistré
 * et le mot de passe entré une fois encrypté alors on 
 * donne les valeurs idoines aux variables de session
 * gérant l'authentification (on détermine notamment
 * si l'utilisateur est administrateur ou pas)
 */
function logIn($dbh){
    $Utilisateur = new Utilisateur();
    $user = $Utilisateur->getUtilisateur($dbh, $_POST["login"]);
    if ($user != NULL && $user->motdepasse == sha1($_POST["motdepasse"])){
        $_SESSION["loggedIn"] = 1;
        $_SESSION["login"] = $user->login;
        if ($user->admin == 1){
            $_SESSION["admin"] = true;
        }
    }
}

/*
 * pour logout il suffit d'unset les variables concernées
 */
function logOut(){
    unset($_SESSION['loggedIn']);
    unset($_SESSION["login"]);
    unset($_SESSION["admin"]);
}

?>