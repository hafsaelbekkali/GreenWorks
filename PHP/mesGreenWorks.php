<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Mes green Works</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
     <link rel="stylesheet" href="../Css/Accueil.css">
</head>

<body>
     <!-- header section Start -->

     <header>
          <a href="./Accueil.php"><img src="../image/Picsart_22-06-12_00-36-19-932-removebg-preview.png" alt="logo" width="230px"></a>
          <div class="fas fa-bars"></div>
          <nav class="navbar">
               <ul>
                    <li><a href="./Accueil.php#home2">Accueil</a></li>
                    <li><a href="./Accueil.php#about">qui somme nous</a></li>
                    <li><a href="./mesGreenWorks.php">mes green works</a></li>
                    <li><a href="./LesGreenWorks.php">les green works</a></li>
                    <li><a href="./Contact.php">contactez-nous</a></li>
               </ul>
          </nav>
     </header>
     <!-- header section End -->

     <section>
          <div class="greenWorks">
               <div class="insConn">
                    <div class="logo">
                         <a href="./Accueil.php"><img src="../image/Picsart_22-06-12_00-36-19-932-removebg-preview.png" alt="logo" width="200px" height="100px"></a>
                    </div>
                    <div class="text">
                         <h5>Bienvenue à</h5>
                         <h3>Green Works</h3>
                         <p>recycler, innover, créer</p>
                    </div>
                    <div class="buttonss">
                         <a href="#connexion"><button class="btn">connexion</button></a>
                         <a href="./Inscription.php"><button class="btn">inscription</button></a>
                    </div>
               </div>
          </div>
          <div class="connexion" id="connexion">
               <div class="box-container">
                    <a href="./Accueil.php"><img src="../image/photo_2023-01-10_12-30-10.jpg" width="350px" height="440px" alt="logo"></a>
                    <div class="box">
                         <form action="" method="POST">
                              <i class="bi bi-person-circle"></i>
                              <h3>Connexion </h3>
                              <div class="label-inp">
                                   <label for="log">Login:</label>
                                   <i class="bi bi-person-fill"></i>
                                   <input type="text" name="login">
                              </div>
                              <div class="label-inp">
                                   <label for="log">mot de passe:</label>
                                   <i class="bi bi-key-fill"></i>
                                   <input type="password" name="psw">
                              </div>
                              <div class="submit">
                                   <input type="submit" value="Connecter" name="sub">
                              </div>
                              <div class="inscrire">
                                   <a href="./Inscription.php"> Mot de passe oublié ?</a>
                                   <a href="./Inscription.php">creer un nouveau compte</a>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </section>

     <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          extract($_POST);
          if (!isset($login) || empty($login)) {
               header("Location:mesGreenWorks.php");
          } else {
               if (!isset($psw) || empty($psw)) {
                    header("Location:mesGreenWorks.php");
               } else {
                    include("dbConnexion.php");
                    try {
                         $req = $bd->prepare("SELECT * FROM connexion WHERE user=:user and password=:psw");
                         $req->execute([
                              "user" => $login,
                              "psw" => $psw
                         ]);
                         $count = $req->rowCount();
                         if ($count == 1) {
                              session_start();
                              $infos = $req->fetch();
                              $_SESSION["user"] = $infos["user"];
                              $_SESSION["id"] = $infos["id"];
                              header("Location:homee.php");
                         } else {
                              header("Location:mesGreenWorks.php#connexion");
                         }
                    } catch (Exception $e) {
                         die("error connexion" . $e->getMessage());
                    }
               }
          }
     }

     ?>


     <script src="../js/Accueil.js"></script>

</body>

</html>