<h2>Réserver Matériel</h2>

<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    echo "Veuillez vous connecter pour effectuer une réservation.";
    exit();
}

// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele pour la table des réservations
$modele_reservation = new Modele();
$modele_reservation->setTable("reservation");

// Traitement de la réservation
if (isset($_POST['reserver'])) {
    $id_user = $_SESSION['id_user'];
    $id_materiel = $_POST['id_materiel'];
    $date_resa = date("Y-m-d");
    $prix = $_POST['prix'];
    $dateDebutLoc = $_POST['dateDebutLoc'];
    $dateFinLoc = $_POST['dateFinLoc'];
    $etat_resa = 'en attente';

    $modele_reservation->insert(array(
        "id_user" => $id_user,
        "id_materiel" => $id_materiel,
        "date_resa" => $date_resa,
        "prix" => $prix,
        "dateDebutLoc" => $dateDebutLoc,
        "dateFinLoc" => $dateFinLoc,
        "etat_resa" => $etat_resa
    ));

    header("Location: index.php?page=5");
    exit();
}
?>

<form method="post">
    <input type="hidden" name="id_materiel" value="<?php echo $_POST['id_materiel']; ?>">
    Prix: <input type="text" name="prix"><br>
    Date début location: <input type="date" name="dateDebutLoc"><br>
    Date fin location: <input type="date" name="dateFinLoc"><br>
    <input type="submit" name="reserver" value="Réserver">
</form>
