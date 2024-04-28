<?php

include_once '../config.php';

class participationC
{

    public function listpart()
    {
        $sql = "SELECT * FROM participation2";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    


    function addpart($participation)
    {
        $sql = "INSERT INTO participation2
        VALUES (NULL , :nom , :cin , :ide )";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $participation->getnom(),
                'cin' => $participation->getcin(),
                'ide' => $participation->getide()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deletepart($idp)
    {
        $sql = "DELETE FROM participation2 WHERE idp= :idp";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idp', $idp);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }



    function showpart($idp)
    {
        $sql = "SELECT * from participation2 where idp = $idp";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $participation = $query->fetch();
            return $participation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    public function getNombreParticipantsPourEvent($ide)
    {
        $db = config::getConnexion();

        $query = $db->prepare('SELECT COUNT(*) AS nombre_participants FROM participation2 WHERE ide = :ide');
        $query->bindValue(':ide', $ide, PDO::PARAM_INT);

        try {
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['nombre_participants'])) {
                return $result['nombre_participants'];
            } else {
                // Aucune participation trouvée pour cet événement
                return 0; // Vous pouvez ajuster la valeur par défaut selon vos besoins
            }
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Error: " . $e->getMessage();
            return 0; // En cas d'erreur, vous pouvez ajuster la valeur par défaut selon vos besoins
        }
    }
 
  
}
