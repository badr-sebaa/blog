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
    if(!empty($_POST['message'])){
        // on recupere le commentaire 
        $com = htmlspecialchars($_POST['message']);
        //on cree une variable avec la date actuel 
        $dt = new DateTime();     
        // on donne le format qui conviens a la date 
        $dt->format('Y-m-d H:i:s');
        // on verifie si le commentaire est au moins de 5 caractere 
        if(strlen($com) >= 5){
          
            // on insere dans la bdd
            $insert = $bdd->prepare('INSERT INTO articles(article,id_utilisateur) VALUES(:article,:id_utilisateur)');
            $insert->execute(array(
                              'article' => $com,
                              'id_utilisateur' => intval($data['id']), // id utilisateur est l'id de l'utilisateur session
                            ));
            // On redirige avec le message de succès
            
        }else{ header('Location:article.php?reg_err=short');
            die();}

    }



        // IMAGE TRAITEMENT 


     if(!empty($_POST)){
      extract($_POST); // On extrait toutes les informations
      $valid = true;
      echo "1";
      if (isset($_POST['submit'])){   // On se positionne sur le bon formulaire
     
          if (isset($_FILES['file']) and !empty($_FILES['file']['name'])) { // On vérifie qu'il y a bien un fichier
           
              $filename = $_FILES['file']['tmp_name']; // On récupère le nom du fichier
              list($width_orig, $height_orig) = getimagesize($filename); // On récupère la taille de notre fichier (l'image)

              if($width_orig >= 100 && $height_orig >= 100 && $width_orig <= 6000 && $height_orig <= 6000){ // On vérifie que la taille de l'image et correcte
                 echo "4";
                  $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
                  $ListeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg'=>'image/pjpeg');
                  $tailleMax = 5242880; // Taille maximum 5 Mo
                  // 2mo  = 2097152
                  // 3mo  = 3145728
                  // 4mo  = 4194304
                  // 5mo  = 5242880
                  // 7mo  = 7340032
                  // 10mo = 10485760
                  // 12mo = 12582912
                  $extensionsValides = array('jpg','jpeg','png','gif'); // Format accepté

                  if ($_FILES['file']['size'] <= $tailleMax){ // Si le fichier et bien de taille inférieur ou égal à 5 Mo
                    echo "5";
                      $extensionUpload = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1)); // Prend l'extension après le point, soit "jpg, jpeg ou png..."

                      if (in_array($extensionUpload, $extensionsValides)){ // Vérifie que l'extension est correct
                        echo "6";
                          $dossier = "../articles/"; // On se place dans le dossier de la personne 

                          $nom = md5(uniqid(rand(), true)); // Permet de générer un nom unique à la photo
                          $chemin = "../articles/" . $nom . "." . $extensionUpload; // Chemin pour placer la photo
                          $resultat = move_uploaded_file($_FILES['file']['tmp_name'], $chemin); // On fini par mettre la photo dans le dossier

                          if ($resultat){ // Si on a le résultat alors on va comprésser l'image
                              echo "7";
                              if (is_readable("../articles/" .$nom . "." . $extensionUpload)) {
                                  $verif_ext = getimagesize("../articles/" .$nom . "." . $extensionUpload);
                                  echo "8";
                                  // Vérification des extensions avec la liste des extensions autorisés
                                  if($verif_ext['mime'] == $ListeExtension[$extensionUpload]  || $verif_ext['mime'] == $ListeExtensionIE[$extensionUpload]){              
                                      // J'enregistre le chemin de l'image dans filename
                                      $filename = "../articles/" .$nom . "." . $extensionUpload;

                                      // Vérification des extensions que je souhaite prendre
                                      if($extensionUpload == 'jpg' || $extensionUpload == 'jpeg' || $extensionUpload == "pjpg" || $extensionUpload == 'pjpeg'){       
                                          $image2 = imagecreatefromjpeg($filename);
                                      }

                                      // Définition de la largeur et de la hauteur maximale
                                      $width2 = 720;
                                      $height2 = 720;

                                      list($width_orig, $height_orig) = getimagesize($filename);

                                      // Redimensionnement
                                      $image_p2 = imagecreatetruecolor($width2, $height2);
                                      imagealphablending($image_p2, false);
                                      imagesavealpha($image_p2, true);

                                      // Cacul des nouvelles dimensions
                                      $point2 = 0;
                                      $ratio = null;
                                      if($width_orig <= $height_orig){
                                          $ratio = $width2 / $width_orig;
                                      }else if($width_orig > $height_orig){
                                          $ratio = $height2 / $height_orig;
                                      }

                                      $width2 = ($width_orig * $ratio) + 1;
                                      $height2 = ($height_orig * $ratio) + 1; 

                                      imagecopyresampled($image_p2, $image2, 0, 0, $point2, 0, $width2, $height2, $width_orig, $height_orig);
                                      imagedestroy($image2);

                                      if($extensionUpload == 'jpg' || $extensionUpload == 'jpeg' || $extensionUpload == "pjpg" || $extensionUpload == 'pjpeg'){

                                          // Content type
                                          header('Content-Type: image/jpeg'); // Important !!

                                          $exif = exif_read_data($filename);
                                          if(!empty($exif['Orientation'])) {
                                              switch($exif['Orientation']) { 
                                                  case 8:
                                                      $image_p2 = imagerotate($image_p2,90,0);
                                                  break;
                                                  case 3:
                                                      $image_p2 = imagerotate($image_p2,180,0);

                                                  break;
                                                  case 6:
                                                      $image_p2 = imagerotate($image_p2,-90,0);

                                                  break;
                                              }
                                          } 
                                          // Affichage
                                          imagejpeg($image_p2, "  ../avatars/" . $_SESSION['user'] . "/" . $nom . "." . $extensionUpload, 75);
                                          imagedestroy($image_p2);
                                      }
                                      if(!empty($_POST['message'])){
                                        $update = $bdd->prepare("UPDATE articles SET image = ? WHERE  article = ?"); 
                                        $update->execute(array(($nom.".".$extensionUpload),$com));
                                      }
                                      else{
                                        $insert = $bdd->prepare('INSERT INTO articles(image,id_utilisateur) VALUES(:image,:id_utilisateur)');
                                        $insert->execute(array(
                                                                'image' => ($nom.".".$extensionUpload),
                                                                'id_utilisateur' => intval($data['id']), // id utilisateur est l'id de l'utilisateur session
                                                              ));
                                          }
                                      

            

                                      $_SESSION['flash']['success'] = "Nouvel avatar enregistré !";
                                      header('Location: article.php'); // Pour la redirection
                                      exit;
                                  }else{
                                    header('Location:article.php?reg_err=MIME');
                                    die();
                                  } 
                          }else
                          header('Location:article.php?reg_err=importerr');
                          die();

                      }else
                      header('Location:article.php?reg_err=badformat');
                      die();

                  }else
                  header('Location:article.php?reg_err=5mo');
                  die();
              }else
              header('Location:article.php?reg_err=dimension');
              die(); 
            } 
          }

?>