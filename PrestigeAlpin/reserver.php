<?php
require_once("controleur/controleur.class.php");

// Instanciation de la classe Controleur
$unControleur = new Controleur();

// Définir la table sur "mat_rando" 
$unControleur->setTable("mat_neige");

if (isset($_POST['id_materiel'])) {
    $id_materiel = $_POST['id_materiel'];

    // Récupérer les valeurs saisies par l'utilisateur pour les dates de début et de fin de location
    $dateDebutLoc = isset($_POST['dateDebutLoc']) ? $_POST['dateDebutLoc'] : '';
    $dateFinLoc = isset($_POST['dateFinLoc']) ? $_POST['dateFinLoc'] : '';

    // Vérifier si les dates de début et de fin de location sont saisies
    if (!empty($dateDebutLoc) && !empty($dateFinLoc)) {
        // Récupérer les informations sur le matériel
        $materiel = $unControleur->selectWhere(array("id_materiel" => $id_materiel));

        if ($materiel) {
            // Vérifier si le prix du matériel est numérique
            if (is_numeric($materiel['prix_loca'])) {
                // Calculer la durée de la location en jours
                $dateDebut = new DateTime($dateDebutLoc);
                $dateFin = new DateTime($dateFinLoc);
                $dureeLocation = $dateDebut->diff($dateFin)->days;

                // Vérifier si la durée de location est valide (supérieure à zéro)
                if ($dureeLocation > 0) {
                    // Calculer le prix total
                    $prixTotal = $materiel['prix_loca'] * $dureeLocation;

                    // Insérer la réservation dans la table des réservations
                    $data = array(
                        "id_user" => isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null,
                        "id_materiel" => $id_materiel,
                        "date_resa" => date("Y-m-d"), // Utiliser la date actuelle
                        "prix_loca" => $prixTotal, // Utiliser le prix total calculé
                        "dateDebutLoc" => $dateDebutLoc,
                        "dateFinLoc" => $dateFinLoc,
                        "etat_resa" => "en attente" // Mettre à jour l'état en fonction de votre logique
                    );

                    // Insérer la réservation dans la table des réservations
                    $result = $unControleur->insertReservation($data);

                    if ($result) {
                        echo "Réservation réussie pour le matériel : " . $materiel['nom'] . ". Prix total : " . $prixTotal . "€";
                    } else {
                        echo "Erreur lors de la réservation. Veuillez réessayer.";
                    }
                } else {
                    echo "La durée de la location doit être supérieure à zéro.";
                }
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

require_once("vue/vue_select_reservation.php");
?>
