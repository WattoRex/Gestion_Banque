<?php

class Client 
{
    private int $clientID;
    private string $nom;
    private string $prenom;
    private string $date_naissance;
    private string $email;
    public function __construct(int $clientID, string $nom, string $prenom, string $date_naissance, string $email)
    {
        $this->clientID = $clientID;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->email = $email;
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
        $this->nom = $nom;

        return $this;
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
        $this->prenom = $prenom;

        return $this;
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
    public function setDateNaissance(string $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
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
        $this->email = $email;

        return $this;
    }
}