<?php
session_start();
require_once 'config.php'; // On inclut la connexion à la base de données

$checke = $bdd->prepare("SELECT * FROM `droits`");
$checke->execute(array());
$row = $checke->rowCount();
$data = $checke->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['inscription'])) {

    if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['passwordverify'])) {

        // Création de variable pour chaque données 
        $login =  htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $passwordverify =  htmlspecialchars($_POST['passwordverify']);
        $id_droits = $_POST['id_droits'];

        $userid = $_GET['id'];

        $check = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE login = '$login'");
        $check->execute(array($login));
        $rows = $check->rowCount();

        if ($rows == 0) {
            echo 1;
            if ($password ==  $passwordverify) {

                echo 2;
                $passwordhash = password_hash($password, PASSWORD_BCRYPT);

                // On insère dans la base de données
                $insert = $bdd->prepare("INSERT INTO `utilisateurs` (`name`,`login`, `password`,`avatar`, `id_droits`) VALUES ('$name','$login','$passwordhash','$avatar','$id_droits')");
                $insert->execute(array(
                    'name'=> $name,
                    'login' => $login,
                    'password' => $passwordhash,
                    'avatar' => $avatar,
                    'id_droits' => $id_droits,
                ));
                // On redirige avec le message de succès
                echo ("Votre ajout a bien été envoyé.");
                header('Location:admin.php');
                die();
            } else {
                echo ("veuillez réessayer.");
                header('Location: creer-utilisateurs.php');
                die();
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title> Page inscription </title>
    <meta charset="UTF-8" />
   
</head>

<body id="bodyform">
    <main>
        <h1 class="h-1">Gossip</h1>
        <div align="center">
            <form method="POST">
                <table class="form-input">
                    <tr>
                        <td>
                            <h1 class="h-1">Ajouter un utilisateur</h1>
                            <label>name</label>
                            <input type="text" name="name" placeholder="Entrer un nom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Identifiant</label>
                            <input type="text" name="login" placeholder="Entrer un identifiant" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mot de passe</label>
                            <input type="password" name="password" placeholder="Entrer un mot de passe" minlength="8" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Confirmation mot de passe</label>
                            <input type="password" name="passwordverify" placeholder="Confirmer le mot de passe" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Quel droit attribuer a l'utilisateur </label>
                            <select name="id_droits" id="id_droits">
                               
                                <? foreach ($data as $key => $cate)  { ?>

                                    <option value="<? echo $cate['id']; ?>"> <? echo $cate['nom']; ?> </option>
                                   
                                <? } ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <button class="button" type="submit" name="inscription">Ajouter l'utilisateur</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </main>

    <footer >
    <?php include("footer.php"); ?>    
    </footer>
</body>

</html>