<?php

include("Actores.php");
include("Directores.php");
include("Generos.php");
include("Peliculas.php");
include("DB.php");

$actoresBD = DatosActores();
//var_dump($actoresBD); OK

$directoresBD = DatosDirectores();
//var_dump($directoresBD);  OK

$generosBD = DatosGenerosPeliculas();
//var_dump($generosBD);  OK

$peliculasBD = DatosPeliculas();
//var_dump($peliculasBD); OK


//CREAR LOS OBJETOS ACTORES - DIRECTORES - GENEROS - PELICULAS ( $actoresObj, $directoresObj, $generosObj y $peliculasObj)
function crearActores($actoresBD){
    for($i = 0; $i<count($actoresBD);$i++){
        $actores[$i] = new Actores($actoresBD[$i]["id"],$actoresBD[$i]["nombre"],$actoresBD[$i]["apellidos"],$actoresBD[$i]["fechaNacimiento"],$actoresBD[$i]["imagen"],$actoresBD[$i]["numOscars"]);
    }
    return $actores;
}

$actoresObj = [];
$actoresObj = crearActores($actoresBD);
//var_dump($actoresObj); OK

function crearDirectores($directoresBD){
    for($i = 0; $i<count($directoresBD); $i++){
        $directores[$i] = new Directores($directoresBD[$i]["id"],$directoresBD[$i]["nombre"],$directoresBD[$i]["apellidos"],$directoresBD[$i]["fechaNacimiento"],$directoresBD[$i]["imagen"],$directoresBD[$i]["peliculasRealizadas"]);
    }
    return $directores;
}

$directoresObj = [];
$directoresObj = crearDirectores($directoresBD);
//var_dump($directoresObj); OK

function crearGeneros($generosBD){
    for($i = 0; $i<count($generosBD); $i++){
        $generos[$i] = new Generos($generosBD[$i]["id"],$generosBD[$i]["tipoGenero"]);
    }
    return $generos;
}
$generosObj = [];
$generosObj = crearGeneros($generosBD);
//var_dump($generosObj);

function crearPeliculas($peliculasBD){
    for($i = 0; $i<count($peliculasBD); $i++){
        $peliculas[$i] = new Peliculas($peliculasBD[$i]["id"],$peliculasBD[$i]["nombre"],$peliculasBD[$i]["calificacion"],$peliculasBD[$i]["imagen"],$peliculasBD[$i]["fechaEstreno"],$peliculasBD[$i]["actores"],$peliculasBD[$i]["directores"],$peliculasBD[$i]["genero"]);
    }
    return $peliculas;
}
$peliculasObj = [];
$peliculasObj = crearPeliculas($peliculasBD);
//var_dump($peliculasObj);

//FUNCION PARA ORDENAR LISTADO DE PELICULAS POR CALIFICACION
function ordenarPeliculaRating($peliculasObj){

}

//FUNCION PARA ORDENAR LISTADO DE PELICULAS POR FECHA
function ordenarPeliculaFecha($peliculasObj){

}

//MAPEO PARA SUSTITUIR LOS ID DE ACTORES, DIRECTORES y GENEROS POR SUS CORRESPONDIENTES NOMBRES.
function mapeoPeliculas($peliculasObj, $actoresObj, $directoresObj, $generosObj){
    $nombreActores = array();
    $apellidoActores = array();
    $nombreDirectores = array();
    $apellidoDirectores = array();
    $nombreGeneros = array();

    //Bucle FOR para cada pelicula.
    for($i = 0; $i<count($peliculasObj);$i++){
        //Bucle for para recorrer actores de cada pelicula y asignar nombre y apellidos.
        for($j = 0; $j<count($actoresObj);$j++){
        }
        
    }

}


