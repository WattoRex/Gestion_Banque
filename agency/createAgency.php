<?php
include_once("./lib/index.php");
include_once("./model/agence.php");

$clientsData = [];
$lastAccountID = 0;

// En-tête du fichier CSV
$csvHeader = [
    "Agence ID",
    "Nom",
    "Adresse"
];

// Vérifier si le fichier CSV existe déjà
$fileExists = file_exists('./save/agences.csv');

$csvFile = fopen('./save/agences.csv', 'a'); // 'a' pour append (ajouter à la fin)
if ($csvFile !== false) {
    // Si le fichier n'existe pas, écrire l'en-tête
    if (!$fileExists) {
        fputcsv($csvFile, $csvHeader); // Écrire l'en-tête dans le fichier CSV
    }

    while (true) {
        // Création d'un objet Account en utilisant le constructeur
        $agency = new Agence(101, "", "");

        // Écrire les informations dans le fichier CSV
        $csvData = [
            $agency->getAgencyCode(),
            $agency->getAgencyName(),
            $agency->getAgencyAdress(),
        ];

        // Écrire les données dans le fichier CSV
        fputcsv($csvFile, $csvData);

        $continuer = trim(readline("Voulez-vous créer une nouvelle agence ? (o/n) : "));
        if ($continuer !== 'o') {
            break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
        }
    }

    fclose($csvFile);
    echo "Les informations des agences ont été sauvegardées dans le fichier agency.csv." . PHP_EOL;
} else {
    echo "Impossible d'ouvrir le fichier agency.csv pour l'écriture." . PHP_EOL;
}