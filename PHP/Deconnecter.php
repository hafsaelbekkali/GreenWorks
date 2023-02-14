<?php
session_start();
try{
    session_unset();
    session_destroy();
    header("Location:mesGreenWorks.php#connexion");
}
catch(Exception $h ){
    die("Erreur de deconnxion :".$h->getMessage());
}
?>