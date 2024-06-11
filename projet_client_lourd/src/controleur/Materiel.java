package controleur;

public class Materiel {
	private int id_materiel;
	private int stock_initial;
	private float prix_loca;
	private String nom, marque, etat_materiel,role;

	public Materiel(int id_materiel, String nom, String marque, float prix_loca, int stock_initial, String etat_materiel, String role) {
		super();
		this.id_materiel = id_materiel;
		this.nom = nom;
		this.stock_initial = stock_initial;
		this.prix_loca = prix_loca;
		this.marque = marque;
		this.etat_materiel = etat_materiel;
		this.role = role;
	}

	public Materiel(String nom, String marque, float prix_loca, int stock_initial, String etat_materiel, String role) {
		super();
		this.id_materiel = 0;
		this.nom = nom;
		this.stock_initial = stock_initial;
		this.prix_loca = prix_loca;
		this.marque = marque;
		this.etat_materiel = etat_materiel;
		this.role = role;
	}



	public int getId_materiel() {
		return id_materiel;
	}
	public void setId_materiel(int id_materiel) {
		this.id_materiel = id_materiel;
	}
	public int getStock_initial() {
		return stock_initial;
	}
	public void setStock_initial(int stock_initial) {
		this.stock_initial = stock_initial;
	}
	public float getPrix_loca() {
		return prix_loca;
	}
	public void setPrix_loca(float prix_loca) {
		this.prix_loca = prix_loca;
	}
	public String getNom() {
		return nom;
	}
	public void setNom(String nom) {
		this.nom = nom;
	}
	public String getMarque() {
		return marque;
	}
	public void setMarque(String marque) {
		this.marque = marque;
	}

	public String getEtat_materiel() {
		return etat_materiel;
	}

	public void setEtat_materiel(String etat_materiel) {
		this.etat_materiel = etat_materiel;
	}

	public String getRole() {
		return role;
	}

	public void setRole(String role) {
		this.role = role;
	}

}
