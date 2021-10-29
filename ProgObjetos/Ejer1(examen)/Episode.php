<?php

class Episode
{

public $id;
public $name;
public $air_date;
public $episode;
public $created;
public $characters;

    /**
     * @param $id
     * @param $name
     * @param $air_date
     * @param $episode
     * @param $created
     * @param $characters
     */

    public function __construct($id, $name, $air_date, $episode, $created, $characters)
    {
        $this->id = $id;
        $this->name = $name;
        $this->air_date = $air_date;
        $this->episode = $episode;
        $this->created = $created;
        $this->characters = $characters;
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAirDate()
    {
        return $this->air_date;
    }

    /**
     * @param mixed $air_date
     */
    public function setAirDate($air_date)
    {
        $this->air_date = $air_date;
    }

    /**
     * @return mixed
     */
    public function getEpisode()
    {
        return $this->episode;
    }

    /**
     * @param mixed $episode
     */
    public function setEpisode($episode)
    {
        $this->episode = $episode;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getCharacters()
    {
        return $this->characters;
    }

    /**
     * @param mixed $characters
     */
    public function setCharacters($characters)
    {
        $this->characters = $characters;
    }



}


