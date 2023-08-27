<?php

function getClientInfo($clientID)
{
    $clientInfo = [];
    $accountInfo = [];

    // Obtenir les informations du client depuis le fichier client.csv
    $clientFile = fopen('./save/clients.csv', 'r');
    if ($clientFile !== false) {
        while (($data = fgetcsv($clientFile)) !== false) {
            if ($data[0] === $clientID) { // Recherche du numéro de client correspondant
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

    // Obtenir les informations des comptes du client depuis le fichier account.csv
    $accountFile = fopen('./save/accounts.csv', 'r');
    if ($accountFile !== false) {
        while (($data = fgetcsv($accountFile)) !== false) {
            if ($data[0] === $clientID) { // Recherche des comptes appartenant au client
                $accountInfo[] = [
                    'accountNumber' => $data[1],
                    'balance' => $data[3]
                ];
            }
        }
        fclose($accountFile);
    }

    return ['clientInfo' => $clientInfo, 'accountInfo' => $accountInfo];
}


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
// Appel de la fonction pour obtenir les informations du client
$info = getClientInfo($selectedclientsID);

// Test en Terminal
// // Affichage des informations du client et des comptes
// echo "Fiche client\n";
// echo "Numéro client : {$info['clientInfo']['clientID']}\n";
// echo "Nom : {$info['clientInfo']['lastName']}\n";
// echo "Prénom : {$info['clientInfo']['firstName']}\n";
// echo "Date de naissance : {$info['clientInfo']['birthdate']}\n";
// echo "_______________________________________________\n";
// echo "Liste de compte\n";
// echo "_______________________________________________\n";
// echo "Numéro de compte\tSolde\n";
// echo "_______________________________________________\n";
// foreach ($info['accountInfo'] as $account) {
//     echo "{$account['accountNumber']}\t{$account['balance']} euros ";
//     if ($account['balance'] > 0) {
//         echo ":-)\n";
//     } elseif ($account['balance'] < 0) {
//         echo ":-(\n";
//     } else {
//         echo "\n";
//     }
// }

// Passage en fichier .TXT
$output = "Fiche client\n\n";
$output .= "Numéro client : {$info['clientInfo']['clientID']}\n";
$output .= "Nom : {$info['clientInfo']['lastName']}\n";
$output .= "Prénom : {$info['clientInfo']['firstName']}\n";
$output .= "Date de naissance : {$info['clientInfo']['birthdate']}\n";
$output .= "_______________________________________________\n";
$output .= "Liste de compte\n";
$output .= "_______________________________________________\n";
$output .= "Numéro de compte\t        Solde\n";
$output .= "_______________________________________________\n";
foreach ($info['accountInfo'] as $account) {
    $accountNumber = $account['accountNumber'];
    $balance = $account['balance'];
    $emoji = ($balance > 0) ? ":-)" : (($balance < 0) ? ":-( " : "");

    // Aligner le numéro de compte à gauche et centrer le solde
    $output .= str_pad($accountNumber, 20, " ") . "\t" . str_pad($balance . " euros", 20, " ", STR_PAD_BOTH) . $emoji . "\n";
}

$filename = $selectedclientsID . '_client_info.txt'; // Utilisation de l'ID client pour nommer le fichier
file_put_contents($filename, $output);

echo "Les informations du client ont été enregistrées dans le fichier $filename.";