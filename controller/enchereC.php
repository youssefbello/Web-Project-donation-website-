<?php

include_once '../config.php';

class enchereC
{

    public function getEnchereById($idEnchere)
    {
        $db = config::getConnexion();

        $query = $db->prepare('SELECT * FROM enchere WHERE id_enchere = :id_enchere');
        $query->bindValue(':id_enchere', $idEnchere, PDO::PARAM_INT);

        try {
            $query->execute();
            $enchereData = $query->fetch(PDO::FETCH_ASSOC);

            if ($enchereData) {
                // Créez et retournez une instance de l'objet enchere
                return new enchere(
                    $enchereData['id_enchere'],
                    $enchereData['date_debut'],
                    $enchereData['date_fin'],
                    $enchereData['nom_objet'],
                    $enchereData['prix_min'],
                    $enchereData['etat'],
                    $enchereData['statut'],
                    $enchereData['descr'],
                    $enchereData['image_objet']
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
    public function updatePrix($idEnchere, $nouveauPrixMin)
    {
        $db = config::getConnexion();
    
        $query = $db->prepare('UPDATE enchere SET prix_min = :prix_min WHERE id_enchere = :id_enchere');
        $query->bindValue(':id_enchere', $idEnchere, PDO::PARAM_INT);
        $query->bindValue(':prix_min', $nouveauPrixMin, PDO::PARAM_INT);
    
        try {
            $query->execute();
            // Vous pouvez ajouter des vérifications supplémentaires ici si nécessaire
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function listenchere($searchTerm = null)
    {
        $sql = "SELECT * FROM enchere";

        // Si un terme de recherche est fourni, ajoutez une clause WHERE pour filtrer par nom
        if ($searchTerm !== null) {
            $sql .= " WHERE nom_objet LIKE :searchTerm";
        }

        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);

            // Si un terme de recherche est fourni, liez le paramètre à la requête
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

    public function trierEncheresParPrixDecroissant()
    {
        $sql = "SELECT * FROM enchere ORDER BY prix_min DESC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function trierEncheresParDateFinProche()
    {
        $sql = "SELECT * FROM enchere ORDER BY date_fin ASC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function delete_enchere($ide)
    {
        $sql = "DELETE FROM enchere WHERE id_enchere = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function add_enchere($enchere)
    {
        $sql = "INSERT INTO enchere  
        VALUES (NULL, :descr,:date_debut,:date_fin,:prix_min,:etat,:statut,:nom_objet, :image_objet)";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'descr' => $enchere->getdesc(),
                'date_debut' => $enchere->getdate_debut(),
                'date_fin' => $enchere->getdate_fin(),
                'prix_min' => $enchere->getprix_min(),
                'etat' => $enchere->getetat(),
                'statut' => $enchere->getstatut(),
                'nom_objet' => $enchere->getnom(),
                'image_objet' => $enchere->getimage()

            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function show_enchere($id)
    {
        $sql = "SELECT * from enchere where id_enchere = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $enchere = $query->fetch();
            return $enchere;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateEnchere(enchere $enchere, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE enchere SET 
                    descr = :descr_objet,
                    date_debut = :date_debut, 
                    date_fin = :date_fin, 
                    prix_min = :prix_min,
                    etat = :etat, 
                    statut = :statut,
                    nom_objet = :nom_objet,
                    image_objet = :image_objet
                WHERE id_enchere = :id_enchere'
            );

            $query->bindValue(':id_enchere', $id);
            $query->bindValue(':descr_objet', $enchere->getdesc());
            $query->bindValue(':date_debut', $enchere->getdate_debut());
            $query->bindValue(':date_fin', $enchere->getdate_fin());
            $query->bindValue(':prix_min', $enchere->getprix_min());
            $query->bindValue(':etat', $enchere->getetat());
            $query->bindValue(':statut', $enchere->getstatut());
            $query->bindValue(':nom_objet', $enchere->getnom());
            $query->bindValue(':image_objet', $enchere->getimage());

            $query->execute();

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
?>


<?php
