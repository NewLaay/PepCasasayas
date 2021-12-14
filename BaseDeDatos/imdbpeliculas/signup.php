<?php
   require 'DBUsers.php';
    global $conne;
    $message = "";

    if (!empty($_POST['usuario']) && !empty($_POST['password'])){
        $sql = "INSERT INTO imdbUsuarios (usuario,password) VALUES (:usuario, :password)";
        $stmt = $conne->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password',$password);

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


<?php if(!empty($message)):   ?>
<p> <?php $message ?></p>
<?php endif; ?>

<header>
    <a href="main.php">Ver películas</a>
</header>
<h1>Regístrate</h1>
<form action="signup.php" method="post">
    <input type="text" name="usuario" placeholder="Usuario">
    <input type="password" name="contraseña" placeholder="Contraseña">
    <input type="password" name="confirm_contraseña" placeholder="Confirmar contraseña">
    <input type="submit" value="Enviar">
</form>
</body>
</html>