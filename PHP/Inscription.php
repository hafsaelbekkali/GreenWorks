<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
     <link rel="stylesheet" href="../Css/Accueil.css">
     <title>Inscription</title>
</head>

<body>


     <!-- header section End -->

     <section>
          <div class="inscription">
               <div class="box-container">
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
                                   <li><a href="#les_green_work.php">les green works</a></li>
                                   <li><a href="Contact.php">contactez-nous</a></li>
                              </ul>
                         </nav>
                    </header>
                    <!-- header section End -->
                    <a href="./accueil.php"><img src="../image/Picsart_22-06-12_00-36-19-932-removebg-preview.png" width="200px" height="100px" alt="logo" class="img"></a>

                    <div class="box">
                         <h3>Inscription</h3>
                         <form action="" method="POST">
                              <div>
                                   <input type="text" name="nom" placeholder="Nom: ">
                              </div>
                              <div>
                                   <input type="text" name="prenom" placeholder="Prénom:">
                              </div>
                              <div>
                                   <input type="email" name="email" placeholder="Email:">
                              </div>
                              <div>
                                   <input type="text" name="user" placeholder="Nom d’utilisateur:">
                              </div>
                              <div>
                                   <input type="password" name="psw" placeholder="Mot de passe :">
                              </div>
                              <div>
                                   <input type="password" name="cpsw" placeholder="Confirmation mot de passe :">
                              </div>
                              <div class="submit">
                                   <input type="submit" value="S'inscrire" name="submit">
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </section>

     <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          extract($_POST);
          if (!isset($nom) || empty($nom)) {
               header("Location:Inscription.php");
          } else {
               if (!isset($prenom) || empty($prenom)) {
                    header("Location:Inscription.php");
               } else {
                    if (!isset($email) || empty($email)) {
                         header("Location:Inscription.php");
                    } else {
                         if (!isset($user) || empty($user)) {
                              header("Location:Inscription.php");
                         } else {
                              if (!isset($psw) || empty($psw)) {
                                   header("Location:Inscription.php");
                              } else {
                                   if (!isset($cpsw) || empty($cpsw)) {
                                        header("Location:Inscription.php");
                                   } else {
                                        include("dbConnexion.php");
                                        try {
                                             $req = $bd->prepare("INSERT INTO connexion(user, password, prenom, nom, email) VALUES (:user, :psw, :prenom, :nom, :email)");
                                             $req->execute([
                                                  "user" => $user,
                                                  "psw" => $psw,
                                                  "prenom" => $prenom,
                                                  "nom" => $nom,
                                                  "email" => $email
                                             ]);
                                             header("Location:mesGreenWorks.php");
                                        } catch (Exception $e) {
                                             die("erreur d'inscription" . $e->getMessage());
                                        }
                                   }
                              }
                         }
                    }
               }
          }
     }


     ?>


     <script src="../js/Accueil.js"></script>

</body>

</html>