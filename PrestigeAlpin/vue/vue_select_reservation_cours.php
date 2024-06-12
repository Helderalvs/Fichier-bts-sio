<?php

// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele pour la table des réservations
$modele_reservation = new Modele();
$modele_reservation->setTable("reservation");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style_front.css">
</head>
<body>
    <h3>Liste des réservations de cours</h3>

    <form method="post">
        Filtrer par : <input type="text" name="filtre">
        <input type="submit" name="Filtrer" value="Filtrer">
    </form>
    <br>
    <table border="1">
        <tr>
            <td>Date réservation</td>
            <td>Nom du cours</td>
            <td>Description du cours</td>
            <td>Prix du cours</td>
            <td>Prix réservation</td>
            <td>Date début réservation</td>
            <td>Date fin réservation</td>
            <td>État réservation</td>
        </tr>

        <?php
        if (isset($lesReservationsCours)) {
            foreach ($lesReservationsCours as $uneReservation) {
                echo "<tr>";
                echo "<td>".date('d/m/Y', strtotime($uneReservation['date_resa']))."</td>";
                echo "<td>".$uneReservation['nom_cours']."</td>";
                echo "<td>".$uneReservation['description_cours']."</td>";
                echo "<td>".$uneReservation['prix_base_cours']." €</td>";
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