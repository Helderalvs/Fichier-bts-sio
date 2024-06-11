package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.*;

import controleur.Neige_Soleil;
import controleur.User;

public class VueGenerale extends JFrame implements ActionListener{

	private JPanel panelMenu = new JPanel(); 
	private JButton btProfil = new JButton("Profil");
	private JButton btMateriel = new JButton("Materiel");
	private JButton btCours = new JButton("Cours");
	private JButton btReservation = new JButton("Reservation");
	private JButton btQuitter = new JButton("Quitter"); 
	
	//Les panels d'administration 
	private PanelProfil unPanelProfil ; 
	private PanelMateriel unPanelMateriel = new PanelMateriel();

	private PanelCours unPanelCours= new PanelCours();

	private PanelReservation unPanelReservation = new PanelReservation();
	
	public   VueGenerale ( User unUser) {
		
		unPanelProfil = new PanelProfil(unUser);
		
		this.setTitle("Neige & Soleil");
		this.setResizable(false);
		this.setBounds(100, 100, 1200, 600);
		this.getContentPane().setBackground(Color.gray);
		this.setLayout(null);
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
		//construction du panel Menu 
		this.panelMenu.setBounds(50, 10, 1100, 30);
		this.panelMenu.setBackground(Color.gray);
		this.panelMenu.setLayout(new GridLayout(1, 6));
		this.panelMenu.add(this.btProfil);
		this.panelMenu.add(this.btMateriel);
		this.panelMenu.add(this.btCours);
		this.panelMenu.add(this.btReservation);
		this.panelMenu.add(this.btQuitter); 
		this.add(this.panelMenu); 
		
		//rendre les boutons ecoutables 
		this.btProfil.addActionListener(this);
		this.btMateriel.addActionListener(this);
		this.btCours.addActionListener(this);
		this.btReservation.addActionListener(this);
		this.btQuitter.addActionListener(this);
		
		//ajout les panels dans la vue 
		this.add(this.unPanelProfil); 
		this.add(this.unPanelMateriel);
		this.add(this.unPanelCours);
		this.add(this.unPanelReservation);
		
		
		this.setVisible(true);
	}
	public void afficherPanel (int choix) {
		this.unPanelProfil.setVisible(false);
		this.unPanelMateriel.setVisible(false);
		this.unPanelCours.setVisible(false);
		this.unPanelReservation.setVisible(false);

		switch (choix) {
		case 1 : this.unPanelProfil.setVisible(true);break;
		case 2 : this.unPanelMateriel.setVisible(true);break;
		case 3 : this.unPanelCours.setVisible(true);break;
		case 4 : this.unPanelReservation.setVisible(true);break;
		}
	}
	@Override
	public void actionPerformed(ActionEvent e) {
		 if (e.getSource() == this.btQuitter) {
			 Neige_Soleil.rendreVisibleVueGenerale(false, null);
			 Neige_Soleil.rendreVisibleVueConnexion(true);
		 }
		 else if (e.getSource() == this.btProfil) {
			 this.afficherPanel(1);
		 }
		 else if (e.getSource() == this.btMateriel) {
			 this.afficherPanel(2);
		 }
		 else if (e.getSource() == this.btCours) {
			 this.afficherPanel(3);
		 }
		 else if (e.getSource() == this.btReservation) {
			 this.afficherPanel(4);
		 }
		
	}

}







