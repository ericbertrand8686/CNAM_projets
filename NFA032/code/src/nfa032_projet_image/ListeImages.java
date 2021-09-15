package nfa032_projet_image;

import nfa032_projet_image.Terminal.TerminalException;

//---------------------------------------------------------------------------------------
// Liste d'images en mémoire avec les méthodes associées pour la gérer

public class ListeImages {
	
	private int nombreImagesMax = 5;
	private String repertoireDeBase = "D:\\Eric\\Programmation\\CNAM\\NFA032_JAVA\\Projet\\fichiers_ppm\\";
	private ImagePPM [] liste = new ImagePPM[nombreImagesMax];
	
	//---------------------------------------------------------------------------------------
	// Choix d'une image instanciée (# null) dans la liste
	
	public ImagePPM choixImage () {
		int numImage;
		boolean siImageEnMemoire = false;
		
		for (int i=0;i<this.nombreImagesMax;i++) {
			if (this.liste[i]!=null) siImageEnMemoire = true;
		}
		
		if (!siImageEnMemoire) {
			Terminal.ecrireStringln("Il n'y a aucune image en mémoire");
			return null;
		}
		
		try {
			do {
				do {
				numImage = Terminal.lireInt();
				} while ( (numImage<1)||(numImage>this.nombreImagesMax));
				
			} while (this.liste[numImage-1]==null);
			
			Terminal.ecrireString ("Vous avez selectionné : ");
			this.liste[numImage-1].afficheDansListe();
			Terminal.ecrireStringln("");
			
			return this.liste[numImage-1];
		} catch (TerminalException err1) {
			Terminal.ecrireStringln("");
			Terminal.ecrireStringln("Vous devez rentrer un nombre entier");
			Terminal.ecrireStringln("");
			return null;
		}
	}
	
	//---------------------------------------------------------------------------------------
	// Fonction renvoyant un booléen pour indiquer si on peut charger une image supplémentaire
	
	public boolean placeDisponible() {
		boolean res = false;
		for (int i=0;i<this.nombreImagesMax;i++) {
			if (this.liste[i]==null) res = true;
		}
		return res;
	}
	
	//---------------------------------------------------------------------------------------
	// Repère une position disponible dans liste d'images et y crée une nouvelle image
	
	public ImagePPM disponible () {
		int numImage = -1;
		for (int i=this.nombreImagesMax-1;i>=0;i--) {
			if (this.liste[i]==null) numImage = i;
		}
		this.liste[numImage] = new ImagePPM();
		return this.liste[numImage];
	}
	
	//---------------------------------------------------------------------------------------
	// Affiche la liste des images chargées en mémoire
	
	public void afficheListe() {
		boolean vide = true;
		for (int i=0; i<this.nombreImagesMax;i++) {
			if (this.liste[i]!=null) {
			System.out.print((i+1) +"> \t"   );
			 this.liste[i].afficheDansListe();
			Terminal.ecrireStringln("");
			vide = false;
			}
		}
		if (vide) Terminal.ecrireStringln("Il n'y a pas d'images chargées en mémoire");
		Terminal.ecrireStringln("");
	}
	
	public String repertoire () {
		return this.repertoireDeBase;
	}	
}