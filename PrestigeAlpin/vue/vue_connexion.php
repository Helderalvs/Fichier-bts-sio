<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
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

<body>
	<div class="banner">
	<h2>Connexion</h2>
	<br>
	<form method="post">
		<td> Email </td>
		<td> <input type="text" name="email"></td>

		<td> Mdp </td>
		<td> <input type="password" name="mdp"></td>

		<td> <input type="submit" name="Connexion" value="Connexion"></td>
	</form>

	<p>Creer un compte ici ! <a href="gestion_inscription.php">Inscription</a></p>
	<p>Accueil <a href="index.php?page=1">Accueil</a></p>
	</div>

</body>
</html>
