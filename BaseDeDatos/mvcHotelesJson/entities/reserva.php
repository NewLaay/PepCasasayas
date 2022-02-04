<?php

include_once "hotel.php";
include_once "usuario.php";

class reserva
{

    protected int $id;
    protected habitacion $habitacion;
    protected usuario $usuario;
    protected datetime $fechaEntrada;
    protected datetime $fechaSalida;

    /**
     * @param int $id
     * @param habitacion $habitacion
     * @param usuario $usuario
     * @param string $fechaEntrada
     * @param string $fechaSalida
     */
    public function __construct(int $id, habitacion $habitacion, usuario $usuario, string $fechaEntrada, string $fechaSalida)
    {
        $this->id = $id;
        $this->habitacion = $habitacion;
        $this->usuario = $usuario;
        $this->fechaEntrada = $fechaEntrada;
        $this->fechaSalida = $fechaSalida;
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
     * @return habitacion
     */
    public function getHabitacion(): habitacion
    {
        return $this->habitacion;
    }

    /**
     * @param habitacion $habitacion
     */
    public function setHabitacion(habitacion $habitacion): void
    {
        $this->habitacion = $habitacion;
    }

    /**
     * @return usuario
     */
    public function getUsuario(): usuario
    {
        return $this->usuario;
    }

    /**
     * @param usuario $usuario
     */
    public function setUsuario(usuario $usuario): void
    {
        $this->usuario = $usuario;
    }

    /**
     * @return string
     */
    public function getFechaEntrada(): string
    {
        return $this->fechaEntrada;
    }

    /**
     * @param string $fechaEntrada
     */
    public function setFechaEntrada(string $fechaEntrada): void
    {
        $this->fechaEntrada = $fechaEntrada;
    }

    /**
     * @return string
     */
    public function getFechaSalida(): string
    {
        return $this->fechaSalida;
    }

    /**
     * @param string $fechaSalida
     */
    public function setFechaSalida(string $fechaSalida): void
    {
        $this->fechaSalida = $fechaSalida;
    }




}