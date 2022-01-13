<?php

include_once "../models/listModel.php";

$model = new listModel();
$hoteles = $model->getHoteles();

require_once "../views/listView.phtml";

?>
