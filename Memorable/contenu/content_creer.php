
<?php
unset($_SESSION["nbquestions"]);
unset($_SESSION["nomquestionnaire"]);
unset($_SESSION["idquestionnaire"]);
unset($_SESSION["type"]);
?>

<!-- Formulaire de création qui renvoit sur la page de création et qui va déterminer le nom, la description
le type de questionnaire, l'ouverture et permettre d'ajouter une image (qui jouera un rôle de présentation
pour un questionnaire de type question-réponse ou informations et qui sera la base du questionnaire
pour un questionnaire de type image).
-->

<h1>Créer un nouveau questionnaire</h1>

<form enctype="multipart/form-data" action="index.php?page=creation" method="POST">
    <div class="form-group">
        <label for="nom">Nom du questionnaire:</label>
        <input type="text" class="form-control" id="nom" name="nom">
    </div>
    <div class="form-group">
        <label for="nom">Description:</label>
        <textarea rows="4" class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="type"> Type de questionnaire:</label>
        <div class="radio">
            <label><input type="radio" name="type" value="0">Question réponse</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="type" value="1">Informations</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="type" value="2">Image</label>
        </div>
    </div>
    <div class="form-group">
        <label for="ouverture"> Type de questionnaire:</label>
        <div class="radio">
            <label><input type="radio" name="ouverture" value="0">Privé</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="ouverture" value="1">Public</label>
        </div>
    </div>
    <div class="form-group">
        Image : <br>
        <input name="userfile" type="file"> <br>
    </div>
    <button type="submit" class="btn btn-default">Créer</button>
</form>