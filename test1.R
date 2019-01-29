library("VIM")
data<-read.csv("C:\\Users\\Chunhui\\Desktop\\testdata\\titanic.csv",na.strings = "")
matrixplot(data)
barMiss(data)
aggr(data,numbers=TRUE,prop=FALSE)
marginplot(data[c("Age","Cabin")],pch=c(20),col=c("green","red","blue"))

