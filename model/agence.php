<?php

class Agence{
    private int $agencyCode;
    private string $agencyName;
    private string $agencyAdress;
    public function __construct($agencyCode, string $agencyName, string $agencyAdress) {
        
        
        // $csvFile = 'agences.csv'; 

        // $agencyData = []; // Tableau pour stocker les données

        // if (($handle = fopen($csvFile, 'r')) !== false) {
        //     while (($data = fgetcsv($handle)) !== false) {
        //         $agencyData
        //     }
        //     fclose($handle);
        // }

        $this->setAgencyCode($agencyCode);
        $this->setAgencyName($agencyName);
        $this->setAgencyAdress($agencyAdress);
    }


    /**
     * Get the value of agencyCode
     *
     * @return int
     */
    public function getAgencyCode(): int
    {
        return $this->agencyCode;
    }

    /**
     * Set the value of agencyCode
     *
     * @param int $agencyCode
     *
     * @return self
     */
    public function setAgencyCode(?int $agencyCode=null): self
    {   
         // Lire le compteID le plus élevé depuis le fichier CSV
         $highestAgencyCode = 1000; // Valeur de départ par défaut

         $csvFile = fopen('agences.csv', 'r');
         if ($csvFile !== false) {
             while (($data = fgetcsv($csvFile)) !== false) {
                 $currentAgencyCode = (int) $data[0]; // Supposons que l'ID de compte soit dans la deuxième colonne
                 if ($currentAgencyCode > $highestAgencyCode) {
                     $highestAgencyCode = $currentAgencyCode;
                 }
             }
             fclose($csvFile);
         }
 
         // Incrémenter le compteID le plus élevé de un
         $newAgencyCode = $highestAgencyCode + 1;
 
         // S'assurer que le compteID a 11 chiffres
         $formattedAgencyCode = str_pad($newAgencyCode, 3, '0', STR_PAD_LEFT);
 
         $this->agencyCode = (int) $formattedAgencyCode;
 
         return $this;
     }
 
    /**
     * Get the value of agencyName
     *
     * @return string
     */
    public function getAgencyName(): string
    {
        return $this->agencyName;
    }

    /**
     * Set the value of agencyName
     *
     * @param string $agencyName
     *
     * @return self
     */
    public function setAgencyName(string $agencyName): self
    {
        $agencyName = trim(strval(readline("Veuilez saisir le nom de l'agence : ")));
        $this->agencyName = $agencyName;

        return $this;
    }

    /**
     * Get the value of agencyAdress
     *
     * @return string
     */
    public function getAgencyAdress(): string
    {
        return $this->agencyAdress;
    }

    /**
     * Set the value of agencyAdress
     *
     * @param string $agencyAdress
     *
     * @return self
     */
    public function setAgencyAdress(string $agencyAdress): self
    {
        testString($postalCode = trim(intval(readline("Veuillez saisir votre code postal : "))));
        $town = trim(strval(readline("Veuillez saisir votre ville : ")));
        $street = trim(strval(readline("Veuillez saisir votre rue : ")));
        $number = trim(intval(readline("Veuillez saisir votre numero de rue : ")));
        $agencyAdress = "{$number} {$street}, {$postalCode}, {$town}. ";
        $this->agencyAdress = $agencyAdress;

        return $this;
    }

    function testString(string $testChaine){
       $bool = ctype_alpha($testChaine);
        do{ 
            echo "il ne faut que des caracteres alphanumeriques. ";
        }while($bool);
    }

    // public function testInt(){

    // }
}

// $maif = new Agence(null,"", "");
// echo "Nom de l'agence : " . $maif->getAgencyName() . PHP_EOL;
// echo " le code de l'agence est : " . $maif->getAgencyCode() . PHP_EOL;
// echo "l'adresse est : " . $maif->getAgencyAdress() . PHP_EOL;
// echo "-----------------------" . PHP_EOL;
?>