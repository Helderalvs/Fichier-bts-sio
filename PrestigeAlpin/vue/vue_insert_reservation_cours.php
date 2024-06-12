    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Démarrer la session uniquement si elle n'est pas déjà active
    }

    // Vérifier si l'utilisateur est connecté en tant que client
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'client') {
        // Afficher le formulaire de réservation
        ?>
        <form method="post" action="reserver.php">
            <label for="id_cours">Cours :</label>
            <select name="id_cours" id="id_cours" required>
                <?php
                // Récupérer tous les cours pour remplir le menu déroulant
                $modele_cours = new Modele();
                $modele_cours->setTable("cours");
                $lesCours = $modele_cours->selectAll();
                foreach ($lesCours as $cours) {
                    echo '<option value="'.$cours['id_cours'].'">'.$cours['nom_cours'].'</option>';
                }
                ?>
            </select>
            <br>
            <label for="dateDebutLoc">Date début location :</label>
            <input type="date" name="dateDebutLoc" id="dateDebutLoc" required>
            <br>
            <label for="dateFinLoc">Date fin location :</label>
            <input type="date" name="dateFinLoc" id="dateFinLoc" required>
            <br>
            <input type="submit" name="reserve_btn" value="Réserver">
        </form>

        <?php
    } else {
        // Rediriger vers la page de connexion
        header("Location: index.php?page=10");
        exit(); // Arrêter l'exécution du script après la redirection
    }
    ?>
