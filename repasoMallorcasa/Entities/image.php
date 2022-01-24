<?php

class image
{

    protected int $id;
    protected int $propertyId;
    protected string $url;

    /**
     * @param int $id
     * @param int $propertyId
     * @param string $url
     */
    public function __construct(int $id, int $propertyId, string $url)
    {
        $this->id = $id;
        $this->propertyId = $propertyId;
        $this->url = $url;
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
     * @return int
     */
    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    /**
     * @param int $propertyId
     */
    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }




}