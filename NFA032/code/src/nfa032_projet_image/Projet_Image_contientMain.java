package nfa032_projet_image;

public class Projet_Image_contientMain {
		
	public static void main (String[] args) {
		// TODO Auto-generated method stub
		
		// on crée une instance de gestionnaire de menu utilisée par main() pour appeler le menu principal
		GestionnaireMenuPrincipal gestionMenuPrincipal = new GestionnaireMenuPrincipal();
		
		// On crée une instance de la rubrique MenuPrincipalProjet qui est la seule dont main() a besoin
		RubriquePourSelectionDansMenu rubriqueMain = gestionMenuPrincipal.rubriquesProjet.new MenuPrincipalProjet();
	
		do {
			
			((RubriqueAvecDeclenchementAction) rubriqueMain).declenche();
			
		} while ( gestionMenuPrincipal.siContinuer );
	}
	
}
