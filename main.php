<?php

//Boucle rejouer ou non
while (true) {
    //Création du "menu"
    $m = intval(0);
    echo "-------------------- Gestion Banque -------------------- " . PHP_EOL;
    echo PHP_EOL . " 1 - Créer une agence " . PHP_EOL;
    echo " 2 - Créer un client " . PHP_EOL;
    echo " 3 - Créer un compte bancaire " . PHP_EOL;
    echo " 4 - Recherche de compte (numéro de compte) " . PHP_EOL;
    echo " 5 - Recherche de client (Nom, N° de compte, Identifiant de client) " . PHP_EOL;
    echo " 6 - Afficher la liste des comptes d'un client (Identifiant client) " . PHP_EOL;
    echo " 7 - Imprimer les infos client (Identifiant client) " . PHP_EOL;
    echo " 8 - Simuler frais de gestion " . PHP_EOL;
    echo PHP_EOL . "-------------------------------------------------------- " . PHP_EOL;
    echo PHP_EOL . " 9 - Quitter le programme " . PHP_EOL;
    echo PHP_EOL . "-------------------------------------------------------- " . PHP_EOL;

    $m = readline("Faite votre choix de configuration : ");

    switch ($m) {
        case 1:
            echo "Fonctionnalité en cour d'ajout !\n";
            break;

        case 2:
            include('./clients/CreateClient.php');
            break;

        case 3:
            include('./account/CreateAccount.php');
            break;

        case 4:
            include('./account/DisplayAccount.php');
            break;

        case 5:
            echo "Fonctionnalité en cour d'ajout !\n";
            break;

        case 6:
            include('./account/DisplayAllAccount.php');
            break;

        case 7:
            include('./clients/customerinfoprint.php');
            break;

        case 8:
            echo "Fonctionnalité en cour d'ajout !\n";
            break;

        case 9:
            echo "Merci d'avoir utilisé le programme de gestion de banque. Au revoir !\n";
            exit;
    }

    $continuer = readline("Voulez-<>vous revenir au menu ? (o/n) : ");
    if ($continuer !== 'o') {
        break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
    }
}