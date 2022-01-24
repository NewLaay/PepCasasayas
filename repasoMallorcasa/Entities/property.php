<?php

include_once "country.php";
include_once "city.php";
include_once "image.php";
include_once "neighborhood.php";
include_once "state.php";
include_once "user.php";

class property
{

    protected int $id;
    protected country $country;
    protected state $state;
    protected city $city;
    protected neighborhood $neighborhood;
    protected int $zipcode;
    protected float $latitude;
    protected float $longitude;
    protected DateTime $date;
    protected string $description;
    protected int $bathrooms;
    protected int $floor;
    protected int $rooms;
    protected int $surface;
    protected int $price;
    protected user $user;
    protected array $images;

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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return country
     */
    public function getCountry(): country
    {
        return $this->country;
    }

    /**
     * @param country $country
     */
    public function setCountry(country $country): void
    {
        $this->country = $country;
    }

    /**
     * @return state
     */
    public function getState(): state
    {
        return $this->state;
    }

    /**
     * @param state $state
     */
    public function setState(state $state): void
    {
        $this->state = $state;
    }

    /**
     * @return city
     */
    public function getCity(): city
    {
        return $this->city;
    }

    /**
     * @param city $city
     */
    public function setCity(city $city): void
    {
        $this->city = $city;
    }

    /**
     * @return neighborhood
     */
    public function getNeighborhood(): neighborhood
    {
        return $this->neighborhood;
    }

    /**
     * @param neighborhood $neighborhood
     */
    public function setNeighborhood(neighborhood $neighborhood): void
    {
        $this->neighborhood = $neighborhood;
    }

    /**
     * @return int
     */
    public function getZipcode(): int
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode(int $zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getBathrooms(): int
    {
        return $this->bathrooms;
    }

    /**
     * @param int $bathrooms
     */
    public function setBathrooms(int $bathrooms): void
    {
        $this->bathrooms = $bathrooms;
    }

    /**
     * @return int
     */
    public function getFloor(): int
    {
        return $this->floor;
    }

    /**
     * @param int $floor
     */
    public function setFloor(int $floor): void
    {
        $this->floor = $floor;
    }

    /**
     * @return int
     */
    public function getRooms(): int
    {
        return $this->rooms;
    }

    /**
     * @param int $rooms
     */
    public function setRooms(int $rooms): void
    {
        $this->rooms = $rooms;
    }

    /**
     * @return int
     */
    public function getSurface(): int
    {
        return $this->surface;
    }

    /**
     * @param int $surface
     */
    public function setSurface(int $surface): void
    {
        $this->surface = $surface;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
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

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }




}