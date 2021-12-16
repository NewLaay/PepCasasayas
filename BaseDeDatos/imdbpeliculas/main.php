
<?php

    //Asignacion de usuario
    session_start();
    require 'DBUsers.php';

    global $conne;

    if(isset($_SESSION['user_id'])){
        $resultados = $conne->prepare('SELECT id, usuario, password FROM imdbUsuarios WHERE id = :id');
        $resultados->bindParam(':id',$_SESSION['user_id']);
        $resultados->execute();
        $resultados = $resultados->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($resultados)>0){
            $user = $resultados;
        }
    }

?>




<!-- HTML copiado de la solución -->

<html lang="es">
<head>
    <title>IMDB - Peliculas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        body{
           background: gray;
        }
        table, th, td {
            border: 2px solid black;
            padding-left: 12px;
            padding-right: 12px;
            color: black;
            margin: auto;
        }

        th{
            color: yellow !important;
        }

        h1{
            text-align: center;
            font-family: "Droid Sans Mono";
            color: yellow;
            font-weight: bold;
        }

        form{
            border 1px solid;
        }

        a{
            text-align: right;
        }

    </style>
</head>
<body>
<h1> Películas Must See </h1>

<?php if(!empty($user)): ?>
<br>Bienvenido:  <?= $user['usuario'] ?>
<br>Estas logeado correctamente.
<a href="logout.php">Logout</a>
<?php else : ?>
<a href="login.php">Login</a> or
<a href="signup.php">Signup</a>
<?php endif; ?>
<form method="post" action="main.php" >
    <select name="filterBy" id="filterBy" onchange="filterTypeChange()">
        <option selected value='principal'>Selecciona un tipo de filtro</option>
        <option  value='calificacion'>Por calificación</option>
        <option  value='fecha'>Por fecha</option>
    </select>
    <button class="btn btn-outline-success" type="submit">Filtra</button>
</form>
<table>

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

    $peliculasBDCalificacion = DatosPeliculasCalificacion();
    //var_dump($peliculasBDCalificacion);

    $peliculasBDFecha = DatosPeliculasFechaEstreno();
    //var_dump($peliculasBDFecha);

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
            $peliculas[$i] = new Peliculas($peliculasBD[$i]["id"],$peliculasBD[$i]["nombre"],$peliculasBD[$i]["calificacion"],$peliculasBD[$i]["imagen"],$peliculasBD[$i]["fechaEstreno"],$peliculasBD[$i]["actores"],$peliculasBD[$i]["directores"],$peliculasBD[$i]["genero"],$peliculasBD[$i]["trailer"],$peliculasBD[$i]["sinopsis"]);
        }
        return $peliculas;
    }
    $peliculasObj = [];
    $peliculasObj = crearPeliculas($peliculasBD);
    //var_dump($peliculasObj);

    //Peliculas por calificacion
    $peliculasObjCalificacion = [];
    $peliculasObjCalificacion = crearPeliculas($peliculasBDCalificacion);
   //var_dump($peliculasObjCalificacion);

    //Peliculas por fecha
    $peliculasObjFecha = [];
    $peliculasObjFecha = crearPeliculas($peliculasBDFecha);
    //var_dump($peliculasObjFecha);


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

    $peliculasMapeadasCalificacion = mapeoPeliculas($peliculasObjCalificacion, $actoresObj, $directoresObj, $generosObj);
    //var_dump($peliculasMapeadasCalificacion);

    $peliculasMapeadasFecha = mapeoPeliculas($peliculasObjFecha, $actoresObj, $directoresObj, $generosObj);
    //var_dump($peliculasMapeadasFecha);

    //RENDERIZADO.
    function render($peliculasObj)
    {
        echo " <tr>
                    <th>Película</th>
                    <th>Calificación</th>
                    <th>Fecha de estreno</th>
                    <th>Reparto</th>
                    <th>Dirección</th>
                    <th>Género</th>
                    <th>Portada</th>
               </tr>";

        foreach ($peliculasObj as $pel) {
            echo "<tr>";
            echo "<td>", $pel->getNombre(), "</td>";
            echo "<td>", $pel->getCalificacion(), "</td>";
            echo "<td>", $pel->getFechaEstreno(), "</td>";
            echo "<td><ul>";
            foreach ($pel->getActores() as $actor) {
                echo "<li>", $actor, "</li>";
            }
            echo "</ul></td>";
            echo "<td><ul>";
            foreach ($pel->getDirectores() as $director) {
                echo "<li>", $director, "</li>";
            }
            echo "</ul></td>";
            echo "<td><ul>";
            foreach ($pel->getGenero() as $genero) {
                echo "<li>", $genero, "</li>";
            }
            echo "</ul></td>";
            echo "<td><a href='render2.php?id=" . $pel->getId() . "' target='_blank'><img src='imagenes/", $pel->getImagen(), "'></a></td>";
            echo "</tr>";
        }
    }

    //RENDER ALEATORIO
    //render($peliculasObj);
    //RENDER CALIFICACION
    //render($peliculasObjCalificacion);
    //RENDER FECHA DE ESTRENO
    //render($peliculasObjFecha);


//Esto será segunda parte de proyecto.
     if(isset($_POST["filterBy"])) {
         switch ($_POST["filterBy"]) {
             case "principal":
                 render($peliculasObj);
                 break;
             case "calificacion":
                 render($peliculasObjCalificacion);
                 break;
             case "fecha":
                 render($peliculasObjFecha);
                 break;
         }

     }

    ?>
