<?php

class Generos
{

    private $id;
    private $genero;

    /**
     * @param $id
     * @param $genero
     */
    public function __construct($id, $genero)
    {
        $this->id = $id;
        $this->genero = $genero;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero): void
    {
        $this->genero = $genero;
    }



}