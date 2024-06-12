<?php
require_once("controleur/controleur.class.php");

// Instanciation de la classe Controleur
$unControleur = new Controleur();

// Gérer la soumission du formulaire d'inscription
if (isset($_POST['Inscription'])) {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';

    // Valider les données du formulaire (ajoutez d'autres validations selon vos besoins)
    if (empty($nom) || empty($prenom) || empty($email) || empty($mdp) || empty($adresse) || empty($telephone)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        // Hasher le mot de passe
        //$mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

        // Appeler la méthode de vérification d'inscription pour les clients
        $resultat = $unControleur->verifInscriptionClient($nom, $prenom, $email, $mdp, $adresse, $telephone);

        if ($resultat) {
            // Rediriger l'utilisateur vers la page d'accueil
            header("Location: index.php?page=2");
            exit(); // Assurez-vous de terminer l'exécution du script après une redirection
        } else {
            echo "<br> Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
        }
    }
}
// Afficher le formulaire d'inscription
require_once("vue/vue_inscription.php");
?>
