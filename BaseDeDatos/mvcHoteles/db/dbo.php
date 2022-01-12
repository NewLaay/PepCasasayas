<?php

/* Aqui lo unico que creamos la clase dbo y definimos la tabla de base de datos.*/

class dbo extends mysqli{

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
            die("ERROR DATABASE: " . mysqli_connect_error());
        }
    }
}
?>