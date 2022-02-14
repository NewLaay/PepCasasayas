<?php
session_start();
if (!isset($_SESSION["userId"])) {
    header("Location: loginController.php");
}

$userMail = $_SESSION["userMail"] ?? "";
$userPlainPassword = $_SESSION["userPlainPassword"] ?? "";
$filmId = $_GET["filmId"] ?? "";
$action = $_GET["action"] ?? "";

$file = file_get_contents("http://localhost/DWS/APIs/sakila_back/Controllers/filmsController.php?mail=" . $userMail . "&password=" . $userPlainPassword . "&filmId=" . $filmId . "&action=" . $action);
$obj_films = json_decode($file);

$availableFilms = $obj_films->availableFilms;
$userFilms = $obj_films->userFilms;

include_once "../Views/filmsView.phtml";