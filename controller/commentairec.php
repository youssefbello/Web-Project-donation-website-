<?php
require_once "../model/publication.php";
class CommentaireC
{
    public function affichecom($id){
        try{
            $pdo=config::getConnexion();
            $query=$pdo->prepare("SELECT * FROM commentaire WHERE id=:id");
            $query->execute(['id'=>$id]);
            return $query->fetchAll();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    } 
    public function affichepublication()
    {
        try {
            $pdo=config::getConnexion();
            $query=$pdo->prepare("SELECT * FROM publication");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function addCommentaire($id,$nom_auteur,$contenu_com)
{
    $sql = "INSERT INTO commentaire ( id, nom_auteur, contenu_com, date_creation) VALUES (:id, :nom_auteur, :contenu_com,NOW() )";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'id' => $id,
            'nom_auteur' =>$nom_auteur ,
            'contenu_com' => $contenu_com
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


    function recupererCommentaires($id)
    {
        $sql = "SELECT * FROM commentaire WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $commentaire = $query->fetchAll(PDO::FETCH_ASSOC);
            return $commentaire;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function supprimerCommentaire($id_com) {
        $sql = "DELETE FROM commentaire WHERE id_com = :id_com";
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id_com', $id_com); // Correction ici
            $query->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // You can add more functions as needed, such as updateCommentaire, deleteCommentaire, etc.
}
?>