<?php
session_start();
require_once 'config.php'; // On inclut la connexion à la base de données

$userid = $_GET['id'];
var_dump($_GET);

$req = $bdd->query("DELETE  FROM commentaires where id = '$userid'");
$req->execute();
if ($req) {
    echo "L'utilisateur a bien été supprimer";
    header("Location: ../html/admin.php");
    exit();
}
?>