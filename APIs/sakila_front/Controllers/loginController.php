<?php

if (isset($_POST["mail"]) && isset($_POST["password"])) {
    $file = file_get_contents("http://localhost/DWS/APIs/sakila_back/Controllers/loginController.php?mail=".$_POST["mail"]."&password=".$_POST["password"]);
    $obj_user = json_decode($file);

    if($obj_user->id > 0){
        session_start();
        $_SESSION["userId"] = $obj_user->id;
        $_SESSION["userMail"] = $obj_user->mail;
        $_SESSION["userPlainPassword"] = $_POST["password"];
        header("Location: filmsController.php");
    } else {
        die("Login gone wrong");
    }
} else {
    include_once "../Views/loginView.phtml";
}

