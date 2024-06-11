package vue;
import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.ArrayList;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextField;

import controleur.Controleur;
import controleur.Cours;
import controleur.Tableau;
public class PanelCours extends PanelPrincipal implements ActionListener{

	private JTextField txtNom_cours = new  JTextField();
	private JTextField txtDescription_cours = new  JTextField();
	private JTextField txtNiveau_difficulte = new  JTextField();
	private JTextField txtDate_cours = new  JTextField();
	private JTextField txtDuree_cours = new  JTextField();
	private JTextField txtPrix_cours = new  JTextField();

	private JTextField txtNb_personne = new  JTextField();

	private JButton btAnnuler = new JButton("Annuler");
	private JButton btEnregistrer = new JButton("Enregistrer");

	private JPanel panelForm = new JPanel();


	private JPanel panelFiltre = new JPanel();
	private JTextField txtFiltre = new JTextField();
	private JButton btFiltrer = new JButton("Filtrer");

	private JTable tableCours ;
	private JScrollPane uneScroll ;
	private Tableau unTableau ;

	private JLabel nbCours = new JLabel();
	private int nb = 0;

	public PanelCours () {
		super ("Gestion des Cours");

		//construire le panel formulaire : saisie de la classe.
		this.panelForm.setBounds(20, 80, 250, 200);
		this.panelForm.setBackground(Color.gray);
		this.panelForm.setLayout(new GridLayout(8,2));
		this.panelForm.add(new JLabel("Nom :"));
		this.panelForm.add(this.txtNom_cours);
		this.panelForm.add(new JLabel("Description  :"));
		this.panelForm.add(this.txtDescription_cours);
		this.panelForm.add(new JLabel("Niveau :"));
		this.panelForm.add(this.txtNiveau_difficulte);
		this.panelForm.add(new JLabel("Date cours :"));
		this.panelForm.add(this.txtDate_cours);
		this.panelForm.add(new JLabel("Duree du cours :"));
		this.panelForm.add(this.txtDuree_cours);
		this.panelForm.add(new JLabel("prix du cours :"));
		this.panelForm.add(this.txtPrix_cours);
		this.panelForm.add(new JLabel("nombre de perssonnes :"));
		this.panelForm.add(this.txtNb_personne);
		this.panelForm.add(this.btAnnuler);
		this.panelForm.add(this.btEnregistrer);
		//on ajoute le formulaire à la fenetre
		this.add(this.panelForm);

		//construction du panel filtre
		this.panelFiltre.setBounds(360, 80, 460, 30);
		this.panelFiltre.setBackground(Color.gray);
		this.panelFiltre.setLayout(new GridLayout(1,3));
		this.panelFiltre.add(new JLabel("Filtrer par :"));
		this.panelFiltre.add(this.txtFiltre);
		this.panelFiltre.add(this.btFiltrer);
		this.add(this.panelFiltre);
		//construction de la table
		String entetes [] = {"ID Cours", "Nom","description", "niveau", "date","prix","nb_personne"};
		this.unTableau= new Tableau (this.obtenirDonnees(""), entetes);
		this.tableCours = new JTable(this.unTableau) ;
		this.uneScroll = new JScrollPane(this.tableCours);
		this.uneScroll.setBounds(360, 130, 460, 200);
		this.add(this.uneScroll);

		//interdire l'ordre des colonnes
		this.tableCours.getTableHeader().setReorderingAllowed(false);

		//construction du Label Nb
		this.nbCours.setBounds(400, 380, 250, 20);
		this.add(this.nbCours);
		this.nb = this.unTableau.getRowCount();
		this.nbCours.setText("Nombre de classes : " + nb);

		//suppression et modification
		this.tableCours.addMouseListener(new MouseListener() {

			@Override
			public void mouseReleased(MouseEvent e) {
			}

			@Override
			public void mousePressed(MouseEvent e) {
			}

			@Override
			public void mouseExited(MouseEvent e) {
			}

			@Override
			public void mouseEntered(MouseEvent e) {
			}

			@Override
			public void mouseClicked(MouseEvent e) {
				int numLigne;
				if (e.getClickCount() >= 2) {
					numLigne = tableCours.getSelectedRow();
					if (numLigne >= 0) {
						int id_cours = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());
						int reponse = JOptionPane.showConfirmDialog(null, "Voulez-vous supprimer la classe",
								"Suppression Classe", JOptionPane.YES_NO_OPTION);
						if (reponse == 0) {
							//supprimer dans la base
							Controleur.deleteCours(id_cours);
							//actualiser l'affichage
							unTableau.supprimerLigne(numLigne);
							btEnregistrer.setText("Enregistrer");
						}
					} else {
						// Gérer le cas où aucune ligne n'est sélectionnée
						JOptionPane.showMessageDialog(null, "Veuillez sélectionner une classe à supprimer.", "Aucune sélection", JOptionPane.INFORMATION_MESSAGE);
					}
				} else if (e.getClickCount() == 1) {
					//remplir les champs du formulaire pour une modification
					numLigne = tableCours.getSelectedRow();
					if (numLigne >= 0) {
						txtNom_cours.setText(unTableau.getValueAt(numLigne, 1).toString());
						txtDescription_cours.setText(unTableau.getValueAt(numLigne, 2).toString());
						txtNiveau_difficulte.setText(unTableau.getValueAt(numLigne, 3).toString());
						txtDate_cours.setText(unTableau.getValueAt(numLigne, 4).toString());
						txtDuree_cours.setText(unTableau.getValueAt(numLigne, 5).toString());
						txtPrix_cours.setText(unTableau.getValueAt(numLigne, 6).toString());
						txtNb_personne.setText(unTableau.getValueAt(numLigne, 7).toString());
						btEnregistrer.setText("Modifier");
					}
				}
			}

		});

		//rendre les boutons ecoutables
		this.btAnnuler.addActionListener(this);
		this.btEnregistrer.addActionListener(this);
		this.btFiltrer.addActionListener(this);
	}

	public Object [][] obtenirDonnees (String filtre){
		//transformer l'ArrayList en une matrice [][]
		ArrayList<Cours> lesCours = Controleur.selectAllCours(filtre);
		Object [][] matrice = new Object [lesCours.size()][8];
		int i = 0;
		for (Cours unCours : lesCours) {
			matrice [i][0] = unCours.setId_cours();
			matrice [i][1] = unCours.getNom();
			matrice [i][2] = unCours.getDescription();
			matrice [i][3] = unCours.getNiveau();
			matrice [i][4] = unCours.getDate();
			matrice [i][5] = unCours.getDuree();
			matrice [i][6] = unCours.getPrix();
			matrice [i][7] = unCours.getNb_personne();
			i++;
		}
		return matrice;
	}
	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == this.btAnnuler) {
			this.txtNom_cours.setText("");
			this.txtDescription_cours.setText("");
			this.txtNiveau_difficulte.setText("");
			this.txtDate_cours.setText("");
			this.txtDuree_cours.setText("");
			this.txtPrix_cours.setText("");
			this.txtNb_personne.setText("");
			this.btEnregistrer.setText("Enregistrer");
		}
		else if (e.getSource() == this.btEnregistrer && this.btEnregistrer.getText().equals("Enregistrer")) {
			String nom = this.txtNom_cours.getText();
			String description = this.txtDescription_cours.getText();
			String niveau = this.txtNiveau_difficulte.getText();
			String date = this.txtDate_cours.getText();
			String duree = this.txtDuree_cours.getText();
			float prix = Float.parseFloat(this.txtPrix_cours.getText());
			int nb_personne = Integer.parseInt(this.txtNb_personne.getText());


			Cours unCours = new Cours(nom, description, niveau, date,duree,prix,nb_personne);

			//insertion dans le professeur dans la base de données
			Controleur.insertCours(unCours);

			//recuperation de l'id du professeur inseree auprès de Mysql
			unCours = Controleur.selectWhereCours(nom, description, niveau, date,duree,prix,nb_personne);

			//actualiser l'affichage dans le tableau
			Object ligne[]= {unCours.getId_cours(),nom, description, niveau, date,duree,prix,nb_personne};
			this.unTableau.ajouterLigne(ligne);
			this.nb = this.unTableau.getRowCount();
			this.nbCours.setText("Nombre de cours : " + nb);

			JOptionPane.showMessageDialog(this, "Insertion réussie du cours.");
			this.txtNom_cours.setText("");
			this.txtDescription_cours.setText("");
			this.txtNiveau_difficulte.setText("");
			this.txtDate_cours.setText("");
			this.txtDuree_cours.setText("");
			this.txtPrix_cours.setText("");
			this.txtNb_personne.setText("");
		}
		else if (e.getSource() == this.btFiltrer) {
			String filtre = this.txtFiltre.getText();

			//recuperation des données de la bdd avec le filtre
			Object matrice[][] = this.obtenirDonnees(filtre);

			//actualisation de l'affichage
			this.unTableau.setDonnes(matrice);
		}
		else if (e.getSource() == this.btEnregistrer && this.btEnregistrer.getText().equals("Modifier")) {
			// Récupérer l'index de la ligne sélectionnée
			int numLigne = tableCours.getSelectedRow();
			if (numLigne >= 0) { // Vérifier si une ligne est sélectionnée
				// Récupérer les valeurs des champs de saisie
				String nom = this.txtNom_cours.getText();
				String description = this.txtDescription_cours.getText();
				String niveau = this.txtNiveau_difficulte.getText();
				String date = this.txtDate_cours.getText();
				String duree = this.txtDuree_cours.getText();
				float prix = Float.parseFloat(this.txtPrix_cours.getText());
				int nb_personne = Integer.parseInt(this.txtNb_personne.getText());

				// Accéder aux valeurs de la ligne sélectionnée et effectuer la modification
				int id_cours = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());
				Cours unCours = new Cours(id_cours, nom, description, niveau, date, duree, prix, nb_personne);

				// Modification dans la base de données
				Controleur.updateCours(unCours);

				// Actualiser l'affichage dans le tableau
				Object ligne[] = {unCours.getId_cours(), nom, description, niveau, date, duree, prix, nb_personne};
				this.unTableau.modifierLigne(numLigne, ligne);

				// Afficher un message de confirmation
				JOptionPane.showMessageDialog(this, "Modification réussie du cours.");

			} else {
				// Aucune ligne sélectionnée, afficher un message à l'utilisateur
				JOptionPane.showMessageDialog(this, "Veuillez sélectionner un cours à modifier.", "Aucune sélection", JOptionPane.INFORMATION_MESSAGE);
			}
		}
	}
	}