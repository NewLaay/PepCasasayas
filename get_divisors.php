<html lang="es">
<head>
    <title>Get divisors</title>
</head>
<body>
<form method="post" action="get_divisors.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php
    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        for($divisor=1; $divisor<$num; $divisor++){
            if($num%$divisor == 0){
                echo "Divisor: ";
                echo $divisor ;
                echo "<br>";
            }
        }
    }
    ?>
</div>
</body>
</html>