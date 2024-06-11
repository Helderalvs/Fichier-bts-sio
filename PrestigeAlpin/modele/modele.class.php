<?php
	class Modele {
		private $unPDO ; //php data object 
		private $table ;

		public function __construct (){
			try{
			$url ="mysql:host=localhost;dbname=prestigeAlpin"; 
			$user = "root"; 
			$mdp =""; 
			//instanciation de la classe PDO 
			$this->unPDO = new PDO($url, $user, $mdp);
			}
			
			catch (PDOException $exp){
				echo "Erreur connexion BDD : ".$exp->getMessage (); 
			}
		}
		public function setTable ($table) {
			$this->table= $table ;
		}
		
		/**************** Gestion des classes  ***********/
	public function insert($tab) {
		$champs = array();
		$valeurs = array();
		foreach ($tab as $cle => $valeur) {
			$champs[] = $cle;
			$valeurs[] = ":" . $cle;
			$donnees[":" . $cle] = $valeur;
		}
		$liste_champs = implode(", ", $champs);
		$liste_valeurs = implode(", ", $valeurs);
		$requete = "INSERT INTO " . $this->table . " (" . $liste_champs . ") VALUES (" . $liste_valeurs . ")";
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
	}
	
		public function selectAll(){
			$requete ="select * from ".$this->table.";";
			$select = $this->unPDO->prepare ($requete); 
			$select->execute();
			return $select->fetchAll(); 
		}
		public function delete($where){
			$champs = array();
			$donnees = array();
			foreach($where as $cle => $valeur){
				$champs [] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaine = implode(" and ", $champs);
			$requete ="delete from ".$this->table." where ".$chaine.";";
			$select = $this->unPDO->prepare($requete); 
			$select->execute($donnees);
		}		
		public function selectWhere ($where){
			$champs = array();
			$donnes = array();
			foreach($where as $cle =>$valeur){
				$champs[] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaine = implode(" and ", $champs);
			$requete="select * from ".$this->table." where ".$chaine.";";
			$select = $this->unPDO->prepare ($requete); 
			$select->execute($donnees);
			return $select->fetch() ; //un seul résultat
		}
		public function update ($tab,$where){
			$champs = array();
			$donnes = array();
			foreach($where as $cle =>$valeur){
				$champs[] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaine = implode(" and ", $champs);

			$champsSet = array();
			foreach($tab as $cle =>$valeur){
				$champsSet[] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaineSet = implode(", ", $champsSet);
			$requete ="update ".$this->table." set ".$chaineSet." where ".$chaine." ;";
			$select = $this->unPDO->prepare ($requete); 
			$select->execute($donnees);
		}
		public function selectLike ($where,$filtre){
			$chaine = "";
			$champs = array();
			foreach($where as $cle) {
				$champs[] = $cle." like :filtre ";
			}
			$chaine = implode(" or ", $champs);
			$requete ="select * from ".$this->table." where ".$chaine.";";
			$select = $this->unPDO->prepare ($requete); 
			$donnees=array(":filtre"=>"%".$filtre."%");
			$select->execute($donnees);
			return $select->fetchAll(); 
		}

		public function count(){
			$requete = "select count(*) as nb from ".$this->table.";";
			$select = $this->unPDO->prepare ($requete); 
			$select->execute();
			return $select->fetch();
		}

		
    // Méthode pour compter le nombre de résultats avec filtre LIKE
    public function countLike($where, $filtre) {
        // Générer la clause WHERE pour le filtre LIKE
        $where_clause = '';
        foreach ($where as $column) {
            $where_clause .= "$column LIKE '%$filtre%' OR ";
        }
        $where_clause = rtrim($where_clause, ' OR ');

        // Construction de la requête SQL
        $sql = "SELECT COUNT(*) AS total FROM {$this->table}";
        if (!empty($where_clause)) {
            $sql .= " WHERE $where_clause";
        }

        // Exécution de la requête et récupération du résultat
        // Ici, vous devez implémenter la manière dont vous exécutez la requête SQL
        // et récupérez le résultat, par exemple avec PDO ou MySQLi
        // $result = $this->db->query($sql);
        // $total = $result->fetchColumn();
        // return $total;

        // À titre d'exemple, retourner un nombre aléatoire
        return rand(1, 100); // À remplacer par la vraie logique de comptage
    }

    // Méthode pour compter le nombre total de résultats
    public function countAll() {
        // Construction de la requête SQL
        $sql = "SELECT COUNT(*) AS total FROM {$this->table}";

        // Exécution de la requête et récupération du résultat
        // Ici, vous devez implémenter la manière dont vous exécutez la requête SQL
        // et récupérez le résultat, par exemple avec PDO ou MySQLi
        // $result = $this->db->query($sql);
        // $total = $result->fetchColumn();
        // return $total;

        // À titre d'exemple, retourner un nombre aléatoire
        return rand(1, 100); // À remplacer par la vraie logique de comptage
    }

	public function insertReservation($reservationData) {
		// Construction de la requête SQL pour insérer une réservation
		$requete = "INSERT INTO reservation (date_resa, prix, dateDebuLoc, dateFinLoc, etat_resa) VALUES (:date_resa, :prix, :dateDebuLoc, :dateFinLoc, :etat_resa)";
	
		// Préparation de la requête
		$insertion = $this->unPDO->prepare($requete);
	
		// Exécution de la requête avec les données de réservation
		$insertion->execute(array(
			":date_resa" => $reservationData["date_resa"],
			":prix" => $reservationData["prix"],
			":dateDebuLoc" => $reservationData["dateDebuLoc"],
			":dateFinLoc" => $reservationData["dateFinLoc"],
			":etat_resa" => $reservationData["etat_resa"]
		));
	
		// Vérification si l'insertion a réussi
		if ($insertion) {
			return true; // Retourne vrai si l'insertion a réussi
		} else {
			return false; // Retourne faux si l'insertion a échoué
		}
	}
	
		/************ Connexion ***************************/
/*
		public function verifConnexion($email, $mdp, $userType) {
			try {
				// Vérifie les identifiants dans la base de données selon le type d'utilisateur
				$tableName = ($userType == "client") ? "client" : "representant";
				$query = $this->unPDO->prepare("SELECT * FROM $tableName WHERE email = :email AND mdp = :mdp");
				$query->bindParam(":email", $email);
				$query->bindParam(":mdp", $mdp);
				$query->execute();
				$result = $query->fetch(PDO::FETCH_ASSOC);
	
				return $result; // Retourne les informations de l'utilisateur s'il est trouvé, sinon retourne null
			} catch (PDOException $e) {
				echo "Erreur lors de la vérification de connexion : " . $e->getMessage();
				return null;
			}
		}
		*/

		public function verifConnexion($email, $mdp) {
			try {
				// Vérifie les identifiants dans la base de données
				$query = $this->unPDO->prepare("SELECT * FROM user WHERE email = :email");
				$query->bindParam(":email", $email);
				$query->execute();
				$result = $query->fetch(PDO::FETCH_ASSOC);
		
				if ($result) {
					// Vérifie si le mot de passe haché correspond
					if ($mdp === $result['mdp']) {
						// Le mot de passe est correct, retourne les informations de l'utilisateur
						return $result;
					} else {
						// Le mot de passe ne correspond pas, retourne null
						return null;
					}
				} else {
					// Aucun utilisateur trouvé avec cet email, retourne null
					return null;
				}
			} catch (PDOException $e) {
				echo "Erreur lors de la vérification de connexion : " . $e->getMessage();
				return null;
			}
		}
		
		

		/************ inscription **********/
		public function verifInscription($nom, $prenom, $email, $mdp, $userType) {
			try {
				// Vérifie si l'email existe déjà dans la table user
				$query = $this->unPDO->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
				$query->bindParam(":email", $email);
				$query->execute();
				$count = $query->fetchColumn();
		
				if ($count > 0) {
					echo "Cet email est déjà utilisé.";
					return false;
				}
		
				// Insère les données dans la table appropriée en fonction du type d'utilisateur
				$tableName = ($userType == "client") ? "client" : "moniteur";
				$query = $this->unPDO->prepare("INSERT INTO $tableName (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)");
				$query->bindParam(":nom", $nom);
				$query->bindParam(":prenom", $prenom);
				$query->bindParam(":email", $email);
				$query->bindParam(":mdp", $mdp);
				$query->execute();
		
				return true;
			} catch (PDOException $e) {
				echo "Erreur lors de l'inscription : " . $e->getMessage();
				return false;
			}
		}
		

		 // Fonction de vérification de l'inscription pour un client
		 public function verifInscriptionClient($nom, $prenom, $email, $mdp) {
			try {
				// Vérifie si l'email existe déjà dans la table user
				$query = $this->unPDO->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
				$query->bindParam(":email", $email);
				$query->execute();
				$count = $query->fetchColumn();
	
				if ($count > 0) {
					echo "Cet email est déjà utilisé.";
					return false;
				}
	
				// Insère les données dans la table client
				$query = $this->unPDO->prepare("INSERT INTO client (nom, prenom, email, mdp, role) VALUES (:nom, :prenom, :email, :mdp, 'client')");
				$query->bindParam(":nom", $nom);
				$query->bindParam(":prenom", $prenom);
				$query->bindParam(":email", $email);
				$query->bindParam(":mdp", $mdp);
				$query->execute();
	
				return true;
			} catch (PDOException $e) {
				echo "Erreur lors de l'inscription : " . $e->getMessage();
				return false;
			}
		}
	
		// Fonction de vérification de l'inscription pour un représentant
		public function verifInscriptionRepresentant($nom, $prenom, $email, $mdp) {
			try {
				// Vérifie si l'email existe déjà dans la table user
				$query = $this->unPDO->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
				$query->bindParam(":email", $email);
				$query->execute();
				$count = $query->fetchColumn();
	
				if ($count > 0) {
					echo "Cet email est déjà utilisé.";
					return false;
				}
	
				// Insère les données dans la table representant
				$query = $this->unPDO->prepare("INSERT INTO moniteur (nom, prenom, email, mdp, role) VALUES (:nom, :prenom, :email, :mdp, 'moniteur')");
				$query->bindParam(":nom", $nom);
				$query->bindParam(":prenom", $prenom);
				$query->bindParam(":email", $email);
				$query->bindParam(":mdp", $mdp);
				$query->execute();
	
				return true;
			} catch (PDOException $e) {
				echo "Erreur lors de l'inscription : " . $e->getMessage();
				return false;
			}
		}


	}


	
?>






