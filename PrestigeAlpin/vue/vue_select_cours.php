<h2>Liste des Cours</h2>

<?php
// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele
$modele = new Modele();
$modele->setTable("cours");
$lesCours = $modele->selectAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/tab.css">
</head>
<body>

<h3>Liste des cours</h3>

<table border="1">
    <tr>
        <td>ID</td>
        <td>Nom</td>
        <td>Description</td>
        <td>Niveau</td>
        <td>Date</td>
        <td>Durée</td>
        <td>Prix</td>
        <td>Action</td>
    </tr>

    <?php
    if (isset($lesCours)) {
        foreach ($lesCours as $cours) {
            echo "<tr>";
            echo "<td>".$cours['id_cours']."</td>";
            echo "<td>".$cours['nom_cours']."</td>";
            echo "<td>".$cours['description_cours']."</td>";
            echo "<td>".$cours['niveau_difficulte']."</td>";
            echo "<td>".$cours['date_cours']."</td>";
            echo "<td>".$cours['duree_cours']."</td>";
            echo "<td>".$cours['prix_cours']."</td>";
            echo "<td>";
            if (isset($_SESSION['role']) && $_SESSION['role'] == "client") {
                echo "<form method='post' action='gestion_reservation.php'>";
                echo "<input type='hidden' name='id_cours' value='".$cours['id_cours']."'>";
                echo "<input type='submit' name='reserver' value='Réserver'>";
                echo "</form>";
            }
            echo "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>

</body>
</html>
<h2>Liste des Cours</h2>

<?php
// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele
$modele = new Modele();
$modele->setTable("cours");
$lesCours = $modele->selectAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/tab.css">
</head>
<body>

<h3>Liste des cours</h3>

<table border="1">
    <tr>
        <td>ID</td>
        <td>Nom</td>
        <td>Description</td>
        <td>Niveau</td>
        <td>Date</td>
        <td>Durée</td>
        <td>Prix</td>
        <td>Action</td>
    </tr>

    <?php
    if (isset($lesCours)) {
        foreach ($lesCours as $cours) {
            echo "<tr>";
            echo "<td>".$cours['id_cours']."</td>";
            echo "<td>".$cours['nom_cours']."</td>";
            echo "<td>".$cours['description_cours']."</td>";
            echo "<td>".$cours['niveau_difficulte']."</td>";
            echo "<td>".$cours['date_cours']."</td>";
            echo "<td>".$cours['duree_cours']."</td>";
            echo "<td>".$cours['prix_cours']."</td>";
            echo "<td>";
            if (isset($_SESSION['role']) && $_SESSION['role'] == "client") {
                echo "<form method='post' action='gestion_reservation.php'>";
                echo "<input type='hidden' name='id_cours' value='".$cours['id_cours']."'>";
                echo "<input type='submit' name='reserver' value='Réserver'>";
                echo "</form>";
            }
            echo "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>

</body>
</html>
