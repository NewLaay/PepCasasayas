<?php

include_once "Actores.php";
include_once "DB.php";
include_once "Directores.php";
include_once "Generos.php";
//include_once "main.php";
include_once "Peliculas.php";
include_once "funcionesGenerales.php";

//Sacamos la ID de la pelicula elegida(clicando la imagen).
if (isset($_GET["id"])){
    $movieElegida = $_GET["id"];
}

//Hacer la conexion a BD con un WHERE para hacer la conexion y que con el select en vez de coger todos nos coja el del ID que le pasamos
$peliculaBDEscogida = DatosPelicula($movieElegida);
//var_dump($peliculaBDEscogida);


//Creamos el objeto
function crearPelicula($peliculaBDEscogida){
    for($i = 0; $i<count($peliculaBDEscogida); $i++){
        $peliculas[$i] = new Peliculas($peliculaBDEscogida[$i]["id"],$peliculaBDEscogida[$i]["nombre"],$peliculaBDEscogida[$i]["calificacion"],$peliculaBDEscogida[$i]["imagen"],$peliculaBDEscogida[$i]["fechaEstreno"],$peliculaBDEscogida[$i]["actores"],$peliculaBDEscogida[$i]["directores"],$peliculaBDEscogida[$i]["genero"],$peliculaBDEscogida[$i]["trailer"]);
    }
    return $peliculas;
}
$peliculaObj = [];
$peliculaObj = crearPelicula($peliculaBDEscogida);
//var_dump($peliculaObj);


//Hacemos el mapeo del objeto escogido
function mapeoPelicula(){

    global $peliculaObj;
    global $actoresObj;
    global $directoresObj;
    global $generosObj;
    //Bucle FOR para cada pelicula.
    for($i = 0; $i<count($peliculaObj);$i++){
        $nombreActores = array();
        $nombreDirectores = array();
        $nombreGeneros = array();
        //Bucle for para recorrer actores de cada pelicula y asignar nombre y apellidos cuando el id sea el mismo.
        for($j = 0; $j<count($actoresObj);$j++){
            for($k = 0; $k<count($peliculaObj[$i]->getActores());$k++){
                if($peliculaObj[$i]->getActores()[$k] == $actoresObj[$j]->getId()){
                    $nombreActores[$k] = $actoresObj[$j]->getNombre().  " ". $actoresObj[$j]->getApellidos();
                }
            }
        }
        $peliculaObj[$i]->setActores($nombreActores);

        //Bucle for para recorrer directores de cada pelicula y asignar nombre y apellidos.
        for($j = 0; $j<count($directoresObj);$j++){
            for($k = 0; $k<count($peliculaObj[$i]->getDirectores());$k++){
                if($peliculaObj[$i]->getDirectores()[$k] == $directoresObj[$j]->getId()){
                    $nombreDirectores[$k] = $directoresObj[$j]->getNombre(). " ". $directoresObj[$j]->getApellidos();
                }
            }
        }
        $peliculaObj[$i]->setDirectores($nombreDirectores);

        //Bucle for para recorrer generos de cada pelicula y asignar generos.
        for($j = 0; $j<count($generosObj);$j++){
            for($k = 0; $k<count($peliculaObj[$i]->getGenero());$k++){
                if($peliculaObj[$i]->getGenero()[$k] == $generosObj[$j]->getId()){
                    $nombreGeneros[$k] = $generosObj[$j]->getTipoGenero();
                }
            }
        }
        $peliculaObj[$i]->setGenero($nombreGeneros);
    }
    return $peliculaObj;

}
$peliculaMapeada = mapeoPelicula();
var_dump($peliculaMapeada);

