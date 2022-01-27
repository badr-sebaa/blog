

<?php
session_start(); // Pour récupèrer nos données dans les variables : $_SESSION   
require_once 'config.php'; // Pour faire la connexion à notre base de données
?>



<head>
    <meta charset="utf-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body>
  
<?php include "header.php";?> 

<?php 

// On récupère les infos de l'utilisateur
$check = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = :id');
$check->execute(array(
    "id" => $_SESSION['user']
));
$data = $check->fetch();


    if(isset($_GET['err'])){
      $err = htmlspecialchars($_GET['err']);
      switch($err){
                    case 'current_password':
                                            echo "<div class='alert alert-danger'>Le mot de passe actuel est incorrect</div>";
                    break;
                    
                    case 'login_size':
                                      echo "<div class='alert alert-success'>le login est trop long ! </div>";
                    break;

                    case 'success_password':
                                            echo "<div class='alert alert-success'>Les données ont bien été modifié ! </div>";
                    break;
                    
                    case 'MIME':
                          echo "<div class='alert alert-success'>Problème MIME! </div>";
                    break;

                    case 'readable':
                          echo "<div class='alert alert-success'>Le fichier n'est pas lisible ! </div>";
                    break;

                    case 'compression':
                          echo "<div class='alert alert-success'>Le fichier est mal compresser ! </div>";
                    break;
                    
                    case 'badformat':
                          echo "<div class='alert alert-success'>Le mauvais format d'image ! </div>";  
                    break;
                    
                    case '5mo':
                          echo "<div class='alert alert-success'>Le fichier est trop volimineux ! </div>";
                    break;
                    
                    case 'dimension':
                          echo "<div class='alert alert-success'>le fichier est de mauvaise dimension ! </div>";
                    break;

                    case 'empty':
                        echo "<div class='alert alert-success'>Le champ est vide ! </div>";
                    break;

                  }
    }
?>



<main>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p`-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Profil</p>

                <form class="mx-1 mx-md-4" action="profil-traitement.php" method="post">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i !class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name ="name" value="<?php echo $data['name'];?> "/>
                      <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i !class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example3c" class="form-control" name="login" value="<?php echo $data['login'];?> "/>
                      <label class="form-label" for="form3Example3c">Your Login</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i !class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" name="password"/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i !class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" name="newpassword"/>
                      <label class="form-label" for="form3Example4c">New Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i !class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" name="verify"/>
                      <label class="form-label" for="form3Example4cd">Repeat your new password</label>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
                  </div>
                  
                </form>

                <div>
    
                  <?php
                    
                    if(file_exists("../avatars/". $_SESSION['user'] . "/" . $_SESSION['avatar']) && isset($_SESSION['avatar'])){
                  ?>
                  <img src="<?= "../avatars/". $_SESSION['user'] . "/" . $_SESSION['avatar']; ?>" width="120" style="width: 100%;height:35%" class="rounded-circle z-depth-2" />
 
                  <?php
                    }else{
                  ?>
                  <img src="../avatars/default/default.jpeg" width="120" style="width: 100%" class="rounded-circle"/>
                  <?php
                    }
                  ?>
                </div>
                
         <form action="avatar-traitement.php" method="post" enctype="multipart/form-data">
            <label for="file" style="margin-bottom: 0; margin-top: 5px; display: inline-flex">
               <input id="file" type="file" name="file" class="hide-upload" required/>
               <i class="fa fa-plus image-plus"></i>
               <input type="submit" name="avatar" value="Envoyer">
            </label>
         </form>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</section>
</main>


<?php 
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>"; 
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>"; 
echo "</br>";
include "footer.php";?>
</body>