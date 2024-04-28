<?php

class reponse
{
    private ?int $id = null;
    private ?string $date = null;
    private ?string $description = null;
    private ?int $id_rec = null;


    public function __construct($date, $description, $id_rec)
    {
        $this->date = $date;
        $this->description = $description;
        $this->id_rec = $id_rec;
    }

    
    public function getId()
    {
        return $this->id;
    }

    
    public function getDate()
    {
        return $this->date;
    }

    
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }


    public function getIDRec()
    {
        return $this->id_rec;
    }

    
    public function setIDRec($id_rec)
    {
        $this->id_rec = $id_rec;

        return $this;
    }
    

    public function getDescription()
    {
        return $this->description;
    }

    
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
