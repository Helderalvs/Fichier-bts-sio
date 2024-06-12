<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <style>
	body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.banner {
  width: 100%;
  height: 100vh;
  background-size: cover;
  background-position: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: black;
}

.banner img {
  height: 150px;
  width: auto;
  margin-bottom: 20px;
}

.banner form {
  background-color: rgba(255, 255, 255, 0.8); /* Ajout d'une transparence au formulaire */
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Ajout d'une ombre légère */
}

.banner form h2 {
  margin-bottom: 20px;
  color: #007bff;
}

.banner form table {
  width: 100%;
}

.banner form table td {
  padding: 10px 0;
}

.banner form input[type="text"],
.banner form input[type="password"],
.banner form input[type="email"] {
  width: calc(100% - 20px); /* Largeur prenant en compte le padding */
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.banner form input[type="submit"] {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.banner form input[type="submit"]:hover {
  background-color: #0056b3;
}

.banner p {
  margin-top: 20px;
}

.banner p a {
  color: #007bff;
  text-decoration: none;
}

.banner p a:hover {
  text-decoration: underline;
}

</style>
<div class="banner">

<form method="post">
<h2>Inscription</h2>
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
            <td>Adresse</td>
            <td><input type="text" name="adresse" required></td>
        </tr>
        <tr>
            <td>Numéro de téléphone</td>
            <td><input type="text" name="telephone" required></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="Inscription" value="Inscription"></td>
        </tr>
    </table>
</form>
<p>Retourner à la page de connexion : <a href="gestion_connexion.php">Connexion</a></p>
<p>Accueil <a href="index.php?page=2">Accueil</a></p>
</div>
</body>
</html>
