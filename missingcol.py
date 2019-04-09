import pandas as pd
import numpy as np 
import sys 

params=sys.argv[1] 
params=params.split(';')
file=params[0]
var=params[1]
var=var.split(',')
path=r'./upload/'+file
df=pd.read_csv(path,skipfooter=1)

x=[]
y=[]
z=[]
for col in var:
    if df[col].dtypes=="object":
        x.append(col)
    else:
        y.append(col)

for col in df.columns:
    if df[col].dtypes=="int64":
        z.append(col)
    elif df[col].dtypes=="float64":
        z.append(col)

cage=','.join(x)
num=','.join(y)
ynum=','.join(z)

print(cage+";"+num+";"+ynum)

