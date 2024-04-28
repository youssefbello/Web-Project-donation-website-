<?php


class participation
{
    private ?int $id_participation = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?int $montant = 0;
    private ?string $date_p = null;
    private ?string $email = null;
    private ?string $tel = null;
    private ?string $dons = null;
    public static function getdonsfromparticipation()
    {
        try {
            $pdo = config::getConnexion();
            $sql = "SELECT dons.id_donation
                FROM dons
                JOIN participation ON dons.id_donation = participation.id_donation";

            $query = $pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, 'participation');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __construct($id_participation, $nom, $prenom, $montant, $date_p, $email, $tel, $dons)
    {

        $this->id_participation = $id_participation;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->montant = $montant;
        $this->date_p = $date_p;
        $this->email = $email;
        $this->tel = $tel;
        $this->dons = $dons;
    }


    public function setid_participation($id_participation)
    {
        $this->id_participation = $id_participation;
    }
    public function getid_participation()
    {
        return $this->id_participation;
    }
    public function setnom($nom)
    {
        $this->nom = $nom;
    }

    public function getnom()
    {
        return $this->nom;
    }
    public function getprenom()
    {
        return $this->prenom;
    }
    public function setprenom($prenom)
    {
        $this->prenom = $prenom;
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
        return $this->date_p;
    }

    public function setdate($date_p)
    {
        $this->date_p = $date_p;
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
    public function getdons()
    {
        return $this->dons;
    }
    public function setdons($dons)
    {
        $this->dons = $dons;
    }
}
