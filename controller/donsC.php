<?php

include_once '../config.php';

class donsC
{

    public function getDonationById($id_donation)
    {
        $db = config::getConnexion();

        $query = $db->prepare('SELECT * FROM dons WHERE id_donation = :id_donation');
        $query->bindValue(':id_donation', $id_donation, PDO::PARAM_INT);

        try {
            $query->execute();
            $donsData = $query->fetch(PDO::FETCH_ASSOC);

            if ($donsData) {
                // Créez et retournez une instance de l'objet don
                return new dons(
                    $donsData['id_donation'],
                    $donsData['cause'],
                    $donsData['date_debut'],
                    $donsData['date_fin'],
                    $donsData['img'],
                    $donsData['etat'],
                    $donsData['amount'],
                    $donsData['descr']
                );
            } else {
                // Aucun don trouvée avec cet ID
                return null;
            }
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    public function updateAmount($id_donation, $nouveauAmount)
    {
        $db = config::getConnexion();

        $query = $db->prepare('UPDATE dons SET amount = :amount WHERE id_donation = :id_donation');
        $query->bindValue(':id_donation', $id_donation, PDO::PARAM_INT);
        $query->bindValue(':amount', $nouveauAmount, PDO::PARAM_INT);

        try {
            $query->execute();
            // Vous pouvez ajouter des vérifications supplémentaires ici si nécessaire
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Error: " . $e->getMessage();
        }
    }

    public function listDons($searchTerm = null)
    {
        $sql = "SELECT * FROM dons";

        // If a search term is provided, add a WHERE clause to filter by 'cause'
        if ($searchTerm !== null) {
            $sql .= " WHERE cause LIKE :searchTerm";
        }

        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);

            // If a search term is provided, bind the parameter to the query
            if ($searchTerm !== null) {
                $searchTerm = "%$searchTerm%";
                $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
            }

            $stmt->execute();
            $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }



    public function trierDonsParPrixDecroissant()
    {
        $sql = "SELECT * FROM dons ORDER BY amount DESC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function trierDonsParDateFinProche()
    {
        $sql = "SELECT * FROM dons ORDER BY date_fin ASC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteDon($id_donation)
    {
        $sql = "DELETE FROM dons WHERE id_donation = :id_donation";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_donation', $id_donation);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addDons($dons)
    {
        $sql = "INSERT INTO dons  
        VALUES (NULL, :cause,:date_debut,:date_fin,:img,:etat,:amount,:descr)";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'cause' => $dons->getCause(),
                'date_debut' => $dons->getDate(),
                'date_fin' => $dons->getDateFin(),
                'img' => $dons->getImg(),
                'etat' => $dons->getetat(),
                'amount' => $dons->getAmount(),
                'descr' => $dons->getdescr()
            ]);

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function show_Dons($id_donation)
    {
        $sql = "SELECT * from dons where id_donation = $id_donation";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $dons = $query->fetch();
            return $dons;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateDonation(dons $dons, $id_donation)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE dons SET 
                    cause = :cause,
                    date_debut = :date_debut, 
                    date_fin = :date_fin, 
                    img = :img,
                    etat = :etat,
                    amount = :amount,
                    descr = :descr
                WHERE id_donation = :id_donation'
            );

            // Bind values
            $query->bindValue(':id_donation', $id_donation);
            $query->bindValue(':cause', $dons->getCause());
            $query->bindValue(':date_debut', $dons->getDate());
            $query->bindValue(':date_fin', $dons->getDateFin());
            $query->bindValue(':img', $dons->getImg());
            $query->bindValue(':etat', $dons->getetat());
            $query->bindValue(':amount', $dons->getAmount());
            $query->bindValue(':descr', $dons->getDescr());

            // Execute the query
            $query->execute();

            // Check if any records were updated
            if ($query->rowCount() > 0) {
                return $query->rowCount() . " records UPDATED successfully";
            } else {
                return "No records were updated";
            }
        } catch (PDOException $e) {
            // Handle errors
            return 'Error: ' . $e->getMessage();
        }
    }

    public function tri($triAttribut = 'id_donation', $triOrdre = 'ASC')
    {
        $sql = "SELECT * FROM dons ORDER BY $triAttribut $triOrdre";
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