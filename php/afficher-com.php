<?php include "header.php";?> 
</br>
 <?php

  session_start();
  require_once 'config.php';
  $id_article = htmlspecialchars($_GET['articleid']);

  $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
  $req->execute(array($_SESSION['user']));
  $data = $req->fetch();
  
?>
 


        <!--SELECTION DE LA DB-->

<?php

// On récupere les données de l'utilisateur
$req = $bdd->query("SELECT articles.article,utilisateurs.login,articles.date,articles.image,articles.id
FROM articles LEFT JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id 
WHERE articles.id = '{$id_article}'");

            $donnees = $req->fetch()
                //On affiche les articles des utilisateurs 
            ?>
            <div style="margin-left: 30%;" >
              <div class="card text-white bg-dark mb-3" style="width: 30rem;">
              <?php if($donnees['image'] != NULL){ ?> <img class="card-img-top" src="<?php echo "../articles/".$donnees['image']?>" alt="Card image cap"> <?php } ?>
                <div class="card-body">
                  <h5 class="card-title"><?= $donnees['login']." le  ".$donnees['date']?></h5>
                  <?php if($donnees['article'] != NULL){ ?> <p class="card-text"><?= $donnees['article']?></p> <?php } ?>
                </div>
                <div class="card-body">
                  <a href="<?php echo 'commentaire.php'.'?articleid='.$donnees['id'];?>" class="card-link">commentez !</a>
                </div>
                </div>
            </div>
            </br>

            
<?php
// On récupere les données de l'utilisateur
$req2= $bdd->query("SELECT commentaires.commentaire , commentaires.login_utilisateur, commentaires.date FROM commentaires LEFT JOIN articles ON commentaires.id_article = articles.id WHERE commentaires.id_article = '{$id_article}'");

while ($data = $req2->fetch()){
                //On affiche les commentaires des utilisateurs 
            ?>
<div style="margin-left: 30%;" >
    <div class="card text-white bg-dark mb-3" style="width: 30rem;">
        <div class="card-body">
                  <h5 class="card-title"><?= $data['login_utilisateur']." le  ".$data['date']?></h5>
                  <p class="card-text"><?= $data['commentaire']?></p>
        </div>
    </div>
</div>
</br>
            <?php
            }
            ?>  

<?php include "footer.php"; ?>