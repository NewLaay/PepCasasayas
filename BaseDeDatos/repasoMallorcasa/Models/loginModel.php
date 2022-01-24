<?php

include_once "../Entities/user.php";
include_once "../DB/dbo.php";

class loginModel
{

    private dbo $db;

    public function __construct(){
        $this->db = new dbo();
    }

    public function getUser($mail,$password) : user{
        $sql = "SELECT * FROM users where mail = '" .$mail ."';";
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        if($result = $query->fetch_assoc()){
            if(crypt($password,$result["password"]) == $result["password"]){
                return new user($result["id"],$result["mail"],$result["password"]);
            }
        }
        return new user(0,"-","-");
    }

}