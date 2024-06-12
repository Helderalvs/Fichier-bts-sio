<?php
		session_start(); 
		require_once("controleur/controleur.class.php");
		//instanciation de la classe Controleur
		$unControleur = new Controleur (); 
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Site Prestige Alpin</title>
		<meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
		rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
		crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
		integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
		crossorigin="anonymous"></script>
		<link rel="stylesheet" href="bootstrap/bootstrap (2).css">
		<link rel="stylesheet" href="bootstrap/bootstrap.min (2).css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
	<center>
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="images/neige&soleil.jpg" height="75px" width="100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'moniteur'){
      echo '<div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=2">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=5">Les cours</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=10">Les réservations</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?page=13">Votre planning</a>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=12">Mon compte</a>
        </li>
        <li>
          <a class="nav-link" href="index.php?page=7">Me déconnecter</a>
        </li>
        </ul> 
      </div>';
    }else if(isset($_SESSION['role']) && $_SESSION['role'] == 'client'){
      echo '<div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=2">Accueil</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Nos Materiaux
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?page=3">Neige</a></li>
            <li><a class="dropdown-item" href="index.php?page=4">Randonnée</a></li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=5">Nos cours</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?page=10">Vos réservations</a>
      </li>
         <li class="nav-item">
        <a class="nav-link" href="index.php?page=20">Vos réservations cours</a>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=12">Mon compte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=7">Me déconnecter</a>
        </li>
      </ul>
    </div>';
    }else{
      echo '<div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=2">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=8">S"inscrire</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=9">Se connecter </a>
        </li>
      </ul>
    </div>';
    }
    ?>
    
  </div>
</nav>
  </header>
<center>
    <?php 

    if (isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page=1;
    }
    switch($page){
        case 2: require_once("home.php"); break;
        case 3: require_once("gestion_materiel_neige.php"); break;
        case 4: require_once("gestion_materiel_rando.php"); break;
        case 5: require_once("gestion_cours.php"); break;
        case 8: require_once("gestion_inscription.php"); break;
        case 9: require_once("gestion_connexion.php"); break; 
       // case 10: require_once("reserver.php"); break; 
        case 10: require_once("gestion_reservation.php"); break; 
        case 20: require_once("gestion_reservation_cours.php"); break; 
        case 11: require_once("Confirmation.php"); break;
        case 12: require_once("profil.php"); break;
        case 13: require_once("gestion_planning.php"); break;
        case 7: session_destroy(); unset($_SESSION['role']);header("Location: index.php");break;
        default: require_once("home.php"); break;
    }
    ?>
</center>
</body>
</html>