package vue;

import controleur.*;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.ArrayList;

public class PanelMateriel extends PanelPrincipal implements ActionListener {

	private JTextField txtNom = new JTextField();
	private JTextField txtMarque = new JTextField();
	private JTextField txtPrix = new JTextField();
	private JTextField txtStock = new JTextField();

	private static JComboBox<String> txtEtat = new JComboBox<String>();
	private JButton btAnnuler = new JButton("Annuler");
	private JButton btEnregistrer = new JButton("Enregister");

	private JPanel pannelFrom = new JPanel();

	private JTable tableMaterielNeige;
	private JScrollPane uneScrollNeige;

	private Tableau unTableauNeige;

	private JTable tableMaterielRando;
	private JScrollPane uneScrollRando;

	private Tableau unTableauRando;

	private JPanel panelFiltre = new JPanel();
	private JTextField txtFiltre = new JTextField();
	private JButton btFiltrer = new JButton("Filtrer");

	private JLabel nbClasses = new JLabel();

  // heritage pour mat neige
	private static JComboBox<String> txtRole = new JComboBox<String>();
	private JTextField txtLongeur_skis = new JTextField();
	private JTextField txtType_fixation = new JTextField();
	private JTextField txtNiveau_usure = new JTextField();
	private JTextField txtType_ski = new JTextField();



	// heritage pour mat rando
	private JTextField txtTaille_harnais = new JTextField();

	private JTextField txtPoids_max = new JTextField();
	private JTextField txtType_corde = new JTextField();
	private JTextField txtType_ancrage = new JTextField();
	private JTextField txtNiveau_regidite = new JTextField();



	private JPanel panelMat_neige = new JPanel();


	private JPanel panelMat_rando = new JPanel();



	private int nb = 0;
	public PanelMateriel() {
		super("Gestion des classes");
		{
			//construire le pannel formulaire : saisie de la classe.
			this.pannelFrom.setBounds(20,80,250,160);
			this.pannelFrom.setBackground(Color.gray);
			this.pannelFrom.setLayout(new GridLayout(8,2));
			this.pannelFrom.add(new JLabel("Nom Materiel : "));
			this.pannelFrom.add(this.txtNom);
			this.pannelFrom.add(new JLabel(" Marque : "));
			this.pannelFrom.add(this.txtMarque);
			this.pannelFrom.add(new JLabel("Prix location :"));
			this.pannelFrom.add(this.txtPrix);
			this.pannelFrom.add(new JLabel("Stock :"));
			this.pannelFrom.add(this.txtStock);




			this.pannelFrom.add(new JLabel("Etat_materiel :"));
			this.pannelFrom.add(this.txtEtat);
			this.txtEtat.addItem("Neuf");
			this.txtEtat.addItem("Moyen");
			this.txtEtat.addItem("Bien");
			this.txtRole.addActionListener(this);



			this.pannelFrom.add(new JLabel("Role :"));
			this.pannelFrom.add(this.txtRole);
			this.txtRole.addItem("Mat_neige");
			this.txtRole.addItem("Mat_rando");
			this.txtRole.addActionListener(this);
			//on ajoute le formulaire à la fenetre
			this.add(this.pannelFrom);



			//ajout des deux pannaux

			this.panelMat_neige.setBounds(20,250,250,120);
			this.panelMat_neige.setBackground(Color.gray);
			this.panelMat_neige.setLayout(new GridLayout(4,2));
			this.panelMat_neige.add(new JLabel("Longeur du Skis :"));
			this.panelMat_neige.add(this.txtLongeur_skis);
			this.panelMat_neige.add(new JLabel("Type de fixation :"));
			this.panelMat_neige.add(this.txtType_fixation);
			this.panelMat_neige.add(new JLabel("Niveau d'usure :"));
			this.panelMat_neige.add(this.txtNiveau_usure);
			this.panelMat_neige.add(new JLabel("Type de ski :"));
			this.panelMat_neige.add(this.txtType_ski);
			this.add(this.panelMat_neige);
			this.panelMat_neige.setVisible(true);


			this.panelMat_rando.setBounds(20,250,250,120);
			this.panelMat_rando.setBackground(Color.gray);
			this.panelMat_rando.setLayout(new GridLayout(5,2));
			this.panelMat_rando.add(new JLabel("Poids Max:"));
			this.panelMat_rando.add(this.txtPoids_max);
			this.panelMat_rando.add(new JLabel("Taille du harnais :"));
			this.panelMat_rando.add(this.txtTaille_harnais);
			this.panelMat_rando.add(new JLabel("Type de corde :"));
			this.panelMat_rando.add(this.txtType_corde);
			this.panelMat_rando.add(new JLabel("Type d'ancrage :"));
			this.panelMat_rando.add(this.txtType_ancrage);
			this.panelMat_rando.add(new JLabel("Niveau de regidite :"));
			this.panelMat_rando.add(this.txtNiveau_regidite);
			this.add(this.panelMat_rando);
			this.panelMat_rando.setVisible(true);

			this.btAnnuler.setBounds(20,380,100,30);
			this.add(this.btAnnuler);
			this.btEnregistrer.setBounds(160,380,100,30);
			this.add(this.btEnregistrer);


			//on ajoute le formulaire à la fenetre
			//this.add(this.pannelFrom);

			// contruction du panel filtre
			this.panelFiltre.setBounds(360,80,660,30);
			this.panelFiltre.setBackground(Color.gray);
			this.panelFiltre.setLayout(new GridLayout(1,2));
			this.panelFiltre.add(new JLabel("Filtrer par :"));
			this.panelFiltre.add(this.txtFiltre);
			this.panelFiltre.add(this.btFiltrer);
			this.add(this.panelFiltre);

			// contruction de la table
			String entetesNeige [] = {"Id","Nom","Marque","Prix","Stock","Etat","Longeur skis","Type fixation","Niveau usure","Type de ski"};
			this.unTableauNeige = new Tableau(this.obtenirDonnes("", "Mat_neige"),entetesNeige);
			this.tableMaterielNeige= new JTable(this.unTableauNeige);
			this.uneScrollNeige = new JScrollPane(this.tableMaterielNeige);
			this.uneScrollNeige.setBounds(360,130,760,100);
			this.add(this.uneScrollNeige);

			String entetesRando[] = {"Id","Nom","Marque","Prix","Stock","Etat","taille_harnais","type_corde","poids_max","type_ancrage","niveau_regidite"};
			this.unTableauRando = new Tableau(this.obtenirDonnes("", "Mat_rando"),entetesRando);
			this.tableMaterielRando= new JTable(this.unTableauRando);
			this.uneScrollRando= new JScrollPane(this.tableMaterielRando);
			this.uneScrollRando.setBounds(360,260,760,100);
			this.add(this.uneScrollRando);



			// interdire l'ordre des colonnes
			this.tableMaterielNeige.getTableHeader().setReorderingAllowed(false);
			this.tableMaterielRando.getTableHeader().setReorderingAllowed(false);

			//contrusction du label Nb
			this.nbClasses.setBounds(400,380,250,20);
			this.add(this.nbClasses);
			this.nb = this.unTableauNeige.getRowCount();
			this.nbClasses.setText("Nombre de classes : " + nb );


			//supprestion et modification
			this.tableMaterielNeige.addMouseListener(new MouseListener() {
				@Override
				public void mouseClicked(MouseEvent e) {
					int numLigne, id_materiel;
					if(e.getClickCount() >=2){
						numLigne = tableMaterielNeige.getSelectedRow();
						id_materiel = Integer.parseInt(unTableauNeige.getValueAt(numLigne,0).toString());
						//suprimer dans la base
						Controleur.deleteMateriel(id_materiel);
						//actualiser l'affichage
						unTableauNeige.supprimerLigne(numLigne);
					}
				}

				@Override
				public void mousePressed(MouseEvent e) {
				}

				@Override
				public void mouseReleased(MouseEvent e) {
				}

				@Override
				public void mouseEntered(MouseEvent e) {
				}

				@Override
				public void mouseExited(MouseEvent e) {
				}
			});

			//rendre les boutons ecoutables
			this.btAnnuler.addActionListener(this);
			this.btEnregistrer.addActionListener(this);
			this.btFiltrer.addActionListener(this);
		}
	}




	public Object[][] obtenirDonnes(String filtre, String role) {
		// transformer l'arrayList en une matrice []
		ArrayList<Materiel> lesMateriel = Controleur.selectAllMateriel(filtre,role);
		if (lesMateriel != null) {
			Object[][] matrice = new Object[lesMateriel.size()][11]; // Changement de la taille de la matrice
			int i = 0;
			for (Materiel unMateriel : lesMateriel) {
				if (unMateriel instanceof  Mat_neige) {
					matrice[i][0] = unMateriel.getId_materiel();
					matrice[i][1] = unMateriel.getNom();
					matrice[i][2] = unMateriel.getMarque();
					matrice[i][3] = unMateriel.getPrix_loca();
					matrice[i][4] = unMateriel.getStock_initial();
					matrice[i][5] = unMateriel.getEtat_materiel();
					matrice[i][6] = ((Mat_neige) unMateriel).getLongeur_skis();
					matrice[i][7] = ((Mat_neige) unMateriel).getType_fixation();
					matrice[i][8] = ((Mat_neige) unMateriel).getNiveau_usure();
					matrice[i][9] = ((Mat_neige) unMateriel).getType_ski();
					matrice[i][10] = "";
				}else {
					matrice[i][0] = unMateriel.getId_materiel();
					matrice[i][1] = unMateriel.getNom();
					matrice[i][2] = unMateriel.getMarque();
					matrice[i][3] = unMateriel.getPrix_loca();
					matrice[i][4] = unMateriel.getStock_initial();
					matrice[i][5] = unMateriel.getEtat_materiel();
					matrice[i][6] = ((Mat_rando) unMateriel).getTaille_harnais();
					matrice[i][7] = ((Mat_rando) unMateriel).getType_corde();
					matrice[i][8] = ((Mat_rando) unMateriel).getPoids_max();
					matrice[i][9] = ((Mat_rando) unMateriel).getType_ancrage();
					matrice[i][10] = ((Mat_rando) unMateriel).getNiveau_regidite();

				}
				i++;
			}
			return matrice;
		} else {
			// Si aucun matériel n'est trouvé, retourner une matrice vide
			return new Object[0][0];
		}
	}


	@Override
	public void actionPerformed(ActionEvent e) {
		if(e.getSource() == this.btAnnuler){
			this.txtNom.setText("");
			this.txtMarque.setText("");
			this.txtPrix.setText("");
			this.txtStock.setText("");
		} else if (e.getSource() == this.btEnregistrer) {
			String nom = this.txtNom.getText();
			String marque = this.txtMarque.getText();
			float prix_loca = Float.parseFloat(this.txtPrix.getText());
			int stock_initial = Integer.parseInt(this.txtStock.getText());
			String etat_materiel = txtEtat.getSelectedItem().toString();

			// Check if the price is greater than 0
			if (prix_loca > 0) {
				this.txtPrix.setBackground(Color.RED); // Set background color to red
			}
			/*
			int age = 0;

			if (trancheAge.equals("0-15ans")) {
				age = 15;
			} else if (trancheAge.equals("15-35")) {
				age = 35;
			} else if (trancheAge.equals("35-60")) {
				age = 60;
			}
			 */
			float longeur_skis=0,taille_harnais=0,poids_max=0;
			String type_fixation="",niveau_usure="",type_ski="",type_corde="",type_ancrage="",niveau_regidite="";
			String role = this.txtRole.getSelectedItem().toString();
			Materiel unMateriel;

			if (role.equals("Mat_neige")){
				longeur_skis = Float.parseFloat((txtLongeur_skis.getText()));
				type_fixation = txtType_fixation.getText();
				niveau_usure = txtNiveau_usure.getText();
				type_ski = txtType_ski.getText();
				unMateriel = new Mat_neige(nom,marque,prix_loca,stock_initial,etat_materiel,role,longeur_skis,type_fixation,niveau_usure,type_ski);
				Controleur.insertMat_neige((Mat_neige) unMateriel);
				unMateriel = Controleur.selectWhereMateriel(nom,marque,prix_loca,stock_initial,etat_materiel,role);

				if (unMateriel != null) {
					// Mettez le code pour actualiser l'affichage ici

					Object ligne[] = {unMateriel.getId_materiel(), nom, marque, prix_loca, stock_initial, etat_materiel, longeur_skis, type_fixation, niveau_usure, type_ski};
					this.unTableauNeige.ajouterLigne(ligne);
				}
			} else if (role.equals("Mat_rando")){
				taille_harnais = Float.parseFloat((txtTaille_harnais.getText()));
				poids_max = Float.parseFloat((txtPoids_max.getText()));
				type_corde = txtType_corde.getText();
				type_ancrage = txtType_ancrage.getText();
				niveau_regidite = txtNiveau_regidite.getText();
				unMateriel = new Mat_rando(nom,marque,prix_loca,stock_initial,etat_materiel,role,taille_harnais,poids_max,type_corde,type_ancrage,niveau_regidite);
				//Insertion des Etudiant dans la base de données
				Controleur.insertMat_rando((Mat_rando) unMateriel);
				unMateriel = Controleur.selectWhereMateriel(nom,marque,prix_loca,stock_initial,etat_materiel,role);

				if (unMateriel != null) {
					// Mettez le code pour actualiser l'affichage ici

					Object ligne[] =  {unMateriel.getId_materiel(), nom, marque, prix_loca, stock_initial, etat_materiel,taille_harnais, type_corde, poids_max, type_ancrage, niveau_regidite };
					this.unTableauNeige.ajouterLigne(ligne);
				}
			}


			//Instanciation d'une classe
			//Materiel unMateriel = new Materiel(nom,marque,prix_loca,stock_initial,etat_materiel,role);

			//Insertion dans la classe dans la base de données
			//Controleur.insertMateriel(unMateriel);

			//recuperation de l'id de la classe insere auprès de Mysql


			this.nb = this.unTableauNeige.getRowCount();
			this.nbClasses.setText("Nombre de classes : " + nb);


			JOptionPane.showMessageDialog(this,"Insertion réussie de la classe");
			this.txtNom.setText("");
			this.txtMarque.setText("");
			this.txtPrix.setText("");
			this.txtStock.setText("");
		}
		else if(e.getSource() == this.btFiltrer){
			String filtre = this.txtFiltre.getText();
			//recuperation des donnes de la bdd avec le filtre
			Object matrice [][] = this.obtenirDonnes(filtre,"Mat_neige");

			//actualisation de l'affichage
			this.unTableauNeige.setDonnes(matrice);
		}
		else if (e.getSource() == txtRole){

			if (txtRole.getSelectedItem().toString().equals("Mat_neige"))
			{
				this.panelMat_neige.setVisible(true);
				this.panelMat_rando.setVisible(false);
			}else {
				this.panelMat_rando.setVisible(true);
				this.panelMat_neige.setVisible(false);
			}
		}
	}
}