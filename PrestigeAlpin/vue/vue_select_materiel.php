<h2>Liste du Matériel</h2>

<?php
// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele
$modele = new Modele();
$modele->setTable("materiel");
$lesMateriels = $modele->selectAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/tab.css">
</head>
<body>

<h3>Liste des matériels</h3>

<table border="1">
    <tr>
        <td>ID</td>
        <td>Nom</td>
        <td>Marque</td>
        <td>Prix Location</td>
        <td>Stock</td>
        <td>État</td>
        <td>Action</td>
    </tr>

    <?php
    if (isset($lesMateriels)) {
        foreach ($lesMateriels as $materiel) {
            echo "<tr>";
            echo "<td>".$materiel['id_materiel']."</td>";
            echo "<td>".$materiel['nom']."</td>";
            echo "<td>".$materiel['marque']."</td>";
            echo "<td>".$materiel['prix_loca']."</td>";
            echo "<td>".$materiel['stock_initial']."</td>";
            echo "<td>".$materiel['etat_materiel']."</td>";
            echo "<td>";
            if (isset($_SESSION['role']) && $_SESSION['role'] == "client") {
                echo "<form method='post' action='index.php?page=reservation'>";
                echo "<input type='hidden' name='id_materiel' value='".$materiel['id_materiel']."'>";
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
