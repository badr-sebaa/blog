<?php
session_start(); // Pour récupèrer nos données dans les variables : $_SESSION   
require_once 'config.php'; // Pour faire la connexion à notre base de données

if(!isset($_SESSION['user'])) {
    echo 'not Set'.'</br>';
 }
 elseif(empty($_SESSION['user'])){
   echo 'vide'.'</br>';
 }
 else{echo "utilisateur : ".$_SESSION['user'].'</br>';}
 
 echo $_SESSION['avatar'];
 echo $_SESSION['user'];
 
if(!empty($_POST)){
    extract($_POST); // On extrait toutes les informations
    $valid = true;
    echo "1";
    if (isset($_POST['avatar'])){   // On se positionne sur le bon formulaire
        if (isset($_FILES['file']) and !empty($_FILES['file']['name'])) { // On vérifie qu'il y a bien un fichier
            $filename = $_FILES['file']['tmp_name']; // On récupère le nom du fichier
            list($width_orig, $height_orig) = getimagesize($filename); // On récupère la taille de notre fichier (l'image)
            if($width_orig >= 50 && $height_orig >= 50 && $width_orig <= 6000 && $height_orig <= 6000){ // On vérifie que la taille de l'image et correcte
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
                        $dossier = "../avatars/ " . $_SESSION['user'] . "/"; // On se place dans le dossier de la personne   
                        if (!is_dir($dossier)){ // Si le nom de dossier n'existe pas alors on le crée
                            mkdir($dossier);}
                        else{
                            if(file_exists("../avatars/". $_SESSION['user'] . "/" . $_SESSION['avatar']) && isset($_SESSION['avatar'])){
                            unlink("../avatars/". $_SESSION['user'] . "/" . $_SESSION['avatar']);}
                        } 
                        $nom = md5(uniqid(rand(), true)); // Permet de générer un nom unique à la photo
                        $chemin = "../avatars/" . $_SESSION['user'] . "/" . $nom . "." . $extensionUpload; // Chemin pour placer la photo
                        echo '</br></br></br></br></br></br>';
                        echo $nom;
                        echo '</br></br></br>';
                        echo $chemin;
                        echo '</br';
                        var_dump( $_FILES['file']) ;
                        $resultat = move_uploaded_file($_FILES['file']['tmp_name'], $chemin); // On fini par mettre la photo dans le dossier
                        var_dump($resultat);
                        if ($resultat){ // Si on a le résultat alors on va comprésser l'image
                            echo "7";
                            if (is_readable("../avatars/" . $_SESSION['user'] . "/" . $nom . "." . $extensionUpload)) {
                                $verif_ext = getimagesize("../avatars/" . $_SESSION['user'] . "/" . $nom . "." . $extensionUpload);
                                echo "8";
                                // Vérification des extensions avec la liste des extensions autorisés
                                if($verif_ext['mime'] == $ListeExtension[$extensionUpload]  || $verif_ext['mime'] == $ListeExtensionIE[$extensionUpload]){              
                                    // J'enregistre le chemin de l'image dans filename
                                    $filename = "../avatars/" . $_SESSION['user'] . "/" . $nom . "." . $extensionUpload;    
                                    $update = $bdd->prepare("UPDATE utilisateurs SET avatar = ? WHERE  id = ?"); 
                                    $update->execute(array(($nom.".".$extensionUpload), $_SESSION['user']));
                                    $_SESSION['avatar'] = ($nom.".".$extensionUpload); // On met à jour l'avatar
                                    header('Location: profil.php'); // Pour la redirection
                                    exit;                   
                                }else{header('Location:profil.php?reg_err=MIME');die();} 
                            }else{header('Location:profil.php?reg_err=importerr');die();}
                        }else{header('Location:profil.php?reg_err=importerr');die();}
                    }else{header('Location:profil.php?reg_err=badformat');die();}
                }else{header('Location:profil.php?reg_err=5mo');die();}
            }else{header('Location:profil.php?reg_err=dimension');die();} 
        }else{header('Location:profil.php?reg_err=empty');die();} 
    }else{header('Location:profil.php?reg_err=empty');die();} 
}else{header('Location:profil.php?reg_err=empty');die();} 
                                                           
?>