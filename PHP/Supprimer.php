<?php 
session_start();
if(!isset($_SESSION["user"])){
   header("Location:mesGreenWorks.php#connexion");
}
?>
<?php
if(isset($_GET["id"])){
    extract($_GET);
    include("dbConnexion.php");
    try{
        $sup=$bd->prepare("DELETE FROM listegreenworks WHERE idList=$id");
        $sup->execute();
        header("Location:homee.php");
    }
    catch(PDOException $e ){
        die("Erreur de suppression ".$e->getMessage());
    }
}
?>