<?php

include_once "../Models/listModel.php";

$model = new listModel();
$properties = $model->getProperties();


session_start();


require_once "../Views/listView.phtml";

?>