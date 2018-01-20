import numpy as np
from operator import itemgetter

adj=[[0,0,0,1,0,0,0,0,0,0],[0,0,0,1,0,0,0,0,0,0],[0,0,0,1,0,0,0,0,0,0],[1,1,1,0,1,1,1,1,1,1],[0,0,0,1,0,0,0,0,0,1],[0,0,0,1,0,0,0,0,0,1],[0,0,0,1,0,0,0,0,0,1],[0,0,0,1,0,0,0,0,0,1],[0,0,0,1,0,0,0,0,0,1],[0,0,0,1,1,1,1,1,1,0]]
v=len(adj)
p=np.random.permutation(v)
value=[]
index=0
match=[0]*v
for val in p:
    l=[index,val]
    value.append(l)
    index=index+1
print "random permutation"
print value
value=sorted(value,key=itemgetter(1))
matching=[]
for i in range(0,v):
    ver1=value[i][0]
    if match[ver1]==1:
        continue
    for j in range(i+1,v):
        ver2=value[j][0]
        if match[ver2]==1:
            continue
        elif adj[ver1][ver2]==1:
            match[ver1]=1
            match[ver2]=1
            l=[ver1,ver2]
            matching.append(l)
            break
print "matching"
print matching       
            

