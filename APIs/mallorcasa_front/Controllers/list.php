<?php

if(isset($_GET["propertyId"])){
    $selectedPropertyId = $_GET["propertyId"];
    $file = file_get_contents("http://localhost/dawsonferrer/allabres/APIs/mallorcasa_back/Controllers/list.php?propertyId=".$selectedPropertyId);
}else{
    $file = file_get_contents("http://localhost/dawsonferrer/allabres/APIs/mallorcasa_back/Controllers/list.php");
}

$obj = json_decode($file);


$properties = $obj->properties;

$selectedPropertyId = "";
$selectedLatitude = 39.650112;
$selectedLongitude = 2.932662;
$zoom = 10;

if (isset($_GET["propertyId"])) {
    $selectedPropertyId = $_GET["propertyId"];
    $selectedProperty = $obj->selectedProperty;
    $selectedLatitude = $obj->selectedLatitude;
    $selectedLongitude = $obj->selectedLongitude;
    $zoom = $obj->zoom;
}

session_start();

require_once "../Views/listView.phtml"

?>

