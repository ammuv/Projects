setwd('E:/sem6/AI')
data<-read.csv("data.csv",header=T)
dataB<-data[which(data$diagnosis == "B"), ]
dataM<-data[which(data$diagnosis == "M"), ]
ncol(data)
a = pd.unique(data.values.ravel())
