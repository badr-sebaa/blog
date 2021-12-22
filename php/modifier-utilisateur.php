<?php
     require_once 'config.php'; // On inclut la connexion à la base de données

     if (isset($_POST['modifier'])) {

        $droit = $_POST['droit'];
        $droit2 = $_POST['droit2'];
    
        if ($droit ==  $droit2) {
    
    
                $userid = $_GET['id'];
                var_dump($_GET['id']);
    
                $req = $bdd->query("UPDATE utilisateurs SET id_droits = '$droit2' WHERE id = '$userid'");
                $req->execute(array());
                header("Location: admin.php");
            }
        }
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    
    <body>
    
        <main>
            <div align="center">
                <div>
                    <h1 class="h1-">Vous etes sur le point de modifier la categorie <? echo "$userid"; ?></h1>
                    <form class="form" method="POST">
                        <table class="form-inpute">
                            <tr>
                            <tr>
                                <td>
                                    <label>Modifier droit</label>
                                    <input type="text" name="droit" id="droit" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Confirmer votre action </label>
                                    <input type="text" name="droit2" id="droit2" required />
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <button class="button" type="submit" name="modifier">Modifier</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
        </main>
    </body>
    
    </html>