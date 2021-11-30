<?php

include_once "Actores.php";
include_once "DB.php";
include_once "Directores.php";
include_once "Generos.php";
include_once "main.php";
include_once "Peliculas.php";


//Sacamos la ID de la pelicula elegida(clicando la imagen).
if (isset($_GET["id"])){
    $movieElegida = $_GET["id"];
}

//Hacer la conexion a BD con un WHERE para hacer la conexion y que con el select en vez de coger todos nos coja el del ID que le pasamos
