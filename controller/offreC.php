

<?php

include_once '../config.php';

class offreC
{

    public function getid_offre($id_offre) {
        $db = config::getConnexion();

        $query = $db->prepare('SELECT * FROM offre WHERE id_offre = :id_offre');
        $query->bindValue(':id_offre', $id_offre, PDO::PARAM_INT);

        try {
            $query->execute();
            $offreData = $query->fetch(PDO::FETCH_ASSOC);

            if ($offreData) {
                // Créez et retournez une instance de l'objet offre
                return new offre(
                    $offreData['id_offre'],
                    $offreData['nom'],
                    $offreData['prenom'],
                    $offreData['date_offre'],
                    $offreData['montant'],
                    $offreData['tel'],
                    $offreData['email'],
                    $offreData['enchere'],
                );
            } else {
                // Aucune enchère trouvée avec cet ID
                return null;
            }
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function listoffre()
    {
        $sql = "SELECT * FROM offre";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function listoffrebyid($id)
{
    $sql = "SELECT * FROM offre WHERE id_enchere = :id_enchere";
    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_enchere', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the result as an associative array
        $offre = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $offre;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}

public function getMaxMise($idEnchere)
    {
        $db = config::getConnexion();

        $query = $db->prepare('SELECT MAX(montant) AS max_montant FROM offre WHERE id_enchere = :id_enchere');
        $query->bindValue(':id_enchere', $idEnchere, PDO::PARAM_INT);

        try {
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['max_montant'])) {
                return $result['max_montant'];
            } else {
                // Aucune mise trouvée pour cette offre
                return false; // Vous pouvez ajuster la valeur par défaut selon vos besoins
            }
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Error: " . $e->getMessage();
            return false; // En cas d'erreur, vous pouvez ajuster la valeur par défaut selon vos besoins
        }
    }



    function delete_offre($ide)
    {
        $sql = "DELETE FROM offre WHERE id_offre = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function add_offre(offre $offre)
    {
        $sql = "INSERT INTO offre (nom, prenom, email, tel, montant, date_offre, id_enchere) VALUES ( :nom, :prenom, :email, :tel, :montant, :date_offre, :id_enchere)"; // Correction ici
    
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $offre->getnom(),
                'prenom' => $offre->getprenom(),
                'email' => $offre->getemail(),
                'tel' => $offre->gettel(),
                'montant' => $offre->getmontant(),
                'date_offre' => $offre->getdate(),
                'id_enchere'=> $offre->getenchere()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function show_offre($id)
    {
        $sql = "SELECT * from offre where id_offre = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $offre = $query->fetch();
            return $offre;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

public function updateoffre(offre $offre, $id) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE offre SET 
                    nom = :nom_objet,
                    prenom = :prenom, 
                    email = :email, 
                    tel = :tel,
                    montant = :montant, 
                    date_offre = :date_offre,
                    id_enchere= :id_enchere
                WHERE id_offre = :id_offre'
            );
    
            $query->bindValue('id_offre', $id);
            $query->bindValue('nom_objet', $offre->getnom());
            $query->bindValue('prenom', $offre->getprenom());
            $query->bindValue('email', $offre->getemail());
            $query->bindValue('tel', $offre->gettel());
            $query->bindValue('montant', $offre->getmontant());
            $query->bindValue('date_offre', $offre->getdate());
            $query->bindValue('id_enchere', $offre->getenchere());
            $query->execute();
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
?>

