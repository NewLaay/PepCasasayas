<?php

class dbo extends mysqli
{
    protected string $hostname_local = "localhost";
    protected string $username_local = "root";
    protected string $password_local = "";
    protected string $database_local = "examen3";

    public function default()
    {
        $this->local();
    }
    public function local()
    {
        parent::__construct($this->hostname_local, $this->username_local, $this->password_local, $this->database_local);

        if (mysqli_connect_error()) {
            die("ERROR DATABASE: " . mysqli_connect_error());
        }
    }
}