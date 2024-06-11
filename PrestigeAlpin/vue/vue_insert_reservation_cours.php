<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Démarrer la session uniquement si elle n'est pas déjà active
}

// Vérifier si l'utilisateur est connecté en tant que client
if (isset($_SESSION['role']) && $_SESSION['role'] == 'client') {
    // Traitement de la réservation du cours
    if (isset($_POST['reserve_btn'])) {
        // Récupérer les données du formulaire
        $dateDebutLoc = $_POST['dateDebutLoc'];
        $dateFinLoc = $_POST['dateFinLoc'];

        // Ici, vous devez insérer les données dans votre base de données, en utilisant les valeurs $dateDebutLoc, $dateFinLoc et l'identifiant du cours (que vous devez transmettre via le formulaire)

        // Exemple de requête d'insertion (assurez-vous de modifier cela en fonction de votre logique et de votre base de données)
        // $id_cours = $_POST['id_cours']; // Assurez-vous que cette variable est transmise via le formulaire
        // $id_user = $_SESSION['id_user']; // Vous devrez peut-être ajuster cette variable en fonction de votre logique d'authentification
        // $sql = "INSERT INTO reservations (id_cours, id_user, date_debut_location, date_fin_location) VALUES ('$id_cours', '$id_user', '$dateDebutLoc', '$dateFinLoc')";
        // Executez votre requête ici

        // Exemple de redirection après la réservation
        // header("Location: confirmation_reservation.php");
        // exit();
    }

    // Afficher le formulaire de réservation
    ?>
    <form method="post" action="reserver_cours.php">
        <br>
        <label for="dateDebutLoc">Date début location :</label>
        <input type="date" name="dateDebutLoc" id="dateDebutLoc" required>
        <br>
        <label for="dateFinLoc">Date fin location :</label>
        <input type="date" name="dateFinLoc" id="dateFinLoc" required>
        <br>
        <input type="submit" name="reserve_btn" value="Réserver">
    </form>
    <?php
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté en tant que client
    header("Location: index.php?page=10");
    exit(); // Arrêter l'exécution du script après la redirection
}
?>
