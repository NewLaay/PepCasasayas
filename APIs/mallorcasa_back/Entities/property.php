<?php

include_once "country.php";
include_once "state.php";
include_once "city.php";
include_once "neighborhood.php";
include_once "user.php";
include_once "image.php";

class property
{
    public int $id;
    public country $country;
    public state $state;
    public city $city;
    public neighborhood $neighborhood;
    public int $zipcode;
    public float $latitude;
    public float $longitude;
    public DateTime $date;
    public string $description;
    public int $bathrooms;
    public int $floor;
    public int $rooms;
    public  int $surface;
    public int $price;
    public user $user;
    public array $images;

    /**
     * @param int $id
     * @param country $country
     * @param state $state
     * @param city $city
     * @param neighborhood $neighborhood
     * @param int $zipcode
     * @param float $latitude
     * @param float $longitude
     * @param DateTime $date
     * @param string $description
     * @param int $bathrooms
     * @param int $floor
     * @param int $rooms
     * @param int $surface
     * @param int $price
     * @param user $user
     * @param array $images
     */
    public function __construct(int $id, country $country, state $state, city $city, neighborhood $neighborhood, int $zipcode, float $latitude, float $longitude, DateTime $date, string $description, int $bathrooms, int $floor, int $rooms, int $surface, int $price, user $user, array $images)
    {
        $this->id = $id;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->neighborhood = $neighborhood;
        $this->zipcode = $zipcode;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->date = $date;
        $this->description = $description;
        $this->bathrooms = $bathrooms;
        $this->floor = $floor;
        $this->rooms = $rooms;
        $this->surface = $surface;
        $this->price = $price;
        $this->user = $user;
        $this->images = $images;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return country
     */
    public function getCountry(): country
    {
        return $this->country;
    }

    /**
     * @return state
     */
    public function getState(): state
    {
        return $this->state;
    }

    /**
     * @return city
     */
    public function getCity(): city
    {
        return $this->city;
    }

    /**
     * @return neighborhood
     */
    public function getNeighborhood(): neighborhood
    {
        return $this->neighborhood;
    }

    /**
     * @return int
     */
    public function getZipcode(): int
    {
        return $this->zipcode;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getBathrooms(): int
    {
        return $this->bathrooms;
    }

    /**
     * @return int
     */
    public function getFloor(): int
    {
        return $this->floor;
    }

    /**
     * @return int
     */
    public function getRooms(): int
    {
        return $this->rooms;
    }

    /**
     * @return int
     */
    public function getSurface(): int
    {
        return $this->surface;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return user
     */
    public function getUser(): user
    {
        return $this->user;
    }

    /**
     * @param user $user
     */
    public function setUser(user $user): void
    {
        $this->user = $user;
    }
}