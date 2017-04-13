<!-- Pour évaluer si on accepte une réponse on utilise la distance de Levenshtein,
qui est une distance sur les chaines de caractères correspondant au nombre
de caractères qu'il faut supprimer, ajouter ou remplacer pour passer d'une chaine
à l'autre

-->
<?php
function reco($vr, $r) {
    $matrice = array();
    // on commence par convertir les caractères en minuscules 
    $tabvr = str_split(strtolower($vr));
    $tabr = str_split(strtolower($r));
    for ($i = 0; $i < strlen($r)+1; $i++) {
        $matrice[0][$i] = $i;
    }
    for ($i = 0; $i < strlen($vr)+1; $i++) {
        $matrice[$i][0] = $i;
    }
    // on construit alors la matrice de Levenshtein
    for ($i = 1; $i < strlen($vr)+1; $i++) {
        for ($j = 1; $j < strlen($r)+1; $j++) {
            if ($tabvr[$i - 1] == $tabr[$j - 1]) {
                $c = 0;
            } else {
                $c = 1;
            }
            $matrice[$i][$j] = min(array($matrice[$i - 1][$j] + 1, $matrice[$i][$j - 1] + 1, $matrice[$i - 1][$j - 1] + $c));
        }
    }
    // le coefficient final de la matrice correspond à la distance de Levenshtein
    $i= $matrice[strlen($vr)][strlen($r)];
    $j = $i / (strlen($r)+strlen($vr));
    /* si le rapport entre cette distance et la somme des tailles des chaines est 
     * assez petit on accepte la réponse
     */
    if ($j<0.1){
        return true;
    }
    else{
        return false;
    }
}


?>