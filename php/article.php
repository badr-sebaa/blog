
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
  
<header> <?php include "header.php";?> </header>


<main>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p`-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">RACLERIE</p>

                <form class="mx-1 mx-md-4" action="article-traitement.php" method="post" enctype="multipart/form-data">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i !class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example4cd" class="form-control" name="message"/>
                      <label class="form-label" for="form3Example4cd">Message</label>
                    </div>
                  </div>

                  <label for="file" style="margin-bottom: 0; margin-top: 5px; display: inline-flex">
                  <input id="file" type="file" name="file" class="hide-upload" required/>
                  <i class="fa fa-plus image-plus"></i>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="TE LA RACLER">
                  </div>
                  
                </form>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</main>

<footer>
<?php include "footer.php";?>
</footer>

</body>

