<!-- On utilise la même page pour l'entrée des données et leur traitement
-->

<?php
$form_values_valid = false;

/*
 * Si les données ont été entrées et qu'elles sont valides (utilisateur nouveau,
 * mots de passe valdides et identiques) on inscrit l'utilisateur et le redirige vers l'accueil
 */
if (isset($_POST["login"]) && $_POST["login"] != "" &&
        isset($_POST["up"]) && $_POST["up"] != "") {
    $user = Utilisateur::getUtilisateur($dbh, $_POST["login"]);
    if ($user == NULL) {
        if ($_POST["up"] == $_POST["up2"]) {
            Utilisateur::insererUtilisateur($dbh, $_POST["login"], $_POST["up"], $_POST["prenom"], $_POST["nom"], $_POST["mail"], $_POST["naissance"]);
            $form_values_valid = true;
            echo "Tu as bien été inscrit";
        }
    }
}

/*
 * Ici on facilite la tache de l'utilisateur qui a déjà rentré des informations
 * mais dont l'inscription n'a pas été validée en pré-remplissant certains champs
 */

if (isset($_POST["prenom"])) {
    $prenom = $_POST["prenom"];
} else {
    $prenom = "";
}
if (isset($_POST["nom"])) {
    $nom = $_POST["nom"];
} else {
    $nom = "";
}
if (isset($_POST["mail"])) {
    $email = $_POST["mail"];
} else {
    $email = "";
}

/*
 * Si l'inscription n'a pas déjà été réalisée on affiche le formulaire 
 * potentiellement pré-rempli et dont tous les champs sont ici obligatoires
 */
if (!$form_values_valid) {
    ?>

    <form action="index.php?page=inscription" method=post
          oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe diffèrent.' : '')">
        <fieldset class="forminscr">
            <legend> Informations personnelles </legend>
            <p>
                <label for="login">Login:</label>
                <input id="login" type=text required name=login>
            </p>
            <p>
                <label for="nom">Nom:</label>
                <input id="nom" type=text required name=nom value="<?php echo $nom ?>">
            </p>
            <p>
                <label for="prenom">Prénom:</label>
                <input id="prenom" type=text required name=prenom value="<?php echo $prenom ?>">
            </p>
            <p>
                <label for="naissance">Date de naissance:</label>
                <input id="naissance" type=date required name=naissance>
            </p>
            <p>
                <label for="mail">Email:</label>
                <input id="mail" type=email required name=mail value="<?php echo $email ?>">
            </p>
            <p>
                <label for="password1">Mot de passe:</label>
                <input id="password1" type=password required name=up>
            </p>
            <p>
                <label for="password2">Confirmez votre mot de passe:</label>
                <input id="password2" type=password name=up2>
            </p>
            <input type=submit value="Inscription">
        </fieldset>
    </form>
    <br>

    <?php
}
?> 

