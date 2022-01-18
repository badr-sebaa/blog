<?php 
    session_start(); 
    require_once 'config.php'; // ajout connexion bdd 

      // si la session existe pas soit si l'on est pas connecté on redirige
      if(!isset($_SESSION['user'])){
        header('Location:../index.php');
        die();
       }

     // On récupere les données de l'utilisateur
     $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
     $req->execute(array($_SESSION['user']));
     $data = $req->fetch();
    // on verifie si la case com n'est pas vide malgre le required
    if(!empty($_POST['com'])){
      echo "1";
        // on recupere le commentaire 
        $com = htmlspecialchars($_POST['com']);
        //on cree une variable avec la date actuel 
        $dt = new DateTime();
        // on donne le format qui conviens a la date 
        $dt->format('Y-m-d H:i:s');
        // on verifie si le commentaire est au moins de 5 caractere 
        if(strlen($com) >= 5){
          
            // on insere dans la bdd
            $insert = $bdd->prepare('INSERT INTO commentaires(commentaire,id_aid_utilisateur,date) VALUES(:commentaire,:id_utilisateur,NOW())');
            $insert->execute(array(
                              'commentaire' => $com,
                              'id_articles' => ,
                              'id_utilisateur' => intval($data['id']), // id utilisateur est l'id de l'utilisateur session
                            ));
            // On redirige avec le message de succès
            echo "2";
            header('Location:gossip.php?reg_err=success');
                    die();
        }else{ header('Location:commentaire.php?reg_err=short');
            die();}

    }else{header('Location:commentaire.php?reg_err=nocom');
          die();}


