<?php

require_once 'config.php'; // On inclu la connexion à la bdd

// Si les variables existent et qu'elles ne sont pas vides
if(!empty($_POST['name']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['verify']))
{
    
    // je crée des variable pour chaque donné 
    $name = htmlspecialchars($_POST['name']);
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $verify = htmlspecialchars($_POST['verify']);

     // On vérifie si l'utilisateur existe
     $check = $bdd->prepare('SELECT * password FROM utilisateurs WHERE login = ?');
     $check->execute(array($login));
     $data = $check->fetch();
     $row = $check->rowCount();

    if($row == 0){ 
        
        if(strlen($login) <= 100){ // On verifie que la longueur du pseudo <= 100
            
            if($password === $verify){ // si les deux mdp saisis sont bon
                
                          // On hash le mot de passe avec Bcrypt, via un coût de 12
                          $cost = ['cost' => 12];
                          $password = password_hash($password, PASSWORD_BCRYPT, $cost);


                          // On insère dans la base de données
                          $insert = $bdd->prepare('INSERT INTO utilisateurs (name,login,password) VALUES(:name,:login,:password)');
                          $insert->execute(array(    
                              'name' => $name,
                              'login' => $login,
                              'password' => $password,
                          ));
                          // On redirige avec le message de succès
                          header('Location:../index.php?reg_err=success');
                          die();                     
            }else{ header('Location: ../index.php?reg_err=password'); die();}
        }else{ header('Location: ../index.php?reg_err=pseudo_length'); die();}
    }else{ header('Location: ../index.php?reg_err=already'); die();}
}
