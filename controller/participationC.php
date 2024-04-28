<?php

include_once '../config.php';

class participationC
{

    public function getid_participation($id_participation) {
        $db = config::getConnexion();

        $query = $db->prepare('SELECT * FROM participation WHERE id_participation = :id_participation');
        $query->bindValue(':id_participation', $id_participation, PDO::PARAM_INT);

        try {
            $query->execute();
            $participationData = $query->fetch(PDO::FETCH_ASSOC);

            if ($participationData) {
                // Créez et retournez une instance de l'objet offre
                return new participation(
                    $participationData['id_participation'],
                    $participationData['nom'],
                    $participationData['prenom'],
                    $participationData['montant'],
                    $participationData['date_p'],
                    $participationData['email'],
                    $participationData['tel'],
                    $participationData['id_donation']
                );
            } else {
                // Aucune don trouvée avec cet ID
                return null;
            }
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function list_participation()
    {
        $sql = "SELECT * FROM participation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function listparticipationbyid($id)
{
    $sql = "SELECT * FROM participation WHERE id_donation = :id_donation";
    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_donation', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the result as an associative array
        $participation = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $participation;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}

    public function getMaxMise($id_donation)
    {
        $db = config::getConnexion();

        $query = $db->prepare('SELECT MAX(montant) AS max_montant FROM participation WHERE id_donation = :id_donation');
        $query->bindValue(':id_donation', $id_donation, PDO::PARAM_INT);

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
    function delete_participation($id_participation)
    {
        $sql = "DELETE FROM participation WHERE id_participation = :id_participation";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_participation', $id_participation);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function ajout_participation(participation $participation)
    {
        $sql = "INSERT INTO participation (nom, prenom, montant, date_p, email, tel, id_donation) VALUES ( :nom, :prenom, :montant, :date_p,:email, :tel,  :id_donation)"; // Correction ici
    
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $participation->getnom(),
                'prenom' => $participation->getprenom(),
                'montant' => $participation->getmontant(),
                'date_p' => $participation->getdate(),
                'email' => $participation->getemail(),
                'tel' => $participation->gettel(),
                'id_donation'=> $participation->getdons()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function show_participation($id_participation)
    {
        $sql = "SELECT * from participation where id_participation = $id_participation";
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

public function update_participation(participation $participation, $id_participation) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE participation SET 
                    nom = :nom,
                    prenom = :prenom, 
                    montant = :montant, 
                    date_p = :date_p,
                    email = :email, 
                    tel = :tel,
                    id_donation= :id_donation
                WHERE id_participation = :id_participation'
            );
    
            $query->bindValue(':id_participation', $id_participation);
            $query->bindValue(':nom', $participation->getnom());
            $query->bindValue(':prenom', $participation->getprenom());
            $query->bindValue(':montant', $participation->getmontant());
            $query->bindValue('date_p', $participation->getdate());
            $query->bindValue(':email', $participation->getemail());
            $query->bindValue(':tel', $participation->gettel());
            $query->bindValue('id_donation', $participation->getdons());
            $query->execute();
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
?>