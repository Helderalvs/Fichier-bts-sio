<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Démarrer la session uniquement si elle n'est pas déjà active
}

// Vérifier si l'utilisateur est connecté en tant que client
if (isset($_SESSION['role']) && $_SESSION['role'] == 'client') {
    // Afficher le formulaire de réservation
    ?>
<form method="post" action="reserver.php">
    <link rel="stylesheet" href="css/reservation.css">
    <label for="id_materiel">Matériel :</label>
    <select name="id_materiel" id="id_materiel" required>
        <?php
        // Récupérer à la fois les matériels de ski et de randonnée pour remplir le menu déroulant
        $modele_materiel_ski = new Modele();
        $modele_materiel_ski->setTable("mat_neige"); // Matériel de ski
        $lesMaterielsSki = $modele_materiel_ski->selectAll();
        foreach ($lesMaterielsSki as $materiel_ski) {
            echo '<option value="'.$materiel_ski['id_materiel'].'">'.$materiel_ski['nom'].' (Ski)</option>';
        }

        $modele_materiel_rando = new Modele();
        $modele_materiel_rando->setTable("mat_rando"); // Matériel de randonnée
        $lesMaterielsRando = $modele_materiel_rando->selectAll();
        foreach ($lesMaterielsRando as $materiel_rando) {
            echo '<option value="'.$materiel_rando['id_materiel'].'">'.$materiel_rando['nom'].' (Randonnée)</option>';
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
    <a href="vue/vue_select_mat_neige.php">Retour au matériel</a>
</form>

    <?php
} else {
    // Rediriger vers la page de connexion
    header("Location: index.php?page=10");
    exit(); // Arrêter l'exécution du script après la redirection
}
?>
