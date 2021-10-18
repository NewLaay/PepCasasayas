<?php

$contents_cities = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=cities");
$cities = json_decode($contents_cities, true);
$contents_countries = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=countries");
$countries = json_decode($contents_countries, true);

function mapCities()
{
    //TODO: Your code here
    global $cities;
    global $countries;
    for($i=0;$i<count($cities);$i++){
        for($j=0;$j<count($countries);$j++){
            if($cities[$i]['CountryCode']=$countries[$j]['Code']){
                $cities[$i]['Pais'] = $countries[$j]['Name'];
            }
        }
    }
    return $cities;
}

function mapCountries()
{
    /* Aqui hay que añadir el nombre de las ciudades que tiene un determinado pais. El nombre de las ciudades se guarda en un array. */
    global $cities;
    global $countries;
    for($i=0;$i<count($countries);$i++){
        for($j=0;$j<count($cities);$j++){
            if($countries[$i]['Code']=$cities[$j]['CountryCode']){

            }
        }
    }
    return $countries;
}

var_dump($cities[0]);
var_dump($countries[0]);
var_dump(mapCities()[0]);