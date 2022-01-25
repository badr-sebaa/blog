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
$req = $bdd->query('SELECT articles.article,utilisateurs.login,articles.date,articles.image,articles.id
FROM articles LEFT JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id 
ORDER BY articles.date DESC ');

include "pagination-test.php";?> 
<?php include "footer.php"; ?>