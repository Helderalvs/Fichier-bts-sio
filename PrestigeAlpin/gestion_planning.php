<?php
// Inclure la classe Modele pour gérer les requêtes SQL
require_once('modele/modele.class.php');

// Récupérer les réservations de cours depuis la base de données
$modele_reservation = new Modele();
$modele_reservation->setTable("reservation");
$reservations = $modele_reservation->selectAll(); // À adapter selon votre structure de base de données

// Afficher les réservations dans un planning
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning des Cours Réservés</title>
    <link rel="stylesheet" href="css/planning.css">
</head>
<body>
<div class="planning">
    <h2>Planning des Cours Réservés</h2>
    <table>
        <tr>
            <th>Jour</th>
            <th>Heure</th>
            <th>Cours</th>
            <th>Client</th>
        </tr>
        <?php foreach ($reservations as $reservation) {
    echo "<tr>";
    echo "<td>".$reservation['dateDebutLoc']."</td>";
    echo "<td>".($reservation['heure_debut'] ?? "")." - ".($reservation['heure_fin'] ?? "")."</td>";
    echo "<td>".$reservation['nom_cours']."</td>";
    echo "<td>".$reservation['nom_client']."</td>";
    echo "</tr>";
}
         ?>
    </table>
</div>
</body>
</html>
