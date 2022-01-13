<?php

/* En el modelo es donde se hacen las operaciones necesarias
En este punto es donde realizamos la conexion y sacamos todas las propiedades que necesitamos de los hoteles .
El controlador nos servira para detectar la iteracion que realiza el usuario*/

include_once "../entities/hotel.php";
include_once "../db/dbo.php";

class listModel
{

    //En este punto realizamos la conexion a la base de datos
    private dbo $db;

    public function __construct(){
        $this->db = new dbo();
    }

    //En este punto creamos la conexion y la query para seleccionar listado de hoteles.
    /*public function getHotel($id): hotel{
        $sql = "SELECT * FROM mvcHoteles where id = " . $id;
        //Recordamos que db tiene una funcion default que nos conecta con las variables definidas anteriormente
        $this->db->default();
        //La funcion query ejecuta la sentencia SQL devolviendo un conjunto de resultados
        $query = $this->db->query($sql);
        //Cerramos la sesion.
        $this->db->close();
        //Fetch assoc permite recuperar los resultados en forma de array asociativo
        $result = $query->fetch_assoc();
        //Creamos el return y lo devolvemos como variable de un objeto.
        $return = new hotel($result["id"],$result["nombre"],$result["imagen"],$result["descripcion"],$result["cadena"],$result["habitaciones"],$result["estrellas"],$result["localidad"]);
        return $return;
    }*/

    //Funcion de getHoteles a partir del objeto Hotel y retornando todos los valores.
    public function getHoteles(): array{
        $sql = "SELECT * FROM mvcHoteles;";
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $return = array();
        while ($result = $query->fetch_assoc()){
            $return [] = new hotel($result["id"],$result["nombre"],$result["imagen"],$result["descripcion"],$result["cadena"],$result["habitaciones"],$result["estrellas"],$result["localidad"]);
        }
        return $return;
    }

    //Funcion para sacar un listado de todos los hoteles(menos optima obv, luego habria que crear el objeto -- mas rapido y optimo arriba)
   /* public function getHoteles(){
        $resultado = [];
        $sql = "SELECT * FROM mvcHoteles";
        $resultados = $this->db->query($sql);

        for($i = 0; $fila = $resultados->fetch_assoc(); $i++){
            $resultado[$i]["id"] = $fila["id"];
            $resultado[$i]["nombre"] = $fila["nombre"];
            $resultado[$i]["imagen"] = $fila["imagen"];
            $resultado[$i]["desripcion"] = $fila["descripcion"];
            $resultado[$i]["cadena"] = $fila["cadena"];
            $resultado[$i]["habitaciones"] = $fila["habitaciones"];
            $resultado[$i]["estrellas"] = $fila["estrellas"];
            $resultado[$i]["localidad"] = $fila["localidad"];
        }
        return $resultado;
    } */

}



