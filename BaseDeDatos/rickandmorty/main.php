<?php
include("Characters.php");
include("Locations.php");
include("Episodes.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$api_url = "https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?seed=5284&data=";

$charactersjson = json_decode(file_get_contents($api_url . "characters"), true);
$episodesjson = json_decode(file_get_contents($api_url . "episodes"), true);
$locationsjson = json_decode(file_get_contents($api_url . "locations"), true);

//CREACION BASE DE DATOS

$servername = "sql480.main-hosting.eu";
$username = "u850300514_jcasasayas";
$password = "x43196836F";
$dbname = "u850300514_jcasasayas";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
    die("Connection failed :" . $conn->connect_error);
}

//Creacion de las tablas (lo hacemos manualmente en el PHPMYADMIN / WORKBENCH
//Creamos las tablas Characters, Episodes y Locations
//var_dump($charactersjson);
//var_dump($locationsjson);
//var_dump($episodesjson);

//REALIZACION DE LOS INSERTS DE CADA TABLA.
//Insertar caracteres.
 /* $sqlInsertarCharacters = "";
for($i=0;$i<count($charactersjson);$i++){
    $sqlInsertarCharacters .= 'INSERT INTO Characters (id, name, status, type, gender, origin, location, image, created ) VALUES ("'.$charactersjson[$i]['id'].'","'.$charactersjson[$i]['name'].'","'.$charactersjson[$i]['status'].'","'.$charactersjson[$i]['type'].'","'.$charactersjson[$i]['gender'].'",'.$charactersjson[$i]['origin'].','.$charactersjson[$i]['location'].',"'.$charactersjson[$i]['image'].'","'.$charactersjson[$i]['created'].'");';
    echo $sqlInsertarCharacters;
}
if($conn->multi_query($sqlInsertarCharacters) == TRUE){
    echo "New record created succesfully: CHARACTERS";
}else{
    echo "Error : " .$sqlInsertarCharacters . "<br>" . $conn->error;
} */


//Insertar episodios
//var_dump($episodesjson);
/* $sqlnsertarEpisodios = "";
for ($i = 0; $i < count($episodesjson); $i++) {
    $sqlnsertarEpisodios .= 'INSERT INTO Episodes (id, name, air_date, episode, created) VALUES ("' . $episodesjson[$i]['id'] . '","' . $episodesjson[$i]['name'] . '","' . $episodesjson[$i]['air_date'] .'","'.$episodesjson[$i]['episode'].'","'.$episodesjson[$i]['created'].'");';
}

if($conn->multi_query($sqlnsertarEpisodios) == TRUE){
    echo "New record created succesfully: EPISODES";
}else{
    echo "Error : " .$sqlnsertarEpisodios . "<br>" . $conn->error;
} */

//Insertar locations
//var_dump($locationsjson);
/* $sqlInsertarLocations = "";
for($i = 0; $i<count($locationsjson);$i++){
    $sqlInsertarLocations .= 'INSERT INTO Locations (id, name, type, dimension, created) VALUES ( "'.$locationsjson[$i]['id'].'","'.$locationsjson[$i]['name'].'","'.$locationsjson[$i]['type'].'","'.$locationsjson[$i]['dimension'].'","'.$locationsjson[$i]['created'].'");';
}
if($conn->multi_query($sqlInsertarLocations) == TRUE){
    echo "New record created succesfully: LOCATIONS";
}else{
    echo "Error  :" .$sqlInsertarLocations . " <br> " .$conn->error;
} */

//Insertar datos en tabla Characteres - Episodios -> ESTE ES EL IMPORTANTE
/* $contador = 0;
for($i = 0 ; $i<count($charactersjson); $i++){
    for ($j = 0; $j<count($charactersjson[$i]["episodes"]);$j++){
        $sql = 'INSERT INTO CharEpi (id, char_id, epis_id) VALUES ( "'.$contador.'","'.$charactersjson[$i]['id'].'","'.$charactersjson[$i]['episodes'][$j].'")';

        if($conn->query($sql) === TRUE ){
            echo "New record created succesfully : CARACTERES-EPISODIOS";
            $contador++;
        }else{
            echo "Error  :" .$sql . " <br> " .$conn->error;
        }
    }
} */


//COGER LOS DATOS DE LA BASE DE DATOS DE MySQL.
//Coger datos de la tabla Characters-> creamos la tabla de Caracteres y le añadimos el array de Episodios

//LO hacemos con un fetch_assoc para tener un array y que sea mas claro, y poder luego añadir el array de episodios
function BDCharacters(){
  global $conn;

  $resultado = [];
  $sql = "SELECT * FROM Characters";
  $resultados = $conn->query($sql);

  //De esta manera, creamos el objeto donde nos muestra la tabla Characteres tal y como lo tenemos en la BD.
  for($i = 0; $row = $resultados->fetch_assoc(); $i++){
      $resultado[$i]['id'] = $row['id'];
      $resultado[$i]['name'] = $row['name'];
      $resultado[$i]['status'] = $row['status'];
      $resultado[$i]['type'] = $row['type'];
      $resultado[$i]['gender'] = $row['gender'];
      $resultado[$i]['origin'] = $row['origin'];
      $resultado[$i]['location'] = $row['location'];
      $resultado[$i]['image'] = $row['image'];
      $resultado[$i]['created'] = $row['created'];
  }

  //Ahora lo que hacemos, es añadir los episodios donde salga cada caracter.
    $sql = "SELECT * FROM CharEpi";
    $resultados = $conn->query($sql);

    for($i = 0; $row = $resultados->fetch_assoc(); $i++){
       for($j = 0; $j<count($resultado);$j++) {
            if($row['char_id'] == $resultado[$j]['id']){
                $resultado[$j]['episodes'][] = $row['epis_id'];
            }
       }
    }

    return $resultado;
}
$charactersBD = BDCharacters();
//var_dump($charactersBD);

//A esta tabla de caracteres le faltaria por añadir los episodios en los que aparece cada caracter.
function BDCharacters2(){
    global $conn;

    $consulta = "SELECT * FROM Characters";

    if($resultado = $conn->query($consulta)){
        return $resultado ->fetch_all(MYSQLI_ASSOC);
    }
}

$charactersBD2 = BDCharacters2();
//var_dump($charactersBD2);



//Coger datos de la tabla Episodes
function BDEpisodes(){
    global $conn;

    $consulta = "SELECT * FROM Episodes";

    if($resultado = $conn->query($consulta)){
        return $resultado ->fetch_all(MYSQLI_ASSOC);
    }
}

$episodesBD = BDEpisodes();
//var_dump($episodesBD);

//Coger los datos de la tabla Locations
function BDLocations(){
    global $conn;

    $consulta = "SELECT * FROM Locations";

    if($resultado = $conn->query($consulta)){
        return $resultado ->fetch_all(MYSQLI_ASSOC);
    }
}

$locationsBD = BDLocations();
//var_dump($locationsBD);


function getSortedCharactersById($characters)
{
    for ($i = 0; $i < count($characters); $i++) {
        for ($j = $i; $j < count($characters); $j++) {
            if (intval($characters[$i]["id"]) > intval($characters[$j]["id"])) {
                $temp = $characters[$i];
                $characters[$i] = $characters[$j];
                $characters[$j] = $temp;
            }
        }
    }
    return $characters;
}

function getSortedCharactersByOrigin($characters)
{
    for ($i = 0; $i < count($characters); $i++) {
        for ($j = $i; $j < count($characters); $j++) {
            if ($characters[$i]["origin"] > $characters[$j]["origin"]) {
                $temp = $characters[$i];
                $characters[$i] = $characters[$j];
                $characters[$j] = $temp;
            }
        }
    }
    return $characters;
}

function getSortedCharactersByStatus($characters)
{
    for ($i = 0; $i < count($characters); $i++) {
        for ($j = $i; $j < count($characters); $j++) {
            if ($characters[$i]["status"] != "Alive" && $characters[$j]["status"] == "Alive") {
                $temp = $characters[$i];
                $characters[$i] = $characters[$j];
                $characters[$j] = $temp;
            }
        }
    }

    for ($i = 0; $i < count($characters); $i++) {
        for ($j = $i; $j < count($characters); $j++) {
            if ($characters[$i]["status"] == "unknown" && $characters[$j]["status"] == "Dead") {
                $temp = $characters[$i];
                $characters[$i] = $characters[$j];
                $characters[$j] = $temp;
            }
        }
    }
    return $characters;
}

function createCharacters($charactersjson)
{

    for ($i = 0; $i < count($charactersjson); $i++) {
        $characters[$i] = new Characters($charactersjson[$i]["id"], $charactersjson[$i]["name"], $charactersjson[$i]["status"],
            $charactersjson[$i]["species"], $charactersjson[$i]["type"], $charactersjson[$i]["gender"], $charactersjson[$i]["origin"],
            $charactersjson[$i]["location"], $charactersjson[$i]["image"], $charactersjson[$i]["created"], $charactersjson[$i]["episodes"]);
    }

    return $characters;
}

function createLocations($locationsjson)
{

    for ($i = 0; $i < count($locationsjson); $i++) {
        $locations[$i] = new Locations($locationsjson[$i]["id"], $locationsjson[$i]["name"], $locationsjson[$i]["type"],
            $locationsjson[$i]["dimension"], $locationsjson[$i]["created"], $locationsjson[$i]["residents"]);
    }

    return $locations;
}

function createEpisodes($episodesjson)
{

    for ($i = 0; $i < count($episodesjson); $i++) {
        $episodes[$i] = new Episodes($episodesjson[$i]["id"], $episodesjson[$i]["name"], $episodesjson[$i]["air_date"], $episodesjson[$i]["episode"],
            $episodesjson[$i]["created"], $episodesjson[$i]["characters"]);
    }

    return $episodes;
}

function mapp($characters, $locations, $episodes)
{
    $epnames = array();

    for ($i = 0; $i < count($characters); $i++) {

        for ($j = 0; $j < count($locations); $j++) {
            if ($characters[$i]->getOrigin() == $locations[$j]->getId() && $characters[$i]->getOrigin() != "0") {
                $characters[$i]->setOrigin($locations[$j]->getName());
            } else if ($characters[$i]->getOrigin() == "0") {
                $characters[$i]->setOrigin("Unknown");
            }
        }

        for ($j = 0; $j < count($locations); $j++) {
            if ($characters[$i]->getLocation() == $locations[$j]->getId() && $characters[$i]->getLocation() != "0") {
                $characters[$i]->setLocation($locations[$j]->getName());
            } else if ($characters[$i]->getLocation() == "0") {
                $characters[$i]->getLocation("Unknown");
            }
        }

        for ($j = 0; $j < count($episodes); $j++) {
            for ($k = 0; $k < count($characters[$i]->getEpisodes()); $k++) {
                if (($characters[$i]->getEpisodes()[$k] == intval($episodes[$j]->getId())) && $characters[$i]->getEpisodes()[$k] !== 0) {
                    $epnames[$k] = $episodes[$j]->getName();

                } else if ($characters[$i]->getEpisodes()[$k] == 0) {
                    $epnames[$k] = "unknown";
                }
            }
        }

        $characters[$i]->setEpisodes($epnames);
    }

    return $characters;
}

function render($character)
{
    //var_dump($character->getId());

    echo '<div class="col-md-4 col-sm-12 col-xs-12"><div class="card mb-4 box-shadow bg-light">';
    echo '<img class="card-img-top" src="' . $character->getImage() . '" alt="' . $character->getImage() . '">';
    echo '<div class="card-body"><h5 class="card-title">' . $character->getName() . '</h5>';
    $alertClass = "success";
    switch ($character->getStatus()) {
        case "Dead":
            $alertClass = "danger";
            break;
        case "unknown":
            $alertClass = "warning";
            break;
    }
    echo '<div class="alert alert-' . $alertClass . '" style="padding:0;" role="alert">' . $character->getStatus() . ' - ' . $character->getSpecies() . '</div>';
    echo '<form><div class="mb-3" style="margin-bottom:0!important;">';
    echo '<label for="exampleInputEmail1" class="form-label" style="margin-bottom: 0;"><strong>Origin:</strong></label>';
    echo '<div id="emailHelp" class="form-text" style="margin-top:0;">' . $character->getOrigin() . '</div></div>';
    echo '<div class="mb-3"><label for="exampleInputEmail1" class="form-label" style="margin-bottom: 0;"><strong>Last known location:</strong></label>';
    echo '<div id="emailHelp" class="form-text" style="margin-top:0;">' . $character->getLocation() . '</div></div></form>';
    echo '<div class="d-flex justify-content-between align-items-center"><div class="btn-group">';
    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#characterModal_' . $character->getId() . '">View episodes</button>';
    echo '<div class="modal fade" id="characterModal_' . $character->getId() . '" tabindex="-1" aria-labelledby="characterModalLabel_' . $character->getId() . '" aria-hidden="true">';
    echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">';
    echo '<h5 class="modal-title" id="characterModalLabel_' . $character->getId() . '">Episodes list </h5>';
    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';
    //echo count($character->getEpisodes());
    echo '<div class="modal-body"><ol class="list-group">';

    foreach ($character->getEpisodes() as $episode => $a) {
        echo '<li class="list-group-item">' . $a . '</li>';
    }

    echo '</ol></div>';
    echo '<div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div></div>';
    echo '<small class="text-muted">' . $character->getCreated() . '</small></div></div></div></div>';
}

$sortingCriteria = "";
if (isset($_GET["sortingCriteria"])) {
    $sortingCriteria = $_GET["sortingCriteria"];
    switch ($sortingCriteria) {
        case "id":
            $charactersjson = getSortedCharactersById($charactersjson);
            break;
        case "origin":
            $charactersjson = getSortedCharactersByOrigin($charactersjson);
            break;
        case "status":
            $charactersjson = getSortedCharactersByStatus($charactersjson);
            break;
    }
}

$characters = createCharacters($charactersjson);
$locations = createLocations($locationsjson);
$episodes = createEpisodes($episodesjson);

$charactersmapp = mapp($characters, $locations, $episodes);


?>
<html lang="es">
<head>
    <title>RMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex" action="main.php">
                <select class="form-control me-2 form-select" aria-label="Sorting criteria" name="sortingCriteria">
                    <option <?php echo($sortingCriteria == "" ? "selected" : "") ?> value="unsorted">Sorting criteria
                    </option>
                    <option <?php echo($sortingCriteria == "id" ? "selected" : "") ?> value="id">Id</option>
                    <option <?php echo($sortingCriteria == "origin" ? "selected" : "") ?> value="origin">Origin</option>
                    <option <?php echo($sortingCriteria == "status" ? "selected" : "") ?> value="status">Status</option>
                </select>
                <button class="btn btn-outline-success" type="submit">Sort</button>
            </form>
        </div>
    </div>
</nav>
<main role="main">
    <div class="py-5 bg-light">
        <div class="container">

            <div class="row">

                <?php

                foreach ($charactersmapp as $i => $key) {
                    render($key);
                }

                ?>
            </div>
        </div>
    </div>

</main>
</body>
</html>