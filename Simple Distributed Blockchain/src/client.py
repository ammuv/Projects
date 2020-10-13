# Will have multiple threads
#1. Thread for time synchronization - Christian's algorithm
#2. Thread for listening to other client's broadcast
#3. Thread for sending to all other client

# import socket programming library 
import socket
import time
import random
'''Helpful Time Function
seconds = time.time()
print("Seconds since epoch =", seconds)

To retrieve time,
local_time = time.ctime(seconds)
print("Local time:", local_time) '''

# import thread module 
from _thread import *
import threading 

# necessary Locks 
time_lock = threading.Lock()
local_blockchain_lock = threading.Lock()
blockchain_lock = threading.Lock()

# change time to format that is convinient
# global variables - time, parameters, local and main blockchain, portsids and balance
sim_time_at_sync = 0
sys_time_at_sync = 0
delta = 0 # discrepancy
tau = 0 # delay
rho = 0 # drift
balance = 0
my_id = 0
port_ids = [13000,13001,13002]
soc = [] # store opened sockets to other clients
local_blockchain = []
blockchain = [] 

def initialize_global_var():
    ''' Initialize all required global var '''
    global sim_time_at_sync, sys_time_at_sync, delta, tau, rho, balance, my_id, port_ids, soc, local_blockchain, blockchain  
    #time recorded as seconds from epoch
    sim_time_at_sync = sys_time_at_sync = time.time()

    # tau sampled at random and others are fixed
    delta = 20
    tau = 5 # use this to compute random delay - random.uniform(1, tau)
    rho = 2
    balance = 1000 # initial balance must be 10 cents

    #initialize id for current client
    #my_id = id_var
    
def thread_time():
    ''' Thread function for updating time continuosly
    '''
    global sim_time_at_sync, sys_time_at_sync, delta, tau, rho, balance, my_id, port_ids, soc, local_blockchain, blockchain  
    #create client-socket here and connect to time_server
    host = '127.0.0.1'
  
    # time server port
    port = 12345
    s = socket.socket(socket.AF_INET,socket.SOCK_STREAM) 
  
    # connect to time server
    s.connect((host,port)) 
  
    message = "time"
    t = delta/(2*rho)
    
    while True: 
        start = time.time()
        time.sleep(random.uniform(1, tau))
        # message sent to server 
        s.send(message.encode('ascii')) 
  
        # messaga received from server 
        utc = s.recv(1024) 
        end = time.time()
        
        # print the received time
        # print('Time received from the server :',str(utc.decode('ascii')))
        utc = str(utc.decode('ascii'))
        utc = float(utc)
        #print(time.ctime(utc))

        # modify according to what is received by locking before modifying
        time_lock.acquire()

        sim_time_at_sync = utc + (end-start)/2
        sys_time_at_sync = end

        time_lock.release()
        
        time.sleep(t)# todo - modify to suitable time (t - (end-start)) ----> something like t>10

    # close the connection 
    s.close() 

def thread_listen_client(c):
    ''' Thread function for continuosly listening to client broadcast
    '''
    global sim_time_at_sync, sys_time_at_sync, delta, tau, rho, balance, my_id, port_ids, soc, local_blockchain, blockchain  
    while True: 
            # data received from client 
            data = c.recv(1024)
            if not data: 
                    print('Client disconnected!') 
                    break
            data = str(data.decode('ascii'))
            data = data.split(",")

            #insert received transfer into local blockchain
            local_blockchain_lock.acquire()
            
            local_blockchain.append(data)

            local_blockchain_lock.release()

    # connection closed 
    c.close() 

def thread_send_transfer_request(s,data):
    ''' Thread function to send blokchain request to a particular client
    '''
    global sim_time_at_sync, sys_time_at_sync, delta, tau, rho, balance, my_id, port_ids, soc, local_blockchain, blockchain  
    time.sleep(random.uniform(1, tau))
    s.send(data.encode('ascii'))

def update_blockchain(t):
    ''' Function to move transactions from lock_blockchain to blockchain
    '''
    global sim_time_at_sync, sys_time_at_sync, delta, tau, rho, balance, my_id, port_ids, soc, local_blockchain, blockchain  
    local_blockchain.sort()
    total = 0
    blockchain_lock.acquire()
    local_blockchain_lock.acquire()
    
    for b in local_blockchain:
        if float(b[0]) < t:
            li = b[1:4] # li will contain transaction as a list of from, to and amount
            blockchain.append(li)
            if(li[0]==str(my_id)): #transaction from you
                balance = balance - float(li[2])
            if(li[1]==str(my_id)): # transaction to you
                balance = balance + float(li[2])
            total += 1
        else:
            break
        
    local_blockchain = local_blockchain[total:] # updating local blockchain
    blockchain_lock.release()
    local_blockchain_lock.release()
       
def handle_transaction_request(to, amount):
    ''' Function to handle transaction request
    '''
    global sim_time_at_sync, sys_time_at_sync, delta, tau, rho, balance, my_id, port_ids, soc, local_blockchain, blockchain  
    time_lock.acquire()
    #can be (1±ρ)  - need to adjust later for now every thing has +rho
    t = sim_time_at_sync + (time.time()-sys_time_at_sync)*(1+rho)
    time_lock.release()

    #check if balance is sufficient
    update_blockchain(t)
    if(amount>balance):
        print("Insufficient balance!")
        return
    
    #send info to other clients   
    data = str(t) + "," + str(my_id) + "," + str(to) + "," + str(amount)
    for s in soc:
        # Start a new thread and return its identifier 
        start_new_thread(thread_send_transfer_request, (s,data,))

    time.sleep(delta+tau)

    #update local blockchain
    data = data.split(",")

    local_blockchain_lock.acquire()
    
    local_blockchain.append(data)
    
    local_blockchain_lock.release()
    
    print(local_blockchain)
    # update blockchain
    update_blockchain(t)
    print(blockchain)

def handle_balance_request():
    ''' Function to handle balance request
    '''
    global sim_time_at_sync, sys_time_at_sync, delta, tau, rho, balance, my_id, port_ids, soc, local_blockchain, blockchain  
    time_lock.acquire()
    #can be (1±ρ)  - need to adjust later for now every thing has +rho
    cur_sim_time = sim_time_at_sync + (time.time()-sys_time_at_sync)*(1+rho)
    time_lock.release()

    time.sleep(delta+tau)
    
    #check if balance is sufficient
    update_blockchain(cur_sim_time)
    print("current balance is: ${0:.2f}".format(balance/100)) # print balance
    print(blockchain)

def listen_client(s):
    ''' Thread function to listen to all clients wanting to connect to server
    '''
    global sim_time_at_sync, sys_time_at_sync, delta, tau, rho, balance, my_id, port_ids, soc, local_blockchain, blockchain  
    # put the socket into listening mode 
    s.listen(5) 
    print("socket is listening") 

    # a forever loop until client wants to exit 
    while True: 
        # establish connection with client 
        c, addr = s.accept() 

        print('Connected to :', addr[0], ':', addr[1]) 

        # Start a new thread and return its identifier 
        start_new_thread(thread_listen_client, (c,)) 
    s.close()     

def print_usernames(usernames):
    for i in range(len(usernames)):
        print(str(i) + ': ' + str(usernames[i]))
        
def get_user_num(num_users):
    while True:
        user_num = int(input('Enter a client number: '))
        if 0 <= user_num and user_num < num_users:
            return int(user_num)
        else:
            print('Invalid entry.')
            
def Main():
    global sim_time_at_sync, sys_time_at_sync, delta, tau, rho, balance, my_id, port_ids, soc, local_blockchain, blockchain  
    initialize_global_var()
    #print('Enter client no: ')
    print_usernames(port_ids)
    my_id = port_ids[get_user_num(len(port_ids))]

    # make client server
    host = "" 
    port = my_id
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM) 
    s.bind((host, port)) 
    print("socket binded to port", port)

    #threads for connecting to incoming clients and then to connect to time server and update time constantly
    start_new_thread(thread_time, ()) 
    time.sleep(10) # to ensure that time var are computed before they are accessed
    start_new_thread(listen_client, (s,)) 
    
    #connecting to all other clients here
    host = '127.0.0.1'
    port_ids_cur = []
            
    for port in port_ids:
        print("trying to connect to sever", port)
        if port != my_id:
            port_ids_cur.append(port)
            c = socket.socket(socket.AF_INET,socket.SOCK_STREAM) 
            while c.connect_ex((host,port)):
                print("connecting to other servers!")
            soc.append(c)

    print("all other clients connected now!")
    time.sleep(10)
    while True:
        ch = input("Enter choice: t (transfer) and b(balance):")
        if(ch=="b"):
            handle_balance_request()
        elif(ch=="t"):
            print('Whom would you like to transfer to?')
            print_usernames(port_ids_cur)
            to_user = port_ids_cur[get_user_num(len(port_ids_cur))]
            #to = int(input("Enter receiver: 13000,13001,13002")) #handle IO edge cases
            print('How much would you like to transfer?')
            dollars = int(input('Dollars: '))
            cents = int(input('Cents: '))
            amt = dollars * 100 + cents
            #amt = int(input("Enter amounts in cents"))
            handle_transaction_request(to_user, amt)
            
        else:
            print("Incorrect choice!!!")
        
        
if __name__ == '__main__':
    Main() 



