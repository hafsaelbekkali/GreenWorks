<?php
try{
    $bd = new PDO("mysql:host=localhost;dbname=green_works;charset=utf8;","root","");
}
catch(PDOException $e){
    die("Erreur !!".$e->getMessage());
}
?>