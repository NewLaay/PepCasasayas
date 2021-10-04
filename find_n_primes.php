<html lang="es">
<head>
    <title>Find N prime numbers</title>
</head>
<body>
<form method="post" action="find_n_primes.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php



    function getDivisors($num){

        $arrayDivisores = array();
        $numeroDivisores = 0;


        if (isset($_POST["num"])) {
            $num = intval($_POST["num"]);

            for($divisor=1; $divisor<$num; $divisor++){
                if($num%$divisor == 0){
                    $arrayDivisores[]=$divisor;
                }
            }
        }
        $numeroDivisores = count($arrayDivisores);
        return $numeroDivisores;

    }

    function isPrimeNum($num){
    /* Aqui tenemos que contar el array para averiguar si es numero primo o no sabiendo cuantos divisores tiene. (Si tiene mas de 1, no es primo*/
    $contador = 1;

       for($i=2;$contador<$num;$i++) {
           if (getDivisors($i) < 2) {
               $contador++;
                echo $i;
           }
       }
    }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        isPrimeNum($num);

    }



    ?>
</div>
</body>
</html>