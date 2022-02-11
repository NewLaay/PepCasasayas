<?php

include_once "../models/signup.php";

$return = array();
$result = false;
$error = "";

if (isset($_GET["user"]) && isset($_GET["password"])){
        $signupModel = new signup();
        if($signupModel->checkUserExists($_GET["user"])){
            $error = "User already exists";
        }else{
            try{
                $password = crypt($_GET["password"], bin2hex(random_bytes(10)));
            }catch (Exception $e){
                $password = crypt($_GET["password"], "salt");
            }
            if ($signupModel->saveUser($_GET["user"], $password)){
                $result = true;
            } else{
                $error = "Sign up gone wrong";
            }
        }

}

$return["result"] = $result;
$return["error"] = $error;

echo json_encode($return);

