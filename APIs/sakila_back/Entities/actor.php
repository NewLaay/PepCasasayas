<?php

class actor
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public datetime $lastUpdate;

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param datetime $lastUpdate
     */
    public function __construct(int $id, string $firstName, string $lastName, datetime $lastUpdate)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->lastUpdate = $lastUpdate;
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return datetime
     */
    public function getLastUpdate(): datetime
    {
        return $this->lastUpdate;
    }

    /**
     * @param datetime $lastUpdate
     */
    public function setLastUpdate(datetime $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }


}