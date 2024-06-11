<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="banner">

<form method="post">
    <table>
        <tr>
            <td>Nom</td>
            <td><input type="text" name="nom" required></td>
        </tr>
        <tr>
            <td>Prénom</td>
            <td><input type="text" name="prenom" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td>Mot de passe</td>
            <td><input type="password" name="mdp" required></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="Inscription" value="Inscription"></td>
        </tr>
    </table>
</form>
<p>Retourner à la page de connexion : <a href="gestion_connexion.php">Connexion</a></p>
<p>Accueil <a href="index.php?page=2	">Accueil</a></p>
</div>
</body>
</html>
