<?php 

    require_once("Conexion.php");

    class Login {

        public function validarDatos($usu, $pass) {

            try {
                $con = null;
                $sql = null;
                $resultado = null;
                $cantidad_resultado = null;

                // Recuperamos la conexión
                $con = Conexion::getConection();

                // Validación de error
                if ($con == "ERROR") {
                    header("location:CtrlSalir.php");
                }

                // Consulta
                $sql = "SELECT * FROM usuarios WHERE usuario = :USU AND pass = :PASS";

                $resultado = $con->prepare($sql);
                $resultado->execute(array(":USU"=>$usu, ":PASS"=>$pass));

                $cantidad_resultado = $resultado->rowCount();

                session_start();

                if ($cantidad_resultado == 1) {
                    $_SESSION["usu"] = $usu;
                    $_SESSION["pass"] = $pass;  

                } else {
                    $_SESSION["error"] = "ERROR";

                }

                
            } catch (Exception $e) {


            } finally {

                $con = null;
                $sql = null;
                $resultado = null;
                $cantidad_resultado = null;

                header("location:../index.php");

            }

        }

    }
?>