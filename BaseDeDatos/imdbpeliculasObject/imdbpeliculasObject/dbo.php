<?php

include_once("Peliculas.php");
include_once("Directores.php");
include_once("Generos.php");
include_once("Actores.php");

class dbo extends mysqli
{

    protected string $hostname = "sql480.main-hosting.eu";
    protected string $username = "u850300514_jcasasayas";
    protected string $password = "x43196836F";
    protected string $database = "u850300514_jcasasayas";

    public function default(){
        $this->local();
    }

    public function local(){
        parent::__construct($this->hostname, $this->username, $this->password, $this->database);

        if (mysqli_connect_error()){
            die("EROR DATABASE: ".mysqli_connect_error());
        }
    }

    public function getDirector($id): Directores {
        $sql = "SELECT * FROM imbdDirectores where id = " .$id;
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $result = $query->fetch_assoc();
        $return = new Directores($result["id"],$result["nombre"],$result["apellidos"],$result["fechaNacimiento"],$result["imagen"],$result["peliculasRealizadas"]);
        return $return;
    }

    public function getActor($id) : Actores{
        $sql = "SELECT * FROM imdbActores where id = " .$id;
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $result = $query->fetch_assoc();
        $return = new Actores($result["id"],$result["nombre"],$result["apellidos"],$result["fechaNacimiento"],$result["imagen"],$result["numOscars"]);
        return $return;
    }

    public function getGenero($id) : Generos{
        $sql = "SELECT * FROM imdbGeneros where id = " .$id;
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $result = $query->fetch_assoc();
        $return = new Generos($result["id"],$result["genero"]);
        return $return;
    }

    public function getPeliculas() : array{
        $sql = "SELECT * FROM imdbPeliculas;";
        $this->default();
        $query = this->query($sql);
        $this->close();
        $return = array();
        while ($result = $query->fetch_assoc()){
            $return[] = new Peliculas($result["id"],$result["nombre"],$result["calificacion"],$result["imagen"],$result["fechaEstreno"],$result["trailer"],$this->getActor($result))
        }
    }



}