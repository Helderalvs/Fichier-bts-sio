<?php
	require_once ("modele/modele.class.php"); 
	class Controleur {
		private $unModele ; 

		public function __construct (){
			//instanciation de la classe Modele
			$this->unModele = new Modele (); 
		}
		
		public function setTable ($table){
			$this->unModele->setTable($table);
		}
		
		/*********** Gestion des materiel *********/
		
		public function insert ($tab){
			//plus tard : controle des données avant insertion
			$this->unModele->insert ($tab); 
		}

		public function selectAll (){
			return $this->unModele->selectAll(); 
		}

		public function selectLike ($where,$filtre){
			return $this->unModele->selectLike ($where,$filtre); 
		}
		public function delete($where){
			$this->unModele->delete ($where);
		}

		public function selectWhere ($where){
			return $this->unModele->selectWhere($where);
		}
		public function update($tab,$where){
			$this->unModele->update($tab,$where);
		}

		public function count(){
			return $this->unModele->count();
		}
		
		public function insertReservation($reservationData){
			return $this->unModele->insertReservation($reservationData);
		}

		/************ connexion **********/
		public function verifConnexion ($email, $mdp){
			return $this->unModele->verifConnexion ($email, $mdp);
		}

		/************ inscription **********/
		public function verifInscription ($nom, $prenom, $email, $mdp, $adresse, $telephone,$userType){
			return $this->unModele->verifInscription ($nom, $prenom, $email, $mdp, $adresse, $telephone, $userType);
		}
		public function verifInscriptionClient ($nom, $prenom, $email, $mdp, $adresse, $telephone){
			return $this->unModele->verifInscriptionClient ($nom, $prenom, $email, $mdp, $adresse, $telephone);
		}
		public function verifInscriptionRepresentant ($nom, $prenom, $email, $mdp, $adresse, $telephone){
			return $this->unModele->verifInscriptionRepresentant ($nom, $prenom, $email, $mdp, $adresse, $telephone);
		}
		


		/********** Securite des données ********/
		public function testVide ($tab){
			$vide = false ; 
			foreach($tab as $valeur){

				if ($valeur == ""){
					$vide = true; 
					break;
				}
			}
			return $vide ;
		}


		public function reserverMateriel($reservationData) {
			// Assurez-vous que les données de réservation sont complètes
			if(isset($reservationData['id_user']) && isset($reservationData['id_materiel']) && isset($reservationData['dateDebutLoc']) && isset($reservationData['dateFinLoc'])) {
				// Insérez la réservation dans la base de données en utilisant la fonction insertReservation du modèle
				$this->unModele->insertReservation($reservationData);
				// Redirigez l'utilisateur vers une page de confirmation
				header("Location: confirmation_reservation.php");
				exit();
			} else {
				echo "Données de réservation incomplètes.";
			}
		}
	}

	

	
?>





