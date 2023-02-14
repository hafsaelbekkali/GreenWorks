<?php
session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["id"])) {
     header("Location:mesGreenWorks.php#connexion");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Home Page</title>
     <!-- Font Awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
     <!-- custom css file link -->
     <link rel="stylesheet" href="../Css/Accueil.css">
</head>

<body>

     <section>
          <div class="home-login">
               <!-- header section Start -->
               <header>
                    <a href="./Accueil.php"> <img src="../image/Picsart_22-06-12_00-36-19-932-removebg-preview.png" alt="logo" width="230px">
                    </a>
                    <div class="fas fa-bars"></div>
                    <nav class="navbar">
                         <ul>
                              <li><a href="./Accueil.php#home2">Accueil</a></li>
                              <li><a href="./Accueil.php#about">qui somme nous</a></li>
                              <li><a href="mesGreenWorks.php">mes green works</a></li>
                              <li><a href="LesGreenWorks.php">les green works</a></li>
                              <li><a href="Contact.php">contactez-nous</a></li>
                              <li><a href="Deconnecter.php">deconnecter</a></li>
                         </ul>
                    </nav>
               </header>
               <!-- header section End -->
               <div class="box-container">
                    <?php
                    include("dbConnexion.php");
                    extract($_POST);
                    try {
                         $req = $bd->prepare("SELECT * FROM connexion where id=? ");
                         $req->execute([$_SESSION["id"]]);
                         $infos = $req->fetchAll();
                         foreach ($infos as $info) {
                              $id = $info[0];
                    ?>
                              <a href="#"> <img id="img" src="../image/Picsart_22-06-12_00-36-19-932-removebg-preview.png" width="200px" alt="logo">

                                   <div class="box">
                                        <h3>Bonjour Mr(Mrs) <br> <span class="nom"> <?php echo $info[3];?> &hearts; <?php echo $info[4]; ?></span> <br> Bienvenue dans Votre <span class="green">GreenWorks</span> <br> Voulez vous:</h3>
                                        <div class="buttons">
                                             <a href="#Afficher"><button class="btn">afficher </button></a>
                                             <a href="./Ajouter.php#Ajouter"><button class="btn">Ajouter </button></a>
                                        </div>
                                   </div>
                         <?php
                         }
                    } catch (PDOException $e) {
                         die("error" . $e->getMessage());
                    }
                         ?>
               </div>
          </div>
     </section>

     <div class="Afficher" id="Afficher">
          <?php
          include("dbConnexion.php");
          extract($_POST);
          try {
               $req = $bd->prepare("SELECT * FROM listegreenworks where id=? ");
               $req->execute([$_SESSION["id"]]);
               $infos = $req->fetchAll();
               foreach ($infos as $info) {
                    $id = $info[0];
          ?>
                    <div class="box-container">
                         <div class="box">
                              <img src="<?php echo $info[5] ?>" width="500px" alt="img">
                              <div class="container">
                                   <h4>Titre : <span> <?php echo $info[2] ?> </span> </h4>
                                   <h4>Ingredient : <span> <?php echo $info[3] ?> </span> </h4>
                                   <h4>Les etapes : <span> <?php echo $info[4] ?> </span> </h4>
                                   <div class="buttons">
                                        <?php echo "<a href='./Supprimer.php?id=$id' class='btn'>Supprimer</a>" ?>
                                        <?php echo "<a href='./Modifier.php?id=$id' class='btn'>Modifier</a>" ?>
                                   </div>
                              </div>
                         </div>
                    </div>
          <?php
                    echo "<hr>";
               }
          } catch (PDOException $e) {
               die("error" . $e->getMessage());
          }
          ?>
     </div>


     <!-- custom js file link -->
     <script src="../js/Accueil.js"></script>
</body>

</html>