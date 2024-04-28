
<?php

class offre
{
    private ?string $id_offre = null;
    private ?string $nom = null;
    private ?int $montant = 0;
    private ?string $date = null;
    private ?string $prenom = null;
    private ?int $tel = 0;
    private ?string $email = null;
    private ?int $enchere = 0;
    public static function getencherefromoffre()
{
    try {
        $pdo = config::getConnexion();
        $sql = "SELECT enchere.id_enchere
                FROM enchere
                JOIN offre ON enchere.id_enchere = offre.id_enchere";

        $query = $pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'offre');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

    public function __construct($id_offre, $nom, $prenom, $date, $montant, $tel, $email, $enchere)
    {

        $this->id_offre = $id_offre;
        $this->nom = $nom;
        $this->montant = $montant;
        $this->date = $date;
        $this->prenom = $prenom;
        $this->tel = $tel;
        $this->email = $email;
        $this->enchere = $enchere;
    }

    public function setid_offre($id_offre)
    {
        $this->id_offre = $id_offre;
    }

    public function getid_offre()
    {
        return $this->id_offre;
    }

    public function setnom($nom)
    {
        $this->nom = $nom;
    }

    public function getnom()
    {
        return $this->nom;
    }

    public function getmontant()
    {
        return $this->montant;
    }

    public function setmontant($montant)
    {
        $this->montant = $montant;
    }

    public function getdate()
    {
        return $this->date;
    }

    public function setdate($date)
    {
        $this->date = $date;
    }
    public function getprenom()
    {
        return $this->prenom;
    }
    public function setprenom($prenom)
    {
        $this->prenom = $prenom;
    }
    public function gettel()
    {
        return $this->tel;
    }
    public function settel($tel)
    {
        $this->tel = $tel;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function setemail($email)
    {
        $this->email = $email;
    }
    public function getenchere()
    {
        return $this->enchere;
    }
    public function setenchere($enchere)
    {
        $this->enchere = $enchere;
    }
}
