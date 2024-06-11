package controleur;

public class Mat_rando extends Materiel{

    private float taille_harnais,poids_max;

    private String type_corde,type_ancrage,niveau_regidite,tranche_age;

    public Mat_rando(int id_materiel, String nom, String marque, float prix_loca, int stock_initial, String etat_materiel, String role, float taille_harnais,
                     float poids_max, String type_corde, String type_ancrage, String niveau_regidite) {
        super(id_materiel, nom, marque, prix_loca, stock_initial, etat_materiel, role);
        this.taille_harnais = taille_harnais;
        this.poids_max = poids_max;
        this.type_corde = type_corde;
        this.type_ancrage = type_ancrage;
        this.niveau_regidite = niveau_regidite;
    }

    public Mat_rando(String nom, String marque, float prix_loca, int stock_initial, String etat_materiel, String role, float taille_harnais,
                     float poids_max, String type_corde, String type_ancrage, String niveau_regidite) {
        super(nom, marque, prix_loca, stock_initial, etat_materiel, role);
        this.taille_harnais = taille_harnais;
        this.poids_max = poids_max;
        this.type_corde = type_corde;
        this.type_ancrage = type_ancrage;
        this.niveau_regidite = niveau_regidite;
    }



    public float getTaille_harnais() {
        return taille_harnais;
    }

    public void setTaille_harnais(float taille_harnais) {
        this.taille_harnais = taille_harnais;
    }

    public float getPoids_max() {
        return poids_max;
    }

    public void setPoids_max(float poids_max) {
        this.poids_max = poids_max;
    }

    public String getType_corde() {
        return type_corde;
    }

    public void setType_corde(String type_corde) {
        this.type_corde = type_corde;
    }

    public String getType_ancrage() {
        return type_ancrage;
    }

    public void setType_ancrage(String type_ancrage) {
        this.type_ancrage = type_ancrage;
    }

    public String getNiveau_regidite() {
        return niveau_regidite;
    }

    public void setNiveau_regidite(String niveau_regidite) {
        this.niveau_regidite = niveau_regidite;
    }
}
