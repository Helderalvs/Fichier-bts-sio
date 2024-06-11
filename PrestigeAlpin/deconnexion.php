<?php
// deconnexion.php

// Démarre la session
session_start();

// Détruit la session
session_destroy();

// Unset la variable de session spécifique (dans votre cas, 'email')
unset($_SESSION['email']);

// Redirige l'utilisateur vers la page d'accueil (index.php)
header("Location: index.php");
?> 
