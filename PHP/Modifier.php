<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Modifier</title>
     <!-- Font Awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
     <!-- custom css file link -->
     <link rel="stylesheet" href="../Css/Accueil.css">
</head>

<body>
     <section>
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
                         <li><a href="Contact.php">deconnecter</a></li>
                    </ul>
               </nav>
          </header>
          <!-- header section End -->
          <?php
          if (isset($_GET["id"])) {
               include("dbConnexion.php");
               extract($_GET);
               // try {
               $sel = $bd->prepare("SELECT * FROM listegreenworks WHERE idList= $id");
               $sel->execute();
               $infos = $sel->fetch();
               // } catch (PDOException $e) {
               //      die("Erreur de modification " . $e->getMessage());
               // }
          }

          ?>

          <div class="Modifier" id="Modifier">
               <div class="box-container">
                    <img src="../image/lightbulb-g3c84d681c_1920.jpg" width="430px" height="500px" alt="">
                    <div class="box">
                         <form method="POST" enctype="multipart/form-data">
                              <h3>Modifier ce GreenWork </h3>

                              <div>
                                   <label for="titre">Titre du GreenWork</label>
                                   <input type="text" name="titre" value="<?php echo $infos[2] ?> " >
                              </div>
                              <div>
                                   <label for="Ingrédients">Ingrédients</label>
                                   <textarea name="Ingrédients" cols="30" rows="10" required value="<?php echo $infos[3] ?>"></textarea>
                              </div>
                              <div>
                                   <label for="etape">Etapes et démarches de réalisation</label>
                                   <textarea name="etape" value="<?php echo $infos[4] ?> "   cols="30" rows="10"  required></textarea>
                              </div>
                              <div>
                                   <input type="file" name="file">
                              </div>
                              <div class="submit">
                                   <input type="submit" name="cree" value="Modifier">
                              </div>
                         </form>
                    </div>
               </div>

          </div>
     </section>

     <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          extract($_POST);
          if (!isset($titre) || empty($titre)) {
               header("Location:Ajouter.php?msg=err_titre");
          } else {
               if (!isset($Ingrédients) || empty($Ingrédients)) {
                    header("Location:Ajouter.php?msg=err_ing");
               } else {
                    if (!isset($etape) || empty($etape)) {
                         header("Location:Ajouter.php?msg=err_etp");
                    } else {
                         if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                              if ($_FILES['file']['size'] <= 1000000) {
                                   $image = $_FILES['file']['type'];
                                   $exts = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/pdf', 'image/jfif', 'image/webp'];
                                   if (in_array($image, $exts)) {
                                        move_uploaded_file($_FILES['file']['tmp_name'], ".././img/" . $_FILES['file']['name']);
                                   }
                              }
                              include("dbConnexion.php");
                              try {
                                   $req = $bd->prepare("UPDATE  listegreenworks SET titre=? , ingredients=?,	etapes=? , image=? WHERE idList=$id");
                                   $req->execute([
                                        $titre,
                                        $Ingrédients,
                                        $etape,
                                        '..\\.\\img\\' . $_FILES['file']['name']
                                   ]);
                                   header("Location:Homee.php");
                              } catch (PDOException $e) {
                                   die("error" . $e->getMessage());
                              }
                         }
                    }
               }
          }
     }
     ?>


     <script src="../js/Accueil.js"></script>
</body>