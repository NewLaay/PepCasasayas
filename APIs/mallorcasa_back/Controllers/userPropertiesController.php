<?php
include_once "../Models/userPropertiesModel.php";
include_once "../Models/loginModel.php";

$user = new user(0, "-", "-");
if (isset($_GET["mail"]) && isset($_GET["password"])) {
    $loginModel = new loginModel();
    $user = $loginModel->getUser($_GET["mail"], $_GET["password"]);
}

if ($user->getId() > 0) {
    $userId = $user->getId();
    $model = new userPropertiesModel();
    $selectedPropertyId = "";
    $selectedLatitude = 39.650112;
    $selectedLongitude = 2.932662;
    $zoom = 10;
    $selectedProperty = "";


    if (isset($_GET["propertyId"]) && !isset($_GET["action"])) {
        $selectedPropertyId = $_GET["propertyId"];
        $selectedProperty = $model->getProperty($selectedPropertyId);
        $selectedLatitude = $selectedProperty->getLatitude();
        $selectedLongitude = $selectedProperty->getLongitude();
        $zoom = 15;
    } elseif (isset($_GET["propertyId"]) && isset($_GET["action"])) {
        $selectedPropertyId = $_GET["propertyId"];
        $selectedProperty = $model->getProperty($selectedPropertyId);
        if ($selectedProperty->getUser()->getId() == $userId && $_GET["action"] == "sell") {
            $model->sellProperty($selectedPropertyId);
        } elseif ($selectedProperty->getUser()->getId() == 0 && $_GET["action"] == "buy") {
            $model->buyProperty($selectedPropertyId, $userId);
        }
    }

    $properties = $model->getProperties($userId);


    $return = array(
        "properties" => $model->getProperties($userId),
        "selectedPropertyId" => $selectedPropertyId,
        "selectedProperty" => $selectedProperty,
        "selectedLatitude" => $selectedLatitude,
        "selectedLongitude" => $selectedLongitude,
        "zoom" => $zoom);

    echo json_encode($return);

} else {
    echo json_encode(array("error" => "Login wrong"));
}

?>