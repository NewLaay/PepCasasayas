
<?php

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

//Sacamos la ID de la pelicula elegida(clicando la imagen).
if (isset($_GET["id"])){
    $movieElegida = $_GET["id"];
}

if(isset($_POST['submit'])){
    $textAreaValue = trim($_POST['content']);

    //Insertar comentario, usuario y id de la pelicula.
    $sql = "Insert into imdbComentarios (comentario, usuario, idPeli) values (".$textAreaValue.",".$user.",".$movieElegida.")";
    $rs = mysqli_query($conne,$sql);
    $affectedRows = mysqli_affected_rows($conne);

    if($affectedRows == 1){
        $successMsg = "Comentario añadido con éxito";
    }
}

include_once "Actores.php";
include_once "DB.php";
include_once "Directores.php";
include_once "Generos.php";
//include_once "main.php";
include_once "Peliculas.php";
include_once "funcionesGenerales.php";

//Sacamos la ID de la pelicula elegida(clicando la imagen).
if (isset($_GET["id"])){
    $movieElegida = $_GET["id"];
}

//Hacer la conexion a BD con un WHERE para hacer la conexion y que con el select en vez de coger todos nos coja el del ID que le pasamos
$peliculaBDEscogida = DatosPelicula($movieElegida);
//var_dump($peliculaBDEscogida);


//Creamos el objeto
function crearPelicula($peliculaBDEscogida){
    for($i = 0; $i<count($peliculaBDEscogida); $i++){
        $peliculas[$i] = new Peliculas($peliculaBDEscogida[$i]["id"],$peliculaBDEscogida[$i]["nombre"],$peliculaBDEscogida[$i]["calificacion"],$peliculaBDEscogida[$i]["imagen"],$peliculaBDEscogida[$i]["fechaEstreno"],$peliculaBDEscogida[$i]["actores"],$peliculaBDEscogida[$i]["directores"],$peliculaBDEscogida[$i]["genero"],$peliculaBDEscogida[$i]["trailer"],$peliculaBDEscogida[$i]["sinopsis"]);
    }
    return $peliculas;
}
$peliculaObj = [];
$peliculaObj = crearPelicula($peliculaBDEscogida);
//var_dump($peliculaObj);


//Hacemos el mapeo del objeto escogido
function mapeoPelicula(){

    global $peliculaObj;
    global $actoresObj;
    global $directoresObj;
    global $generosObj;
    //Bucle FOR para cada pelicula.
    for($i = 0; $i<count($peliculaObj);$i++){
        $nombreActores = array();
        $nombreDirectores = array();
        $nombreGeneros = array();
        //Bucle for para recorrer actores de cada pelicula y asignar nombre y apellidos cuando el id sea el mismo.
        for($j = 0; $j<count($actoresObj);$j++){
            for($k = 0; $k<count($peliculaObj[$i]->getActores());$k++){
                if($peliculaObj[$i]->getActores()[$k] == $actoresObj[$j]->getId()){
                    $nombreActores[$k] = $actoresObj[$j]->getNombre().  " ". $actoresObj[$j]->getApellidos();
                }
            }
        }
        $peliculaObj[$i]->setActores($nombreActores);

        //Bucle for para recorrer directores de cada pelicula y asignar nombre y apellidos.
        for($j = 0; $j<count($directoresObj);$j++){
            for($k = 0; $k<count($peliculaObj[$i]->getDirectores());$k++){
                if($peliculaObj[$i]->getDirectores()[$k] == $directoresObj[$j]->getId()){
                    $nombreDirectores[$k] = $directoresObj[$j]->getNombre(). " ". $directoresObj[$j]->getApellidos();
                }
            }
        }
        $peliculaObj[$i]->setDirectores($nombreDirectores);

        //Bucle for para recorrer generos de cada pelicula y asignar generos.
        for($j = 0; $j<count($generosObj);$j++){
            for($k = 0; $k<count($peliculaObj[$i]->getGenero());$k++){
                if($peliculaObj[$i]->getGenero()[$k] == $generosObj[$j]->getId()){
                    $nombreGeneros[$k] = $generosObj[$j]->getTipoGenero();
                }
            }
        }
        $peliculaObj[$i]->setGenero($nombreGeneros);
    }
    return $peliculaObj;

}
$peliculaMapeada = mapeoPelicula();
//var_dump($peliculaMapeada);

?>

<!-- HTML PARA EL RENDER 2 -->

<html lang="es">
<head>
    <title> PELICULA - <?php foreach($peliculaObj as $pel){
            echo $pel->getNombre();
        } ?></title>
    <style>
        body{
            width: 100%;
            height: 100%;
            background:linear-gradient(darkgray,gray);
        }

        h1{
            text-align: center;
            font-family: "Droid Sans Mono";
            color: yellow;
            font-weight: bold;
            font-size: 75px;
        }

        h2{
            text-align: center;
        }

        h3{
            text-align: center;
            box-sizing: border-box;
        }

        .bordeBotones{
            border-radius: 25px;
            box-sizing: content-box;
        }

        h4{
            text-align: center;
            color: lightyellow;
        }

        .contenido{
            width: 100%;
        }

        .columnaActores{
            width: 50%;
            float: left;
            display: inline-block;
            text-align: center;
        }

        .columnaDirectores{
            width: 50%;
            float: right;
            display: inline-block;
            text-align: center;
        }

        .comentarios{
            width: 100%;
            display: inline-block;
            text-align: center;
            color: lightyellow;
        }

        p{
            font-size: xx-large;
            font-weight: bold;
            font-family: "DejaVu Serif";
        }


    </style>

</head>
<body>
<h1><?php
    foreach($peliculaObj as $pel){
        echo $pel->getNombre();
    }?></h1>
<h2>
    <?php
    foreach($peliculaObj as $pel){
        echo "<iframe width='660' height='415' src='".$pel->getTrailer()."' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
    }
    ?>
</h2>
<h3>
    <?php foreach($peliculaObj as $pel){
        foreach($pel->getGenero() as $genero){
            echo "<input type='button' value='$genero'>".'&nbsp&nbsp&nbsp&nbsp&nbsp'."</input>";
        }
        echo $pel->getCalificacion()."/10";
    }; ?>
</h3>
<h4>
    <?php foreach($peliculaObj as $pel){
        echo $pel->getSinopsis();
    }
    ?>
</h4>
<div class="contenido">
    <div class="columnaActores">
        <p>Actores</p>
        <?php
        foreach($peliculaObj as $pel){
            foreach($pel->getActores() as $actor){
                echo $actor."<br>";
            }
        }
        ?>
    </div>
    <div class="columnaDirectores">
        <p><?php
            foreach($peliculaObj as $pel){
                if(count($pel->getDirectores()) > 1){
                    echo "Directores";
                }else{
                    echo "Director";
                }
            }
            ?></p>
        <?php
        foreach($peliculaObj as $pel){
            foreach($pel->getDirectores() as $director){
                echo $director."<br>";
            }
        }
        ?>
    </div>
</div>
<br>
<!-- Solo mostrar comentarios si estas logeado. -->
<?php if(!empty($user)): ?>
<div class="contenido">
    <div class="comentarios">
        <form action="" method="post">
            <label>Comentarios</label><br>
            <textarea cols="150" rows="5" name="comments" id="para1">
            </textarea><br>
            <input type="submit" name="submit" value="Añadir Comentario"/></form>
    </div>
</div>
</body>

<?php endif; ?>

