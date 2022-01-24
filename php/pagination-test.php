<?php
    require_once ("config.php");


    $count=$bdd->prepare("SELECT COUNT(id) as cpt from articles");
    $count->setFetchMode (PDO::FETCH_ASSOC);
    $count->execute();
    $tcount=$count->fetchAll();

    $page=$_GET["page"];
    $nbr_elements_par_page = 5;
    $nbr_de_pages= ceil($tcount [0]["cpt"]/ $nbr_elements_par_page);
    $debut= ($page-1)*$nbr_elements_par_page;
    
    $sel=$bdd->prepare("SELECT articles.article,utilisateurs.login,articles.date,articles.image,articles.id
    FROM articles LEFT JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id 
    ORDER BY articles.date DESC , articles.article LIMIT $debut,$nbr_elements_par_page");
    $sel->setFetchMode(PDO::FETCH_ASSOC);
    $sel->execute();
    $tab=$sel->fetchAll();
?>
<!DOCTYPE html>
<html>
    <head>
       <meta charset="UTF-8" />
    </head>
    <body>

        <section id="cont">
            <?php for ($i=0;$i<count($tab);$i++){ ?>
                <div style="margin-left: 30%;" >
              <div class="card text-white bg-dark mb-3" style="width: 30rem;">
              <?php if($tab [$i]['image'] != NULL){ ?> <img class="card-img-top" src="<?php echo "../articles/".$tab [$i]['image']?>" alt="Card image cap"> <?php } ?>
                <div class="card-body">
                  <h5 class="card-title"><?= $tab [$i]['login']." le  ".$tab [$i]['date']?></h5>
                  <?php if($tab [$i]['article'] != NULL){ ?> <p class="card-text"><?= $tab [$i]['article']?></p> <?php } ?>
                </div>
                <div class="card-body">
                  <a href="<?php echo 'afficher-com.php'.'?articleid='.$tab [$i]['id'];?>" class="card-link">commentaire</a>
                </div>
              </div>
            </div>
            </br>

            <?php } ?>

            <div id="pagination">
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <?php 
            for ($i=1;$i<=$nbr_de_pages; $i++){
            ?>
            <li class="page-item"><a class="page-link" href="<?php echo '?page='.$i ?>"><?php echo $i ?> </a></li>
            <?php }?>
            </li>
            </ul>
            </nav>
        </div>
    </body>
</html>