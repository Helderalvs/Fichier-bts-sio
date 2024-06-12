<?php
// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele pour la table des réservations
$modele_reservation = new Modele();
$modele_reservation->setTable("reservation");

// Récupérer toutes les réservations pour les matériels de ski
$lesReservationsNeige = $modele_reservation->selectJoin('reservation', 'mat_neige', 'id_materiel', 'id_materiel', array('reservation.*', 'mat_neige.nom AS nom_materiel', 'mat_neige.marque AS marque_materiel', 'mat_neige.prix_loca AS prix_base_materiel'));

// Récupérer toutes les réservations pour les matériels de randonnée
$lesReservationsRando = $modele_reservation->selectJoin('reservation', 'mat_rando', 'id_materiel', 'id_materiel', array('reservation.*', 'mat_rando.nom AS nom_materiel', 'mat_rando.marque AS marque_materiel', 'mat_rando.prix_loca AS prix_base_materiel'));

// Fusionner les résultats des deux requêtes
$lesReservations = array_merge($lesReservationsNeige, $lesReservationsRando);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style_front.css">
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
            <td>Date réservation</td>
            <td>Nom du matériel</td>
            <td>Marque du matériel</td>
            <td>Prix du matériel</td>
            <td>Prix location</td>
            <td>Date début location</td>
            <td>Date fin location</td>
            <td>État réservation</td>
        </tr>

        <?php
        if (isset($lesReservations)) {
            foreach ($lesReservations as $uneReservation) {
                echo "<tr>";
                echo "<td>".date('d/m/Y', strtotime($uneReservation['date_resa']))."</td>";
                echo "<td>".$uneReservation['nom_materiel']."</td>";
                echo "<td>".$uneReservation['marque_materiel']."</td>";
                echo "<td>".$uneReservation['prix_base_materiel']." €</td>";
                echo "<td>".$uneReservation['prix']." €</td>";
                echo "<td>".date('d/m/Y', strtotime($uneReservation['dateDebutLoc']))."</td>";
                echo "<td>".date('d/m/Y', strtotime($uneReservation['dateFinLoc']))."</td>";
                echo "<td>".$uneReservation['etat_resa']."</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>
