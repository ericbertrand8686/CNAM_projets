package nfa032_projet_image;

// Cette interface est employée pour ajouter la fonctionnalité de déclencher une action
// à des rubriques implémentant l'interface RubriquePourSelectionDansMenu

// Dans le cadre du projet ce sont les rubriques du menu principal à qui on demande
// de pouvoir déclencher une action après qu'elles aient été sélectionnées

// Si l'héritage avait été autorisé, on aurait aussi pu étendre l'interface RubriquePourSelectionDansMenu

public interface RubriqueAvecDeclenchementAction {
	void declenche();
}



