<?php
include_once("./lib/index.php");
include_once("./model/account.php");

$accountsData = [];
$lastAccountID = 0;

// En-tête du fichier CSV
$csvHeader = [
    "Client ID",
    "Account ID",
    "Account Type",
    "Account Balance",
    "Overdraft"
];

// Vérifier si le fichier CSV existe déjà
$fileExists = file_exists('accounts.csv');

$csvFile = fopen('accounts.csv', 'a'); // 'a' pour append (ajouter à la fin)
if ($csvFile !== false) {
    // Si le fichier n'existe pas, écrire l'en-tête
    if (!$fileExists) {
        fputcsv($csvFile, $csvHeader); // Écrire l'en-tête dans le fichier CSV
    }

    while (true) {
        // Création d'un objet Account en utilisant le constructeur
        $account = new Account(12345, null, "Courant", 0, true);

        // Écrire les informations dans le fichier CSV
        $csvData = [
            $account->getClientID(),
            $account->getAccountID(),
            $account->getAccountType(),
            $account->getAccountBalance(),
            $account->getOverdraft() ? "Autorisé" : "Refusé"
        ];

        // Écrire les données dans le fichier CSV
        fputcsv($csvFile, $csvData);

        $continuer = trim(readline("Voulez-vous créer un nouveau compte ? (o/n) : "));
        if ($continuer !== 'o') {
            break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
        }
    }

    fclose($csvFile);
    echo "Les informations des comptes ont été sauvegardées dans le fichier accounts.csv." . PHP_EOL;
} else {
    echo "Impossible d'ouvrir le fichier accounts.csv pour l'écriture." . PHP_EOL;
}