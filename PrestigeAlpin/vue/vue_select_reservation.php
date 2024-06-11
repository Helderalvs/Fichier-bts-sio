<?php
// Démarrer la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele pour la table des réservations
$modele_reservation = new Modele();
$modele_reservation->setTable("reservation");

// Récupérer toutes les réservations
$lesReservations = $modele_reservation->selectAll();

// Vérification si le formulaire de suppression a été soumis
if (isset($_POST['supprimer'])) {
    if (isset($_POST['id_resa'])) {
        $id_resa = $_POST['id_resa'];
        $modele_reservation->delete(array("id_resa" => $id_resa));
        
        // Réactualiser la page pour afficher les changements
        header("Location: index.php?page=6");
        exit();
    }
}

// Traitement de la réservation
if (isset($_POST['reserve_btn'])) {
    $date_resa = $_POST['date_resa'] ?? '';
    $prix = $_POST['prix'] ?? 0;
    $dateDebutLoc = $_POST['dateDebutLoc'] ?? '';
    $dateFinLoc = $_POST['dateFinLoc'] ?? '';
    $etat_resa = $_POST['etat_resa'] ?? '';

    $modele_reservation->insert(array(
        "date_resa" => $date_resa,
        "prix" => $prix,
        "dateDebutLoc" => $dateDebutLoc,
        "dateFinLoc" => $dateFinLoc,
        "etat_resa" => $etat_resa
    ));

    header("Location: index.php?page=5");
    exit();
}

// Définir les variables nécessaires pour le formulaire de réservation
$date_resa = ''; // Initialisez ces variables avec des valeurs par défaut
$prix = 0;
$dateDebutLoc = '';
$dateFinLoc = '';
$etat_resa = '';

// Inclure la vue pour le formulaire de réservation
require_once('vue/vue_insert_reservation.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/tab.css">
</head>
<body>
    <h3>Liste des réservations</h3>

    <form method="post">
        Filtrer par : <input type="text" name="filtre">
        <input type="submit" name="Filtrer" value="Filtrer">
    </form>
    <br>
    <table border="1">
        <tr>
            <td>ID réservation</td>
            <td>Date réservation</td>
            <td>Prix</td>
            <td>Date début location</td>
            <td>Date fin location</td>
            <td>État réservation</td>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "client") {
                echo "<td>Opérations</td>";
            } ?>
        </tr>

        <?php
        if (isset($lesReservations)) {
            foreach ($lesReservations as $uneReservation) {
                echo "<tr>";
                echo "<td>".$uneReservation['id_resa']."</td>";
                echo "<td>".$uneReservation['id_user']."</td>";
                echo "<td>".$uneReservation['id_cours']."</td>";
                echo "<td>".$uneReservation['date_resa']."</td>";
                echo "<td>".$uneReservation['prix']."</td>";
                echo "<td>".$uneReservation['etat_resa']."</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>

