<?php


$localhost = "sql480.main-hosting.eu";
$username = "u850300514_jcasasayas";
$pwd = "x43196836F";
$bdname = "u850300514_jcasasayas";

try{
    $conne = new PDO("mysql:host=$localhost;dbname=$bdname;",$username,$pwd);
}catch(PDOException $e){
    die('Connected failed : '.$e->getMessage());
}


?>