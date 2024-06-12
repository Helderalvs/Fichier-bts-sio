<?php
class Modele {
	private $unPDO; //php data object 
	private $table;

	public function __construct() {
		try {
			$url = "mysql:host=localhost;dbname=prestigeAlpin";
			$user = "root";
			$mdp = "";
			//instanciation de la classe PDO 
			$this->unPDO = new PDO($url, $user, $mdp);
		} catch (PDOException $exp) {
			echo "Erreur connexion BDD : " . $exp->getMessage();
		}
	}

	public function setTable($table) {
		$this->table = $table;
	}

	/**************** Gestion des classes ***********/
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

	public function selectAll() {
		$requete = "select * from " . $this->table . ";";
		$select = $this->unPDO->prepare($requete);
		$select->execute();
		return $select->fetchAll();
	}

	public function delete($where) {
		$champs = array();
		$donnees = array();
		foreach ($where as $cle => $valeur) {
			$champs[] = $cle . " = :" . $cle;
			$donnees[":" . $cle] = $valeur;
		}
		$chaine = implode(" and ", $champs);
		$requete = "delete from " . $this->table . " where " . $chaine . ";";
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
	}

	public function selectWhere($where) {
		$champs = array();
		$donnees = array();
		foreach ($where as $cle => $valeur) {
			$champs[] = $cle . " = :" . $cle;
			$donnees[":" . $cle] = $valeur;
		}
		$chaine = implode(" and ", $champs);
		$requete = "select * from " . $this->table . " where " . $chaine . ";";
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
		return $select->fetch(); //un seul résultat
	}

	public function update($tab, $where) {
		$champs = array();
		$donnees = array();
		foreach ($where as $cle => $valeur) {
			$champs[] = $cle . " = :" . $cle;
			$donnees[":" . $cle] = $valeur;
		}
		$chaine = implode(" and ", $champs);

		$champsSet = array();
		foreach ($tab as $cle => $valeur) {
			$champsSet[] = $cle . " = :" . $cle;
			$donnees[":" . $cle] = $valeur;
		}
		$chaineSet = implode(", ", $champsSet);
		$requete = "update " . $this->table . " set " . $chaineSet . " where " . $chaine . " ;";
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
	}

	public function selectLike($where, $filtre) {
		$chaine = "";
		$champs = array();
		foreach ($where as $cle) {
			$champs[] = $cle . " like :filtre ";
		}
		$chaine = implode(" or ", $champs);
		$requete = "select * from " . $this->table . " where " . $chaine . ";";
		$select = $this->unPDO->prepare($requete);
		$donnees = array(":filtre" => "%" . $filtre . "%");
		$select->execute($donnees);
		return $select->fetchAll();
	}

	public function count() {
		$requete = "select count(*) as nb from " . $this->table . ";";
		$select = $this->unPDO->prepare($requete);
		$select->execute();
		return $select->fetch();
	}

	// Méthode pour compter le nombre de résultats avec filtre LIKE
	public function countLike($where, $filtre) {
		$chaine = "";
		foreach ($where as $cle) {
			$chaine .= $cle . " like :filtre or ";
		}
		$chaine = rtrim($chaine, " or ");
		$requete = "select count(*) as total from " . $this->table . " where " . $chaine . ";";
		$select = $this->unPDO->prepare($requete);
		$donnees = array(":filtre" => "%" . $filtre . "%");
		$select->execute($donnees);
		return $select->fetch();
	}

	// Méthode pour compter le nombre total de résultats
	public function countAll() {
		$requete = "select count(*) as total from " . $this->table . ";";
		$select = $this->unPDO->prepare($requete);
		$select->execute();
		return $select->fetch();
	}

	public function insertReservation($reservationData) {
		// Construction de la requête SQL pour insérer une réservation
		$requete = "INSERT INTO reservation (date_resa, prix, dateDebutLoc, dateFinLoc, etat_resa) VALUES (:date_resa, :prix, :dateDebutLoc, :dateFinLoc, :etat_resa)";
		// Préparation de la requête
		$insertion = $this->unPDO->prepare($requete);
		// Exécution de la requête avec les données de réservation
		$insertion->execute(array(
			":date_resa" => $reservationData["date_resa"],
			":prix" => $reservationData["prix_loca"],
			":dateDebutLoc" => $reservationData["dateDebutLoc"],
			":dateFinLoc" => $reservationData["dateFinLoc"],
			":etat_resa" => $reservationData["etat_resa"]
		));
		// Vérification si l'insertion a réussi
		return $insertion ? true : false;
	}

	/************ Connexion ***************************/
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
	public function verifInscription($nom, $prenom, $email, $mdp, $adresse, $telephone, $userType) {
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
			$query = $this->unPDO->prepare("INSERT INTO $tableName (nom, prenom, email, mdp, adresse, telephone) VALUES (:nom, :prenom, :email, :mdp, :adresse, :telephone)");
			$query->bindParam(":nom", $nom);
			$query->bindParam(":prenom", $prenom);
			$query->bindParam(":email", $email);
			$query->bindParam(":mdp", $mdp);
			$query->bindParam(":adresse", $adresse);
			$query->bindParam(":telephone", $telephone);
			$query->execute();

			return true;
		} catch (PDOException $e) {
			echo "Erreur lors de l'inscription : " . $e->getMessage();
			return false;
		}
	}

	// Fonction de vérification de l'inscription pour un client
	public function verifInscriptionClient($nom, $prenom, $email, $mdp, $adresse, $telephone) {
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
			$query = $this->unPDO->prepare("INSERT INTO client (nom, prenom, email, mdp,adresse, telephone, role) VALUES (:nom, :prenom, :email, :mdp, :adresse, :telephone, 'client')");
			$query->bindParam(":nom", $nom);
			$query->bindParam(":prenom", $prenom);
			$query->bindParam(":email", $email);
			$query->bindParam(":mdp", $mdp);
			$query->bindParam(":adresse", $adresse);
			$query->bindParam(":telephone", $telephone);
			$query->execute();

			return true;
		} catch (PDOException $e) {
			echo "Erreur lors de l'inscription : " . $e->getMessage();
			return false;
		}
	}

	// Fonction de vérification de l'inscription pour un représentant
	public function verifInscriptionRepresentant($nom, $prenom, $email, $mdp, $adresse, $telephone) {
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
			$query = $this->unPDO->prepare("INSERT INTO moniteur (nom, prenom, email, mdp, adresse, telephone, role) VALUES (:nom, :prenom, :email, :mdp, :adresse, :telephone, 'moniteur')");
			$query->bindParam(":nom", $nom);
			$query->bindParam(":prenom", $prenom);
			$query->bindParam(":email", $email);
			$query->bindParam(":mdp", $mdp);
			$query->bindParam(":adresse", $adresse);
			$query->bindParam(":telephone", $telephone);
			$query->execute();

			return true;
		} catch (PDOException $e) {
			echo "Erreur lors de l'inscription : " . $e->getMessage();
			return false;
		}
	}
	

	// Nouvelle méthode pour sélectionner un enregistrement par ID
	public function selectById($id) {
		try {
			// Préparez la requête SQL en utilisant la colonne 'id_materiel'
			$requete = "SELECT * FROM {$this->table} WHERE id_materiel = :id";
			$select = $this->unPDO->prepare($requete);
			$select->bindParam(':id', $id);
			$select->execute();
			return $select->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo "Erreur lors de la sélection par ID : " . $e->getMessage();
			return null;
		}
	}
	public function selectJoin($table1, $table2, $field1, $field2, $fields = array()) {
		// Préparer la liste des champs à sélectionner
		$fields_str = implode(',', $fields);
		
		// Préparer la requête SQL avec la jointure
		$sql = "SELECT $fields_str, $table2.marque AS marque_materiel, $table2.prix_loca AS prix_base_materiel FROM $table1 INNER JOIN $table2 ON $table1.$field1 = $table2.$field2";
		
		// Exécuter la requête
		$select = $this->unPDO->prepare($sql);
		$select->execute();

		// Retourner les résultats
		return $select->fetchAll(PDO::FETCH_ASSOC);
	}


}
?>
