<?php 

    session_start();
    if (isset($_SESSION["usu"]) && isset($_SESSION["pass"])) {
        
        require_once("modelo/Validar.php");
        $validar = new Validar();
        $validar->validarDatos();

        include_once("vista/principal.php");
        
    } else {

        if (isset($_SESSION["error"])) {
        
            echo "<p>Usuario y/o contraseña incorrecto</p>";
            unset($_SESSION["error"]);
    
        }

        include_once("vista/login.php");
    }
?>