<?php

//Boucle rejouer ou non
while (true) {
    //Création du "menu"
    $m = intval(0);
    echo "-------------------- Gestion Banque -------------------- " . PHP_EOL;
    echo " 1 - Créer une agence " . PHP_EOL;
    echo " 2 - Créer un client " . PHP_EOL;
    echo " 3 - Créer un compte bancaire " . PHP_EOL;
    echo " 4 - Recherche de compte (numéro de compte) " . PHP_EOL;
    echo " 5 - Recherche de client (Nom, N° de compte, Identifiant de client) " . PHP_EOL;
    echo " 6 - Afficher la liste des comptes d'un client (Identifiant client) " . PHP_EOL;
    echo " 7 - Imprimer les infos client (Identifiant client) " . PHP_EOL;
    echo " 8 - Simuler frais de gestion " . PHP_EOL;
    echo "-------------------------------------------------------- " . PHP_EOL;
    echo " 9 - Quitter le programme " . PHP_EOL;
    echo "-------------------------------------------------------- " . PHP_EOL;

    $m = readline(PHP_EOL . "Faite votre choix de configuration : ");

    switch ($m) {
        case 1:
            break;
        case 2:
            break;
        case 3:
            break;
        case 4:
            break;
        case 5:
            break;
        case 6:
            break;
        case 7:
            break;
        case 8:
            break;
        case 9:
            break;
    }

    $continuer = readline(PHP_EOL . "Voulez-<>vous revenir au menu ? (o/n) : ");
    if ($continuer !== 'o') {
        break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
    }
}