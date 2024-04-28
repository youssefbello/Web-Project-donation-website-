<?php
class sponsor{
    private ?int $ids = null ;
    private ?string $noms = null;
    private ?string $typs = null;
    private ?int $ide= 0 ;
    public static function geteventid(){
        try {
            $pdo = config::getConnexion();
            $sql = "SELECT event.ide
                    FROM event
                    JOIN sponsor ON event.ide = sponsor.ide";
    
            $query = $pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, 'sponsor');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __construct($ids = null,$noms , $typs , $ide ){
        $this->ids = $ids ;
        $this ->noms = $noms ;
        $this ->typs = $typs ;
        $this ->ide = $ide ;
    }

    public function getId()
    {
        return $this->ids;
    }
    public function getnoms(){
        return $this ->noms ;
    }
    public function gettyps(){
        return $this ->typs ;
    }
    public function getide(){
        return $this ->ide ;
    }
  
    public function setnoms(){
        $this->noms=$noms;
    }
    public function settyps(){
        $this->typs=$typs;
    }
    public function setide(){
        $this->ide=$ide;
    }
   
}

?>