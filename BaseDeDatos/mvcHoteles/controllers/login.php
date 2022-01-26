<?php

include_once "../models/login.php";

if (isset($_POST["user"]) && isset($_POST["password"])){
    $login = new login();
    $user = $login->getUser($_POST["user"],$_POST["password"]);
    if ($user->getId() > 0){
        session_start();
        $_SESSION["userId"] = $user->getId();
        $_SESSION["userName"] = $user->getUser();
        header("Location: list.php");
    }else{
        die("Login gone wrong");
    }
}else{
    include_once "../views/login.phtml";
}

