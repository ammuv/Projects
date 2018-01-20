package connect4;

import java.awt.*;
import java.awt.event.*;
import java.applet.*;

	public class UIFourConnect extends Applet implements ActionListener{
		private static final long serialVersionUID = 1L;
		private int X,Y,bX,bY;
		private int draw=0;
		private int row,column;
		private Label l,gend;
	    private Board b;
		private int nextMoveLocation=-1;
		private int maxDepth = 5;
		private TextField t1; 
		private int gameend=0;
		
		private int winner,wrow,wcolumn,type;
		public void init(){
			b=new Board();
			X=10;
			Y=10;
			bY=450;
			bX=460;
			t1=new TextField(20);
			b.placeMove(5, 1);
			t1.setText("6");
			t1.setBounds(460,110,110,20);
			add(t1);
			gend=new Label(" ");
			gend.setBackground(Color.yellow);
			gend.setAlignment(Label.CENTER);
			gend.setFont(new Font("sans serif",Font.CENTER_BASELINE,36));
			gend.setBounds(1000,60,200,150);
			Button bu=new Button();
			l=new Label(" ");
			String button="1234567";
			setLayout(null);
			for(int i=0;i<7;i++){
				addbutton(bu,button.substring(i,i+1));
			}	 
		}
		public void addbutton(Button b1,String s1){
			b1=new Button(s1);
			b1.setBackground(Color.red);
			b1.setForeground(Color.orange);
			b1.setBounds(bY,bX,50,50);
			add(b1);
			bY+=50;
			b1.addActionListener(this);
		}
		public void actionPerformed(ActionEvent e){
			String s1=e.getActionCommand();
			int d=Integer.parseInt(s1);
			int move=d;
			
			if(move<1 || move > 7 || !b.isLegalMove(move-1)||gameend==1){
				l.setName("Error");
				l.setBounds(1000,30,40,40);
				add(l);
			}
			else{
				playAgainstAIConsole(move);
				if(gameend==1){
					repaint();
					/*Wins w;
					WinsRead wr=new WinsRead();
					w=wr.read();
					if(winner==1)
						w.addAI();
					else if(winner==2)
						w.addUI();
					else
						w.addDraw();
					WinsWrite ww=new WinsWrite();
					ww.write(w);*/
				}
			}
		}
		public void paint(Graphics g){
			setBackground(Color.cyan);
			int i=350,j=300,k;
			for(k=0;k<7;k++){ 
				g.setColor(Color.green);
				g.fillRect(X, Y, i, j);
				g.setColor(Color.black);
				g.drawRect(X, Y, i, j);
				i=i-50;
			}
			i=360;
			j=310;
			for(k=0;k<6;k++){
				j=j-50;
				g.drawLine(Y,j,i,j);
			}
			for(i=0;i<6;i++){
				for(j=0;j<7;j++){
					row=15+i*50;
					column=15+j*50;
					if(b.board[i][j]==0)
						continue;
					else if(b.board[i][j]==1){
						g.setColor(Color.red);
						g.fillOval(column,row,40,40);
					}
					else if(b.board[i][j]==2){
						g.setColor(Color.blue);
						g.fillOval(column,row,40,40);
					}
				}
			}
			if(gameend==1){
				if(type==1){
					for(k=0;k<4;k++){
						row=15+wrow*50;
						column=15+(wcolumn+k)*50;
						g.setColor(Color.yellow);
						g.fillOval(column,row,40,40);
					}
				}
				else if(type==2){
					for(k=0;k<4;k++){
						row=15+(wrow-k)*50;
						column=15+wcolumn*50;
						g.setColor(Color.yellow);
						g.fillOval(column,row,40,40);
					}
				}
				else if(type==3){
					for(k=0;k<4;k++){
						row=15+(wrow-k)*50;
						column=15+(wcolumn+k)*50;
						g.setColor(Color.yellow);
						g.fillOval(column,row,40,40);
					}
				}
				else if(type==4){
					for(k=0;k<4;k++){
						row=15+(wrow-k)*50;
						column=15+(wcolumn-k)*50;
						g.setColor(Color.yellow);
						g.fillOval(column,row,40,40);
					}
				}
			}
			g.setColor(Color.magenta);
			g.fillRect(450,20,300,140);
			g.setColor(Color.white);
			g.setFont(new Font("Times New Roman",Font.ITALIC,20));
			g.drawString("No. of wins:", 460,55);
			g.drawString("Computer's Previous Move:",460,90);
		}
		  //Game Result
	    public int gameResult(Board b){
	        int aiScore = 0, humanScore = 0;
	        for(int i=5;i>=0;--i){
	            for(int j=0;j<=6;++j){
	                if(b.board[i][j]==0) continue;
	                
	                //Checking cells to the right
	                if(j<=3){
	                    for(int k=0;k<4;++k){ 
	                            if(b.board[i][j+k]==1) aiScore++;
	                            else if(b.board[i][j+k]==2) humanScore++;
	                            else break; 
	                    }
	                    if(aiScore==4){ winner=1;wrow=i;wcolumn=j;type=1;
                    	return 1; }
                    	else if (humanScore==4){ winner=2;wrow=i;wcolumn=j;type=1;
                    		return 2;
                    }
	                    aiScore = 0; humanScore = 0;
	                } 
	                
	                //Checking cells up
	                if(i>=3){
	                    for(int k=0;k<4;++k){
	                            if(b.board[i-k][j]==1) aiScore++;
	                            else if(b.board[i-k][j]==2) humanScore++;
	                            else break;
	                    }
	                    if(aiScore==4){ winner=1;wrow=i;wcolumn=j;type=2;
                    	return 1; }
                    	else if (humanScore==4){ winner=2;wrow=i;wcolumn=j;type=2;
                    		return 2;
                    }
	                    aiScore = 0; humanScore = 0;
	                } 
	                
	                //Checking diagonal up-right
	                if(j<=3 && i>= 3){
	                    for(int k=0;k<4;++k){
	                        if(b.board[i-k][j+k]==1) aiScore++;
	                        else if(b.board[i-k][j+k]==2) humanScore++;
	                        else break;
	                    }
	                    if(aiScore==4){ winner=1;wrow=i;wcolumn=j;type=3;
                    	return 1; }
                    	else if (humanScore==4){ winner=2;wrow=i;wcolumn=j;type=3;
                    		return 2;
                    }
	                    aiScore = 0; humanScore = 0;
	                }
	                
	                //Checking diagonal up-left
	                if(j>=3 && i>=3){
	                    for(int k=0;k<4;++k){
	                        if(b.board[i-k][j-k]==1) aiScore++;
	                        else if(b.board[i-k][j-k]==2) humanScore++;
	                        else break;
	                    } 
	                    if(aiScore==4){ winner=1;wrow=i;wcolumn=j;type=4;
                    	return 1; }
                    	else if (humanScore==4){ winner=2;wrow=i;wcolumn=j;type=4;
                    		return 2;
                    }
	                    aiScore = 0; humanScore = 0;
	                }  
	            }
	        }
	        
	        for(int j=0;j<7;++j){
	            //Game has not ended yet
	            if(b.board[0][j]==0)return -1;
	        }
	        //Game draw!
	        winner=3;
	        return 0;
	    }
	    
	    int calculateScore(int aiScore, int moreMoves){   
	        int moveScore = 4 - moreMoves;
	        if(aiScore==0)return 0;
	        else if(aiScore==1)return 1*moveScore;
	        else if(aiScore==2)return 10*moveScore;
	        else if(aiScore==3)return 100*moveScore;
	        else return 1000;
	    }
	    
	    //Evaluate board favorableness for AI
	    public int evaluateBoard(Board b){
	      
	        int aiScore=1;
	        int score=0;
	        int blanks = 0;
	        int k=0, moreMoves=0;
	        for(int i=5;i>=0;--i){
	            for(int j=0;j<=6;++j){
	                
	                if(b.board[i][j]==0 || b.board[i][j]==2) continue; 
	                
	                if(j<=3){ 
	                    for(k=1;k<4;++k){
	                        if(b.board[i][j+k]==1)aiScore++;
	                        else if(b.board[i][j+k]==2){aiScore=0;blanks = 0;break;}
	                        else blanks++;
	                    }
	                     
	                    moreMoves = 0; 
	                    if(blanks>0) 
	                        for(int c=1;c<4;++c){
	                            int column = j+c;
	                            for(int m=i; m<= 5;m++){
	                             if(b.board[m][column]==0)moreMoves++;
	                                else break;
	                            } 
	                        } 
	                    
	                    if(moreMoves!=0) score += calculateScore(aiScore, moreMoves);
	                    aiScore=1;   
	                    blanks = 0;
	                } 
	                
	                if(i>=3){
	                    for(k=1;k<4;++k){
	                        if(b.board[i-k][j]==1)aiScore++;
	                        else if(b.board[i-k][j]==2){aiScore=0;break;} 
	                    } 
	                    moreMoves = 0; 
	                    
	                    if(aiScore>0){
	                    	//moreMoves=aiScore-1;
	                    	  int column = j;
	                        for(int m=i-k+1; m<=i-1;m++){
	                         if(b.board[m][column]==0)moreMoves++;
	                            else break;
	                        }
	                    }
	                    if(moreMoves!=0) score += calculateScore(aiScore, moreMoves);
	                    aiScore=1;  
	                    blanks = 0;
	                }
	                 
	                if(j>=3){
	                    for(k=1;k<4;++k){
	                        if(b.board[i][j-k]==1)aiScore++;
	                        else if(b.board[i][j-k]==2){aiScore=0; blanks=0;break;}
	                        else blanks++;
	                    }
	                    moreMoves=0;
	                    if(blanks>0) 
	                        for(int c=1;c<4;++c){
	                            int column = j- c;
	                            for(int m=i; m<= 5;m++){
	                             if(b.board[m][column]==0)moreMoves++;
	                                else break;
	                            } 
	                        } 
	                    
	                    if(moreMoves!=0) score += calculateScore(aiScore, moreMoves);
	                    aiScore=1; 
	                    blanks = 0;
	                }
	                 
	                if(j<=3 && i>=3){
	                    for(k=1;k<4;++k){
	                        if(b.board[i-k][j+k]==1)aiScore++;
	                        else if(b.board[i-k][j+k]==2){aiScore=0;blanks=0;break;}
	                        else blanks++;                        
	                    }
	                    moreMoves=0;
	                    if(blanks>0){
	                        for(int c=1;c<4;++c){
	                            int column = j+c, row = i-c;
	                            for(int m=row;m<=5;++m){
	                                if(b.board[m][column]==0)moreMoves++;
	                                else if(b.board[m][column]==1);
	                                else break;
	                            }
	                        } 
	                        if(moreMoves!=0) score += calculateScore(aiScore, moreMoves);
	                        aiScore=1;
	                        blanks = 0;
	                    }
	                }
	                 
	                if(i>=3 && j>=3){
	                    for(k=1;k<4;++k){
	                        if(b.board[i-k][j-k]==1)aiScore++;
	                        else if(b.board[i-k][j-k]==2){aiScore=0;blanks=0;break;}
	                        else blanks++;                        
	                    }
	                    moreMoves=0;
	                    if(blanks>0){
	                        for(int c=1;c<4;++c){
	                            int column = j-c, row = i-c;
	                            for(int m=row;m<=5;++m){
	                                if(b.board[m][column]==0)moreMoves++;
	                                else if(b.board[m][column]==1);
	                                else break;
	                            }
	                        } 
	                        if(moreMoves!=0) score += calculateScore(aiScore, moreMoves);
	                        aiScore=1;
	                        blanks = 0;
	                    }
	                } 
	            }
	        }
	        return score;
	    } 
	    
	    public int minimax(int depth, int turn){
	        int gameResult = gameResult(b);
	        if(gameResult==1)return Integer.MAX_VALUE;
	        else if(gameResult==2)return Integer.MIN_VALUE;
	        else if(gameResult==0)return 0;
	        
	        if(depth==maxDepth)return evaluateBoard(b);
	        
	        int maxScore=Integer.MIN_VALUE, minScore = Integer.MAX_VALUE;
	        
	        for(int j=0;j<=6;++j){
	            if(!b.isLegalMove(j)) continue;
	                
	            if(turn==1){
	                    b.placeMove(j, 1);
	                    int currentScore = minimax(depth+1, 2);
	                    maxScore = Math.max(currentScore, maxScore);
	                    if(depth==0){
	                        System.out.println("Score for location "+j+" = "+currentScore);
	                        if(maxScore==currentScore) nextMoveLocation = j;
	                        
				if(maxScore==Integer.MAX_VALUE){
				//We know we're going to win if we play here.
			        //So no need of further evaluations.
				b.undoMove(j);break;}
	                    }
	            }else if(turn==2){
	                    b.placeMove(j, 2);
	                    int currentScore = minimax(depth+1, 1);
	                    minScore = Math.min(currentScore, minScore);
	            }
	            b.undoMove(j);
	        }
	        return turn==1?maxScore:minScore;
	    }
	    
	    public int getAIMove(){
	        nextMoveLocation = -1;
	        minimax(0, 1);
	        return nextMoveLocation;
	    }
	    
	    public void playAgainstAIConsole(int move){   
	        	b.placeMove(move-1, (byte)2); 		
				repaint();
			
				int gameResult = gameResult(b);
	        	if(gameResult==1){gend.setText("AI Wins!");add(gend);gameend=1;return;}
	            else if(gameResult==2){gend.setText("You Win!");add(gend);gameend=1;return;}
	            else if(gameResult==0){gend.setText("Draw!");add(gend);gameend=1;return;}
	            
	        	int i=getAIMove();
	            b.placeMove(i, 1);
	            String s=Integer.toString(i+1);
	            t1.setText(s);
	            repaint();
	            
	        	gameResult = gameResult(b);
	        	if(gameResult==1){gend.setText("AI Wins!");add(gend);gameend=1;return;}
	            else if(gameResult==2){gend.setText("You Win!");add(gend);gameend=1;return;}
	            else if(gameResult==0){gend.setText("Draw!");add(gend);gameend=1;return;}
	        }
	        
}
