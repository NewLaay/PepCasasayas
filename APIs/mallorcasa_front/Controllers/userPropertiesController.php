<?php
session_start();
if (isset($_SESSION["userId"])) {
    $url = "http://localhost/dawsonferrer/allabres/APIs/mallorcasa_back/Controllers/userPropertiesController.php?mail=" . $_SESSION["userMail"] . "&password=" . $_SESSION["userPlainPassword"];
    if (isset($_GET["propertyId"])) {
        $url .= "&propertyId=" . $_GET["propertyId"];
    }
    if (isset($_GET["action"])) {
        $url .= "&action=" . $_GET["action"];
    }
    $file = file_get_contents($url);
    $userProperties_obj = json_decode($file);
} else {
    header("Location: loginController.php");
}

$properties = $userProperties_obj->properties;

$selectedPropertyId = "";
$selectedLatitude = 39.650112;
$selectedLongitude = 2.932662;
$zoom = 10;

if (isset($_GET["propertyId"])) {
    $selectedPropertyId = $_GET["propertyId"];
    $selectedProperty = $userProperties_obj->selectedProperty;
    $selectedLatitude = $userProperties_obj->selectedLatitude;
    $selectedLongitude = $userProperties_obj->selectedLongitude;
    $zoom = $userProperties_obj->zoom;
}

require_once "../Views/userPropertiesView.phtml"

?>