<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["user"])) {
     header("Location:mesGreenWorks.php#connexion");
}
?>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Ajouter</title>
     <!-- Font Awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
     <!-- custom css file link -->
     <link rel="stylesheet" href="../Css/Accueil.css">
</head>

<body>
     <?php
     if (isset($_GET['msg'])) {
          extract($_GET);
          switch ($msg) {
               case "err_titre":
                    echo "<div class='err'>Entrez le titre</div>";
                    break;
               case "err_ing":
                    echo "<div class='err'> Entrez Ingrédients</div>";
                    break;
               case "err_etp":
                    echo "<div class='err'>Entrez les etapes</div>";
                    break;
               case "err_file":
                    echo "<div class='err'>Choisis un file</div>";
                    break;
          }
     }
     ?>
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
                         <li><a href="./mesGreenWorks.php">mes green works</a></li>
                         <li><a href="./LesGreenWorks.php">les green works</a></li>
                         <li><a href="./Contact.php">contactez-nous</a></li>
                         <li><a href="./Deconnecter.php">deconnecter</a></li>
                    </ul>
               </nav>
          </header>
          <!-- header section End -->

          <div class="Ajouter" id="Ajouter">
               <div class="box-container">
                    <img src="../image/easter-gfb678edaa_1280.jpg" width="430px" height="500px" alt="">
                    <div class="box">
                         <form method="POST" enctype="multipart/form-data">
                              <h3>Créer un nouveau GreenWork </h3>

                              <div>
                                   <label for="titre">Titre du GreenWork</label>
                                   <input type="text" name="titre">
                              </div>
                              <div>
                                   <label for="Ingrédients">Ingrédients</label>
                                   <textarea name="Ingrédients" cols="30" rows="10"></textarea>
                              </div>
                              <div>
                                   <label for="etape">Etapes et démarches de réalisation</label>
                                   <textarea name="etape" cols="30" rows="10"></textarea>
                              </div>
                              <div>
                                   <input type="file" name="file">
                              </div>
                              <div class="submit">
                                   <input type="submit" name="cree" value="Ajouter">
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
                                   $req = $bd->prepare("INSERT INTO listegreenworks(id , titre , ingredients,	etapes , image) Values(:id, :titre, :ingredients, :etapes, :image)");
                                   $req->execute([
                                        "id" => $_SESSION['id'],
                                        "titre" => $titre,
                                        "ingredients" => $Ingrédients,
                                        "etapes" => $etape,
                                        "image" => '..\\.\\img\\' . $_FILES['file']['name']
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