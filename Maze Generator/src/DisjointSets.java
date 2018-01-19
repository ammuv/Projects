package mazegenerator;
import java.util.Vector;

//Disjoint sets class- used for checking connectivity of cells
public class DisjointSets {
	private Vector<Integer>  s;
	int noSets;
	
	public DisjointSets(int noEle){
		s=new Vector<Integer>(noEle);
		noSets=noEle;
		int i;
		for(i=0;i<noEle;i++)
			s.add(-1);
	}
	
	public void union(int root1,int root2){
		if(s.get(root2)<s.get(root1)){
			s.set(root1,root2);
		}
		else{
			if(s.get(root2)==s.get(root1))
				s.set(root1,s.get(root1)-1);
			s.set(root2,root1);
		}
		noSets--;
	}
	
	public int find(int x){
		if(s.get(x)<0)
			return x;
		else{
			int t=find(s.get(x));
			s.set(x,t);
			return s.get(x);
		}
	}
	
	public int numberOfSets(){
		return noSets;
	}
}
