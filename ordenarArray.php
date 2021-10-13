<?php

function ordenarArray($arrayNumeros){

    for($i=0;$i<count($arrayNumeros);$i++){
        for ($j=$i+1;$j<count($arrayNumeros);$j++){
            if($arrayNumeros[$j]<$arrayNumeros[$i]){
                $min = $arrayNumeros[$i];
                $arrayNumeros[$i] = $arrayNumeros[$j];
                $arrayNumeros[$j] = $min;
            }
        }
    }
    return $arrayNumeros;
}

$arrayNumeros = array(5,9,2,1,0,4,6,3,7);

echo "El array es 5,9,2,1,0,4,6,3,7"."<br>"."<br>";

echo "Impresión del array sin ordenar:";
print_r($arrayNumeros);

echo "<br>";
echo "Impresión del array ordenado: ";
print_r(ordenarArray($arrayNumeros));
