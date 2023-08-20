<?php

class Account
{
    private int $clientID;
    private int $accountID;
    private string $accountType;
    private int $accountBalance;
    private bool $overdraft;
    private static $accountCountPerClient = [];

    public function __construct(int $clientID, $accountID, string $accountType, int $accountBalance, bool $overdraft)
    {
        $this->clientID = $clientID;

        // // Lire les ID clients depuis le fichier CSV
        // $clientIDsFromCSV = []; // À remplir avec les ID clients depuis le fichier CSV

        // if (!in_array($clientID, $clientIDsFromCSV)) {
        //     throw new Exception("ID client non valide : $clientID");
        // }

        while (true) {
            if (!isset(self::$accountCountPerClient[$clientID])) {
                self::$accountCountPerClient[$clientID] = 0;
            }

            if (self::$accountCountPerClient[$clientID] >= 3) {
                $errorMessage = "Limite de compte atteinte pour l'identifiant de client : $clientID";
                echo $errorMessage . PHP_EOL;
                echo "Veuillez entrer un autre identifiant de client." . PHP_EOL;
                $clientID = intval(readline("Entrez un nouvel identifiant de client : "));
                continue; // Revenir au début de la boucle pour re-vérifier la limite
            }

            break; // Sortir de la boucle si la limite n'est pas atteinte
        }
        self::$accountCountPerClient[$clientID]++;

        $this->setAccountID($accountID);
        $this->setAccountType($accountType);
        $this->setAccountBalance($accountBalance);
        $this->setOverdraft($overdraft);
    }

    /**
     * Get the value of clientID
     *
     * @return int
     */
    public function getClientID(): int
    {

        //     $clientData = []; // Charger les donée via CSV

        //     echo "Liste des clients : \n";
        //     foreach ($clientData as $client) {
        //         echo "{$client['clientID']} - {$client['clientName']}\n";
        //     }

        //     $selectedClientID = intval(readline("Entrez l'ID du client : "));

        //     // Validate selected client ID and return
        //     foreach ($clientData as $client) {
        //         if ($client['clientID'] === $selectedClientID) {
        //             return $selectedClientID;
        //         }
        //     }

        // echo "Client avec ID $selectedClientID introuvable. Veuillez réessayer.\n"; //ou en dessous
        //     throw new Exception("Client avec ID $selectedClientID introuvable.");
        // }

        return $this->clientID;
    }

    /**
     * Set the value of clientID
     *
     * @param int $clientID
     *
     * @return self
     */
    public function setClientID(int $clientID): self
    {

        //     $clientData = []; // Charger les donée via CSV

        //     foreach ($clientData as $client) {
        //         if ($client['clientID'] === $clientID) {
        //             $this->clientID = $clientID;
        //             return $this;
        //         }
        //     }

        // echo "Client avec ID $clientID introuvable.\n"; //ou en dessous
        //     throw new Exception("Client avec ID $clientID introuvable.");
        // }

        $this->clientID = $clientID;

        return $this;
    }

    /**
     * Get the value of accountID
     *
     * @return int
     */
    public function getAccountID(): int
    {
        return $this->accountID;
    }

    /**
     * Set the value of accountID
     *
     * @param int|null $accountID
     *
     * @return self
     */
    public function setAccountID(?int $accountID = null): self
    {
        if ($accountID === null) {
            $accountID = $this->generateUniqueAccountID();
        } elseif (strlen((string) $accountID) !== 11) {
            throw new InvalidArgumentException("Account ID must be 11 digits long.");
        }

        $this->accountID = $accountID;

        return $this;
    }

    private function generateUniqueAccountID(): int
    {
        // Genrer un nombre aléatoire composé de 11 chiffres
        do {
            $newAccountID = random_int(10000000000, 99999999999);
        } while ($this->accountIDExists($newAccountID));

        return $newAccountID;
    }

    private function accountIDExists(int $accountID): bool
    {
        // Vérifie dans la "base de donnée" les account ID existant
        // Je souhaite pouvoir récuprer les données sauvegarder client d'un ficiher CSV et des les afficher 
        // dans une liste menu (via un switch)  pour choisir le client qui souhaite crée un nouveau compte. 
        return false; //Pour le moment on dit que non
    }

    /**
     * Get the value of accountType
     *
     * @return string
     */
    public function getAccountType(): string
    {
        return $this->accountType;
    }

    /**
     * Set the value of accountType
     *
     * @param string $accountType
     *
     * @return self
     */
    public function setAccountType(string $accountType): self
    {
        while (true) {
            //Création du "menu"
            $m = intval(0);
            echo PHP_EOL . "------ Menu de choix de compte ------- " . PHP_EOL;
            echo PHP_EOL . ' 1 - Compte courant' . PHP_EOL;
            echo ' 2 - Compte Epargne' . PHP_EOL;
            echo ' 3 - Compte escroquerie longue durée' . PHP_EOL;
            echo PHP_EOL . "----------------------------------------- " . PHP_EOL;


            $m = null;
            while ($m !== "1" && $m !== "2" && $m !== "3") {
                $m = trim(readline("Faites votre choix de compte (1, 2 ou 3) : "));
            }

            switch ($m) {
                case "1":
                    $accountType = "Courant";
                    break;
                case "2":
                    $accountType = "Livret A";
                    break;
                case "3":
                    $accountType = "Plan Epargne Logement";
                    break;
            }

            $continuer = readline("Voulez-vous confirmer votre saisie ? (o/n) : ");
            if ($continuer === 'o') {
                break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
            }
        }
        $this->accountType = $accountType;

        return $this;
    }

    /**
     * Get the value of accountBalance
     *
     * @return int
     */
    public function getAccountBalance(): int
    {
        return $this->accountBalance;
    }

    /**
     * Set the value of accountBalance
     *
     * @param int $accountBalance
     *
     * @return self
     */
    public function setAccountBalance(int $accountBalance): self
    {
        while (true) {
            $input = readline("Entrer le montant initial de votre compte : ");

            if (ctype_digit($input) && intval($input) >= 0) {
                $accountBalance = intval($input);
                break;
            } else {
                echo "Saisie invalide, veuillez entrer un montant valide supérieur ou égal à zéro." . PHP_EOL;
            }
        }

        $this->accountBalance = $accountBalance;

        return $this;
    }

    /**
     * Get the value of overdraft
     *
     * @return bool
     */
    public function getOverdraft(): bool
    {
        return $this->overdraft;
    }

    /**
     * Set the value of overdraft
     *
     * @param bool $overdraft
     *
     * @return self
     */
    public function setOverdraft(bool $overdraft): self
    {

        while (true) {
            //Création du "menu"
            $m = intval(0);
            echo PHP_EOL . "------ Menu de choix d'autorisation de découvert' ------- " . PHP_EOL;
            echo PHP_EOL . ' 1 - Découvert autorisé' . PHP_EOL;
            echo ' 2 - Découvert refusée' . PHP_EOL;
            echo PHP_EOL . "----------------------------------------- " . PHP_EOL;

            $m = null;
            while ($m !== "1" && $m !== "2") {
                $m = trim(readline("Faite votre choix d'autorisation de découvert (1 pour Découvert autorisé, 2 pour Découvert refusé) : "));
            }

            switch ($m) {
                case 1:
                    $overdraft = true;
                    break;
                case 2:
                    $overdraft = false;
                    break;
            }

            $continuer = readline("Voulez-vous confirmer votre saisie ? (o/n) : ");
            if ($continuer === 'o') {
                break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
            }
        }
        $this->overdraft = $overdraft;

        return $this;
    }
}

//         // Choix à la main
//         while (true) {
//             $input = strtolower(readline("Entrer 'true' ou 'false' le choix d'autorisation de découvert : "));

//             if ($input === "true") {
//                 $overdraft = true;
//                 break;
//             } elseif ($input === "false") {
//                 $overdraft = false;
//                 break;
//             } else {
//                 echo "Saisie invalide, veuillez entrer 'true' ou 'false'." . PHP_EOL;
//             }
//         }
//         $this->overdraft = $overdraft;

//         return $this;
//     }
// }


while (true) {
    // Test 
    // Création d'un objet Account en utilisant le constructeur
    $account = new Account(12345, null, "Courant", 0, true);
    // Accéder aux propriétés et les afficher
    echo "Client ID: " . $account->getClientID() . PHP_EOL;
    echo "Account ID: " . $account->getAccountID() . PHP_EOL;
    echo "Account Type: " . $account->getAccountType() . PHP_EOL;
    echo "Account Balance: " . $account->getAccountBalance() . PHP_EOL;
    echo "Overdraft Allowed: " . ($account->getOverdraft() ? "Autorisé" : "Refusé") . PHP_EOL;


    // Afficher les nouvelles valeurs après les modifications
    // echo "Updated Account Balance: " . $account->getAccountBalance() . PHP_EOL;
    // echo "Updated Account Type: " . $account->getAccountType() . PHP_EOL;

    // $agencyAdress = ` $number + $street + $town + , + $postalCode `; //Pour asiggner l'adresse.
    $continuer = trim(readline("Voulez-vous crée un nouveau compte ? (o/n) : "));
    if ($continuer !== 'o') {
        break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
    }
}