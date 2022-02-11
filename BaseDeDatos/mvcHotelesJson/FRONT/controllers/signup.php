<?php

if(isset($_POST["user"]) && isset($_POST["password"]) && isset($_POST["password2"])){
    if($_POST["password"] == $_POST["password2"]){
        $file = file_get_contents("http://localhost/PepCasasayas/BaseDeDatos/mvcHotelesJson/BACK/controllers/signup.php?user=".$_POST["user"]."&password=". $_POST["password"]);
        $signup_obj = json_decode($file);
        if ($signup_obj->result){
            header("Location: login.php");
        } else{
           die($signup_obj->error);
        }
    }
}else{
    include_once "../views/signup.phtml";
}