<html lang="es">
<head>
    <title>Find N prime numbers</title>
</head>
<body>
<form method="post" action="find_n_primes2.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php
    function getDivisors($num){

        $divisores = 0;

        for($i = 1; $i < $num; $i ++) {
            if ($num % $i == 0) {
                $divisores++;
                /* Aqui buscamos el numero de divisores que tiene un numero determinado. Un numero sera primo si tiene menos de 2 divisores.*/
            }
        }
        return $divisores;
        /* Devolvemos el número de divisores que tiene un número determinado.*/
    }

    function isPrimeNum($num){

        $count = 0;

        for($i = 2; $count < $num;$i++){
            if (getDivisors($i) == 1){
                /* Si el numero del bucle tiene 1 divisor, sera primo. Si no, no lo sera. Y pasamos al numero siguiente pero tambien al contador siguiente
                El contador permite parar el bucle cuando el contador sea mayor al numero de numeros de primos que tenemos que sacar.*/
                echo $i,'<br>';
                $count++;
            }
        }
            /* Lo que hacemos es crear un contador y hacer un bucle para sacar los "N" primeros numeros y determinar si son primos.
            Un número primo es a partir del 2. Por tanto, empezamos el bucle de mirar los numeros primos a partir del 2 (i = 2)*/
    }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        echo "Los ".$num." primeros números primos son: ";
        echo "<br>";
        isPrimeNum($num);

    }
    ?>
</div>
</body>
</html>