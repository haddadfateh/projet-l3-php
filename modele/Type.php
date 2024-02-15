<?php

class Type{
    private $id;
    private $nom;

    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }
}

?>