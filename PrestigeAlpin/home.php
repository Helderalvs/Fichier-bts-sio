<?php
// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele
$modele = new Modele();

// Définir la table à utiliser pour les matériaux de ski
$modele->setTable("mat_neige");

// Récupérer tous les matériaux de ski
$lesMatNeige = $modele->selectAll();

$filtre = isset($_POST['filtre']) ? $_POST['filtre'] : ''; // Récupérer la valeur du filtre depuis le formulaire

if (!empty($filtre)) {
    $where = array("nom", "marque"); // Champs sur lesquels vous souhaitez appliquer le filtre
    $lesMatNeige = $modele->selectLike($where, $filtre);
} else {
    $lesMatNeige = $modele->selectAll();
}

// Définir la table à utiliser pour les cours
$modele->setTable("cours");
$lesCours = $modele->selectAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tab.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .banner {
            height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            position: relative;
        }

        .content {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

        .content p {
            font-size: 24px;
            margin: 20px 0;
        }

        .content button {
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .content button:hover {
            background-color: #e65c00;
        }

        .sections {
            padding: 50px 20px;
            text-align: center;
        }

        .section {
            margin: 20px 0;
        }

        .section h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 18px;
            color: #666;
        }

        .courses, .materials {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .item {
            background: #fff;
            padding: 20px;
            margin: 10px;
            width: 30%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: left;
        }

        .item img {
            max-width: 100%;
            border-radius: 10px;
        }

        .item h3 {
            font-size: 24px;
            color: #333;
            margin-top: 15px;
        }

        .item p {
            color: #666;
            margin: 10px 0;
        }

        .filter-form {
            text-align: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .item {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="banner">
        <div class="content">
            <p>Explorer et S'amuser ? Alors équipez-vous !!</p>
            <?php if (!isset($_SESSION['role'])) { ?>
                <div>
                    <a href="index.php?page=8">
                        <button type="button">S'inscrire <span></span></button>
                    </a>
                    <a href="index.php?page=9">
                        <button type="button">Se connecter<span></span></button>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="sections">
        <!-- Section Matériels de Ski -->
        <div class="section">
            <h2>Liste Matériel de Ski</h2>
            <form method="post" class="filter-form">
                Filtrer par : <input type="text" name="filtre">
                <input type="submit" name="Filtrer" value="Filtrer">
            </form>
            <div class="materials">
                <?php if (isset($lesMatNeige)) {
                    foreach ($lesMatNeige as $unMatNeige) {
                        echo "<div class='item'>";
                        echo "<h3>".$unMatNeige['nom']."</h3>";
                        echo "<p>Marque : ".$unMatNeige['marque']."</p>";
                        echo "<p>Prix location : ".$unMatNeige['prix_loca']." €</p>";
                        echo "<p>Stock : ".$unMatNeige['stock_initial']."</p>";
                        echo "<p>État : ".$unMatNeige['etat_materiel']."</p>";
                        if (isset($_SESSION['role']) && $_SESSION['role'] == "client") {
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='id_materiel' value='".$unMatNeige['id_materiel']."'>";
                            echo "Date début location : <input type='date' name='dateDebutLoc' required>";
                            echo "Date fin location : <input type='date' name='dateFinLoc' required>";
                            echo "<input type='submit' name='reserver' value='Réserver'>";
                            echo "</form>";
                        }
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>

        <!-- Section Cours -->
        <div class="section">
            <h2>Liste des Cours</h2>
            <div class="courses">
                <?php if (isset($lesCours)) {
                    foreach ($lesCours as $cours) {
                        echo "<div class='item'>";
                        echo "<h3>".$cours['nom_cours']."</h3>";
                        echo "<p>Description : ".$cours['description_cours']."</p>";
                        echo "<p>Niveau : ".$cours['niveau_difficulte']."</p>";
                        echo "<p>Date : ".$cours['date_cours']."</p>";
                        echo "<p>Durée : ".$cours['duree_cours']." heures</p>";
                        echo "<p>Prix : ".$cours['prix_cours']." €</p>";
                        if (isset($_SESSION['role']) && $_SESSION['role'] == "client") {
                            echo "<form method='post' action='index.php?page=6'>";
                            echo "<input type='hidden' name='id_cours' value='".$cours['id_cours']."'>";
                            echo "<input type='submit' name='reserver' value='Réserver'>";
                            echo "</form>";
                        }
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
