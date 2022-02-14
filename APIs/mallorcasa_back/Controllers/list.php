<?php
include_once "../Models/listModel.php";

$model = new listModel();
$properties = $model->getProperties();

$return = array(
    "properties" => $model->getProperties(),
    "selectedPropertyId" => "",
    "selectedProperty" => "",
    "selectedLatitude" => 39.650112,
    "selectedLongitude" => 2.932662,
    "zoom" => 10);

if (isset($_GET["propertyId"])) {
    $selectedProperty = $model->getProperty($_GET["propertyId"]);
    $return = array(
        "properties" => $model->getProperties(),
        "selectedPropertyId" => $_GET["propertyId"],
        "selectedProperty" => $selectedProperty,
        "selectedLatitude" => $selectedProperty->getLatitude(),
        "selectedLongitude" => $selectedProperty->getLongitude(),
        "zoom" => 15);
}

echo json_encode($return)

?>

