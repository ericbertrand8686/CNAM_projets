package nfa031_projet_mastermind;

import java.util.Scanner;

public class NFA031_Projet_Mastermind {
	
	// Le début du programme est repris de RandomMastermind()
	static String [] TAB_REF_COLORS = {
			"rouge",
			"jaune",
			"vert",
			"bleu",
			"orange",
			"blanc",
			"violet",
			"fuchsia"
	};
	
	static int NB_COLORS = 4;
	static int NB_TOURS = 12;
	
	// je crée sc en variable statique ce qui permet de la refermer en fin de main() sans produire d'erreur due à la fermeture de System.in
	static Scanner sc = new Scanner(System.in);
	
	
	public static void main(String[] args) {
			
		String [] combinaisonSecrete = generateRandomCombination();
		String [] combinaisonEntree = new String[NB_COLORS];
		String [] recapitulatifTours = new String[NB_TOURS];						// tableau des résultats de chaque tour
		String resultatComparaison = "";
		// J'enregistre la chaîne qui me permet de savoir si le joueur a gagné
		String comparaisonFinDuJeu = compareCombinaisons(combinaisonSecrete,combinaisonSecrete);

		int tourDeJeu = 0;

		do {
			System.out.println("Tour n° "+ (tourDeJeu+1));
			
			// Pour rendre le programme "jouable" on affiche un récapitulatif à partir du 3ème tour
			if (tourDeJeu>1) {
				for (int i=0;i<tourDeJeu;i++) System.out.println(recapitulatifTours[i]);		
					}
			
			System.out.println();
			
			// Le joueur propose une combinaison et le programme lui fournit le résultat obtenu
			combinaisonEntree = lireCombinaison();
			
			System.out.println();
			System.out.println("La combinaison que vous avez choisie est :");
			afficheCombinaison(combinaisonEntree);
			
			resultatComparaison = compareCombinaisons(combinaisonSecrete,combinaisonEntree);
		
			System.out.println(resultatComparaison);
			System.out.println();
			
			recapitulatifTours[tourDeJeu]= chaineCombinaison(combinaisonEntree) + resultatComparaison;
			
			tourDeJeu++;
		
		} while ((tourDeJeu<NB_TOURS)&&!(resultatComparaison.equals(comparaisonFinDuJeu)));
		
		if (resultatComparaison.equals(comparaisonFinDuJeu)) {
			System.out.println("Bravo, vous avez gagné en " + tourDeJeu + " tours!");
		} else {
			System.out.println("Le tour n° " + tourDeJeu + " est passé, vous avez perdu");
			System.out.println("la bonne combinaison était :");
			afficheCombinaison(combinaisonSecrete);
		}
		sc.close();
	}

	
	
	// Affichage d'une combinaison
	static void afficheCombinaison (String [] Combi) {

		for (int i=0; i < NB_COLORS; i++) {
		System.out.print(Combi[i] + "\t\t"  );
		}										
	}

	
	// Chaine correspondant à la combinaison
	static String chaineCombinaison (String [] Combi) {
		String chaine ="";

		for (int i=0; i < NB_COLORS; i++) {
		chaine= chaine+(Combi[i] + "\t\t"  );
		}			
		return chaine;
	}
	

	// Comparaison de combinaisons
	static String compareCombinaisons (String [] combi1, String [] combi2) {

		int couleursBienPlacees = 0;
		int couleursPresentes = 0;
		
		if (combi1.length!=NB_COLORS||combi2.length!=NB_COLORS) {
		} else {
			for (int i=0; i < NB_COLORS; i++) {
				if (combi1[i]==combi2[i]) couleursBienPlacees++;
				}
			
			for (int i=0; i < NB_COLORS; i++) {
				for (int j=0; j < NB_COLORS; j++) {
					if (combi1[i]==combi2[j]) couleursPresentes++;
				}
			}
			
		}
		
		String res = (" " + couleursBienPlacees + " bien placée(s) et " + (couleursPresentes-couleursBienPlacees) + " présente(s)");
		return res;
	}
	

	// Entrée par le clavier d'une combinaison, , autant que possible j'ai réutilisé les éléments de generateRandomCombination()
	static String [] lireCombinaison() {
		
		String [] combination = new String[NB_COLORS];
		int entree = 0;
		int currentPosition = 0;
		
		System.out.println("Entrez votre combinaison en donnant " + NB_COLORS + " chiffres correspondants aux couleurs");
		System.out.println("< 0 > annuler la combinaison et reprendre à zéro");
		for (int i=0; i<TAB_REF_COLORS.length; i++) {
			System.out.print("< " + (i+1) + " > " + TAB_REF_COLORS[i] + "\t\t"  );
			if ((i%4)==3) System.out.println();
			// rappel des numéros correspondants aux couleurs que l'on utilisera pour entrer la combinaison
		}		
		System.out.println();
								
			while(currentPosition!=NB_COLORS) {
				do  {
					System.out.print("Entrez la couleur en position " + (currentPosition + 1) +" : ");
					entree = sc.nextInt();	
				} while ((entree<0)||(entree>8));
				
				if (entree==0) {
					System.out.println("Vous avez souhaité reprendre l'entrée de la combinaison à zéro");
					currentPosition = 0;
					for (int i = 0;  i<NB_COLORS; i++) combination[i]="";
				} else if (isIn(TAB_REF_COLORS[(entree-1)], combination)) {
					System.out.println("La couleur choisie ne peut apparaitre qu'une fois dans la combinaison");
				} else {
					combination[currentPosition]= TAB_REF_COLORS[(entree-1)];
					currentPosition++;						
				}
			}
		return combination;		
		}
	
	
	// Generate random combination of 4 colors, code repris de RandomMastermind()
	static String [] generateRandomCombination() {
		String [] combination = new String[NB_COLORS];
		int currentPosition = 0;
		while(currentPosition!=NB_COLORS) {
			int indexRandom = (int)(Math.random()*TAB_REF_COLORS.length);
			String color = TAB_REF_COLORS[indexRandom];
			if(!isIn(color, combination)) {
				combination[currentPosition] = color;
				currentPosition++;
			}
		}
		return combination;
	}

	static boolean isIn(String iStringToFind, String [] iTab) {
		int size = iTab.length;
		for(int i=0;i<size;i++) {
			if(iStringToFind.equals(iTab[i])) return true;
		}
		return false;
	}

}

