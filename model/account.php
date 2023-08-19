<?php

class Account
{
    private int $clientID;
    private int $accountID;
    private string $accountType;
    private int $accountBalance;
    private bool $overdraft;

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

            $m = readline(PHP_EOL . "Faite votre choix de compte : ");

            switch ($m) {
                case 1:
                    $accountType = "Courant";
                    break;
                case 2:
                    $accountType = "Livret A";
                    break;
                case 3:
                    $accountType = "Plan Epargne Logement";
                    break;
            }

            $continuer = readline(PHP_EOL . "Voulez-<>vous revenir au menu ? (o/n) : ");
            if ($continuer !== 'o') {
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
            $input = intval(readline("Entrer le montant inital de votre compte : "));

            if ($input >= 0) {
                $accountBalance = $input;
                break;
            } else {
                echo "Saisie invalide, veuillez entrer un momant supérieur ou égal à zéro." . PHP_EOL;
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
            $input = strtolower(readline("Entrer 'true' ou 'false' le choix d'autorisation de découvert : "));

            if ($input === "true") {
                $overdraft = true;
                break;
            } elseif ($input === "false") {
                $overdraft = false;
                break;
            } else {
                echo "Saisie invalide, veuillez entrer 'true' ou 'false'." . PHP_EOL;
            }
        }
        $this->overdraft = $overdraft;

        return $this;
    }
}


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
echo "Updated Account Balance: " . $account->getAccountBalance() . PHP_EOL;
echo "Updated Account Type: " . $account->getAccountType() . PHP_EOL;

// $agencyAdress = ` $number + $street + $town + , + $postalCode `; //Pour asiggner l'adresse.
