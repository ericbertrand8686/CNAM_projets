package nfa032_projet_image;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;


//---------------------------------------------------------------------------------------
// Classe des images PPM
public class ImagePPM {

	private String nom;
	
	private int valeurMax;
	private int largeur;
	private int hauteur;
	
	private Segment premierSegment;
	
	public ImagePPM () {
		super();
	}
	
	public ImagePPM (String nom1, int valeurMax1, int largeur1, int hauteur1, Segment premierSegment1 ) {
		this.nom = nom1;
		this.valeurMax = valeurMax1;
		this.largeur = largeur1;
		this.hauteur = hauteur1;
		this.premierSegment = premierSegment1;
	}
	
	public void afficheDansListe () {
		Terminal.ecrireString(this.nom + " \t " + this.largeur +  "  x  " + this.hauteur);
	}
	
	//---------------------------------------------------------------------------------------
	
	public int getHauteur () {
		return this.hauteur;
	}
	
	public int getLargeur () {
		return this.largeur;
	}
	
	//---------------------------------------------------------------------------------------
	public void chargerFichier (String RepertoireDeBase1, String nomFichier1) {
		
		int compte = 0;
		String leRouge; // intermédiaires pour la lecture du fichier
		String leVert;
		String leBleu;
		FileInputStream fichier ;
		
		try{
			fichier = new FileInputStream (RepertoireDeBase1+nomFichier1);
		} catch ( FileNotFoundException ex ) {
			Terminal.ecrireStringln("Ce fichier n’existe pas");
			Terminal.ecrireStringln("");
			return;
		}
		
		try {
			getNext(fichier,10);			//P3
			getNext(fichier,10);			//Commentaire
			int largeur2 = Integer.parseInt(getNext(fichier,32));
			int hauteur2 = Integer.parseInt(getNext(fichier,10));
			int valeurMax2 = Integer.parseInt(getNext(fichier,10));

			this.nom = nomFichier1;
			this.valeurMax = valeurMax2;
			this.largeur = largeur2;
			this.hauteur = hauteur2;
			this.premierSegment = new Segment();
							
			int nombrePixels = largeur2*hauteur2;
			
			Segment segmentCourant = this.premierSegment;
			Segment segmentSuivant = new Segment();
			
			leRouge = getNext(fichier,32);
			leVert = getNext(fichier,32);
			leBleu = getNext(fichier,32);
			
			//On amorce le processus en chargeant le premier pixel dans segmentCourant
			segmentCourant.setSegment(Integer.parseInt(leRouge),Integer.parseInt(leVert),Integer.parseInt(leBleu), 1, null );
			compte++;
			
			while (compte<nombrePixels) {
				
				leRouge = getNext(fichier,32);
				leVert = getNext(fichier,32);
				leBleu = getNext(fichier,32);

				//Dans la suite de la boucle on charge le pixel dans SegmentSuivant
				segmentSuivant.setSegment(Integer.parseInt(leRouge),Integer.parseInt(leVert),Integer.parseInt(leBleu), 1, null );
				
				//Ce qui permet de vérifier s'il faut allonger le segment en cours ou en créer un nouveau
				if ( segmentCourant.memesIntensites(segmentSuivant)) {
						segmentCourant.incrementeNombre();
				} else {
					segmentCourant.setSuivant(segmentSuivant);
					segmentCourant = segmentSuivant;
					segmentSuivant = new Segment();
				}
				compte++;
			}
			fichier.close() ;
		} catch ( FileNotFoundException ex ){
			Terminal.ecrireStringln("Ce fichier n’existe pas");
		} catch ( IOException exc ){
			Terminal.ecrireStringln( "Erreur d'entrée−sortie" );
		}
	}
	
	private String getNext(FileInputStream fichier1, int but) {
		String res ="";
		int c;
		
		try{
				c = fichier1.read ();
				
				if (but==32) {
					while((c==32)||(c==10)) {
						 c = fichier1.read ();
					 } 
				}
				
				while ((c!= -1)&&(c!= but)) {
					if (c!= 10) res = res + (char) c;
					c = fichier1.read ();
				}

		} catch ( IOException exc ) {
					Terminal.ecrireStringln( "Erreur d'entrée−sortie" );
		}
		return res;
	}
	
	//---------------------------------------------------------------------------------------
	public void enregistrerFichier (String repertoireDeBase1, String nomFichier1) {
		
		FileOutputStream fichier;
		
		int compte = 1;
		int nombrePixels = this.largeur * this.hauteur ;
		
		Segment segmentCourant;
		Segment segment1 = new Segment();
		segment1.setSuivant(null);
		
		String aEcrire;
		String aLaLigne = "\n";
		int tailleSegment;
		
		try {
			fichier = new FileOutputStream (repertoireDeBase1 + nomFichier1);
			
			writeNext (fichier, "P3" + aLaLigne);
			writeNext (fichier, "# issu de " + this.nom + aLaLigne);
			writeNext (fichier, String.valueOf(this.largeur) + " " );
			writeNext (fichier, String.valueOf(this.hauteur) + aLaLigne);
			writeNext (fichier, String.valueOf(this.valeurMax) + aLaLigne);
			
			segmentCourant = this.premierSegment;

			while (compte<=nombrePixels) {
				
				tailleSegment = segmentCourant.getNombre();
				aEcrire = segmentCourant.intensitesEnChaine();
				
				for (int i=0; i<tailleSegment;i++) {
					writeNext(fichier,aEcrire);
					if ((compte%5)==0) writeNext (fichier, aLaLigne);
					compte++;
				}
				segmentCourant = segmentCourant.getSuivant();
			}
			
			
			fichier.close () ;
		} catch ( IOException exc ) {
		Terminal.ecrireStringln ("Erreur d'entrée−sortie");
		}
		Terminal.ecrireStringln("");
	}
	
	
		private void writeNext(FileOutputStream fichier1, String aEcrire) {
		try {
			for ( int i = 0 ; i< aEcrire.length () ; i ++) {
			fichier1.write(aEcrire.charAt (i));
			}
		} catch ( IOException exc ) {
			Terminal.ecrireStringln ("Erreur d'entrée−sortie");
		}
	}
	
	//---------------------------------------------------------------------------------------
	// Modification sur l'ensemble d'une image
	public void modificationGlobale (ModificationSegment modif1) {
		int compte = 1;
		int nombrePixels = this.largeur * this.hauteur ;
		Segment segmentCourant = this.premierSegment;
		
		while (compte<=nombrePixels) {
			segmentCourant.appliqueModif(modif1);
			compte = compte + segmentCourant.getNombre();
			segmentCourant = segmentCourant.getSuivant();
		}
	}
	
	
	// Modification sur l'ensemble d'une image par une méthode récursive
	public void modificationGlobaleRecursive (ModificationSegment modif1) {
		this.premierSegment.applicationRecursiveModif(modif1);
	}
	

	//---------------------------------------------------------------------------------------
	
	public void redimensionne(int largeur1,int hauteur1) {
		
		Segment segmentCourant = this.premierSegment;
		Segment debutDeLigne;
		Segment segmentCourantDepart;
		Segment finDeLignePourRaccord = null;
		Segment segmentPourRaccordDeLigne = null;
		
		double rapportLargeur = ((double)largeur1)/((double)this.getLargeur());			// passer les largeurs en type double absolument
		double rapportHauteur = ((double)hauteur1)/((double)this.getHauteur()); 	
		double longueurSegmentRedim;
		

		int rouge1, vert1, bleu1;													// Intensités de couleur
		
		int longueurCouranteSegment;
		int longeurRedimAjusteeEnInt;
		int compteurLargeurLigne, compteurLargeurLigneRedim;
		int compteurNbLignesRedim = 0;
		
		
		
		
		// Première boucle pour parcourir tous les lignes de l'image non redimensionnée
		for (int i=0; i<this.getHauteur();i++) {
			
			compteurLargeurLigne = 0;
			compteurLargeurLigneRedim = 0;
			
			
			// on repère le début et de la ligne et on l'ajuste si nécessaire à la bonne longueur
			debutDeLigne = segmentCourant;
			
	
			debutDeLigne.avancePourGarder(this.getLargeur());

			
			// Deuxième bloucle sur la longueur d'une ligne  
			while (compteurLargeurLigne<this.getLargeur()) {
			
				longueurCouranteSegment = 0;
				longueurSegmentRedim = 0;
				segmentCourantDepart = segmentCourant;
				rouge1 = 0;
				vert1 = 0;
				bleu1 =0;
				
				// Dans le cas d'une contraction la deuxième boucle "accumule" les segments pour atteindre la longueur de 1
				while (longueurSegmentRedim<1) {
					
					longueurCouranteSegment = longueurCouranteSegment + segmentCourant.getNombre();
					compteurLargeurLigne = compteurLargeurLigne + segmentCourant.getNombre();
					longueurSegmentRedim = rapportLargeur*longueurCouranteSegment;
					
					rouge1 = rouge1 + segmentCourant.getIntensiteRouge()*segmentCourant.getNombre();
					vert1 = vert1 + segmentCourant.getIntensiteVert()*segmentCourant.getNombre();
					bleu1 = bleu1 + segmentCourant.getIntensiteBleu()*segmentCourant.getNombre();
					
					segmentPourRaccordDeLigne = segmentCourant;
					segmentCourant = segmentCourant.getSuivant();
				}
				
				// Ici on "moyenne" sur le nombre de pixel accumulés
				rouge1 = (int) Math.round( ((double) rouge1) / ((double) longueurCouranteSegment) );
				vert1 = (int) Math.round( ((double) vert1) / ((double) longueurCouranteSegment) );
				bleu1 = (int) Math.round( ((double) bleu1) / ((double) longueurCouranteSegment) );
							
				longeurRedimAjusteeEnInt =(int) ( Math.round(longueurSegmentRedim) );
				
				// On ajuste la longueur du segment de manière à rapprocher les compteurs des images originale et redimensionnée
				if ( Math.round((compteurLargeurLigneRedim + longeurRedimAjusteeEnInt) - rapportLargeur* ((double) compteurLargeurLigne)) >= 1 ) longeurRedimAjusteeEnInt--;
				if ( Math.round((compteurLargeurLigneRedim + longeurRedimAjusteeEnInt) - rapportLargeur* ((double) compteurLargeurLigne)) <= -1 ) longeurRedimAjusteeEnInt++;
				
				compteurLargeurLigneRedim = compteurLargeurLigneRedim + longeurRedimAjusteeEnInt;
				segmentCourantDepart.setSegment((int) rouge1, (int) vert1, (int) bleu1, longeurRedimAjusteeEnInt,segmentCourant);
			}
			
			compteurNbLignesRedim++;
			
			// Dans le cas ou on dilate l'image  en hauteur il faut "dupliquer" des lignes 
			while ( compteurNbLignesRedim < ((int) Math.round(((double) (i+1))*rapportHauteur) )    ) {
				
				// recopier la ligne courante en faisant les raccord
				// On tient compte du cas particulier de la toute première ligne
				if (finDeLignePourRaccord==null) {
					this.premierSegment = debutDeLigne.avancePourCopier(largeur1);
				} else {
					finDeLignePourRaccord.setSuivant( debutDeLigne.avancePourCopier(largeur1) );
				}
				
				compteurNbLignesRedim++;
			}
			
			// on fait itérer la fin de ligne
			finDeLignePourRaccord = segmentPourRaccordDeLigne;
			
			
			// Dans le cas ou on compresse l'image en hauteur il faut "sauter" des lignes en avançant segmentCourant 
			// et en faisant le raccord avec segmentPourRaccordDeLigne pour éliminer les lignes superflues
			if ( compteurNbLignesRedim > ((int) Math.round(((double) (i+1))*rapportHauteur) )    ) {
				segmentCourant = segmentCourant.avancePourGarder( this.getLargeur() * (compteurNbLignesRedim - (int) Math.round(((double) (i+1))*rapportHauteur)) );
				this.premierSegment = segmentCourant;
				i = i + (compteurNbLignesRedim - (int) Math.round(((double) (i+1))*rapportHauteur));
				segmentPourRaccordDeLigne.setSuivant(segmentCourant);
			}
		}
	
	this.hauteur = hauteur1;	
	this.largeur = largeur1;
	}
	
	
	//---------------------------------------------------------------------------------------
	
	public void recadre(ZoneRectangulaire rectangle1) {
		
		int premierSautDeGauche = rectangle1.getXmin() - 1;
		int sautsEnGardant = rectangle1.getXmax() -  rectangle1.getXmin()+1;
		int sautsEnEnlevant = this.largeur - rectangle1.getXmax() + rectangle1.getXmin() - 1;
		int hauteurZone = rectangle1.getYmax() - rectangle1.getYmin() +1;
		Segment segmentCourant = this.premierSegment;

		segmentCourant = segmentCourant.avancePourEnlever(this.largeur*(rectangle1.getYmin()-1) + premierSautDeGauche);
		this.premierSegment = segmentCourant;
		
		for (int i=1;i<=hauteurZone;i++) {
			segmentCourant = segmentCourant.avancePourGarder(sautsEnGardant);
			if (i==hauteurZone) sautsEnEnlevant = 0;
			
			segmentCourant.setSuivant(segmentCourant.getSuivant().avancePourEnlever(sautsEnEnlevant));
			segmentCourant = segmentCourant.getSuivant();
		}
		segmentCourant.setSuivant(null);
		
		this.hauteur = hauteurZone;
		this.largeur = sautsEnGardant;
	}
	
	
	//---------------------------------------------------------------------------------------
	
	public void modificationDansRectangle(ZoneRectangulaire rectangle1, ModificationSegment modif1) {
		
		int premierSautDeGauche = rectangle1.getXmin() - 1;
		int sautsEnColorant = rectangle1.getXmax() -  rectangle1.getXmin()+1;
		int sautsEnGardant = this.largeur - rectangle1.getXmax() + rectangle1.getXmin() - 1;
		int hauteurZone = rectangle1.getYmax() - rectangle1.getYmin() +1;
		Segment segmentCourant = this.premierSegment;
	
		segmentCourant = segmentCourant.avancePourGarder( (rectangle1.getYmin()-1)*this.largeur + premierSautDeGauche);
		
		for (int i=1;i<=hauteurZone;i++) {
			segmentCourant = segmentCourant.getSuivant().avancePourModifier(sautsEnColorant, modif1);
			if (i==hauteurZone) sautsEnGardant = 0;
			
			segmentCourant = segmentCourant.getSuivant().avancePourGarder(sautsEnGardant);
		}
	}
	
	
	//---------------------------------------------------------------------------------------
	
	public void incrustation(ImagePPM image1) {
		
		Segment segmentCourantFond = this.premierSegment;
		Segment segmentCourantIncru = image1.premierSegment;
		Segment segmentPrecedentPourRaccord = segmentCourantFond;
		int compteurFond, compteurIncru;

		// Procédé basique mais efficace avec l'exemple utilisé
		// J'utilise le premier segment de l'image à incruster
		// comme échantillon de la couleur de background
		Segment referenceCouleurIncru = image1.premierSegment;
		
		Terminal.ecrireString ("Entrez la position en largeur de l'incrustation : " );
		int x1 = ImagePPM.inImageRange(Terminal.lireInt(), this.largeur);
		Terminal.ecrireString("");
		
		Terminal.ecrireString ("Entrez la position en hauteur de l'incrustation : ");
		int y1 = ImagePPM.inImageRange(Terminal.lireInt(), this.hauteur);
		Terminal.ecrireString ("");
		
		int hauteurIncrustation = Math.min(image1.hauteur, this.hauteur - y1 +1);
		int largeurIncrustation = Math.min(image1.largeur, this.largeur - x1 +1);
		int sautDeRaccordDansIncru = image1.largeur - largeurIncrustation;
		int sautDeRaccordDansFond = this.largeur - largeurIncrustation ;
		
		segmentCourantFond = segmentCourantFond.avancePourGarder( (y1-1)*this.largeur + x1 - 1);
		segmentCourantFond = segmentCourantFond.getSuivant();
		
		for (int i=0; i<hauteurIncrustation; i++) {
			
			System.out.println(i);		//
			
			// On initialise les compteurs indiquants le nombre de pixels incrustés dans l'image de fond et l'image à incruster
			compteurFond =  0;
			compteurIncru = 0;
			
			while (compteurIncru<largeurIncrustation) {
				
				// Si le segment courant à incruster est plus long que la largeur à incruster on partage
				// ce segment courant en deux, la longueur du premier segment étant la longueur à incruster
			
				if (segmentCourantIncru.getNombre()>(largeurIncrustation-compteurIncru)) {
					segmentCourantIncru = segmentCourantIncru.avancePourGarder(largeurIncrustation-compteurIncru);
				}
				
				// Si le segment courant du fond est plus long que le segment à incruster on le partage en deux
				if (segmentCourantFond.getNombre() > segmentCourantIncru.getNombre()) {
					segmentCourantFond = segmentCourantFond.avancePourGarder(segmentCourantIncru.getNombre());
					}
				

				// C'est ici qu'on décide d'incruster ou de laisser le fond intact
				//
				if (segmentCourantIncru.memesIntensites(referenceCouleurIncru)) {
					// On met a jour les compteurs d'incrustation
					compteurFond = compteurFond + segmentCourantIncru.getNombre();
					compteurIncru = compteurIncru + segmentCourantIncru.getNombre();
						
					// On avance sur l'image du fond en laissant les pixels du parcours intacts
					segmentCourantFond = segmentCourantFond.avancePourGarder(segmentCourantIncru.getNombre()) ;
					
				} else {
					// Si le segment courant du segment à incruster est plus long que le fond on le partage en deux
					if (segmentCourantIncru.getNombre() > segmentCourantFond.getNombre()) {
						segmentCourantIncru = segmentCourantIncru .avancePourGarder(segmentCourantFond.getNombre());
						}
					
					//On met a jour les compteurs d'incrustation
					compteurFond = compteurFond + segmentCourantFond.getNombre();
					compteurIncru = compteurIncru + segmentCourantIncru.getNombre();
						
					//On "incruste" en recopiant le segment à incruster sur celui du fond	
					segmentCourantFond.recopieSegment(segmentCourantIncru);
				}
				

				
				// On garde en mémoire le segment courant du fond avant itération pour faire le raccord en fin de zone d'incrustation
				segmentPrecedentPourRaccord = segmentCourantFond;
				
				//On itère en passant aux segments suivants
				segmentCourantFond = segmentCourantFond.getSuivant();
				segmentCourantIncru = segmentCourantIncru.getSuivant();
				
			}
			
			System.out.println(largeurIncrustation-compteurFond);
			
			// On a fini d'incruster une ligne et on fait en sorte de passer à la suivante
			
			// On fait un premier saut dans l'image du fond pour arriver à la fin de la zone d'incrustation
			//if (largeurIncrustation > compteurFond) {
			//	segmentCourantFond = segmentCourantFond.avancePourGarder(largeurIncrustation-compteurFond);
			//	segmentCourantFond = segmentCourantFond.getSuivant();
			//}

			// On fait le raccord pour enlever les segments superflus
			//segmentPrecedentPourRaccord.setSuivant(segmentCourantFond);
			
			
			// On se positionne sur la ligne suivante au début de la zone d'incrustation
			if (sautDeRaccordDansFond > 0) {
				segmentCourantFond = segmentCourantFond.avancePourGarder(sautDeRaccordDansFond);
				segmentCourantFond = segmentCourantFond.getSuivant();
			}

			if (sautDeRaccordDansIncru > 0) {
				segmentCourantIncru = segmentCourantIncru.avancePourGarder(sautDeRaccordDansIncru);
				segmentCourantIncru = segmentCourantIncru.getSuivant();
			}
			
		}
	}
	

	
	//---------------------------------------------------------------------------------------
	
	
	public ZoneRectangulaire selectionneZoneRectangulaire() {
		int entreeXmin, entreeXmax, entreeYmin, entreeYmax, courant;
		
		Terminal.ecrireString ("Entrez la valeur minimale pour la largeur : ");
		entreeXmin = ImagePPM.inImageRange(Terminal.lireInt(), this.largeur);
		Terminal.ecrireString("");
		
		Terminal.ecrireString ("Entrez la valeur maxmimale pour la largeur : ");
		entreeXmax = ImagePPM.inImageRange(Terminal.lireInt(), this.largeur);
		Terminal.ecrireString ("");
		
		if (entreeXmax<entreeXmin) {
			courant = entreeXmax;
			entreeXmax =  entreeXmin;
			entreeXmin = courant;
		}
		
		Terminal.ecrireString ("Entrez la valeur minimale pour la hauteur : ");
		entreeYmin = ImagePPM.inImageRange(Terminal.lireInt(), this.hauteur);
		Terminal.ecrireString("");
		
		Terminal.ecrireString ("Entrez la valeur maximale pour la hauteur : " );
		entreeYmax = ImagePPM.inImageRange(Terminal.lireInt(), this.hauteur);
		Terminal.ecrireString("");
		
		if (entreeYmax<entreeYmin) {
			courant = entreeYmax;
			entreeYmax =  entreeYmin;
			entreeYmin = courant;
		}
		
		return new ZoneRectangulaire(entreeXmin, entreeXmax, entreeYmin, entreeYmax);
	}
	
	public int getValeurMax () {
		return this.valeurMax;
	}

	
	//---------------------------------------------------------------------------------------
	// petite fonction pour faciliter les calculs et ne pas outrepasser l'intensité maximum de l'image

	public static int inImageRange(int valeurIntensite, int IntensiteMax) {
		if (valeurIntensite<0) valeurIntensite = 0;
		if (valeurIntensite> IntensiteMax) valeurIntensite = IntensiteMax;
		return valeurIntensite;
	}
}
