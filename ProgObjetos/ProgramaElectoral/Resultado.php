<?php

class Resultado
{
    private $district;
    private $party;
    private $votes;
    private $escanos;
    private $votosEscanos;

    /**
     * @param $district
     * @param $party
     * @param $votes
     * @param $escanos
     * @param $votosEscanos
     */
    public function __construct($district, $party, $votes, $escanos, $votosEscanos)
    {
        $this->district = $district;
        $this->party = $party;
        $this->votes = $votes;
        $this->escanos = $escanos;
        $this->votosEscanos = $votosEscanos;
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

    /**
     * @return mixed
     */
    public function getEscanos()
    {
        return $this->escanos;
    }

    /**
     * @param mixed $escanos
     */
    public function setEscanos($escanos)
    {
        $this->escanos = $escanos;
    }

    /**
     * @return mixed
     */
    public function getVotosEscanos()
    {
        return $this->votosEscanos;
    }

    /**
     * @param mixed $votosEscanos
     */
    public function setVotosEscanos($votosEscanos)
    {
        $this->votosEscanos = $votosEscanos;
    }


}