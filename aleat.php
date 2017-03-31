<?php

function aleatqr($tabprod){
    $compteur = 0;
    foreach($tabprod as $questionprod){
        $compteur += exp($questionprod->nbtentatives - 2*$questionprod->nbsucces);
  
    }
    $val = rand(1, 10000)*$compteur/10000;
    $compt = 0;
    $indice = 0;
    while ($compt < $val){
        $compt += exp($tabprod[$indice]->nbtentatives - 2*$tabprod[$indice]->nbsucces);
        $indice +=1;
    }
    return $tabprod[$indice-1];
}

function aleatinfo($tabprod){
    $compteur = 0;
    foreach($tabprod as $infoprod){
        $compteur += exp($infoprod->np - $infoprod->nb);
  
    }
    $val = rand(1, 10000)*$compteur/10000;
    $compt = 0;
    $indice = 0;
    while ($compt < $val){
        $compt += exp($tabprod[$indice]->np - $tabprod[$indice]->nb);
        $indice +=1;
    }
    return $tabprod[$indice-1];
}