<?php

$file = file_get_contents("http://localhost/PepCasasayas/BaseDeDatos/mvcHotelesJson/BACK/controllers/list.php");

$obj = json_decode($file);

$hoteles = $obj->hoteles;

session_start();

require_once "../views/listView.phtml";
