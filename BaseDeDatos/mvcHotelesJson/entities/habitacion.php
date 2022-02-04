<?php

include_once "hotel.php";

class habitacion
{

    protected int $id;
    protected hotel $hotel;

    /**
     * @param int $id
     * @param hotel $hotel
     */
    public function __construct(int $id, hotel $hotel)
    {
        $this->id = $id;
        $this->hotel = $hotel;
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
     * @return hotel
     */
    public function getHotel(): hotel
    {
        return $this->hotel;
    }

    /**
     * @param hotel $hotel
     */
    public function setHotel(hotel $hotel): void
    {
        $this->hotel = $hotel;
    }




}