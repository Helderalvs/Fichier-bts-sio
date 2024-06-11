package controleur;

public class Reservation {

    private int id_resa;

    private float prix;
    private String date_resa,dateDebutLoc,dateFinLoc,etat_resa;


    public Reservation(int id_resa, String date_resa, String dateDebutLoc, String dateFinLoc, float prix, String etat_resa) {
        this.id_resa = id_resa;
        this.prix = prix;
        this.date_resa = date_resa;
        this.dateDebutLoc = dateDebutLoc;
        this.dateFinLoc = dateFinLoc;
        this.etat_resa = etat_resa;
    }

    public Reservation(String date_resa, String dateDebutLoc, String dateFinLoc, Float prix, String etat_resa) {
        this.id_resa = 0;
        this.prix = prix;
        this.date_resa = date_resa;
        this.dateDebutLoc = dateDebutLoc;
        this.dateFinLoc = dateFinLoc;
        this.etat_resa = etat_resa;
    }



    public int getId_resa() {
        return id_resa;
    }

    public void setId_resa(int id_resa) {
        this.id_resa = id_resa;
    }

    public float getPrix() {
        return prix;
    }

    public void setPrix(float prix) {
        this.prix = prix;
    }

    public String getDate_resa() {
        return date_resa;
    }

    public void setDate_resa(String date_resa) {
        this.date_resa = date_resa;
    }

    public String getDateDebutLoc() {
        return dateDebutLoc;
    }

    public void setDateDebutLoc(String dateDebutLoc) {
        this.dateDebutLoc = dateDebutLoc;
    }

    public String getDateFinLoc() {
        return dateFinLoc;
    }

    public void setDateFinLoc(String dateFinLoc) {
        this.dateFinLoc = dateFinLoc;
    }

    public String getEtat_resa() {
        return etat_resa;
    }

    public void setEtat_resa(String etat_resa) {
        this.etat_resa = etat_resa;
    }
}
