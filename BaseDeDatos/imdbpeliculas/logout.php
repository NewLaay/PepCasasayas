<?php

session_start();

//unset sirve para liberar todas las variables de la sesion
session_unset();

//destruye toda la informacion registrada de una sesion
session_destroy();
?>


<a href="main.php">Ver películas</a>
<h1>Desconectado satisfactoriamente.</h1>