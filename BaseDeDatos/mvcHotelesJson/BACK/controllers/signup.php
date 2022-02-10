<?php

include_once "../models/signup.php";

$return = array();
$result = false;
$error = "";

if (isset($_GET["user"]) && isset($_GET["password"]) && isset($_GET["password2"])){
    if($_GET["password"] == $_GET["password2"]){
        $signupModel = new signup();
        if($signupModel->checkUserExists($_GET["user"])){
            $error = "User already exists";
        }else{
            try{
                $password = crypt($_POST["password"], bin2hex(random_bytes(10)));
            }catch (Exception $e){
                $password = crypt($_POST["password"], "salt");
            }
            if ($signupModel->saveUser($_POST["user"], $password)){
                $result = true;
            } else{
                $error = "Sign up gone wrong";
            }
        }
    }
}

$return["result"] = $result;
$return["error"] = $error;

echo json_encode($return);

