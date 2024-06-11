	<h2> Materiel Neige </h2>

	<?php


	$unControleur->setTable("mat_neige");
	if (isset($_SESSION['role']) && $_SESSION['role']=="admin" ) {
		$id_materiel = null; 
		if(isset($_GET['action']) && isset($_GET['id_materiel']))
		{
			$action = $_GET['action']; 
			$id_materiel = $_GET['id_materiel'];
			$where = array("id_materiel"=>$id_materiel);
			switch($action){
				case "sup"  : 
				$unControleur->delete($where); 
				break;
				case "edit" : 
				$laClasse = $unControleur->selectWhere($where);
				break;
			}
		}
		require_once ("vue/vue_insert_mat_neige.php"); 
		
		if (isset($_POST['Valider'])){
			//verification des données 
			if( $unControleur->testVide($_POST)){
				echo "<br> Veuillez remplir les champs.";
			}else {
				//insertion de la nouvelle classe dans la BDD 
				$tab=array("nom"=>$_POST['nom'],
				"marque"=>$_POST['marque'],
				"prix_loca"=>$_POST['prix_loca'],
				"stock_initial"=>$_POST['stock_initial'],
				"etat_materiel"=>$_POST['etat_materiel']);
				$unControleur->insert ($tab);
				}
		}

		if (isset($_POST['Modifier'])){
			//verification des données 
			if( $unControleur->testVide($_POST)){
				echo "<br> Veuillez remplir les champs.";
			}else {
				//update de la classe dans la BDD 
				$tab=array("nom"=>$_POST['nom'],
				"marque"=>$_POST['marque'],
				"prix_loca"=>$_POST['prix_loca'],
				"stock_initial"=>$_POST['stock_initial'],
				"etat_materiel"=>$_POST['etat_materiel']);
				$where = array("id_materiel"=>$_POST['id_materiel']);
				$unControleur->update ($tab,$where);
				//actualiser la page 
				header("Location: index.php?page=2");
				}
		}
		} //fin du if admin 

		if (isset($_POST['Filtrer'])){
			$filtre = $_POST['filtre']; 
			$where = array("nom");
			$id_materiel = $unControleur->selectLike($where,$filtre);
		}else{
			$id_materiel = $unControleur->selectAll();
		}

		require_once ("vue/vue_select_mat_neige.php"); 
	?>