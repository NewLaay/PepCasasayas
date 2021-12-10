<?php

class Peliculas
{

    private $id;
    private $nombre;
    private $calificacion;
    private $imagen;
    private $fechaEstreno;
    private $trailer;
    private Actores $actores;
    private Directores $directores;
    private Generos $generos;

    /**
     * @param $id
     * @param $nombre
     * @param $calificacion
     * @param $imagen
     * @param $fechaEstreno
     * @param $trailer
     * @param Actores $actores
     * @param Directores $directores
     * @param Generos $generos
     */
    public function __construct($id, $nombre, $calificacion, $imagen, $fechaEstreno, $trailer, Actores $actores, Directores $directores, Generos $generos)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->calificacion = $calificacion;
        $this->imagen = $imagen;
        $this->fechaEstreno = $fechaEstreno;
        $this->trailer = $trailer;
        $this->actores = $actores;
        $this->directores = $directores;
        $this->generos = $generos;
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

    /**
     * @return Actores
     */
    public function getActores(): Actores
    {
        return $this->actores;
    }

    /**
     * @param Actores $actores
     */
    public function setActores(Actores $actores): void
    {
        $this->actores = $actores;
    }

    /**
     * @return Directores
     */
    public function getDirectores(): Directores
    {
        return $this->directores;
    }

    /**
     * @param Directores $directores
     */
    public function setDirectores(Directores $directores): void
    {
        $this->directores = $directores;
    }

    /**
     * @return Generos
     */
    public function getGeneros(): Generos
    {
        return $this->generos;
    }

    /**
     * @param Generos $generos
     */
    public function setGeneros(Generos $generos): void
    {
        $this->generos = $generos;
    }




}