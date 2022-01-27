<?php session_start(); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#" style="width: 25%;"> <?php
                    
                    if(file_exists("../avatars/". $_SESSION['user'] . "/" . $_SESSION['avatar']) && isset($_SESSION['avatar'])){
                  ?>
                  <img src="<?= "../avatars/". $_SESSION['user'] . "/" . $_SESSION['avatar']; ?>" width="120" style="width:10%;height:5%" class="rounded-circle z-depth-2" />
 
                  <?php
                    }else{
                  ?>
                  <img src="../avatars/default/default.jpeg" width="120" style="width: 10%" class="rounded-circle"/>
                  <?php
                    }
                  ?>
                </div>GOSSIP_ </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="afficher-articles.php?page=1">Gossip<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profil.php">Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="article.php">Raclerie</a>
      </li>
      <?php if($_SESSION['id_droit'] == 42 or $_SESSION['id_droit'] == 1337 ){ ?>
      <li class="nav-item">
        <a class="nav-link"  href="admin.php">Admin</a>
      </li>
      <?php } ?>
    </ul>
    <span class="navbar-text">
    <a class="nav-link" href="disconnection.php">Logout</a>
    </span>
  </div>
</nav>