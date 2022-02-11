<?php

if(isset($_POST["user"]) && isset($_POST["password"])){
    $file = file_get_contents("http://localhost/PepCasasayas/BaseDeDatos/mvcHotelesJson/BACK/controllers/login.php?user=".$_POST["user"]."&password=".$_POST["password"]);
    $obj_user = json_decode($file);

    if($obj_user->id > 0){
        session_start();
        $_SESSION["userId"] = $obj_user->id;
        $_SESSION["userName"] = $obj_user->user;
        $_SESSION["userPlainPassword"] = $_POST["password"];
        header("Location:list.php");
    } else{
        die("Login gone wrong");
    }
}else{
    include_once "../views/login.phtml";
}