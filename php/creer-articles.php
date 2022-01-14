<?php
session_start();

require_once 'config.php'; // On inclut la connexion à la base de données

$checke = $bdd->prepare("SELECT * FROM `categories`");
$checke->execute(array());
$row = $checke->rowCount();
$data = $checke->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $categorie)


if (isset($_POST['creer'])) {
    if (!empty($_POST['categorie']) && !empty($_POST['newarticle'])) {


        // Création de variable pour chaque données avec sécu
        $id = $_SESSION['id'];
        $categorie = htmlspecialchars($_POST['categorie']);
        $newarticle = htmlspecialchars($_POST['newarticle']);

            // On insère dans la base de données
            $insert = $bdd->prepare("INSERT INTO `articles` (`article`,`id_utilisateur`,`id_categorie`,`date`) VALUES ('$newarticle','$id','$categorie', NOW())");
            $insert->execute();
            // On redirige avec le message de succès
            echo ("Votre ajout a bien été envoyé.");
            header('Location: admin.php');
            die();
        } else {
            echo ("veuillez réessayer.");
            header('Location: creer-articles.php');
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
                            <h1 class="h_1">Créer de nouveaux articles</h1>
                            <label for="categorie">Choisir la catégorie correspondante:</label>
                            <select name="categorie" id="categorie">
                                <?php foreach ($data as $categorie) { ?>

                                    <option value="<?php echo $categorie['id']; ?>"> <?php echo $categorie['nom']; ?> </option>

                                <?php
                                } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label for="newarticle">Ecrire un article:</label>
                        <input type="texterea" name="newarticle" id="newarticle" style="height:50px;">
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                        <input class="input" type="submit" value="Creer" name="creer">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </main>
</body>

</html>