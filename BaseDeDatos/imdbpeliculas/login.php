<?php

//Iniciamos una sesion o reanumados la existente.
session_start();

require 'DBUsers.php';

global $conne;

if (!empty($_POST['usuario']) && !empty($_POST['password'])){
    $sql = 'SELECT id, usuario, password from imdbUsuarios WHERE usuario=:usuario';
    $registros = $conne->prepare($sql);
    //La funcion bindParam permite vincular un parametro al nombre de la variable especificado
    $registros->bindParam(':usuario', $_POST['usuario']);
    $registros->execute();
    $resultados = $registros->fetch(PDO::FETCH_ASSOC);

    $message = "";

    //El metodo password_verify comprueba que la contraseña coincida con un hash.
    //El hash de la contraseña se almacena en $resultados, con el acceso a la BD y mediante el fetch asociativo a la password
    if(count($resultados) > 0 && password_verify($_POST['password'], $resultados['password'])){

        $_SESSION['user_id'] = $resultados['id'];
        //Enviamos mensaje de usuario correcto.
        $message = "Conectado satisfactoriamente";
    } else{
        $message = "Credenciales erróneas";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
    <style>
        /* General */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            text-align: center;
        }

        /* Input Forms*/
        input[type="text"], input[type="password"]{
            outline: none;
            padding: 20px;
            display: block;
            width: 300px;
            border-radius: 3px;
            border: 1px solid #eee;
            margin: 20px auto;
        }

        input[type="submit"] {
            padding: 10px;
            color: #fff;
            background: #0098cb;
            width: 320px;
            margin: 20px auto;
            margin-top: 0;
            border: 0;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #00b8eb;
        }

        /* Header */
        header {
            border-bottom: 2px solid #eee;
            padding: 20px 0;
            margin-bottom: 10px;
            width: 100%;
            text-align: center;
        }
        header a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
<header>
    <a href="main.php">Ver películas</a>
</header>
<?php if(!empty($message)):   ?>
    <p> <?= $message ?></p>
<?php endif; ?>

<h1>Login</h1>

    <form action="login.php" method="post">
        <input type="text" name="usuario" placeholder="Usuario">
        <input type="password" name="password" placeholder="Contraseña">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>