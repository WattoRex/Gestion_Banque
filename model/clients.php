<?php

class Client
{
    private string $clientID;
    private string $nom;
    private string $prenom;
    private string $date_naissance;
    private string $email;
    public function __construct(string $clientID, string $nom, string $prenom, string $date_naissance, string $email)
    {
        $this->setClientID($clientID);
        $this->setnom($nom);
        $this->setprenom($prenom);
        $this->setDateNaissance($date_naissance);
        $this->setemail($email);
    }

    /**
     * Get the value of clientID
     *
     * @return int
     */
    public function getClientID(): string
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
    public function setClientID(string $clientID): self
    {
        $lettre = range("A", "Z");
        $codeLettre1 = $lettre[array_rand($lettre)];
        $codeLettre2 = $lettre[array_rand($lettre)];
        $codeLettre = $codeLettre1 . $codeLettre2;

        $csvFileName = './save/clients.csv';

        // Lire le fichier CSV pour obtenir le nombre le plus élevé
        $handle = fopen($csvFileName, 'r');
        $maxNumber = 100000; // Valeur par défaut si le fichier est vide

        if ($handle !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                $currentNumber = (int) substr($data[0], 2); // Extraire les chiffres du clientID
                if ($currentNumber > $maxNumber) {
                    $maxNumber = $currentNumber;
                }
            }
            fclose($handle);
        }

        $newNumber = $maxNumber + 1;
        $formattedNewNumber = sprintf('%06d', $newNumber); // Formater en 6 chiffres avec des zéros

        $clientID = $codeLettre . $formattedNewNumber;
        $this->clientID = $clientID;
        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom(string $nom): self
    {
        do {
            $nom = trim(readline("Saisissez le nom du client : "));

            // Vérification de la longueur du nom
            if (strlen($nom) < 2 || strlen($nom) > 50) {
                echo "Le nom doit avoir entre 2 et 50 caractères." . PHP_EOL;
                continue;
            }

            // Vérification des caractères du nom (lettres, espaces et tirets)
            if (!preg_match('/^[A-Za-z\s\-]+$/', $nom)) {
                echo "Le nom ne doit contenir que des lettres, des espaces et des tirets." . PHP_EOL;
                continue;
            }

            $this->nom = $nom;
            return $this;
        } while (true);
    }

    /**
     * Get the value of prenom
     *
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param string $prenom
     *
     * @return self
     */
    public function setPrenom(string $prenom): self
    {
        do {
            $prenom = trim(readline("Saisissez le prénom du client : "));

            // Vérification de la longueur du prénom
            if (strlen($prenom) < 2 || strlen($prenom) > 50) {
                echo "Le prénom doit avoir entre 2 et 50 caractères." . PHP_EOL;
                exit;
            }

            // Vérification des caractères du prénom (lettres, espaces et tirets)
            if (!preg_match('/^[A-Za-z\s\-]+$/', $prenom)) {
                echo "Le prénom ne doit contenir que des lettres, des espaces et des tirets." . PHP_EOL;
                exit;
            }
            $this->prenom = $prenom;
            return $this;
        } while (true);
    }

    /**
     * Get the value of date_naissance
     *
     * @return string
     */
    public function getDateNaissance(): string
    {
        return $this->date_naissance;
    }

    /**
     * Set the value of date_naissance
     *
     * @param string $date_naissance
     *
     * @return self
     */
    public function setDateNaissance(string $date_naissance): void
    {
        do {
            $date_naissance = trim(readline("Saisissez la date de naissance du client : "));

            if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_naissance) && ctype_digit(str_replace('/', '', $date_naissance))) {
                $date_parts = explode('/', $date_naissance);

                if (count($date_parts) === 3 && checkdate($date_parts[1], $date_parts[0], $date_parts[2])) {
                    $this->date_naissance = $date_naissance;
                } else {
                    echo "Date de naissance non valide. Utilisez le format DD/MM/YYYY." . PHP_EOL;
                    continue;
                }
            } else {
                echo "Format de date de naissance invalide. Utilisez le format DD/MM/YYYY et assurez-vous qu'il ne contient que des chiffres." . PHP_EOL;
                continue;
            }

            break;
        } while (true);
    }


    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        do {
            $input_email = trim(readline("Saisissez l'email du client : "));

            if (filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
                $this->email = $input_email; // Stocke l'email dans l'objet seulement si c'est une adresse email valide
                break; // Sort de la boucle si l'email est valide
            } else {
                echo "L'email n'est pas valide. Veuillez saisir une adresse email valide." . PHP_EOL;
            }
        } while (true);

        return $this;
    }
}

// // Exemple test
// $client = new Client(202020, "", "", "", "");
// echo "Informations du client : " . PHP_EOL;
// echo "Identifiant : " . $client->getClientID() . PHP_EOL;
// echo "Nom : " . $client->getNom() . PHP_EOL;
// echo "Prénom : " . $client->getPrenom() . PHP_EOL;
// echo "Date de naissance : " . $client->getDateNaissance() . PHP_EOL;
// echo "Email : " . $client->getEmail() . PHP_EOL;
// echo "-----------------------" . PHP_EOL;