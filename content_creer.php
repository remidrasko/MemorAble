<h1>Créer un nouveau questionnaire</h1>
<?php unset($_SESSION["nbquestions"]); ?>


<form method="post" action="index.php?page=creation">
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
    <button type="submit" class="btn btn-default">Créer</button>
</form>