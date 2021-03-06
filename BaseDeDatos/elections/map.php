<?php

//MODIFICACION DE BASE DE DATOS
$servername = "sql480.main-hosting.eu";
$username = "u850300514_jcasasayas";
$password = "x43196836F";
$dbname = "u850300514_jcasasayas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//FORMA DE HACER EN TABLAS ASOCIATIVAS.
// Coger los datos de la base de datos de cada tabla: TABLA DISTRITOS
function PruebaDistritos(){
    global $conn;

    $consulta = "SELECT * FROM Districts";
    $filas = array();

    if($resultado = $conn->query($consulta)){
        while($fila = $resultado->fetch_assoc()){
            $filas[] = $fila;
        }
        return $filas;
    }
}
$pruebaDistritos = pruebaDistritos();
//var_dump($pruebaDistritos);

// Coger los datos de la tabla distritos con un FETCH_ALL
function PruebaDistritos2(){
    global $conn;

    $consulta = "SELECT * FROM Districts";
    $filas = array();
    if($resultado = $conn->query($consulta)){
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
$pruebaDistritos2 = PruebaDistritos2();
//var_dump($pruebaDistritos2);

//Datos de PROVINCIAS
function DatosPartidos(){
    global $conn;

    $consulta = "SELECT * FROM Parties";
    $filas = array();

    if($resultado = $conn->query($consulta)){
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
$pruebaPartidos = DatosPartidos();
//var_dump($pruebaPartidos);


//Datos de RESULTADOS
function DatosResultados(){
    global $conn;

    $consulta = "SELECT * FROM Results";
    $filas = array();

    if($resultado = $conn->query($consulta)){
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
$pruebaResultados = DatosResultados();
//var_dump($pruebaResultados);

/* Create database [YA ESTA CREADA]
$sql = "CREATE DATABASE u850300514_jcasasayas";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
} */


$api_url = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";
//Insertar los valores en las tablas creadas de distritos, partidos y resultados.
$districts = json_decode(file_get_contents($api_url . "districts"), true);
//var_dump($districts);
/* $sql2 = "";
for($i=0; $i<count($districts); $i++){
    $sql2 .= 'INSERT INTO Districts (id, name, delegates) VALUES ("'.$districts[$i]['id'].'","'.$districts[$i]['name'].'",'.$districts[$i]['delegates'].');';
}

if ($conn->multi_query($sql2) === TRUE) {
    echo "New record created successfully : Distritos";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
} */


$results = json_decode(file_get_contents($api_url . "results"), true);
$resultadosBD = array();
$resultadosBD = $results;
//var_dump($resultadosBD);
//var_dump($resultadosBD[0]['district']);
/*
$sql3 = "";
for($i=0;$i<count($resultadosBD);$i++){
    $sql3 .= 'INSERT INTO Results (district, party, votes) VALUES ("'.$resultadosBD[$i]['district'].'","'.$resultadosBD[$i]['party'].'",'.$resultadosBD[$i]['votes'].');';
                                  //echo $sql3;
                                    //distrito es string, partido es String y votos es INT.
}

if ($conn->multi_query($sql3) === TRUE) {
    echo "New record created successfully : Resultados";
} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}

$parties = json_decode(file_get_contents($api_url . "parties"), true);
 $sql4 = "";
//var_dump($parties);
for($i=0;$i<count($parties);$i++){
  $sql4 .= 'INSERT INTO Parties (id, name, acronym, logo, colour) VALUES ('.$parties[$i]['id'].',"'.$parties[$i]['name'].'","'.$parties[$i]['acronym'].'","'.$parties[$i]['logo'].'","'.$parties[$i]['colour'].'");';
  echo $sql4;
}

if ($conn->multi_query($sql4) === TRUE) {
    echo "New record created successfully : Partidos";
} else {
    echo "Error: " . $sql4 . "<br>" . $conn->error;
}



$conn->close();

*/


include("result.php");
include("district.php");
include("party.php");
include("results.php");
include("parties.php");
include("districts.php");

//$api_url = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

$results = json_decode(file_get_contents($api_url . "results"), true);
$parties = json_decode(file_get_contents($api_url . "parties"), true);

//$districts = json_decode(file_get_contents($api_url . "districts"), true);
//var_dump($parties);
function castParties(&$value, $key)
{
    $value = new party($value["id"], $value["name"], $value["acronym"], $value["logo"], $value["colour"]);
}

function castDistricts(&$value, $key)
{
    $value = new district($value["id"], $value["name"], $value["delegates"]);
}

array_walk($parties, 'castParties');
$parties = new parties($parties);
array_walk($districts, 'castDistricts');
$districts = new districts($districts);

function castResults(&$value, $key)
{
    global $parties;
    global $districts;
    $value = new result($key + 1, $districts->getDistrictByDistrictName($value["district"]), $parties->getPartyByPartyName($value["party"]), $value["votes"]);
}

array_walk($results, 'castResults');
$results = new results($results);
$results->setSeatsByDistricts($districts);

$filterBy = "";
if (isset($_GET["filterBy"])) {
    $filterBy = $_GET["filterBy"];
}
if (isset($_GET["filterBy"]) && $_GET["filterBy"] == "global") {
    $global_results = $results->getGeneralResultsByParties($parties);
}

$query_districtId = "";
if (isset($_GET["district"]) && isset($_GET["filterBy"]) && $_GET["filterBy"] == "districts") {
    $query_districtId = intval($_GET["district"]);
    $query_district = $districts->getDistrictByDistrictId($query_districtId);
    $district_results = $results->getResultsByDistrict($query_district);
}

$query_partyId = "";
if (isset($_GET["party"]) && isset($_GET["filterBy"]) && $_GET["filterBy"] == "parties") {
    $query_partyId = intval($_GET["party"]);
    $query_party = $parties->getPartyByPartyId($query_partyId);
    $party_results = $results->getResultsByParty($query_party);
}

?>

<html lang="es">
<head>
    <title>Election Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="scripts/ammap.js"></script>
    <script type="text/javascript" charset="UTF-8" src="scripts/spainProvincesLow.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        select {
            margin-bottom: 10px;
        }

        body {
            margin: 20px
        }
    </style>
    <script type="text/javascript">
        var map = AmCharts.makeChart("map", {
            "type": "map",
            "pathToImages": "http://www.amcharts.com/lib/3/images/",
            "addClassNames": true,
            "fontSize": 15,
            "color": "#FFFFFF",
            "projection": "mercator",
            "backgroundAlpha": 1,
            "backgroundColor": "rgba(80,80,80,1)",
            "dataProvider": {
                "map": "spainProvincesLow",
                "getAreasFromMap": true,
                "areas": [
                    <?php
                    if ($filterBy == "districts" && $query_districtId != "") {
                        $district_results = $results->getResultsByDistrict($districts->getDistrictByDistrictId($query_districtId));
                        $result_votes = array_map(function ($item) { return $item->getVotes(); }, $district_results);
                        $winner_key = array_search(max($result_votes), $result_votes);
                        $district_winner = $district_results[$winner_key];
                        echo "{'id': " . $query_districtId . ", 'color':'" . $district_winner->getParty()->getColour() . "'}\n";
                    } elseif ($filterBy == "parties" && $query_partyId != "") {
                        foreach ($districts->getDistricts() as $district) {
                            $district_results = $results->getResultsByDistrict($district);
                            $result_votes = array_map(function ($item) { return $item->getVotes(); }, $district_results);
                            $winner_key = array_search(max($result_votes), $result_votes);
                            $district_winner = $district_results[$winner_key];
                            if ($district_winner->getParty()->getId() == $query_partyId) {
                                echo "{'id': " . $district->getId() . ", 'color':'" . $district_winner->getParty()->getColour() . "'},\n";
                            }
                        }
                    } elseif ($filterBy == "global") {
                        foreach ($districts->getDistricts() as $district) {
                            $district_results = $results->getResultsByDistrict($district);
                            $result_votes = array_map(function ($item) { return $item->getVotes(); }, $district_results);
                            $winner_key = array_search(max($result_votes), $result_votes);
                            $district_winner = $district_results[$winner_key];
                            echo "{'id': " . $district->getId() . ", 'color':'" . $district_winner->getParty()->getColour() . "'},\n";
                        }
                    }
                    ?>
                ]
            },
            "balloon": {
                "horizontalPadding": 15,
                "borderAlpha": 0,
                "borderThickness": 1,
                "verticalPadding": 15
            },
            "areasSettings": {
                "color": "rgba(129,129,129,1)",
                "outlineColor": "rgba(80,80,80,1)",
                "rollOverOutlineColor": "rgba(80,80,80,1)",
                "rollOverBrightness": 20,
                "selectedBrightness": 20,
                "selectable": true,
                "unlistedAreasAlpha": 0,
                "unlistedAreasOutlineAlpha": 0
            },
            "imagesSettings": {
                "alpha": 1,
                "color": "rgba(129,129,129,1)",
                "outlineAlpha": 0,
                "rollOverOutlineAlpha": 0,
                "outlineColor": "rgba(80,80,80,1)",
                "rollOverBrightness": 20,
                "selectedBrightness": 20,
                "selectable": true
            },
            "linesSettings": {
                "color": "rgba(129,129,129,1)",
                "selectable": true,
                "rollOverBrightness": 20,
                "selectedBrightness": 20
            },
            "zoomControl": {
                "zoomControlEnabled": true,
                "homeButtonEnabled": false,
                "panControlEnabled": false,
                "right": 38,
                "bottom": 30,
                "minZoomLevel": 0.25,
                "gridHeight": 100,
                "gridAlpha": 0.1,
                "gridBackgroundAlpha": 0,
                "gridColor": "#FFFFFF",
                "draggerAlpha": 1,
                "buttonCornerRadius": 2
            }
        });

        map.addListener("clickMapObject", function (event) {
            $(location).attr('href', "?filterBy=districts&district=" + event.mapObject.id);
        });

        function filterTypeChange() {
            var filterType = document.getElementById("filterBy").value;
            if (filterType == "districts") {
                $("#filterDistrict").removeClass("d-none").addClass("d-block");
                $("#filterParty").removeClass("d-block").addClass("d-none");
            } else if (filterType == "parties") {
                $("#filterParty").removeClass("d-none").addClass("d-block");
                $("#filterDistrict").removeClass("d-block").addClass("d-none");
            } else if (filterType == "") {
                $("#filterParty").removeClass("d-block").addClass("d-none");
                $("#filterDistrict").removeClass("d-block").addClass("d-none");
                $(location).attr('href', "map.php");
            } else if (filterType == "global") {
                $("#filterParty").removeClass("d-block").addClass("d-none");
                $("#filterDistrict").removeClass("d-block").addClass("d-none");
                filter();
            }
        }

        function filter() {
            $("#filterForm").submit();
        }
    </script>
</head>
<body>
<div id="map" style="width: 100%; height: 350px;margin-bottom: 20px"></div>
<form action="map.php" method="get" id="filterForm">
    <div class="form-group">
        <select class="form-control" name="filterBy" id="filterBy" onchange="filterTypeChange()">
            <option value="">Seleccionar filtrado</option>
            <option value="global" <?php echo($filterBy == "global" ? "selected" : "") ?>>Resultados generales</option>
            <option value="districts" <?php echo($filterBy == "districts" ? "selected" : "") ?>>Filtrar por provincia
            </option>
            <option value="parties" <?php echo($filterBy == "parties" ? "selected" : "") ?>>Filtrar por partido</option>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control <?php echo($filterBy == "districts" ? "" : "d-none") ?>" name="district"
                id="filterDistrict" onchange="filter()">
            <?php
            echo "<option value=''>Selecciona una circumscripci??n</option>\n";
            foreach ($districts->getDistricts() as $district) {
                echo "<option " . ($query_districtId == $district->getId() ? "selected" : "") . " value='" . $district->getId() . "'>" . $district->getName() . "</option>\n";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control <?php echo($filterBy == "parties" ? "" : "d-none") ?>" name="party" id="filterParty"
                onchange="filter()">
            <?php
            echo "<option value=''>Selecciona un partido</option>\n";
            foreach ($parties->getParties() as $party) {
                echo "<option " . ($query_partyId == $party->getId() ? "selected" : "") . " value='" . $party->getId() . "'>" . $party->getName() . "</option>\n";
            }
            ?>
        </select>
    </div>
    <input class="d-none" type="submit" value="Filtra"/>
</form>
<table class="table table-striped" id="districtsTable">
    <?php
    if (isset($_GET["district"]) && isset($_GET["filterBy"]) && $_GET["filterBy"] == "districts") {
        echo "<thead><tr><th scope='col'>Circumscripci??n</th><th scope='col'>Partido</th><th scope='col'>Votos</th><th scope='col'>Esca??os</th></tr></thead>\n";
        echo "<tbody>\n";
        foreach ($district_results as $district_result) {
            echo "<tr><td>" . $district_result->getDistrict()->getName() . "</td><td><img src='" . $district_result->getParty()->getLogo() . "' alt='logo' height='25px'/> <strong>" . $district_result->getParty()->getAcronym() . "</strong> - " . $district_result->getParty()->getName() . "</td><td>" . $district_result->getVotes() . "</td><td>" . $district_result->getSeats() . "</td></tr>\n";
        }
        echo "</tbody>\n";
    }
    ?>
</table>
<table class="table table-striped" id="partiesTable">
    <?php
    if (isset($_GET["party"]) && isset($_GET["filterBy"]) && $_GET["filterBy"] == "parties") {
        echo "<thead><tr><th scope='col'>Circumscripci??n</th><th scope='col'>Partido</th><th scope='col'>Votos</th><th scope='col'>Esca??os</th></tr></thead>\n";
        echo "<tbody>\n";
        foreach ($party_results as $party_result) {
            echo "<tr><td>" . $party_result->getDistrict()->getName() . "</td><td><img src='" . $party_result->getParty()->getLogo() . "' alt='logo' height='25px'/> <strong>" . $party_result->getParty()->getAcronym() . "</strong> - " . $party_result->getParty()->getName() . "</td><td>" . $party_result->getVotes() . "</td><td>" . $party_result->getSeats() . "</td></tr>\n";
        }
        echo "</tbody>\n";
    }
    ?>
</table>

<table class="table table-striped" id="globalTable">
    <?php
    if (isset($_GET["filterBy"]) && $_GET["filterBy"] == "global") {
        echo "<thead><tr><th scope='col'>Circumscripci??n</th><th scope='col'>Partido</th><th scope='col'>Votos</th><th scope='col'>Esca??os</th></tr></thead>\n";
        echo "<tbody>\n";
        foreach ($global_results as $global_result) {
            echo "<tr><td>" . $global_result->getDistrict()->getName() . "</td><td><img src='" . $global_result->getParty()->getLogo() . "' alt='logo' height='25px'/> <strong>" . $global_result->getParty()->getAcronym() . "</strong> - " . $global_result->getParty()->getName() . "</td><td>" . $global_result->getVotes() . "</td><td>" . $global_result->getSeats() . "</td></tr>\n";
        }
        echo "</tbody>\n";
    }
    ?>
</table>

</body>