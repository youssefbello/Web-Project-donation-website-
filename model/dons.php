<?php

class dons
{
    private ?int $id_donation = null;

    private ?string $cause =null;

    private ?string $date_debut = null;

    private ?string $date_fin = null;

    private ?string $img = null; 

    private ?int $etat=0;

    private ?string $amount = null;

    private ?string $descr =null;
   
    public function __construct($id_donation = null,  $cause,  $date_debut, $date_fin, $img, $etat, $amount, $descr)
    {
        $this->id_donation = $id_donation;  
        $this->cause= $cause; 
        $this->date_debut = $date_debut;   
        $this->date_fin= $date_fin;
        $this->etat=$etat;
        $this->img= $img;
        $this->amount = $amount;
        $this->descr = $descr;

    }

    public function getId_donation()
    {
        return $this->id_donation;
    }
    public function setId_donation($id_donation)
    {
        $this->id_donation = $id_donation;
        return $this;
    }
    public function getCause()
    {
        return $this->cause;
    }
    
    public function setCause($cause)
    {
        $this->cause = $cause;
        return $this;
    }
    
    public function getDate()
    {
        return $this->date_debut;
    }

    public function setDate($date_debut)
    {
        $this->date_debut= $date_debut;
        return $this;
    }

    public function getDateFin()
    {
        return $this->date_fin;
    }

    public function setDateFin($date_fin)
    {
        $this->date_fin= $date_fin;
        return $this;
    }
    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img= $img;
        return $this;
    }
    public function getetat()
    {
        return $this->etat;
    }

    public function setetat($etat)
    {
        $this->etat = $etat;
    }
    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    public function getdescr()
    {
        return $this->descr;
    }

    public function setdescr($descr)
    {
        $this->descr = $descr;
        return $this;
    }
}

?>