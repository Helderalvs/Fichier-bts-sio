<?php
// Vérifiez si la session a déjà démarré
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifiez si l'utilisateur est connecté en tant que représentant
if (!isset($_SESSION['email']) || $_SESSION['role'] != "moniteur") {
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
    <!-- Inclure les liens vers les fichiers CSS, Bootstrap, etc. si nécessaire -->
</head>
<body>
    <h1>Bienvenue sur la page des représentants</h1>
    <!-- Ajoutez le contenu spécifique pour les représentants ici -->
    <p>Vous pouvez maintenant accéder aux fonctionnalités réservées aux représentants.</p>
    <!-- Par exemple, vous pouvez afficher une liste des produits à gérer, des clients à suivre, etc. -->
    <!-- Assurez-vous que seul le représentant peut accéder à cette page en vérifiant la session dans le code PHP ci-dessus -->
</body>
</html>
