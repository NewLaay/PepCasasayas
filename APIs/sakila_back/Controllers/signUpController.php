<?php

include_once "../Models/signupModel.php";

$return = array();
$result = false;
$error = "";

if (isset($_GET["mail"]) && isset($_GET["password"])) {
    $signupModel = new signupModel();
    if ($signupModel->checkUserExists($_GET["mail"])) {
        $error = "User already exists";
    } else {
        try {
            $password = crypt($_GET["password"], bin2hex(random_bytes(10)));
        } catch (Exception $e) {
            $password = crypt($_GET["password"], "salt");
        }
        if ($signupModel->saveUser($_GET["mail"], $password)) {
            $result = true;
        } else {
            $error = "Sign up gone wrong";
        }
    }
} else {
    $error = "Sign up gone wrong";
}

$return["result"] = $result;
$return["error"] = $error;

echo json_encode($return);