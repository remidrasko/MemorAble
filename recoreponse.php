
<?php

function reco($vr, $r) {
    $matrice = array();
    $tabvr = str_split(strtolower($vr));
    $tabr = str_split(strtolower($r));
    for ($i = 0; $i < strlen($r)+1; $i++) {
        $matrice[0][$i] = $i;
    }
    for ($i = 0; $i < strlen($vr)+1; $i++) {
        $matrice[$i][0] = $i;
    }
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
    $i= $matrice[strlen($vr)][strlen($r)];
    $j = $i / (strlen($r)+strlen($vr));
    if ($j<0.1){
        return true;
    }
    else{
        return false;
    }
}


?>