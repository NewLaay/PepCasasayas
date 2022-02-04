<?php

include_once "../models/listSingleModel.php";

session_start();

if(isset($_SESSION["userId"])){
    $userId = $_SESSION["userId"];
}

$model = new listSingleModel();

if (isset($_GET["id"])){
    $hotel = $model->getHotel($_GET["id"]);
} else{
    die("NO ID SELECTED");
}


require_once "../views/singleView.phtml";

?>
