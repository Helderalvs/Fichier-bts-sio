package modele;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

import controleur.*;

public class Modele {
	private static BDD uneBDD = new BDD("root", "", "localhost","prestigealpin");
	
	public static User selectWhereUser (String email, String mdp) {
		User unUser = null;
		String requete ="select * from user where email='"+email+"' and mdp='"+mdp+"' ;";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement(); 
			ResultSet unResultat = unStat.executeQuery(requete); 
			if (unResultat.next()) {
				unUser = new User(unResultat.getInt("id_user"), unResultat.getString("nom"),
						unResultat.getString("prenom"), unResultat.getString("email"), 
						unResultat.getString("mdp"), unResultat.getString("role"));
			}
			unStat.close();
			uneBDD.seDeConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur de requete : " + requete );
		}
		return unUser;
	}

	public static void updateUser(User unUser) {
	 String requete="update user set nom='"
			 +unUser.getNom()+"',prenom = '"
			 +unUser.getPrenom()+"',email = '"
			 +unUser.getEmail()+"',role = '"
			 +unUser.getRole()+"',mdp = '"
			 +unUser.getMdp()+"' where iduser = "
			 +unUser.getIduser() +";"; 
		 try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement(); 
			
			unStat.execute(requete);
			
			unStat.close();
			uneBDD.seDeConnecter();	
		 }
		 catch (SQLException exp)
			{
				System.out.println("Erreur de requete : " + requete );
			}	
		
	}


    public static void insertMateriel(Materiel unMateriel) {
		String requete = "insert into materiel values(null, '"
				+ unMateriel.getNom()+"','"
				+ unMateriel.getMarque()+"','"
				+ unMateriel.getPrix_loca()+"','"
				+ unMateriel.getStock_initial()+"','"
				+ unMateriel.getEtat_materiel()+"','"
				+ unMateriel.getRole()+"' ) ;";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur de requete : " + requete );
		}
    }

	public static void deleteMateriel(int id_materiel) {
		String requete = "DELETE FROM materiel WHERE id_materiel = " + id_materiel+";";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur de requete : " + requete );
		}
	}

	public static void updateMateriel(Materiel unMateriel) {
		String requete = "update materiel set nom='" + unMateriel.getNom()
				+"', marque='"+ unMateriel.getMarque() +"' , "
				+" prix_loca='"+ unMateriel.getPrix_loca() +"' , "
				+" stock_initial='"+ unMateriel.getStock_initial() +"' , "
				+" etat_materiel='" + unMateriel.getEtat_materiel() +"' where role='"+unMateriel.getRole()+"';";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur de requete : " + requete );
		}
	}
	public static ArrayList<Materiel> selectAllMateriel (String filtre, String role) {
		String requete = "";

		if (filtre.equals("")){
			requete = "select * from "+role+";";
		} else {
			requete = "select * from "+role+" where nom like '%"
					+ filtre +"%' or marque like '%" + filtre
					+ filtre +"%' or prix_loca like '%" + filtre
					+ filtre +"%' or stock_initial like '%" + filtre
					+ filtre +"%' or etat_materiel like '%" + filtre
					+"%' or role = '%" + filtre +"%' ;";
		}
		ArrayList<Materiel> lesMateriel = new ArrayList<>();
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();
			ResultSet desRes = unStat.executeQuery(requete);
			while (desRes.next()) {
				Materiel unMateriel;

				if (role.equals("Mat_neige")) {
					unMateriel = new Mat_neige(
							desRes.getInt("id_materiel"),
							desRes.getString("nom"),
							desRes.getString("marque"),
							desRes.getFloat("prix_loca"),
							desRes.getInt("stock_initial"),
							desRes.getString("etat_materiel"),
							desRes.getString("role"),
							desRes.getFloat("longeur_skis"),
							desRes.getString("type_fixation"),
							desRes.getString("niveau_usure"),
							desRes.getString("type_ski")
					);
				}else {
					unMateriel = new Mat_rando(
							desRes.getInt("id_materiel"),
							desRes.getString("nom"),
							desRes.getString("marque"),
							desRes.getInt("prix_loca"),
							desRes.getInt("stock_initial"),
							desRes.getString("etat_materiel"),
							desRes.getString("role"),
							desRes.getFloat("taille_harnais"),
							desRes.getFloat("poids_max"),
							desRes.getString("type_corde"),
							desRes.getString("type_ancrage"),
							desRes.getString("niveau_regidite")
					);
				}

				lesMateriel.add(unMateriel);
			}
			unStat.close();
			uneBDD.seDeConnecter();
		} catch (SQLException exp) {
			System.out.println("Erreur de requete : " + requete);
			exp.printStackTrace();
		} return lesMateriel;
	}

	public static Materiel selectWhereMateriel(String nom, String marque, float prix_loca, int stock_initial, String etat_materiel, String role) {
		Materiel unMateriel = null;
		String requete = "SELECT * FROM materiel WHERE nom='" + nom + "' AND marque='" + marque + "' AND stock_initial=" + stock_initial + " AND prix_loca=" + prix_loca + " AND etat_materiel='" + etat_materiel + "' AND role='" + role + "'";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();
			ResultSet desRes = unStat.executeQuery(requete);
			if (desRes.next()) {
				unMateriel = new Materiel (
						desRes.getInt("id_materiel"),
						desRes.getString("nom"),
						desRes.getString("marque"),
						desRes.getFloat("prix_loca"),
						desRes.getInt("stock_initial"),
						desRes.getString("etat_materiel"),
						desRes.getString("role")
				);
			}
			unStat.close();
			uneBDD.seDeConnecter();
		} catch (SQLException exp) {
			System.out.println("Erreur de requete : " + requete);
			exp.printStackTrace();
		}
		return unMateriel;
	}

	public static void insertMat_neige(Mat_neige unMateriel) {
		String requete = "INSERT INTO mat_neige (nom, marque, prix_loca, stock_initial,etat_materiel, longeur_skis, type_fixation, niveau_usure, type_ski, role,tranche_age) VALUES ('"
				+ unMateriel.getNom() + "', '"
				+ unMateriel.getMarque() + "', "
				+ unMateriel.getPrix_loca() + ", "
				+ unMateriel.getStock_initial() + ", '"
				+ unMateriel.getEtat_materiel() + "', "
				+ unMateriel.getLongeur_skis() + ", '"
				+ unMateriel.getType_fixation() + "', '"
				+ unMateriel.getNiveau_usure() + "', '"
				+ unMateriel.getType_ski() + "', '"
				+ unMateriel.getRole() + "', '";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur de requete : " + requete );
		}
	}

	public static void insertMat_rando(Mat_rando unMateriel) {
		String requete = "insert into mat_rando values(null, '"
				+ unMateriel.getNom() + "', '"
				+ unMateriel.getMarque() + "', "
				+ unMateriel.getPrix_loca() + ", "
				+ unMateriel.getStock_initial() + ", '"
				+ unMateriel.getEtat_materiel() + "', "
				+ unMateriel.getTaille_harnais() + ", '"
				+ unMateriel.getType_corde() + "', '"
				+ unMateriel.getPoids_max() + "', '"
				+ unMateriel.getType_ancrage() + "', '"
				+ unMateriel.getNiveau_regidite() + "', '"
				+ unMateriel.getRole() + "', '";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur de requete : " + requete );
		}
	}


	public static void insertCours(Cours unCours) {
		String requete = "insert into cours values(null, '"
				+ unCours.getNom()+"','"
				+ unCours.getDescription()+"','"
				+ unCours.getNiveau()+"','"
				+ unCours.getDate()+"','"
				+ unCours.getDuree()+"','"
				+ unCours.getPrix()+"','"
				+ unCours.getNb_personne()+"') ;";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur de requete : " + requete );
		}
	}
	public static void deleteCours(int id_cours) {
		String requete = "DELETE FROM cours WHERE id_cours = " + id_cours+";";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur de requete : " + requete );
		}
	}

	public static ArrayList<Cours> selectAllCours(String filtre) {
		String requete = "";
		if (filtre.equals("")) {
			requete = "SELECT * FROM cours;";
		} else {
			requete = "SELECT * FROM cours WHERE nom_cours LIKE '%" + filtre + "%' OR description_cours LIKE '%" + filtre
					+ "%' OR niveau_difficulte LIKE '%" + filtre + "%';";
		}

		ArrayList<Cours> lesCours = new ArrayList<>();
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();
			ResultSet desRes = unStat.executeQuery(requete);
			while (desRes.next()) {
				Cours unCours = new Cours(desRes.getInt("id_cours"), desRes.getString("nom_cours"),
						desRes.getString("description_cours"), desRes.getString("niveau_difficulte"),
						desRes.getString("date_cours"), desRes.getString("duree_cours"), desRes.getInt("prix_cours"),
						desRes.getInt("nb_personne"));
				lesCours.add(unCours);
			}
			unStat.close();
			uneBDD.seDeConnecter();
		} catch (SQLException exp) {
			System.out.println("Erreur de requete : " + requete);
			exp.printStackTrace();
		}
		return lesCours;
	}

	public static void updateCours(Cours unCours) {
		String requete = "update cours set nom_cours='" + unCours.getNom()
				+ "', description_cours='" + unCours.getDescription() + "' , "
				+ " niveau_difficulte='" + unCours.getNiveau() + "' , "
				+ " date_heure='" + unCours.getDate() + "' , "
				+ " duree_cours=" + unCours.getDuree() + " , "
				+ " prix_cours=" + unCours.getPrix() + " , "
				+ " nb_personne=" + unCours.getNb_personne() + " where id_cours=" + unCours.getId_cours() + ";";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		} catch (SQLException exp) {
			System.out.println("Erreur de requete : " + requete);
		}
	}

	public static Cours selectWhereCours(String nom, String description, String niveau, String date, String duree, float prix, int nb_personne) {
		Cours unCours = null;
		String requete = "SELECT * FROM cours WHERE nom_cours='" + nom + "' AND description_cours='" + description + "' AND niveau_difficulte='" + niveau + "' AND date_heure='" + date + "' AND duree_cours='" + duree + "' AND prix_cours='" + prix + "' AND nb_personne='" + nb_personne+"';";
		System.out.println(requete);
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();
			ResultSet desRes = unStat.executeQuery(requete);
			if (desRes.next()) {
				unCours = new Cours(
						desRes.getInt("id_cours"),
						desRes.getString("nom_cours"),
						desRes.getString("description_cours"),
						desRes.getString("niveau_difficulte"),
						desRes.getString("date_heure"),
						desRes.getString("duree_cours"),
						desRes.getInt("prix_cours"),
						desRes.getInt("nb_personne")
				);
			}
			unStat.close();
			uneBDD.seDeConnecter();
		} catch (SQLException exp) {
			System.out.println("Erreur de requete : " + requete);
			exp.printStackTrace();
		}
		return unCours;
	}

	public static ArrayList<Reservation> selectAllReservation(String filtre) {
		String requete = "";
		if (filtre.equals("")) {
			requete = "SELECT * FROM reservation;";
		} else {
			requete = "SELECT * FROM reservation WHERE id_resa LIKE '%" + filtre + "%' OR date_resa LIKE '%" + filtre
					+ "%' OR prix LIKE '%" + filtre + "%';";
		}


		ArrayList<Reservation> lesReservation = new ArrayList<>();
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();
			ResultSet desRes = unStat.executeQuery(requete);
			while (desRes.next()) {
				Reservation uneReservation = new Reservation(desRes.getInt("id_resa"), desRes.getString("date_resa"),
						desRes.getString("dateDebutLoc"), desRes.getString("dateFinLoc"),
						desRes.getFloat("prix"), desRes.getString("etat_resa"));
				lesReservation.add(uneReservation);
			}
			unStat.close();
			uneBDD.seDeConnecter();
		} catch (SQLException exp) {
			System.out.println("Erreur de requete : " + requete);
			exp.printStackTrace();
		}
		return lesReservation;
	}

	public static void insertReservation(Reservation uneReservation) {
		String requete = "insert into reservation values(null, '"
				+ uneReservation.getDate_resa()+"','"
				+ uneReservation.getDateDebutLoc()+"','"
				+ uneReservation.getDateFinLoc()+"','"
				+ uneReservation.getPrix()+"','"
				+ uneReservation.getEtat_resa()+"');";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		}
		catch (SQLException exp)
		{
			System.out.println("Erreur de requete : " + requete );
		}
	}
	public static Reservation selectWhereReservation(String date_resa, String dateDebutLoc, String dateFinLoc, float prix, String etat_resa) {
		Reservation uneReservation = null;
		String requete = "SELECT * FROM reservation WHERE date_resa='" + date_resa + "' AND dateDebutLoc='" + dateDebutLoc + "' AND dateFinLoc='" + dateFinLoc + "' AND prix='" + prix + "' AND etat_resa='" + etat_resa + "';";
		System.out.println(requete);
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();
			ResultSet desRes = unStat.executeQuery(requete);
			if (desRes.next()) {
				uneReservation = new Reservation(
						desRes.getInt("id_resa"),
						desRes.getString("date_resa"),
						desRes.getString("dateDebutLoc"),
						desRes.getString("dateFinLoc"),
						desRes.getFloat("prix"),
						desRes.getString("etat_resa")
				);
			}
			unStat.close();
			uneBDD.seDeConnecter();
		} catch (SQLException exp) {
			System.out.println("Erreur de requete : " + requete);
			exp.printStackTrace();
		}
		return uneReservation;
	}

	public static void updateReservation(Reservation uneReservation) {
		String requete = "update reservation set date_resa='" + uneReservation.getDate_resa()
				+ "', dateDebutLoc='" + uneReservation.getDateDebutLoc() + "' , "
				+ " dateFinLoc='" + uneReservation.getDateFinLoc() + "' , "
				+ " prix='" + uneReservation.getPrix() + "' , "
				+ " etat_resa=" + uneReservation.getEtat_resa() + " where id_resa=" + uneReservation.getId_resa() + ";";
		try {
			uneBDD.seConnecter();
			Statement unStat = uneBDD.getMaConnexion().createStatement();

			unStat.execute(requete);

			unStat.close();
			uneBDD.seDeConnecter();
		} catch (SQLException exp) {
			System.out.println("Erreur de requete : " + requete);
		}
	}

}















