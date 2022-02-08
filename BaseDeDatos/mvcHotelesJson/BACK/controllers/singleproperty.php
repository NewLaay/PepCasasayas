<?php

include_once "../models/listSingleModel.php";

$model = new listSingleModel();

$error = "";
$return = array();

if(isset($_GET["id"])){
    $return["property"] = $model->getHotel($_GET["id"]);
}else{
    $return["error"] = "NO ID SELECTED" ;
}

echo json_encode($return);

?>