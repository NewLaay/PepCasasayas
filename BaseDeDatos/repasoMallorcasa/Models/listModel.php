<?php

include_once "../Entities/country.php";
include_once "../Entities/state.php";
include_once "../Entities/city.php";
include_once "../Entities/neighborhood.php";
include_once "../Entities/image.php";
include_once "../Entities/property.php";
include_once "../Entities/user.php";
include_once "../DB/dbo.php";


class listModel
{
    private dbo $db;

    public function __construct(){
        $this->db = new dbo();
    }

    public function getCountry($id) : country{
        $sql = "SELECT * FROM countries where id = " . $id ;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new country($result["id"],$result["name"]);
        return $return;
    }

    public function getState($id) : state{
        $sql = "SELECT * FROM states where id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new state($result["id"],$result["name"]);
        return $return;
}

    public function getCity($id) : city{
        $sql = "SELECT * FROM cities where id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new city($result["id"],$result["name"]);
        return $return;
    }

    public function getNeighborhood($id) : neighborhood{
        $sql = "SELECT * FROM neighborhoods where id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new neighborhood($result["id"],$result["name"]);
        return $return;
    }

    public function getUser($id) : user{
        if(!is_null($id)){
        $sql = "SELECT * FROM users where id = " .$id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new user($result["id"],$result["mail"],$result["password"]);
        return $return;
        }
        return new user(0, "-", "-");
    }

    public function getImages($propertyId) : array{
        $sql = "SELECT * FROM multimedias where propertyId = " .$propertyId;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $return = array();
        while ($result = $query->fetch_assoc()){
            $return [] = new image($result["id"],$result["propertyId"],$result["url"]);
        }
        return $return;
    }

    public function getProperties(): array{
        $sql = "SELECT * FROM properties where userId IS NULL";
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $return = array();
        while ($result = $query->fetch_assoc()) {
            $return[] = new property($result["id"], $this->getCountry($result["countryId"]), $this->getState($result["stateId"]),
                $this->getCity($result["cityId"]), $this->getNeighborhood($result["neighborhoodId"]), $result["zipcode"],
                $result["latitude"], $result["longitude"], DateTime::createFromFormat("Y-m-d", $result["date"]), $result["description"],
                $result["bathrooms"], $result["floor"], $result["rooms"], $result["surface"], $result["price"], $this->getUser($result["userId"]), $this->getImages($result["id"]));
        }
        return $return;
    }

    public function getProperty($id) : property{
        $sql = "SELECT * FROM properties where id = " .$id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new property($result["id"], $this->getCountry($result["countryId"]), $this->getState($result["stateId"]),
            $this->getCity($result["cityId"]), $this->getNeighborhood($result["neighborhoodId"]), $result["zipcode"],
            $result["latitude"], $result["longitude"], DateTime::createFromFormat("Y-m-d", $result["date"]), $result["description"],
            $result["bathrooms"], $result["floor"], $result["rooms"], $result["surface"], $result["price"], $this->getUser($result["userId"]), $this->getImages($result["id"]));

        return $return;
    }


}