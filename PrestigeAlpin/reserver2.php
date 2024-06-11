<?php
require_once("controleur/controleur.class.php");

// Instanciation de la classe Controleur
$unControleur = new Controleur();

// Définir la table sur "mat_neige"
$unControleur->setTable("mat_neige");

if (isset($_POST['id_materiel'])) {
    $id_materiel = $_POST['id_materiel'];

      // Récupérer les valeurs saisies par l'utilisateur pour les dates de début et de fin de location
      $dateDebutLoc = isset($_POST['dateDebutLoc']) ? $_POST['dateDebutLoc'] : '';
      $dateFinLoc = isset($_POST['dateFinLoc']) ? $_POST['dateFinLoc'] : '';

    // Récupérer les informations sur le matériel
    $materiel = $unControleur->selectWhere(array("id_materiel" => $id_materiel));

    if ($materiel) {
        // Insérer la réservation dans la table des réservations
        $data = array(
            "id_user" => isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null,
            "id_materiel" => $id_materiel,
            "date_resa" => date("Y-m-d H:i:s"), // Ajout de la date de réservation
            "prix" => 0.00, // Par exemple, prix initialisé à 0.00
            "dateDebutLoc" => $dateDebutLoc,
            "dateFinLoc" => $dateFinLoc,
            "etat_resa" => "en attente" // Par exemple, état de la réservation initialisé à "en attente"
        );
        $result = $unControleur->insertReservation($data);

        if ($result) {
            echo "Réservation réussie pour le matériel : " . $materiel['nom'];
        } else {
            echo "Erreur lors de la réservation. Veuillez réessayer.";
        }
    } else {
        echo "Matériel non trouvé.";
    }
} else {    
    echo "Aucun matériel sélectionné pour la réservation.";
}

require_once("vue/vue_select_reservation.php");
?>

