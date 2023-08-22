<?php
include_once("./lib/index.php");
include_once("./model/clients_copy.php");

$clientsData = [];
$lastAccountID = 0;

// En-tête du fichier CSV
$csvHeader = [
    "Client ID",
    "Nom",
    "Prenom",
    "Date de naissance",
    "Email"
];

// Vérifier si le fichier CSV existe déjà
$fileExists = file_exists('./save/clients.csv');

$csvFile = fopen('./save/clients.csv', 'a'); // 'a' pour append (ajouter à la fin)
if ($csvFile !== false) {
    // Si le fichier n'existe pas, écrire l'en-tête
    if (!$fileExists) {
        fputcsv($csvFile, $csvHeader); // Écrire l'en-tête dans le fichier CSV
    }

    while (true) {
        // Création d'un objet Account en utilisant le constructeur
        $client = new Client(202020, "", "", "", "");

        // Écrire les informations dans le fichier CSV
        $csvData = [
            $client->getClientID(),
            $client->getNom(),
            $client->getPrenom(),
            $client->getDateNaissance(),
            $client->getEmail(),
        ];

        // Écrire les données dans le fichier CSV
        fputcsv($csvFile, $csvData);

        $continuer = trim(readline("Voulez-vous créer un nouveau compte ? (o/n) : "));
        if ($continuer !== 'o') {
            break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
        }
    }

    fclose($csvFile);
    echo "Les informations des comptes ont été sauvegardées dans le fichier clients.csv." . PHP_EOL;
} else {
    echo "Impossible d'ouvrir le fichier clients.csv pour l'écriture." . PHP_EOL;
}