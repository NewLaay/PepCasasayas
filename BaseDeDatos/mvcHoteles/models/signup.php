<?php

include_once "../entities/usuario.php";
include_once "../db/dbo.php";

class signup
{

    private dbo $db;

    public function __construct(){
        $this->db = new dbo();
    }

    public function checkUserExists($user){
        $sql = "SELECT * FROM mvcUsuarios where user = '" . $user . "';";
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        if($query->num_rows == 0){
            return false; //no existe el usuario
        }return true;
    }

    public function saveUser($user, $password){
        $sql = "INSERT INTO mvcUsuarios (user, password) VALUES ('".$user."', '".$password."');";
        $this->db->default();
        $this->db->query($sql);
        if($this->db->insert_id > 0){
            $this->db->close();
            return true;
        }
        $this->db->close();
        return false;
    }

}