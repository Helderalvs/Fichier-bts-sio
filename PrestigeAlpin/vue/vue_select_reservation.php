    <?php

    // Inclure la classe Modele
    require_once('modele/modele.class.php');

    // Créer une instance de la classe Modele pour la table des réservations
    $modele_reservation = new Modele();
    $modele_reservation->setTable("reservation");

    // Récupérer toutes les réservations
    $lesReservations = $modele_reservation->selectAll();

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
                <td>Prix</td>
                <td>Date début location</td>
                <td>Date fin location</td>
                <td>État réservation</td>
            </tr>

            <?php
            if (isset($lesReservations)) {
                foreach ($lesReservations as $uneReservation) {
                    echo "<tr>";
                    echo "<td>".$uneReservation['date_resa']."</td>";
                    echo "<td>".$uneReservation['prix']."</td>";
                    echo "<td>".$uneReservation['dateDebutLoc']."</td>";
                    echo "<td>".$uneReservation['dateFinLoc']."</td>";
                    echo "<td>".$uneReservation['etat_resa']."</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </body>
    </html>
