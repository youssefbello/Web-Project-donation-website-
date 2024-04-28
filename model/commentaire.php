<?php
class commentaire
{
    private ?int $id_com =0;
    private ?int $id =0;
    private ?string $contenu_com = null;
    private ?string $date_creation=null;
    private ?string $nom_auteur = null;

    public function __constructcom($id_com = null,$id, $nom_auteur, $contenu_com, $date_creation)
    {
        $this->id_com = $id_com;
        $this->id=$id;
        $this->nom_auteur = $nom_auteur;
        $this->contenu_com = $contenu_com;
        $this->date_creation = $date_creation;
    }


    public function getIdcom()
    {
        return $this->id_com;
    }


    public function getIdpubb()
    {
        return $this->id;
    }


    public function setIdpubb($id)
    {
        $this->id= $id;

        return $this;
    }
    public function getcontenu_com()
    {
        return $this->contenu_com;
    }


    public function setcontenu_com($contenu_com)
    {
        $this->contenu_com = $contenu_com;

        return $this;
    }
    public function getdatecom()
    {
        return $this->date_creation;
    }


    public function setdatecom($date_creation)
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getnomauteur()
    {
        return $this->nom_auteur;
    }


    public function setnomauteur($nom_auteur)
    {
        $this->nom_auteur = $nom_auteur;

        return $this;
    }
}
