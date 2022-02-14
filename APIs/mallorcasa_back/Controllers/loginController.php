<?php

include_once "../Models/loginModel.php";

if (isset($_GET["mail"]) && isset($_GET["password"])) {
    $loginModel = new loginModel();
    $user = $loginModel->getUser($_GET["mail"], $_GET["password"]);
    echo json_encode($user);
} else {
    echo json_encode(new user(0, "-", "-"));
}