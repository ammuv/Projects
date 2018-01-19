package mazegenerator;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Random;
import java.util.Vector;
import java.applet.*;
import java.awt.*;

//Applet for generating the maze
public class KruskalMaze extends Applet{

	private static final long serialVersionUID = 1L;

	private int mazeWidth,c;
	private int mazeHeight;
	private int len,br;
	private Vector<Line> edges;
	private DisjointSets cells;
	private Label gend;
	private Label owner;
	
	//initializes the applet
	 public void init(){
	
		mazeWidth=50;
		mazeHeight=50;
		
		len=600/mazeHeight;
		br=800/mazeWidth;
		
		edges=new Vector<Line>();
		cells=new DisjointSets(mazeWidth*mazeHeight);
		
		setLayout(null);
		gend=new Label("MAZE");
		gend.setBackground(Color.CYAN);
		gend.setAlignment(Label.CENTER);
		gend.setFont(new Font("sans serif",Font.CENTER_BASELINE,36));
		gend.setBounds(1000,60,200,100);
		add(gend);
		owner=new Label(" Vaishali-14pt37 & Suthier-14pt35");
		owner.setBackground(Color.yellow);
		owner.setAlignment(Label.CENTER);
		owner.setFont(new Font("sans serif",Font.CENTER_BASELINE,24));
		owner.setBounds(900,200,400,150);
		add(owner);
		Point CurrentCell,CurrentCell1;
		
		/*adds edges to adjacent cells- initially all edges are present*/
		
		for(int i=0;i<mazeHeight;i++){
			for(int j=0;j<mazeWidth;j++){
				CurrentCell=new Point(i,j);
				CurrentCell1=new Point(i,j);
				if(i>0)
					edges.add(new Line(CurrentCell,new Point(i-1,j)));
				if(j>0)
					edges.add(new Line(CurrentCell1,new Point(i,j-1)));
			}
		}	
		
		generate();
	}
	
	 /*Kruskal to generate maze by applying connectivity principal*/
	 
	public void generate(){
		
		int findP1,findP2;
		while(cells.numberOfSets()>1){
			Random rn=new Random();
			int i;
			i=rn.nextInt(edges.size());
			Line l=edges.get(i);
			
			findP1=cells.find(l.beg.y+l.beg.x*mazeWidth);
			findP2=cells.find(l.end.y+l.end.x*mazeWidth);
			
			if(findP1!=findP2){
				edges.remove(i);
				cells.union(findP1,findP2);
			}
		}
		for(Line l1:edges){
			l1=rot(l1);
		}	
	}
	
	/*used to display the maze*/
	
	public void paint(Graphics g){
	       
		setBackground(Color.darkGray);
		g.setColor(Color.white);
		g.fillRect(50, 30, 800, 600);
		g.setColor(Color.black);
		g.drawRect(50, 30, 800, 600);
		
		//to generate edges randomly
		ArrayList<Integer> list = new ArrayList<Integer>();
        for (int i=1; i<edges.size(); i++) {
            list.add(new Integer(i));
        }
        Collections.shuffle(list);
	
        for(int i:list){
			Line l1=edges.get(i);
			g.setColor(Color.black);
			g.drawLine(50+l1.beg.x,30+l1.beg.y,50+l1.end.x,30+l1.end.y);		
			try
		          { Thread.sleep(1); } 
		        catch(InterruptedException ex)
		          { Thread.currentThread().interrupt(); }
		}
	}
	
	//Helper functions
	Line rot(Line l){
		Point b=convert(l.beg);
		Point e=convert(l.end);
		Point m=mid(b,e);
		
 		if(b.x==e.x){
			b.x=m.x-(br/2);
			e.x=m.x+(br/2);
			b.y=m.y;
			e.y=m.y;
		}
 		else if(b.y==e.y){
			b.y=m.y-(len/2);
			e.y=m.y+(len/2);
			b.x=m.x;
			e.x=m.x;
		}
 		l.beg=b;
 		l.end=e;
		return l;
	}
	Point mid(Point b,Point e){
		int x=(b.x+e.x)/2;
		int y=(b.y+e.y)/2;
		Point p=new Point(x,y);
		return p;
	}
	Point convert(Point p){
		int x=(br/2)+(p.y*br);
		int y=(len/2)+(p.x*len);
		Point p1=new Point(x,y);
		return p1;
	}
}


