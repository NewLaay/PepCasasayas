<?php

include ("District.php");
include ("Party.php");
include ("Resultados.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$api_url = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

$districtjson = json_decode(file_get_contents($api_url . "districts"), true);
$partyjson = json_decode(file_get_contents($api_url . "parties"), true);
$votesjson = json_decode(file_get_contents($api_url . "results"), true);

// Creación de las funciones para crear objetos de distritos y partidos.

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

// Llamada a las funciones y creación del array de objetos de distritos y partidos.
$distritos = crearDistritos($districtjson);
$partidos = crearPartidos($partyjson);

// Lo que tenemos que hacer es recorrer el array de objetos $distritos, y que retorne el distrito cuando coincida con $districtName.
function getDistrictByDistrictName($districtName){
    global $distritos;
    foreach ($distritos as $distrito){
        if($distrito->getName() == $districtName){
            return $distrito;
        }
    }
}

// Ahora recorremos el array de objetos $partidos y retornamos el partido cuando coincide con $partyName.
function getPartyByPartyName($partyName){
    global $partidos;
    foreach($partidos as $partido){
        if($partido->getName() == $partyName){
            return $partido;
        }
    }
}

// Creación del array de objetos de resultados con los objetos realizados.
function crearResultados($votesjson){
    $resultados = array();
    for($i=0;$i<count($votesjson);$i++){
        $resultados[$i] = new Resultados(getDistrictByDistrictName($votesjson[$i]["district"]),getPartyByPartyName($votesjson[$i]["party"]), $votesjson[$i]["votes"]);
    }
    return $resultados;
}

$resultados = crearResultados($votesjson);



?>

<!-- Código HTML copiado del Código fuente de la solución -->
<html lang="es">
<head>
    <title>Election Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table, th, td {
            border: 1px solid black;
            padding-left: 12px;
            padding-right: 12px;
        }
    </style>
</head>
<body>
<form action="index.php" method="post">
    <select name="district">
        <option value=''>Selecciona una circumscripción</option>
        <option  value='1'>Madrid</option>
        <option  value='2'>Barcelona</option>
        <option  value='3'>València</option>
        <option  value='4'>Alacant</option>
        <option  value='5'>Sevilla</option>
        <option  value='6'>Málaga</option>
        <option  value='7'>Murcia</option>
        <option  value='8'>Cádiz</option>
        <option  value='9'>Illes Balears</option>
        <option  value='10'>A Coruña</option>
        <option  value='11'>Las Palmas</option>
        <option  value='12'>Bizkaia</option>
        <option  value='13'>Asturias</option>
        <option  value='14'>Granada</option>
        <option  value='15'>Pontevedra</option>
        <option  value='16'>Santa Cruz de Tenerife</option>
        <option  value='17'>Zaragoza</option>
        <option  value='18'>Almería</option>
        <option  value='19'>Badajoz</option>
        <option  value='20'>Córdoba</option>
        <option  value='21'>Girona</option>
        <option  value='22'>Gipuzkoa</option>
        <option  value='23'>Tarragona</option>
        <option  value='24'>Toledo</option>
        <option  value='25'>Cantabria</option>
        <option  value='26'>Castelló</option>
        <option  value='27'>Ciudad Real</option>
        <option  value='28'>Huelva</option>
        <option  value='29'>Jaén</option>
        <option  value='30'>Navarra</option>
        <option  value='31'>Valladolid</option>
        <option  value='32'>Araba</option>
        <option  value='33'>Albacete</option>
        <option  value='34'>Burgos</option>
        <option  value='35'>Cáceres</option>
        <option  value='36'>León</option>
        <option  value='37'>Lleida</option>
        <option  value='38'>Lugo</option>
        <option  value='39'>Ourense</option>
        <option  value='40'>La Rioja</option>
        <option  value='41'>Salamanca</option>
        <option  value='42'>Ávila</option>
        <option  value='43'>Cuenca</option>
        <option  value='44'>Guadalajara</option>
        <option  value='45'>Huesca</option>
        <option  value='46'>Palencia</option>
        <option  value='47'>Segovia</option>
        <option  value='48'>Teruel</option>
        <option  value='49'>Zamora</option>
        <option  value='50'>Soria</option>
        <option  value='51'>Ceuta</option>
        <option  value='52'>Melilla</option>
    </select>
    <input type="submit" value="Filtra"/>
</form>
<table>
</table>
</body>