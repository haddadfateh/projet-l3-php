<?php
require_once("Type.php");

class Pokemon{
    private $id;
    private $nom;
    private $taille;
    private $poids;

    private $types;

    public function __construct(int $id, string $nom, int $taille, int $poids)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->taille = $taille;
        $this->poids = $poids;
        $this->types = Array();
    }

    public function addType(Type $t){
        $this->types[] = $t;
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

    /**
     * Get the value of taille
     */ 
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Get the value of poids
     */ 
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Get the value of types
     */ 
    public function getTypes()
    {
        return $this->types;
    }
}
?>