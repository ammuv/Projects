# this will be a server
# It will receive requests from clients for current time and will return the time
import time
import random
# import socket programming library 
import socket 
  
# import thread module 
from _thread import *
import threading 

tau = 5 #for simulating delay

# thread function 
def threaded(c): 
    while True: 

        # data received from client 
        data = c.recv(1024) 
        if not data: 
            print('client disconnected') 
            break
        
        #t = time.localtime()
        #current_time = time.strftime("%H:%M:%S", t)   

        #compute time in seconds
        sec = time.time()
        current_time = str(sec)

        #delay
        time.sleep(random.uniform(1, tau))
        # send current UTC time to client
        c.send(current_time.encode('ascii')) 

    # connection closed 
    c.close() 
  
  
def Main(): 
    host = "" 

    # port number
    port = 12345
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM) 
    s.bind((host, port)) 
    print("timer server socket binded to port", port) 

    # put the socket into listening mode 
    s.listen(5) 
    print("time server socket is listening") 

    # a forever loop until client wants to exit 
    while True: 

        # establish connection with client 
        c, addr = s.accept() 

        print('Connected to :', addr[0], ':', addr[1]) 

        # Start a new thread and return its identifier 
        start_new_thread(threaded, (c,)) 
    s.close() 
  
  
if __name__ == '__main__': 
    Main() 


