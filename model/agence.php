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
         // Lire le code agence le plus élevé depuis le fichier CSV
         $highestAgencyCode = 100; // Valeur de départ par défaut

         $csvFile = fopen('./save/agences.csv', 'r');
         if ($csvFile !== false) {
             while (($data = fgetcsv($csvFile)) !== false) {
                 $currentAgencyCode = (int) $data[0]; // Supposons que le code de l'agence soit dans la 1 colonne
                 if ($currentAgencyCode > $highestAgencyCode) {
                     $highestAgencyCode = $currentAgencyCode;
                 }
             }
             fclose($csvFile);
         }
 
         // Incrémenter le agencyCode le plus élevé de un
         $newAgencyCode = $highestAgencyCode + 1;
 
         // S'assurer que le agencyCode a 3 chiffres
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
        do{
            $agencyName = trim(strval(readline("Veuilez saisir le nom de l'agence : ")));
            if(ctype_alpha($agencyName)){
                $this->agencyName = $agencyName;
                break;
            }else 
                echo "Veuillez saisir que des carateres alphabetique !" . PHP_EOL;
        }while(true);
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
        while(true){
            $postalCode = trim(intval(readline("Veuillez saisir votre code postal : ")));
            if(/*ctype_digit($postalCode) && */preg_match('/^\d{5}$/', $postalCode)){
            break;
         }else 
        echo "Veuillez saisir que des carateres numeriques !" . PHP_EOL;
        }
        while(true){
            $town = trim(strval(readline("Veuillez saisir votre ville : ")));
            if(ctype_alpha($town)){
                break;
             }else 
            echo "Veuillez saisir que des carateres alphabetique !" . PHP_EOL;
            }
        while(true){
            $street = trim(strval(readline("Veuillez saisir votre rue : ")));
            if(ctype_alpha($street)){
                break;
             }else 
            echo "Veuillez saisir que des carateres alphabetique !" . PHP_EOL;
            }
        while(true){
            $number = trim(intval(readline("Veuillez saisir votre numero de rue : ")));
            if(ctype_digit($number)){
                break;
             }else 
            echo "Veuillez saisir que des carateres numerique !" . PHP_EOL;
            }
        $agencyAdress = "{$number} {$street}, {$postalCode}, {$town}.";
        $this->agencyAdress = $agencyAdress;

        return $this;
    }

    // function testString(string $testChaine){
    //    $bool = ctype_alpha($testChaine);
    //     do{ 
    //         echo "il ne faut que des caracteres alphanumeriques. ";
    //     }while($bool);
    // }
    // public function testInt(){

    // }
}

// $maif = new Agence(null,"", "");
// echo "Nom de l'agence : " . $maif->getAgencyName() . PHP_EOL;
// echo " le code de l'agence est : " . $maif->getAgencyCode() . PHP_EOL;
// echo "l'adresse est : " . $maif->getAgencyAdress() . PHP_EOL;
// echo "-----------------------" . PHP_EOL;
?>