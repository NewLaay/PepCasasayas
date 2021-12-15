<?php

require 'DBUsers.php';

global $conne;

$message = "";
    if (!empty($_POST['usuario']) && !empty($_POST['password'])){
        $sql = "INSERT INTO imdbUsuarios (usuario,password) VALUES (:usuario, :password)";
        //La funcion prepare prepara una sentencia SQL que sera ejecutada con la sentencia execute
        $stmt = $conne->prepare($sql);
        //La funcion bindParam permite vincular un parametro al nombre de la variable especificado
        $stmt->bindParam(':usuario',$_POST['usuario']);
        //Password_hash permite crear un hash de contraseña y usamos el algoritmo BYCRYPT para crear el hash
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password',$password);

        //La funcion execute es la encargada de ejecutar la sentencia preparada.
        if ($stmt->execute()){
            $message = 'Nuevo usuario creado.';
        } else{
            $message = 'Ha ocurrido un error.';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regístrate</title>
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
<?php require 'DBUsers.php' ?>

<?php if(!empty($message)):   ?>
<p> <?= $message ?></p>
<?php endif; ?>

<header>
    <a href="main.php">Ver películas</a>
</header>
<h1>Regístrate</h1>
<form action="signup.php" method="post">
    <input type="text" name="usuario" placeholder="Usuario">
    <input type="password" name="password" placeholder="Contraseña">
    <input type="password" name="confirm_password" placeholder="Confirmar contraseña">
    <input type="submit" value="Enviar">
</form>
</body>
</html>