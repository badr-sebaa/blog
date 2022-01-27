<?php   
    // Démarrage de la session 
    session_start();
    // Include de la base de données
    require_once 'config.php';


    // Si la session n'existe pas 
    if(!isset($_SESSION['user']))
    {
        header('Location:../index.php');
        die();
    }

// Si les variables existent 
if(!empty($_POST['name']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['newpassword']) && !empty($_POST['verify'])){
    // XSS 
    $new_name = htmlspecialchars($_POST['name']);
    $new_login = htmlspecialchars($_POST['login']);
    $current_password = htmlspecialchars($_POST['password']);
    $new_password = htmlspecialchars($_POST['newpassword']);
    $new_password_retype = htmlspecialchars($_POST['verify']);

      // On récupère les infos de l'utilisateur
      $check = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = :id');
      $check->execute(array(
          "id" => $_SESSION['user']
      ));
      $data = $check->fetch();

      // Si le mot de passe est le bon
      if(password_verify($current_password, $data['password']))
      {
        if(strlen($new_login) <= 100){
          // Si le mot de passe tapé est bon
          if($new_password === $new_password_retype){

              // On chiffre le mot de passe
              $cost = ['cost' => 12];
              $new_password = password_hash($new_password, PASSWORD_BCRYPT, $cost);
              // On met à jour la table utiisateurs
              $update = $bdd->prepare('UPDATE utilisateurs SET name = :name,login = :login,password = :password WHERE id = :id');
              $update->execute(array(
                  "name" => $new_name,
                  "login" => $new_login,
                  "password" => $new_password,
                  "id" => $_SESSION['user']
              ));
              // On redirige
              header('Location:profil.php?err=success_password');
              die();
            }
        }else{
            header('Location:profil.php?err=login_size');
        }
     }else{
                header('Location:profil.php?err=current_password');
                die();
             }

}
else{
    header('Location:profil.php');
    die();
}