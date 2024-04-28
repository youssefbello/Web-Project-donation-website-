<?php

include_once '../config.php';
include '../model/reclamation.php';
require '../vendor/autoload.php';

class reclamationC
{

    public function afficher()
    {
        $sql = "SELECT * FROM reclamation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function supprimer($id)
    {
        $sql = "DELETE FROM reclamation WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function ajouter($reclamation)
    {
        $sql = "INSERT INTO reclamation (nom, email, phone, etat, sujet, date, description)
        VALUES (:nom,:email, :phone, :etat, :sujet, :date, :description)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $reclamation->getNom(),
                'email' => $reclamation->getEmail(),
                'phone' => $reclamation->getPhone(),
                'etat' => $reclamation->getEtat(),
                'sujet' => $reclamation->getSujet(),
                'date' => $reclamation->getDate(),
                'description' => $reclamation->getDescription()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function modifier($reclamation, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE reclamation SET 
                    nom = :nom, 
                    email = :email,
                    phone = :phone,
                    etat = :etat,
                    sujet = :sujet,
                    date = :date,
                    description = :description
                WHERE id= :id'
            );
            $query->execute([
                'id' => $id,
                'nom' => $reclamation->getNom(),
                'email' => $reclamation->getEmail(),
                'phone' => $reclamation->getPhone(),
                'etat' => $reclamation->getEtat(),
                'sujet' => $reclamation->getSujet(),
                'date' => $reclamation->getDate(),
                'description' => $reclamation->getDescription()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function recupererReclamation($id){
        $sql="SELECT * from reclamation where id=$id";
        $conn = new config();
        $db=$conn->getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $reclamation=$query->fetch();
            return $reclamation;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }


    function triReclamation()
    {
        $sql = "SELECT * FROM reclamation order by nom";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function rechercheReclamation($rech)
    {
        $sql = "SELECT * FROM reclamation where reclamation.nom like '%$rech%' or reclamation.email like '%$rech%' or reclamation.sujet like '%$rech%' or reclamation.etat like '%$rech%' or reclamation.description like '%$rech%'";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function sendSMS(){
        $accountSid = 'AC25769a58bb69c3f1bc0ba8a3dca75546';
        $authToken = '55cd8ffa7147866922f68b11df223b4a';
        $twilioClient = new Twilio\Rest\Client($accountSid, $authToken);

        // Send an SMS
        $twilioClient->messages->create(
            '+21622030195',
            array(
                'from' => '+12407125144',
                'body' => 'Une nouvelle reclamation a été ajoutée avec succées.'
            )
        );
    }
}
