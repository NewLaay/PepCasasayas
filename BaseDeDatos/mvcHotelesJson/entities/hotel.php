<?php

/* La entidad es la clase con sus atributos, su constructor y sus getters y setters.
Mas adelante, la utilizaremos en el modelo para tratar sus datos.*/

class hotel
{

    protected int $id;
    protected string $nombre;
    protected string $imagen;
    protected string $descripcion;
    protected string $cadena;
    protected int $habitaciones;
    protected int $estrellas;
    protected string $localidad;

    /**
     * @param int $id
     * @param string $nombre
     * @param string $imagen
     * @param string $descripcion
     * @param string $cadena
     * @param int $habitaciones
     * @param int $estrellas
     * @param string $localidad
     */
    public function __construct(int $id, string $nombre, string $imagen, string $descripcion, string $cadena, int $habitaciones, int $estrellas, string $localidad)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->descripcion = $descripcion;
        $this->cadena = $cadena;
        $this->habitaciones = $habitaciones;
        $this->estrellas = $estrellas;
        $this->localidad = $localidad;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getImagen(): string
    {
        return $this->imagen;
    }

    /**
     * @param string $imagen
     */
    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return string
     */
    public function getCadena(): string
    {
        return $this->cadena;
    }

    /**
     * @param string $cadena
     */
    public function setCadena(string $cadena): void
    {
        $this->cadena = $cadena;
    }

    /**
     * @return int
     */
    public function getHabitaciones(): int
    {
        return $this->habitaciones;
    }

    /**
     * @param int $habitaciones
     */
    public function setHabitaciones(int $habitaciones): void
    {
        $this->habitaciones = $habitaciones;
    }

    /**
     * @return int
     */
    public function getEstrellas(): int
    {
        return $this->estrellas;
    }

    /**
     * @param int $estrellas
     */
    public function setEstrellas(int $estrellas): void
    {
        $this->estrellas = $estrellas;
    }

    /**
     * @return string
     */
    public function getLocalidad(): string
    {
        return $this->localidad;
    }

    /**
     * @param string $localidad
     */
    public function setLocalidad(string $localidad): void
    {
        $this->localidad = $localidad;
    }




}