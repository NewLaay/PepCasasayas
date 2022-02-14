<?php

include_once "../DBO/dbo.php";
include_once "../Entities/user.php";

class signUpModel
{
    private dbo $db;

    public function __construct()
    {
        $this->db = new dbo();
    }

    public function checkUserExists($mail): bool
    {
        $this->db->default();
        $sql = "SELECT * FROM user WHERE mail = '" . $mail . "';";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0) {
            $this->db->close();
            return true;
        }
        $this->db->close();
        return false;
    }

    public function saveUser($mail, $password): int
    {
        $this->db->default();
        $sql = "INSERT INTO user (mail, password) VALUES ('" . $mail . "','" . $password . "');";
        $this->db->query($sql);
        $insertId = $this->db->insert_id;
        $this->db->close();
        return $insertId > 0;
    }
}