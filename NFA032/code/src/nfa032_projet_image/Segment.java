package nfa032_projet_image;

public class Segment {
	
	private int intensiteRouge;
	private int intensiteVert;
	private int intensiteBleu;
	private int nombre;
	
	private Segment suivant;
		
	//---------------------------------------------------------------------------------------
	// Constructeurs
	
	public Segment() {
		super();
		}
	
	public Segment(int rouge, int vert, int bleu, int nb, Segment suiv) {
		this.intensiteRouge = rouge;
		this.intensiteVert = vert;
		this.intensiteBleu = bleu;
		this.nombre = nb;
		this.suivant = suiv;
	}
	
	
	//Setters
	
	public void setSegment(int rouge, int vert, int bleu, int nb, Segment suiv) {
		this.intensiteRouge = rouge;
		this.intensiteVert = vert;
		this.intensiteBleu = bleu;
		this.nombre = nb;
		this.suivant = suiv;
	}
	
	public void setIntensite(int rouge1, int vert1, int bleu1) {
		this.intensiteRouge = rouge1;
		this.intensiteVert = vert1;
		this.intensiteBleu = bleu1;
	}

	public void setSuivant(Segment suiv) {
		this.suivant = suiv;
	}
	
	public void incrementeNombre() {
		this.nombre++;
	}

	public void recopieIntensite (Segment segment1) {
		this.intensiteRouge = segment1.intensiteRouge;
		this.intensiteVert = segment1.intensiteVert;
		this.intensiteBleu = segment1.intensiteBleu;
	}
	
	public void recopieSegment (Segment segment1) {
		this.intensiteRouge = segment1.intensiteRouge;
		this.intensiteVert = segment1.intensiteVert;
		this.intensiteBleu = segment1.intensiteBleu;
		this.nombre = segment1.getNombre();
	}

	// Getters
	
	public int getNombre() {
		return this.nombre;
	}

	public Segment getSuivant() {
		return(this.suivant);
	}
		;
	public int getIntensiteRouge() {
		return this.intensiteRouge;
	}

	
	public int getIntensiteVert() {
		return this.intensiteVert;
	}

	public int getIntensiteBleu() {
		return this.intensiteBleu;
	}
	
	// Fonctions renvoyant une information binaire sur un segment
	
	public boolean memesIntensites (Segment segment1) {
		boolean res = ((this.intensiteRouge==segment1.intensiteRouge)&&(this.intensiteVert==segment1.intensiteVert)&&(this.intensiteBleu==segment1.intensiteBleu));
		return res;
	}
	
	
	public boolean siCouleurDominante (Couleur couleur1) {
		return couleur1.siDominant(this);
	}
	
	
	private boolean dansIntervalleIntensite(int rMin, int rMax, int vMin, int vMax, int bMin, int bMax) {
		boolean rougeOK = (this.intensiteRouge>=rMin)&&(this.intensiteRouge<=rMax) ;
		boolean vertOK = (this.intensiteVert>=vMin)&&(this.intensiteVert<=vMax) ;
		boolean bleuOK = (this.intensiteBleu>=bMin)&&(this.intensiteBleu<=bMax) ;
		
		return (rougeOK&&vertOK&&bleuOK);
	}
	
	
	
	//---------------------------------------------------------------------------------------
	// Méthode appliquant un type de modification passé par paramètre via une classe afin d'abstraire la modification
	
	public void appliqueModif(ModificationSegment modif1) {
		modif1.applique(this);
	}
	
	
	// Méthode récursive pour modifier un segment et tout ses suivants
	public void applicationRecursiveModif(ModificationSegment modif1) {
		
		this.appliqueModif(modif1);
		
		if (this.getSuivant()!=null) {
					this.getSuivant().applicationRecursiveModif(modif1);
		}
	}
	
	//Méthode utilisée plusieurs fois dans les classes de modification
	
	private void incrementer (int increment, int valeurMax1) {
		this.intensiteRouge = ImagePPM.inImageRange(this.intensiteRouge + increment, valeurMax1);
		this.intensiteVert = ImagePPM.inImageRange(this.intensiteVert + increment, valeurMax1);
		this.intensiteBleu = ImagePPM.inImageRange(this.intensiteBleu + increment, valeurMax1);
	}
	
	
	//---------------------------------------------------------------------------------------
	// Classes de modification de segment permettant d'abstraire les différents types de modifications
	// Elles implémentent aussi ModificationSegment ce qui leur permet de servir d'argument dans appliqueModif(ModificationSegment modif1)
	
	// Les modifications implémentent l'interface RubriquePourSelectionDansMenu ce qui leur permet d'apparaitre dans les menus)
	// Elles sont instanciées au sein des Menus modificationsGlobales et modificationsRectangle de GestionnaireMenuPrincipal
	
	public static class Modification {
		
		// Il est important que ce paramètre soit accessible aux méthodes de modification
		// pour ne pas outrepasser les limites de l'image courante
		private static int valeurMaxImageCourante = 255;
		
		// Cette méthode est appelée depuis les menus afin de mettre à jour le paramètre précédent
		// au moment ou une image et une modification ont été selectionnées
		// La méthode sert donc à assurer la communication entre les classes GestionnaireMenuPrincipal et Segment
		public static void transfereParametresImage(ImagePPM image1) {
			valeurMaxImageCourante = image1.getValeurMax();
		}
		

		public static class Moyenne implements ModificationSegment, RubriquePourSelectionDansMenu {
			public String getTitre() {
				return "Passer en niveaux de gris";
			}
			
			public void applique(Segment segment1) {
				int moyenne = (segment1.intensiteRouge + segment1.intensiteVert + segment1.intensiteBleu)/3;
				segment1.intensiteRouge = moyenne;
				segment1.intensiteVert = moyenne;
				segment1.intensiteBleu = moyenne;
			}
		}
		
		public static class Negatif implements ModificationSegment, RubriquePourSelectionDansMenu {
			
			public String getTitre() {
				return "Passer au négatif";
			}
						
			public void applique(Segment segment1) {
				int valeurMax1 = valeurMaxImageCourante;
				segment1.intensiteRouge = quePositif(valeurMax1 - segment1.intensiteRouge);
				segment1.intensiteVert = quePositif(valeurMax1 - segment1.intensiteVert);
				segment1.intensiteBleu = quePositif(valeurMax1 - segment1.intensiteBleu);
			}	
		}
		
		public static class Foncer implements ModificationSegment, RubriquePourSelectionDansMenu {
						
			private Menu menuFoncer = new Menu ( new RubriquePourSelectionDansMenu [] {
					new Rouge(),
					new Vert(),
					new Bleu()
					});
			
			private Couleur couleurCourante;
			private int incrementCourant;
			
			public String getTitre() {
				return "Foncer ou éclaircir les zones avec une couleur dominante";
			}
			
			public void menuParametresManuel() {
				Terminal.ecrireStringln("Choisissez la couleur dominante");
				couleurCourante = (Couleur) menuFoncer.choisir();
				if (couleurCourante==null) return;
		
				Terminal.ecrireStringln("Entrez l'incrément dont les zones concernées seront modifiées");
				Terminal.ecrireStringln("Si l'entier est positif les zones foncées, s'il est positif elles seront éclaircies");
				incrementCourant = Terminal.lireInt();
				Terminal.ecrireStringln("");
			}
			
			public void applique(Segment segment1) {
				if (couleurCourante==null) return;
				if (couleurCourante.siDominant(segment1))  {
					segment1.incrementer(incrementCourant, valeurMaxImageCourante);
				}
			}
		}
		
		public static class FoncerParIntervalle implements ModificationSegment, RubriquePourSelectionDansMenu {
			private int incrementCourant;
			private int rougeMin, rougeMax, vertMin, vertMax, bleuMin, bleuMax;
			
			public String getTitre() {
				return "Foncer ou éclaircir les zones selectionnées par intervalles d'intensité";
			}
			
			public void menuParametresManuel() {
				
				Terminal.ecrireStringln("Pour la couleur rouge");
				Terminal.ecrireString("Choisissez la valeur minimale de l'intervalle : ");
				rougeMin = Terminal.lireInt();
				Terminal.ecrireStringln("");
				Terminal.ecrireString("Choisissez la valeur maximale de l'intervalle : ");
				rougeMax = Terminal.lireInt();
				Terminal.ecrireStringln("");

				Terminal.ecrireStringln("Pour la couleur verte");
				Terminal.ecrireString("Choisissez la valeur minimale de l'intervalle : ");
				vertMin = Terminal.lireInt();
				Terminal.ecrireStringln("");
				Terminal.ecrireString("Choisissez la valeur maximale de l'intervalle : ");
				vertMax = Terminal.lireInt();
				Terminal.ecrireStringln("");
				
				Terminal.ecrireStringln("Pour la couleur bleue");
				Terminal.ecrireString("Choisissez la valeur minimale de l'intervalle : ");
				bleuMin = Terminal.lireInt();
				Terminal.ecrireStringln("");
				Terminal.ecrireString("Choisissez la valeur maximale de l'intervalle : ");
				bleuMax = Terminal.lireInt();
				Terminal.ecrireStringln("");
				
				Terminal.ecrireStringln("Entrez l'incrément dont les zones concernées seront modifiées");
				Terminal.ecrireStringln("Si l'entier est positif les zones foncées, s'il est positif elles seront éclaircies");
				incrementCourant = Terminal.lireInt();
				Terminal.ecrireStringln("");
			}

			public void applique(Segment segment1) {
				if (segment1.dansIntervalleIntensite(rougeMin, rougeMax, vertMin, vertMax, bleuMin, bleuMax)) {
					segment1.incrementer(incrementCourant, valeurMaxImageCourante);
				}
			}
		}

		public static class Monochrome implements ModificationSegment, RubriquePourSelectionDansMenu {
			
			private int leRouge, leVert, leBleu;
			
			public String getTitre() {
				return "Modification en monochrome (1 seule couleur)";
			}
				
	public void menuParametresManuel() {
				
		Terminal.ecrireStringln("Choisissez les composantes de votre couleur");
				Terminal.ecrireString("Choisissez l'intensité de la couleur rouge : ");
				leRouge = ImagePPM.inImageRange(Terminal.lireInt(), valeurMaxImageCourante);
				Terminal.ecrireStringln("");
				
				Terminal.ecrireString("Choisissez l'intensité de la couleur verte : ");
				leVert = ImagePPM.inImageRange(Terminal.lireInt(), valeurMaxImageCourante);
				Terminal.ecrireStringln("");
				
				Terminal.ecrireString("Choisissez l'intensité de la couleur bleue : ");
				leBleu = ImagePPM.inImageRange(Terminal.lireInt(), valeurMaxImageCourante);
				Terminal.ecrireStringln("");
			}
			
			public void applique(Segment segment1) {
				segment1.setIntensite(leRouge, leVert, leBleu);
			}
		}
		
		public static class MonochromeCouleurElementaire implements ModificationSegment, RubriquePourSelectionDansMenu {
			
			private Couleur couleurElementaire;
			
			public MonochromeCouleurElementaire (Couleur couleur1) {
				super();
				this.couleurElementaire = couleur1;
			}
			
			public String getTitre() {
				return ( "Modification en " +  ((RubriquePourSelectionDansMenu) this.couleurElementaire).getTitre() );
			}
				
	public void menuParametresManuel() {
			}
			
			public void applique(Segment segment1) {
				this.couleurElementaire.adaptateurModification(segment1);
			}
		}
		

		// Fonction utilisée pour que les valeurs d'intensité calculées ne puissent être que positives
		private static int quePositif(int num) {
			int res=num;
			if (res<0) res = 0; 
			return res;
		}
		
	}
	
	public String intensitesEnChaine() {
		String res = completer(String.valueOf(this.intensiteRouge)) + completer(String.valueOf(this.intensiteVert)) + completer(String.valueOf(this.intensiteBleu));
		return res;
	}
	
	// permet d'obtenir une longueur homogène pour les chaines représentant l'intensité des couleurs
	private String completer (String aCompleter) {
		int longueur = aCompleter.length();
		
		while (longueur<4) {
			aCompleter = " " + aCompleter;
			longueur++;
		}
		aCompleter = aCompleter + " ";
		return aCompleter;
	}


	//---------------------------------------------------------------------------------------
	// Ces différentes méthodes permettent de parcourir une image
	// en partant du segment de départ et en avançant d'un nombre de pixels donné
	// Si nécessaire en effectuant des changements sur certains des segments parcourus
	// Les méthodes sont implémentées avec de la récursivité
	
	
	// Cette première version est utilisée dans l'élimination de segments au sein d'une image
	// Si le nombre de pixels ne permet pas d'éliminer entièrement le dernier segment du parcours
	// On raccourcit  ce segment de la longeur restant à parcourir/éliminer
	// Le segment renvoyé en résultat est le premier segment qui suit la section éliminée

	
	public Segment avancePourEnlever(int nombreDePas) {
		Segment segmentCourant = this;
		if (segmentCourant.nombre>nombreDePas) {
			segmentCourant.nombre = segmentCourant.nombre - nombreDePas;
			return segmentCourant;
		} else {
			nombreDePas = nombreDePas - segmentCourant.nombre;
			segmentCourant = segmentCourant.suivant;
			return segmentCourant.avancePourEnlever(nombreDePas);
		}
	}
	
	
	// Dans ce cas on veut garder les segments parcourus dans l'image
	// Si un segment est trop long pour le parcours on partage le segment
	// en deux pour que la fin de parcours tombe juste sur la fin d'un segment
	// Le segment renvoyé en résultat est le dernier de la section à conserver
	
	public Segment avancePourGarder(int nombreDePas) {
		Segment segmentCourant = this;
		if (segmentCourant.nombre == nombreDePas) {
			return segmentCourant;
		} else if (segmentCourant.nombre>nombreDePas) {
			Segment segment1 = new Segment();
			
			segment1.recopieIntensite(segmentCourant);
			segment1.nombre = segmentCourant.nombre-nombreDePas;
			segment1.suivant = segmentCourant.suivant;
			segmentCourant.nombre = nombreDePas;
			segmentCourant.setSuivant(segment1);
			
			return segmentCourant;
			} else {
			nombreDePas = nombreDePas - segmentCourant.nombre;
			segmentCourant = segmentCourant.suivant;
			return segmentCourant.avancePourGarder(nombreDePas);
		}
	}
	
	
	// Méthode similaire à avancePourGarder si ce n'est qu'on applique
	// une modification tout le long du parcours
	
	public Segment avancePourModifier(int nombreDePas, ModificationSegment modif1) {
		
		Segment segmentCourant = this;
		
		if (segmentCourant.nombre == nombreDePas) {
			segmentCourant.appliqueModif(modif1);
			return segmentCourant;
		} else if (segmentCourant.nombre>nombreDePas) {
			Segment segment1 = new Segment();
			
			segment1.recopieIntensite(segmentCourant);
			segment1.nombre = segmentCourant.nombre-nombreDePas;
			segment1.suivant = segmentCourant.suivant;
			segmentCourant.nombre = nombreDePas;
			segmentCourant.setSuivant(segment1);
			segmentCourant.appliqueModif(modif1);
			
			return segmentCourant;
			} else {
			segmentCourant.appliqueModif(modif1);
			nombreDePas = nombreDePas - segmentCourant.nombre;
			segmentCourant = segmentCourant.suivant;
			return segmentCourant.avancePourModifier(nombreDePas, modif1);
		}
	}
	
	
	// Méthode utilisé pour effectuer une copie du "parcours"
	// qui sera située juste avant le parcours original
	// Le segment renvoyé en résultat est le premier appartenant à la copie
	// qui sera untilisée pour un raccord
	// Pas de récursivité dans la méthode
	
	public Segment avancePourCopier (int nombreDePas) {
		
		Segment segmentCourant = this;
		Segment segmentCourantCopie = new Segment(0,0,0,0,null);
		Segment segmentDepartCopie = segmentCourantCopie;
		int compteur = 0;
		
		while (compteur< nombreDePas) {
		
		if (segmentCourant.getNombre() == (nombreDePas-compteur)) {
			segmentCourantCopie.recopieSegment(segmentCourant);
			compteur = compteur + segmentCourant.getNombre();
			// la boucle se termine, les raccords sont pris en charge en fin de méthode
			
		} else if (segmentCourant.nombre>(nombreDePas-compteur)) {
			
			Segment segment1 = new Segment();
			segment1.recopieIntensite(segmentCourant);
			segment1.nombre = segmentCourant.getNombre()-(nombreDePas-compteur);
			segment1.setSuivant(segmentCourant.suivant);
			segmentCourant.nombre = nombreDePas-compteur;
			segmentCourant.setSuivant(segment1);
	
			segmentCourantCopie.recopieSegment(segmentCourant);
			compteur = compteur + segmentCourant.getNombre();
			// la boucle se termine aussi là
			
		} else {
			//La boucle se poursuit 
			segmentCourantCopie.recopieSegment(segmentCourant);
			compteur = compteur + segmentCourant.getNombre();
			
			// On prépare le suivant de segmentCourantCopie
			segmentCourantCopie.setSuivant(new Segment(0,0,0,0,null));
			
			//On itère sur les segments courants
			segmentCourant = segmentCourant.getSuivant();
			segmentCourantCopie = segmentCourantCopie.getSuivant();
			}
		
		}
		
		// On fait le raccord pour placer la copie avant l'original
		segmentCourantCopie.setSuivant(this);
		
		// On revoie le point de départ pour faire le raccord
		return segmentDepartCopie;
	}
	
	
	//---------------------------------------------------------------------------------------
	// Eléments de l'interface couleur pour abstraire l'identification des couleurs dominantes et les modification en couleurs élémentaires
	
	public static class Rouge implements Couleur, RubriquePourSelectionDansMenu {
		public String getTitre() {
			return "rouge";
		}
		
		public void adaptateurModification (Segment segment1) {
			segment1.setIntensite(Modification.valeurMaxImageCourante, 0, 0);
		}
		
		public boolean siDominant(Segment segment1) {
			return ((segment1.intensiteRouge>segment1.intensiteBleu)&&(segment1.intensiteRouge>segment1.intensiteVert));
		}
	}
		
		public static class Vert implements Couleur, RubriquePourSelectionDansMenu {
			public String getTitre() {
				return "vert";
			}
			
			public void adaptateurModification (Segment segment1) {
				segment1.setIntensite(0, Modification.valeurMaxImageCourante, 0);
			}
			
			public boolean siDominant(Segment segment1) {
				return ((segment1.intensiteVert>segment1.intensiteBleu)&&(segment1.intensiteVert>segment1.intensiteRouge));
			}
		}
	
	public static class Bleu implements Couleur, RubriquePourSelectionDansMenu {
		public String getTitre() {
			return "bleu";
		}
		
		public void adaptateurModification (Segment segment1) {
			segment1.setIntensite(0, 0, Modification.valeurMaxImageCourante);
		}
		
		public boolean siDominant(Segment segment1) {
			return ((segment1.intensiteBleu>segment1.intensiteRouge)&&(segment1.intensiteBleu>segment1.intensiteVert));
		}
	}
	
}