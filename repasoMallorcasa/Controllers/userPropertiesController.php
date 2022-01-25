<?php

include_once "../Models/userPropertiesModel.php";

session_start();

if(isset($_SESSION["userId"])){
    $userId = $_SESSION["userId"];
}else{
    header("Location: loginController.php");
}

$model = new userPropertiesModel();

if(isset($_GET["propertyId"]) && isset($_GET["action"])) {
    $selectedPropertyId = $_GET["propertyId"];
    $selectedProperty = $model->getProperty($selectedPropertyId);
    if ($selectedProperty->getUser()->getId() == $userId && $_GET["action"] == "sell") {
        $model->sellProperty($selectedPropertyId);
    } elseif ($selectedProperty->getUser()->getId() == 0 && $_GET["action"] == "buy") {
        $model->buyProperty($selectedPropertyId, $userId);
    }
}

$properties = $model->getProperties($userId);

require_once "../Views/userPropertiesView.phtml";