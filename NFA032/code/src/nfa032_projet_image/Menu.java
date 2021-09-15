package nfa032_projet_image;

import nfa032_projet_image.Terminal.TerminalException;

// Un menu est ici un tableau de rubriques assorti d'une méthode pour sélectionner une des rubriques

public class Menu {
			
	public Menu ( RubriquePourSelectionDansMenu [] liste1 ) {
		this.listeRubrique = liste1;
	}
	
	public RubriquePourSelectionDansMenu [] listeRubrique;
	
	// Methode pour choisir une des rubriques du menu
	public RubriquePourSelectionDansMenu choisir()  {
		
		int nombreRubriquesMenu = this.listeRubrique.length;
		for (int i=0; i<nombreRubriquesMenu;i++) {
			Terminal.ecrireStringln("< " + (i+1) + " > " + this.listeRubrique[i].getTitre());
					}
		
		Terminal.ecrireString("Entrez le nombre correspondant à l'action souhaitée : ");
		
		try {
			int choixRubrique = Terminal.lireInt();
			Terminal.ecrireStringln("");
			if ((choixRubrique>0)&&(choixRubrique<nombreRubriquesMenu+1)) {
				Terminal.ecrireStringln("Vous avez choisi " + this.listeRubrique[choixRubrique-1].getTitre());
				Terminal.ecrireStringln("");
				return (this.listeRubrique[choixRubrique-1]);
			} else {
				Terminal.ecrireStringln("Ce nombre ne correspond pas à une option");
				Terminal.ecrireStringln("");
				return null;
			}
		} catch (TerminalException err1) {
			Terminal.ecrireStringln("");
			Terminal.ecrireStringln("Vous devez rentrer un nombre entier");
			Terminal.ecrireStringln("");
			return null;
		}
	}
}
