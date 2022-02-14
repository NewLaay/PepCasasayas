<?php

include_once "language.php";
include_once "actor.php";
include_once "category.php";
include_once "user.php";

class film
{
    public int $id;
    public string $title;
    public string $description;
    public int $releaseYear;
    public language $language;
    public int $length;
    public string $rating;
    public datetime $lastUpdate;
    public array $actors;
    public array $categories;
    public user $user;

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param int $releaseYear
     * @param language $language
     * @param int $length
     * @param string $rating
     * @param datetime $lastUpdate
     * @param array $actors
     * @param array $categories
     * @param user $user
     */
    public function __construct(int $id, string $title, string $description, int $releaseYear, language $language, int $length, string $rating, datetime $lastUpdate, array $actors, array $categories, user $user)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->releaseYear = $releaseYear;
        $this->language = $language;
        $this->length = $length;
        $this->rating = $rating;
        $this->lastUpdate = $lastUpdate;
        $this->actors = $actors;
        $this->categories = $categories;
        $this->user = $user;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
    public function getReleaseYear(): int
    {
        return $this->releaseYear;
    }

    /**
     * @param int $releaseYear
     */
    public function setReleaseYear(int $releaseYear): void
    {
        $this->releaseYear = $releaseYear;
    }

    /**
     * @return language
     */
    public function getLanguage(): language
    {
        return $this->language;
    }

    /**
     * @param language $language
     */
    public function setLanguage(language $language): void
    {
        $this->language = $language;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return string
     */
    public function getRating(): string
    {
        return $this->rating;
    }

    /**
     * @param string $rating
     */
    public function setRating(string $rating): void
    {
        $this->rating = $rating;
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

    /**
     * @return array
     */
    public function getActors(): array
    {
        return $this->actors;
    }

    /**
     * @param array $actors
     */
    public function setActors(array $actors): void
    {
        $this->actors = $actors;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
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