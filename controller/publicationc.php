<?php


class publicationC
{

    public function listepublication($noPage,$perpage)
    {
        $sql = 'SELECT * from publication ORDER BY date_pub DESC LIMIT '. ($perpage*($noPage-1)).','.$perpage;
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function listepublications()
    {
        $sql = "SELECT * FROM publication";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function pagination()
    {
        $sql = "SELECT COUNT(*) as nbr_pub from publication";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([]);
            $nombre = $query->fetch();
            return $nombre['nbr_pub'];
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
   

    function deletepublication($id)
    {
        $sql = "DELETE from publication WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addpublication($publication)
    {
        $sql = "INSERT INTO publication 
        VALUES (NULL,:img,:titre,:contenu,:detail, :date_pub,:auteur)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'img'=> $publication->getimage(),
                'titre' => $publication->gettitre(),
                'contenu' => $publication->getcontenu(),
                'detail' => $publication->getdetail(),
                'date_pub' => $publication->getdatepub(),
                'auteur' => $publication->getauteur(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showpublication($id)
    {
        $sql = "SELECT * from publication where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $publication = $query->fetch();
            return $publication;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatepublication($publication, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE publication SET 
                    img = :img,
                    titre = :titre, 
                    contenu = :contenu, 
                    detail = :detail,
                    date_pub = :date_pub, 
                    auteur = :auteur
                WHERE id= :id'
            );
            
            $query->execute([
                'id' => $id,
                'img' => $publication->getimage(),
                'titre' => $publication->gettitre(),
                'contenu' => $publication->getcontenu(),
                'detail' => $publication->getdetail(),
                'date_pub' => $publication->getdatepub(),
                'auteur' => $publication->getauteur(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
   public function rechercherParTitre($titre)
   {
    
    $db = config::getConnexion();
     $sql = "SELECT * FROM publication WHERE titre LIKE :titre";
     $stmt = $db->prepare($sql);
     $stmt->bindValue(':titre', '%' . $titre . '%');
     $stmt->execute();

     return $stmt->fetchAll();
   }
   public function listepub()
    {
        $sql = 'SELECT * from publication ORDER BY date_pub DESC LIMIT 0,4';
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
?>