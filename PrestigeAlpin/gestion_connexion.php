<?php
require_once("controleur/controleur.class.php");
require_once("vue/vue_connexion.php");

// Instanciation de la classe Controleur
$unControleur = new Controleur();

// Vérification de la soumission du formulaire de connexion
if (isset($_POST['Connexion'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];   

    // Vérifie que les champs ne sont pas vides
    if (!empty($email) && !empty($mdp)) {
        // Vérifie l'authentification de l'utilisateur
        $unUser = $unControleur->verifConnexion($email, $mdp);
      
        if ($unUser != null) {
            // Authentification réussie
            $_SESSION['id_user'] = $unUser['id_user']; // Ajout de l'identifiant de l'utilisateur à la session
            $_SESSION['email'] = $unUser['email'];
            $_SESSION['nom'] = $unUser['nom'];
            $_SESSION['prenom'] = $unUser['prenom'];
            $_SESSION['role'] = $unUser['role']; // Assurez-vous que le rôle est défini dans vos données utilisateur
        
            // Redirection en fonction du rôle de l'utilisateur
            if ($unUser['role'] == "client") {
                header("Location: index.php?page=2"); // Page client
            } elseif ($unUser['role'] == "moniteur") {
                header("Location: index.php?page=8"); // Page représentant (à adapter en fonction de votre logique de redirection)
            } else {
                // Rôle non défini ou invalide
                echo "Erreur de redirection. Veuillez contacter l'administrateur.";
            }
            exit(); // Fin du script après la redirection
        }
        } else {
            // Identifiants incorrects
            echo "<br> Veuillez vérifier vos identifiants.";
        }
    } else {
        // Champ(s) manquant(s)
        echo "<br> Veuillez remplir tous les champs.";
    }
?>

