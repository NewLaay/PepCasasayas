<?php

include_once "../entities/usuario.php";
include_once "../db/dbo.php";

class logout
{

    private dbo $db;

    public function __construct(){
        $this->db = new dbo();
    }


}