
<?php
// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele
$modele = new Modele();

// Définir la table à utiliser
$modele->setTable("mat_rando");

// Récupérer tous les matériaux de ski
$lesMatNeige = $modele->selectAll();

$filtre = isset($_POST['filtre']) ? $_POST['filtre'] : ''; // Récupérer la valeur du filtre depuis le formulaire

if (!empty($filtre)) {
    $where = array("nom", "marque"); // Champs sur lesquels vous souhaitez appliquer le filtre
    $lesMatNeige = $modele->selectLike($where, $filtre);
} else {
    $lesMatNeige = $modele->selectAll();
}
?>

<h3>Liste matériel ski</h3>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/tab.css">

<form method="post">
    Filtrer par : <input type="text" name="filtre">
    <input type="submit" name="Filtrer" value="Filtrer">
</form>
<br>
<table border="1">
    <tr>
        <td>ID mat</td>
        <td>Nom</td>
        <td>Marque</td>
        <td>Prix loca</td>
        <td>Stock</td>
        <td>État matériel</td>
    </tr>

    <?php
    if (isset($lesMatNeige)) {
        foreach ($lesMatNeige as $unMatNeige) {
            echo "<tr>";
            echo "<td>".$unMatNeige['id_materiel']."</td>";
            echo "<td>".$unMatNeige['nom']."</td>";
            echo "<td>".$unMatNeige['marque']."</td>";
            echo "<td>".$unMatNeige['prix_loca']."</td>";
            echo "<td>".$unMatNeige['stock_initial']."</td>";
            echo "<td>".$unMatNeige['etat_materiel']."</td>";
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
                echo "<td>";
                echo "<a href='index.php?page=2&action=sup&id_materiel=".$unMatNeige['id_materiel']."'>
                    <img src='images/supprimer.png' height='30' width='30'>
                    </a>";
                echo "<a href='index.php?page=2&action=edit&id_materiel=".$unMatNeige['id_materiel']."'>
                    <img src='images/editer.png' height='30' width='30'>
                    </a>";
                echo "</td>";
            }
            echo "</tr>";
        }
    }
    ?>
</table>