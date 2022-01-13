<?php

include_once "../entities/hotel.php";
include_once "../db/dbo.php";

class listSingleModel
{

    private dbo $db;

    public function __construct(){
        $this->db = new dbo();
    }

    public function getHotel($id){
        $resultado = [];
        $sql = "SEECT * FROM mvcHoteles where id = " . $id;
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
    }

}