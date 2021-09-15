package nfa031_DS_mésange;

import java.util.Scanner;

public class Gestion_Hotel_Mésange {

		public static int nbch = 5;							// je définis le nombre de chambres en static
		public static int [] nbpers = new int[nbch];		// je crée le tableau d'occupation des chambres
		
		// 2 variables statiques utilisées dans les 2 fonctions
		//situées en fin de code afichocc et nbchocc
		
		
		
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		char rep = 'z';										// charactère utilisé pour enregistrer les réponses 
		
		Scanner sc = new Scanner(System.in);				// un scanner pour les entiers
		Scanner scch = new Scanner(System.in);				// un autre pour les caractères
		
		nbpers[0]=0;										// initialisation du remplissage des chambres
		nbpers[1]=2;
		nbpers[2]=1;
		nbpers[3]=0;
		nbpers[4]=0;
			
		int numch = 1;										// utilisé pour enregistrer un numéro de chambre
		int nbpersarr = 0;									// nombre d'arrivants
		int nblitsch = 0;									// utilisé pour calculer le nombre de lits d'une chambre
		
		boolean sinumch = false;							// vrai si un numéro de chambre valide est entré
		boolean sichocc = false;							// vrai si une chambre est occupée 
		
		System.out.println("Bienvenue dans le programme de gestion  de l'hôtel Mésange");
		System.out.println("Le tableau suivant vous donne un aperçu de l'occupation des chambres:");

		affichocc();										// On fait un premier état des lieux du remplissage
		
		do {
			System.out.println("Quelle action souhaitez-vous effectuer:");
			System.out.println("Entrez <a> pour enregistrer une arrivée");
			System.out.println("Entrez <d> pour enregistrer un départ");
			System.out.println("Entrez <q> pour quitter le programme");
			
			rep = scch.next().charAt(0);					// l'action choisie est enrregistrée avec le charactère rep
			
			System.out.println();							// passage à la ligne esthétique dans la plupart des cas
			
			switch(rep) {									// on est aiguillé par un switch sur l'action à effectuer
			
				case 'a' : {
					if (nbchocc()==5) {						// toutes les chambres sont occupées
						System.out.println("Aucune chambre n'est libre, vous ne pouvez enregistrer d'arrivée");
					} 
					else {									// ici, il reste des places
						System.out.print("Combien d'arrivants souhaitez vous enregistrer: ");
						nbpersarr=sc.nextInt();				// on enregistre le nombre d'arrivants souhaités
						System.out.println();
			
						if (nbpersarr==0) {					// 0 arrivants
							System.out.println("Un nombre nul d'arrivants ne correspond pas à une opération de ce système");
						break;								// par principe j'ai utilisé l'instruction break
						}									// le code aurait fonctionné sans, je crois
						
						if (nbpersarr<0) {					// nombre négatif d'arrivants
							System.out.println("Un nombre négatif d'arrivants correspond à un départ, pas à une arrivée");
							break;	
							}
						
						if (nbpersarr>4) {					// 5+ arrivants
							System.out.println("Les chambres de l'hôtel ne peuvent accueillir plus de quatre personnes");
							break;	
							}
						
															// on a un nombre d'arrivants entre 1 et 4
															// on va passer en revue toutes les chambres avec une boucle
															// si l'une convient son numéro sera attribué à numch
						
						numch = 0;							// Tant que la valeur est nulle aucune chambre n'est attribuée aux arrivants
						
						
						for (int i=0; i<nbch;i++) {					// début de la boucle
							nblitsch = (((i+1) % 2) + 1)*2;			// savant calcul pour déterminer la capacité de la chambre
							if ((numch==0)&&(nbpers[i]==0)&&(nbpersarr<(nblitsch+1)) ) {
							// 3 conditions doivent être remplies pour attribuer une chambre aux arrivants
							// 		1) si on ne leur a pas déjà trouvé une chambre 
							// 		2) si la chambre qu'on passe en revue est vide
							// 		3) si la capacité de la chambre est suffisante
								
								numch= i+1;							// le numéro de chambre est attribué
								nbpers[i] = nbpersarr;				// on remplit la chambre
								System.out.println("Le(s) " + nbpersarr + " arrivant(s) sont bien enregistré(s) en chambre " + numch);
							}
						}
				
						if (numch==0) {								// on n'a pas pu trouver de chambre suffisamment spacieuse
							System.out.println("Les arrivants sont trop nombreux par rapport aux capacités des chambres");
							System.out.println("Vous ne pouvez pas enregistrer leur arrivée");
						}
					}
				break;	
				}
				
				
				case 'd' : { 	
					if (nbchocc()==0) {				// pas de chambre occupée don pas de départ possible
						System.out.println("Aucune chambre n'est occupée, vous ne pouvez pas enregistrer de départ");
					} else 
					{
						System.out.print("Quelle chambre va-t-elle être libérée: ");
						numch=sc.nextInt();
						System.out.println();								// on enregistre le numéro de la chambre qui se libère
						System.out.println();
						
						sinumch = (numch>0) && (numch<(nbch+1));			// s'agit-il d'un vrai numéro de chambre?
						
						if (sinumch) { sichocc = (nbpers[numch-1]>0);		// si c'est le cas on regarde si la chambre est effectivement occupée
						} else 
						{ sichocc = false;
						};
						
						if (sinumch && sichocc) {							// les deux conditions sont remplies
							nbpers[numch-1] = 0;							// on libère la chambre
							System.out.println("Le départ a été enregistré,la chambre n'est plus occupée");
						} else 
						{
							if (sinumch) {									// sinon la chambre n'est pas occupée
								System.out.println("Cette chambre n'est pas occupée, vous ne pouvez enregistrer de départ");
							} else 
							{												// ou il y a une erreur dans le numéro
								System.out.println("Cette chambre n'existe pas dans l'hôtel, vous ne pouvez enregistrer de départ");
							}
						}
					}
				break;
				}
				
				
				case 'q' : {												// commentaire esthétique
					System.out.println("Vous souhaitez arrêter les opérations");
				break;
				}
				
				
				default : {													// si la réponse n'est pas correcte
					System.out.println("Seules les touches <a> <d> et <q> sont prises en compte");
				}
			}
			
			System.out.println();												// on fait le point sur le remplissage
			System.out.println("Les chambres occupées actuellement sont:");		// en fin d'action
			affichocc();
						
		} while (rep!='q');												// tant qu'on ne quitte pas la boucle se poursuit
		
		System.out.println("Vous avez quitté le système de gestion des chambres");		// fin de boucle
		
		sc.close();														// on arrête proprements les scanners
		scch.close();
}


	public static void affichocc() {								// procédure d'affichage du remplissage
		
		System.out.println();
		
		System.out.print("Chambre numéro: \t \t");					// 1ère boucle pour la 1ère ligne
		for (int i=0; i<nbch;i++) {
			System.out.print((i+1) + "\t");
		}
		System.out.println();
					
		
		System.out.print("Nombre d'occupants: \t \t");				// 2ème boucle pour l'occupation des chambres
		for (int i=0; i<nbch;i++) {
			System.out.print(nbpers[i] + "\t");
			}
		System.out.println();
		System.out.println();
		
	}
	
	public static int nbchocc() {								// fonction qui renvoie le nombre de chambres occupées
		int n=0;
		for (int i=0; i<nbch;i++) {
			if (nbpers[i] > 0) n++  ;
			}	
		return n;
	}
}	
