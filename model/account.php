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
        // Lire le compteID le plus élevé depuis le fichier CSV
        $highestAccountID = 10000000000; // Valeur de départ par défaut

        $csvFile = fopen('accounts.csv', 'r');
        if ($csvFile !== false) {
            while (($data = fgetcsv($csvFile)) !== false) {
                $currentAccountID = (int) $data[1]; // Supposons que l'ID de compte soit dans la deuxième colonne
                if ($currentAccountID > $highestAccountID) {
                    $highestAccountID = $currentAccountID;
                }
            }
            fclose($csvFile);
        }

        // Incrémenter le compteID le plus élevé de un
        $newAccountID = $highestAccountID + 1;

        // S'assurer que le compteID a 11 chiffres
        $formattedAccountID = str_pad($newAccountID, 11, '0', STR_PAD_LEFT);

        $this->accountID = (int) $formattedAccountID;

        return $this;
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

// while (true) {
//     // Test 
//     // Création d'un objet Account en utilisant le constructeur
//     $account = new Account(12345, null, "Courant", 0, true);
//     // Accéder aux propriétés et les afficher
//     echo "Client ID: " . $account->getClientID() . PHP_EOL;
//     echo "Account ID: " . $account->getAccountID() . PHP_EOL;
//     echo "Account Type: " . $account->getAccountType() . PHP_EOL;
//     echo "Account Balance: " . $account->getAccountBalance() . PHP_EOL;
//     echo "Overdraft Allowed: " . ($account->getOverdraft() ? "Autorisé" : "Refusé") . PHP_EOL;


//     // Afficher les nouvelles valeurs après les modifications
//     // echo "Updated Account Balance: " . $account->getAccountBalance() . PHP_EOL;
//     // echo "Updated Account Type: " . $account->getAccountType() . PHP_EOL;

//     // $agencyAdress = ` $number + $street + $town + , + $postalCode `; //Pour asiggner l'adresse.
//     $continuer = trim(readline("Voulez-vous crée un nouveau compte ? (o/n) : "));
//     if ($continuer !== 'o') {
//         break; // Sortir de la boucle si l'utilisateur n'entre pas 'o'
//     }
// }