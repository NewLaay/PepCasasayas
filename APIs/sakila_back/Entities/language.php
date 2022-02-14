<?php

class language
{
    public int $id;
    public string $name;
    public datetime $lastUpdate;

    /**
     * @param int $id
     * @param string $name
     * @param datetime $lastUpdate
     */
    public function __construct(int $id, string $name, datetime $lastUpdate)
    {
        $this->id = $id;
        $this->name = $name;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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