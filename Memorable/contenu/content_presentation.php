<?php
unset($_SESSION["typequestionnaire"]);
$qcourant = Questionnaire::getQuestionnaireById($dbh, $_GET["idquestionnaire"]);
$typecourant = $qcourant->type;
if (isset($_SESSION["login"])) {
    $qprodcourant = Utilisateur_Questionnaire::getQuestionnaireProduit($dbh, $_SESSION["login"], $_GET["idquestionnaire"], $qcourant->type);
}
?>

<!--On affiche à l'utilisateur les informations principales sur le questionnaire
(nom, créateur, type et quelques statistiques ...)
-->
<div class="container-fluid" style="background: url('images/desert.jpg') no-repeat; background-size: 100% 100%; margin-top: -50px;" >
    <div class="row" style="margin-top:30px;">
        <div class ="col-md-6">

            <div class="jumbotron" style="width:400px; padding:10px; margin:auto;  ">
                <h2 class="text-center">
                    <?php
                    echo $qcourant->nom;
                    ?>
                </h2>
                <h3 class="text-center">
                    <?php
                    echo "Test crée par " . $qcourant->auteur;
                    ?>
                </h3>
            </div>
        </div>
        <div class ="col-md-6">
            <h3>
                <?php echo $qcourant->description; ?>
            </h3>
            <h4>
                Type :
                <?php
                if ($typecourant == 0) {
                    echo "Questions-réponses";
                } else if ($typecourant == 1) {
                    echo "Informations";
                } else {
                    echo "Image";
                }
                ?>
                <br>
                Ouverture :
                <?php
                if ($qcourant->ouverture == 0) {
                    echo "Questionnaire privé";
                } else {
                    echo "Questionnaire public<br>";
                    echo "Nombre de réalisations par les internautes :" . $qcourant->realisations;
                }
                if (isset($_SESSION["login"])) {
                    echo "<br> Pourcentage de réussite actuel : " . $qcourant->getPourcentage($dbh, $_SESSION["login"]) . "%";
                    echo"<br> Nombre de réalisations du questionnaire : " . $qprodcourant->nbquestionsrepondues;
                    echo "<br>";
                }
                ?>
            </h4>

        </div>
    </div>
    <br><br>
    
    
<!-- On donne le lien à l'utilisateur pour s'évaluer et pour s'entraîner 
s'il est authentifié (car nécessité de garder en mémoire ses réponses)
-->
    <div class ="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-4" >
            <?php
            if (isset($_SESSION["login"])) {
                echo" <h2  class='lientest' >";
                echo '<span class="glyphicon glyphicon-education"> <a href=index.php?page=test&idquestionnaire=' . $qcourant->id . '>Entrainement </a></span>';
                echo "</h2>";
            }
            ?>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
            <h2  class="lientest" >
                <?php echo '<span class="glyphicon glyphicon-blackboard"> <a href=index.php?page=evaluer&idquestionnaire=' . $qcourant->id . '>Evaluation </a></span>';
                ?>
            </h2>
        </div>
    </div>
    
    
<!-- Si l'utilisateur est authentifié et s'est déjà entraîné on lui affiche l'évolution
de son taux de maitrise du questionnaire en fonction du temps à l'aide du module
Highcharts
-->
    
    <br><br>
    <div id="graphique" style="max-width: 600px; height: 400px; margin: 0 auto"></div>
    <?php
    if (isset($_SESSION["login"])) {
        $tableau = Remplissage::tableauRemplissages($dbh, $qprodcourant->idproduit);
    } else {
        $tableau = null;
    }
    if ($tableau != null) {
        ?>
    
        <script type="text/javascript">
            Highcharts.chart('graphique', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Evolution du pourcentage de réussite'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'datetime',
                    //        dateTimeLabelFormats: { // don't display the dummy year
                    //            month: '%e. %b',
                    //            year: '%b'
                    //        },
                    title: {
                        text: 'Date'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Réussite'
                    },
                    min: 0,
                    max: 100
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x:%e. %b %H:%M}: {point.y:.0f} %'
                },

                plotOptions: {
                    spline: {
                        marker: {
                            enabled: true
                        }
                    }
                },

                series: [{
                        name: 'Progression',
                        data: [
    <?php
    foreach ($tableau as $date => $pourcentage) {
        $dateformate = explode(" ", $date);
        $annee = explode("-", $dateformate[0])[0];
        $mois = explode("-", $dateformate[0])[1] - 1;
        $jour = explode("-", $dateformate[0])[2];
        $heure = explode(":", $dateformate[1])[0];
        $minute = explode(":", $dateformate[1])[1];
        echo"[Date.UTC(" . $annee . ", " . $mois . ", " . $jour . ", " . $heure . ", " . $minute . "), " . $pourcentage . "], ";
    }
    ?>
                            
                        ]
                    }]
            });
        </script>
        <?php
    }
    ?>
    <br>
</div>