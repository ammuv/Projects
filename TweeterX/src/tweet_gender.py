from __future__ import division
import pandas as pd
import numpy as np
from random import shuffle

INPUT_CSV = "gender-classifier-DFE-791531.csv"
csv = pd.read_csv(INPUT_CSV, encoding='latin1')
header = csv.head()
data = csv.values.tolist()

#print header

# remove unconfident points
data = list(filter(lambda x: x[6] == 1.0, data))

# split
tmales = list(filter(lambda x: x[5] == "male", data))
tfemales = list(filter(lambda x: x[5] == "female", data))
tbrands = list(filter(lambda x: x[5] == "brand", data))

#print total info
print (" females:"+str(len(tfemales)))
print (" males:"+str(len(tmales)))
print (" brands:"+str(len(tbrands)))

#shuffle all the data
shuffle(tmales)
shuffle(tfemales)
shuffle(tbrands)

#split and find no of data in training set for 10 fold validation
total=len(data)
nm=len(tmales)
nf=len(tfemales)
nb=len(tbrands)

percent_males=float(nm/total)
percent_females=float(nf/total)
percent_brands=float(nb/total)

no_test_males=int(percent_males*0.1*total)
no_test_females=int(percent_females*0.1*total)
no_test_brands=int(percent_brands*0.1*total)

print("total:"+str(int(0.1*total)))
print("males:"+str(no_test_males))
print("females:"+str(no_test_females))
print("brands"+str(no_test_brands))

#set of functions required for text processing:
#1.union
#2.wordify
#3.try_string
#4.ret_frequency

#union of two lists
def union(a, b):
    return list(set(a) | set(b))

# remove unwanted char
def wordify(t):
	t = t.replace("'", " ")
	t = t.replace(",", " ")
	t = t.replace(".", " ")
	t = t.replace("!", " ")
	t = t.replace("?", " ")
	t = t.replace("&", " ")
	t = t.replace("|", " ")
	t = t.replace("/", " ")
	t = t.replace(";", " ")
	t = t.replace(":", " ")
	t = t.replace("\\", " ")
	t = t.replace("\\n", " ")
	return t
    
#If string conversion is possible convert else return empty string
def try_string(t):
	try:
		return str(t)
	except:
		return ""
	    
#Frequency of words in wordlist
def ret_frequency(Wordlist):
	words = {}
	for w in Wordlist:
		if w in words:
			words[w] += 1.0
		else:
			words[w] = 1.0
	for w in words:
		words[w] /= len(Wordlist)
	return words
    
#10 fold cross validation

for r in range(0,10):
    
    #get test and training set
    findex=range(i*no_test_females,(i+1)*no_test_females)
    mindex=range(i*no_test_males,(i+1)*no_test_males)
    bindex=range(i*no_of_brands,(i+1)*no_of_brands)
    
    test=[tfemales[i] for i in findex]+[tmales[i] for i in mindex]+[tbrands[i]for i in bindex]
    females=[tfemales[i] for i not in findex]
    males=[tmales[i] for i not in mindex]
    brands=[tbrands[i]for i not in bindex]
    
    # combine female words into a single list of 'words'
    female_words = " ".join(list(map(lambda x: try_string(x[10]), females)))
    female_words = female_words.lower()
    female_words = wordify(female_words).split(" ")
    female_words = list(w for w in female_words if len(w) > 1)

    # males' words
    male_words = " ".join(list(map(lambda x: try_string(x[10]), males)))
    male_words = male_words.lower()
    male_words = wordify(male_words).split(" ")
    male_words = list(w for w in male_words if len(w) > 1)

    # brands' words
    brand_words = " ".join(list(map(lambda x: try_string(x[10]), brands)))
    brand_words = brand_words.lower()
    brand_words = wordify(brand_words).split(" ")
    brand_words = list(w for w in brand_words if len(w) > 1)

    F = ret_frequency(female_words)
    M = ret_frequency(male_words)
    B = ret_frequency(brand_words)
    keys = union(union(F.keys(), M.keys()), B.keys())

    relative_f = []
    relative_m = []
    relative_b = []
    for k in keys:
            if k not in F:
                    F[k] = 0.0
            if k not in M:
                    M[k] = 0.0
            if k not in B:
                    B[k] = 0.0
            if F[k] + M[k] + B[k] > 0.002:
                    relative_f.append((F[k] / (F[k] + M[k] + B[k]), k))
                    relative_m.append((M[k] / (F[k] + M[k] + B[k]), k))
                    relative_b.append((B[k] / (F[k] + M[k] + B[k]), k))
                    
    relative_f = list(sorted(relative_f))
    relative_m = list(sorted(relative_m))
    relative_b = list(sorted(relative_b))         

    #predict test data value

    #words in test data
    words = " ".join(list(map(lambda x: try_string(x[10]), test)))
    words = words.lower()
    words = wordify(words).split(" ")
    words = list(w for w in words if len(w) > 1)
    
    print ("\nfemale:")
    for w in relative_f[-10:]:
            print (w)

    print ("male:")
    for w in relative_m[-10:]:
            print (w)

    print ("brand:")
    for w in relative_b[-10:]:
            print (w)
