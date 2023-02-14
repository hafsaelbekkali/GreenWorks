<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Font Awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
     <!-- custom css file link -->
     <link rel="stylesheet" href="../Css/Accueil.css">
     <title>Les Green Works</title>
</head>

<body>
     <!-- header section Start -->
     <header>
          <a href="Accueil.php"> <img src="../image/Picsart_22-06-12_00-36-19-932-removebg-preview.png" alt="logo" width="230px">
          </a>
          <div class="fas fa-bars"></div>
          <nav class="navbar">
               <ul>
                    <li><a href="Accueil.php#home2">Accueil</a></li>
                    <li><a href="Accueil.php#about">qui somme nous</a></li>
                    <li><a href="mesGreenWorks.php">mes green works</a></li>
                    <li><a href="#les-green-works1">les green works</a></li>
                    <li><a href="Contact.php">contactez-nous</a></li>
               </ul>
          </nav>
     </header>
     <!-- header section End -->

     <div class="section">
          <div class="les-green-works">
               <div class="les-green-works1" id="les-green-works1">
                    <img src="../Image/bottles-g40d208d1c_1280.jpg" alt="GreenWorks" width="500px">
                    <div class="contenu">
                         <h4>Les GreenWorks</h4>
                         <p> Si vous n'achetez pas de produits recyclés, vous ne recyclez pas vraiment.</p>
                         <a href="#list-green-works" class="list">Liste des GreenWorks</a><br>
                         <a href="#list-green-works"><i class="bi bi-arrow-down-circle-fill"></i></a>
                    </div>
               </div>
               <div class="list-green-works" id="list-green-works">
                    <h2>list-green-works</h2>
                    <?php
                    include("dbConnexion.php");
                    extract($_POST);
                    try {
                         $req = $bd->prepare("SELECT * FROM listegreenworks");
                         $req->execute();
                         $infos = $req->fetchAll();
                         foreach ($infos as $info ){
                              $id = $info[0];
                    ?>
                              <div class="box-container">
                                   <div class="box">
                                        <div class="image-icons">
                                             <img src="<?php echo $info[5] ?>" width="500px" alt="img">
                                             <div class="icons">
                                                  <i class="bi bi-hand-thumbs-up-fill"></i>
                                                  <i class="bi bi-balloon-heart-fill"></i>
                                                  <i class="bi bi-emoji-angry-fill"></i>
                                                  <i class="bi bi-emoji-laughing-fill"></i>
                                                  <i class="bi bi-hand-thumbs-down-fill"></i>
                                                  <i class="bi bi-bookmark-heart-fill"></i>
                                             </div>

                                        </div>
                                        <div class="container">
                                             <h4>Titre : <span> <?php echo $info[2] ?> </span> </h4>
                                             <h4>Ingredient : <span> <?php echo $info[3] ?> </span> </h4>
                                             <h4>Les etapes : <span> <?php echo $info[4] ?> </span> </h4>
                                        </div>
                                   </div>
                                   <?php echo "<hr>"; ?>
                              </div>
                    <?php
                         }
                    } catch (PDOException $e) {
                         die("error" . $e->getMessage());
                    }
                    ?>

               </div>

          </div>
     </div>
     <!-- custom js file link -->
     <script src="../js/Accueil.js"></script>
</body>

</html>