<?php include "header.php";?> 
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
$req = $bdd->query('SELECT articles.article,utilisateurs.login,articles.date,articles.image FROM articles LEFT JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id');

            while ($donnees = $req->fetch())
            {
                //On affiche les commentaires des utilisateurs 
                echo "<ul><li class=\"him\">".$donnees['login']." LE ".$donnees['date']."</li><li class= \"me\">".$donnees['article']."</li>";
                echo "<img src= \""."../articles/".$donnees['image']."\">";
            }
        ?>  





 <?php include "footer.php"; ?>