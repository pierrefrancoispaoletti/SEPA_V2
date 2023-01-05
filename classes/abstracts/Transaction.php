<?php

abstract class Transaction
{
    private $ibanCrediteur;
    private $ibanDebiteur;
    private $nomDebiteur;
    private $bicCrediteur;
    private $bicDebiteur;
    private $nomCrediteur;
    private $amount;
    private $currency = "EUR";
    private $nomInitiateur;
    private $description;

    private $type;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
        $this->type = static::getType();
    }

    abstract static function getType();

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Get the value of ibanCrediteur
     */
    public function getIbanCrediteur()
    {
        return $this->ibanCrediteur;
    }

    /**
     * Set the value of ibanCrediteur
     */
    public function setIbanCrediteur(string $ibanCrediteur)
    {
        $this->ibanCrediteur = $ibanCrediteur;
    }

    /**
     * Get the value of ibanDebiteur
     */
    public function getIbanDebiteur()
    {
        return $this->ibanDebiteur;
    }

    /**
     * Set the value of ibanDebiteur
     */
    public function setIbanDebiteur(string $ibanDebiteur)
    {
        $this->ibanDebiteur = $ibanDebiteur;
    }

    /**
     * Get the value of bicCrediteur
     */
    public function getBicCrediteur()
    {
        return $this->bicCrediteur;
    }

    /**
     * Set the value of bicCrediteur
     */
    public function setBicCrediteur(string $bicCrediteur)
    {
        $this->bicCrediteur = $bicCrediteur;
    }

    /**
     * Get the value of bicDebiteur
     */
    public function getBicDebiteur()
    {
        return $this->bicDebiteur;
    }

    /**
     * Set the value of bicDebiteur
     */
    public function setBicDebiteur(string $bicDebiteur)
    {
        $this->bicDebiteur = $bicDebiteur;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     */
    public function setAmount(mixed $amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get the value of currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * Get the value of nomInitiateur
     */
    public function getNomInitiateur()
    {
        return $this->nomInitiateur;
    }

    /**
     * Set the value of nomInitiateur
     */
    public function setNomInitiateur(string $nomInitiateur)
    {
        $this->nomInitiateur = $nomInitiateur;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of nomCrediteur
     */
    public function getNomCrediteur()
    {
        return $this->nomCrediteur;
    }

    /**
     * Set the value of nomCrediteur
     */
    public function setNomCrediteur(string $nomCrediteur)
    {
        $this->nomCrediteur = $nomCrediteur;
    }

    /**
     * Get the value of nomDebiteur
     */
    public function getNomDebiteur()
    {
        return $this->nomDebiteur;
    }

    /**
     * Set the value of nomDebiteur
     */
    public function setNomDebiteur(string $nomDebiteur)
    {
        $this->nomDebiteur = $nomDebiteur;
    }
}
