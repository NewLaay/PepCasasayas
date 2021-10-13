<html lang="es">
<head>
    <title>Christmas Tree</title>
</head>
<body>
<form method="post" action="CristmasTree.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div style="background-color: skyblue; width:min-content">
    <?php
    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        $count = $num;

        for ( $i=1; $i<=$num; $i++ ) {

            for ($j=0; $j<$count; $j++) {

                echo "<span style='color:skyblue'>*";

            }

            for ($j=0; $j<$i; $j++) {

                echo "<span style='color:black'>*";

                if ($j >= 1){
                    echo "<span style='color:black'>*";
                }

            }

            for ($j=0; $j<$count; $j++) {

                echo "<span style='color:skyblue'>*";

            }

            echo "<br/>";
            $count--;
        }

    }
    ?>
</div>
</body>
</html>