<html lang="es">
<head>
    <title>Christmas tree</title>
</head>
<body>
<form method="post" action="christmas_tree2.php">
    <label>
        Number of flats:
        <input type="text" name="numFlats"/>
    </label>
    <input type="submit"/>
</form>
<div style="background-color: skyblue; display: inline-block;">
    <?php
    if (isset($_POST["numFlats"])) {
        $numflats = intval($_POST["numFlats"]);
        for($l=0; $l<$numflats*2+1; $l++ ){
            echo "<span style='color: skyblue'>*</span>";
        }
        echo "<br>";
        /* Primero hacemos un bucle para cada piso con lógica inversa.*/
        for($i=$numflats; $i>0; $i--){
            /* El primer bucle que hacemos es de hacer un bucle de los espacios en blanco escribiendo los asteriscos de este color*/
            /* En cada inicio de piso la J sera mas pequeña, hasta que lleguemos a 0. */
            for($j=$i; $j>0; $j--){
                echo "<span style='color: skyblue'>*</span>";
            }
            /* La k se ira a mas, ya que cada vez queremos escrbir mas asteriscos. En este caso, nos vamos hacia numFlats. */
            /* La segunda vez se ejecuta 1 vez, la 3 se ejecuta 2 veces... y asi, la primera no se va a ejecutar, ya que K es igual a numflats (k = i) */
            for($k = $i; $k<$numflats;$k++){
                echo "<span style='color: forestgreen'>*</span>";
            }
            echo "<span style='color: forestgreen'>*</span>";
            for($k = $i; $k<$numflats;$k++){
                echo "<span style='color: forestgreen'>*</span>";
            }
            /* El bucle de abajo tampoco es necesario, es para hacer el fondo azul y el bucle es el mismo que el primero*/
            for($j=$i; $j>0; $j--){
                echo "<span style='color: skyblue'>*</span>";
            }
            echo "<br>";
        }
        /* El bucle de abajo no importa, pero es para hacer la base de los asteriscos */
        for($l=0; $l<$numflats*2+1; $l++ ){
            echo "<span style='color: skyblue'>*</span>";
        }
    }
    ?>
</div>
</body>
</html>
