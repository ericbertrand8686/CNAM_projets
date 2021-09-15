package nfa032_projet_image;

// ModificationSegment est utilisée pour abstraire les méthodes de modification de segment



public interface ModificationSegment {
	public void applique(Segment segment1);
	default public void menuParametresManuel() {}
}
