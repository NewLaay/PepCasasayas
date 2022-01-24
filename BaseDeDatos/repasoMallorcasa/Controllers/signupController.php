<?php

include_once "../Models/signUpModel.php";

if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["password2"])){
    if($_POST["password"] == $_POST["password2"]){
        $signupModel = new signUpModel();
        if($signupModel->checkUserExists($_POST["mail"])){
            die("User already exists.");
        }else{
            $password = crypt($_POST["password"],"salt");
        }
        if($signupModel->saveUser($_POST["mail"],$password)){
            header("Location: loginController.php");
        } else{
            die("sign up gone wrong");
        }
    }
} else{
    include_once "../Views/signUp.phtml";
}