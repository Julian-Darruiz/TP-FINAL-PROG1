<?php
require_once 'clases/Usuario.php';

class PeliculaFavorita
{
    public $id;
    public $userID;
    public $nombrePelicula;
    public $genero;

    public function __construct($userID, $nombrePelicula, $genero, $id = null)
    {
        $this->id = $id;
        $this->nombrePelicula = $nombrePelicula;
        $this->genero = $genero;
        $this->userID = $userID;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function getUser() {return $this->userID;}
    public function getNombrePelicula() {return $this->nombrePelicula;}
    public function getGenero() {return $this->genero;}
}