<?php

include_once "../models/login.php";

if (isset($_GET["user"]) && isset($_GET["password"])){
    $login = new login();
    $user = $login->getUser($_GET["user"],$_GET["password"]);
    echo json_encode($user);
} else{
    echo json_encode(new usuario(0, "-", "-"));
}

