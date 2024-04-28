<?php
class participation{
    private ?int $idp = null ;
    private ?int $cin = null;
    private ?string $nom = null;
    private ?int $ide = 0 ;
    public static function geteventid(){
        try {
            $pdo = config::getConnexion();
            $sql = "SELECT event.ide
                    FROM event
                    JOIN participation ON event.ide = participation.ide";
    
            $query = $pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, 'participation');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    

    public function __construct($idp = null,$nom , $cin , $ide ){
        $this->idp = $idp ;
        $this ->nom = $nom;
        $this ->cin = $cin ;
        $this ->ide = $ide;
       
    }

    public function getId()
    {
        return $this->idp;
    }
    public function getcin(){
        return $this ->cin ;
    }
    public function getnom(){
        return $this ->nom ;
    }
    public function getide(){
        return $this ->ide;
    }

    public function setcin(){
        $this->cin=$cin;
    }
    public function setnom(){
        $this->nom=$nom;
    }
    
    public function setide(){
        $this->ide=$ide;
    }
    
}

?>
