<?php

include_once  '../config.php';

class eventC
{

   
    public function listevent($searchTerm = null)
    {
        $sql = "SELECT * FROM event";

        // If a search term is provided, add a WHERE clause to filter by 'cause'
        if ($searchTerm !== null) {
            $sql .= " WHERE obj LIKE :searchTerm";
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

    function addevent($event)
    {
        $sql = "INSERT INTO event
        VALUES (NULL , :obj, :place ,:dh, :bud,:be ,:nbrp , :type)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'obj' => $event->getobj(),
                'place' => $event->getplace(),
                'dh' => $event->getdh()->format('Y/m/d'),
                'bud' => $event->getbud(),
                'be' => $event->getbe(),
                'nbrp' => $event->getnbrp(),
                'type' => $event->gettype(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteevent($ide)
    {
        $sql = "DELETE FROM event WHERE ide= :ide";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ide', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }



    public function update(event $event, $ide)
    {   
        try{
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE event SET 
                    obj = :obj, 
                    place = :place, 
                    dh = :dh, 
                    bud = :bud ,
                    be = :be ,
                    nbrp = :nbrp ,
                    type = :type 
                WHERE ide= :ide'
            );
            
            $query->bindValue(':ide',$ide);
            $query->bindValue(':obj',$event->getobj());
            $query->bindValue(':place',$event->getplace());
            $query->bindValue(':dh',$event->getdh()->format('Y/m/d'));
            $query->bindValue(':bud',$event->getbud());
            $query->bindValue(':be',$event->getbe());
            $query->bindValue(':nbrp',$event->getnbrp());
            $query->bindValue(':type',$event->gettype());
          
                $query->execute();
                echo $query->rowCount() . " records UPDATED successfully <br>";
            }
         catch (Exception $e) {
            die("error:". $e->getMessage());
            
        }
    }

    function showevent($ide)
    {
        $sql = "SELECT * from event where ide = $ide";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $event = $query->fetch();
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function tri($triAttribut = 'ide', $triOrdre = 'ASC') {
        $sql = "SELECT * FROM event ORDER BY $triAttribut $triOrdre";
        $db = config::getConnexion();
    
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
}