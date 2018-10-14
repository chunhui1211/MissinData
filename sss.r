
library("VIM")
library("dplyr")
library("ggplot2")
library("gridExtra")
library("psych")
library("caret")
library("Hmisc")
MyData <- read.csv(file="titanic.csv", header=TRUE, sep=",")
cor.ci(MyData,method="spearman")



# aggr(MyData, combined = TRUE, numbers = TRUE)
# matrixplot(MyData,interactive = F)
# scattmatrixMiss(MyData,interactive = F)
# png(filename = "temp.png",width = 500,height = 500)
# hist(aggr(MyData, combined = TRUE, numbers = TRUE),col="lightblue"
# dev.off()