<?php

include_once "../Models/singleProperty.php";

$model = new singleProperty();

if (isset($_GET["id"])){
      $property = $model->getProperty($_GET["id"]);
    } else{
    die("No id selected");
}

session_start();

require_once "../Views/singleProperty.phtml";


?>