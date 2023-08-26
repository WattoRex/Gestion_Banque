<?php

// Chemin vers le fichier CSV des comptes
$csvFile = './save/accounts.csv';

// Tableau pour stocker les IDs de compte
$accountIDs = [];

// Ouvrir le fichier CSV et récupérer les IDs de compte
if (($handle = fopen($csvFile, 'r')) !== false) {
    while (($data = fgetcsv($handle)) !== false) {
        $accountID = $data[1]; // Supposons que l'ID du compte est dans la deuxième colonne
        $accountIDs[] = $accountID; // Ajouter l'ID de compte au tableau
    }
    fclose($handle);
}

// Si aucun compte n'a été trouvé dans le fichier
if (empty($accountIDs)) {
    echo "Aucun compte trouvé dans le fichier." . PHP_EOL;
} else {
    echo "Choisissez un compte à afficher : " . PHP_EOL;

    // Afficher le menu avec les options d'IDs de compte
    foreach ($accountIDs as $index => $accountID) {
        echo ($index + 1) . ". Account ID: $accountID" . PHP_EOL;
    }

    // Initialiser la variable $choiceValid avant d'entrer dans la boucle
    $choiceValid = false;

    while (!$choiceValid) {
        // Demander à l'utilisateur de choisir une option
        $choice = trim(readline("Entrez le numéro de compte que vous souhaitez afficher : "));

        // Vérification que l'entrée est un nombre entier
        if (ctype_digit($choice)) {
            $choice = intval($choice);
            if ($choice >= 1 && $choice <= count($accountIDs)) {
                $choiceValid = true;
            } else {
                echo "Option invalide. Veuillez entrer un numéro entre 1 et " . count($accountIDs) . "." . PHP_EOL;
            }
        } else {
            echo "Option invalide. Veuillez entrer un numéro valide." . PHP_EOL;
        }
    }

    $selectedAccountID = $accountIDs[$choice - 1];

    // Rechercher les informations du compte sélectionné
    if (($handle = fopen($csvFile, 'r')) !== false) {
        while (($data = fgetcsv($handle)) !== false) {
            $currentAccountID = $data[1];
            if ($currentAccountID == $selectedAccountID) {
                // Préparer les informations du compte pour affichage
                $accountInfo = [
                    'ID Client' => $data[0],
                    'ID Compte' => $data[1],
                    'Type de Compte' => $data[2],
                    'Solde du Compte' => $data[3],
                    'Autorisation de Découvert' => ($data[4] == '1' ? 'Autorisée' : 'Non Autorisée')
                ];
                break; // Sortir de la boucle après avoir trouvé le compte
            }
        }
        fclose($handle);
    }

    // Afficher les informations du compte si elles existent
    if (isset($accountInfo)) {
        echo "Informations du compte avec l'ID $selectedAccountID :" . PHP_EOL;
        echo "-------------------------" . PHP_EOL;
        foreach ($accountInfo as $key => $value) {
            echo "$key : $value" . PHP_EOL;
        }
    } else {
        echo "Aucune information trouvée pour le compte avec l'ID $selectedAccountID." . PHP_EOL;
    }

}