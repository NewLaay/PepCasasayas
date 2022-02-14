<?php

include_once "../Models/singlepropertyModel.php";

$model = new singlepropertyModel();

$error = "";
$return = array();

if (isset($_GET["id"])) {
    $return["property"] = $model->getProperty($_GET["id"]);

} else {
    $return["error"] = "NO ID SELECTED";
}

echo json_encode($return);

?>