<?php

//Boucle rejouer ou non
while (true) {
    //Création du "menu"
    $m = intval(0);
    echo PHP_EOL . "------ Menu de gestion des élèves ------- " . PHP_EOL;
    echo PHP_EOL . ' 1 - Ajout de donnée (Nom et Notes Eleves)' . PHP_EOL;
    echo ' 2 - Affichage des moyenne des élèves' . PHP_EOL;
    echo PHP_EOL . "----------------------------------------- " . PHP_EOL;

    $m = readline(PHP_EOL . "Faite votre choix de configuration : ");

    switch ($m) {
        case 1:
            include_once("./fonction/FonctionAjoutDonnee.php");
            break;
        case 2:
            include_once("./fonction/FonctionAffichage.php");
            break;
    }

    $continuer = readline(PHP_EOL . "Voulez-<>vous revenir au menu ? (o/n) : ");
    if ($continuer !== 'o') {
        break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
    }
}