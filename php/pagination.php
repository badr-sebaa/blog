<?php


// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}
// On se connecte à là base de données
require_once('config.php');

// On détermine le nombre total d'articles
$sql = 'SELECT COUNT(*) AS nb_articles FROM articles;';

// On prépare la requête
$query = $bdd->prepare($sql);

// On exécute
$query->execute();

// On récupère le nombre d'articles
$result = $query->fetch();


$nbArticles = (int) $result['nb_articles'];

// On détermine le nombre d'articles par page
$parPage = 5;


// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);


// Calcul du 1er article de la page
$premier = ($pages-1) * $parPage;

$sql = 'SELECT * FROM articles ORDER BY articles DESC LIMIT $premier, $parPage;';

// On prépare la requête
$query = $bdd->prepare($sql);

// On remplace les valeurs
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);

// On exécute
$query->execute();

// On récupère les valeurs dans un tableau associatif
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<html>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
               
                <nav style="margin-left: 35%;"  >
                    <ul class="pagination">
                        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="afficher-articles.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="afficher-articles.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "active" ?>">
                            <a href="afficher-articles.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
    </main>
</body>
</html>