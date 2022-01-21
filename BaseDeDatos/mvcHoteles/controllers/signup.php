<?php

include_once "../models/signup.php";

if(isset($_POST["user"]) && isset($_POST["password"]) && isset($_POST["password2"])){
    if($_POST["password"] == $_POST["password2"]){
        $signup = new signup();
        if($signup->checkUserExists($_POST["user"])){
            die("User already exists");
        } else{
            try{
                $password = crypt($_POST["password"],bin2hex(random_bytes(10)));
            }catch (Exception $e){
                $password = crypt($_POST["password"],"salt");
            }
            if($signup->saveUser($_POST["user"],$password)){
                header("Location: login.php");
            }else{
                die("sign up gone wrong");
            }
        }
    }
}else{
    include_once "../views/signup.phtml";
}