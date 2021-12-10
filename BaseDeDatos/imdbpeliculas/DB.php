<?php

$localhost = "sql480.main-hosting.eu";
$username = "u850300514_jcasasayas";
$pwd = "x43196836F";
$bdname = "u850300514_jcasasayas";

$conn = new mysqli($localhost, $username, $pwd, $bdname);

if($conn->connect_errno){
    echo "Error al conectar en base de datos.";
}

//Coger los datos de la base de datos.

function DatosActores(){
    global $conn;

    $resultado = [];
    $sql = "SELECT * FROM imdbActores";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        $resultado[$i]["id"] = $fila["id"];
        $resultado[$i]["nombre"] = $fila["nombre"];
        $resultado[$i]["apellidos"] = $fila["apellidos"];
        $resultado[$i]["fechaNacimiento"] = $fila["fechaNacimiento"];
        $resultado[$i]["imagen"] = $fila["imagen"];
        $resultado[$i]["numOscars"] = $fila["numOscars"];
    }
    return $resultado;

}

function DatosDirectores(){
    global $conn;

    $resultado = [];
    $sql = "SELECT * FROM imdbDirectores";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        $resultado[$i]["id"] = $fila["id"];
        $resultado[$i]["nombre"] = $fila["nombre"];
        $resultado[$i]["apellidos"] = $fila["apellidos"];
        $resultado[$i]["fechaNacimiento"] = $fila["fechaNacimiento"];
        $resultado[$i]["imagen"] = $fila["imagen"];
        $resultado[$i]["peliculasRealizadas"] = $fila["peliculasRealizadas"];
    }
    return $resultado;
}

function DatosGenerosPeliculas(){
    global $conn;

    $resultado = [];
    $sql = "SELECT * FROM imdbGeneros";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        $resultado[$i]["id"] = $fila["id"];
        $resultado[$i]["tipoGenero"] = $fila["genero"];
    }
    return $resultado;
}


function DatosPeliculas(){
    global $conn;

    $resultado = [];
    $sql = "SELECT * FROM imdbPeliculas";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        $resultado[$i]["id"] = $fila["id"];
        $resultado[$i]["nombre"] = $fila["nombre"];
        $resultado[$i]["calificacion"] = $fila["calificacion"];
        $resultado[$i]["imagen"] = $fila["imagen"];
        $resultado[$i]["fechaEstreno"] = $fila["fechaEstreno"];
        $resultado[$i]["trailer"] = $fila["trailer"];
        $resultado[$i]["sinopsis"] = $fila["sinopsis"];
     }

    //Incluimos los generos
    $sql = "SELECT * FROM imdbPeliculaGenero";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado);$j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["genero"][] = $fila["gen_id"];
            }
        }
    }


    //Incluimos los actores
    $sql = "SELECT * FROM imdbPeliculaActores";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado); $j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["actores"][] = $fila["act_id"];
            }
        }
    }

    //Incluimos los directores
    $sql = "SELECT * FROM imdbPeliculaDirector";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado); $j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["directores"][] = $fila["dir_id"];
            }
        }
    }
    return $resultado;
}

//Hacemos la conexion para una sola pagina y mostrar en render2.
function DatosPelicula($id){
    global $conn;

    $resultado = [];
    $sql = "SELECT * FROM imdbPeliculas where id = " .$id;
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        $resultado[$i]["id"] = $fila["id"];
        $resultado[$i]["nombre"] = $fila["nombre"];
        $resultado[$i]["calificacion"] = $fila["calificacion"];
        $resultado[$i]["imagen"] = $fila["imagen"];
        $resultado[$i]["fechaEstreno"] = $fila["fechaEstreno"];
        $resultado[$i]["trailer"] = $fila["trailer"];
        $resultado[$i]["sinopsis"] = $fila["sinopsis"];
    }

    //Incluimos los generos
    $sql = "SELECT * FROM imdbPeliculaGenero ";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado);$j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["genero"][] = $fila["gen_id"];
            }
        }
    }


    //Incluimos los actores
    $sql = "SELECT * FROM imdbPeliculaActores ";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado); $j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["actores"][] = $fila["act_id"];
            }
        }
    }

    //Incluimos los directores
    $sql = "SELECT * FROM imdbPeliculaDirector  ";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado); $j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["directores"][] = $fila["dir_id"];
            }
        }
    }
    return $resultado;

}

//Metemos order by para ordenar por calificacion.
function DatosPeliculasCalificacion(){
    global $conn;

    $resultado = [];
    $sql = "SELECT * FROM imdbPeliculas order by calificacion desc";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        $resultado[$i]["id"] = $fila["id"];
        $resultado[$i]["nombre"] = $fila["nombre"];
        $resultado[$i]["calificacion"] = $fila["calificacion"];
        $resultado[$i]["imagen"] = $fila["imagen"];
        $resultado[$i]["fechaEstreno"] = $fila["fechaEstreno"];
        $resultado[$i]["trailer"] = $fila["trailer"];
        $resultado[$i]["sinopsis"] = $fila["sinopsis"];
    }

    //Incluimos los generos
    $sql = "SELECT * FROM imdbPeliculaGenero";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado);$j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["genero"][] = $fila["gen_id"];
            }
        }
    }


    //Incluimos los actores
    $sql = "SELECT * FROM imdbPeliculaActores";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado); $j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["actores"][] = $fila["act_id"];
            }
        }
    }

    //Incluimos los directores
    $sql = "SELECT * FROM imdbPeliculaDirector";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado); $j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["directores"][] = $fila["dir_id"];
            }
        }
    }
    return $resultado;
}

function DatosPeliculasFechaEstreno(){
    global $conn;

    $resultado = [];
    $sql = "SELECT * FROM imdbPeliculas order by fechaEstreno desc";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        $resultado[$i]["id"] = $fila["id"];
        $resultado[$i]["nombre"] = $fila["nombre"];
        $resultado[$i]["calificacion"] = $fila["calificacion"];
        $resultado[$i]["imagen"] = $fila["imagen"];
        $resultado[$i]["fechaEstreno"] = $fila["fechaEstreno"];
        $resultado[$i]["trailer"] = $fila["trailer"];
        $resultado[$i]["sinopsis"] = $fila["sinopsis"];
    }

    //Incluimos los generos
    $sql = "SELECT * FROM imdbPeliculaGenero";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado);$j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["genero"][] = $fila["gen_id"];
            }
        }
    }


    //Incluimos los actores
    $sql = "SELECT * FROM imdbPeliculaActores";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado); $j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["actores"][] = $fila["act_id"];
            }
        }
    }

    //Incluimos los directores
    $sql = "SELECT * FROM imdbPeliculaDirector";
    $resultados = $conn->query($sql);

    for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
        for($j = 0; $j<count($resultado); $j++){
            if($fila["pel_id"] == $resultado[$j]["id"]){
                $resultado[$j]["directores"][] = $fila["dir_id"];
            }
        }
    }
    return $resultado;
}

/* Creacion de las tablas para el control de los usuarios.
Lo hacemos directamente en el WorkBench (copiamos la sentencia)


CREATE TABLE imdbComentarios(
id int NOT NULL,
comentario varchar(255),
idUser int NOT NULL,
idPeli int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (idUser) REFERENCES imdbUsuarios(id),
FOREIGN KEY (idPeli) REFERENCES imdbPeliculas(id)
)

LA TABLA VOTOS SOLO ACEPTARA VOTOS ENTEROS DEL 0 AL 10. (LO TENEMOS QUE HACER A LA HORA DE METER LOS INSERTS)
CREATE TABLE imdbVotos(
id int NOT NULL,
voto int,
idUser int NOT NULL,
idPeli int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (idUser) REFERENCES imdbUsuarios(id),
FOREIGN KEY (idPeli) REFERENCES imdbPeliculas(id)
)