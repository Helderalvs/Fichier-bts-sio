package controleur;

import modele.Modele;

import java.util.ArrayList;

public class Controleur {
	
	public static User selectWhereUser (String email, String mdp) {
		return Modele.selectWhereUser(email, mdp);
	}

	public static void updateUser(User unUser) {
		 
		Modele.updateUser(unUser);
	}

	public static ArrayList<Materiel> selectAllMateriel(String filtre, String role){
		return Modele.selectAllMateriel(filtre, role);
	}

	public static void deleteMateriel (int id_materiel){
		Modele.deleteMateriel(id_materiel);
	}

	public static Materiel selectWhereMateriel(String nom, String marque, float prix_loca, int stock_initial, String etat_materiel, String role) {
		return Modele.selectWhereMateriel(nom,marque, prix_loca,stock_initial,etat_materiel,role);
	}

	public static void insertMat_neige(Mat_neige unMateriel) {
		Modele.insertMat_neige(unMateriel);
	}

	public static void insertMat_rando(Mat_rando unMateriel) {
		Modele.insertMat_rando(unMateriel);
	}
	public static void insertCours(Cours unCours) {
		Modele.insertCours(unCours);
	}

	public static void deleteCours (int id_cours){
		Modele.deleteCours(id_cours);
	}

	public static ArrayList<Cours> selectAllCours(String filtre){
		return Modele.selectAllCours(filtre);
	}

	public static void updateCours (Cours unCours){
		Modele.updateCours(unCours);
	}

	public static Cours selectWhereCours(String nom, String description, String niveau, String date, String duree, float prix, int nb_personne) {
		return Modele.selectWhereCours(nom,description, niveau,date,duree,prix,nb_personne);
	}

	public static ArrayList<Reservation> selectAllReservation(String filtre){
		return Modele.selectAllReservation(filtre);
	}

	public static void insertReservation(Reservation uneReservation) {
		Modele.insertReservation(uneReservation);
	}

	public static Reservation selectWhereReservation(String date_resa, String dateDebutLoc, String dateFinLoc, float prix, String etat_resa) {
		return Modele.selectWhereReservation(date_resa, dateDebutLoc, dateFinLoc,prix,etat_resa);
	}

	public static void updateReservation (Reservation uneReservation){
		Modele.updateReservation(uneReservation);
	}

}

