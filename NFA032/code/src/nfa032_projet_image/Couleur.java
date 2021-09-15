package nfa032_projet_image;

// Interface pour l'abstraction des couleurs
// Les couleurs interviennent lorsqu'on détermine la couleur dominante d'un segment
// ou qu'on veut colorier un segment en fonction d'une des couleurs élémentaires
// la méthode adaptateurModification fonctionne comme une modification sans implémenter l'interface Modification
// C'est la méthode MonochromeCouleurElementaire qui implémente Modification et accepte des couleurs comme arguments


public interface Couleur {
public boolean siDominant(Segment segment1);
public void adaptateurModification (Segment segment1);
}
