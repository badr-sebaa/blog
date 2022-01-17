
<?php
require_once 'config.php'; // On inclut la connexion à la base de données

$req = $bdd->query('SELECT * FROM utilisateurs');
$req3 = $bdd->query('SELECT * FROM articles');
$req4 = $bdd->query('SELECT * FROM commentaires');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include("header.php"); ?>
    <main>
        <div>
            <h1 class="tarr">TABLEAU DE BORD</h1>
        </div> 

        <section>
<h2 class="h2admin">Utilisateurs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="th">ID</th>
                    <th class="th">NAME</th>
                    <th class="th">LOGIN</th>
                    <th class="th">PASSWORD</th>
                    <th class="th">ID_DROIT</th>
                    <th class="th">MODIFIER DROIT</th>
                    <th class="th">SUPPRIMER</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($rows = $req->fetch()) {
                    echo "<tr><th>$rows[id]</th>";
                    echo "<th>$rows[name]</th>";
                    echo "<th>$rows[login]</th>";
                    echo "<th>$rows[password]</th>";
                    echo "<th>$rows[id_droits]</th>";
                    echo "<th><a href=\"modifier-utilisateur.php?id=$rows[id]\">modifier</a></th>";
                    echo "<th><a href=\"supprimer-utilisateurs.php?id=$rows[id]\">supprimer</a></th></tr>";
                }
                ?>
            </tbody>
        </table>
        <button class="button" type="submit" name="connexion"><a href="creer-utilisateurs.php?id=<?php $rows['id'];?>\">Créer</a></button>
    </section>
  
        <section>
<h2 class="h2admin">Articles</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="th">ID</th>
                    <th class="th">ARTICLE</th>
                    <th class="th">ID_UTILISATEUR</th>
                    <th class="th">LIKE</th>
                    <th class="th">DATE</th>
                    <th class="th">MODIFIER</th>
                    <th class="th">SUPPRIMER</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($rows = $req3->fetch()) {
                    echo "<tr><th>$rows[id]</th>";
                    echo "<th>$rows[article]</th>";
                    echo "<th>$rows[id_utilisateur]</th>";
                    echo "<th>$rows[like]</th>";
                    echo "<th>$rows[date]</th>";
                    echo "<th><a href=\"profil.php?id=$rows[id]\">modifier</a></th>";
                    echo "<th><a href=\"supprimer-articles.php?id=$rows[id]\">supprimer</a></th></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
        <section>
<h2 class="h2admin">Commentaires</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="th">ID</th>
                    <th class="th">COMMENTAIRE</th>
                    <th class="th">ID_ARTICLE</th>
                    <th class="th">ID_UTILISATEUR</th>
                    <th class="th">DATE</th>
                    <th class="th">MODIFIER</th>
                    <th class="th">SUPPRIMER</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($rows = $req4->fetch()) {
                    echo "<tr><th>$rows[id]</th>";
                    echo "<th>$rows[commentaire]</th>";
                    echo "<th>$rows[id_article]</th>";
                    echo "<th>$rows[id_utilisateur]</th>";
                    echo "<th>$rows[date]</th>";
                    echo "<th><a href=\"modifier.php?id=$rows[id]\">modifier</a></th>";
                    echo "<th><a href=\"profil.php?id=$rows[id]\">supprimer</a></th></tr>";
                }
                ?>
            </tbody>
        </table>
        <button class="button" type="submit" name="connexion"><a href="creer-commentaires.php?id=<?php $rows['id'];?>\">Créer</a></button>
    </section>
  
 <?php include("footer.php"); ?>
</body>

</html>