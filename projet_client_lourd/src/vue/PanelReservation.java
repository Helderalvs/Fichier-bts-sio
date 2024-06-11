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
import controleur.Reservation;
import controleur.Tableau;
public class PanelReservation extends PanelPrincipal implements ActionListener{

	private JTextField txtDate_resa = new  JTextField();

	private JTextField txtDateDebutLoc = new  JTextField();

	private JTextField txtPrix = new  JTextField();

	private JTextField txtDateFinLoc = new  JTextField();

	private JTextField txtEtat_resa = new  JTextField();

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

	public PanelReservation () {
		super ("Gestion des Cours");

		//construire le panel formulaire : saisie de la classe.
		this.panelForm.setBounds(20, 80, 250, 200);
		this.panelForm.setBackground(Color.gray);
		this.panelForm.setLayout(new GridLayout(8,2));
		this.panelForm.add(new JLabel("Date reservation:"));
		this.panelForm.add(this.txtDate_resa);
		this.panelForm.add(new JLabel("Date debut  :"));
		this.panelForm.add(this.txtDateDebutLoc);
		this.panelForm.add(new JLabel("Date fin :"));
		this.panelForm.add(this.txtDateFinLoc);
		this.panelForm.add(new JLabel("Prix:"));
		this.panelForm.add(this.txtPrix);
		this.panelForm.add(new JLabel("Etat :"));
		this.panelForm.add(this.txtEtat_resa);
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
		String entetes [] = {"ID resa", "date","date debut", "date fin","prix","etat resa"};
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
						txtDate_resa.setText(unTableau.getValueAt(numLigne, 1).toString());
						txtDateDebutLoc.setText(unTableau.getValueAt(numLigne, 2).toString());
						txtDateFinLoc.setText(unTableau.getValueAt(numLigne, 3).toString());
						txtPrix.setText(unTableau.getValueAt(numLigne, 4).toString());
						txtEtat_resa.setText(unTableau.getValueAt(numLigne, 4).toString());
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
		ArrayList<Reservation> lesReservation = Controleur.selectAllReservation(filtre);
		Object [][] matrice = new Object [lesReservation.size()][6];
		int i = 0;
		for (Reservation uneReservation : lesReservation) {
			matrice [i][0] = uneReservation.getId_resa();
			matrice [i][1] = uneReservation.getDate_resa();
			matrice [i][2] = uneReservation.getDateDebutLoc();
			matrice [i][3] = uneReservation.getDateFinLoc();
			matrice [i][4] = uneReservation.getPrix();
			matrice [i][5] = uneReservation.getEtat_resa();
			i++;
		}
		return matrice;
	}
	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == this.btAnnuler) {
			this.txtDate_resa.setText("");
			this.txtDateDebutLoc.setText("");
			this.txtDateFinLoc.setText("");
			this.txtPrix.setText("");
			this.txtEtat_resa.setText("");
			this.btEnregistrer.setText("Enregistrer");
		} else if (e.getSource() == this.btEnregistrer && this.btEnregistrer.getText().equals("Enregistrer")) {
			String date_resa = this.txtDate_resa.getText();
			String dateDebutLoc = this.txtDateDebutLoc.getText();
			String dateFinLoc = this.txtDateFinLoc.getText();
			Float prix = Float.valueOf(this.txtPrix.getText());
			String etat_resa = this.txtEtat_resa.getText();


			Reservation uneReservation = new Reservation(date_resa, dateDebutLoc, dateFinLoc, prix, etat_resa);

			//insertion dans le professeur dans la base de données
			Controleur.insertReservation(uneReservation);

			//recuperation de l'id du professeur inseree auprès de Mysql
			uneReservation = Controleur.selectWhereReservation(date_resa, dateDebutLoc, dateFinLoc, prix, etat_resa);

			//actualiser l'affichage dans le tableau
			Object ligne[] = {uneReservation.getId_resa(), date_resa, dateDebutLoc, dateFinLoc, prix, etat_resa};
			this.unTableau.ajouterLigne(ligne);
			this.nb = this.unTableau.getRowCount();
			this.nbCours.setText("Nombre de cours : " + nb);

			JOptionPane.showMessageDialog(this, "Insertion réussie du cours.");
			this.txtDate_resa.setText("");
			this.txtDateDebutLoc.setText("");
			this.txtDateFinLoc.setText("");
			this.txtPrix.setText("");
			this.txtEtat_resa.setText("");
		} else if (e.getSource() == this.btFiltrer) {
			String filtre = this.txtFiltre.getText();

			//recuperation des données de la bdd avec le filtre
			Object matrice[][] = this.obtenirDonnees(filtre);

			//actualisation de l'affichage
			this.unTableau.setDonnes(matrice);
		} else if (e.getSource() == this.btEnregistrer && this.btEnregistrer.getText().equals("Modifier")) {
			// Récupérer l'index de la ligne sélectionnée
			int numLigne = tableCours.getSelectedRow();
			if (numLigne >= 0) { // Vérifier si une ligne est sélectionnée
				// Récupérer les valeurs des champs de saisie
				String date_resa = this.txtDate_resa.getText();
				String dateDebutLoc = this.txtDateDebutLoc.getText();
				String dateFinLoc = this.txtDateFinLoc.getText();
				Float prix = Float.valueOf(this.txtPrix.getText());
				String etat_resa = this.txtEtat_resa.getText();

				// Accéder aux valeurs de la ligne sélectionnée et effectuer la modification
				int id_resa = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());
				Reservation uneReservation = new Reservation(id_resa, date_resa, dateDebutLoc, dateFinLoc, prix, etat_resa);

				// Modification dans la base de données
				Controleur.updateReservation(uneReservation);

				// Actualiser l'affichage dans le tableau
				Object ligne[] = {uneReservation.getId_resa(), date_resa, dateDebutLoc, dateFinLoc, prix, etat_resa};
				this.unTableau.modifierLigne(numLigne, ligne);

				// Afficher un message de confirmation
				JOptionPane.showMessageDialog(this, "Modification réussie du cours.");

			} else{
					// Aucune ligne sélectionnée, afficher un message à l'utilisateur
					JOptionPane.showMessageDialog(this, "Veuillez sélectionner un cours à modifier.", "Aucune sélection", JOptionPane.INFORMATION_MESSAGE);
				}
			}
		}
}