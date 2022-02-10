<?php

include_once "../entities/usuario.php";
include_once "../db/dbo.php";

class login
{

    private dbo $db;

    public function __construct(){
        $this->db = new dbo();
    }

    public function getUser($user, $password): usuario{
        $sql = "SELECT * FROM mvcUsuarios WHERE user = '" . $user . "';";
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        if($result = $query->fetch_assoc()){
            if (crypt($password, $result["password"]) == $result["password"]){
                return new usuario($result["id"],$result["user"],$result["password"]);
            }
        }
        return new usuario(0,"-","-");
    }

}



