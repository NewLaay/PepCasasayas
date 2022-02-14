<?php

include_once "../DBO/dbo.php";
include_once "../Entities/user.php";

class loginModel
{
    protected dbo $db;

    public function __construct()
    {
        $this->db = new dbo();
    }

    public function getUser($mail, $password): user
    {
        $this->db->default();
        $sql = "SELECT * FROM user WHERE mail = '" . $mail . "'";
        $query = $this->db->query($sql);
        if ($result = $query->fetch_assoc()) {
            if (crypt($password, $result["password"]) == $result["password"]) {
                return new user($result["user_id"], $result["mail"], $result["password"]);
            }
        }
        return new user(0, "-", "-");
    }
}