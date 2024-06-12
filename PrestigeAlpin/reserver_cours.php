<?php
session_start();
 
// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele pour la table des réservations
$modele_reservation = new Modele();
$modele_reservation->setTable("inscription");
$id_cours = $_POST['id_cours'] ?? null;
$prix_cours = $_POST['prix_cours'] ?? null;

// Vérifier si le formulaire de réservation a été soumis
if (isset($_POST['reserve_btn'])) {
    // Récupération des données du formulaire
    $id_cours = $_POST['id_cours'] ?? null;
    $dateDebutLoc = $_POST['dateHeureDebut'] ?? '';
    $dateFinLoc = $_POST['dateHeureFin'] ?? '';

    if ($id_cours && $dateDebutLoc && $dateFinLoc) {
        // Conversion des dates en objets DateTime pour la validation
        $dateDebut = new DateTime($dateDebutLoc);
        $dateFin = new DateTime($dateFinLoc);

        // Vérification que les dates sont valides et dans le bon ordre
        if ($dateDebut < $dateFin) {
            // Calcul de la durée de location
            $dureeLocation = $dateDebut->diff($dateFin)->days;

            // Vérification de la durée de location
            if ($dureeLocation > 0) {
                 

                if ( is_numeric($_POST['prix_cours'])) {
                    // Calcul du prix total
                    $prixTotal = $_POST['prix_cours'] * $dureeLocation;

                    // Données à insérer dans la table des réservations
                    $data = array(
                        "id_user" =>  $_SESSION['id_user'], // Utilisateur par défaut
                        "id_cours" => $id_cours,
                        "date_resa" => date("Y-m-d"),
                        "prix" => $prixTotal,
                        "dateHeureDebut" => $dateDebutLoc,
                        "dateHeureFin" => $dateFinLoc,
                        "etat_resa" => "en attente"
                    );
                  //  var_dump($data);
                    // Insertion de la réservation dans la base de données
                    $result = $modele_reservation->insert($data);

                   // if ($result) {
                        echo "Réservation réussie pour le cours : " . $cours['nom_cours'] . ". Prix total : " . $prixTotal . "€";
                        // Redirection vers la page de réservation
                        header("Location: index.php?page=20");
                        exit(); // Arrêter l'exécution du script après la redirection
                    //} else {
                    //    echo "Une erreur s'est produite lors de la réservation. Veuillez réessayer.";
                  //  }
                } else {
                    echo "Les informations sur le cours sont invalides.";
                }
            } else {
                echo "La durée de la réservation doit être supérieure à zéro.";
            }
        } else {
            echo "La date de fin de location doit être ultérieure à la date de début de location.";
        }
    } else {
        echo "Veuillez saisir toutes les informations nécessaires pour la réservation.";
    }
}

// Inclure la vue pour le formulaire de réservation
require_once('vue/vue_insert_reservation_cours.php');
?>
