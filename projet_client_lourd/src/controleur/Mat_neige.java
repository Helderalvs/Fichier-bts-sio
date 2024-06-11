package controleur;

import javax.swing.*;

public class Mat_neige extends Materiel{
    private float longeur_skis;
    private String Type_fixation,Niveau_usure,Type_ski;


    public Mat_neige(int id_materiel, String nom, String marque, float prix_loca, int stock_initial,
                     String etat_materiel, String role,float longeur_skis,String Type_fixation,String Niveau_usure,String Type_ski) {
        super(id_materiel, nom, marque, prix_loca, stock_initial, etat_materiel, role);
        this.longeur_skis = longeur_skis;
        this.Type_fixation = Type_fixation;
        this.Niveau_usure = Niveau_usure;
        this.Type_ski = Type_ski;
    }

    public Mat_neige(String nom, String marque, float prix_loca, int stock_initial,
                     String etat_materiel, String role,float longeur_skis,String Type_fixation,String Niveau_usure,String Type_ski) {
        super(nom, marque, prix_loca, stock_initial, etat_materiel, role);
        this.longeur_skis = longeur_skis;
        this.Type_fixation = Type_fixation;
        this.Niveau_usure = Niveau_usure;
        this.Type_ski = Type_ski;
    }

    public float getLongeur_skis() {
        return longeur_skis;
    }

    public void setLongeur_skis(float longeur_skis) {
        this.longeur_skis = longeur_skis;
    }

    public String getType_fixation() {
        return Type_fixation;
    }

    public void setType_fixation(String type_fixation) {
        Type_fixation = type_fixation;
    }

    public String getNiveau_usure() {
        return Niveau_usure;
    }

    public void setNiveau_usure(String niveau_usure) {
        Niveau_usure = niveau_usure;
    }

    public String getType_ski() {
        return Type_ski;
    }

    public void setType_ski(String type_ski) {
        Type_ski = type_ski;
    }
}
