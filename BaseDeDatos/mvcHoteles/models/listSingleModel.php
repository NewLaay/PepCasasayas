<?php

include_once "../entities/hotel.php";
include_once "../db/dbo.php";

class listSingleModel
{

    private dbo $db;

    public function __construct(){
        $this->db = new dbo();
    }

    public function getHotel($id) :hotel{
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
    }

}