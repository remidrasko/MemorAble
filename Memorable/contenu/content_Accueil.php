
<?php
// on récupère les questionnaires qui vont être mis en valeur dans la page d'accueil
$promus = Questionnaire::promus($dbh);
?>
<div style="background: url('images/paysage.jpg') no-repeat; background-size: 100% 100%; margin-top: -50px;">
    <br>
    
    <row>
        <div class="jumbotron" style="width:400px; height:100px; margin:auto; padding-top: 0px; margin-top: -30px; background-color: bisque; font-family : Gloria Hallelujah">
            <h2 class="text-center">
                MemorAble
            </h2>
            <h3 class="text-center">
                Apprenez à apprendre !
            </h3>
        </div>
        <div class="col-md-4">

        </div>
    </row>

    
<!-- image par défaut dans la page d'accueil dirigeant vers une présentation du fonctionnement du site
-->
    <img id="accueil" src="images/imagequestionnaire/cerveau.jpg" class="img-rounded" style="max-width : 40% ;height :auto; position:absolute; margin-left:50px; margin-top:50px; display:block;"> 

    
<!-- présentation de la page d'aide, et des deux questionnaires mis en valeur (un de type question-réponse
et un de type image)
-->
    <div style="margin-left: 50%; margin-top: 50px">
        <div id="cerveau.jpg"  class="rubriqueaccueil">
            <a href="index.php?page=aide" style="text-decoration: none; color:black;">
                <h4>Découvrez comment utiliser <b>MemorAble</b></h4>
            </a>
        </div>
        <div id="<?php echo $promus[0]->adresseimage ?>" class="rubriqueaccueil">
            <a href="index.php?page=presentation&idquestionnaire=<?php echo $promus[0]->id ?>" style="text-decoration: none; color:black;">
                <h4> <b>Le quiz du jour : </b> <?php echo $promus[0]->nom ?></h4>
        </div></a>
        <div id="<?php echo $promus[1]->adresseimage ?>" class="rubriqueaccueil">
            <a href="index.php?page=presentation&idquestionnaire=<?php echo $promus[1]->id ?>" style="text-decoration: none; color:black;">
                <h4><b>L'image du jour : </b><?php echo $promus[1]->nom ?></h4>
            </a>
        </div>

    </div>
    <div style="height: 200px"></div>

</div>

<!-- le script ci-après permet d'afficher l'image correspondant au quizz mis en valeur
lorsque l'utilisateur passe sa souris sur l'encart associé
-->
<script type="text/javascript">
    function show(name) {
        $("#accueil").attr('src', 'images/imagequestionnaire/' + name);
    }
    $(document).ready(function () {
        $(".rubriqueaccueil").mouseover(function () {
            show($(this).attr("id"));
        });
    });
</script>