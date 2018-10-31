<?php

// Si le fichier compteur.txt n'existe pas, on le crée

if(!file_exists('compteur.txt')){
    file_put_contents('compteur.txt', 0);
}

// On récupère le contenu du fichier compteur.txt
$compteur = file_get_contents('compteur.txt');

// On met dans le fichier le compteur actuel +1
file_put_contents('compteur.txt', ++$compteur);

// Affichage du nombre de visites
echo $compteur . ' visites';