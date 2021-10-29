<?php

class District
{
    private $id;
    private $name;
    private $delegates;

    /**
     * @param $id
     * @param $name
     * @param $delegates
     */
    public function __construct($id, $name, $delegates)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delegates = $delegates;
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
    public function getDelegates()
    {
        return $this->delegates;
    }

    /**
     * @param mixed $delegates
     */
    public function setDelegates($delegates)
    {
        $this->delegates = $delegates;
    }




}

