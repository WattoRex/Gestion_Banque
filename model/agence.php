<?php

class Agence{
    private int $agencyCode;
    private string $agencyName;
    private string $agencyAdress;
    public function __construct(int $agencyCode, string $agencyName, string $agencyAdress) {
        $this->agencyCode = $agencyCode;
        $this->agencyName = $agencyName;
        $this->agencyAdress = $agencyAdress;
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
    public function setAgencyCode(int $agencyCode): self
    {
        $this->agencyCode = $agencyCode;

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
        $postalCode = intval(readline("Veuillez saisir votre code postal : "));
        $town = strval(readline("Veuillez saisir votre ville : "));
        $street = strval(readline("Veuillez saisir votre rue : "));
        $number = intval(readline("Veuillez saisir votre numero de rue : "));
        $this->agencyAdress = ;

        return $this;
    }
}
// maif = new Agence(rthrh,452, setAgencyAdress());
?>