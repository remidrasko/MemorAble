<?php

/*Cette fonction permet un tirage aléatoire parmi les questions du questionnaire 
 *(questionnaire de type question-réponse ou image) suivant une loi
 *en exp(nombre d'échecs - nombre de réussites). On utilise pour cela 
 *la fonction de répartition et une loi uniforme.
 */
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



/*Cette fonction permet un tirage aléatoire parmi les informations du questionnaire suivant une loi
 *en exp(nombre de fois où l'utilisateur a indiqué ne pas connaitre - nombre de fois où l'utilisateur a indiqué bien connaitre).
 *On utilise pour cela la fonction de répartition et une loi uniforme.
 */
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