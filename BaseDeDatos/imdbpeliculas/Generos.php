<?php

class Generos
{

    private $id;
    private $tipoGenero;

    /**
     * @param $id
     * @param $tipoGenero
     */
    public function __construct($id, $tipoGenero)
    {
        $this->id = $id;
        $this->tipoGenero = $tipoGenero;
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
    public function getTipoGenero()
    {
        return $this->tipoGenero;
    }

    /**
     * @param mixed $tipoGenero
     */
    public function setTipoGenero($tipoGenero): void
    {
        $this->tipoGenero = $tipoGenero;
    }



}