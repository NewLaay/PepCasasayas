<?php

class Peliculas
{
    private $id;
    private $nombre;
    private $calificacion;
    private $imagen;
    private $fechaEstreno;
    private $actores; //aray de Objetos
    private $directores; //array de Objetos
    private $genero; //array de Objetos
    private $trailer;

    /**
     * @param $id
     * @param $nombre
     * @param $calificacion
     * @param $imagen
     * @param $fechaEstreno
     * @param $actores
     * @param $directores
     * @param $genero
     */
    public function __construct($id, $nombre, $calificacion, $imagen, $fechaEstreno, $actores, $directores, $genero, $trailer)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->calificacion = $calificacion;
        $this->imagen = $imagen;
        $this->fechaEstreno = $fechaEstreno;
        $this->actores = $actores;
        $this->directores = $directores;
        $this->genero = $genero;
        $this->trailer = $trailer;
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
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * @param mixed $calificacion
     */
    public function setCalificacion($calificacion): void
    {
        $this->calificacion = $calificacion;
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
    public function getFechaEstreno()
    {
        return $this->fechaEstreno;
    }

    /**
     * @param mixed $fechaEstreno
     */
    public function setFechaEstreno($fechaEstreno): void
    {
        $this->fechaEstreno = $fechaEstreno;
    }

    /**
     * @return mixed
     */
    public function getActores()
    {
        return $this->actores;
    }

    /**
     * @param mixed $actores
     */
    public function setActores($actores): void
    {
        $this->actores = $actores;
    }

    /**
     * @return mixed
     */
    public function getDirectores()
    {
        return $this->directores;
    }

    /**
     * @param mixed $directores
     */
    public function setDirectores($directores): void
    {
        $this->directores = $directores;
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

    /**
     * @return mixed
     */
    public function getTrailer()
    {
        return $this->trailer;
    }

    /**
     * @param mixed $trailer
     */
    public function setTrailer($trailer): void
    {
        $this->trailer = $trailer;
    }




}