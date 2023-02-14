<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>contactez-nous</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
     <link rel="stylesheet" href="../Css/Accueil.css">
</head>

<body>
     <!-- header section Start -->

     <header>
          <a href="./Accueil.php"> <img src="../image/Picsart_22-06-12_00-36-19-932-removebg-preview.png" alt="logo" width="230px"> </a>
          <div class="fas fa-bars"></div>
          <nav class="navbar">
               <ul>
                    <li><a href="Accueil.php#home2">Accueil</a></li>
                    <li><a href="Accueil.php#about">qui somme nous</a></li>
                    <li><a href="./mesGreenWorks.php">mes green works</a></li>
                    <li><a href="./LesGreenWorks.php">les green works</a></li>
                    <li><a href="./Contact.php">contactez-nous</a></li>
               </ul>
          </nav>
     </header>
     <!-- header section End -->

     <div class="contact">
          <div class="box-container">
               <img src="../image/photo_2023-01-16_23-42-46.jpg" width="350px" height="440px" alt="">
               <form action="" method="POST">
                    <h3>Contactez-Nous</h3>
                    <div>
                         <label for="user"> Email d’utilisateur</label>
                         <input type="email" name="email" required>
                    </div>
                    <div>
                         <label for="user"> Objet </label>
                         <input type="text" name="objet" required>
                    </div>
                    <div>
                         <label for="user"> Message</label>
                         <textarea name="msg" cols="25" rows="5" required></textarea>
                    </div>
                    <div class="submit">
                         <input type="submit" value="Envoyer" name="envoyer">
                    </div>
               </form>
          </div>
     </div>
     <?php
     if($_SERVER["REQUEST_METHOD"]=="POST"){
          extract($_POST);
          include("dbConnexion.php");
          if(!isset($email) || empty($email)){
               header("Location:contact.php");
          }else{
               if(!isset($objet) || empty($objet)){
                    header("Location:contact.php");
               }else{
                    if(!isset($msg) || empty($msg)){
                         header("Location:contact.php");
                    }else{
                         try{
                              $req = $bd ->prepare("INSERT INTO contact(email, objet, message) VALUES (:email, :objet, :msg) ");
                              $req ->execute([
                                   "email" =>$email,
                                   "objet" =>$objet,
                                   "msg" =>$msg
                              ]);
                              echo "<script> alert('message envoye') </script>";
                         }
                         catch(Exception $e){
                              die("error".$e->getMessage());
                         }
                    }
               }
          }

     }

     ?>

     <script src="../js/Accueil.js"></script>

</body>

</html>