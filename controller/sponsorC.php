<?php

include_once '../config.php';

class sponsorC
{

    public function listsponsor()
    {
        $sql = "SELECT * FROM sponsor ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    


    function addsponsor($sponsor)
    {
        $sql = "INSERT INTO sponsor
        VALUES (NULL , :noms, :typs ,:ide)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'noms' => $sponsor->getnoms(),
                'typs' => $sponsor->gettyps(),
                'ide' => $sponsor->getide()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deletesponsor($ids)
    {
        $sql = "DELETE FROM sponsor WHERE ids= :ids";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ids', $ids);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }



   

    function showsponsor($ids)
    {
        $sql = "SELECT * from sponsor where ids = $ids";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $event = $query->fetch();
            return $sponsor;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

   
}