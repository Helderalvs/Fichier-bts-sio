<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Démarrer la session uniquement si elle n'est pas déjà active
}

// Vérifier si l'utilisateur est connecté en tant que client
if (isset($_SESSION['role']) && $_SESSION['role'] == 'client') {
    // Afficher le formulaire de réservation
    ?>
<form method="post" action="traitement_reservation.php">
    <input type="hidden" name="id_materiel" value="<?php echo $unMatNeige['id_materiel']; ?>">
    
    <label for="date_debut">Date de début :</label>
    <input type="date" name="date_debut" id="date_debut" required>
    
    <label for="date_fin">Date de fin :</label>
    <input type="date" name="date_fin" id="date_fin" required>
    
    <input type="submit" name="submit_reservation" value="Réserver">
</form>


    <?php
} else {
    // Rediriger vers la page de connexion
    header("Location: index.php?page=9");
    exit(); // Arrêter l'exécution du script après la redirection
}
?>
