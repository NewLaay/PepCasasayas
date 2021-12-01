<?php

include_once("Actores.php");
include_once("Directores.php");
include_once("Generos.php");
include_once("Peliculas.php");
include_once("DB.php");

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
//var_dump($directoresObj);

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
        $peliculas[$i] = new Peliculas($peliculasBD[$i]["id"],$peliculasBD[$i]["nombre"],$peliculasBD[$i]["calificacion"],$peliculasBD[$i]["imagen"],$peliculasBD[$i]["fechaEstreno"],$peliculasBD[$i]["actores"],$peliculasBD[$i]["directores"],$peliculasBD[$i]["genero"],$peliculasBD[$i]["trailer"]);
    }
    return $peliculas;
}
$peliculasObj = [];
$peliculasObj = crearPeliculas($peliculasBD);
//var_dump($peliculasObj);

//FUNCION PARA ORDENAR LISTADO DE PELICULAS POR CALIFICACION
function ordenarPeliculaRating($peliculasObj){
    for($i = 0; $i<count($peliculasObj); $i++){
        for($j = $i; $j<count($peliculasObj);$j++){
            if($peliculasObj[$i]->getCalificacion()<$peliculasObj[$j]->getCalificacion()){
                $aux = $peliculasObj[$j];
                $peliculasObj[$j] = $peliculasObj[$i];
                $peliculasObj[$i] = $aux;
            }
        }
    }
    return $peliculasObj;
}

$peliculasRating = ordenarPeliculaRating($peliculasObj);
//var_dump($peliculasOrdenadas2);

//FUNCION PARA ORDENAR LISTADO DE PELICULAS POR FECHA
function ordenarPeliculaFecha($peliculasObj){
    for($i = 0; $i<count($peliculasObj);$i++){
        for($j = $i+1; $j<count($peliculasObj);$j++){
            if($peliculasObj[$i]->getFechaEstreno()<$peliculasObj[$j]->getFechaEstreno()){
                $aux = $peliculasObj[$i];
                $peliculasObj[$i] = $peliculasObj[$j];
                $peliculasObj[$j] = $aux;
            }
        }
    }
    return $peliculasObj;
}

$peliculasFecha = ordenarPeliculaFecha($peliculasObj);
//var_dump($peliculasFecha);


//MAPEO PARA SUSTITUIR LOS ID DE ACTORES, DIRECTORES y GENEROS POR SUS CORRESPONDIENTES NOMBRES.
function mapeoPeliculas($peliculasObj, $actoresObj, $directoresObj, $generosObj){
    //Bucle FOR para cada pelicula.
    for($i = 0; $i<count($peliculasObj);$i++){
        $nombreActores = array();
        $nombreDirectores = array();
        $nombreGeneros = array();
        //Bucle for para recorrer actores de cada pelicula y asignar nombre y apellidos cuando el id sea el mismo.
        for($j = 0; $j<count($actoresObj);$j++){
            for($k = 0; $k<count($peliculasObj[$i]->getActores());$k++){
                if($peliculasObj[$i]->getActores()[$k] == $actoresObj[$j]->getId()){
                    $nombreActores[$k] = $actoresObj[$j]->getNombre().  " ". $actoresObj[$j]->getApellidos();
                }
            }
        }
        $peliculasObj[$i]->setActores($nombreActores);

        //Bucle for para recorrer directores de cada pelicula y asignar nombre y apellidos.
        for($j = 0; $j<count($directoresObj);$j++){
            for($k = 0; $k<count($peliculasObj[$i]->getDirectores());$k++){
                if($peliculasObj[$i]->getDirectores()[$k] == $directoresObj[$j]->getId()){
                    $nombreDirectores[$k] = $directoresObj[$j]->getNombre(). " ". $directoresObj[$j]->getApellidos();
                }
            }
        }
        $peliculasObj[$i]->setDirectores($nombreDirectores);

        //Bucle for para recorrer generos de cada pelicula y asignar generos.
        for($j = 0; $j<count($generosObj);$j++){
            for($k = 0; $k<count($peliculasObj[$i]->getGenero());$k++){
                if($peliculasObj[$i]->getGenero()[$k] == $generosObj[$j]->getId()){
                    $nombreGeneros[$k] = $generosObj[$j]->getTipoGenero();
                }
            }
        }
        $peliculasObj[$i]->setGenero($nombreGeneros);
    }
    return $peliculasObj;

}

$peliculasMapeadas = mapeoPeliculas($peliculasObj,$actoresObj, $directoresObj, $generosObj);
//var_dump($peliculasMapeadas);
