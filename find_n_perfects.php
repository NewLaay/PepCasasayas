<html lang="es">
<head>
    <title>Find N perfect numbers</title>
</head>
<body>
<form method="post" action="find_n_perfects.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div>



    <?php

    /* Un numero perfecto es igual a la suma de divisores */

    function getDivisors($num){
        $divisores = array();

            for($i=1; $i<$num; $i++){
                if($num%$i == 0){
                $divisores[]=$i;
                }
            }
            return $divisores;
        }


    function isPerfectNum($num){
      $contador = 0;
      /*Un numero es perfecto si su número es el mismo a la suma de sus divisores.*/
        /* Contador pasa a ser el contador de los N primeros numeros introducidos por $num (por tanto sacamos los N primeros numeros)*/
      for($i=1; $contador<$num; $i++){

          if(array_sum(getDivisors($i)) == $i){
            /*Aqui hacemos la condicion: la suma de los divisores del numero $i tiene que ser igual al numero $i, y si lo es es Perfecto*/
            /* Establecemos $i en 1 y de ahi vamos mirando uno a uno si es un numero perfecto.*/
              echo "<br>"."- ".$i;
              $contador++;
              /* Aumentamos el contador para sacar los primeros numeros introducidos por la maquina*/
          }

      }
    }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        /*Aqui simplemente imprimimos el resultado */
        echo "Los ".$num." primeros números perfectos son: ";
        isPerfectNum($num);
    }
    ?>
</div>
</body>
</html>