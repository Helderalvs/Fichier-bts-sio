package controleur;

public class Cours {

    private int id_cours,nb_personne;

    private String nom, description, niveau,date,duree;

    private float prix;


    public Cours(int id_cours, String nom, String description, String niveau, String date, String duree, float prix, int nb_personne) {
        super();
        this.id_cours = id_cours;
        this.nb_personne = nb_personne;
        this.nom = nom;
        this.description = description;
        this.niveau = niveau;
        this.date = date;
        this.duree = duree;
        this.prix = prix;
    }

    public Cours(String nom, String description, String niveau, String date, String duree, float prix, int nb_personne) {
        super();
        this.id_cours = 0;
        this.nb_personne = nb_personne;
        this.nom = nom;
        this.description = description;
        this.niveau = niveau;
        this.date = date;
        this.duree = duree;
        this.prix = prix;
    }

    public int getId_cours() {
        return id_cours;
    }

    public Object setId_cours() {
        return id_cours;
    }

    public int getNb_personne() {
        return nb_personne;
    }

    public void setNb_personne(int nb_personne) {
        this.nb_personne = nb_personne;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getNiveau() {
        return niveau;
    }

    public void setNiveau(String niveau) {
        this.niveau = niveau;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getDuree() {
        return duree;
    }

    public void setDuree(String duree) {
        this.duree = duree;
    }

    public float getPrix() {
        return prix;
    }

    public void setPrix(float prix) {
        this.prix = prix;
    }
}
