<?php 
    session_start(); // Démarrage de la session
    require_once 'config.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['login']) && !empty($_POST['password'])) // Si il existe les champs login, password et qu'il sont pas vident
    {
        // Patch XSS
        $login = htmlspecialchars($_POST['login']); 
        $password = htmlspecialchars($_POST['password']);
        
        
        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT * FROM users WHERE login = ?');
        $check->execute(array($login));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
                // Si le mot de passe est le bon
                if(password_verify($password, $data['password']))
                {
                    // On créer la session et on redirige sur index.php
                    $_SESSION['user'] = $data['id'];
                    header('Location: header.php');
                    die();
                }else{ header('Location: connection.php?login_err=password'); die(); }
        }else{ header('Location: connection.php?login_err=already'); die(); }
    }else{ header('Location: connection.php'); die();} // si le formulaire est envoyé sans aucune données
