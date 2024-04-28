<?php
class publication
{
    private ?int $id =0;
    private ?string $img = null;
    private ?string $titre = null;
    private ?string $contenu= null;
    private ?string $detail= null;
    private ?string $date_pub=null;
    private ?string $auteur = null;

    public function __construct($id = null,$g, $n, $p, $k, $a, $d)
    {
        $this->id = $id;
        $this->img=$g;
        $this->titre = $n;
        $this->contenu = $p;
        $this->detail = $k;
        $this->date_pub = $a;
        $this->auteur = $d;
    }


    public function getIdpub()
    {
        return $this->id;
    }


    public function gettitre()
    {
        return $this->titre;
    }


    public function settitre($titre)
    {
        $this->titre= $titre;

        return $this;
    }
    public function getimage()
    {
        return $this->img;
    }


    public function setimage($img)
    {
        $this->img = $img;

        return $this;
    }

    public function getcontenu()
    {
        return $this->contenu;
    }


    public function setcontenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getdetail()
    {
        return $this->detail;
    }


    public function setdetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }
    public function getdatepub()
    {
        return $this->date_pub;
    }


    public function setdatepub($date_pub)
    {
        $this->date_pub = $date_pub;

        return $this;
    }


    public function getauteur()
    {
        return $this->auteur;
    }


    public function setauteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }
    
}
