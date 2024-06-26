<?php
session_start(); // Démarrer la session

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
    $id_materiel = $_POST['id_materiel'] ?? null;
    $dateDebutLoc = $_POST['dateDebutLoc'] ?? '';
    $dateFinLoc = $_POST['dateFinLoc'] ?? '';

    if ($id_materiel && $dateDebutLoc && $dateFinLoc) {
        $modele_materiel_neige = new Modele();
        $modele_materiel_neige->setTable("mat_neige");
        $materiel_neige = $modele_materiel_neige->selectWhere(array("id_materiel" => $id_materiel));

        $modele_materiel_rando = new Modele();
        $modele_materiel_rando->setTable("mat_rando");
        $materiel_rando = $modele_materiel_rando->selectWhere(array("id_materiel" => $id_materiel));

        // Fusionner les données récupérées des deux tables
        $materiel = ($materiel_neige) ? $materiel_neige : $materiel_rando;

        if ($materiel) {
            if (is_numeric($materiel['prix_loca'])) {
                $dateDebut = new DateTime($dateDebutLoc);
                $dateFin = new DateTime($dateFinLoc);
                $dureeLocation = $dateDebut->diff($dateFin)->days;

                if ($dureeLocation > 0) {
                    $prixTotal = $materiel['prix_loca'] * $dureeLocation;

                    // Suppression de la vérification de l'utilisateur connecté
                    $data = array(
                        "id_user" => 1, // Utilisateur par défaut
                        "id_materiel" => $id_materiel,
                        "date_resa" => date("Y-m-d"),
                        "prix" => $prixTotal,
                        "dateDebutLoc" => $dateDebutLoc,
                        "dateFinLoc" => $dateFinLoc,
                        "etat_resa" => "en attente"
                    );

                     $modele_reservation->insert($data);

                   // if ($result) {
                        // Stocker le message de confirmation dans une variable de session
                        $_SESSION['confirmation_message'] = "Réservation réussie pour le matériel : " . $materiel['nom'] . ". Prix total : " . $prixTotal . "€";
                        // Redirection vers la page de réservation
                        header("Location: index.php?page=10");
                        exit();
                   // }
                //} else {
                //    echo "La durée de la location doit être supérieure à zéro.";
                //}
            } else {
                echo "Prix du matériel non valide.";
            }
        } else {
            echo "Matériel non trouvé.";
        }
    } else {
        echo "Veuillez saisir les dates de début et de fin de location.";
    }
}
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