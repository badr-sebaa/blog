<?php
require_once 'config.php'; // On inclut la connexion à la base de données

if (isset($_SESSION['login'])) {

    $userid = $_GET['id'];
    var_dump($_GET);

    $req = $bdd->query("DELETE  FROM utilisateurs where id = '$userid'");
    $req->execute(array($userid));
    if($req){
    echo "L'utilisateur est supprimer" ;
    header("Location: admin.php");
    exit();
}
}
?>