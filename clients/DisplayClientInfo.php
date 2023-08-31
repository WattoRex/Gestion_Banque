<?php

// Charger les données clients depuis le fichier CSV (non inclus ici)
$clientsData = []; // Chargez les données clients ici


// Afficher le menu de recherche
echo "Options de recherche : " . PHP_EOL;
echo "1. Rechercher par Nom" . PHP_EOL;
echo "2. Rechercher par Numéro de Compte" . PHP_EOL;
echo "3. Rechercher par Numéro de Client" . PHP_EOL;

$choice = trim(readline("Entrez votre choix : "));

$searchOption = '';
switch ($choice) {
    case '1':
        $searchOption = 'nom';
        break;
    case '2':
        $searchOption = 'accountid';
        break;
    case '3':
        $searchOption = 'id';
        break;
    default:
        echo "Option invalide.";
        exit();
}

$searchValue = trim(readline("Entrez la valeur de recherche : "));

$clientInfo = [];
$accountInfo = [];

// Obtenir les informations du client depuis le fichier client.csv
$clientFile = fopen('./save/clients.csv', 'r');
if ($clientFile !== false) {
    while (($data = fgetcsv($clientFile)) !== false) {
        if (($searchOption === 'id' && $data[0] === $searchValue) || ($searchOption === 'nom' && strtolower($data[1]) === strtolower($searchValue))) {
            $clientInfo = [
                'clientID' => $data[0],
                'firstName' => $data[1],
                'lastName' => $data[2],
                'birthdate' => $data[3]
            ];
            break; // Sortir de la boucle une fois que le client est trouvé
        }
    }
    fclose($clientFile);
}

// Si l'option de recherche est AccountID, obtenir les informations du compte depuis le fichier account.csv
if ($searchOption === 'accountid') {
    $accountFile = fopen('./save/accounts.csv', 'r');
    if ($accountFile !== false) {
        while (($data = fgetcsv($accountFile)) !== false) {
            if ($data[1] === $searchValue) { // Recherche du compte correspondant à l'AccountID
                $accountInfo = [
                    [
                        'accountNumber' => $data[1],
                        'balance' => $data[3]
                    ]
                ];
                $clientID = $data[0];
                break;
            }
        }
        fclose($accountFile);
    }

    if (!empty($clientID)) {
        // Rechercher les informations du client associé à ce compte
        $clientFile = fopen('./save/clients.csv', 'r');
        if ($clientFile !== false) {
            while (($data = fgetcsv($clientFile)) !== false) {
                if ($data[0] === $clientID) {
                    $clientInfo = [
                        'clientID' => $data[0],
                        'firstName' => $data[1],
                        'lastName' => $data[2],
                        'birthdate' => $data[3]
                    ];
                    break; // Sortir de la boucle une fois que le client est trouvé
                }
            }
            fclose($clientFile);
        }
    }
}

// Afficher les informations du client et des comptes
echo "Informations du client avec la recherche '$searchValue':" . PHP_EOL;
echo "--------------------------------------------------------" . PHP_EOL;
if (!empty($clientInfo)) {
    echo "Client ID: " . $clientInfo['clientID'] . PHP_EOL;
    echo "Nom et Prenom : " . $clientInfo['firstName'] . " " . $clientInfo['lastName'] . PHP_EOL;
    echo "Date de naissance: " . $clientInfo['birthdate'] . PHP_EOL;
} else {
    echo "Aucun client trouvé pour la recherche." . PHP_EOL;
}


//Pas demander ?
// if (empty($accountInfo)) {
//     echo "Aucun compte trouvé pour ce client ou cet AccountID." . PHP_EOL;
// } else {
//     echo "Comptes du client:" . PHP_EOL;
//     foreach ($accountInfo as $account) {
//         echo "Numéro de compte: " . $account['accountNumber'] . ", Solde: " . $account['balance'] . PHP_EOL;
//     }
// }