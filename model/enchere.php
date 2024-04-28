<?php
class enchere
{
    private ?string $id_enchere = null;
    private ?string $date_debut = null;
    private ?string $date_fin = null;
    private ?string $nomObjet = null;
    private ?int $prix_min = 0;
    private ?int $etat = 0;
    private ?int $statut = 0;
    private ?string $descr_objet = null;
    private ?string $image = null; 

    public function __construct($id_enchere = null, $date_debut, $date_fin, $nomObjet, $prix_min, $etat, $statut, $descr_objet, $image)
    {
        $this->id_enchere = $id_enchere;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->nomObjet = $nomObjet;
        $this->prix_min = $prix_min;
        $this->etat = $etat;
        $this->statut = $statut;
        $this->descr_objet = $descr_objet;
        $this->image = $image; 
    }

    public function getid()
    {
        return $this->id_enchere;
    }

    public function setid($t)
    {
        $this->id_enchere = $t;
    }

    public function getdate_debut()
    {
        return $this->date_debut;
    }

    public function setdate_debut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    public function getdate_fin()
    {
        return $this->date_fin;
    }

    public function setdate_fin($date_fin)
    {
        $this->date_fin = $date_fin;
    }

    public function getnom()
    {
        return $this->nomObjet;
    }

    public function setnom($e)
    {
        $this->nomObjet = $e;
    }

    public function getprix_min()
    {
        return $this->prix_min;
    }

    public function setprix_min($t)
    {
        $this->prix_min = $t;
    }

    public function getetat()
    {
        return $this->etat;
    }

    public function setetat($t)
    {
        $this->etat = $t;
    }

    public function getstatut()
    {
        return $this->statut;
    }

    public function setstatut($t)
    {
        $this->statut = $t;
    }

    public function getdesc()
    {
        return $this->descr_objet;
    }

    public function setdesc($t)
    {
        $this->descr_objet = $t;
    }
    public function getimage()
    {
        return $this->image;
    }

    public function setimage($image)
    {
        $this->image = $image;
    }
}

