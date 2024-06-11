<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Démarrer la session uniquement si elle n'est pas déjà active
}

// Vérifier si l'utilisateur est connecté en tant que client
if (isset($_SESSION['role']) && $_SESSION['role'] == 'client') {
    // Afficher le formulaire de réservation
    ?>

<form method="post" action="reserver.php">
    <label for="id_materiel">Matériel :</label>
    <select name="id_materiel" id="id_materiel" required>
        <?php
        // Récupérer tous les matériels pour remplir le menu déroulant
        $modele_materiel = new Modele();
        $modele_materiel->setTable("mat_neige"); // Ou mat_rando selon le matériel
        $lesMateriels = $modele_materiel->selectAll();
        foreach ($lesMateriels as $materiel) {
            echo '<option value="'.$materiel['id_materiel'].'">'.$materiel['nom'].'</option>';
        }
        ?>
    </select>
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
    // Rediriger vers la page de connexion
    header("Location: index.php?page=10");
    exit(); // Arrêter l'exécution du script après la redirection
}
?>
