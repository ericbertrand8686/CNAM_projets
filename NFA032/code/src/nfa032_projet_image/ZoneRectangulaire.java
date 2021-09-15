package nfa032_projet_image;


//---------------------------------------------------------------------------------------
public class ZoneRectangulaire {
	private int xMin, xMax, yMin, yMax; 
	
	public ZoneRectangulaire(int x1, int x2, int y1, int y2 ) {
		this.xMin = x1;
		this.xMax = x2;
		this.yMin = y1;
		this.yMax = y2;
	}
	
	public int getXmin() {
		return this.xMin;
	}
	
	public int getXmax() {
		return this.xMax;
	}
	
	public int getYmin() {
		return this.yMin;
	}
	
	public int getYmax() {
		return this.yMax;
	}
}
