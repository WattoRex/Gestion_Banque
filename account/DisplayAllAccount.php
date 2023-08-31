<?php

// Sélection Clients
$csvFile = './save/clients.csv'; // Assurez-vous que le fichier clients.csv existe dans le même répertoire que votre script.
$clientsData = []; // Tableau pour stocker les données
$clientsIDs = []; // Tableau pour stocker les IDs des clients


if (($handle = fopen($csvFile, 'r')) !== false) {
    while (($data = fgetcsv($handle)) !== false) {
        $clientsIDs[] = $data[0]; // Ajouter l'ID de compte au tableau
        $clientsData[$data[0]] = [
            'nom' => $data[1],
        ];
    }
    fclose($handle);
}

// Si aucun compte n'a été trouvé dans le fichier
if (empty($clientsIDs)) {
    echo "Aucun client trouvé dans le fichier." . PHP_EOL;
} else {
    echo "Choisissez un clients  : " . PHP_EOL;

    // Afficher le menu avec les options d'IDs de compte
    foreach ($clientsIDs as $index => $clientsID) {
        echo ($index + 1) . ". clients ID: $clientsID" . PHP_EOL;
    }

    // Initialiser la variable $choiceValid avant d'entrer dans la boucle
    $choiceValid = false;

    while (!$choiceValid) {
        // Demander à l'utilisateur de choisir une option
        $choice = trim(readline("Entrez le numéro client dont vous souhaitez afficher tous les comptes : "));

        // Vérification que l'entrée est un nombre entier
        if (ctype_digit($choice)) {
            $choice = intval($choice);
            if ($choice >= 1 && $choice <= count($clientsIDs)) {
                $choiceValid = true;
            } else {
                echo "Option invalide. Veuillez entrer un numéro entre 1 et " . count($clientsIDs) . "." . PHP_EOL;
            }
        } else {
            echo "Option invalide. Veuillez entrer un numéro valide." . PHP_EOL;
        }
    }
    $selectedclientsID = $clientsIDs[$choice - 1];
}

// Chemin vers le fichier CSV des comptes
$csvFile = './save/accounts.csv'; // Chemin vers le fichier CSV des comptes
$accountsData = []; // Tableau pour stocker les données des comptes

if (($handle = fopen($csvFile, 'r')) !== false) {
    while (($data = fgetcsv($handle)) !== false) {
        $accountClientID = $data[0]; // On suppose que l'ID du client est dans la première colonne

        // Si le compte actuel appartient au client recherché
        if ($accountClientID == $selectedclientsID) {
            $accountsData[] = [
                'ID Client' => $data[0],
                'ID Compte' => $data[1],
                'Type de Compte' => $data[2],
                'Solde du Compte' => $data[3],
                'Autorisation de Découvert' => ($data[4] == '1' ? 'Autorisée' : 'Non Autorisée')
            ];
        }
    }
    fclose($handle);
}

if (count($accountsData) > 0) {
    echo "Comptes pour le client avec l'ID $selectedclientsID :" . PHP_EOL;
    foreach ($accountsData as $accountInfo) {
        echo "-------------------------" . PHP_EOL;
        foreach ($accountInfo as $key => $value) {
            echo "$key : $value" . PHP_EOL;
        }
    }
} else {
    echo "Aucun compte trouvé pour ce client. " . PHP_EOL;
}