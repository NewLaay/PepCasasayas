<?php

include_once "../models/listSingleModel.php";

$model = new listSingleModel();

if (isset($_GET["id"])){
    $hotel = $model->getHotel($_GET["id"]);
} else{
    die("NO ID SELECTED");
}


require_once "../views/singleView.phtml";

?>
