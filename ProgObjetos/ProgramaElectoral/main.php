<!-- HTML copiado de la solución -->

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
<form method="post" action="main.php" >
    <select name="num" id="result">
        <option value='0'>Selecciona una circumscripción</option>
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
    <?php

    include("Resultado.php");
    include("Party.php");
    include("District.php");

    $api_url = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

    $resultadosjson = json_decode(file_get_contents($api_url . "results"), true);
    $partidosjson = json_decode(file_get_contents($api_url . "parties"), true);
    $distritosjson = json_decode(file_get_contents($api_url . "districts"), true);

    //Creacion de los arrays de objetos de resultados, partidos y resultados.
    function crearDistritos($distritosjson){
        $distritos = array();
        for($i=0;$i<count($distritosjson);$i++){
            $distritos[$i] = new District($distritosjson[$i]["id"],$distritosjson[$i]["name"],$distritosjson[$i]["delegates"]);
        }
        return $distritos;
    }

    function crearPartidos($partidosjson){
        $partidos = array();
        for($i=0;$i<count($partidosjson);$i++){
            $partidos[$i] = new Party($partidosjson[$i]["id"],$partidosjson[$i]["name"],$partidosjson[$i]["acronym"],$partidosjson[$i]["logo"]);
        }
        return $partidos;
    }

    function crearResultados($resultadosjson){
        $resultados = array();
        for($i=0;$i<count($resultadosjson);$i++){
            $resultados[$i] = new Resultado($resultadosjson[$i]["district"],$resultadosjson[$i]["party"],$resultadosjson[$i]["votes"],0,0);
        }
        return $resultados;
    }

    //Llamada a la funcion para crear los arrays.
    $distritos = crearDistritos($distritosjson);
    $partidos = crearPartidos($partidosjson);
    $resultados = crearResultados($resultadosjson);


    // AsignarEscaños segun ley dHont a las Provincias.
    // https://es.wikipedia.org/wiki/Sistema_D%27Hondt
    function asignarEscanosProvincia()
    {
        global $resultados; //se modificaran sus atributos: $seats y $votesTemp
        global $distritos; //Aqui estan los asientos disponibles p/ cada provincia y su id.


        //Recorrer todas las provincias y guardar su nombre y su número de escaños posibles (definido en delegates)
        foreach ($distritos as $distrito) {
            $distritoElegido = $distrito->getName();
            $numeroEscanos = $distrito->getDelegates();
            //Creamos contador para evitar superar el maximo de escaños permitidos para cada provincia
            $contadorEscanos = 0;
            //Creamos array para almacenar los resultados de cada provincia
            $resultadosDistrito = array();

            //Guardar los resultados del distrito elegido
            foreach ($resultados as $resultado) {
                if ($resultado->getDistrict() == $distritoElegido) {
                    $resultadosDistrito[] = $resultado;
                }
            }

            //Asignacion de escaños hasta que lleguemos al máximo de cada provincia.
            while ($contadorEscanos < $numeroEscanos) {
                //En este punto se aplica la Ley d'Hont.
                // cociente = V / (s+1) .
                // V representa el numero total de votos recibidos por la lista y s el número de escaños que se lleva de momento (inicialmente 0)
                // Tenemos que recorrer el array de resultadosDistrito y asignar el cociente a votosEscanos segun formula:
                foreach ($resultadosDistrito as $resultado) {
                    $resultado->setVotosEscanos($resultado->getVotes() / ($resultado->getEscanos() + 1));
                }
                //Ahora lo que haremos es ordenar el array de resultados en funcion de VotosEscanos.
                // De esta manera, cada escaño que repartamos sera el que esté en la posicion 0 despues de la ordenacion
                // que será el que más votos tenga cada vez que se haya repartido el escaño
                for ($i = 0; $i < count($resultadosDistrito); $i++) {
                    for ($j = $i + 1; $j < count($resultadosDistrito); $j++) {
                        if ($resultadosDistrito[$i]->getVotosEscanos() < $resultadosDistrito[$j]->getVotosEscanos()) {
                            $aux = $resultadosDistrito[$j];
                            $resultadosDistrito[$j] = $resultadosDistrito[$i];
                            $resultadosDistrito[$i] = $aux;
                        }
                    }
                }

                //Añadimos el escaño alque tenga mas votos y añadimos uno al contador de escaños
                $resultadosDistrito[0]->setEscanos($resultadosDistrito[0]->getEscanos() + 1);
                $contadorEscanos++;

            }
        }
    }

    asignarEscanosProvincia();

    //Creacion del formulario para mostrar por pantalla según la opción elegida
    if (isset($_POST["num"])) {
        //Condicion de que sea mayor que 0, ya que el num 0 es "Seleeciona una circumscripcion y en ese caso no mostramos nada
        if ($_POST["num"] > 0) {

            $numElegido = ($_POST["num"]);
            $nombreDistrito = "";

            //Determinar el nombre del distrito.
            foreach ($distritos as $distrito) {
                if ($distrito->getId() == $numElegido) {
                    $nombreDistrito = $distrito->getName();
                    break;
                }
            }
            //Imprimir por pantalla la tabla de los resultados elegidos
            echo " <tr>
                    <th>Circumscripción</th>
                    <th>Partido</th>
                    <th>Votos</th>
                    <th>Escaños</th>
               </tr>";
            foreach ($resultados as $resultado) {
                if ($resultado->getDistrict() == $nombreDistrito) {
                    echo "<tr><td>", $nombreDistrito, "</td><td>",  $resultado->getParty(), "</td><td>", $resultado->getVotes(), "</td><td>", $resultado->getEscanos(), "</td></tr>";
                }
            }
        }

    }

    // Asignar los escaños totales que tiene un determinado partido.
  /*  function asignarEscanosPartido(){
        global $resultados;
        global $partidos;
        global $distritos;

        // Recorrer todos los partidos y guardar su nombre y los escaños totales (que será la suma total de escaños del partido en cada provincia)
        foreach ($partidos as $partido){
            $partidoElegido = $partido->getName();
            $sumaEscanos = 0; // Creamos variable que sumará el total de escaños de cada partido.
            foreach($resultados as $resultado) {
                if ($resultado->getParty() == $partidoElegido) {
                    $sumaEscanos[] = $resultado; //Guardamos los resultados de cada partido.
                }
            }
        }

    }

    // asignarEscanosPartido(); */

    ?>
