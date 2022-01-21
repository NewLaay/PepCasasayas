<?php

include_once "../models/listModel.php";

$model = new listModel();
$hoteles = $model->getHoteles();


session_start();

require_once "../views/listView.phtml";

?>
