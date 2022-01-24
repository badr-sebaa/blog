<?php include "header.php";?> 
</br>
 <?php

  session_start();
  require_once 'config.php';
  
  
  $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
  $req->execute(array($_SESSION['user']));
  $data = $req->fetch();
  
?>
 


        <!--SELECTION DE LA DB-->

<?php

// On récupere les données de l'utilisateur
$req = $bdd->query('SELECT articles.article,utilisateurs.login,articles.date,articles.image 
FROM articles LEFT JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id 
ORDER BY articles.date DESC ');

            while ($donnees = $req->fetch())
            {
                //On affiche les commentaires des utilisateurs 
            ?>
            <div style="margin-left: 30%;" >
              <div class="card text-white bg-dark mb-3" style="width: 30rem;">
              <div class="card-body">
                  <h5 class="card-title"><?= $donnees['login']." le  ".$donnees['date']?></h5>
                  <?php if($donnees['article'] != NULL){ ?> <p class="card-text"><?= $donnees['article']?></p> <?php } ?>
                </div>
              <?php if($donnees['image'] != NULL){ ?> <img class="card-img-top" src="<?php echo "../articles/".$donnees['image']?>" alt="Card image cap"> <?php } ?>
                
                <div class="card-body">
                  <a href="#" class="card-link">Commentaires</a>
                </div>
              </div>
            </div>
            </br>
            <?php
            }
            ?>  

<?php include "pagination-test.php";?> 
<?php include "footer.php"; ?>