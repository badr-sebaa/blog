<?php
session_start();
require_once 'config.php'; // On inclut la connexion à la base de données

$checke = $bdd->prepare("SELECT * FROM `articles`");
$checke->execute(array());
$row = $checke->rowCount();
$data = $checke->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $article)

if (isset($_POST['creer'])) {
    if (!empty($_POST['newcomment'])  && !empty($_POST['article'])) {

        // Création de variable pour chaque données avec sécu
        $id = $_SESSION['id'];
        $article = htmlspecialchars($_POST['article']);
        $newcomment = htmlspecialchars($_POST['newcomment']);

        // On insère dans la base de données
        $insert = $bdd->prepare("INSERT INTO `commentaires` (`commentaire`,`id_article`,`id_utilisateur`,`date`) VALUES ('$newcomment','$article','$id', NOW())");
        $insert->execute();
        // On redirige avec le message de succès
        echo ("Votre ajout a bien été envoyé.");
        header('Location: admin.php');
        die();
    } else {
        echo ("Votre ajout n'a pue etre effectuer veuillez réessayer.");
        header('Location:creer-commentaire.php');
        die();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> Page inscription </title>
    <meta charset="UTF-8" />
</head>

<body>
    <main id="formcenter">
        <div align="center">
            <form class="form" method="POST">
                <table class="form-input">
                    <tr>
                        <td>
                            <h1 class="h_1">Ajouter un commentaire</h1>
                            <label for="article">Choisir l'id de l'article à commenter:</label>
                            <select name="article" id="article">
                                <?php foreach ($data as $article) { ?>

                                    <option value="<?php echo $article['id']; ?>"> <?php echo $article['id']; ?> </option>

                                <?php
                                } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="newcomment">Ajouter un commentaire:</label>
                            <input type="texterea" name="newcomment" id="newcomment">
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <input type="submit" value="Creer" name="creer">
                        </td>
                    </tr>
                </table>
                <p><a href='../index.php'>Retourner à l'acceuil</a></p>
            </form>
        </div>
    </main>

</body>

</html>