<?php

class Resultados
{
    private $district;
    private $party;
    private $votes;

    /**
     * @param $district
     * @param $party
     * @param $votes
     */
    public function __construct($district, $party, $votes)
    {
        $this->district = $district;
        $this->party = $party;
        $this->votes = $votes;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    }

    /**
     * @return mixed
     */
    public function getParty()
    {
        return $this->party;
    }

    /**
     * @param mixed $party
     */
    public function setParty($party)
    {
        $this->party = $party;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    }



}