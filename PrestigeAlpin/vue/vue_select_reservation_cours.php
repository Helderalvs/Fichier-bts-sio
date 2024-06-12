<?php

// Inclure la classe Modele
require_once('modele/modele.class.php');

// Créer une instance de la classe Modele pour la table des réservations
$modele_reservation = new Modele();
$modele_reservation->setTable("inscription");
if (isset($_GET['action']) && isset($_GET['cle'])){
    $action = $_GET['action']; 
    $cle = $_GET['cle'];
    $tab = explode ("_", $cle); 
    $where = array("id_user"=>$tab[0], "id_cours"=>$tab['1'], "date_resa"=>$tab[2]); 
    $donnees = array("etat_resa"=>"valide"); 
    $modele_reservation->update($donnees, $where);
}


$where =array("id_user"=>$_SESSION['id_user']);
$role =  $_SESSION['role'] ; 
if ($role =="client"){
    $lesInscriptions = $modele_reservation->selectWhereAll($where);
}else {
    $lesInscriptions = $modele_reservation->selectAll();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style_front.css">
</head>
<body>
    <h3>Liste des réservations cours</h3>

    <form method="post">
        Filtrer par : <input type="text" name="filtre">
        <input type="submit" name="Filtrer" value="Filtrer">
    </form>
    <br>
    <table border="1">
        <tr>
            <td>Date réservation</td>
            <td>Nom du cours</td>
            
            <td>Prix du cours</td>
        
            <td>Date début cours</td>
            <td>Date fin cours</td>
            <td>État réservation</td>
            <?php
               if ($role == "moniteur"){
            echo " <td> Confirmation </td> ";
               }
            ?>
        </tr>

        <?php
        $modele_reservation->setTable("cours");
        if (isset($lesInscriptions)) {
            foreach ($lesInscriptions as $unCours) {
                echo "<tr>";
                echo "<td>".date('d/m/Y', strtotime($unCours['date_resa']))."</td>";
                $where =array("id_cours"=>$unCours['id_cours']);
                $leCours = $modele_reservation->selectWhere ($where);
                echo "<td>".$leCours['nom_cours']."</td>";
                
                echo "<td>".$unCours['prix']." €</td>";
                echo "<td>".date('d/m/Y', strtotime($unCours['dateHeureDebut']))."</td>";
                echo "<td>".date('d/m/Y', strtotime($unCours['dateHeureFin']))."</td>";
                echo "<td>".$unCours['etat_resa']."</td>";
                $cle = $unCours['id_user']."_".$unCours['id_cours']."_".$unCours['date_resa'];
                if ($role == "moniteur"){
                echo "<td> ";
                echo "<a href='index.php?page=20&action=confirme&cle=".$cle."'>Confirmer</a>"; 
                echo "</td>";
                }
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>