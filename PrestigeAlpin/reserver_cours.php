<?php
// Inclure la classe Modele pour la table des réservations
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
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['role']) && $_SESSION['role'] == "client") {
        // Vérifier si l'identifiant du cours a été transmis
        if (isset($_POST['id_cours'])) {
            $id_cours = $_POST['id_cours'];

            // Récupérer les dates de début et de fin de location depuis le formulaire
            $dateDebutLoc = $_POST['dateDebutLoc'];
            $dateFinLoc = $_POST['dateFinLoc'];

            // Insertion des détails de la réservation dans la base de données
            $data_reservation = array(
                "id_user" => 1,
                "id_cours" => $id_cours,
                "date_resa" => date("Y-m-d H:i:s"), // Date et heure actuelles
                "dateDebutLoc" => $dateDebutLoc,
                "dateFinLoc" => $dateFinLoc,
                "etat_resa" => "en attente"
            );
            $insertion_reservation = $modele_reservation->insert($data_reservation);

            if ($insertion_reservation) {
                echo "Réservation effectuée avec succès.";
            } else {
                echo "Erreur lors de la réservation.";
            }

            // Redirection vers une page de confirmation ou une autre page appropriée
            header("Location: confirmation_reservation.php");
            exit();
        } else {
            echo "Erreur: Identifiant du cours manquant.";
        }
    } else {
        echo "Vous devez être connecté en tant que client pour réserver un cours.";
    }
}

// Inclure la vue pour le formulaire de réservation
require_once('vue/vue_insert_reservation_cours.php');

