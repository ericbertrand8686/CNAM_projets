package nfa031_Projet_Indicage_Naturel;

public class Projet_Indicage_Naturel {

	static char [] tab = {'c','n','a','m'};


	// Méthode d'affichage du tableau
	static void display( char [] tab1) {
		for (int i = 0; i< tab1.length; i++) {
			System.out.print(tab1[i] + " | ");
		}
		System.out.println();
	}
	
	
	// Méthode qui insère un élément dans un tableau en précisant un indice
	static char [] insertion( char [] tab1, char caractere ,int indice) {
		
		// test qui permet de s’assurer que l’indice est valable
		if (!((indice>0)&&(indice<(tab1.length+2)))) {
			System.out.println("L'indice donné n'est pas correct, le tableau ne sera pas modifié");
			return (tab1);	
		} else {
			char [] tab2 = new char[1+tab1.length];
			for (int i=0; i<(indice-1); i++) {
				tab2[i] = tab1[i];
			}
			
			tab2[indice-1]=caractere;
			
			for (int i=indice; i<tab2.length; i++) {
				tab2[i] = tab1[i-1];
			}
			
			return(tab2);
		}
	}
	
	
	// Méthode qui supprime un élément d’un tableau en précisant un indice
	// Je "recycle" la structure et une partie du code de la méthode d'insertion
	static char [] suppression ( char [] tab1, int indice) {
		
		// test qui permet de s’assurer que l’indice est valable
		if (!((indice>0)&&(indice<(tab1.length+1)))) {
			System.out.println("L'indice donné n'est pas correct, le tableau ne sera pas modifié");
			return (tab1);
		} else {
			char [] tab2 = new char[tab1.length-1];
			for (int i=0; i<(indice-1); i++) {
				tab2[i] = tab1[i];
			}
						
			for (int i=indice-1; i<tab2.length; i++) {
				tab2[i] = tab1[i+1];
			}
			
			return(tab2);
		}
	}
	
	
	// Méthode qui supprime un élément d’un tableau en précisant l’élément que l’on souhaite supprimer
	static char [] suppressionCaractere ( char [] tab1, char caractere) {
		int indice = 0;
		
		// on cherche l'élément à supprimer dans le tableau
		for (int i=0; i<tab1.length; i++) {
			if (tab1[i]==caractere) indice=i;
		}
		
		// si l'élément n'est pas trouvé
		if (indice==0) {
			System.out.println("Le caractère à supprimer n'a pas été trouvé, le tableau ne sera pas modifié");
			return tab1;
		} else {
			// l'élement est trouvé, je passe en indiçage naturel et j'exploite la méthode de suppression
			return(suppression(tab1,indice+1));
		}
	}
	
	
	// Méthode qui ajoute un élément à la fin d'un tableau sans préciser d’indice
	static char [] insertionALaFin ( char [] tab1, char caractere) {
		// Je réutilise sans la moindre vergogne la méthode d'insertion
		return insertion(tab1, caractere, 1+tab1.length);
	}
	
	
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		char [] tabToTest = tab;
		int indiceCourant = 3;
		char caractereCourant = 'i';
	
		System.out.println("Test de la méthode display");
		display(tabToTest);														// on attend c | n | a | m |
		System.out.println();
		
		System.out.println("Test de la méthode d'insertion avec l'indice " + indiceCourant + " et le caractère " + caractereCourant);
		display(insertion(tabToTest,caractereCourant,indiceCourant));			// on attend c | n | i | a | m |
		System.out.println();
		
		indiceCourant = 2;
		System.out.println("Test de la méthode de suppression avec l'indice " + indiceCourant);
		display(suppression(tabToTest,indiceCourant));							// on attend c | a | m |
		System.out.println();
		
		caractereCourant = 'a';
		System.out.println("Test de la méthode de suppression d'un élément avec le caractère " + caractereCourant);
		display(suppressionCaractere(tabToTest,caractereCourant));				// on attend c | n | m |
		System.out.println();		
		
		caractereCourant ='f';
		System.out.println("Test de la méthode d'addition d'un élément à la fin du tableau avec le caractère " + caractereCourant);
		display(insertionALaFin(tabToTest,caractereCourant));					// on attend c | n | a | m | f |
		System.out.println();
		
	}
}
