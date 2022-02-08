<?php

include_once "../models/listModel.php";

$model = new listModel();
$hoteles = $model->getHoteles();

$return = array(
    "hoteles" => $model->getHoteles()
);

echo json_encode($return)

?>
