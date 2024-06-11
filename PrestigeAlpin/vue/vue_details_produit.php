<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du produit</title>
    <!-- Inclure ici les liens vers les fichiers CSS, le cas échéant -->
</head>
<body>
    <h1>Détails du produit</h1>
    <?php
    // Afficher les détails du produit récupérés dans votre script PHP
    echo "<p>Nom du matériel : " . $produit['nom'] . "</p>";
    echo "<p>Marque : " . $produit['marque'] . "</p>";
    echo "<p>Prix de location : " . $produit['prix_loca'] . " €</p>";
    echo "<p>Stock initial : " . $produit['stock_initial'] . "</p>";
    echo "<p>État du matériel : " . $produit['etat_materiel'] . "</p>";

    // Afficher les détails spécifiques à la table mat_neige
    if ($produit['role'] == 'mat_neige') {
        echo "<p>Longueur des skis : " . $produit['longeur_skis'] . " cm</p>";
        echo "<p>Type de fixation : " . $produit['type_fixation'] . "</p>";
        echo "<p>Niveau d'usure : " . $produit['niveau_usure'] . "</p>";
        echo "<p>Type de ski : " . $produit['type_ski'] . "</p>";
    }
    
    // Afficher les détails spécifiques à la table mat_rando
    if ($produit['role'] == 'mat_rando') {
        echo "<p>Taille du harnais : " . $produit['taille_harnais'] . " cm</p>";
        echo "<p>Type de corde : " . $produit['type_corde'] . "</p>";
        echo "<p>Poids maximal : " . $produit['poids_max'] . " kg</p>";
        echo "<p>Type d'ancrage : " . $produit['type_ancrage'] . "</p>";
        echo "<p>Niveau de rigidité : " . $produit['niveau_regidite'] . "</p>";
    }
    ?>
    <!-- Inclure ici d'autres éléments HTML selon vos besoins -->
</body>
</html>
