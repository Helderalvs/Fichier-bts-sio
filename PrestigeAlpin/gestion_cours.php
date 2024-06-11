<?php
require_once("controleur/controleur.class.php");

// Instanciation de la classe Controleur
$unControleur = new Controleur();

$unControleur->setTable("cours"); // Définir le nom de la table sur "cours"

if (isset($_SESSION['role']) && $_SESSION['role'] == "client") {
    $unCours = null; // Initialiser la variable $unCours à null

    if (isset($_GET['action']) && isset($_GET['id_cours'])) {
        $action = $_GET['action'];
        $id_cours = $_GET['id_cours'];
        $where = array("id_cours" => $id_cours); // Définir le nom de la colonne sur "id_cours"

    }

    if (isset($_POST['Valider'])) {
        // Vérifier les données
        if ($unControleur->testVide($_POST)) {
            echo "<br> Veuillez remplir tous les champs.";
        } else {
            // Insérer le nouveau cours dans la base de données
            $tab = array(
                "nom_cours" => $_POST['nom_cours'],
                "description_cours" => $_POST['description_cours'],
                "niveau_difficulte" => $_POST['niveau_difficulte'],
                "date_cours" => $_POST['date_cours'],
                "duree_cours" => $_POST['duree_cours'],
                "prix_cours" => $_POST['prix_cours'],
                "nb_personne" => $_POST['nb_personne']
            );
            $unControleur->insert($tab);
        }
    }

    if (isset($_POST['Modifier'])) {
        // Vérifier les données
        if ($unControleur->testVide($_POST)) {
            echo "<br> Veuillez remplir tous les champs.";
        } else {
            // Mettre à jour le cours dans la base de données
            $tab = array(
                "nom_cours" => $_POST['nom_cours'],
                "description_cours" => $_POST['description_cours'],
                "niveau_difficulte" => $_POST['niveau_difficulte'],
                "date_cours" => $_POST['date_cours'],
                "duree_cours" => $_POST['duree_cours'],
                "prix_cours" => $_POST['prix_cours'],
                "nb_personne" => $_POST['nb_personne']
            );
            $where = array("id_cours" => $id_cours);
            $unControleur->update($tab, $where);
            // Actualiser la page
            header("Location: index.php?page=4");
        }
    }
} // Fin de la session admin

if (isset($_POST['Filtrer'])) {
    $filtre = $_POST['filtre'];
    $where = array("id_cours", "nom_cours", "description_cours", "prix_cours", "niveau_difficulte");
    $lesCours = $unControleur->selectLike($where, $filtre);
} else {
    $lesCours = $unControleur->selectAll();
}

require_once("vue/vue_select_cours.php");

?>