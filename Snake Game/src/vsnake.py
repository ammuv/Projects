import pygame
from visual import *
import random
from visual.controls import *

class Game:
    
    def draw_obstacles(self):
        self.obstacle1=box(pos=(10,0,0), length=2, height=2, width=5, color=color.black)
        self.obstacle2=box(pos=(0,10,0), length=2, height=2, width=5, color=color.black)
        self.obstacle3=box(pos=(-8,0,0), length=2, height=2, width=5, color=color.black)
        self.obstacle4=box(pos=(0,-6,0), length=2, height=2, width=5, color=color.black)
        self.obstacle5=box(pos=(-12,0,0), length=2, height=2, width=5, color=color.black)
        
    def check_obstacle_collision(self):
        if (self.snake[0].pos+self.step).x>=9 and (self.snake[0].pos+self.step).x<=11:
            if (self.snake[0].pos+self.step).y>=-1 and (self.snake[0].pos+self.step).y<=1:
                self.endgame=1
        if (self.snake[0].pos+self.step).x>=-1 and (self.snake[0].pos+self.step).x<=1:
            if (self.snake[0].pos+self.step).y>=9 and (self.snake[0].pos+self.step).y<=11:
                self.endgame=1
        if (self.snake[0].pos+self.step).x>=-9 and (self.snake[0].pos+self.step).x<=-7:
            if (self.snake[0].pos+self.step).y>=-1 and (self.snake[0].pos+self.step).y<=1:
                self.endgame=1
        if (self.snake[0].pos+self.step).x>=-1 and (self.snake[0].pos+self.step).x<=1:
            if (self.snake[0].pos+self.step).y>=-7 and (self.snake[0].pos+self.step).y<=-5:
                self.endgame=1
        if (self.snake[0].pos+self.step).x>=-13 and (self.snake[0].pos+self.step).x<=-11:
            if (self.snake[0].pos+self.step).y>=-1 and (self.snake[0].pos+self.step).y<=1:
                self.endgame=1
                
    def check_free(self,arr):
        if (arr).x>=9 and (arr).x<=11:
            if (arr).y>=-1 and (arr).y<=1:
                return True
        if (arr).x>=-1 and (arr).x<=1:
            if (arr).y>=9 and (arr).y<=11:
                return True
        if (arr).x>=-9 and (arr).x<=-7:
            if (arr).y>=-1 and (arr).y<=1:
                return True
        if (arr).x>=-1 and (arr).x<=1:
            if (arr).y>=-7 and (arr).y<=-5:
                return True
        if (arr).x>=-13 and (arr).x<=-11:
            if (arr).y>=-1 and (arr).y<=1:
                return True
        return False
        
    def check_wall_collision(self):
        if (self.snake[0].pos+self.step).x>13:
            self.endgame=1
        if (self.snake[0].pos+self.step).x<-13:
            self.endgame=1
        if (self.snake[0].pos+self.step).y>13:
            self.endgame=1
        if (self.snake[0].pos+self.step).y<-13:
            self.endgame=1
        
    def initialise(self):
        scene.range = (30,30,15)
        scene.width=800
        scene.height=800
        
        self.snake=[]
        self.snake.append(frame(axis=(0,1,0)))
        for i in xrange(1,10):
          self.snake.append(box(pos=(0,-1*i,0),length=1, height=1, width=1,color=color.red))
        self.snakeHead=sphere(frame=self.snake[0],pos=(0,0,0),size=(1,1.4,1),color=color.red)
        print self.snake[0].axis
        
        self.draw_game_board()
        self.L=range(1,10)
        self.v=1
        self.step = vector(0,self.v,0)
        
        self.foodTimer=0
        self.foodTimerLimit=50
        while(1):
            self.food=sphere(pos=(random.randint(-13,13),random.randint(-13,13),0),color=color.green)
            if(self.check_free(self.food.pos)==False):
                break;
            
        self.powerTimer=0
        self.powerTimerLimit=50
        while(1):
            self.power=ring(pos=(random.randint(-13,13),random.randint(-13,13),0),radius=1,thickness=0.5,color=color.magenta)
            if(self.check_free(self.power.pos)==False):
                break;
            
        self.times=10
        self.score=0
        self.endgame=0
        self.scorelbl=label(pos=(-13,21,0),text='score: %d'%self.score,box=False)  
        self.play_game()
        
    def move_snake(self):
        for i in self.L[::-1]:
            self.snake[i].pos=self.snake[i-1].pos

    def move_reverse(self):
        if self.snake[0].pos.x>13 or self.snake[0].pos.x<-13:
            self.step.x*=-1
        elif self.snake[0].pos.y>13 or self.snake[0].pos.y<-13:
            self.step.y*=-1

    def add_snake_body(self):
        self.snake.append(box(pos=self.snake[len(self.snake)-1].pos,length=1, height=1, width=1,color=color.red))
        self.L.append(len(self.L)+1)

    def play_game(self):
        ct=1
        while 1:
            if self.endgame==1:
                break
            rate(self.times)

            self.check_wall_collision()
            
            if self.endgame==1:
                pass

            self.check_obstacle_collision()

            if self.endgame==1:
                pass
                    
            for i in range(2,len(self.snake)):
                if self.snake[0].pos==self.snake[i].pos:
                    self.endgame=1
                    break
                
            if(ct):
                self.snake[0].pos += self.step
                self.move_snake()
                
            if self.snake[0].pos==self.food.pos:
                self.times+=1
                self.foodTimerLimit+=10
                self.add_snake_body()
                self.score+=1
                self.scorelbl.text='score: %d'%self.score
                self.foodTimer=0
                while(1):
                    self.food.pos=vector(random.randint(-13,13),random.randint(-13,13),0)
                    if(self.check_free(self.food.pos)==False):
                        break;
            self.move_reverse()

            if self.foodTimer>self.foodTimerLimit:
                while(1):
                    self.food.pos=vector(random.randint(-13,13),random.randint(-13,13),0)
                    if(self.check_free(self.food.pos)==False):
                        break;
                self.foodTimer=0
            self.foodTimer+=1

            if self.snake[0].pos==self.power.pos and self.powerTimer<self.powerTimerLimit:
                self.times+=1
                self.powerTimerLimit+=10
                self.score+=2
                self.scorelbl.text='score: %d'%self.score
                self.powerTimer=0
                while(1):
                    self.power.pos=vector(random.randint(-13,13),random.randint(-13,13),0)
                    if(self.check_free(self.power.pos)==False):
                        break;
            self.move_reverse()

            if self.powerTimer>self.powerTimerLimit and self.powerTimer<3*(self.powerTimerLimit):
                self.power.radius=0;
                
            if self.powerTimer>3*(self.powerTimerLimit):
                self.power.radius=1;
                while(1):
                    self.power.pos=vector(random.randint(-13,13),random.randint(-13,13),0)
                    if(self.check_free(self.power.pos)==False):
                        break;
                self.powerTimer=0
            self.powerTimer+=1
              
            if scene.kb.keys:
                key = scene.kb.getkey()
                if key=='p':
                    ct=0
                if key=='c':
                    ct=1
                if key == 'left':
                    if self.step == vector(-1*self.v,0,0):
                        pass
                    self.step=vector(-1*self.v,0,0)
                    self.snake[0].axis=self.step
                elif key == 'right':
                    if self.step == vector(self.v,0,0):
                        pass
                    self.step=vector(self.v,0,0)
                    self.snake[0].axis=self.step
                elif key == 'up':
                    if self.step == vector(0,self.v,0):
                        pass
                    self.step=vector(0,self.v,0)
                    self.snake[0].axis=self.step
                elif key == 'down':
                    if self.step == vector(0,-1*self.v,0):
                        pass
                    self.step=vector(0,-1*self.v,0)
                    self.snake[0].axis=self.step
        exit()

    def draw_game_board(self):
        self.gameBox=frame()
        self.game_floor=box(frame=self.gameBox,size=(31,31,1),pos=(0,0,-1.5))
        self.game_w_R=box(frame=self.gameBox,size=(1,31,3),pos=(15,0,0),material=materials.marble)
        self.game_w_L=box(frame=self.gameBox,size=(1,31,3),pos=(-15,0,0),material=materials.wood)
        self.game_w_T=box(frame=self.gameBox,size=(31,1,3),pos=(0,15,0),material=materials.earth)
        self.game_w_B=box(frame=self.gameBox,size=(31,1,3),pos=(0,-15,0),material=materials.marble)
        self.draw_obstacles()

if __name__=="__main__":
    game=Game()
    game.initialise()
    exit()

      
