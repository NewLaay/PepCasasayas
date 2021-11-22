<?php

class Actores
{

    private $id;
    private $nombre;
    private $apellidos;
    private $fechaNacimiento;
    private $imagen;
    private $oscars;

    /**
     * @param $id
     * @param $nombre
     * @param $apellidos
     * @param $fechaNacimiento
     * @param $imagen
     * @param $oscars
     */
    public function __construct($id, $nombre, $apellidos, $fechaNacimiento, $imagen, $oscars)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->imagen = $imagen;
        $this->oscars = $oscars;
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen): void
    {
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getOscars()
    {
        return $this->oscars;
    }

    /**
     * @param mixed $oscars
     */
    public function setOscars($oscars): void
    {
        $this->oscars = $oscars;
    }



}