<?php
    require_once ("config.php");


    $count=$pdo->prepare("SELECT COUNT (id) as cpt from articles");
    $count->setFetchMode (PDO::FETCH_ASSOC);
    $count->execute();
    $tcount=$count->fetchAll();

    @$page=$_GET["page"];
    $nbr_elements_par_page=5;
    $nbr_de_pages = ceil($tcount [0]["cpt"]/ $nbr_elements_par_page);
    $debut=($page-1)*$nbr_elements_par_page;

    
    $sel=$pdo->prepare("SELECT articles from article order by article LIMIT $debut,$nbr_elements_par_page");
    $sel->setFetchMode(PDO::FETCH_ASSOC);
    $sel->execute();
    $tab=$sel->fetchAll();
?>
<!DOCTYPE html>
<html>
    <head>
       <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/pagination.css=<?php echo time()?>" />
    </head>
    <body>
        <header>
            <?php echo $tcount[0]["cpt"] ?> enregistrements au total
        </header>
        <div id="pagination-test">
            <?php
                 for ($i=1;$i<=$nbr_de_pages; $i++){
                    echo "<a href='?page=$i'>$i</a>&nbsp";
            ?>
        </div>

        <section id="cont">
            <?php for ($i=0;$i<count($tab);$i++){ ?>
                <?php echo $tab[$i]["article"]?>

            <div>
            <?php echo $tab[$i]["article"]?>
            </div>

            <?php } ?>
    </body>
</html>