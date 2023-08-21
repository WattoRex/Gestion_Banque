<?php

class Agence{
    private int $agencyCode;
    private string $agencyName;
    private string $agencyAdress;
    public function __construct($agencyCode, string $agencyName, string $agencyAdress) {
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
        $agencyCode = 100;
        if($agencyCode != 999){
            $agencyCode = $agencyCode + 1;
            $this->agencyCode = $agencyCode;
        }else{
            echo "le nombres d'agences maximales a ete atteint. ";
        }
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
        $postalCode = trim(intval(readline("Veuillez saisir votre code postal : ")));
        $town = trim(strval(readline("Veuillez saisir votre ville : ")));
        $street = trim(strval(readline("Veuillez saisir votre rue : ")));
        $number = trim(intval(readline("Veuillez saisir votre numero de rue : ")));
        $agencyAdress = "l'adresse est : {$number} {$street}, {$postalCode}, {$town}. ";
        $this->agencyAdress = $agencyAdress;

        return $this;
    }
}
// $maif = new Agence(null,"", "");
// echo "Nom de l'agence : " . $maif->getAgencyName() . PHP_EOL;
// echo $maif->getAgencyCode() . PHP_EOL;
// echo $maif->getAgencyAdress() . PHP_EOL;
// echo "-----------------------" . PHP_EOL;
?>