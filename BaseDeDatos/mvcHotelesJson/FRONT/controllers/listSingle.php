<?php

if(isset($_GET["id"])){
    $selectedPropertyId = $_GET["id"];
    $file = file_get_contents("http://localhost/PepCasasayas/BaseDeDatos/mvcHotelesJson/BACK/controllers/singleproperty.php?id=".$selectedPropertyId);
    $property_obj = json_decode($file);
}else{
    die("NO ID SELECTED");
}

session_start();

require_once "../views/singleView.phtml";