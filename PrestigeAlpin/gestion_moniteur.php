<?php
// Vérifiez si la session a déjà démarré
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifiez si l'utilisateur est connecté en tant que représentant
if ( ! isset($_SESSION['email']) || $_SESSION['role'] != "moniteur") {
    // Si l'utilisateur n'est pas connecté ou n'est pas un représentant, redirigez-le vers la page de connexion
    header("Location: index.php");
    exit();
}

// Maintenant que l'utilisateur est authentifié en tant que représentant, vous pouvez afficher le contenu de la page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Représentant</title>
    <link rel="stylesheet" href="css/style_front.css">
    
    <!-- Inclure les liens vers les fichiers CSS, Bootstrap, etc. si nécessaire -->
</head>
<body>
    <h1>Bienvenue sur la page des Moniteurs</h1>
    <br> 
    <h2> Liste des moniteurs </h2> 
    <?php
    // Inclure la classe Modele
    require_once('modele/modele.class.php');

    // Créer une instance de la classe Modele pour la table des réservations
    $modele_reservation = new Modele();
    $modele_reservation->setTable("moniteur");
    $lesMoniteurs = $modele_reservation->selectAll();
    ?>
    <br>
    <table border="1">
        <tr>
            <td> Nom</td>
            <td> Prénom</td>
            <td> Email </td>
            <td> Adresse </td>
            <td> Téléphone</td>
            <td> Ville - Code Postal </td>
            <td>Date Début </td>
        </tr>
    
        <?php
        if (isset($lesMoniteurs)) {
            foreach ($lesMoniteurs as $unMoniteur) {
                echo "<tr>";
                echo "<td>".$unMoniteur['nom']."</td>";
                echo "<td>".$unMoniteur['prenom']."</td>";
                echo "<td>".$unMoniteur['email']."</td>";
                echo "<td>".$unMoniteur['adresse']."</td>";
                echo "<td>".$unMoniteur['telephone']."</td>";
                echo "<td>".$unMoniteur['ville']." - " .$unMoniteur['cp']."</td>";
                echo "<td>".$unMoniteur['date_debut']."</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

</body>
</html>
