<?php

include ("District.php");
include ("Party.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$api_url = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

$districtjson = json_decode(file_get_contents($api_url . "districts"), true);
$partyjson = json_decode(file_get_contents($api_url . "parties"), true);
$votesjson = json_decode(file_get_contents($api_url . "results"), true);

// Creacion de los objetos de distritos, partidos y votos.

function crearDistritos($districtjson){
    $distritos = array();
    for($i=0;$i<count($districtjson);$i++){
        $distritos[$i] = new District($districtjson[$i]["id"],$districtjson[$i]["name"],$districtjson[$i]["delegates"]);
    }
    return $distritos;
}

function crearPartidos($partyjson){
    $partidos = array();
    for($i=0;$i<count($partyjson);$i++){
        $partidos[$i] = new Party($partyjson[$i]["id"],$partyjson[$i]["name"],$partyjson[$i]["acronym"],$partyjson[$i]["logo"]);
    }
    return $partidos;
}

$distritos = crearDistritos($districtjson);
$partidos = crearPartidos($partyjson);


// Listado de votos por distrito
function votosDistritos($distritos,$votesjson){
    $votos = array();
    for($i=0;$i<count($distritos);$i++){
        for($j=0;$j<count($votesjson);$j++){
            if($distritos[$i]->getName() == $votesjson[$j]["district"]){
                $votos[$votesjson[$j]["party"]] = $votesjson[$j]["votes"];
                $distritos[$i]->setVotos($votos);
            }
        }
    }
    return $distritos;
}

// Listado de votos por partido
function votosPartidos($partidos,$votesjson){
    $votos = array();
    for($i=0;$i<count($partidos);$i++){
        for($j=0;$j<count($votesjson);$j++){
            if($partidos[$i]->getName() == $votesjson[$j]["district"]){
                $votos[$votesjson[$j]["district"]] = $votesjson[$j]["votes"];
                $partidos[$i]->setVotos($votos);
             }
        }
    }
    return $partidos;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaños</title>
</head>
<body>

</body>
</html>