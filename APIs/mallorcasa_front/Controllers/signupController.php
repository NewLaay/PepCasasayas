<?php
if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["password2"])) {
    if ($_POST["password"] == $_POST["password2"]) {
        $file = file_get_contents("http://localhost/dawsonferrer/allabres/APIs/mallorcasa_back/Controllers/signupController.php?mail=" . $_POST["mail"] . "&password=" . $_POST["password"]);
        $signup_obj = json_decode($file);
        if ($signup_obj->result) {
            header("Location: loginController.php");
        } else {
            die($signup_obj->error);
        }
    }
} else {
    include_once "../Views/signUpView.phtml";
}