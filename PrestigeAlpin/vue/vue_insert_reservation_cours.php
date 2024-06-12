    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Démarrer la session uniquement si elle n'est pas déjà active
    }

    // Vérifier si l'utilisateur est connecté en tant que client
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'client') {
        // Afficher le formulaire de réservation
        ?>
        <form method="post" action="reserver_cours.php">
        <link rel="stylesheet" href="css/reservation.css">
            <label for="id_cours">Cours :</label>
            <select name="id_cours" id="id_cours" required>
                <?php
                // Récupérer tous les cours pour remplir le menu déroulant
                $modele_cours = new Modele();
                $modele_cours->setTable("cours");
                $lesCours = $modele_cours->selectAll();
                foreach ($lesCours as $cours) {
                    if ($cours['id_cours'] == $id_cours){
                    echo '<option value="'.$cours['id_cours'].'">'.$cours['nom_cours'].'</option>';
                    }   
                }
                ?>
            </select>
            <br>
            <label for="dateHeureDebut">Date début location :</label>
            <input type="date" name="dateHeureDebut" id="dateHeureDebut" required>
            <br>
            <label for="dateHeureFin">Date fin location :</label>
            <input type="date" name="dateHeureFin" id="dateHeureFin" required>
            <br>
            <label for="prix_cours">Prix cours :</label>
            <input type="text" name="prix_cours" id="prix_cours" readonly value='<?= $prix_cours ?>'>
            <br>
            <br>
            <input type="submit" name="reserve_btn" value="Réserver">
            <a href="vue/vue_select_mat_neige.php">Retour au matériel</a>
        </form>

        <?php
    } else {
        // Rediriger vers la page de connexion
        header("Location: index.php?page=10");
        exit(); // Arrêter l'exécution du script après la redirection
    }
    ?>
