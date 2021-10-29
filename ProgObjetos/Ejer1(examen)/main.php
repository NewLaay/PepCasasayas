<?php

// Creamos lass clases de character, location y episode y las incluimos en el metodo main.

include "Character.php";
include "Location.php";
include "Episode.php";

$seed = 6836;
$api_url = "https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?seed=" . $seed . "&data=";

$characters = json_decode(file_get_contents($api_url . "characters"), true);
$episodes = json_decode(file_get_contents($api_url . "episodes"), true);
$locations = json_decode(file_get_contents($api_url . "locations"), true);

$objectsCharacter = array();
$objectsEpisode = array();
$objectsLocation = array();

// Creamos el array de objetos de caracteres.
foreach ($characters as $character) {
    $character = new Character($character["id"], $character["name"], $character["status"], $character["species"], $character["type"], $character["gender"], $character["origin"], $character["location"], $character["image"], $character["created"], $character["episodes"]);
    $objectsCharacter[] = $character;
}

// Creamos el array de objetos de episodios.
foreach ($episodes as $episode) {
    $episode = new Episode($episode["id"], $episode["name"], $episode["air_date"], $episode["episode"], $episode["created"], $episode["characters"]);
    $objectsEpisode[] = $episode;
}

// Creamos el array de objetos de localizaciones.
foreach ($locations as $location) {
    $location = new Location($location["id"], $location["name"], $location["type"], $location["dimension"], $location["created"], $location["residents"]);
    $objectsLocation[] = $location;
}

/* **** MAPPING ***** */

// Mapeando el objeto caracter
function mappingCharacters() {
    global $objectsCharacter;
    global $locations;
    global $episodes;

    foreach ($objectsCharacter as $charKey => $character) {
        foreach ($locations as $locKey => $location) {
            if ($character->getOrigin() == $location["id"]) {
                $character->setOrigin($location["name"]);
            }
            if ($character->getLocation() == $location["id"]) {
                $character->setLocation($location["name"]);
            }
         }
    }
    return $objectsCharacter;
}

var_dump($objectsCharacter);
echo "<br>"."Ahora hacemos el mapeo para comprobar si está bien hecho.";
mappingCharacters();
var_dump($objectsCharacter);

?>